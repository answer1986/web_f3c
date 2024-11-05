<?php
/**
 * functions
 *
 * @package    apus-tumbas
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * batch including all files in a path.
 *
 * @param String $path : PATH_DIR/*.php or PATH_DIR with $ifiles not empty
 */
function apustumbas_includes( $path, $ifiles=array() ){

    if ( !empty($ifiles) ){
         foreach( $ifiles as $key => $file ){
            $file  = $path.'/'.$file; 
            if(is_file($file)){
                require($file);
            }
         }   
    } else {
        $files = glob($path);
        foreach ($files as $key => $file) {
            if(is_file($file)){
                require($file);
            }
        }
    }
}

function apustumbas_get_widget_locate( $name, $plugin_dir = APUSTUMBAS_PLUGIN_DIR ) {
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