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
define( 'DB_NAME', 'dema4' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root1234' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'kUJf.#IE1yYsC~U):JPW;no+s|m!`nJNTpiL>u+E${G/lY^=.Gaa(`E:yGZA!@Lx' );
define( 'SECURE_AUTH_KEY',  'iEr#.HVWg~n)ddYg^Bc_|v%2Oz z~3/QmIjt5oh4Xw42cfwQ4!(-p1d8;D-j0UXS' );
define( 'LOGGED_IN_KEY',    'X1NeET[qQiI)geT,1`Pp O,.xX|(0Qse[6rf;=J4~VcJU9lFB.zfH,;ji0!Rfg ,' );
define( 'NONCE_KEY',        'DK,PuJ&:~z!^trcA1zR`PV2uYy@DuAd/e-jyQ[e._q&P!0g98*b*[@`vnfMR+1fH' );
define( 'AUTH_SALT',        'F&pWRw=/a2rt8uQ1HQnkS+ke}nXK9_a2 TCk`:J*.Xjw-ppVNFD#SX4O{/XY=ZGF' );
define( 'SECURE_AUTH_SALT', '$BApb_0v5N/m;;m56jv*eV#tEqshI%{n.0LjOi!wjYJ<;lC|#~q>dc!iwF=[R22,' );
define( 'LOGGED_IN_SALT',   '},WcQ8DCZ~Ka`!()ERp#U8Y~=}HgU,M.A{L0?hjwz}k7U+CNWZ_!~Z6!x$yjB]>%' );
define( 'NONCE_SALT',       'E8CMHl>jOf,(0^!:(k{[PvwD.=e/CCHY*90cG?gkX3/%)UqIrA*wD!KwTq!=fH;=' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
//define( 'SCRIPT_DEBUG', true );
//define( 'ALNP_DEV_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
