( ( $ ) => {

	// Slider that plays on mobile only.

	const mobileSliders = $( '[data-mob-slider]' );
	const args = {
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: false,
		dots: false,
		arrows: false,
		autoplay: false,
		// adaptiveHeight: true,
	};

	$( window ).on( 'load resize', function () {
		if ( $( window ).width() < 992 ) {
			mobileSliders.not( '.slick-initialized' ).slick( args );
		} else if ( mobileSliders.hasClass( 'slick-initialized') ) {
			mobileSliders.slick( 'unslick' );
		}
	});

} )( jQuery );
