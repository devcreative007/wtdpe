<?php
/**
 * Register sidebars and widgetized areas.
 *
 * @package Override
 * @since Override 1.0
 */

	// Some simple code for our Main widget-enabled sidebar.
function override_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'override' ),
		'description'   => esc_html__( 'Appears as the sidebar on the rightside. This sidebar will be visible on smartphones and tablets.', 'override' ),
		'id'            => 'main',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	// Some simple code for our Secondary widget-enabled sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'override' ),
		'description'   => esc_html__( 'Appears as the sidebar on the leftside. This sidebar will be visible on smartphones and tablets.', 'override' ),
		'id'            => 'secondary',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	// Some simple code for our First Footer widget-enabled sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'override' ),
		'description'   => esc_html__( 'Appears as the first sidebar in footer. This sidebar will be visible on smartphones and tablets.', 'override' ),
		'id'            => 'footer-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	// Some simple code for our Second Footer widget-enabled sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 2', 'override' ),
		'description'   => esc_html__( 'Appears as the second sidebar in footer. This sidebar will be visible on smartphones and tablets', 'override' ),
		'id'            => 'footer-sidebar-two',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	// Some simple code for our Third Footer widget-enabled sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 3', 'override' ),
		'description'   => esc_html__( 'Appears as the third sidebar in footer. This sidebar will be visible on smartphones and tablets.', 'override' ),
		'id'            => 'footer-sidebar-three',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	// Some simple code for our Fourth Footer widget-enabled sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 4', 'override' ),
		'description'   => esc_html__( 'Appears as the fourth sidebar in footer. This sidebar will be visible on smartphones and tablets.', 'override' ),
		'id'            => 'footer-sidebar-four',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}
