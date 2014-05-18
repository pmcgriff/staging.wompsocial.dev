<?php global $brander_options; ?>


    <?php if (empty($brander_options['about_background']['url'])): ?>
        <style>
            .aboutRow {
                position: relative;
            }
            
            .aboutRow:after {
              content: "";
            background: rgba(0,0,0,0.8)  url(http://placehold.it/1680x1050/181818/ffffff.jpg) no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
              opacity: 0.2;
              top: 0;
              left: 0;
              bottom: 0;
              right: 0;
              position: absolute;
              z-index: 1;   
            }     
            .themeFeatures {background: transparent;}    
            .themeFeatures:after {content: none;}   
        </style>
    <?php else: ?>
        <style>
            .aboutRow {
                position: relative;
            }
            .aboutRow:after {
              content: "";
            background: rgba(0,0,0,0.8)  url(<?php echo $brander_options['about_background']['url']; ?>) no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
              opacity: 0.2;
              top: 0;
              left: 0;
              bottom: 0;
              right: 0;
              position: absolute;
              z-index: 1; 
            }            
            .themeFeatures {background: transparent;}
            .themeFeatures:after {content: none;}  
        </style>    
    <?php endif ?> 


    <?php if (empty($brander_options['about_background']['url'])): ?>
        <style>
            .ch-img-2 {
            background-image: url(http://placehold.it/226x226/8d6d2e/ffffff.jpg);
            }
        </style>
    <?php else: ?>
        <style>
            .ch-img-2 {
            background-image: url(<?php echo $brander_options['about_image']['url']; ?>);
            }
        </style>    
    <?php endif ?>    
<style>
    
</style>

<div class="aboutRow">
    <div class="row">
        <div class="blockTitle">
            <?php if (empty($brander_options['about_title'])): ?>
                About Me
             <?php else: ?>
                <?php echo $brander_options['about_title']; ?>
             <?php endif ?>
        </div>
        <div class="fancySeperator"></div>

        <div class="large-3 large-centered medium-3 medium-centered columns aboutImage">
            <ul class="ch-grid ">
                <li>
                    <div class="ch-item">               
                        <div class="ch-info about_image">
                            <div class="ch-info-front ch-img-2 inner-border"></div>
                            <div class="ch-info-back inner-border">
                                <?php if (empty($brander_options['about_subtitle'])): ?>
                                    <h3>Brander photography</h3>
                                 <?php else: ?>
                                    <h3><?php echo $brander_options['about_subtitle']; ?></h3>
                                 <?php endif ?>                                
                            </div>  
                        </div>
                    </div>
                </li>
            </ul>               
        </div>


        <div class="blockText large-10 large-centered columns">
            <?php if (empty($brander_options['about_text'])): ?>
                <p>You know, being a test pilot isn't always the healthiest business in the world.</p>

                <p>To be the first to enter the cosmos, to engage, single-handed, in an unprecedented duel with nature—could one dream of anything more?</p>

                <br />

                <p>What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth. Where ignorance lurks, so too do the frontiers of discovery and imagination.</p>
             <?php else: ?>
                <h3><?php echo $brander_options['about_text']; ?></h3>
             <?php endif ?>    
        </div>

        <div class="readMore"> 
            <a href="<?php bloginfo('url') ?>/<?php if (empty($brander_options['about_slug'])): ?>#<?php else: ?><?php echo $brander_options['about_slug']; ?><?php endif ?>">Read More</a>
        </div>
    </div>
</div>