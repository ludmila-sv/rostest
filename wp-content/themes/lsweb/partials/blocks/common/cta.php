<?php
/**
 * CTA.
 *
 * @package lsweb
 */

$block_id = 'cta-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'cta full-width';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( get_field( 'bg' ) ) {
	$class_name .= ' bg-color-' . get_field( 'bg' );
}

$ttl           = get_field( 'title' );
$text          = get_field( 'text' );
$button_type   = get_field( 'button_type' );
$link_btn      = get_field( 'link' );
$link_whatsapp = get_field( 'link_whatsapp' );
$link_telegram = get_field( 'link_telegram' );
$bg_img        = get_field( 'bg_img' );
$show_line     = get_field( 'show_line' );

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	if ( get_field( 'rounded' ) ) {
		?>

		<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> cta--rounded">

			<div class="container">
				<?php if ( $bg_img ) { ?>

					<div class="cta__bg">
						<?php echo wp_get_attachment_image( $bg_img, 'full', false, array( 'class' => 'img-fit' ) ); ?>

					</div>
				<?php } ?>

				<div class="cta__inner">
					<?php if ( $ttl ) { ?>

						<h2 class="cta__title<?php if ( get_field( 'title_small') ) { echo ' cta__title--small'; } // phpcs:ignore ?>" itemprop="headline"><?php echo wp_kses_post( $ttl ); ?></h2>
					<?php } ?>
					<?php if ( $text ) { ?>

						<div class="cta__subtitle"><?php echo wp_kses_post( $text ); ?></div>
					<?php } ?>
					<?php if ( 'any' === $button_type && $link_btn ) { ?>

						<div class="cta__btn"><?php lsweb_get_link( $link_btn, 'btn btn--primary btn--yellow btn--arrow btn--round' ); ?></div>
					<?php } elseif ( 'whatsapp' === $button_type && $link_whatsapp ) { ?>

						<div class="cta__btn">
							<a class="btn btn--primary btn--red btn--whatsapp btn--round" href="<?php echo esc_url( $link_whatsapp ); ?>" target="_blank"><span></span> Написать</a>
						</div>
					<?php } elseif ( 'telegram' === $button_type && $link_telegram ) {
						$tel_txt = str_contains( $link_telegram, 'PsyAcademySystemBot' ) ? 'Написать' : 'Подписаться на канал';
						?>

						<div class="cta__btn">
							<a class="btn btn--primary btn--red btn--telegram btn--round" href="<?php echo esc_url( $link_telegram ); ?>" target="_blank"><span></span> <?php echo esc_html( $tel_txt ); ?></a>
						</div>
					<?php } ?>

				</div>

			</div>
		</section>
	<?php } else { ?>

		<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
			<?php if ( $bg_img ) { ?>

				<div class="cta__bg">
					<?php echo wp_get_attachment_image( $bg_img, 'full', false, array( 'class' => 'img-fit' ) ); ?>

				</div>
			<?php } ?>
			<?php if ( $show_line ) { ?>

				<div class="middle-line"></div>
			<?php } ?>

			<div class="container">
				<?php if ( $ttl ) { ?>

					<h2 class="cta__title<?php if ( get_field( 'title_small') ) { echo ' cta__title--small'; } // phpcs:ignore ?>" itemprop="headline"><?php echo wp_kses_post( $ttl ); ?></h2>
				<?php } ?>
				<?php if ( $text ) { ?>

					<div class="cta__subtitle"><?php echo wp_kses_post( $text ); ?></div>
				<?php } ?>
				<?php if ( 'any' === $button_type && $link_btn ) { ?>

					<div class="cta__btn"><?php lsweb_get_link( $link_btn, 'btn btn--primary btn--red' ); ?></div>
				<?php } elseif ( 'whatsapp' === $button_type && $link_whatsapp ) { ?>

					<div class="cta__btn">
						<a class="btn btn--primary btn--red btn--whatsapp" href="<?php echo esc_url( $link_whatsapp ); ?>" target="_blank"><span></span> Написать</a>
					</div>
					<?php
				} elseif ( 'telegram' === $button_type && $link_telegram ) {
					$tel_txt = str_contains( $link_telegram, 'PsyAcademySystemBot' ) ? 'Написать' : 'Подписаться на канал';
					?>

					<div class="cta__btn">
						<a class="btn btn--primary btn--red btn--telegram" href="<?php echo esc_url( $link_telegram ); ?>" target="_blank"><span></span> <?php echo esc_html( $tel_txt ); ?></a>
					</div>
				<?php } ?>

			</div>
		</section>
	<?php } ?>
<?php } ?>
