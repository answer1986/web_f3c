<?php

$atts  = array_merge( array(
	'columns'	=> 4,
	'layout_type' => 'grid'
), $atts);
extract( $atts );

$bcol = 12/$columns;
if ($columns == 5) {
	$bcol = 'cus-5';
}
if ( !empty($brands) && is_array($brands) ):
?>
	<div class="widget widget-brands">
	    <div class="widget-content">
    		<?php if ( $layout_type == 'carousel' ): ?>
    			<div class="owl-carousel products" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="false" data-nav="true">
		    		<?php foreach ($brands as $brand) { ?>
		    			<div class="item">
			                <?php if (isset($brand->link) && $brand->link): ?>
								<a href="<?php echo esc_url($brand->link); ?>" target="_blank">
							<?php endif; ?>
							<?php if (isset($brand->image) && $brand->image): ?>
								<?php $img = wp_get_attachment_image_src($brand->image, 'full'); ?>
								<?php apus_themer_display_image($img); ?>
							<?php endif; ?>
							<?php if (isset($brand->link) && $brand->link): ?>
								</a>
							<?php endif; ?>
				        </div>
		    		<?php } ?>
	    		</div>
	    	<?php else: ?>
	    		<div class="row">
		    		<?php foreach ($brands as $brand) { ?>
		    			<div class="col-md-<?php echo esc_attr($bcol); ?>">
			                <?php if (isset($brand->link) && $brand->link): ?>
								<a href="<?php echo esc_url($brand->link); ?>" target="_blank">
							<?php endif; ?>
							<?php if (isset($brand->image) && $brand->image): ?>
								<?php $img = wp_get_attachment_image_src($brand->image, 'full'); ?>
								<?php apus_themer_display_image($img); ?>
							<?php endif; ?>
							<?php if (isset($brand->link) && $brand->link): ?>
								</a>
							<?php endif; ?>
				        </div>
		    		<?php } ?>
	    		</div>
	    	<?php endif; ?>
	    </div>
	</div>
<?php endif; ?>