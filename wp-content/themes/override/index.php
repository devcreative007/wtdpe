<?php
/**
 * The main template file
 * Index.php used to display our main page and our archives
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Override
 * @since Override 1.0
 */

get_header();
?>


<div id="blogwrapper">

	<?php
	/**
	 * @credit: Twenty Eleven
	 *
	 * @link http://codex.wordpress.org/Template_Hierarchy
	 */
	if ( is_archive() && is_day() ) {
		printf( __( '<h1 class="archives">Daily Archives:&nbsp;</h1> %s', 'override' ), '<span class="archives">' . get_the_date() . '</span>' );
	} elseif ( is_archive() && is_month() ) {
		printf( __( '<h1 class="archives">Monthly Archives:&nbsp;</h1> %s', 'override' ), '<span class="archives">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'override' ) ) . '</span>' );
	} elseif ( is_archive() && is_year() ) {
		printf( __( '<h1 class="archives">Yearly Archives:&nbsp;</h1> %s', 'override' ), '<span class="archives">' . get_the_date( _x( 'Y', 'yearly archives date format', 'override' ) ) . '</span>' );
	}
	?>


	<div id="blog">

		<!--Get the Main-Loop-->
		<?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php else : ?>
		<!--If no posts found get the content-none template-->
	<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?><!--End if THE LOOP-->

		<?php if ( override_show_posts_nav() ) : ?>
		<div class="navigation">
			<?php override_numbered_nav(); ?>
		</div><!--/navigation-->
		<?php endif; ?><!--/override_show_posts_nav()-->

	</div><!--/blog-->
</div><!--/blogswrapper-->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
