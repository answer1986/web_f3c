<?php
//convert hex to rgb
if ( !function_exists ('tumbas_getbowtied_hex2rgb') ) {
	function tumbas_getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}
if ( !function_exists ('tumbas_custom_styles') ) {
	function tumbas_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
		<!-- ******************************************************************** -->
		<!-- * Theme Options Styles ********************************************* -->
		<!-- ******************************************************************** -->
			
		<style>

			/* check main color */ 
			<?php if ( tumbas_get_config('main_color') != "" ) : ?>

				/* seting border color main */
				.apus-topbar .text-banner a, a.btn, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce 
				input.button, input.btn, a.btn:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover,
				.woocommerce input.button:hover, input.btn:hover, .widget-banner:hover, .widget-banner:hover .banner-body, .owl-carousel .owl-controls .owl-nav
				.owl-prev:hover, .owl-carousel .owl-controls .owl-nav .owl-next:hover, .layout-blog .entry-content .categories a, .layout-blog .info-content 
				.categories a, .information .price .sale-percent, .accessoriesproducts .product-item:nth-of-type(2n)::before, .accessoriesproducts .product-item:nth-of-type(3n)::before
				{
					border-color: <?php echo esc_html( tumbas_get_config('main_color') ) ?>;
				}

				/* seting background main */
				.navbar-nav.megamenu .text-label, #top-categories-menu .text-label, .apus-topcart.version-2, a.btn, .woocommerce #respond input#submit, 
				.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, input.btn, a.btn:hover, .woocommerce #respond input#submit:hover
				, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, input.btn:hover, .single-post .entry-content .quote
				{
					background: <?php echo esc_html( tumbas_get_config('main_color') ) ?>;
				}
				/* setting color*/
				
				.apus-topbar .text-banner a, .navbar-nav.megamenu > li.active > a, .navbar-nav.megamenu > li:hover > a, #top-categories-menu > li.active > a, 
				#top-categories-menu > li:hover > a, .apus-topcart.version-2 .mini-cart .count, .widget-products .widget-title > a:hover, .related 
				.widget-title > a:hover, .owl-carousel .owl-controls .owl-nav .owl-prev:hover, .owl-carousel .owl-controls .owl-nav .owl-next:hover,
				a:hover, a:focus, .woocommerce div.product p.price, .woocommerce div.product span.price, .kc_tabs.kc_vertical_tabs > .kc_wrapper > 
				ul.ui-tabs-nav > li.ui-tabs-active a i, .kc_tabs.kc_vertical_tabs > .kc_wrapper > ul.ui-tabs-nav > li a:hover i, .apus-breadscrumb .breadcrumb li, .apus-breadscrumb .back-link:hover, .apus-breadscrumb .breadcrumb a:hover, .apus-breadscrumb .breadcrumb a:active, .sidebar ul > 
				li:hover::before, .sidebar ul > li:hover a, .information .price .sale-percent, .accessoriesproducts .product-item:nth-of-type(2n)::before,
				.accessoriesproducts .product-item:nth-of-type(3n)::before
				{
					color: <?php echo esc_html( tumbas_get_config('main_color') ) ?>;
				}
				/* setting border color*/
				
				.navbar-nav.megamenu > li.active, .navbar-nav.megamenu > li:hover, #top-categories-menu > li.active, #top-categories-menu > li:hover,
				.apus-topcart.version-2 .mini-cart .count, .tagcloud a:focus, .tagcloud a:hover
				{
					border-color: <?php echo esc_html( tumbas_get_config('main_color') ) ?>;
				}
				
				
				.apus-topbar .text-banner a, .widget-carousel-banner .price, .apus-footer a:hover, .apus-footer a:focus, .apus-footer a:active,
				.widget-newletter.style1 .btn::before, .main-menu-2 .navbar .nav > li > a:hover, .apus-search-form .select-category::before, .btn:hover, 
				.button:hover, .btn:focus, .button:focus, .layout-blog .meta .more a, .apus-pagination span.current, .apus-pagination a.current, .layout-blog 
				.entry-content .categories a, .accessoriesproducts .total-price, .accessoriesproducts .product-item .widget-product .price
				{
					color: <?php echo esc_html( tumbas_get_config('main_color') ) ?>;
				}
				
				/* setting important*/
				.text-theme
				{
					color: <?php echo esc_html( tumbas_get_config('main_color') ) ?> !important ;
				}
				.carousel-banner-layout1 .owl-carousel .owl-controls .owl-dots .owl-dot.active, .sidebar .widget .widget-title span::after, .apus-sidebar 
				.widget .widget-title span::after, .tagcloud a:focus, .tagcloud a:hover
				{
					background: <?php echo esc_html( tumbas_get_config('main_color') ) ?> !important;
				}
			<?php endif; ?>

			
			/* Custom CSS */
			<?php if ( tumbas_get_config('custom_css') != "" ) : ?>
				<?php echo tumbas_get_config('custom_css') ?>
			<?php endif; ?>

		</style>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		echo implode($new_lines);
	}
}

?>
<?php add_action( 'wp_head', 'tumbas_custom_styles', 99 ); ?>