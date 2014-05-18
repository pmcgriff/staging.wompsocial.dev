<?php

/**
* Template Name: About
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





<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php $image_id = get_post_thumbnail_id();

$image_url = wp_get_attachment_image_src($image_id,'full', true);?>    

<style>

    .revolutionSubstitute_about {

    background: url(<?php echo $image_url[0] ?>) no-repeat center center;

    -webkit-background-size: cover;

    -moz-background-size: cover;

    -o-background-size: cover;

    background-size: cover;

    }

</style>

<?php endwhile; else: ?>

    <p><?php _e('Sorry, no posts matched your criteria.', 'brander'); ?></p>

<?php endif; ?> 



            <div class="revolutionSubstitute_about">

              <div class="row">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



                <?php if (empty($brander_options['small_logo']['url'])): ?>

                <?php else: ?>

                    <img src="<?php echo $brander_options['small_logo']['url']; ?>" alt="">

                <?php endif ?> 

              

                  <div class="title"><?php the_title(); ?></div>

                  <div class="fancyGoldenSeperator"></div>

                  <div class="text"><?php the_content(); ?></div>



                <?php endwhile; else: ?>

                    <p><?php _e('Sorry, no posts matched your criteria.', 'brander'); ?></p>

                <?php endif; ?>

              </div>

            </div>









            <div class="aboutTxt pattern_2">

                <div class="row">

                    <div class="scrolly">

                        <a href="#news">

                            <img src="<?php echo get_template_directory_uri(); ?>/img/scrolly-bottom.png" alt="">

                        </a>

                    </div>



                    <div id="news" class="title">

                    <?php if (empty($brander_options['about_layout_title'])): ?>

                        brander awesome

                     <?php else: ?>

                        <?php echo $brander_options['about_layout_title']; ?>

                     <?php endif ?>

                        </div>

                    <div class="large-10 large-centered medium-12 columns subtitle">

                        <p>

                        <?php if (empty($brander_options['about_layout_subtitle'])): ?>

                            Science cuts two ways, of course; its products can be used for both good and evil.  But there's no turning back from science.

                         <?php else: ?>

                            <?php echo $brander_options['about_layout_subtitle']; ?>

                         <?php endif ?>                            

                        </p>

                    </div>



                    <div class="large-6 medium-12 columns sideText">

                        <?php if (empty($brander_options['about_layout_text'])): ?>

                            <h4>To be the first to enter the cosmos, to engage</h4>

                            <p>A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That's how I felt seeing the Earth for the first time. I could not help but love and cherish her.</p>



                            <p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.</p>



                            <p>When I orbited the Earth in a spaceship, I saw for the first time how beautiful our planet is. Mankind,</p>

                         <?php else: ?>

                            <?php echo $brander_options['about_layout_text']; ?>

                         <?php endif ?>   

                    </div>



                    <div class="large-6 medium-12 columns sideImage">



                        <?php if (empty($brander_options['flip_image']['url'])): ?>

                            <style>

                                .ch-img-1 {

                                background-image: url(http://placehold.it/300x300/555555/ffffff.jpg);

                                }

                            </style>

                        <?php else: ?>

                            <style>

                                .ch-img-1 {

                                background-image: url(<?php echo $brander_options['flip_image']['url']; ?>);

                                }

                            </style>    

                        <?php endif ?>  



                        <ul class="ch-grid">

                            <li>

                                <div class="ch-item">               

                                    <div class="ch-info">

                                        <div class="ch-info-front ch-img-1 inner-border"></div>

                                        <div class="ch-info-back inner-border">

                                            <h3>

                                                <?php if (empty($brander_options['flip_title'])): ?>

                                                    The final frontier

                                                 <?php else: ?>

                                                    <?php echo $brander_options['flip_title']; ?>

                                                 <?php endif ?>                                                

                                            </h3>

                                            <p>

                                                <?php if (empty($brander_options['flip_text'])): ?>

                                                    Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.

                                                 <?php else: ?>

                                                    <?php echo $brander_options['flip_text']; ?>

                                                 <?php endif ?> 

                                            </p>

                                        </div>  

                                    </div>

                                </div>

                            </li>

                        </ul>   

                        

                        <?php if (empty($brander_options['twitter'])): ?>

                         <?php else: ?>

                        <div class="twitterAbout">

                            <a href="<?php echo $brander_options['twitter']; ?>" target="_blank">


                                <?php if (empty($brander_options['about_twitter']['url'])): ?>

                                   <img src="<?php echo get_template_directory_uri(); ?>/img/about_twitter.png" height="127" width="127" alt="">

                                <?php else: ?>

                                    <img src="<?php echo $brander_options['about_twitter']['url']; ?>" alt=""> 

                                <?php endif ?> 

                                

                            </a>

                        </div> 

                         <?php endif ?>                          





                        <?php if (empty($brander_options['facebook'])): ?>

                         <?php else: ?>

                        <div class="facebookAbout">

                            <a href="<?php echo $brander_options['facebook']; ?>" target="_blank">


                                <?php if (empty($brander_options['about_facebook']['url'])): ?>

                                   <img src="<?php echo get_template_directory_uri(); ?>/img/about_facebook.png" height="83" width="83" alt="">

                                <?php else: ?>

                                    <img src="<?php echo $brander_options['about_facebook']['url']; ?>" alt=""> 

                                <?php endif ?> 


                                

                            </a>

                        </div> 

                         <?php endif ?>             

                    </div>

                </div>

            </div>







<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/latest_post' ); ?>



<!-- Features Block -->

<?php get_template_part( 'page_blocks/features' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

