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
define( 'WP_MAX_MEMORY_LIMIT' , '512M' );
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'shutterir_6517db');

/** MySQL database username */
define('DB_USER', 'shutterir_adus');

/** MySQL database password */
define('DB_PASSWORD', 'iranshutter6517#4u');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_DEBUG', true);
//define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG',true);

define('SCRIPT_DEBUG',true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'L^#7%wNKfA`9v!r6ee8vMF%k^4!LoAt)F$ccO.60XSBi5#Ry.MwNp1%GW3D{}zQZ');
define('SECURE_AUTH_KEY',  '>6;bX+V~ ^De0(;2Mx`96@{w2T!,rhq!Fh55mEy6ay^@lDCIJ/U{&NoU6BfgpF*}');
define('LOGGED_IN_KEY',    '*Xew`N#/lwf7~F2mDs$US:JO@94DI|w`{.ZO0usrrx)~(,~,Lc1QVTSD)0T;>-|R');
define('NONCE_KEY',        '+?e]VYm}q,EvU2v`$mJ5D{/oksW/r{7NoR3;Y#Xt ,Mo~,Ej-v[.b*NRLFETl|ix');
define('AUTH_SALT',        'Qf*OILv|}>w99a{WUO4/`2RZ`kplh,2y`j,9|BQQ+hEo0sYAHwspW AL!kcTl?=V');
define('SECURE_AUTH_SALT', 'oKu!M_-vGR<8#~V-[wcpMg3)+m@Gz:2<Il^>gl4u+U;._t^CK4L:R:9]V|34(>|8');
define('LOGGED_IN_SALT',   'kG/?$FSlwCf)#w-^QM_[Iv?6tkL<_bXQL=uunaSrs8}5.kXgv:#s01Y#i-agqc*W');
define('NONCE_SALT',       '72,9w)%].Cz7qhI`qz4n-wc/Y,[XvO@lT]G(QdH&?UhkWxNk6=K[NSBjL-r}N$XK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mshish_';

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
