<ul class="social-block">
<?php  $options = get_option( 'leslie_theme_options' );  ?>

    <?php if( !empty ($options['soc_email']) ) { ?>    
    <li><img src="<?php echo get_template_directory_uri() . '/include/images/mail.png'; ?>" alt="<?php _e( 'Email: ', 'leslie' ); ?>" /> <span><?php _e( 'Email: ', 'leslie' ); ?></span> <a href="emailto:<?php echo esc_html( $options['soc_email'] ); ?>" title="<?php echo esc_html( $options['soc_email'] ); ?>"><?php echo esc_html( $options['soc_email'] ); ?></a></li>
    <?php } ?>
    
        <?php if( !empty ($options['soc_facebook']) ) { ?>       
        <li><img src="<?php echo get_template_directory_uri() . '/include/images/facebook.png'; ?>" alt="<?php _e( 'Facebook: ', 'leslie' ); ?>" /> <span><?php _e( 'Facebook: ', 'leslie' ); ?></span> <a href="<?php echo esc_url( $options['soc_facebook'] ); ?>" target="_blank"><?php echo esc_url( $options['soc_facebook'] ); ?></a></li>
        <?php } ?>
    
            <?php if( !empty ($options['soc_twitter']) ) { ?>           
            <li><img src="<?php echo get_template_directory_uri() . '/include/images/twitter.png'; ?>" alt="<?php _e( 'Twitter: ', 'leslie' ); ?>" /> <span><?php _e( 'Twitter: ', 'leslie' ); ?></span> <a href="<?php echo esc_url( $options['soc_twitter'] ); ?>" target="_blank"><?php echo esc_url( $options['soc_twitter'] ); ?></a></li>
            <?php } ?>
            
                <?php if( !empty ($options['soc_linkedin']) ) { ?>               
                <li><img src="<?php echo get_template_directory_uri() . '/include/images/linkedin.png'; ?>" alt="<?php _e( 'LinkedIn: ', 'leslie' ); ?>" /> <span><?php _e( 'LinkedIn: ', 'leslie' ); ?></span> <a href="<?php echo esc_url( $options['soc_linkedin'] ); ?>" target="_blank"><?php echo esc_url( $options['soc_linkedin'] ); ?></a></li>
                <?php } ?>
                
                    <?php if( !empty ($options['soc_gplus']) ) { ?>                   
                    <li><img src="<?php echo get_template_directory_uri() . '/include/images/google_plus.png'; ?>" alt="<?php _e( 'Google Plus: ', 'leslie' ); ?>" /> 
<span><?php _e( 'Google Plus: ', 'leslie' ); ?></span> <a href="<?php echo esc_url( $options['soc_gplus'] ); ?>" title="<?php echo esc_url( $options['soc_gplus'] ); ?>" target="_blank"><?php echo esc_url( $options['soc_gplus'] ); ?></a></li>
                    <?php } ?>
</ul>
<!-- ends social block -->