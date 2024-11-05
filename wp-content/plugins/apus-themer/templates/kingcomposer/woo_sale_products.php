<?php

$atts  = array_merge( array(
	'number'  => 8,
	'columns'	=> 4,
	'category'	=> '',
	'layout_type' => 'grid',
	'rows' => 1,
), $atts);
extract( $atts );


$categories = apus_themer_multiple_fields_to_array_helper($categories);
$loop = apus_themer_get_products( $categories, 'deals', 1, $number );
?>
<div class="widget_deals_products widget widget_products">

    <div class="widget-content woocommerce">
        <?php if ( $loop->have_posts() ): ?>
            <?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns ) ); ?>
        <?php endif; ?>
    </div>

</div>