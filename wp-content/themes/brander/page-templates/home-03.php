<?php

/**
* Template Name: Home 03
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

<?php get_template_part( 'page_blocks/revolution' ); ?>



<!-- 2 Col Projects -->

<?php get_template_part( 'page_blocks/2col-projects' ); ?>





<!-- Service Iconic -->

<?php get_template_part( 'page_blocks/services_iconic' ); ?>



<!-- Audio Block -->

<?php get_template_part( 'page_blocks/audio' ); ?>





<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>



<?php get_footer(); ?>

