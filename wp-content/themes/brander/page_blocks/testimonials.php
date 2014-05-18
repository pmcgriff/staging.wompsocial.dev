<?php global $brander_options; ?>


<?php if (empty($brander_options['testimonials_background']['url'])): ?>
    <style>
        .sp-content {
        background: #7d7f72 url(http://placehold.it/1680x1050/181818/ffffff.jpg) repeat scroll 0 0;
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        }        
    </style>
<?php else: ?>
    <style>
        .sp-content {
        background: #7d7f72 url(<?php echo $brander_options['testimonials_background']['url']; ?>) repeat scroll 0 0;
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        }        
    </style>    
<?php endif ?> 


<div class="testimonialRow">
    <div class="sp-slideshow">
    
        <input id="button-1" type="radio" name="radio-set" class="sp-selector-1" checked="checked" />
        <label for="button-1" class="button-label-1"></label>


        <?php
           $args = array( 'post_type' => 'testimonials', 'posts_per_page' => 1); 
           $loop = new WP_Query( $args );
           while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <input id="button-1" type="radio" name="radio-set" class="sp-selector-1" checked="checked" />
            <label for="button-1" class="button-label-1"></label>
        <?php endwhile; ?>  



        <?php
           $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1, 'offset' => 1); 
           $loop = new WP_Query( $args );
           $counter = 2;
           while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <input id="button-<?php echo $counter;?>" type="radio" name="radio-set" class="sp-selector-<?php echo $counter;?>" />
            <label for="button-<?php echo $counter;?>" class="button-label-<?php echo $counter;?>"></label>


        <?php $counter++; endwhile; ?>  
        

        

        <?php
           $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1); 
           $loop = new WP_Query( $args );
           $counter = 1;
           while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <label for="button-<?php echo $counter;?>" class="sp-arrow sp-a<?php echo $counter;?>"></label>
        <?php $counter++; endwhile; ?>          

        

            <div class="sp-content">
                <div class="sp-parallax-bg"></div>              
                <ul class="sp-slider clearfix">
				<?php
				   $args = array( 'post_type' => 'testimonials' ); 
				   $loop = new WP_Query( $args );
				   while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <li>
                        <div class="testimonial row">
                            <div class="aboutPicture">
                                <?php if(has_post_thumbnail()) { the_post_thumbnail('testimonials'); }?>
                            </div>
                            <p><?php echo wp_trim_words( get_the_content(), 100 ); ?></p>
                            <span class="title"><?php the_title(); ?></span>
                        </div>
                    </li>
				<?php endwhile; ?>  
                </ul>
            </div><!-- sp-content -->

        
    </div><!-- sp-slideshow -->         
</div>


