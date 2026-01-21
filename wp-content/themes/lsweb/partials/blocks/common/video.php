<?php
/**
 * Custom Video.
 *
 * @package lsweb
 */

$block_id = 'custom-video-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'custom-video';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
$video_place = get_field( 'video_place' );
$video_place = $video_place ? $video_place : 'popup';
$video_preview = get_field( 'video_bg' );
$video_source = get_field( 'video_source' );
$video_embed = get_field( 'video_embed' );
$video_iframe = get_field( 'video_iframe' );
$video_iframe = $video_iframe ? str_replace( 'iframe', 'div', get_field( 'video_iframe' ) ) : '';
$video_iframe = $video_iframe ? str_replace( 'src', 'data-src', $video_iframe ) : '';
$video_link = get_field( 'video_link' );
$video_auto = get_field( 'video_auto' );
$video_class = 'custom-video__video';
$img_class = 'custom-video__poster';

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>" role="region" aria-label="<?php esc_html_e( 'Video', 'lsweb' ); ?>">
		<div class="<?php echo esc_attr( $video_class ); ?>" data-video-wrapper>
			<?php echo wp_get_attachment_image( $video_preview, 'full', false, array( 'class' => $img_class ) ); ?>

			<?php if ( 'external' === $video_source ) { ?>
				<?php if ( 'iframe' === $video_embed ) { ?>

					<div data-video-iframe>
						<?php
						echo $video_iframe; // phpcs:ignore
						?>

					</div>

					<div class="custom-video__btn"><a href="#iframe" class="btn--play" data-video-play="<?php echo esc_attr( $video_place ); ?>" role="button" aria-label="<?php esc_html_e( 'Play Video', 'lsweb' ); ?>"></a></div>
				<?php } else { ?>
				
					<div class="custom-video__btn"><a href="<?php echo esc_url( $video_link ); ?>" class="btn--play" data-video-play="<?php echo esc_attr( $video_place ); ?>" role="button" aria-label="<?php esc_html_e( 'Play Video', 'lsweb' ); ?>"></a></div>
				<?php } ?>
			<?php } elseif ( have_rows( 'wp_video' ) ) { ?>
				<?php if ( 'auto' === $video_auto ) { ?>

					<div class="video__iframe-wrapper">
						<video autoplay muted>
							<?php
							while ( have_rows( 'wp_video' ) ) :
								the_row();
								?>

								<source src="<?php echo esc_url( wp_get_attachment_url( get_sub_field( 'file' ) ) ); ?>" type="video/<?php the_sub_field( 'type' ); ?>">
							<?php endwhile; ?>

						</video>
					</div>
				<?php } else { ?>

					<div data-wp-video>
						<?php
						while ( have_rows( 'wp_video' ) ) :
							the_row();
							?>

							<div data-wp-video-source data-src="<?php echo esc_url( wp_get_attachment_url( get_sub_field( 'file' ) ) ); ?>" data-type="video/<?php the_sub_field( 'type' ); ?>"></div>
						<?php endwhile; ?>

					</div>

					<div class="custom-video__btn"><a href="#" class="btn--play" data-video-play="<?php echo esc_attr( $video_place ); ?>" role="button" aria-label="<?php esc_html_e( 'Play Video', 'lsweb' ); ?>"></a></div>
				<?php } ?>
			<?php } ?>

		</div>
	</div>
<?php } ?>
