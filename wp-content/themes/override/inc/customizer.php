<?php
/**
 * Override: Customizer
 *
 * @package Override
 * @subpackage Override
 * @since 1.2.2.0
 */

/**
 * Add refresh support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function override_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'refresh';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.header-text-wrapper #site-title a',
		'render_callback' => 'override_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'override_customize_partial_blogdescription',
	) );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Override 1.2.2.0
 * @see override_customize_register()
 *
 * @return void
 */
function override_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Override 1.2.2.0
 * @see override_customize_register()
 *
 * @return void
 */
function override_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

add_action( 'customize_register', 'override_customize_register' );