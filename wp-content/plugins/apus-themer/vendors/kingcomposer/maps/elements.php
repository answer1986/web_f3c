<?php

add_action('init', 'apus_themer_elements_kingcomposer_map', 99 );

function apus_themer_elements_kingcomposer_map() {
	global $kc;
	$maps = array();

	$layouts = array(
		'grid' => esc_html__( 'Grid', 'apus-themer' ),
		'carousel' => esc_html__( 'Carousel', 'apus-themer' ),
		'list' => esc_html__( 'List', 'apus-themer' )
	);

	$maps['element_blog_posts'] =  apply_filters( 'apus_themer_kingcomposer_map_element_blog_posts', array(
		'name' => esc_html__( 'Apus Blog Posts', 'apus-themer' ),
		'title' => esc_html__( 'Blog Posts Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'List of latest post with more layouts.', 'apus-themer' ),
		'params' => array(
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Grid Column' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                "admin_label" => true,
                'description' => esc_html__( 'Display number of post', 'apus-themer' )
            ),    
			array(
				'name' => 'number',
				'label' => esc_html__( 'Items Limit', 'apus-themer' ),
				'type' => 'number_slider',
				'value' => '5',
				'options' => array(
					'min' => 1,
					'max' => 10,
					'unit' => '',
					'show_input' => false
				),
				"admin_label" => true,
				'description' => esc_html__('Specify number of post that you want to show. Enter -1 to get all team', 'apus-themer'),
			),
			array(
				'type'			=> 'dropdown',
				'label'			=> esc_html__( 'Order by', 'kingcomposer' ),
				'name'			=> 'order_by',
				'description'	=> esc_html__( '', 'kingcomposer' ),
				'admin_label'	=> true,
				'options' 		=> array(
					'ID'		=> esc_html__('Post ID', 'kingcomposer'),
					'author'	=> esc_html__('Author', 'kingcomposer'),
					'title'		=> esc_html__('Title', 'kingcomposer'),
					'name'		=> esc_html__('Post name (post slug)', 'kingcomposer'),
					'type'		=> esc_html__('Post type (available since Version 4.0)', 'kingcomposer'),
					'date'		=> esc_html__('Date', 'kingcomposer'),
					'modified'	=> esc_html__('Last modified date', 'kingcomposer'),
					'rand'		=> esc_html__('Random order', 'kingcomposer'),
					'comment_count'	=> esc_html__('Number of comments', 'kingcomposer')
				)
			),
			array(
				'type' => 'select',
				'label' => esc_html__( 'Order By', 'apus-themer' ),
				'name' => 'order',
				'options' => array(
					'DESC' => esc_html__( 'Descending', 'apus-themer' ),
					'ASC' => esc_html__( 'Ascending', 'apus-themer' )
				),
				'description' => ' &nbsp; '
			),
			array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
					'grid' => esc_html__( 'Grid', 'apus-themer' ),
					'carousel' => esc_html__( 'Carousel', 'apus-themer' )
				),
				'value' => 'carousel'
            ),
		)
	));

	$maps['element_brands'] =  apply_filters( 'apus_themer_kingcomposer_map_element_brands', array(
		'name' => esc_html__( 'Apus Brands', 'apus-themer' ),
		'title' => esc_html__( 'Apus Brands Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'List of brands with more layouts.', 'apus-themer' ),
		'params' => array(
	        array(
	            'type' => 'group',
	            'label' => esc_html__('Brand Items', 'apus-themer'),
	            'name' => 'brands',
	            'params' => array(
	                array(
						"type" => "attach_image",
						"label" => esc_html__('Photo', 'apus-themer'),
						"name" => 'image',
						"value" => '',
						'description' => ''
					),
	                array(
	                    'type' => 'text',
	                    'label' => esc_html__( 'Link', 'apus-themer' ),
	                    'name' => 'link',
	                    'admin_label' => true,
	                )
	            ),
	        ),
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Grid Column' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                "admin_label" => true,
                'value' => 3
            ),
			array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
					'grid' => esc_html__( 'Grid', 'apus-themer' ),
					'carousel' => esc_html__( 'Carousel', 'apus-themer' )
				),
				'value' => 'carousel'
            ),
		)
	));

	$maps['element_testimonials'] = apply_filters( 'apus_themer_kingcomposer_map_element_testimonials', array(
		'name' => esc_html__( 'Apus Testimonials', 'apus-themer' ),
		'title' => esc_html__( 'Apus Testimonials Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'List of testimonials with more layouts.', 'apus-themer' ),
		'params' => array(
	        array(
	            'type'            => 'group',
	            'label'            => esc_html__('Testimonial Items', 'apus-themer'),
	            'name'            => 'testimonials',
	            'params' => array(
	                array(
						"type" => "attach_image",
						"label" => esc_html__('Photo', 'apus-themer'),
						"name" => 'image',
						"value" => '',
					),
					array(
	                    'type' => 'text',
	                    'label' => esc_html__( 'Name', 'apus-themer' ),
	                    'name' => 'name',
	                    'admin_label' => true,
	                ),
	                array(
	                    'type' => 'text',
	                    'label' => esc_html__( 'Job', 'apus-themer' ),
	                    'name' => 'job',
	                    'admin_label' => true,
	                ),
	                array(
	                    'type' => 'textarea',
	                    'label' => esc_html__( 'Content', 'apus-themer' ),
	                    'name' => 'content',
	                    'admin_label' => true,
	                ),
	            ),
	        ),
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Grid Column' ,'apus-themer' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                "admin_label" => true
            ),
			array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type' ,'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => $layouts
            ),
		)
	));

	$maps['element_counter'] = apply_filters( 'apus_themer_kingcomposer_map_element_counter', array(
		'name' => esc_html__( 'Apus Counter', 'apus-themer' ),
		'title' => esc_html__( 'Apus Counter Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display counter number.', 'apus-themer' ),
		'params' => array(
	        array(
				"type" => "text",
				"label" => esc_html__("Title", 'apus-themer'),
				"name" => "title",
				"admin_label"	=> true
			),
			array(
				"type" => "textarea",
				"label" => esc_html__("Description", 'apus-themer'),
				"name" => "description",
			),
			array(
				"type" => "text",
				"label" => esc_html__("Number", 'apus-themer'),
				"name" => "number",
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
				'label'	=> esc_html__('Image', 'apus-themer' )
			),
			array(
				"type" => "color_picker",
				"label" => esc_html__("Text Color", 'apus-themer'),
				"name" => "text_color"
			),
		)
	));

	$maps['element_socials_link'] = apply_filters( 'apus_themer_kingcomposer_map_element_socials_link', array(
		'name' => esc_html__( 'Apus Socials Link', 'apus-themer' ),
		'title' => esc_html__( 'Apus Socials Link Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display Socials Link.', 'apus-themer' ),
		'params' => array(
			array(
	            'type' => 'group',
	            'label' => __('Social Items', 'apus-themer'),
	            'name' => 'socials',
	            'params' => array(
	            	array(
						"type" => "text",
						"label" => esc_html__("Title", 'apus-themer'),
						"name" => "title",
						"admin_label"	=> true
					),
	            	array(
						"type" => "text",
						"label" => esc_html__("URL", 'apus-themer'),
						"name" => "url",
						"admin_label"	=> true
					),
					array(
						"type" => "icon_picker",
						"label" => esc_html__("Icon Font", 'apus-themer'),
						"name" => "icon"
					),
					array(
						"type" => "attach_image",
						"description" => esc_html__("If you upload an image, icon will not show.", 'apus-themer'),
						"name" => "image",
						'label'	=> esc_html__('Icon Image', 'apus-themer' )
					),
					
	            ),
	        )
		)
	));

	$maps['element_newsletter'] = apply_filters( 'apus_themer_kingcomposer_map_element_newsletter', array(
		'name' => esc_html__( 'Apus Newsletter', 'apus-themer' ),
		'title' => esc_html__( 'Apus Newsletter Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display Newsletter.', 'apus-themer' ),
		'params' => array(
			array(
                'type' => 'dropdown',
                'label' => esc_html__( 'Style', 'apus-themer' ),
                'name' => 'style',
                'options' => array(
                    'style1' => esc_html__( 'Style 1', 'apus-themer' ),
                    'style2' => esc_html__( 'Style 2', 'apus-themer' )
                )
            )
		)
	));

	$maps['element_features_box'] = apply_filters( 'apus_themer_kingcomposer_map_element_features_box', array(
		'name' => esc_html__( 'Apus Features Box', 'apus-themer' ),
		'title' => esc_html__( 'Apus Features Box Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display Features Box.', 'apus-themer' ),
		'params' => array(
			array(
	            'type'            => 'group',
	            'label'            => esc_html__('Features Items', 'apus-themer'),
	            'name'            => 'features',
	            'params' => array(
	                array(
		                "type" => "text",
		                "class" => "",
		                "label" => esc_html__('Title','apus-themer'),
		                "name" => "title",
		            ),
		            array(
		                "type" => "textarea",
		                "class" => "",
		                "label" => esc_html__('Description', 'apus-themer'),
		                "name" => "description",
		            ),
					array(
						"type" => "icon_picker",
						"label" => esc_html__("Icon Font", 'apus-themer'),
						"name" => "icon"
					),
					array(
						"type" => "attach_image",
						"description" => esc_html__("If you upload an image, icon will not show.", 'apus-themer'),
						"name" => "image",
						'label'	=> esc_html__('Image', 'apus-themer' )
					),
	            ),
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
                "type" => "dropdown",
                "label" => esc_html__('Style','apus-themer'),
                "name" => 'style',
                'options' 	=> array(
					'default' => esc_html__('Default ', 'apus-themer'), 
					'style_border' => esc_html__('Style Border ', 'apus-themer')
				)
            )
		)
	));

	$maps['element_contact_info'] = apply_filters( 'apus_themer_kingcomposer_map_element_contact_info', array(
		'name' => esc_html__( 'Apus Contact Info', 'apus-themer' ),
		'title' => esc_html__( 'Apus Contact Info Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display Contact Info.', 'apus-themer' ),
		'params' => array(
			array(
	            'type' => 'group',
	            'label' => esc_html__('Items', 'apus-themer'),
	            'name' => 'items',
	            'params' => array(
					array(
						"type" => "icon_picker",
						"label" => esc_html__("Icon Font", 'apus-themer'),
						"name" => "icon"
					),
					array(
						"type" => "attach_image",
						"description" => esc_html__("If you upload an image, icon will not show.", 'apus-themer'),
						"name" => "image",
						'label'	=> esc_html__('Icon Image', 'apus-themer' )
					),
					array(
		                "type" => "textarea",
		                "class" => "",
		                "label" => esc_html__('Description', 'apus-themer'),
		                "name" => "description",
		            ),
	            ),
	        )
		)
	));

	$maps['element_single_image'] = apply_filters( 'apus_themer_kingcomposer_map_element_single_image', array(
		'name' => esc_html__( 'Apus Single Image', 'apus-themer' ),
		'title' => esc_html__( 'Apus Single Image Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display Single Image.', 'apus-themer' ),
		'params' => array(
			array(
				"type" => "attach_image",
				"name" => "image",
				'label'	=> esc_html__('Image', 'apus-themer' )
			),
			array(
                "type" => "text",
                "class" => "",
                "label" => esc_html__('Link','apus-themer'),
                "name" => "link",
            ),
		)
	));

	$maps['element_video'] = apply_filters( 'apus_themer_kingcomposer_map_element_video', array(
		'name' => esc_html__( 'Apus Video', 'apus-themer' ),
		'title' => esc_html__( 'Apus Video Settings', 'apus-themer' ),
		'icon' => 'fa fa-newspaper-o',
		'category' => 'Elements',
		'wrapper_class' => 'clearfix',
		'description' => esc_html__( 'Display Single Image.', 'apus-themer' ),
		'params' => array(
			array(
				"type" => "attach_image",
				"name" => "image",
				'label'	=> esc_html__('Image cover', 'apus-themer' )
			),
			array(
				"type" => "icon_picker",
				"label" => esc_html__("Icon", 'apus-themer'),
				"name" => "icon"
			),
			array(
                "type" => "text",
                "class" => "",
                "label" => esc_html__('Youtube Video Link','apus-themer'),
                "name" => "video_link",
            ),
		)
	));

	$styles = array();
	if (is_admin()) {
		$full_styles = Apus_Google_Maps_Styles::styles();
		foreach ($full_styles as $style) {
			$styles[$style['slug']] = $style['title'];
		}
	}
	$maps['element_google_map'] = apply_filters( 'apus_themer_kingcomposer_map_element_google_map', array(
        'name' => esc_html__( 'Apus Google Map', 'apus-themer' ),
        'description' => esc_html__('Display Google Map ... in frontend', 'apus-themer'),
        'icon' => 'sl-paper-plane',
        'category' => 'Elements',
        'params' => array(
            array(
				'name' => 'latitude',
				'label' => esc_html__("Latitude", 'apus-themer'),
				'type' => 'text',
				'value' => '40.722701'
			),
			array(
				'name' => 'longitude',
				'label' => esc_html__("Longitude", 'apus-themer'),
				'type' => 'text',
				'value' => '-73.994701'
			),
			array(
				'name' => 'advanced',
				'label' => esc_html__("Use Custom Marker Icon", 'apus-themer'),
				'type' => 'toggle',
				'description' => esc_html__('If you want to custom marker icon', 'apus-themer')
			),
			array(
				"type" => "attach_image",
				"label" => esc_html__('Marker Icon', 'apus-themer'),
				"name" => 'marker_icon',
				'relation' => array(
					'parent' => 'advanced',
					'show_when' => 'yes'
				),
			),
			array(
				'name' => 'map_height',
				'label' => esc_html__("Map Height", 'apus-themer'),
				'type' => 'text',
				'value' => '500'
			),
			array(
				'name' => 'map_zoom',
				'label' => esc_html__("Map Zoom", 'apus-themer'),
				'type' => 'text',
				'value' => '14'
			),
			array(
                'name' => 'map_style',
                'label' => esc_html__( 'Map Style', 'apus-themer' ),
                'type' => 'select',
                'options' => $styles,
                'value' => 'cool-grey'
            ),
            array(
				'name' => 'map_key',
				'label' => esc_html__("Map API Key", 'apus-themer'),
				'type' => 'text',
				'value' => 'AIzaSyAgLtmIukM56mTfet5MEoPsng51Ws06Syc'
			),
        )
    ));

    $kc->add_map( $maps );
}