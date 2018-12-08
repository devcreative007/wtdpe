<?php
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own override_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @package Override
 * @since Override 1.2.1.3
 */

if ( ! function_exists( 'override_comment' ) ) :

	function override_comment( $comment, $args, $depth ) {

		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
				<p><?php esc_html_e( 'Pingback:', 'override' ); ?> <?php comment_author_link(); ?>	
					<?php edit_comment_link( esc_html__( 'Edit', 'override' ),'<span class="edit-post-ico"><i class="fa fa-pencil-square"></i> ','</span>' ); ?>
				</p>
				<?php
				break;
			default :
				?>


				<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
				<?php if ( 'div' != $args['style'] ) : ?>
				<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
			<?php endif; ?>
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					} ?>
					<?php printf( __( '<span class="saywrap"><span class="fn">%s</span> <span class="says">says:</span></span>', 'override' ), get_comment_author_link() ) ?>
				</div>
				<?php if ( '0' == $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php echo esc_html_e( 'Your comment is awaiting moderation.', 'override' ) ?></em>

			<?php endif; ?>


				<?php comment_text(); ?>

				<div class="comment-meta commentmetadata"><i class="fa fa-calendar"></i><a class="commentlink"
																							href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>">

						<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'override' ), get_comment_date(), get_comment_time() ) ?></a><?php
					?>
				</div>
				
				<div class="postmetadata">
					<?php edit_comment_link( esc_html__( 'Edit', 'override' ),'<span class="edit-post-ico"><i class="fa fa-pencil-square"></i> ','</span>' ); ?>
				</div>
			

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					) ) ) ?>
				</div>
				<?php if ( 'div' != $args['style'] ) : ?>
				</div>
				<?php
			endif;
				break;
		endswitch;
		?>
		<?php
	}
endif;