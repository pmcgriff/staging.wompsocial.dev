<?php
/**
 * Enfold Child Theme - Starter
 *
 * @since Enfold Starter 1.0
 *
 * Add your own functions here. You can also copy some of the theme functions into this file.
 * Wordpress will use those functions instead of the original functions then.
 *
 * @link http://www.kriesi.at/documentation/enfold/using-a-child-theme/
 */

/**
 * Turn on Custom CSS Class field for all Avia Layout Builder elements
 * @link http://www.kriesi.at/documentation/enfold/turn-on-custom-css-field-for-all-alb-elements/
 */
add_theme_support('avia_template_builder_custom_css');


/**
 * Turn on Advanced Template Builder DSebug Mode to see short codes.
 * @link http://www.kriesi.at/support/topic/avia-builder-update-for-posts/
 */
add_action('avia_builder_mode', "builder_set_debug");

if(!function_exists('builder_set_debug')) {
    function builder_set_debug()
    {
        return "debug";
    }
}


/*
 * add jQuery Form Validation Plugin - Customized for Mailchimp for Wordpress
 */

if(!function_exists('jquery_validate_load')) {
    function jquery_validate_load() {
        wp_enqueue_script( 'jquery_validate', get_template_directory_uri() . '/js/validate/jquery.validate.min.js', array( 'jquery' ), '1.11', true );
        wp_enqueue_script( 'jquery_add_method', get_template_directory_uri() . '/js/validate/additional-methods.min.js', array( 'jquery_validate' ), '1.11', true );
        wp_enqueue_script( 'contactus_validate', get_template_directory_uri() . '/js/validate/form-validator-script.js', array( 'jquery_validate' ), '1.0', true );
    }
}

add_action( 'wp_enqueue_scripts', 'jquery_validate_load' );


/**        MUST BE PUT AT THE END OF THIS FUNCTIONS.PHP FILE     ******
 * Add filter to add or replace Enfold ALB shortcodes with new folder contents
 *
 * Note that the shortcodes must be in the same format as those in
 * enfold/config-templatebuilder/avia-shortcodes
 *
 * @link http://www.kriesi.at/documentation/enfold/add-new-or-replace-advanced-layout-builder-elements-from-child-theme/
 */

add_filter('avia_load_shortcodes', 'avia_include_shortcode_template', 15, 1);
function avia_include_shortcode_template($paths)
{
    $template_url = get_stylesheet_directory();
    array_unshift($paths, $template_url.'/shortcodes/');

    return $paths;
}


/*
 * add cssShake File
 */

if(!function_exists('cssShake_load')) {
    function cssShake_load() {
        wp_enqueue_style( 'cssShake', get_template_directory_uri() . '/css/csshake.css');
    }
}

add_action( 'wp_enqueue_scripts', 'cssShake_load' );