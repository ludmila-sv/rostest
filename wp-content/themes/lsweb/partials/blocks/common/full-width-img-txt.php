<?php
/**
 * Full-Width Image&Text.
 *
 * @package lsweb
 */

$block_id = 'full-width-img-txt-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'full-width-img-txt full-width';

if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
$align       = get_field( 'alignment' ) ? get_field( 'alignment' ) : 'left';
$class_name .= ' text-block-' . $align;

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="full-width-img-txt__bg">
			<?php echo wp_get_attachment_image( get_field( 'image' ), 'full', false, array( 'class' => 'img-block' ) ); ?>

		</div>
		<div class="full-width-img-txt__container">
			<div class="full-width-img-txt__txt">
				<InnerBlocks />
			</div>
		</div>
	</section>
<?php } ?>
