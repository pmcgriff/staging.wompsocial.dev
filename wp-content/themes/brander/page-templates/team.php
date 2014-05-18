<?php

/**
* Template Name: Team
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

            <div id="news" class="row XXLRow teamLayout">



            <?php $args = array( 'post_type' => 'team');

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post(); ?>



                <div class="teamItem">

                    <div class="image">

                        <?php if(has_post_thumbnail()) { the_post_thumbnail('370x382'); }?>

                        <div class="hiddenTeam">

                            <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto">

                                <div class="hiddenInner">

                                    <div class="thickLine"></div>
                                    
                                    <?php if (empty($brander_options['post_zoom_2']['url'])): ?>

                                       <img src="<?php echo get_template_directory_uri(); ?>/img/zoomy.png" height="63" width="62" alt="">

                                    <?php else: ?>

                                        <img src="<?php echo $brander_options['post_zoom_2']['url']; ?>" alt=""> 

                                    <?php endif ?> 
                                    

                                    <span>Open image</span>

                                </div>

                            </a>

                        </div>

                    </div>

                    <div class="white">

                        <div class="name"><?php the_title(); ?></div>

                        <?php if (function_exists('rwmb_meta')):?> 

                            <div class="position"><?php echo rwmb_meta( 'position' ); ?></div>

                        <?php else: ?>   

                        <?php endif; ?>                        

                        <div class="description"><?php echo wp_trim_words( get_the_content(), 9999 ); ?></div>

                        <?php if (function_exists('rwmb_meta')):?> 

                        <div class="socialisation">



                            <?php $facebook = rwmb_meta('facebook_url'); ?>

                            <?php $twitter = rwmb_meta('twitter_url'); ?>

                            <?php $vimeo = rwmb_meta('vimeo_url'); ?>

                            <?php $dribbble = rwmb_meta('dribbble_url'); ?>

                            <?php $linkedin = rwmb_meta('linkedin_url'); ?>



                            <?php if (!empty($facebook)) { ?>

                                <a href="<?php echo rwmb_meta( 'facebook_url' ); ?>" class="facebook"></a>

                            <?php } else {} ?>



                            <?php if (!empty($twitter)) { ?>

                                <a href="<?php echo rwmb_meta( 'twitter_url' ); ?>" class="twitter"></a>

                            <?php } else {} ?>



                            <?php if (!empty($vimeo)) { ?>

                                <a href="<?php echo rwmb_meta( 'vimeo_url' ); ?>" class="vimeo"></a>

                            <?php } else {} ?>



                            <?php if (!empty($dribbble)) { ?>

                                <a href="<?php echo rwmb_meta( 'dribbble_url' ); ?>" class="dribbble"></a>

                            <?php } else {} ?>



                            <?php if (!empty($linkedin)) { ?>

                                <a href="<?php echo rwmb_meta( 'linkedin_url' ); ?>" class="linkedin"></a>

                            <?php } else {} ?>



                        </div>

                        <?php else: ?>   

                        <?php endif; ?>                        

                    </div>

                </div>



            <?php endwhile; ?>





            </div>

        </div>







<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/features' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

