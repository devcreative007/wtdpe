<?php
/*
 * Plugin Name: Very Simple Meta Description
 * Description: This is a very simple plugin to add meta description in the header of your WordPress website. For more info please check readme file.
 * Version: 4.4
 * Author: Guido van der Leest
 * Author URI: https://www.guidovanderleest.nl
 * License: GNU General Public License v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: very-simple-meta-description
 * Domain Path: /translation
 */

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// load plugin text domain
function vsmd_init() { 
	load_plugin_textdomain( 'very-simple-meta-description', false, dirname( plugin_basename( __FILE__ ) ) . '/translation' );
}
add_action('plugins_loaded', 'vsmd_init');

// add excerpt to pages
function vsmd_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'vsmd_page_excerpt' );

// add settings link
function vsmd_action_links ( $links ) { 
	$settingslink = array( '<a href="'. admin_url( 'options-general.php?page=vsmd' ) .'">'. __('Settings', 'very-simple-meta-description') .'</a>', ); 
	return array_merge( $links, $settingslink ); 
} 
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'vsmd_action_links' ); 
 
// add admin options page
function vsmd_menu_page() {
	add_options_page( __( 'Meta Description', 'very-simple-meta-description' ), __( 'Meta Description', 'very-simple-meta-description' ), 'manage_options', 'vsmd', 'vsmd_options_page' );
}
add_action( 'admin_menu', 'vsmd_menu_page' );

// add admin settings and such 
function vsmd_admin_init() {
	add_settings_section( 'vsmd-section', __( 'General', 'very-simple-meta-description' ), 'vsmd_section_callback', 'vsmd' );
	add_settings_field( 'vsmd-field', __( 'Meta Description', 'very-simple-meta-description' ), 'vsmd_field_callback', 'vsmd', 'vsmd-section' );
	register_setting( 'vsmd-options', 'vsmd-setting', 'sanitize_text_field' );
	add_settings_field( 'vsmd-field-1', __( 'Homepage', 'very-simple-meta-description' ), 'vsmd_field_callback_1', 'vsmd', 'vsmd-section' );
	register_setting( 'vsmd-options', 'vsmd-setting-1', 'esc_attr' );

	add_settings_section( 'vsmd-section-2', __( 'Post and Page', 'very-simple-meta-description' ), 'vsmd_section_callback_2', 'vsmd' );
	add_settings_field( 'vsmd-field-2', __( 'Excerpt', 'very-simple-meta-description' ), 'vsmd_field_callback_2', 'vsmd', 'vsmd-section-2' );
	register_setting( 'vsmd-options', 'vsmd-setting-2', 'esc_attr' );

	add_settings_section( 'vsmd-section-3', __( 'Product', 'very-simple-meta-description' ), 'vsmd_section_callback_3', 'vsmd' );
	add_settings_field( 'vsmd-field-3', __( 'Product short description', 'very-simple-meta-description' ), 'vsmd_field_callback_3', 'vsmd', 'vsmd-section-3' );
	register_setting( 'vsmd-options', 'vsmd-setting-3', 'esc_attr' );
}
add_action( 'admin_init', 'vsmd_admin_init' );

function vsmd_section_callback() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'Search engines such as Google and Bing use the meta description when listing search results.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'Using the same meta description for all posts and pages is not SEO friendly.', 'very-simple-meta-description' ).'</li>';
	echo '</ul>';
}

function vsmd_section_callback_2() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'While adding a post or page you can set an excerpt using the "Excerpt" box.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'The "Excerpt" can be used as meta description for that post or page.', 'very-simple-meta-description' ).'</li>';
	echo '</ul>';
}

function vsmd_section_callback_3() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'While adding a WooCommerce product you can set an excerpt using the "Product short description" box.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'The "Product short description" can be used as meta description for that product.', 'very-simple-meta-description' ).'</li>';
	echo '</ul>';
}

function vsmd_field_callback() {
	$vsmd_setting = esc_attr( get_option( 'vsmd-setting' ) );
	$vsmd_count = strlen(get_option( 'vsmd-setting' ) );
	echo "<textarea name='vsmd-setting' rows='8' cols='50' maxlength='320'>$vsmd_setting</textarea>";
	?>
	<p><?php printf( esc_attr__( 'You have used %s of 320 characters.', 'very-simple-meta-description' ), $vsmd_count ); ?></p>
	<?php
}

function vsmd_field_callback_1() {
	$value = esc_attr( get_option( 'vsmd-setting-1' ) );
	?>
	<input type='hidden' name='vsmd-setting-1' value='no'>
	<label><input type='checkbox' name='vsmd-setting-1' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use this meta description for homepage only.', 'very-simple-meta-description' ); ?></label>
	<?php
}

function vsmd_field_callback_2() {
	$value = esc_attr( get_option( 'vsmd-setting-2' ) );
	?>
	<input type='hidden' name='vsmd-setting-2' value='no'>
	<label><input type='checkbox' name='vsmd-setting-2' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use as meta description.', 'very-simple-meta-description' ); ?></label>
	<?php
}

function vsmd_field_callback_3() {
	$value = esc_attr( get_option( 'vsmd-setting-3' ) );
	?>
	<input type='hidden' name='vsmd-setting-3' value='no'>
	<label><input type='checkbox' name='vsmd-setting-3' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use as meta description.', 'very-simple-meta-description' ); ?></label>
	<?php
}

// display admin options page
function vsmd_options_page() {
?>
<div class="wrap"> 
	<div id="icon-plugins" class="icon32"></div> 
	<h1><?php _e( 'Very Simple Meta Description', 'very-simple-meta-description' ); ?></h1> 
	<form action="options.php" method="POST">
	<?php settings_fields( 'vsmd-options' ); ?>
	<?php do_settings_sections( 'vsmd' ); ?>
	<?php submit_button(); ?>
	</form>
</div>
<?php
}

// include meta in header 
function vsmd_meta_description() {
	// no meta description for 404 or search page
	if ( is_404() || is_search() ) 
		return;
	global $post;
	$vsmd_meta = esc_attr( get_option( 'vsmd-setting' ) );
	$vsmd_homepage = esc_attr( get_option( 'vsmd-setting-1' ) );
	$vsmd_post = esc_attr( get_option( 'vsmd-setting-2' ) );
	$vsmd_product = esc_attr( get_option( 'vsmd-setting-3' ) );
	$vsmd_excerpt = get_the_excerpt();

	// meta description
	if ( $vsmd_homepage != 'yes' ) {
		if ( $vsmd_post == 'yes' && is_singular( array('post', 'page') ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($vsmd_excerpt).'" />'."\n";
		} elseif ( $vsmd_product == 'yes' && is_singular( 'product' ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($vsmd_excerpt).'" />'."\n";
		} else {
			if ( !empty($vsmd_meta) ) {
				echo '<meta name="description" content="'.esc_attr($vsmd_meta).'" />'."\n";
			}
		}
	} 
	if ( $vsmd_homepage == 'yes' ) {
		if ( $vsmd_post == 'yes' && is_singular( array('post', 'page') ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($vsmd_excerpt).'" />'."\n";
		} elseif ( $vsmd_product == 'yes' && is_singular( 'product' ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($vsmd_excerpt).'" />'."\n";
		} else { 
			if ( is_front_page() ) {
				if ( !empty( $vsmd_meta ) ) {
					echo '<meta name="description" content="'.esc_attr($vsmd_meta).'" />'."\n";
				}
			}
		}
	}
}
add_action( 'wp_head', 'vsmd_meta_description' );
