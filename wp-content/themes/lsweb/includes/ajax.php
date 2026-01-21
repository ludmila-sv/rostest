<?php
/**
 * Ajax handlers.
 *
 * @package lsweb
 */

/**
 * Sends callback form.
 *
 * @package lsweb
 */
function lsweb_ajax_callback() {
	$email_to   = get_option( 'admin_email' );
	$email_from = $email_to;

	$name   = ( isset( $_POST['name'] ) && isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'callbackform_form' ) ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : ''; // phpcs:ignore
	$phone = ( isset( $_POST['phone'] ) && isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'callbackform_form' ) ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : ''; // phpcs:ignore
	$email = ( isset( $_POST['email'] ) && isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'callbackform_form' ) ) ? sanitize_text_field( wp_unslash( $_POST['email'] ) ) : ''; // phpcs:ignore

	if ( $phone ) {
		$subject = __( 'Order consultation', 'lsweb' );
		$txt     = __( 'Order consultation', 'lsweb' ) . " \n" . __( 'Name: ', 'lsweb' ) . $name . "\n" . __( 'Telephone: ', 'lsweb' ) . $phone . "\nEmail: " . $email;

		$subject = iconv( 'UTF-8', 'windows-1251', $subject );
		$txt     = iconv( 'UTF-8', 'windows-1251', $txt );

		$headers = 'From: <' . $email_from . ">\r\n";
		$headers = $headers . 'Return-path: <' . $email_from . ">\r\n";
		$headers = $headers . "Content-type: text/plain; charset=\"windows-1251\"\r";
		wp_mail( $email_to, $subject, $txt, $headers );
	}
	wp_die();
}

add_action( 'wp_ajax_sendcallback', 'lsweb_ajax_callback' );
add_action( 'wp_ajax_nopriv_sendcallback', 'lsweb_ajax_callback' );
