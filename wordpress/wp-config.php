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
define('DB_NAME', 'bracketpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'j2bVK+UuaqyVezO_t+i$Hj]A7jZVRU*+C_6=IAeW;@.ezXSoe^o&X)!B-o<v]-@v');
define('SECURE_AUTH_KEY',  'Ix?m>(]PVtvLd_*6)d_gEhE0U3ac*WLJk(d^_%+>vM>8;r[#75J$S[qKuSOFKX=p');
define('LOGGED_IN_KEY',    'cL4$`C(d.9`^jpkRyh>ETeiLv-hifo;g|.{sDFcR}w-dG68>iIs!=TyrA7TBxlw[');
define('NONCE_KEY',        '9 )Z^^^).WxI-#$MHWR3G]sw.#_=0J0ga{nHVzZknx@gxej&PS#y=&^&#p.Y+Uap');
define('AUTH_SALT',        '^CpB2+%Cc,4,rx/H,H; j4tw<S:<bBUz`)9|K52p-gA# `t?nV~/]E1#8JJ#i{vf');
define('SECURE_AUTH_SALT', ' w#5t`~:VGoiT+~xsEs[g@2%NTjL:^?kc9mxGnASr53`l%AQ713F}3^r5~%B!g1m');
define('LOGGED_IN_SALT',   ')36 /gJ6cuNI>Lt}ShvvA4T1!=LZ,91{rKn$oa>BXrcp%SfTf(f?L0-08/s`A^PC');
define('NONCE_SALT',       '_K?AkP^9<?F^#x%rK0|SaX7f.:,V%~@<:,dH$4;f,KkGN9|Q~TlP#EA0=&YUFeFC');

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
