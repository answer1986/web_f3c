<?php

$atts  = array_merge( array(
	'image' => '',
	'image_position' => '',
	'title' => '',
	'subtitle' => '',
	'description' => '',
	'button_text' => '',
	'button_link' => '',
), $atts);

extract( $atts );


$img = wp_get_attachment_image_src($image, 'full');
$style = '';
if (isset($img[0]) && $img[0]) {
	$style = 'style="background-image:url('.esc_url($img[0]).');"';
}
?>
<div class="widget widget-banner image_position-<?php echo esc_attr($image_position); ?>" <?php echo trim($style); ?>>
	<div class="banner-body">
	
		<?php if ( $title ) { ?>
			<h3 class="banner-title"><?php echo trim($title); ?></h3>
		<?php } ?>
		<?php if ( $subtitle ) { ?>
			<div class="banner-subtitle"><?php echo trim($subtitle); ?></div>
		<?php } ?>
		<?php if ( $description ) { ?>
			<div class="banner-description"><?php echo trim($description); ?></div>
		<?php } ?>

		<?php if ( $button_link ) { ?>
			<a href="<?php echo esc_url($button_link); ?>" title="<?php echo esc_attr($button_text); ?>" class="btn btn-default">
				<?php echo trim($button_text); ?>
			</a>
		<?php } ?>
		
	</div>
</div>
