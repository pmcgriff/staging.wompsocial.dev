<?php

if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
* Takes care of all the sign-up checkboxes
*/
class MC4WP_Checkbox_Manager 
{	
	/**
	* Constructor
	*/
	public function __construct() {
		
		$opts = mc4wp_get_options( 'checkbox' );

		// load checkbox css if necessary
		add_action( 'wp_enqueue_scripts', array( $this, 'load_stylesheet' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'load_stylesheet' ) );

		// Load WP Comment Form Integration
		if ( $opts['show_at_comment_form'] ) {
			new MC4WP_Comment_Form_Integration();
		}

		// Load WordPress Registration Form Integration
		if ( $opts['show_at_registration_form'] ) {
			new MC4WP_Registration_Form_Integration();
		}

		// Load BuddyPress Integration
		if ( $opts['show_at_buddypress_form'] ) {
			new MC4WP_BuddyPress_Integration();
		}

		// Load EDD Integration
		if ( $opts['show_at_edd_checkout'] ) {
			new MC4WP_EDD_Integration();
		}

		// Load MultiSite Integration
		if ( $opts['show_at_multisite_form'] ) {
			new MC4WP_MultiSite_Integration();
		}

		// Load WooCommerce Integration
		if ( $opts['show_at_woocommerce_checkout'] ) {
			new MC4WP_WooCommerce_Integration();
		}

		// Load bbPress Integration
		if ( $opts['show_at_bbpress_forms'] ) {
			new MC4WP_bbPress_Integration();
		}

		// Load CF7 Integration
		if( function_exists( 'wpcf7_add_shortcode' ) ) {
			new MC4WP_CF7_Integration();
		}

		// Always load General Integration
		new MC4WP_General_Integration();
	}

	/**
	 * Loads the checkbox stylesheet
	 */
	public function load_stylesheet( ) {

		$opts = mc4wp_get_options('checkbox');

		if( $opts['css'] == false ) {
			return false;
		}

		wp_enqueue_style( 'mailchimp-for-wp-checkbox', MC4WP_PLUGIN_URL . 'assets/css/checkbox.css', array(), MC4WP_VERSION, 'all' );
		return true;
	}
}
