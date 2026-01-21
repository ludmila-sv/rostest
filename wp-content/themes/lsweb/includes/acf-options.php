<?php
/**
 *  Set here desired option's pages.
 *
 * @package lsweb
 */

/**
 * Register custom post types.
 *
 * @see get_post_type_labels() for label keys.
 */
function lsweb_acf_options_init() {
	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_page(
			array(
				'page_title'  => __( 'Theme Settings', 'lsweb' ),
				'menu_title'  => __( 'Theme Settings', 'lsweb' ),
				'menu_slug'   => 'theme-settings',
				'capability'  => 'manage_options',
				'parent_slug' => '',
				'position'    => false,
				'icon_url'    => false,
				'redirect'    => false,
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Header', 'lsweb' ),
				'menu_title'  => __( 'Header', 'lsweb' ),
				'parent_slug' => 'theme-settings',
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Footer', 'lsweb' ),
				'menu_title'  => __( 'Footer', 'lsweb' ),
				'parent_slug' => 'theme-settings',
			)
		);
	}
}
add_action( 'init', 'lsweb_acf_options_init' );
