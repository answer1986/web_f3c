<?php
/**
 * Portfolio manager for apus themer
 *
 * @package    apus-themer
 * @author     Team Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Themer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class Apus_PostType_Portfolio {

  	public static function init() {
    	add_action( 'init', array( __CLASS__, 'register_post_type' ) );
    	add_action( 'init', array( __CLASS__, 'register_taxonomy' ) );
  	}

  	public static function register_post_type() {
	    $labels = array(
			'name'                  => __( 'Portfolio', 'apus-themer' ),
			'singular_name'         => __( 'Portfolio', 'apus-themer' ),
			'add_new'               => __( 'Add New', 'apus-themer' ),
			'add_new_item'          => __( 'Add New', 'apus-themer' ),
			'edit_item'             => __( 'Edit Portfolio', 'apus-themer' ),
			'new_item'              => __( 'New Portfolio', 'apus-themer' ),
			'all_items'             => __( 'All Portfolios', 'apus-themer' ),
			'view_item'             => __( 'View Portfolio', 'apus-themer' ),
			'search_items'          => __( 'Search Portfolio', 'apus-themer' ),
			'not_found'             => __( 'No Portfolios found', 'apus-themer' ),
			'not_found_in_trash'    => __( 'No Portfolios found in Trash', 'apus-themer' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Portfolios', 'apus-themer' ),
	    );

	    register_post_type( 'apus_portfolio',
	      	array(
		        'labels'            => apply_filters( 'apus_postype_portfolio_labels' , $labels ),
		        'supports'          => array( 'title', 'editor' ),
		        'public'            => true,
		        'has_archive'       => true,
		        'menu_position'     => 51,
		        'menu_icon'         => 'dashicons-admin-home',
	      	)
	    );
  	}
  	
  	public static function register_taxonomy() {
  		$labels = array(
	        'name'              => __( 'Categories', 'apus-themer' ),
	        'singular_name'     => __( 'Category', 'apus-themer' ),
	        'search_items'      => __( 'Search Category', 'apus-themer' ),
	        'all_items'         => __( 'All Categories', 'apus-themer' ),
	        'parent_item'       => __( 'Parent Category', 'apus-themer' ),
	        'parent_item_colon' => __( 'Parent Category:', 'apus-themer' ),
	        'edit_item'         => __( 'Edit Category', 'apus-themer' ),
	        'update_item'       => __( 'Update Category', 'apus-themer' ),
	        'add_new_item'      => __( 'Add New Category', 'apus-themer' ),
	        'new_item_name'     => __( 'New Category Name', 'apus-themer' ),
	        'menu_name'         => __( 'Categories', 'apus-themer' ),
      	);
      	// Now register the taxonomy
      	register_taxonomy('portfolio_cat', array('apus_portfolio'), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_nav_menus' => false,
			'rewrite'           => array( 'slug' => 'portfolio-category' ),
      	));
  	}
}

Apus_PostType_Portfolio::init();