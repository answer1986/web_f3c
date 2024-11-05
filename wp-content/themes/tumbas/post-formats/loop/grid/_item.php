<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : tumbas_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 15;

    $categories = get_the_category();
    
?>

<article <?php post_class('post post-grid'); ?>>
    <?php
    $thumb = tumbas_display_post_thumb($thumbsize);
    echo trim($thumb);
    ?>
    <div class="entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <div class="entry-meta">
            <div class="info">
                <?php
                if ( ! empty( $categories ) ) {
                ?>
                    <span class="categories">
                <?php
                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                ?>
                    </span>
                <?php
                    }
                ?>
                    
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>

            </div>
        </div>
        <div class="info-bottom">
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo tumbas_substring( get_the_content(), $nb_word, '...' ); ?></div>
            <?php } else { ?>
                <div class="entry-description"><?php echo tumbas_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
            <?php } ?>

            <div class="meta">
                <span class="date"><?php the_time( 'F , d Y' ); ?>  </span>
                <span class="more"><a href="<?php the_permalink(); ?>">more</a></span>
            </div>
        </div>
    </div>
</article>