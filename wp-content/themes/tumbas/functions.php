<?php
/**
 * tumbas functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Tumbas
 * @since Tumbas 1.31
 */

define( 'TUMBAS_THEME_VERSION', '1.31' );
define( 'TUMBAS_DEMO_MODE', false );
define( 'TUMBAS_MIN_CSS_JS', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'tumbas_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Tumbas 1.0
 */
function tumbas_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on tumbas, use a find and replace
	 * to change 'tumbas' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tumbas', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'tumbas' ),
		'topmenu'  => esc_html__( 'Top Menu', 'tumbas' ),
		'my-account'  => esc_html__( 'My Account Menu', 'tumbas' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = tumbas_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tumbas_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( array( 'css/style-editor.css', tumbas_fonts_url() ) );
	
	tumbas_get_load_plugins();
}
endif; // tumbas_setup
add_action( 'after_setup_theme', 'tumbas_setup' );


/**
 * Load Google Front
 */
function tumbas_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $poppins = _x( 'on', 'poppins font: on or off', 'tumbas' );
    $montserrat    = _x( 'on', 'montserrat font: on or off', 'tumbas' );
 
    if ( 'off' !== $poppins || 'off' !== $montserrat || 'off' !== $playfair ) {
        $font_families = array();
 
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }
        if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function tumbas_full_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'tumbas-theme-fonts', tumbas_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'tumbas_full_fonts_url');

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Tumbas 1.1
 */
function tumbas_javascript_detection() {
	wp_add_inline_script( 'tumbas-typekit', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'tumbas_javascript_detection', 0 );

function tumbas_fontawesome_load() {
	$css_folder = tumbas_get_css_folder();
	$min = tumbas_get_asset_min();

	//load font awesome
	wp_enqueue_style( 'font-awesome', $css_folder . '/font-awesome'.$min.'.css', array(), '4.5.0' );
}
add_action( 'wp_enqueue_scripts', 'tumbas_fontawesome_load', 999999 );
/**
 * Enqueue scripts and styles.
 *
 * @since Tumbas 1.0
 */
function tumbas_scripts() {
	// Load our main stylesheet.
	$css_folder = tumbas_get_css_folder();
	$js_folder = tumbas_get_js_folder();
	$min = tumbas_get_asset_min();

	$css_path = $css_folder . '/template'.$min.'.css';
	wp_enqueue_style( 'tumbas-template', $css_path, array(), '3.2' );
	wp_enqueue_style( 'tumbas-style', get_template_directory_uri() . '/style.css', array(), '3.2' );
	

	//load font monia
	wp_enqueue_style( 'font-monia', $css_folder . '/font-monia'.$min.'.css', array(), '1.8.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate-style', $css_folder . '/animate'.$min.'.css', array(), '3.5.0' );

	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap-rtl'.$min.'.css', array(), '3.2.0' );
	}else{
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap'.$min.'.css', array(), '3.2.0' );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'perfect-scrollbar', $css_folder . '/perfect-scrollbar'.$min.'.css', array(), '2.3.2' );

	wp_enqueue_script( 'bootstrap', $js_folder . '/bootstrap'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_enqueue_script( 'owl-carousel', $js_folder . '/owl.carousel'.$min.'.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'perfect-scrollbar-jquery', $js_folder . '/perfect-scrollbar.jquery'.$min.'.js', array( 'jquery' ), '2.0.0', true );

	wp_enqueue_script( 'jquery-magnific-popup', $js_folder . '/magnific/jquery.magnific-popup'.$min.'.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'magnific-popup', $js_folder . '/magnific/magnific-popup'.$min.'.css', array(), '1.1.0' );
	
	// lazyload image
	wp_enqueue_script( 'jquery-unveil', $js_folder . '/jquery.unveil'.$min.'.js', array( 'jquery' ), '20150330', true );

	wp_register_script( 'tumbas-functions', $js_folder . '/functions'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'tumbas-functions', 'tumbas_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'tumbas-functions' );

	if ( tumbas_get_config('header_js') != "" ) {
		wp_add_inline_script( 'tumbas-header', tumbas_get_config('header_js') );
	}
}
add_action( 'wp_enqueue_scripts', 'tumbas_scripts', 100 );

function tumbas_footer_scripts() {
	if ( tumbas_get_config('footer_js') != "" ) {
		wp_add_inline_script( 'tumbas-footer', tumbas_get_config('footer_js') );
	}
}
add_action('wp_footer', 'tumbas_footer_scripts');
/**
 * Display descriptions in main navigation.
 *
 * @since Tumbas 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function tumbas_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'tumbas_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Tumbas 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function tumbas_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'tumbas_search_form_modify' );

/**
 * Function for remove srcset (WP4.4)
 *
 */
function tumbas_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'tumbas_disable_srcset' );

/**
 * Function get opt_name
 *
 */
function tumbas_get_opt_name() {
	return 'tumbas_theme_options';
}
add_filter( 'apus_themer_get_opt_name', 'tumbas_get_opt_name' );

function tumbas_register_demo_mode() {
	if ( defined('TUMBAS_DEMO_MODE') && TUMBAS_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_themer_register_demo_mode', 'tumbas_register_demo_mode' );

function tumbas_get_demo_preset() {
	$preset = '';
    if ( defined('TUMBAS_DEMO_MODE') && TUMBAS_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_themer_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_themer_preset_default' );
        }
    }
    return $preset;
}

function tumbas_get_config($name, $default = '') {
	global $tumbas_options;
    if ( isset($tumbas_options[$name]) ) {
        return $tumbas_options[$name];
    }
    return $default;
}

function tumbas_get_global_config($name, $default = '') {
	$options = get_option( 'tumbas_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function tumbas_get_image_lazy_loading() {
	return tumbas_get_config('image_lazy_loading');
}

add_filter( 'apus_themer_get_image_lazy_loading', 'tumbas_get_image_lazy_loading');

function tumbas_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'tumbas' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'tumbas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact us Topbar', 'tumbas' ),
		'id'            => 'contact-topbar',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'tumbas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog left sidebar', 'tumbas' ),
		'id'            => 'blog-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'tumbas' ),
		'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog right sidebar', 'tumbas' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'tumbas' ),
		'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product left sidebar', 'tumbas' ),
		'id'            => 'product-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'tumbas' ),
		'before_widget' => '<aside id="%1$s" class="widget sidebar-v2 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product right sidebar', 'tumbas' ),
		'id'            => 'product-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'tumbas' ),
		'before_widget' => '<aside id="%1$s" class="widget sidebar-v2 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Demo sidebar', 'tumbas' ),
		'id'            => 'demo-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'tumbas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'tumbas_register_sidebar' );

/*
 * Init widgets
 */
function tumbas_widgets_init($widgets) {
	$widgets = array_merge($widgets, array( 'woo-price-filter', 'woo-product-sorting', 'vertical_menu' ));
	return $widgets;
}
add_filter( 'apus_themer_register_widgets', 'tumbas_widgets_init' );

function tumbas_get_load_plugins() {
	// framework
	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Themer For Themes', 'tumbas' ),
        'slug'                     => 'apus-themer',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/apus-themer.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Cmb2', 'tumbas' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	));
	
	$plugins[] =(array(
		'name'                     => esc_html__('King Composer - Page Builder', 'tumbas'),
	    'slug'                     => 'kingcomposer',
	    'required'                 => true,
	    'source'				   => get_template_directory() . '/inc/plugins/kingcomposer.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Revolution Slider', 'tumbas' ),
        'slug'                     => 'revslider',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	));

	// for woocommerce
	$plugins[] =(array(
		'name'                     => esc_html__( 'WooCommerce', 'tumbas' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	));
	
	// for other plugins
	$plugins[] =(array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'tumbas' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Contact Form 7', 'tumbas' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Tumbas', 'tumbas' ),
        'slug'                     => 'apus-tumbas',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/apus-tumbas.zip'
	));
	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';


if ( defined( 'APUS_THEMER_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'TUMBAS_REDUX_THEMER_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	require get_template_directory() . '/inc/vendors/cmb2/product.php';
	define( 'TUMBAS_CMB2_ACTIVED', true );
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	require get_template_directory() . '/inc/vendors/woocommerce/woo-custom.php';
	define( 'TUMBAS_WOOCOMMERCE_ACTIVED', true );
}
if( in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/kingcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/kingcomposer/maps.php';
	define( 'TUMBAS_KINGCOMPOSER_ACTIVED', true );
}
if( in_array( 'apus-themer/apus-themer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/widgets/popup_newsletter.php';
}
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';
//Textos traducidos a medida
add_filter(  'gettext',  'wps_translate_words_array'  );
add_filter(  'ngettext',  'wps_translate_words_array'  );
function wps_translate_words_array( $translated ) {
     $words = array(
                        // 'palabra a traducir' = > 'traducción'
                        'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.' => 'No hay opciones de envío disponibles. Asegúrese de haber ingresado su dirección correctamente o contáctenos al correo ventas@f3c.cl si necesita ayuda.',
		   'Search' => 'Buscar',
		 		   'My Account' => 'INICIAR SESIÓN',
		 		   'Your Cart' => 'Tu Carro',
		 		   'Checkout' => 'Pasar a pago',
		 		   'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our' => 'Sus datos personales se utilizarán para respaldar su experiencia en este sitio web, para administrar el acceso a su cuenta y para otros fines descritos en nuestra',
                    );
     $translated = str_ireplace(  array_keys($words),  $words,  $translated );
     return $translated;
}
/** Cambiar estado obligatorio-opcional campos de facturación
* true = obligatorio
* false = opcional
*/
add_filter('woocommerce_billing_fields', 'force_billing_fields', 1000, 1);
function force_billing_fields($fields) {
$fields['billing_wooccm10']['required'] = true; //Ciudad
$fields['billing_city']['required'] = true; //Comuna
$address_fields['city']['required'] = true; //Ciudad
$address_fields['state']['required'] = true; //Provincia
return $fields;
}
add_filter( 'woocommerce_defer_transactional_emails', '__return_false' );

/** Cambiar frases
*/
add_filter('gettext',  'translate_text');
add_filter('ngettext',  'translate_text');
 
function translate_text($translated) {
     $translated = str_ireplace('Your cart',  'Tu carro',  $translated);
     return $translated;
}
/* Oculta productos sin imagen destacada */
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );
function custom_pre_get_posts_query( $query ) {
    $query->set( 'meta_query', array( array(
       'key' => '_thumbnail_id',
       'value' => '0',
       'compare' => '>'
    )));
}

class Tumbas_Custom_Mobile_Menu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target)     ? $item->target     : '';
        $atts['rel']    = ! empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = ! empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        
        if ($args->walker->has_children) {
            $item_output .= '<span class="submenu-toggle"><i class="fa fa-angle-down"></i></span>';
        }

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

function register_my_menus() {
  register_nav_menus(
    array(
      'menu-mobil' => __( 'Menu-Mobil' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

