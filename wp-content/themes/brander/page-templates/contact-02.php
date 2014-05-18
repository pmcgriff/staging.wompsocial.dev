<?php

/**
* Template Name: Contact 02
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





<div class="revolutionSubstitute_contact">

    <?php if (empty($brander_options['contact_iframe'])): ?>

        <iframe width="1680" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;t=m&amp;ll=51.513871,-0.131664&amp;spn=0.032049,0.144196&amp;z=14&amp;output=embed"></iframe>



     <?php else: ?>

        <?php echo $brander_options['contact_iframe']; ?>

    <?php endif ?> 



</div>









<div class="aboutTxt aboutWhiteTxt contactTxt">

    <div class="row">

        <div class="scrolly">

            <a href="#news">

                <img src="<?php echo get_template_directory_uri(); ?>/img/scrolly-bottom.png" alt="">

            </a>

        </div>

        <div id="news" class="titleHold large-8 medium-12 large-centered columns">

            <?php if ( have_posts() ) : ?>

            <?php ?>

            <?php while ( have_posts() ) : the_post(); ?> 

                <?php the_title(); ?>

            <?php endwhile; ?>

            <?php else : ?>

            <?php endif; ?>

        </div>

        <div class="fancyGoldenSeperator"></div>

        <div class="large-7 medium-7 large-centered medium-centered columns paragraphText">

            <?php if (empty($brander_options['contact_pre-title'])): ?>

                Science cuts two ways, of course; its products can be used for both good and evil. 

             <?php else: ?>

                <?php echo $brander_options['contact_pre-title']; ?>

             <?php endif ?>            

        </div>

        <div class="large-6 medium-6 columns about50">

            <div class="large-12 columns">

                <div class="number">

                    <span>1</span>

                </div>

                <div class="date">CONTACT FORM</div>

                <div class="category">We reply ASAP</div>

            </div>

            <div class="large-12 columns title">

                <?php if (empty($brander_options['contact_subtitle'])): ?>

                    To be the first to enter the cosmos, to engage

                 <?php else: ?>

                    <?php echo $brander_options['contact_subtitle']; ?>

                <?php endif ?>  

            </div>

            <div class="large-12 columns text contactForm2">

                <?php if ( have_posts() ) : ?>

                <?php ?>

                <?php while ( have_posts() ) : the_post(); ?> 

                <?php the_content(); ?> 

                <?php endwhile; ?>

                <?php else : ?>

                <?php endif; ?>     

            </div>

        </div>



        <div class="large-6 medium-6 columns about50 contact50">

            <div class="large-12 columns">

                <div class="number">

                    <span>2</span>

                </div>

                <div class="date">CONTACT DETAILS</div>

                <div class="category">Call us or visit us for a cup of coffee</div>

            </div>

            <div class="large-12 columns title">

                <div class="large-6 medium-6 columns">

                    <?php if (empty($brander_options['contact_1'])): ?>

                        <h3>Main HQ - London</h3>



                        <h4>John Doe</h4>

                        <p>General Manager</p>

                        <p>London, UK</p>

                        <p>+1 315 648 9548</p>

                        <p>johndoe@email.com</p>



                        <h4>John Doe</h4>

                        <p>General Manager</p>

                        <p>London, UK</p>

                        <p>+1 315 648 9548</p>

                        <p>johndoe@email.com</p> 

                     <?php else: ?>

                        <?php echo $brander_options['contact_1']; ?>

                     <?php endif ?>



                </div>



                <div class="large-6 medium-6 columns">

                    <?php if (empty($brander_options['contact_2'])): ?>

                        <h3>USA HQ - New York</h3>



                        <h4>John Doe</h4>

                        <p>General Manager</p>

                        <p>London, UK</p>

                        <p>+1 315 648 9548</p>

                        <p>johndoe@email.com</p>



                        <h4>John Doe</h4>

                        <p>General Manager</p>

                        <p>London, UK</p>

                        <p>+1 315 648 9548</p>

                        <p>johndoe@email.com</p>  

                     <?php else: ?>

                        <?php echo $brander_options['contact_2']; ?>

                     <?php endif ?>



                </div>                        

            </div>

        </div>                

    </div>

</div>





<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/services_iconic' ); ?>



<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/testimonials' ); ?>



<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/split-row' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

