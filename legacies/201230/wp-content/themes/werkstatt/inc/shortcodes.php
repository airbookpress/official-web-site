<?php
/**
 * Available Werkstatt Shortcodes
 *
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Werkstatt Shortcodes
/*-----------------------------------------------------------------------------------*/
// Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

// Replace WP autop formatting
if (!function_exists( "werkstatt_remove_wpautop")) {
	function werkstatt_remove_wpautop($content) {
		$content = do_shortcode( shortcode_unautop( $content ) );
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Multi Columns Shortcodes
/* Don't forget to add "_last" behind the shortcode if it is the last column.
/*-----------------------------------------------------------------------------------*/

// Two Columns
function werkstatt_shortcode_two_columns_one( $atts, $content = null ) {
   return '<div class="two-columns-one">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one', 'werkstatt_shortcode_two_columns_one' );

function werkstatt_shortcode_two_columns_one_last( $atts, $content = null ) {
   return '<div class="two-columns-one last">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one_last', 'werkstatt_shortcode_two_columns_one_last' );

// Three Columns
function werkstatt_shortcode_three_columns_one($atts, $content = null) {
   return '<div class="three-columns-one">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one', 'werkstatt_shortcode_three_columns_one' );

function werkstatt_shortcode_three_columns_one_last($atts, $content = null) {
   return '<div class="three-columns-one last">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one_last', 'werkstatt_shortcode_three_columns_one_last' );

function werkstatt_shortcode_three_columns_two($atts, $content = null) {
   return '<div class="three-columns-two">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two', 'werkstatt_shortcode_three_columns_two' );

function werkstatt_shortcode_three_columns_two_last($atts, $content = null) {
   return '<div class="three-columns-two last">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two_last', 'werkstatt_shortcode_three_columns_two_last' );

// Four Columns
function werkstatt_shortcode_four_columns_one($atts, $content = null) {
   return '<div class="four-columns-one">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one', 'werkstatt_shortcode_four_columns_one' );

function werkstatt_shortcode_four_columns_one_last($atts, $content = null) {
   return '<div class="four-columns-one last">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one_last', 'werkstatt_shortcode_four_columns_one_last' );

function werkstatt_shortcode_four_columns_two($atts, $content = null) {
   return '<div class="four-columns-two">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two', 'werkstatt_shortcode_four_columns_two' );

function werkstatt_shortcode_four_columns_two_last($atts, $content = null) {
   return '<div class="four-columns-two last">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two_last', 'werkstatt_shortcode_four_columns_two_last' );

function werkstatt_shortcode_four_columns_three($atts, $content = null) {
   return '<div class="four-columns-three">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three', 'werkstatt_shortcode_four_columns_three' );

function werkstatt_shortcode_four_columns_three_last($atts, $content = null) {
   return '<div class="four-columns-three last">' . werkstatt_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three_last', 'werkstatt_shortcode_four_columns_three_last' );


// Divide Text Shortcode
function werkstatt_shortcode_divider($atts, $content = null) {
   return '<div class="divider"></div>';
}
add_shortcode( 'divider', 'werkstatt_shortcode_divider' );


/*-----------------------------------------------------------------------------------*/
/* Info Boxes Shortcodes
/*-----------------------------------------------------------------------------------*/

function werkstatt_shortcode_white_box($atts, $content = null) {
   return '<div class="box white-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'white_box', 'werkstatt_shortcode_white_box' );

function werkstatt_shortcode_yellow_box($atts, $content = null) {
   return '<div class="box yellow-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'yellow_box', 'werkstatt_shortcode_yellow_box' );

function werkstatt_shortcode_red_box($atts, $content = null) {
   return '<div class="box red-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'red_box', 'werkstatt_shortcode_red_box' );

function werkstatt_shortcode_blue_box($atts, $content = null) {
   return '<div class="box blue-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'blue_box', 'werkstatt_shortcode_blue_box' );

function werkstatt_shortcode_green_box($atts, $content = null) {
   return '<div class="box green-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'green_box', 'werkstatt_shortcode_green_box' );

function werkstatt_shortcode_lightgrey_box($atts, $content = null) {
   return '<div class="box lightgrey-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'lightgrey_box', 'werkstatt_shortcode_lightgrey_box' );

function werkstatt_shortcode_grey_box($atts, $content = null) {
   return '<div class="box grey-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'grey_box', 'werkstatt_shortcode_grey_box' );

function werkstatt_shortcode_dark_box($atts, $content = null) {
   return '<div class="box dark-box">' . do_shortcode( werkstatt_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'dark_box', 'werkstatt_shortcode_dark_box' );


/*-----------------------------------------------------------------------------------*/
/* Buttons Shortcodes
/*-----------------------------------------------------------------------------------*/
function werkstatt_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    'target' => '',
    'color'	=> '',
    'size'	=> '',
	 'form'	=> '',
	 'font'	=> '',
    ), $atts));

	$color = ($color) ? ' '.$color. '-btn' : '';
	$size = ($size) ? ' '.$size. '-btn' : '';
	$form = ($form) ? ' '.$form. '-btn' : '';
	$font = ($font) ? ' '.$font. '-btn' : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$out = '<a' .$target. ' class="standard-btn' .$color.$size.$form.$font. '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;
}
add_shortcode('button', 'werkstatt_button');

