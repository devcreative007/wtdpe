( function( $ ) {
	// Responsive videos
	var all_videos = $( '.entry-content' ).find( 'iframe[src*="player.vimeo.com"], iframe[src*="youtube.com"], iframe[src*="dailymotion.com"],iframe[src*="kickstarter.com"][src*="video.html"], object, embed' );

	all_videos.each( function() {
		var video = $(this),
			aspect_ratio = video.attr( 'height' ) / video.attr( 'width' );

		video
			.removeAttr( 'height' )
			.removeAttr( 'width' );

		if ( ! video.parents( 'object' ).length )
			video.wrap( '<div class="responsive-video-wrapper" style="padding-top: ' + ( aspect_ratio * 100 ) + '%" />' );
	} );

	// Image anchor
	$( 'a:has(img)' ).addClass('image-anchor');

	$( 'a[href="#"]' ).click( function(e) {
		e.preventDefault();
	});
} )( jQuery );