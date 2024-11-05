<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>

<div class="apus-images images-swipe">
  
  <div class="main-image-carousel-wrapper single-img p-relative">
    
    <?php woocommerce_show_product_loop_sale_flash(); ?>
    <?php
      $images = $product->get_gallery_image_ids();
      $attachment_ids = array();
      if ( in_array(get_post_thumbnail_id(), $images) ) {
        $attachment_ids = $images;
      } elseif ( get_post_thumbnail_id() || $images ) {
        $attachment_ids = array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
      }
      if ( $attachment_ids ) {
        ?>
          <div class="owl-carousel main-image-carousel" data-items="1" data-carousel="owl" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="false">
            <?php
                $image_sizes = get_option('shop_single_image_size');
                $data_med_size = $image_sizes['width'] . 'x'. $image_sizes['height'];
                foreach ( $attachment_ids as $attachment_id ) {
                    $classes = array( 'thumb-link' );

                    $image_full = wp_get_attachment_image_src( $attachment_id, 'full' );
                    $image_full_link = isset($image_full[0]) ? $image_full[0] : '';

                    if (!empty($image_full) && isset($image_full[1]) && isset($image_full[2]) ) {
                      $data_size = $image_full[1] . 'x' . $image_full[2];
                    } else {
                      $data_size = $data_med_size;
                    }

                    $image_link = wp_get_attachment_image_src( $attachment_id, 'shop_single' );
                    $image_link = isset($image_link[0]) ? $image_link[0] : '';

                    if ( ! $image_link )
                        continue;

                    $image_title = esc_attr( get_the_title( $attachment_id ) );

                    $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $attr = array(
                        'title' => $image_title,
                        'alt'   => $image_title
                        ) );

                    $class = get_post_thumbnail_id() == $attachment_id ? 'active apus_swipe_image_item' : 'apus_swipe_image_item';
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" data-med="%s" data-size="%s" data-med-size="%s" class="%s">%s</a>', $image_link, $image_full_link, $data_size, $data_med_size, $class, $image ), $attachment_id, $post->ID );
                    
                }
            ?>
          </div>
          <?php
      } else {
        ?>
        <div class="owl-carousel main-image-carousel" data-items="1" data-carousel="owl" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="false">
          <?php
            $image_sizes = get_option('shop_single_image_size');
            $image_link = woocommerce_placeholder_img_src();
            $data_med_size = $image_sizes['width'] . 'x'. $image_sizes['height'];
            $class = get_post_thumbnail_id() == $attachment_id ? 'active apus_swipe_image_item' : 'apus_swipe_image_item';

            $image .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'tumbas').'" />';

            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" data-med="%s" data-size="%s" data-med-size="%s" class="%s">%s</a>', $image_link, $image_link, $data_med_size, $data_med_size, $class, $image ), $attachment_id, $post->ID );
          ?>
        </div>
        <?php
      }
    ?>
    <!-- video -->
    <?php
      $video = get_post_meta( $post->ID, 'apus_product_review_video', true );

      if (!empty($video)) {
        ?>
        <div class="video">
          <a href="<?php echo esc_url($video); ?>" class="popup-video">
            <i class="mn-icon-537"></i>
            <span><?php echo esc_html__('Watch video', 'tumbas'); ?></span>
          </a>
        </div>
        <?php
      }
    ?>
  </div>
  <div class="thumbnails-img">
    <?php do_action( 'woocommerce_product_thumbnails' ); ?>
  </div>
</div>