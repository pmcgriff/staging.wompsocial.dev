<?php

/**
* Template Name: Home 04
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



    <?php if (empty($brander_options['home04_background']['url'])): ?>

        <style>

            .revolutionSubstitute {

            background: url(http://placehold.it/1680x1050/181818/ffffff.jpg) no-repeat center center;

            -webkit-background-size: cover;

            -moz-background-size: cover;

            -o-background-size: cover;

            background-size: cover;

            }

        </style>

    <?php else: ?>

        <style>

            .revolutionSubstitute {

            background: url(<?php echo $brander_options['home04_background']['url']; ?>) no-repeat center center;

            -webkit-background-size: cover;

            -moz-background-size: cover;

            -o-background-size: cover;

            background-size: cover;

            }

        </style>    

    <?php endif ?> 



    <div class="revolutionSubstitute">

      <div class="row">

          <div class="large-6 large-centered medium-6 medium-centered roundy columns">

              <div class="welcome">Welcome</div>

              <div class="logoCurved">

                <?php if (empty($brander_options['home04_image']['url'])): ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-curved.png" alt="" >

                <?php else: ?>

                    <img src="<?php echo $brander_options['home04_image']['url']; ?>" alt="" >   

                <?php endif ?> 

              </div>

              <div class="line"></div>

              <div class="text">

	            <?php if (empty($brander_options['home04_title'])): ?>

	                a premium themeforest theme

	             <?php else: ?>

	                <?php echo $brander_options['home04_title']; ?>

	             <?php endif ?>

              	</div>

          </div>

          <div class="large-10 large-centered medium-9 medium-centered columns substituteText">

            <?php if (empty($brander_options['home04_text'])): ?>

                Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science.

             <?php else: ?>

                <?php echo $brander_options['home04_text']; ?>

             <?php endif ?>

          	</div>

      </div>

    </div>







<!-- Latest Pojects Block -->

<?php get_template_part( 'page_blocks/latest_projects' ); ?>







<div class="latestNewsHead">

    <div class="row">

        <div class="scrolly">

            <a href="#news">

              <?php if (empty($brander_options['revolutionScroll']['url'])): ?>

                 <img src="<?php echo get_template_directory_uri(); ?>/img/scrolly-bottom.png" alt="">

              <?php else: ?>

                  <img src="<?php echo $brander_options['revolutionScroll']['url']; ?>" alt=""> 

              <?php endif ?> 

            </a>

        </div>

        <h1>

            <?php if (empty($brander_options['latest_title'])): ?>

                LATEST NEWS

             <?php else: ?>

                <?php echo $brander_options['latest_title']; ?>

             <?php endif ?>            

        </h1>

        <div class="desc large-10 large-centered medium-12 columns">

            <p>

                <?php if (empty($brander_options['latest_text'])): ?>

                    Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science.

                 <?php else: ?>

                    <?php echo $brander_options['latest_text']; ?>

                 <?php endif ?>                

            </p>

        </div>

    </div>

    





</div>





<!-- Audio Block -->

<?php get_template_part( 'page_blocks/audio' ); ?> 



<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/latest_post' ); ?>



<!-- About Block -->

<?php get_template_part( 'page_blocks/about' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>



<?php get_footer(); ?>