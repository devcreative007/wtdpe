<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package ZimpleLite
 */


/**
 * Adds pro version description
 *
 * @param object $wp_customize / Customizer Object
 */
function zimple_lite_customize_register_upgrade_options( $wp_customize ) {

	// Add Upgrade / More Features Section
	$wp_customize->add_section( 'zimple_lite_section_upgrade', array(
        'title'    => esc_html__( 'More Features', 'zimple-lite' ),
        'priority' => 70,
		'panel' => 'zimple_lite_options_panel' 
		)
	);
	
	// Add custom Upgrade Content control
	$wp_customize->add_setting( 'zimple_lite_theme_options[upgrade]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new zimple_lite_Customize_Upgrade_Control(
        $wp_customize, 'zimple_lite_theme_options[upgrade]', array(
            'section' => 'zimple_lite_section_upgrade',
            'settings' => 'zimple_lite_theme_options[upgrade]',
            'priority' => 1
            )
        )
    );

}
add_action( 'customize_register', 'zimple_lite_customize_register_upgrade_options' );