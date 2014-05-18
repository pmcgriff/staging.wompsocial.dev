<?php global $brander_options; ?>



<div id="news" class="newsfeed">

    <?php $args = array( 'post_type' => 'post', 'posts_per_page' => 1);
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <div class="large-6 columns medium-6 image_side">
        <?php if(has_post_thumbnail()) { the_post_thumbnail('745x385'); }?>
        <div class="post_info">
            <div class="date-n-category"><?php the_time('d.m.Y') ?>   <span>/</span>   <?php the_category(', '); ?></div>
            <div class="tags"><?php the_tags('',', '); ?></div>                   
        </div>
    </div>
    <div class="large-6 columns medium-6 post_item">
        <div class="title">
            <div class="number">01</div>
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        </div>
        <div class="content">
            <p><?php echo wp_trim_words( get_the_content(), 80 ); ?></p>
            <a href="<?php the_permalink(); ?>" class="readMore">Read More</a>
        </div>
    </div>

    <?php endwhile; ?>

</div>


<script>
  jQuery(window).load(function() {
    jQuery(".image_side").css({'height':(jQuery(".post_item").height() + 90 +'px')});

  });                       
</script>