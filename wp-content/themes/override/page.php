<?php
/**
 * The Template for displaying pages
 *
 * @package Override
 * @since Override 1.0
 */

get_header();
?>


<div id="blogwrapper">

	<div id="blog">
		<!--Get the Page-Loop-->
		<?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>
			<!--Get the page template-part-->
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
		<?php endwhile; ?>
		<?php endif; ?><!--END if THE LOOP-->
	</div><!--/blog-->

</div><!--/blogwrapper-->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
