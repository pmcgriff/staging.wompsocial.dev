<?php
/**
 * @package Brander
 */
?>


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
                    <h1><?php the_title(); ?></h1>
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
            