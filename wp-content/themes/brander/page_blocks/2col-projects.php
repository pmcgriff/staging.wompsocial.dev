    <div id="scroll-tm" class="portfolioRow portfoliox3">            

        <div class="row">     

            <div id="container">

                <div id="grid-wrapper">







                <?php $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 4);

                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ) : $loop->the_post(); ?>



                    <div class="post grid-item x3 medium">

                        <div class="innerItem">

                            <?php if(has_post_thumbnail()) { the_post_thumbnail('512x340'); }?>

                            <div class="hiddenReveal">

                                <div class="leftHover">

                                    <div class="zoomy">

                                        <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto[gallery]">


                                                <?php if (empty($brander_options['post_zoom']['url'])): ?>

                                                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-zoom_gold.png" height="58" width="58" alt="">

                                                <?php else: ?>

                                                <img src="<?php echo $brander_options['post_zoom']['url']; ?>" alt=""> 

                                                <?php endif ?> 

                                            

                                        </a>

                                    </div>

                                    <div class="linky">

                                        <a href="<?php the_permalink(); ?>">


                                            <?php if (empty($brander_options['post_link']['url'])): ?>

                                            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-link_gold.png" height="58" width="58" alt="">

                                            <?php else: ?>

                                            <img src="<?php echo $brander_options['post_link']['url']; ?>" alt=""> 

                                            <?php endif ?> 

                                            

                                        </a>

                                    </div>

                                </div>

                                <div class="rightHover">

                                    <div class="text">

                                        <h5>

                                            <?php if (function_exists('rwmb_meta')):?> 

                                                <?php echo rwmb_meta( 'subtitle' ); ?>

                                            <?php else: ?>   

                                            <?php endif; ?>

                                        </h5>

                                        <h2><?php the_title(); ?></h2>

                                        <p>web design</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                <?php endwhile; ?>



                </div><!-- /grid-wrapper -->   

            </div><!-- /container -->

        </div>



        <div class="row">

            <a href="<?php echo get_template_directory_uri(); ?>/portfolio" class="loadMore">Load More</a>

        </div>



    </div>







    <script>

       //Inview Portfolio Grid

            jQuery('div.portfolioRow').bind('inview', function (event, visible) {

              if (visible == true) {

                    (function($){

                        $(function(){                   

                            var setGrid = function () {

                                return $("#grid-wrapper").vgrid({

                                    easeing: "easeOutQuint",

                                    time: 800,

                                    delay: 60,

                                    selRefGrid: "#grid-wrapper div.x3",

                                    selFitWidth: ["#container"],

                                    gridDefWidth: 290 + 15 + 15 + 5,

                                    forceAnim: 1            });

                            };

                            

                            setTimeout(setGrid, 300);



                            $(window).load(function(e){

                                setTimeout(function(){ 

                                    // prevent flicker in grid area - see also style.css

                                    $("#grid-wrapper").css("paddingTop", "0px");

                                }, 0);

                            });



                        }); // end of document ready

                    })(jQuery); // end of jQuery name space             

              } else {

                jQuery("div.portfolioRow").unbind('inview');

              }

            });



    </script>