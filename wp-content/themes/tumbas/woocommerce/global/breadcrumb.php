<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {
	
	echo trim($wrap_before);

	$back_link = '' ;
	echo '<ol class="apus-woocommerce-breadcrumb breadcrumb pull-left" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
	foreach ( $breadcrumb as $key => $crumb ) {

		echo trim($before);

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<li><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
			$back_link = '<a href="' . esc_url( $crumb[1] ) . '" class="back-link">' . esc_html__( 'Back To ', 'tumbas' ) . esc_html( $crumb[0] ) . '</a>' ;
		} else {
			echo '<li>'.esc_html( $crumb[0] ).'</li>';
		}

		echo trim($after);
	}
	echo '</ol>';
	echo trim($back_link);

	echo trim($wrap_after);
	
}
?>
