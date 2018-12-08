<?php 

/**
|------------------------------------------------------------------------------
| Generate custom style from theme option
|------------------------------------------------------------------------------
 */

function zimple_lite_custom_style() {
	?>
	<style type="text/css">

		/* Main Navigtiona  */
		
		#site-navigation {
			background: <?php echo esc_html( get_theme_mod('zimple_lite_style_primary_bg_color') ) ?>;
		}

		#site-navigation ul li:hover,
		#site-navigation ul li:hover > a,
		#site-navigation ul li.current-menu-parent > a,
		#site-navigation ul li.current-menu-ancestor > a,
		#site-navigation ul li.current_page_ancestor > a,
		#site-navigation ul li.current-menu-item > a {
			background: <?php echo esc_html( get_theme_mod('zimple_lite_style_primary_hover_active_bg_color') ) ?>;
		}
		

		/* Link color */
		a, .widget ul li a,
		.f-widget ul li a .site-footer .textwidget {
			color: <?php echo esc_html( get_theme_mod('zimple_lite_anchor_text_color') ) ?>;
		}

	</style>
	<?php
}
add_action('wp_head','zimple_lite_custom_style');