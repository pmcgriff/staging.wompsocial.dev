<?php
// REGISTER SCRIPTS
function brander_style() {
  wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', false ); //Normalize
  wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.min.css', false ); //Foundation
  wp_enqueue_style( 'fonts', get_template_directory_uri() . '/fonts/fonts.css', false ); //Theme Fonts
  wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', false ); //Pretty Photo
  wp_enqueue_style( 'demo', get_template_directory_uri() . '/css/demo.css', false ); //
  wp_enqueue_style( 'audioplayer', get_template_directory_uri() . '/css/audioplayer.css', false ); //Audio Player
  wp_enqueue_style( 'style7', get_template_directory_uri() . '/css/style7.css', false ); //Style7
  wp_enqueue_style( 'brander_style', get_stylesheet_uri() ); 
  wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', false ); //Responsive
  

}

function brander_scripts() {
  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'bander-foundation', get_template_directory_uri() . '/js/foundation.min.js', array(), '1.0', true ); //Foundation
  wp_enqueue_script( 'bander-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true ); //General JS
  wp_enqueue_script( 'bander-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.0', true ); //Easing
  wp_enqueue_script( 'bander-vgrid', get_template_directory_uri() . '/js/jquery.vgrid.0.1.4-mod.js', array(), '1.0', true ); //Vgrid
  wp_enqueue_script( 'bander-tweetable', get_template_directory_uri() . '/js/tweetable.jquery.min.js', array(), '1.0', true ); //Tweetable
  wp_enqueue_script( 'bander-timeago', get_template_directory_uri() . '/js/jquery.timeago.js', array(), '1.0', true ); //TimeAgo
  wp_enqueue_script( 'bander-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), '1.0', true ); //PrettyPhoto
  wp_enqueue_script( 'bander-inview', get_template_directory_uri() . '/js/jquery.inview.js', array(), '1.0', true ); //Inview
  wp_enqueue_script( 'bander-class-ie', get_template_directory_uri() . '/js/classie.js', array(), '1.0', true ); //Class IE
  wp_enqueue_script( 'bander-svganimations', get_template_directory_uri() . '/js/svganimations.js', array(), '1.0', true ); //SVG Animation
  wp_enqueue_script( 'bander-audioplayer', get_template_directory_uri() . '/js/audioplayer.min.js', array(), '1.0', true ); //Supersized Shutter
  wp_enqueue_script( 'brander-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );
  wp_enqueue_script( 'brander-modrnizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', array(), '1.0'  );//Modernizr
  wp_enqueue_script( 'brander-migrate', get_template_directory_uri() . '/js/jquery-migrate.min.js?ver=1.2.1', array(), '1.0', true );
  wp_enqueue_script( 'brander-isotope', get_template_directory_uri() . '/js/jquery.isotope.js', array(), '1.0',  true);//Isotope
  wp_enqueue_script( 'brander-shorty', get_template_directory_uri() . '/js/modernizr.custom.79639.js', array(), '1.0',  false);//Custom Modernizr for shortcode support   

  if (is_page_template('page-templates/about.php')) {
    wp_enqueue_style( 'common-hover', get_template_directory_uri() . '/css/common-hover.css', false ); //Style7  
  } 

  if (is_page_template('page-templates/blog-timeline.php')) {
    wp_enqueue_style( 'timeline', get_template_directory_uri() . '/css/timeline.css', false ); //Style7  
  }


  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }


  if ( is_singular() && wp_attachment_is_image() ) {
    wp_enqueue_script( 'brander-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202', true );
  }

  if ( is_singular() ) wp_enqueue_script( "comment-reply" );
    
    if (is_page_template('page-templates/womp-teaser.php')) {
      wp_enqueue_script('jquery_validate', get_template_directory_uri() . '/js/validate/jquery.validate.min.js', array( 'jquery' ) , '1.11', TRUE);
      wp_enqueue_script('jquery_add_method', get_template_directory_uri() . '/js/validate/additional-methods.min.js', array( 'jquery_validate' ) , '1.11', TRUE);
      wp_enqueue_script('contactus_validate', get_template_directory_uri() . '/js/validate/form-validator-script.js', array( 'jquery_validate' ) , '1.0', TRUE);    
    }
}

add_action( 'wp_enqueue_scripts', 'brander_style' );
add_action( 'wp_enqueue_scripts', 'brander_scripts' );







//GOOGLE WEB FONTS
function load_fonts() {
    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Quicksand:300,400,700');
    wp_enqueue_style( 'googleFonts');
}
    
add_action('wp_print_styles', 'load_fonts');




  function add_twitter_feed() { ?>


  <?php if (empty($brander_options['twitter_feed'])): ?>
      <?php $twitter_user = 'avathemes' ?>
  <?php else: ?>
      <?php $twitter_user = $brander_options['twitter_feed']; ?>
  <?php endif ?> 


  <script type="text/javascript">
        (function($) {
          "use strict";    
        $('.tweet').tweetable({
            username: '<?php echo $twitter_user; ?>',
            limit: 1,
            rotate: false,
            speed: 10000,
            time: true,
            html5: true,
            onComplete:function($ul){
                $('time').timeago();
            }
        });
        })(jQuery);     
  </script>
  
  <?php
  }
  add_action('wp_footer','add_twitter_feed',100);


//ADD HOME 01 SCRIPTS


function scripts() {
if ( is_page_template('page-templates/home-01.php') || is_page_template('page-templates/gallery.php')) { 
  wp_enqueue_style( 'supersized', get_template_directory_uri() . '/css/supersized.css', false ); //Supersized
  wp_enqueue_style( 'supersized_shutter', get_template_directory_uri() . '/css/supersized.shutter.css', false ); //Supersized Shutter  
  wp_enqueue_script( 'bander-supersized', get_template_directory_uri() . '/js/supersized.3.2.7.min.js', array(), '1.0', true ); //Supersized
  wp_enqueue_script( 'bander-supersized_shutter', get_template_directory_uri() . '/js/supersized.shutter.min.js', array(), '1.0', true ); //Supersized Shutter
  }
}
add_action( 'wp_print_scripts', 'scripts'); 

function home_01_scripts() { ?>
	
	<?php if ( is_page_template('page-templates/home-01.php') ) { ?>
        <script>
            //Inview Portfolio Grid
                jQuery('div.portfolioRow').bind('inview', function (event, visible) {
                  if (visible == true) {
                        (function($){
                            $(function(){                   
                                $('#header').css("visibility", "hidden");
                                var setGrid = function () {
                                    return $("#grid-wrapper").vgrid({
                                        easeing: "easeOutQuint",
                                        time: 800,
                                        delay: 60,
                                        selRefGrid: "#grid-wrapper div.x1",
                                        selFitWidth: ["#container", "#footer"],
                                        gridDefWidth: 290 + 15 + 15 + 5,
                                        forceAnim: 1            });
                                };
                                
                                setTimeout(setGrid, 300);
                                setTimeout(function() {
                                    $('#header').hide().css("visibility", "visible").fadeIn(500);
                                }, 500);
                                
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


        <script type="text/javascript">
            
            jQuery(function($){
                
                $.supersized({
                
                    // Functionality
                    slideshow               :   1,          // Slideshow on/off
                    autoplay                :   1,          // Slideshow starts playing automatically
                    start_slide             :   1,          // Start slide (0 is random)
                    stop_loop               :   0,          // Pauses slideshow on last slide
                    random                  :   0,          // Randomize slide order (Ignores start slide)
                    slide_interval          :   5000,       // Length between transitions
                    transition              :   6,          // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                    transition_speed        :   1000,       // Speed of transition
                    new_window              :   1,          // Image links open in new window/tab
                    pause_hover             :   0,          // Pause slideshow on hover
                    keyboard_nav            :   1,          // Keyboard navigation on/off
                    performance             :   1,          // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
                    image_protect           :   0,          // Disables image dragging and right click with Javascript
                                                               
                    // Size & Position                         
                    min_width               :   0,          // Min width allowed (in pixels)
                    min_height              :   0,          // Min height allowed (in pixels)
                    vertical_center         :   1,          // Vertically center background
                    horizontal_center       :   1,          // Horizontally center background
                    fit_always              :   0,          // Image will never exceed browser width or height (Ignores min. dimensions)
                    fit_portrait            :   1,          // Portrait images will not exceed browser height
                    fit_landscape           :   0,          // Landscape images will not exceed browser width
                                                               
                    // Components                           
                    slide_links             :   false,    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
                    thumb_links             :   1,          // Individual thumb links for each slide
                    thumbnail_navigation    :   0,          // Thumbnail navigation
                    slides                  :   [           // Slideshow Images


                    <?php global $brander_options; ?>




			        <?php if (empty($brander_options['supersized_galery'])): ?>

			        <?php else: ?>
			            <?php foreach ($brander_options['supersized_galery'] as $key => $value): ?>
			                {image : "<?php echo $value['image']; ?>"},
			            <?php endforeach ?>
			        <?php endif ?>



                                                                                                                                                                     
                                                ],
                                                
                    // Theme Options               
                    progress_bar            :   0,          // Timer for each slide                         
                    mouse_scrub             :   0
                    
                });
            });


            
        </script>
	<?php } ?>

	
<?php }

add_action('wp_footer', 'home_01_scripts',100);









//ADD ABOUT SCRIPTS
function about_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/about.php') ) { ?>
        <script>
          jQuery(window).load(function() {
            jQuery(".image_side").css({'height':(jQuery(".post_item").height() + 90 +'px')});
          });                       
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'about_scripts',100);



//ADD ABOUT 02 SCRIPTS
function about02_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/about-02.php') ) { ?>
        <script>
          jQuery(window).load(function() {
            jQuery(".large-6_image_side").css({'height':(jQuery(".large-6_post_item").height()+ 205 +'px')});
          });                       
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'about02_scripts',100);


//ADD PORTFOLIO SCRIPTS
function portfolio_google() { ?>
  
  <?php if ( is_page_template('page-templates/portfolio.php') ) { ?>
        <script>
        (function($) {
            $(function() {
              Grid.init();
            }); 
        })(jQuery);                                
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_google',100);

//ADD PORTFOLIO 2 COLUMNS SCRIPTS
function portfolio_2Col_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/portfolio-2col.php') ) { ?>
        <script>
          jQuery(window).load(function() {
            jQuery(".teamItem .image").css({'height':(jQuery(".teamItem .white").height()+ 83 +'px')});
          });                       
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_2Col_scripts',100);

//ADD PORTFOLIO 3 COLUMNS SCRIPTS
function portfolio_3Col_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/portfolio-3col.php') ) { ?>
        <script>
            //Inview Portfolio Grid
                jQuery('div.portfolioRow').bind('inview', function (event, visible) {
                  if (visible == true) {
                        (function($){
                            $(function(){                   
                                $('#header').css("visibility", "hidden");
                                var setGrid = function () {
                                    return $("#grid-wrapper").vgrid({
                                        easeing: "easeOutQuint",
                                        time: 800,
                                        delay: 60,
                                        selRefGrid: "#grid-wrapper div.x3",
                                        selFitWidth: ["#container", "#footer"],
                                        gridDefWidth: 290 + 15 + 15 + 5,
                                        forceAnim: 1            });
                                };
                                
                                setTimeout(setGrid, 300);
                                setTimeout(function() {
                                    $('#header').hide().css("visibility", "visible").fadeIn(500);
                                }, 500);
                                
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
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_3Col_scripts',100);


//ADD PORTFOLIO 4 COLUMNS SCRIPTS
function portfolio_4Col_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/portfolio-4col.php') ) { ?>
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
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_4Col_scripts',100);



//ADD PORTFOLIO FULL SCRIPTS
function portfolio_full_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/portfolio-masonry-full-width.php') ) { ?>
        <script>     
          jQuery(window).load(function() {
            jQuery(function($) {                 
                $(function() {

                    $.Isotope.prototype._getCenteredMasonryColumns = function() {
                        this.width = this.element.width();
                        var parentWidth = this.element.parent().width();
                        // i.e. options.masonry && options.masonry.columnWidth
                        var colW = this.options.masonry && this.options.masonry.columnWidth ||
                        // or use the size of the first item
                        this.$filteredAtoms.outerWidth(true) ||
                        // if there's no items, use size of container
                        parentWidth;
                        var cols = Math.floor(parentWidth / colW);
                        cols = Math.max(cols, 1);
                        // i.e. this.masonry.cols = ....
                        this.masonry.cols = cols;
                        // i.e. this.masonry.columnWidth = ...
                        this.masonry.columnWidth = colW;
                    };

                    $.Isotope.prototype._masonryReset = function() {
                        // layout-specific props
                        this.masonry = {};
                        // FIXME shouldn't have to call this again
                        this._getCenteredMasonryColumns();
                        var i = this.masonry.cols;
                        this.masonry.colYs = [];
                        while (i--) {
                            this.masonry.colYs.push(0);
                        }
                    };

                    $.Isotope.prototype._masonryResizeChanged = function() {
                        var prevColCount = this.masonry.cols;
                        // get updated colCount
                        this._getCenteredMasonryColumns();
                        return (this.masonry.cols !== prevColCount);
                    };

                    $.Isotope.prototype._masonryGetContainerSize = function() {
                        var unusedCols = 0,
                            i = this.masonry.cols;
                        // count unused columns
                        while (--i) {
                            if (this.masonry.colYs[i] !== 0) {
                                break;
                            }
                            unusedCols++;
                        }
                        return {
                            height: Math.max.apply(Math, this.masonry.colYs),
                            // fit container to columns that have been used;
                            width: (this.masonry.cols - unusedCols) * this.masonry.columnWidth
                        };
                    };


                    var $container = $('#container_iso'),
                        $body = $('body'),
                        colW = 1,
                        columns = null;

                    $container.isotope({
                        // disable window resizing
                        resizable: false,
                        masonry: {
                            columnWidth: colW
                        }
                    });

                    //FILTERING
                    $('#filters a').click(function() {
                        var selector = $(this).attr('data-filter');
                        $container.isotope({
                            filter: selector
                        });
                        return false;
                    });
                });
            });
          }); 
                 
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_full_scripts',100);


//ADD SERVICES SCRIPTS
function portfolio_services_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/services.php') ) { ?>
        <script>     
          jQuery(window).load(function() {
            jQuery("div.teamItem-large .image").css({'height':(jQuery(".teamItem-large .white").height()+ 96 +'px')});
          }); 
                 
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_services_scripts',100);


//ADD TEAM SCRIPTS
function portfolio_team_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/team.php') ) { ?>
        <script>     
          jQuery(window).load(function() {
            jQuery(".teamItem .image").css({'height':(jQuery(".teamItem .white").height()+ 83 +'px')});
          }); 
                 
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_team_scripts',100);



//ADD TEAM 02 SCRIPTS
function portfolio_team02_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/team-02.php') ) { ?>
        <script>     
          jQuery(window).load(function() {
            jQuery("div.teamItem-large .image").css({'height':(jQuery(".teamRow .white").height()+ 83 +'px')});
          }); 
                 
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_team02_scripts',100);


//ADD BLOG MASONRY SCRIPTS
function portfolio_blog_masonry_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/blog-masonry.php') ) { ?>
        <script>     
            jQuery(window).load(function() {
              jQuery(function($) { 
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
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_blog_masonry_scripts',100);




//ADD BLOG MASONRY FULL WIDTH SCRIPTS
function portfolio_blog_masonry_full_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/blog-masonry-full.php') ) { ?>
        <script>   
            jQuery(window).load(function() {
              jQuery(function($) { 
                $(function() {

                    $.Isotope.prototype._getCenteredMasonryColumns = function() {
                        this.width = this.element.width();
                        var parentWidth = this.element.parent().width();
                        // i.e. options.masonry && options.masonry.columnWidth
                        var colW = this.options.masonry && this.options.masonry.columnWidth ||
                        // or use the size of the first item
                        this.$filteredAtoms.outerWidth(true) ||
                        // if there's no items, use size of container
                        parentWidth;
                        var cols = Math.floor(parentWidth / colW);
                        cols = Math.max(cols, 1);
                        // i.e. this.masonry.cols = ....
                        this.masonry.cols = cols;
                        // i.e. this.masonry.columnWidth = ...
                        this.masonry.columnWidth = colW;
                    };

                    $.Isotope.prototype._masonryReset = function() {
                        // layout-specific props
                        this.masonry = {};
                        // FIXME shouldn't have to call this again
                        this._getCenteredMasonryColumns();
                        var i = this.masonry.cols;
                        this.masonry.colYs = [];
                        while (i--) {
                            this.masonry.colYs.push(0);
                        }
                    };

                    $.Isotope.prototype._masonryResizeChanged = function() {
                        var prevColCount = this.masonry.cols;
                        // get updated colCount
                        this._getCenteredMasonryColumns();
                        return (this.masonry.cols !== prevColCount);
                    };

                    $.Isotope.prototype._masonryGetContainerSize = function() {
                        var unusedCols = 0,
                            i = this.masonry.cols;
                        // count unused columns
                        while (--i) {
                            if (this.masonry.colYs[i] !== 0) {
                                break;
                            }
                            unusedCols++;
                        }
                        return {
                            height: Math.max.apply(Math, this.masonry.colYs),
                            // fit container to columns that have been used;
                            width: (this.masonry.cols - unusedCols) * this.masonry.columnWidth
                        };
                    };


                    var $container = $('#container_iso'),
                        $body = $('body'),
                        colW = 1,
                        columns = null;

                    $container.isotope({
                        // disable window resizing
                        resizable: false,
                        masonry: {
                            columnWidth: colW
                        }
                    });

                    //FILTERING
                    $('#filters a').click(function() {
                        var selector = $(this).attr('data-filter');
                        $container.isotope({
                            filter: selector
                        });
                        return false;
                    });
                  });
                });
            });
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'portfolio_blog_masonry_full_scripts',100);



//ADD TIMELINE SCRIPTS
function timeline_blog_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/blog-timeline.php') ) { ?>
        <script>    
          jQuery(function($) { 
            $(window).scroll(function(){                 
                $('.container .padding_left').each(function(){
                    var scrollTop     = $(window).scrollTop(),
                        elementOffset = $(this).offset().top,
                        distance      = (elementOffset - scrollTop),
                            windowHeight  = $(window).height(),
                            breakPoint    = windowHeight*0.9;

                        if(distance > breakPoint) {
                            $(this).addClass("more-padding");   
                        }  if(distance < breakPoint) {
                            $(this).removeClass("more-padding");    
                        }
                });
            });

            jQuery(window).load(function() {
              jQuery(".container div.contentsDiv:nth-child(odd)").addClass("left-content")
              jQuery(".container div.contentsDiv:nth-child(even)").addClass("right-content")
            }); 
            
          });

                 
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'timeline_blog_scripts',100);



//ADD CLASSIC SCRIPTS
function blog_classic_scripts() { ?>
  
  <?php if ( is_page_template('page-templates/blog-classic.php') ) { ?>
        <script>    
          jQuery(function($) { 
            $('.tweet').tweetable({username: 'AVAThemes'});
            
          });

                 
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'blog_classic_scripts',100);




//ADD CLASSIC SCRIPTS
function contact_02() { ?>
  
  <?php if ( is_page_template('page-templates/contact-02.php') ) { ?>
        <script>
          jQuery(window).load(function() {
            jQuery(".large-6_image_side").css({'height':(jQuery(".large-6_post_item").height()+ 205 +'px')});
          });                       
        </script>
  <?php } ?>

  
<?php }

add_action('wp_footer', 'contact_02',100);









//ADD HOME 03 SCRIPTS
function shortcode_page() { ?>
  
  <?php if ( is_page_template('page-templates/shortcode.php') ) { ?>
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




           //Inview Portfolio Grid
                jQuery('div.portfolioRow').bind('inview', function (event, visible) {
                  if (visible == true) {
                        (function($){
                            $(function(){                   
                                var setGrid = function () {
                                    return $("#grid-wrapper_2").vgrid({
                                        easeing: "easeOutQuint",
                                        time: 800,
                                        delay: 60,
                                        selRefGrid: "#grid-wrapper_2 div.x3",
                                        selFitWidth: ["#container"],
                                        gridDefWidth: 290 + 15 + 15 + 5,
                                        forceAnim: 1            });
                                };
                                
                                setTimeout(setGrid, 300);

                                
                                $(window).load(function(e){
                                    setTimeout(function(){ 
                                        // prevent flicker in grid area - see also style.css
                                        $("#grid-wrapper_2").css("paddingTop", "0px");
                                    }, 0);
                                });

                            }); // end of document ready
                        })(jQuery); // end of jQuery name space             
                  } else {
                    jQuery("div.portfolioRow").unbind('inview');
                  }
                });

        </script>


        <script type="text/javascript">

            jQuery( function() { jQuery( 'audio' ).audioPlayer(); } );
            
        </script>

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


        <script>
          jQuery(window).load(function() {
            jQuery(".image_side").css({'height':(jQuery(".post_item").height() + 90 +'px')});

            jQuery( function() { jQuery( 'audio' ).audioPlayer(); } );
          });  
        </script>
      
  <?php } ?>

  
<?php }

add_action('wp_footer', 'shortcode_page',100);