<?php global $brander_options; ?>





    <?php if (empty($brander_options['contact_background']['url'])): ?>

        <style>

            .contactRow {

                position: relative;

            }

            .contactRow:after {

              content: "";

                background: url(http://placehold.it/1680x1050/181818/ffffff.jpg) no-repeat center center;

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

        </style>

    <?php else: ?>

        <style>

            .contactRow {

                position: relative;

            }

            .contactRow:after {

              content: "";

                background-color: #000;

                background: url(<?php echo $brander_options['contact_background']['url']; ?>) no-repeat center center;

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

        </style>    

    <?php endif ?> 





<div class="contactRow">

    <div class="row">

        <div class="large-12 columns">

            <div class="blockTitle">

            <?php if (empty($brander_options['contact_title'])): ?>

                Contact Me

             <?php else: ?>

                <?php echo $brander_options['contact_title']; ?>

             <?php endif ?>

            </div>

            <div class="fancySeperator"></div>

            <div class="blockText">

            <?php if (empty($brander_options['contact_text'])): ?>

                <p>To be the first to enter the cosmos, to engage, single-handed, in an unprecedented duel with nature—could one dream of anything more?</p>

                <p><span><a href="mailto:someone@example.com">info@avathemes.com</a></span><span>+1 235 456 6548</span></p>

             <?php else: ?>

                <p><?php echo $brander_options['contact_text']; ?></p>

             <?php endif ?>

            </div>

        </div>  



        <div class="large-4 medium-4 small-6 columns contactIcons">

            <div class="iconHold">

                <?php if (empty($brander_options['contact_1_image']['url'])): ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-1.png" alt="" >

                <?php else: ?>

                    <img src="<?php echo $brander_options['contact_1_image']['url']; ?>" alt="" >   

                <?php endif ?> 





                <?php if (empty($brander_options['contact_1_hover_image']['url'])): ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-1-hover.png" alt="" class="hoverEffect">

                <?php else: ?>

                    <img src="<?php echo $brander_options['contact_1_hover_image']['url']; ?>" alt="" class="hoverEffect">   

                <?php endif ?> 

            </div>

            <div class="titleHold">

            <?php if (empty($brander_options['contact_1_title'])): ?>

                Visit us

             <?php else: ?>

                <?php echo $brander_options['contact_1_title']; ?>

             <?php endif ?>                 

            </div>

            <div class="textHold">

            <?php if (empty($brander_options['contact_1_text'])): ?>

                 When I orbited the Earth in a spaceship, I saw for the first time 

             <?php else: ?>

                <?php echo $brander_options['contact_1_text']; ?>

             <?php endif ?>               

            </div>

        </div>   



        <div class="large-4 medium-4 small-6 columns contactIcons">

            <div class="iconHold">

                <?php if (empty($brander_options['contact_2_image']['url'])): ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-2.png" alt="" >

                <?php else: ?>

                    <img src="<?php echo $brander_options['contact_2_image']['url']; ?>" alt="" >   

                <?php endif ?> 





                <?php if (empty($brander_options['contact_2_hover_image']['url'])): ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-2-hover.png" alt="" class="hoverEffect">

                <?php else: ?>

                    <img src="<?php echo $brander_options['contact_2_hover_image']['url']; ?>" alt="" class="hoverEffect">   

                <?php endif ?> 

            </div>

            <div class="titleHold">

            <?php if (empty($brander_options['contact_2_title'])): ?>

                Send us a mail

             <?php else: ?>

                <?php echo $brander_options['contact_2_title']; ?>

             <?php endif ?>                 

            </div>

            <div class="textHold">

            <?php if (empty($brander_options['contact_2_text'])): ?>

                 When I orbited the Earth in a spaceship, I saw for the first time 

             <?php else: ?>

                <?php echo $brander_options['contact_2_text']; ?>

             <?php endif ?>               

            </div>

        </div>   





        <div class="large-4 medium-4 small-6 columns contactIcons">

            <div class="iconHold">

                <?php if (empty($brander_options['contact_3_image']['url'])): ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-3.png" alt="" >

                <?php else: ?>

                    <img src="<?php echo $brander_options['contact_3_image']['url']; ?>" alt="" >   

                <?php endif ?> 





                <?php if (empty($brander_options['contact_3_hover_image']['url'])): ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-3-hover.png" alt="" class="hoverEffect">

                <?php else: ?>

                    <img src="<?php echo $brander_options['contact_3_hover_image']['url']; ?>" alt="" class="hoverEffect">   

                <?php endif ?> 

            </div>

            <div class="titleHold">

            <?php if (empty($brander_options['contact_3_title'])): ?>

                Send us a mail

             <?php else: ?>

                <?php echo $brander_options['contact_3_title']; ?>

             <?php endif ?>                 

            </div>

            <div class="textHold">

            <?php if (empty($brander_options['contact_3_text'])): ?>

                 When I orbited the Earth in a spaceship, I saw for the first time 

             <?php else: ?>

                <?php echo $brander_options['contact_3_text']; ?>

             <?php endif ?>               

            </div>

        </div>                                                              

    </div>

</div>