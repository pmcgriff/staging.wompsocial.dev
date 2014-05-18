<div id="scroll-tm" class="portfolioRow">            
    <div class="row">     
        <div id="container">
            <div id="grid-wrapper">

                <?php $args = array( 'post_type' => 'portfolio');
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div class="post grid-item x1  
                        <?php if (function_exists('rwmb_meta')):?>
                            <?php
                            if (rwmb_meta( 'size' )=='small') { ?>
                                small
                            <?php } elseif (rwmb_meta( 'size' )=='medium') { ?>
                                medium
                            <?php } else { ?>
                                small
                            <?php } ?>
                        <?php else: ?>   
                            <?php echo  "small"; ?>
                        <?php endif; ?>
                    ">
                        <div class="innerItem">

                            <?php if (function_exists('rwmb_meta')):?> 

                                <?php
                                if (rwmb_meta( 'size' )=='small') { ?>
                                    <?php if(has_post_thumbnail()) { the_post_thumbnail('333x239'); }?>
                                <?php } elseif (rwmb_meta( 'size' )=='medium') { ?>
                                    <?php if(has_post_thumbnail()) { the_post_thumbnail('333x490'); }?>
                                <?php } else { ?>
                                    <?php if(has_post_thumbnail()) { the_post_thumbnail('333x239'); }?>
                                <?php } ?>

                            <?php else: ?>   
                            <?php endif; ?>
                            <div class="hiddenReveal">
                                <div class="zoomy">
                                    <a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/icon-zoom.png" height="58" width="58" alt="">
                                    </a>
                                </div>
                                <div class="linky">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/icon-link.png" height="58" width="58" alt="">
                                    </a>
                                </div>

                                <div class="text">
                                    <h5>
                                        <?php if (function_exists('rwmb_meta')):?> 
                                            <?php echo rwmb_meta( 'subtitle' ); ?>
                                        <?php else: ?>   
                                        <?php endif; ?>
                                    </h5>
                                    <h2><?php if (strlen($post->post_title) > 12) {echo substr(the_title($before = '', $after = '', FALSE), 0, 12) . ''; } else {the_title();} ?></h2>

                                    <?php if (function_exists('rwmb_meta')):?> 

                                        <?php
                                        if (rwmb_meta( 'size' )=='small') { ?>
                                           
                                        <?php } elseif (rwmb_meta( 'size' )=='medium') { ?>
                                            <?php the_excerpt(); ?>
                                        <?php } else { ?>
                                        <?php } ?>

                                    <?php else: ?>   
                                    <?php endif; ?>    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

 
            </div><!-- /grid-wrapper -->   
        </div><!-- /container -->
    </div>



</div>
