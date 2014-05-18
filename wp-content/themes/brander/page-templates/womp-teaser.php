<?php

/**
* Template Name: WOMP Teaser
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
<?php

/**
* Template Name: WOMP Teaser
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


<!-- WOMP Contact Block -->

<?php get_template_part( 'page_blocks/womp-contact' ); ?>



<?php get_footer(); ?>

