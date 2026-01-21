<?php
/**
 * Header.
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<?php if ( ! is_user_logged_in() ) { ?>

		<!-- Yandex.Metrika counter -->
		<!-- /Yandex.Metrika counter -->
	<?php } ?>

</head>

<body <?php body_class(); ?>>
<?php if ( ! is_user_logged_in() ) { ?>

	<!-- Yandex.Metrika counter -->
	<noscript></noscript>
	<!-- /Yandex.Metrika counter -->
<?php } ?>

<main class="site-page">
	<div class="site-page__content">

		<header class="header">
			<div class="container">
				<div class="header__inner">

					<?php
					$logo = get_field( 'logo', 'option' );
					if ( ! empty( $logo ) ) {
						?>

						<a class="header__logo" href="<?php echo esc_url( home_url() ); ?>" aria-label="<?php esc_html_e( 'Site Logo', 'lsweb' ); ?>"><?php echo wp_get_attachment_image( get_field( 'logo', 'option' ), 'medium', false, array( 'class' => '' ) ); ?></a>
					<?php } else { ?>

						<a class="header__logo" href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="Logo" width="112" height="12"></a>
					<?php } ?>

					<nav class="header__menu" aria-label="<?php esc_html_e( 'Site Navigation', 'lsweb' ); ?>">
						<div class="header__menu__wrapper" id="aria-controls-menu">
							<ul class="header__menu__ul menu d-desktop" role="menu" aria-label="<?php esc_html_e( 'Site Navigation', 'lsweb' ); ?>">
								<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
											'container'      => '',
											'menu_class'     => '',
											'menu_id'        => '',
											'walker'         => new Clean_Walker(),
											'tab_space'      => 8,
											'items_wrap'     => '%3$s',
										)
									);
								}
								?>

							</ul>
						</div>
					</nav>

					<div class="header__toggler" aria-expanded="false" aria-label="<?php esc_html_e( 'Toggle Navigation', 'lsweb' ); ?>" role="button" aria-haspopup="true" aria-controls="aria-controls-menu" tabindex="0">
						<div class="header__toggler__bars">
							<span class="bar"></span>
							<span class="bar"></span>
							<span class="bar"></span>
						</div>
					</div>				
				</div>
			</div>
		</header>
