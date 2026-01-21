<?php
/**
 * Pre-heading.
 *
 * @package lsweb
 */

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<div class="pre-heading"><?php the_field( 'pre-heading' ); ?></div>
<?php } ?>
