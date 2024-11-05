<?php

$atts  = array_merge( array(
	'beforetitle'	=> '',
	'title' => '',
	'aftertitle' => '',
	'price' => '',
	'button_text' => '',
	'button_link' => '',
	'images' => '',
	'layout_type' => '',
), $atts);
extract( $atts );
?>
<div class="widget widget-carousel-banner carousel-banner-<?php echo esc_attr($layout_type); ?>">
	<?php if ($layout_type == 'layout1'): ?>
		<div class="row">
			<div class="col-md-6">
				<div class="banner-body">
					<?php if ($beforetitle) { ?>
						<div class="beforetitle"><?php echo trim($beforetitle); ?></div>
					<?php } ?>
					<?php if ($title) { ?>
						<h3 class="title"><?php echo trim($title); ?></h3>
					<?php } ?>
					<?php if ($aftertitle) { ?>
						<div class="aftertitle"><?php echo trim($aftertitle); ?></div>
					<?php } ?>
					<?php if ($price) { ?>
						<div class="price"><?php echo trim($price); ?></div>
					<?php } ?>
					<?php if ($button_text && $button_link) { ?>
						<a href="<?php echo esc_url($button_link); ?>" class="btn btn-default"><?php echo trim($button_text); ?></a>
					<?php } ?>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="owl-carousel" data-items="1" data-carousel="owl" data-pagination="true" data-nav="true" data-extrasmall="1">
					<?php foreach ($images as $item): ?>
						<?php $img = wp_get_attachment_image_src($item->image,'full'); ?>
						<?php if (isset($img[0]) && $img[0]) { ?>
				    		<div class="item">
				    			<?php tumbas_display_image($img); ?>
				    		</div>
						<?php } ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="custom-carousel">
			<div class="owl-carousel" data-items="1" data-carousel="owl" data-pagination="false" data-nav="true" data-extrasmall="1" data-loop="<?php echo (count($images) > 1 ? 'true' : 'false'); ?>">
				<?php foreach ($images as $item): ?>
					<?php $img = wp_get_attachment_image_src($item->image,'full'); ?>
					<?php if (isset($img[0]) && $img[0]) { ?>
			    		<div class="item">
			    			<?php tumbas_display_image($img); ?>
			    		</div>
					<?php } ?>
				<?php endforeach; ?>
			</div>
		</div>

		<?php if ($price) { ?>
			<div class="price"><?php echo trim($price); ?></div>
		<?php } ?>

		<?php if ($beforetitle) { ?>
			<div class="beforetitle"><?php echo trim($beforetitle); ?></div>
		<?php } ?>
		<?php if ($title) { ?>
			<h3 class="title"><?php echo trim($title); ?></h3>
		<?php } ?>
		<?php if ($aftertitle) { ?>
			<div class="aftertitle"><?php echo trim($aftertitle); ?></div>
		<?php } ?>
		<?php if ($button_text && $button_link) { ?>
			<a href="<?php echo esc_url($button_link); ?>" class="btn btn-default"><?php echo trim($button_text); ?></a>
		<?php } ?>

	<?php endif; ?>
</div>