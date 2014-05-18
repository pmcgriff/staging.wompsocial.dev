<?php

/**
* Template Name: Info
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package Brander
*/



get_header(); ?>



<style>

.infoRows .imageNdescription {

overflow: visible;}   

.infoRows .imageNdescription img {

width: auto;height: 100%; max-width: none} 

</style>



<?php if ( have_posts() ) : ?>

<?php ?>

<?php while ( have_posts() ) : the_post(); ?> 

    <div class="serviceRows infoRows">

        <div class="serviceLeft">

            <div class="description">

                <div class="descriptionInner">

                    <p>

                        <?php if (empty($brander_options['info_layout_subtitle'])): ?>

                            Science cuts two ways, of course; its products can be used for.

                         <?php else: ?>

                            <?php echo $brander_options['info_layout_subtitle']; ?>

                         <?php endif ?>

                    </p>

                    <h1><?php the_title(); ?></h1>

                </div>

            </div>

        </div>

<?php endwhile; ?>

<?php else : ?>

<?php endif; ?>





        <div class="serviceRight">

            <div class="imageNdescription">

                <?php if(has_post_thumbnail()) { the_post_thumbnail('h1006'); }?>

                <div class="description">

                    <div class="title">

                        <?php if (empty($brander_options['info_block1_title'])): ?>

                            Jane Doe

                         <?php else: ?>

                            <?php echo $brander_options['info_block1_title']; ?>

                         <?php endif ?>

                    </div>

                    <div class="content">

                        <?php if (empty($brander_options['info_block1_text'])): ?>

                            <p>A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That's how I felt seeing the Earth for the first time. I could not help but love and cherish her.</p>

                         <?php else: ?>

                            <?php echo $brander_options['info_block1_text']; ?>

                         <?php endif ?>                    

                    </div>

                </div>

                

                <div class="topImage">

                    <?php if (empty($brander_options['info_layout_top_image']['url'])): ?>

                       <img src="http://placehold.it/371x375/8d6d2e/ffffff.jpg" alt="">

                    <?php else: ?>

                        <img src="<?php echo $brander_options['info_layout_top_image']['url']; ?>" alt=""> 

                    <?php endif ?>                     

                    <div class="theTail"></div>

                </div>                    

            </div>

        </div>



        <div class="infoTexts">

            <div class="row infoExtendedRow">

                <div class="large-6 medium-6 columns">

                    <div class="text">

                        <h2>

                        <?php if (empty($brander_options['info_block2_title'])): ?>

                            Jane Doe

                         <?php else: ?>

                            <?php echo $brander_options['info_block2_title']; ?>

                         <?php endif ?>                            

                        </h2>



                        <?php if (empty($brander_options['info_block2_text'])): ?>

                            <p>If you could see the earth illuminated when you were in a place as dark as night, it would look to you more splendid than the moon.</p>



                            <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals. The airman's earth, if free men make it, will be truly round: a globe in practice, not in theory.</p>



                            <p>What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth.</p>



                            <p>Dinosaurs are extinct today because they lacked opposable thumbs and the brainpower to build a space program.</p>



                            <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals.</p>

                         <?php else: ?>

                            <?php echo $brander_options['info_block2_text']; ?>

                         <?php endif ?>                           

                    </div>

                </div>



                <div class="large-6 medium-6 columns">

                    <div class="large-6 medium-6 large-offset-6 columns">

                        <?php if (empty($brander_options['info_layout_image_1']['url'])): ?>

                           <img src="http://placehold.it/371x375/8d6d2e/ffffff.jpg" alt="">

                        <?php else: ?>

                            <img src="<?php echo $brander_options['info_layout_image_1']['url']; ?>" alt=""> 

                        <?php endif ?> 

                    </div>

                    <div class="large-6 medium-6 columns">

                        <?php if (empty($brander_options['info_layout_image_2']['url'])): ?>

                           <img src="http://placehold.it/371x375/8d6d2e/ffffff.jpg" alt="">

                        <?php else: ?>

                            <img src="<?php echo $brander_options['info_layout_image_2']['url']; ?>" alt=""> 

                        <?php endif ?>

                    </div>                        

                </div>

            </div>

        </div>

    </div>









<!-- Latest Post Block -->

<?php get_template_part( 'page_blocks/testimonials' ); ?>



<!-- Contact Block -->

<?php get_template_part( 'page_blocks/contact' ); ?>







<?php get_footer(); ?>

