<?php
/**
 * Plugin Name: Apus Tumbas
 * Plugin URI: http://apusthemes.com/apus-tumbas/
 * Description: Apus Tumbas is a simple event plugin, allow you can manager event easy
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.1
 *
 * Text Domain: apus-tumbas
 * Domain Path: /languages/
 *
 * @package apus-tumbas
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusTumbas") ){
	
	final class ApusTumbas{

		private static $instance;

		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusTumbas ) ) {
				self::$instance = new ApusTumbas;
				self::$instance->setup_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 *
		 */
		public function setup_constants(){
			// Plugin version
			if ( ! defined( 'APUSTUMBAS_VERSION' ) ) {
				define( 'APUSTUMBAS_VERSION', '1.0.0' );
			}

			// Plugin Folder Path
			if ( ! defined( 'APUSTUMBAS_PLUGIN_DIR' ) ) {
				define( 'APUSTUMBAS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSTUMBAS_PLUGIN_URL' ) ) {
				define( 'APUSTUMBAS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSTUMBAS_PLUGIN_FILE' ) ) {
				define( 'APUSTUMBAS_PLUGIN_FILE', __FILE__ );
			}

			// Template Folder
			if ( ! defined( 'APUSTUMBAS_THEME_FILE' ) ) {
				define( 'APUSTUMBAS_THEME_FILE', get_template_directory() );
			}

			define( 'APUSTUMBAS_EVENT_PREFIX', 'apustumbas_event_' );
		}

		public function setup_cmb2_url() {
			return APUSTUMBAS_PLUGIN_URL . 'inc/vendors/cmb2/libraries';
		}

		public function includes() {
			/**
			 * Get the CMB2 bootstrap!
			 */
			if ( !class_exists('CMB2') && file_exists( APUSTUMBAS_PLUGIN_DIR . 'inc/vendors/cmb2/libraries/init.php' ) ) {
				require_once APUSTUMBAS_PLUGIN_DIR . 'inc/vendors/cmb2/libraries/init.php';
				//Customize CMB2 URL
				add_filter( 'cmb2_meta_box_url', array($this, 'setup_cmb2_url') );
			}
			// cmb2 custom field
			if ( ! class_exists( 'Taxonomy_MetaData_CMB2' ) ) {
				require_once APUSTUMBAS_PLUGIN_DIR . 'inc/vendors/cmb2/taxonomy/Taxonomy_MetaData_CMB2.php';
			}

			require_once APUSTUMBAS_PLUGIN_DIR . 'inc/class-template-loader.php';
			require_once APUSTUMBAS_PLUGIN_DIR . 'inc/class-apus-widgets.php';
			require_once APUSTUMBAS_PLUGIN_DIR . 'inc/mixes-functions.php';
			
			apustumbas_includes( APUSTUMBAS_PLUGIN_DIR . 'inc/taxonomies/*.php' );

			add_action( 'widgets_init',  array( $this, 'widget_init' ) );
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusTumbas's languages directory
			$lang_dir = dirname( plugin_basename( APUSTUMBAS_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apustumbas_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-tumbas' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-tumbas', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apustumbas/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apustumbas folder
				load_textdomain( 'apus-tumbas', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apustumbas/languages/ folder
				load_textdomain( 'apus-tumbas', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-tumbas', false, $lang_dir );
			}
		}

		public function widget_init() {
			apustumbas_includes( APUSTUMBAS_PLUGIN_DIR . 'inc/widgets/*.php' );
		}
	}
}

function ApusTumbas() {
	return ApusTumbas::getInstance();
}

ApusTumbas();
