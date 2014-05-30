<?php
if (!function_exists('mint_add_documentation_page'))
{
	function mint_add_documentation_page()
	{
		add_menu_page( 'Documentation', 'Documentation', 'manage_options', 'mint-help', 'mint_render_documentation_page', get_template_directory_uri() . '/images/help-icon.png' );
	}
}

add_action('admin_menu', 'mint_add_documentation_page');

if (!function_exists('mint_add_documentation_sub_page'))
{
	function mint_add_documentation_sub_page()
	{
		add_submenu_page( 'mint-help', 'Support Forum', 'Support Forum', 'manage_options', 'mint-support-forum', 'mint_render_documentation_sub_page');
	}
}

add_action('admin_menu', 'mint_add_documentation_sub_page');

if (!function_exists('mint_render_documentation_page'))
{
	function mint_render_documentation_page()
	{
		echo "<iframe src='".MINT_DOC_URL."' onload='javascript:this.style.height=jQuery(window).height()+\"px\"' width='100%' height='100%' style='width:100%;height:100%;'>";
	}
}


if (!function_exists('mint_render_documentation_sub_page'))
{
	function mint_render_documentation_sub_page()
	{
		// It shouldn't render anything
	}
}

if (isset($_GET['page']) && $_GET['page'] == "mint-support-forum")
{
	header("Location: ". MINT_FORUM_URL);
}
