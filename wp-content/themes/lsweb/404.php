<?php
/**
 *  404 page template
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$subtitle404 = get_field( 'error404_subtitle', 'option' ) ? get_field( 'error404_subtitle', 'option' ) : __( '404 error', 'lsweb' );
$title404    = get_field( 'error404_title', 'option' ) ? get_field( 'error404_title', 'option' ) : __( 'Page Not Found', 'lsweb' );

get_header(); ?>

<div class="error-404">
	<div class="container">
		<div class="error-404__inner">
			<div class="error-404__info">
				<h1 class="error-404__title"><?php echo esc_html( $title404 ); ?></h1>
				<div class="error-404__subtitle"><?php echo esc_html( $subtitle404 ); ?></div>
				<div class="error-404__btns">
					<a class="btn btn--primary btn--red btn--arrow" href="/">
						<?php esc_html_e( 'Go Back Home', 'lsweb' ); ?>
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7 13L3 9M3 9L7 5M3 9H16C18.7614 9 21 11.2386 21 14C21 16.7614 18.7614 19 16 19H11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
