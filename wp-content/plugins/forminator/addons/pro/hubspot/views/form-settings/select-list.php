<?php
// defaults
$vars = array(
	'error_message' => '',
	'list_id'       => '',
	'list_id_error' => '',
	'multi_id'      => '',
	'lists'         => array(),
);
/** @var array $template_vars */
foreach ( $template_vars as $key => $val ) {
	$vars[ $key ] = $val;
}
?>

<div class="integration-header">

	<h3 class="sui-box-title" id="dialogTitle2"><?php echo esc_html( __( 'Add Contact to List', Forminator::DOMAIN ) ); ?></h3>

	<span class="sui-description" style="margin-top: 20px; line-height: 22px;"><?php esc_html_e( "You can also add the contact to a HubSpot list. Leave it empty if you only want to create a contact but dont't want to add it to a list.", Forminator::DOMAIN ); ?></span>

	<?php if ( ! empty( $vars['error_message'] ) ) : ?>
		<div class="sui-notice sui-notice-error">
			<p><?php echo esc_html( $vars['error_message'] ); ?></p>
		</div>
	<?php endif; ?>

</div>

<form style="display: block; margin-top: -10px;">

	<div class="sui-form-field <?php echo esc_attr( ! empty( $vars['list_id_error'] ) ? 'sui-form-field-error' : '' ); ?>">

		<label for="hubspot-list-id" id="hubspot-list-id-label" class="sui-label"><?php esc_html_e( 'HubSpot List', Forminator::DOMAIN ); ?></label>

		<select name="list_id" id="hubspot-list-id" class="sui-select sui-form-control" aria-labelledby="hubspot-list-id-label">

			<option value=""><?php esc_html_e( 'Please select a list', Forminator::DOMAIN ); ?></option>

			<?php if ( ! empty( $vars['lists'] ) ) :
                foreach ( $vars['lists'] as $list_id => $list_name ) : ?>
                    <option value="<?php echo esc_attr( $list_id ); ?>" <?php selected( $vars['list_id'], $list_id ); ?>><?php echo esc_html( $list_name ); ?></option>
                <?php endforeach;
			endif; ?>

		</select>

		<?php if ( ! empty( $vars['list_id_error'] ) ) : ?>
			<span class="sui-error-message"><?php echo esc_html( $vars['list_id_error'] ); ?></span>
		<?php endif; ?>

		<span class="sui-description" style="margin-top: 10px;"><?php esc_html_e( "Only static are shown here, as you can't manually add contacts to an active HubSpot list.", Forminator::DOMAIN ); ?></span>

	</div>

	<input
		type="hidden"
		name="multi_id"
		value="<?php echo esc_attr( $vars['multi_id'] ); ?>"
	/>

</form>
