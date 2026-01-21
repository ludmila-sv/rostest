( ( $ ) => {
	
'use strict';

class DisclosureNav {
	constructor( domNode ) {
		this.rootNode = domNode;
		this.useArrowKeys = true;
		this.topLevelNodes = this.rootNode.find( '> li > a' );
		this.buttonNodes = this.rootNode.find( '> li > a[aria-haspopup]' );
		this.linkNodes = this.rootNode.find( 'a[role="menuitem"]' );

		this.buttonNodes.on( 'click', ( e ) => this.onButtonClick( e ) );
		this.buttonNodes.on( 'keydown', ( e ) => this.onButtonKeyDown( e ) );

		this.linkNodes.on( 'keydown', ( e ) => this.onLinkKeyDown( e ) );

		this.rootNode.on( 'focusout', ( e ) => this.onBlur( e ) );
	}

	controlFocusByKey( keyboardEvent, nodeList, currentIndex ) {
		switch ( keyboardEvent.key ) {
			case 'ArrowUp':
			case 'ArrowLeft':
				keyboardEvent.preventDefault();
				if (currentIndex > -1) {
					var prevIndex = Math.max(0, currentIndex - 1);
					nodeList.eq( prevIndex ).focus();
				}
				break;
			case 'ArrowDown':
			case 'ArrowRight':
				keyboardEvent.preventDefault();
				if (currentIndex > -1) {
					var nextIndex = Math.min(nodeList.length - 1, currentIndex + 1);
					nodeList.eq( nextIndex ).focus();
				}
				break;
			case 'Home':
				keyboardEvent.preventDefault();
				nodeList.eq( 0 ).focus();
				break;
			case 'End':
				keyboardEvent.preventDefault();
				nodeList.eq( nodeList.length - 1 ).focus();
				break;
		}
	}

	onBlur( event ) {
		if ( this.rootNode.find( $( event.relatedTarget ) ).length < 1 ) {
			this.closeAll();
		}
	}

	onButtonClick( event ) {
		event.preventDefault();
		const button = $( event.currentTarget );
		const buttonExpanded = button.attr( 'aria-expanded' ) === 'true';
		this.toggleMenu( button, ! buttonExpanded );
	}

	onButtonKeyDown( event ) {
		const button = $( document.activeElement );
		console.log(button);

		if ( event.key === 'Escape' ) {
			this.toggleMenu( button, false );
		}

		else if ( event.key === 'Enter' || event.key === ' ' ) {
			event.preventDefault();
			this.toggleMenu( button, true );
		}
	}

	onLinkKeyDown( event ) {
		const menu = $( document.activeElement ).closest( 'ul ');
		const siblingLinks = menu.find( '> li > a[role="menuitem"]' );
		const targetLinkIndex = siblingLinks.index( $( document.activeElement ) );

		// Trap focus within the popup menu
		if ( ! menu.is( this.rootNode ) ) {
			if ( event.key === 'Tab' ) {
				const focusableElements = menu.find( '>li > a' );
				const firstFocusable = focusableElements.first();
				const lastFocusable = focusableElements.last();
			
				if ( event.shiftKey ) {
					// Shift+Tab: Move focus to the previous element
					if ( $( document.activeElement ).is( firstFocusable ) ) {
						event.preventDefault();
						lastFocusable.focus();
					}
				} else {
					// Tab: Move focus to the next element
					if ( $( document.activeElement ).is( lastFocusable ) ) {
						event.preventDefault();
						firstFocusable.focus();
					}
				}
			} else if ( event.key === 'Escape' ) {
				event.stopPropagation();
				const button = $( document.activeElement ).closest( 'ul' ).siblings( 'a[aria-haspopup]' );
				this.toggleMenu( button, false );
			}
		}

		// handle arrow key navigation between top-level buttons, if set
		if ( this.useArrowKeys ) {
			this.controlFocusByKey( event, siblingLinks, targetLinkIndex );
		}
	}

	closeAll() {
		const submenu = this.buttonNodes.siblings( 'ul ');
		if ( submenu ) {
			submenu.removeClass( 'open' );
			this.buttonNodes.attr( 'aria-expanded', 'false' );
		}
	}

	toggleMenu( domNode, show ) {
		if ( domNode ) {
			const menu = domNode.siblings( 'ul ');
			if ( menu ) {
				if ( show ) {
					menu.closest( 'li' ).addClass( 'open' );
					menu.attr( 'aria-hidden', 'false' ).prop( 'hidden', false);
					domNode.attr( 'aria-expanded', 'true' );
					menu.find( 'li' ).eq( 0 ).find( '> a[role="menuitem"]').eq( 0 ).focus();
				} else {
					menu.closest( 'li' ).removeClass( 'open' );
					menu.attr( 'aria-hidden', 'true' ).prop( 'hidden', true);
					domNode.attr( 'aria-expanded', 'false' );
					domNode.focus();
				}
			}
		}
	}
}

/* Initialize Disclosure Menus */
// new DisclosureNav( $( '#menu') );

    const menus = $( '.menu' );

    for ( var i = 0; i < menus.length; i++ ) {
      new DisclosureNav( menus.eq( i ) );
    }

} )( jQuery );