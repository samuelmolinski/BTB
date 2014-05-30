<?php
/* Content Rotator Shortcode for Visual Composer */
if (!function_exists('mint_vc_carousel_sc'))
{
	function mint_vc_quote_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'author' => null,
			'el_class' => null,
			'image' => null
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$html = "<div class='carousel $el_class'>";
		
		$html .= "<div class='mint-quote-text'>" . $content . "</div>";

		$html .= "</div>";
		return $html;
	}
}

add_shortcode( 'quote', 'mint_vc_carousel_sc' );