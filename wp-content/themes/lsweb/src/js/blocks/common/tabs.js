( ( $ ) => {
	if ( $( '[data-tabs]' ).length > 0 ) {
		let hashes = [];

		// For tabs2: populate tans nav.
		$( '[data-tabs-gb]' ).each( function() {
			$( this )
				.find( '.tab' )
				.each( function() {
					const title = $( this ).data( 'title' );
					const tabId = $( this ).attr( 'id' );

					$( this ).attr( 'aria-labelledby', 'tab-btn-' + tabId );
					$( this )
						.closest( '.tabs' )
						.find( '.tabs__nav' )
						.find( 'ul' )
						.append(
							'<li role="none"><a class="tab-link" href="#' + tabId + '" role="tab" aria-controls="' + tabId + '" id="tab-btn-' + tabId + '" aria-selected="false" tabindex="-1">' + title + '</a></li>'
						);
					hashes.push( '#' + tabId );
				} );
		} );

		$( document ).on( 'click', '[role="tab"]', function( event ) {
			event.preventDefault();

			$( this ).closest( '[role="tablist"]' ).find( 'li' ).each( function() {
				$( this ).removeClass( 'active' );
			} );

			$( this ).parent().addClass( 'active' );

			$( this ).closest( '[role="tablist"]' ).find( '[role="tab"]' ).each( function() {
				$( this ).attr( 'aria-selected', 'false').attr( 'tabindex', '-1');
			} );

			$( this ).attr( 'aria-selected', 'true').attr( 'tabindex', '0');

			const href = $( this ).attr( 'href' );
			const hash = href.substr( href.indexOf( '#' ) );

			$( this ).closest( '[data-tabs]' ).find( '[role="tabpanel"]' ).each( function() {
					$( this ).fadeOut().prop( 'hidden', true );
				} );
			$( href ).fadeIn().prop( 'hidden', false );

			/*if ( window.history.pushState ) {
				window.history.pushState( null, null, hash );
			} else {
				window.location.hash = hash;
			}*/
		} );

		const initialHash = window.location.hash;
		if ( initialHash && ! initialHash.match( /\// ) && hashes.indexOf( initialHash ) !== -1 ) {
			$( '[role="tablist"] a[href="' + initialHash + '"]' ).eq( 0 ).trigger( 'click' );
		} else {
			$( '[role="tablist"] a' ).eq( 0 ).trigger( 'click' );
		}

		// Enable arrow navigation between tabs in the tab list
		$( '[data-tabs]' ).each( function() {
			let tabFocus = 0;
			const tabList = $( this ).find( '[role="tablist"]' );
			const tabs = tabList.find( '[role="tab"]' );

			tabList.on( 'keydown', function(e) {
				// Move right
				if ( e.key === 'ArrowRight' || e.key === 'ArrowLeft' ) {
					tabs.eq( tabFocus ).attr( 'tabindex', '-1' );

					if (e.key === "ArrowRight") {
						tabFocus++;
						// If we're at the end, go to the start
						if ( tabFocus >= tabs.length ) {
							tabFocus = 0;
						}

						// Move left
					} else if (e.key === 'ArrowLeft' ) {
						tabFocus--;
						// If we're at the start, move to the end
						if ( tabFocus < 0 ) {
							tabFocus = tabs.length - 1;
						}
					}
			
					tabs.eq( tabFocus ).attr( 'tabindex', '0' );
					tabs.eq( tabFocus ).focus();
				}
			} );
		} );
	}
} )( jQuery );
