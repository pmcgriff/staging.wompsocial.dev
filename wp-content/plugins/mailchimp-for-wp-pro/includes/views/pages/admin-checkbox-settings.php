<?php 
if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
?>

<div id="mc4wp-admin" class="wrap checkbox-settings">

	<h2><img src="<?php echo MC4WP_PLUGIN_URL . 'assets/img/menu-icon.png'; ?>" /> <?php _e( 'MailChimp for WordPress', 'mailchimp-for-wp' ); ?>: <?php _e( 'Checkbox Settings', 'mailchimp-for-wp' ); ?></h2>
	<?php settings_errors(); ?>

	<p><?php _e( 'To use sign-up checkboxes, select at least one list and one form to add the checkbox to.', 'mailchimp-for-wp' ); ?></p>


	<form method="post" action="options.php">

		<?php settings_fields( 'mc4wp_checkbox_settings' ); ?>

		<h3 class="mc4wp-title"><?php _e( 'MailChimp settings for checkboxes', 'mailchimp-for-wp' ); ?></h3>

		<?php 
		if( empty( $opts['lists'] ) ) { ?>
			<div class="mc4wp-info">
				<p><?php _e( 'If you want to use sign-up checkboxes, select at least one MailChimp list to subscribe people to.', 'mailchimp-for-wp' ); ?></p>
			</div>
		<?php 
		}
		?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'MailChimp Lists', 'mailchimp-for-wp' ); ?></th>
				
					<?php // loop through lists
					if( ! $lists || empty( $lists ) ) {
						?><td colspan="2"><?php printf( __( 'No lists found, %sare you connected to MailChimp?%s', 'mailchimp-for-wp' ), '<a href="'. admin_url( 'admin.php?page=mc4wp-pro' ) .'">', '</a>' ); ?></td><?php
					} else { ?>
					<td class="nowrap">
						<?php foreach($lists as $list) {
							?><label><input type="checkbox" name="mc4wp_checkbox[lists][<?php echo esc_attr( $list->id ); ?>]" value="<?php echo esc_attr( $list->id ); ?>" <?php if( array_key_exists( $list->id, $opts['lists'] ) ) echo 'checked="checked"'; ?>> <?php echo esc_html( $list->name ); ?></label><br /><?php
						} ?>
					</td>
					<td class="desc"><?php _e( 'Select the list(s) to which people who check the checkbox should be subscribed.' ,'mailchimp-for-wp' ); ?></td>
					<?php
				} ?>
				
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Double opt-in?', 'mailchimp-for-wp' ); ?></th>
				<td class="nowrap"><input type="radio" id="mc4wp_checkbox_double_optin_1" name="mc4wp_checkbox[double_optin]" value="1" <?php if($opts['double_optin'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_double_optin_1"><?php _e( 'Yes' ); ?></label> &nbsp; <input type="radio" id="mc4wp_checkbox_double_optin_0" name="mc4wp_checkbox[double_optin]" value="0" <?php if($opts['double_optin'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_double_optin_0"><?php _e( 'No' ); ?></label></td>
				<td class="desc"><?php _e( 'Select "yes" if you want people to confirm their email address before being subscribed (recommended)', 'mailchimp-for-wp' ); ?></td>
			</tr>
			<?php $enabled = !$opts['double_optin']; ?>
			<tr id="mc4wp-send-welcome"  valign="top" <?php if(!$enabled) { ?>class="hidden"<?php } ?>>
				<th scope="row"><?php _e( 'Send Welcome Email?', 'mailchimp-for-wp' ); ?></th>
				<td class="nowrap">
					<input type="radio" id="mc4wp_checkbox_send_welcome_1" name="mc4wp_checkbox[send_welcome]" value="1" <?php if($enabled) { checked($opts['send_welcome'], 1); } else { echo 'disabled'; } ?> />
					<label for="mc4wp_checkbox_send_welcome_1"><?php _e( 'Yes' ); ?></label> &nbsp;
					<input type="radio" id="mc4wp_checkbox_send_welcome_0" name="mc4wp_checkbox[send_welcome]" value="0" <?php if($enabled) { checked($opts['send_welcome'], 0); } else { echo 'disabled'; } ?> />
					<label for="mc4wp_checkbox_send_welcome_0"><?php _e( 'No' ); ?></label> &nbsp;
				</td>
				<td class="desc"><?php _e( 'Select "yes" if you want to send your lists Welcome Email if a subscribe succeeds (only when double opt-in is disabled).', 'mailchimp-for-wp' ); ?></td>
			</tr>
		</table>

		<h3 class="mc4wp-title"><?php _e( 'Checkbox settings', 'mailchimp-for-wp' ); ?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Add the checkbox to these forms', 'mailchimp-for-wp' ); ?></th>
				<td class="nowrap">
					<?php foreach($checkbox_plugins as $code => $name) { ?>
						<label><input name="mc4wp_checkbox[show_at_<?php echo $code; ?>]" value="1" type="checkbox" <?php checked($opts['show_at_'.$code], 1); ?>> <?php echo $name; ?></label> <br />
					<?php } ?>
				</td>
				<td class="desc">
					<?php _e( 'Selecting a form will automatically add the sign-up checkbox to it.', 'mailchimp-for-wp' ); ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc4wp_checkbox_label"><?php _e( 'Checkbox label text', 'mailchimp-for-wp' ); ?></label></th>
				<td colspan="2">
					<input type="text" class="widefat" id="mc4wp_checkbox_label" name="mc4wp_checkbox[label]" value="<?php echo esc_attr($opts['label']); ?>" required />
					<p class="help"><?php printf( __( 'HTML tags like %s are allowed in the label text.', 'mailchimp-for-wp' ), '<code>' . esc_html( '<strong><em><a>' ) . '</code>' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Pre-check the checkbox?', 'mailchimp-for-wp' ); ?></th>
				<td class="nowrap"><input type="radio" id="mc4wp_checkbox_precheck_1" name="mc4wp_checkbox[precheck]" value="1" <?php if($opts['precheck'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_precheck_1"><?php _e( 'Yes' ); ?></label> &nbsp; <input type="radio" id="mc4wp_checkbox_precheck_0" name="mc4wp_checkbox[precheck]" value="0" <?php if($opts['precheck'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_precheck_0"><?php _e( 'No' ); ?></label></td>
				<td class="desc"></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Load some default CSS?', 'mailchimp-for-wp' ); ?></th>
				<td class="nowrap"><input type="radio" id="mc4wp_checbox_css_1" name="mc4wp_checkbox[css]" value="1" <?php if($opts['css'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_checbox_css_1"><?php _e( 'Yes' ); ?></label> &nbsp; <input type="radio" id="mc4wp_checbox_css_0" name="mc4wp_checkbox[css]" value="0" <?php if($opts['css'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_checbox_css_0"><?php _e( 'No' ); ?></label></td>
				<td class="desc"><?php _e( 'Select "yes" if the checkbox appears in a weird place.', 'mailchimp-for-wp' ); ?></td>
			</tr>
		</table>

		<?php submit_button(__( 'Save all changes' ) ); ?>

		<?php if($selected_checkbox_hooks) { ?>
		<h3 class="mc4wp-title"><?php _e( 'Custom label texts', 'mailchimp-for-wp' ); ?></h3>
		<p><?php _e( 'Override the default checkbox label text for any given checkbox using the fields below.', 'mailchimp-for-wp' ); ?></p>
		<table class="form-table">
			<?php foreach($selected_checkbox_hooks as $code => $name) { ?>
			<tr valign="top">
				<th scope="row"><?php echo $name; ?></th>
				<td><input type="text" name="mc4wp_checkbox[text_<?php echo $code; ?>_label]" placeholder="<?php echo esc_attr($opts['label']); ?>" class="widefat" value="<?php if(isset($opts['text_'.$code.'_label'])) echo esc_attr($opts['text_'.$code.'_label']); ?>" /></td>
			</tr>
			<?php } ?>
			<tr>
				<th></th>
				<td>
					<p class="help"><?php printf( __( 'HTML tags like %s are allowed in the label text.', 'mailchimp-for-wp' ), '<code>' . esc_html( '<strong><em><a>' ) . '</code>' ); ?></p>
				</td>
			</tr>
		</table>

		<?php submit_button(__( 'Save all changes' ) ); ?>

		<?php } ?>

	</form>

	<?php require dirname( __FILE__ ) . '/../parts/admin-footer.php'; ?>

</div>