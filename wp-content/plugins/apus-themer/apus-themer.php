<?php
/**
 * Apus Themer Plugin
 *
 * A simple, truly extensible and fully responsive options framework
 * for WordPress themes and plugins. Developed with WordPress coding
 * standards and PHP best practices in mind.
 *
 * Plugin Name:     Apus Themer
 * Plugin URI:      http://apusthemes.com
 * Description:     Apus themer for wordpress theme
 * Author:          Team ApusTheme
 * Author URI:      http://apusthemes.com
 * Version:         1.0
 * Text Domain:     apus-themer
 * License:         GPL3+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     languages
 */

define( 'APUS_THEMER_VERSION', '1.0');
define( 'APUS_THEMER_URL', plugin_dir_url( __FILE__ ) );
define( 'APUS_THEMER_DIR', plugin_dir_path( __FILE__ ) );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
 * Redux Framework
 *
 */
if ( !class_exists( 'ReduxFramework' ) && file_exists( APUS_THEMER_DIR . 'libs/redux/redux-core/framework.php' ) ) {
    require_once( APUS_THEMER_DIR . 'libs/redux/redux-core/framework.php' );
    define( 'APUS_THEMER_REDUX_ACTIVED', true );
} else {
	define( 'APUS_THEMER_REDUX_ACTIVED', true );
}
/**
 * Custom Post type
 *
 */
add_action( 'init', 'apus_themer_load_posttypes_setup', 1 );
/**
 * Import data sample
 *
 */
require APUS_THEMER_DIR . 'importer/import.php';
/**
 * functions
 *
 */
require APUS_THEMER_DIR . 'functions.php';
require APUS_THEMER_DIR . 'functions-preset.php';
/**
 * Widgets
 *
 */
require APUS_THEMER_DIR . 'classes/class-apus-widgets.php';
add_action( 'widgets_init',  'apus_themer_widget_init' );

require APUS_THEMER_DIR . 'classes/class-apus-megamenu.php';
//require APUS_THEMER_DIR . 'classes/minify.php';
require APUS_THEMER_DIR . 'classes/createplaceholder.php';
require APUS_THEMER_DIR . 'classes/class-apus-google-maps-styles.php';
/**
 * Vendors
 *
 */
if ( in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require APUS_THEMER_DIR . 'vendors/kingcomposer/functions.php';
}
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require APUS_THEMER_DIR . 'vendors/woocommerce/functions.php';
}
/**
 * Init
 *
 */
function apus_themer_init() {
	$demo_mode = apply_filters( 'apus_themer_register_demo_mode', false );
	if ( $demo_mode ) {
		apus_themer_init_redux();
	}
}
add_action( 'init', 'apus_themer_init' );

function apus_themer_script(){
	wp_enqueue_style( 'apus-themer-backend', APUS_THEMER_URL . 'assets/backend.css', array(), APUS_THEMER_VERSION );
}
add_action( 'admin_enqueue_scripts', 'apus_themer_script' );