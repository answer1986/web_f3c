<?php

function apus_themer_woocommerce_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
    foreach ( $categories as $key => $category ) {
        if ( $category->category_parent == $id_parent ) {
            $dropdown = array_merge( $dropdown, array( $category->slug => str_repeat( "- ", $level ) . $category->name ) );
            unset($categories[$key]);
            apus_themer_woocommerce_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
        }
    }
}

function apus_themer_woocommerce_get_categories() {
    $return = array( '' => esc_html__(' --- Choose a Category --- ', 'apus-themer') );

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
    apus_themer_woocommerce_get_category_childs( $categories, 0, 0, $return );

    return $return;
}

add_action('init', 'apus_themer_woocommerce_kingcomposer_map', 99 );

function apus_themer_woocommerce_kingcomposer_map() {
	global $kc;
    $disable = apply_filters( 'apus_themer_woocommerce_kingcomposer_map_disable', false );
    if ($disable) {
        return;
    }
	$order_by_options = array(
		'',
		'date'     	     =>  esc_html__( 'Date', 'apus-themer' ) ,
		'ID'  	    	 =>  esc_html__( 'ID', 'apus-themer' ),
		'author'    	 =>  esc_html__( 'Author', 'apus-themer' ) ,
		'title'  	  	 =>  esc_html__( 'Title', 'apus-themer' ) ,
		'modified'  	 =>  esc_html__( 'Modified', 'apus-themer' ),
		'rand'           =>  esc_html__( 'Random', 'apus-themer' ),
		'comment_count'  =>  esc_html__( 'Comment count', 'apus-themer' ),
		'menu_order'  	 => esc_html__( 'Menu order', 'apus-themer' ),
	);

	$order_way_options = array(
		'',
		'DESC' =>  esc_html__( 'Descending', 'apus-themer' ) ,
		'ASC'  =>  esc_html__( 'Ascending', 'apus-themer' ),
	);

	$layouts = array(
        'grid' => esc_html__( 'Grid', 'apus-themer' ),
		'list' => esc_html__( 'List', 'apus-themer' ),
		'carousel' => esc_html__( 'Carousel', 'apus-themer' )
	);
	$types = array(
		'best_selling' => esc_html__( 'Best Selling', 'apus-themer' ),
		'featured_product' => esc_html__( 'Featured Products', 'apus-themer' ),
		'top_rate'  => esc_html__( 'Top Rate', 'apus-themer' ),
		'recent_product'  => esc_html__( 'Recent Products', 'apus-themer' ),
		'on_sale'  => esc_html__( 'On Sale', 'apus-themer' ),
		'recent_review'  => esc_html__( 'Recent Review', 'apus-themer' )
	);
    $categories = array();
    if ( is_admin() ) {
        $categories = apus_themer_woocommerce_get_categories();
    }

	$kc->add_map( array('woo_products' => apply_filters( 'apus_themer_kingcomposer_map_woo_products', array(
        'name' => 'Apus Products',
        'description' => esc_html__('Display Bestseller, Latest, Most Review ... in frontend', 'apus-themer'),
        'icon' => 'sl-paper-plane',
        'category' => 'Woocommerce',
        'params' => array(
            array(
                'name' => 'type',
                'label' => 'Product Type',
                'type' => 'select',
                'admin_label' => true,
                'options' => $types
            ),
            array(
				'type'           => 'multiple',
				'label'          => esc_html__( 'Select Categories', 'apus-themer' ),
				'name'           => 'categories',
				'description'    => esc_html__( 'Select Categories to display', 'apus-themer' ),
				'admin_label'    => true,
				'options' => $categories
            ),
            array(
                'name' => 'number',
                'label' => 'Number post show',
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 24,
                    'unit' => '',
                    'show_input' => true
                ),
                'description' => esc_html__( 'Display number of post', 'apus-themer' )
            ),
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Number Column' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                'value' => 1
            ),
            array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => $layouts
            ),
            array(
                'name' => 'rows',
                'label' => esc_html__( 'Rows' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                'description' => esc_html__( 'Apply for Carousel layout' ,'apus-themer' ),
            )
        )
    ))));

	$kc->add_map( array('woo_sale_products' => apply_filters( 'apus_themer_kingcomposer_map_woo_sale_products', array(
        'name' => 'Apus Sale Products',
        'description' => esc_html__('Display Bestseller, Latest, Most Review ... in frontend', 'apus-themer'),
        'icon' => 'sl-paper-plane',
        'category' => 'Woocommerce',
        'params' => array(
            array(
                'type'           => 'multiple',
                'label'          => esc_html__( 'Select Categories', 'apus-themer' ),
                'name'           => 'categories',
                'description'    => esc_html__( 'Select Categories to display', 'apus-themer' ),
                'admin_label'    => true,
                'options' => $categories
            ),
            array(
                'name' => 'number',
                'label' => 'Number post show',
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 24,
                    'unit' => '',
                    'show_input' => true
                ),
                'description' => esc_html__( 'Display number of post', 'apus-themer' )
            ),
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Number Column' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                )
            ),
            array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => $layouts
            ),
            array(
                'name' => 'rows',
                'label' => esc_html__( 'Rows' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                'description' => esc_html__( 'Apply for Carousel layout' ,'apus-themer' ),
            )
        )
    ))));

    $kc->add_map( array('woo_categories_tabs' => apply_filters( 'apus_themer_kingcomposer_map_woo_categories_tabs', array(
        'name' => 'Apus Categories Tabs',
        'description' => esc_html__('Display categories tabs with icon in frontend', 'apus-themer'),
        'icon' => 'sl-paper-plane',
        'category' => 'Woocommerce',
        'params' => array(
            array(
                'type' => 'group',
                'label' => __('Tabs', 'apus-themer'),
                'name' => 'tabs',
                'params' => array(
                    array(
                        'name' => 'name',
                        'label' => esc_html__( 'Tab Name' ,'apus-themer' ),
                        'type' => 'text',
                    ),
                    array(
                        'type'           => 'select',
                        'label'          => esc_html__( 'Select Category', 'apus-themer' ),
                        'name'           => 'category',
                        'description'    => esc_html__( 'Select Category to display', 'apus-themer' ),
                        'admin_label'    => true,
                        'options' => $categories
                    ),
                    array(
                        "type" => "icon_picker",
                        "label" => esc_html__("Icon", 'apus-themer'),
                        "name" => "icon"
                    ),
                    array(
                        "type" => "attach_image",
                        "description" => esc_html__("If you upload an image, icon will not show.", 'apus-themer'),
                        "name" => "image",
                        'label' => esc_html__('Icon Image', 'apus-themer' )
                    )
                ),
            ),
            array(
                'name' => 'type',
                'label' => esc_html__( 'Product Type' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => $types,
                'value' => 4,
            ),
            array(
                'name' => 'number',
                'label' => esc_html__( 'Number products' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 30,
                    'unit' => '',
                    'show_input' => true
                ),
                'value' => 8,
                'description' => esc_html__( 'Display number of products', 'apus-themer' )
            ),
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Number Column' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                'value' => 4
            ),
            array(
                'name' => 'tab_style',
                'label' => esc_html__( 'Tab Style' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
                    'style1' => esc_html__( 'Style 1' ,'apus-themer' ),
                    'style2' => esc_html__( 'Style 2' ,'apus-themer' ),
                ),
                'value' => 'grid'
            ),
            array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
                    'grid' => esc_html__( 'Grid' ,'apus-themer' ),
                    'special' => esc_html__( 'Special' ,'apus-themer' ),
                ),
                'value' => 'grid'
            ),
        )
    ))));
}

