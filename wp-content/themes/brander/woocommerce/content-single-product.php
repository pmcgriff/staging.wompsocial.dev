<?php

/**
* The template for displaying product content in the single-product.php template
*
* Override this template by copying it to yourtheme/woocommerce/content-single-product.php
*
* @author 		WooThemes
* @package 	WooCommerce/Templates
* @version     1.6.4
*/



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>



<?php

	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */

	 do_action( 'woocommerce_before_single_product' );



	 if ( post_password_required() ) {

	 	echo get_the_password_form();

	 	return;

	 }

?>



<?php global $post, $product; ?>



<div id="scroll-tm" class="doubleNews blogClassic">            

    <div class="row blogSingle">

        <div class="large-12 columns">

            <div class="newsTitle">

               <?php the_title(); ?>                

            </div>                                       

        </div>                    

        <div class="large-8 columns medium-8 mainHold">

            <div class="large-12 columns">



				<?php

					/**
					 * woocommerce_before_single_product_summary hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */

					do_action( 'woocommerce_before_single_product_summary' );

				?>



                <div class="newsContent singleShopContent">



                    <div class="newsFoot blogSingleHead singleShopHead">

                        <div class="date">

                            <?php echo $product->get_price_html(); ?>

                        </div>

                    </div>  



					<div class="singleShopCarty">

						<?php if ( $product->is_in_stock() ) : ?>



							<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>



							<form class="cart" method="post" enctype='multipart/form-data'>

							 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

						 	







							 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />



							 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>



								<div class="quantitySelect">

								 	<?php

								 		if ( ! $product->is_sold_individually() )

								 			woocommerce_quantity_input( array(

								 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),

								 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )

								 			) );

								 	?>									

								</div>	



								<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

							</form>



							<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>



						<?php endif; ?>

					</div>





                    <div class="newsFoot blogSingleHead singleAdditionalInfo">

                        <div class="date">

							<?php $cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );

							$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) ); ?>



							<?php do_action( 'woocommerce_product_meta_start' ); ?>



							<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>



								<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'woocommerce' ); ?></span>.</span>



							<?php endif; ?>



							<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>



							<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>



							<?php do_action( 'woocommerce_product_meta_end' ); ?>							

                        </div>

                    </div>  					



                    <h1><?php the_title(); ?></h1>

                    <div class="sinlgeContent">

                        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>

                    </div>

                </div> 





				<?php

					/**
					 * woocommerce_after_single_product_summary hook
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * @hooked woocommerce_output_related_products - 20
					 */

					do_action( 'woocommerce_after_single_product_summary' );

				?>



            </div>



                                                              

        </div> 



        <div class="large-4 medium-4 columns sideBar wooSidebarWidgets">



	        <?php dynamic_sidebar('woo-sidebar'); ?>

                                                                                            

        </div>  





                       

    </div>

</div>









<?php do_action( 'woocommerce_after_single_product' ); ?>

