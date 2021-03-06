<?php
/**
 * The template used for displaying posts content in two-columns.php
 *
 * @package Override
 * @since Override 1.2.1.2
 */

?>

<article>
	<div class="entry-content">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"
		                           title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'override' ), the_title_attribute( 'echo=0' ) ) ); ?>"
		                           rel="bookmark"><?php the_title(); ?></a></h1>

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
		<?php endif; ?><!--/featured-img-->
		<?php the_content( esc_html__( 'Read more', 'override' ) ); ?>
		<?php if ( post_password_required() && ! current_user_can( 'manage_options' ) ) : ?>
			<div class="postmetadata">
				<span class="locked-ico"><i class="fa fa-lock"></i>
					<?php esc_html_e( 'Password required', 'override' ); ?>
				</span><!--/locked-ico-->
			</div><!--/postmetadata-->
		<?php elseif ( post_password_required() && current_user_can( 'manage_options' ) ) : ?>
			<div class="postmetadata">
				<span class="locked-ico"><i class="fa fa-lock"></i>
					<?php esc_html_e( 'Password required', 'override' ); ?>
				</span><!--/locked-ico-->   
					<?php edit_post_link( esc_html__( 'Edit', 'override' ),'<span class="edit-post-ico"><i class="fa fa-pencil-square"></i> ','</span>' ); ?>
			</div><!--/postmetadata-->
		<?php else : ?>
		<div class="postmetadata">
				<span class="filled-under-ico"><i class="fa fa-folder-open"></i>
					<?php esc_html_e( 'Filled  under&#58;', 'override' ); ?> <?php the_category( ', ' ); ?>
				</span><!--/filled-under-ico-->
				<span class="by-ico"><i class="fa fa-user"></i>
					<?php esc_html_e( 'By:', 'override' ); ?> <a
						href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
				</span><!--/by-ico-->
			<?php if ( has_tag() ) : ?>
			<span class="tag-ico"><i class="fa fa-tag"></i>
				<?php the_tags( esc_html__( 'Tags:&nbsp;', 'override' ), ', ', '<br />' ); ?>
				</span><!--/tag-ico-->
			<?php endif; ?><!--/has_tag()-->
				<span class="posted-on-ico"><i class="fa fa-calendar"></i>
					<?php esc_html_e( 'Posted on:&nbsp;', 'override' ); ?><a
						href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
				</span><!--/posted-on-ico-->
			<?php if ( comments_open() ) : ?>
				<span class="comments-ico"><i class="fa fa-comment"></i>
					<?php comments_popup_link( esc_html__( 'No Comments &#187;', 'override' ), esc_html__( '1 Comment &#187;', 'override' ), esc_html__( '% Comments &#187;', 'override' ) ); ?>
				</span><!--/comments-ico-->
			<?php else : ?>
			<span class="disabled-commnets-ico"><i class="fa fa-exclamation-circle"></i>
				<?php esc_html_e( 'Comments are disabled!', 'override' ); ?>
				</span><!--/disabled-commnets-ico-->
			<?php endif; ?><!--/comments_open()-->
				<?php edit_post_link( esc_html__( 'Edit', 'override' ),'<span class="edit-post-ico"><i class="fa fa-pencil-square"></i> ','</span>' ); ?>
		</div><!--/postmetadata-->

		<?php endif; ?><!--/post_password_required() && ! current_user_can( 'manage_options' )-->

	</div><!--/entry-->
</article>
</div><!--/post_class(opening div tag located in two-columns.php)-->

<?php override_link_pages(); ?>
