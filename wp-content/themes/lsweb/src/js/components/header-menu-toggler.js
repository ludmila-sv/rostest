( ( $ ) => {
	// Toggle submenu
	$( '.header__toggler' ).on( 'click', function( event ) {
		event.preventDefault();

		if ( $( this ).attr( 'aria-expanded' ) === 'false' ) {
			$( this ).attr( 'aria-expanded', 'true' );
			$( 'body' ).addClass( 'menu-open' ); // this should go last
		} else {
			$( 'body' ).removeClass( 'menu-open' ); // this should go first
			$( this ).attr( 'aria-expanded', 'false' );
		}
	} );
} )( jQuery );
