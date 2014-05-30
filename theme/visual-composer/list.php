<?php

if(!function_exists("mint_vc_list_sc"))
{
	function mint_vc_list_sc($attrs, $content = null)
	{
		extract( shortcode_atts( array(
			'el_class' => null,
			'type' => 'arrow' // circle, arrow, disc, ok, decimal, upper-roman, lower-roman, lower-alpha, upper-alpha
		), $attrs ) );

		return "<div class='mint-list mint-list-{$type} $el_class '>". do_shortcode($content) ."</div>";
	}
}
add_shortcode("list", "mint_vc_list_sc");

//array_merge( array('None'),  $mint_entypo_icons )


if (function_exists('wpb_map'))
{
	global $mint_entypo_icons;
	wpb_map(
		array(
			'name'     => 'Mint - List',
			'base'     => 'list',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-list',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'List Icon',
					'param_name'  => 'type',
					'value'       => array('circle', 'arrow', 'disc', 'ok', 'decimal', 'upper-roman', 'lower-roman', 'lower-alpha', 'upper-alpha', 'arrow-circle'),
					'description' => 'Select the list icon'
 				),

 				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'List Items',
					'param_name'  => 'content',
					'value'       => 'Your list items',
					'description' => 'Enter your list items here'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Element Class',
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => ''
 				),


 			)
 		)
 	);
}