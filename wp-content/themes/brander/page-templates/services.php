<?php

/**
* Template Name: Services
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







<div class="teamRow">

    <div class="scrolly">

        <a href="#news">

              <?php if (empty($brander_options['revolutionScroll']['url'])): ?>

                 <img src="<?php echo get_template_directory_uri(); ?>/img/scrolly-bottom.png" alt="">

              <?php else: ?>

                  <img src="<?php echo $brander_options['revolutionScroll']['url']; ?>" alt=""> 

              <?php endif ?> 

        </a>

    </div>            

    <div id="news" class="row XXLRow">



        <?php $args = array( 'post_type' => 'service');

        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post(); ?>



        <div class="teamItem-large serviceItem">

            <div class="image">

                <?php if(has_post_thumbnail()) { the_post_thumbnail('745x385'); }?>

                <div class="hiddenTeam">

                    <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto">

                        <div class="hiddenInner">

                            <div class="thickLine"></div>

                            <img src="<?php echo get_template_directory_uri(); ?>/img/zoomy.png" class="zoomy" height="63" width="62" alt="">

                            <span>Open image</span>

                        </div>

                    </a>

                </div>

            </div>

            <div class="white">

                <div class="name"><?php the_title(); ?></div>

                <div class="description">

                    <p><?php echo wp_trim_words( get_the_content(), 80 ); ?></p>

                </div>

                <div class="link">

                    <a href="<?php if (function_exists('rwmb_meta')):?><?php bloginfo('url') ?>/<?php echo rwmb_meta( 'service_url' ); ?><?php else: ?>#<?php endif; ?>">View portfolio</a>

                </div>

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

