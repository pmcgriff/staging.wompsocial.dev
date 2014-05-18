<?php

// prevent direct file access
if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

class MC4WP_WooCommerce_Integration extends MC4WP_Integration {
	
	public function __construct() {
		add_action( 'woocommerce_after_order_notes', array( $this, 'output_checkbox' ), 10 );
		add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'save_woocommerce_checkout_checkbox_value' ) );
		add_action( 'woocommerce_order_status_changed', array( $this, 'subscribe_from_woocommerce_checkout' ), 10, 3 );
	}

	public function output_checkbox( $hook = '' ) {
		return parent::output_checkbox( 'woocommerce_checkout' );
	}

	/**
	* @param int $order_id
	*/
	public function save_woocommerce_checkout_checkbox_value( $order_id )
	{
		update_post_meta( $order_id, '_mc4wp_optin', $this->checkbox_was_checked() );
	}

	/**
	* @param int $order_id
	* @return boolean
	*/
	public function subscribe_from_woocommerce_checkout( $order_id, $status, $new_status ) {

		$do_optin = get_post_meta( $order_id, '_mc4wp_optin', true );
		
		if( $do_optin ) {

			$order = new WC_Order( $order_id );
			$email = $order->billing_email;
			$merge_vars = array();
			$merge_vars['NAME'] = "{$order->billing_first_name} {$order->billing_last_name}";
			
			$result = $this->subscribe( $email, $merge_vars, 'woocommerce_checkout' );

			if( $result === true ) {
				delete_post_meta( $order_id, 'mc4wp_optin' );
				return true;
			}
			
		}

		return false;
	}

}