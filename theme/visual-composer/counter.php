<?php
/* Count Shortcode for Visual Composer */
if (!function_exists('mint_vc_counter_sc'))
{
	function mint_vc_counter_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'start' => 0,
			'el_class' => null,
			'end'   => 100,
			'title' => 'Counter',
			'color' => '#677999',
			'border' => null
		) , $atts));

		$counter_style = 'color:' . $color . ';';
		if($border)
		{
			$counter_style .= 'border-bottom:1px solid #eeeeee;';
		}

		$content = wpb_js_remove_wpautop($content);

		return "<div class='mint-counter $el_class '><p class='mint-counter-number' style='$counter_style' data-mint-start='{$start}' data-mint-end='{$end}'>{$start}</p><p class='mint-counter-title hcolor'>{$title}</p></div>";
	}
}

add_shortcode( 'counter', 'mint_vc_counter_sc' );

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Counter',
			'base'     => 'counter',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-counter',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'value'       => 'Counter',
					'description' => 'Select the title for the counter.'
 				),

 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Start number',
					'param_name'  => 'start',
					'value'       => 0,
					'description' => 'The start number of counter. Ex: 1'
 				),

 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'End Number',
					'param_name'  => 'end',
					'value'       => 100,
					'description' => 'The end number of counter. Ex: 235'
 				),

 				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Color',
					'param_name'  => 'color',
					'value'       => '#677999',
					'description' => 'The color of number'
 				),

 				array(
 					'type' => 'checkbox',
 					'holder' => 'div',
 					'class' => '',
 					'heading' => 'Enable border?',
 					'param_name' => 'border',
 					"value" => Array( "Yes" => 'yes'),
 					'description' => 'Enable border below the number'
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