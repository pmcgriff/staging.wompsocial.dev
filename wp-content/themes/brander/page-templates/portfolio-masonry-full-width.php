<?php

/**
* Template Name: Portfolio - Full Width
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

  #container_iso {width: 100% !important}

</style>



<div id="scroll-tm" class="portfolioRow">   





    <div class="row filterRow extendedRow">



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





    <div class="row extendedRow portolioFullWidth">     

        <div id="container_iso" class="blogMasonry">



            <?php $args = array( 'post_type' => 'portfolio');

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post(); ?>   

                 

            <div class="post grid-item x1 medium

                  <?php 
                       $term_list = wp_get_post_terms($post->ID, 'project-type');
                  
                       foreach ($term_list as $name) {
                         echo $name->slug." ";
                       }
                  ?>

            ">

                <a href="<?php the_permalink(); ?>" class="image">

                <?php if(has_post_thumbnail()) { ?> 

                <?php the_post_thumbnail('w339'); ?>

                <div class="category">

                  <?php 

                  $terms = get_the_terms($post->id,"project-type");

                  $project_cats = NULL;

                  

                  if ( !empty($terms) ){

                    foreach ( $terms as $term ) {

                      $project_cats .= strtolower($term->name) . ' ';

                    }

                  }?>

                  <?php echo $term->name ?>                   

                </div>

                <?php }?>

                </a>

                <div class="wrap">

                    <div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                    <div class="line"></div>

                    <div class="content"><?php the_excerpt(); ?></div>

                </div>

                <div class="foot">

                    <div class="date"><?php the_time('d.m.Y') ?></div>

                    <div class="socials">

                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="facebook"></a>

                        <a href="https://twitter.com/home?status=<?php the_permalink(); ?>" class="twitter" target="_blank"></a>

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

