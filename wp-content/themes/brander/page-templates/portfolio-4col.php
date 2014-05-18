<?php

/**
* Template Name: Portfolio - 4 Col
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







<div id="scroll-tm" class="portfolioRow">   



   

    <div class="row filterRow">



        <ul id="filters" class="smallFilters show-for-1024">

          <li>Filters

            <ul>

             <li><a href="#" class="all" data-filter="*">All</a></li>

            <?php

            $catArgs = array(

                        'taxonomy'=>'project-type'

                        // post_type isn't a valid argument, no matter how you use it.

                        );

            $categories = get_categories('taxonomy=project-type'); ?>

             <?php foreach ($categories as $category) : ?>



            <li><a href="#" data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name ?></a></li>



             <?php endforeach; ?>                 

            </ul>

          </li>

        </ul>



        <ul id="filters" class="hide-for-1024">

             <li><a href="#" class="all" data-filter="*">All</a></li>

            <?php

            $catArgs = array(

                        'taxonomy'=>'project-type'

                        // post_type isn't a valid argument, no matter how you use it.

                        );

            $categories = get_categories('taxonomy=project-type'); ?>

             <?php foreach ($categories as $category) : ?>



            <li><a href="#" data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name ?></a></li>



             <?php endforeach; ?>

        </ul>

    </div>





    <div class="row">     

        <div id="container_iso" class="portfolio-4Col">



            <?php $args = array( 'post_type' => 'portfolio');

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post(); ?>



            <div class="post grid-item x1 small


                  <?php 
                       $term_list = wp_get_post_terms($post->ID, 'project-type');
                  
                       foreach ($term_list as $name) {
                         echo $name->slug." ";
                       }
                  ?>



                ">

                <div class="innerItem">

                    <?php if(has_post_thumbnail()) { the_post_thumbnail('256x220'); }?>

                    <div class="hiddenReveal">

                        <div class="zoomy">

                            <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto">

                                <?php if (empty($brander_options['post_zoom_small']['url'])): ?>

                                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-zoom_gold_small.png" alt="">

                                <?php else: ?>

                                <img src="<?php echo $brander_options['post_zoom_small']['url']; ?>" alt=""> 

                                <?php endif ?> 

                                

                            </a>

                        </div>

                        <div class="linky">

                            <a href="<?php the_permalink(); ?>">

                                <?php if (empty($brander_options['post_link_small']['url'])): ?>

                                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-link_gold_small.png" alt="">

                                <?php else: ?>

                                <img src="<?php echo $brander_options['post_link_small']['url']; ?>" alt=""> 

                                <?php endif ?> 

                                

                            </a>

                        </div>



                        <div class="text">

                            <h5>

                                <?php if (function_exists('rwmb_meta')):?> 

                                    <?php echo rwmb_meta( 'subtitle' ); ?>

                                <?php else: ?>   

                                <?php endif; ?>

                            </h5>

                            <h2><?php the_title(); ?></h2>

                            <h5 class="category">

                              <?php 

                              $terms = get_the_terms($post->id,"project-type");

                              $project_cats = NULL;

                              

                              if ( !empty($terms) ){

                                foreach ( $terms as $term ) {

                                  $project_cats .= strtolower($term->name) . ' ';

                                }

                              }?>

                              <?php echo $term->name ?>                              

                            </h5>

                        </div>

                    </div>                                

                </div>

            </div>



            <?php endwhile; ?>

                                                           

        </div><!-- /container -->

    </div>

</div>







<!-- Features Block -->

<?php get_template_part( 'page_blocks/features' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

