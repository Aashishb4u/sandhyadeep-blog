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
define( 'DB_NAME', 'sandhyadeep_demo' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '01Dec@1993' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct' );
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
define( 'AUTH_KEY',         '*tBaPaTa>Z9@3;z{T1JttHNYFu+v&7M5)qQz7R@S+/t`Ondivl!#.e^smKLCa{P1' );
define( 'SECURE_AUTH_KEY',  '=R3:ZJ~73mr{+yX<(A]J0W603s]kluy0GYjb7 GV_9TA8+?VsCSfU2l{nWuDo!A+' );
define( 'LOGGED_IN_KEY',    '~ad&.q_G!Fy@YD;xhuZgOl:hQ&3syaW]bEn$u=c:,Qu@]]|D^U3h_.s;lx,Z[=`T' );
define( 'NONCE_KEY',        'c/d,>14`=F#,T7@9K]N#MzVOsJz%IrX4o*Q!._/EAV|#NJy/;}8 Kmi={Y-/:cH$' );
define( 'AUTH_SALT',        '57im&|~;r2Y7@E)<d v*l>C(m?ysR6-rR8$Cvz33CikV]*4vo6/f:4NJ(trfv1<|' );
define( 'SECURE_AUTH_SALT', '88p3fsZ[;e|2tv~S1Pw[#G-SM8`hajiLmM?y?Hx)gk+F1_<%Fu==]gpc#`zg!B}m' );
define( 'LOGGED_IN_SALT',   'nR%;Bo92pmvd~X5,5f&l)/y%0NOH,Tobp{s)0KE8KE !6`y,vh&OyisPh4M[^q0T' );
define( 'NONCE_SALT',       'mLc,Y3.7tL}8_x_>v7t,X&z3xdJv]Soy9MB>wz;c5$)KN#COMFzqw@v[(o0} cuI' );

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
