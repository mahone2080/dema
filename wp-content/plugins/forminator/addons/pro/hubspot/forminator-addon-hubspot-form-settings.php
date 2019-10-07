<?php

require_once dirname( __FILE__ ) . '/forminator-addon-hubspot-form-settings-exception.php';

/**
 * Class Forminator_Addon_Hubspot_Form_Settings
 * Handle how form settings displayed and saved
 *
 * @since 1.0 HubSpot Addon
 */
class Forminator_Addon_Hubspot_Form_Settings extends Forminator_Addon_Form_Settings_Abstract {

	/**
	 * @var Forminator_Addon_Hubspot
	 * @since 1.0 HubSpot Addon
	 */
	protected $addon;

	public $target_types = array();

	/**
	 * Forminator_Addon_Hubspot_Form_Settings constructor.
	 *
	 * @since 1.0 HubSpot Addon
	 *
	 * @param Forminator_Addon_Abstract $addon
	 * @param                           $form_id
	 *
	 * @throws Forminator_Addon_Exception
	 */
	public function __construct( Forminator_Addon_Abstract $addon, $form_id ) {
		parent::__construct( $addon, $form_id );

		$this->_update_form_settings_error_message = __(
			'The update to your settings for this form failed, check the form input and try again.',
			Forminator::DOMAIN
		);
	}

	/**
	 * HubSpot Form Settings wizard
	 *
	 * @since 1.0 HubSpot Addon
	 * @return array
	 */
	public function form_settings_wizards() {
		// numerical array steps
		return array(
			array(
				'callback'     => array( $this, 'map_fields' ),
				'is_completed' => array( $this, 'map_fields_is_completed' ),
			),
			array(
				'callback'     => array( $this, 'setup_list' ),
				'is_completed' => array( $this, 'setup_list_is_completed' ),
			),
		);
	}


	/**
	 * Setup Connection Name
	 *
	 * @since 1.0 HubSpot Addon
	 *
	 * @param $submitted_data
	 *
	 * @return array
	 */
	public function map_fields( $submitted_data ) {
		$template = forminator_addon_hubspot_dir() . 'views/form-settings/create-contact.php';

		$multi_id = $this->generate_multi_id();
		if ( isset( $submitted_data['multi_id'] ) ) {
			$multi_id = $submitted_data['multi_id'];
		}

		$email_fields                 = array();
		$forminator_field_element_ids = array();
		foreach ( $this->form_fields as $form_field ) {
			// collect element ids
			$forminator_field_element_ids[] = $form_field['element_id'];
			if ( 'email' === $form_field['type'] ) {
				$email_fields[] = $form_field;
			}
		}

		$template_params = array(
			'fields_map'    => $this->get_multi_id_form_settings_value( $multi_id, 'fields_map', array() ),
			'error_message' => '',
			'multi_id'      => $multi_id,
			'fields'        => array(),
			'form_fields'   => $this->form_fields,
			'email_fields'  => $email_fields,
		);

		unset( $submitted_data['multi_id'] );

		$fields                    = array(
			'email'     => __( 'Email Address', Forminator::DOMAIN ),
			'firstname' => __( 'First Name', Forminator::DOMAIN ),
			'lastname'  => __( 'Last Name', Forminator::DOMAIN ),
			'jobtitle'  => __( 'Job Title', Forminator::DOMAIN ),
		);
		$template_params['fields'] = $fields;
		$is_submit                 = ! empty( $submitted_data );
		$has_errors                = false;
		if ( $is_submit ) {
			$fields_map                    = isset( $submitted_data['fields_map'] ) ? $submitted_data['fields_map'] : array();
			$template_params['fields_map'] = $fields_map;

			try {

				$input_exceptions = new Forminator_Addon_Hubspot_Form_Settings_Exception();
				if ( ! isset( $fields_map['email'] ) || empty( $fields_map['email'] ) ) {
					$input_exceptions->add_input_exception( 'Please assign field for Email Address', 'email_error' );
				}

				$fields_map_to_save = array();
				foreach ( $fields as $key => $title ) {
					if ( isset( $fields_map[ $key ] ) && ! empty( $fields_map[ $key ] ) ) {
						$element_id = $fields_map[ $key ];
						if ( ! in_array( $element_id, $forminator_field_element_ids, true ) ) {
							$input_exceptions->add_input_exception(
								sprintf( __( 'Please assign valid field for %s', Forminator::DOMAIN ), $title ),
								$key . '_error'
							);
							continue;
						}

						$fields_map_to_save[ $key ] = $fields_map[ $key ];
					}
				}

				if ( $input_exceptions->input_exceptions_is_available() ) {
					throw $input_exceptions;
				}

				$this->save_multi_id_form_setting_values( $multi_id, array( 'fields_map' => $fields_map ) );

			} catch ( Forminator_Addon_Hubspot_Form_Settings_Exception $e ) {
				$template_params = array_merge( $template_params, $e->get_input_exceptions() );
				$has_errors      = true;
			} catch ( Forminator_Addon_Hubspot_Exception $e ) {
				$template_params['error_message'] = $e->getMessage();
				$has_errors                       = true;
			}
		}

		$buttons = array();
		if ( $this->map_fields_is_completed( array( 'multi_id' => $multi_id ) ) ) {
			$buttons['disconnect']['markup'] = Forminator_Addon_Abstract::get_button_markup( esc_html__( 'Deactivate', Forminator::DOMAIN ),
				'sui-button-ghost sui-tooltip sui-tooltip-top-center forminator-addon-form-disconnect',
				esc_html__( 'Deactivate this HubSpot Integration from this Form.', Forminator::DOMAIN )
			);
		}

		$buttons['next']['markup'] = '<div class="sui-actions-right">' .
									 Forminator_Addon_Abstract::get_button_markup( esc_html__( 'Continue', Forminator::DOMAIN ), 'forminator-addon-next' ) .
									 '</div>';

		return array(
			'html'       => Forminator_Addon_Abstract::get_template( $template, $template_params ),
			'buttons'    => $buttons,
			'size'       => 'normal',
			'redirect'   => false,
			'has_errors' => $has_errors,
		);
	}

	/**
	 * Check if pick name step completed
	 *
	 * @since 1.0 HubSpot Addon
	 *
	 * @param $submitted_data
	 *
	 * @return bool
	 */
	public function map_fields_is_completed( $submitted_data ) {
		$multi_id = '';
		if ( isset( $submitted_data['multi_id'] ) ) {
			$multi_id = $submitted_data['multi_id'];
		}

		if ( empty( $multi_id ) ) {
			return false;
		}

		$fields_map = $this->get_multi_id_form_settings_value( $multi_id, 'fields_map', array() );

		if ( empty( $fields_map ) || ! is_array( $fields_map ) || count( $fields_map ) < 1 ) {
			return false;
		}

		if ( ! isset( $fields_map['email'] ) || empty( $fields_map['email'] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Setup List
	 *
	 * @since 1.0 HubSpot Addon
	 *
	 * @param $submitted_data
	 *
	 * @return array
	 */
	public function setup_list( $submitted_data ) {
		$template = forminator_addon_hubspot_dir() . 'views/form-settings/select-list.php';

		if ( ! isset( $submitted_data['multi_id'] ) ) {
			return $this->get_force_closed_wizard( __( 'Please pick valid connection', Forminator::DOMAIN ) );
		}

		$multi_id = $submitted_data['multi_id'];

		unset( $submitted_data['multi_id'] );

		$template_params = array(
			'list_id'       => $this->get_multi_id_form_settings_value( $multi_id, 'list_id', '' ),
			'list_name'     => $this->get_multi_id_form_settings_value( $multi_id, 'list_name', '' ),
			'list_id_error' => '',
			'multi_id'      => $multi_id,
			'error_message' => '',
		);


		$is_submit    = ! empty( $submitted_data );
		$has_errors   = false;
		$notification = array();
		$is_close     = false;

		$lists = array();

		try {

			$api           = $this->addon->get_api();
			$lists_request = $api->get_contact_list();

			if ( ! empty( $lists_request->lists ) ) {
				foreach ( $lists_request->lists as $key => $data ) {
					if ( isset( $data->listId ) && isset( $data->name ) ) { //phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar
						$lists[ $data->listId ] = $data->name; //phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar
					}
				}
			}
			if ( empty( $lists ) ) {
				throw new Forminator_Addon_Hubspot_Exception( __( 'No lists found on your HubSpot account . Please create one.', Forminator::DOMAIN ) );
			}

			$template_params['lists'] = $lists;

		} catch ( Forminator_Addon_Hubspot_Exception $e ) {
			$template_params['error_message'] = $e->getMessage();
			$has_errors                       = true;
		}

		if ( $is_submit ) {
			$list_id                    = isset( $submitted_data['list_id'] ) ? $submitted_data['list_id'] : '';
			$template_params['list_id'] = $list_id;

			try {
				$list_name = $lists[ $list_id ];

				$this->save_multi_id_form_setting_values(
					$multi_id,
					array(
						'list_id'   => $list_id,
						'list_name' => $list_name,
					)
				);

				$notification = array(
					'type' => 'success',
					'text' => '<strong>' . $this->addon->get_title() . '</strong> ' . __( 'is activated successfully.' ),
				);
				$is_close     = true;

			} catch ( Forminator_Addon_Hubspot_Exception $e ) {
				$template_params['list_id_error'] = $e->getMessage();
				$has_errors                       = true;
			}
		}

		$buttons = array();
		if ( $this->map_fields_is_completed( array( 'multi_id' => $multi_id ) ) ) {
			$buttons['disconnect']['markup'] = Forminator_Addon_Abstract::get_button_markup( esc_html__( 'Deactivate', Forminator::DOMAIN ),
				'sui-button-ghost sui-tooltip sui-tooltip-top-center forminator-addon-form-disconnect',
				esc_html__( 'Deactivate this HubSpot Integration from this Form.', Forminator::DOMAIN )
			);
		}

		$buttons['next']['markup'] = '<div class="sui-actions-right">' .
									 Forminator_Addon_Abstract::get_button_markup( esc_html__( 'Activate', Forminator::DOMAIN ), 'forminator-addon-next sui-button-blue' ) .
									 '</div>';

		return array(
			'html'         => Forminator_Addon_Abstract::get_template( $template, $template_params ),
			'buttons'      => $buttons,
			'redirect'     => false,
			'has_errors'   => $has_errors,
			'has_back'     => true,
			'notification' => $notification,
			'is_close'     => $is_close,
		);
	}

	/**
	 * Check if setup list completed
	 *
	 * @since 1.0 HubSpot Addon
	 *
	 * @param $submitted_data
	 *
	 * @return bool
	 */
	public function setup_list_is_completed( $submitted_data ) {
		$multi_id = '';
		if ( isset( $submitted_data['multi_id'] ) ) {
			$multi_id = $submitted_data['multi_id'];
		}

		if ( empty( $multi_id ) ) {
			return false;
		}

		$list_id = $this->get_multi_id_form_settings_value( $multi_id, 'list_id', '' );

		if ( empty( $list_id ) ) {
			return false;
		}

		return true;
	}


	/**
	 * Check if multi_id form settings values completed
	 *
	 * @since 1.0 HubSpot Added
	 *
	 * @param $multi_id
	 *
	 * @return bool
	 */
	public function is_multi_form_settings_complete( $multi_id ) {
		$data = array( 'multi_id' => $multi_id );

		if ( ! $this->map_fields_is_completed( $data ) ) {
			return false;
		}


		return true;
	}

	/**
	 * Generate multi id for multiple connection
	 *
	 * @since 1.0 HubSpot Addon
	 * @return string
	 */
	public function generate_multi_id() {
		return uniqid( 'hubspot_', true );
	}


	/**
	 * Override how multi connection displayed
	 *
	 * @since 1.0 HubSpot Addon
	 * @return array
	 */
	public function get_multi_ids() {
		$multi_ids = array();
		foreach ( $this->get_form_settings_values() as $key => $value ) {
			$multi_ids[] = array(
				'id'    => $key,
				// use name that was added by user on creating connection
				'label' => isset( $value['name'] ) ? $value['name'] : $key,
			);
		}

		return $multi_ids;
	}

	/**
	 * Disconnect a connection from current form
	 *
	 * @since 1.0 HubSpot Addon
	 *
	 * @param array $submitted_data
	 */
	public function disconnect_form( $submitted_data ) {
		// only execute if multi_id provided on submitted data
		if ( isset( $submitted_data['multi_id'] ) && ! empty( $submitted_data['multi_id'] ) ) {
			$addon_form_settings = $this->get_form_settings_values();
			unset( $addon_form_settings[ $submitted_data['multi_id'] ] );
			$this->save_form_settings_values( $addon_form_settings );
		}
	}
}
