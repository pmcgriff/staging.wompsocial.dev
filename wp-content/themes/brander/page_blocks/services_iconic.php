<?php global $brander_options; ?>

    <?php if (empty($brander_options['services_background']['url'])): ?>
        <style>
            .serviceRow {
            background: url(http://placehold.it/1680x1050/181818/ffffff.jpg) no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            }
            .themeFeatures {background: transparent;}
        </style>
    <?php else: ?>
        <style>
            .serviceRow {
            background: url(<?php echo $brander_options['services_background']['url']; ?>) no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            }
            .themeFeatures {background: transparent;}
        </style>    
    <?php endif ?> 

<div class="serviceRow">
    <div class="row">
        <div class="blockTitle">
            <?php if (empty($brander_options['services_title'])): ?>
                Our Services
             <?php else: ?>
                <?php echo $brander_options['services_title']; ?>
             <?php endif ?>
            </div>
        <div class="fancySeperator"></div>
        <div class="large-11 large-centered columns">
            <?php if (empty($brander_options['services_text'])): ?>
                <p>To be the first to enter the cosmos, to engage, single-handed, in an unprecedented duel with nature—could one dream of anything more? </p>
             <?php else: ?>
                <p><?php echo $brander_options['services_text']; ?></p>
             <?php endif ?>            
        </div>

        <div class="large-10 large-centered columns serviceIconRow ">

            <?php $args = array( 'post_type' => 'service', 'posts_per_page' => 3);
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <?php if (function_exists('rwmb_meta')):?> 
                <div class="large-4 medium-4 small-6 columns serviceColumns">
                    <div class="aboutPicture servicePicture">
                        <div class="servicePicHold">
                        <?php 
                        $images = rwmb_meta( 'iconic', 'type=image_advanced' );
                        foreach ( $images as $image )
                        {
                            echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
                        }
                         ?>

                        </div>
                    </div> 
                    <div class="title"><?php the_title(); ?></div>                       
                </div>                        
            <?php else: ?>   
            <?php endif; ?>
            <?php endwhile; ?>                    
        </div>

        <?php if (empty($brander_options['price_shortcode'])): ?>

         <?php else: ?>

        <div class="large-12 columns priceTable">
            <?php echo do_shortcode(stripslashes($brander_options['price_shortcode'])); ?>  
                                                      
        </div>         
            
         <?php endif ?>

    </div>
</div>