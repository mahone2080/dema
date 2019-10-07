<?php
// defaults
$vars = array(
	'error_message' => '',
	'name'          => '',
	'name_error'    => '',
	'multi_id'      => '',
	'fields'        => array(),
	'form_fields'   => array(),
	'email_fields'  => array(),
);
/** @var array $template_vars */

foreach ( $template_vars as $key => $val ) {
	$vars[ $key ] = $val;
}

?>
<div class="integration-header">

	<h3 id="dialogTitle2" class="sui-box-title"><?php echo esc_html( __( 'Create Contact', Forminator::DOMAIN ) ); ?></h3>

	<p class="sui-description" style="max-width: 400px; margin: 20px auto 0; line-height: 22px;"><?php esc_html_e( "Let's start with matching up your form fields with the default HubSpot contact fields to make sure we're sending data to the right place.", Forminator::DOMAIN ); ?></p>

	<?php if ( ! empty( $vars['error_message'] ) ) : ?>
		<span class="sui-notice sui-notice-error"><p><?php echo esc_html( $vars['error_message'] ); ?></p></span>
	<?php endif; ?>

</div>

<form style="display: block; margin-top: -10px;">

	<table class="sui-table" style="margin-bottom: 0;">

		<thead>

			<tr>
				<th><?php esc_html_e( 'HubSpot Fields', Forminator::DOMAIN ); ?></th>
				<th><?php esc_html_e( 'Forminator Fields', Forminator::DOMAIN ); ?></th>
			</tr>

		</thead>

		<tbody>

			<?php
			if ( ! empty( $vars['fields'] ) ) :

				foreach ( $vars['fields'] as $key => $field_title ) : ?>

					<tr>

						<td>
							<?php echo esc_html( $field_title ); ?>
							<?php if ( 'email' === $key ) : ?>
								<span class="integrations-required-field">*</span>
							<?php endif; ?>
						</td>

						<td>
							<?php
							$forminator_fields = $vars['form_fields'];
							if ( 'email' === $key ) {
								$forminator_fields = $vars['email_fields'];
							}
							$current_error    = '';
							$current_selected = '';
							if ( isset( $vars[ $key . '_error' ] ) && ! empty( $vars[ $key . '_error' ] ) ) {
								$current_error = $vars[ $key . '_error' ];
							}
							if ( isset( $vars['fields_map'][ $key ] ) && ! empty( $vars['fields_map'][ $key ] ) ) {
								$current_selected = $vars['fields_map'][ $key ];
							}
							?>
							<div class="sui-form-field <?php echo esc_attr( ! empty( $current_error ) ? 'sui-form-field-error' : '' ); ?>"<?php echo ( ! empty( $current_error ) ) ? ' style="padding-top: 5px;"' : ''; ?>>
								<select class="sui-select" name="fields_map[<?php echo esc_attr( $key ); ?>]">
									<option value=""><?php esc_html_e( 'None', Forminator::DOMAIN ); ?></option>
									<?php
									if( ! empty( $forminator_fields ) ) :
										foreach ( $forminator_fields as $forminator_field ) : ?>
											<option value="<?php echo esc_attr( $forminator_field['element_id'] ); ?>"
												<?php selected( $current_selected, $forminator_field['element_id'] ); ?>>
												<?php echo esc_html( $forminator_field['field_label'] . ' | ' . $forminator_field['element_id'] ); ?>
											</option>
										<?php endforeach;
									endif;
									?>
								</select>
								<?php if ( ! empty( $current_error ) ) : ?>
									<span class="sui-error-message" style="margin-top: 5px; margin-bottom: 5px;"><?php echo esc_html( $current_error ); ?></span>
								<?php endif; ?>
							</div>
						</td>

					</tr>

				<?php endforeach;

			endif; ?>

		</tbody>

	</table>
	<input type="hidden" name="multi_id" value="<?php echo esc_attr( $vars['multi_id'] ); ?>">
</form>
