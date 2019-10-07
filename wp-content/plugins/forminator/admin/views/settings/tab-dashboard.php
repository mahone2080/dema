<?php
$section = isset( $_GET['section'] ) ? $_GET['section'] : 'dashboard'; // wpcs csrf ok.

$nonce = wp_create_nonce( 'forminator_save_dashboard_settings' );
?>

<div class="sui-box" data-nav="dashboard" style="<?php echo esc_attr( 'dashboard' !== $section ? 'display: none;' : '' ); ?>">

	<div class="sui-box-header">
		<h2 class="sui-box-title"><?php esc_html_e( 'General', Forminator::DOMAIN ); ?></h2>
	</div>

	<form class="forminator-settings-save" action="">

		<div class="sui-box-body">

			<div class="sui-box-settings-row">

				<div class="sui-box-settings-col-1">
					<span class="sui-settings-label"><?php esc_html_e( 'Dashboard', Forminator::DOMAIN ); ?></span>
					<span class="sui-description"><?php esc_html_e( 'Customize the Forminator dashboard as per your liking.', Forminator::DOMAIN ); ?></span>
				</div>

				<div class="sui-box-settings-col-2">

					<label class="sui-settings-label"><?php esc_html_e( 'Modules Listing', Forminator::DOMAIN ); ?></label>

					<span class="sui-description" style="margin-bottom: 10px;"><?php esc_html_e( 'Choose the number of modules with their preferred status you want to see on your dashboard for each module type.', Forminator::DOMAIN ); ?></span>

					<div class="sui-tabs sui-tabs-overflow">

						<div role="tablist" class="sui-tabs-menu" data-tabs>
							<button role="tab" id="forms" class="sui-tab-item active" aria-controls="forms-tab"><?php esc_html_e( 'Forms', Forminator::DOMAIN ); ?></button>
							<button role="tab" id="polls" class="sui-tab-item" aria-controls="polls-tab" tabindex="-1"><?php esc_html_e( 'Polls', Forminator::DOMAIN ); ?></button>
							<button role="tab" id="quizzes" class="sui-tab-item" aria-controls="quizzes-tab" tabindex="-1"><?php esc_html_e( 'Quizzes', Forminator::DOMAIN ); ?></button>
						</div>

						<div class="sui-tabs-content" data-panes>

							<?php // TAB: Forms ?>
							<div tabindex="0" role="tabpanel" id="forms-tab" class="forms-content sui-tab-content active" aria-labelledby="forms">
								<?php $this->template( 'settings/dashboard/forms' ); ?>
							</div>

							<?php // TAB: Polls ?>
							<div tabindex="0" role="tabpanel" id="polls-tab" class="polls-content sui-tab-content" aria-labelledby="polls" hidden>
								<?php $this->template( 'settings/dashboard/polls' ); ?>
							</div>

							<?php // TAB: Quizzes ?>
							<div tabindex="0" role="tabpanel" id="quizzes-tab" class="quizzes-content sui-tab-content" aria-labelledby="quizzes" hidden>
								<?php $this->template( 'settings/dashboard/quizzes' ); ?>
							</div>

						</div>

					</div>

				</div>

			</div>

			<?php $this->template( 'settings/tab-emails' ); ?>

			<?php $this->template( 'settings/tab-pagination' ); ?>


		</div>

		<div class="sui-box-footer">

			<div class="sui-actions-right">

				<button class="sui-button sui-button-blue wpmudev-action-done" data-title="<?php esc_attr_e( "General settings", Forminator::DOMAIN ); ?>" data-action="dashboard_settings" data-nonce="<?php echo esc_attr( $nonce ); ?>">
					<span class="sui-loading-text"><?php esc_html_e( 'Save Settings', Forminator::DOMAIN ); ?></span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>

			</div>

		</div>

	</form>

</div>
