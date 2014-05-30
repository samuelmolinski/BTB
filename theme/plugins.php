<?php

if (!defined('ABSPATH')) die();

if (!function_exists('mint_register_required_plugins'))
{
	function mint_register_required_plugins()
	{
		$theme_text_domain = 'Mint';

		$plugins = array(

			/****  NOT REQUIRED  *******/
			// This is an example of how to include a plugin pre-packaged with a theme
			array(
				'name'     				=> 'Revolution Slider', // The plugin name
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory() . '/theme/plugins/revslider.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),

			array(
				'name'               => 'Layer Slider',
				'slug'               => 'LayerSlider',
				'source'             => get_template_directory() . '/theme/plugins/layersliderwp.zip',
				'required'           => false,
				'version'            => '4.6.5',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			// This is an example of how to include a plugin from the WordPress Plugin Repository
			array(
				'name' 		=> 'WooCommerce - excelling eCommerce',
				'slug' 		=> 'woocommerce',
				'required' 	=> false,
			),

			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => false,
			),

			array(
				'name'     => 'Latest Tweets Widget',
				'slug'     => 'latest-tweets-widget',
				'required' => false
			),

			array(
				'name'     => 'Quick Flickr Widget',
				'slug'     => 'quick-flickr-widget',
				'required' => false
			),

			array(
				'name'     => 'MailChimp for WordPress Lite',
				'slug'     => 'mailchimp-for-wp',
				'required' => false
			),

			array(
				'name'     => 'Sitemap',
				'slug'     => 'sitemap',
				'required' => false
			),

			array(
				'name'     			 => 'Visual Composer',
				'slug'     			 => 'js_composer',
				'source'   			 => get_template_directory() . '/theme/plugins/js_composer.zip',
				'required' 			 => true,
				'version'            => '',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			)
		);

		/********************* REQUIRED ****************/

	


		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
		);

		tgmpa( $plugins, $config );
	}
}

add_action('tgmpa_register', 'mint_register_required_plugins');