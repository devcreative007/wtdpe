<?php
/**
 * Override theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development
 * and https://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @file functions.php
 * @author  Dejan Peić
 * @package Override
 * @filesource  wp-content/themes/override/functions.php
 * @version Release: 1.2.2.1
 * @since Override 1.2.2.1
 */

// Set global image and video width. 
add_action( 'after_setup_theme', 'override_content_width', 0 );

/**
 * Register sidebars by running override_widgets_init() on the widgets_init hook.
 * To override override_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 */

add_action( 'widgets_init', 'override_widgets_init' );

add_action( 'wp_head', 'override_dynamic_layout' );

/** Tell WordPress to run override_add_theme_support() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'override_add_theme_support' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own override_add_theme_support() function to override in a child theme.
 */
if ( ! function_exists( 'override_add_theme_support' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own override_add_theme_support() function to override in a child theme.
	 */
	function override_add_theme_support() {

		// Set up the WordPress core custom header arguments and settings.
		$defaults = array(
			'default-color'          => 'efefef',
			'wp-head-callback'       => '_custom_background_cb',
		);

		add_theme_support( 'custom-background', $defaults );

		// Enable post and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Enable post thumbnails (Featured Images).
		add_theme_support( 'post-thumbnails' );

		// Enable support for Post Thumbnails, and declare four sizes.
		add_image_size( 'override-post-thumb', 620, 207, true );
		add_image_size( 'override-home-thumb', 220, 180, true );
		add_image_size( 'override-index-thumb', 300, 100, true );
		set_post_thumbnail_size( 1000, 9999, false );

		// Code for custom header support.
		$defaultshead = array(
			'default-image'          => false,
			'random-default'         => false,
			'width'                  => 1000,
			'height'                 => 400,
			'flex-height'            => true,
			'flex-width'             => true,
			'default-text-color'     => '283972',
			'header-text'            => true,
			'uploads'                => true,
		);
		
		register_default_headers( array(
		'default-image' => array(
			'url'           => get_parent_theme_file_uri( '/images/override-skeleton-logo.png' ),
			'thumbnail_url' => get_parent_theme_file_uri( '/images/override-skeleton-logo.png' ),
			'description'   => esc_html__( 'Default Header Image', 'override' ),
		),
		) );
		
		// Enable post and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'video', 'audio' ) );

		add_theme_support( 'custom-header', $defaultshead );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'main-menu', esc_html__( 'Main Menu', 'override' ) );

		// Will add support for custom tinymce CSS styling.
		add_editor_style( 'css/editor-style.css' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

	}


endif;


/**
 * Enqueues scripts and styles.
 *
 * @since Override 1.2.1.9
 */
function override_js_scripts_and_css() {


		// Enqueue JS files.
		wp_enqueue_script( 'hoverIntent' );
		wp_enqueue_script( 'override-menu-script', get_template_directory_uri() . '/js/menu.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'override-functions-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'override-responsive-vid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'override-responsive-text', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '1.0', true );
	
		/*
		We add some JavaScript to pages with the comment form
		* to support sites with threaded comments (when in use).
		*/
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
		// Load the Internet Explorer 8 specific stylesheet.
		wp_enqueue_style( 'override-css-ie8-style', get_template_directory_uri() . '/css/ie8.css', array( 'override-css-style' ), '1.0' );
		wp_style_add_data( 'override-css-ie8-style', 'conditional', 'lt IE 9' );
		wp_enqueue_style( 'override-css-style', get_template_directory_uri() . '/style.css', array(), '1.2.2.1', 'all' );
		wp_enqueue_style( 'override-font-awesome', get_template_directory_uri() . '/fonts/css/font-awesome.css', array(), '1.0', 'all'  );

}

add_action( 'wp_enqueue_scripts', 'override_js_scripts_and_css' );
// Add's widgets to the theme (function tied to the widgets_init hook).
require_once( get_template_directory() . '/inc/widgets-init.php' );
// Add's filtered functions.
require_once( get_template_directory() . '/inc/filtered-functions.php' );
// Add's functions necessary for pagination.
require_once( get_template_directory() . '/inc/pagination.php' );
// Add's comment-form walker function.
require_once( get_template_directory() . '/inc/comment-form.php' );
// Add's bredcubmb function.
require_once( get_template_directory() . '/inc/breadcrumbs.php' );
// Add's dynamic-css function dynamic-css.php tied to hook add_action( 'wp_head', 'override_dynamic_layout' ).
require_once( get_template_directory() . '/inc/dynamic-css.php' );
// Add's cutomizer functions.
require_once( get_template_directory() . '/inc/customizer.php' );
