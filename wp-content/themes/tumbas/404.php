<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Tumbas
 * @since Tumbas 1.0
 */
/*

*Template Name: 404 Page
*/
get_header();
$sidebar_configs = tumbas_get_page_layout_configs();

?>
<section class="page-404">
<section id="main-container" class="container inner">
	<div class="row">
		<?php if ( isset($sidebar_configs['left']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			  		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
			   			<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			   		<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
		<div id="main-content" class="main-page <?php echo esc_attr($sidebar_configs['main']['class']); ?>">

			<section class="error-404 not-found  clearfix">
				<div class="row">
					<div class="col-md-6">
						<img class="img4" src="<?php echo esc_url_raw( get_template_directory_uri().'/images/not.jpg'); ?>" alt="">
					</div>

					<div class="col-md-6">
						<span class="page-sub"><?php esc_html_e( 'Oopss..', 'tumbas' ); ?></span>
						<h3 class="page-title"><?php esc_html_e( 'Page Cannot be Found', 'tumbas' ); ?></h3>
						<div class="page-content">
							<p class="sub-title"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 'tumbas' ); ?></p>
							<a class="btn  " href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('back to homepage', 'tumbas'); ?></a>
						</div><!-- .page-content -->
					</div>

				</div>
			</section><!-- .error-404 -->

		</div><!-- .content-area -->
		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			  		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
		
	</div>
</section>
</section>
<?php get_footer(); ?>