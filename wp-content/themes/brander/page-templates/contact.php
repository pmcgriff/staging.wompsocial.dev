<?php

/**
* Template Name: Contact
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




<style>

.imageNdescription img {

width: auto;height: 100%; max-width: none} 

</style>


            <div class="serviceRows contactRows">

                <div class="serviceLeft">

                    <div class="description">

                        <div class="descriptionInner">

                            <?php if (empty($brander_options['contact_pre-title'])): ?>

                                <p>Science cuts two ways, of course; its products can be used for.</p>

                             <?php else: ?>

                                <?php echo $brander_options['contact_pre-title']; ?>

                             <?php endif ?>



                            <?php if ( have_posts() ) : ?>

                            <?php ?>

                            <?php while ( have_posts() ) : the_post(); ?> 

                            <h1><?php the_title(); ?></h1>

                            <?php endwhile; ?>

                            <?php else : ?>

                            <?php endif; ?>                             

                            

                            

                            <?php if (empty($brander_options['contact_subtitle'])): ?>

                                <p>Products can be used for</p>

                             <?php else: ?>

                                <?php echo $brander_options['contact_subtitle']; ?>

                             <?php endif ?>



                            

                        </div>



                        <div class="revealRow">

                            <div class="contactSocial">

                                <a href="<?php if (empty($brander_options['facebook'])): ?>#<?php else: ?><?php echo $brander_options['facebook']; ?><?php endif ?>" class="facebook">

                                    <img src="<?php echo get_template_directory_uri(); ?>/img/contact-facebook.jpg" alt="">

                                </a>

                            </div>



                            <div href="<?php if (empty($brander_options['twitter'])): ?>#<?php else: ?><?php echo $brander_options['twitter']; ?><?php endif ?>" class="contactSocial">

                                <a class="facebook">

                                    <img src="<?php echo get_template_directory_uri(); ?>/img/contact-twitter.jpg" alt="">

                                </a>

                            </div>                                                                      

                            <div class="contactSocial">

                                <a href="<?php if (empty($brander_options['vimeo'])): ?>#<?php else: ?><?php echo $brander_options['vimeo']; ?><?php endif ?>" class="facebook">

                                    <img src="<?php echo get_template_directory_uri(); ?>/img/contact-vimeo.jpg" alt="">

                                </a>

                            </div>



                            <div class="contactSocial contactWhite">

                                social networks

                                <div class="theTail"></div>

                            </div>                              



                        </div>

                    </div>



                    <div class="logoRow">

                    <?php $count = 0;

                        foreach ($brander_options['project_slides'] as $key => $value) {

                        if($count == 4) break;

                        else { ?>

                            <div class="logoHold">

                                <img src="<?php echo $value['image']; ?>" alt="">

                            </div>

                        <?php }

                    $count++;} ?>



                                                    

                    </div>

                </div>







                <div class="serviceRight">

                    <div class="imageNdescription">

                        <?php if ( have_posts() ) : ?>

                        <?php ?>

                        <?php while ( have_posts() ) : the_post(); ?> 

                            <?php if(has_post_thumbnail()) { the_post_thumbnail('h1006'); }?>

                        <?php endwhile; ?>

                        <?php else : ?>

                        <?php endif; ?>

                        <div class="contactBottom">

                            contact form

                            <div class="theTail"></div>

                        </div>



                    </div>



                    <div class="contactForm">

                        <?php if ( have_posts() ) : ?>

                        <?php ?>

                        <?php while ( have_posts() ) : the_post(); ?> 

                        <?php the_content(); ?> 

                        <?php endwhile; ?>

                        <?php else : ?>

                        <?php endif; ?>                                                    

                    </div>

                </div>

            </div>







<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/testimonials' ); ?>





<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

