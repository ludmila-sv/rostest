<?php
/**
 * Statistics.
 *
 * @package lsweb
 */

$block_id = 'statistics-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'statistics';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$ttl = get_field( 'title' );
$block_el = $ttl ? 'section' : 'div';

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<<?php echo esc_attr( $block_el ); ?> id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="container">

			<?php if ( $ttl ) { ?>

				<h2 class="statistics__title"><?php echo wp_kses_post( $ttl ); ?></h2>
			<?php } ?>

			<?php if ( have_rows( 'statistics' ) ) { ?>

				<div class="statistics__list">
					<?php
					while ( have_rows( 'statistics' ) ) {
						the_row();
						$num  = get_sub_field( 'number' );
						$unit = get_sub_field( 'unit' );
						$desc = get_sub_field( 'desc' );
						?>

						<div class="statistics__item">
							<div class="statistics__item__inner">
								<?php if ( $num ) { ?>

									<div class="statistics__item__stat">
										<div class="statistics__item__num"><?php echo esc_html( $num ); ?></div>
										<?php if ( $unit ) { ?>

											<div class="statistics__item__unit"><?php echo esc_html( $unit ); ?></div>
										<?php } ?>

									</div>
								<?php } ?>
								<?php if ( $desc ) { ?>

									<div class="statistics__item__desc"><?php echo wp_kses_post( $desc ); ?></div>
								<?php } ?>

							</div>
						</div>				
					<?php } ?>

				</div>
			<?php } ?>

		</div>
	</<?php echo esc_attr( $block_el ); ?>>
<?php } ?>
