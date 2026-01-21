<?php
/**
 * Register custom post types.
 *
 * @package lsweb
 */

/**
 * Register custom post types.
 *
 * @see get_post_type_labels() for label keys.
 */
function lsweb_cpt_init() {
	/* Doctor */
	$labels = array(
		'name'               => __( 'Doctor', 'lsweb' ),
		'singular_name'      => __( 'Doctor', 'lsweb' ),
		'menu_name'          => __( 'Doctors', 'lsweb' ),
		'name_admin_bar'     => __( 'Doctor', 'lsweb' ),
		'add_new'            => __( 'Add New Doctor', 'lsweb' ),
		'add_new_item'       => __( 'Add', 'lsweb' ),
		'new_item'           => __( 'New Doctor', 'lsweb' ),
		'edit_item'          => __( 'Edit Doctor', 'lsweb' ),
		'view_item'          => __( 'View Doctor', 'lsweb' ),
		'all_items'          => __( 'All Doctors', 'lsweb' ),
		'search_items'       => __( 'Search Doctor', 'lsweb' ),
		'parent_item_colon'  => __( 'Parent Doctor', 'lsweb' ),
		'not_found'          => __( 'No Doctors', 'lsweb' ),
		'not_found_in_trash' => __( 'No Doctors found in Trash.', 'lsweb' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'doctors' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 22,
		'menu_icon'          => 'dashicons-businesswoman',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
	);

	register_post_type( 'doctors', $args );

	/* Register custom taxonomies */

	// Register custom taxonomy 'specialization' to custom post type "doctors".

	$tax_labels = array(
		'name'              => __( 'Specialization', 'lsweb' ),
		'singular_name'     => __( 'Specialization', 'lsweb' ),
		'search_items'      => __( 'Search Specialization', 'lsweb' ),
		'all_items'         => __( 'All Specializations', 'lsweb' ),
		'parent_item'       => __( 'Parent Specialization', 'lsweb' ),
		'parent_item_colon' => __( 'Parent Specialization', 'lsweb' ),
		'edit_item'         => __( 'Edit Specialization', 'lsweb' ),
		'update_item'       => __( 'Update Specialization', 'lsweb' ),
		'add_new_item'      => __( 'Add New Specialization', 'lsweb' ),
		'new_item_name'     => __( 'New Specialization', 'lsweb' ),
		'menu_name'         => __( 'Specializations', 'lsweb' ),
		'not_found'         => __( 'No Specializations', 'lsweb' ),
	);

	$tax_args = array(
		'hierarchical'      => true,
		'labels'            => $tax_labels,
		'public'            => true,
		'query_var'         => 'specialization',
		'rewrite'           => array( 'slug' => 'specialization' ),
		'meta_box_cb'       => 'null',
		'show_admin_column' => true,
		'show_in_rest'      => true, // true - visible in GB!
		'rest_base'         => null, // $taxonomy
	);

	register_taxonomy( 'specialization', 'doctors', $tax_args );

	// Register custom taxonomy 'city' to custom post type "doctors".

	$tax_labels_city = array(
		'name'              => __( 'City', 'lsweb' ),
		'singular_name'     => __( 'City', 'lsweb' ),
		'search_items'      => __( 'Search Cities', 'lsweb' ),
		'all_items'         => __( 'All Cities', 'lsweb' ),
		'parent_item'       => __( 'Parent City', 'lsweb' ),
		'parent_item_colon' => __( 'Parent City', 'lsweb' ),
		'edit_item'         => __( 'Edit City', 'lsweb' ),
		'update_item'       => __( 'Update City', 'lsweb' ),
		'add_new_item'      => __( 'Add New City', 'lsweb' ),
		'new_item_name'     => __( 'New City', 'lsweb' ),
		'menu_name'         => __( 'Cities', 'lsweb' ),
		'not_found'         => __( 'No Cities', 'lsweb' ),
	);

	$tax_args_city = array(
		'hierarchical'      => true,
		'labels'            => $tax_labels_city,
		'public'            => true,
		'query_var'         => 'city',
		'rewrite'           => array( 'slug' => 'city' ),
		'meta_box_cb'       => 'null',
		'show_admin_column' => true,
		'show_in_rest'      => true, // true - visible in GB!
		'rest_base'         => null,
	);

	register_taxonomy( 'city', 'doctors', $tax_args_city );
}

add_action( 'init', 'lsweb_cpt_init' );
