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
define('DB_NAME', 'test2');

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
define('AUTH_KEY',         '4Cl^O>+b-l06T.[ZH.}7Pz*<.S/<f.K )IL0A+xCDy&QhuC(x+NZW+6r~IzGi2zN');
define('SECURE_AUTH_KEY',  'ktxj~+~6qsLr]))cOXL}{)],0g-8WZ$h98[Kj{WV^iQe_@j@BOCd.T8K3F,vlKeK');
define('LOGGED_IN_KEY',    '|l&8zt!J+6c2KPoAZ6|/;%V+f/883>n54-@7/Tum/(1XZ6{%*C+zJ+Crw5 x;YUQ');
define('NONCE_KEY',        'vc.X8suFVSys9)!Kj|{|e+rA*]%QMP=mO@57Vq8NG_/#O4geB+1B./Vdfj A,OWb');
define('AUTH_SALT',        'Fbo%++ |r 3m<stX/s[%R!Po!(t!;>xu=$E8]<[6a`$Z=v:N&*|U[q#@=LG${ -%');
define('SECURE_AUTH_SALT', '|+@JQGu)-).ti{wi<W@-vU{yElwDF[7kw6(6a]zD>}v9Ya9u-Oh=.=$&7CKtFz.U');
define('LOGGED_IN_SALT',   '5aZ-5dKn%(b_FR8hRtV)%B<|$%#nUsU-xkjPgYPso2VR4C.vh1DROcI@e^Djq}O#');
define('NONCE_SALT',       '7s{zJ[%#xO1m-}VGGLH9It^XjM$jLXK,4;jP23gg)agU/QdnSJR3a)3ulj[SG[qn');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
