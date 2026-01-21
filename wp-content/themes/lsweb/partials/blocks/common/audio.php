<?php
/**
 * Audio button.
 *
 * @package lsweb
 */

$block_id = 'audio-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'audio-button';
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

	<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<a class="btn-audio" href="#" data-audio="<?php the_field( 'file' ); ?>" role="button" aria-label="<?php esc_html_e( 'Play/Stop Audio', 'lsweb' ); ?>" aria-pressed="true/false"><span class="btn-audio__play"></span><?php the_field( 'title' ); ?></a>
	</div>
<?php } ?>