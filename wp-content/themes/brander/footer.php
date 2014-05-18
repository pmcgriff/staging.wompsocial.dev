<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package Brander

 */

?>



<?php global $brander_options; ?>



<?php if (!is_page_template('page-templates/gallery.php') ) { ?>

            <div class="footer">

                <div class="scrolly">

                    <a href="#top">

                        <?php if (empty($brander_options['to_top']['url'])): ?>

                          <img src="<?php echo get_template_directory_uri(); ?>/img/scrolly.png" height="51" width="51" alt="">
                        <?php else: ?>

                            <img src="<?php echo $brander_options['to_top']['url']; ?>" alt=""> 

                        <?php endif ?>  
                        </a>

                </div>

                <div class="row">

                    <div class="large-12 columns">

                        <?php /* <div class="seperator"></div> */ ?> 

                        <div class="socials">

                            <?php if (empty($brander_options['facebook'])): ?>

                             <?php else: ?>

                                <a href="<?php echo $brander_options['facebook']; ?>" class="facebook"></a>

                             <?php endif ?>



                            <?php if (empty($brander_options['twitter'])): ?>

                             <?php else: ?>

                                <a href="<?php echo $brander_options['twitter']; ?>" class="twitter"></a>

                             <?php endif ?>



                            <?php if (empty($brander_options['dribbble'])): ?>

                             <?php else: ?>

                                <a href="<?php echo $brander_options['dribbble']; ?>" class="dribbble"></a>

                             <?php endif ?>



                            <?php if (empty($brander_options['vimeeo'])): ?>

                             <?php else: ?>

                                <a href="<?php echo $brander_options['vimeeo']; ?>" class="vimeo"></a>

                             <?php endif ?>





                            <?php if (empty($brander_options['linkedin'])): ?>

                             <?php else: ?>

                                <a href="<?php echo $brander_options['linkedin']; ?>" class="linkedin"></a>

                             <?php endif ?>



                        </div>



                    </div>

                </div>
                

                <?php if (empty($brander_options['footer_text'])): ?>
                
                    <footer class="footermark" role="contentinfo">© Copyright - WOMP Social</footer><!-- .footermark -->

                 <?php else: ?>

                    <footer class="footermark" role="contentinfo"><?php echo $brander_options['footer_text']; ?></footer><!-- .footermark -->

                 <?php endif ?>  

            </div>

<?php } ?>



        </div>

    </div>

    <!--/#inner-wrap-->

</div>

<!--/#outer-wrap-->





<?php if (!is_page_template('page-templates/portfolio.php') ) { ?>

    <?php wp_footer(); ?>

<?php } ?>



</body>

</html>