<?php

/**
* Template Name: Portfolio - Classic
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package Brander
*/



 get_header(); ?>





<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/component_gGrid.css" />

<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom_expandingGrid.js"></script>



<div class="gRow pattern_3">

    <div class="row">

        <div class="large-12 columns">

            <div class="main">

                <ul id="og-grid" class="og-grid">



                    <?php $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1);

                    $loop = new WP_Query( $args );

                    while ( $loop->have_posts() ) : $loop->the_post(); ?>



                    <li>

                        <a href="<?php the_permalink(); ?>" data-largesrc="<?php $image_id = get_post_thumbnail_id();

                        $image_url = wp_get_attachment_image_src($image_id,'526x395', true);

                        echo $image_url[0];  ?>" data-title="<?php the_title(); ?>" data-description="<?php echo wp_trim_words( get_the_content(), 100 ); ?>">

                            <?php if(has_post_thumbnail()) { the_post_thumbnail('248x215'); }?>

                        </a>

                    </li>





                    <?php endwhile; ?>                                                                                                                                                                    

                </ul>

            </div>         

        </div>

    </div>

</div>



<!-- Features Block -->

<?php get_template_part( 'page_blocks/features' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>





<?php get_footer(); ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/grid.js"></script>



 <script src='<?php echo get_template_directory_uri(); ?>/js/jquery-migrate.min.js?ver=1.2.1'></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/foundation.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js" ></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.inview.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.04022.js"></script> 

<script src="<?php echo get_template_directory_uri(); ?>/js/classie.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/svganimations.js"></script>   

<script>

    $(function() {

        Grid.init();

    });

</script>