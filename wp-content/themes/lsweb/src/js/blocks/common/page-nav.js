( function ( $ ) {
	if ( $( '.page-nav' ).length > 0 ) {
		$( '.page-nav .has-submenu > a' ).on( 'click', function ( e ) {
			e.preventDefault();
			$( this ).parent().toggleClass( 'open' );
		} );

		const $page = $( '.site-page__content' );
		const $pagenav = $( '.page-nav' );

		function fixPadding() {
			if ( $( window ).width() < 992 ) {
				const btnH = $( '.page-nav__btn' ).outerHeight();
				$page.css( 'padding-bottom', btnH + 'px' );
				const pageNavH = $pagenav.outerHeight();
				$page.css( 'padding-top', pageNavH + 'px' );
			} else {
				$page.css( 'padding-top', '' );
				$page.css( 'padding-bottom', '' );
			}
		}
		fixPadding();

		$( window ).on( 'resize', function () {
			fixPadding();
		} );
	}
} )( jQuery );
