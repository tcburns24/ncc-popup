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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '^!=;|qLW0pkKN8~X[%A4>leD{E-HT>*yv2Z18F9guqA|0Aq.]]hHH eZ1_9>oz@y' );
define( 'SECURE_AUTH_KEY',   'XQSq|#._ruZ.N:m,t^(ZCL)4A5vTH&=7L6nQF?rn}sG6`Lh|Pn_@UUXWuMj~6JE$' );
define( 'LOGGED_IN_KEY',     'Y,lS*{{0voEEy)Q5OM~6kk;+XlN3lVYu(P%|J=tXyOQ_eGK08&0fV0mv_rK9XR(N' );
define( 'NONCE_KEY',         'iz7j$LoFJ5w_V*SjF&YT?=Nw}y_=OpQe4=M0o1[|RE-(OFn0%Lo<s!]6D_xiaGJF' );
define( 'AUTH_SALT',         'm&W#Y]aL(gMYbM|h~bw=1K?T#eTM@3!y:J|c(VaGsOZ3(5qgpPhF=8d)0.~JHrgG' );
define( 'SECURE_AUTH_SALT',  '>W_!> ;2N{#.pNE6([.{,zYui6nQS=]zVe[GZ3G.?o[UD{:aaa<QCFnEZ9PWsu_-' );
define( 'LOGGED_IN_SALT',    '&!4B5j8(xJ`@dNKMhI&A^=Ke!eJ=DZCB cM}TfJ6+5qn<{q{KHc^K6$*(@4^vI,F' );
define( 'NONCE_SALT',        'mT$N+wG^Q[gF{M;U+L9hz6kiQXyHKzh5zl&:3kUxRns<KT7DRwGn)v#}fHt=}-4#' );
define( 'WP_CACHE_KEY_SALT', '^9x{b)9-)W<P/j2KsOZ%d(T&vCLdyeZqR-Hk%e9%W@n_1,-r,|6DhkT`p,}Np%sK' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
