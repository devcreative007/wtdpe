<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Override
 * @since Override 1.2.1.2
 */

?>
<?php
// Function_exists() Return TRUE if the given function has been defined.
// Code by BOUTROS ABICHEDID. Adding breadcrumb trail to the WordPress theme.
if ( function_exists( 'override_breadcrumb' ) ) {
	override_breadcrumb();
}
?>

<article>
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<div class="entry-content">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-img">
				<?php
				$get_desc    = get_post( get_post_thumbnail_id() )->post_content;
				$get_caption = get_post( get_post_thumbnail_id() )->post_excerpt;

				the_post_thumbnail();

				if ( ! empty( $get_desc ) && ! empty( $get_caption ) ) {// If caption and description exist show div.
					echo '<div class="featured-caption">' . esc_html( $get_desc ) . '<br />' . esc_html( $get_caption ) . '</div>';
				} elseif ( '' === $get_desc && '' !== $get_caption || '' === $get_caption && '' !== $get_desc ) {
					echo '<div class="featured-caption">' . esc_html( $get_desc ) . esc_html( $get_caption ) . '</div>';
				}
				?>
			</div><!--/featured-img-->
			<?php endif; ?><!--/has_post_thumbnail()-->

			<?php the_content(); ?>
			<?php if ( post_password_required() ) : ?>
				<div class="postmetadata">
				<span class="locked-ico"><i class="fa fa-lock"></i>
					<?php esc_html_e( 'Password required', 'override' ); ?>
				</span>
				</div><!--/postmetadata-->
			<?php endif; ?>

			<?php edit_post_link( esc_html__( 'Edit', 'override' ),'<div class="postmetadata"><span class="edit-post-ico"><i class="fa fa-pencil-square"></i> ','</span></div>' ); ?>

		</div><!--/entry-->
	</div><!--/post_class-->
</article>
<?php override_link_pages(); ?>

<?php if ( comments_open() ) : ?>

<div class="comments-template">
	<?php comments_template(); ?>
</div>
<?php endif; ?><!--/comments_open()-->
