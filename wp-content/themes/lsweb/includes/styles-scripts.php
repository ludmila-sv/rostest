<?php
/**
 * Theme scripts and styles.
 *
 * @package lsweb
 */

/**
 * Returns version string for assets.
 *
 * @return null|string
 */
function _get_asset_version() {
	return defined( 'ENV_DEV' ) ? gmdate( 'YmdHis' ) : wp_get_theme()->get( 'Version' );
}

/**
 * Returns a google fonts url to be used in stylesheets
 *
 * @return string
 */
function _get_fonts_loading_url() {
	return 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Bitter:ital,wght@0,100..900;1,100..900&display=swap';
}

/**
 * Enqueue scripts and styles
 *
 * @return void
 */
function lsweb_enqueue_scripts() {
	$asset_version = _get_asset_version();

	wp_enqueue_script(
		'fancybox',
		'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js',
		array( 'jquery' ),
		'3.5.7',
		true
	);
	wp_enqueue_style( 'fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', null, '3.5.7' );

	wp_enqueue_script(
		'select2',
		'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
		array( 'jquery' ),
		'4.1.0',
		true
	);
	wp_enqueue_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', null, '4.1.0' );

	//phpcs:ignore
	//wp_enqueue_style( 'googlefonts', _get_fonts_loading_url(), null, $asset_version );
	wp_enqueue_style( 'involve-font', get_template_directory_uri() . '/assets/fonts/Involve/font.css', array(), _get_asset_version() );
	wp_enqueue_style( 'lsweb-bs-style', get_template_directory_uri() . '/assets/css/bootstrap.css', null, $asset_version );
	wp_enqueue_style( 'lsweb-style', get_template_directory_uri() . '/assets/css/main.css', array( 'lsweb-bs-style' ), $asset_version );

	wp_enqueue_script(
		'lsweb-scripts',
		get_template_directory_uri() . '/assets/js/main/main.js',
		array( 'jquery' ),
		$asset_version,
		true
	);

	wp_localize_script(
		'lsweb-scripts',
		'lswebScriptData',
		array(
			'ajax_url'   => admin_url( 'admin-ajax.php' ),
			'loading'    => __( 'Loading...', 'lsweb' ),
			'stopVideo'  => __( 'Stop Video', 'lsweb' ),
			'galleryImg' => __( 'Gallery Image', 'lsweb' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'lsweb_enqueue_scripts' );

/**
 * Renders `<link rel="preload" href="">` tags for registered css files, for better performance.
 *
 * See:
 * https://web.dev/uses-rel-preload/
 * https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
 *
 * @return void
 */
function lsweb_preload_styles() {

	/**
	 * NB: you can also preconnect to font's server in case they are not self hosted. `preconnect` or `dns-prefetch` - NOT BOTH!
	 * and they should be listed before preloading fonts, and css.
	 */
	//phpcs:ignore
	// echo '<link rel="preconnect" href="https://hello.myfonts.net" crossorigin>'.

	/**
	 * Also preloading woff2 files of fonts gives good performance gain, and mitigates font flickering.
	 * You need only woff2 file of each font's file
	 */
	// echo '<link rel="preload" href="' . esc_attr( get_template_directory_uri() ) . '/assets/fonts/font-name/font-file.woff2" as="font" type="font/woff2" crossorigin>'.

	$styles = wp_styles();
	$links  = "\r\n";

	foreach ( $styles->queue as $handle ) {

		$obj = $styles->registered[ $handle ];

		if ( null === $obj->ver ) {
			$ver = '';
		} else {
			$ver = $obj->ver ? $obj->ver : $styles->default_version;
		}

		if ( isset( $styles->args[ $handle ] ) ) {
			$ver = $ver ? $ver . '&amp;' . $styles->args[ $handle ] : $styles->args[ $handle ];
		}

		$src  = $obj->src;
		$href = $styles->_css_href( $src, $ver, $handle );
		if ( false !== strpos( $href, 'http' ) ) {
			$links .= '<link rel="preload" href="' . esc_attr( $href ) . '" as="style" type="text/css">';
			$links .= "\r\n";
		}
	}
	echo $links; // phpcs:ignore
	echo "\r\n"; // phpcs:ignore
}

add_action( 'wp_head', 'lsweb_preload_styles', 3 );

/**
 * Outputs preconnect googlefonts links.
 * NB! preconnect includes dns-prefetch.
 */
function lsweb_preconnect_googlefonts() {
	$links  = '<link rel="preconnect" href="https://fonts.googleapis.com">';
	$links .= "\r\n";
	$links .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
	$links .= "\r\n";
	$links .= '<link rel="preconnect" href="https://cdn.jsdelivr.net">';
	echo "\r\n";
	echo $links; // phpcs:ignore
	echo "\r\n";
}
add_action( 'wp_head', 'lsweb_preconnect_googlefonts', 2 );

/**
 * Outputs secured bootstrap-js tag with integrity checks, add other CDN loaded scripts here if there are any.
 *
 * @param string $tag The `<script>` tag for the enqueued script.
 * @param string $handle The script's registered handle.
 * @param string $src The script's source URL.
 *
 * @return string;
 */
function lsweb_external_scripts_integrity( $tag, $handle, $src ) {

	// add other script-handle => secured script tag here.
	$scripts = array(
		'bootstrap-js' => '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>', // phpcs:ignore
		'popper-js'    => '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>', // phpcs:ignore
	);

	// it will replace only necessary one.
	if ( isset( $scripts[ $handle ] ) ) {
		$tag = $scripts[ $handle ];
	}

	return $tag;
}

// add_filter( 'script_loader_tag', 'lsweb_external_scripts_integrity', 10, 3 );


/**
 * Enqueue block editor style for Gutenberg Blocks
 */
function lsweb_block_editor_styles() {
	$asset_version = _get_asset_version();

	wp_enqueue_style( 'googlefonts', _get_fonts_loading_url(), null, $asset_version );
	wp_enqueue_style( 'lsweb-blocks-editor-style', get_theme_file_uri( '/assets/css/blocks-editor-style.css' ), false, $asset_version, 'all' );

	$current_admin_page = get_current_screen();
	if ( 'widgets' !== $current_admin_page->id ) {
		wp_enqueue_script(
			'lsweb-admin-script',
			get_template_directory_uri() . '/assets/js/editor/editor.js',
			array( 'wp-blocks', 'wp-edit-post', 'wp-dom' ),
			'1.0.0',
			true
		);
	}
}

add_action( 'enqueue_block_editor_assets', 'lsweb_block_editor_styles' );

/**
 * Add admin styles
 */
function lsweb_load_custom_wp_admin_style() {
	wp_enqueue_style( 'lsweb-admin-style', get_template_directory_uri() . '/assets/admin/main.css', array(), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'lsweb_load_custom_wp_admin_style' );
