<?php global $porter_config; ?>

	<?php if(!is_singular()) : ?>

         <div <?php post_class('large-12 columns'); ?>>
            <div class="newsItem">
                <ul class="example-orbit" data-orbit data-options="slide_number:false;timer:false;bullets:false;next_class: classic_next;prev_class: classic_prev;variable_height:true">
                
                <?php $post_id = get_the_ID(); 

                $images = get_children(array(
                    'post_parent' => $post_id,
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',));
                ?>

                <?php if ($images) { foreach ($images as $image) {
                $big_image = wp_get_attachment_image_src($image->ID, 'full');
                ?>

                <li><?php echo wp_get_attachment_image( $image->ID, 'w650' ); ?><?php  ?></li>

                <?php } } else { echo 'There are no any attachments in your post.'; } ?>
                
                </ul>                            
            </div>
            <div class="newsContent slide">
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

         <div <?php post_class('large-12 columns'); ?>>
            <div class="newsItem">
                <ul class="example-orbit" data-orbit data-options="slide_number:false;timer:false;bullets:false;next_class: classic_next;prev_class: classic_prev;variable_height:true">
                  <li>
                    <img src="img/portfolio_single_2.jpg" alt="">
                  </li>
                  <li>
                    <img src="img/portfolio_single_3.jpg" alt="">
                  </li>
                </ul>                            
            </div>
            <div class="newsContent slide">
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