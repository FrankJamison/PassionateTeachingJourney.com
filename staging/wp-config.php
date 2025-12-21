<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u942215055_mnvxe');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', '127.0.0.1');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY', 'ex0o36+^lVj(R!hd]W}=5%U|Zi}17Eg#p@(/yC.Am]T;JbxzWpm!)-Xcv#P:fHMk');
define('SECURE_AUTH_KEY', '$#w4nJ*l9)idO`awm3h_w;Wm]yf/X>T%RU|ou44[6[k#TFAvU!:)>wona~][O:H%');
define('LOGGED_IN_KEY', 'lMcB_&,^7;T]qbU6QCkNXX-!8HR2`GfRQ:3&&/s|2QuO_6^k$+)^;x2tLEQc%lj^');
define('NONCE_KEY', '*DhxrMO;fE8uGJw*v(9|giIe6<okKfxPP-d!oA@EAKE@=g}4q07ftI*vD:@P],-:');
define('AUTH_SALT', ',5r+}=d:a2HFX1OhoH_ zNp*pG{ 5X+Ct^f9?wP[S #]Y!@`vL,6C0M2q(B6 V$N');
define('SECURE_AUTH_SALT', '/diu-iv|P}(Q,z4u8u}RjR9:i$zUb::4R1N{jw`WNMKed{AbTD9wV~nr!Yyk:D.F');
define('LOGGED_IN_SALT', 'Th0tT; 68~2X[;OQ+L>oEmn {A%yb;bNC#!LaD8RM^u9-t/C(?LiAfg9.bmAogZL');
define('NONCE_SALT', '[.XI|J8;LK*Z{=X|}eIg<BxA*%.+}M8%$4y=SEVDZ<|TC4>UqE1/;9(#JHdNeA<^');
define('WP_CACHE_KEY_SALT', 'r`IC)n=Co^MJp_c??Vdopj#Kf}Olhw=?w_Po1(?#w5}7y@,4gkfM&>QI(eN6adhJ');


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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);


/* Add any custom values between this line and the "stop editing" line. */



define('FS_METHOD', 'direct');
define('WP_AUTO_UPDATE_CORE', 'minor');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
