<?php

$atts  = array_merge( array(
	'latitude' => '',
	'longitude' => '',
	'advanced' => '',
	'marker_icon' => '',
	'map_height' => '',
	'map_zoom' => '',
	'map_style' => '',
	'map_key' => ''
), $atts);
extract( $atts );

if ( $latitude && $longitude ):

	wp_enqueue_script('gmap-api', '//maps.google.com/maps/api/js?sensor=true&amp;key='.$map_key);
	wp_enqueue_script( 'google-script', APUS_THEMER_URL.'/assets/front/google-script.js', array( 'jquery', 'gmap-api' ) );

	$data_marker = '';
	if ( $advanced == 'yes' && $marker_icon ) {
		$img = wp_get_attachment_image_src($marker_icon,'full');
		if (isset($img[0]) && $img[0]) {
			$data_marker = 'data-marker_icon="'.esc_url($img[0]).'"';
		}
	}
	$style = '';
	if ($map_style) {
		$style = Apus_Google_Maps_Styles::get_style($map_style);
	}
	$css = '';
	if ($map_height) {
		$css = 'style="height: '.esc_attr($map_height).'px"';
	}
	$key = apus_themer_random_key();
?>
	<div class="widget widget-google-map">
		<div id="widget-google-map<?php echo esc_attr($key); ?>" class="google-map-wrapper" <?php echo trim($css); ?> data-latitude="<?php echo esc_attr($latitude); ?>"
			data-longitude="<?php echo esc_attr($longitude); ?>"
			<?php echo trim($data_marker); ?> data-zoom="<?php echo esc_attr($map_zoom); ?>" data-style="<?php echo esc_attr($style); ?>"></div>
	</div>

<?php endif; ?>