<?php global $brander_options; ?>

    <?php if (empty($brander_options['features_background']['url'])): ?>
        <style>
            .themeFeatures{
            background: url(http://placehold.it/1680x1050/181818/ffffff.jpg) no-repeat center center !important;
            -webkit-background-size: cover !important;
            -moz-background-size: cover !important;
            -o-background-size: cover !important;
            background-size: cover !important;
            }
        </style>
    <?php else: ?>
        <style>
            .themeFeatures{
            background: url(<?php echo $brander_options['features_background']['url']; ?>) no-repeat center center !important;
            -webkit-background-size: cover !important;
            -moz-background-size: cover !important;
            -o-background-size: cover !important;
            background-size: cover !important;
            }
        </style>    
    <?php endif ?> 

<div class="aboutRow themeFeatures">
    <div class="row">
        <div class="blockTitle">
        <?php if (empty($brander_options['features_title'])): ?>
            Theme features
         <?php else: ?>
            <?php echo $brander_options['features_title']; ?>
         <?php endif ?>
         </div>
        <div class="fancyGoldenSeperator"></div>
        <div class="large-10 large-centered columns">
            <?php if (empty($brander_options['features_text'])): ?>
                <p>Science cuts two ways, of course; its products can be used for both good and evil. 
            But there's no turning back from science.</p>
             <?php else: ?>
                <p><?php echo $brander_options['features_text']; ?></p>
             <?php endif ?>
        </div>




        <div class="large-12 columns svgRelative">

            <div class="specs">


                <?php if (empty($brander_options['svg_specs'])): ?>

                <?php else: ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($brander_options['svg_specs'] as $key => $value): ?>
                        <div class="spec spec<?php echo $counter?>"><?php echo $value; ?></div>
                        <div class="liney line<?php echo $counter?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/pointy-<?php echo $counter?>.png" alt="">
                        </div>
                        <?php  $counter++; ?>
                    <?php endforeach ?>
                <?php endif ?>

            </div>

            <div class="svgHolder">
                
                <div id="main" class="main">
                    <figure>
                        <div class="drawings mac">

                        <?php if (empty($brander_options['svg_image']['url'])): ?>
                            <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/img/svg-overlay.png" alt="" />
                        <?php else: ?>
                            <img class="illustration" src="<?php echo $brander_options['svg_image']['url']; ?>" alt="" />   
                        <?php endif ?> 
                            <svg version="1.1" class="line-drawing" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="558px" height="330px"  xml:space="preserve">

                            <?php if (empty($brander_options['svg_pathss'])): ?>
                                <path fill="none" stroke="#ED1C24" stroke-miterlimit="10" d="M0.02,329.406V19.167C0.02,19.167-1.314,1,18.186,1H279.02"/>
                                <path d="M27.019,329.406L27.019 24.667 278.964 24.667 "/>
                                <path fill="none" stroke="#ED1C24" stroke-miterlimit="10" d="M557.984,329.406V19.167c0,0,1.334-18.167-18.166-18.167H278.984"/>
                                <path d="M530.984,329.406L530.984 24.667 279.04 24.667 "/>
                                <path d="M197.519,24.667L197.519 121.167 360.52 121.167 360.52 24.667 "/>
                                <path d="M197.519,329.406L197.519 127.167 360.52 127.167 360.52 329.406 "/>
                                <path d="M366.52,329.406L366.52 248.667 530.984 248.667 "/>
                                <path d="M530.984,242.667L366.52 242.667 366.52 24.667 "/>
                                <path d="M191.484,329.406L191.484 248.667 27.019 248.667 "/>
                                <path d="M27.019,242.667L191.484 242.667 191.484 24.667 "/>
                             <?php else: ?>
                                <?php echo $brander_options['svg_pathss']; ?>
                             <?php endif ?>

                            </svg> 
                        </div>
                    </figure>
                </div>


            </div>
        </div>
    </div>
</div>