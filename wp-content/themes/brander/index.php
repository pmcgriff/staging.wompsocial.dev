<?php
/**
 * The main template file.
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
                <div class="row">
                    <div class="large-12 columns">
                        <div class="newsTitle">
                           BLOG CLASSIC                    
                        </div>                                       
                    </div>
                    <div class="large-8 columns medium-8 mainHold">

                        <?php 
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                              'paged' => $paged
                            );

                            query_posts($args);
                          if (have_posts()) : while (have_posts()) : the_post(); ?>
                          <?php
                            // The following determines what the post format is and shows the correct file accordingly
                            $format = get_post_format();
                            get_template_part( 'post_formats/'.$format );
                            if($format == '')
                            get_template_part( 'post_formats/standard' );
                          ?>
                        <?php endwhile; ?>
                        <!-- End of the main loop -->

                        <!-- Add the pagination functions here. -->

                        <div class="branderPageNavi">
                            <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
                            <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>                            
                        </div>



                        <?php else : ?>
                        <p><?php _e('Sorry, no posts matched your criteria.', 'brander'); ?></p>
                        <?php endif; ?>
                                                                                                    
                    </div> 


    

                </div>   
  
                        
            </div>



<!-- Contact Block -->
<?php get_template_part( 'page_blocks/contact' ); ?>





<?php get_footer(); ?>
