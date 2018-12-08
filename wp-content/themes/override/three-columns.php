<?php /* Template name: Blog Three Columns */
/**
 * This Template is used to display Three Column Layout
 *
 * @package Override
 * @since Override 1.1.7
 */

get_header();
?>

<div id="blogwrapper">
	<div id="blogs-three-cols">

		<?php
		if ( get_query_var( 'paged' ) ) {
			$paged = absint( get_query_var( 'paged' ) );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = absint( get_query_var( 'page' ) );
		} else {
			$paged = 1;
		}
		$default_posts_per_page = get_option( 'posts_per_page' );

		$args = array(
			/* Add whatever you need here - see http://codex.wordpress.org/Class_Reference/WP_Query */
			'post_type'      => 'post',
			'posts_per_page' => $default_posts_per_page,
			'include'        => implode( ',', get_option( 'sticky_posts' ) ),
			'paged'          => $paged,
		);

		$args2 = array(
			'post_type'      => 'post',
			'posts_per_page' => $default_posts_per_page,
			'paged'          => $paged,
		);

		$sticky_posts_list  = get_posts( $args );
		$regular_posts_list = get_posts( $args2 );

		$regular_posts_list = array_merge( $sticky_posts_list, $regular_posts_list );
		$regular_posts_list = array_map( 'unserialize', array_unique( array_map( 'serialize', $regular_posts_list ) ) );


		$temp     = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query( $args );
		$count    = $wp_query->post_count;

		$posts_reordered = array(
			'left-column'   => array(),
			'middle-column' => array(),
			'right-column'  => array(),
		);

		foreach ( array_chunk( $regular_posts_list, 3 ) as $chunk ) {
			$posts_reordered['left-column'][] = $chunk[0];
			if ( isset( $chunk[1] ) ) {
				$posts_reordered['middle-column'][] = $chunk[1];
			}
			if ( isset( $chunk[2] ) ) {
				$posts_reordered['right-column'][] = $chunk[2];
			}
		}
		?>

		<?php $i = 1;
		foreach ( $posts_reordered as $key => $column_posts ) : ?>
		<?php $outer_div_class = "$key"; ?>

		<div class="<?php echo sanitize_html_class( $outer_div_class ); ?>">
			<?php $inner_div_class = "col$i"; ?>

			<?php foreach ( $column_posts as $post ) :
			setup_postdata( $post ); ?>
			<div class="<?php echo sanitize_html_class( $inner_div_class ); ?>">
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<?php get_template_part( 'template-parts/content', 'three-columns' ); ?>
				</div><!--/$inner_div_class-->
				<?php endforeach; ?>
			</div><!--/$outer_div_class-->
			<?php $i++;
			endforeach; ?>

			<?php if ( 0 === $count ) {
				get_template_part( 'template-parts/content', 'none' );
			} ?>

			<?php if ( override_show_posts_nav() ) : ?>
			<div class="navigation">
				<?php override_numbered_nav(); ?>
			</div>
			<?php endif; ?><!--/override_show_posts_nav-->

			<?php wp_reset_postdata(); ?>

			<?php
			$wp_query = null;
			$wp_query = $temp;
			?>

		</div><!--/blogs-->
	</div><!--/blogswrapper-->


	<?php get_sidebar( 'secondary' ); ?>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
