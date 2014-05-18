<?php

/**
  * Template Name: Blog - Masonry
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

              <li><a href="#" data-filter="*">all</a></li>

                <?php

                //for each category, show all posts

                $cat_args=array();

                $categories=get_categories($cat_args);

                  foreach($categories as $category) {

                    $args=array(

                      'showposts' => -1,

                      'category__in' => array($category->term_id),

                      'ignore_sticky_posts'=>1

                    );

                    $posts=get_posts($args);

                      if ($posts) {

                        echo '<li><a href="#" data-filter=".' . $category->slug . '" ' . '>' . $category->name.'</a></li> ';

                        foreach($posts as $post) {

                          setup_postdata($post); ?>





                          

                <?php

                        } // foreach($posts

                      } // if ($posts

                    } // foreach($categories

                ?>                       

            </ul>

          </li>

        </ul>



        <ul id="filters" class="hide-for-1024">

          <li><a href="#" data-filter="*">all</a></li>

                <?php

                //for each category, show all posts

                $cat_args=array();

                $categories=get_categories($cat_args);

                  foreach($categories as $category) {

                    $args=array(

                      'showposts' => -1,

                      'category__in' => array($category->term_id),

                      'ignore_sticky_posts'=>1

                    );

                    $posts=get_posts($args);

                      if ($posts) {

                        echo '<li><a href="#" data-filter=".' . $category->slug . '" ' . '>' . $category->name.'</a></li> ';

                        foreach($posts as $post) {

                          setup_postdata($post); ?>





                          

                <?php

                        } // foreach($posts

                      } // if ($posts

                    } // foreach($categories

                ?> 

        </ul>

    </div>



    <div class="row">     

        <div id="container_iso" class="blogMasonry">



            <?php

               $args = array( 'post_type' => 'post'); 

               $loop = new WP_Query( $args );

               while ( $loop->have_posts() ) : $loop->the_post(); ?>



                <div class="post grid-item x1 medium <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">

                    <div class="image">

                    <a href="<?php the_permalink(); ?>">

                        <?php if(has_post_thumbnail()) { the_post_thumbnail('333x239'); }?>

                    </a>

                    <div class="category"><?php $category = get_the_category(); echo $category[0]->name; ?></div>

                    </div>

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



<!-- Clients Block -->

<?php get_template_part( 'page_blocks/clients' ); ?>



<!-- Testimonials Block -->

<?php get_template_part( 'page_blocks/testimonials' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

