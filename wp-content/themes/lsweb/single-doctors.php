<?php
/**
 * Doctor.
 *
 * Template Name: Страница врача
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();

$experience = get_field( 'experience' );
$price      = get_field( 'price' );
$rating     = get_field( 'rating' );

/* translators: %s is replaced with the number of years */
$experience = ! empty( $experience ) ? sprintf( _n( '%s year', '%s years', $experience, 'lsweb' ), $experience ) : 0;

$doctor_desc = has_excerpt() ? get_the_excerpt() : '';
?>

<div role="article" class="doctor" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="identifier" content="<?php echo esc_attr( get_the_ID() ); ?>">
	<div itemprop="articleBody">
		
		<div class="container">

			<div class="doctor__intro">
				<div class="doctor__photo">
					<?php
					$thumbnail = get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'doctor__photo__img', 'alt' => '', 'itemprop' => 'image' ) ); // phpcs:ignore
					if ( $thumbnail ) {
						echo $thumbnail; // phpcs:ignore
					} else {
						?>

						<img class="doctor__photo__person" src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/person.svg'; ?>" alt="<?php echo esc_html( get_the_title( $post->ID ) ); ?>">
					<?php } ?>

				</div>

				<div class="doctor__info">
					<h1 class="doctor__title" itemprop="headline"><?php the_title(); ?></h1>
					
					<div class="doctor__specialization">
						<span class="doctor__specialization__title"><?php esc_html_e( 'Doctor\'s specialization', 'lsweb' ); ?>:</span>

						<?php
						$specializations = get_the_terms( $post->ID, 'specialization' );
						if ( ! empty( $specializations ) ) {
							?>

							<span class="doctor__specializations__list">
								<?php
								$n_specializations = count( $specializations );

								$i = 0;
								foreach ( $specializations as $spec ) {
									++$i;
									?>

									<span class="doctor__specializations__list__item"><?php echo esc_html( $spec->name ); if ( $i < $n_specializations ) { echo ','; } // phpcs:ignore ?></span>
								<?php } ?>
								
							</span>
						<?php } ?>

					</div>

					<?php if ( $doctor_desc ) { ?>

						<div class="doctor__desc">
							<?php echo wp_kses_post( $doctor_desc ); ?>

						</div>
					<?php } ?>

					<div class="doctor__options">
						<?php if ( ! empty( $experience ) ) { ?>

							<div class="doctor__experience">
								<span class="doctor__options__title"><?php esc_html_e( 'experience', 'lsweb' ); ?>:</span>
								<?php echo esc_html( $experience ); ?>

							</div>
						<?php } ?>
						<?php if ( ! empty( $price ) ) { ?>

							<div class="doctor__price">
								<span class="doctor__options__title"><?php esc_html_e( 'price', 'lsweb' ); ?>:</span>
								<?php echo esc_html( $price ); ?>₽

							</div>
						<?php } ?>

						<?php if ( ! empty( $rating ) ) { ?>

							<div class="doctor__rating">
								<span class="doctor__options__title"><?php esc_html_e( 'rating', 'lsweb' ); ?>:</span>
								<?php echo esc_html( $rating ); ?>

							</div>
						<?php } ?>

					</div>
					
					<div class="doctor__city">
						<span class="doctor__city__title"><?php esc_html_e( 'Doctor\'s city', 'lsweb' ); ?>:</span>

						<?php
						$cities = get_the_terms( $post->ID, 'city' );
						if ( ! empty( $cities ) ) {
							?>

							<span class="doctor__cities__list">
								<?php
								$n_cities = count( $cities );

								$i = 0;
								foreach ( $cities as $spec ) {
									++$i;
									?>

									<span class="doctor__cities__list__item"><?php echo esc_html( $spec->name ); if ( $i < $n_cities ) { echo ','; } // phpcs:ignore ?></span>
								<?php } ?>
								
							</span>
						<?php } ?>

					</div>
				</div>
			</div>

			<?php the_content(); ?>

		</div>

	</div>
</div>

<?php

get_footer();
