<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$specification = get_post_meta( $post->ID, 'apus_product_specification', true );
?>

<div class="specification">
	<?php echo trim($specification); ?>
</div>
