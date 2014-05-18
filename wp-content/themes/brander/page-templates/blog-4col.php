<?php

/**
    * Template Name: Blog - 4 Col
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



            <div id="scroll-tm" class="doubleNews blog2Col blog4Col">

                <div class="row">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                        

                    <div class="large-12 columns">

                        <div class="newsTitle">

                           <?php the_title(); ?>

                            <div class="newsSubTitle">

                               <?php the_content(); ?>

                            </div>                        

                        </div>                                       

                    </div>                        

                    <?php endwhile; else: ?>

                        <p><?php _e('Sorry, no posts matched your criteria.', 'brander'); ?></p>

                    <?php endif; ?>



                    <?php

                       $args = array( 'post_type' => 'post'); 

                       $loop = new WP_Query( $args );

                       while ( $loop->have_posts() ) : $loop->the_post(); ?>

                     



                        <div class="large-3 medium-6 columns">

                            <div class="newsItem">

                                <?php if(has_post_thumbnail()) { the_post_thumbnail('512x340'); }?>

                                <div class="slideOut">

                                    <div class="thickSmallLine"></div>

                                    <a class="zoomy" href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto"></a>

                                    <h3><?php the_title(); ?></h3>

                                </div>

                            </div>

                            <div class="newsContent">

                                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                                <?php the_excerpt(); ?>

                                <div class="newsFoot">

                                    <div class="date">

                                        <img src="<?php echo get_template_directory_uri(); ?>/img/time.png" height="18" width="18" alt="">

                                        <?php the_time('d.m.Y') ?>

                                    </div>

                                    <div class="heart">

                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" height="18" width="21" alt=""></a>

                                    </div>

                                </div>

                            </div>                    

                        </div>



                    <?php endwhile; ?>



                                                           

                </div>   



                        

            </div>









<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

