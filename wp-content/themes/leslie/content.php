<?php
/*
 * content and loop
 * @theme leslie
 */
if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="c12 content-container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        </header>
            <div class="entry">
                <figure>
                <?php if ( has_post_thumbnail() ) {
                  the_post_thumbnail();
                  } else {
                  echo '<div class="no-thumb"></div>';
                  } ?>
                </figure>

                    <?php the_content(''); ?>

            </div>
                <?php get_template_part( 'metadata' ); ?>

                        <div class="clearfix"><br></div>
                            <?php comments_template(); ?>
    </article><!-- ends post id -->
</div>

<?php endwhile; ?>

    <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
