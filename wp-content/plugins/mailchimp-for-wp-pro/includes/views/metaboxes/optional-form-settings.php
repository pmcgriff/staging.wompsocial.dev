<?php
if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
?>
<p><?php printf( __( 'Any settings you specify here will override the <a href="%s">general form settings</a>. If no setting is specified, the corresponding general setting value will be used.', 'mailchimp-for-wp' ), admin_url( 'admin.php?page=mc4wp-pro-form-settings' ) ); ?></p>

<h4 class="mc4wp-title"><?php _e( 'MailChimp Settings', 'mailchimp-for-wp' ); ?></h4>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="mc4wp_form_hide_after_success"><?php _e( 'Double opt-in?', 'mailchimp-for-wp' ); ?></label></th>
		<td>
			<input type="radio" id="mc4wp_form_double_optin_1" name="mc4wp_form[double_optin]" value="1" <?php if($form_settings['double_optin'] == 1) echo 'checked="checked"'; ?> /> 
			<label for="mc4wp_form_double_optin_1"><?php _e( 'Yes' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_double_optin_0" name="mc4wp_form[double_optin]" value="0" <?php if($form_settings['double_optin'] == 0) echo 'checked="checked"'; ?> /> 
			<label for="mc4wp_form_double_optin_0"><?php _e( 'No' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_double_optin_inherit" name="mc4wp_form[double_optin]" value="" data-inherited-value="<?php echo $inherited_settings['double_optin']; ?>" <?php if($form_settings['double_optin'] == '') echo 'checked="checked"'; ?> /> 
			<label for="mc4wp_form_double_optin_inherit"><?php _e( 'Inherit', 'mailchimp-for-wp' ); ?></label>

			<p class="help"><?php _e( 'Select "yes" if you want people to confirm their email address before being subscribed (recommended)', 'mailchimp-for-wp' ); ?></p>
		</td>
		
	</tr>
	<tr valign="top">
		<th scope="row"><?php _e( 'Update existing subscribers?', 'mailchimp-for-wp' ); ?></th>
		<td>
			<input type="radio" id="mc4wp_form_update_existing_1" name="mc4wp_form[update_existing]" value="1" <?php checked($form_settings['update_existing'], 1); ?> /> 
			<label for="mc4wp_form_update_existing_1"><?php _e( 'Yes' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_update_existing_0" name="mc4wp_form[update_existing]" value="0" <?php checked($form_settings['update_existing'], 0); ?> /> 
			<label for="mc4wp_form_update_existing_0"><?php _e( 'No' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_update_existing_inherit" name="mc4wp_form[update_existing]" value="" data-inherited-value="<?php echo $inherited_settings['update_existing']; ?>" <?php checked($form_settings['update_existing'], ''); ?> />
			<label for="mc4wp_form_update_existing_inherit"><?php _e( 'Inherit', 'mailchimp-for-wp' ); ?></label>

			<p class="help"><?php _e( 'Select "yes" if you want to update existing subscribers (instead of showing the "already subscribed" message).', 'mailchimp-for-wp' ); ?></p>
		</td>
	</tr>
	<?php $enabled = $final_settings['update_existing']; ?>
	<tr id="mc4wp-replace-interests" valign="top" class="<?php if(!$enabled) echo 'hidden'; ?>">
		<th scope="row"><?php _e( 'Replace interest groups?', 'mailchimp-for-wp' ); ?></th>
		<td>
			<input type="radio" id="mc4wp_form_replace_interests_1" name="mc4wp_form[replace_interests]" value="1" <?php if($enabled) { checked($form_settings['replace_interests'], 1); } else { echo 'disabled'; } ?> />
			<label for="mc4wp_form_replace_interests_1"><?php _e( 'Yes' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_replace_interests_0" name="mc4wp_form[replace_interests]" value="0" <?php if($enabled) { checked($form_settings['replace_interests'], 0); } else { echo 'disabled'; } ?> />
			<label for="mc4wp_form_replace_interests_0"><?php _e( 'No' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_replace_interests_inherit" name="mc4wp_form[replace_interests]" value="" <?php if($enabled) { checked($form_settings['replace_interests'], ''); } else { echo 'disabled'; } ?> />
			<label for="mc4wp_form_replace_interests_inherit"><?php _e( 'Inherit', 'mailchimp-for-wp' ); ?></label>

			<p class="help"><?php _e( 'Select "yes" if you want to replace the interest groups with the groups provided instead of adding the provided groups to the member\'s interest groups (only when updating a subscriber).', 'mailchimp-for-wp'); ?></p>
		</td>
	</tr>
	<?php $enabled = !$final_settings['double_optin']; ?>
	<tr id="mc4wp-send-welcome"  valign="top" class="<?php if(!$enabled) echo 'hidden'; ?>">
		<th scope="row"><?php _e( 'Send Welcome Email?', 'mailchimp-for-wp' ); ?></th>
		<td>
			<input type="radio" id="mc4wp_form_send_welcome_1" name="mc4wp_form[send_welcome]" value="1" <?php if($enabled) { checked($form_settings['send_welcome'], 1); } else { echo 'disabled'; } ?> />
			<label for="mc4wp_form_send_welcome_1"><?php _e( 'Yes' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_send_welcome_0" name="mc4wp_form[send_welcome]" value="0" <?php if($enabled) { checked($form_settings['send_welcome'], 0); } else { echo 'disabled'; } ?> />
			<label for="mc4wp_form_send_welcome_0"><?php _e( 'No' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_send_welcome_inherit" name="mc4wp_form[send_welcome]" value="" <?php if($enabled) { checked($form_settings['send_welcome'], ''); } else { echo 'disabled'; } ?> />
			<label for="mc4wp_form_send_welcome_inherit"><?php _e( 'Inherit', 'mailchimp-for-wp' ); ?></label>

			<p class="help"><?php _e( 'Select "yes" if you want to send your lists Welcome Email if a subscribe succeeds (only when double opt-in is disabled).' ,'mailchimp-for-wp' ); ?></p>
		</td>
	</tr>
</table>

<h4 class="mc4wp-title"><?php _e( 'Form Settings & Messages', 'mailchimp-for-wp' ); ?></h4>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><?php _e( 'Enable AJAX form submission?', 'mailchimp-for-wp' ); ?></th>
		<td>
			<input type="radio" id="mc4wp_form_ajax_1" name="mc4wp_form[ajax]" value="1" <?php if($form_settings['ajax'] == 1) echo 'checked="checked"'; ?> /> 
			<label for="mc4wp_form_ajax_1"><?php _e("Yes"); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_ajax_0" name="mc4wp_form[ajax]" value="0" <?php if($form_settings['ajax'] == 0) echo 'checked="checked"'; ?> />
			<label for="mc4wp_form_ajax_0"><?php _e( 'No' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_ajax_inherit" name="mc4wp_form[ajax]" value="" <?php if($form_settings['ajax'] == '') echo 'checked="checked"'; ?> /> 
			<label for="mc4wp_form_ajax_inherit"><?php _e( 'Inherit', 'mailchimp-for-wp' ); ?></label>
			<p class="help"><?php _e( 'Select "yes" if you want to use AJAX (JavaScript) to submit forms.', 'mailchimp-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="mc4wp_form_hide_after_success"><?php _e( 'Hide form after a successful sign-up?', 'mailchimp-for-wp' ); ?></label></th>
		<td>
			<input type="radio" id="mc4wp_form_hide_after_success_1" name="mc4wp_form[hide_after_success]" value="1" <?php if($form_settings['hide_after_success'] == 1) echo 'checked="checked"'; ?> /> 
			<label for="mc4wp_form_hide_after_success_1"><?php _e("Yes"); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_hide_after_success_0" name="mc4wp_form[hide_after_success]" value="0" <?php if($form_settings['hide_after_success'] == 0) echo 'checked="checked"'; ?> />
			<label for="mc4wp_form_hide_after_success_0"><?php _e( 'No' ); ?></label> &nbsp;
			<input type="radio" id="mc4wp_form_hide_after_success_inherit" name="mc4wp_form[hide_after_success]" value="" <?php if($form_settings['hide_after_success'] == '') echo 'checked="checked"'; ?> /> 
			<label for="mc4wp_form_hide_after_success_inherit"><?php _e( 'Inherit', 'mailchimp-for-wp' ); ?></label>

			<p class="help"><?php _e( 'Select "yes" to hide the form fields after a successful sign-up.', 'mailchimp-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="mc4wp_form_redirect"><?php _e( 'Redirect to URL after successful sign-ups', 'mailchimp-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" name="mc4wp_form[redirect]" id="mc4wp_form_redirect" placeholder="<?php echo $inherited_settings['redirect']; ?>" value="<?php echo $form_settings['redirect']; ?>" />
			<p class="help"><?php _e( 'Leave empty or enter 0 for no redirection. Use complete (absolute) URLs, including <code>http://</code>', 'mailchimp-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php _e( 'Send an email copy of the form data?', 'mailchimp-for-wp' ); ?></th>
		<td>
			<label><input type="radio" id="mc4wp_form_send_email_copy_1" name="mc4wp_form[send_email_copy]" value="1" <?php checked($form_settings['send_email_copy'], 1); ?> /> <?php _e( 'Yes' ); ?></label> &nbsp;
			<label><input type="radio" id="mc4wp_form_send_email_copy_0" name="mc4wp_form[send_email_copy]" value="0" <?php checked($form_settings['send_email_copy'], 0); ?>  /> <?php _e( 'No' ); ?></label>
			<p class="help"><?php _e( 'Tick "yes" if you want to receive an email with the form data for every sign-up request.', 'mailchimp-for-wp' ); ?></p>
			<br />
			<p id="email_copy_receiver" <?php if( $form_settings['send_email_copy'] != 1) { ?>style="display: none;" <?php } ?>>
				<strong><?php _e( 'Send the copy to this email:', 'mailchimp-for-wp' ); ?></strong>
				<input type="text" class="widefat" name="mc4wp_form[email_copy_receiver]" value="<?php echo esc_attr( $form_settings['email_copy_receiver'] ); ?>" />
			</p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="mc4wp_form_text_success"><?php _e( 'Success message', 'mailchimp-for-wp' ); ?></label></th>
		<td><input type="text" class="widefat" id="mc4wp_form_text_success" name="mc4wp_form[text_success]" placeholder="<?php echo $inherited_settings['text_success']; ?>" value="<?php echo esc_attr($form_settings['text_success']); ?>" /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="mc4wp_form_text_error"><?php _e( 'General error message' ,'mailchimp-for-wp' ); ?></label></th>
		<td><input type="text" class="widefat" id="mc4wp_form_text_error" name="mc4wp_form[text_error]" placeholder="<?php echo $inherited_settings['text_error']; ?>"  value="<?php echo esc_attr($form_settings['text_error']); ?>" /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="mc4wp_form_text_invalid_email"><?php _e( 'Invalid email address message', 'mailchimp-for-wp' ); ?></label></th>
		<td><input type="text" class="widefat" id="mc4wp_form_text_invalid_email" name="mc4wp_form[text_invalid_email]" placeholder="<?php echo $inherited_settings['text_invalid_email']; ?>" value="<?php echo esc_attr($form_settings['text_invalid_email']); ?>" /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="mc4wp_form_text_already_subscribed"><?php _e( 'Already subscribed message', 'mailchimp-for-wp' ); ?></label></th>
		<td><input type="text" class="widefat" id="mc4wp_form_text_already_subscribed" name="mc4wp_form[text_already_subscribed]" placeholder="<?php echo $inherited_settings['text_already_subscribed']; ?>" value="<?php echo esc_attr($form_settings['text_already_subscribed']); ?>" /></td>
	</tr>
	<?php if( true === $this->has_captcha_plugin ) { ?>
		<tr valign="top">
			<th scope="row"><label for="mc4wp_form_text_invalid_captcha"><?php _e( 'Invalid CAPTCHA message', 'mailchimp-for-wp' ); ?></label></th>
			<td colspan="2" ><input type="text" class="widefat" id="mc4wp_form_text_invalid_captcha" name="mc4wp_form[text_invalid_captcha]" placeholder="<?php echo $inherited_settings['text_invalid_captcha']; ?>" value="<?php echo esc_attr( $form_settings['text_invalid_captcha'] ); ?>" /></td>
		</tr>
	<?php } ?>
	<tr>
		<th></th>
		<td>
			<p class="help"><?php printf( __( 'HTML tags like %s are allowed in the message fields.', 'mailchimp-for-wp' ), '<code>' . esc_html( '<strong><em><a>' ) . '</code>' ); ?></p>
		</td>
	</tr>


</table>
