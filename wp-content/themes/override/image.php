<?php
/**
 * Template for displaying image attachments
 *
 * @package Override
 * @since Override 1.2.0
 */

get_header();
?>


<div id="blogwrapper">

	<div id="blog">

		<!--Get the Main-Loop-->
		<div class="entry-content">
			<?php while ( have_posts() ) : the_post(); ?>

				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php
							$metadata = wp_get_attachment_metadata();
							printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'override' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( wp_get_attachment_url() ),
								absint( $metadata['width'] ),
								absint( $metadata['height'] ),
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);
							?>

						</div><!--/entry-meta-->


					</header><!--/entry-header-->

					<div class="entry">


						<div class="attachment">
							<?php
							/**
							 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
							 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
							 */
							$attachments = array_values( get_children( array(
								'post_parent'    => $post->post_parent,
								'post_status'    => 'inherit',
								'post_type'      => 'attachment',
								'post_mime_type' => 'image',
								'order'          => 'ASC',
								'orderby'        => 'menu_order ID',
							) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID ) {
									break;
								}
							}
							$k++;
							// If there is more than 1 attachment in a gallery.
							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) ) {
									// Get the URL of the next image attachment.
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								} else {
									// Or get the URL of the first image attachment.
									$next_attachment_url = get_attachment_link( $attachments[0]->ID );
								}
							} else {
								// Or, if there's only 1 image, get the URL of the image.
								$next_attachment_url = wp_get_attachment_url();
							}
							?>

							<a href="<?php echo esc_url( $next_attachment_url ); ?>"
							   title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'override_attachment_size', array(
									1200,
									1200,
								) ); // Filterable image size.
								echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>
						</div><!--/attachment-->


						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!--/entry-caption-->

						<?php endif; ?>


						<?php the_content(); ?>
						<?php wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'override' ),
							'after'  => '</div>',
						) ); ?>

					</div><!--/entry-->

					<footer class="entry-meta">

						<?php edit_post_link( esc_html__( 'Edit', 'override' ),'<div class="postmetadata"><span class="edit-post-ico"><i class="fa fa-pencil-square"></i> ','</span></div>' ); ?>

					</footer><!--/entry-meta-->

				</div><!-- #post-<?php the_ID(); ?> -->


			<?php endwhile; // End of the loop. ?>

		</div><!--/entry-->

		<nav class="attachment-navigation">
			<span
				class="prev-image"><?php previous_image_link( false, esc_html__( '&lsaquo; Previous', 'override' ) ); ?></span>
			<span
				class="next-image"><?php next_image_link( false, esc_html__( 'Next &rsaquo;', 'override' ) ); ?></span>
		</nav><!--/attachment-navigation-->

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
