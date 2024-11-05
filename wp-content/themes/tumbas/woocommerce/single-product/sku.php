<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
?>

<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

	<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'tumbas' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'tumbas' ); ?></span></span>

<?php endif; ?>

<?php

$brands = get_the_terms( $post->ID, 'product_brand' );
$brand_count = sizeof( get_the_terms( $post->ID, 'product_brand' ) );

if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) {
?>
	<span class="sku_wrapper brand_wrapper">
		<?php echo _n( 'Brand:', 'Brands:', $brand_count, 'tumbas' ); ?>
		<?php
		foreach ($brands as $brand) {
			?>
			<a class="sku" href="<?php echo get_term_link($brand, 'product_brand'); ?>"><?php echo trim($brand->name); ?></a>
			<?php
		}
		?>
	</span>
<?php } ?>