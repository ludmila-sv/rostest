<?php
/**
 * Image & Text.
 *
 * @package lsweb
 */

$block_id = 'img-txt-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'img-txt full-width';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( get_field( 'bg' ) ) {
	$class_name .= ' bg-color-' . get_field( 'bg' );
}
if ( get_field( 'align' ) ) {
	$class_name .= ' img-align-' . get_field( 'align' );
}

$show_line     = get_field( 'show_line' );
$show_caption  = get_field( 'show_caption' );
$caption_title = get_field( 'caption_title' );
$caption_text  = get_field( 'caption_text' );
$caption_class = get_field( 'caption_simple' ) ? ' img-txt__img--caption--simple' : '';
$txt_class     = get_field( 'justify' ) ? ' img-txt__txt--justify' : '';

if ( $show_line ) {
	$class_name .= ' img-txt--line';
}

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<section  id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="container">
			<?php if ( $show_line ) { ?>

				<div class="middle-line d-desktop"></div>
			<?php } ?>

			<div class="row">
				<div class="col-lg-6">
					<div class="img-txt__img<?php if ( $show_caption ) { echo ' img-txt__img--caption'; } // phpcs:ignore ?><?php echo esc_attr( $caption_class ); ?>">
						<?php if ( $show_caption ) { ?>
							<div class="img-txt__img__inner">

						<?php } ?>

						<?php echo wp_get_attachment_image( get_field( 'image' ), 'large' ); ?>

						<?php if ( $show_caption ) { ?>
						
							</div>
						<?php } ?>
						<?php if ( ( $caption_title || $caption_text ) && $show_caption ) { ?>

							<div class="img-txt__img__caption">
								<?php if ( $caption_title ) { ?>

									<div class="img-txt__img__caption__title"><?php echo wp_kses_post( $caption_title ); ?></div>
								<?php } ?>
								<?php if ( $caption_text ) { ?>

									<div class="img-txt__img__caption__txt"><?php echo wp_kses_post( $caption_text ); ?></div>
								<?php } ?>

							</div>
						<?php } ?>

					</div>
				</div>
				<div class="col-lg-6">
					<div class="img-txt__txt<?php echo esc_attr( $txt_class ); ?>">
						<InnerBlocks />
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
