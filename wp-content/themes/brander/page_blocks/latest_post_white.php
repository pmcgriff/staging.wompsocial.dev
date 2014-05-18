<?php global $brander_options; ?>





<div class="aboutTxt aboutWhiteTxt">
    <div class="row">
        <div class="scrolly">
            <a href="#news">
                <img src="<?php echo get_template_directory_uri(); ?>/img/scrolly-bottom.png" alt="">
            </a>
        </div>
        <div id="news" class="titleHold large-8 medium-12 large-centered columns">
            <?php if (empty($brander_options['latest_title'])): ?>
                Science cuts two Ways, of course
             <?php else: ?>
                <?php echo $brander_options['latest_title']; ?>
             <?php endif ?>             
        </div>

        <?php $args = array( 'post_type' => 'post', 'posts_per_page' => 2);
        $counter = 1;
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <div class="large-6 medium-6 columns about50">
            <div class="large-12 columns">
                <div class="number">
                    <span><?php echo $counter; ?></span>
                </div>
                <div class="date"><?php the_time('d.m.Y') ?></div>
                <div class="category"><?php the_category(', '); ?></div>
            </div>
            <div class="large-12 columns title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="large-12 columns text">
                <p><?php echo wp_trim_words( get_the_content(), 40 ); ?></p>
            </div>
            <div class="large-12 columns link">
                <a href="<?php the_permalink(); ?>" class="readMore">
                    Read More
                </a>
            </div>
        </div>

        <?php $counter++; endwhile; ?>

                
    </div>
</div>

