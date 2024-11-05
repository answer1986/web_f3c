<?php

$atts  = array_merge( array(
	'number'  => 8,
	'columns'	=> 4,
	'type'		=> 'recent_products',
	'categories'	=> '',
	'layout_type' => 'grid',
	'rows' => 1,
	'product_special' => '',
	'item_style' => 'inner',
), $atts);
extract( $atts );

if ( empty($type) ) {
	return ;
}

$excludes = array();
if ( $layout_type == 'special' ) {
	$product_special = tumbas_autocomplete_options_helper($product_special);
	if (is_array($product_special) && isset($product_special[0])) {
		$product_special = $product_special[0];
		$excludes = array($product_special);
	}
}
$tcategories = array();
if ( function_exists('apus_themer_multiple_fields_to_array_helper') ) {
	$tcategories = apus_themer_multiple_fields_to_array_helper($categories);
}
$loop = tumbas_get_products( $tcategories, $type, 1, $number, '', '', $excludes );

?>
<div class="widget widget-<?php echo esc_attr($layout_type); ?> widget-products products">
	<?php if ($title || $show_view_more_btn) { ?>
		<div class="widget-title">
			<h3><?php echo trim($title); ?></h3>
			<?php if ($show_view_more_btn) { ?>
				<a href="<?php echo esc_url($view_more_btn_url); ?>"><?php echo trim($view_more_btn); ?></a>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( $loop->have_posts() ) :
		wc_set_loop_prop( 'loop', 0 );
		wc_set_loop_prop( 'columns', $columns );
	?>
		<div class="widget-content woocommerce">
			<div class="<?php echo esc_attr( $layout_type ); ?>-wrapper">
				<?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'product_special' => $product_special, 'product_item' => $item_style ) ); ?>
			</div>
		</div>
	<?php endif; ?>

</div>
