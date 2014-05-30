<?php
 
add_action( 'init', 'register_cpt_timeline');

function register_cpt_timeline() 
{

	/* Taxonomy */
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
	'name' => _x( 'Timeline Categories', 'Timeline Categories', 'Mint' ),
	'singular_name' => _x( 'Timeline Category', 'Timeline Category', 'Mint' )
  ); 	

  register_taxonomy('timeline-category',array('timeline'), array(
	'hierarchical' => true,
	'labels' => $labels,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'timeline-category' ),
  ));



	
	
	/* Post Type */
	$labels = array( 
		'name' => __( 'Timeline Items', 'Mint' ),
		'singular_name' => __( 'Timeline Item', 'Mint' ),
		'add_new' => __( 'Add New', 'Mint' ),
		'add_new_item' => __( 'Add New Timeline Item', 'Mint' ),
		'edit_item' => __( 'Edit Timeline Item', 'Mint' ),
		'new_item' => __( 'New Timeline Item', 'Mint' ),
		'view_item' => __( 'View Timeline Item', 'Mint' ),
		'search_items' => __( 'Search Timeline Items', 'Mint' ),
		'not_found' => __( 'No Timeline items found', 'Mint' ),
		'not_found_in_trash' => __( 'No Timeline items found in Trash', 'Mint' ),
		'parent_item_colon' => __( 'Parent Timeline Item:', 'Mint' ),
		'menu_name' => __( 'Timeline Items', 'Mint' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'Your timeline items',
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ),
		'taxonomies' => array('timeline-category'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => get_template_directory_uri() . '/images/timeline_post.png',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',

	);

	register_post_type( 'timeline', $args );
		
}