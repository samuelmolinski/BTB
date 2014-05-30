<?php
/* Space Shortcode for Visual Composer */
if (!function_exists('mint_vc_space_sc'))
{
	function mint_vc_space_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'space' => 15
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		return "<div class='space{$space}'>&nbsp;</div>";
	}
}

add_shortcode( 'space', 'mint_vc_space_sc' );

$mint_spaces = array();

for($i = 1; $i <= 20; $i++)
{
	$mint_spaces[($i * 5) + "px"] = 5 * $i;
}

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Space',
			'base'     => 'space',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-space',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Space Size',
					'param_name'  => 'space',
					'value'       => $mint_spaces,
					'description' => 'Select the empty space size.'
 				),

 				
			)
		)
	);
}