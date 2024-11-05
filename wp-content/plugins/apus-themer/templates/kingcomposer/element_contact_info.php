<?php

$atts  = array_merge( array(
	'items' => array()
), $atts);
extract( $atts );

if (!empty($items)): ?>
	<div class="contact-info">
		<?php foreach ($items as $item) { ?>
			<div class="media">
			  	<div class="media-left">
			    	<?php if ( isset($item->image) && $item->image ): ?>
						<?php $img = wp_get_attachment_image_src($item->image, 'full'); ?>
						<?php if (isset($img[0]) && $img[0]) { ?>
					    	<img src="<?php echo esc_url_raw($img[0]);?>" alt="" />
						<?php } ?>
					<?php elseif (isset($item->icon) && $item->icon): ?>
		            	<i class="<?php echo esc_attr($item->icon); ?>"></i>
				    <?php endif ?>
			  	</div>
			  	<div class="media-body">
			    	<?php if ( isset($item->description) ):
			    		echo $item->description;
			    	endif; ?>
			  	</div>
			</div>
		<?php } ?>
	</div>
<?php endif; ?>
