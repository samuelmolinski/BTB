<?php
global $mint_easing;
/* Quote Shortcode for Visual Composer */
if (!function_exists('mint_vc_mcarousel_sc'))
{
	function mint_vc_mcarousel_sc($atts, $content = null)
	{

		global $mint_easing;
		extract(shortcode_atts( array(
			'ids' 		    => null,
			'title'         => '',
			'easing' 	    => 'linear',
			'arrows'  	    => true
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$gallery_easing = (!in_array($easing, $mint_easing )) ? "linear" : $easing;
		$gallery_has_arrows     = (!$arrows)     ? false : true;
		$gallery_has_title = (empty($title)) ? false : true;

		$gallery_images = explode("," , $ids);
		if (empty($gallery_images)) $gallery_images = array();

		$link_to = (!empty($link_to)) ? $link_to : "#";

		ob_start();

		?>
			<div class="mint-carousel">
				<?php
					if($gallery_has_title)
					{
						?>
						<div class="pull-left mint-carousel-title"><h3><?php echo $title; ?></h3></div>
						<?php
					}

					if($gallery_has_arrows)
					{
						?>
							<div class="mint-carousel-arrows pull-right"></div>
							<div class="clearfix"></div>
						<?php
					}
				?>
				<div class="clearfix"></div>
				<div class="mint-carousel-container">
					<?php
						if( !empty($gallery_images) && is_array($gallery_images)) // slider container
						{
							foreach($gallery_images as $id)
							{
								$slide = get_post($id);
								?>
								<a class="mint-item-slide colorbox" href="<?php echo $slide->guid; ?>"><img src="<?php echo MintUtils::resized($slide->guid, 100, 90); ?>" width="100" height="90" alt="<?php echo $slide->post_title; ?>" /></a>
								<?php
							}
						}
					?>
				</div>
			</div>
		<?php
		$html = ob_get_clean();
		wp_reset_query();
		return $html;
	}
}

add_shortcode( 'mcarousel', 'mint_vc_mcarousel_sc' );


if (function_exists('wpb_map'))
{
	global $mint_easing;
	wpb_map(
		array(
			'name'     => 'Mint - Carousel',
			'base'     => 'mcarousel',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-mcarousel',
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
 					'type'        => 'textfield',
 					'holder'      => 'div',
 					'class'       => '',
 					'heading'     => 'Title',
 					'param_name'  => 'title',
 					'value'       => '',
 					'description' => 'Slider Title'
 				),

			    array(
			      "type" => 'checkbox',
			      "heading" => "Enable Arrows?",
			      "param_name" => "arrows",
			      
			      "value" => Array( "Yes" => 'yes')
			    ),

				array(
					'type'        => 'dropdown',
					'holder'	  => 'div',
					'class'		  => '',
					'heading'	  => 'Easing',
					'param_name'  => 'easing',
					'description' => 'Select the easing',
					'value'		  => $mint_easing
				)

			)
		)
	);
}