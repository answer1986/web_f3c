<?php

global $post;
$args = array( 'position' => 'top', 'animation' => 'true' );
?>
<div class="apus-social-share">
		<div class="bo-social-icons bo-sicolor social-radius-rounded">
		<?php if ( tumbas_get_config('facebook_share', 1) ): ?>
 
			<a class="bo-social-facebook" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Facebook" href="http://www.facebook.com/sharer.php?s=100&p&#91;url&#93;=<?php the_permalink(); ?>&p&#91;title&#93;=<?php the_title(); ?>" target="_blank" title="<?php echo esc_html__('Share on facebook', 'tumbas'); ?>">
				<span class="fa fa-facebook"></span>
				<span class="social-name">Facebook</span>
			</a>
 
		<?php endif; ?>
		<?php if ( tumbas_get_config('twitter_share', 1) ): ?>
 
			<a class="bo-social-twitter"  data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank" title="<?php echo esc_html__('Share on Twitter', 'tumbas'); ?>">
				<span class="fa fa-twitter"></span>
				<span class="social-name">Twitter</span>
			</a>
 
		<?php endif; ?>
		<?php if ( tumbas_get_config('linkedin_share', 1) ): ?>
 
			<a class="bo-social-linkedin"  data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="LinkedIn" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="<?php echo esc_html__('Share on LinkedIn', 'tumbas'); ?>">
				<span class="fa fa-linkedin"></span>
				<span class="social-name">Linkedin</span>
			</a>
 
		<?php endif; ?>
		<?php if ( tumbas_get_config('tumblr_share', 1) ): ?>
 
			<a class="bo-social-tumblr" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Tumblr" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank" title="<?php echo esc_html__('Share on Tumblr', 'tumbas'); ?>">
				<span class="fa fa-tumblr"></span>
				<span class="social-name">Tumblr</span>
			</a>
 
		<?php endif; ?>
		<?php if ( tumbas_get_config('google_share', 1) ): ?>
 
			<a class="bo-social-google" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Google plus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" title="<?php echo esc_html__('Share on Google plus', 'tumbas'); ?>">
				<span class="fa fa-google"></span>
				<span class="social-name">Google</span>
			</a>
 
		<?php endif; ?>
		<?php if ( tumbas_get_config('pinterest_share', 1) ): ?>
 
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			<a class="bo-social-pinterest" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>" target="_blank" title="<?php echo esc_html__('Share on Pinterest', 'tumbas'); ?>">
				<span class="fa fa-pinterest-p"></span>
				<span class="social-name">Pinterest</span>
			</a>
 
		<?php endif; ?>
	</div>
</div>	