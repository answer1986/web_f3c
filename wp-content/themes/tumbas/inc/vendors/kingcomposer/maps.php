<?php

if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    function tumbas_woocommerce_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( $category->slug => str_repeat( "- ", $level ) . $category->name ) );
                unset($categories[$key]);
                tumbas_woocommerce_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
    }

    function tumbas_woocommerce_get_categories() {
        $return = array( '' => esc_html__(' --- Choose a Category --- ', 'tumbas') );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'product_cat'
        );

        $categories = get_categories( $args );
        tumbas_woocommerce_get_category_childs( $categories, 0, 0, $return );

        return $return;
    }

    add_action('init', 'tumbas_woocommerce_kingcomposer_map', 99 );

    function tumbas_woocommerce_kingcomposer_map() {
    	global $kc;

    	$layouts = array(
    		'grid' => esc_html__( 'Grid', 'tumbas' ),
            'carousel' => esc_html__( 'Carousel', 'tumbas' ),
    		'special' => esc_html__( 'Special', 'tumbas' )
    	);
    	$types = array(
    		'best_selling' => esc_html__( 'Best Selling', 'tumbas' ),
    		'featured_product' => esc_html__( 'Featured Products', 'tumbas' ),
    		'top_rate'  => esc_html__( 'Top Rate', 'tumbas' ),
    		'recent_product'  => esc_html__( 'Recent Products', 'tumbas' ),
    		'on_sale'  => esc_html__( 'On Sale', 'tumbas' ),
    		'recent_review'  => esc_html__( 'Recent Review', 'tumbas' )
    	);
        $categories = array();
        if ( is_admin() ) {
            $categories = tumbas_woocommerce_get_categories();
        }
    	
        $kc->add_map( array('woo_products' => array(
            'name' => esc_html__( 'Apus Products', 'tumbas' ),
            'description' => esc_html__('Display Bestseller, Latest, Most Review ... in frontend', 'tumbas'),
            'icon' => 'sl-paper-plane',
            'category' => 'Woocommerce',
            'params' => array(
                array(
                    'name'        => 'title',
                    'label'       => esc_html__( 'Title', 'tumbas' ),
                    'type'        => 'textarea',
                    'admin_label' => true,
                ),
                array(
                    'name' => 'type',
                    'label' => esc_html__( 'Product Type', 'tumbas' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => $types
                ),
                array(
                    'type' => 'multiple',
                    'label' => esc_html__( 'Select Categories', 'tumbas' ),
                    'name' => 'categories',
                    'description' => esc_html__( 'Select Categories to display', 'tumbas' ),
                    'admin_label' => true,
                    'options' => $categories
                ),
                array(
                    'name' => 'number',
                    'label' => esc_html__( 'Number product show', 'tumbas' ),
                    'type' => 'number_slider',
                    'options' => array(
                        'min' => 1,
                        'max' => 24,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'value' => 4,
                    'description' => esc_html__( 'Display number of product', 'tumbas' )
                ),
                array(
                    'name' => 'item_style',
                    'label' => esc_html__( 'Item Style', 'tumbas' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => array(
                        'inner' => esc_html__( 'Default', 'tumbas' ),
                        'inner-v2' => esc_html__( 'Style 2', 'tumbas' ),
                        'inner-v3' => esc_html__( 'Style 3', 'tumbas' ),
                    )
                ),
                array(
                    'name' => 'layout_type',
                    'label' => esc_html__( 'Layout Type', 'tumbas' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => $layouts
                ),
                array(
                    'name' => 'columns',
                    'label' => esc_html__( 'Number Column', 'tumbas' ),
                    'type' => 'number_slider',
                    'options' => array(
                        'min' => 1,
                        'max' => 6,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'relation'      => array(
                        'parent'    => 'layout_type',
                        'show_when' => array( 'grid', 'carousel' )
                    ),
                    'value' => 4
                ),
                array(
                    'name' => 'rows',
                    'label' => esc_html__( 'Rows', 'tumbas' ),
                    'type' => 'number_slider',
                    'options' => array(
                        'min' => 1,
                        'max' => 6,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'relation'      => array(
                        'parent'    => 'layout_type',
                        'show_when' => 'carousel'
                    ),
                    'value' => 1
                ),
                array(
                    'type'          => 'autocomplete',
                    'label'         => esc_html__('Main Product', 'tumbas'),
                    'name'          => 'product_special',
                    'options'       => array(
                        'multiple'      => false,
                        'post_type'     => 'product',
                    ),
                    'relation'      => array(
                        'parent'    => 'layout_type',
                        'show_when' => 'special'
                    ),
                ),
                array(
                    'name'        => 'show_view_more_btn',
                    'label'       => esc_html__('Shhow View More Button', 'tumbas'),
                    'type'        => 'toggle'
                ),
                array(
                    'name'        => 'view_more_btn',
                    'label'       => esc_html__( 'View More Text', 'tumbas' ),
                    'type'        => 'text',
                    'admin_label' => true,
                    'relation'      => array(
                        'parent'    => 'show_view_more_btn',
                        'show_when' => 'yes'
                    ),
                ),
                array(
                    'name'        => 'view_more_btn_url',
                    'label'       => esc_html__( 'View More Url', 'tumbas' ),
                    'type'        => 'text',
                    'admin_label' => true,
                    'relation'      => array(
                        'parent'    => 'show_view_more_btn',
                        'show_when' => 'yes'
                    ),
                ),
            )
        )));
        
    }

}


add_action('init', 'tumbas_kingcomposer_maps', 99 );
function tumbas_kingcomposer_maps() {
    global $kc;
    $kc->add_map( array('element_banner' => array(
        'name' => esc_html__( 'Apus Banner', 'tumbas' ),
        'description' => esc_html__('Display Banner in frontend', 'tumbas'),
        'icon' => 'sl-paper-plane',
        'category' => 'Elements',
        'params' => array(
            array(
                "type" => "attach_image",
                "name" => "image",
                'label' => esc_html__('Image Banner', 'tumbas' )
            ),
            array(
                'name' => 'image_position',
                'label' => esc_html__( 'Image Position' ,'tumbas' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
                    'left' => esc_html__( 'Left' ,'tumbas' ),
                    'right' => esc_html__( 'Right' ,'tumbas' ),
                )
            ),
            array(
                'name' => 'title',
                'label' => esc_html__( 'Title', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'subtitle',
                'label' => esc_html__( 'Sub Title', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'description',
                'label' => esc_html__( 'Description', 'tumbas' ),
                'type' => 'textarea'
            ),
            array(
                'name' => 'button_text',
                'label' => esc_html__( 'Button Text', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'button_link',
                'label' => esc_html__( 'Button Link', 'tumbas' ),
                'type' => 'text'
            ),
        )
    )));
    $kc->add_map( array('element_carousel_banner' => array(
        'name' => esc_html__( 'Apus Carousel Banner', 'tumbas' ),
        'description' => esc_html__('Display Carousel Banner in frontend', 'tumbas'),
        'icon' => 'sl-paper-plane',
        'category' => 'Elements',
        'params' => array(
            array(
                'name' => 'beforetitle',
                'label' => esc_html__( 'Before Title', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'title',
                'label' => esc_html__( 'Title', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'aftertitle',
                'label' => esc_html__( 'After Title', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'price',
                'label' => esc_html__( 'Price', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'button_text',
                'label' => esc_html__( 'Button Text', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'name' => 'button_link',
                'label' => esc_html__( 'Button Link', 'tumbas' ),
                'type' => 'text'
            ),
            array(
                'type' => 'group',
                'label' => esc_html__('Images', 'tumbas'),
                'name' => 'images',
                'params' => array(
                    array(
                        "type" => "attach_image",
                        "name" => "image",
                        'label' => esc_html__('Image Banner', 'tumbas' )
                    ),
                )
            ),
            array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type', 'tumbas' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
                    'layout1' => esc_html__( 'Layout 1', 'tumbas' ),
                    'layout2' => esc_html__( 'Layout 2', 'tumbas' ),
                ),
                'value' => 'layout1'
            ),
        )
    )));

    $custom_menus = array();
    if ( is_admin() ) {
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
        if ( is_array( $menus ) && ! empty( $menus ) ) {
            foreach ( $menus as $single_menu ) {
                if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
                    $custom_menus[ $single_menu->slug ] = $single_menu->name;
                }
            }
        }
    }
    $kc->add_map( array('element_megamenu' => array(
        'name' => esc_html__( 'Apus Megamenu', 'tumbas' ),
        'description' => esc_html__('Display Megamenu in frontend', 'tumbas'),
        'icon' => 'sl-paper-plane',
        'category' => 'Elements',
        'params' => array(
            array(
                'name' => 'nav_slug',
                'label' => esc_html__( 'Choose a menu', 'tumbas' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => $custom_menus,
            ),
        )
    )));
}

