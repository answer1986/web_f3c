<?php
	global $product;
	$current_product = isset($root_product_id) && $root_product_id == $product->get_id() ? true : false;
?>
<div class="media product-block widget-product accessory-product" data-id="<?php echo esc_attr($product->get_id()); ?>" data-price="<?php echo esc_attr($product->get_price()); ?>">
	<div class="media-left">
		<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="image">
			<?php tumbas_product_get_image('shop_catalog'); ?>
		</a>
	</div>
	<div class="media-body">
		<div class="clearfix">
			<?php
            if ( $current_product ) {
                echo esc_html__( 'Item you are currently viewing', 'tumbas' );
            } else {
                echo esc_html__( 'Compatible Accessories', 'tumbas' );
            }
            ?>
	    </div>
		<h3 class="name">
			<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo trim( $product->get_title() ); ?></a>
		</h3>
		<div class="price"><?php echo ($product->get_price_html()); ?></div>
		<div class="groups-button clearfix">
            <div class="addcart">
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            </div>
            
        </div>
	</div>
</div>