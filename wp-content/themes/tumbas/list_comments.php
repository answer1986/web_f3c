<?php

$GLOBALS['comment'] = $comment;
$add_below = '';

?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<div class="the-comment media">
		<div class="avatar media-left">
			<?php echo get_avatar($comment, 92); ?>
		</div>

		<div class="comment-box media-body">
			<div class="comment-author meta">
				<strong><?php echo get_comment_author_link() ?></strong>
				<span class="date"><?php printf(esc_html__('%1$s', 'tumbas'), get_comment_date()) ?></span>
				<?php edit_comment_link(esc_html__(' - Edit', 'tumbas'),'  ','') ?>
			</div>
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html_e('Your comment is awaiting moderation.', 'tumbas') ?></em>
				<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
			<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__(' Reply', 'tumbas'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	</div>