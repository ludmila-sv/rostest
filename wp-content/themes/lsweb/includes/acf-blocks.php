<?php
/**
 *  Place all ACF powered blocks definitions here.
 *
 * @package lsweb
 */

/**
 * Registers ACF blocks.
 */
function lsweb_register_acf_block_types() {

	acf_register_block_type(
		array(
			'name'            => 'hero',
			'title'           => __( 'Hero', 'lsweb' ),
			'description'     => __( 'Hero block with a heading, some text, and a background image or a video.', 'lsweb' ),
			'render_template' => 'partials/blocks/common/hero.php',
			'category'        => 'customgb',
			'keywords'        => array( 'hero' ),
			'mode'            => 'preview',
			'icon'            => 'cover-image',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/hero.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'page-header',
			'title'           => __( 'Page Header', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/page-header.php',
			'category'        => 'customgb',
			'keywords'        => array( 'page header', 'header' ),
			'mode'            => 'edit',
			'icon'            => 'heading',
			'supports'        => array(
				'align'           => true,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/page-header.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'page-header-2',
			'title'           => __( 'Page Header v.2', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/project-specific/page-header-2.php',
			'category'        => 'customgb',
			'keywords'        => array( 'page header', 'header' ),
			'mode'            => 'edit',
			'icon'            => 'heading',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/page-header-2.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'pre-heading',
			'title'           => __( 'Pre-heading', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/pre-heading.php',
			'category'        => 'customgb',
			'keywords'        => array( 'pre-heading', 'preheading' ),
			'mode'            => 'edit',
			'icon'            => 'heading',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/pre-heading.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'cta',
			'title'           => __( 'CTA', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/cta.php',
			'category'        => 'customgb',
			'keywords'        => array( 'cta' ),
			'mode'            => 'preview',
			'icon'            => 'megaphone',
			'supports'        => array(
				'align'           => true,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/cta.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'advantages',
			'title'           => __( 'Advantages', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/advantages.php',
			'category'        => 'customgb',
			'keywords'        => array( 'advantages' ),
			'mode'            => 'edit',
			'icon'            => 'thumbs-up',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/advantages.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'logos-slider',
			'title'           => __( 'Logos slider', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/logos-slider.php',
			'category'        => 'customgb',
			'keywords'        => array( 'logos' ),
			'mode'            => 'edit',
			'icon'            => 'tag',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/logos-slider.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'statistics',
			'title'           => __( 'Statistics', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/statistics.php',
			'category'        => 'customgb',
			'keywords'        => array( 'statistics' ),
			'mode'            => 'edit',
			'icon'            => 'chart-bar',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'enqueue_script'  => get_template_directory_uri() . '/assets/js/gb/statistics.js',
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/statistics.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'accordion',
			'title'           => __( 'Accordion', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/accordion.php',
			'category'        => 'customgb',
			'keywords'        => array( 'accordion' ),
			'mode'            => 'edit',
			'icon'            => 'menu-alt',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/accordion.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'tabs',
			'title'           => __( 'Tabs', 'lsweb' ),
			'description'     => __( 'Tabs with the WYSIWYG editor for each tab', 'lsweb' ),
			'render_template' => 'partials/blocks/common/tabs.php',
			'category'        => 'customgb',
			'keywords'        => array( 'tabs' ),
			'icon'            => 'admin-page',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/tabs.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'tabs2',
			'title'           => __( 'Tabs GB', 'lsweb' ),
			'description'     => __( 'Tabs that allow to insert any GB into a tab.', 'lsweb' ),
			'render_template' => 'partials/blocks/common/tabs2.php',
			'category'        => 'customgb',
			'keywords'        => array( 'tabs' ),
			'icon'            => 'admin-page',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/tabs.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'tab',
			'title'           => __( 'Tab', 'lsweb' ),
			'description'     => __( 'One Tab for the Tabs block.' ),
			'render_template' => 'partials/blocks/common/tab.php',
			'category'        => 'customgb',
			'keywords'        => array( 'tab' ),
			'parent'          => array(
				'acf/tabs2',
			),
			'icon'            => 'media-default',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'slider',
			'title'           => __( 'Slider', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/slider.php',
			'category'        => 'customgb',
			'keywords'        => array( 'slider' ),
			'icon'            => 'format-gallery',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/slider.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'slider-slide',
			'title'           => __( 'Slide', 'lsweb' ),
			'description'     => __( 'Slide used inside slider block', 'lsweb' ),
			'render_template' => 'partials/blocks/common/slider-slide.php',
			'category'        => 'customgb',
			'keywords'        => array( 'slide' ),
			'mode'            => 'preview',
			'parent'          => array(
				'acf/slider',
			),
			'icon'            => 'images-alt2',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'video',
			'title'           => __( 'Video', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/video.php',
			'category'        => 'customgb',
			'keywords'        => array( 'video', 'text' ),
			'mode'            => 'edit',
			'icon'            => 'video-alt3',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/video.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'audio',
			'title'           => __( 'Audio Button', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/audio.php',
			'category'        => 'customgb',
			'keywords'        => array( 'autio' ),
			'mode'            => 'edit',
			'icon'            => 'embed-audio',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/audio.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'img-txt',
			'title'           => __( 'Image & Text', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/img-txt.php',
			'category'        => 'customgb',
			'keywords'        => array( 'image', 'text' ),
			'icon'            => 'align-right',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/img-txt.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'full-width-img-txt',
			'title'           => __( 'Full-Width Image&Text', 'lsweb' ),
			'description'     => '',
			'render_template' => 'partials/blocks/common/full-width-img-txt.php',
			'category'        => 'customgb',
			'keywords'        => array( 'image', 'text' ),
			'icon'            => 'align-right',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/full-width-img-txt.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'text-bg',
			'title'           => __( 'Text Block', 'lsweb' ),
			'description'     => __( 'Text on Colored Background', 'lsweb' ),
			'render_template' => 'partials/blocks/common/text-bg.php',
			'category'        => 'customgb',
			'keywords'        => array( 'image', 'text' ),
			'icon'            => 'align-right',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/text-bg.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'page-nav',
			'title'           => __( 'In-Page Navigation', 'lsweb' ),
			'description'     => __( 'Navigation that sticks to the top when the page is scrolled below it.', 'lsweb' ),
			'render_template' => 'partials/blocks/common/page-nav.php',
			'category'        => 'customgb',
			'keywords'        => array( 'navigation', 'menu' ),
			'mode'            => 'edit',
			'icon'            => 'editor-ul',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview'    => get_template_directory_uri() . '/includes/gb-preview/page-nav.png',
						'is_preview' => true,
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'bg',
			'title'           => __( 'Colored Background', 'lsweb' ),
			'description'     => __( 'Allows to add a background to any block', 'lsweb' ),
			'render_template' => 'partials/blocks/common/bg.php',
			'category'        => 'customgb',
			'keywords'        => array( 'common', 'content', 'fixed', 'width' ),
			'icon'            => 'admin-customizer',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'fixed-width',
			'title'           => __( 'Fixed Width', 'lsweb' ),
			'description'     => __( 'Fixed width content (wysiwyg)', 'lsweb' ),
			'render_template' => 'partials/blocks/common/fixed-width.php',
			'category'        => 'customgb',
			'keywords'        => array( 'common', 'content', 'fixed', 'width' ),
			'icon'            => 'fullscreen-exit-alt',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'full-width',
			'title'           => __( 'Full Width', 'lsweb' ),
			'description'     => __( 'Full width content for posts.', 'lsweb' ),
			'render_template' => 'partials/blocks/common/full-width.php',
			'category'        => 'customgb',
			'keywords'        => array( 'common', 'content', 'full', 'width' ),
			'icon'            => 'fullscreen-alt',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'css',
			'title'           => __( 'Custom css', 'lsweb' ),
			'description'     => __( 'Custom styles for the page.', 'lsweb' ),
			'render_template' => 'partials/blocks/common/css.php',
			'category'        => 'customgb',
			'keywords'        => array( 'css' ),
			'mode'            => 'edit',
			'icon'            => 'editor-code',
			'supports'        => array(
				'align'           => false,
				'anchor'          => true,
				'customClassName' => true,
				'jsx'             => false,
			),
		)
	);
}

// Check if function exists and hook into setup.
if ( function_exists( 'acf_register_block_type' ) ) {
	add_action( 'acf/init', 'lsweb_register_acf_block_types' );
}
