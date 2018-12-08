<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php else : ?> 
        <ul>
            <?php the_widget( 'WP_Widget_Meta' ) ?> 
        </ul> 
<?php endif; ?>