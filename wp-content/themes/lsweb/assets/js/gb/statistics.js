import { CountUp } from '../libraries/countup/countUp.min.js';
	
if ( document.querySelectorAll( '.statistics__item__num' ).length > 0 ) {
	document.querySelectorAll( '.statistics__item__num' ).forEach( ( item ) => {
		const num = +item.textContent;
		const duration = num / 100 > 2 ? num / 100 : 2;

		const options = {
			duration : duration,
			separator: '',
			enableScrollSpy: true,
		}
		const counter = new CountUp( item, num, options );
		if ( ! counter.error ) {
			counter.start();
		} else {
			console.error( counter.error );
		}
	} );
}

