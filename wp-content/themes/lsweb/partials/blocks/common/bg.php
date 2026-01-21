<?php
/**
 * Colored Background.
 *
 * @package lsweb
 */

$block_id = 'bg-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'bg';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( get_field( 'full_width' ) ) {
	$class_name .= ' full-width';
}
if ( get_field( 'bg' ) ) {
	$class_name .= ' bg-color-' . get_field( 'bg' );
}
if ( get_field( 'no_top_margin' ) ) {
	$class_name .= ' mt-0';
}
if ( get_field( 'no_bottom_margin' ) ) {
	$class_name .= ' mb-0';
}
?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="container">
		<InnerBlocks />
	</div>
</div>
