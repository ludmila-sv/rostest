<?php
/**
 *  Theme translation.
 *
 * Usage:
 * <?php esc_html_e( 'Contact Us', 'lsweb' ); ?>
 * <?php _ex( 'Contact Us', 'context', 'lsweb' ); // phpcs:ignore ?>
 * <?php echo str_replace( '<a>', '<a href="' . esc_url( $consent_url ) . '">', __( 'I accept <a>Terms and Conditions</a> and agree to receive marketing letters that can be interesting for me.', 'lsweb' ) ); ?>
 * __( 'Homepage', 'lsweb' )
 * translators: %s is replaced with the number of doctors
 * $result = sprintf( _n( '%s doctor', '%s doctors', $post_number, 'lsweb' ), $post_number );
 * $result = sprintf( _nx( '%s doctor', '%s doctors', $post_number, 'see', 'lsweb' ), $post_number );
 * _x( $text, $context, $domain );
 *
 * @package lsweb
 */

/**
 * Loads translations
 */
function lsweb_load_textdomain() {
	$mo_file_path = get_template_directory() . '/languages/lsweb-' . determine_locale() . '.mo';

	load_textdomain( 'lsweb', $mo_file_path );
}
add_action( 'after_setup_theme', 'lsweb_load_textdomain' );
