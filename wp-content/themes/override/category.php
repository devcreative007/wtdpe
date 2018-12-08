<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
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

		<?php if ( is_category() ) : ?>
			<h1 class="cat"><?php single_cat_title( esc_html__( 'Category Archives: ', 'override' ) ); ?></h1>
		<?php endif; ?>
		<?php if ( category_description() ) : // Show an optional category description. ?>
			<h1 class="cat-desc"><?php esc_html_e( 'Description:', 'override' );
			?></h1><?php echo category_description(); ?>
		<?php endif; ?>

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
		<?php endif; ?><!--/override_show_posts_nav()-->

	</div><!--/blogs-->
</div><!--/blogswrapper-->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
