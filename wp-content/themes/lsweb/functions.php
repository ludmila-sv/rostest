<?php
/**
 *  Theme Functions.
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Reqire files with theme settings.
require_once __DIR__ . '/includes/acf-load.php';
require_once __DIR__ . '/includes/acf-options.php';
require_once __DIR__ . '/includes/wp-cli-acf-tools.php';
require_once __DIR__ . '/includes/acf-enhancements.php';
require_once __DIR__ . '/includes/gutenberg-customizations.php';
require_once __DIR__ . '/includes/theme-customizations.php';
require_once __DIR__ . '/includes/styles-scripts.php';
require_once __DIR__ . '/includes/wp-cleanup.php';
require_once __DIR__ . '/includes/cpt.php';
require_once __DIR__ . '/includes/class-clean-walker.php';
require_once __DIR__ . '/includes/ajax.php';
require_once __DIR__ . '/includes/translation.php';
