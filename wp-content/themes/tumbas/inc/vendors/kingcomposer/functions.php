<?php

add_action('init', 'tumbas_kingcomposer_init');
function tumbas_kingcomposer_init() {
    if ( function_exists( 'kc_add_icon' ) ) {
    	$css_folder = tumbas_get_css_folder();
		$min = tumbas_get_asset_min();
        kc_add_icon( $css_folder . '/font-monia'.$min.'.css' );
    }
 
}