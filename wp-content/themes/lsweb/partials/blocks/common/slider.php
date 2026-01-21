<?php
/**
 * Slider.
 *
 * @package lsweb
 */

$block_id = 'slider-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}
$class_name = 'slider';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

$template = array(
	array(
		'acf/slider-slide',
		array(),
	),
	array(
		'acf/slider-slide',
		array(),
	),
);

$allowed_blocks = array(
	'acf/slider-slide',
);
if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>" role="region" aria-label="<?php esc_html_e( 'Slider', 'lsweb' ); ?>">
		<div class="slick-slider-js">
			<InnerBlocks template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>"
				allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" />
		</div>
		<div class="slick-controls d-none">
			<div class="slick-prev" role="button" aria-label="<?php esc_html_e( 'Previous', 'lsweb' ); ?>"></div>
			<div class="slick-next" role="button" aria-label="<?php esc_html_e( 'Next', 'lsweb' ); ?>"></div>
		</div>
	</div>
<?php } ?>
