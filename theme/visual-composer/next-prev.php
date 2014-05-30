<?php
/* Quote Shortcode for Visual Composer */
if (!function_exists('mint_vc_next_prev_sc'))
{
	function mint_vc_next_prev_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'next' => true,
			'prev' => true
		) , $atts));

		$content = wpb_js_remove_wpautop($content);
		$html = "<div class='sc-nextprev'>";

		if ($prev)
		{
			ob_start();
			previous_post_link( '%link', __('Previous', 'Mint') );
			$html .= ob_get_clean();
		}

		if ($next)
		{

			ob_start();
			next_post_link( '%link', __('Next', 'Mint') );
			$next_url = ob_get_clean();


			if ($prev && !empty($next_url))
			{
				$html .= '<span> | </span>';
			}
			$html .= $next_url;
			
		}

		$html .= "</div>";
		return $html;
	}
}

add_shortcode( 'nextprev', 'mint_vc_next_prev_sc' );



if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Next/Previous',
			'base'     => 'nextprev',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-nextprev',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Show Next Link',
					'param_name' => 'next',
					"value" => Array( "Yes" => 'yes'),
					'description' => ''
				),

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Show Prev Link',
					'param_name' => 'prev',
					"value" => Array( "Yes" => 'yes'),
					'description' => ''
				),
				

 				
			)
		)
	);
}