<?php

$atts  = array_merge( array(
	'number' => 8,
	'columns' => 4,
	'type' => 'recent_products',
	'tabs'	=> array(),
	'layout_type' => 'grid',
	'tab_style' => 'style1'
), $atts);
extract( $atts );

if ( empty($type) || empty($tabs) ) {
	return ;
}
$_id = apus_themer_random_key();
?>
<div class="widget widget-categories-tabs-<?php echo esc_attr($layout_type); ?> widget-products products">
	<ul role="tablist" class="nav <?php echo esc_attr($tab_style); ?>" data-load="ajax">
        <?php $i = 0; foreach ($tabs as $tab) { ?>
            <li<?php echo ($i == 0 ? ' class="active"' : ''); ?>>
                <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($i); ?>" data-toggle="tab">
                	<?php if ( isset($tab->image) && $tab->image ): ?>
						<?php $img = wp_get_attachment_image_src($tab->image,'full'); ?>
						<?php if (isset($img[0]) && $img[0]) { ?>
					    	<img src="<?php echo esc_url_raw($img[0]);?>" alt="" />
						<?php } ?>
					<?php endif; ?>
					<?php if (isset($tab->icon) && $tab->icon) { ?>
		            	<i class="<?php echo esc_attr($tab->icon); ?>"></i>
				    <?php } ?>

                    <?php echo $tab->name; ?>
                </a>
            </li>
        <?php $i++; } ?>
    </ul>
	<div class="widget-content woocommerce">
		<div class="tab-content">
            <?php $i = 0; foreach ($tabs as $tab) : ?>
                <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($i); ?>" class="tab-pane <?php echo ($i == 0 ? 'active' : ''); ?>" data-loaded="<?php echo ($i == 0 ? 'true' : 'false'); ?>" data-number="<?php echo esc_attr($number); ?>" data-categories="<?php echo esc_attr($tab->category); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-product_type="<?php echo esc_attr($type); ?>" data-layout_type="<?php echo esc_attr($layout_type); ?>">
                    <?php if ( $i == 0 ): ?>
                        <?php
                        	$categories = !empty($tab->category) ? array($tab->category) : array();
                        	$loop = apus_themer_get_products( $categories, $type, 1, $number );
                    	?>
                        <?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns ) ); ?>
                    <?php endif; ?>
                </div>
            <?php $i++; endforeach; ?>
        </div>
	</div>

</div>
