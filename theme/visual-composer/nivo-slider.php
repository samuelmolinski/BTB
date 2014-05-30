<?php
global $mint_easing;
/* Nivo Slider Shortcode for Visual Composer */
if (!function_exists('mint_vc_nivo_sc'))
{
	function mint_vc_nivo_sc($atts, $content = null)
	{
		global $is_nivo;
		$is_nivo = true;

		
		extract(shortcode_atts( array(
			'ids' 		    => null,
			'slidew'        => 940,
			'slideh'     	=> null,
			'theme'         => 'default'
		) , $atts));



		$content = wpb_js_remove_wpautop($content);

		$ids = @explode(",", $ids);

		if (!is_array($ids) || empty($ids)) return;
		$ids = array_map('intval', $ids);

		//$theme = ( !in_array($theme, array('bar', 'light', 'dark', 'default') ) ) ? "default" : $theme; 
		$theme = "default";

		ob_start();
		?>
		<div class='mint-nivo-slider'>

			<div class="slider-wrapper theme-<?php echo $theme; ?>">
	            <div class="nivoSlider">
	                <?php foreach($ids as $i) : ?>
						<img src="<?php echo MintUtils::resized( get_post($i)->guid , $slidew, $slideh ); ?>" />
	                <?php endforeach; ?>
	            </div>
	          
	        </div>


		</div>
       <?php

		$html = ob_get_clean();

		return $html;
	}
}

add_shortcode( 'nivoSlider', 'mint_vc_nivo_sc' );


if (function_exists('wpb_map'))
{
	global $mint_easing;
	wpb_map(
		array(
			'name'     => 'Nivo Slider',
			'base'     => 'nivoSlider',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-nivoslider',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'attach_images',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Images',
					'param_name'  => 'ids',
					'value'       => '',
					'description' => 'Upload your image slides here'
 				),


				array(
					'type'    => 'textfield',
					'holder'  => 'div',
					'class'   => '',
					'heading' => 'Slider Images Width',
					'param_name' => 'slidew',
					'description' => 'Enter the images width',
					'value' => '940'
				),


				array(
					'type'    => 'textfield',
					'holder'  => 'div',
					'class'   => '',
					'heading' => 'Slider Images Height',
					'param_name' => 'slideh',
					'description' => 'Enter the images height. Set to 0 if you want images to be resized proportionally to the width.',
					'value' => '0'
				)
 				
			)
		)
	);
}