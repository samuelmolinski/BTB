<?php
/* Quote Shortcode for Visual Composer */
if (!function_exists('mint_vc_quote_sc'))
{
	function mint_vc_quote_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'author' => null,
			'el_class' => null,
			'image' => null
		) , $atts));

		$content = wpb_js_remove_wpautop($content);
		$imgClass = ($image) ? "" : "quote-no-image";

		$html = "<blockquote class='mint-quote-a {$imgClass} $el_class'>";
		$html .= "<div class='mint-quote-text'>" . $content . "</div>";
		if (!empty($author))
		{
			$html .= "<div class='mint-quote-author pull-right '> &mdash; ". $author ."</div>";
		}
		$html .= "</blockquote>";
		return $html;
	}
}

add_shortcode( 'quote', 'mint_vc_quote_sc' );


if(!function_exists("mint_vc_quote_slider_sc"))
{
	function mint_vc_quote_slider_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'author' => null,
			'author2' => null,
			'author3' => null,
			'author4' => null,
			'author5' => null,
			'content2' => null,
            'content3' => null,
            'content4' => null,
            'content5' => null,
			'el_class' => null,
			'image' => null
		) , $atts));

		$content = wpb_js_remove_wpautop($content);
        $quotes = ($image) ? "quote-image" : "";

		$html = "";
		$html .= "<div class='quote-slider-bg '><div class='block'><ul class='animateblock'>";
        $html .= "<li><div class='quote-text {$quotes}'>{$content}</div>";
        if (!empty($author))
		{
			$html .= "<div class='quote-slider-author'> &mdash; ". $author ."</div>";
		}
        $html .="</li>";
        $html .="<li><div class='quote-text {$quotes}'>{$content2}</div>";
      
        if (!empty($author2))
		{
			$html .= "<div class='quote-slider-author'> &mdash; ". $author2 ."</div>";
		}
        $html .="</li>";
       
        if (!empty($content3)){ 
        $html .="<li><div class='quote-text {$quotes}'>{$content3}</div>";
      
        if (!empty($author3))
		{
			$html .= "<div class='quote-slider-author'> &mdash; ". $author3 ."</div>";
		}
        $html .="</li>";
        }
         if (!empty($content4)){ 
        $html .="<li><div class='quote-text {$quotes}'>{$content4}</div>";
      
        if (!empty($author4))
		{
			$html .= "<div class='quote-slider-author'> &mdash; ". $author4 ."</div>";
		}
        $html .="</li>";
        }
         if (!empty($content5)){
        $html .="<li><div class='quote-text {$quotes}'>{$content5}</div>";
      
        if (!empty($author5))
		{
			$html .= "<div class='quote-slider-author'> &mdash; ". $author5 ."</div>";
		}
        $html .="</li>";
        }
        $html .= " </ul></div></div>";
		
		return $html;


	}
}
add_shortcode('quote_slider', 'mint_vc_quote_slider_sc');


if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Quote',
			'base'     => 'quote',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-quote',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Show Quotes',
					'param_name' => 'image',
					"value" => Array( "Yes" => 'yes'),
					'description' => 'Show or hide quotes'
				),

				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Quote Text',
					'param_name'  => 'content',
					'value'       => 'Your quote text',
					'description' => 'Enter your quote text here.'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author',
					'param_name'  => 'author',
					'value'       => '',
					'description' => 'Enter the quote author. May be left blank.'
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

	//register container for the quote slider
	vc_map(
		array(
			"name" =>  "Mint - Quote Slider",
			"base" => "quote_slider",
			"as_parent" => array("only" => "quote"),
			"content_element" => true,
		    'params'   => array(

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Show Quotes',
					'param_name' => 'image',
					"value" => Array( "Yes" => 'yes'),
					'description' => 'Show or hide quotes'
				),

				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Quote Text',
					'param_name'  => 'content',
					'value'       => 'Your quote text',
					'description' => 'Enter your quote text here.'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author',
					'param_name'  => 'author',
					'value'       => '',
					'description' => 'Enter the quote author. May be left blank.'
 				),
 				array(
					'type'        => 'textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Quote Two Text',
					'param_name'  => 'content2',
					'value'       => 'Your quote text',
					'description' => 'Enter your quote text here.'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author',
					'param_name'  => 'author2',
					'value'       => '',
					'description' => 'Enter the quote author. May be left blank.'
 				),
 				array(
					'type'        => 'textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Quote Three Text',
					'param_name'  => 'content3',
					'value'       => '',
					'description' => 'Enter your quote text here.'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author',
					'param_name'  => 'author3',
					'value'       => '',
					'description' => 'Enter the quote author. May be left blank.'
 				),
 				array(
					'type'        => 'textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Quote Three Text',
					'param_name'  => 'content4',
					'value'       => '',
					'description' => 'Enter your quote text here.'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author',
					'param_name'  => 'author4',
					'value'       => '',
					'description' => 'Enter the quote author. May be left blank.'
 				),
 				array(
					'type'        => 'textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Quote Three Text',
					'param_name'  => 'content5',
					'value'       => '',
					'description' => 'Enter your quote text here.'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author',
					'param_name'  => 'author5',
					'value'       => '',
					'description' => 'Enter the quote author. May be left blank.'
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

           ),    				
		)
	);

}

if(class_exists("WPBakeryShortCodesContainer"))
{
	class WPBakeryShortCode_Quote_Slider extends WPBakeryShortCodesContainer {}
}

if(class_exists("WPBakeryShortCode"))
{
	class WPBakeryShortCode_Quote extends WPBakeryShortCode {}
}