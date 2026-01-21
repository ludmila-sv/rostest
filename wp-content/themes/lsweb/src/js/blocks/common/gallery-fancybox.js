( ( $ ) => {
	const galleryImg = lswebScriptData.galleryImg;

	if ( $( '.wp-block-gallery' ).length > 0 ) {
		let i = 0;
		$( '.wp-block-gallery' ).each( function() {
			i++;
			$( this ).find( 'figure a' ).each( function() {
				const caption = $( this ).siblings( 'figcaption' ).text();
				const alt = $( this ).find( 'img' ).attr( 'alt' ) ? $( this ).find( 'img' ).attr( 'alt' ) : galleryImg;
				$( this ).attr( 'data-fancybox', 'gallery' + i );
				$( this ).attr( 'data-caption', caption );
				$( this ).attr( 'aria-label', alt );
			} );
		} );

		$( '.wp-block-gallery figure a' ).each( function() {
			$( this ).append( '<span class="figure-zoom"></span>' );
		} );

		//$( document ).on( 'click', '.figure-zoom', function() {
		//	$( this ).siblings( 'a' ).trigger( 'click' );
		//} );

		$( '.wp-block-gallery a' ).fancybox( {
			// Options will go here
		} );
	}
} )( jQuery );
