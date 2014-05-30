<?php

if(!function_exists("mint_vc_highlight_sc"))
{
	function mint_vc_highlight_sc($attrs, $content = null)
	{
		extract( shortcode_atts( array(
			'type' => 'background', // background, text
			'color' => '#7dbd22',
		), $attrs ) );

		$style = ($type == "background") ? "padding:2px 5px;color:#fff;background-color:" . $color : "text-decoration:underline;color:". $color;

		return "<span style='{$style}'>" . do_shortcode($content) . "</span>";
	}
}

add_shortcode("highlight", "mint_vc_highlight_sc");


if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Highlight',
			'base'     => 'highlight',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-highlight',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Highlight What?',
					'param_name'  => 'type',
					'value'       => array( 'Background' => 'background', 'Text' => 'text'),
					'description' => 'Select what exactly to highlight.'
 				),

				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Color',
					'param_name'  => 'color',
					'value'       => '#7dbd22',
					'description' => 'Select the background color'
				),

				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Highlighted Content',
					'param_name'  => 'content',
					'value'       => 'Your highlighted content',
					'description' => 'Enter your content here'
				),
 				
			)
		)
	);
}