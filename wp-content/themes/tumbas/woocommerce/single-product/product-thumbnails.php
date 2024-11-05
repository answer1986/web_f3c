<?php
/**
 * Single Product Thumbnails
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$id = rand();
global $post, $product, $woocommerce;

$images = $product->get_gallery_image_ids();
$attachment_ids = array();
if ( in_array(get_post_thumbnail_id(), $images) ) {
    $attachment_ids = $images;
} elseif ( get_post_thumbnail_id() || $images ) {
    $attachment_ids = array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
}

if ( $attachment_ids ) {
    $loop       = 0;
    $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 6 );
    ?>
    <div class="thumbnails-image">
        <div class="lite-carousel-play">
            <a class="prev carousel-md" href="#">
                <span class="fa fa-angle-up"></span>
            </a>
            <div class="vertical-carousel" data-carousel="lite" data-visible="<?php echo esc_attr($columns); ?>" data-number="<?php echo count($attachment_ids); ?>">
                <ul>
                <?php

                foreach ( $attachment_ids as $attachment_id ) {
                    $classes = array( 'thumb-link' );

                    $image_single_link = wp_get_attachment_image_src( $attachment_id, 'shop_single' );
                    $image_full_link = wp_get_attachment_image_src( $attachment_id, 'full' );
                    $image_src = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
                    $image_link = isset($image_src[0]) ? $image_src[0] : '';
                    if ( ! $image_link )
                        continue;

                    $image_title    = esc_attr( get_the_title( $attachment_id ) );
                    
                    $image_class = esc_attr( implode( ' ', $classes ) );
                    if (tumbas_get_config('image_lazy_loading')) {
                        $placeholder_image = tumbas_create_placeholder(array($image_src[1],$image_src[2]));
                        $image = '<img src="'.esc_url($placeholder_image).'" data-src="'.esc_url($image_link).'" class="attachment-shop_thumbnail size-shop_thumbnail unveil-image" title="'.esc_attr($image_title).'" alt="'.esc_attr($image_title).'">';
                    } else {
                        $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                            'title' => $image_title,
                            'alt'   => $image_title,
                            'data-zoom-image'=> $image_link
                        ) );
                    }
                    echo '<li><div class="image-wrapper">';
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" data-image="%s" class="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_full_link[0], $image_single_link[0], $image_class, $image ), $attachment_id, $post->ID, $image_class );
                    echo '</div></li>';
                    $loop++;
                }

                ?>
                </ul>
            </div>
            <a class="next carousel-md" href="#">
                <span class="fa fa-angle-down"></span>
            </a>
        </div>
    </div>
    <?php
}
