<?php
/**
 * Initialize preview on demo
 *
 * @author Themeisle
 * @package hestia
 * @version 1.1.2
 * @since 1.1.21
 */

/**
 * Check if it is demo preview
 *
 * @return bool
 */
function hestia_isprevdem() {
	global $wp_customize;
	$ti_theme         = wp_get_theme();
	$theme_name       = $ti_theme->get( 'TextDomain' );
	$active_theme     = hestia_get_raw_option( 'template' );
	$is_theme_preview = is_customize_preview() && ! $wp_customize->is_theme_active();

	return apply_filters( 'hestia_isprevdem', $active_theme != strtolower( $theme_name ) && $is_theme_preview );
}

/**
 * All options or a single option val
 *
 * @param string $opt_name Option name.
 *
 * @return bool|mixed
 */
function hestia_get_raw_option( $opt_name ) {
	$alloptions = wp_cache_get( 'alloptions', 'options' );
	$alloptions = maybe_unserialize( $alloptions );
	return isset( $alloptions[ $opt_name ] ) ? maybe_unserialize( $alloptions[ $opt_name ] ) : false;
}

/**
 * Load functions if we're on demo preview.
 */
if ( hestia_isprevdem() ) {
	load_template( get_template_directory() . '/demo-preview-images/prevdem-functions.php' );
}
