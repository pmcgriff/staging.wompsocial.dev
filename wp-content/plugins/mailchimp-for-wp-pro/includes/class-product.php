<?php

class MC4WP_Product extends DVK_Product {

	public function __construct() {
		parent::__construct(
				'https://dannyvankooten.com/mailchimp-for-wordpress/',
				'MailChimp for WordPress Pro',
				plugin_basename( MC4WP_PLUGIN_FILE ),
				MC4WP_VERSION,
				'http://dannyvankooten.com/mailchimp-for-wordpress/',
				'admin.php?page=mc4wp-pro',
				'mailchimp-for-wp',
				'Danny van Kooten'
		);
	}

}