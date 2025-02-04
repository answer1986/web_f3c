<div class="author-info">
	<div class="about-container media">
		<?php if(get_avatar( get_the_author_meta( 'user_email' ),200 )){?>
			<div class="avatar-img media-left">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ),200 ); ?>
			</div>
		<?php } ?>
		<!-- .author-avatar -->
		<div class="description media-body">
			<h4 class="author-title">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<?php echo get_the_author(); ?>
				</a>
			</h4>
			<?php the_author_meta( 'description' ); ?>
		</div>
	</div>
</div>