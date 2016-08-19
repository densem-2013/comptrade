<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'comptrade');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '777123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'k% 4vpYw><.R@.8xaQ9-G?E_#E^eC{W*eh/ck4<zlJZwwn4cc4@~tSm<7HRT}{9V');
define('SECURE_AUTH_KEY',  ']odtAqt?!UF*XXHn#~vM*nXe:heJ>9BVDXPB{)&}X,wEIp)_^$c1a93/KAO|bR!h');
define('LOGGED_IN_KEY',    's=UA:9.ic:862<I?CB9ry@vhC/M;_Bd$~m<~5AzKL#&su(LSacMN.YGy Y2O7Lx>');
define('NONCE_KEY',        ' x~~?&E6iK4*NKK~e.#Q7ObJZzy`QUJ`XjUh$[jaJhtSA ]Al?-pk/hg%7.~~75[');
define('AUTH_SALT',        '{tGFlB9@jX~(%7#nF;m7D#<kf`IcBAU$d)_ n8?yRF i$NQ<QyV!:E*6zs[YS|:>');
define('SECURE_AUTH_SALT', '=xzoRlq=$uN3Xm!n[{BTw?A%_KoBV0{+B@H=A/{p.u%@@<)`1erPP3+ya-@S0A_o');
define('LOGGED_IN_SALT',   '9Z,-!g7 |de}kbGH<uWQh,HEi{u>?7I/;T@^bo!J1H8DSE#lFLrv|lV+UdYWP^h>');
define('NONCE_SALT',       'R=n+>tjj}-Ac54sD)Q( vR#RmW5Sea@sT?k5-/S#K<{Bn?/RC8t8@K~w<$.IvFD(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
