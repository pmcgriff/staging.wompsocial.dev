<?php
/*-----------------------------------------------------------------------------------*/
/*  Add portfolio Post Types
/*-----------------------------------------------------------------------------------*/

function brander_create_post_type_portfolio() 
{
  $labels = array(
    'name' => __( 'Portfolio','brander'),
    'singular_name' => __( 'Portfolio Item','brander' ),
    'add_new' => __('Add New','brander'),
    'add_new_item' => __('Add New Portfolio Item','brander'),
    'edit_item' => __('Edit Portfolio Item','brander'),
    'new_item' => __('New Portfolio Item','brander'),
    'view_item' => __('View Portfolio Item','brander'),
    'search_items' => __('Search Portfolio Item','brander'),
    'not_found' =>  __('No posts found','brander'),
    'not_found_in_trash' => __('No posts found in Trash','brander'), 
    'parent_item_colon' => ''
    );
    
    $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'menu_icon'=> 'dashicons-portfolio',
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail', 'excerpt')
    ); 
    
    register_post_type(__( 'portfolio', 'brander' ),$args);
}

add_action( 'init', 'brander_create_post_type_portfolio' );


add_action( 'admin_init', 'portfolio_meta' );
function portfolio_meta()
{
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;
    $prefix = 'rw_';
    $meta_boxes = array();
    // 1st meta box
    $meta_boxes[] = array(
        'title'    => 'Post options',
        'pages'    => array( 'portfolio' ),
        'fields' => array(
          array(
                'name' => 'Subtitle',
                'description' => 'Post Subtitle',
                'id'   => 'subtitle',
                'type' => 'text',
            ),            
            array(
                'name' => 'Select post size',
                'id'   => 'size',
                'type' => 'radio',
                'options' => array(
                  'medium' => __( 'Large', 'medium' ),
                  'small' => __( 'Small', 'small' ),
                ),
            ), 
                                   
                                            
        )
    );     
   
    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}


#-----------------------------------------------------------------#
# Add taxonomys attached to portfolio
#-----------------------------------------------------------------# 

$category_labels = array(
 'name' => __( 'Portfolio Categories', 'clix'),
 'singular_name' => __( 'Portfolio Category', 'clix'),
 'search_items' =>  __( 'Search Portfolio Categories', 'clix'),
 'all_items' => __( 'All Portfolio Categories', 'clix'),
 'parent_item' => __( 'Parent Portfolio Category', 'clix'),
 'edit_item' => __( 'Edit Portfolio Category', 'clix'),
 'update_item' => __( 'Update Portfolio Category', 'clix'),
 'add_new_item' => __( 'Add New Portfolio Category', 'clix'),
    'menu_name' => __( 'Portfolio Categories', 'clix')
);  

register_taxonomy("project-type", 
  array("portfolio"), 
  array("hierarchical" => true, 
    'labels' => $category_labels,
    'show_ui' => true,
       'query_var' => true,
    'rewrite' => array( 'slug' => 'project-type' )
));



/*-----------------------------------------------------------------------------------*/
/*  Add Testimonials Post Types
/*-----------------------------------------------------------------------------------*/

function brander_create_post_type_testimonials() 
{
  $labels = array(
    'name' => __( 'Testminonials','brander'),
    'singular_name' => __( 'Testminonial Item','brander' ),
    'add_new' => __('Add New','brander'),
    'add_new_item' => __('Add New Testminonial Item','brander'),
    'edit_item' => __('Edit Testminonial Item','brander'),
    'new_item' => __('New Testminonial Item','brander'),
    'view_item' => __('View Testminonial Item','brander'),
    'search_items' => __('Search Testminonial Item','brander'),
    'not_found' =>  __('No posts found','brander'),
    'not_found_in_trash' => __('No posts found in Trash','brander'), 
    'parent_item_colon' => ''
    );
    
    $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'menu_icon'=> 'dashicons-groups',
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail', 'excerpt')
    ); 
    
    register_post_type(__( 'testimonials', 'brander' ),$args);
}

add_action( 'init', 'brander_create_post_type_testimonials' );


/*-----------------------------------------------------------------------------------*/
/*  Add Services Post Types
/*-----------------------------------------------------------------------------------*/

function brander_create_post_type_service() 
{
  $labels = array(
    'name' => __( 'Services','brander'),
    'singular_name' => __( 'Service Item','brander' ),
    'add_new' => __('Add New','brander'),
    'add_new_item' => __('Add New Service Item','brander'),
    'edit_item' => __('Edit Service Item','brander'),
    'new_item' => __('New Service Item','brander'),
    'view_item' => __('View Service Item','brander'),
    'search_items' => __('Search Service Item','brander'),
    'not_found' =>  __('No posts found','brander'),
    'not_found_in_trash' => __('No posts found in Trash','brander'), 
    'parent_item_colon' => ''
    );
    
    $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'menu_icon'=> 'dashicons-admin-tools',
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail')
    ); 
    
    register_post_type(__( 'service', 'brander' ),$args);
}

add_action( 'init', 'brander_create_post_type_service' );


add_action( 'admin_init', 'service_meta' );
function service_meta()
{
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;
    $prefix = 'rw_';
    $meta_boxes = array();
    // 1st meta box
    $meta_boxes[] = array(
        'title'    => 'Service options',
        'pages'    => array( 'service' ),
        'fields' => array(
          array(
                'name' => 'Iconic',
                'description' => 'Set icon for your service item',
                'id'   => 'iconic',
                'type' => 'image_advanced',
            ),            

          array(
                'name' => 'URL',
                'description' => 'Set URL for your "View portfolio" link',
                'id'   => 'service_url',
                'type' => 'text',
            ),
                                   
                                            
        )
    );     
   
    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Add Team Members Post Types
/*-----------------------------------------------------------------------------------*/

function brander_create_post_type_team() 
{
  $labels = array(
    'name' => __( 'Team Members','brander'),
    'singular_name' => __( 'Team Member','brander' ),
    'add_new' => __('Add New','brander'),
    'add_new_item' => __('Add New Team Member','brander'),
    'edit_item' => __('Edit Team Member','brander'),
    'new_item' => __('New Team Member','brander'),
    'view_item' => __('View Team Member','brander'),
    'search_items' => __('Search Team Member','brander'),
    'not_found' =>  __('No posts found','brander'),
    'not_found_in_trash' => __('No posts found in Trash','brander'), 
    'parent_item_colon' => ''
    );
    
    $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'menu_icon'=> 'dashicons-id-alt',
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail')
    ); 
    
    register_post_type(__( 'team', 'brander' ),$args);
}

add_action( 'init', 'brander_create_post_type_team' );

add_filter( 'rwmb_meta_boxes', 'team_meta' );
function team_meta( $meta_boxes )
{
    $prefix = 'rw_';
    // 1st meta box
    $meta_boxes[] = array(
        'id'       => 'personal',
        'title'    => 'Personal Information',
        'pages'    => array( 'team' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
          array(
                'name' => 'Position',
                'id'   => 'position',
                'type' => 'text',
            ),
        )
    );
    // 2nd meta box
    $meta_boxes[] = array(
        'title'    => 'Social links',
        'pages'    => array( 'team' ),
        'fields' => array(
          array(
                'name' => 'Facebook URL',
                'id'   => 'facebook_url',
                'type' => 'text',
            ),
  
          array(
                'name' => 'Twitter URL',
                'id'   => 'twitter_url',
                'type' => 'text',
            ),                                   
  
          array(
                'name' => 'Vimeo URL',
                'id'   => 'vimeo_url',
                'type' => 'text',
            ),   

          array(
                'name' => 'Dribbble URL',
                'id'   => 'dribbble_url',
                'type' => 'text',
            ),   

          array(
                'name' => 'Linkedin URL',
                'id'   => 'linkedin_url',
                'type' => 'text',
            ), 
        )
    );
    return $meta_boxes;
}




/*-----------------------------------------------------------------------------------*/
/*  REGULAR POST TYPES
/*-----------------------------------------------------------------------------------*/

add_filter( 'rwmb_meta_boxes', 'post_meta' );
function post_meta( $meta_boxes )
{
    $prefix = 'rw_';
    // 1st meta box
    $meta_boxes[] = array(
        'id'       => 'personal',
        'title'    => 'Additional Fields',
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
          array(
                'name' => 'Post format fields',
                'id'   => 'post_additional',
                'type' => 'text',
                'desc' => 'Additional fields for specific post formats: <br /><br />
                Video format: add your video url here<br />
                Audio format: add your soundcloud url here<br />
                Quote format: add your quote here<br/>
                Link format: add your link url here',
            ),
        )
    );

    return $meta_boxes;
}