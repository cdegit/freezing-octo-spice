<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp381');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '=}:sPnj,18q~qHjyQR!W=#W/wTz<8)[cxXq.wSC^#(*(a*wvdv=:*f*,9E2SB(ES');
define('SECURE_AUTH_KEY',  'fktGW(1vmXM4P6dPPPLos/?RMj/JgN(<Kmh/@4ztb9*g7~=8mnx;8P_!D|tNzH,8');
define('LOGGED_IN_KEY',    '_3pTo}oeU:(!*N~ZqM9Cp,*-2T@h*}7mb+ZTWdmTb+cbi{5K[y@@/z}CbO/mNON1');
define('NONCE_KEY',        'B{(Mi/(*TK(@ 5q0Oo;bMCjsXT}+$|*,Jss9?PLiYHv2S6OP(){Aw 2#!z Q) L]');
define('AUTH_SALT',        '@$V+&<l/`~=?[cHu=3|6ebBsBuo)4&MTrg`F@@+D0?Jl|SEQ0@&2~/Sa0[dFp|eH');
define('SECURE_AUTH_SALT', 'Dh.%i-+`Pu=OUIi#yV0##+05z@+ dEv@vW7252FO,#VjBL+MzqHiz3[4Klj7<y1p');
define('LOGGED_IN_SALT',   'i,*IQ7Mn[V#4.$Dg.m[ {M3g<4.[dIX5AWH$>S}1bSe6=Cii^3pKh3_H|P0VMQO7');
define('NONCE_SALT',       '56p |QbgOYV3wh8XH{_r?xBz+*1 H!+94Z5%zN)sFs!<h+@J9B 8)<E5K}t5plB0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
