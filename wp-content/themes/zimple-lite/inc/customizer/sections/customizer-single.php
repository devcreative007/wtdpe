<?php
/**
 * Single Settings
 *
 * Register Single Settings section, settings and controls for Theme Customizer
 *
 * @package ZimpleLite
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function zimple_lite_customize_register_single_options( $wp_customize ) {
		// Add Section for Theme Options
		$wp_customize->add_section( 'zimple_lite_section_single', array(
	        'title'    => esc_html__( 'Single Post Settings', 'zimple-lite' ),
	        'priority' => 30,
			'panel' => 'zimple_lite_options_panel' 
			)
		);

		// Add Settings and Controls for Post length on home & archives
		$wp_customize->add_setting( 'zimple_lite_theme_options[related_posts]', array(
	        'default'           => 'cat',
	        'type'           	=> 'option',
	        'transport'         => 'refresh',
	        'sanitize_callback' => 'zimple_lite_sanitize_select'
			)
		);
	    $wp_customize->add_control( 'zimple_lite_theme_options[related_posts]', array(
	        'label'    => esc_html__( 'Related posts', 'zimple-lite' ),
	        'section'  => 'zimple_lite_section_single',
	        'settings' => 'zimple_lite_theme_options[related_posts]',
	        'type'     => 'radio',
			'priority' => 1,
	        'choices'  => array(
	            'cat' => esc_html__( 'Categories', 'zimple-lite' ),
	            'tag' => esc_html__( 'Tags', 'zimple-lite' )
				)
			)
		);
	}
add_action( 'customize_register', 'zimple_lite_customize_register_single_options' );