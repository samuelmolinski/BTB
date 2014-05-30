<?php
/* Team Box Shortcode for Visual Composer */
if (!function_exists('mint_vc_teamboxavo_sc'))
{
	function mint_vc_teamboxavo_sc($atts, $content = null)
	{		
		global $mint_social_networks;

		extract(shortcode_atts( array(
			'ids' 		=> null,
			'el_class' => null,
			'name' => null,
			'link' => null,
			'function'  => null,
			'color' => null,

		) , $atts));

		$image = false;

		if (!empty($ids))
		{
			$ids = @explode(",", $ids);
			if (is_array($ids) && !empty($ids))
			{
				$image = @$ids[0];
			}
		}

		if (!empty($image))
		{
			list($image)  = wp_get_attachment_image_src($image , "original" );
		}

		$content = wpb_js_remove_wpautop($content);
		$html ="<style>.avoteam article:hover {background:".$color.";-webkit-box-shadow: 0px 0px 0px 10px ".$color.";-moz-box-shadow: 0px 0px 0px 10px ".$color.";box-shadow: 0px 0px 0px 10px ".$color."; }</style>";
		$html .= "<div class='mint-teambox avoteam $el_class'> ";

		$html .= "<article> <div class='media'>";
        if (!empty($link)){
        	$html .= "<a href='".$link."'>";
        }
	
		if (!empty($image))
		{
			    $html .= "<div class='article-thumbnail'>";
				$retina = MintUtils::resized( $image, 440, null );
				$html .= "<img class='mint-teambox-image' data-retina='".$retina."' src='".MintUtils::resized( $image, 220, null )."' />";

			$html .= "</div>";
		}	

		
		$html .= "<div class='team-body'>";
		$html .= "<h2>".$name."</h2>";
		$html .= "<h3>".$function."</h3><hr>";

		if (!empty($content))
		{
			$html .= "<div class='mint-teambox-content'>";
				$html .= $content;
			$html .= "</div></a><hr style='border-top: 1px solid #d7d7d7;margin-bottom:15px;'>";
		}

	$html .= "<div class='mint-teambox-soc pull-left'>";
			foreach($mint_social_networks as $socavo => $t)
			{
				if (isset($atts[$socavo])) {
					$html .= "<a class='icon-".$socavo."' href='".$atts[$socavo]."'>&nbsp;</a>";
				}
			}
		$html .= "</div>";


		$html .= "</div>";
		$html .= "</div></article>";
		$html .= "</div>";
		return $html;
	}
}

add_shortcode( 'teamboxavo', 'mint_vc_teamboxavo_sc' );


if (function_exists('wpb_map'))
{
	global $mint_social_networks;

	$soc = array();

	foreach($mint_social_networks as $id => $ta)
	{
		$soc[] = array(
			'type'        => 'textfield',
			'holder'      => 'div',
			'class'       => '',
			'heading'     =>  $ta. ' URL',
			'param_name'  => $id,
			'value'       => '',
			'description' => 'Team member ' . $ta . ' URL'
		);
	}



  $param[] = array(
		'type'        => 'attach_images',
		'holder'      => 'div',
		'class'       => '',
		'heading'     => 'Image',
		'param_name'  => 'ids',
		'value'       => '',
		'description' => 'Upload your team member picture here'
	);

   $param[] =  array(
		'type'        => 'textarea_html',
		'holder'      => 'div',
		'class'       => '',
		'heading'     => 'Inner HTML',
		'param_name'  => 'content',
		'value'       => '',
		'description' => 'Your team box inner html.'
	);

	$param[] = array(
		'type'       => 'textfield',
		'holder'     => 'div',
		'class'      => '',
		'heading'    => 'Name',
		'param_name' => 'name',
		'value'      => 'Insert Your name'
	);
   $param[] = array(
		'type'       => 'textfield',
		'holder'     => 'div',
		'class'      => '',
		'heading'    => 'Link',
		'param_name' => 'link',
	);
	$param[] = array(
		'type'       => 'textfield',
		'holder'     => 'div',
		'class'      => '',
		'heading'    => 'Function',
		'param_name' => 'function',
		'value'      => 'Your Function'
	);
	$param[] = 	array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Box Color Hover',
					'param_name'  => 'color',
					'value'       => '#ffffff',
					'description' => 'Select the hover color.'
 				);
	$param[] = array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Element Class',
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => ''
 				);
    $param = array_merge($param, $soc);
	
	wpb_map(
		array(
			'name'     => 'Mint - Team Box Avo Edition',
			'base'     => 'teamboxavo',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-teambox',
			'category' => __('Content', 'js_composer'),
			'params'   => $param
		)
	);
}