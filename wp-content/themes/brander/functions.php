<?php

/**
 * Brander functions and definitions
 *
 * @package Brander
 */



/**
 * Set the content width based on the theme's design and stylesheet.
 */





require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';



add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function my_theme_register_required_plugins() {



	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(



		// This is an example of how to include a plugin pre-packaged with a theme

		array(

			'name'     				=> 'Redux Framework', // The plugin name

			'slug'     				=> 'redux-framework-master', // The plugin slug (typically the folder name)

			'source'   				=> get_stylesheet_directory() . '/plugins/redux-framework-master.zip', // The plugin source

			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required

			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

		),







		array(

			'name'     				=> 'Revolution slider', // The plugin name

			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)

			'source'   				=> get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source

			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required

			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

		),



		array(

			'name'     				=> 'Shortcodes Ultimate Maker', // The plugin name

			'slug'     				=> 'shortcodes-ultimate-maker', // The plugin slug (typically the folder name)

			'source'   				=> get_stylesheet_directory() . '/plugins/shortcodes-ultimate-maker.zip', // The plugin source

			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required

			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

		),



		// This is an example of how to include a plugin from the WordPress Plugin Repository

		array(

			'name' 		=> 'Metabox',

			'slug' 		=> 'meta-box',

			'required' 	=> true,

		),		



		array(

			'name' 		=> 'Contact Form 7',

			'slug' 		=> 'contact-form-7',

			'required' 	=> true,

		),	



		array(

			'name' 		=> 'Woo Commerce',

			'slug' 		=> 'woocommerce',

			'required' 	=> true,

		),	



		array(

			'name' 		=> 'Shortcodes Ultimate',

			'slug' 		=> 'shortcodes-ultimate',

			'required' 	=> true,

		),



	);



	// Change this to your theme text domain, used for internationalising strings

	$theme_text_domain = 'tgmpa';



	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */

	$config = array(

		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.

		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins

		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug

		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug

		'menu'         		=> 'install-required-plugins', 	// Menu slug

		'has_notices'      	=> true,                       	// Show admin notices or not

		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not

		'message' 			=> '',							// Message to output right before the plugins table

		'strings'      		=> array(

			'page_title'                       			=> __( 'Install Required Plugins', 'brander' ),

			'menu_title'                       			=> __( 'Install Plugins', 'brander' ),

			'installing'                       			=> __( 'Installing Plugin: %s', 'brander' ), // %1$s = plugin name

			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'brander' ),

			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)

			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)

			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)

			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)

			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)

			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),

			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),

			'return'                           			=> __( 'Return to Required Plugins Installer', 'brander' ),

			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'brander' ),

			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'brander' ), // %1$s = dashboard link

			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'

		)

	);



	tgmpa( $plugins, $config );



}





#-----------------------------------------------------------------#

# Load Brander Options Panel

#-----------------------------------------------------------------#

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/redux-framework/ReduxCore/framework.php' ) ) {

	require_once( dirname( __FILE__ ) . '/redux-framework/ReduxCore/framework.php' );

}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/redux-framework/sample/sample-config.php' ) ) {

	require_once( dirname( __FILE__ ) . '/redux-framework/sample/sample-config.php' );

}

if ( class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/brander_options.php' ) ) {

	require_once( dirname( __FILE__ ) . '/inc/brander_options.php' );

}





if ( ! isset( $content_width ) ) {

	$content_width = 640; /* pixels */

}



if ( ! function_exists( 'brander_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function brander_setup() {



	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 * If you're building a theme based on Brander, use a find and replace

	 * to change 'brander' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'brander', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

	 */

	//add_theme_support( 'post-thumbnails' );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(

		'primary' => __( 'Primary Menu', 'brander' ),

	) );



	// Enable support for Post Formats.

	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'quote', 'link' ) );



	// Setup the WordPress core custom background feature.

	add_theme_support( 'custom-background', apply_filters( 'brander_custom_background_args', array(

		'default-color' => 'ffffff',

		'default-image' => '',

	) ) );



	  add_theme_support( 'post-thumbnails' );

	  set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

	  add_image_size( '333x490', 333, 490, true ); 

	  add_image_size( '333x239', 333, 239, true ); 

	  add_image_size( '512x340', 512, 340, true );

	  add_image_size( '526x395', 526, 395, true );	   

	  add_image_size( '497x322', 497, 322, true );

	  add_image_size( '497x296', 497, 296, true );

	  add_image_size( '368x401', 368, 401, true );

	  add_image_size( '256x220', 256, 220, true );	  

	  add_image_size( '248x215', 248, 215, true );

	  add_image_size( '745x385', 745, 385, true );	  

	  add_image_size( '370x382', 370, 382, true );

	  add_image_size( '372x376', 372, 376, true );

	  add_image_size( '99x75', 99, 75, true );

	  add_image_size( 'w339', 339, 9999);

	  add_image_size( 'w650', 650, 9999);

	  add_image_size( 'h1006', 9999, 1006);

	  add_image_size( 'h609', 9999, 609);

	  add_image_size( 'testimonials', 136, 136, true ); 





	// Enable support for HTML5 markup.

	add_theme_support( 'html5', array(

		'comment-list',

		'search-form',

		'comment-form',

		'gallery',

	) );

}

endif; // brander_setup

add_action( 'after_setup_theme', 'brander_setup' );



/**
 * Register widgetized area and update sidebar with default widgets.
 */

function brander_widgets_init() {

	register_sidebar( array(

		'name'          => __( 'Sidebar', 'brander' ),

		'id'            => 'sidebar-1',

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

}

add_action( 'widgets_init', 'brander_widgets_init' );



function woo_sidebar() {

	register_sidebar( array(

		'name'          => __( 'Woo Commerce Sidebar', 'brander' ),

		'id'            => 'woo-sidebar',

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

}

add_action( 'widgets_init', 'woo_sidebar' );



/**
 * Implement the Custom Header feature.
 */

//require get_template_directory() . '/inc/custom-header.php';



/**
 * Custom template tags for this theme.
 */

require get_template_directory() . '/inc/template-tags.php';



/**
 * Custom functions that act independently of the theme templates.
 */

require get_template_directory() . '/inc/extras.php';



/**
 * Customizer additions.
 */

require get_template_directory() . '/inc/customizer.php';



/**
 * Load Jetpack compatibility file.
 */

require get_template_directory() . '/inc/jetpack.php';





/**
 * Register Scripts
 */

require get_template_directory() . '/inc/register_scripts.php';



/**
 * Custom post types
 */

require get_template_directory() . '/inc/post_types.php';


/*Theme modifications*/
require get_template_directory() . '/inc/brander_modification.php';











//Custom Excerpt size

function custom_excerpt_length( $length ) {

	return 22;

}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



function wpb_set_post_views($postID) {

    $count_key = 'wpb_post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if($count==''){

        $count = 0;

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');

    }else{

        $count++;

        update_post_meta($postID, $count_key, $count);

    }

}

//To keep the count accurate, lets get rid of prefetching

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



function wpb_track_post_views ($post_id) {

    if ( !is_single() ) return;

    if ( empty ( $post_id) ) {

        global $post;

        $post_id = $post->ID;    

    }

    wpb_set_post_views($post_id);

}

add_action( 'wp_head', 'wpb_track_post_views');













function mytheme_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		extract($args, EXTR_SKIP);



		if ( 'div' == $args['style'] ) {

			$tag = 'div';

			$add_below = 'comment';

		} else {

			$tag = 'li';

			$add_below = 'div-comment';

		}

?>

		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

		<?php if ( 'div' != $args['style'] ) : ?>

		<div id="div-comment-<?php comment_ID() ?>" class="comment">



	



		<?php endif; ?>

		<div class="who">

		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>

		

		</div>

<?php if ($comment->comment_approved == '0') : ?>

		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'brander') ?></em>

		<br />

<?php endif; ?>



		<div class="what">

			<?php comment_text() ?>

			<p class="details">Comment by <?php printf(__('%s', 'brander'), get_comment_author_link()) ?> / <?php

				printf( __('%1$s at %2$s', 'brander'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'brander'),'  ','' );

			?></p>			

		</div>



		



		<div class="reply">

		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

		</div>

		<?php if ( 'div' != $args['style'] ) : ?>

		</div>

		<?php endif; ?>

<?php

        }


