( ( $ ) => {

	// Slider that plays on desktop only.

	let sliderOn = false;

	function slickJsSlider() {
		if ( $( '.slickjs' ).length > 0 ) {

			if ( $( document ).width() > 991 ) {
				if ( ! sliderOn ) {
					$( '.slickjs' ).slick( {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: false,
						dots: true,
						appendDots: $( '.slick-controls' ),
						arrows: false,
						autoplay: false,
						adaptiveHeight: true,
						responsive: [
							{
								breakpoint: 992,
								settings: {
									slidesToShow: 1,
								},
							},
							/*{
								breakpoint: 768,
								settings: 'unslick',
							},*/
						],
					} );
					sliderOn = true;
				}
			} else if ( sliderOn ) {
					setTimeout( unslickSliders, 700 );
					sliderOn = false;
				}
		}
	}

	function unslickSliders() {
		$( '.slickjs' ).slick( 'unslick' );
	}

	slickJsSlider();

	$( window ).on( 'resize', function () {
		slickJsSlider();
	} );

	// Simple slider that plays both on mobile and desktop.
	if ( $( '.slick-slider-js' ).length > 0 ) {
		$( '.slick-slider-js' ).each( function() {
			const prev = $( this ).closest( '.slider' ).find( '.slick-controls' ).find( '.slick-prev ');
			const next = $( this ).closest( '.slider' ).find( '.slick-controls' ).find( '.slick-next ');

			$( this ).on( 'init', function( event, slick ){
				$( this ).closest( '.slider' ).find( '.slick-controls' ).removeClass( 'd-none' );
			} );

			$( this ).slick( {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				dots: false,
				arrows: true,
				autoplay: false,
				prevArrow: prev,
				nextArrow: next,
			} );
		} );
	}
} )( jQuery );
