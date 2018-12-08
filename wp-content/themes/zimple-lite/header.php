<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ZimpleLite
 */

$theme_options = zimple_lite_theme_options();

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'zimple-lite' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="header-section">
			<div class="site-headline inner clearfix">
				<div class="col-lg-12">
					<?php if ( has_nav_menu( 'zimple-lite-top' ) ) : ?>
						<div class="smenu top-nav primary-navigation default-menu clearfix"> <!-- Top MENU -->
							<a class="toggle-mobile-menu" href="#" title="Menu"><?php esc_html_e( 'Main Navigation', 'zimple-lite' ); ?> <i class="fa fa-bars"></i></a>
							<?php wp_nav_menu( array('theme_location' => 'zimple-lite-top', 'container' => false, 'menu_class' => 'menu nav clearfix') ); ?>
						</div><!-- ./Top MENU -->
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="inner clearfix">
			<div class="inner-header">
				<!-- Logo -->
				<?php zimple_lite_header_title() ?>

				<!-- Header Ads -->
				<?php 
					if ( is_active_sidebar( 'zimple-lite-header-banner' )) {
					?>
						<div class="ads-728x90 ads-top col-xs-8 col-sm-12 col-md-12 col-lg-8">
							<?php dynamic_sidebar( 'zimple-lite-header-banner' ); ?>
						</div>
					
					<?php
					}
				?>

			</div>
		</div>

		<nav <?php if ( 1 == $theme_options['sticky_header'] ) : ?>id="sticky"<?php endif; ?> class="secondary-navigation default-menu navbar navbar-default" role="navigation"> 
			<div class="main-menu inner">
				<div class="navbar-header"> 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
						<span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'zimple-lite' ); ?></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand" href="#"><?php esc_html_e( 'Menu', 'zimple-lite' ); ?></a>
				</div>

				<?php if ( has_nav_menu( 'zimple-lite-primary' ) ) : ?>
					<div class="collapse navbar-collapse navbar-ex1-collapse"> 

						<?php wp_nav_menu( array('theme_location' => 'zimple-lite-primary', 'container' => false, 'menu_class' => 'menu nav navbar-nav') ); ?>
					</div>
				<?php else : ?>
					<div class="collapse navbar-collapse navbar-ex1-collapse"> 
						<?php wp_nav_menu( array('theme_location' => 'zimple-lite-primary', 'container' => false, 'menu_id' => 'main-menu-nav',  'menu_class' => 'menu nav navbar-nav') ); ?>
					</div>
				<?php endif; ?>
			</div>
		</nav>
		<div id="catcher" ></div>
	</header><!-- #masthead -->

	<?php
		if ( is_home() && 1 == $theme_options['enable_slide'] ) {
			get_template_part( 'template-parts/content', 'slide' ); 
		}
	?>

	<div id="content" class="site-content inner">