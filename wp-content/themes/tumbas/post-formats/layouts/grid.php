<?php
	$columns = tumbas_get_config('blog_columns', 1);
	$bcol = floor( 12 / $columns );
	$class = 'col-md-'.$bcol.($columns > 1 ? ' col-sm-6' : '');
?>
<div class="layout-blog style-grid">
    <div class="row">
        <?php $count = 1; while ( have_posts() ) : the_post(); ?>
            <div class="<?php echo esc_attr($class); ?> <?php echo ($count%$columns == 1) ? ' md-clearfix':''; ?> <?php echo ($columns > 1 && $count%2 == 1) ? ' sm-clearfix' : ''; ?>">
                <?php get_template_part( 'post-formats/content', get_post_format() ); ?>
            </div>
        <?php $count++; endwhile; ?>
    </div>
</div>
