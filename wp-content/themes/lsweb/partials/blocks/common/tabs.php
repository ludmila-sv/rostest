<?php
/**
 * Tabs.
 *
 * ARIA: https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Roles/tab_role#example
 *
 * @package lsweb
 */

$block_id = 'tabs-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'tabs';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$template = array(
	array(
		'acf/tab',
		array(),
	),
	array(
		'acf/tab',
		array(),
	),
);
$allowed_blocks = array(
	'acf/tab',
);

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>" data-tabs role="region" aria-label="<?php esc_html_e( 'Tabs', 'lsweb' ); ?>">

		<?php if ( have_rows( 'tabs' ) ) { ?>

			<div class="tabs__nav">
				<ul role="tablist" aria-label="<?php esc_html_e( 'Tabs', 'lsweb' ); ?>">
					<?php
					$i = 0;
					while ( have_rows( 'tabs' ) ) :
						the_row();
						$i++;
						$index = $i . '-' . $block['id'];
						$selected = 1 === $i ? 'true' : 'false';
						$tabindex = 1 === $i ? '0' : '-1';
						?>

						<li role="none" <?php if ( 1 === $i ) { echo 'class="active"'; } // phpcs:ignore?>><a class="tab-link" href="#tab-<?php echo $index; ?>" role="tab" aria-controls="tab-<?php echo $index; ?>" id="tab-btn-<?php echo $index; ?>" aria-selected="<?php echo $selected; ?>" tabindex="<?php echo $tabindex; ?>"><?php the_sub_field( 'tab_title' ); ?></a></li>
					<?php endwhile; ?>

				</ul>
			</div>

			<div class="tabs__content">
				<?php
				$i = 0;
				while ( have_rows( 'tabs' ) ) :
					the_row();
					$i++;
					$index = $i . '-' . $block['id'];
					?>

					<div class="tab" id="tab-<?php echo $index; // phpcs:ignore ?>" role="tabpanel" tabindex="0"<?php if ( 1 !== $i ) { echo ' hidden style="display: none;"'; } // phpcs:ignore?> aria-labelledby="tab-btn-<?php echo $index; // phpcs:ignore?>">
						
						<?php the_sub_field( 'tab_content' ); ?>
						
					</div>
				<?php endwhile; ?>

			</div>
		<?php } ?>

	</div>
<?php } ?>
