<?php
/**
 * Set up the default theme options
 *
 * @param string $name  The option name
 *
 * @since leslie 0.1
 */

function leslie_theme_options() {
    //delete_option( 'leslie_theme_options' );
    $default_theme_options = array (
       'link_color'   => '#033383',
       'soc_facebook' => '',
       'soc_twitter'  => '',
       'soc_linkedin' => '',
       'soc_gplus'    => '',
       'soc_email'    => '',
       'leslie_url'   => ''
        );
    return apply_filters( 'leslie_theme_options', $default_theme_options );
}

global $default_theme_options;

    // Register our new customizer settings and controls
function leslie_customize_register($wp_customize) {
    // Create string for options 
        $leslie_theme_options = leslie_theme_options();
    // Add a custom section into customizer
        $wp_customize->add_section( 'leslie_social', array(
            'title' => __( 'Social Media', 'leslie' ),
            'description' => __( 'Insert complete URL', 'leslie' ),
            'priority' => 35,
        ) );
    // facebook
        $wp_customize->add_setting('leslie_theme_options[soc_facebook]', array(
            'default' => $leslie_theme_options['soc_facebook'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
            'capability' => 'edit_theme_options',
 
        ) );
        $wp_customize->add_control('leslie_theme_options[soc_facebook]', array(
            'label' => __('Facebook', 'leslie'),
            'section' => 'leslie_social',
            'settings' => 'leslie_theme_options[soc_facebook]',
        ) );
    // twitter
        $wp_customize->add_setting('leslie_theme_options[soc_twitter]', array(
            'default' => $leslie_theme_options['soc_twitter'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
            'capability' => 'edit_theme_options',
 
        ) );
        $wp_customize->add_control('leslie_theme_options[soc_twitter]', array(
            'label' => __('Twitter', 'leslie'),
            'section' => 'leslie_social',
            'settings' => 'leslie_theme_options[soc_twitter]',
        ) );
    // linkedin
        $wp_customize->add_setting('leslie_theme_options[soc_linkedin]', array(
            'default' => $leslie_theme_options['soc_linkedin'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
            'capability' => 'edit_theme_options',
 
        ) );
        $wp_customize->add_control('leslie_theme_options[soc_linkedin]', array(
            'label' => __('LinkedIn', 'leslie'),
            'section' => 'leslie_social',
            'settings' => 'leslie_theme_options[soc_linkedin]',
        ) );
    // gplus
        $wp_customize->add_setting('leslie_theme_options[soc_gplus]', array(
            'default' => $leslie_theme_options['soc_gplus'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
            'capability' => 'edit_theme_options',
 
        ) );
        $wp_customize->add_control('leslie_theme_options[soc_gplus]', array(
            'label' => __('Google Plus', 'leslie'),
            'section' => 'leslie_social',
            'settings' => 'leslie_theme_options[soc_gplus]',
        ) );
    // email
        $wp_customize->add_setting('leslie_theme_options[soc_email]', array(
            'default' => $leslie_theme_options['soc_email'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
            'capability' => 'edit_theme_options',
 
        ) );
        $wp_customize->add_control('leslie_theme_options[soc_email]', array(
            'label' => __('Email', 'leslie'),
            'section' => 'leslie_social',
            'settings' => 'leslie_theme_options[soc_email]',
        ) );

        // color customizer
	        $wp_customize->add_setting( 'leslie_theme_options[link_color]', array(
			'default' => '#033888',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label' => __( 'Link Color', 'leslie' ),
			'section' => 'colors',
			'settings' => 'leslie_theme_options[link_color]',
		) ) );

            // Add a custom section into customizer
            $wp_customize->add_section( 'leslie_support', array(
                'title' => __( 'Leslie Theme Support', 'leslie' ),
                'description' => __( 'Support documents for this theme:', 'leslie' ),
                'priority' => 200,
            ) );
            // support link text
            $wp_customize->add_setting('leslie_theme_options[leslie_url]', array(
                'default' => $leslie_theme_options['leslie_url'],
                'sanitize_callback' => 'esc_url_raw',
             ) );
            $wp_customize->add_control('leslie_theme_options[leslie_url]', array(
                'label' => __('Support Site', 'leslie'),
                'description' => '<a target="_blank" title="opens in new window" href="http://themes.tradesouthwest.com/wordpress/leslie/">themes.tradesouthwest.com/wordpress/leslie/</a>',
                'section' => 'leslie_support',
                'type' => 'hidden',
                'settings' => 'leslie_theme_options[leslie_url]',
            ) );

    }
    add_action( 'customize_register', 'leslie_customize_register' );

    /**
     * Add a style block to the theme for title, post meta and link color.
     *
     * This function is attached to the 'wp_head' action hook.
     *
     * @since Jacqui 0.1
     */
    function leslie_custom_styles() {
        $leslie_theme_options = get_option( 'leslie_theme_options' );
            if (isset ( $leslie_theme_options['link_color'] ) ) { ?>
                <style>
                .post-meta a, .entry-content a, .widget a, .widget-container a, .site-title a, .header-wrap a, .header-wrap a:visited, .entry-title a, .profile-content a, #access a, table a { 
                    color: <?php echo esc_attr( $leslie_theme_options['link_color'] ); ?> !important; }
                </style>
        
    <?php 
        }
    } // end leslie custom styles
    add_action( 'wp_head', 'leslie_custom_styles' );
?>