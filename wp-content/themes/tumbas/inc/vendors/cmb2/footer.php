<?php

if ( !function_exists( 'tumbas_footer_metaboxes' ) ) {
	function tumbas_footer_metaboxes(array $metaboxes) {
		$prefix = 'apus_footer_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Footer Style', 'tumbas' ),
				'id'   => $prefix.'style_class',
				'type' => 'select',
				'options' => array(
					'lighting' => esc_html__('Lighting', 'tumbas'),
					'dark' => esc_html__('Dark', 'tumbas')
				)
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'tumbas' ),
			'object_types'              => array( 'apus_footer' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'tumbas_footer_metaboxes' );
