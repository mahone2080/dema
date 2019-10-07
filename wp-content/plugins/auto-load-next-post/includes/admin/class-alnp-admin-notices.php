<?php
/**
 * Display notices in the WordPress admin.
 *
 * @since    1.3.2
 * @version  1.5.14
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Notices
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Admin_Notices' ) ) {

	class Auto_Load_Next_Post_Admin_Notices {

		/**
		 * Activation date.
		 *
		 * @access public
		 * @static
		 * @since  1.4.10
		 * @var    string
		 */
		public static $install_date;

		/**
		 * Constructor
		 *
		 * @access  public
		 * @since   1.3.2
		 * @version 1.5.11
		 */
		public function __construct() {
			self::$install_date = get_site_option( 'auto_load_next_post_install_date', time() );

			// Check WordPress enviroment.
			add_action( 'admin_init', array( $this, 'check_wp' ), 12 );

			// Don't bug the user if they don't want to see any notices.
			add_action( 'admin_init', array( $this, 'dont_bug_me' ), 15 );

			// Display other admin notices when required. All are dismissable.
			add_action( 'admin_print_styles', array( $this, 'add_notices' ), 0 );
		} // END __construct()

		/**
		 * Checks that the WordPress version meets the plugin requirement.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.11
		 * @global  string $wp_version
		 * @return  bool
		 */
		public function check_wp() {
			global $wp_version;

			// If the current user can not install plugins then return nothing!
			if ( ! current_user_can( 'install_plugins' ) ) {
				return false;
			}

			if ( ! version_compare( $wp_version, AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'requirement_wp_notice' ) );
				return false;
			}

			return true;
		} // END check_wp()

		/**
		 * Don't bug the user if they don't want to see any notices.
		 *
		 * @access  public
		 * @since   1.5.0
		 * @version 1.5.14
		 * @global  $current_user
		 */
		public function dont_bug_me() {
			global $current_user;

			$user_hidden_notice = false;

			// If the user is allowed to install plugins and requested to hide the review notice then hide it for that user.
			if ( ! empty( $_GET['hide_auto_load_next_post_review_notice'] ) && current_user_can( 'install_plugins' ) ) {
				add_user_meta( $current_user->ID, 'auto_load_next_post_hide_review_notice', '1', true );
				$user_hidden_notice = true;
			}

			// If the user is allowed to install plugins and requested to hide the upgrade notice then hide it for that user.
			if ( ! empty( $_GET['hide_auto_load_next_post_upgrade_notice'] ) && current_user_can( 'install_plugins' ) ) {
				add_user_meta( $current_user->ID, 'auto_load_next_post_hide_upgrade_notice', '1', true );
				$user_hidden_notice = true;
			}

			// If the user is allowed to install plugins and requested to hide the welcome notice then hide it for that user.
			if ( ! empty( $_GET['hide_auto_load_next_post_welcome_notice'] ) && current_user_can( 'install_plugins' ) ) {
				add_user_meta( $current_user->ID, 'auto_load_next_post_hide_welcome_notice', '1', true );
				$user_hidden_notice = true;
			}

			if ( ! empty( $_GET['hide_auto_load_next_post_beta_notice'] ) && current_user_can( 'install_plugins' ) ) {
				set_transient( 'alnp_beta_notice_hidden', 'hidden', WEEK_IN_SECONDS );
				$user_hidden_notice = true;
			}

			if ( $user_hidden_notice ) {
				// Redirect to the plugins page.
				wp_safe_redirect( admin_url( 'plugins.php' ) );
				exit;
			}
		} // END dont_bug_me()

		/**
		 * Checks if the theme supports the plugin and display the plugin review
		 * notice after 7 days or more from the time the plugin was installed.
		 *
		 * @access  public
		 * @since   1.3.2
		 * @version 1.5.14
		 * @global  $current_user
		 * @return  void|bool
		 */
		public function add_notices() {
			global $current_user;

			// If the current user can not install plugins then return nothing!
			if ( ! current_user_can( 'install_plugins' ) ) {
				return false;
			}

			$screen    = get_current_screen();
			$screen_id = $screen ? $screen->id : '';

			// Notices should only show on the main dashboard and on the plugins screen.
			if ( ! in_array( $screen_id, alnp_get_admin_screens() ) ) {
				return false;
			}

			// Is admin welcome notice hidden?
			$hide_welcome_notice = get_user_meta( $current_user->ID, 'auto_load_next_post_hide_welcome_notice', true );

			// Check if we need to display the welcome notice.
			if ( empty( $hide_welcome_notice ) ) {
				// If the user has just installed the plugin for the first time then welcome the user.
				if ( ( intval( time() - self::$install_date ) / WEEK_IN_SECONDS ) % 52 <= 2 ) {
					add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
				}
			}

			// Is admin review notice hidden?
			$hide_review_notice = get_user_meta( $current_user->ID, 'auto_load_next_post_hide_review_notice', true );

			// Check if we need to display the review plugin notice.
			if ( empty( $hide_review_notice ) ) {
				// If it has been a week or more since activating the plugin then display the review notice.
				if ( ( intval( time() - self::$install_date ) ) > WEEK_IN_SECONDS ) {
					add_action( 'admin_notices', array( $this, 'plugin_review_notice' ) );
				}
			}

			// Is this version of Auto Load Next Post a beta release?
			if ( is_alnp_beta() && empty( get_transient( 'alnp_beta_notice_hidden' ) ) ) {
				add_action( 'admin_notices', array( $this, 'beta_notice' ) );
			}

			$template = get_option( 'template' );

			// Checks if the theme supports Auto Load Next Post and not provided via a plugin.
			if ( is_alnp_supported() ) {
				$plugin_supported = alnp_get_theme_support( 'plugin_support' );

				// Return if theme is supported via plugin.
				if ( ! empty( $plugin_supported ) && $plugin_supported == 'yes' ) {
					update_option( 'auto_load_next_post_theme_supported', $template );
					return false;
				}

				// If supported theme does not match active theme then show notice.
				if ( get_option( 'auto_load_next_post_theme_supported' ) !== $template ) {
					add_action( 'admin_notices', array( $this, 'theme_ready_notice' ) );
					update_option( 'auto_load_next_post_theme_supported', $template );
				}
			} else {
				// If theme not supported then delete option.
				delete_option( 'auto_load_next_post_theme_supported' );
			}

			// Upgrade warning notice that will disappear once the new release is installed.
			$upgrade_version = '1.6.0';

			$user_hidden_upgrade = get_user_meta( $current_user->ID, 'auto_load_next_post_hide_upgrade_notice', '1' );

			if ( version_compare( AUTO_LOAD_NEXT_POST_VERSION, $upgrade_version, '<' ) && empty( $user_hidden_upgrade ) ) {
				add_action( 'admin_notices', array( $this, 'upgrade_warning' ) );
			}
		} // END add_notices()

		/**
		 * Shows an upgrade warning notice if the installed version is less
		 * than the new release coming soon.
		 *
		 * @access  public
		 * @since   1.4.13
		 * @version 1.5.13
		 */
		public function upgrade_warning() {
			include_once( dirname( __FILE__ ) . '/views/html-notice-upgrade-warning.php' );
		} // END upgrade_warning()

		/**
		 * Show the WordPress requirement notice.
		 *
		 * @access public
		 * @since  1.4.3
		 */
		public function requirement_wp_notice() {
			include( dirname( __FILE__ ) . '/views/html-notice-requirement-wp.php' );
		} // END requirement_wp_notice()

		/**
		 * Show the theme ready notice.
		 *
		 * @access public
		 * @since  1.5.0
		 */
		public function theme_ready_notice() {
			include( dirname( __FILE__ ) . '/views/html-notice-theme-ready.php' );
		} // END theme_ready_notice()

		/**
		 * Show the welcome notice.
		 *
		 * @access public
		 * @since  1.5.0
		 */
		public function welcome_notice() {
			include( dirname( __FILE__ ) . '/views/html-notice-welcome.php' );
		} // END welcome_notice()

		/**
		 * Show the beta notice.
		 *
		 * @access public
		 * @since  1.5.0
		 */
		public function beta_notice() {
			include( dirname( __FILE__ ) . '/views/html-notice-trying-beta.php' );
		} // END beta_notice()

		/**
		 * Show the plugin review notice.
		 *
		 * @access  public
		 * @since   1.4.4
		 * @version 1.4.10
		 */
		public function plugin_review_notice() {
			$install_date = self::$install_date;

			include( dirname( __FILE__ ) . '/views/html-notice-please-review.php' );
		} // END plugin_review_notice()

	} // END class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Notices();
