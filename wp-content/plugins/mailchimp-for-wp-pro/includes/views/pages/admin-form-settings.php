<?php 
if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
?>
<div id="mc4wp-admin" class="wrap form-settings">

	<h2><img src="<?php echo MC4WP_PLUGIN_URL . 'assets/img/menu-icon.png'; ?>" /> <?php _e( 'MailChimp for WordPress', 'mailchimp-for-wp' ); ?>: <?php _e( 'Forms', 'mailchimp-for-wp' ); ?></h2>

	<h2 class="nav-tab-wrapper">  
		<a href="?page=mc4wp-pro-form-settings&tab=general-settings" class="nav-tab <?php echo ($tab === 'general-settings') ? 'nav-tab-active' : ''; ?>"><?php _e( "Forms & Settings", "mailchimp-for-wp" ); ?></a>
		<a href="?page=mc4wp-pro-form-settings&tab=css-builder" class="nav-tab <?php echo ($tab === 'css-builder') ? 'nav-tab-active' : ''; ?>"><?php _e( "CSS Styles Builder", "mailchimp-for-wp" ); ?></a>
	</h2> 

	<?php settings_errors(); ?>
	
	<br class="clear" />

	<?php 
	
	if( file_exists( dirname( __FILE__ ) . "/../tabs/admin-forms-{$tab}.php" ) ) {
		require dirname( __FILE__ ) . "/../tabs/admin-forms-{$tab}.php"; 
	}

	require dirname( __FILE__ ) . '/../parts/admin-footer.php'; 
	?>

</div>