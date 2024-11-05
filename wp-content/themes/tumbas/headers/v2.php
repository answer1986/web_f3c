<header id="apus-header" class="site-header header-v2 hidden-sm hidden-xs " role="banner">
    <div id="apus-topbar" class="apus-topbar">
        <?php if ( tumbas_get_config('show_top_info', false) ) { ?>
        <div class="text-banner">
            <?php echo trim( tumbas_get_config('top_info_text', '') ); ?>
        </div>
        <?php } ?>
        <div class="container">
            <div class="topbar-inner clearfix">
                <?php if ( is_active_sidebar('contact-topbar') ): ?>
                    <div class="pull-left contact-topbar">
                        <?php dynamic_sidebar('contact-topbar'); ?>
                    </div>
                <?php endif; ?>

                <?php if ( has_nav_menu( 'topmenu' ) ) : ?>
                    <div class="main-menu-2  pull-left">
                        <nav 
                         data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                        <?php   $args = array(
                                'theme_location' => 'topmenu',
                                'container_class' => 'collapse navbar-collapse',
                                'menu_class' => 'nav navbar-nav-2 megamenu',
                                'fallback_cb' => '',
                                'menu_id' => 'primary-menu',
                                'walker' => new Tumbas_Nav_Menu()
                            );
                            wp_nav_menu($args);
                        ?>
                        </nav>
                    </div>
                <?php endif; ?>
                
                <div class="pull-right">
                <?php if( !is_user_logged_in() ){ ?>
                    <div class="login-topbar">
                        <a class="login-link" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Login','tumbas'); ?>"> <?php esc_html_e('Login', 'tumbas'); ?></a>
                        <span><?php esc_html_e( 'or', 'tumbas'); ?></span>
                        <a class="register-link" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign Up','tumbas'); ?>"> <?php esc_html_e('Sign Up', 'tumbas'); ?></a>
                    </div>
                <?php } else { ?>
                    <?php if ( has_nav_menu( 'my-account' ) ) : ?>
                        <div class="site-header-topmenu pull-right">
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0">
                                    <?php esc_html_e( 'My Account', 'tumbas' ); ?>
                                </a>
                                <div class="dropdown-menu">
                                    <?php
                                        $args = array(
                                            'theme_location' => 'my-account',
                                            'container_class' => 'collapse navbar-collapse',
                                            'menu_class' => 'nav navbar-nav',
                                            'fallback_cb' => '',
                                            'menu_id' => 'topmenu-menu',
                                            'walker' => new Tumbas_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                </div>
                            </div>
                            
                        </div>
                    <?php endif; ?>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="<?php echo (tumbas_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="header-main clearfix <?php echo (tumbas_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="container">
                <div class="header-inner">
                        <div class="row">
                        <!-- LOGO -->
                            <div class="col-md-2">
                                <div class="logo-in-theme pull-left">
                                    <?php get_template_part( 'page-templates/parts/logo' ); ?>
                                </div>
                            </div>
                            <div class="col-md-8 p-static">
                                <div class="header-setting">
                                    <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
                                </div>
                            </div>
                            <div class="col-md-2 pull-right ">
                                <?php if ( defined('TUMBAS_WOOCOMMERCE_ACTIVED') && TUMBAS_WOOCOMMERCE_ACTIVED ): ?>
                                    <div class="pull-right">
                                        <div class="top-cart hidden-xs">
                                            <?php get_template_part( 'woocommerce/cart/mini-cart-button2' ); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</header>

