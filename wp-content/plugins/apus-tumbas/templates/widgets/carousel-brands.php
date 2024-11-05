<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}
?>
<div class="carousel-brands-widget widget-content">
    <?php
        $hide_empty = $instance['hide_empty'];

        $brands_list = get_terms( 'product_brand', array(
            'orderby'    => 'name',
            'order' => 'ASC',
            'hide_empty' => $hide_empty
        ));

        if ( !empty( $brands_list ) && !is_wp_error( $brands_list ) ){
            ?>

            <div class="owl-carousel" data-items="<?php echo esc_attr($instance['columns']); ?>" data-carousel="owl" data-pagination="false" data-nav="false" data-extrasmall="2" data-loop="<?php echo (count($brands_list) > 1 ? 'true' : 'false'); ?>" data-autoplay="<?php echo ($instance['autoplay'] ? 'true' : 'false'); ?>">
            <?php
            foreach ( $brands_list as $brand_item ) {
                echo '<div class="item">';    
                	$icon = Taxonomy_MetaData_CMB2::get( 'product_brand', $brand_item->term_id, 'logo' );
					if ( $icon ) {
						$image = $icon;
					} else {
						$image = wc_placeholder_img_src();
					}
                    echo '<a href="'.get_term_link( $brand_item->slug, 'product_brand' ).'" title="'.esc_attr($brand_item->name).'">
                    		<img src="'.esc_url($image).'" alt="'.esc_attr($brand_item->name).'" />
                    	</a>';
                
                echo '</div>';
            }
            ?>
            </div>
           <?php
        } 

    ?>
</div>