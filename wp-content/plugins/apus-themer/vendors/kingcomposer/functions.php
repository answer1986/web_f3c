<?php

function apus_themmer_maps() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		require_once( APUS_THEMER_DIR .'vendors/kingcomposer/maps/woocommerce.php'  );
	}
	if ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		require_once( APUS_THEMER_DIR .'vendors/kingcomposer/maps/revslider.php'  );
	}
	require_once( APUS_THEMER_DIR .'vendors/kingcomposer/maps/elements.php' );
}
apus_themmer_maps();

function apus_themmer_set_template_path(){
	global $kc;  
	
	$kc->set_template_path( APUS_THEMER_DIR . 'templates/kingcomposer/' );
	$kc->set_template_path( get_template_directory() . '/kingcomposer/' );
}
add_action('init', 'apus_themmer_set_template_path' , 99 );


function apus_themmer_enable_custom_posttype(){
	global $kc;
	$kc->add_content_type( 'apus_megamenu' );
	$kc->add_content_type( 'apus_footer' );
}
add_action('init', 'apus_themmer_enable_custom_posttype' , 99 );
