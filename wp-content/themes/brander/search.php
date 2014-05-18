<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Brander
 */

get_header(); ?>

<div id="scroll-tm" class="doubleNews blogClassic">            
    <div class="row blogSingle">

        <div class="large-12 columns">
            <div class="newsTitle">
               <?php printf( __( 'Search Results for: %s', 'brander' ), '<span>' . get_search_query() . '</span>' ); ?>               
            </div>                                       
        </div> 

        <div class="large-8 columns medium-8 mainHold">

			<?php if ( have_posts() ) : ?>
			<?php ?>        	
            <?php while ( have_posts() ) : the_post(); ?>
                <?php // The following determines what the post format is and shows the correct file accordingly
                $format = get_post_format();
                get_template_part( 'post_formats/'.$format );
                if($format == '')
                get_template_part( 'post_formats/standard' );
                ?>
            <?php endwhile; ?>
			<?php else : ?>


	            <div class="large-12 columns">
	                <div class="newsContent">      

						<h1><?php printf( __( 'No results for: %s', 'brander' ), '<span>' . get_search_query() . '</span>' ); ?>  </h1>

	                    <h2 class="created">Try searching for something else</h2>
	                    <div class="sinlgeContent">
	                        <?php get_search_form(); ?>
	                    </div>
	                </div>                 
	            </div>

			<?php endif; ?>            

			<div class="large-12 columns postSearchNavi">
				<?php posts_nav_link(' ', '< previous page', 'next page >'); ?>
			</div>                                                               
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
