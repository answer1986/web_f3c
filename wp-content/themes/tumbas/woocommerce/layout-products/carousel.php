<?php
$product_item = isset($product_item) ? $product_item : 'inner';
$columns = isset($columns) ? $columns : 4;
?>
<div class="owl-carousel" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="2" data-pagination="false" data-nav="true">
    <?php while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
        <div class="item">
            <div class="products-grid product">
                <?php wc_get_template_part( 'item-product/'.$product_item ); ?>
            </div>
        </div>
    <?php endwhile; ?>
</div> 
<?php wp_reset_postdata(); ?>