<?php
/**
 *  Filter doctors.
 *
 * @package lsweb
 */

// phpcs:disable WordPress.Security.NonceVerification.Missing
// phpcs:disable WordPress.Security.NonceVerification.Recommended

$get_specialization = isset( $_GET['spec'] ) && 'all' !== $_GET['spec'] ? sanitize_text_field( wp_unslash( $_GET['spec'] ) ) : '';
$get_city           = isset( $_GET['ci'] ) && 'all' !== $_GET['ci'] ? sanitize_text_field( wp_unslash( $_GET['ci'] ) ) : '';
$get_sort           = isset( $_GET['sort'] ) && 'all' !== $_GET['sort'] ? sanitize_text_field( wp_unslash( $_GET['sort'] ) ) : '';

$args_specializations = array(
	'taxonomy' => 'specialization',
	'orderby'  => 'name',
	'order'    => 'ASC',
);
$specializations      = get_terms( $args_specializations );

$args_cities = array(
	'taxonomy' => 'city',
	'orderby'  => 'name',
	'order'    => 'ASC',
);
$cities      = get_terms( $args_cities );
?>

<div class="archive__filter">
	<form class="archive__form doctor-selector" method="get" action="/doctors/">
		
		<div class="doctor-selector__selects">
			<div class="doctor-selector__select">
				<select name="spec" class="select-styled">
					<?php if ( ! empty( $specializations ) && ! is_wp_error( $specializations ) ) { ?>

						<option  <?php if ( '' === $get_specialization ) { echo 'selected '; } // phpcs:ignore ?>value="all"><?php esc_html_e( 'Choose Specialization', 'lsweb' ); ?></option>
						<?php
						foreach ( $specializations as $spec ) {
							?>

							<option <?php if ( $spec->slug === $get_specialization ) { echo 'selected '; } // phpcs:ignore ?>value="<?php echo esc_attr( $spec->slug ); ?>"><?php echo esc_attr( $spec->name ); ?></option>
							<?php
						}
					}
					?>

				</select>
			</div>

			<div class="doctor-selector__select">
				<select name="ci" class="select-styled">
					<?php if ( ! empty( $cities ) && ! is_wp_error( $cities ) ) { ?>

						<option  <?php if ( '' === $get_city ) { echo 'selected '; } // phpcs:ignore ?>value="all"><?php esc_html_e( 'Choose City', 'lsweb' ); ?></option>
						<?php
						foreach ( $cities as $city ) {
							?>

							<option <?php if ( $city->slug === $get_city ) { echo 'selected '; } // phpcs:ignore ?>value="<?php echo esc_attr( $city->slug ); ?>"><?php echo esc_attr( $city->name ); ?></option>
							<?php
						}
					}
					?>

				</select>
			</div>

			<div class="doctor-selector__select">
				<select name="sort" class="select-styled">
					<option  <?php if ( '' === $get_sort ) { echo 'selected '; } // phpcs:ignore ?>value="all"><?php esc_html_e( 'Sort By', 'lsweb' ); ?></option>
					<option <?php if ( 'rating' === $get_sort ) { echo 'selected '; } // phpcs:ignore ?>value="rating"><?php esc_html_e( 'Rating', 'lsweb' ); ?></option>
					<option <?php if ( 'price' === $get_sort ) { echo 'selected '; } // phpcs:ignore ?>value="price"><?php esc_html_e( 'Price', 'lsweb' ); ?></option>
					<option <?php if ( 'experience' === $get_sort ) { echo 'selected '; } // phpcs:ignore ?>value="experience"><?php esc_html_e( 'Experience', 'lsweb' ); ?></option>
				</select>
			</div>
		</div>

		<div class="doctor-selector__submit">
			<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Show', 'lsweb' ); ?></button>
		</div>

	</form>

</div>
