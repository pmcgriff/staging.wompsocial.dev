<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brander
 */

get_header(); ?>


<div id="scroll-tm" class="doubleNews blogClassic">            
    <div class="row blogSingle">
        <div class="large-12 columns">


            <div class="newsTitle">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'brander' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'brander' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'brander' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'brander' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'brander' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'brander' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'brander' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'brander');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'brander');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'brander' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'brander' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'brander' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'brander' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'brander' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'brander' );

						else :
							_e( 'Archives', 'brander' );

						endif;
					?>              
            </div>                                       
        </div>                    
        <div class="large-8 columns medium-8 mainHold">

		<?php if ( have_posts() ) : ?>  
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'archive' );
				?>

			<?php endwhile; ?>

			<?php brander_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

                                                              
        </div> 

        <div class="large-4 medium-4 columns sideBar">
	        <div class="widget">
	            <div class="title">
	                Popular posts
	            </div>
	            <?php 
	            $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
	            while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
	            <div class="item">
	                <div class="large-8 columns">
	                    <div class="side-title">
	                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                    </div>
	                    <div class="excerpt"><?php echo wp_trim_words( get_the_content(), 5 ); ?></div>
	                </div>
	                <div class="large-4 columns">
	                    <?php if(has_post_thumbnail()) { the_post_thumbnail('99x75'); }?>
	                </div>
	            </div>
	            <?php   endwhile; ?>                            

	        </div>  

	        <div class="widget tweetWidget">
	            <div class="title">
	                Latest Tweet
	            </div>
	            <div class="username">@<?php if (empty($brander_options['twitter_feed'])): ?>
                        avathemes
                    <?php else: ?>
                       <?php echo $brander_options['twitter_feed']; ?>
                    <?php endif; ?></div>
	            <div class="tweet"></div>
	        </div>

	        <div class="widget tagWidget">
	            <div class="title">
	                Tags
	            </div>
	            <div class="tags">
	                <ul>
	                    <?php wp_tag_cloud('smallest=16&largest=52'); ?>
	                </ul>
	            </div>
	        </div>   

	        <?php get_sidebar(); ?>
                                                                                            
        </div>  

                         
    </div>
</div>



<?php get_footer(); ?>
