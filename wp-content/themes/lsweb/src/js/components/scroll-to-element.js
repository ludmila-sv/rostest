( ( $ ) => {
	function scrollToElement( $target ) {
		if ( $target.length ) {
			let scroll = $target.offset().top - 30;

			if ( $( '.page-nav' ).length ) {
				scroll -= $( '.page-nav' ).outerHeight();
			}

			if ( $( '.header' ).length ) {
				//scroll -= $( '.header' ).outerHeight();
			}
			if ( scroll < 0 ) {
				scroll = 0;
			}

			$( 'html, body' ).animate(
				{
					scrollTop: scroll,
				},
				1000
			);
		}
	}

	function initScrollToElement() {
		$( 'a.scroll-to' ).on( 'click', function ( event ) {
			const href = $( this ).attr( 'href' );
			if ( href && href.indexOf( '#' ) === 0 && href.length > 1 ) {
				const $target = $( href );

				if ( $target.length ) {
					event.preventDefault();
					scrollToElement( $target );
				}
			}
		} );

		// TODO uncomment if you need this functionality.
		// jQuery( window ).on( 'hashchange load', function() {
		// 	if ( window.location.hash ) {
		// 		const $el = $( window.location.hash );
		// 		if ( $el.length ) {
		// 			scrollToElement( $el );
		// 		}
		// 	}
		// } );
	}

	initScrollToElement();
} )( jQuery );
