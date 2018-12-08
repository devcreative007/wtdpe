<?php
/**
 * Archive Settings
 *
 * Register Home & Archive Settings section, settings and controls for Theme Customizer
 *
 * @package ZimpleLite
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function zimple_lite_customize_register_archive_options( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'zimple_lite_section_home_archive', array(
        'title'    => esc_html__( 'Home & Archive Settings', 'zimple-lite' ),
        'priority' => 20,
		'panel' => 'zimple_lite_options_panel' 
		)
	);

    // Add Post Meta Settings
    $wp_customize->add_setting( 'zimple_lite_theme_options[home_slide]', array(
        'default'           => '',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new zimple_lite_Customize_Header_Control(
        $wp_customize, 'zimple_lite_theme_options[home_slide]', array(
            'label' => esc_html__( 'Home Slide', 'zimple-lite' ),
            'section' => 'zimple_lite_section_home_archive',
            'settings' => 'zimple_lite_theme_options[home_slide]',
            'priority' => 1
            )
        )
    );

    $wp_customize->add_setting( 'zimple_lite_theme_options[enable_slide]', array(
        'default'           => false,
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zimple_lite_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 'zimple_lite_theme_options[enable_slide]', array(
        'label'    => esc_html__( 'Enable feature slide', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_home_archive',
        'settings' => 'zimple_lite_theme_options[enable_slide]',
        'type'     => 'checkbox',
        'priority' => 2
        )
    );

	// Add Settings and Controls for Post length on home & archives
	$wp_customize->add_setting( 'zimple_lite_theme_options[post_content]', array(
        'default'           => 'excerpt',
        'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zimple_lite_sanitize_select'
		)
	);
    $wp_customize->add_control( 'zimple_lite_theme_options[post_content]', array(
        'label'    => esc_html__( 'Post length on home & archives', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_home_archive',
        'settings' => 'zimple_lite_theme_options[post_content]',
        'type'     => 'radio',
		'priority' => 3,
        'choices'  => array(
            'index' => esc_html__( 'Show full posts', 'zimple-lite' ),
            'excerpt' => esc_html__( 'Show post excerpts', 'zimple-lite' )
			)
		)
	);
	
	// Add Setting and Control for Excerpt Length
	$wp_customize->add_setting( 'zimple_lite_theme_options[excerpt_length]', array(
        'default'           => 20,
		'type'           	=> 'option',
		'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);
    $wp_customize->add_control( 'zimple_lite_theme_options[excerpt_length]', array(
        'label'    => esc_html__( 'Excerpt Length', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_home_archive',
        'settings' => 'zimple_lite_theme_options[excerpt_length]',
        'type'     => 'text',
		'active_callback' => 'zimple_lite_control_post_content_callback',
		'priority' => 3
		)
	);

	// Add Setting and Control for Excerpt More Text
	$wp_customize->add_setting( 'zimple_lite_theme_options[excerpt_more]', array(
        'default'           => ' [...]',
		'type'           	=> 'option',
		'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
		)
	);

    $wp_customize->add_control( 'zimple_lite_theme_options[excerpt_more]', array(
        'label'    => esc_html__( 'Excerpt More Text', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_home_archive',
        'settings' => 'zimple_lite_theme_options[excerpt_more]',
        'type'     => 'text',
        'active_callback' => 'zimple_lite_control_post_content_callback',
		'priority' => 3
		)
	);

    // Add Settings and Controls for Pagination
    $wp_customize->add_setting( 'zimple_lite_theme_options[paging]', array(
        'default'           => 'paging-default',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zimple_lite_sanitize_select'
        )
    );
    $wp_customize->add_control( 'zimple_lite_theme_options[paging]', array(
        'label'    => esc_html__( 'Pagination Type', 'zimple-lite' ),
        'section'  => 'zimple_lite_section_home_archive',
        'settings' => 'zimple_lite_theme_options[paging]',
        'type'     => 'radio',
        'priority' => 4,
        'choices'  => array(
            'paging-default' => esc_html__( ' Default (Older Posts/Newer Posts)', 'zimple-lite' ),
            'paging-numberal' => esc_html__( 'Numberal (1 2 3 ..)', 'zimple-lite' )
            )
        )
    );

}
add_action( 'customize_register', 'zimple_lite_customize_register_archive_options' );