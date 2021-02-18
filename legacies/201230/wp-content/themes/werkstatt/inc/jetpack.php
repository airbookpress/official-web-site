<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */

function werkstatt_jetpack_setup() {

	/**
		* Add theme support for Responsive Videos.
	*/
    add_theme_support( 'jetpack-responsive-videos' );

	/**
		* Add theme support for Infinite Scroll.
 	*/
	add_theme_support( 'infinite-scroll', array (
		'container'			=> 'primary',
		'type'           	=> 'scroll',
		'posts_per_page' 	=> 15,
		'wrapper'        	=> false,
	) );
}
add_action( 'after_setup_theme', 'werkstatt_jetpack_setup' );
