<div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix">
    <div class="container">
        <div class="row">
            <div class="col-xs-5">
                <?php
                    $logo = tumbas_get_config('media-mobile-logo');
                ?>

                <?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                <?php else: ?>
                    <div class="logo logo-theme">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                            <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-xs-7">
                <div class="action-right clearfix">
                    <div class="active-mobile pull-right">
                        <button data-toggle="offcanvas" class="btn btn-sm btn-danger btn-offcanvas btn-toggle-canvas offcanvas" type="button">
                            <?php esc_html_e( 'MENU', 'tumbas' ); ?>
                           <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <?php if ( defined('TUMBAS_WOOCOMMERCE_ACTIVED') && TUMBAS_WOOCOMMERCE_ACTIVED ): ?>
                        <div class="active-mobile top-cart pull-right">
                            <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                        </div>  
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
	<section class="buscador " style="padding-bottom:22px";><div class="kc-row-container  kc-container"><div class="kc-wrap-columns"><div class="kc-elm kc-css-85864 kc_col-sm-7 kc_column kc_col-sm-7"><div class="kc-col-container">
		<?php echo do_shortcode('[fibosearch]'); ?>
</div></div></div></div></section>
</div>