<?php

if(!function_exists("mint_vc_pagination_sc"))
{
	function mint_vc_pagination_sc($attrs, $content = null)
	{
		global $wp_query, $custom_wp_query;
		$wp_query = (!isset($custom_wp_query)) ? $wp_query : $custom_wp_query;

		return MintUtils::pagination($wp_query);
	}
}

add_shortcode("pagination", "mint_vc_pagination_sc");


if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Pagination',
			'base'     => 'pagination',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-pagination',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				
 				
			)
		)
	);
}