<?php

/**
* Template Name: Home 05
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



<!-- Revolution Block -->

<?php get_template_part( 'page_blocks/revolution_02' ); ?>





            <div id="scroll-tm" class="doubleNews">



<!-- Audio Block -->

<?php get_template_part( 'page_blocks/audio' ); ?> 





            	

            	<div class="row">



					<?php 

					$ID1  = $brander_options['home_05_cateogries_01'];

					$id = array($ID1);

					if (have_posts()) : ?>





					<?php query_posts( array( 'category__in' => $id, 'posts_per_page' => 2 ) ); ?>



					<div class="large-12 columns">

					    <div class="newsTitle">

					        <?php single_cat_title(); ?>

					    </div>                   

					</div>





						<?php while (have_posts()) : the_post(); ?>





					    <div class="large-6 medium-6 columns">

					        <div class="newsItem">

					            <?php if(has_post_thumbnail()) { the_post_thumbnail('512x340'); }?>

					            <div class="slideOut">

					                <div class="thickSmallLine"></div>

					                <a class="zoomy" href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto"></a>

					                <h3><?php the_title(); ?></h3>

					                <p><?php echo wp_trim_words( get_the_content(), 10 ); ?></p>

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

					                	<a href="http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=<?php echo get_permalink(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" height="18" width="21" alt=""></a>					                    

					                </div>

					            </div>

					        </div>                    

					    </div>



						<?php endwhile; ?>

					<?php else : ?>

					<?php endif; ?>

            

                </div>   







                <div class="row secondRow">



					<?php 

					$ID1  = $brander_options['home_05_cateogries_02'];

					$id = array($ID1);

					if (have_posts()) : ?>





					<?php query_posts( array( 'category__in' => $id, 'posts_per_page' => 2 ) ); ?>



                    <div class="large-12 columns">

                        <div class="newsTitle">

                            <?php single_cat_title(); ?>

                        </div>                   

                    </div>



						<?php while (have_posts()) : the_post(); ?>



					    <div class="large-6 medium-6 columns">

					        <div class="newsItem">

					            <?php if(has_post_thumbnail()) { the_post_thumbnail('512x340'); }?>

					            <div class="slideOut">

					                <div class="thickSmallLine"></div>

					                <a class="zoomy" href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto"></a>

					                <h3><?php the_title(); ?></h3>

					                <p><?php echo wp_trim_words( get_the_content(), 10 ); ?></p>

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

					                	<a href="http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=<?php echo get_permalink(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" height="18" width="21" alt=""></a>					                    

					                </div>

					            </div>

					        </div>                    

					    </div>



						<?php endwhile; ?>

					<?php else : ?>

					<?php endif; ?>            

                </div>                     

            </div>







<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>



<?php get_footer(); ?>

