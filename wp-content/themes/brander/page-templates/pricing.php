<?php

/**
* Template Name: Pricing
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

width: auto;height: 100%;} 

</style>





<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php $image_id = get_post_thumbnail_id();

$image_url = wp_get_attachment_image_src($image_id,'full', true);?>    

<style>

    .pricing {

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





<div class="serviceRows pricing">

    <div class="serviceLeft">

        <div class="description">

            <div class="descriptionInner">



                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

                    <h1><?php the_title(); ?></h1>

                <?php endwhile; else: ?>

                    <p><?php _e('Sorry, no posts matched your criteria.', 'brander'); ?></p>

                <?php endif; ?>





            </div>

        </div>

    </div>

</div>





<div class="pricings">

    <div class="row">

        <div class="firstRows">

            <div class="large-12 columns priceTable textual">



                <?php if (empty($brander_options['pricing_tablles1'])): ?>

                <?php else: ?>

                    <?php echo do_shortcode(stripslashes($brander_options['pricing_tablles1'])); ?> 

                <?php endif ?>                                                      

            </div> 



            <div class="large-12 columns priceTable">

                <?php if (empty($brander_options['pricing_tablles2'])): ?>

                <?php else: ?>

                    <?php echo do_shortcode(stripslashes($brander_options['pricing_tablles2'])); ?> 

                <?php endif ?>                                                       

            </div>



        </div>

    </div>

</div>







<div class="textModifications">

    <div class="row">

        <?php if (empty($brander_options['pricing_testarea1'])): ?>

        <?php else: ?>

            <div class="large-6 medium-6 columns">

                <?php echo do_shortcode(stripslashes($brander_options['pricing_testarea1'])); ?>                                                                                         

                                                         

            </div>     

        <?php endif ?> 















        <?php if (empty($brander_options['pricing_testarea2'])): ?>

        <?php else: ?>

            <div class="large-6 medium-6 columns">

                <?php echo do_shortcode(stripslashes($brander_options['pricing_testarea2'])); ?>                                                                                         

                                                         

            </div>





            

        <?php endif ?> 





               

    </div>

</div>















<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

