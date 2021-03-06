<?php
/**
 * Callback Functions
 *
 * @package ZimpleLite
 */

 
/**
 * Adds a callback function to retrieve wether post content is set to excerpt or not
 *
 * @param object $control / Instance of the Customizer Control 
 * @return bool
 */
function zimple_lite_control_post_content_callback( $control ) {

	// Check if excerpt mode is selected
	if ( $control->manager->get_setting('zimple_lite_theme_options[post_content]')->value() == 'excerpt' ) :
		return true;
	else :
		return false;
	endif;
	
}