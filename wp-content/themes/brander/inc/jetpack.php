<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Brander
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function brander_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'brander_jetpack_setup' );
