<?php   global $woocommerce; ?>
<div class="apus-topcart version-2">
 <div id="cart" class="dropdown">
        <div class="media ropdown-toggle" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" title="<?php esc_html_e('View your shopping cart', 'tumbas'); ?>">
            <div class="media-left">
                <a href="#" class="mini-cart">
                    <span class="count-item"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
                    <img class="img4"src="<?php echo esc_url_raw( get_template_directory_uri().'/images/cart.png' ); ?>" id="carro" >
                </a>   
            </div>
            <div class="media-body">
                <h5 class="title-cart"><?php echo esc_html('Carrito','tumbas') ?></h5>
                <div class="total-cart-price">
                    <?php echo trim( $woocommerce->cart->get_cart_total() ); ?>
                </div>
            </div> 
        </div>
        <div class="dropdown-menu"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div>