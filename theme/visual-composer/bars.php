<?php
/* Quote Shortcode for Visual Composer */
if (!function_exists('mint_vc_bars_sc'))
{
	function mint_vc_bars_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'color' => '#f7f7f7',
			'stick_image' => false,
			'el_class' => null,
 		) , $atts));

		$content = wpb_js_remove_wpautop($content);
		$sticky_image_class = ($stick_image) ? "mint-sticky-image-bar" : "";
		return "<div class='mint-bar $el_class fullwidth {$sticky_image_class}' style='background-color:{$color}'><div class='elastic'>" . do_shortcode($content) . "</div></div>";
	}
}

add_shortcode( 'bar', 'mint_vc_bars_sc' );

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Bars',
			'base'     => 'bar',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-bar',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Bar Color',
					'param_name'  => 'color',
					'value'       => '#f7f7f7',
					'description' => 'Select the bar color.'
 				),

 				array(
			      "type" => 'checkbox',
			      "heading" => "Stick image to bottom?",
			      "param_name" => "stick_image",
			      
			      "value" => array( "Yes" => 'yes')
			    ),

 				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Bar Text',
					'param_name'  => 'content',
					'value'       => 'Your Bar text',
					'description' => 'Enter your bar text here.'
				),

				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Element Class',
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => ''
 				)

 				
			)
		)
	);
}