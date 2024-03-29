<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Class Forminator_Admin_L10n
 *
 * @since 1.0
 */
class Forminator_Admin_L10n {

	public $forminator = null;

	public function __construct() {
	}

	public function get_l10n_strings() {
		$l10n = $this->admin_l10n();

		$admin_locale   = require_once forminator_plugin_dir() . 'admin/locale.php';

		$locale         = array(
			'' => array(
				'localeSlug' => 'default',
			),
		);

		$l10n['locale'] = array_merge( $locale, (array) $admin_locale );


		return apply_filters( 'forminator_l10n', $l10n );
	}

	/**
	 * Default Admin properties
	 *
	 * @return array
	 */
	public function admin_l10n() {
		return array(
			"popup"         => array(
				"form_name_label"       => __( "Name your form", Forminator::DOMAIN ),
				"form_name_placeholder" => __( "E.g. Contact Form", Forminator::DOMAIN ),
				"name"                  => __( "Name", Forminator::DOMAIN ),
				"fields"                => __( "Fields", Forminator::DOMAIN ),
				"date"                  => __( "Date", Forminator::DOMAIN ),
				"clear_all"             => __( "Clear All", Forminator::DOMAIN ),
				"your_exports"          => __( "Your exports", Forminator::DOMAIN ),
				"edit_login_form"       => __( "Edit Login or Register form", Forminator::DOMAIN ),
				"edit_scheduled_export" => __( "Edit Scheduled Export", Forminator::DOMAIN ),
				"frequency"             => __( "Frequency", Forminator::DOMAIN ),
				"daily"                 => __( "Daily", Forminator::DOMAIN ),
				"weekly"                => __( "Weekly", Forminator::DOMAIN ),
				"monthly"               => __( "Monthly", Forminator::DOMAIN ),
				"week_day"              => __( "Day of the week", Forminator::DOMAIN ),
				"monday"                => __( "Monday", Forminator::DOMAIN ),
				"tuesday"               => __( "Tuesday", Forminator::DOMAIN ),
				"wednesday"             => __( "Wednesday", Forminator::DOMAIN ),
				"thursday"              => __( "Thursday", Forminator::DOMAIN ),
				"friday"                => __( "Friday", Forminator::DOMAIN ),
				"saturday"              => __( "Saturday", Forminator::DOMAIN ),
				"sunday"                => __( "Sunday", Forminator::DOMAIN ),
				"day_time"              => __( "Time of the day", Forminator::DOMAIN ),
				"email_to"              => __( "Email export data to", Forminator::DOMAIN ),
				"email_placeholder"     => __( "E.g. john@doe.com", Forminator::DOMAIN ),
				"schedule_help"         => __( "Leave blank if you don't want to receive exports via email.", Forminator::DOMAIN ),
				"congratulations"       => __( "Congratulations!", Forminator::DOMAIN ),
				"is_ready"              => __( "is ready!", Forminator::DOMAIN ),
				"new_form_desc"         => __( "Add it to any post / page by clicking Forminator button, or set it up as a Widget.", Forminator::DOMAIN ),
				"paypal_settings"       => __( "Edit PayPal credentials", Forminator::DOMAIN ),
				"preview_cforms"        => __( "Preview Custom Form", Forminator::DOMAIN ),
				"preview_polls"         => __( "Preview Poll", Forminator::DOMAIN ),
				"preview_quizzes"       => __( "Preview Quiz", Forminator::DOMAIN ),
				"captcha_settings"      => __( "Edit reCAPTCHA credentials", Forminator::DOMAIN ),
				"currency_settings"     => __( "Edit default currency", Forminator::DOMAIN ),
				"pagination_entries"    => __( "Submissions | Pagination Settings", Forminator::DOMAIN ),
				"pagination_listings"   => __( "Listings | Pagination Settings", Forminator::DOMAIN ),
				"email_settings"        => __( "Email Settings", Forminator::DOMAIN ),
				"uninstall_settings"    => __( "Uninstall Settings", Forminator::DOMAIN ),
				"privacy_settings"      => __( "Privacy Settings", Forminator::DOMAIN ),
				"validate_form_name"    => __( "Form name cannot be empty! Please pick a name for your form.", Forminator::DOMAIN ),
				"close"                 => __( "Close", Forminator::DOMAIN ),
				"close_label"           => __( "Close this dialog window", Forminator::DOMAIN ),
				'records'               => __( "Records", Forminator::DOMAIN ),
				"delete"                => __( "Delete", Forminator::DOMAIN ),
				"confirm"               => __( "Confirm", Forminator::DOMAIN ),
				"are_you_sure"          => __( "Are you sure?", Forminator::DOMAIN ),
				"cannot_be_reverted"    => __( "Have in mind this action cannot be reverted.", Forminator::DOMAIN ),
				"are_you_sure_form"     => __( "Are you sure you wish to permanently delete this form?", Forminator::DOMAIN ),
				"confirm_action"        => __( "Please confirm that you want to do this action.", Forminator::DOMAIN ),
				"confirm_title"         => __( "Confirm Action", Forminator::DOMAIN ),
				"confirm_field_delete"  => __( "Please confirm that you want to delete this field", Forminator::DOMAIN ),
				"cancel"                => __( "Cancel", Forminator::DOMAIN ),
				"save_alert"            => __( "The changes you made may be lost if you navigate away from this page.", Forminator::DOMAIN ),
				"save_changes"          => __( "Save Changes", Forminator::DOMAIN ),
				"export_cform"          => __( "Export Form", Forminator::DOMAIN ),
				"export_poll"           => __( "Export Poll", Forminator::DOMAIN ),
				"export_quiz"           => __( "Export Quiz", Forminator::DOMAIN ),
				"import_cform"          => __( "Import Form", Forminator::DOMAIN ),
				"import_poll"           => __( "Import Poll", Forminator::DOMAIN ),
				"import_quiz"           => __( "Import Quiz", Forminator::DOMAIN ),
				'enable_scheduled_export' => __( 'Enable scheduled exports', Forminator::DOMAIN ),
				'scheduled_export_if_new' => __( 'Only send email if there are new submission(s)', Forminator::DOMAIN ),
				"download_csv"            => __( 'Download CSV', Forminator::DOMAIN ),
				"scheduled_exports"       => __( 'Scheduled Exports', Forminator::DOMAIN ),
				"manual_exports"          => __( 'Manual Exports', Forminator::DOMAIN ),
				"manual_description"      => __( 'Download the submissions list in .csv format.', Forminator::DOMAIN ),
				"scheduled_description"   => __( 'Enable scheduled exports to get the submissions list in your email.', Forminator::DOMAIN ),
				"disable"                 => __( 'Disable', Forminator::DOMAIN ),
				"enable"                  => __( 'Enable', Forminator::DOMAIN ),
				"enter_name"              => __( 'Enter a name', Forminator::DOMAIN ),
				"new_form_desc2"          => __( 'Name your new form, then lets start building!', Forminator::DOMAIN ),
				"new_poll_desc2"          => __( 'Name your new poll, then lets start building!', Forminator::DOMAIN ),
				"new_quiz_desc2"          => __( 'Choose a name for your new quiz, then start adding questions and answers!'),
				"input_label"             => __( 'Input Label', Forminator::DOMAIN ),
				"form_name_validation"    => __( 'Form name cannot be empty.', Forminator::DOMAIN ),
				"poll_name_validation"    => __( 'Poll name cannot be empty.', Forminator::DOMAIN ),
				"quiz_name_validation"    => __( 'Quiz name cannot be empty.', Forminator::DOMAIN ),
				"new_form_placeholder"    => __( 'E.g. Blank Form', Forminator::DOMAIN ),
				"new_poll_placeholder"    => __( 'E.g. Blank Poll', Forminator::DOMAIN ),
				"new_quiz_placeholder"    => __( 'E.g. My Awesome Quiz', Forminator::DOMAIN ),
				"create"                  => __( 'Create', Forminator::DOMAIN ),
				'reset'                   => __( 'RESET', Forminator::DOMAIN ),
				"disconnect"              => __( 'Disconnect', Forminator::DOMAIN ),
			),
			"quiz"          => array(
				"choose_quiz_title"       => __( 'Choose Quiz Type', Forminator::DOMAIN ),
				"choose_quiz_description" => __( "Let's start by choosing an appropriate quiz type based on your goal.", Forminator::DOMAIN ),
				"knowledge_label"         => __( 'Knowledge Quiz', Forminator::DOMAIN ),
				"knowledge_description"   => __( 'Test the knowledge of your visitors on a subject and final score is calculated based on number of right answers. E.g. Test your music knowledge.', Forminator::DOMAIN ),
				"nowrong_label"           => __( 'Personality Quiz', Forminator::DOMAIN ),
				"nowrong_description"     => __( "Show different outcomes depending on the visitor's answers. There are no wrong answers. E.g. Which superhero are you?", Forminator::DOMAIN ),
				"continue_button"         => __( 'Continue', Forminator::DOMAIN ),
			),
			"form"          => array(
				"form_template_title"       => __( "Choose a template", Forminator::DOMAIN ),
				"form_template_description" => __( "Customize one of our pre-made form templates, or start from scratch."),
				"continue_button"           => __( 'Continue', Forminator::DOMAIN ),
			),
			"sidebar"       => array(
				"label"         => __( "Label", Forminator::DOMAIN ),
				"value"         => __( "Value", Forminator::DOMAIN ),
				"add_option"    => __( "Add Option", Forminator::DOMAIN ),
				"delete"        => __( "Delete", Forminator::DOMAIN ),
				"pick_field"    => __( "Pick a field", Forminator::DOMAIN ),
				"field_will_be" => __( "This field will be", Forminator::DOMAIN ),
				"if"            => __( "if", Forminator::DOMAIN ),
				"shown"         => __( "Shown", Forminator::DOMAIN ),
				"hidden"        => __( "Hidden", Forminator::DOMAIN ),
			),
			"colors"        => array(
				"poll_shadow"       => __( "Poll shadow", Forminator::DOMAIN ),
				"title"             => __( "Title text", Forminator::DOMAIN ),
				"question"          => __( "Question text", Forminator::DOMAIN ),
				"answer"            => __( "Answer text", Forminator::DOMAIN ),
				"input_background"  => __( "Input field bg", Forminator::DOMAIN ),
				"input_border"      => __( "Input field border", Forminator::DOMAIN ),
				"input_placeholder" => __( "Input field placeholder", Forminator::DOMAIN ),
				"input_text"        => __( "Input field text", Forminator::DOMAIN ),
				"btn_background"    => __( "Button background", Forminator::DOMAIN ),
				"btn_text"          => __( "Button text", Forminator::DOMAIN ),
				"link_res"          => __( "Results link", Forminator::DOMAIN ),
			),
			"options"       => array(
				"browse"                => __( "Browse", Forminator::DOMAIN ),
				"clear"                 => __( "Clear", Forminator::DOMAIN ),
				"no_results"            => __( "You don't have any results yet.", Forminator::DOMAIN ),
				"select_result"         => __( "Select result", Forminator::DOMAIN ),
				"no_answers"            => __( "You don't have any answer yet.", Forminator::DOMAIN ),
				"placeholder_image"     => __( "Click browse to add image...", Forminator::DOMAIN ),
				"placeholder_image_alt" => __( "Click on browse to add an image", Forminator::DOMAIN ),
				"placeholder_answer"    => __( "Add an answer here", Forminator::DOMAIN ),
				"multiqs_empty"         => __( "You don't have any questions yet.", Forminator::DOMAIN ),
				"add_question"          => __( "Add Question", Forminator::DOMAIN ),
				"add_new_question"      => __( "Add New Question", Forminator::DOMAIN ),
				"question_title"        => __( "Question title", Forminator::DOMAIN ),
				"question_title_error"  => __( "Question title cannot be empty! Please, add some content to your question.", Forminator::DOMAIN ),
				"answers"               => __( "Answers", Forminator::DOMAIN ),
				"add_answer"            => __( "Add Answer", Forminator::DOMAIN ),
				"add_new_answer"        => __( "Add New Answer", Forminator::DOMAIN ),
				"add_result"            => __( "Add Result", Forminator::DOMAIN ),
				"delete_result"         => __( "Delete Result", Forminator::DOMAIN ),
				"title"                 => __( "Title", Forminator::DOMAIN ),
				"image"                 => __( "Image (optional)", Forminator::DOMAIN ),
				"description"           => __( "Description", Forminator::DOMAIN ),
				"trash_answer"          => __( "Delete this answer", Forminator::DOMAIN ),
				"correct"               => __( "Correct answer", Forminator::DOMAIN ),
				"no_options"            => __( "You don't have any options yet.", Forminator::DOMAIN ),
				"delete"                => __( "Delete", Forminator::DOMAIN ),
				"restricted_dates"      => __( "Restricted dates:", Forminator::DOMAIN ),
				"add"                   => __( "Add", Forminator::DOMAIN ),
				"custom_date"           => __( "Pick custom date(s) to restrict:", Forminator::DOMAIN ),
				"form_data"             => __( "Form Data", Forminator::DOMAIN ),
				"required_form_fields"  => __( "Required Fields", Forminator::DOMAIN ),
				"optional_form_fields"  => __( "Optional Fields", Forminator::DOMAIN ),
				"all_fields"            => __( "All Submitted Fields", Forminator::DOMAIN ),
				"form_name"             => __( "Form Name", Forminator::DOMAIN ),
				"misc_data"             => __( "Misc Data", Forminator::DOMAIN ),
				"form_based_data"       => __( "Add form data", Forminator::DOMAIN ),
				"been_saved"            => __( "has been saved.", Forminator::DOMAIN ),
				"been_published"        => __( "has been published.", Forminator::DOMAIN ),
				"error_saving"          => __( "Error! Form cannot be saved." ),
				"default_value"         => __( "Default Value", Forminator::DOMAIN ),
				"admin_email"           => get_option( 'admin_email' ),
				"delete_question"       => __( "Delete this question", Forminator::DOMAIN ),
				"remove_image"          => __( "Remove image", Forminator::DOMAIN ),
				"answer_settings"       => __( "Show extra settings", Forminator::DOMAIN ),
				"add_new_result"        => __( "Add New Result", Forminator::DOMAIN ),
				"multiorder_validation" => __( "You need to add at least one result for this quiz so you can re-order the results priority.", Forminator::DOMAIN ),
				"user_ip_address"       => __( "User IP Address", Forminator::DOMAIN ),
				"date"                  => __( "Date", Forminator::DOMAIN ),
				"embed_id"              => __( "Embed Post/Page ID", Forminator::DOMAIN ),
				"embed_title"           => __( "Embed Post/Page Title", Forminator::DOMAIN ),
				"embed_url"             => __( "Embed URL", Forminator::DOMAIN ),
				"user_agent"            => __( "HTTP User Agent", Forminator::DOMAIN ),
				"refer_url"             => __( "HTTP Refer URL", Forminator::DOMAIN ),
				"display_name"          => __( "User Display Name", Forminator::DOMAIN ),
				"user_email"            => __( "User Email", Forminator::DOMAIN ),
				"user_login"            => __( "User Login", Forminator::DOMAIN ),
				"shortcode_copied"      => __( "Shortcode has been copied successfully.", Forminator::DOMAIN )
			),
			"commons"       => array(
				"color"                          => __( "Color", Forminator::DOMAIN ),
				"colors"                         => __( "Colors", Forminator::DOMAIN ),
				"border_color"                   => __( "Border color", Forminator::DOMAIN ),
				"border_color_hover"             => __( "Border color (hover)", Forminator::DOMAIN ),
				"border_color_active"            => __( "Border color (active)", Forminator::DOMAIN ),
				"border_color_correct"           => __( "Border color (correct)", Forminator::DOMAIN ),
				"border_color_incorrect"         => __( "Border color (incorrect)", Forminator::DOMAIN ),
				"border_width"                   => __( "Border width", Forminator::DOMAIN ),
				"border_style"                   => __( "Border style", Forminator::DOMAIN ),
				"background"                     => __( "Background", Forminator::DOMAIN ),
				"background_hover"               => __( "Background (hover)", Forminator::DOMAIN ),
				"background_active"              => __( "Background (active)", Forminator::DOMAIN ),
				"background_correct"             => __( "Background (correct)", Forminator::DOMAIN ),
				"background_incorrect"           => __( "Background (incorrect)", Forminator::DOMAIN ),
				"font_color"                     => __( "Font color", Forminator::DOMAIN ),
				"font_color_hover"               => __( "Font color (hover)", Forminator::DOMAIN ),
				"font_color_active"              => __( "Font color (active)", Forminator::DOMAIN ),
				"font_color_correct"             => __( "Font color (correct)", Forminator::DOMAIN ),
				"font_color_incorrect"           => __( "Font color (incorrect)", Forminator::DOMAIN ),
				"font_background"                => __( "Font background", Forminator::DOMAIN ),
				"font_background"                => __( "Font background (hover)", Forminator::DOMAIN ),
				"font_background_active"         => __( "Font background (active)", Forminator::DOMAIN ),
				"font_family"                    => __( "Font family", Forminator::DOMAIN ),
				"font_family_custom"             => __( "Custom font family", Forminator::DOMAIN ),
				"font_family_placeholder"        => __( "E.g. 'Arial', sans-serif", Forminator::DOMAIN ),
				"font_family_custom_description" => __( "Here you can type the font family you want to use, as you would in CSS.", Forminator::DOMAIN ),
				"icon_size"                      => __( "Icon size", Forminator::DOMAIN ),
				"enable"                         => __( "Enable", Forminator::DOMAIN ),
				"dropdown"                       => __( "Dropdown", Forminator::DOMAIN ),
				"appearance"                     => __( "Appearance", Forminator::DOMAIN ),
				"expand"                         => __( "Expand", Forminator::DOMAIN ),
				"placeholder"                    => __( "Placeholder", Forminator::DOMAIN ),
				"preview"                        => __( "Preview", Forminator::DOMAIN ),
				"icon_color"                     => __( "Icon color", Forminator::DOMAIN ),
				"icon_color_hover"               => __( "Icon color (hover)", Forminator::DOMAIN ),
				"icon_color_active"              => __( "Icon color (active)", Forminator::DOMAIN ),
				"icon_color_correct"             => __( "Icon color (correct)", Forminator::DOMAIN ),
				"icon_color_incorrect"           => __( "Icon color (incorrect)", Forminator::DOMAIN ),
				"box_shadow"                     => __( "Box shadow", Forminator::DOMAIN ),
				"enable_settings"                => __( "Enable settings", Forminator::DOMAIN ),
				"font_size"                      => __( "Font size", Forminator::DOMAIN ),
				"font_weight"                    => __( "Font weight", Forminator::DOMAIN ),
				"text_align"                     => __( "Text align", Forminator::DOMAIN ),
				"regular"                        => __( "Regular", Forminator::DOMAIN ),
				"medium"                         => __( "Medium", Forminator::DOMAIN ),
				"large"                          => __( "Large", Forminator::DOMAIN ),
				"light"                          => __( "Light", Forminator::DOMAIN ),
				"normal"                         => __( "Normal", Forminator::DOMAIN ),
				"bold"                           => __( "Bold", Forminator::DOMAIN ),
				"typography"                     => __( "Typography", Forminator::DOMAIN ),
				"padding_top"                    => __( "Top padding", Forminator::DOMAIN ),
				"padding_right"                  => __( "Right padding", Forminator::DOMAIN ),
				"padding_bottom"                 => __( "Bottom padding", Forminator::DOMAIN ),
				"padding_left"                   => __( "Left padding", Forminator::DOMAIN ),
				"border_radius"                  => __( "Border radius", Forminator::DOMAIN ),
				"date_placeholder"               => __( "20 April 2018", Forminator::DOMAIN ),
				"left"                           => __( "Left", Forminator::DOMAIN ),
				"center"                         => __( "Center", Forminator::DOMAIN ),
				"right"                          => __( "Right", Forminator::DOMAIN ),
				"none"                           => __( "None", Forminator::DOMAIN ),
				"solid"                          => __( "Solid", Forminator::DOMAIN ),
				"dashed"                         => __( "Dashed", Forminator::DOMAIN ),
				"dotted"                         => __( "Dotted", Forminator::DOMAIN ),
				"delete_option"                  => __( "Delete option", Forminator::DOMAIN ),
				"label"                          => __( "Label", Forminator::DOMAIN ),
				"value"                          => __( "Value", Forminator::DOMAIN ),
				"reorder_option"                 => __( "Re-order this option", Forminator::DOMAIN ),
				"forminator_ui"                  => __( "Forminator UI", Forminator::DOMAIN ),
				"vanilla_theme"                  => __( "Vanilla Theme", Forminator::DOMAIN ),
				"forminator_bold"                => __( "Forminator Bold", Forminator::DOMAIN ),
				"forminator_flat"                => __( "Forminator Flat", Forminator::DOMAIN ),
				"material_design"                => __( "Material Design", Forminator::DOMAIN ),
				"vanilla_message"                => __( "Vanilla Theme will provide you a clean design (with no styles) and simple markup.", Forminator::DOMAIN ),
				"no_file_chosen"                 => __( "No file chosen", Forminator::DOMAIN ),
				"update_successfully"            => __( "saved succesfully!", Forminator::DOMAIN ),
				"update_unsuccessfull"           => __( "Error! Settings were not saved.", Forminator::DOMAIN )
			),
			"social"        => array(
				"facebook"    => __( "Facebook", Forminator::DOMAIN ),
				"twitter"     => __( "Twitter", Forminator::DOMAIN ),
				"google_plus" => __( "Google+", Forminator::DOMAIN ),
				"linkedin"    => __( "LinkedIn", Forminator::DOMAIN ),
			),
			"calendar"      => array(
				"day_names_min" => array(
					esc_html__( 'Su', Forminator::DOMAIN ),
					esc_html__( 'Mo', Forminator::DOMAIN ),
					esc_html__( 'Tu', Forminator::DOMAIN ),
					esc_html__( 'We', Forminator::DOMAIN ),
					esc_html__( 'Th', Forminator::DOMAIN ),
					esc_html__( 'Fr', Forminator::DOMAIN ),
					esc_html__( 'Sa', Forminator::DOMAIN ),
				),
				"month_names"   => array(
					esc_html__( 'January', Forminator::DOMAIN ),
					esc_html__( 'February', Forminator::DOMAIN ),
					esc_html__( 'March', Forminator::DOMAIN ),
					esc_html__( 'April', Forminator::DOMAIN ),
					esc_html__( 'May', Forminator::DOMAIN ),
					esc_html__( 'June', Forminator::DOMAIN ),
					esc_html__( 'July', Forminator::DOMAIN ),
					esc_html__( 'August', Forminator::DOMAIN ),
					esc_html__( 'September', Forminator::DOMAIN ),
					esc_html__( 'October', Forminator::DOMAIN ),
					esc_html__( 'November', Forminator::DOMAIN ),
					esc_html__( 'December', Forminator::DOMAIN ),
				),
				"day_names_min" => self::get_short_days_names(),
				"month_names"   => self::get_months_names(),
			),
			"exporter"      => array(
				"export_nonce" => wp_create_nonce( 'forminator_export' ),
				"form_id"      => forminator_get_form_id_helper(),
				"form_type"    => forminator_get_form_type_helper(),
				"enabled"      => filter_var( forminator_get_exporter_info( 'enabled', forminator_get_form_id_helper() . forminator_get_form_type_helper() ), FILTER_VALIDATE_BOOLEAN ),
				"interval"     => forminator_get_exporter_info( 'interval', forminator_get_form_id_helper() . forminator_get_form_type_helper() ),
				"month_day"    => forminator_get_exporter_info( 'month_day', forminator_get_form_id_helper() . forminator_get_form_type_helper() ),
				"day"          => forminator_get_exporter_info( 'day', forminator_get_form_id_helper() . forminator_get_form_type_helper() ),
				"hour"         => forminator_get_exporter_info( 'hour', forminator_get_form_id_helper() . forminator_get_form_type_helper() ),
				"email"        => forminator_get_exporter_info( 'email', forminator_get_form_id_helper() . forminator_get_form_type_helper() ),
				'if_new'       => forminator_get_exporter_info( 'if_new', forminator_get_form_id_helper() . forminator_get_form_type_helper() ),
				'noResults'    => esc_html__( 'No Result Found', Forminator::DOMAIN ),
				'searching'    => esc_html__( 'Searching', Forminator::DOMAIN ),
			),
			"exporter_logs" => forminator_get_export_logs( forminator_get_form_id_helper() ),
		);
	}

	/**
	 * Get short days names html escaped and translated
	 *
	 * @since 1.5.4
	 * @return array
	 */
	public static function get_short_days_names() {
		return array(
			esc_html__( 'Su', Forminator::DOMAIN ),
			esc_html__( 'Mo', Forminator::DOMAIN ),
			esc_html__( 'Tu', Forminator::DOMAIN ),
			esc_html__( 'We', Forminator::DOMAIN ),
			esc_html__( 'Th', Forminator::DOMAIN ),
			esc_html__( 'Fr', Forminator::DOMAIN ),
			esc_html__( 'Sa', Forminator::DOMAIN ),
		);
	}

	/**
	 * Get months names html escaped and translated
	 *
	 * @since 1.5.4
	 * @return array
	 */
	public static function get_months_names() {
		return array(
			esc_html__( 'January', Forminator::DOMAIN ),
			esc_html__( 'February', Forminator::DOMAIN ),
			esc_html__( 'March', Forminator::DOMAIN ),
			esc_html__( 'April', Forminator::DOMAIN ),
			esc_html__( 'May', Forminator::DOMAIN ),
			esc_html__( 'June', Forminator::DOMAIN ),
			esc_html__( 'July', Forminator::DOMAIN ),
			esc_html__( 'August', Forminator::DOMAIN ),
			esc_html__( 'September', Forminator::DOMAIN ),
			esc_html__( 'October', Forminator::DOMAIN ),
			esc_html__( 'November', Forminator::DOMAIN ),
			esc_html__( 'December', Forminator::DOMAIN ),
		);


	}

}
