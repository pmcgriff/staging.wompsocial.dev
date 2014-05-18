<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="content">

 *

 * @package Brander

 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#0c90e6">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php global $brander_options; ?>



<?php wp_head(); ?>
<?php if (( $brander_options['dark_or_lights'])=='0') {
    echo '<link rel="stylesheet" href="';
    echo get_template_directory_uri();
    echo '/css/style_light.css">';
} else {

} ?>

</head>



<body <?php body_class(); ?>>

<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>

<?php if ( ! is_page_template('page-templates/womp-teaser.php') ) {



    if (( $brander_options['sticky_heads'])=='1') {
        echo '
        <style>
        #nav {position: fixed; top: 0; left: 0; right: 0}
        </style>
        ';
    } else {
        echo '
        <style>
        #nav {position: relative;}
        </style>
        ';
    }

}?>


<?php if ( is_page_template('page-templates/home-01.php') || is_page_template('page-templates/home-02.php') || is_page_template('page-templates/home-03.php') || is_page_template('page-templates/home-04.php') || is_page_template('page-templates/home-05.php') || is_page_template('page-templates/womp-teaser.php') ) { ?>
    
    
    
    <div id="spinner">
    
        <div class="brander_preload">
    
            <?php if (empty($brander_options['brander_preload']['url'])): ?>
    
               <img src="<?php echo get_template_directory_uri(); ?>/img/preload.gif" height="75" width="75" alt="">
    
            <?php else: ?>
    
                <img src="<?php echo $brander_options['brander_preload']['url']; ?>" alt=""> 
    
            <?php endif ?>  
    
        </div>
    
    </div> 
    
    
    
    <?php } else { ?>

    
    <div id="spinner" class="transparent">
    
    </div> 
    
    
    
    <?php } ?>

<?php if (empty($brander_options['custom_css'])): ?>
<?php else: ?>
<?php echo '<style>';
echo $brander_options['custom_css'];
echo '</style>';
 ?>
<?php endif ?>  

<div id="outer-wrap">

    <div id="inner-wrap">

<?php if ( ! is_page_template('page-templates/womp-teaser.php') ) { ?>

        <header id="top" role="banner">

            <div class="block">

                <a class="nav-btn" id="nav-open-btn" href="#nav"></a>

            </div>

        </header>

        <nav id="nav" role="navigation">

            <div class="menu" id="menu">



                <div class="row">

                    <div class="large-2 medium-2 columns">

                        <a href="<?php bloginfo('url') ?>">                            

                            <?php if (empty($brander_options['brander_logo']['url'])): ?>

                               <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" height="46" width="46" alt="">

                            <?php else: ?>

                                <img src="<?php echo $brander_options['brander_logo']['url']; ?>" alt=""> 

                            <?php endif ?>                               

                        </a>

                    </div>



                    <div class="large-10 medium-10 columns">



                        <?php if (class_exists('Woocommerce')) { ?>

                            <div class="shopingIcon">

                                <a href="<?php echo get_permalink( get_page_by_path( 'cart' ) ) ?>">

                                    <img src="<?php echo get_template_directory_uri(); ?>/img/cart_icon.png" alt="">

                                </a>

                            </div>

                        <?php } ?>



                          <?php $defaults = array(

                                'theme_location'  => 'primary',

                                'menu'            => '',

                                'container'       => '',

                                'container_class' => 'div',

                                'container_id'    => '',

                                'menu_class'      => 'menu',

                                'menu_id'         => '',

                                'echo'            => true,

                                'fallback_cb'     => 'wp_page_menu',

                                'before'          => '',

                                'after'           => '',

                                'link_before'     => '',

                                'link_after'      => '',

                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',

                                'depth'           => 0,

                                'walker'          => ''

                            );



                            wp_nav_menu( $defaults );

                        ?>









                    </div>

                </div>

                <a class="close-btn" id="nav-close-btn" href="#top">Return to Content</a>

            </div>

        </nav>

<?php } else { ?>
        
        <header id="top" role="banner">

        </header>
        
<?php } ?>

