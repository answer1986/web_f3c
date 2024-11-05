<?php

add_action('init', 'apus_themer_revslider_kingcomposer_map', 99 );
function apus_themer_revslider_kingcomposer_map() {
	global $kc;
    $disable = apply_filters( 'apus_themer_revslider_kingcomposer_map_disable', false );
    if ($disable) {
        return;
    }
    if (!class_exists('RevSlider')) {
        return;
    }
	
    $revsliders = array();
    if (is_admin()) {
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();
        if ( $arrSliders ) {
            foreach ( $arrSliders as $slider ) {
                /** @var $slider RevSlider */
                $revsliders[ $slider->getAlias() ] = $slider->getTitle();
            }
        } else {
            $revsliders[ 0 ] = esc_html__( 'No sliders found', 'apus-themer' );
        }
    }
    
	$kc->add_map( array('element_revslider' => apply_filters( 'apus_themer_kingcomposer_map_revslider', array(
        'name' => esc_html__( 'Revolution Slider', 'apus-themer' ),
        'description' => esc_html__('Display Revolution Slider in frontend', 'apus-themer'),
        'icon' => 'sl-paper-plane',
        'category' => 'Elements',
        'params' => array(
            array(
                'name' => 'alias',
                'label' => esc_html__( 'Revolution Slider' , 'apus-themer' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => $revsliders
            ),
            array(
                'name' => 'exclass',
                'label' => esc_html__( 'Extra Class' , 'apus-themer' ),
                'type' => 'text',
                'admin_label' => true
            ),
        )
    ))));

}

