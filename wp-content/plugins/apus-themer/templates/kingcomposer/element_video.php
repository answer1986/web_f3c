<?php

$atts  = array_merge( array(
	'image'  => '',
	'video_link' => ''
), $atts);
extract( $atts );
?>
<div class="widget widget-video  <?php echo esc_attr($el_class); ?> <?php echo esc_attr( $style ); ?>">
    <div class="video-wrapper-inner">
		<div class="video">
			<?php $img = wp_get_attachment_image_src($image,'full'); ?>
			<?php if ( !empty($img) && isset($img[0]) ): ?>
				<a class="popup-video" href="<?php echo esc_url_raw($video_link); ?>">
					<?php if (isset($icon) && $icon) { ?>
						<i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
					<?php } ?>
	        		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
	        	</a>
	        <?php endif; ?>
		</div>
	</div>
</div>