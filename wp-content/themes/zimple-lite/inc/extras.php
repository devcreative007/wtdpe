<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ZimpleLite
 */



function zimple_lite_body_classes( $classes ) {
	
	// Get Theme Options from Database
	
	$theme_options = zimple_lite_theme_options();
		
	// Switch Sidebar Layout to left
	if ( 'left-sidebar' == $theme_options['layout'] ) {
		$classes[] = 'sidebar-left';
	}

	return $classes;
}
add_filter( 'body_class', 'zimple_lite_body_classes' );


if ( ! function_exists( 'zimple_lite_excerpt_more' ) ) {
	/**
	|------------------------------------------------------------------------------
	| Excerpt ending
	|------------------------------------------------------------------------------
	| 
	| @return string
	|
	*/

	function zimple_lite_excerpt_more( $more ) {
		$theme_options = zimple_lite_theme_options();
		return esc_html ($theme_options['excerpt_more']);
	}

	add_filter( 'excerpt_more', 'zimple_lite_excerpt_more' );
	
}

if ( ! function_exists( 'zimple_lite_excerpt_length' ) ) {

	/**
	|------------------------------------------------------------------------------
	| Excerpt length
	|------------------------------------------------------------------------------
	| 
	| @return integer
	|
	*/

	function zimple_lite_excerpt_length($length) {

		$theme_options = zimple_lite_theme_options();

		$number = intval ( $nav_style = $theme_options['excerpt_length'] ) > 0 ?  intval ( $nav_style = $theme_options['excerpt_length'] ) : $length;
		return $number;
	}
	
}

add_filter( 'excerpt_length', 'zimple_lite_excerpt_length', 999 );


	/**
	|------------------------------------------------------------------------------
	| Related Posts
	|------------------------------------------------------------------------------
	|
	| You can show related posts by Categories or Tags.
	|
	| 1. Thumbnail related posts (default)
	| 2. List of related posts
	| 
	| @return void
	|
	*/
if (! function_exists('zimple_lite_related_posts') ):

	function zimple_lite_related_posts() {
		global $post;

		// Get Theme Options from Database
		$theme_options = zimple_lite_theme_options();
		$numberRelated = 3; 
		$args =  array();

		if ($theme_options['related_posts'] == 'tag') {

			$tags = wp_get_post_tags($post->ID);
			$arr_tags = array();
			foreach($tags as $tag) {
				array_push($arr_tags, $tag->term_id);
			}
			
			if (!empty($arr_tags)) { 
			    $args = array(  
				    'tag__in' => $arr_tags,  
				    'post__not_in' => array($post->ID),  
				    'posts_per_page'=> $numberRelated,
			    ); 
			}

		} else {

			 $args = array( 
			 	'category__in' => wp_get_post_categories($post->ID), 
			 	'posts_per_page' => $numberRelated, 
			 	'post__not_in' => array($post->ID) 
			 );

		}

		if (! empty($args) ) {
			$posts = get_posts($args);

			if ($posts) {

			?>
			<h3 class="title-related-posts"><?php _e('Related Posts', 'zimple-lite') ?></h3>
				<ul class="related grid clearfix">
				<?php
				foreach ($posts as $p) {
					?>
					<li>
						<div class="related-entry">
							<?php if (has_post_thumbnail($p->ID)) : ?>
							<div class="relate-post-thumbnail">
								<a href="<?php echo esc_url ( get_the_permalink($p->ID)  ) ?>">
								<?php echo get_the_post_thumbnail($p->ID, 'zimple-lite-related-posts-thumb') ?>
								</a>
							</div>
							<?php endif; ?>
							<a href="<?php echo esc_url (  get_the_permalink($p->ID) ) ?>"><?php echo esc_html(  get_the_title($p->ID)  ) ?></a>
						</div>
					</li>
					<?php
				}
				?>
				</ul>
				<?php
			}
		}
	}
endif;

/**
	|------------------------------------------------------------------------------
	| Post Render
	|------------------------------------------------------------------------------
	| 
	| @return void
	|
	*/
function zimple_lite_post_render() {

	 if ( have_posts() ) : ?>
			<?php if (get_theme_mod('zimple_lite_general_layout') != 'grid_post') : ?>
			<div id="post-container" class="post-item-list-view">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<div id="post-container" class="post-item-grid-view clearfix">
				
				<?php /* Start the Loop */ ?>
				<?php
				 	while ( have_posts() ) : the_post(); 
				 ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'grid' );
					?>

				<?php 
					
					endwhile; 
				?>
				
			</div>
		<?php endif; ?>

			<?php zimple_lite_the_posts_navigation(); ?>

	<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

	<?php endif;
}