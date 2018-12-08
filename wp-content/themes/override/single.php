<?php
/**
 * The Template for displaying all single posts
 *
 * @package Override
 * @since Override 1.0
 */

get_header();
?>

<div id="blogwrapper">
	<div id="blog">
		<?php
		// Function_exists() Return TRUE if the given function has been defined.
		// code by BOUTROS ABICHEDID. Adding breadcrumb trail to the WordPress theme.
		if ( function_exists( 'override_breadcrumb' ) ) {
			override_breadcrumb();
		}
		?>
		<?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

	<?php endwhile; ?>

		<?php endif; ?><!--End if THE LOOP-->

		<!--We will show our div & spans only if next-prev post exist-->
		<?php if ( get_next_post() || get_previous_post() ) : ?>
		<div class="single-navigation">
			<?php if ( get_adjacent_post( false, '', true ) ) { ?>
				<span class="prev"><?php previous_post_link( esc_html( '&lsaquo; %link' ) ); ?></span>
			<?php } ?>

			<?php if ( get_adjacent_post( false, '', false ) ) { ?>
				<span class="next"><?php next_post_link( esc_html( '%link &rsaquo;' ) ); ?></span>
			<?php } ?>
		</div><!--/single navigation-->
		<?php endif; ?><!--/get_next_post() || get_previous_post()-->

		<?php if ( comments_open() || get_comments_number() ) : // If comments are open or we have at least one comment, load up the comment template.    ?>
		<div class="comments-template">
			<?php comments_template(); ?>
		</div>
		<?php endif; ?><!--/comments_open() || get_comments_number()-->

	</div><!--/blog-->
</div><!--/blogwrapper-->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
