<?php

$atts  = array_merge( array(
	'image'	=> '',
	'link'	=> ''
), $atts);
extract( $atts );

?>
<div class="widget widget-single-image">
    <div class="widget-content">
		<?php if (isset($image) && $image): ?>
			<?php $img = wp_get_attachment_image_src($image, 'full');
			if ($link) {
				?>
				<a href="<?php echo esc_url($link); ?>">
				<?php
			}
				apus_themer_display_image($img);
			if ($link) {
				?>
				</a>
				<?php
			}
			?>
		<?php endif; ?>
    </div>
</div>