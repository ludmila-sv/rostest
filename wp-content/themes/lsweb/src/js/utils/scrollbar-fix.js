/**
 * This script sets a variable with a value equal to the scrollbar width
 * to calculate margins for the Full-width block, 
 * as the scrollbarwidth is included in vw.
 */
document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px");

window.addEventListener( 'resize', function() {
	document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px");
}, true );
