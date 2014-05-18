<?php 
if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
?>
<p class="help"><?php printf( __( 'Need help? Email me directly at <a href="%s">support@dannyvankooten.com</a>. Please include your website URL and as many details as possible.', 'mailchimp-for-wp' ), 'mailto:support%40dannyvankooten.com?subject=MailChimp%20for%20WP%20premium%20support&body=Hi%20Danny%2C%0A%0AMy%20website%3A%20' . site_url() . '%0AMailChimp%20for%20WP%20v' . MC4WP_VERSION . '%0AWordPress%20v' . bloginfo('version') . '%0APHP%20v' . phpversion() . '%0A%0A' ); ?></p>
<p class="help">What's next? Submit your feature requests or vote for new features using <a href="http://www.google.com/moderator/#15/e=20c6b7&t=20c6b7.40">this Google Moderator tool</a>.</p>