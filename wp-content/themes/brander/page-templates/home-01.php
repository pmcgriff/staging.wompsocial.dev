<?php

/**
* Template Name: Home 01
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





        <div id="mains" role="main">



            <div class="revolutionRow supersizedHomeRow">

                <div class="aboutRow themeFeatures supersizedBackground">

                    <div class="row">

                        <div class="blockTitle">

                            <img id="womp-logo" src="http://www.wompsocial.com/wp-content/uploads/revslider/womptease/header_logo.png" draggable="false" alt="">
                        </div>


                        <div class="large-10 large-centered columns">

                            <?php if (empty($brander_options['features_text'])): ?>

                                <p>Welcome</p>

                             <?php else: ?>

                                <p><?php echo $brander_options['features_text']; ?></p>

                             <?php endif ?>

                        </div>


                        <img id="womp-invite" src="<?php echo $brander_options['svg_image']['url']; ?>" alt="" /> 



                    </div>

                </div>



            </div>
            </div>

</body>

</html>
