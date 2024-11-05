<header id="apus-header" class="site-header header-default hidden-sm hidden-xs " role="banner">
    
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

                <?php if ( tumbas_get_config('show_searchform') ): ?>
                    <div class="apus-search pull-right">
                       <button type="button" class="button-show-search button-setting"><i class="mn-icon-52"></i></button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="full-top-search-form">
                <?php get_template_part( 'page-templates/parts/productsearchform-popup' ); ?>
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
                            <div class="col-md-10 p-static">
                                <div class="heading-right pull-right hidden-sm hidden-xs">
                                    <div class="pull-right  header-setting">

                                        <?php if ( defined('TUMBAS_WOOCOMMERCE_ACTIVED') && TUMBAS_WOOCOMMERCE_ACTIVED ): ?>
                                            <div class="pull-right">
                                                <!-- Setting -->
                                                <div class="top-cart hidden-xs">
                                                    <?php get_template_part( 'woocommerce/cart/mini-cart-button2' ); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                    <div class="main-menu pull-left">
    <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
        <?php
            $args = array(
                'theme_location' => 'primary',
                'container_class' => 'collapse navbar-collapse',
                'menu_class' => 'nav navbar-nav megamenu main-menu-v1',
                'fallback_cb' => '',
                'menu_id' => 'primary-menu',
                'walker' => new Tumbas_Nav_Menu()
            );
            wp_nav_menu($args);
        ?>
    </nav>
    <section class="buscador kc-elm kc-css-676447 kc_row">
        <div class="kc-row-container kc-container " style="width: 70%;">
            <div class="kc-wrap-columns">
                <div class="kc-elm kc-css-85864 kc_col-sm-12 kc_column kc_col-sm-12">
                    <div class="kc-col-container">
                        <div class="kc-elm kc-css-286886 kc-raw-code">
                            <div class="dgwt-wcas-search-wrapp dgwt-wcas-is-detail-box dgwt-wcas-no-submit woocommerce dgwt-wcas-style-solaris js-dgwt-wcas-layout-classic dgwt-wcas-layout-classic js-dgwt-wcas-mobile-overlay-enabled">
                                <?php echo do_shortcode('[fibosearch]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

                                <?php endif; ?>
                            </div>
                        </div>
					<!-- Buscador -->
                </div>
            </div>
            
        </div>
    </div>
</header>