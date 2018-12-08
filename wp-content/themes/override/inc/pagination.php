<?php
/**
 * Create pagination functions for the theme.
 *
 * @package Override
 * @since Override 1.0
 */

/** Will use this function as conditional statement to show or hide our numbered pagination. */
if ( ! function_exists( 'override_show_posts_nav' ) ) :
	function override_show_posts_nav() {
		global $wp_query;

		return ( $wp_query->max_num_pages > 1 );// If more than one page exists, return TRUE.
	}
endif;

/** This function is responsible for splitting posts and pages using <!--nexpage-->. */
if ( ! function_exists( 'override_link_pages' ) ) :
	function override_link_pages() {
		$paged_page_nav = wp_link_pages(
			array(
				'before'      => '<div class="page-navigation"><ul><li class="pages">' . esc_html__( 'Pages:', 'override' ) . '</li>',
				'after'       => '</ul></div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'echo'        => false,
			)
		);

		// Add "current" and "page_divide" classes to our links
		// @link: http://wordpress.stackexchange.com/questions/17421/wp-link-page-wrap-current-page-element
		// Now let's wrap the nav inside <li>-elements.
		$current_class  = 'current';
		$classes        = 'page-divide';
		$paged_page_nav = str_replace( '<a', '<li class="' . $classes . '"><a', $paged_page_nav );
		$paged_page_nav = str_replace( '</span></a>', '</a></li>', $paged_page_nav );
		$paged_page_nav = str_replace( '"><span>', '">', $paged_page_nav );
		// Add "current" class.
		$paged_page_nav = str_replace( '<span>', '<li class="' . $current_class . '">', $paged_page_nav );
		$paged_page_nav = str_replace( '</span>', '</li>', $paged_page_nav );
		echo $paged_page_nav;
	}
endif;

/** This function is responsible for creating numbered navigation.
 *
 * @global WP_Query $wp_query WordPress Query object.
 */
if ( ! function_exists( 'override_numbered_nav' ) ) :
	function override_numbered_nav() {
		global $wp_query;

		/*
		* We need this here to add numbered Pagination used in paginate_links function
		* @link: https://codex.wordpress.org/Function_Reference/paginate_links
		*/
		if ( get_query_var( 'paged' ) ) {
			$paged = absint( get_query_var( 'paged' ) );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = absint( get_query_var( 'page' ) );
		} else {
			$paged = 1;
		}

		// Structure of "format" depends on whether we're using pretty permalinks.
		if ( get_option( 'permalink_structure' ) ) {
			$format = '?paged=%#%';
		} else {
			$format = '/page/%#%/';
		}
		$big  = 999999999; // Need an unlikely integer.
		$base = '?paged=%#%' === $format ? $base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ) : $base = esc_url( add_query_arg( 'paged', '%#%' ) );

		echo paginate_links( array(
			'base'      => $base,
			'format'    => $format,
			'prev_next' => true,
			'current'   => max( 1, $paged ),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => esc_html__( '&lsaquo; Prev', 'override' ),
			'next_text' => esc_html__( 'Next &rsaquo;', 'override' ),
			'end_size'  => 1,
			'mid_size'  => 1,
		) );
	}
endif;
