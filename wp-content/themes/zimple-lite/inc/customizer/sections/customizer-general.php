<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package ZimpleLite
 */
/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function zimple_lite_customize_register_general_options( $wp_customize ) {
// Add Section for Theme Options
	$wp_customize->add_section( 'zimple_lite_section_general', array(
        'title'    => esc_html__( 'General Settings', 'zimple-lite' ),
        'priority' => 10,
		'panel' => 'zimple_lite_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'zimple_lite_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zimple_lite_sanitize_select'
		)
	);
    $wp_customize->add_control( 'zimple_lite_theme_options[layout]', array(
        'label'    => esc_html__( 'Theme Layout', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_general',
        'settings' => 'zimple_lite_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left-sidebar' => esc_html__( 'Left Sidebar', 'zimple-lite' ),
            'right-sidebar' => esc_html__( 'Right Sidebar', 'zimple-lite' )
			)
		)
	);

    // Add Sticky Header Setting
    $wp_customize->add_setting( 'zimple_lite_theme_options[sticky_header_title]', array(
        'default'           => '',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new zimple_lite_Customize_Header_Control(
        $wp_customize, 'zimple_lite_theme_options[sticky_header_title]', array(
            'label' => esc_html__( 'Sticky Header', 'zimple-lite' ),
            'section' => 'zimple_lite_section_general',
            'settings' => 'zimple_lite_theme_options[sticky_header_title]',
            'priority' => 2
            )
        )
    );

    $wp_customize->add_setting( 'zimple_lite_theme_options[sticky_header]', array(
        'default'           => false,
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zimple_lite_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 'zimple_lite_theme_options[sticky_header]', array(
        'label'    => esc_html__( 'Enable sticky header feature', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_general',
        'settings' => 'zimple_lite_theme_options[sticky_header]',
        'type'     => 'checkbox',
        'priority' => 3
        )
    );

	// Back to Top Setting
	$wp_customize->add_setting( 'zimple_lite_theme_options[back_to_top_function]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new zimple_lite_Customize_Header_Control(
        $wp_customize, 'zimple_lite_theme_options[back_to_top_function]', array(
            'label' => esc_html__( 'Back to Top', 'zimple-lite' ),
            'section' => 'zimple_lite_section_general',
            'settings' => 'zimple_lite_theme_options[back_to_top_function]',
            'priority' => 4
            )
        )
    );

    $wp_customize->add_setting( 'zimple_lite_theme_options[back_to_top]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zimple_lite_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zimple_lite_theme_options[back_to_top]', array(
        'label'    => esc_html__( 'Enable Back to Top Button', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_general',
        'settings' => 'zimple_lite_theme_options[back_to_top]',
        'type'     => 'checkbox',
		'priority' => 5
		)
	);
	
}


add_action( 'customize_register', 'zimple_lite_customize_register_general_options' );