<?php global $porter_config; ?>



	<?php if(!is_singular()) : ?>



        <div <?php post_class('large-12 columns link'); ?>>

            <div class="newsItem">

                <?php if(has_post_thumbnail()) { the_post_thumbnail('w650'); }?>

                <div class="play">

                    <img src="<?php echo get_template_directory_uri(); ?>/img/link.png" height="72" width="72" alt="">

                    <span><a href="<?php if (function_exists('rwmb_meta')):?><?php echo rwmb_meta( 'post_additional' ); ?><?php else: ?><?php endif; ?>"><?php if (function_exists('rwmb_meta')):?><?php echo rwmb_meta( 'post_additional' ); ?><?php else: ?><?php endif; ?></a></span>

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



    

    <?php else :?>



        <div <?php post_class('large-12 columns link'); ?>>

            <div class="newsItem">

                <?php if(has_post_thumbnail()) { the_post_thumbnail('w650'); }?>

                <div class="play">

                    
        <?php if (empty($brander_options['link_icon']['url'])): ?>

           <img src="<?php echo get_template_directory_uri(); ?>/img/link.png" height="72" width="72" alt="">

        <?php else: ?>

            <img src="<?php echo $brander_options['link_icon']['url']; ?>" alt=""> 

        <?php endif ?> 
                    

                    <span><a href="<?php if (function_exists('rwmb_meta')):?><?php echo rwmb_meta( 'post_additional' ); ?><?php else: ?><?php endif; ?>"><?php if (function_exists('rwmb_meta')):?><?php echo rwmb_meta( 'post_additional' ); ?><?php else: ?><?php endif; ?></a></span>

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

    

    <?php endif; ?>