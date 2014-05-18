<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brander
 */
?>



<div id="scroll-tm" class="doubleNews blogClassic">            
    <div class="row blogSingle">
        <div class="large-12 columns">
            <div class="newsTitle">
               <?php _e( 'Nothing Found', 'brander' ); ?>               
            </div>                                       
        </div>                    
        <div class="large-8 columns medium-8 mainHold">
            <div class="large-12 columns">
                <div class="newsContent">                               
                    <h1>Try searching for something else</h1>
                    <div class="sinlgeContent">
                        <?php get_search_form(); ?>
                    </div>
                </div>                 
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