<?php
/**
 * Social Network Links
 *
 * @package lsweb
 */

$tab_number = isset( $args['tabs'] ) ? $args['tabs'] : 3;
$tabulation = '';

if ( $tab_number > 0 ) {
	for ( $i = 0; $i < $tab_number; $i++ ) {
		$tabulation .= "\t";
	}
}

$tabulation_a = '';
if ( $tab_number > 2 ) {
	for ( $i = 0; $i < $tab_number - 2; $i++ ) {
		$tabulation_a .= "\t";
	}
} else if ( $tab_number > 0 ) {
	for ( $i = 0; $i < $tab_number; $i++ ) {
		$tabulation_a .= "\t";
	}
}
?>

<?php if ( have_rows( 'footer_social_links', 'option' ) ) { ?>

	<?php echo $tabulation; // phpcs:ignore ?><div class="social">
		<?php
		while ( have_rows( 'footer_social_links', 'option' ) ) :
			the_row();
			$socnet_url = get_sub_field( 'link' );
			$socnet     = get_sub_field( 'social_net' );
			if ( file_exists( __DIR__ . '/social-' . esc_attr( $socnet ) . '.svg' ) ) {
				?>

				<?php echo $tabulation_a; // phpcs:ignore ?><a href="<?php echo esc_url( $socnet_url ); ?>" target="_blank" aria-label="<?php echo esc_html( $socnet ); ?>"><?php require __DIR__ . '/social-' . esc_attr( $socnet ) . '.svg'; ?></a>
			<?php } ?>
		<?php endwhile; ?>

	<?php echo $tabulation; // phpcs:ignore ?></div>
<?php } ?>
