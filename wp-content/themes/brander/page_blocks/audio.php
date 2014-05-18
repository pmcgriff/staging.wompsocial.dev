<?php global $brander_options; ?>


    <div class="audioDiv">
        <div class="row">
            <div class="large-6 large-centered medium-6 medium-centered small-12 columns audioWrap">
                <audio preload="auto" controls>
                    <source src="<?php echo $brander_options['audio-mp3']; ?>">
                    <source src="<?php echo $brander_options['audio-ogg']; ?>">
                    <source src="<?php echo $brander_options['audio-wav']; ?>">
                </audio> 
                <div class="fancyGoldenSeperator"></div>
            </div>
        </div>   
    </div>

    <script>
      jQuery(window).load(function() {
        jQuery(".image_side").css({'height':(jQuery(".post_item").height() + 90 +'px')});

        jQuery( function() { jQuery( 'audio' ).audioPlayer(); } );
      });                       
    </script>    