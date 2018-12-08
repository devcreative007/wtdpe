            </div><!-- ends row full page -->
        </div><!-- end main --><div class="clearfix"></div>
<footer class="row" id="footer">
    <div id="inner-footer">

        <div class="c4">
            <p class="pagination"><a href="#masthead" title="&uarr;"><?php _e('Top of Page', 'leslie'); ?></a></p>
                <?php get_template_part( 'content', 'social' ); ?><br>
                    <div class="credits">
                        <h5><?php _e('Copyright', 'leslie'); ?> &copy; <?php echo date("Y") ?> <a href="<?php esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h5>
                            <?php do_action( 'leslie_footer_credits' ); ?>
                    </div> <!-- ends credits -->
        </div>

            <div class="c4">
                <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
                <div id="sidebar-2">
                    <?php dynamic_sidebar( 'sidebar-2' ); ?>
                </div>
                <?php endif; ?>
            </div>

                <div class="c4">
                    <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
                    <div id="sidebar-3">
                        <?php dynamic_sidebar( 'sidebar-3' ); ?>
                    </div>
                    <?php endif; ?>
               </div>

    </div><!-- ends inner footer id -->
</footer>
    <?php wp_footer(); ?>
</body>
</html>