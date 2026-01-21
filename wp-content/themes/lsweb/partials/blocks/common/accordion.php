<?php
/**
 * Accordion block.
 *
 * @package lsweb
 */

$block_id = 'accordion-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'accordion';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( ! empty( get_field( 'title_centered' ) ) ) {
	$class_name .= ' accordion--title-centered';
}
if ( ! empty( get_field( 'dark' ) ) ) {
	$class_name .= ' accordion--dark';
}
$dark_bg = get_field( 'dark_bg' );
$bg      = get_field( 'bg' );
if ( ! empty( $dark_bg ) ) {
	$class_name .= ' accordion--dark-bg full-width';
}

$numbered = get_field( 'numbered' );
$btn      = get_field( 'btn' );

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<?php if ( ! empty( $dark_bg ) && ! empty( $bg ) ) { ?>

			<div class="accordion__bg">
				<?php echo wp_get_attachment_image( $bg, 'full', false, array( 'class' => 'img-fit' ) ); ?>

			</div>
		<?php } ?>
		<div class="container">

			<?php if ( get_field( 'title' ) ) { ?>

				<h2 class="accordion__title"><?php the_field( 'title' ); ?></h2>
			<?php } ?>

			<?php if ( have_rows( 'accordion' ) ) { ?>

				<div class="accordion__list" data-accordion>
					<?php
					$i = 0;
					while ( have_rows( 'accordion' ) ) :
						the_row();
						$i++;
						$index = $i . '-' . $block['id'];
						?>

						<div class="accordion__item<?php if ( $numbered ) { echo ' accordion__item--numbered'; } // phpcs:ignore?>" data-accordion-item>
							<div class="accordion__item__title" role="button" id="ac-title-<?php echo $index; ?>" aria-controls="ac-txt-<?php echo $index; // phpcs:ignore ?>" aria-expanded="false" tabindex="0">
								<?php
								if ( $numbered ) {
									echo '<span class="accordion__item__title__num">' . esc_attr( $i ) . '.</span> ';
								}
								the_sub_field( 'title' );
								?>
							</div>

							<div class="accordion__item__text" id="ac-txt-<?php echo $index; // phpcs:ignore ?>" aria-labelledby="ac-title-<?php echo $index; ?>" role="region" aria-hidden="true">
								<div class="accordion__item__text__body">
									<div class="accordion__item__text__inner">
										<?php the_sub_field( 'text' ); ?>

									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>

				</div>
			<?php } ?>

			<?php
			if ( ! empty( $btn ) ) {
				$btn_class = empty( $dark_bg ) ? 'btn btn--primary btn--arrow' : 'btn btn--primary btn--round btn--yellow btn--arrow';
				?>

				<div class="accordion__btn">
					<?php lsweb_get_link( $btn, $btn_class ); ?>

				</div>
			<?php } ?>

		</div>
	</section>
<?php } ?>
