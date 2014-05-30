<?php

global $mint_entypo_icons;

if (!function_exists('mint_vc_iconbox_sc'))
{
	function mint_vc_iconbox_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'title'         => null,
			'icon' 			=> null,
			'iconsize'     => "default",
			'custom_icon'	=> null,
			'el_class' => null,
			'type'          => 'mint-iconbox-a'
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$isIconImage = !empty($custom_icon);
		$icon_size = ($iconsize == "default") ? "" : "style='font-size:" . (int)$iconsize . "px'";

		$html = "<div class='mint-icon-boxes  " . $type . " $el_class'>";
			$html .= "<div class='media'>";
				if($isIconImage)
				{
					$icon_image = get_post($custom_icon);
					$html .= "<div class='pull-left mint-icon animated'><span class='mint-iconbox-icon animated'><img src='{$icon_image->guid}' alt='' /></span></div>";
				}
				else
				{
					$html .= "<div class='pull-left mint-icon animated'><span class='mint-iconbox-icon animated'><i class='{$icon}' $icon_size></i></span></div>";
				}

				$html .= "<div class='media-body'><h4 class='mint-iconbox-title'>{$title}</h4><p class='mint-iconbox-content'>{$content}</p></div>";

			$html .= "</div>";
		$html .= "</div>";
		return $html;
	}
}
add_shortcode( 'iconbox', 'mint_vc_iconbox_sc' );

$mint_iconsize = array("Default" => "default");

for($i = 10; $i <= 100; $i++)
{
	$mint_iconsize[$i + "px"] = $i;
}

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Icon Box',
			'base'     => 'iconbox',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-iconbox',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'value'       => '',
					'description' => 'Iconbox title'
 				),

 				 array(
				      "type" => "dropdown",
				      "heading" => "Icon",
				      "param_name" => "icon",
				      "value" => array_merge( array('None'),  $mint_entypo_icons ),
				      "description" => "Select the icon you would want to display. Note that this is a font icon and it will scale smoothly"
				    ),

 				array(
 					'type' => "dropdown",
 					'holder' => 'div',
 					'class' => '',
 					'heading' => 'Icon Size',
 					'param_name' => 'iconsize',
 					'value' => $mint_iconsize,
 					'description' => 'Choose a custom icon size. Ex: 20'
 				),

 				array(
					'type'        => 'attach_images',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Custom Icon',
					'param_name'  => 'custom_icon',
					'value'       => '',
					'description' => 'If you want to use your own custom icon upload it here.'
 				),

				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Infobox Text',
					'param_name'  => 'content',
					'value'       => 'Your infobox text',
					'description' => 'Enter your infobox text here.'
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
				
				array(
					'type'        => 'dropdown',
					'holder'	  => 'div',
					'class'		  => '',
					'heading'	  => 'Infobox Type',
					'param_name'  => 'type',
					'description' => 'Select the type of the infobox',
					'value'		  => array(
						"Icon Box A" => "mint-iconbox-a",
						"Icon Box B" => "mint-iconbox-b",
						"Icon Box C" => "mint-iconbox-c",
						"Icon Box D" => "mint-iconbox-d",
						"Icon Box E" => "mint-iconbox-e",
						"Icon Box F" => "mint-iconbox-f",
						"Icon Box G" => "mint-iconbox-g",
						"Icon Box H" => "mint-iconbox-h",
						"Icon Box I" => "mint-iconbox-i",
						"Icon Box J" => "mint-iconbox-j",
						"Icon Box K" => "mint-iconbox-k",
						"Icon Box L" => "mint-iconbox-l"
					),

              )

			)
		)
	);
}