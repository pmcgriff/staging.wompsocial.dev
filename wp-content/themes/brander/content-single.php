<?php

/**

 * @package Brander

 */

?>



<div id="scroll-tm" class="doubleNews blogClassic">            

    <div class="row blogSingle">

        <div class="large-12 columns">

            <div class="newsTitle">

               <?php the_title(); ?>                

            </div>                                       

        </div>                    

        <div class="large-8 columns medium-8 mainHold">

            <div <?php post_class('large-12 columns'); ?>>

                <div class="newsItem">

                    <?php if(has_post_thumbnail()) { the_post_thumbnail('w650'); }?>

                    <div class="slideOut">

                        <div class="thickSmallLine"></div>

                        <a class="zoomy" href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>" data-rel="prettyPhoto"></a>

                        <h3>open</h3>

                    </div>

                </div>

                <div class="newsContent">                            

                    <h1><?php the_title(); ?></h1>

                    <div class="sinlgeContent">

                        <?php the_content(); ?>

                    </div>

                </div> 



                <div class="theComments">

				<?php

					// If comments are open or we have at least one comment, load up the comment template

					if ( comments_open() || '0' != get_comments_number() ) :

						comments_template();

					endif;

				?>



                             

                </div>                 

            </div>



                                                              

        </div> 
                 

    </div>

</div>



