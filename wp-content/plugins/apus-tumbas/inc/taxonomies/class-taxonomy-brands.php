<?php
/**
 * event category
 *
 * @package    apus-tumbas
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ApusTumbas_Taxonomy_Brand{

	/**
	 *
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_action( 'cmb2_init', array( __CLASS__, 'metaboxes' ) );

		add_filter( 'manage_edit-product_brand_columns', array( __CLASS__, 'brand_taxonomy_columns' ), 15 );
		add_filter( 'manage_product_brand_custom_column', array( __CLASS__, 'brand_taxonomy_column' ), 15, 3 );
	}

	/**
	 *
	 */
	public static function definition() {
		$labels = array(
			'name'              => __( 'Brands', 'apus-tumbas' ),
			'singular_name'     => __( 'Brand', 'apus-tumbas' ),
			'search_items'      => __( 'Search Brands', 'apus-tumbas' ),
			'all_items'         => __( 'All Brands', 'apus-tumbas' ),
			'parent_item'       => __( 'Parent Brand', 'apus-tumbas' ),
			'parent_item_colon' => __( 'Parent Brand:', 'apus-tumbas' ),
			'edit_item'         => __( 'Edit Brand', 'apus-tumbas' ),
			'update_item'       => __( 'Update Brand', 'apus-tumbas' ),
			'add_new_item'      => __( 'Add New Brand', 'apus-tumbas' ),
			'new_item_name'     => __( 'New Brand', 'apus-tumbas' ),
			'menu_name'         => __( 'Brands', 'apus-tumbas' ),
		);

		register_taxonomy( 'product_brand', 'product', array(
			'labels'            => apply_filters( 'apustumbas_taxomony_product_brand_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'product-brands',
			'rewrite'           => array( 'slug' => __( 'product-brands', 'apus-tumbas' ) ),
			'public'            => true,
			'show_ui'           => true,
		) );
	}

	public static function metaboxes() {
	    $metabox_id = 'apus_tumbas_brands_options';

	    $cmb = new_cmb2_box( array(
			'id'           => $metabox_id,
			'title'        => '',
			'object_types' => array( 'page' ),
		) );

	    $cmb->add_field( array(
		    'name'    => __( 'Logo', 'apus-tumbas' ),
		    'id'      => 'logo',
		    'type'    => 'file',
		    'options' => array(
		        'url' => false,
		    ),
		    'text'    => array(
		        'add_upload_file_text' => __( 'Add Logo', 'apus-tumbas' )
		    )
		) );

	    $cats = new Taxonomy_MetaData_CMB2( 'product_brand', $metabox_id );
	}

	public static function brand_taxonomy_columns( $columns ) {
		$new_columns          = array();
		$new_columns['cb']    = $columns['cb'];
		$new_columns['thumb'] = __( 'Image', 'apus-tumbas' );

		unset( $columns['cb'] );

		return array_merge( $new_columns, $columns );
	}

	public static function brand_taxonomy_column( $columns, $column, $id ) {
		if ( 'thumb' == $column ) {
			$icon = Taxonomy_MetaData_CMB2::get( 'product_brand', $id, 'logo' );
			if ( $icon ) {
				$image = $icon;
			} else {
				$image = wc_placeholder_img_src();
			}
			$image = str_replace( ' ', '%20', $image );
			$columns = '<img src="' . esc_url( $image ) . '" alt="' . __( 'Thumbnail', 'apus-tumbas' ) . '" class="wp-post-image" height="48" width="48" />';
		}

		return $columns;
	}
}

ApusTumbas_Taxonomy_Brand::init();