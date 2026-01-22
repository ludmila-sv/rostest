<?php
/**
 * Doctors archive.
 *
 * @package lsweb
 */

// phpcs:disable WordPress.Security.NonceVerification.Missing
// phpcs:disable WordPress.Security.NonceVerification.Recommended

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$get_specialization = isset( $_GET['spec'] ) && 'all' !== $_GET['spec'] ? sanitize_text_field( wp_unslash( $_GET['spec'] ) ) : '';
$get_city           = isset( $_GET['ci'] ) && 'all' !== $_GET['ci'] ? sanitize_text_field( wp_unslash( $_GET['ci'] ) ) : '';
$get_sort           = isset( $_GET['sort'] ) && 'all' !== $_GET['sort'] ? sanitize_text_field( wp_unslash( $_GET['sort'] ) ) : '';

$args = array(
	'post_type'      => 'doctors',
	'posts_per_page' => 9,
	'paged'          => $paged,
);
if ( ! empty( $get_specialization ) || ! empty( $get_city ) ) {
	$args['tax_query'] = array();
	if ( ! empty( $get_specialization ) ) {
		array_push(
			$args['tax_query'],
			array(
				'taxonomy' => 'specialization',
				'field'    => 'slug',
				'terms'    => $get_specialization,
			)
		);
	}
	if ( ! empty( $get_city ) ) {
		array_push(
			$args['tax_query'],
			array(
				'taxonomy' => 'city',
				'field'    => 'slug',
				'terms'    => $get_city,
			)
		);
	}
}

if ( ! empty( $get_sort ) ) {
	$args['meta_key'] = $get_sort;
	$args['orderby']  = 'meta_value_num';
	$args['order']    = 'price' === $get_sort ? 'ASC' : 'DESC';
}

$doctors_query = new WP_Query( $args );
?>

<div class="archive" itemscope itemtype="http://schema.org/Article" role="article">
	<meta itemprop="identifier" content="doctors-archive">
	<div class="container" itemprop="articleBody">
		<h1 itemprop="headline"><?php esc_html_e( 'All Doctors', 'lsweb' ); ?></h1>

		<div class="row">
			<div class="col-lg-4">
				<?php get_template_part( 'partials/doctors-filter' ); ?>

			</div>

			<div class="col-lg-8">
				<div class="archive__posts" itemscope itemtype="https://schema.org/ItemList">
					<?php
					if ( $doctors_query->have_posts() ) {
						while ( $doctors_query->have_posts() ) :
							$doctors_query->the_post();
							get_template_part( 'partials/doctor-card', null, array( 'post' => $post ) ); // phpcs:ignore
						endwhile;

						$nav = get_the_posts_pagination(
							array(
								'format'             => '?paged=%#%',
								'total'              => $doctors_query->max_num_pages,
								'prev_text'          => '',
								'next_text'          => '',
								'screen_reader_text' => __( 'Pagination', 'lsweb' ),
							)
						);
						$nav = str_replace( '<h2 class="screen-reader-text">' . __( 'Pagination', 'lsweb' ) . '</h2>', '', $nav );
						$nav = str_replace( ' role="navigation"', '', $nav );
						echo $nav; //phpcs:ignore

						wp_reset_postdata();

					} else {
						?>
						
						<p class="archive__no-results"><?php esc_html_e( 'Nothing found.', 'lsweb' ); ?></p>
					<?php } ?>

				</div>

			</div>
		</div>
	</div>
</div>

<?php

get_footer();
