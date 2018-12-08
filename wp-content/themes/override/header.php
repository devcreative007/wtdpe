<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="blogwrapper">
 *
 * @package Override
 * @since Override 1.0
 */

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<!--Support mobile devices-->
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php
	/**
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	?>
</head>
<body <?php body_class(); ?>>
<main role="main">
	<div id="wrapper"><!--wrapper start-->

		<div class="header-text-wrapper">

			<h1 id="site-title"><a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
									href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html( bloginfo( 'name' ) ); ?></a>
			</h1>

			<h2 class="site-description"><a
					href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html( bloginfo( 'description' ) ); ?></a>
			</h2>

		</div><!--/header-text-wrapper-->

		<!--Let's enable menu-->
		<nav role="navigation">

			<div class="nav-menu">
				<div class="menu-toggle"><p><?php esc_html_e( 'Menu', 'override' ); ?></p></div>

				<?php
				wp_nav_menu( array(
					'link_before'     => '<span class="minus"></span>',
					'theme_location'  => 'main-menu',
					'menu_class'      => 'nav',
					'container'       => 'div',
					'container_class' => 'nav',
				) );
				?>
				<div class="searchbox">
					<form method="get" id="navsearchform" role="search" action="<?php echo esc_url( home_url() ); ?>/">
						<input type="submit" value="">
						<input type="text" class="search" value="<?php echo get_search_query(); ?>" name="s"/>
					</form>
				</div>

			</div><!--/nav-menu-->
		</nav>
		<!--Let's enable our header picture-->
		<header role="banner">
			<div id="header"><?php if ( ! empty( get_header_image() ) ) {// Check if Header image exist.
					?>
					<img src="<?php esc_url( header_image() ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>"/>
				<?php } ?>
			</div><!--/#header-->
		</header>
