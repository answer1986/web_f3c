<?php 
global $product;
?>
<div class="product-block list" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<div class="row">
		<div class="col-lg-4 col-md-4">
		    <figure class="image">
		        <?php woocommerce_show_product_loop_sale_flash(); ?>
		        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
		            <?php
		                /**
		                * woocommerce_before_shop_loop_item_title hook
		                *
		                * @hooked woocommerce_show_product_loop_sale_flash - 10
		                * @hooked woocommerce_template_loop_product_thumbnail - 10
		                */
		                tumbas_swap_images();
		            ?>
		        </a>

		    </figure>
		</div>    
	    <div class="col-lg-8 col-md-8">
		    <div class="caption-list">
		        
		        <div class="meta">
		        	<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="product-cats">
	                    <?php
	                        $terms = get_the_terms( $product->get_id(), 'product_cat' );
	                        if ( !empty($terms) ) {
	                            foreach ( $terms as $term ) {
	                                echo '<a href="' . get_term_link( $term->term_id ) . '">' . $term->name . '</a>';
	                                break;
	                            }
	                        }
	                    ?>
	                </div>
					<?php echo  the_excerpt();  ?>

		            <?php
		                /**
		                * woocommerce_after_shop_loop_item_title hook
		                *
		                * @hooked woocommerce_template_loop_rating - 5
		                * @hooked woocommerce_template_loop_price - 10
		                */
		                remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
		                do_action( 'woocommerce_after_shop_loop_item_title');
		            ?>

		            <div class="action-bottom clearfix"> 
						<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		            </div>
		        </div>    
		    </div>
		</div>    
	</div>	    
</div>
