<?php
 
add_action( 'init', 'register_cpt_portfolio' );

function register_cpt_portfolio() 
{

		/* Taxonomy */
	  // Add new taxonomy, make it hierarchical (like categories)
	  $labels = array(
		'name' => _x( 'Portfolio Categories', 'Portfolio Categories', 'Mint' ),
		'singular_name' => _x( 'Portfolio Category', 'Portfolio Category', 'Mint' )
	  ); 	

	  register_taxonomy('portfolio-category',array('portfolio'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	  ));

 

		
		
		/* Post Type */
		$labels = array( 
			'name' => __( 'Portfolio Items', 'Mint' ),
			'singular_name' => __( 'Portfolio Item', 'Mint' ),
			'add_new' => __( 'Add New', 'Mint' ),
			'add_new_item' => __( 'Add New Portfolio Item', 'Mint' ),
			'edit_item' => __( 'Edit Portfolio Item', 'Mint' ),
			'new_item' => __( 'New Portfolio Item', 'Mint' ),
			'view_item' => __( 'View Portfolio Item', 'Mint' ),
			'search_items' => __( 'Search Portfolio Items', 'Mint' ),
			'not_found' => __( 'No portfolio items found', 'Mint' ),
			'not_found_in_trash' => __( 'No portfolio items found in Trash', 'Mint' ),
			'parent_item_colon' => __( 'Parent Portfolio Item:', 'Mint' ),
			'menu_name' => __( 'Portfolio Items', 'Mint' ),
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Your portfolio items',
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ),
			'taxonomies' => array('portfolio-category'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => get_template_directory_uri() . '/images/portfolio_post.png',
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post',

		);

		register_post_type( 'portfolio', $args );
		
}