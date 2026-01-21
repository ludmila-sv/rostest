<?php
/**
 * Hero block.
 *
 * @package lsweb
 */

$block_id = 'hero-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'hero full-width';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$image      = get_field( 'image' );
$block_type = get_field( 'type' );
$suptitle   = get_field( 'suptitle' );
$subtitle   = get_field( 'subtitle' );
$ttl        = get_field( 'title' );

if ( ! empty( $image ) ) {
	$class_name .= ' hero--bg';
}
if ( '1' === $block_type ) {
	$class_name .= ' hero--simple';
}

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<?php if ( $image && '0' === $block_type ) { ?>

			<div class="hero__img">
				<?php echo wp_get_attachment_image( $image, 'full', false, array( 'class' => 'img-fit' ) ); ?>

			</div>
		<?php } ?>

		<?php if ( get_field( 'show_video' ) && '0' === $block_type ) { ?>

			<div class="hero__video hero--play-video">
				<?php if ( have_rows( 'video_sources' ) ) { ?>

					<video autoplay loop muted playsinline
						poster="<?php echo esc_url( wp_get_attachment_image_url( $image, 'large' ) ); ?>">
						<?php
						while ( have_rows( 'video_sources' ) ) :
							the_row();
							?>

							<source src="<?php echo esc_attr( get_sub_field( 'video' ) ); ?>" type="video/<?php the_sub_field( 'type' ); ?>">

						<?php endwhile; ?>

					</video>

				<?php } ?>

				<?php if ( have_rows( 'video_for_desktop' ) ) { ?>

					<video loop muted playsinline preload="metadata" class="desktop"
						poster="<?php echo esc_url( wp_get_attachment_image_url( $image, 'full' ) ); ?>"
						style="display:none;">
						<?php
						while ( have_rows( 'video_for_desktop' ) ) :
							the_row();
							?>
							
							<source src="<?php echo esc_attr( get_sub_field( 'video' ) ); ?>" type="video/<?php the_sub_field( 'type' ); ?>">
						
						<?php endwhile; ?>

					</video>

				<?php } ?>

			</div>

		<?php } ?>

		<div class="hero__shadow"></div>

		<div class="hero__content">
			<div class="container hero__container">
				<div class="hero__text">

					<?php if ( $suptitle ) { ?>

						<div class="hero__suptitle"><?php echo wp_kses_post( $suptitle ); ?></div>

					<?php } ?>

					<?php if ( $ttl ) { ?>

						<h2 class="hero__title" itemprop="headline"><?php echo wp_kses_post( $ttl ); ?></h2>

					<?php } ?>

					<?php if ( $subtitle ) { ?>

						<div class="hero__subtitle"><?php echo wp_kses_post( $subtitle ); ?></div>

					<?php } ?>

				</div>

			</div>
		</div>
	</section>

<?php } ?>
