<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' );

$args = array('#customer_login', '#customer_register');
$action = isset($_COOKIE['tumbas_login_register']) && in_array($_COOKIE['tumbas_login_register'], $args) ? $_COOKIE['tumbas_login_register'] : '#customer_login';
?>



<div id="customer_login" class="register_login_wrapper <?php echo trim($action == '#customer_login' ? 'active' : ''); ?>">

		<h1><?php esc_html_e( 'Welcome Back', 'tumbas' ); ?></h1>
		<div class="description">
			<?php esc_html_e( 'Didn\'t have an account yet?', 'tumbas' ); ?>
			<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
				<a href="#customer_register" class="register-login-action"><?php esc_html_e( 'Register Here', 'tumbas' ); ?></a>
			<?php endif; ?>
		</div>
		<form method="post" class="login" role="form">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="form-group form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'tumbas' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</p>
			<p class="form-group form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'tumbas' ); ?> <span class="required">*</span></label>
				<input class="input-text form-control" type="password" name="password" id="password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-group form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<p for="rememberme" class="inline">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'tumbas' ); ?>
				</p>
				<input type="submit" class="button" name="login" value="<?php esc_html_e( 'Login', 'tumbas' ); ?>" />
			</p>
			<p class="form-group lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'tumbas' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div id="customer_register" class="register_login_wrapper <?php echo trim($action == '#customer_register' ? 'active' : ''); ?>">

	<h1><?php esc_html_e( 'Join With Us', 'tumbas' ); ?></h1>
	<div class="description">
		<?php esc_html_e( 'Already have an account?', 'tumbas' ); ?>
		<a href="#customer_login" class="register-login-action"><?php esc_html_e( 'Log In Here', 'tumbas' ); ?></a>
	</div>
	<form method="post" class="register widget" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

		<?php do_action( 'woocommerce_register_form_start' ); ?>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

			<p class="form-group form-row form-row-wide">
				<label for="reg_username"><?php esc_html_e( 'Username', 'tumbas' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</p>

		<?php endif; ?>

		<p class="form-group form-row form-row-wide">
			<label for="reg_email"><?php esc_html_e( 'Email address', 'tumbas' ); ?> <span class="required">*</span></label>
			<input type="email" class="input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
		</p>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

			<p class="form-group form-row form-row-wide">
				<label for="reg_password"><?php esc_html_e( 'Password', 'tumbas' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text form-control" name="password" id="reg_password" />
			</p>

		<?php else : ?>

			<p><?php esc_html_e( 'A password will be sent to your email address.', 'tumbas' ); ?></p>

		<?php endif; ?>

		<!-- Spam Trap -->
		<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'tumbas' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

		<?php do_action( 'woocommerce_register_form' ); ?>
		<?php do_action( 'register_form' ); ?>

		<p class="form-group form-row">
			<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
			<input type="submit" class="button" name="register" value="<?php esc_html_e( 'Register', 'tumbas' ); ?>" />
		</p>

		<?php do_action( 'woocommerce_register_form_end' ); ?>

	</form>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>