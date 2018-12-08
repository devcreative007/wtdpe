<?php
/* 
 * Please note that trackback rdf must stay in comment for XHTML 
 * to work with HTML. Do not remove comment element.
 */
?>
<div class="metadata">
    <p class="author-link"><?php _e( 'Author: ', 'leslie' ); ?> <span><?php the_author() ?></span></p>   
    <p class="entry-date"><?php _e( 'Posted On: ', 'leslie' ); ?> <span><?php the_date(); ?> @ <?php the_time(); ?></span></p>
    
    <?php if( is_single() || is_category() || is_archive() || is_tag() ) { ?>
        <p class="linkcat"><?php _e( 'Filed under: ', 'leslie' ); ?><span> <?php the_category(',') ?> </span></p>
        <p><?php the_tags(); ?></p>
    <?php } ?>
    
    <p class="edit-link"><?php edit_post_link(__( 'Edit this', 'leslie' )); ?></p>
    <em><?php wp_link_pages(); ?></em>
</div><!-- <?php trackback_rdf(); ?> --> 