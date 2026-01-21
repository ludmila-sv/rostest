<?php
/**
 *  Functions to enhance ACF.
 *
 * @package lsweb
 */

/**
 * Custom ACF JSON save point.
 *
 * @param string $path - path to json acf files.
 */
function lsweb_acf_json_save_point( $path ) {
	return get_template_directory() . '/includes/acf-fields';
}
// add_filter( 'acf/settings/save_json', 'lsweb_acf_json_save_point' );

/**
 * Custom ACF JSON load point.
 *
 * @param string $paths - path to json acf files.
 */
function lsweb_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_template_directory() . '/includes/acf-fields';
	return $paths;
}
// add_filter( 'acf/settings/load_json', 'lsweb_acf_json_load_point' );


/**
 * Adds Custom GB block's category.
 */
add_filter(
	'block_categories_all',
	function ( $categories, $post ) {

		$custom_categories = array(
			array(
				'slug'  => 'sitegb',
				'title' => __( 'Site GB', 'lsweb' ),
			),
			array(
				'slug'  => 'customgb',
				'title' => __( 'Custom GB', 'lsweb' ),
			),
		);

		$categories_slugs = array_reduce(
			$categories,
			function ( $res, $cat ) {
				if ( ! empty( $cat['slug'] ) ) {
					$res[] = $cat['slug'];
				}

				return $res;
			},
			array()
		);

		$checked_custom_categories = array();
		foreach ( $custom_categories as $custom_category ) {
			if ( false === array_search( $custom_category['slug'], $categories_slugs, true ) ) {
				$checked_custom_categories[] = $custom_category;
			}
		}
		$categories = array_merge( $checked_custom_categories, $categories );

		return $categories;
	},
	10,
	2
);
