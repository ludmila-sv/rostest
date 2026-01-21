( ( $ ) => {
	const loading = lswebScriptData.loading;
	const stopVideo = lswebScriptData.stopVideo;
	const videoPlayBtn = $( '[data-video-play]' );

	videoPlayBtn.each( function() {
		$( this ).on( 'click', function( event ) {
			event.preventDefault();

			if ( ! $( this ).prop( 'disabled' ) ) {
				if ( 'popup' === $( this ).attr('data-video-play') ) {
					$( this ).prop( 'disabled', true ).addClass( 'playing' );
				}

				// 1. Create Video to append (either <video> or <iframe>).
				let videoSrc = $( this ).attr( 'href' );
				let video = '';
				let vkVideoClip = false;
				let vkVideoVideo = false;

				if ( videoSrc === '#' ) {
					// 1.1. Video uploaded to WP.
					$( this ).closest( '[data-video-wrapper]' )
						.find( '[data-wp-video-source]' )
						.each( function() {
							video +=
								'<source src="' +
								$( this ).attr( 'data-src' ) +
								'" type="' +
								$( this ).attr( 'data-type' ) +
								'" >';
						} );
					video = '<video controls autoplay loop>' + video + '</video>';
				} else {
					// 1.2. External Video.

					// 1.2.0 Iframe
					if ( videoSrc.indexOf( 'iframe' ) > 0 ) {
						const videoFake = $( this ).closest( '[data-video-wrapper]' ).find( '[data-video-iframe]' ).html();
						video = videoFake.replace( /div/g, 'iframe' ).replace( 'data-src', 'src' );
					}

					// 1.2.1 Youtube & Vimeo
					if ( videoSrc.indexOf( 'youtu' ) > 0 ) {
						videoSrc =
							`https://www.youtube.com/embed/` +
							youTubeGetID( videoSrc ) +
							'?autoplay=1&rel=0&wmode=opaque';
						video = '<iframe src="' + videoSrc + '" frameborder="0" allowfullscreen allow="accelerometer; autoplay;"></iframe>';
					}
					if ( videoSrc.indexOf( 'vimeo' ) > 0 ) {
						videoSrc =
							`https://player.vimeo.com/video/` +
							getVimeoId( videoSrc );
						video = '<iframe src="' + videoSrc + '" frameborder="0" allowfullscreen allow="accelerometer; autoplay;"></iframe>';
					}

					// 1.2.2. VK Video
					if ( videoSrc.indexOf( 'vkvideo' ) > 0 ) {
						const vkOid = getVKOid( videoSrc );
						const vkId = getVKId( videoSrc );

						video = '<iframe src="https://vkvideo.ru/video_ext.php?oid=' + vkOid + '&id=' + vkId + '&hd=2&autoplay=1" width="325" height="646" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>';
					}
					// For popup - popup's proportions depend on whether it is clip (shorts) or video. (For the inline video proportions are determined by the video poster.)
					if ( videoSrc.indexOf( 'vkvideo.ru/clip' ) > 0 ) {
						vkVideoClip = true;
					}
					if ( videoSrc.indexOf( 'vkvideo.ru/video' ) > 0 ) {
						vkVideoVideo = true;
					}

					// 1.2.3. Rutube
					if ( videoSrc.indexOf( 'rutube' ) > 0 ) {
						const rtId = getRTid( videoSrc );
						const rtP = getRTp( videoSrc );
						const rtSrc = rtP ? rtId + '/?p=' + rtP + '&autoplay=true' : rtId + '/?autoplay=true';

						video = '<iframe src="https://rutube.ru/play/embed/' + rtSrc + '" style="border: none;" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
					}
				}

				// 2. Append Video (either inline or popup).

				if ( 'inline' === $( this ).attr( 'data-video-play') ) {
					const videoWrapper = $( this ).closest( '[data-video-wrapper]' );
					videoWrapper.append( '<div class="video__iframe-wrapper" data-content="' + loading + '"></div>' );
					videoWrapper.find( '.video__iframe-wrapper' ).append( video );

				} else {
					const htmlH = $( window ).scrollTop();
					let y = htmlH + 60;

					if ( vkVideoClip ) {
						$( 'body' ).append( '<div id="cover"></div>' );
						$( 'body' ).append( '<div id="video-popup" class="video-vk__popup"></div>' );
						$( '#video-popup' ).append( '<div id="iframe-wrapper" class="video-vk__popup__iframe" data-content="' + loading + '"></div>' );
						$( '#iframe-wrapper' ).append( video );
						$( '#iframe-wrapper' ).append( '<div id="video-close" class="video-vk__popup__close" role="button" tabindex="0" aria-label="' + stopVideo + '"></div>' );
						y = htmlH + 20;
					} else if ( vkVideoVideo ) {
						$( 'body' ).append( '<div id="cover"></div>' );
						$( 'body' ).append( '<div id="video-popup" class="video-vk__popup"></div>' );
						$( '#video-popup' ).append( '<div id="iframe-wrapper" class="video-vk__popup__iframe video-vk__popup__iframe--hor" data-content="' + loading + '"></div>' );
						$( '#iframe-wrapper' ).append( video );
						$( '#iframe-wrapper' ).append( '<div id="video-close" class="video-vk__popup__close" role="button" tabindex="0" aria-label="' + stopVideo + '"></div>' );
						y = htmlH + 60;
					} else {
						$( 'body' ).append( '<div id="cover"></div>' );
						$( 'body' ).append( '<div id="video-popup" class="video-popup"></div>' );
						$( '#video-popup' ).append( '<div id="iframe-wrapper" class="video-popup__iframe-wrapper" data-content="' + loading + '"></div>' );
						$( '#iframe-wrapper' ).append( video );
						$( '#iframe-wrapper' ).append( '<div id="video-close" class="video-popup__close" role="button" tabindex="0" aria-label="' + stopVideo + '"></div>' );
					}

					$( '#video-popup' ).css( 'top', y );

					// Execute code after the append operation is complete
					$( 'body' ).promise().done( function() {
						$( '#video-close' ).trigger( 'focus' );
					} );
				}

			}
		} );
	} );

	function videoPopupClose() {
		$( '#video-popup' ).remove();
		$( '#cover' ).remove();
		$( '[data-video-play].playing' ).trigger( 'focus' );
		$( '[data-video-play]' ).removeProp( 'disabled' ).removeClass( 'playing' );
		return false;
	}

	$( document ).on( 'click', '#video-close', function() {
		videoPopupClose();
	} );


	$( document ).on( 'keydown', '#video-close', function ( e ) {
		if ( e.key === ' ' || e.key === 'Enter' ) {
			videoPopupClose();
		}
		return true;
	} ); // end .click

	$( document ).on( 'click.video', function( event ) {
		if ( $( '#video-popup' ).length ) {
			if ( $( event.target ).closest( '#iframe-wrapper' ).length || $( event.target ).closest( '[data-video-play]' ).length ) {
				return;
			}
			videoPopupClose();
		}
	} );

	$( document ).on( 'keydown', '#iframe-wrapper', function ( e ) {
		if ( e.key === 'Tab' ) {
			e.preventDefault();
		}
	} );

	/**
	 * Get the VK customer id from a link like https://vkvideo.ru/clip-212646510_456239116
	 * @param {string} url - the url from which you want to extract the id
	 * @returns {string|false}
	 */
	function getVKOid( url ) {
		let ID = '';
		let pattern = '';
		if ( url.indexOf( 'vkvideo.ru/clip' ) > 0 ) {
			pattern = 'vkvideo.ru/clip';
		}
		if ( url.indexOf( 'vkvideo.ru/video' ) > 0 ) {
			pattern = 'vkvideo.ru/video';
		}
		if ( pattern ) {
			url = url.split( pattern );
			if ( url[ 1 ] !== undefined ) {
				ID = url[ 1 ].split( '_' );
				ID = ID[ 0 ];
				return ID;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Get the VK video id from a link like https://vkvideo.ru/clip-212646510_456239116
	 * @param {string} url - the url from which you want to extract the id
	 * @returns {string|false}
	 */
	function getVKId( url ) {
		let ID = '';
		let pattern = '';
		if ( url.indexOf( 'vkvideo.ru/clip' ) > 0 ) {
			pattern = 'vkvideo.ru/clip';
		}
		if ( url.indexOf( 'vkvideo.ru/video' ) > 0 ) {
			pattern = 'vkvideo.ru/video';
		}
		if ( pattern ) {
			url = url.split( pattern );
			if ( url[ 1 ] !== undefined ) {
				ID = url[ 1 ].split( '_' );
				ID = ID[ 1 ];
				return ID;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Get the Rutube customer id from a link like https://rutube.ru/video/b66f94e5801477f132c09c3e8bab70ad/?p=gqB8uvdUQsYqDNtoFK0RSA
	 * @param {string} url - the url from which you want to extract the id
	 * @returns {string|false}
	 */
	function getRTid( url ) {
		let ID = '';
		let pattern = '';
		if ( url.indexOf( 'rutube.ru/video/' ) > 0 ) {
			pattern = 'rutube.ru/video/';
		}
		if ( pattern ) {
			url = url.split( pattern );
			if ( url[ 1 ] !== undefined ) {
				ID = url[ 1 ].split( '/' );
				ID = ID[ 0 ];
				return ID;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Get the Rutube permission id from a link like https://rutube.ru/video/b66f94e5801477f132c09c3e8bab70ad/?p=gqB8uvdUQsYqDNtoFK0RSA
	 * @param {string} url - the url from which you want to extract the id
	 * @returns {string|false}
	 */
	function getRTp( url ) {
		let ID = '';
		let pattern = '';
		if ( url.indexOf( 'p=' ) > 0 ) {
			pattern = 'p=';
		}
		if ( pattern ) {
			url = url.split( pattern );
			if ( url[ 1 ] !== undefined ) {
				ID = url[ 1 ].split( '&' );
				ID = ID[ 0 ];
				return ID;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Get the youtube id.
	 * @param {string} url - the url from which you want to extract the id
	 * @returns {string|undefined}
	 */
	function youTubeGetID( url ) {
		let ID = '';
		url = url
			.replace( /(>|<)/gi, '' )
			.split( /(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/ );
		if ( url[ 2 ] !== undefined ) {
			ID = url[ 2 ].split( /[^0-9a-z_\-]/i );
			ID = ID[ 0 ];
		} else {
			ID = url;
		}
		return ID;
	}

	/**
	 * Get the vimeo id.
	 * @param {string} vimeoStr - the url from which you want to extract the id
	 * @returns {string|undefined}
	 */
	function getVimeoId( vimeoStr ) {
		let str = vimeoStr;

		if ( str.indexOf( '#' ) > -1 ) {
			[ str ] = str.split( '#' );
		}

		if ( str.indexOf( '?' ) > -1 && str.indexOf( 'clip_id=' ) === -1 ) {
			[ str ] = str.split( '?' );
		}

		let id;
		let arr;

		const primary = /https?:\/\/vimeo\.com\/([0-9]+)/;

		const matches = primary.exec( str );
		if ( matches && matches[ 1 ] ) {
			return matches[ 1 ];
		}

		const vimeoPipe = [
			'https?://player.vimeo.com/video/[0-9]+$',
			'https?://vimeo.com/channels',
			'groups',
			'album',
		].join( '|' );

		const vimeoRegex = new RegExp( vimeoPipe, 'gim' );

		if ( vimeoRegex.test( str ) ) {
			arr = str.split( '/' );
			if ( arr && arr.length ) {
				id = arr.pop();
			}
		} else if ( /clip_id=/gim.test( str ) ) {
			arr = str.split( 'clip_id=' );
			if ( arr && arr.length ) {
				[ id ] = arr[ 1 ].split( '&' );
			}
		}

		return id;
	}
} )( jQuery );
