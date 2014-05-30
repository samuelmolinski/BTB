<?php
/* Space Shortcode for Visual Composer */
if (!function_exists('mint_vc_mwc_sc'))
{
	function mint_vc_mwc_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(

		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		return $content;
	}
}

add_shortcode( 'mwc', 'mint_vc_mwc_sc' );

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - WooCommerce',
			'base'     => 'mwc',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-mwc',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'WooCommerce Shortcodes',
					'param_name'  => 'content',
					'value'      => ''
 				),

 				
			)
		)
	);
}