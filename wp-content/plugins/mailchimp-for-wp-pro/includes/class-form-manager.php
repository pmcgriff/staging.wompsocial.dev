<?php

if( ! defined("MC4WP_VERSION") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

class MC4WP_Form_Manager
{	
	/**
	* @var int
	*/
	private $form_instance_number = 1;

	/**
	* @var string
	*/
	private $error = '';

	/**
	* @var boolean
	*/
	private $success = false;

	/**
	* @var int
	*/
	private $submitted_form_instance = 0;

	/**
	* @var boolean
	*/
	private $loaded_ajax_scripts = false;

	/**
	* @var array
	*/
	private $posted_data = array();

	/**
	 * @var array
	 */
	private $options = array();

    /**
     * @var bool
     */
    private $loader_css_printed = false;

	/**
	 * @var string
	 */
	private $mailchimp_error = '';

	/**
	* Constructor
	*/
	public function __construct() 
	{
		$this->options = $opts = mc4wp_get_options( 'form' );

		add_action( 'init', array( $this, 'initialize' ) );
		add_action( 'template_redirect', array( $this, 'show_form_preview' ), 1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_stylesheet' ) );

		// enable shortcodes in text widgets
		add_filter( 'widget_text', 'shortcode_unautop' );
		add_filter( 'widget_text', 'do_shortcode' );

		add_shortcode( 'mc4wp_form', array( $this, 'output_form' ) );

		// deprecated. use mc4wp_form.
		add_shortcode( 'mc4wp-form', array( $this, 'output_form' ) );
				
		// has a form been submitted, either by ajax or manually?
		if( isset( $_POST['_mc4wp_form_submit'] ) ) {
			$this->ensure_backwards_compatibility();

			if( ! defined( 'DOING_AJAX') || ! DOING_AJAX ) {
				// do not submit the form until later, to make sure all WP functions are available
				add_action( 'init', array( $this, 'submit' ) );
			} else {
				add_action( 'wp_ajax_nopriv_mc4wp_submit_form', array( $this, 'ajax_submit' ) );
				add_action( 'wp_ajax_mc4wp_submit_form', array( $this, 'ajax_submit' ) );
			}
		}

	}

	/**
	* Initialize form stuff
	*
	* - Registers post type
	* - Registers scripts
	*/
	public function initialize() {

		// register post type
		register_post_type( 'mc4wp-form', array(
			'labels' => array(
				'name' => 'MailChimp Sign-up Forms',
				'singular_name' => 'Sign-up Form',
				'add_new_item' => 'Add New Form',
				'edit_item' => 'Edit Form',
				'new_item' => 'New Form',
				'all_items' => 'All Forms',
				'view_item' => null
				),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => false
			)
		);

		// register placeholder script, which will later be enqueued for IE only
		wp_register_script( 'mc4wp-placeholders', MC4WP_PLUGIN_URL . 'assets/js/third-party/placeholders.min.js', array(), MC4WP_VERSION, true );
	
		// register ajax script
		wp_register_script( 'mc4wp-ajax-forms', MC4WP_PLUGIN_URL . 'assets/js/ajax-forms.js', array( 'jquery-form' ), MC4WP_VERSION, true );
	
		// register non-AJAX script (that handles form submissions)
		wp_register_script( 'mc4wp-forms', MC4WP_PLUGIN_URL . 'assets/js/forms.js', array(), MC4WP_VERSION, true );

	}

	/**
	* Loads a basic HTML template to preview forms
	* @return boolean
	*/
	public function show_form_preview()
	{
		if( isset( $_GET['_mc4wp_css_preview'] ) === false ) {
			return false;
		}

		require MC4WP_PLUGIN_DIR . 'includes/views/pages/form-preview.php';
		die();
	}

	/**
	* Tells the plugin which shipped stylesheets to load.
	*
	* @return bool True if a stylesheet was enqueued
	*/
	public function load_stylesheet( ) {

		if( $this->options['css'] == false || isset( $_GET['_mc4wp_css_preview'] ) ) {
			return false;
		}

		$opts = $this->options;

		if( $opts['css'] === 'custom' ) {

			// load the custom stylesheet
			$custom_stylesheet = get_option( 'mc4wp_custom_css_file', false );

			// prevent query on every pageload if option does not exist
			if( false === $custom_stylesheet ) {
				update_option( 'mc4wp_custom_css_file', '' );
			}

			// load stylesheet
			if( is_string( $custom_stylesheet ) && $custom_stylesheet !== '' ) {
				wp_enqueue_style( 'mc4wp-custom-form-css', $custom_stylesheet, array(), MC4WP_VERSION, 'all' );
			}

		} elseif( $opts['css'] !== 1 && $opts['css'] !== 'default' ) {

			if( $opts['css'] === 'custom-color' ) {
				// load the custom color theme
				$custom_color = urlencode( $opts['custom_theme_color'] );
				wp_enqueue_style( 'mailchimp-for-wp-form-theme-' . $opts['css'], MC4WP_PLUGIN_URL . "assets/css/form-theme-custom.php?custom-color=" . $custom_color, array(), MC4WP_VERSION, 'all' );

			} else {
				// load one of the default form themes
				$form_theme = $opts['css'];
				if( in_array( $form_theme, array( 'blue', 'green', 'dark', 'light', 'red' ) ) ) {
					wp_enqueue_style( 'mailchimp-for-wp-form-theme-' . $opts['css'], MC4WP_PLUGIN_URL . "assets/css/form-theme-{$opts['css']}.css", array(), MC4WP_VERSION, 'all' );
				}
			}

		} else {
			// load just the basic form reset
			wp_enqueue_style( 'mailchimp-for-wp-form', MC4WP_PLUGIN_URL . "assets/css/form.css", array(), MC4WP_VERSION, 'all' );
		}

		return true;
	}

	/**
	* Get CSS classes to add to a form element
	*
	* @param int $form_id
	* @return string
	*/ 
	public function get_form_css_classes( $form_id ) {

		$settings = mc4wp_get_form_settings( $form_id, true );

		$css_classes = array(
			'form',
			'mc4wp-form',
			'mc4wp-form-' . $form_id
		);

		if( $settings['ajax'] ) { 
			$css_classes[] = 'mc4wp-ajax'; 
		}

		if( $this->error !== '' ) {
			$css_classes[] = 'mc4wp-form-error';
		}

		if( $this->success === true ) {
			$css_classes[] = 'mc4wp-form-success';
		}

		// allow developers to add css classes
		$css_classes = apply_filters( 'mc4wp_form_css_classes', $css_classes, $form_id );

		return implode( ' ', $css_classes );
	}

	/**
	* Outputs a form with the given ID
	*
	* @param array $atts
	* @param string $content
	* @return string 
	*/
	public function output_form( $atts = array(), $content = null )
	{
		// include the necessary functions file
		if( ! function_exists( 'mc4wp_replace_variables' ) ) {
			include_once MC4WP_PLUGIN_DIR . 'includes/functions/template.php';
		}

		// try to get default form ID if it wasn't specified in the shortcode atts
		if( ! isset( $atts['id'] ) ) { 

			// try to get default form id
			$atts['id'] = get_option( 'mc4wp_default_form_id', 0 );

			// failure? :(
			if( ! $atts['id'] ) {
				return ( current_user_can( 'manage_options' ) ) ? '<p><strong>MailChimp for WP Pro error:</strong> Please specify a form ID in the shortcode attributes. Example: <code>[mc4wp-form id="31"]</code></p>' : ''; 
			}
		}

		$form = get_post( $atts['id'] );

		if( ! $form || $form->post_type != 'mc4wp-form' ) { 
			return ( current_user_can( 'manage_options' ) ) ? '<p><strong>MailChimp for WP Pro error:</strong> Sign-up form not found. Please check if you have used the correct form ID.</p>' : ''; 
		}

		// get form, first element in posts array
		$form_ID = $form->ID;
		$form_markup = __( $form->post_content );
		$settings = mc4wp_get_form_settings( $form_ID, true );

		// add some useful css classes
		$css_classes = $this->get_form_css_classes( $form_ID );

		// does this form have AJAX enabled?
		if( $settings['ajax'] && ! $this->loaded_ajax_scripts ) { 
			
			// get ajax scripts to load in the footer
			wp_enqueue_script( 'mc4wp-ajax-forms' );

            // Print inline CSS in footer
			add_action( 'wp_footer', array( $this, 'print_loader_css') );

			$scheme = ( is_ssl() ) ? 'https' : 'http';
			wp_localize_script( 'mc4wp-ajax-forms', 'mc4wp_vars', array(
					'ajaxurl' => admin_url( 'admin-ajax.php', $scheme )
				)
			);

			$this->loaded_ajax_scripts = true;
		}

		if( ! function_exists( 'mc4wp_get_current_url' ) ) {
			require_once MC4WP_PLUGIN_DIR . 'includes/functions/template.php';
		}

		$content = "<!-- MailChimp for WP Pro v" . MC4WP_VERSION . " -->";
		$content .= '<div id="mc4wp-form-' . $this->form_instance_number . '" class="' . $css_classes . '">';

		// show the form fields if not submitted or if submitted with hide_after_success == false
		if( ! ( $this->success && $settings['hide_after_success'] ) ) {

			$form_action = apply_filters( 'mc4wp_form_action', mc4wp_get_current_url() );
			$content .= '<form method="post" action="' . $form_action . '">';

			// replace special values
			$form_markup = str_ireplace( array( '%N%', '{n}' ), $this->form_instance_number, $form_markup );
			$form_markup = mc4wp_replace_variables( $form_markup, array_values( $settings['lists'] ) );

			// insert captcha
			if( function_exists( 'cptch_display_captcha_custom' ) ) {
				$captcha_fields = '<input type="hidden" name="_mc4wp_has_captcha" value="1" /><input type="hidden" name="cntctfrm_contact_action" value="true" />' . cptch_display_captcha_custom();
				$form_markup = str_ireplace( '[captcha]', $captcha_fields, $form_markup );
			}

			// allow plugins to add form fields
			do_action( 'mc4wp_before_form_fields', $form_ID );

			// allow plugins to alter form content
			$content .= apply_filters( 'mc4wp_form_content', $form_markup, $form_ID );

			// allow plugins to add form fields
			do_action( 'mc4wp_after_form_fields', $form_ID );

			// hidden fields
			$content .= '<textarea name="_mc4wp_required_but_not_really" style="display: none !important;"></textarea>';
			$content .= '<input type="hidden" name="_mc4wp_form_ID" value="'. $form_ID .'" />';
			$content .= '<input type="hidden" name="_mc4wp_form_instance" value="'. $this->form_instance_number .'" />';
			$content .= '<input type="hidden" name="_mc4wp_form_submit" value="1" />';
			$content .= '<input type="hidden" name="_mc4wp_form_nonce" value="'. wp_create_nonce( '_mc4wp_form_nonce' ) .'" />';
			$content .= "</form>";
		}


		// if ajax, output all error messages (but hidden)
		if( $settings['ajax'] ) {

			$content .= '<span class="mc4wp-ajax-loader" style="display: none;"></span>';

			// output all error messages but hide them
			$messages = array( 'success', 'already_subscribed', 'invalid_email', 'invalid_captcha', 'error' );

			foreach( $messages as $m ) {

				if( ! isset( $settings['text_'. $m] ) || empty( $settings['text_'. $m] ) ) {
					continue;
				}

				$content .= '<div style="display:none !important;" class="' . $this->get_alert_css_class( $m ) . '">'. __( $settings['text_'. $m] ) . ' <span class="mc4wp-mailchimp-error"></span></div>';
				
			}
		} 

		if( (int) $this->form_instance_number === (int) $this->submitted_form_instance ) {
			// only show success or error messages if this is the form that was submitted.

			if( $this->success ) {
				$content .= '<div class="mc4wp-alert mc4wp-success">' . __( $settings['text_success'] ) . '</div>';
			} elseif( $this->error ) {
				
				$api = mc4wp_get_api();
				$e = $this->error;

				// show error messages
				$error_type = ( $e == 'already_subscribed' ) ? 'notice' : 'error';
				$error_message = isset( $settings['text_' . $e] ) ? $settings['text_' . $e] : $settings['text_error'];

				// allow developers to customize error message
				$error_message = apply_filters( 'mc4wp_form_error_message', $error_message, $e );

				$content .= '<div class="mc4wp-alert mc4wp-'. $error_type .'">'. __( $error_message ) . '</div>';

				// show the eror returned by MailChimp?
				if ( $api->has_error() && current_user_can( 'manage_options' ) ) {
					$content .= '<div class="mc4wp-alert mc4wp-error"><strong>Admin notice:</strong> '. $api->get_error_message() . '</div>';
				}
	
			}
		}

		/* WordPress Administrators only */
		if( empty( $settings['lists'] ) && current_user_can( 'manage_options' ) ) {
			$content .= '<div class="mc4wp-alert mc4wp-error"><strong>Admin notice:</strong> you have not yet selected a MailChimp list(s) for this form. <a href="'. get_admin_url( null, "post.php?post={$form_ID}&action=edit" ) .'">Edit this sign-up form</a> and select at least one list.</div>';
		} 

		$content .= "</div>";
		$content .= "<!-- / MailChimp for WP Pro -->";

		// increase form instance number in case there is more than one form on a page
		$this->form_instance_number++;

		// make sure scripts are enqueued later
		global $is_IE;
		if( isset( $is_IE ) && $is_IE ) {
			wp_enqueue_script( 'mc4wp-placeholders' );
		}

		return $content;
	}

	/**
	* Gets the CSS class string for the form notice.
	*
	* @param string $code
	* @return string
	*/
	private function get_alert_css_class( $code ) {

		$class = "mc4wp-alert mc4wp-{$code}-message ";

		switch( $code ) {

			case 'success':
				$class .= "mc4wp-success";
			break;

			case 'already_subscribed':
				$class .= "mc4wp-notice";
			break;

			default:
				$class .= "mc4wp-error";
			break;

		}

		return $class;
	}


	/**
	* Runs for default form submits (non-AJAX)
	*
	* @return boolean True on success
	*/
	public function submit()
	{
		// check nonce
		if(!isset($_POST['_mc4wp_form_nonce']) || !wp_verify_nonce( $_POST['_mc4wp_form_nonce'], '_mc4wp_form_nonce' )) { 
			$this->error = 'invalid_nonce';
			$success = false;
		} else {
			$success = $this->subscribe();
		}

		$this->submitted_form_instance = absint($_POST['_mc4wp_form_instance']);

		// enqueue scripts (in footer)
		wp_enqueue_script( 'mc4wp-forms' );
		wp_localize_script( 'mc4wp-forms', 'mc4wp', array(
			'success' => $success,
			'submittedFormId' => intval($this->submitted_form_instance),
			'postData' => $this->posted_data
			)
		);

		if($success) { 

			$form_ID = $_POST['_mc4wp_form_ID'];
			$settings = mc4wp_get_form_settings($form_ID, true);

			// check if we want to redirect the visitor
			if ( !empty( $settings['redirect'] ) ) {
				wp_redirect( $settings['redirect'] );
				exit;
			}

			return true;
		} else {
			return false;
		}
	}

	/**
	* Runs on AJAX submitted forms.
	*
	* @return JSON Object containing the various result parameters.
	*/
	public function ajax_submit()
	{
		// check nonce, die if invalid.
		check_ajax_referer('_mc4wp_form_nonce', '_mc4wp_form_nonce');

		// unset AJAX $_POST action
		if( isset( $_POST['action'] ) ) {
			unset( $_POST['action'] );
		}

		$success = $this->subscribe();
		$response = array();
		$response['success'] = $success;
		
		if( true === $success ) {
			$form_ID = $_POST['_mc4wp_form_ID'];
			$settings = mc4wp_get_form_settings($form_ID, true);
			$response['redirect'] = (empty($settings['redirect'])) ? false : $settings['redirect'];
			$response['hide_form'] = ($settings['hide_after_success'] == 1);
		} else {
			$response['error'] = $this->error;
			$response['mailchimp_error'] = $this->mailchimp_error;
			$response['show_error'] = current_user_can('manage_options');
		}

		// clear output, some plugins might have thrown errors by now.
		if( ob_get_level() > 0 ) {
			ob_end_clean();
		}

		header( "Content-Type: application/json" );
		echo json_encode($response);
		exit;
	}

	/**
	* Act on posted data
	*/
	private function subscribe()
	{	
		// check if honeypot was filled
		if( isset( $_POST['_mc4wp_required_but_not_really'] ) && ! empty( $_POST['_mc4wp_required_but_not_really'] ) ) {
			// spam bot filled the honeypot field
			$this->error = 'spam';
			return false;
		}

		// check if captcha was present and valid
		if( isset( $_POST['_mc4wp_has_captcha'] ) && $_POST['_mc4wp_has_captcha'] == 1 && function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) {
			$this->error = 'invalid_captcha';
			return false;
		}

		// get form ID
		$form_id = ( isset( $_POST['_mc4wp_form_ID'] ) ) ? intval( $_POST['_mc4wp_form_ID'] ) : 0;

		// allow plugins to add additional validation
		$valid_form_request = apply_filters( 'mc4wp_valid_form_request', true, $form_id );
		if( $valid_form_request !== true ) {
			$this->error = $valid_form_request;
			return false;
		}

		// get individual form settings
		$settings = mc4wp_get_form_settings( $form_id, true );

		// get lists for submitted form 
		$lists = $this->get_form_lists( $form_id );
		
		if( empty( $lists ) ) {
			$this->error = 'no_lists_selected';
			return false;
		}

		// Let's go
		$data = $this->get_posted_form_data();
		$merge_vars = array();
		$email = null;

		// add all submited variables to merge vars array
		foreach( $data as $name => $value ) {

			// uppercase all variables
			$name = trim( strtoupper( $name ) );
			$value = ( is_scalar( $value ) ) ? trim( $value ) : $value;

			if( $name === 'EMAIL' && is_email( $value ) ) {
				// set the email address
				$email = $value;
			} else if($name === 'GROUPINGS') {
				// try to properly format groupings
				$groupings = $value;

				// malformed groupings data, do nothing..
				if( ! is_array( $groupings ) ) { 
					continue; 
				}

				$merge_vars['GROUPINGS'] = array();

				foreach($groupings as $grouping_id_or_name => $groups) {

					$grouping = array();

					// group ID or group name given?
					if( is_numeric( $grouping_id_or_name ) ) {
						$grouping['id'] = $grouping_id_or_name;
					} else {
						$grouping['name'] = $grouping_id_or_name;
					}

					// comma separated list should become an array
					if( ! is_array( $groups ) ) {
						$groups = explode( ',', $groups );
					}
					
					$grouping['groups'] = array_map( 'stripslashes', $groups );
					

					// add grouping to array
					$merge_vars['GROUPINGS'][] = $grouping;
				}

				// unset groupings if not used
				if( empty( $merge_vars['GROUPINGS'] ) ) { 
					unset( $merge_vars['GROUPINGS'] ); 
				}
				
			} else if( $name === 'BIRTHDAY' ) {
				// format birthdays in the MM/DD format required by MailChimp
				$merge_vars['BIRTHDAY'] = date( 'm/d', strtotime( $value ) );
			} else if( $name === 'ADDRESS' ) {
				
				if( ! isset( $value['addr1'] ) ) {
					// addr1, addr2, city, state, zip, country 
					$addr_pieces = explode( ',', $value );

					// try to fill it.... this is a long shot
					$merge_vars['ADDRESS'] = array(
						'addr1' => $addr_pieces[0],
						'city' => ( isset( $addr_pieces[1] ) ) ? $addr_pieces[1] : '',
						'state' => ( isset( $addr_pieces[2] ) ) ? $addr_pieces[2] : '',
						'zip' => ( isset( $addr_pieces[3] ) ) ? $addr_pieces[3] : ''
					);

				} else {
					// form contains the necessary fields already: perfection
					$merge_vars['ADDRESS'] = $value;
				}

			} else {
				// just add to merge vars array
				$merge_vars[$name] = $value;
			}	
		}

		// check if an email address has been found
		if( ! $email ) {
			$this->error = 'invalid_email';
			return false;
		}

		// Try to guess FNAME and LNAME if they are not given, but NAME is
		if( isset( $merge_vars['NAME'] ) && ! isset( $merge_vars['FNAME'] ) && ! isset( $merge_vars['LNAME'] ) ) {

			$strpos = strpos( $merge_vars['NAME'], ' ' );
			if( $strpos !== false ) {
				$merge_vars['FNAME'] = substr( $merge_vars['NAME'], 0, $strpos );
				$merge_vars['LNAME'] = substr( $merge_vars['NAME'], $strpos );
			} else {
				$merge_vars['FNAME'] = $merge_vars['NAME'];
			}

		}

		// everything is ready and sanitized
		// now make the subscribe request

		$api = mc4wp_get_api();
		$result = false;

		do_action( 'mc4wp_before_subscribe', $email, $merge_vars, $form_id );

		// get email type for this form
		$email_type = $this->get_form_email_type( $form_id );
	
		// make subscribe request for each selected list
		foreach( $lists as $list_id ) {

			// allow plugins to alter merge vars for each individual list
			$list_merge_vars = apply_filters( 'mc4wp_merge_vars', $merge_vars, $form_id, $list_id );

			// send a subscribe request to MailChimp for each list
			$result = $api->subscribe( $list_id, $email, $list_merge_vars, $email_type, $settings['double_optin'], $settings['update_existing'], $settings['replace_interests'], $settings['send_welcome'] );
		}

		do_action( 'mc4wp_after_subscribe', $email, $merge_vars, $form_id, $result );

		if( $result !== true ) {

			// request failed, store error 
			$this->success = false;
			$this->error = $result;
			$this->mailchimp_error = $api->get_error_message();
			return false;
		} 

		// store user email in a cookie
		$this->set_email_cookie( $email );

		// send an email copy if that is desired
		if( $settings['send_email_copy'] == true ) {
			$this->send_email( $email, $merge_vars, $form_id );
		}

		/**
		* @depreciated Don't use, will be removed in v2.0
		*/
		$from_url = ( isset( $_SERVER['HTTP_REFERER'] ) ) ? $_SERVER['HTTP_REFERER'] : '';
		do_action( 'mc4wp_subscribe_form', $email, $lists, $form_id, $merge_vars, $from_url ); 

		$this->success = true;
		return true;
	}

	/**
	* Get posted form data
	*
	* Strips internal MailChimp for WP variables from the posted data array
	*
	* @return array
	*/
	public function get_posted_form_data() {

		$data = array();

		foreach( $_POST as $name => $value ) {
			if( $name[0] !== '_' ) {
				$data[$name] = $value;
			}
		}

		// store data somewhere safe
		$this->posted_data = $data;

		return $data;
	}

	/**
	* Gets the email_type for a form
	* @return string The email type to use for subscription coming from this form
	*/
	public function get_form_email_type( $form_id ) {

		$email_type = 'html';

		// get email type from form
		if( isset( $_POST['_mc4wp_email_type'] ) ) {
			$email_type = trim( $_POST['_mc4wp_email_type'] );
		}

		// allow plugins to override this email type
		$email_type = apply_filters( 'mc4wp_email_type', $email_type, $form_id );

		return $email_type;
	}

	/**
	* Get selected MailChimp Lists for a form
	* 
	* @param int $form_id Numeric ID of the form
	* @return array Array of selected MailChimp lists
	*/
	public function get_form_lists( $form_id ) {

		// get individual form settings
		$settings = mc4wp_get_form_settings( $form_id, true );

		// set lists to subscribe to
		$lists = $settings['lists'];

		// get lists from form, if set.
		if( isset( $_POST['_mc4wp_lists'] ) && ! empty( $_POST['_mc4wp_lists'] ) ) {

			$lists = $_POST['_mc4wp_lists'];

			// make sure lists is an array
			if( ! is_array( $lists ) ) {
				$lists = array( $lists );
			}

		}

		// allow plugins to alter the lists to subscribe to
		$lists = apply_filters( 'mc4wp_lists', $lists, $form_id );

		return $lists;
	}

	/**
	* Stores the given email in a cookie for 30 days
	*
	* @param string $email
	*/
	public function set_email_cookie( $email ) {
		setcookie( 'mc4wp_email', $email, strtotime( '+30 days' ), '/' );
	}

	/**
	 * Send an email with a subscription summary to a given email address
	 *
	 * @param $email
	 * @param $merge_vars
	 * @param $form_id
	 */
	private function send_email($email, $merge_vars, $form_id) {

		$settings = mc4wp_get_form_settings( $form_id );

		// email receiver
		$to = $settings['email_copy_receiver'];
	 	
		$form = get_post($form_id);
		$form_name = $form->post_title;

	 	// email subject
	 	$subject = "New MailChimp Sign-Up - ". get_bloginfo('name');
	  
		// build email message
		ob_start();

		?>
		<h3>MailChimp for WordPress: New Sign-Up</h3>
		<p><strong><?php echo $email; ?></strong> signed-up at <?php echo date("H:i"); ?> on <?php echo date("d/m/Y"); ?> using the form "<?php echo $form_name; ?>".</p>
		<table cellspacing="0" cellpadding="10" border="0" style="border:1px solid #bbb;">
			<tbody>
				<tr>
					<td><strong>EMAIL</strong></td>
					<td><?php echo $email; ?></td>
				</tr>
				<?php 
				foreach( $merge_vars as $field_name => $value ) { 

						if( $field_name == 'GROUPINGS' ) {			 
							foreach( $value as $grouping ) {

								$grouping_name = isset( $grouping['name'] ) ? $grouping['name'] : $grouping['id'];
								$groups = implode( ', ', $grouping['groups'] );
								?>
								<tr>
									<td><strong>GROUPING:</strong> <?php echo $grouping_name; ?></td>
									<td><?php echo $groups; ?></td>
								</tr>
								<?php			
							}
						} else {

							if( is_array( $value ) ) {
								$value = implode( ", ", $value );
							}

							?>
							<tr>
								<td><strong><?php echo $field_name; ?></strong></td>
								<td><?php echo $value; ?></td>
							</tr>
							<?php						
						}
				} 
				?>
			</tbody>
		</table>
		<p style="color:#666;">This email was auto-sent by the MailChimp for WordPress plugin.</p>				
		<?php		  
		$message = ob_get_contents();
		ob_end_clean();

		// filters
		$message = apply_filters('mc4wp_email_copy', $message, $email, $merge_vars, $form_id);
	 
		// send email
		wp_mail( $to, $subject, $message, "Content-Type: text/html" );
	}

	/**
	* Prints the AJAX Loader CSS (Inline)
	*/
	public function print_loader_css() {

        $print_css = apply_filters( 'mc4wp_print_ajax_loader_styles', true );

        if( $print_css !== true || $this->loader_css_printed === true ) {
            return false;
        }

		?><style type="text/css">
		.mc4wp-ajax-loader{ 
			vertical-align: middle; 
			height: 16px; 
			width:16px; 
			border:0; 
			background: url("<?php echo esc_html( MC4WP_PLUGIN_URL . 'assets/img/ajax-loader.gif' ); ?>"); 
		}
		</style><?php

        $this->loader_css_printed = true;
	}

	/*
	* Formats old GROUPINGS field into the proper format for the new style
	*
	* @deprecated 2.0
	*/
	public function ensure_backwards_compatibility()
	{
		// detect old style GROUPINGS, then fix it.
		if( isset( $_POST['GROUPINGS'] ) && is_array( $_POST['GROUPINGS'] ) && isset( $_POST['GROUPINGS'][0] ) ) {

			$old_groupings = $_POST['GROUPINGS'];
			unset( $_POST['GROUPINGS'] );
			$new_groupings = array();

			foreach( $old_groupings as $grouping ) {

				if( ! isset( $grouping['id'] ) && ! isset( $grouping['name'] ) ) { 
					continue; 
				}

				if( ! isset( $grouping['groups'] ) ) { 
					continue; 
				}

				$key = (isset($grouping['id'])) ? $grouping['id'] : $grouping['name'];

				$new_groupings[$key] = $grouping['groups'];

			}

			// re-fill $_POST array with new groupings
			if( ! empty( $new_groupings ) ) { 
				$_POST['GROUPINGS'] = $new_groupings; 
			}

		}

		return;
	}
}