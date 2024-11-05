<?php
$product_item = isset($product_item) ? $product_item : 'inner';
$bcol = 12/$columns;
$countrow = 1;
?>
<div class="special <?php echo ($columns <= 1) ? 'w-products-list' : 'products products-grid';?>">
	<div class="row">
		<?php $count = 0; while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			<?php if ($count%4 == 0) { ?>
				<div class="col-md-4 <?php if($countrow == 1){ echo 'col-first'; }else{ echo 'col-last'; } ?> ">
					<?php $countrow++; ?>
					<div class="row">
			<?php } ?>
					<div class="col-xs-6 <?php echo ($count%2 == 0 ? 'first' : ''); ?>">
						<?php wc_get_template_part( 'item-product/'.$product_item ); ?>
					</div>
			<?php if ($count%4 == 3 || ($count == $loop->post_count - 1) ) { ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( $count == 3 && isset($product_special) && $product_special ) {
				global $product, $post;
				$product = wc_get_product( $product_special );
				$post = $product->post;
				setup_postdata($post);
			?>
				<div class="col-md-4 product-special">
					<?php wc_get_template_part( 'item-product/inner-v1' ); ?>
				</div>
			<?php } ?>
		<?php $count++; endwhile; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>