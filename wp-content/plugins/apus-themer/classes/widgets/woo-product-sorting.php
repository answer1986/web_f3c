<?php


if ( ! defined( 'ABSPATH' ) ) exit;

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	class Apus_Themer_Widget_Woo_Product_Sorting extends WC_Widget {

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_cssclass    	= 'apus_widget apus_widget_product_sorting woocommerce';
			$this->widget_description	= __( 'Display a product sorting list.', 'apus-themer' );
			$this->widget_id          	= 'apus_woocommerce_widget_product_sorting';
			$this->widget_name        	= __( 'WooCommerce Product Sorting', 'apus-themer' );
			$this->settings           	= array(
				'title'  => array(
					'type'  => 'text',
					'std'   => __( 'Sort By', 'apus-themer' ),
					'label'	=> __( 'Title', 'apus-themer' )
				)
			);
			
			parent::__construct();
		}

		public function getTemplate() {
			return 'woo-product-sorting.php';
		}
		/**
		 * Widget function
		 *
		 * @see WP_Widget
		 * @access public
		 * @param array $args
		 * @param array $instance
		 * @return void
		 */
		public function widget( $args, $instance ) {
			global $wp_query;
			
			extract( $args );
			
			$title = ( ! empty( $instance['title'] ) ) ? $before_title . $instance['title'] . $after_title : '';
			
			$output = '';
			
			if ( 1 != $wp_query->found_posts || woocommerce_products_will_display() ) {
				$output .= '<ul id="apus-product-sorting" class="apus-product-sorting">';
				
				$orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
				$orderby == ( $orderby ===  'title' ) ? 'menu_order' : $orderby; // Fixed: 'title' is default before WooCommerce settings are saved
				
				$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
					'menu_order'	=> __( 'Default', 'apus-themer' ),
					'popularity' 	=> __( 'Popularity', 'apus-themer' ),
					'rating'     	=> __( 'Average rating', 'apus-themer' ),
					'date'       	=> __( 'Newness', 'apus-themer' ),
					'price'      	=> __( 'Price: Low to High', 'apus-themer' ),
					'price-desc'	=> __( 'Price: High to Low', 'apus-themer' )
				) );
		
				if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
					unset( $catalog_orderby_options['rating'] );
				}
				
				
				/* Build entire current page URL (including query strings) */
				global $wp;
				$link = home_url( $wp->request ); // Base page URL
						
				// Unset query strings used for Ajax shop filters
				unset( $_GET['shop_load'] );
				unset( $_GET['_'] );
				
				$qs_count = count( $_GET );
				
				// Any query strings to add?
				if ( $qs_count > 0 ) {
					$i = 0;
					$link .= '?';
					
					// Build query string
					foreach ( $_GET as $key => $value ) {
						$i++;
						$link .= $key . '=' . $value;
						if ( $i != $qs_count ) {
							$link .= '&';
						}
					}
				}
				
				
	            foreach ( $catalog_orderby_options as $id => $name ) {
					if ( $orderby == $id ) {
						$output .= '<li class="active">' . esc_attr( $name ) . '</li>';
					} else {
						// Add 'orderby' URL query string
						$link = add_query_arg( 'orderby', $id, $link );
						$output .= '<li><a href="' . esc_url( $link ) . '">' . esc_attr( $name ) . '</a></li>';
					}
	            }
				       
	        	$output .= '</ul>';
			}
			
			echo $before_widget . $title . $output . $after_widget;
		}
		
	}
	register_widget( 'Apus_Themer_Widget_Woo_Product_Sorting' );
}