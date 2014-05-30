<?php
	
	add_theme_support( 'woocommerce' );
	
	// register all Mint menus
	register_nav_menus(array(
		"main-menu" => "Main Menu",
		"top-nav"   => "Top Nav",
		"footer-nav" => "Footer Nav",
		"error-nav" => "Error Nav"
	));




	// Init languages
	load_theme_textdomain( 'Mint', get_template_directory() . '/languages' );

	// Shortcodes in widgets
	add_filter('widget_text', 'do_shortcode');

	add_theme_support( 'automatic-feed-links' );

	// Change the button customize to actually go to theme options
	function mint_customize_button($themes)
	{
		if (array_key_exists('Mint', $themes))
		{
			$themes['Mint']['actions']['customize'] = admin_url("themes.php?page=optionsframework");
		}

		return $themes;
	}

	add_filter('wp_prepare_themes_for_js', 'mint_customize_button');

	/* Supress warnings and never actually call these */
	function mint_supress_themecheck_unused()
	{
		wp_link_pages( $args ); 
		// Already did
		add_theme_support( 'post-thumbnails' );

		// Already implemented in theme options
		add_theme_support( 'custom-background' );

		// Already implemented in our theme options
		add_theme_support( 'custom-header', $args );
	}
	
	if (!function_exists('mint_get_page_id'))
	{	
		function mint_get_page_id()
		{
			$mpi = @get_the_ID();
			if (defined('MINT_REWRITE_PAGE_ID'))
			{
				$mpi = MINT_REWRITE_PAGE_ID;
			}
			return $mpi;
		}
	}