<?php 
	/* We are using alias shortcodes to be used inside visual composer 
	   That means the same shortocde can be used twice with 2 different names
	   This allows to keep the functionality of the Visual Composer and not break it while editing.
	   This also helps create richer visual items because Mint Shortcodes are bundled and incorporated 
	   in the TinyMCE and can be used safe along with Visual Composer and actually using Visual Composer
	   in the background.

	   This file holds all our alias shortcodes to render real shortcodes
	*/

	/* Mint Defined Shortcodes */

	add_shortcode('mc_space',     'mint_vc_space_sc'  );
	add_shortcode('mc_teambox',   'mint_vc_teambox_sc');
	add_shortcode('mc_iconbox',   'mint_vc_iconbox_sc');
	add_shortcode('mc_quote',     'mint_vc_quote_sc');
	add_shortcode('mc_highlight', 'mint_vc_highlight_sc');
	add_shortcode('mc_dropcap',   'mint_vc_dropcap_sc');
	add_shortcode('mc_list',  	  'mint_vc_list_sc');


	/* Helper function to parse the function parameters */
	function mint_vc_alias_helper( $scname, $atts , $content = null )
	{
		$str = "";
		if (!empty($atts))
		{
			foreach($atts as $att => $val)
			{
				$str .= $att .= '="'.$val.'" ';
			}	
		}
		
		return do_shortcode( "[" . $scname . " " . $str . "] " . do_shortcode( $content ) . "[/" . $scname . "]" );
	}	



	/* Visual Composer Shortcodes */
	/* Yes we have to create a separate function for each shortcode :( . We would have used anonymous functions of PHP 5.3 but noooo */
	if (!function_exists('mint_alias_sc_vc_facebook'))
	{
		function mint_alias_sc_vc_facebook($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_facebook", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_tweetmeme'))
	{
		function mint_alias_sc_vc_tweetmeme($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_tweetmeme", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_googleplus'))
	{
		function mint_alias_sc_vc_googleplus($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_googleplus", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_pinterest'))
	{
		function mint_alias_sc_vc_pinterest($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_pinterest", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_gmaps'))
	{
		function mint_alias_sc_vc_gmaps($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_gmaps", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_button'))
	{
		function mint_alias_sc_vc_button($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_button", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_video'))
	{
		function mint_alias_sc_vc_video($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_video", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_accordion'))
	{
		function mint_alias_sc_vc_accordion($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_accordion", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_tour'))
	{
		function mint_alias_sc_vc_tour($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_tour", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_tabs'))
	{
		function mint_alias_sc_vc_tabs($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_tabs", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_toggle'))
	{
		function mint_alias_sc_vc_toggle($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_toggle", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_messagebox'))
	{
		function mint_alias_sc_vc_messagebox($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_messagebox", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_text_separator'))
	{
		function mint_alias_sc_vc_text_separator($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_text_separator", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_separator'))
	{
		function mint_alias_sc_vc_separator($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_separator", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_row'))
	{
		function mint_alias_sc_vc_row($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_row", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_column'))
	{
		function mint_alias_sc_vc_column($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_column", $atts, $content);
		}
	}
	
	if (!function_exists('mint_alias_sc_vc_single_image'))
	{
		function mint_alias_sc_vc_single_image($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_single_image", $atts, $content);
		}
	}

	if (!function_exists('mint_alias_sc_vc_column_text'))
	{
		function mint_alias_sc_vc_column_text($atts, $content = null)
		{
			return mint_vc_alias_helper("vc_column_text", $atts, $content);
		}
	}

	$vc_alias = array(
		'vc_facebook',
		'vc_tweetmeme',
		'vc_googleplus',
		'vc_pinterest',
		'vc_gmaps',
		'vc_button',
		'vc_video',
		'vc_accordion',
		'vc_tour',
		'vc_tabs',
		'vc_toggle',
		'vc_messagebox',
		'vc_text_separator',
		'vc_separator',
		'vc_row',
		'vc_column',
		'vc_single_image',
		'vc_column_text'
	);

	foreach($vc_alias as $alias)
	{		
		add_shortcode( str_replace("vc_", "mc_", $alias), 'mint_alias_sc_vc_' . str_replace("vc_", "", $alias) );
	}

	
	

	
?>