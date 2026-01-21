( ( $ ) => {
	const loading = lswebScriptData.loading;
	const stopVideo = lswebScriptData.stopVideo;
	const listMediaBtn = $( '[data-play-video]' );

	listMediaBtn.on( 'click', function( event ) {
		event.preventDefault();

		if ( ! $( this ).prop( 'disabled' ) ) {
			$( this ).prop( 'disabled', true ).addClass( 'playing-video' );

			const videoSrc = $( this ).siblings( '.hidden' ).find( 'span' ).text();
			const video =
				'<iframe src="' +
				videoSrc +
				'" frameborder="0" allowfullscreen allow="accelerometer; autoplay;"></iframe>';

			const htmlH = $( window ).scrollTop();
			let y = htmlH + 60;

			$( 'body' ).append( '<div id="cover"></div>' );
			$( 'body' ).append( '<div id="popup-video-simple" class="video-popup"></div>' );
			$( '#popup-video-simple' ).append( '<div id="iframe-wrapper" class="video-popup__iframe-wrapper" data-content="' + loading + '"></div>' );
			$( '#iframe-wrapper' ).append( video );
			$( '#iframe-wrapper' ).append( '<div id="video-close" class="video-popup__close" role="button" tabindex="0" aria-label="' + stopVideo + '"></div>' );

			$( '#popup-video-simple' ).css( 'top', y );

			// Execute code after the append operation is complete
			$( 'body' ).promise().done( function() {
				$( '#video-close' ).trigger( 'focus' );
			} );
		}
	} );

	function videoPopupClose( playBtn ) {
		$( '#popup-video-simple' ).remove();
		$( '#cover' ).remove();
		playBtn.trigger( 'focus' );
		playBtn.removeProp( 'disabled' ).removeClass( 'playing-video' );
		return false;
	}

	$( document ).on( 'click.popup-simple', '#video-close', function() {
		const playBtn = $( '.playing-video' );
		videoPopupClose( playBtn );
	} );

	$( document ).on( 'click.popup-simple', function( event ) {
		if ( $( '#popup-video-simple' ).length ) {
			if ( $( event.target ).closest( '#iframe-wrapper' ).length || $( event.target ).closest( '[data-play-video]' ).length ) {
				return;
			}
			const playBtn = $( '.playing-video' );
			videoPopupClose( playBtn );
		}
	} );

} )( jQuery );
