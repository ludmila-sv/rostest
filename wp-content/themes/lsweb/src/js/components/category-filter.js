( ( $ ) => {
	if ( $( '.category-filter' ).length > 0 ) {
		const chosen = $( '.category-filter__chosen' ).text();
		$( '.category-filter__list li' ).each( function() {
			if ( $( this ).find( 'a' ).text() === chosen ) {
				$( this ).addClass( 'selected' );
			}
		} );

		$( '.category-filter__chosen' ).on( 'click', function() {
			$( this ).parent().toggleClass( 'open' );
		} );

		$( '.blog-archive__controls__toggler' ).on( 'click', function() {
			$( this ).closest( '.blog-archive__controls' ).toggleClass( 'open-filter' );
		} );

	}
} )( jQuery );
