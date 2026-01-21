<?php
/**
 * Callback form.
 *
 * Usage: <?php get_template_part( 'partials/callbackform', null, array( 'title' => $callback_title, 'txt' => $callback_txt ) ); ?>
 *
 * @package lsweb
 */

$callback_title = ! empty( $args['title'] ) ? $args['title'] : '';
$callback_txt = ! empty( $args['txt'] ) ? $args['txt'] : '';
?>

<form id="callbackform" class="callbackform" action="/" method="post">
	<div class="callbackform__info">
		<?php if ( ! empty( $callback_title ) ) { ?>

			<div class="callbackform__title"><h2><?php echo esc_html( $callback_title ); ?></h2></div>
		<?php } ?>

		<?php if ( ! empty( $callback_txt ) ) { ?>

			<div class="callbackform__txt"><?php echo esc_html( $callback_txt ); ?></div>
		<?php } ?>

	</div>

	<div class="callbackform__fields">
		<div class="callbackform__item">
			<input id="callback-phone" name="phone" type="tel" placeholder="<?php _ex( 'Phone', 'callback', 'lsweb' ); // phpcs:ignore ?>" autocomplete="tel">
		</div>

		<div class="callbackform__item">
			<input id="callback-email" name="email" type="email" placeholder="<?php _ex( 'Email', 'callback', 'lsweb' ); // phpcs:ignore ?>" autocomplete="email">
		</div>

		<div class="callbackform__item">
			<input id="callback-name" name="name" type="text" placeholder="<?php _ex( 'Name', 'callback', 'lsweb' ); // phpcs:ignore ?>"  autocomplete="given-name">
		</div>

		<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'callbackform_form' ); // phpcs:ignore ?>">

		<div class="callbackform__item">
			<button id="callbackform-submit" class="btn btn--primary" type="submit"><?php _ex( 'Submit', 'callback', 'lsweb' ); // phpcs:ignore ?></button>
		</div>
	</div>

	<?php $consent_url = get_privacy_policy_url() ? get_privacy_policy_url() : '#'; ?>

	<div class="callbackform__item--full callbackform__item--checkbox d1-none">
		<input id="callback-consent" name="consent" type="checkbox" checked="checked">
		<label class="callbackform__checkbox callbackform__label" for="callback-consent"><?php echo str_replace( '<a>', '<a href="' . esc_url( $consent_url ) . '">', __( 'I accept&nbsp; <a>Terms and Conditions</a> &nbsp;and agree to receive marketing letters that can be interesting for me.', 'lsweb' ) ); // phpcs:ignore ?></label>		
	</div>
</form>
