<?php
/**
 * Full Width block.
 *
 * @package lsweb
 */

$block_id = '';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = ' id="' . $block['anchor'] . '"';
}

$class_name = 'full-width';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
?>

<div class="<?php echo esc_attr( $class_name ); ?>"<?php echo $block_id; // phpcs:ignore ?>>
	<InnerBlocks />
</div>
