<?php
/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0.1
 */


function werkstatt_customize_register( $wp_customize ) {

	//TODO: Add customizer.js to display changes delivered via postMessage
	//$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	//$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'werkstatt' );
	$wp_customize->get_section('header_image')->title = esc_html__( 'Logo', 'werkstatt' );

	// Werkstatt Theme Options Sections
	$wp_customize->add_section( 'werkstatt_themeoptions', array(
		'title'        		=> esc_html__( 'Theme Options', 'werkstatt' ),
		'priority'      	=> 1,
	) );

	// Add the custom colors.
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );

	// Custom Colors.
	$wp_customize->add_setting( 'link_color' , array(
    	'default'     		=> '#555555',
    	'sanitize_callback' => 'sanitize_hex_color',
		'transport'   		=> 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'				=> esc_html__( 'Link Color', 'werkstatt' ),
		'section'			=> 'colors',
		'settings'			=> 'link_color',
	) ) );


	// Werkstatt Theme Options

	$wp_customize->add_setting( 'werkstatt_intro', array(
		'default'       	=> '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'werkstatt_intro', array(
		'label'         	=> esc_html__( 'Intro Text', 'werkstatt' ),
		'description'		=> esc_html__( 'Intro text on the blog front papge. (HTML is allowed)', 'werkstatt' ),
		'section'       	=> 'werkstatt_themeoptions',
		'type'          	=> 'textarea',
		'priority'			=> 1,
	) );

	$wp_customize->add_setting( 'werkstatt_credit', array(
		'default'       	=> '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'werkstatt_credit', array(
		'label'         	=> esc_html__( 'Footer credit text', 'werkstatt' ),
		'description'		=> esc_html__( 'Customize the footer credit text. (HTML is allowed)', 'werkstatt' ),
		'section'       	=> 'werkstatt_themeoptions',
		'type'          	=> 'text',
		'priority'			=> 2,
	) );

	$wp_customize->add_setting( 'werkstatt_credit_footer', array(
		'default'							     => '',
		'sanitize_callback' 	     => 'werkstatt_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'werkstatt_credit_footer', array(
		'label'								     => esc_html__( 'Show credit text in footer', 'werkstatt' ),
		'section'							     => 'werkstatt_themeoptions',
		'type'								     => 'checkbox',
		'priority'						     => 3,
	) );

}
add_action( 'customize_register', 'werkstatt_customize_register' );

/**
 * Sanitize Checkboxes.
 */
function werkstatt_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}
