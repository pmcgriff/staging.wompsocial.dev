<?php

/**
* Template Name: Woo Commerce Cart
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



<div id="scroll-tm" class="doubleNews blogClassic">            

    <div class="row blogSingle">

        <div class="large-12 columns">

            <div class="newsTitle">

               <?php the_title(); ?>                

            </div>                                       

        </div>                    

        <div class="large-8 columns medium-8 mainHold">

            <div class="large-12 columns">

                <div class="cartContent">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <?php the_content(); ?>

                    <?php endwhile; endif ?>

                </div>                 

            </div>



                                                              

        </div> 



        <div class="large-4 medium-4 columns sideBar wooSidebarWidgets">



            <?php dynamic_sidebar('woo-sidebar'); ?>

                                                                                            

        </div> 



                        

    </div>

</div>







 

<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

