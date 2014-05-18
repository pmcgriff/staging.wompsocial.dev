<?php global $brander_options; ?>


<div class="projectsBlock">
    <div class="row">
        <div class="large-6 medium-6 columns latestProject">
            <div class="latestTitle">
                <div class="title">Latest Project</div>
                <div class="description"><span>
                    <?php $count_posts = wp_count_posts( 'portfolio' )->publish; echo $count_posts?>
                </span> PROJECTS DONE</div>
            </div>


            <?php $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 1);
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <?php if(has_post_thumbnail()) { the_post_thumbnail('497x322'); }?>

            <?php endwhile; ?>

        </div>
        <div class="large-6 medium-6 columns latestEnter">

            <?php $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 1, 'offset' => 1);
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <?php if(has_post_thumbnail()) { the_post_thumbnail('497x296'); }?>



            <img src="<?php echo get_template_directory_uri(); ?>/img/tiny-rectangle.png" height="24" width="24" alt="" class="rectangle">
            <div class="enterContent">
                <div class="image"><img src="<?php echo get_template_directory_uri(); ?>/img/check.png" height="65" width="65" alt=""></div>
                <div class="text">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p>
                        <?php echo wp_trim_words( get_the_content(), 13 ); ?>
                    </p>
                </div>
            </div>
            <?php endwhile; ?>            
            
        </div>                
    </div>
</div>
