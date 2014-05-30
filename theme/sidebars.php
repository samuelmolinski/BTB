<?php
	// register all Mint default sidebars
	
	// Blog Sidebar
	register_sidebar(array(
		'name' => __('Blog Sidebar', 'Mint'),
		'id' => 'blog-sidebar',
		'description' => 'This is the default blog sidebar',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="sidebar-widget-title">',
		'after_title' => '</h4>'
	));

	// Footer sidebars
	register_sidebars( 4, array(
		'name'          => 'Footer Sidebar %d',
		'id'            => 'footer-sidebar',
		'description'   => 'This is the default footer sidebar',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget-title">',
		'after_title'   => '</h4>'
	));

