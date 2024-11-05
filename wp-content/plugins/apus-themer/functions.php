<?php
/**
 * functions for apus themer
 *
 * @package    apus-themer
 * @author     Team Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Themer
 */

function apus_themer_create_placeholder($size) {
	return "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 ".$size[0]." ".$size[1]."'%2F%3E";
}

function apus_themer_display_image($img) {
	if ( !empty($img) && isset($img[0]) ) {
		$image_lazy_loading = apply_filters('apus_themer_get_image_lazy_loading', true);
		if ($image_lazy_loading) {
			$placeholder_image = apus_themer_create_placeholder(array($img[1], $img[2]));
			?>
			<div class="image-wrapper">
				<img src="<?php echo trim($placeholder_image); ?>" data-src="<?php echo esc_url_raw($img[0]); ?>" alt="" class="unveil-image">
			</div>
			<?php
		} else {
			?>
			<div class="image-wrapper">
				<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
			</div>
			<?php
		}
	}
}

function apus_themer_load_posttypes_setup(){
	$post_types = apply_filters( 'apus_themer_load_posttypes_setup', array('footer', 'megamenu') );
	if ( !empty($post_types) ) {
		foreach ($post_types as $post_type) {
			if ( file_exists( APUS_THEMER_DIR . 'classes/post-types/'.$post_type.'.php' ) ) {
				require APUS_THEMER_DIR . 'classes/post-types/'.$post_type.'.php';
			}
		}
	}
}

function apus_themer_widget_init() {
	$widgets = apply_filters( 'apus_themer_register_widgets', array('custom_menu', 'search', 'single_image', 'recent_post', 'instagram') );
	if ( !empty($widgets) ) {
		foreach ($widgets as $widget) {
			if ( file_exists( APUS_THEMER_DIR . 'classes/widgets/'.$widget.'.php' ) ) {
				require APUS_THEMER_DIR . 'classes/widgets/'.$widget.'.php';
			}
		}
	}
}

function apus_themer_autocomplete_options_helper( $options ){
	$output = array();
   	$options = array_map('trim', explode(',', $options));
	foreach( $options as $option ){
		$tmp = explode( ":", $option );
		$output[$tmp[0]] = $tmp[1];
	}
	return $output; 
}

function apus_themer_multiple_fields_to_array_helper( $string ) {
	$output = array();
	if ( !empty($string) ) {
	   	$output = array_map('trim', explode(',', $string));
   	}
	return $output;
}

function apus_themer_get_widget_locate( $name, $plugin_dir = APUS_THEMER_DIR ) {
	$template = '';
	
	// Child theme
	if ( ! $template && ! empty( $name ) && file_exists( get_stylesheet_directory() . "/widgets/{$name}" ) ) {
		$template = get_stylesheet_directory() . "/widgets/{$name}";
	}

	// Original theme
	if ( ! $template && ! empty( $name ) && file_exists( get_template_directory() . "/widgets/{$name}" ) ) {
		$template = get_template_directory() . "/widgets/{$name}";
	}

	// Plugin
	if ( ! $template && ! empty( $name ) && file_exists( $plugin_dir . "/templates/widgets/{$name}" ) ) {
		$template = $plugin_dir . "/templates/widgets/{$name}";
	}

	// Nothing found
	if ( empty( $template ) ) {
		throw new Exception( "Template /templates/widgets/{$name} in plugin dir {$plugin_dir} not found." );
	}

	return $template;
}

function apus_themer_random_key($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $return = '';
    for ($i = 0; $i < $length; $i++) {
        $return .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $return;
}

function apus_themer_substring($string, $limit, $afterlimit = '[...]') {
    if ( empty($string) ) {
    	return $string;
    }
   	$string = explode(' ', strip_tags( $string ), $limit);

    if (count($string) >= $limit) {
        array_pop($string);
        $string = implode(" ", $string) .' '. $afterlimit;
    } else {
        $string = implode(" ", $string);
    }
    $string = preg_replace('`[[^]]*]`','',$string);
    return strip_shortcodes( $string );
}