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

              position: fixed;

              z-index: 0; 

            }            

        </style>    

    <?php endif ?> 





<div id="womp-contact" class="contactRow">

    <div class="formWrapper" id="VIPinvite">
        <div class="row">
            
            <div class="large-12 columns contactInfoSection">
    
                <div class="blockTitle">
    
                <?php if (empty($brander_options['contact_title'])): ?>
    
                    Contact Us
    
                 <?php else: ?>
    
                    <?php echo $brander_options['contact_title']; ?>
    
                 <?php endif ?>
    
                </div>
    
                <div class="fancySeperator"></div>
    
                <div class="blockText">
    
                <?php if (empty($brander_options['contact_text'])): ?>
    
                    <p>Reserve a spot as one of our first Tribesmen and we will send you updates on our progress and an invite to be one of a limited number of beta users when we are ready to launch!</p>
                 <?php else: ?>
    
                    <p><?php echo $brander_options['contact_text']; ?></p>
    
                 <?php endif ?>
    
                </div>
    
            </div> 


            <div class="large-12 columns formHolder contactForm">
                <h2 style="text-align: center;">
                    <?php if (empty($brander_options['contact_1_title'])): ?>
        
                        Contact Info
        
                     <?php else: ?>
        
                        <?php echo $brander_options['contact_1_title']; ?>
        
                     <?php endif ?>                 
                </h2>
            </div>
            <div class="large-12 columns formHolder">
                <?php
	               if( function_exists( 'mc4wp_form' ) ) {
	                   mc4wp_form(2101);
                    }
                ?>
            </div>

        </div>


    </div>

</div>