<div class="grid">
    <div id="nocomments">
        <?php if ( post_password_required() ) : ?>
            <p class="nopassword"><?php _e( 'This article is protect by password. Insert password to view comments.', 'leslie' ); ?></p>
    </div><!-- ends nocomments -->
    <?php return; endif; ?>

    <div id="comments">
    <?php  if ( have_comments() ) : ?>

            <h5 id="comments-title" class="c12">
                <?php printf( _n( '1 thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'leslie' ),
                        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
            </h5>
 
            <ol class="commentlist">
                <?php wp_list_comments() ?>
            </ol><!-- .commentlist -->
 
              <p class="comment-links"><?php previous_comments_link() ?> <span><?php next_comments_link() ?></span></p>
 

    <?php endif; ?>
    </div><!-- #comments -->
        <?php if ( comments_open() ) : ?> <?php comment_form(); ?> <?php endif; ?>
</div><!-- ends comments area -->
