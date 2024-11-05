<?php

$atts  = array_merge( array(
	'title'	=> '',
	'description' => '',
	'number' => '',
	'icon' => '',
	'image' => '',
	'text_color' => '',
), $atts);
extract( $atts );


$text_color = $text_color ? 'style="color:'. esc_attr($text_color) .';"' : "";
wp_enqueue_script( 'apus-counter-js', APUS_THEMER_URL . '/assets/front/jquery.counterup.min.js', array( 'jquery' ) );
wp_enqueue_script( 'apus-waypoints-js', APUS_THEMER_URL . '/assets/front/waypoints.min.js', array( 'jquery' ) );

?>
<?php $img = wp_get_attachment_image_src($image, 'full'); ?>
<div class="counters">
	<div class="counter-wrap" >
		<?php if( isset($img[0]) ) { ?>
			<img src="<?php echo esc_url_raw($img[0]);?>" title="<?php echo esc_attr($title); ?>" class="image-icon">
		<?php } elseif( $icon ) { ?>
		 	<i class="fa <?php echo esc_attr($icon); ?>" <?php echo trim($text_color); ?>></i>
		<?php } ?>
		<span class="clearfix"></span>
	   	<span class="counter counterUp" <?php echo trim($text_color); ?>><?php echo (int)$number ?></span>
	</div> 
    <h5><?php echo trim($title); ?></h5>
    <?php if ( !empty($description) ): ?>
	    <div class="description"><?php echo $description; ?></div>
	<?php endif; ?>
</div>
