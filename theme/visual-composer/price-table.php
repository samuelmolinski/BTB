<?php
/* Space Shortcode for Visual Composer */
if (!function_exists('mint_vc_price_table_sc'))
{
	function mint_vc_price_table_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'type' => 'price-one',
			'title' => null,
			'price' => null,
			'link' => null,
			'link_title' => null,
			'offerts' => null,
			'boxcolor' => null,
			'barcolor' => null,
			'barfont' => null,
			'textcolor' => null,
			'value' => null,
			'time' => null,
			'cents' => null,

		) , $atts));

		$content = wpb_js_remove_wpautop($content);
        
        if($type == 'price-one' ){ 

		$html = "<div class='price-table {$type}' style='border:1px solid {$boxcolor}'>";
		$html .= "<div class='price-title' style='background-color:{$boxcolor};'><h3 style='color:{$textcolor} !important'> {$title}</h3></div>";
		$html .= "<div class='price-price' style='background-color:{$barcolor};color:{$barfont}'> <h3>{$price}</h3></div>";
		$html .= "<div class='price-content'> {$content}</div><hr>";
		$html .= "<div><a class='btn' style='background-color:{$boxcolor} !important;color:{$textcolor} !important;' href='{$link}' >{$link_title}</a></div>";
		$html .= "<div class='price-offerts'><hr> {$offerts}</div>";
		$html .="</div>";
	}
	   if($type == 'price-two' ){ 
        $html = "<style>.price-two{border:1px solid {$boxcolor};;}.price-two:hover{border:1px solid {$barcolor};background-color:#fff !important; -o-transition:.4s; -ms-transition:.4s; -moz-transition:.4s; -webkit-transition:.4s; transition:.4s;}.price-two .price-title h3{color:{$textcolor} !important}.price-two:hover .price-title h3{color:{$barcolor} !important}} </style>";
		$html .= "<div class='price-table {$type}' style='background-color:{$boxcolor};' >";
		$html .= "<div class='price-title' ><h3> {$title}</h3></div>";
		$html .= "<div class='price-price'> <h3>{$price}</h3></div>";
		$html .= "<div class='price-content'> {$content}</div><hr>";
		$html .= "<div><a class='btn' style='background-color:{$barcolor} !important;color:{$barfont} !important;' href='{$link}' >{$link_title}</a></div>";
		$html .= "<div class='price-offerts'> {$offerts}</div>";
		$html .="</div>";
	}
	   if($type == 'price-three' ){ 
       
		$html = "<style> .price-three .price-content li{border-bottom:1px solid {$boxcolor};} .price-three:hover .price-price,.price-three:hover .price-price span,.price-three:hover .price-price sup {color:#fff !important }.price-three:hover{transform:scale(1.1);}.price-three:hover .price-price{background-color: {$barcolor};}.price-three .price-price{background:{$boxcolor};} </style>";
		$html .="<div class='price-table {$type}' style='border:1px solid {$boxcolor}'>";
		$html .= "<div class='price-title' ><h3 style='color:{$textcolor} !important'> {$title}</h3></div>";
		$html .= "<div class='price-price'><sup style='left:-20px;color:{$barfont}'>{$value}</sup><span class='price-tab' style='color:{$textcolor};'>{$price}.</span><sup style='color:{$textcolor};left:-10px' >{$cents}</sup><span style='color:{$barfont}'> {$time}</span></div>";
		$html .= "<div class='price-content'> {$content}</div>";
		$html .= "<div><a class='btn' style='background-color:{$barcolor} !important;color:{$textcolor} !important;' href='{$link}' >{$link_title}</a></div>";
		$html .= "<div class='price-offerts'>{$offerts}</div>";
		$html .="</div>";
	}
		return $html;
	}
}

add_shortcode( 'price_table', 'mint_vc_price_table_sc' );


if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Price Table',
			'base'     => 'price_table',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-sticky-note',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Price Type',
					'param_name'  => 'type',
					'value'       => array(
						'Style 1'      => 'price-one',
						'Style 2' => 'price-two',
						'Style 3'     => 'price-three'
					),
					'description' => 'Select the Price Table Type.'
 				),
 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'description' => 'Wrote the title.'
 				),
 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Price',
					'param_name'  => 'price',
					'description' => 'Wrote the price. 50'
 				),
 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Cents',
					'param_name'  => 'cents',
					'description' => 'Wrote the price. 50'
 				),
 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Value',
					'param_name'  => 'value',
					'description' => 'Wrote the Value. "$,euro"'
 				),
 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Period',
					'param_name'  => 'time',
					'description' => 'Wrote the Periode. "year"'
 				),

 				array(
 					'type' => 'textarea_html',
 					'holder' => 'div',
 					'class' => '',
 					'heading' => 'Content',
 					'param_name' => 'content',
 					'value' => '<li>Insert list of elements</li>'
 				),
 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Link',
					'param_name'  => 'link',
					'description' => 'Wrote the link.'
 				),
                array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Link Title',
					'param_name'  => 'link_title',
					'description' => 'Wrote the link title.'
 				),
                array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Offerts',
					'param_name'  => 'offerts',
					'description' => 'Wrote the Offert Text.'
 				),
 				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Box Color',
					'param_name'  => 'boxcolor',
					'value'       => '#7dbd22',
					'description' => 'Select the bar color.'
 				),
 				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Text Color',
					'param_name'  => 'textcolor',
					'value'       => '#ffffff',
					'description' => 'Select the bar color.'
 				),
 				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Bar Color',
					'param_name'  => 'barcolor',
					'value'       => '#f7f7f7',
					'description' => 'Select the bar color.'
 				),
 				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Bar Font',
					'param_name'  => 'barfont',
					'value'       => '#00000',
					'description' => 'Select the bar color.'
 				),

 				
			)
		)
	);
}