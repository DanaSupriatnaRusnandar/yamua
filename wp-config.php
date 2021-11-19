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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'yamua' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'yU&2t]|PI]wnl<v)l?[Il_Ri%O5ziGl8Mnu8 e(c{W8UpZik1UB4sFQvQHKvIP`:' );
define( 'SECURE_AUTH_KEY',  '#?$Dz)%?uTwI:sG*w$nXh~w-nV!J`!p)U3(Qs<([D9~ODL&x2-~|PZhVU~nb_.d~' );
define( 'LOGGED_IN_KEY',    '6^J|fqmqk+1B|{XnN{O}4%6}>o4J6W,[jbo--;05hsk=!pPG61T6v~;o*]/8adC;' );
define( 'NONCE_KEY',        '-paJSo_=yos[V$?pP0xp.`{8TU B!=p7`N<d~hp(C`$L1P<fyW.p,o|6o=8craob' );
define( 'AUTH_SALT',        'JEfT.x@cyTU`(5,{O4XvD ht@eBK%*{Jm=P@iws&LoIJ$cBZNkN.FpL,mRQ%r#_J' );
define( 'SECURE_AUTH_SALT', ';Euj{d?W9n?4iv|aA~l?3Hb6|<J`yaF6&TK>@YQ,IaoECh{Q8yxy~I}?18Mb?s(o' );
define( 'LOGGED_IN_SALT',   'kC)h*4EXoObE!$|*VWSc5@VyIP;tfT [zM/J9fu0<o#<_]RF;SB/l|d7@wz>tNL-' );
define( 'NONCE_SALT',       ';(7 D)3}ZR;1zWLh.i-S}B$NSv8HiFvsCm2 tQHCCLF>(1Di8=.T@$S7g1}%2#:v' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
