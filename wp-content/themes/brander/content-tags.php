<?php
/**
 * @package Brander
 */
?>


                   
        <div class="large-12 columns medium-12 mainHold">
        <div <?php post_class('large-12 columns'); ?>>
            <div class="newsItem">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('full'); }?>
                <div class="slideOut">
                    <div class="thickSmallLine"></div>
                    <a class="zoomy" href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto"></a>
                    <h3>open</h3>
                </div>
            </div>
            <div class="newsContent">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <?php the_excerpt(); ?>
                <div class="newsFoot">
                    <div class="date">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/time.png" height="18" width="18" alt="">
                        <?php the_time('d.m.Y') ?>
                    </div>
                    <div class="heart">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" height="18" width="21" alt=""></a>
                    </div>
                </div>
            </div>                    
        </div> 

                                                              
        </div> 





