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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '6YHb!2g;*9C-inD[9ZHSP(bbP3=C,gor/loab %eH<zs)kk>OppI1Z=+KHynO-hU' );
define( 'SECURE_AUTH_KEY',  '?KcP,%+;1:.n|Y#65`6zCx}D0kTEndIUvn.|iY&pf(r=y`DQI{zGOwcOFKodl(pq' );
define( 'LOGGED_IN_KEY',    '=@MXEeXrT$4ZdIAxKPiI@>>[m{4i=`E!H*;2{0X7vfE>00@udq]K@sJ{Yip:J6:B' );
define( 'NONCE_KEY',        'K&Zpdn~wb`]@bCrwj(K,;:rWe+#V-VX#4=J7o4S7OT6GiMICo3c.rrnrt6qthH6@' );
define( 'AUTH_SALT',        'GoH<<?JKJB,c4%q<>U{:v,)d0aKn:rbpVl5y4K(9$Gxf|H.g,%(?XDwao&Kj<:Ge' );
define( 'SECURE_AUTH_SALT', ':~8EM;J=.azgIpTPK/1BT$xu=D,p9It0sK#(r$teNm(@+xZmeT&05#BSp^uWs6a+' );
define( 'LOGGED_IN_SALT',   '=D;!&IiN{<<PjU;LvI9BTKpVZ%.,8wLju-)(WkGjE=x-75>}r=;g37=1K}HgSNh*' );
define( 'NONCE_SALT',       '6~&*]Ry$L9J~ztm7+f4nF<u6p~C,4|#rDoOM.mkQ:/Xs[0ztC,7zSq4lUy,GD8W:' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tbl_';

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
