<?php
/**
 * The template for 404 (not found page)
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Override
 * @since Override 1.0
 */

get_header();
?>

<div id="blogwrapper">
	<div id="blog">


		<div class="post">
			<div class="entry-content">
				<h1><?php esc_html_e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'override' ); ?></h1>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'override' ); ?></p>
				

				<div class="entry-content-none">
					<?php get_search_form(); ?>
				</div><!--/entry-content-none-->

				<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

				<div class="widget">
					<h2 class="widgettitle"><?php esc_html_e( 'Most Used Categories', 'override' ); ?></h2>
					<ul>
						<?php wp_list_categories( array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						) ); ?>
					</ul>
				</div>
				
				<?php
				$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives.', 'override' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', array(
					'count'    => 0,
					'dropdown' => 1,
				), array( 'after_title' => '</h2>' . $archive_content ) );
				?>
				
				<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

			</div><!--/entry-->
		</div><!--/post-->

	</div><!--/blog-->
</div><!--/blogwrapper -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
