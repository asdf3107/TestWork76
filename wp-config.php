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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */
define('OPENWEATHER_API_KEY', 'bd5e378503939ddaee76f12ad7a97608');


// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp2' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '}DLW#%jj=B?7LruU^O1sQ_B@T#Alc~W3PQi.H0KcX;7UL}o*lNH<D6rPmq)1-5d_' );
define( 'SECURE_AUTH_KEY',  ';A>0D)VWNVoPkeZgOqj}02T||mxR =w4C[x8sR>&>o*8<.GfJ[hVNX#dc)0 w35;' );
define( 'LOGGED_IN_KEY',    'G2O^&(:pL~a)d!rykIjX~k.uE=8Aj5BBdCIWd|i0E9zPgh@Kbk`2D<w:v,bRUs?&' );
define( 'NONCE_KEY',        'DF`=tX2@v};dFhU l]9ABcU@E5Q?]m*y>fA]|U/QR,xlRFXq!H yyl:D-4C^${4n' );
define( 'AUTH_SALT',        'SOs#d0EG~cWI39Eao_L)%iyt,$=~BoD#lzq#v.1Q^~BqA(wYa|xsW#krhZv)##>0' );
define( 'SECURE_AUTH_SALT', 'YD4h`]9j#G88Z/}EB+]?|yUIHC%.i ,jK0#J:O<,)|$40+yUE+~91+Ztx{ :Vg:T' );
define( 'LOGGED_IN_SALT',   'L(%@3*L,. O&Y]]dW[?b/7LuIlD9CeUbfkiw&jF3]a$MG/t][(u4ev,B~B~4cMh4' );
define( 'NONCE_SALT',       '~^__7xJji`hLJg _QWJd<8A[pC8v1N-CG]Nr[W)5jz]]EV|<cM,_4l3-h}+@Rs.8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
