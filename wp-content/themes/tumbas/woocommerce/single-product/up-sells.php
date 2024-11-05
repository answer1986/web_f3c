<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop;


$woocommerce_loop['columns'] = tumbas_get_config('upsells_product_columns', 4);



if ( $upsells ) : ?>

	<div class="related products widget owl-carousel-top aaa">
		<h3 class="widget-title"><span><?php esc_html_e( 'You may also like&hellip;', 'tumbas' ) ?></span></h3>

			<div class="owl-carousel" data-items="<?php echo esc_attr($woocommerce_loop['columns']); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="2" data-pagination="false" data-nav="true">
				<?php foreach ( $upsells as $upsell ) : ?>

					<?php
					$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );
					?>

					<div class="item">
			            <div class="products-grid product">
			                <?php wc_get_template_part( 'item-product/inner' ); ?>
			            </div>
			        </div>
				<?php endforeach; ?>
			</div>

	</div>

	<?php
endif;

wp_reset_postdata();