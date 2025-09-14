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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/Applications/XAMPP/xamppfiles/htdocs/kidslifestylebd/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'kids' );

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
define( 'AUTH_KEY',         'p<}-pS8hv>H)Qmc~8Adz.eW|T*r&)d^c`oK9e1##(UM30!2hUoxaph1k>JyYlFQ-' );
define( 'SECURE_AUTH_KEY',  '[a}0~]`~4p0|k>QI}30u$68I87[aF5?T9ga@M63pq0VoKJ6!Kj+H1KD|jc!`WyRT' );
define( 'LOGGED_IN_KEY',    '|!R8j}=X#~js1#cXq%zvO` ubK=T[[D=K68j_UAt8!o>@L|:eP0Zv##I0uZMYtcJ' );
define( 'NONCE_KEY',        '>3 Q%MYYH1[m}jo9A6_$2VS}ryt(%a`uouzufrz+QB>$nv:I5Xv~8x,Wcb4v1e5R' );
define( 'AUTH_SALT',        '#gjJu#cJWlSTJdKK wr3/9(6RM5/A6?iPtzpefR%D;:0Y4dxN:d!kFPp}-VnE$YY' );
define( 'SECURE_AUTH_SALT', 'FGb^W]D>B{$2ilT:]nr<uiO0E0N iXo}UC1:o}Lg=H-R8@W3E`33pz81j;chY@Ab' );
define( 'LOGGED_IN_SALT',   '5jU@Hsr<:DThESswDF:yp@0Y.AyY%8oJycXE:pV!RQ:&18 #X6r0L3%qk;kKPz(Q' );
define( 'NONCE_SALT',       '@V|55U{XhNmWd/hYs,:L^`~~Ie(.!A-&5PS_xA]:|O$aI1Ip}< *{f$YO.jSmeI:' );

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
define("FS_METHOD", "direct");