<?php
if(!function_exists("mint_vc_dropcap_sc"))
{
	function mint_vc_dropcap_sc($attrs, $content = null)
	{
		extract( shortcode_atts( array(
			'type' => 'default', // default, circle
			'color' => '#7dbd22'
		), $attrs ) );

		$style = ($type == "default") ? "color:" . $color : "background-color:" . $color;
		$id = uniqid("mint-");	
		return "<style>.{$id}:first-letter {".$style."}</style><div class='mint-dropcap {$id} mint-dropcap-{$type}'>" . do_shortcode($content) . "</div>";
	}
}
add_shortcode("dropcap", "mint_vc_dropcap_sc");

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Dropcap',
			'base'     => 'dropcap',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-dropcap',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Dropcap type',
					'param_name'  => 'type',
					'value'       => array( 'Default' => 'default', 'Circled' => 'circle'),
					'description' => 'Select the default dropcap type.'
 				),

				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Color',
					'param_name'  => 'color',
					'value'       => '#7dbd22',
					'description' => 'Select the color'
				),
				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Dropcap Content',
					'param_name'  => 'content',
					'value'       => 'Your dropcapped content here',
					'description' => 'Enter your content here'
				),
 				
			)
		)
	);
}