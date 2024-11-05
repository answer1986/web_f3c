<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	
	<div class="row">
		<div class="col-sm-5">
			<?php
			if ( wc_review_ratings_enabled() ) {
					$avg = $product->get_average_rating();
					$total = $product->get_review_count();
					$comment_ratings = get_post_meta( $product->get_id(), '_wc_rating_count', true );
				?>
				
				<div class="average-value">
					<?php
						if ($rating_html = wc_get_rating_html( $product->get_average_rating() )) {
							?>
							<h3 class="title-info"><?php echo esc_html__('Overall Customer Rating', 'tumbas'); ?></h3>
							<div class="average-html">
								<?php
			            		echo trim( wc_get_rating_html( $product->get_average_rating() ) );
			            		echo ( $avg ) ? esc_html( round( $avg, 1 ) ) : 0;
			            		?>
		            		</div>
		            		<span><?php printf( _n('Based on %s review', 'Based on %s reviews', $total, 'tumbas'), $total ); ?></span>
		            		<?php
		            		if ( isset($comment_ratings[5]) && !empty($comment_ratings[5]) ) {
			            		$percent = esc_attr(  round( $comment_ratings[5] / $total * 100, 2 ) . '%' );
			            		printf(__('<sapan class="ratio">%s of customers would recommend this product to a friend (%d out of %d)</span>', 'tumbas'), $percent, $comment_ratings[5], $total);
			            	}
		            	}
	            	?>
					
				</div>
			<?php } ?>
			<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

				<div id="review_form_wrapper">
					<div id="review_form">
						<?php
							$commenter = wp_get_current_commenter();

							$comment_form = array(
								'title_reply'          => have_comments() ? esc_html__( 'Write your review', 'tumbas' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'tumbas' ), get_the_title() ),
								'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'tumbas' ),
								'comment_notes_before' => '',
								'comment_notes_after'  => '',
								'fields'               => array(
									'author' => '<p class="comment-form-author">' .
									            '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="' . esc_html__( 'Your Name', 'tumbas' ) . '"/></p>',
									'email'  => '<p class="comment-form-email">' .
									            '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="' . esc_html__( 'Your Email', 'tumbas' ) . '" /></p>',
								),
								'label_submit'  => esc_html__( 'Submit Review', 'tumbas' ),
								'logged_in_as'  => '',
								'comment_field' => ''
							);

							if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
								$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.', 'tumbas' ), esc_url( $account_page_url ) ) . '</p>';
							}

							if ( wc_review_ratings_enabled() ) {
								
								$comment_form['comment_field'] = '<label class="you-rating" for="rating">' . esc_html__( 'Rating: ', 'tumbas' ) .'</label><div class="comment-form-rating list-rating">
									<ul class="review-stars">
										<li><span class="fa fa-star-o"></span></li>
										<li><span class="fa fa-star-o"></span></li>
										<li><span class="fa fa-star-o"></span></li>
										<li><span class="fa fa-star-o"></span></li>
										<li><span class="fa fa-star-o"></span></li>
									</ul>
									<ul class="review-stars filled" style="width: 100%">
										<li><span class="fa fa-star"></span></li>
										<li><span class="fa fa-star"></span></li>
										<li><span class="fa fa-star"></span></li>
										<li><span class="fa fa-star"></span></li>
										<li><span class="fa fa-star"></span></li>
									</ul>
									<input type="hidden" value="5" name="rating" id="rating"></div>';
							}

							$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="' . esc_html__( 'Your Review', 'tumbas' ) . '" ></textarea></p>';

							comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
						?>
					</div>
				</div>

			<?php else : ?>

				<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'tumbas' ); ?></p>

			<?php endif; ?>
		</div>
		<div class="col-sm-7">
	
			<div id="comments">

				<?php if ( have_comments() ) : ?>

					<ol class="commentlist">
						<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
					</ol>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						) ) );
						echo '</nav>';
					endif; ?>

				<?php else : ?>

					<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'tumbas' ); ?></p>

				<?php endif; ?>
			</div>
		</div>
	</div>

	

	<div class="clear"></div>
</div>
