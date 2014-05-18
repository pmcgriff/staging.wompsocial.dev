
        <div id="scroll-tm" class="portfolioRow">   

            <div class="row filterRow">

                <ul id="filters" class="smallFilters show-for-1024">
                  <li>Filters
                    <ul>
                     <li><a href="#" class="all" data-filter="*">All</a></li>
                    <?php
                    $catArgs = array(
                                'taxonomy'=>'project-type'
                                // post_type isn't a valid argument, no matter how you use it.
                                );
                    $categories = get_categories('taxonomy=project-type'); ?>
                     <?php foreach ($categories as $category) : ?>

                    <li><a href="#" data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name ?></a></li>

                     <?php endforeach; ?>                   
                    </ul>
                  </li>
                </ul>

                <ul id="filters" class="hide-for-1024">
                     <li><a href="#" class="all" data-filter="*">All</a></li>
                    <?php
                    $catArgs = array(
                                'taxonomy'=>'project-type'
                                // post_type isn't a valid argument, no matter how you use it.
                                );
                    $categories = get_categories('taxonomy=project-type'); ?>
                     <?php foreach ($categories as $category) : ?>

                    <li><a href="#" data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name ?></a></li>

                     <?php endforeach; ?>
                </ul>
            </div>

            <div class="row">     
                <div id="container_iso">


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

                      <?php 
                            $term_list = wp_get_post_terms($post->ID, 'project-type');

                            foreach ($term_list as $name) {
                                echo $name->slug.' ';
                            }
                      ?>

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
                                    <h2><?php the_title(); ?></h2>

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


                </div><!-- /container -->
            
            </div>
        </div>



        <script>
            jQuery(function($) {        
                $(window).load(function() {
                    $(function(){
                      
                      var $container = $('#container_iso');
                      
                      $container.isotope({
                        itemSelector: '.post'
                      });
                      
                    });

                    // cache container
                    var $container = $('#container_iso');


                    // filter items when filter link is clicked
                    $('#filters a').click(function(){
                      var selector = $(this).attr('data-filter');
                      $container.isotope({ filter: selector });
                      return false;
                    });   
                }); 
            }); 
       
        </script>