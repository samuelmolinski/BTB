<?php
/* Social Shortcode for Visual Composer */
if (!function_exists('mint_vc_social_sc'))
{
	function mint_vc_social_sc($atts, $content = null)
	{
		global $mint_social_networks;

		$content = wpb_js_remove_wpautop($content);

		if (!isset($el_class)) $el_class = null;

		$html = "<div class='mint-social $el_class'>";
			foreach($mint_social_networks as $soc => $t)
			{
				if (isset($atts[$soc])) {
					$html .= "<a class='tcolor icon-".$soc."' href='".$atts[$soc]."' target='_blank'>&nbsp;</a>";
				}
			}
		$html .= "</div>";

		return $html;
	}
}

add_shortcode( 'social', 'mint_vc_social_sc' );

if (function_exists('wpb_map'))
{
	global $mint_social_networks;

	$soc = array();

	foreach($mint_social_networks as $id => $t)
	{
		$soc[] = array(
			'type'        => 'textfield',
			'holder'      => 'div',
			'class'       => '',
			'heading'     =>  $t. ' URL',
			'param_name'  => $id,
			'value'       => '',
			'description' => $t . ' URL'
		);
	}

	wpb_map(
		array(
			'name'     => 'Mint - Socials',
			'base'     => 'social',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-social',
			'params'   => $soc		
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
	);
}