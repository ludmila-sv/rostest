<?php
/**
 * Advantages block.
 *
 * @package lsweb
 */

$block_id = 'advantages-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'advantages full-width';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$num = have_rows( 'advantages' ) ? count( get_field( 'advantages' ) ) : 0;
if ( $num ) {
	$class_name .= ' advantages--' . $num;
}

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="container">
			<?php if ( get_field( 'title' ) ) { ?>

				<h2 class="advantages__title"><?php the_field( 'title' ); ?></h2>
			<?php } ?>
			<?php if ( have_rows( 'advantages' ) ) { ?>

				<div class="advantages__list">
					<?php
					while ( have_rows( 'advantages' ) ) :
						the_row();
						$adv_title = get_sub_field( 'title' );
						$adv_text  = get_sub_field( 'text' );
						$adv_icon  = get_sub_field( 'icon' );
						?>

						<div class="advantages__item">
							<div class="advantages__item__inner">
								<?php if ( ! empty( $adv_icon ) ) { ?>

									<div class="advantages__item__icon">
										<?php echo wp_get_attachment_image( $adv_icon, 'full', false, array( 'class' => 'img-block' ) ); ?>

									</div>
								<?php } ?>
								<?php if ( ! empty( $adv_title ) ) { ?>

									<div class="advantages__item__title"><?php echo wp_kses_post( $adv_title ); ?></div>
								<?php } ?>
								<?php if ( ! empty( $adv_text ) ) { ?>

									<div class="advantages__item__text">
										<?php echo wp_kses_post( $adv_text ); ?>

									</div>
								<?php } ?>

							</div>
						</div>
					<?php endwhile; ?>

				</div>

			<?php } ?>

		</div>
	</div>
<?php } ?>
