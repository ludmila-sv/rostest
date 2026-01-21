<?php
/**
 * Category filter
 *
 * @package lsweb
 */

$args = array(
	'hierarchical'     => false,
	'show_option_all'  => __( 'All Categories', 'lsweb' ),
	'show_option_none' => '',
	'style'            => 'list',
	'separator'        => '',
	'title_li'         => '',
	'orderby'          => 'name',
	'order'            => 'ASC',
);
?>

<div class="category-filter">
	<div class="category-filter__wrapper">
		<div class="category-filter__inner">
			<div class="category-filter__chosen"><?php if ( is_category() ) { single_cat_title(); } else { echo __( 'All Categories', 'lsweb' ); } // phpcs:ignore ?><span class="category-filter__toggler"></span></div>
			<div class="category-filter__list">
				<ul>
					<?php wp_list_categories( $args ); ?>

				</ul>
			</div>
		</div>
	</div>
</div>
