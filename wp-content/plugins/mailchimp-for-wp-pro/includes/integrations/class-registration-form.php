<?php

// prevent direct file access
if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

class MC4WP_Registration_Form_Integration extends MC4WP_Integration {
	
	public function __construct() {
		add_action( 'register_form', array( $this, 'output_checkbox' ), 20 );
		add_action( 'user_register', array( $this, 'subscribe_from_registration' ), 90, 1 );
	}

	/**
	* Outputs the registration form checkbox
	*/
	public function output_checkbox( $hook = '' ) {
		return parent::output_checkbox( 'registration_form' );
	}

	/**
	* Subscribes from WP Registration Form
	*
	* @param int $user_id
	*/
	public function subscribe_from_registration( $user_id ) {

		// was sign-up checkbox checked?
		if ( $this->checkbox_was_checked() === false ) { 
			return false;
		}

		// gather emailadress from user who WordPress registered
		$user = get_userdata( $user_id );

		// was a user found with the given ID?
		if ( ! $user ) { 
			return false; 
		}

		$email = $user->user_email;
		$merge_vars = array( 'NAME' => $user->user_login );

		// try to add first name
		if ( isset( $user->user_firstname ) && !empty( $user->user_firstname ) ) {
			$merge_vars['FNAME'] = $user->user_firstname;
		}

		// try to add last name
		if ( isset( $user->user_lastname ) && !empty( $user->user_lastname ) ) {
			$merge_vars['LNAME'] = $user->user_lastname;
		}

		return $this->subscribe( $email, $merge_vars, 'registration' );
	}
	/* End registration form functions */

}