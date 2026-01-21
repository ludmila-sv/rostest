( ( $ ) => {
	if ( $( '[data-accordion]' ).length > 0 ) {
		const accordionTogglers = $( '[data-accordion]' ).find( '[role="button"]' );

		accordionTogglers.on( 'click', function() {
			toggleAccordion( $( this ) );
			return false;
		} );

		accordionTogglers.on( 'keydown', function(e) {
			if ( e.key === ' ' || e.key === 'Enter' ) {
				toggleAccordion( $( this ) );
				return false;
			}
			return true;
		} );

		function toggleAccordion( el ) {
			const accordion = el.closest( '[data-accordion]' );
			const accordionItems = accordion.find( '[data-accordion-item]' );
			const thisItem = el.parent();

			if ( thisItem.hasClass( 'accordion-open') ) {
				thisItem.removeClass( 'accordion-open' );
				thisItem.find( '[role="button"]' ).attr( 'aria-expanded', 'false' );
				thisItem.find( '[role="region"]' ).attr( 'aria-hidden', 'true' );
			} else {				
				thisItem.addClass( 'accordion-open' );
				thisItem.find( '[role="button"]' ).attr( 'aria-expanded', 'true' );
				thisItem.find( '[role="region"]' ).attr( 'aria-hidden', 'false' );
			}

			/*
			setTimeout(function() {
				const scroll = thisItem.offset().top - 30;

				$( 'html, body' ).animate( { scrollTop: scroll, }, 'fast' );
			}, 350);
			*/
			
		}

		// Enable arrow navigation between accordion titles
		$( '[data-accordion]' ).each( function() {
			let btnFocus = 0;
			const btns = $( this ).find( '[role="button"]' );

			btns.on( 'keydown', function(e) {
				if ( e.key === 'ArrowDown' || e.key === 'ArrowUp' ) {
					// btns.eq( btnFocus ).attr( 'tabindex', '-1' );

					if (e.key === "ArrowDown") {
						btnFocus++;
						if ( btnFocus >= btns.length ) {
							btnFocus = 0;
						}

					} else if (e.key === 'ArrowUp' ) {
						btnFocus--;
						if ( btnFocus < 0 ) {
							btnFocus = btns.length - 1;
						}
					}
			
					// btns.eq( btnFocus ).attr( 'tabindex', '0' );
					btns.eq( btnFocus ).focus();
				}
			} );
		} );

		accordionTogglers.on( 'focusin', function(e) {
			$( this ).addClass( 'focused' );
			return true;
		} )
		.on( 'focusout', function(e) {
			$( this ).removeClass( 'focused' );
			return true;
		} );
	}
} )( jQuery );
