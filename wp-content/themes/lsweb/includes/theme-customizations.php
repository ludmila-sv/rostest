<?php
/**
 * Theme customizations.
 *
 * @package lsweb
 */

// phpcs:disable Squiz.PHP.CommentedOutCode
// phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter

/**
 * Theme setup hooks
 */
function lsweb_after_setup_theme() {

	if ( ! defined( 'WP_DEBUG' ) || ( defined( 'WP_DEBUG' ) && ! empty( WP_DEBUG ) ) ) {
		show_admin_bar( false );
	}

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'wp-block-styles' ); // required for blocks editor styles in Gutenberg.

	add_theme_support( 'align-wide' ); // Gutenberg alignment options.

	register_nav_menus(
		array(
			'primary'   => __( 'Header Menu', 'lsweb' ),
			'secondary' => __( 'Footer Menu', 'lsweb' ),
		)
	);

	add_editor_style(
		array(
			get_template_directory_uri() . '/assets/css/editor-style.css?ver=' . _get_asset_version(),
			_get_fonts_loading_url(),
		)
	);
}

add_action( 'after_setup_theme', 'lsweb_after_setup_theme' );

/**
 * Adds SVG support
 *
 * @param array $mimes - permitted mime types.
 *
 * @package lsweb
 */
function lsweb_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['doc'] = 'application/msword';
	return $mimes;
}
add_filter( 'upload_mimes', 'lsweb_mime_types' );

/**
 * Fix MIME type for SVG
 *
 * Some svg files do not contain xml, for them 'image/svg+xml' does not work, but 'image/svg' works.
 *
 * @param array  $data - data.
 * @param string $file - file.
 * @param string $filename - filename.
 * @param array  $mimes - mime types.
 * @param array  $real_mime - real mime.
 *
 * @package lsweb
 */
function lsweb_fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ) {

	// WP 5.1 +.
	if ( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ) {
		$dosvg = in_array( $real_mime, array( 'image/svg', 'image/svg+xml' ), true );
	} else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
	}

	if ( $dosvg ) {
		if ( current_user_can( 'manage_options' ) ) {
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		} else {
			$data['ext']  = false;
			$data['type'] = false;
		}
	}

	return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'lsweb_fix_svg_mime_type', 10, 5 );

/**
 * Fix svg in wp admin.
 *
 * @package lsweb
 */
function lsweb_fix_svg() {
	echo '<style type="text/css">
			.attachment-266x266, .thumbnail img {
				width: 100% !important;
				height: auto !important;
			}
		</style>';
}
add_action( 'admin_head', 'lsweb_fix_svg' );

/**
 * Adds custom classes to body and removes unnecessary classes.
 *
 * @param array $classes Body Classes.
 * @return array
 */
function lsweb_body_class( $classes ) {
	if ( in_array( 'page-template-default', $classes, true ) ) {
		unset( $classes[ array_search( 'page-template-default', $classes, true ) ] );
	}
	foreach ( $classes as $class ) {
		if ( false !== strpos( $class, 'page-id-' ) || false !== strpos( $class, 'single-' ) || false !== strpos( $class, 'postid-' ) || false !== strpos( $class, 'pageid-' ) || false !== strpos( $class, 'post-type-archive-' ) || false !== strpos( $class, 'author-' ) || false !== strpos( $class, 'term-' ) || false !== strpos( $class, '-paged-' ) ) {
			unset( $classes[ array_search( $class, $classes, true ) ] );
		}
	}

	// array_merge( $classes, array( 'class-name' ) );.
	return $classes;
}
add_filter( 'body_class', 'lsweb_body_class', 10, 1 );

/**
 * Search among blog posts only
 *
 * @param object $query - wp query result.
 */
function lsweb_posts_search_filter( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search ) {
		$query->set( 'post_type', array( 'post' ) );
	}
}
add_action( 'pre_get_posts', 'lsweb_posts_search_filter' );

/**
 * Modifies wp-spacer block
 *
 * @param string $block_content - the block content.
 * @param object $block - the block object.
 *
 * @return string;
 */
function lsweb_spacer_block( $block_content, $block ) {
	if ( 'core/spacer' !== $block['blockName'] ) {
		return $block_content;
	}
	$pattern = '/\sstyle="height:(\d+)px"/i';
	preg_match( $pattern, $block_content, $matches );
	if ( isset( $matches[1] ) ) {
		$height  = $matches[1] / 16;
		$return  = '<div aria-hidden="true" class="wp-block-spacer">';
		$return .= '<div class="d-desktop" style="height:' . $height . 'rem"></div>';
		$return .= '<div class="d-mobile" style="height:' . $height / 2 . 'rem"></div>';
		$return .= '</div>';
		return $return;
	} else {
		return $block_content;
	}
}
add_filter( 'render_block', 'lsweb_spacer_block', 10, 2 );

/**
 * Change excerpt length
 *
 * @package lsweb
 */
add_filter(
	'excerpt_length',
	function () {
		return 20;
	}
);

/**
 * Change excerpt read more text
 *
 * @package lsweb
 */
function lsweb_excerpt_more() {
	return ' ...';
}
add_filter( 'excerpt_more', 'lsweb_excerpt_more' );

/**
 * Function to get links from the acf field.
 *
 * @param array  $link - link data.
 * @param string $class - link class.
 *
 * @return void
 *
 * @package lsweb
 */
function lsweb_get_link( $link, $btn_class = 'btn btn--primary' ) {
	if ( ! empty( $link ) ) {
		$link_title  = $link['title'];
		$link_url    = $link['url'];
		$link_target = $link['target'] ? ' target="' . $link['target'] . '"' : '';
		if ( str_contains( $btn_class, 'btn--arrow' ) ) {
			$link_title .= ' <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20 1.70504L1.70504 20L0 18.295L15.8836 2.41131H1.44546e-05L1.46654e-05 1.38407e-05L18.295 1.37975e-05L20 1.70504ZM19.9792 4.392V19.9792H17.568V4.392H19.9792Z" fill="white"/></svg>';
		}

		echo '<a class="' . $btn_class . '" href="' . $link_url . '"' . $link_target . '>' . $link_title . '</a>'; // phpcs:ignore
	}
}

/**
 * &shy; hyphenation for Gutenberg - just insert [shy].
 */
function lsweb_shy_shortcode() {
	return '&shy;';
}
add_shortcode( 'shy', 'lsweb_shy_shortcode' );

/**
 * &nbsp; for Gutenberg - just insert [nbsp].
 */
function lsweb_nbsp_shortcode() {
	return '&nbsp;';
}
add_shortcode( 'nbsp', 'lsweb_nbsp_shortcode' );

/**
 * Remove ACF warning.
 */
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );
