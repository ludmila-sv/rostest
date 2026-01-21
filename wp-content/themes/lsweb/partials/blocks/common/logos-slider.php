<?php
/**
 * Logos slider.
 *
 * @package lsweb
 */

$block_id = 'logos-slider-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'logos-slider full-width';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="container">

			<?php if ( get_field( 'title' ) ) { ?>

				<h2 class="logos-slider__title"><?php the_field( 'title' ); ?></h2>
			<?php } ?>

			<?php if ( have_rows( 'slides' ) ) { // owl is disabled now. ?>

				<div class="logos-slider__list owl-carousel owl-theme">

					<?php
					while ( have_rows( 'slides' ) ) {
						the_row();
						?>

						<div class="logos-slider__item">
							<?php
							if ( get_sub_field( 'img' ) ) {
								$item_link  = get_sub_field( 'link' ) ? get_sub_field( 'link' ) : '#';
								?>

								<a class="logos-slider__item__link" href="<?php echo esc_attr( $item_link ); ?>" target="_blank">
									<?php echo wp_get_attachment_image( get_sub_field( 'img' ), 'large', false, array( 'class' => 'logos-slider__item__img' ) ); ?>

								</a>
							<?php } ?>

						</div>
					<?php } ?>

				</div>
			<?php } ?>

		</div>
	</section>
<?php } ?>
