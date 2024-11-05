<?php

$atts  = array_merge( array(
	'title'	=> '',
	'features' => '',
	'style' => '',
	'columns' => ''
), $atts);
extract( $atts );

if ( !empty($features) ):
?>
	<div class="widget widget-features-box <?php echo esc_attr($style); ?>">
		<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
	    </h3>
	    <?php endif; ?>
	    <div class="content">
		    <?php if($columns > 1) echo '<div class="row">'; ?>
			<?php foreach ($features as $item): ?>
				<?php if($columns > 1) echo '<div class="col-md-'.(12/$columns).'">'; ?>
				<div class="feature-box">
					<div class="fbox-head">
						<?php if ( isset($item->image) && $item->image ){ ?>
							<?php $img = wp_get_attachment_image_src($item->image,'full'); ?>
							<?php if (isset($img[0]) && $img[0]) { ?>
						    	<div class="fbox-image">
						    		<div class="inner">
						    			<?php
						    				if ( function_exists('apus_themer_display_image') ) {
							    				apus_themer_display_image($img);
							    			}
						    			?>
						    		</div>
						    	</div>
							<?php } ?>
						<?php }else{ ?>
							<?php if (isset($item->icon) && $item->icon) { ?>
						        <div class="fbox-icon">
						        	<div class="inner">
						            	<i class="fa <?php echo esc_attr($item->icon); ?>"></i>
						            </div>
						        </div>
						    <?php } ?>
					    <?php } ?>
				    </div>
				    <div class="fbox-content">  
				        <h3 class="ourservice-heading"><?php echo trim($item->title); ?></h3>                     
				        <?php if (isset($item->description) && trim( $item->description )!='') { ?>
				            <p class="description"><?php echo trim( $item->description );?></p>  
				        <?php } ?>
				    </div>      
				</div>
				<?php if($columns > 1) echo '</div>'; ?>
			<?php endforeach; ?>
			<?php if($columns > 1) echo '</div>'; ?>
		</div>
	</div>
<?php endif; ?>