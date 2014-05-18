<?php

/**
  * Template Name: Blog - Timeline
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

  .latestNews {max-height: 613px; overflow: hidden;}

  .right-content {margin-left: -2px;}

</style>





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



  <div class="revolutionSubstitute_about">

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



  <div class="blogStatistics">

      <div class="row">

          <div class="large-4 medium-4 columns"><?php $num_cats  = wp_count_terms('category'); echo $num_cats ?> categories</div>

          <div class="large-4 medium-4 columns"><?php $num_posts = wp_count_posts( 'post' ); $num_posts = $num_posts->publish; echo $num_posts ?> BLOG POSTS</div>

          <div class="large-4 medium-4 columns"><?php $num_comm  = get_comment_count(); $num_comm  = $num_comm['approved']; echo $num_comm ?> COMMENTS</div>

      </div>

      <div class="theTail"></div>

  </div>





<?php

   $args = array( 'post_type' => 'post', 'posts_per_page' => 1 ); 

   $loop = new WP_Query( $args );

   while ( $loop->have_posts() ) : $loop->the_post(); ?>



    <div class="latestNews">

        <?php if(has_post_thumbnail()) { the_post_thumbnail('h609'); }?>

        <div class="latestItem">

            <div class="smallTitle">Latest news</div>

            <div class="largeTitle"><?php the_title() ?></div>

            <div class="line"></div>

            <div class="text"><?php the_excerpt(); ?></div>

            <a href="<?php the_permalink(); ?>" class="readMore">read more</a>

        </div>

        <div class="backgroundBottom">

            <div class="left"></div>

            <div class="right"></div>

        </div>

    </div>



<?php endwhile; ?>









<div class="timelines">



  <div class="top">

     <div class="left-content no_padding">

     </div>

     <div class="right-content no_padding">

     </div>                

  </div>





  <?php $args = array( 'post_type'=>'post' ); query_posts( $args ); ?>



  <?php $day_check = ''; ?>

  <?php while (have_posts()) : the_post(); ?>

  <?php $day = get_the_date('d');   if ($day != $day_check) {     if ($day_check != '') { ?>

        <?php echo '</div></div>'; // close the list here

      }

      echo '<div>'; echo '<div class="today">', get_the_date()  ;  echo '</div><div class="container">'; } ?>





       <div class="contentsDiv">

          <div class="timelinePosts">

              <div class="padding_left">

                  <img src="<?php echo get_template_directory_uri(); ?>/img/the_zip_left.jpg" alt="">

              </div>

              <div class="timelinePost">

                  <div class="image">

                      <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto">

                          <?php if(has_post_thumbnail()) { the_post_thumbnail('w339'); }?>

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

          </div> 

       </div>







  <?php $day_check = $day; endwhile; ?>



  <?php wp_reset_query(); ?>



</div>







<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>



