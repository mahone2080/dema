<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Class Forminator_Admin
 *
 * @since 1.0
 */
class Forminator_Admin {

	/**
	 * @var array
	 */
	public $pages = array();

	/**
	 * Forminator_Admin constructor.
	 */
	public function __construct() {
		$this->includes();

		// Init admin pages
		add_action( 'admin_menu', array( $this, 'add_dashboard_page' ) );
		add_action( 'admin_notices', array( $this, 'show_stripe_updated_notice' ) );

		// Init Admin AJAX class
		new Forminator_Admin_AJAX();

		/**
		 * Triggered when Admin is loaded
		 */
		do_action( 'forminator_admin_loaded' );
	}

	/**
	 * Include required files
	 *
	 * @since 1.0
	 */
	private function includes() {
		// Admin pages
		include_once forminator_plugin_dir() . 'admin/pages/dashboard-page.php';
		include_once forminator_plugin_dir() . 'admin/pages/entries-page.php';
		include_once forminator_plugin_dir() . 'admin/pages/integrations-page.php';
		include_once forminator_plugin_dir() . 'admin/pages/settings-page.php';

		// Admin AJAX
		include_once forminator_plugin_dir() . 'admin/classes/class-admin-ajax.php';

		// Admin Data
		include_once forminator_plugin_dir() . 'admin/classes/class-admin-data.php';

		// Admin l10n
		include_once forminator_plugin_dir() . 'admin/classes/class-admin-l10n.php';
	}

	/**
	 * Initialize Dashboard page
	 *
	 * @since 1.0
	 */
	public function add_dashboard_page() {
		$title = __( 'Forminator', Forminator::DOMAIN );
		if( FORMINATOR_PRO ) {
			$title = __( 'Forminator Pro', Forminator::DOMAIN );
		}

		$this->pages['forminator'] = new Forminator_Dashboard_Page( 'forminator', 'dashboard', $title, $title, false, false );
		$this->pages['forminator-dashboard'] = new Forminator_Dashboard_Page( 'forminator', 'dashboard', __( 'Forminator Dashboard', Forminator::DOMAIN ), __( 'Dashboard', Forminator::DOMAIN ), 'forminator' );
	}

	/**
	 * Add Integrations page
	 *
	 * @since 1.1
	 */
	public function add_integrations_page() {
		add_action( 'admin_menu', array( $this, 'init_integrations_page' ) );
	}

	/**
	 * Initialize Integrations page
	 *
	 * @since 1.1
	 */
	public function init_integrations_page() {
		$this->pages['forminator-integrations'] = new Forminator_Integrations_Page(
			'forminator-integrations',
			'integrations',
			__( 'Integrations', Forminator::DOMAIN ),
			__( 'Integrations', Forminator::DOMAIN ),
			'forminator'
		);

		//TODO: remove this after converted to JS
		$addons = Forminator_Addon_Loader::get_instance()->get_addons()->to_array();
		foreach ($addons as $slug => $addon_array) {
			$addon_class = forminator_get_addon($slug);

			if ($addon_class && is_callable( array( $addon_class, 'admin_hook_html_version' ))) {
				call_user_func( array( $addon_class, 'admin_hook_html_version' ));
			}
		}

	}

	/**
	 * Add Settings page
	 *
	 * @since 1.0
	 */
	public function add_settings_page() {
		add_action( 'admin_menu', array( $this, 'init_settings_page' ) );
	}

	/**
	 * Initialize Settings page
	 *
	 * @since 1.0
	 */
	public function init_settings_page() {
		$this->pages['forminator-settings'] = new Forminator_Settings_Page( 'forminator-settings', 'settings', __( 'Global Settings', Forminator::DOMAIN ), __( 'Settings', Forminator::DOMAIN ), 'forminator' );
	}

	/**
	 * Add Entries page
	 *
	 * @since 1.0.5
	 */
	public function add_entries_page() {
		add_action( 'admin_menu', array( $this, 'init_entries_page' ) );
	}

	/**
	 * Initialize Entries page
	 *
	 * @since 1.0.5
	 */
	public function init_entries_page() {
		$this->pages['forminator-entries'] = new Forminator_Entries_Page(
			'forminator-entries',
			'entries',
			__( 'Forminator Submissions', Forminator::DOMAIN ),
			__( 'Submissions', Forminator::DOMAIN ),
			'forminator'
		);
	}

	/**
	 * Check if we have any Stripe form
	 *
	 * @since 1.9
	 *
	 * @return bool
	 */
	public function has_stripe_forms() {
		$forms = Forminator_Custom_Form_Model::model()->get_models_by_field( 'stripe-1' );

		if( count( $forms ) > 0 ) {
			return true;
		}

		return false;
	}

	/**
	 * Show Stripe admin notice
	 *
	 * @since 1.9
	 */
	public function show_stripe_updated_notice() {
		$notice_dismissed = get_option( 'forminator_stripe_notice_dismissed', false );
		if ( $notice_dismissed ) {
			return;
		}

		if ( ! $this->has_stripe_forms() ) {
			return;
		}
		?>
		<div class="forminator-notice notice notice-warning" data-prop="forminator_stripe_notice_dismissed" data-nonce="<?php echo esc_attr( wp_create_nonce( 'forminator_dismiss_notification' ) ); ?>">
			<p>
				<?php echo sprintf( __( 'To make Forminator\'s Stripe field <a href="%s" target="_blank">SCA Compliant</a>, we have replaced the Stripe Checkout modal with Stripe Elements which adds an inline field to collect your customer\'s credit or debit card details. Your existing forms with Stripe field are automatically updated, but we recommend checking them to ensure everything works fine.', Forminator::DOMAIN ), 'https://stripe.com/gb/guides/strong-customer-authentication' ); ?>
			</p>
			<p>
				<a href="<?php echo menu_page_url( 'forminator', false ) . '&show_stripe_dialog=true'; ?>" class="button button-primary"><?php esc_html_e( 'Learn more', Forminator::DOMAIN ); ?></a>
				<a href="#" class="dismiss-notice" style="margin-left: 10px; text-decoration: none; color: #555; font-weight: 500;"><?php esc_html_e( 'Dismiss', Forminator::DOMAIN ); ?></a>
			</p>
		</div>

		<script type="text/javascript">
			jQuery( '.forminator-notice .dismiss-notice' ).on( 'click', function( e ) {
				e.preventDefault();

				var $notice = jQuery( e.currentTarget ).closest( '.forminator-notice' );
				var ajaxUrl = '<?php echo forminator_ajax_url(); ?>';

				jQuery.post(
					ajaxUrl,
					{
						action: 'forminator_dismiss_notification',
						prop: $notice.data('prop'),
						_ajax_nonce: $notice.data('nonce')
					}
				).always( function() {
					$notice.hide();
				});
			});
		</script>
		<?php
	}
}
