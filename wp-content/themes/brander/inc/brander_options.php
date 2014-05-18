<?php
/**
*  ReduxFramework Sample Config File
*  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */

if (!class_exists("Redux_Framework_sample_config")) {

    class Redux_Framework_sample_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( defined('TEMPLATEPATH') && strpos( Redux_Helpers::cleanFilePath( __FILE__ ), Redux_Helpers::cleanFilePath( TEMPLATEPATH ) ) !== false) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
*
*            This is a test function that will let you see when the compiler hook occurs.
*          It only runs if a field   set with compiler=>true is changed.
*
         * */
        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
              require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
              $wp_filesystem->put_contents(
              $filename,
              $css,
              FS_CHMOD_FILE // predefined mode settings for WP files
              );
              }
             */
        }

        /**
*
*          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
*          Simply include this function in the child themes functions.php file.*
*
*          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
*          so you must use get_template_directory_uri() if you want to use any of the built in icons
*
         * */
        function dynamic_section($sections) {
            //$sections = array();


            return $sections;
        }

        /**
*
*          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
*
         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
*
*          Filter hook for filtering the default value of any given field. Very useful in development mode.
*
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = "Testing filter hook!";

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));

            }
        }

        public function setSections() {

            /**
*              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'brander-redux'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo $this->theme->display('Name'); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'brander-redux'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'brander-redux'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'brander-redux') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'brander-redux'), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>

            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }




            // ACTUAL DECLARATION OF SECTIONS

           $this->sections[] = array(
                'icon' => ' el-icon-brush',
                'title' => __('General settings', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'brander_logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Page logo', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Upload your logo. ', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'footer_text',
                        'type' => 'text',
                        'title' => __('Footer text', 'brander-redux'),
                        'desc' => __('Change your footer text. ', 'brander-redux'),
                    ),  

                    array(
                        'id' => 'small_logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Page logo - white', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Upload your logo. ', 'brander-redux'),
                    ),                                        
                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-home',
                'title' => __('Home 01', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'supersized_galery',
                        'type' => 'slides',
                        'title' => __('Add/Edit Images', 'brander-redux'),
                        'subtitle' => __('Add images for your slideshow', 'brander-redux'),
                    ), 
                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-home',
                'title' => __('Home 03', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'h02_revolution_shortcode',
                        'type' => 'text',
                        'title' => __('Revolution Shortcode', 'brander-redux'),
                        'subtitle' => __('Add your revolution slider shortcode here.', 'brander-redux'),
                    ), 
                )
            );    

           $this->sections[] = array(
                'icon' => 'el-icon-home',
                'title' => __('Home 04', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'home04_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                        'subtitle' => __('Add your title here, the title will be displayed on the first block of home layout 4.', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'home04_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Layout logo', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a layout logo. ', 'brander-redux'),
                        'subtitle' => __('Add your logo here, the logo will be displayed on the first block of home layout 4.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo-curved.png'),
                    ),     
                    array(
                        'id' => 'home04_text',
                        'type' => 'textarea',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Add your text here, the text will be displayed on the first block of home layout 4.', 'brander-redux'),
                    ),  
                    array(
                        'id' => 'home04_background',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Background', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a background image your for your Home layout. ', 'brander-redux'),
                        'subtitle' => __('Add your backgoround here, the backgoround will be displayed on the first block of home layout 4.', 'brander-redux'),
                        'default' => array('url' => 'http://placehold.it/1920x1200/8d6d2e/ffffff.jpg'),
                    ),                                                       
                )
            );  


           $this->sections[] = array(
                'icon' => 'el-icon-home',
                'title' => __('Home 05', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'h05_revolution_shortcode',
                        'type' => 'text',
                        'title' => __('Revolution Shortcode', 'brander-redux'),
                        'subtitle' => __('Add your revolution slider shortcode here.', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'home_05_cateogries_01',
                        'type' => 'select',
                        'data' => 'categories',
                        'title' => __('Categories Select Option', 'brander-redux'),
                        'subtitle' => __('No validation can be done on this field type', 'brander-redux'),
                        'desc' => __('This is the description field, again good for additional info.', 'brander-redux'),
                    ),    

                    array(
                        'id' => 'home_05_cateogries_02',
                        'type' => 'select',
                        'data' => 'categories',
                        'title' => __('Categories Select Option', 'brander-redux'),
                        'subtitle' => __('No validation can be done on this field type', 'brander-redux'),
                        'desc' => __('This is the description field, again good for additional info.', 'brander-redux'),
                    ),                                       
                )
            ); 

            $this->sections[] = array(
                'type' => 'divide',
            );


           $this->sections[] = array(
                'icon' => 'el-icon-idea',
                'title' => __('About Layout', 'brander-redux'),
                'fields' => array(


                    array(
                        'id' => 'about_layout_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                        'subtitle' => __('Layout title.', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'about_layout_subtitle',
                        'type' => 'text',
                        'title' => __('Subtitle', 'brander-redux'),
                        'subtitle' => __('Layout subtitle.', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'about_layout_text',
                        'type' => 'editor',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Layout text.', 'brander-redux'),
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                         
                    ),     

  
                    array(
                        'id' => 'about_flip',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Flip effect options', 'brander-redux'),
                    ),

                    array(
                        'id' => 'flip_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Flip image', 'brander-redux'),
                        'compiler' => 'true',
                    ), 

                    array(
                        'id' => 'flip_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                    ),                     

                    array(
                        'id' => 'flip_text',
                        'type' => 'textarea',
                        'title' => __('Text', 'brander-redux'),
                    ),

                    array(
                        'id' => 'about_twitter',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('About twitter image', 'brander-redux'),
                        'compiler' => 'true',
                    ), 

                    array(
                        'id' => 'about_facebook',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('About facebook image', 'brander-redux'),
                        'compiler' => 'true',
                    ),                                         

                )
            );


           $this->sections[] = array(
                'icon' => 'el-icon-question-sign',
                'title' => __('Info Layout', 'brander-redux'),
                'fields' => array(

                    array(
                        'id' => 'info_layout_subtitle',
                        'type' => 'text',
                        'title' => __('Subtitle', 'brander-redux'),
                        'subtitle' => __('Layout subtitle.', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'info_layout_top_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Top Image', 'brander-redux'),
                        'compiler' => 'true',
                    ), 

                    array(
                        'id' => 'info_block1_title',
                        'type' => 'text',
                        'title' => __('Block 1 Title', 'brander-redux'),
                        'subtitle' => __('Info block 1 title.', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'info_block1_text',
                        'type' => 'editor',
                        'title' => __('Block 1 Text', 'brander-redux'),
                        'subtitle' => __('Info block 1 text.', 'brander-redux'),
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                         
                    ),                        

                    array(
                    'id'   =>'divider_1',
                    'type' => 'divide'
                    ), 

                    array(
                        'id' => 'info_block2_title',
                        'type' => 'text',
                        'title' => __('Block 2 Title', 'brander-redux'),
                        'subtitle' => __('Info block 2 title.', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'info_block2_text',
                        'type' => 'editor',
                        'title' => __('Block 2 Text', 'brander-redux'),
                        'subtitle' => __('Info block 2 text.', 'brander-redux'),
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                         
                    ),     

                    array(
                    'id'   =>'divider_1',
                    'type' => 'divide'
                    ), 

                    array(
                        'id' => 'info_layout_image_1',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Additional image 1', 'brander-redux'),
                        'compiler' => 'true',
                    ), 

                    array(
                        'id' => 'info_layout_image_2',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Additional image 2', 'brander-redux'),
                        'compiler' => 'true',
                    ),                                         

                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'title' => __('Gallery Layout', 'brander-redux'),
                'fields' => array(

                    array(
                        'id' => 'gallery_layout',
                        'type' => 'slides',
                        'title' => __('Add/Edit Images', 'brander-redux'),
                        'subtitle' => __('Add images for your gallery layout', 'brander-redux'),
                    ),                                        

                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-group',
                'title' => __('Testimonals Layout', 'brander-redux'),
                'fields' => array(

                    array(
                        'id' => 'testimonials_subtite',
                        'type' => 'text',
                        'title' => __('Layout Subtitle', 'brander-redux'),
                    ),                                        

                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-barcode',
                'title' => __('Pricing Layout', 'brander-redux'),
                'fields' => array(


                    array(
                        'id' => 'pricing_tablles1',
                        'type' => 'textarea',
                        'title' => __('Pricing Tables', 'brander-redux'),
                    ),  

                    array(
                        'id' => 'pricing_tablles2',
                        'type' => 'textarea',
                        'title' => __('Pricing Tables 2', 'brander-redux'),
                    ),  

                    array(
                        'id' => 'pricing_testarea1',
                        'type' => 'textarea',
                        'title' => __('Shortcode test block 1', 'brander-redux'),
                    ),                                                                                                

                    array(
                        'id' => 'pricing_testarea2',
                        'type' => 'textarea',
                        'title' => __('Shortcode test block 2', 'brander-redux'),
                    ),   

                )
            );  

           $this->sections[] = array(
                'icon' => 'el-icon-phone',
                'title' => __('Contact Layout', 'brander-redux'),
                'fields' => array(

                    array(
                        'id' => 'contact_pre-title',
                        'type' => 'text',
                        'title' => __('Layout pre-title', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'contact_subtitle',
                        'type' => 'text',
                        'title' => __('Layout subtitle', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'contact_1',
                        'type' => 'editor',
                        'title' => __('Contact block 1', 'brander-redux'),
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                        
                    ),  

                    array(
                        'id' => 'contact_2',
                        'type' => 'editor',
                        'title' => __('Contact block 2', 'brander-redux'),
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                        
                    ), 

                    array(
                        'id' => 'contact_iframe',
                        'type' => 'textarea',
                        'title' => __('iFrame code', 'brander-redux'),
                    ),                                                                                                                                

                )
            );                     

            $this->sections[] = array(
                'type' => 'divide',
            );            


           $this->sections[] = array(
                'icon' => 'el-icon-music',
                'title' => __('Audio Block', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'audio-mp3',
                        'type' => 'text',
                        'title' => __('Audio mp3 URL', 'brander-redux'),
                    ), 
                                                                                 
                    array(
                        'id' => 'audio-ogg',
                        'type' => 'text',
                        'title' => __('Audio ogg URL', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'audio-wav',
                        'type' => 'text',
                        'title' => __('Audio wav URL', 'brander-redux'),
                    ),                                                                                                      

                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-group',
                'title' => __('Testimonials Block', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'testimonials_background',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Block Background', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a background image your for Testimonials Block. ', 'brander-redux'),
                        'subtitle' => __('Background image.', 'brander-redux'),

                    ),                                                                                                    

                )
            );


           $this->sections[] = array(
                'icon' => 'el-icon-wrench',
                'title' => __('Services Block', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'services_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                        'subtitle' => __('Block title.', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'services_text',
                        'type' => 'textarea',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Block text.', 'brander-redux'),
                    ),     
                    array(
                        'id' => 'price_shortcode',
                        'type' => 'textarea',
                        'title' => __('Shortcodes', 'brander-redux'),
                        'subtitle' => __('Shortcodes block.', 'brander-redux'),
                        'description' => __('If left empty, shortcode blocks will not be displayed in the Service Block.', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'services_background',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Block Background', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a background image your for Services Block. ', 'brander-redux'),
                        'subtitle' => __('Background image.', 'brander-redux'),
                        'default' => array('url' => 'http://placehold.it/1920x1200/8d6d2e/ffffff.jpg'),
                    ),                                                          
                )
            );                    

           $this->sections[] = array(
                'icon' => 'el-icon-folder-open',
                'title' => __('Projects Block', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'project_slides',
                        'type' => 'slides',
                        'title' => __('Project Slides', 'brander-redux'),
                        'subtitle' => __('Add logos or pictures of your latest projects.', 'brander-redux'),
                        'placeholder' => array(
                            'title' => __('This is a title', 'brander-redux'),
                            'description' => __('Description Here', 'brander-redux'),
                            'url' => __('Give us a link!', 'brander-redux'),
                        ),
                    ),                                                                                      

                )
            );


           $this->sections[] = array(
                'icon' => 'el-icon-file',
                'title' => __('Latest Post Block', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'latest_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                        'subtitle' => __('Block title.', 'brander-redux'),
                        'desc' => 'Add a title for your Latest Post Block.',
                    ),

                    array(
                        'id' => 'latest_text',
                        'type' => 'textarea',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Block text.', 'brander-redux'),
                        'desc' => 'Add some text for your Latest Post Block',                      
                    ),                                                                                    

                )
            );


           $this->sections[] = array(
                'icon' => 'el-icon-th-large',
                'title' => __('Split Row Block', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'split_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Image', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a background image your for Split Row Block. ', 'brander-redux'),
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => 'http://placehold.it/1920x1200/8d6d2e/ffffff.jpg'),
                    ), 

                    array(
                        'id' => 'split_text',
                        'type' => 'editor',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Block text.', 'brander-redux'),
                        'desc' => 'Add some text for your Split Row Block',
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                        
                    ),                                                                                    

                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-photo',
                'title' => __('Theme Features Block', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'features_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                        'subtitle' => __('Block title.', 'brander-redux'),
                        'desc' => 'Add a title for your Theme Features Block.',
                    ),

                    array(
                        'id' => 'features_text',
                        'type' => 'editor',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Block text.', 'brander-redux'),
                        'desc' => 'Add some text for your Theme Features Block',
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                        
                    ),

                    array(
                        'id' => 'features_background',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Block Background', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a background image your for About Block. ', 'brander-redux'),
                        'subtitle' => __('Background image.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/svgBackground.jpg'),
                    ),      

                    array(
                        'id' => 'svg_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('SVG mockup image', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add mockup image for your SVG effect. ', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/svg-overlay.png'),
                    ),  

                    array(
                        'id' => 'svg_pathss',
                        'type' => 'textarea',
                        'title' => __('SVG Paths', 'brander-redux'),
                        'desc' => 'Add your SVG paths.',
                    ),  

                    array(
                        'id' => 'svg_specs',
                        'type' => 'multi_text',
                        'title' => __('Theme features list', 'brander-redux'),
                        'desc' => __('Add 6 items that will appear with your SVG effect.', 'brander-redux')
                    ),                                                                                        

                )
            );

           $this->sections[] = array(
                'icon' => 'el-icon-idea',
                'title' => __('About Block Settings', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'about_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                        'subtitle' => __('Block title.', 'brander-redux'),
                        'desc' => 'Add a title for your About Block.',
                    ),

                    array(
                        'id' => 'about_text',
                        'type' => 'editor',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Block text.', 'brander-redux'),
                        'desc' => 'Add some text for your About Block',
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                        
                    ),

                    array(
                        'id' => 'about_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Image', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add an image your for About Block. Recomended size 226x226.', 'brander-redux'),
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => 'http://placehold.it/226x226/8d6d2e/ffffff.jpg'),
                    ),

                    array(
                        'id' => 'about_subtitle',
                        'type' => 'text',
                        'title' => __('Image Title', 'brander-redux'),
                        'subtitle' => __('Image title.', 'brander-redux'),
                        'desc' => 'Add title for your image. The title will be displayed on image hover.',
                    ),

                    array(
                        'id' => 'about_slug',
                        'type' => 'text',
                        'title' => __('Readmore link', 'brander-redux'),
                        'desc' => 'Add a page slug of the page that you want "Read more" to be linked with.',
                    ),

                    array(
                        'id' => 'about_background',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Block Background', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a background image your for About Block. ', 'brander-redux'),
                        'subtitle' => __('Background image.', 'brander-redux'),
                        'default' => array('url' => 'http://placehold.it/1680x1050/181818/ffffff.jpg'),
                    ),                                     

                )
            );



           $this->sections[] = array(
                'icon' => 'el-icon-phone',
                'title' => __('Contact Block Settings', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'contact_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                        'subtitle' => __('Block title.', 'brander-redux'),
                        'desc' => 'Add a title for your Contact Block.',
                    ),

                    array(
                        'id' => 'contact_text',
                        'type' => 'editor',
                        'title' => __('Text', 'brander-redux'),
                        'subtitle' => __('Block text.', 'brander-redux'),
                        'desc' => 'Add some text for your Contact Block',
                        'editor_options'   => array(
                            'media_buttons'            => false
                        )                        
                    ),


                    array(
                        'id' => 'contact_background',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Block Background', 'brander-redux'),
                        'compiler' => 'true',
                        'desc' => __('Add a background image your for Contact Block.', 'brander-redux'),
                        'subtitle' => __('Background image.', 'brander-redux'),
                        'default' => array('url' => 'http://placehold.it/1680x1050/181818/ffffff.jpg'),
                    ),                     

                    array(
                        'id' => 'notice_info_contact',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Contact Block 1', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_1_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_1_text',
                        'type' => 'textarea',
                        'title' => __('Text', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_1_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Icon', 'brander-redux'),
                        'compiler' => 'true',
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/icon-1.png'),
                    ),
                    array(
                        'id' => 'contact_1_hover_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Icon Hover', 'brander-redux'),
                        'compiler' => 'true',
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/icon-1-hover.png'),
                    ),                    
        


                    array(
                        'id' => 'notice_info_contact_2',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Contact Block 2', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_2_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_2_text',
                        'type' => 'textarea',
                        'title' => __('Text', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_2_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Icon', 'brander-redux'),
                        'compiler' => 'true',
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/icon-2.png'),
                    ),
                    array(
                        'id' => 'contact_2_hover_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Icon Hover', 'brander-redux'),
                        'compiler' => 'true',
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/icon-2-hover.png'),
                    ),                


                    array(
                        'id' => 'notice_info_contact_3',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Contact Block 3', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_3_title',
                        'type' => 'text',
                        'title' => __('Title', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_3_text',
                        'type' => 'textarea',
                        'title' => __('Text', 'brander-redux'),
                    ),
                    array(
                        'id' => 'contact_3_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Icon', 'brander-redux'),
                        'compiler' => 'true',
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/icon-3.png'),
                    ),
                    array(
                        'id' => 'contact_3_hover_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Icon Hover', 'brander-redux'),
                        'compiler' => 'true',
                        'subtitle' => __('Block image.', 'brander-redux'),
                        'default' => array('url' => get_template_directory_uri().'/img/icon-3-hover.png'),
                    ),   

                )
            );



            $this->sections[] = array(
                'type' => 'divide',
            );            

           $this->sections[] = array(
                'icon' => 'el-icon-bullhorn',
                'title' => __('Social Settings', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'twitter_feed',
                        'type' => 'text',
                        'title' => __('Username for twitter feed', 'brander-redux'),
                    ), 

                    array(
                        'id' => 'social_info',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Social Info', 'brander-redux'),
                        'desc' => __('If left empty then social icons won\'t be displayed', 'brander-redux'),                        
                    ),                    
                    array(
                        'id' => 'facebook',
                        'type' => 'text',
                        'title' => __('Facebook URL', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'twitter',
                        'type' => 'text',
                        'title' => __('Twitter URL', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'dribbble',
                        'type' => 'text',
                        'title' => __('Dribbble URL', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'vimeeo',
                        'type' => 'text',
                        'title' => __('Vimeo URL', 'brander-redux'),
                    ), 
                    array(
                        'id' => 'linkedin',
                        'type' => 'text',
                        'title' => __('Linkedin URL', 'brander-redux'),
                    ),                                                                                 
                                                         
                )
            );  




            $this->sections[] = array(
                'type' => 'divide',
            );            

           $this->sections[] = array(
                'icon' => 'el-icon-brush',
                'title' => __('Theme modification', 'brander-redux'),
                'fields' => array(

                    array(
                        'id'        => 'dark_or_lights',
                        'type'      => 'switch',
                        'title'     => __('Theme color version', 'redux-framework-demo'),
                        'subtitle'  => __('Use dark or light theme?', 'redux-framework-demo'),
                        'default'   => 1,
                        'on'        => 'Dark',
                        'off'       => 'Light',
                    ),


                    array(
                        'id'        => 'sticky_heads',
                        'type'      => 'switch',
                        'title'     => __('Sticky header', 'redux-framework-demo'),
                        'subtitle'  => __('Use sticky header?', 'redux-framework-demo'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),

                    array(
                        'id'       => 'theme_color',
                        'type'     => 'color',
                        'title'    => __('Theme main color', 'ava-united'), 
                        'subtitle' => __('Change your golden color (default: #8d6d2e).', 'ava-united'),
                        'default'  => '#8d6d2e',
                        'validate' => 'color',
                    ),


                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('Theme icons and images', 'redux-framework-demo'),
                    ), 

                    array(
                        'id' => 'brander_preload',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Preloader', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/preload.gif'),
                    ) ,  

                    array(
                        'id' => 'fancyGoldenSeperator',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Golden seperator', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/fancyGoldenseperator.png'),
                    ),   


                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('SVG text lines', 'redux-framework-demo'),
                    ),      

                    array(
                        'id' => 'line_1',
                        'type' => 'media',
                        'title' => __('Line 1', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/pointy-1.png'),
                    ),                                                      
           
                    array(
                        'id' => 'line_2',
                        'type' => 'media',
                        'title' => __('Line 2', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/pointy-2.png'),
                    ),  

                    array(
                        'id' => 'line_3',
                        'type' => 'media',
                        'title' => __('Line 3', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/pointy-3.png'),
                    ) ,

                    array(
                        'id' => 'line_4',
                        'type' => 'media',
                        'title' => __('Line 4', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/pointy-4.png'),
                    ),  

                    array(
                        'id' => 'line_5',
                        'type' => 'media',
                        'title' => __('Line 5', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/pointy-5.png'),
                    )  ,

                    array(
                        'id' => 'line_6',
                        'type' => 'media',
                        'title' => __('Line 6', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/pointy-1.png'),
                    )  ,                                                                                                            

                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('Read more arrows', 'redux-framework-demo'),
                    ),  

                    array(
                        'id' => 'read_more_arrow',
                        'type' => 'media',
                        'title' => __('Read more arrow', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/read-more-arrow.png'),
                    )  ,   

                    array(
                        'id' => 'read_more_arrow_large',
                        'type' => 'media',
                        'title' => __('Read more arrow large', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/read-more-hover.png'),
                    )  ,                      


                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('Scrolling icons', 'redux-framework-demo'),
                    ),

                    array(
                        'id' => 'to_top',
                        'type' => 'media',
                        'title' => __('Scroll to top', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/scrolly.png'),
                    )  , 

                    array(
                        'id' => 'revolutionScroll',
                        'type' => 'media',
                        'title' => __('Scroll to bottom', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/scrolly-bottom.png'),
                    )  ,                     

                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('Navigational arrows', 'redux-framework-demo'),
                    ),

                    array(
                        'id' => 'testimonial_arrows',
                        'type' => 'media',
                        'title' => __('Testimonials arrows', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/testimonial-arrows.png'),
                    )  ,                     


                    array(
                        'id' => 'gallery_next',
                        'type' => 'media',
                        'title' => __('Gallery arrows', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/next_pre.png'),
                    )  , 



                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('Post icons', 'redux-framework-demo'),
                    ),

                    array(
                        'id' => 'post_zoom',
                        'type' => 'media',
                        'title' => __('Zoom', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/icon-zoom_gold.png'),
                    )  ,                         


                    array(
                        'id' => 'post_zoom_small',
                        'type' => 'media',
                        'title' => __('Zoom Small', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/icon-zoom_gold_small.png'),
                    )  ,

                    array(
                        'id' => 'post_link',
                        'type' => 'media',
                        'title' => __('Link', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/icon-link_gold.png'),
                    )  ,  

                    array(
                        'id' => 'post_link_small',
                        'type' => 'media',
                        'title' => __('Link Small', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/icon-link_gold_small.png'),
                    )  ,  

                    array(
                        'id' => 'post_zoom_2',
                        'type' => 'media',
                        'title' => __('Zoom alternative', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/zoomy.png'),
                    )  ,

                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('Post format specific', 'redux-framework-demo'),
                    ),

                    array(
                        'id' => 'video_icon',
                        'type' => 'media',
                        'title' => __('Video play', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/youtubePlay.png'),
                    )  ,


                    array(
                        'id' => 'link_icon',
                        'type' => 'media',
                        'title' => __('Link icon', 'brander-redux'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/img/link.png'),
                    )  ,

                    array(
                        'id'    => 'opt-info',
                        'type'  => 'info',
                        'desc'  => __('Custom CSS', 'redux-framework-demo'),
                    ),

                    array(
                        'id' => 'custom_css',
                        'type' => 'textarea',
                        'title' => __('Custom CSS', 'brander-redux'),
                    )  ,

                )
            );  






            $this->sections[] = array(
                'type' => 'divide',
            );





            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'brander-redux') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'brander-redux') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'brander-redux') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'brander-redux') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';



            $this->sections[] = array(
                'icon' => 'el-icon-info-sign',
                'title' => __('Theme Information', 'brander-redux'),
                'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'brander-redux'),
                'fields' => array(
                    array(
                        'id' => 'raw_new_info',
                        'type' => 'raw',
                        'content' => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon' => 'el-icon-book',
                    'title' => __('Documentation', 'brander-redux'),
                    'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => __('Theme Information 1', 'brander-redux'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'brander-redux')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => __('Theme Information 2', 'brander-redux'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'brander-redux')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'brander-redux');
        }

        /**
*
*          All the possible arguments for Redux.
*          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
*
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'brander_options', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Brander Options', 'brander-redux'),
                'page_title' => __('Brander Options', 'brander-redux'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                //'async_typography' => false, // Use a asynchronous font on the front end or font string
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => true, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority'     => 3,  // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => 'dashicons-welcome-widgets-menus', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );
                'hints' => array(
                    'icon'              => 'icon-question-sign',
                    'icon_position'     => 'right',
                    'icon_color'        => 'lightgray',
                    'icon_size'         => 'normal',

                    'tip_style'         => array(
                        'color'     => 'light',
                        'shadow'    => true,
                        'rounded'   => false,
                        'style'     => '',
                    ),
                    'tip_position'      => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon' => 'el-icon-github'
                    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon' => 'el-icon-linkedin'
            );



            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'brander-redux'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'brander-redux');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'brander-redux');
        }

    }

    new Redux_Framework_sample_config();
}


/**
*
*  Custom function for the callback referenced above
*
 */
if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }

endif;

/**
*
*  Custom function for the callback validation referenced above
*
 * */
if (!function_exists('redux_validate_callback_function')):

    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }


endif;