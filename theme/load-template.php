<?php
if (!defined('ABSPATH')) die();

if (!function_exists('mint_preload_template'))
{
	function mint_preload_template()
	{	
		do_action('mint_special_pages');
	
		if (MintOptions::get('enable-coming-soon') == true && !current_user_can("administrator"))
		{
			require_once get_template_directory() . "/pages/coming-soon.php";
			die();
		}

		if (MintOptions::get('maintenance-mode') == true && !current_user_can("administrator"))
		{
			if ( (int)MintOptions::get("maintenance-page") != get_the_ID() )
			{
				header("Location: " . get_permalink( MintOptions::get("maintenance-page") ) );
				exit();
			}
			
		}
	}
}

add_action('mint_before_html_start', 'mint_preload_template');
