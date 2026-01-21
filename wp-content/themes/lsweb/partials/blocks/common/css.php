<?php
/**
 * Custom css block.
 *
 * @package lsweb
 */

if ( ! empty( get_field( 'css' ) ) ) {
	$style = get_field( 'css' );
	$handle = 'css-' . $block['id'];
	wp_register_style( $handle, false, array(), true, true );
	wp_enqueue_style( $handle );
	wp_add_inline_style( $handle, $style );
}
