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
define('DB_NAME', 'xve');

/** MySQL database username */
define('DB_USER', 'xve');

/** MySQL database password */
define('DB_PASSWORD', 'xve');

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
define('AUTH_KEY',         'Q;NyO7Z5n9i.OwGW*{Zg;@L8zesSj[-:<vF8T4gfAfE};b6~1,O(A+ZG|X_e2HK#');
define('SECURE_AUTH_KEY',  'nDRGN48OIBA+^^~h,6ptZRv;QOf$:aO#WiO&zng3`bBc7fTAY{ka8.Ge{U#[FQM?');
define('LOGGED_IN_KEY',    'r#|c}>:)X2(n9,K5u4src^%0.+.9D}MpQfGN<=$=ff@^E)GX|N[{TK_[mLGz5wmv');
define('NONCE_KEY',        'aH;jXY*ctc.&/;Xd|YcXphh!Nma:axLiW|it4_UVY:|g_<P1FcEId8R`?j}%.tc(');
define('AUTH_SALT',        'Y77 v+_4QfrtSflicyu[%U*N)6%3w?!KAdLG3LjB ))irC#:G_(U.uN/:b,jR{MM');
define('SECURE_AUTH_SALT', '8O{c9]=X+s<6O0$}:=j.MIgqc@Z1?.*2h0J)<=czV$[FcsZjPwntlJ-}V`bk#[LQ');
define('LOGGED_IN_SALT',   '5-^vP$UpFs/PrnmobO{9NM>A=*R~X|w xHB.P~bchV!V}=NnUMp^#RG8{Tm8A7vf');
define('NONCE_SALT',       '{r/`gKX+j^!;z&/E42Pr%3H%P(pIA+cCik[pu{cJE6o2[E`gvF7[UE.9G/5H;Ta=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'xve_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
