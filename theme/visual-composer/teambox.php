<?php
/* Team Box Shortcode for Visual Composer */
if (!function_exists('mint_vc_teambox_sc'))
{
	function mint_vc_teambox_sc($atts, $content = null)
	{
		global $mint_social_networks;
		
		extract(shortcode_atts( array(
			'ids' 		=> null,
			'link'		=> true,
			'el_class' => null,
			'link_text' => __('More', 'Mint'),
			'link_url'  => '#'

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
		$html = "<div class='mint-team-container mint-teambox $el_class'> ";

		$html .= "<article> <div class='media'>";

	
		if (!empty($image))
		{
			$html .= "<div class='article-thumbnail'>";
			if (!empty($link))
			{
				$html .= "<a href='".$link_url."'>";
			}
				$retina = MintUtils::resized( $image, 440, null );
				$html .= "<img class='mint-teambox-image' data-retina='".$retina."' src='".MintUtils::resized( $image, 220, null )."' />";

			if (!empty($link))
			{
				$html .= "</a>";
			}

			$html .= "</div>";
		}	

		
		$html .= "<div class='article-body'>";
		if (!empty($content))
		{
			$html .= "<div class='mint-teambox-content'>";
				$html .= $content;
			$html .= "</div>";
		}

	

		$html .= "</div>"; // body
		$html .= "<div class='article-caption mint-teambox-footer'>";


		$html .= "<div class='mint-teambox-socials pull-left'>";
			foreach($mint_social_networks as $soc => $t)
			{
				if (isset($atts[$soc])) {
					$html .= "<a class='icon-".$soc."' href='".$atts[$soc]."'>&nbsp;</a>";
				}
			}
		$html .= "</div>";

		if ($link) {
			$html .= "<div class='pull-right'><a href='".$link_url."'><span class='icon-right-thin'>&nbsp;</span>".$link_text."</a></div>";
		}

	$html .= "</div>";
		$html .= "</div></article>";
		$html .= "</div>";
		return $html;
	}
}

add_shortcode( 'teambox', 'mint_vc_teambox_sc' );


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
			'description' => 'Team member ' . $t . ' URL'
		);
	}


	$params[] = array(
		'type'        => 'attach_images',
		'holder'      => 'div',
		'class'       => '',
		'heading'     => 'Image',
		'param_name'  => 'ids',
		'value'       => '',
		'description' => 'Upload your team member picture here'
	);

	$params[] = array(
		'type'        => 'textarea_html',
		'holder'      => 'div',
		'class'       => '',
		'heading'     => 'Inner HTML',
		'param_name'  => 'content',
		'value'       => '',
		'description' => 'Your team box inner html.'
	);

	$params[] = array(
		'type'       => 'checkbox',
		'holder'     => 'div',
		'class'      => '',
		'heading'    => 'Show a Link?',
		'param_name' =>  'link',
		'value'      => array('Yes' => 'yes')
	);	

	$params[] = array(
		'type'       => 'textfield',
		'holder'     => 'div',
		'class'      => '',
		'heading'    => 'Link Text',
		'param_name' => 'link_text',
		'value'      => 'More'
	);	

	$params[] = array(
		'type'       => 'textfield',
		'holder'     => 'div',
		'class'      => '',
		'heading'    => 'Link Url',
		'param_name' => 'link_url',
		'value'      => '#'
	);	
	$params[] = array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Element Class',
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => ''
 				);

	$params = array_merge($params, $soc);

	
	wpb_map(
		array(
			'name'     => 'Mint - Team Box',
			'base'     => 'teambox',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-teambox',
			'category' => __('Content', 'js_composer'),
			'params'   => $params
 				
			)
		
	);
}