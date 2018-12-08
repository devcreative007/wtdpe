<?php
/**
 * ZimpleLite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ZimpleLite
 */

/* Pro URL */
define('zimple_lite_PRO_URL', 'https://themecountry.com/themes/zimplepro/');

if ( ! function_exists( 'zimple_lite_setup' ) ) :
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
**/

function zimple_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ZimpleLite, use a find and replace
	 * to change 'zimple-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'zimple-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 200, 170 );
	add_image_size( 'zimple-lite-slide-thumb', 180, 180, true ); //
	add_image_size( 'zimple-lite-related-posts-thumb', 100, 80, true ); //

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'zimple-lite-primary' => esc_html__( 'Primary', 'zimple-lite' ),
		'zimple-lite-top'	=> __( 'Top Menu', 'zimple-lite' ),
		'zimple-lite-footer' => __('Footer Menu', 'zimple-lite'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	add_theme_support( 'custom-logo', array(
		'height'      => 60, // change to your height logo
		'width'       => 200, // change to your width logo
		'flex-width' => true, // change to flexible width
		'flex-width' => true, // change to flexible width
	) );

}
endif;
add_action( 'after_setup_theme', 'zimple_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zimple_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zimple_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'zimple_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zimple_lite_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'zimple-lite' ),
		'id'            => 'zimple-lite-sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'zimple-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Banner', 'zimple-lite' ),
		'id'            => 'zimple-lite-header-banner',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer One', 'zimple-lite' ),
		'id'            => 'zimple-lite-footer-one',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Two', 'zimple-lite' ),
		'id'            => 'zimple-lite-footer-two',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Three', 'zimple-lite' ),
		'id'            => 'zimple-lite-footer-three',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'zimple_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zimple_lite_scripts() {
	wp_enqueue_style( 'zimple-lite-merriweather-google-font-style', '//fonts.googleapis.com/css?family=Merriweather:400,700,300italic');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .  '/css/font-awesome.min.css');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() .  '/css/flexslider.css');
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() .  '/css/responsive.css');

	/**
	* Engueue Script
	*/

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20160115', true );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '20160115', true );
	wp_enqueue_script( 'zimple-lite-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '20160423', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zimple_lite_scripts' );

// Remove Sticky posts enable slideshow
function zimple_lite_exclude_sticky_post( $query ) {

	$theme_options = zimple_lite_theme_options();

        $sticky = get_option( 'sticky_posts' );

        if ( ! is_admin() && $query->is_home() && $query->is_main_query() && $theme_options['enable_slide'] == 1 && $sticky ) {

                $query->set( 'post__not_in', $sticky );
                $query->set( 'ignore_sticky_posts', true );
        }    
}

add_action( 'pre_get_posts', 'zimple_lite_exclude_sticky_post' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Custom Style 
*/
load_template( get_template_directory() . '/inc/custom-style.php' );
