<?php
/*
 * content part that shows in archive, tags, excerpts pages, etc for this theme.
 * @theme leslie 
*/
if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="c12" id="category-page">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        </header>
            <div class="entry">
                <?php the_excerpt(''); ?>
            </div>
                <?php get_template_part( 'metadata' ); ?>
               
    </div><!-- ends post id -->
</div>
<?php endwhile; ?>
    <p class="navigation">
        <?php posts_nav_link(); ?>
    </p>
    <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
    </div>

<?php endif; ?>

