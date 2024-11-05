<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-f3c' );

/** Database username */
define( 'DB_USER', 'inv.riquelme' );

/** Database password */
define( 'DB_PASSWORD', 'Aperfect0316.' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8cYLrNcRvsq{R7>sdFB<l$S|6TU.!B% (Am~_>OI=:,GD^OJB,oh2unEHmp}GSje' );
define( 'SECURE_AUTH_KEY',  '}+c?]KCFY$!rl)bn!R6wb;J<;HA;&DD4**B.w6~4b~Z1j|%rE$hXDY$TxK_v+j)v' );
define( 'LOGGED_IN_KEY',    'Ga>=>Og(;xZjiR{5[Yr^Oc_${Wtd{|^(m;(+*PfI6WmdZR$>su)x[g|<lncE& 9 ' );
define( 'NONCE_KEY',        'Pt?W#E/fzR}U6Xh/0telGjI@}8+Xo|(:QedOuL8_H0},WN`O9F<zCMYTLi$YKhnh' );
define( 'AUTH_SALT',        'Zj~_Jn9.52d@ 8&yd`-rQg!m-8I<v]<~Ae0y+3`#09]q/nQI:+u^g@f7fZwJ*t]%' );
define( 'SECURE_AUTH_SALT', 'NE@$8g|WC-}S/O!X:cYNX8w>Z@3(I$[a$?|awlc&^j<rB]]h^/l-x{8:Y>76S@DQ' );
define( 'LOGGED_IN_SALT',   'G Bn3a0AE!|[ACF-0G9 %|%(uUC),VyjF*d`#2DqOX| ?eDxedR>fT9Jw_vF.`e0' );
define( 'NONCE_SALT',       'dHV:LA2U?QNF*?ZaPDU/dy>&`J.XpCb/|&+xBbbm}IcPCYkhhw!K<S*;?Uf1;?I@' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_HOME', 'http://localhost:8888/wordpress_f3c');
define('WP_SITEURL', 'http://localhost:8888/wordpress_f3c');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
