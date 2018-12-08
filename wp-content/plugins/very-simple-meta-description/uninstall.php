<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete options
delete_option( 'vsmd-setting' );
delete_option( 'vsmd-setting-1' );
delete_option( 'vsmd-setting-2' );
delete_option( 'vsmd-setting-3' );

// Deprecated options
delete_option( 'vsmd-setting-4' );
delete_option( 'vsmd-setting-5' );
delete_option( 'vsmd-setting-6' );

// For site options in Multisite
delete_site_option( 'vsmd-setting' );
delete_site_option( 'vsmd-setting-1' );
delete_site_option( 'vsmd-setting-2' );
delete_site_option( 'vsmd-setting-3' );

// Deprecated site options in Multisite
delete_site_option( 'vsmd-setting-4' );
delete_site_option( 'vsmd-setting-5' );
delete_site_option( 'vsmd-setting-6' );
