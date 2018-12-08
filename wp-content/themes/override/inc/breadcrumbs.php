<?php
/**
 * Create our BreadCrumbs  function.
 *
 * @Author: Boutros AbiChedid
 *
 * @Date:        February 14, 2011
 * @Copyright:   Boutros AbiChedid (http://bacsoftwareconsulting.com/)
 * @Licence:     Feel free to use it and modify it to your needs but keep the
 * Author's credit. This code is provided 'as is' without any warranties.
 * @Function     Name:  override_breadcrumb()
 * @Version:     1.0 -- Tested up to WordPress version 4.7.4
 * @Description: WordPress Breadcrumb navigation function. Adding a
 * breadcrumb trail to the theme without a plugin.
 * This code does not support multi-page split numbering, attachments,
 * custom post types and custom taxonomies.
 *
 * @package    Override
 * @since      Override 1.0
 */

function override_breadcrumb() {
	// Variable (symbol >> encoded) and can be styled separately.
	// Use >> for different level categories (parent >> child >> grandchild).
	$delimiter = '<span class="delimiter"> &raquo; </span>';
	// Use bullets for same level categories ( parent . parent ).
	$delimiter1 = '<span class="delimiter1"> &bull; </span>';
	// Text link for the 'Home' page.
	$youarehere = esc_html__( 'You are here:&nbsp;', 'override' );
	// Display only the first 30 characters of the post title.
	$maxlength = 30;
	$main      = esc_html__( 'Home', 'override' );
	// Archive Category string.
	$archive = esc_html__( 'Archive Category:&nbsp;', 'override' );
	// Posts Tagged string.
	$posttagged = esc_html__( 'Posts tagged:&nbsp;', 'override' );
	// Search results string.
	$searchfor = esc_html__( 'Search Results for:&nbsp;', 'override' );
	// Archived Articles by Author string.
	$archivesbyauthor = esc_html__( 'Archived Article(s) by Author:&nbsp;', 'override' );
	// Error 404 string.
	$errornotfound = esc_html__( 'Error 404 - Not Found.', 'override' );
	// Variable for archived year.
	$arc_year = get_the_time( 'Y' );
	// Variable for archived month.
	$arc_month = get_the_time( 'F' );
	// Variables for archived day number + full.
	$arc_day      = get_the_time( 'd' );
	$arc_day_full = get_the_time( 'l' );
	// Variable for the URL for the Year.
	$url_year = get_year_link( $arc_year );
	// Variable for the URL for the Month.
	$url_month = get_month_link( $arc_year, $arc_month );

	/*
    is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page()
    */

	// Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
	if ( ! is_front_page() ) {
		// If Breadcrump exists, wrap it up in a div container for styling.
		// You need to define the breadcrumb class in CSS file.
		echo '<div class="breadcrumb">';
		// Global WordPress variable $post. Needed to display multi-page navigations.
		global $post, $cat;
		// A safe way of getting values for a named option from the options database table.
		$homeLink = home_url();
		// If you don't like "You are here:", just remove it.
		echo $youarehere . '<a href="' . esc_url( $homeLink ) . '">' . $main . '</a>' . $delimiter;
		// Display breadcrumb for single post
		if ( is_single() ) {// check if any single post is being displayed.
			// Returns an array of objects, one object for each category assigned to the post.
			// This code does not work well (wrong delimiters) if a single post is listed
			// at the same time in a top category AND in a sub-category. But this is highly unlikely.

			$category = get_the_category();
			$num_cat  = count( $category );// Counts the number of categories the post is listed in.
			// If you have a single post assigned to one category.
			// If you don't set a post to a category, WordPress will assign it a default category.
			if ( $num_cat <= 1 ) {
				echo get_category_parents( $category[0], true, ' ' . $delimiter . ' ' );
				// Display the full post title.
				echo ' ' . esc_html( get_the_title() );
				// Then the post is listed in more than 1 category.
			} else {// Put bullets between categories, since they are at the same level in the hierarchy.

				echo the_category( $delimiter1, 'multiple' );
				// Display partial post title, in order to save space.
				if ( strlen( get_the_title() ) >= $maxlength ) {
					echo ' ' . $delimiter . esc_html( trim( substr( get_the_title(), 0, $maxlength ) ) ) . ' ...';
				} else {// the title is short, display all post title.
					echo ' ' . $delimiter . esc_html( get_the_title() );
				}
			}
		} elseif ( is_category() ) {// Check if Category archive page is being displayed.
			// Returns the category title for the current page.
			// If it is a subcategory, it will display the full path to the subcategory.
			echo $archive . get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
		} elseif ( is_tag() ) {// Check if a Tag archive page is being displayed.
			// Returns the current tag title for the current page.
			echo $posttagged . single_tag_title( '', false );
		} elseif ( is_day() ) {// Check if the page is a date (day) based archive page.
			echo '<a href="' . esc_url( $url_year ) . '">' . esc_html( $arc_year ) . '</a> ' . $delimiter . ' ';
			echo '<a href="' . esc_url( $url_month ) . '">' . esc_html( $arc_month ) . '</a> ' . $delimiter . esc_html( $arc_day ) . ' (' . esc_html( $arc_day_full ) . ')';
		} elseif ( is_month() ) {// Check if the page is a date (month) based archive page.
			echo '<a href="' . esc_url( $url_year ) . '">' . esc_html( $arc_year ) . '</a> ' . $delimiter . esc_html( $arc_month );
		} elseif ( is_year() ) {// Check if the page is a date (year) based archive page.
			echo esc_html( $arc_year );
		} elseif ( is_search() ) {// Check if search result page archive is being displayed.
			echo $searchfor . esc_html( get_search_query() );
		} elseif ( is_page() && ! $post->post_parent ) {// Check if this is a top Level page being displayed.
			echo esc_html( get_the_title() );
		} elseif ( is_page() && $post->post_parent ) {// Check if this is a subpage (submenu) being displayed.
			// Get the ancestor of the current page/post_id, with the numeric ID
			// Of the current post as the argument.
			// get_post_ancestors() returns an indexed array containing the list of all the parent categories.

			$post_array = get_post_ancestors( $post );
			// Sorts in descending order by key, since the array is from top category to bottom.
			krsort( $post_array );
			// Loop through every post id which we pass as an argument to the get_post() function.
			// $post_ids contains a lot of info about the post, but we only need the title.
			foreach ( $post_array as $key => $postid ) {
				// Returns the object $post_ids.
				$post_ids = get_post( $postid );
				// Returns the name of the currently created objects.
				$title = $post_ids->post_title;
				// Create the permalink of $post_ids.
				echo '<a href="' . esc_url( get_permalink( $post_ids ) ) . '">' . esc_html( $title ) . '</a>' . $delimiter;
			}
			the_title();// Returns the title of the current page.
		} elseif ( is_author() ) {// Check if an Author archive page is being displayed.
			global $author;
			// Returns the user's data, where it can be retrieved using member variables.
			$user_info = get_userdata( $author );
			echo $archivesbyauthor . '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( $user_info->display_name ) . '</a>';
		} elseif ( is_404() ) {// Checks if 404 error is being displayed.
			echo $errornotfound;
		} else {// All other cases that I missed. No Breadcrumb trail.

		}
		echo '</div>';
	}
}
