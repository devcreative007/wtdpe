<?php
/**
 * This file contains all of the functions which are passed through WordPress filters.
 *
 * @package Override
 * @since Override 1.2.0.5
 */

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Override 1.2.0.5
 */
function override_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'override_content_width', 1000 );
}


/**
 * Removing private prefix from post titles.
 *
 * @param string $content the string to output.
 *
 * @return string The filtered Post title.
 */
function override_title_format( $content ) {
	return '%s';
}

add_filter( 'private_title_format', 'override_title_format' );
add_filter( 'protected_title_format', 'override_title_format' );


/**
 * Removes WordPress when sending emails and replacing it with the name of your site.
 *
 * @param string $email name associated with the "from" email address.
 *
 * @return string The name of your site.
 */
function override_remove_wordpress_from_mail( $email ) {
	$wpfrom = get_option( 'blogname' );

	return $wpfrom;
}

add_filter( 'wp_mail_from_name', 'override_remove_wordpress_from_mail' );


/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function override_excerpt_more( $more ) {
	global $post;
	return '<p><a class="more-link" href="'. esc_url( get_permalink( $post->ID ) ) . '">'. __( 'Read More', 'override' ) .'</a></p>';
}

add_filter( 'excerpt_more', 'override_excerpt_more' );


/**
 * Add a parent CSS class for nav menu items.
 *
 * @param array $items The menu items, sorted by each menu item's menu order.
 *
 * @return array (maybe) modified parent CSS class.
 */
function override_add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		// Check if the item is a parent item.
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents, true ) ) {
			// Add "menu-parent-item" class to parents.
			$item->classes[] = 'menu-parent-item';
		}
	}

	return $items;
}

// Add_menu_parent_class to menu.
add_filter( 'wp_nav_menu_objects', 'override_add_menu_parent_class' );


/**
 * Filters the oembed results and wraps them in responsive div
 *
 * @param string $html The original HTML returned from the external oembed provider.
 *
 * @return string The filtered HTML.
 */
function override_embed_html( $html ) {
	return '<div class="video-container">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'override_embed_html', 10, 1 );
add_filter( 'video_embed_html', 'override_embed_html' ); // Jetpack.


/**
 * HTML5 rel attribute validation fix
 *
 * @param string $text The original HTML returned from category link.
 *
 * @return string $text The filtered HTML.
 */
function override_add_nofollow_cat( $text ) {
	$text = str_replace( 'rel="category"', 'rel="tag"', $text );

	return $text;
}

// Fix for html5.
add_filter( 'the_category', 'override_add_nofollow_cat' );


/**
 * Display descriptions in main navigation.
 *
 * @credit: Twenty Fifteen 1.0
 *
 * @link: http://wordpress.stackexchange.com/questions/14037/menu-items-description-custom-walker-for-wp-nav-menu
 *
 * @param string  $item_output  The menu item output.
 * @param WP_Post $item Menu item object.
 * @param int     $depth Depth of the menu.
 * @param array   $args wp_nav_menu() arguments.
 *
 * @return string Menu item with possible description.
 */
function override_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'main-menu' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . esc_html( $item->description ) . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'override_nav_description', 10, 4 );
