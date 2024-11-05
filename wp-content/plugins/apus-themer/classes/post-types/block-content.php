<?php
/**
 * Block Content manager for apus themer
 *
 * @package    apus-themer
 * @author     Team Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Themer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class Apus_PostType_Block_Content {

  	public static function init() {
    	add_action( 'init', array( __CLASS__, 'register_post_type' ) );

    	add_action('init', array( __CLASS__, 'enable_kingcomposer' ) , 99 );
  	}

  	public static function register_post_type() {
	    $labels = array(
			'name'                  => __( 'Apus Block Content', 'apus-themer' ),
			'singular_name'         => __( 'Block Content', 'apus-themer' ),
			'add_new'               => __( 'Add New Block Content', 'apus-themer' ),
			'add_new_item'          => __( 'Add New Block Content', 'apus-themer' ),
			'edit_item'             => __( 'Edit Block Content', 'apus-themer' ),
			'new_item'              => __( 'New Block Content', 'apus-themer' ),
			'all_items'             => __( 'All Block Contents', 'apus-themer' ),
			'view_item'             => __( 'View Block Content', 'apus-themer' ),
			'search_items'          => __( 'Search Block Content', 'apus-themer' ),
			'not_found'             => __( 'No Blocks found', 'apus-themer' ),
			'not_found_in_trash'    => __( 'No Blocks found in Trash', 'apus-themer' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Apus Block Content', 'apus-themer' ),
	    );

	    register_post_type( 'apus_block_content',
	      	array(
		        'labels'            => apply_filters( 'apus_postype_block_content_labels' , $labels ),
		        'supports'          => array( 'title', 'editor' ),
		        'public'            => true,
		        'has_archive'       => true,
		        'menu_position'     => 51,
		        'menu_icon'         => 'dashicons-admin-home',
	      	)
	    );

  	}
  	
  	public static function enable_kingcomposer(){
  		if ( in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			global $kc;
			$kc->add_content_type( 'apus_block_content' );
		}
	}
	
}

Apus_PostType_Block_Content::init();