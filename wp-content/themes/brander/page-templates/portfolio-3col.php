<?php

/**
* Template Name: Portfolio - 3 Col
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



<div id="scroll-tm" class="portfolioRow portfoliox3 portfolio3Col">            

    <div class="row">     

        <div id="container">

            <div id="grid-wrapper">



            <?php $args = array( 'post_type' => 'portfolio');

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post(); ?>



                <div class="post grid-item x1 medium">

                    <div class="innerItem">

                        <?php if(has_post_thumbnail()) { the_post_thumbnail('512x340'); }?>

                        <div class="hiddenReveal">

                            <div class="leftHover">

                                <div class="zoomy">

                                    <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto">
                                                <?php if (empty($brander_options['post_zoom']['url'])): ?>

                                                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-zoom_gold.png" height="58" width="58" alt="">

                                                <?php else: ?>

                                                <img src="<?php echo $brander_options['post_zoom']['url']; ?>" alt=""> 

                                                <?php endif ?> 

                                    </a>

                                </div>

                                <div class="linky">

                                    <a href="<?php the_permalink(); ?>">


                                            <?php if (empty($brander_options['post_link']['url'])): ?>

                                            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-link_gold.png" height="58" width="58" alt="">

                                            <?php else: ?>

                                            <img src="<?php echo $brander_options['post_link']['url']; ?>" alt=""> 

                                            <?php endif ?> 

                                    </a>

                                </div>

                            </div>

                            <div class="rightHover">

                                <div class="text">

                                    <h5>

                                        <?php if (function_exists('rwmb_meta')):?> 

                                            <?php echo rwmb_meta( 'subtitle' ); ?>

                                        <?php else: ?>   

                                        <?php endif; ?>                                        

                                    </h5>

                                    <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

                                    <p><?php echo wp_trim_words( get_the_content(), 5 ); ?></p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



            <?php endwhile; ?>

                                                

            </div><!-- /grid-wrapper -->   

        </div><!-- /container -->

    </div>

</div>









<!-- Features Block -->

<?php get_template_part( 'page_blocks/features' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

