<?php /* Template name: Sitemap */
/**
 * The Template for displaying simple Sitemap
 *
 * @package Override
 * @since Override 1.2.0
 */

get_header();
?>

<div id="blogwrapper">
	<div class="entry-content" id="sitemap">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<h3><?php esc_html_e( 'Pages', 'override' ); ?></h3>
		<ul><?php wp_list_pages( 'title_li=' ); ?></ul>


		<h3><?php esc_html_e( 'Feeds', 'override' ); ?></h3>

		<ul>
			<li><a href="<?php bloginfo( 'rss2_url' ); ?>"><?php esc_html_e( 'Main RSS', 'override' ); ?></a></li>
			<li>
				<a href="<?php bloginfo( 'comments_rss2_url' ); ?>"><?php esc_html_e( 'Comment Feed', 'override' ); ?></a>
			</li>
		</ul>


		<h3><?php esc_html_e( 'Categories', 'override' ); ?></h3>
		<ul><?php wp_list_categories( 'orderby=ID&show_count=1&hierarchical=0&feed=RSS' ); ?></ul>

		<h3><?php esc_html_e( 'All Blog Posts:', 'override' ); ?></h3>
			<ul><?php $archive_query = new WP_Query( 'posts_per_page=-1' );
				while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>"
					title="<?php the_title_attribute( array( 'before' => esc_attr__( 'Permanent link to ', 'override' ) ) ); ?>"><?php the_title(); ?></a>
					(<?php comments_number( '0', '1', '%' ); ?>)
				</li>
				<?php endwhile; ?>
			</ul>

		<h3><?php esc_html_e( 'Archives', 'override' ); ?></h3>
		<ul>
			<?php wp_get_archives( 'type=monthly&show_post_count=true' ); ?>
		</ul>
	</div><!--/entry-content-->
</div><!--/blogwrapper-->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
