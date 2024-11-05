<?php
/**
 * Footer manager for apus themer
 *
 * @package    apus-themer
 * @author     Team Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Themer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class Apus_PostType_Footer {

  	public static function init() {
    	add_action( 'init', array( __CLASS__, 'register_post_type' ) );
  	}

  	public static function register_post_type() {
	    $labels = array(
			'name'                  => __( 'Apus Footer', 'apus-themer' ),
			'singular_name'         => __( 'Footer', 'apus-themer' ),
			'add_new'               => __( 'Add New Footer', 'apus-themer' ),
			'add_new_item'          => __( 'Add New Footer', 'apus-themer' ),
			'edit_item'             => __( 'Edit Footer', 'apus-themer' ),
			'new_item'              => __( 'New Footer', 'apus-themer' ),
			'all_items'             => __( 'All Footers', 'apus-themer' ),
			'view_item'             => __( 'View Footer', 'apus-themer' ),
			'search_items'          => __( 'Search Footer', 'apus-themer' ),
			'not_found'             => __( 'No Footers found', 'apus-themer' ),
			'not_found_in_trash'    => __( 'No Footers found in Trash', 'apus-themer' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Apus Footers', 'apus-themer' ),
	    );

	    register_post_type( 'apus_footer',
	      	array(
		        'labels'            => apply_filters( 'apus_postype_footer_labels' , $labels ),
		        'supports'          => array( 'title', 'editor' ),
		        'public'            => true,
		        'has_archive'       => true,
		        'menu_position'     => 51,
		        'menu_icon'         => 'dashicons-admin-home',
	      	)
	    );

  	}
  	
}

Apus_PostType_Footer::init();