<?php

/**
* Template Name: Gallery
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package Brander
*/



get_header(); ?>



            <!--Thumbnail Navigation-->

            <div id="prevthumb"></div>

            <div id="nextthumb"></div>

            

            <!--Arrow Navigation-->

            <a id="prevslide" class="load-item"></a>

            <a id="nextslide" class="load-item"></a>

            

            <div id="thumb-tray" class="load-item">

                <div id="thumb-back"></div>

                <div id="thumb-forward"></div>

            </div>

            

            <!--Time Bar-->

            <div id="progress-back" class="load-item">

                <div id="progress-bar"></div>

            </div>

            

            <!--Control Bar-->

            <div id="controls-wrapper" class="load-item">

                <div id="controls">

                            

                    <!--Slide captions displayed here-->

                    <div id="slidecaption"></div>

                    

                    <!--Thumb Tray button-->

                    <a id="tray-button"><img id="tray-arrow" src="<?php echo get_template_directory_uri(); ?>/img/button-tray-up.png"/></a>

                    

                    <!--Navigation-->

                    <ul id="slide-list"></ul>

                    

                </div>

            </div>







<?php get_footer(); ?>





        <script type="text/javascript">

            

            jQuery(function($){

                

                $.supersized({

                

                    // Functionality

                    slideshow               :   1,          // Slideshow on/off

                    autoplay                :   1,          // Slideshow starts playing automatically

                    start_slide             :   1,          // Start slide (0 is random)

                    stop_loop               :   0,          // Pauses slideshow on last slide

                    random                  :   0,          // Randomize slide order (Ignores start slide)

                    slide_interval          :   3000,       // Length between transitions

                    transition              :   6,          // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left

                    transition_speed        :   1000,       // Speed of transition

                    new_window              :   1,          // Image links open in new window/tab

                    pause_hover             :   0,          // Pause slideshow on hover

                    keyboard_nav            :   1,          // Keyboard navigation on/off

                    performance             :   1,          // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)

                    image_protect           :   0,          // Disables image dragging and right click with Javascript

                                                               

                    // Size & Position                         

                    min_width               :   0,          // Min width allowed (in pixels)

                    min_height              :   0,          // Min height allowed (in pixels)

                    vertical_center         :   1,          // Vertically center background

                    horizontal_center       :   1,          // Horizontally center background

                    fit_always              :   0,          // Image will never exceed browser width or height (Ignores min. dimensions)

                    fit_portrait            :   1,          // Portrait images will not exceed browser height

                    fit_landscape           :   0,          // Landscape images will not exceed browser width

                                                               

                    // Components                           

                    slide_links             :   false,    // Individual links for each slide (Options: false, 'num', 'name', 'blank')

                    thumb_links             :   1,          // Individual thumb links for each slide

                    thumbnail_navigation    :   0,          // Thumbnail navigation

                    slides                  :   [           // Slideshow Images

     

              <?php if (empty($brander_options['gallery_layout'])): ?>



              <?php else: ?>

                  <?php foreach ($brander_options['gallery_layout'] as $key => $value): ?>

                      {image : "<?php echo $value['image']; ?>", title : "<?php echo $value['description']; ?>", thumb : "<?php echo $value['image']; ?>"},

                  <?php endforeach ?>

              <?php endif ?>                                                                                                                                      

                                                ],

                                                

                    // Theme Options               

                    progress_bar            :   1,          // Timer for each slide                         

                    mouse_scrub             :   0

                    

                });

            });

            

        </script>