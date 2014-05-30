<?php
global $mint_easing;
/* Flex Slider Shortcode for Visual Composer */
if (!function_exists('mint_vc_flexslider_sc'))
{
	function mint_vc_flexslider_sc($atts, $content = null)
	{
		global $is_flexslider;
		$is_flexslider = true;

		
		extract(shortcode_atts( array(
			'ids' 		 => null,
			'slidew'     => 940,
			'slideh'     => null,
			'animation'  => 'slide',
			'controlnav' => 'bullets',
			'thumb_w'    => 150,
			'thumb_h'    => 150,         
		) , $atts));



		$content = wpb_js_remove_wpautop($content);

		$ids = @explode(",", $ids);

		if (!is_array($ids) || empty($ids)) return;
		$ids = array_map('intval', $ids);

		$animation  = ( !in_array($animation, array('slide', 'fade') ) ) ? "slide" : $animation; 
		
		$controlnav = ( !in_array($controlnav, array('bullets', 'thumbnails') ) ) ? "bullets" : $controlnav; 

		
		

		ob_start();
		?>
		<div data-controlNav="<?php echo $controlnav; ?>" data-animation="<?php echo $animation; ?>" data- class='mint-flex-slider'>
			
			<div class="flexslider">
			  <ul class="slides">
			  <?php foreach($ids as $i) : $src = get_post($i)->guid; ?>
			    <li data-thumb="<?php echo MintUtils::resized( $src , $thumb_w , $thumb_h ); ?>">
			      <img src="<?php echo MintUtils::resized($src, $slidew, $slideh ); ?>" />
			    </li>
			  <?php endforeach; ?>
			  </ul>
			</div>

		</div>
       <?php

		$html = ob_get_clean();

		return $html;
	}
}

add_shortcode( 'flexslider', 'mint_vc_flexslider_sc' );


if (function_exists('wpb_map'))
{
	global $mint_easing;
	wpb_map(
		array(
			'name'     => 'Flex Slider',
			'base'     => 'flexslider',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-flexslider',
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
					'type'        => 'dropdown',
					'holder'	  => 'div',
					'class'		  => '',
					'heading'	  => 'Animation Type',
					'param_name'  => 'animation',
					'description' => 'Select the animation type',
					'value'		  => array(
						'Slide' 	 => 'slide',
						'Fade'        => 'fade',
					)
				),

				array(
					'type'        => 'dropdown',
					'holder'	  => 'div',
					'class'		  => '',
					'heading'	  => 'Controls Type',
					'param_name'  => 'controlNav',
					'description' => 'Select controls type',
					'value'		  => array(
						'Bullets' 	 => 'bullets',
						'Thumbnails' => 'thumbnails',
					)
				),

			
				array(
					'type'    => 'textfield',
					'holder'  => 'div',
					'class'   => '',
					'heading' => 'Slider Images Width',
					'param_name' => 'slidew',
					'description' => '',
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
				),
				array(
					'type'    => 'textfield',
					'holder'  => 'div',
					'class'   => '',
					'heading' => 'Thumbnails Images Height',
					'param_name' => 'thumb_w',
					'description' => '',
					'value' => '150'
				),
				array(
					'type'    => 'textfield',
					'holder'  => 'div',
					'class'   => '',
					'heading' => 'Thumbnails Images Height',
					'param_name' => 'thumb_h',
					'description' => '',
					'value' => '150'
				)
 				
			)
		)
	);
}