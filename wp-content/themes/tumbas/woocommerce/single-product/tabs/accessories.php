<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$pids = Tumbas_Woo_Custom::get_accessories( $product );

if ( empty($pids) || sizeof( $pids ) == 0 ) return;

$args = apply_filters( 'woocommerce_accessories_products_args', array(
	'post_type' => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows' => 1,
	'posts_per_page' => -1,
	'orderby' => 'post__in',
	'post__in' => $pids
) );

$products = new WP_Query( $args );

$total_price = 0;
$count = 0;

if ( $products->have_posts() ) : ?>
	
	<div class="tumbas-msg"></div>
	<div class="accessoriesproducts products widget" data-current-pid="<?php echo esc_attr($product->get_id()); ?>" data-current-type="<?php echo esc_attr($product->get_type()); ?>">
		<h3 class="widget-title"><span><?php esc_html_e( 'Complete Your Purchase', 'tumbas' ); ?></span></h3>
		
		<div class="accessoriesproducts-wrapper">
			<div class="row accessories-products-wrapper">
				<div class="col-xs-12 col-md-6 col-sm-6 product-item first">
					<?php
						wc_get_template( 'item-product/list-v1.php', array( 'root_product_id' => $product->get_id() ) );
						$count++;
						$total_price += $product->get_price();
					?>
				</div>
				<?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
					<div class="col-xs-12 col-md-6 col-sm-6 product-item <?php echo ($count%2 == 0 ? 'first' : ''); ?>">
						<?php wc_get_template( 'item-product/list-v1.php' ); ?>
					</div>

					<?php
						$count++;
						$total_price += $product->get_price();
					?>

				<?php endwhile; ?>
			</div>
				
			<div class="total-info-wrapper">
				<div class="total-price-wrapper pull-left">
					<?php
						echo '<span class="text-price-info">' . esc_html__( 'Price for both items', 'tumbas' ) . '</span>';
						echo '<span class="total-price">' . wc_price( $total_price ) . $product->get_price_suffix() . '</span>';
					?>
				</div>
				<div class="add-all-items-to-cart-wrapper pull-right">
					<button type="button" class="button btn btn-primary add-all-items-to-cart"><?php echo esc_html__( 'Add items to cart', 'tumbas' ); ?></button>
				</div>
			</div>
		</div>

	</div>
<?php endif;
wp_reset_postdata();