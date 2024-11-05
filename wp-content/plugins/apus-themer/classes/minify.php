<?php
/**
 * Minify JS, CSS
 *
 * @package    apus-themer
 * @author     Team Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Themer
 */

include( APUS_THEMER_DIR . '/libs/minify/JSMin.php' );
include( APUS_THEMER_DIR . '/libs/minify/CSSmin.php' );

class Apus_Themer_Minify {
	
	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'run' ) );
	}

	public static function run() {
		if ( isset($_GET['apus-minify']) && $_GET['apus-minify'] ) {
			$css_folder = apply_filters( 'apus-themer-css-folder', get_template_directory() . '/css' );
			$css_folder_min = apply_filters( 'apus-themer-css-folder-min', get_template_directory() . '/css' );

			$js_folder = apply_filters( 'apus-themer-js-folder', get_template_directory() . '/js/dev' );
			$js_folder_min = apply_filters( 'apus-themer-js-folder-min', get_template_directory() . '/js' );

			self::run_all_sub_folder( $css_folder, $css_folder_min );
			self::run_all_sub_folder( $js_folder, $js_folder_min );
		}
	}

	public static function compress($folder_path, $save_path ) {

		$cssobj = new CSSmin();
		$css_files = glob( $folder_path . '/*.css' );

		$return = '';
		foreach( $css_files as $w ) {
			$paths = explode('/', $w);
			$last = array_pop($paths);
			$t = str_replace( ".css", '', basename($w) );
			if ( !self::is_min_file( basename($w) ) ) {
				$output = $cssobj->run(file_get_contents($w), false);
				$return .= file_put_contents( $save_path . '/' . $t . '.min.css', $output);
			}
		}
		// minify js
		$js_files = glob( $folder_path . '/*.js' );
		foreach( $js_files as $w ) {
			$paths = explode('/', $w);
			$last = array_pop($paths);

			$t = str_replace( ".js", '', basename($w) );
			if ( !self::is_min_file( basename($w) ) ) {
				$output = JSMin::minify(file_get_contents($w), false);
				$return .= file_put_contents( $save_path . '/' . $t . '.min.js', $output);
			}
		}
	}

	public static function run_all_sub_folder($folder_path, $save_path) {
		if ( is_dir($folder_path) ) {
			if (!is_dir($save_path)) {
				mkdir($save_path, 0777);
			}
			self::compress($folder_path, $save_path);
			$directories = glob($folder_path . '/*' , GLOB_ONLYDIR);
			if (!empty($directories)) {
				foreach ($directories as $directory) {
					$paths = explode('/', $directory);
					$last = array_pop($paths);
					if ($last != 'min') {
						$name = basename($directory);
						self::run_all_sub_folder($directory, $save_path . '/' . $name);
					}
				}
			}

		}
	}

	public static function is_min_file($file_name) {
		if ( strpos($file_name, '.min') !== false )
	    	return true;
	    return false;
	}
}

Apus_Themer_Minify::init();
