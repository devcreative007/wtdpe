<?php
/**
 * customizer Theme Customizer.
 *
 * @package ZimpleLite
 */

// Load Customizer Helper Functions
require( get_template_directory() . '/inc/customizer/functions/custom-controls.php' );
require( get_template_directory() . '/inc/customizer/functions/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/functions/callback-functions.php' );

// Load Customizer Section Files
require( get_template_directory() . '/inc/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-home-archives.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-single.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-upgrade.php' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zimple_lite_customize_register( $wp_customize ) {

	// Add Theme Options Panel
	$wp_customize->add_panel( 'zimple_lite_options_panel', array(
		'priority'       => 200,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'zimple-lite' ),
		'description'    => '',
	) );
	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
}
add_action( 'customize_register', 'zimple_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zimple_lite_customize_preview_js() {
	wp_enqueue_script( 'zimple_lite_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'customize-preview' ), '20160530', true );
}
add_action( 'customize_preview_init', 'zimple_lite_customize_preview_js' );

/**
 * Embed JS file for Customizer Controls
 *
 */
function zimple_lite_customize_controls_js() {
	
	wp_enqueue_script( 'zimple-lite-customizer-controls', get_template_directory_uri() . '/inc/customizer/js/customizer-controls.js', array(), '20160530', true );
	
	// Localize the script
	wp_localize_script( 'zimple-lite-customizer-controls', 'zimple_lite_theme_links', array(
		'title'	=> esc_html__( 'Theme Links', 'zimple-lite' ),
		'themeURL'	=> esc_url( __( 'https://themecountry.com/zimple-lite/', 'zimple-lite' )),
		'themeLabel'	=> esc_html__( 'Theme Page', 'zimple-lite' ),
		'docuURL'	=> esc_url( __( 'https://themecountry.com/docs/zimple-doc/', 'zimple-lite' )),
		'docuLabel'	=>  esc_html__( 'Theme Documentation', 'zimple-lite' ),
		'rateURL'	=> esc_url( 'http://wordpress.org/support/view/theme-reviews/zimple-lite?filter=5' ),
		'rateLabel'	=> esc_html__( 'Rate this theme', 'zimple-lite' ),
		)
	);

}
add_action( 'customize_controls_enqueue_scripts', 'zimple_lite_customize_controls_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 *
 */
function zimple_lite_customize_preview_css() {
	wp_enqueue_style( 'zimple-lite-customizer-css', get_template_directory_uri() . '/inc/customizer/css/customizer.css', array(), '20160530' );
}
add_action( 'customize_controls_print_styles', 'zimple_lite_customize_preview_css' );

/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 */
function zimple_lite_theme_options() {
	// Merge Theme Options Array from Database with Default Options Array
	$theme_options = wp_parse_args( 
		
		// Get saved theme options from WP database
		get_option( 'zimple_lite_theme_options', array() ), 
		
		// Merge with Default Options if setting was not saved yet
		zimple_lite_default_options() 
		
	);

	// Return theme options
	return $theme_options;
}

/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function zimple_lite_default_options() {

	$default_options = array(
		'site_title'						=> true,
		'layout' 							=> 'right-sidebar',
		'sticky_header'						=> false,
		'post_layout_archives'				=> 'left',
		'post_content' 						=> 'excerpt',
		'excerpt_length' 					=> 20,
		'excerpt_more' 						=> '[...]',
		'post_navigation'					=> true,
		'related_posts'						=> 'cat',
		'enable_slide'						=> false,
		'back_to_top'						=> true,
		'paging'							=> 'paging-default',
	);
	
	return $default_options;
}