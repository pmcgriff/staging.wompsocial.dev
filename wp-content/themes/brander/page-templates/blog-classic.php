<?php

/**
    * Template Name: Blog - Classic
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



                        <?php query_posts('');  if (have_posts()) : while (have_posts()) : the_post(); ?>

                          <?php

                            // The following determines what the post format is and shows the correct file accordingly

                            $format = get_post_format();

                            get_template_part( 'post_formats/'.$format );

                            if($format == '')

                            get_template_part( 'post_formats/standard' );

                          ?>

                        <?php endwhile; endif; ?>

                                                                                                    

                    </div> 



                    <div class="large-4 medium-4 columns sideBar">

                        <div class="widget">

                            <div class="title">

                                Popular posts

                            </div>

                            <?php 

                            $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );

                            while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>

                            <div class="item">

                                <div class="large-8 columns">

                                    <div class="side-title">

                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                                    </div>

                                    <div class="excerpt"><?php echo wp_trim_words( get_the_content(), 5 ); ?></div>

                                </div>

                                <div class="large-4 columns">

                                    <?php if(has_post_thumbnail()) { the_post_thumbnail('99x75'); }?>

                                </div>

                            </div>

                            <?php   endwhile; ?>                            



                        </div>  



                                                                                             

                    </div>                                                           

                </div>   



                        

            </div>







<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>



<?php get_footer(); ?>