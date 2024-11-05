<?php

function tumbas_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '330',   // px
            'height'    => '330',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '660',   // px
            'height'    => '660',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '130',    // px
            'height'    => '130',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}
add_action( 'init', 'tumbas_woocommerce_setup');

if ( !function_exists('tumbas_get_products') ) {
    function tumbas_get_products($categories = array(), $product_type = 'featured_product', $paged = 1, $post_per_page = -1, $orderby = '', $order = '', $excludes = array()) {
        global $woocommerce, $wp_query;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        if ( isset( $args['orderby'] ) ) {
            if ( 'price' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }

        switch ($product_type) {
            case 'best_selling':
                $args['meta_key']='total_sales';
                $args['orderby']='meta_value_num';
                $args['ignore_sticky_posts']   = 1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $args['ignore_sticky_posts']=1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = array(
                             'key' => '_featured',
                             'value' => 'yes'
                         );
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'top_rate':
                $args['meta_key']       = '_wc_average_rating';
                $args['orderby']       = 'meta_value_num';
                $args['order']       = 'DESC';
                $args['meta_query'] = WC()->query->get_meta_query();
                $args['tax_query'] = WC()->query->get_tax_query();
                break;
            case 'recent_product':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'deals':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['meta_query'][] =  array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => time(),
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                );
                break;     
            case 'on_sale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $args['post__in'] = $product_ids_on_sale;
                break;
            case 'recent_review':
                if($post_per_page == -1) $_limit = 4;
                else $_limit = $post_per_page;
                global $wpdb;
                $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c
                        WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0
                        ORDER BY c.comment_date ASC";
                $results = $wpdb->get_results($query, OBJECT);
                $_pids = array();
                foreach ($results as $re) {
                    if(!in_array($re->comment_post_ID, $_pids))
                        $_pids[] = $re->comment_post_ID;
                    if(count($_pids) == $_limit)
                        break;
                }

                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = $_pids;

                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $args['tax_query']    = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field'         => 'slug',
                    'terms'         => $categories,
                    'operator'      => 'IN'
                )
            );
        }

        if ( !empty($excludes) && is_array($excludes) ) {
            $args['post__not_in'] = $excludes;
        }
        return new WP_Query($args);
    }
}
//
if ( ! function_exists( 'tumbas_woocommerce_content' ) ) {

    function tumbas_woocommerce_content() {
        if ( is_singular( 'product' ) ) {

            while ( have_posts() ) : the_post();
                wc_get_template_part( 'content', 'single-product' );
            endwhile;

        } else { ?>

            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>
            <?php if ( have_posts() ) : ?>
                <?php do_action('woocommerce_before_shop_loop'); ?>
                    
                <?php
                    $args = array(
                        'before'        => '<div class="categories-wrapper"><div class="row">',
                        'after'         => '</div></div>',
                        'force_display' => false
                    );
                    woocommerce_product_subcategories($args);
                ?>

                <?php do_action( 'apus_before_products'); ?>
                
                <?php woocommerce_product_loop_start(); ?>
                    
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    
                <?php woocommerce_product_loop_end(); ?>
                <?php do_action('woocommerce_after_shop_loop'); ?>
            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                <?php wc_get_template( 'loop/no-products-found.php' ); ?>
            <?php endif;

        }
    }
}

// cart modal
if ( !function_exists('tumbas_woocommerce_cart_modal') ) {
    function tumbas_woocommerce_cart_modal() {
        wc_get_template( 'content-product-cart-modal.php' , array( 'current_product_id' => (int)$_GET['product_id'] ) );
        die;
    }
}

add_action( 'wp_ajax_tumbas_add_to_cart_product', 'tumbas_woocommerce_cart_modal' );
add_action( 'wp_ajax_nopriv_tumbas_add_to_cart_product', 'tumbas_woocommerce_cart_modal' );


// hooks
if ( !function_exists('tumbas_woocommerce_enqueue_styles') ) {
    function tumbas_woocommerce_enqueue_styles() {
        $css_folder = tumbas_get_css_folder();
        $js_folder = tumbas_get_js_folder();
        $min = tumbas_get_asset_min();

        wp_enqueue_style( 'tumbas-woocommerce', $css_folder . '/woocommerce'.$min.'.css' , 'tumbas-woocommerce' , TUMBAS_THEME_VERSION, 'all' );
        if ( is_singular('product') ) {
            wp_enqueue_script( 'jquery-jcarousellite', $js_folder . '/jquery.jcarousellite'.$min.'.js', array( 'jquery' ), '20150330', true );

            // photoswipe
            wp_enqueue_script( 'photoswipe-js', $js_folder . '/photoswipe/photoswipe'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-ui-js', $js_folder . '/photoswipe/photoswipe-ui-default'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-init', $js_folder . '/photoswipe/photoswipe.init'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_style( 'photoswipe-style', $js_folder . '/photoswipe/photoswipe'.$min.'.css', array(), '3.2.0' );
            wp_enqueue_style( 'photoswipe-skin-style', $js_folder . '/photoswipe/default-skin/default-skin'.$min.'.css', array(), '3.2.0' );
            
        }
        $alert_message = array(
            'success'       => sprintf( '<div class="woocommerce-message">%s <a class="button btn btn-primary btn-inverse wc-forward" href="%s">%s</a></div>', esc_html__( 'Products was successfully added to your cart.', 'tumbas' ), wc_get_cart_url(), esc_html__( 'View Cart', 'tumbas' ) ),
            'empty'         => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'No options selected. Please choose current product option.', 'tumbas' ) ),
            'no_variation'  => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'Product Variation does not selected.', 'tumbas' ) ),
        );
        wp_register_script( 'tumbas-woocommerce', $js_folder . '/woocommerce'.$min.'.js', array( 'jquery' ), '20150330', true );
        wp_localize_script( 'tumbas-woocommerce', 'tumbas_woo', $alert_message );
        wp_enqueue_script( 'tumbas-woocommerce' );

        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'tumbas_woocommerce_enqueue_styles', 150 );

// cart
if ( !function_exists('tumbas_woocommerce_header_add_to_cart_fragment') ) {
    function tumbas_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['#cart .count-item'] =  sprintf(_n(' <span class="count-item"> %d  </span> ', ' <span class="count-item"> %d </span> ', $woocommerce->cart->cart_contents_count, 'tumbas'), $woocommerce->cart->cart_contents_count);
        $fragments['#cart .total-cart-price'] = '<div class="total-cart-price">'.trim( $woocommerce->cart->get_cart_total() ).'</div>';
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'tumbas_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('tumbas_woocommerce_breadcrumb_defaults') ) {
    function tumbas_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = tumbas_get_config('woo_breadcrumb_image');
        $breadcrumb_color = tumbas_get_config('woo_breadcrumb_color');
        $style = array();
        $breadcrumb_enable = tumbas_get_config('show_product_breadcrumbs');
        if ( !$breadcrumb_enable ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner clearfix">';
        $args['wrap_after'] = '</div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'tumbas_woocommerce_breadcrumb_defaults' );
add_action( 'tumbas_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('tumbas_woocommerce_display_modes') ) {
    function tumbas_woocommerce_display_modes(){
        global $wp;
        $current_url = tumbas_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = tumbas_woocommerce_get_display_mode();

        echo '<div class="display-mode">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="mn-icon-99"></i>'.'</a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="mn-icon-105"></i>'.'</a>';
        echo '</div>'; 
    }
}

if ( !function_exists('tumbas_woocommerce_get_display_mode') ) {
    function tumbas_woocommerce_get_display_mode() {
        $woo_mode = tumbas_get_config('product_display_mode', 'grid');
        if ( isset($_COOKIE['tumbas_woo_mode']) && ($_COOKIE['tumbas_woo_mode'] == 'list' || $_COOKIE['tumbas_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['tumbas_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('tumbas_shop_page_link')) {
    function tumbas_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}

// set display mode to cookie
if ( !function_exists('tumbas_before_woocommerce_init') ) {
    function tumbas_before_woocommerce_init() {
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'tumbas_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['tumbas_woo_mode'] = trim($_GET['display_mode']);
        }
    }
}
add_action( 'init', 'tumbas_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('tumbas_woocommerce_shop_per_page') ) {
    function tumbas_woocommerce_shop_per_page($number) {
        $value = tumbas_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'tumbas_woocommerce_shop_per_page', 100 );

// Number of products per row
if ( !function_exists('tumbas_woocommerce_shop_columns') ) {
    function tumbas_woocommerce_shop_columns($number) {
        $value = tumbas_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 5, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'tumbas_woocommerce_shop_columns' );

// share box
if ( !function_exists('tumbas_woocommerce_share_box') ) {
    function tumbas_woocommerce_share_box() {
        if ( tumbas_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox-product' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'tumbas_woocommerce_share_box', 100 );

// quickview
if ( !function_exists('tumbas_woocommerce_quickview') ) {
    function tumbas_woocommerce_quickview() {
        $args = array(
            'post_type'=>'product',
            'product' => $_GET['productslug']
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ($query->have_posts()): $query->the_post(); global $product;
                wc_get_template_part( 'content', 'product-quickview' );
            endwhile;
        }
        wp_reset_postdata();
        die;
    }
}

if ( tumbas_get_global_config('show_quickview') ) {
    add_action( 'wp_ajax_tumbas_quickview_product', 'tumbas_woocommerce_quickview' );
    add_action( 'wp_ajax_nopriv_tumbas_quickview_product', 'tumbas_woocommerce_quickview' );
}

// swap effect
if ( !function_exists('tumbas_swap_images') ) {
    function tumbas_swap_images($size = 'shop_catalog') {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = 'image-no-effect unveil-image';
        if (has_post_thumbnail()) {
            $product_thumbnail_id = get_post_thumbnail_id();
            $product_thumbnail_title = get_the_title( $product_thumbnail_id );
            $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $size );
            $placeholder_image = tumbas_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

            if ( tumbas_get_config('show_swap_image') ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = 'image-hover';
                    $product_thumbnail_hover_title = get_the_title( $attachment_ids[0] );
                    $product_thumbnail_hover = wp_get_attachment_image_src( $attachment_ids[0], $size );
                    
                    if ( tumbas_get_config('image_lazy_loading') ) {
                        echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog unveil-image image-effect" />';
                    } else {
                        echo '<img src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog image-effect" />';
                    }
                }
            }
            
            if ( tumbas_get_config('image_lazy_loading') ) {
                echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
            } else {
                echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
            }
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'tumbas').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}


// get image
if ( !function_exists('tumbas_product_get_image') ) {
    function tumbas_product_get_image($thumb = 'shop_thumbnail') {
        global $product;

        $product_thumbnail_id = get_post_thumbnail_id();
        $product_thumbnail_title = get_the_title( $product_thumbnail_id );
        $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $thumb );
        
        $placeholder_image = tumbas_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

        echo '<div class="product-image">';
        if ( tumbas_get_config('image_lazy_loading') ) {
            echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image unveil-image" />';
        } else {
            echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image" />';
        }
        echo '</div>';
    }
}

// layout class for woo page
if ( !function_exists('tumbas_woocommerce_content_class') ) {
    function tumbas_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( tumbas_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'tumbas_woocommerce_content_class', 'tumbas_woocommerce_content_class' );

// get layout configs
if ( !function_exists('tumbas_get_woocommerce_layout_configs') ) {
    function tumbas_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = tumbas_get_config('product_'.$page.'_left_sidebar');
        $right = tumbas_get_config('product_'.$page.'_right_sidebar');

        switch ( tumbas_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3'  );
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-6 ' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
        }

        return $configs; 
    }
}

// Show/Hide related, upsells products
if ( !function_exists('tumbas_woocommerce_related_upsells_products') ) {
    function tumbas_woocommerce_related_upsells_products($located, $template_name) {
        $content_none = get_template_directory() . '/woocommerce/content-none.php';
        $show_product_releated = tumbas_get_config('show_product_releated');
        if ( 'single-product/related.php' == $template_name ) {
            if ( !$show_product_releated  ) {
                $located = $content_none;
            }
        } elseif ( 'single-product/up-sells.php' == $template_name ) {
            $show_product_upsells = tumbas_get_config('show_product_upsells');
            if ( !$show_product_upsells ) {
                $located = $content_none;
            }
        }

        return apply_filters( 'tumbas_woocommerce_related_upsells_products', $located, $template_name );
    }
}
add_filter( 'wc_get_template', 'tumbas_woocommerce_related_upsells_products', 10, 2 );

if ( !function_exists( 'tumbas_product_tabs' ) ) {
    function tumbas_product_tabs($tabs) {
        global $product, $post;
        if ( tumbas_get_config('show_product_accessories_tab', true) && is_object($product) ) {
            $pids = Tumbas_Woo_Custom::get_accessories( $product );
            if ( !empty($pids) ) {
                $accessory_tabs = array(
                    'accessory' => array(
                        'title' => esc_html__('Accessories', 'tumbas'),
                        'priority' => 5,
                        'callback' => 'tumbas_display_accessories',
                        'icon' => tumbas_get_tab_icon('product_accessories_tab_icon'),
                        'icon_hover' => tumbas_get_tab_icon('product_accessories_tab_icon_hover')
                    )
                );
                $tabs = array_merge($accessory_tabs, $tabs);
            }
        }
        
        if ( tumbas_get_config('show_product_specification_tab', true) && get_post_meta( $post->ID, 'apus_product_specification', true ) ) {
            $tabs['specifications'] = array(
                'title' => esc_html__('Specification', 'tumbas'),
                'priority' => 15,
                'callback' => 'tumbas_display_specification',
                'icon' => tumbas_get_tab_icon('product_specification_tab_icon'),
                'icon_hover' => tumbas_get_tab_icon('product_specification_tab_icon_hover')
            );
        }

        if ( !tumbas_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        } elseif ( isset($tabs['reviews']) ) {
            $tabs['reviews']['icon'] = tumbas_get_tab_icon('product_review_tab_icon');
            $tabs['reviews']['icon_hover'] = tumbas_get_tab_icon('product_review_tab_icon_hover');
        }
        if ( !tumbas_get_config('show_product_description_tab') && isset($tabs['description']) ) {
            unset( $tabs['description'] ); 
        } elseif ( isset($tabs['description']) ) {
            $tabs['description']['icon'] = tumbas_get_tab_icon('product_description_tab_icon');
            $tabs['description']['icon_hover'] = tumbas_get_tab_icon('product_description_tab_icon_hover');
        }
        
        if ( isset($tabs['additional_information']) ) {
            unset( $tabs['additional_information'] ); 
        }

        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'tumbas_product_tabs', 90 );

if ( !function_exists( 'tumbas_get_tab_icon') ) {
    function tumbas_get_tab_icon($key) {
        $icon_url = '';
        $icon = tumbas_get_config($key);
        if ( isset($icon['url']) && !empty($icon['url']) ) {
            $icon_url = $icon['url'];
        }
        return $icon_url;
    }
}

if ( !function_exists( 'tumbas_minicart') ) {
    function tumbas_minicart() {
        $template = apply_filters( 'tumbas_minicart_version', '' );
        get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
// Wishlist
add_filter( 'yith_wcwl_button_label', 'tumbas_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'tumbas_woocomerce_icon_wishlist_add' );
function tumbas_woocomerce_icon_wishlist( $value='' ){
    return '<i class="mn-icon-1246"></i>'.'<span class="sub-title">'.esc_html__('Add to Wishlist','tumbas').'</span>';
}

function tumbas_woocomerce_icon_wishlist_add(){
    return '<i class="mn-icon-2"></i>'.'<span class="sub-title">'.esc_html__('Wishlisted','tumbas').'</span>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


function tumbas_woocommerce_get_ajax_products() {
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';
    $columns = isset($_POST['columns']) ? $_POST['columns'] : 4;
    $number = isset($_POST['number']) ? $_POST['number'] : 4;
    $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : '';
    $layout_type = isset($_POST['layout_type']) ? $_POST['layout_type'] : '';

    $categories_id = !empty($categories) ? array($categories) : array();
    $loop = tumbas_get_products( $categories_id, $product_type, 1, $number );
    if ( $loop->have_posts()) {
        wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) );
    }
    exit();
}
add_action( 'wp_ajax_tumbas_get_products', 'tumbas_woocommerce_get_ajax_products' );
add_action( 'wp_ajax_nopriv_tumbas_get_products', 'tumbas_woocommerce_get_ajax_products' );


function tumbas_woocommerce_photoswipe() {
    if ( !is_singular('product') ) {
        return;
    }
    ?>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>

        <div class="pswp__scroll-wrap">

          <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
          </div>

          <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="<?php echo esc_html__('Close (Esc)', 'tumbas'); ?>"></button>
                <button class="pswp__button pswp__button--share" title="<?php echo esc_html__('Share', 'tumbas'); ?>"></button>
                <button class="pswp__button pswp__button--fs" title="<?php echo esc_html__('Toggle fullscreen', 'tumbas'); ?>"></button>
                <button class="pswp__button pswp__button--zoom" title="<?php echo esc_html__('Zoom in/out', 'tumbas'); ?>"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="<?php echo esc_html__('Previous (arrow left)', 'tumbas'); ?>"></button>
            <button class="pswp__button pswp__button--arrow--right" title="<?php echo esc_html__('Next (arrow right)', 'tumbas'); ?>"></button>
            <div class="pswp__caption">
              <div class="pswp__caption__center"></div>
            </div>
          </div>

        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'tumbas_woocommerce_photoswipe' );


function tumbas_display_accessories() {
    get_template_part( 'woocommerce/single-product/tabs/accessories' );
}

function tumbas_display_specification() {
    get_template_part( 'woocommerce/single-product/tabs/specification' );
}



function tumbas_autocomplete_options_helper( $options ){
    $output = array();
    $options = array_map('trim', explode(',', $options));
    foreach( $options as $option ){
        $tmp = explode( ":", $option );
        $output[] = $tmp[0];
    }
    return $output; 
}


function tumbas_set_loop_shop_per_page() {
    if ( isset( $_REQUEST['wppp_ppp'] ) ) :
        $per_page = intval( $_REQUEST['wppp_ppp'] );
        WC()->session->set( 'products_per_page', intval( $_REQUEST['wppp_ppp'] ) );
    elseif ( isset( $_REQUEST['ppp'] ) ) :
        $per_page = intval( $_REQUEST['ppp'] );
        WC()->session->set( 'products_per_page', intval( $_REQUEST['ppp'] ) );
    elseif ( WC()->session->__isset( 'products_per_page' ) ) :
        $per_page = intval( WC()->session->__get( 'products_per_page' ) );
    else :
        $per_page = tumbas_get_config('product_columns', 4) * 4;
        $per_page = apply_filters( 'tumbas_loop_shop_per_page', $per_page );
    endif;
    
    return $per_page;
}
add_filter( 'loop_shop_per_page', 'tumbas_set_loop_shop_per_page', 2000 );

if ( ! function_exists( 'tumbas_wc_products_per_page' ) ) {
    /**
     * Outputs a dropdown for user to select how many products to show per page
     */
    function tumbas_wc_products_per_page() {
        
        global $wp_query;

        $action             = '';
        $cat                = '';
        $cat                = $wp_query->get_queried_object();
        $method             = apply_filters( 'tumbas_wc_ppp_method', 'post' );
        $return_to_first    = apply_filters( 'tumbas_wc_ppp_return_to_first', false );
        $total              = $wp_query->found_posts;
        $per_page           = $wp_query->get( 'posts_per_page' );
        $_per_page          = tumbas_get_global_config('number_products_per_page', 4);

        // Generate per page options
        $products_per_page_options = array();
        while( $_per_page < $total ) {
            $products_per_page_options[] = $_per_page;
            $_per_page = $_per_page * 2;
        }

        if ( empty( $products_per_page_options ) ) {
            return;
        }

        $products_per_page_options[] = -1;

        // Set action url if option behaviour is true
        // Paste QUERY string after for filter and orderby support
        $query_string = ! empty( $_SERVER['QUERY_STRING'] ) ? '?' . add_query_arg( array( 'ppp' => false ), $_SERVER['QUERY_STRING'] ) : null;

        if ( isset( $cat->term_id ) && isset( $cat->taxonomy ) && $return_to_first ) :
            $action = get_term_link( $cat->term_id, $cat->taxonomy ) . $query_string;
        elseif ( $return_to_first ) :
            $action = get_permalink( wc_get_page_id( 'shop' ) ) . $query_string;
        endif;

        // Only show on product categories
        if ( ! woocommerce_products_will_display() ) :
            return;
        endif;
        
        do_action( 'tumbas_wc_ppp_before_dropdown_form' );

        ?><form method="POST" action="<?php echo esc_url( $action ); ?>" class="form-tumbas-wc-ppp"><?php

             do_action( 'tumbas_wc_ppp_before_dropdown' );

            ?>  <div class="show">
                <label for="tumbas-wc-wppp-select"><?php echo esc_html__( 'Show:', 'tumbas' ); ?></label>
                <select name="ppp" onchange="this.form.submit()" class="tumbas-wc-wppp-select c-select" id="tumbas-wc-wppp-select"><?php

                foreach( $products_per_page_options as $key => $value ) :

                    ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $per_page ); ?>><?php
                        $ppp_text = apply_filters( 'tumbas_wc_ppp_text', esc_html__( '%s', 'tumbas' ), $value );
                        esc_html( printf( $ppp_text, $value == -1 ? esc_html__( 'All', 'tumbas' ) : $value ) ); // Set to 'All' when value is -1
                    ?></option><?php

                endforeach;

            ?></select></div><?php

            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) :

                if ( 'ppp' === $key || 'submit' === $key ) :
                    continue;
                endif;
                if ( is_array( $val ) ) :
                    foreach( $val as $inner_val ) :
                        ?><input type="hidden" name="<?php echo esc_attr( $key ); ?>[]" value="<?php echo esc_attr( $inner_val ); ?>" /><?php
                    endforeach;
                else :
                    ?><input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $val ); ?>" /><?php
                endif;
            endforeach;

            do_action( 'tumbas_wc_ppp_after_dropdown' );

        ?></form><?php

        do_action( 'tumbas_wc_ppp_after_dropdown_form' );
    }
}

function tumbas_woocommerce_catalog_orderby($args) {
    return array(
        'menu_order' => esc_html__( 'Default sorting', 'tumbas' ),
        'popularity' => esc_html__( 'Popularity', 'tumbas' ),
        'rating'     => esc_html__( 'Average rating', 'tumbas' ),
        'date'       => esc_html__( 'Newness', 'tumbas' ),
        'price'      => esc_html__( 'Price: low to high', 'tumbas' ),
        'price-desc' => esc_html__( 'Price: high to low', 'tumbas' )
    );
}
add_filter( 'woocommerce_catalog_orderby', 'tumbas_woocommerce_catalog_orderby' );
function tumbas_shop_control_bar() {
    echo '<div class="apus-filter clearfix">';
    do_action( 'tumbas_shop_control_bar' );
    echo '</div>';
}

add_action( 'tumbas_shop_control_bar', 'woocommerce_catalog_ordering', 10 );
add_action( 'tumbas_shop_control_bar', 'tumbas_wc_products_per_page', 20 );
add_action( 'tumbas_shop_control_bar', 'tumbas_woocommerce_display_modes', 30 );
add_action( 'apus_before_products', 'tumbas_shop_control_bar' , 2 );


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


function tumbas_woocommerce_template_single_sku() {
    get_template_part( 'woocommerce/single-product/sku' );
}

function tumbas_show_percent_disount() {
    global $product;
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();

    if ( !empty($sale_price) && !empty($regular_price) ) {
        $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

        return $percentage.esc_html__('%', 'tumbas');
    } else {
        return '';
    }
}