<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}

$args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_post
);

$query = new WP_Query($args);
if($query->have_posts()):
?>
<div class="post-widget media-post-layout widget-content">
<ul class="posts-list">
<?php
	while($query->have_posts()):$query->the_post();
?>
	<li>
		<article class="post post-list">

		    <div class="entry-content media">

		        <?php
		        if ( has_post_thumbnail() ) {
		            ?>
		              <div class="media-left">
		                <?php echo trim(tumbas_post_thumbnail('100x100')); ?>
		              </div>
		            <?php
		        }
		        ?>
		        <div class="media-body">
		          <?php
		              if (get_the_title()) {
		              ?>
		                  <h4 class="entry-title">
		                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		                  </h4>
		              <?php
		          }
		          ?>
		          <div class="entry-content-inner clearfix">
		              <div class="entry-meta">
		                   <div class="entry-create">
		                      <span class="entry-date"><i class="fa fa-calendar-check-o"></i><?php the_time( 'M d, Y' ); ?></span>
		                  </div>
		              </div>
		          </div>
		        </div>
		    </div>
		</article>
	</li>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</ul>
</div>
<?php endif; ?>
