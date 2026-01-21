<?php
/**
 * Gutenberg Customization.
 *
 * @package lsweb
 */

/**
 * Declare registration of block styles for headings, paragraphs, buttons and other standard blocks.
 *
 * @return void
 */
function lsweb_register_block_styles() {

	if ( function_exists( 'register_block_style' ) ) {

		$theme_block_styles = array(

			'core/paragraph' => array(
				array(
					'name'  => 'lead',
					'label' => __( 'Lead', 'lsweb' ),
				),
				array(
					'name'  => 'caption',
					'label' => __( 'Caption', 'lsweb' ),
				),
				array(
					'name'  => 'overline',
					'label' => __( 'Overline', 'lsweb' ),
				),
				array(
					'name'  => 'narrow',
					'label' => __( 'Narrow', 'lsweb' ),
				),
				array(
					'name'  => 'narrow24',
					'label' => __( 'Narrow 24px', 'lsweb' ),
				),
			),

			'core/button'    => array(
				array(
					'name'  => 'primary',
					'label' => __( 'Primary', 'lsweb' ),
				),
				array(
					'name'  => 'secondary',
					'label' => __( 'Secondary', 'lsweb' ),
				),
				array(
					'name'  => 'tertiary',
					'label' => __( 'Tertiary (Link)', 'lsweb' ),
				),
			),

			'core/list'      => array(
				array(
					'name'  => 'checked',
					'label' => __( 'Checked', 'lsweb' ),
				),
				array(
					'name'  => 'checked-circle',
					'label' => __( 'Checked in Circle', 'lsweb' ),
				),
				array(
					'name'  => 'light',
					'label' => __( 'Light', 'lsweb' ),
				),
			),

		);

		if ( is_array( $theme_block_styles ) ) {
			foreach ( $theme_block_styles as $block_name => $block_styles ) {
				// it's quick short fallback if there's only one style and someone made mistake, forgetting wrapping it into array - we just wrap it.
				if ( ! empty( $block_styles['name'] ) ) {
					$block_styles = array( $block_styles );
				}

				foreach ( $block_styles as $style_properties ) {
					register_block_style( $block_name, $style_properties );
				}
			}
		}
	}
}

add_filter( 'init', 'lsweb_register_block_styles', 10 );

// Restrict acf color picker.
add_action(
	'admin_footer',
	function () {
		?>
		<script>
		if (window.acf) {
			acf.addFilter('color_picker_args', function (args, $field) {

			args.palettes = [
				'#252c3f',
				'#7b5b5b',
				'#af8e8e',
				'#f0efea',
				'#ffffff',
			];

			return args;
			});
		}
		</script>
		<?php
	}
);
