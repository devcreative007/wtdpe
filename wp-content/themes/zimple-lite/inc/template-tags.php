<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ZimpleLite
 */

if ( ! function_exists('zimple_lite_header_title') ) :
	
	function zimple_lite_header_title() {

		$logo = get_theme_mod('custom_logo');
		$custom_logo = wp_get_attachment_image_src( $logo , 'full' );
		?>
			<div class="site-branding logo col-xs-4 col-sm-12 col-md-4 col-lg-4">
				<?php if ( !empty($logo) ) : ?>
					<?php if( is_front_page() || is_home() ) : ?>
					<h1 class="site-title logo" itemprop="headline">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo( 'description' )); ?>">
							<img src="<?php echo $custom_logo[0]; ?>" alt="<?php echo esc_attr(get_bloginfo( 'description' )); ?>" />
						</a>
					</h1>
					<?php else : ?>
						<h2 class="site-title logo" itemprop="headline">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo( 'description' )); ?>">
								<img src="<?php echo esc_url($custom_logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo( 'description' )); ?>" />
							</a>
						</h2>
					<?php endif ?>
				<?php else : ?>
					<?php if( is_front_page() || is_home() ) : ?>
						<h1 itemprop="headline" class="site-title">
							<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo( 'description' )); ?>">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php else : ?>
							<h2 class="site-title">
							<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo( 'description' )); ?>">
								<?php bloginfo( 'name' ); ?>
							</a>
							</h2>
							<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
						<?php endif ?>
				<?php endif ?>
		</div>
			<?php
	}
endif;

if ( ! function_exists( 'zimple_lite_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function zimple_lite_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' %s', 'post date', 'zimple-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( ' %s', 'post author', 'zimple-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"><i class="fa fa-user" aria-hidden="true"></i>' . $byline . '</span>';

	echo '<span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.



	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'zimple-lite' ) );
		if ( $categories_list && zimple_lite_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-file" aria-hidden="true"></i>' . esc_html__( ' %1$s', 'zimple-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'zimple-lite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i>' . esc_html__( ' %1$s', 'zimple-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'zimple-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function zimple_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'zimple_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'zimple_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so zimple_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so zimple_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in zimple_lite_categorized_blog.
 */
function zimple_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'zimple_lite_categories' );
}
add_action( 'edit_category', 'zimple_lite_category_transient_flusher' );
add_action( 'save_post',     'zimple_lite_category_transient_flusher' );

if ( ! function_exists( 'zimple_lite_footer_copyright' ) ) :

	function zimple_lite_footer_copyright() {
		
		printf( __( '<a href="%s" rel="designer">Zimple Lite</a> powered by <a href="http://wordpress.org/">WordPress</a>', 'zimple-lite' ),  zimple_lite_PRO_URL);
 
	}

endif;

if ( ! function_exists( 'zimple_lite_the_posts_navigation' ) ) :
/**
 |------------------------------------------------------------------------------
 | Display navigation to next/previous set of posts when applicable.
 |------------------------------------------------------------------------------
 |
 | @todo Remove this function when WordPress 4.3 is released.
 |
 */
function zimple_lite_the_posts_navigation() {
	
	$theme_options = zimple_lite_theme_options();
	$nav_style = $theme_options['paging'];


	if  ( $nav_style == 'paging-numberal') :
		echo '<div class="content-pagination">';
			the_posts_pagination( array(
				'prev_text'          => __( '<i class="fa fa-angle-left"></i>', 'zimple-lite' ),
				'next_text'          => __( '<i class="fa fa-angle-right"></i>', 'zimple-lite' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'zimple-lite' ) . ' </span>',
			) );
		echo '</div>';

	else :

		the_posts_navigation();

	endif;
	}

endif;