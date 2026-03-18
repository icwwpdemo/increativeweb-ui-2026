<?php

if ( ! function_exists('icw_case_cpt') ) {

// Register Custom Post Type
	function icw_case_cpt() {

		$labels = array(
			'name'                  => _x( 'Cases', 'Post Type General Name', 'ICWTHEME' ),
			'singular_name'         => _x( 'Case', 'Post Type Singular Name', 'ICWTHEME' ),
			'menu_name'             => __( 'Cases', 'ICWTHEME' ),
			'name_admin_bar'        => __( 'Case', 'ICWTHEME' ),
			'archives'              => __( 'Case Archives', 'ICWTHEME' ),
			'attributes'            => __( 'Case Attributes', 'ICWTHEME' ),
			'parent_item_colon'     => __( 'Parent Case:', 'ICWTHEME' ),
			'all_items'             => __( 'All Cases', 'ICWTHEME' ),
			'add_new_item'          => __( 'Add New Case', 'ICWTHEME' ),
			'add_new'               => __( 'Add New', 'ICWTHEME' ),
			'new_item'              => __( 'New Case', 'ICWTHEME' ),
			'edit_item'             => __( 'Edit Case', 'ICWTHEME' ),
			'update_item'           => __( 'Update Case', 'ICWTHEME' ),
			'view_item'             => __( 'View Case', 'ICWTHEME' ),
			'view_items'            => __( 'View Cases', 'ICWTHEME' ),
			'search_items'          => __( 'Search Case', 'ICWTHEME' ),
			'not_found'             => __( 'Not found', 'ICWTHEME' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ICWTHEME' ),
			'featured_image'        => __( 'Featured Image', 'ICWTHEME' ),
			'set_featured_image'    => __( 'Set featured image', 'ICWTHEME' ),
			'remove_featured_image' => __( 'Remove featured image', 'ICWTHEME' ),
			'use_featured_image'    => __( 'Use as featured image', 'ICWTHEME' ),
			'insert_into_item'      => __( 'Insert into Case', 'ICWTHEME' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Case', 'ICWTHEME' ),
			'items_list'            => __( 'Cases list', 'ICWTHEME' ),
			'items_list_navigation' => __( 'Cases list navigation', 'ICWTHEME' ),
			'filter_items_list'     => __( 'Filter Cases list', 'ICWTHEME' ),
		);
		$args = array(
			'label'                 => __( 'Case', 'ICWTHEME' ),
			'description'           => __( 'Case Description', 'ICWTHEME' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-admin-settings',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'case', $args );

	}
	add_action( 'init', 'icw_case_cpt', 0 );

}

if ( ! function_exists( 'icw_case_tag_taxonomy' ) ) {

// Register Custom Taxonomy
	function icw_case_tag_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Tags', 'Taxonomy General Name', 'ICWTHEME' ),
			'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'ICWTHEME' ),
			'menu_name'                  => __( 'Tags', 'ICWTHEME' ),
			'all_items'                  => __( 'All Tags', 'ICWTHEME' ),
			'parent_item'                => __( 'Parent Tag', 'ICWTHEME' ),
			'parent_item_colon'          => __( 'Parent Tag:', 'ICWTHEME' ),
			'new_item_name'              => __( 'New Tag Name', 'ICWTHEME' ),
			'add_new_item'               => __( 'Add New Tag', 'ICWTHEME' ),
			'edit_item'                  => __( 'Edit Tag', 'ICWTHEME' ),
			'update_item'                => __( 'Update Tag', 'ICWTHEME' ),
			'view_item'                  => __( 'View Tag', 'ICWTHEME' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'ICWTHEME' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'ICWTHEME' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'ICWTHEME' ),
			'popular_items'              => __( 'Popular tags', 'ICWTHEME' ),
			'search_items'               => __( 'Search Tags', 'ICWTHEME' ),
			'not_found'                  => __( 'Not Found', 'ICWTHEME' ),
			'no_terms'                   => __( 'No tags', 'ICWTHEME' ),
			'items_list'                 => __( 'Tags list', 'ICWTHEME' ),
			'items_list_navigation'      => __( 'Tags list navigation', 'ICWTHEME' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'case_tag', array( 'case' ), $args );

	}
	add_action( 'init', 'icw_case_tag_taxonomy', 0 );

}

if ( ! function_exists('icw_hero_cpt') ) {

// Register Custom Post Type
	function icw_hero_cpt() {

		$labels = array(
			'name'                  => _x( 'Headers', 'Post Type General Name', 'ICWTHEME' ),
			'singular_name'         => _x( 'Hero Banner', 'Post Type Singular Name', 'ICWTHEME' ),
			'menu_name'             => __( 'Headers', 'ICWTHEME' ),
			'name_admin_bar'        => __( 'Hero Banner', 'ICWTHEME' ),
			'archives'              => __( 'Hero Banner Archives', 'ICWTHEME' ),
			'attributes'            => __( 'Hero Banner Attributes', 'ICWTHEME' ),
			'parent_item_colon'     => __( 'Parent Hero Banner:', 'ICWTHEME' ),
			'all_items'             => __( 'All Headers', 'ICWTHEME' ),
			'add_new_item'          => __( 'Add New Hero Banner', 'ICWTHEME' ),
			'add_new'               => __( 'Add New', 'ICWTHEME' ),
			'new_item'              => __( 'New Hero Banner', 'ICWTHEME' ),
			'edit_item'             => __( 'Edit Hero Banner', 'ICWTHEME' ),
			'update_item'           => __( 'Update Hero Banner', 'ICWTHEME' ),
			'view_item'             => __( 'View Hero Banner', 'ICWTHEME' ),
			'view_items'            => __( 'View Headers', 'ICWTHEME' ),
			'search_items'          => __( 'Search Hero Banner', 'ICWTHEME' ),
			'not_found'             => __( 'Not found', 'ICWTHEME' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ICWTHEME' ),
			'featured_image'        => __( 'Featured Image', 'ICWTHEME' ),
			'set_featured_image'    => __( 'Set featured image', 'ICWTHEME' ),
			'remove_featured_image' => __( 'Remove featured image', 'ICWTHEME' ),
			'use_featured_image'    => __( 'Use as featured image', 'ICWTHEME' ),
			'insert_into_item'      => __( 'Insert into Hero Banner', 'ICWTHEME' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Hero Banner', 'ICWTHEME' ),
			'items_list'            => __( 'Headers list', 'ICWTHEME' ),
			'items_list_navigation' => __( 'Headers list navigation', 'ICWTHEME' ),
			'filter_items_list'     => __( 'Filter Headers list', 'ICWTHEME' ),
		);
		$args = array(
			'label'                 => __( 'Hero Banner', 'ICWTHEME' ),
			'description'           => __( 'Hero Banner Description', 'ICWTHEME' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'hierarchical'          => true,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-welcome-widgets-menus',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'page',
		);
		register_post_type( 'hero', $args );

	}
	add_action( 'init', 'icw_hero_cpt', 0 );

}
