<?php
/*
 * content for custom post type "tsw-custom-profile"
 * @uses post_type
 * @uses normal loop with modified query to call custom post type
 * @theme leslie
 */
?>
    <div id="leslie-profile">
    
        <?php 
        $args = array( 'post_type' => 'custom_profile', 'posts_per_page' => 12 ); 
        $the_query = new WP_Query( $args ); 
        if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <article class="profile-container">
            
                <figure>
                <?php if( has_post_thumbnail() ) {
                      $attachment_page_url = '';
                      $attachment_page_url = get_attachment_link( get_post_thumbnail_id() ); ?>
                    <a class="featured-image" href="<?php echo $attachment_page_url; ?>"><?php the_post_thumbnail(); ?></a>
                    <?php } else { echo '<div class="no-thumb"></div>'; } ?>
                </figure>
                    <div class="profile-content">
                        <h2 class="profile-title"><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                    </div>
                    
            </article>

            <?php endwhile; wp_reset_postdata(); ?>	
                
                <?php else : ?>
                <div class="widget-container">
                    <ul>
                        <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?> 
                    </ul> 
                </div><!-- ends widget container -->
                    
        <?php endif; ?>	
    </div>