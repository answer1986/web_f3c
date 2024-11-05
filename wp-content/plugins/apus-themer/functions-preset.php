<?php
/**
 * functions preset for apus themer
 *
 * @package    apus-themer
 * @author     Team Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Themer
 */


function apus_themer_init_redux() {

    add_action( 'apus_themer_preset', 'apus_themer_redux_preset' );
    add_action( 'admin_enqueue_scripts', 'apus_themer_redux_scripts' );

    add_action( 'wp_ajax_apus_themer_new_preset', 'apus_themer_redux_save_new_preset' );
    add_action( 'wp_ajax_nopriv_apus_themer_new_preset', 'apus_themer_redux_save_new_preset' );

    add_action( 'wp_ajax_apus_themer_set_default_preset', 'apus_themer_redux_set_default_preset' );
    add_action( 'wp_ajax_nopriv_apus_themer_set_default_preset', 'apus_themer_redux_set_default_preset' );

    add_action( 'wp_ajax_apus_themer_delete_preset', 'apus_themer_redux_delete_preset' );
    add_action( 'wp_ajax_nopriv_apus_themer_delete_preset', 'apus_themer_redux_delete_preset' );
    
    add_action( 'wp_ajax_apus_themer_duplicate_preset', 'apus_themer_redux_duplicate_preset' );
    add_action( 'wp_ajax_nopriv_apus_themer_duplicate_preset', 'apus_themer_redux_duplicate_preset' );
}

function apus_themer_redux_scripts() {
    wp_enqueue_script( 'apus-themer-admin', APUS_THEMER_URL . 'assets/admin.js', array( 'jquery'  ), '20131022', true );
    wp_enqueue_style( 'apus-themer-admin', APUS_THEMER_URL . 'assets/backend.css' );
}

function apus_themer_redux_duplicate_preset() {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $preset = isset($_POST['default_preset']) ? $_POST['default_preset'] : '';
    $opt_name = apply_filters( 'apus_themer_get_opt_name' );
    $preset_option = get_option( $opt_name.$preset );
    
    $key = strtotime('now');
    if ( !empty($title) ) {
        $presets = get_option( 'apus_themer_presets' );
        $key = strtotime('now');
        $presets[$key] = $title;
        update_option( 'apus_themer_presets', $presets );
        update_option( $opt_name.$key, $preset_option );
        update_option( 'apus_themer_preset_default', $key );
    }
}

function apus_themer_redux_delete_preset() {
    $preset = isset($_POST['default_preset']) ? $_POST['default_preset'] : '';
    $default_preset = get_option( 'apus_themer_preset_default' );

    if ( !empty($preset) ) {
        $presets = get_option( 'apus_themer_presets' );
        if ( isset($presets[$preset]) ) {
            unset($presets[$preset]);
        }
        update_option( 'apus_themer_presets', $presets );
        if ($preset == $default_preset) {
            update_option( 'apus_themer_preset_default', '' );
        }
    }
}

function apus_themer_redux_set_default_preset() {
    $default_preset = isset($_POST['default_preset']) ? $_POST['default_preset'] : '';
    update_option( 'apus_themer_preset_default', $default_preset );
    die();
}

function apus_themer_redux_save_new_preset() {
    $new_preset = isset($_POST['new_preset']) ? $_POST['new_preset'] : '';

    if ( !empty($new_preset) ) {
        $presets = get_option( 'apus_themer_presets' );
        $key = strtotime('now');
        $presets[$key] = $new_preset;
        update_option( 'apus_themer_presets', $presets );
        update_option( 'apus_themer_preset_default', $key );
    }
    die();
}

function apus_themer_redux_preset() {
    // preset
    $presets = get_option( 'apus_themer_presets' );

    $default_preset = get_option( 'apus_themer_preset_default' );
    if ( empty($presets) || !is_array($presets) ) {
        $presets = array();
    }
    ?>
    <section class="preset-section">
        <h3><?php esc_html_e( 'Preset Manager', 'apus-themer' ); ?></h3>
        
        <div class="preset-content">
            <p class="note"><?php esc_html_e( 'Current preset default: ', 'apus-themer' ); ?> <strong><?php echo (isset($presets[$default_preset]) ? $presets[$default_preset] : 'Default'); ?></strong></p>

            <label><?php esc_html_e( 'Create a new preset', 'apus-themer' ); ?></label>
            <div><input type="text" name="new_preset" class="new_preset"> <button type="button" name="submit_new_preset" class="submit-new-preset button"><?php esc_html_e( 'Add new', 'apus-themer' ); ?></button></div>
        
            
            <div class="set_default">
                <label><?php esc_html_e( 'Set default preset', 'apus-themer' ); ?></label>
                <br>
                <select class="set_default_preset" name="default_preset">
                    <option value=""><?php esc_html_e( 'Default', 'apus-themer' ); ?></option>
                    <?php foreach ($presets as $key => $preset) { ?>
                        <option value="<?php echo $key; ?>"<?php echo $key == $default_preset ? 'selected="selected"' : ''; ?>><?php echo $preset; ?></option>
                    <?php } ?>
                </select>
                <button type="button" name="submit_preset" class="submit-preset button"><?php esc_html_e( 'Set Default', 'apus-themer' ); ?></button>
                <button type="button" name="submit_duplicate_preset" class="submit-duplicate-preset button"><?php esc_html_e( 'Duplicate', 'apus-themer' ); ?></button>
                <button type="button" name="submit_delete_preset" class="submit-delete-preset button"><?php esc_html_e( 'Delete Preset', 'apus-themer' ); ?></button>
                <div class="preset_des"><?php esc_html_e( 'Key:', 'apus-themer' ); ?> <span class="key"><?php echo $default_preset; ?></span></div>
            </div>
            
        </div>
        <br>
        <br>
    </section>
    <?php
}