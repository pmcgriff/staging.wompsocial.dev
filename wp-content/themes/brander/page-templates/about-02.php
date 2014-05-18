<?php

/**
* Template Name: About 02
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





    <div class="revolutionSubstitute_about about_02">

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









<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/latest_post_white' ); ?>





<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/services_02' ); ?>





<!-- Testimonials Block -->

<?php get_template_part( 'page_blocks/testimonials' ); ?>      





<!-- Features Block -->

<?php get_template_part( 'page_blocks/split-row' ); ?>





<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

