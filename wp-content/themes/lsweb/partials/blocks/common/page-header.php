<?php
/**
 * Page Header.
 *
 * @package lsweb
 */

$block_id = 'page-header-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_name = 'page-header';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align-' . $block['align'];
}
if ( get_field( 'full_width' ) ) {
	$class_name .= ' full-width';
}
if ( get_field( 'color' ) ) {
	$class_name .= ' bg-color-' . get_field( 'color' );
}

$ttl = get_field( 'title' );
$txt = get_field( 'text' );

if ( ! empty( $block['data']['is_preview'] ) ) {
	?>
	<img src="<?php echo esc_url( $block['data']['preview'] ); ?>" alt="" style="width: 100%; height: auto;">
	<?php
} else {
	?>

	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="container">
			<?php if ( $ttl ) { ?>

				<h1 class="page-header__title" itemprop="headline"><?php echo wp_kses_post( $ttl ); ?></h1>
			<?php } ?>
			<?php if ( $txt ) { ?>

				<div class="page-header__txt"><?php echo wp_kses_post( $txt ); ?></div>
			<?php } ?>
			
		</div>
	</section>
<?php } ?>