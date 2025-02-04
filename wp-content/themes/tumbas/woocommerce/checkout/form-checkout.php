<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- header -->
<div class="apus-checkout-header">
	<div class="apus-page-title">
		<span><?php echo esc_html__( 'Shopping Cart', 'tumbas' ); ?></span>
	</div>
	<div class="apus-checkout-step">
		<ul>
			<li>
				<?php printf(__( '<span class="step">%d</span> Shopping Cart', 'tumbas' ), 1 ); ?>
			</li>
			<li class="active">
				<?php printf(__( '<span class="step">%d</span> Checkout', 'tumbas' ), 2 ); ?>
			</li>
			<li>
				<?php printf(__( '<span class="step">%d</span> Completed', 'tumbas' ), 3 ); ?>
			</li>
		</ul>
	</div>
</div>
<?php
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'tumbas' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', wc_get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

<div class="clearfix col2-set">
	<div class="details-check col-1">
	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div id="customer_details">
			
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			

			
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		
	<?php endif; ?>
	</div>
	<div class="details-review col-2">
		<div class="order-review">
			<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'tumbas' ); ?></h3>
			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</div>
	</div>	

</div>

	

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
