<?php
/**
 * Tab partial.
 *
 * ARIA: https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Roles/tab_role#example
 *
 * @package lsweb
 */

$template = array(
	array(
		'core/paragraph',
		array(),
	),
);
?>

<div class="tab" id=<?php echo esc_attr( sanitize_title( get_field( 'title' ) ) ); ?> data-title="<?php echo esc_attr( get_field( 'title' ) ); ?>" role="tabpanel" tabindex="0" hidden>
	<InnerBlocks template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" />
</div>
