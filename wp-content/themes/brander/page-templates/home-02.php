<?php

/**
* Template Name: Home 02
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





<!-- Isotope Block -->

<?php get_template_part( 'page_blocks/isotope' ); ?>



<!-- Features Block -->

<?php get_template_part( 'page_blocks/features' ); ?>



<!-- Clients Block -->

<?php get_template_part( 'page_blocks/projects' ); ?>



<!-- Testimonials Block -->

<?php get_template_part( 'page_blocks/testimonials' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>





<?php get_footer(); ?>

