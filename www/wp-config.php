<?php
// Load our environment variables from the .env file:
// Import the Composer Autoloader to make the SDK classes accessible:
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Load our environment variables from the .env file localhost
    (Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']))->load();
} else {
    // Load our environment variables from the .env file for prod
    (Dotenv\Dotenv::createImmutable('/var/www/vhosts/sanborn.dev.briansenesac.com/httpdocs'))->load();
}

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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', $_ENV['DB_NAME'] );

/** Database username */
define( 'DB_USER', $_ENV['DB_USER'] );

/** Database password */
define( 'DB_PASSWORD', $_ENV['DB_PASSWORD'] );

/** Database hostname */
define( 'DB_HOST', $_ENV['DB_HOST'] );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', $_ENV['DB_CHARSET'] );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', $_ENV['DB_COLLATE'] );

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
define( 'AUTH_KEY',         'L2,AklYWr`<WXu[c0su(R+F43X$@)h*5]Xg1jzA+zWX9&2$EOp#{6$$DiyBSWQRF' );
define( 'SECURE_AUTH_KEY',  '75cP%vLg|,+@D!}29]J5/tI<DI#{bA6_gTp}.}r+rue>nZ1_0sr$>v#y,hQhtgvQ' );
define( 'LOGGED_IN_KEY',    '-t_9B#v9@uz` 9XDt`$RVm?s)l)O/FQln9*!xC->6?Hh.<{8E,ejjmdsg,TEkq2/' );
define( 'NONCE_KEY',        '+SKXmR+9(tp}*s>c]=(bh,HF<#U71%<E3!e>7.=ndy?mOK!BLr%b+5e~%9:TnIYg' );
define( 'AUTH_SALT',        'sb9^9k<s}IR`k`@b}u=odS$;632C.WsW|Bt,6P41Y9N$&SLyq$u-|3yn59slv60w' );
define( 'SECURE_AUTH_SALT', 'rT-{*UlP<3jZ fJ:)j4KR0&Ah*_DQDc$d=F9|na?PV]y>+ VGov`0;A`qpm.x74#' );
define( 'LOGGED_IN_SALT',   '%]+p[ndQ!Z7g&wm^HvU=(^dJ25,0SA$L4g:R<DIYOZm4+?TJE5Pw4GytuN2(:|k`' );
define( 'NONCE_SALT',       'y?SVw0*6uGv)F3t#2g.y)WBd<~3h.TVF@b<h&olMP4Zp0STLS9oB#Y = ;u[6r%U' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = $_ENV['DB_PREFIX'];

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

/* Add any custom values between this line and the "stop editing" line. */

define('CONCATENATE_SCRIPTS', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
