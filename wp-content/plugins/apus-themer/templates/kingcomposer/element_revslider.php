<?php

$atts  = array_merge( array(
	'title'	=> '',
	'alias' => '',
	'exclass' => ''
), $atts);
extract( $atts );

?>

<div class="widget-revslider <?php echo esc_attr($exclass); ?>">
	<?php echo apply_filters( 'vc_revslider_shortcode', do_shortcode( '[rev_slider ' . $alias . ']' ) ); ?>
</div>