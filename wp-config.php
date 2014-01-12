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
define('DB_NAME', 'freel300_PPA');

/** MySQL database username */
define('DB_USER', 'freel300_PPA');

/** MySQL database password */
define('DB_PASSWORD', '~Poc$.W^2i_A');

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
define('AUTH_KEY',         '6{~:+aF_x&c]yX`2Bkq^]Qcm|7:d_+EmgejbHh*&eZmDAGW}5v|C mR;-&yWEHQ;');
define('SECURE_AUTH_KEY',  '&},p7vv+_mCLwDU,cJ*oMUaD7e}-+>)`z,^^/jg{5z_q4>/%s2PR<e3_9_X0GGp`');
define('LOGGED_IN_KEY',    'XRlD?Q3BrB$hMSw!x?#L_bD0r4wMR)9SnF]P4BE:CQc>xe3%G-RSxB5VD !K37Gn');
define('NONCE_KEY',        '(eq]hrdJ,cl~wzsPeFU0hvt5={x-sF66iY4u[(!L<i?uE-[Js|C;t]G`HLX&S`t}');
define('AUTH_SALT',        'vRPC}M2:|zFKSW6B]wc$t/n![|%gp5{zM^;[;vuCs5jP*~hD93lu~}p8z@:1m50x');
define('SECURE_AUTH_SALT', '~+^=F(zq&{p[-6ofV/=vCyJy2(<ijfRU/^TI,4.$A<<+B`r.HR-_Mxey-HZ8~$Qv');
define('LOGGED_IN_SALT',   '%T`>/cH(|(x8#V[}Y+yWPN|m;{ |1-^6;~+X,;< _ 4Yz0Kw.zI=GS|}[ty:;r8r');
define('NONCE_SALT',       'q^7r$-Hf6}1}^K9fKK0X6ng#XEzu&?r{-i]l$+Tept>ebR`HA9bhPAh@sESlh425');

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
