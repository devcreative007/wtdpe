<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ZimpleLite
 */
	if ( ! is_active_sidebar( 'zimple-lite-sidebar-right' ) ) {
		return;
	}
?>

<aside id="secondary" class="widget-area ewidget col-xs-12 col-sm-4 col-md-4 col-lg-4" role="complementary">
	<?php dynamic_sidebar( 'zimple-lite-sidebar-right' ); ?>
</aside><!-- #secondary -->
