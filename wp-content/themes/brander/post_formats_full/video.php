<?php global $porter_config; ?>

	<?php if(!is_singular()) : ?>

        <div  <?php post_class('large-12 columns video'); ?>>
            <div class="newsItem">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('w650'); }?>
                <a href="<?php if (function_exists('rwmb_meta')):?><?php echo rwmb_meta( 'post_additional' ); ?><?php else: ?><?php endif; ?>" data-rel="prettyPhoto" class="play"></a>
            </div>
            <div class="newsContent">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <?php the_content(); ?>
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

    
    <?php else :?>

        <div  <?php post_class('large-12 columns video'); ?>>
            <div class="newsItem">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('w650'); }?>
                <a href="<?php if (function_exists('rwmb_meta')):?><?php echo rwmb_meta( 'post_additional' ); ?><?php else: ?><?php endif; ?>" data-rel="prettyPhoto" class="play"></a>
            </div>
            <div class="newsContent">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <?php the_content(); ?>
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
    
    <?php endif; ?>