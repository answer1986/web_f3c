<?php

$atts  = array_merge( array(
	'number'  => 8,
	'columns'	=> 4,
	'type'		=> 'recent_products',
	'categories'	=> '',
	'layout_type' => 'grid',
	'rows' => 1,
), $atts);
extract( $atts );

if ( empty($type) ) {
	return ;
}
$categories = apus_themer_multiple_fields_to_array_helper($categories);
$loop = apus_themer_get_products( $categories, $type, 1, $number );

?>
<div class="widget widget-<?php echo esc_attr($layout_type); ?> widget-products products">
	
	<?php if ( $loop->have_posts() ) : ?>
		<div class="widget-content woocommerce">
			<div class="<?php echo esc_attr( $layout_type ); ?>-wrapper">
				<?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns ) ); ?>
			</div>
		</div>
	<?php endif; ?>

</div>
