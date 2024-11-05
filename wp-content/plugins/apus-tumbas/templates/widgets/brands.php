<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}
?>

<div class="brands-widget widget-content">
    <?php
        $hide_empty = $instance['hide_empty'];
        $show_count = $instance['show_count'];

        $brands_list = get_terms( 'product_brand', array(
            'orderby'    => 'name',
            'order' => 'ASC',
            'hide_empty' => $hide_empty
        ));

        if ( !empty( $brands_list ) && !is_wp_error( $brands_list ) ){
            
            echo '<ul>';

            foreach ( $brands_list as $brand_item ) {
                echo '<li>';    
                
                if ($show_count) {
                    echo '<a href="'.get_term_link( $brand_item->slug, 'product_brand' ).'">'.$brand_item->name.'</a> <span class="count">('.$brand_item->count.')</span>';
                } else {
                    echo '<a href="'.get_term_link( $brand_item->slug, 'product_brand' ).'">'.$brand_item->name.'</a>';
                }
                
                echo '</li>';
            }

            echo '</ul>';
        } 

    ?>
</div>