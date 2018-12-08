<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
    
    <div id="sidebar">
        <?php dynamic_sidebar( 'sidebar' ); ?>
    </div>
    <?php else : ?> 

        <div id="sidebar">
            <ul>
                <?php the_widget( 'WP_Widget_Meta' ) ?> 
            </ul> 
        </div>    

<?php endif; ?><!-- ends sidebar -->