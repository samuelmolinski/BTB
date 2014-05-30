<?php
/* Testimonials Shortcode for Visual Composer */
if (class_exists('Latest_Tweets_Widget'))
{
	if (!function_exists('mint_vc_twitter_sc'))
	{
		function mint_vc_twitter_sc($atts, $content = null)
		{
			extract(shortcode_atts( array(
				'title'       => __('Latest Tweets' , 'Mint'),
				'screen_name' => null,
				'num'         => 5,
				'rts'         => false,
				'ats'         => false,
			) , $atts));

			$content = wpb_js_remove_wpautop($content);
			// Latest_Tweets_Widget
			ob_start();
			the_widget('Latest_Tweets_Widget', $atts);
			$html = ob_get_clean();
			return $html;
		}
	}

	add_shortcode( 'tweets', 'mint_vc_twitter_sc' );
}

if (function_exists('wpb_map'))
{
	if (class_exists('Latest_Tweets_Widget'))
	{

		wpb_map(
			array(
				'name'     => 'Mint - Tweets',
				'base'     => 'tweets',
				'class'    => '',
				'controls' => 'full',
				'icon'     => 'mint-icon-twitter',
				'category' => __('Content', 'js_composer'),
				'params'   => array(

					array(
						'type'        => 'textfield',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Heading',
						'param_name'  => 'title',
						'description' => 'Choose a heading for this wiget'
	 				),

	 				array(
						'type'        => 'textfield',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Screen Name',
						'param_name'  => 'screen_name',
						'description' => ''
	 				),

	 				array(
						'type'        => 'textfield',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Tweets',
						'param_name'  => 'num',
						'value'       => 5,
						'description' => 'Choose how many tweets to show'
	 				),



	 			

	 				array(
						'type'        => 'checkbox',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Show retweets',
						'param_name'  => 'rts',
						'value'       => array("Yes" => 'yes'),
		
	 				),

	 				array(
						'type'        => 'checkbox',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Show replies',
						'param_name'  => 'ats',
						'value'       => array("Yes" => "yes"),
		
	 				),


					

	 				
				)
			)
		);
	}
}