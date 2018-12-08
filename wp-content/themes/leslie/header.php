<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <header class="row" id="masthead">

        <figure class="c4" id="logo" role="banner">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>  &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" /></a>
        </figure> 

            <div class="c8" id="hgroup">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url() ); ?>/"><?php bloginfo('name'); ?></a></h1> 
                <h2 class="site-description"><?php bloginfo('description'); ?></h2>
            </div>

    </header><!-- ends header -->

        <div id="main">

            <div class="row" id="full-page">