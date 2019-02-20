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
define('DB_NAME', 'exawp_db');

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
define('AUTH_KEY',         'ux*US3?jQ<*`gh0>~%7=r@13Z+a)Es[aX]]OD?N5>BB|~)Eph`gZ2{}rz,JyNagw');
define('SECURE_AUTH_KEY',  ' @K-BKb<yFt!G:j6EE{i6Mw7whxYa;(,E}4`A#NCJIWVMfIzQ7T/|q2k=L%Oq%T/');
define('LOGGED_IN_KEY',    'TeY{(?>s&YYyGoOTi4tk%s|G?8 QnroKH`cZ@Jm4|do&<YlPam~xoZD}@FnE5jdZ');
define('NONCE_KEY',        '$pSQ:-zMt46!W-Rsv29o8r>NqSa5,_|%e%q@Zuf@G1(Q{GH;}v82wm&Y`ZLIN?:b');
define('AUTH_SALT',        'yo(W220PZa=^;hPwIKQ`PBcLCrjI?;p`hJ[0hbH7K/dY>?V#u>!m#U-eCFHFJhG3');
define('SECURE_AUTH_SALT', '_wlgRusaV3Dr=&&Z8*prX``2g0*$Y9HqJhN,:jbwBxW4b1z|Q9xIG9x(0RbZPy@N');
define('LOGGED_IN_SALT',   'k xN;~o$p;hLMPlw!/i#r[T~Ck&fs>o5NHkiBDgbD{.O_OB(M822Oz3)*b+*ia}^');
define('NONCE_SALT',       'HJYJA{rbh;rLJ4Z8cMRo|*RUD8Ipx1}4G_v=ouKE<yWx0=Ad%hK+$Ecb9vDKNu1L');

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
