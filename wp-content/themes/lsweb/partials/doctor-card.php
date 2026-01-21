<?php
/**
 *  Blog archive page - single post block
 *
 * @package lsweb
 */

if ( ! empty( $args ) ) {
	$doctor = $args['post'];
} else {
	$doctor = $post;
}

$current_post_id = isset( $doctor->ID ) ? $doctor->ID : 1;

$experience = get_field( 'experience', $current_post_id );
$price      = get_field( 'price', $current_post_id );
$rating     = get_field( 'rating', $current_post_id );

/* translators: %s is replaced with the number of years */
$experience = ! empty( $experience ) ? sprintf( _n( '%s year', '%s years', $experience, 'lsweb' ), $experience ) : 0;
?>

<div class="doctor-card" itemprop="itemListElement" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="identifier" content="<?php echo esc_attr( $current_post_id ); ?>">
	<meta itemprop="url" content="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>">

	<a href="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>" class="doctor-card__thumbnail" aria-label="<?php esc_html_e( 'Main post image', 'lsweb' ); ?>">
		<?php
		$thumbnail = get_the_post_thumbnail( $doctor->ID, 'large', array( 'class' => 'doctor-card__thumbnail__img', 'alt' => '', 'itemprop' => 'image' ) ); // phpcs:ignore
		if ( $thumbnail ) {
			echo $thumbnail; // phpcs:ignore
		} else {
			?>

			<img class="doctor-card__thumbnail__person" src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/person.svg'; ?>" alt="<?php echo esc_html( get_the_title( $doctor->ID ) ); ?>">
		<?php } ?>

	</a>

	<div class="doctor-card__info">
		<h3 class="doctor-card__title" itemprop="headline"><a href="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>"><?php echo esc_html( get_the_title( $current_post_id ) ); ?></a></h3>
					
		<div class="doctor-card__specialization">
			<span class="doctor-card__specialization__title"><?php esc_html_e( 'Doctor\'s specialization', 'lsweb' ); ?>:</span>

			<?php
			$specializations = get_the_terms( $doctor->ID, 'specialization' );
			if ( ! empty( $specializations ) ) {
				?>

				<span class="doctor-card__specializations__list">
					<?php
					$n_specializations = count( $specializations );

					$i = 0;
					foreach ( $specializations as $spec ) {
						++$i;
						?>

						<span class="doctor-card__specializations__list__item"><?php echo esc_html( $spec->name ); if ( $i < $n_specializations ) { echo ','; } // phpcs:ignore ?></span>
					<?php } ?>
					
				</span>
			<?php } ?>

		</div>

		<div class="doctor-card__options">
			<?php if ( ! empty( $experience ) ) { ?>

				<div class="doctor-card__experience">
					<span class="doctor-card__options__title"><?php esc_html_e( 'experience', 'lsweb' ); ?>:</span>
					<?php echo esc_html( $experience ); ?>

				</div>
			<?php } ?>
			<?php if ( ! empty( $price ) ) { ?>

				<div class="doctor-card__price">
					<span class="doctor-card__options__title"><?php esc_html_e( 'price', 'lsweb' ); ?>:</span>
					<?php echo esc_html( $price ); ?>₽

				</div>
			<?php } ?>

			<?php if ( ! empty( $rating ) ) { ?>

				<div class="doctor-card__rating">
					<span class="doctor-card__options__title"><?php esc_html_e( 'rating', 'lsweb' ); ?>:</span>
					<?php echo esc_html( $rating ); ?>

				</div>
			<?php } ?>

		</div>
		
		<div class="doctor-card__city">
			<span class="doctor-card__city__title"><?php esc_html_e( 'Doctor\'s city', 'lsweb' ); ?>:</span>

			<?php
			$cities = get_the_terms( $doctor->ID, 'city' );
			if ( ! empty( $cities ) ) {
				?>

				<span class="doctor-card__cities__list">
					<?php
					$n_cities = count( $cities );

					$i = 0;
					foreach ( $cities as $spec ) {
						++$i;
						?>

						<span class="doctor-card__cities__list__item"><?php echo esc_html( $spec->name ); if ( $i < $n_cities ) { echo ','; } // phpcs:ignore ?></span>
					<?php } ?>
					
				</span>
			<?php } ?>

		</div>

		<div class="doctor-card__excerpt" itemprop="articleBody"><?php echo esc_html( get_the_excerpt( $current_post_id ) ); ?></div>

		<div class="doctor-card__link">
			<a href="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>"><?php esc_html_e( 'Read more', 'lsweb' ); ?></a>
		</div>
	</div>
</div>
