<?php
/**
 * WP clean up.
 *
 * @package lsweb
 */

// phpcs:disable Squiz.PHP.CommentedOutCode
// phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter

/**
 * Remove Emoji
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Remove script type="text/javascript" for validator.w3.org
 *
 * @param string $tag    The `<script>` tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return string;
 */
function lsweb_remove_type_attr( $tag, $handle ) {
	return preg_replace( "/ type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
add_filter( 'style_loader_tag', 'lsweb_remove_type_attr', 10, 2 );
add_filter( 'script_loader_tag', 'lsweb_remove_type_attr', 10, 2 );

add_action(
	'template_redirect',
	function () {
		ob_start(
			function ( $buffer ) {
				$buffer = str_replace( array( ' type="text/javascript"', " type='text/javascript'" ), '', $buffer );
				$buffer = str_replace( array( ' type="text/css"', " type='text/css'" ), '', $buffer );
				$buffer = preg_replace( '/(<link [^>]+) *\/>/', '$1>', $buffer );
				$buffer = preg_replace( '/(<meta [^>]+) *\/>/', '$1>', $buffer );
				return $buffer;
			}
		);
	}
);

/**
 * Remove inline wp styles from head.
 */
function lsweb_remove_inline_styles_header() {
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
// add_action( 'wp_enqueue_scripts', 'lsweb_remove_inline_styles_header', 99 );

/**
 * Remove inline wp styles from footer.
 */
function lsweb_remove_inline_styles_footer() {
	add_filter(
		'print_styles_array',
		function ( $styles ) {

			$styles_to_remove = array( 'core-block-supports' );

			if ( is_array( $styles ) && count( $styles ) > 0 ) {
				foreach ( $styles as $key => $code ) {
					if ( in_array( $code, $styles_to_remove, true ) ) {
						unset( $styles[ $key ] );
					}
				}
			}
			return $styles;
		}
	);
}
add_action( 'wp_enqueue_scripts', 'lsweb_remove_inline_styles_footer', 99 );

// Removes dns-prefetch.
remove_action( 'wp_head', 'wp_resource_hints', 2 );

// Removes wlwmanifest link (wlwmanifest allows to edit content through Windows Live Writer).
remove_action( 'wp_head', 'wlwmanifest_link' );

// Hides WP version.
remove_action( 'wp_head', 'wp_generator' );

// Removes rsd link.
remove_action( 'wp_head', 'rsd_link' );

// Removes short link.
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Disables unauthenticated access to REST endpoints.
 */

/*
add_filter(
	'rest_authentication_errors',
	function ( $result ) {

		// maybe authentication error already set.
		if ( empty( $result ) ) {
			if ( ! is_user_logged_in() ) {
				return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
			}
		}

		return $result;
	}
);
*/

/**
 * Removes REST-API links for unauthorized users from head.
 */
/*
add_action(
	'init',
	function () {

		if ( ! is_user_logged_in() ) {

			// Removes <link rel="https://api.w.org/" href="/wp-json/">.
			remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

			// Removes rest api endpoint in /xmlrpc.php?rsd.
			remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );

			// Removes Link: <https://example.com/wp-json/>; rel="https://api.w.org/".
			remove_action( 'template_redirect', 'rest_output_link_header', 11 );
		}

	}
);
*/

// Removes <style> tags for GBs in the footer and removes unnecessary classes from GBs.
// remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );

/**
 * Removes frameborder="0" from iframe and fixes the <br> tag.
 *
 * @param string $content - post content.
 * @package lsweb
 */
function lsweb_cleanup_content( $content ) {
	$content = str_replace( ' frameborder="0"', '', $content );
	$content = str_replace( '<br />', '<br>', $content );
	return $content;
}
add_filter( 'the_content', 'lsweb_cleanup_content' );

/**
 * Removes trailing slashes.
 *
 * @param string $html - post content.
 * @package lsweb
 */
function lsweb_remove_slashes( $html ) {
	$html = preg_replace( '/(<link [^>]+) *\/>/', '$1>', $html );
	$html = preg_replace( '/(<meta [^>]+) *\/>/', '$1>', $html );
	$html = preg_replace( '/(<img [^>]+) *\/>/', '$1>', $html );
	$html = preg_replace( '/(<hr [^>]+) *\/>/', '$1>', $html );
	$html = str_replace( '<noscript><style>.lazyload{display:none}</style></noscript>', '', $html );
	$html = str_replace( '</head>', '<noscript><style>.lazyload{display:none}</style></noscript></head>', $html );
	return $html;
}

// Output img, link, meta tags without trailing slashes.
add_filter( 'wp_get_attachment_image', 'lsweb_remove_slashes' );
add_filter( 'style_loader_tag', 'lsweb_remove_slashes', 11 );
add_action( 'site_icon_meta_tags', 'lsweb_remove_slashes', 11 );
add_action( 'rest_url', 'lsweb_remove_slashes', 11 );
add_action( 'wp_robots', 'lsweb_remove_slashes', 11 );

// Autoptimize: output void elements without trailing slashes.
add_filter( 'autoptimize_html_after_minify', 'lsweb_remove_slashes' );

/**
 * Removes trailing slashes.
 *
 * @param string $input - content to clean.
 * @package lsweb
 */
function lsweb_tag_fixer( $input ) {
	$res = preg_replace( '/(<img.+)\s?\/>/', '$1>', $input );
	$res = preg_replace( '/(<hr.+)\s?\/>/', '$1>', $res );
	return $res;
}

foreach ( array( 'the_content', 'the_excerpt', 'comment_text' ) as $filter ) {
	add_filter( $filter, 'lsweb_tag_fixer', 12 );
}

/**
 * Removes trailing slashes from tags
 *
 * @param string $content - the post content.
 *
 * @return string;
 *
 * @package lsweb
 */
function lsweb_html5_cleanup( $content ) {
	$content = str_replace( '<br />', '<br>', $content );
	$content = str_replace( '<br/>', '<br>', $content );
	$content = preg_replace( '/(<img [^>]+) *\/>/', '$1>', $content );
	return $content;
}

add_filter( 'the_content', 'lsweb_html5_cleanup', 25 );

// add_filter( 'wpseo_image_sizes', array() );

/**
 * Removes sizes="auto" (this will also switch off contain-intrinsic-size in css ).
 *
 * Not recommended, as the contain-intrinsic-size style prevents layout shifts, especially for responsive images using sizes="auto".
 *
 * @package lsweb
 */
add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );

/**
 * Removes script with type="speculationrules".
 *
 * WordPress 6.8 introduced a new performance feature called speculative loading, which is enabled on all sites by default. This feature uses the browser’s Speculation Rules API to anticipate which links users might click and preloads them in the background.
 *
 * @package lsweb
 */
add_filter( 'wp_speculation_rules_configuration', '__return_null' );
