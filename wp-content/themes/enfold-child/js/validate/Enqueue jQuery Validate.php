/*
 * add jQuery Form Validation Plugin
 */

if (is_page('Home')) {
    function jquery_validate() {
          wp_enqueue_script('jquery_validate', get_template_directory_uri() . '/js/validate/jquery.validate.min.js', array( 'jquery' ) , '1.11', TRUE);
          wp_enqueue_script('jquery_add_method', get_template_directory_uri() . '/js/validate/additional-methods.min.js', array( 'jquery_validate' ) , '1.11', TRUE);
          wp_enqueue_script('contactus_validate', get_template_directory_uri() . '/js/validate/form-validator-script.js', array( 'jquery_validate' ) , '1.0', TRUE);  
    }

    add_action( 'wp_enqueue_scripts', 'jquery_validate' );
}