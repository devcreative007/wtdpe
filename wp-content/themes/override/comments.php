<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to override_comment() which is
 * located in the functions.php file.
 *
 * @package Override
 * @since Override 1.2.0
 */

/**
 * This File is used to output comments fields it work's side by side with our custom callback function located
 * inside /inc/comment-form.php
 * READ: http://codex.wordpress.org/Function_Reference/wp_list_comments
 *       http://codex.wordpress.org/Function_Reference/comment_form
 */


/**
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {

	return;
}

?>


<?php

$commenter     = wp_get_current_commenter();
$req           = get_option( 'require_name_email' );
$aria_req      = ( $req ? " aria-required='true'" : '' );
$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'override' ), '<span class="required">*</span>' );
$args          = array(
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'title_reply'          => esc_html__( 'Leave a Reply', 'override' ),
	'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'override' ),
	'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'override' ),
	'label_submit'         => esc_html__( 'Post Comment', 'override' ),
	'comment_field'        => '<p class="comment-form-comment"><label class="comment-post" for="comment">' . _x( 'Comment post', 'noun', 'override' ) . '</label><textarea id="comment" name="comment" cols="45" aria-required="true" rows="8"></textarea></p>',
	'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'override' ), wp_login_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) ) ) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'override' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) ) ) . '</p>',
	'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'override' ) . ( $req ? $required_text : '' ) . '</p>',
	'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'override' ), '<code>' . allowed_tags() . '</code>' ) . '</p>',
	'fields'               => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="comment-text-wrapper"><p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'override' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input class="author" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . ' " size="30" ' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'override' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input class="email" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'override' ) . '</label>' . '<input id="url" class="website" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>',
	) ),
);

?>

<?php comment_form( $args ); ?>
<ol class="commentlist">
	<?php wp_list_comments( 'type=all&callback=override_comment&avatar_size=60' ); ?>
</ol>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?><!--Lets's check if there are any commnets if there are then we will show our div-->
	<div class="paginate-com">
		<?php paginate_comments_links(
			array(
				'prev_text' => esc_html__( '&lsaquo; Previous', 'override' ),
				'next_text' => esc_html__( 'Next &rsaquo;', 'override' ),
				'end_size'  => 1,
				'mid_size'  => 1,
			)
		); ?>
	</div>
<?php endif; ?>
