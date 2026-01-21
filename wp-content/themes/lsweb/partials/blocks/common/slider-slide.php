<?php
/**
 * Slide partial.
 *
 * @package lsweb
 */

$block_id = '';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = ' id="' . $block['anchor'] . '"';
}

$class_name = 'slider__slide';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
$template = array(
	array(
		'core/image',
		array(),
	),
);
?>

<div class="<?php echo esc_attr( $class_name ); ?>"<?php echo $block_id; // phpcs:ignore ?>>
	<InnerBlocks template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" />
</div>
