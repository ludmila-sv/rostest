//import { unregisterBlockStyle } from '@wordpress/blocks';
//import domReady from '@wordpress/dom-ready';

wp.domReady(function() {
	wp.blocks.unregisterBlockStyle( 'core/quote', 'plain' );
});