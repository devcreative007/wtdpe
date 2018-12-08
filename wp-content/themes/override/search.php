<?php
/**
 * The Template for displaying search pages
 *
 * @package Override
 * @since Override 1.0
 */

get_header();
?>


<div id="blogwrapper">
	<div id="blog">
		<h1 class="page-title-search"><?php printf( __( 'Search Results for: %s', 'override' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

		<?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'search' ); ?>

		<?php endwhile; ?>

		<?php else : ?>
			<!--If no posts found get the content-none template-->
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?><!--END if THE LOOP-->

		<?php if ( override_show_posts_nav() ) : ?>
		<div class="navigation">
			<?php override_numbered_nav(); ?>
		</div><!--/navigation-->
		<?php endif; ?><!--END if override_show_posts_nav-->
	</div><!--/blog-->
</div><!--/blogwrapper-->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
