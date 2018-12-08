<?php
if ( is_active_sidebar( 'zimple-lite-footer-one' )
|| is_active_sidebar( 'zimple-lite-footer-two' )
|| is_active_sidebar( 'zimple-lite-footer-three' ) ) : ?>

    <div class="footer-widget fwidget clearfix">
        <?php if ( is_active_sidebar( 'zimple-lite-footer-one' )) : ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <?php dynamic_sidebar( 'zimple-lite-footer-one' ); ?>
            </div>
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'zimple-lite-footer-two' )) : ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <?php dynamic_sidebar( 'zimple-lite-footer-two' ); ?>
            </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'zimple-lite-footer-three' )) : ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <?php dynamic_sidebar( 'zimple-lite-footer-three' ); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>