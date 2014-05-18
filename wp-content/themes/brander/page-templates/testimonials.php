<?php

/**
* Template Name: Testimonials
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









<div class="serviceRows">

    <div class="serviceLeft">

        <div class="description">

            <div class="descriptionInner">

                <?php if (empty($brander_options['testimonials_subtite'])): ?>

                    <p>Science cuts two ways, of course; its products can be used for.</p>

                 <?php else: ?>

                    <?php echo $brander_options['testimonials_subtite']; ?>

                 <?php endif ?>



                

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <h1><?php the_title() ?></h1>

                <?php endwhile; else: ?>

                    <p><?php _e('Sorry, no posts matched your criteria.', 'brander'); ?></p>

                <?php endif; ?>                

            </div>



        </div>



    </div>







    <div class="serviceRight">

        <div class="imageNdescription">

            <?php if(has_post_thumbnail()) { the_post_thumbnail('h1006'); }?>

        </div>

    </div>



    <div class="testimonialsLayoutRow">



        <?php

           $args = array( 'post_type' => 'testimonials'); 

           $loop = new WP_Query( $args );

           while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <div class="testimonialItem">

                <div class="date"><span><?php the_time('d') ?></span> <span><?php the_time('S') ?></span> <span><?php the_time('F') ?></span></div>

                <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto" class="image"> <?php if(has_post_thumbnail()) { the_post_thumbnail('372x376'); }?></a>

                <div class="content">

                    <div class="title"><?php the_title(); ?></div>

                    <div class="text"><?php echo wp_trim_words( get_the_content(), 30 ); ?></div>

                    <a href="<?php the_permalink(); ?>" class="readMore">read more</a>

                </div>

            </div>

        <?php endwhile; ?>



                                                                         

    </div>

</div>

















<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/testimonials' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

