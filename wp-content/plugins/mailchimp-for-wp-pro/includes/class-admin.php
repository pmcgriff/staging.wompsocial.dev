<?php

if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

class MC4WP_Admin {

	/**
	 * @var bool True if the BWS Captcha plugin is activated.
	 */
	private $has_captcha_plugin = false;

	/**
	 * @var string The relative path to the main plugin file from the plugins dir
	 */
	private $plugin_file = '';

	/**
	* @var License_Manager
	*/ 
	private $license_manager;

	/**
	* Constructor
	*/
	public function __construct() {

		$this->plugin_file = plugin_basename( MC4WP_PLUGIN_FILE );
		
		$this->license_manager = $this->load_license_manager();

		$this->setup_hooks(); 
	}

	/**
	* The upgrade routine
	* Only runs after updating plugin files (if version was bumped)
	*
	* @return boolean Boolean indication whether the upgrade routine ran
	*/ 
	public function upgrade() {

		$db_version = get_option( 'mc4wp_version', 0 );
		if( version_compare( MC4WP_VERSION, $db_version, '<=' ) ) {
			return false;
		}

		// upgrade from old custom stylesheet
		$stylesheet = get_option( 'mc4wp_custom_css_file', false );
		if( $stylesheet === false ) {

			// check if custom stylesheet exists
			if( file_exists( WP_CONTENT_DIR . '/mc4wp-custom-styles.css' ) ) {
				update_option( 'mc4wp_custom_css_file', WP_CONTENT_URL . '/mc4wp-custom-styles.css' );
			}

		}

		// upgrade from older license manager
		$product = new MC4WP_Product();

		$old_option_name = sanitize_title_with_dashes( $product->get_author() . '_' . $product->get_item_name() . '_license', null, 'save' );
		$old_option = get_option( $old_option_name, false );
		if( $old_option !== false ) {
			$new_option_name = sanitize_title_with_dashes( $product->get_item_name() . '_license', null, 'save' );

			update_option( $new_option_name, $old_option );
			delete_option( $old_option_name );
		}

		// upgrade from even older license system
		if( get_option( 'mc4wp_license_status', false ) === 'valid' ) {

			// get current license key
			$opts = mc4wp_get_options('general');
			$license_key = $opts['license_key'];

			// set key and status
			$this->license_manager->set_license_status( 'valid' );
			$this->license_manager->set_license_key( $license_key );

			// delete old license status option
			delete_option( 'mc4wp_license_status' );
		}

		update_option( 'mc4wp_version', MC4WP_VERSION );
		return true;
	}

	/**
	* Loads the plugin license manager
	*
	* @return MCWP_Plugin_License_Manager An instance of the Plugin_License_Manager class
	*/
	private function load_license_manager() {

		$product = new MC4WP_Product();
		$license_manager = new DVK_Plugin_License_Manager( $product );
		$license_manager->setup_hooks();
		return $license_manager;
	}

	/**
	* Registers all the hooks
	*/
	private function setup_hooks() {

		// admin actions
		add_action( 'admin_init', array( $this, 'initialize' ) );
		add_action( 'do_meta_boxes', array( $this, 'remove_meta_boxes' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 25 );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_assets' ) );
		add_action( 'admin_menu', array( $this, 'build_menu' ) );
		add_action( 'admin_notices', array( $this, 'show_notice_to_deactivate_lite' ) );
		add_action( 'save_post', array( $this, 'save_form_data' ) );



		// admin filters
		add_filter( 'default_content', array( $this, 'get_default_form_markup' ), 10, 2 );
		add_filter( 'plugin_action_links', array( $this, 'add_plugin_settings_link' ), 10, 2 );
		add_filter( 'plugin_row_meta', array( $this, 'add_plugin_meta_links'), 10, 2 );
		add_filter( 'post_updated_messages', array( $this, 'set_form_updated_messages' ) );
		add_filter( 'quicktags_settings', array( $this, 'set_quicktags_buttons' ), 10, 2 );
		add_filter( 'user_can_richedit', array( $this, 'disable_visual_editor' ) );
		add_filter( 'gettext', array( $this, 'change_publish_button' ), 10, 2 );
		add_filter( 'wp_insert_post_data', array( $this, 'strip_form_tags' ) );
	}

	/**
	 * Initializes the plugin
	 *
	 * - Registers settings
	 * - Loads the translation files
	 * - Runs the upgrade routine
	 * - Checks if the Captcha plugin is activated
	 */
	public function initialize() {

		// is Captcha plugin running?
		$this->has_captcha_plugin = function_exists( 'cptch_display_captcha_custom' );

		// load textdomain
		$this->load_plugin_textdomain();

		// register settings
		$this->register_settings();

		// run upgrade routine
		$this->upgrade();
	}

	/**
	 * Load plugin textdomain
	 */
	public function load_plugin_textdomain() {
		// load the plugin text domain
		load_plugin_textdomain( 'mailchimp-for-wp', false, dirname( $this->plugin_file ) . '/languages/' );
	}

	/**
	 * Add settings link to Plugins page
	 *
	 * @param $links
	 * @param $file
	 *
	 * @return array
	 */
	public function add_plugin_settings_link( $links, $file ) {

		if( $file !== $this->plugin_file ) {
			return $links;
		}

		$settings_link = '<a href="' . admin_url('admin.php?page=mc4wp-pro') . '">' . __( 'Settings' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

	/**
	 * Adds meta links to the plugin in the WP Admin > Plugins screen
	 *
	 * @param array $links
	 * @param string $file
	 *
	 * @return array
	 */
	public function add_plugin_meta_links( $links, $file ) {

		if( $file !== $this->plugin_file ) {
			return $links;
		}

		$links[] = '<a href="http://dannyvankooten.com/mailchimp-for-wordpress/documentation/">' . __( 'Documentation', 'mailchimp-for-wp' ) . '</a>';
		return $links;
	}

	/**
	* Change the publish button to "Save Form" or "Update Form"
	*/
	public function change_publish_button( $translation, $text ) {
		global $pagenow;
		if ( ( $pagenow === 'post.php' || $pagenow === 'post-new.php' ) && get_post_type() === 'mc4wp-form' ) {

			if ( $text === "Publish" ) {
				$translation = __( "Save Form", 'mailchimp-for-wp' );
			} elseif ( $text === "Update" ) {
				$translation = __( "Update Form", 'mailchimp-for-wp' );
			}

		}

		return $translation;
	}

	/**
	* Set Quicktags buttons for MCWP Forms
	* @return array 
	*/
	public function set_quicktags_buttons( $settings, $editor_id ) {
		global $pagenow;
		if ( ( $pagenow === 'post.php' || $pagenow === 'post-new.php' ) && get_post_type() === 'mc4wp-form' ) {
			$settings['buttons'] = 'strong,em,link,img,ul,li,close';
		}
		return $settings;
	}

	/**
	* Register plugin settings
	*/
	public function register_settings() {
		register_setting( 'mc4wp_settings', 'mc4wp', array( $this, 'validate_settings' ) );
		register_setting( 'mc4wp_checkbox_settings', 'mc4wp_checkbox', array( $this, 'validate_checkbox_settings' ) );
		register_setting( 'mc4wp_form_settings', 'mc4wp_form', array( $this, 'validate_settings' ) );
		register_setting( 'mc4wp_form_css_settings', 'mc4wp_form_css', array( $this, 'validate_form_css_settings' ) );
	}

	/**
	* Set the default form mark-up
	* @return string
	*/
	public function get_default_form_markup( $content = '', $post = null ) {
		if ( ( $post && $post->post_type === 'mc4wp-form' ) ) {

			$email_placeholder = __( 'Your email address', 'mailchimp-for-wp' );
			$email_label = __('Email address', 'mailchimp-for-wp' );
			$signup_button =  __( 'Sign up', 'mailchimp-for-wp' );

			return "<p>\n\t<label for=\"mc4wp_email\">{$email_label} </label>\n\t<input type=\"email\" id=\"mc4wp_email\" name=\"EMAIL\" placeholder=\"{$email_placeholder}\" required />\n</p>\n\n<p>\n\t<input type=\"submit\" value=\"{$signup_button}\" />\n</p>";
		}
	}

	/**
	* Set notices after saving a form
	* @return array
	*/
	public function set_form_updated_messages( $messages ) {
		$back_link = __( 'Back to general form settings', 'mailchimp-for-wp' );
		$messages['mc4wp-form'] = $messages['post'];
		$messages['mc4wp-form'][1] = __( 'Form updated.', 'mailchimp-for-wp' ) . ' <a href="'. admin_url( 'admin.php?page=mc4wp-pro-form-settings' ) .'">&laquo; '. $back_link . '</a>';
		$messages['mc4wp-form'][6] = __( 'Form saved.', 'mailchimp-for-wp' ) . ' <a href="'. admin_url( 'admin.php?page=mc4wp-pro-form-settings' ) .'">&laquo; '. $back_link . '</a>';
		return $messages;
	}

	/**
	* Strips <form> tags from form content before it is saved to the database
	* 
	* @param array $data
	* @return array
	*/
	public function strip_form_tags( $data ) {

		if( $data['post_type'] !== 'mc4wp-form' ) {
			return $data;
		}

		$data['post_content'] = preg_replace( '/<\/?form(.|\s)*?>/i', '', $data['post_content'] );

		return $data;
	}

	/**
	* @var int $post_ID
	*/
	public function save_form_data( $post_id ) {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST['_mc4wp_nonce'] ) || ! wp_verify_nonce( $_POST['_mc4wp_nonce'], 'mc4wp_save_form' ) ) {
			return false; 
		}

		if( ! isset( $_POST['mc4wp_form'] ) || ! is_array( $_POST['mc4wp_form'] ) ) {
			return false;
		}

		$data = $_POST['mc4wp_form'];
		$meta = array(
			'lists' => $data['lists']
		);

		$optional_meta_keys = array( 'send_email_copy', 'email_copy_receiver', 'double_optin', 'update_existing', 'replace_interests', 'send_welcome', 'ajax', 'hide_after_success', 'redirect', 'text_success', 'text_error', 'text_invalid_email', 'text_already_subscribed', 'text_invalid_captcha' );
		foreach ( $optional_meta_keys as $meta_key ) {
			if ( isset( $data[$meta_key] ) ) {
				$meta[$meta_key] = $data[$meta_key];
			}
		}

		return update_post_meta( $post_id, '_mc4wp_settings', $meta );
	}

	/**
	* Adds meta boxes to the MCWP Forms screen
	*/
	public function add_meta_boxes() {
		add_meta_box( 'mc4wp-form-settings', __( 'Form settings', 'mailchimp-for-wp' ), array( $this, 'show_required_form_settings_metabox' ), 'mc4wp-form', 'side', 'high' );
		add_meta_box( 'mc4wp-optional-settings', __( 'Optional settings', 'mailchimp-for-wp' ), array( $this, 'show_optional_form_settings_metabox' ), 'mc4wp-form', 'normal', 'high' );
		add_meta_box( 'mc4wp-form-variables', __( 'Form variables', 'mailchimp-for-wp' ), array( $this, 'show_form_variables_metabox' ), 'mc4wp-form', 'side' );
	}

	/**
	 * Remove all metaboxes except "submitdiv".
	 * Also removes all metaboxes added by other plugins..
	 */
	public function remove_meta_boxes() {
		global $wp_meta_boxes;
		if ( isset( $wp_meta_boxes["mc4wp-form"] ) && is_array( $wp_meta_boxes["mc4wp-form"] ) ) {
			$meta_boxes = $wp_meta_boxes["mc4wp-form"];
			$allowed_meta_boxes = array( 'submitdiv' );

			foreach ( $meta_boxes as $context => $context_boxes ) {
				if ( ! is_array( $context_boxes ) ) { continue; }

				foreach ( $context_boxes as $priority => $priority_boxes ) {
					if ( !is_array( $priority_boxes ) ) { continue; }

					foreach ( $priority_boxes as $meta_box_id => $meta_box_args ) {
						if ( stristr( $meta_box_id, 'mc4wp' ) === false && !in_array( $meta_box_id, $allowed_meta_boxes ) ) {
							unset( $wp_meta_boxes["mc4wp-form"][$context][$priority][$meta_box_id] );
						}
					}
				}
			}
		}
	}

	/**
	 * Outputs the form variables metabox
	 * @param WP_Post $post
	 */
	public function show_form_variables_metabox( $post ) {
		?><p><?php _e( 'Use the following variables to add some dynamic content to your form.' , 'mailchimp-for-wp' ); ?></p><?php
		include MC4WP_PLUGIN_DIR . 'includes/views/parts/admin-text-variables.php';
	}

	/**
	 * Outputs the required form settings metabox
	 * @param WP_Post $post
	 */
	public function show_required_form_settings_metabox( $post ) {
		$lists = $this->get_mailchimp_lists();
		$form_settings = mc4wp_get_form_settings( $post->ID );
		include MC4WP_PLUGIN_DIR . 'includes/views/metaboxes/required-form-settings.php';
	}

	/**
	 * Outputs the optional form settings metabox
	 * @param WP_Post $post
	 */
	public function show_optional_form_settings_metabox( $post ) {
		$form_settings = mc4wp_get_form_settings( $post->ID );
		$inherited_settings = mc4wp_get_options('form');
		$final_settings = mc4wp_get_form_settings( $post->ID, true );
		include MC4WP_PLUGIN_DIR . 'includes/views/metaboxes/optional-form-settings.php';
	}

	/**
	 * Disables the visual editor for MC4WP Forms
	 * @param bool $default
	 * @return boolean
	 */
	public function disable_visual_editor( $default ) {
		
		// return false if the post type viewed is a MC4WP Form
		if ( get_post_type() === 'mc4wp-form' ) {
			return false; 
		}

		return $default;
	}

	/**
	* Sanitize the plugin settings
	*
	* @var array $settings Raw input array of settings
	* @return array $settings Sanitized array of settings
	*/
	public function validate_settings( array $settings ) {

		if( isset( $settings['api_key'] ) ) {
			$settings['api_key'] = trim( $settings['api_key'] );
		}

		return $settings;
	}


	/**
	* Validate the checkbox settings
	*
	* @param array $settings Raw input array of settings
	* @return array $settings Sanitized array of settings
	*/
	public function validate_checkbox_settings( array $settings ) {
		// strip tags from general label
		$settings['label'] = strip_tags( $settings['label'], '<b><strong><i><em><a><span><strike><u>' );

		// strip tags from custom labels
		$checkbox_label_keys = array_keys( $this->get_checkbox_compatible_plugins() );
		foreach ( $checkbox_label_keys as $key ) {
			if ( isset( $settings['text_' . $key . '_label'] ) ) {
				$settings['text_' . $key . '_label'] = strip_tags( $settings['text_' . $key . '_label'], '<b><strong><i><em><a><span><strike><u>' );
			}
		}

		return $settings;
	}

	/**
	* Validate the form CSS settings
	*
	* @param array $settings Raw input array of settings
	* @return array $settings Sanitized array of settings
	*/
	public function validate_form_css_settings( array $settings ) {

		// make sure width fields end in 'px' or '%'
		$check = array( 'form_width', 'buttons_width', 'fields_width', 'labels_width' );
		foreach( $check as $f ) {

			if( ! empty( $settings[ $f ] ) ) {

				// strip spaces & lowercase string
				$s = str_replace( ' ', '', strtolower( $settings[ $f ] ) );

				if( substr( $s, -1 ) != '%' && substr( $s, -2 ) != 'px') {
					$s .= 'px';
				}

				$settings[ $f ] = $s;
			}
		}

		$css = $settings;

		// make sure selector prefix ends with space
		$css['selector_prefix'] = trim( $css['selector_prefix'] ) . ' ';

		// make sure values do not end with 'px'
		$check = array( 
			'form_border_width', 
			'form_horizontal_padding', 
			'form_vertical_padding', 
			'fields_height', 
			'paragraphs_font_size', 
			'paragraphs_vertical_margin',
			'labels_vertical_margin',
			'labels_horizontal_margin',
			'labels_font_size', 
			'buttons_height',
			'buttons_border_width',
			'buttons_font_size'
		);

		foreach( $check as $f ) {
			if( ! empty( $css[ $f ] ) ) {
				$css[ $f ] = intval( $css[ $f ] );
			}
		}

		extract( $css );
		// Build CSS String
		ob_start();
		include MC4WP_PLUGIN_DIR . 'includes/views/parts/css-styles.php';
		$css = ob_get_contents();
		ob_end_clean();

		$file = wp_upload_bits( 'mailchimp-for-wp.css', null, $css );

		if( false === $file || ! is_array( $file ) || $file['error'] !== false ) {
			// error, show notice with generated CSS
			$message = sprintf( __( 'Couldn\'t create the stylesheet. Manually add the generated CSS to your theme stylesheet by using the %sTheme Editor%s or use FTP and edit <em>%s</em>.', 'mailchimp-for-wp' ), '<a href="'. admin_url( 'theme-editor.php' ) .'">', '</a>', get_stylesheet_directory() .'/style.css' );
			$button = sprintf( __( '%sShow CSS%s', 'mailchimp-for-wp' ), '<a class="mc4wp-show-css" href="javascript:void(0);">', '</a>' );
			add_settings_error( 'mc4wp', 'mc4wp-css', $message . ' ' . $button .'<div id="mc4wp_generated_css" style="display:none;"><pre style="white-space: pre-wrap;">{$css}</pre></div>' );

		} else {
			// store url to CSS file
			update_option( 'mc4wp_custom_css_file', $file['url'] );

			// show notice
			$opts = mc4wp_get_options('form');
			$enqueue_text = ( $opts['css'] == 'custom' ) ? '' : sprintf( __( 'To apply these styles on your website, select "load custom form styles" in the %sform settings%s', 'mailchimp-for-wp' ), '<a href="' . admin_url('admin.php?page=mc4wp-pro-form-settings') . '">', '</a>.' );
			add_settings_error( 'mc4wp', 'mc4wp-css', sprintf( __( 'The %sCSS Stylesheet%s has been created.', 'mailchimp-for-wp' ), '<a href="'. $file['url'] .'">', '</a>' ) . ' ' . $enqueue_text, 'updated' );

		}

		return $settings;
	}

	/**
	* Build the MCWP Admin Menu
	*/
	public function build_menu() {
		$required_cap = apply_filters('mc4wp_settings_cap', 'manage_options');

		add_menu_page( 'MailChimp for WP Pro', 'MailChimp for WP', $required_cap, 'mc4wp-pro', array( $this, 'show_general_settings_page' ), MC4WP_PLUGIN_URL . 'assets/img/menu-icon.png', '99.13371337');

		// only add admin pages to menu if license is active and valid.
		add_submenu_page( 'mc4wp-pro', 'License & API Settings - MailChimp for WP Pro', 'General Settings', $required_cap, 'mc4wp-pro', array( $this, 'show_general_settings_page' ) );
		add_submenu_page( 'mc4wp-pro', 'Checkboxes - MailChimp for WP Pro', 'Checkboxes', $required_cap, 'mc4wp-pro-checkbox-settings', array( $this, 'show_checkbox_settings_page' ) );
		add_submenu_page( 'mc4wp-pro', 'Forms - MailChimp for WP Pro', 'Forms', $required_cap, 'mc4wp-pro-form-settings', array( $this, 'show_form_settings_page' ) );
		add_submenu_page( 'mc4wp-pro', 'Reports - MailChimp for WP Pro', 'Reports', $required_cap, 'mc4wp-pro-reports', array( $this, 'show_reports_page' ) );

	}

	/**
	* Load scripts and stylesheet on MCWP Admin pages
	*/
	public function load_assets( $hook = '' ) {
		global $pagenow;

		if ( isset( $_GET['page'] ) && stristr( $_GET['page'], 'mc4wp-pro' ) ) {
			/* Any Settings Page */
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_style( 'mc4wp-admin-styles', MC4WP_PLUGIN_URL . 'assets/css/admin-styles.css' );

			wp_register_script( 'mc4wp-admin-settings',  MC4WP_PLUGIN_URL . 'assets/js/admin-settings.js', array( 'jquery', 'wp-color-picker' ), MC4WP_VERSION, true );
			wp_enqueue_script( array( 'jquery', 'mc4wp-admin-settings' ) );

			/* Reports page */
			if ( $_GET['page'] === 'mc4wp-pro-reports' ) {

				// load flot
				wp_register_script( 'mc4wp-flot', MC4WP_PLUGIN_URL . 'assets/js/third-party/jquery.flot.min.js', array( 'jquery' ), MC4WP_VERSION, true );
				wp_register_script( 'mc4wp-flot-time', MC4WP_PLUGIN_URL . 'assets/js/third-party/jquery.flot.time.min.js', array( 'jquery' ), MC4WP_VERSION, true );
				wp_register_script( 'mc4wp-statistics', MC4WP_PLUGIN_URL . 'assets/js/admin-statistics.js', array( 'mc4wp-flot-time' ), MC4WP_VERSION, true );

				wp_enqueue_script( array( 'jquery', 'mc4wp-flot', 'mc4wp-statistics' ) );

				// print ie excanvas script in footer
				add_action( 'admin_print_footer_scripts', array( $this, 'print_excanvas_script' ), 1 );
			}

			/* CSS Edit Page */
			if ( $_GET['page'] === 'mc4wp-pro-form-settings' && isset( $_GET['tab'] ) && $_GET['tab'] === 'css-builder' ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'jquery-ui-accordion' );
				wp_enqueue_script( 'mc4wp-form-css', MC4WP_PLUGIN_URL . 'assets/js/admin-form-css.js', array(), MC4WP_VERSION, true );
			}

		} elseif ( ( $pagenow === 'post.php' || $pagenow === 'post-new.php' ) && get_post_type() === 'mc4wp-form' ) {
			// edit form post type pages
			wp_enqueue_style( 'mc4wp-admin-styles', MC4WP_PLUGIN_URL . 'assets/css/admin-styles.css' );

			wp_register_script( 'mc4wp-beautifyhtml', MC4WP_PLUGIN_URL . 'assets/js/third-party/beautify-html.js', array( 'jquery' ), MC4WP_VERSION, true);
			wp_register_script( 'mc4wp-admin-formhelper',  MC4WP_PLUGIN_URL . 'assets/js/admin-formhelper.js', array( 'jquery' ), MC4WP_VERSION, true );

			wp_enqueue_script( array( 'jquery', 'mc4wp-beautifyhtml', 'mc4wp-admin-formhelper' ) );
			wp_localize_script( 'mc4wp-admin-formhelper', 'mc4wp',
				array(
					'has_captcha_plugin' => $this->has_captcha_plugin
				)
			);

			// we don't need the following scripts
			wp_dequeue_script( 'autosave', 'suggest' );

		}

	}

	/**
	* Get Checkbox integrations
	*
	* @return array 
	*/
	public function get_checkbox_compatible_plugins() {

		$checkbox_plugins = array(
			'comment_form' => __( "Comment form", 'mailchimp-for-wp' ),
			"registration_form" => __( "Registration form", 'mailchimp-for-wp' )
		);

		if( is_multisite() ) {
			$checkbox_plugins['multisite_form'] = __( "MultiSite forms", 'mailchimp-for-wp' );
		}

		if( class_exists("BuddyPress") ) {
			$checkbox_plugins['buddypress_form'] = __( "BuddyPress registration", 'mailchimp-for-wp' );
		}

		if( class_exists('bbPress') ) {
			$checkbox_plugins['bbpress_forms'] = "bbPress";
		}

		if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			$checkbox_plugins['edd_checkout'] = sprintf( __( '%s checkout', 'mailchimp-for-wp' ), 'Easy Digital Downloads' );
		}

		if ( class_exists( 'Woocommerce' ) ) {
			$checkbox_plugins['woocommerce_checkout'] = sprintf( __( '%s checkout', 'mailchimp-for-wp' ), 'WooCommerce' );
		}

		return $checkbox_plugins;
	}

	/**
	* Get selected Checkbox integrations
	* @return array
	*/
	public function get_selected_checkbox_hooks() {
		$checkbox_plugins = $this->get_checkbox_compatible_plugins();
		$selected_checkbox_hooks = array();
		$checkbox_opts = mc4wp_get_options( 'checkbox' );

		// check which checkbox hooks are selected
		foreach ( $checkbox_plugins as $code => $name ) {

			if ( isset( $checkbox_opts['show_at_'.$code] ) && $checkbox_opts['show_at_'.$code] ) { 
				$selected_checkbox_hooks[$code] = $name; 
			}
		}

		return $selected_checkbox_hooks;
	}

	/**
	* Show general settings page
	*/
	public function show_general_settings_page() {
		$opts = mc4wp_get_options('general');

		$connected = mc4wp_get_api()->is_connected();
		$lists = $this->get_mailchimp_lists();

		if ( ! $connected ) {
			add_settings_error( "mc4wp", "invalid-api-key", printf( __( 'Please make sure the plugin is connected to MailChimp. <a href="%s">Provide a valid API key.</a>', 'mailchimp-for-wp' ), admin_url( '?page=mc4wp-pro' ) ), 'updated' );
		}

		require MC4WP_PLUGIN_DIR . 'includes/views/pages/admin-general-settings.php';
	}

	/**
	* Show checkbox settings page
	*/
	public function show_checkbox_settings_page() {
		$opts = mc4wp_get_options('checkbox');
		$lists = $this->get_mailchimp_lists();

		$checkbox_plugins = $this->get_checkbox_compatible_plugins();
		$selected_checkbox_hooks = $this->get_selected_checkbox_hooks();

		require MC4WP_PLUGIN_DIR . 'includes/views/pages/admin-checkbox-settings.php';
	}

	/**
	* Show form settings page
	*/
	public function show_form_settings_page() {
		$tab = ( isset( $_GET['tab'] ) ) ? $_GET['tab'] : 'general-settings';
		$opts = mc4wp_get_options('form');

		if ( $tab === 'general-settings' ) {

			require_once 'tables/class-forms-table.php';
			$table = new MC4WP_Forms_Table( $this );
		} else {
			// forms css page
			$css_keys = array(
				'form_width', 'form_background_color', 'form_font_color', 'form_border_color', 'form_border_width', 'form_horizontal_padding', 'form_vertical_padding', 'form_text_align',
				'paragraphs_font_size', 'paragraphs_font_color', 'paragraphs_vertical_margin',
				'labels_font_color', 'labels_font_style', 'labels_font_size', 'labels_display', 'labels_vertical_margin', 'labels_horizonal_margin', 'labels_width',
				'fields_border_color', 'fields_border_width', 'fields_width', 'fields_height', 'fields_display',
				'buttons_background_color', 'buttons_font_color', 'buttons_font_size', 'buttons_border_color',
				'buttons_hover_background_color', 'buttons_hover_font_color', 'buttons_hover_border_color',
				'buttons_border_width', 'buttons_width', 'buttons_height',
				'messages_font_color_error', 'messages_font_color_success',
				'selector_prefix'
			);

			// fill array with default css settings, prevent having to call isset() every time
			$css = array_merge( array_fill_keys( $css_keys, '' ), get_option( 'mc4wp_form_css', array() ) );

			$forms = get_posts( 'post_type=mc4wp-form&posts_per_page=-1' );
			$form_id = ( isset( $forms[0] ) ) ? $forms[0]->ID : 0;
			$preview_url = add_query_arg( array( 'form_id' => $form_id, '_mc4wp_css_preview' => 1 ), home_url() );
		}

		require MC4WP_PLUGIN_DIR . 'includes/views/pages/admin-form-settings.php';
	}

	/**
	* Show log page
	*/
	public function show_log_page() {
		include_once MC4WP_PLUGIN_DIR . 'includes/tables/class-log-table.php';
		$table = new MC4WP_Log_Table( $this );
		$tab = 'log';
		include_once MC4WP_PLUGIN_DIR . 'includes/views/pages/admin-reports.php';
	}

	/**
	* Show reports (stats) page
	*/
	public function show_stats_page() {
		$statistics = new MC4WP_Statistics();

		// set default range or get range from URL
		$range = ( isset( $_GET['range'] ) ) ? $_GET['range'] : 'last_week';

		// get data
		if ( $range !== 'custom' ) {
			$args = $statistics->get_range_times( $range );
		} else {
			// construct timestamps from given date in select boxes
			$start = strtotime( implode( '-', array( $_GET['start_year'], $_GET['start_month'], $_GET['start_day'] ) ) );
			$end = strtotime( implode( '-', array( $_GET['end_year'], $_GET['end_month'], $_GET['end_day'] ) ) );

			// calculate step size
			$step = $statistics->get_step_size( $start, $end );
			$given_day = $_GET['start_day'];

			$args = compact( "step", "start", "end", "given_day" );
		}

		// check if start timestamp comes after end timestamp
		if ( $args['start'] >= $args['end'] ) {
			$args = $statistics->get_range_times( 'last_week' );
			add_settings_error( 'mc4wp-statistics-error', 'invalid-range', "End date can't be before the start date" );
		}

		// setup statistic settings
		$ticksizestep = ( $args['step'] === 'week' ) ? 'month' : $args['step'];
		$statistics_settings = $this->statistics_settings = array( 'ticksize' => array( 1, $ticksizestep ) );
		$statistics_data = $this->statistics_data = $statistics->get_statistics( $args );

		//$totals = $statistics->get_total_signups( $args );

		// add scripts
		wp_localize_script( 'mc4wp-statistics', 'mc4wp_statistics_data', $statistics_data );
		wp_localize_script( 'mc4wp-statistics', 'mc4wp_statistics_settings', $statistics_settings );


		$start_day = ( isset( $_GET['start_day'] ) ) ? $_GET['start_day'] : 0;
		$start_month = ( isset( $_GET['start_month'] ) ) ? $_GET['start_month'] : 0;
		$start_year = ( isset( $_GET['start_year'] ) ) ? $_GET['start_year'] : 0;
		$end_day = ( isset( $_GET['end_day'] ) ) ? $_GET['end_day'] : 0;
		$end_month = ( isset( $_GET['end_month'] ) ) ? $_GET['end_month'] : 0;
		$end_year = ( isset( $_GET['end_year'] ) ) ? $_GET['end_year'] : 0;
		$tab = 'statistics';

		include_once MC4WP_PLUGIN_DIR . 'includes/views/pages/admin-reports.php';
	}

	/**
	* Show reports page
	*/
	public function show_reports_page() {
		$tab = ( isset( $_GET['tab'] ) ) ? $_GET['tab'] : 'stats';

		if ( $tab === 'log' ) {
			return $this->show_log_page();
		} else {
			return $this->show_stats_page();
		}
	}

	/**
	 * Show a notice if MailChimp for WP Lite is activated
	 */
	public function show_notice_to_deactivate_lite() {
		if ( false === is_plugin_active( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
			return;
		}
		?><div class="updated">
			<p><?php printf( __( '<strong>Welcome to MailChimp for WordPress Pro!</strong> We transfered the settings you had set in the Lite version, please <a href="%s">deactivate it now</a> to prevent problems', 'mailchimp-for-wp' ), admin_url( 'plugins.php#mailchimp-for-wp' ) ); ?></p>
		</div>
		<?php
	}

	/**
	 * Get the name of the MailChimp list with the given ID.
	 *
	 * @param int $id
	 * @return string
	 */
	public function get_mailchimp_list_name( $id ) {
		$lists = (array) $this->get_mailchimp_lists();

		foreach ( $lists as $list ) {
			if ( $list->id == $id ) return $list->name;
		}

		return '';
	}

	/**
	 * Get MailChimp lists
	 * Try cache first, then try API, then try fallback cache.
	 */
	private function get_mailchimp_lists() {

		$cached_lists = get_transient( 'mc4wp_mailchimp_lists' );
		$refresh_cache = ( isset( $_POST['mc4wp-renew-cache'] ) && $_POST['mc4wp-renew-cache'] == 1 );

		if ( true === $refresh_cache || false == $cached_lists || empty( $cached_lists ) ) {

			// make api request for lists
			$api = mc4wp_get_api();
			$lists = array();

			$lists_data = $api->get_lists();
			
			if ( $lists_data ) {

				$lists = array();

					foreach ( $lists_data as $list ) {

						$lists["{$list->id}"] = (object) array(
							'id' => $list->id,
							'name' => $list->name,
							'subscriber_count' => $list->stats->member_count,
							'merge_vars' => array(),
							'interest_groupings' => array()
						);

						// get interest groupings
						$groupings_data = $api->get_list_groupings( $list->id );
						if ( $groupings_data ) {
							$lists["{$list->id}"]->interest_groupings = array_map( array( $this, 'strip_unnecessary_grouping_properties' ), $groupings_data );
						}

					}
				

				// get merge vars for all lists at once
				$merge_vars_data = $api->get_lists_with_merge_vars( array_keys($lists) );
				if ( $merge_vars_data ) {
					foreach ( $merge_vars_data as $list ) {
						// add merge vars to list
						$lists["{$list->id}"]->merge_vars = array_map( array( $this, 'strip_unnecessary_merge_vars_properties' ), $list->merge_vars );
					}
				}

				// cache renewal triggered manually?
				if ( $refresh_cache ) {
					if ( false === empty ( $lists ) ) {
						add_settings_error( "mc4wp", "mc4wp-cache-success", __( 'Renewed MailChimp cache.', 'mailchimp-for-wp' ), 'updated' );
					} else {
						add_settings_error( "mc4wp", "mc4wp-cache-error", __( 'Failed to renew MailChimp cache - please try again later.', 'mailchimp-for-wp' ) );
					}
				}

				// store lists in transients
				set_transient( 'mc4wp_mailchimp_lists', $lists, ( 24 * 3600 ) ); // 1 day
				set_transient( 'mc4wp_mailchimp_lists_fallback', $lists, 1209600 ); // 2 weeks
				return $lists;
			} else {
				// api request failed, get fallback data (with longer lifetime)
				$cached_lists = get_transient( 'mc4wp_mailchimp_lists_fallback' );

				if ( ! $cached_lists ) { 
					return array(); 
				}
			}

		}

		return $cached_lists;
	}

	/**
	 * Build the group array object which will be stored in cache
	 * @return object
	 */
	public function strip_unnecessary_group_properties( $group ) {
		return (object) array(
			'name' => $group->name
		);
	}

	/**
	 * Build the groupings array object which will be stored in cache
	 * @return object
	 */
	public function strip_unnecessary_grouping_properties( $grouping ) {
		return (object) array(
			'id' => $grouping->id,
			'name' => $grouping->name,
			'groups' => array_map( array( $this, 'strip_unnecessary_group_properties' ), $grouping->groups ),
			'form_field' => $grouping->form_field
		);
	}

	/**
	 * Build the merge_var array object which will be stored in cache
	 * @return object
	 */
	public function strip_unnecessary_merge_vars_properties( $merge_var ) {
		$array = array(
			'name' => $merge_var->name,
			'field_type' => $merge_var->field_type,
			'req' => $merge_var->req,
			'tag' => $merge_var->tag
		);

		if ( isset( $merge_var->choices ) ) {
			$array["choices"] = $merge_var->choices;
		}

		return (object) $array;

	}

	/**
	 * Print the IE canvas fallback script in the footer on statistics pages
	 */
	public function print_excanvas_script() {
		?><!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo MC4WP_PLUGIN_URL . 'assets/js/third-party/excanvas.min.js'; ?>"></script><![endif]--><?php
	}

}
