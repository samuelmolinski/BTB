<?php
define('MINT_TINYMCE_URI', get_template_directory_uri() . "/theme/tinymce/");
define('MINT_TINYMCE_DIR', get_template_directory()     . "/theme/tinymce/");

require_once "visual-composer-aliases.php";

if (!function_exists('mint_register_vc_shortcodes'))
{
	function mint_register_vc_shortcodes($plugins)
	{
		$plugins['MintShortCodes'] = MINT_TINYMCE_URI .'tinymce.js';
		return $plugins;
	}
}

if (!function_exists('mint_register_vc_shortcodes_button'))
{
	function mint_register_vc_shortcodes_button($buttons)
	{
		array_push($buttons, 'MintShortCodes');
		return $buttons;
	}
}


if (is_admin())
{
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true')
		{
			add_filter("mce_external_plugins", "mint_register_vc_shortcodes" );
			add_filter('mce_buttons'         , "mint_register_vc_shortcodes_button");
		}
	}	
}