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
if ( !empty($testimonials) && is_array($testimonials) ):
?>
	<div class="widget widget-testimonials">
	    <div class="widget-content">
    		<?php if ( $layout_type == 'carousel' ): ?>
    			<div class="owl-carousel products" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="false" data-nav="true">
		    		<?php foreach ($testimonials as $testimonial) { ?>
		    			
				        <div class="testimonials-body">
						   <div class="testimonials-profile">
						      	<div class="media">
						         	<div class="testimonial-avatar media-left">
							            <?php if (isset($testimonial->image) && $testimonial->image): ?>
											<?php $img = wp_get_attachment_image_src($testimonial->image, 'full'); ?>
											<?php apus_themer_display_image($img); ?>
										<?php endif; ?>
						         	</div>
						         	<div class="testimonial-meta media-body">
							            <div class="description"><?php echo $testimonial->content; ?></div>
							            <div class="info">
							               	<h3 class="name-client"> <?php echo $testimonial->name; ?></h3>
							               	<div class="job"> , <?php echo $testimonial->job; ?></div>   
							            </div>
						         	</div>
						      	</div>
						   </div> 
						</div>

		    		<?php } ?>
	    		</div>
	    	<?php else: ?>
	    		<div class="row">
		    		<?php foreach ($testimonials as $testimonial) { ?>
		    			<div class="col-md-<?php echo esc_attr($bcol); ?>">
			                <div class="testimonials-body">
							   	<div class="testimonials-profile">
							      	<div class="media">
							         	<div class="testimonial-avatar media-left">
								            <?php if (isset($testimonial->image) && $testimonial->image): ?>
												<?php $img = wp_get_attachment_image_src($testimonial->image, 'full'); ?>
												<?php apus_themer_display_image($img); ?>
											<?php endif; ?>
							         	</div>
							         	<div class="testimonial-meta media-body">
								            <div class="description"><?php echo $testimonial->content; ?></div>
								            <div class="info">
								               	<h3 class="name-client"> <?php echo $testimonial->name; ?></h3>
								               	<div class="job"> , <?php echo $testimonial->job; ?></div>   
								            </div>
							         	</div>
							      	</div>
							   	</div> 
							</div>
				        </div>
		    		<?php } ?>
	    		</div>
	    	<?php endif; ?>
	    </div>
	</div>
<?php endif; ?>