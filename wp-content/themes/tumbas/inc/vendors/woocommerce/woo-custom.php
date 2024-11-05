<?php

if ( !class_exists("Tumbas_Woo_Custom") ) {
	class Tumbas_Woo_Custom {

		public static function init() {
			if ( !tumbas_get_config('show_product_accessory', true) ) {
				return;
			}
			// Add to Cart
			add_action( 'wp_ajax_nopriv_tumbas_variable_add_to_cart', array( __CLASS__, 'add_to_cart' ) );
			add_action( 'wp_ajax_tumbas_variable_add_to_cart', array( __CLASS__, 'add_to_cart' ) );

			add_action( 'woocommerce_product_write_panel_tabs', array( __CLASS__, 'add_accessories_field_tab' ) );
			add_action( 'woocommerce_product_data_panels', array( __CLASS__, 'add_accessories_add_fields' ) );

			add_action( 'woocommerce_process_product_meta_simple', array( __CLASS__, 'save_accessories' ) );
			add_action( 'woocommerce_process_product_meta_variable', array( __CLASS__, 'save_accessories' ) );
			add_action( 'woocommerce_process_product_meta_grouped', array( __CLASS__, 'save_accessories' ) );
			add_action( 'woocommerce_process_product_meta_external', array( __CLASS__, 'save_accessories' ) );

			// total price
			add_action( 'wp_ajax_nopriv_tumbas_get_total_price', array( __CLASS__, 'display_total_price' ) );
			add_action( 'wp_ajax_tumbas_get_total_price', array( __CLASS__, 'display_total_price' ) );
		}
		
		public static function add_accessories_field_tab() {
			?>
			<li class="accessories_options accessories_tab show_if_simple show_if_variable">
				<a href="#apus_accessories"><?php echo esc_html__( 'Accessories', 'tumbas' ); ?></a>
			</li>
			<?php
		}

		public static function add_accessories_add_fields() {
			global $post;
			$json_ids = self::get_products_by_ids();
			?>
			<div id="apus_accessories" class="panel woocommerce_options_panel apus_accessories">
				<div class="options_group">
					<p class="form-field">
						<label for="accessory_ids"><?php esc_html_e( 'Accessories', 'tumbas' ); ?></label>
						<select id="product_accessory_ids" class="wc-product-search" multiple="multiple" style="width: 50%;" name="accessory_ids[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'woocommerce' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
							<?php
								foreach ( $json_ids as $product_id => $product_name) {
									echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product_name ) . '</option>';
								}
							?>
						</select>
					</p>
				</div>
			</div>
			<?php
		}

		public static function save_accessories( $post_id ) {
			$accessories = isset( $_POST['accessory_ids'] ) ? array_filter( array_map( 'intval', explode( ',', $_POST['accessory_ids'] ) ) ) : array();

			update_post_meta( $post_id, '_accessory_ids', $accessories );
		}

		public static function get_accessories( $product ) {
			$accessory_ids = get_post_meta( $product->ID, '_accessory_ids', true );
			if (!empty($accessory_ids)) {
				return (array)maybe_unserialize( $accessory_ids );
			} else {
				return '';
			}
		}

		public static function get_products_by_ids() {
			global $post;
			$product_ids = self::get_accessories($post);
			$json_ids = array();
			foreach ( $product_ids as $product_id ) {
				$product = wc_get_product( $product_id );
				if ( is_object( $product ) ) {
					$json_ids[ $product_id ] = wp_kses_post(html_entity_decode($product->get_formatted_name(), ENT_QUOTES, get_bloginfo( 'charset' )));
				}
			}
			return $json_ids;
		}

		public static function add_to_cart() {
			$pid = apply_filters( 'tumbas_add_to_cart_product_id', absint( $_POST['product_id'] ) );
			$quantity = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
			$variation_id = empty( $_POST['variation_id'] ) ? 0 : $_POST['variation_id'];
			$variation = empty( $_POST['variation'] ) ? 0 : $_POST['variation'];
			$product_status = get_post_status( $pid );
			
			if ( WC()->cart->add_to_cart( $pid, $quantity, $variation_id, $variation ) && 'publish' === $product_status ) {
				do_action( 'woocommerce_ajax_added_to_cart', $pid );

				if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
					wc_add_to_cart_message( $pid );
				}
				WC_AJAX::get_refreshed_fragments();
			} else {
				$data = array(
					'error' => true,
					'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $pid ), $pid )
				);
				wp_send_json( $data );
			}
			die();
		}

		public static function display_total_price() {
			$price = empty( $_POST['data'] ) ? 0 : $_POST['data'];
			if ( $price ) {
				$price_html = wc_price( $price );
				echo wp_kses_post( $price_html );
			}
			die();
		}

	}
	add_action( 'init', array('Tumbas_Woo_Custom', 'init') );
}