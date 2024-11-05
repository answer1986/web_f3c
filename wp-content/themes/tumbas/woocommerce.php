<?php

get_header();
$sidebar_configs = tumbas_get_woocommerce_layout_configs();

?>

<?php do_action( 'tumbas_woo_template_main_before' ); ?>

<section id="main-container" class="main-content <?php echo apply_filters('tumbas_woocommerce_content_class', 'container');?>">
	<!-- categories -->
	<?php
	if ( !is_singular('product') ) {

		if ( tumbas_get_config('product_archive_show_categories', true ) && tumbas_get_config('product_archive_categories' ) ) { ?>
		<div class="top-categories-wrapper text-center">
			<?php
				$args = array(
                    'menu' => tumbas_get_config( 'product_archive_categories' ),
                    'container_class' => '',
                    'menu_class' => 'nav navbar-nav main-menu-v1',
                    'fallback_cb' => '',
                    'menu_id' => 'top-categories-menu',
                    'walker' => new Tumbas_Nav_Menu()
                );
                wp_nav_menu($args);
            ?>
		</div>
	<?php
		}
	}
	?>
	<div class="row">
		

		<div id="main-content" class="archive-shop col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					
					<?php  tumbas_woocommerce_content(); ?>

				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- #main-content -->
		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="col-xs-12 <?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php

get_footer();
