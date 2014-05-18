<?php
/**
 * @package Brander
 */
?>

<div id="scroll-tm" class="doubleNews blogClassic">            
    <div class="row blogSingle">
        <div class="large-12 columns">
            <div class="newsTitle">
               <?php printf( __( 'Search Results for: %s', 'brander' ), '<span>' . get_search_query() . '</span>' ); ?>               
            </div>                                       
        </div>                    
        <div class="large-8 columns medium-8 mainHold">
            <div class="large-12 columns">
                <div class="newsItem">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail('w650'); }?>
                    <div class="slideOut">
                        <div class="thickSmallLine"></div>
                        <a class="zoomy" href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto"></a>
                        <h3>open</h3>
                    </div>
                </div>
                <div class="newsContent">
                    <div class="newsFoot blogSingleHead">
                        <div class="date">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/time.png" height="18" width="18" alt="">
                            <?php the_time('d.m.Y') ?>
                        </div>
	                    <div class="heart">
	                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" height="18" width="21" alt=""></a>
	                    </div>
                    </div>                                
                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    <div class="sinlgeContent">
                        <?php the_content(); ?>
                    </div>
                </div> 

                <div class="theComments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

                             
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


		<div class="large-12 columns">
			<?php brander_post_nav(); ?>
		</div>                          
    </div>
</div>

