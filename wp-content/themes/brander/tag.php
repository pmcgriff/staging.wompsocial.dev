<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<div id="scroll-tm" class="doubleNews blogClassic">            
    <div class="row blogSingle">


			<?php if ( have_posts() ) : ?>

	        <div class="large-12 columns">
	            <div class="newsTitle">
	               <?php printf( __( 'Tag Archives: %s', 'brander' ), single_tag_title( '', false ) ); ?>            
	            </div>                                       
	        </div> 

			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', 'tags' );

					endwhile;


				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		<div class="large-12 columns">
			<?php brander_post_nav(); ?>
		</div>                          
    </div>
</div>
<?php
get_footer();
