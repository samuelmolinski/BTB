<?php
global $mint_easing;
/* Quote Shortcode for Visual Composer */
if (!function_exists('mint_vc_mslider_sc'))
{
	function mint_vc_mslider_sc($atts, $content = null)
	{

		global $mint_easing;
		extract(shortcode_atts( array(
			'ids' 		    => null,
			'mode' 		    => 'horizontal',
			'easing' 	    => 'linear',
			'bullets' 	    => true,
			'arrows'  	    => true,
			'thumbnails'    => false,
			'text_type'     => 'none',
			'slidew'        => 940,
			'lightbox'      => false
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$gallery_text_type = (!$text_type) ? "none" : $text_type;

		if ( !in_array($gallery_text_type, array( 'none','minimalistic','extended','full') ) )  {
			$gallery_text_type = 'none';
		}

		$gallery_mode   = (!in_array($mode,   array('horizontal', 'vertical', 'fade') )) ? "horizontal" : $mode;
		$gallery_easing = (!in_array($easing, $mint_easing )) ? "linear" : $easing;

		$gallery_has_bullets    = (!$bullets)    ? false : true;
		$gallery_has_thumbnails = (!$thumbnails) ? false : true;
		$gallery_has_arrows     = (!$arrows)     ? false : true;

		$gallery_images = explode("," , $ids);
		if (empty($gallery_images)) $gallery_images = array();

		if (!isset($atts['arrows']))     $gallery_has_arrows = false;
		if (!isset($atts['bullets']))    $gallery_has_bullets = false;
		if (!isset($atts['thumbnails'])) $gallery_has_thumbnails = false;

		ob_start();

		?>
			<div class="all-mint-slider">
						<div class="mint-slider" data-slider-easing="<?php echo $gallery_easing; ?>" data-slider-mode="<?php echo $gallery_mode; ?>">
							<div class="mint-slider-main">
								<?php

									if( !empty($gallery_images) && is_array($gallery_images)) // slider main images
									{
										foreach($gallery_images as $id)
										{
											$slide = get_post($id);
											?>
											<div class="slide">
												<?php
													if($lightbox)
													{
														?>
														<a class="colorbox" href="<?php echo $slide->guid; ?>"><img src="<?php echo MintUtils::resized($slide->guid, $slidew, NULL); ?>" width="<?php echo $slidew; ?>" alt="" /></a>
														<?php
													}
													else
													{
														$link = ( get_post_meta($slide->ID, 'custom_url', true) ) ? get_post_meta($slide->ID, 'custom_url', true) : "#";
														?>
														<a href="<?php echo $link; ?>"><img src="<?php echo MintUtils::resized($slide->guid, $slidew, NULL); ?>" width="<?php echo $slidew; ?>" alt="" /></a>
														<?php
													}
												?>

												<?php
													switch($gallery_text_type) // slider types
													{
														case "none":
															break;
														case "minimalistic":
															if($slide->post_title || $slide->post_content)
															{
																?>
																<div class="mint-slider-description-minimalistic">
																	<?php if($slide->post_title) : ?>
																		<div class="mint-slider-caption mint-slider-title pull-right"><?php echo $slide->post_title; ?></div><div class="clearfix"></div>
																	<?php endif; ?>

																	<?php if($slide->post_content) : ?>
																		<div class="mint-slider-caption mint-slider-content pull-right"><?php echo $slide->post_content; ?></div><div class="clearfix"></div>
																	<?php endif; ?>
																</div>
																<?php
															}
															break;
														case "extended":
															if($slide->post_title || $slide->post_content)
															{
																?>
																<div class="mint-slider-description-extended">
																	<?php if($slide->post_title) : ?>
																		<div class="mint-slider-caption mint-slider-title"><?php echo $slide->post_title; ?></div>
																	<?php endif; ?>

																	<?php if($slide->post_content) : ?>
																		<div class="mint-slider-caption mint-slider-content"><?php echo $slide->post_content; ?></div>
																	<?php endif; ?>
																</div>
																<?php
															}
															break;
														case "full":
															if($slide->post_title || $slide->post_content)
															{
																?>
																<div class="mint-slider-description-full">
																	<?php if($slide->post_title) : ?>
																		<div class="mint-slider-caption mint-slider-title"><?php echo $slide->post_title; ?></div>
																	<?php endif; ?>

																	<?php if($slide->post_content) : ?>
																		<div class="mint-slider-caption mint-slider-content"><?php echo $slide->post_content; ?></div>
																	<?php endif; ?>
																</div>
																<?php
															}
															break;
													}
												?>
											</div>
											<?php
										}
									}
								?>
							</div>

							<?php // bullets
								if($gallery_has_bullets)
								{
									?>
									<div class="mint-slider-bullets">
										<?php
											if( !empty($gallery_images) && is_array($gallery_images)) // slider bullets
											{
												$slide_index = 0;
												$slides_size = count($gallery_images);
												while($slide_index < $slides_size)
												{
													?>
													<a data-slide-index="<?php echo $slide_index; ?>" class="slide-bullet" href="#"></a>
													<?php
													$slide_index++;
												}
											}
										?>
									</div>
									<?php
								}
							?>

							<?php // arrows
								if($gallery_has_arrows)
								{
									?>
									<div class="mint-slider-arrows"></div>
									<?php
								}
							?>
						</div> <!-- end mint slider -->

						<?php // thumbnails
							if($gallery_has_thumbnails)
							{
								?>
								<div class="mint-slider-pager mint-slider-thumbnails">
									<?php
										if( !empty($gallery_images) && is_array($gallery_images)) // slider thumbnails
										{
											$slide_index = 0;
											foreach($gallery_images as $id)
											{
												$slide = get_post($id);
												?>
												<a data-slide-index="<?php echo $slide_index; ?>" class="slide-thumb" href="#"><img src="<?php echo MintUtils::resized($slide->guid, 84, 67); ?>" width="84" height="67" alt="" /></a>
												<?php
												$slide_index++;
											}
										}
									?>
								</div>
								<div class="space20">&nbsp;</div>
								<?php
							}
							else
							{
								?>
								<div class="space15">&nbsp;</div>
								<?php
							}
						?>
					</div> <!-- end of all mint slider -->
		<?php
		$html = ob_get_clean();
		#wp_reset_query();
		return $html;
	}
}

add_shortcode( 'mslider', 'mint_vc_mslider_sc' );


if (function_exists('wpb_map'))
{
	global $mint_easing;
	wpb_map(
		array(
			'name'     => 'Mint - Slider',
			'base'     => 'mslider',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-mslider',
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
			      "type" => 'checkbox',
			      "heading" => "Enable Bullets?",
			      "param_name" => "bullets",
			      
			      "value" => array( "Yes" => 'yes')
			    ),

			    array(
			      "type" => 'checkbox',
			      "heading" => "Enable Arrows?",
			      "param_name" => "arrows",
			      
			      "value" => array( "Yes" => 'yes')
			    ),

			    array(
			      "type" => 'checkbox',
			      "heading" => "Enable Thumbnails?",
			      "param_name" => "thumbnails",
			     
			      "value" => array( "Yes" => 'yes')
			    ),

			    array(
			    	'type' => 'checkbox',
			    	'heading' => 'Enable Lightbox?',
			    	'param_name' => 'lightbox',
			    	'value' => array('Yes' => 'yes')
			    ),

				array(
					'type'        => 'dropdown',
					'holder'	  => 'div',
					'class'		  => '',
					'heading'	  => 'Mode',
					'param_name'  => 'mode',
					'description' => 'Select the slider mode',
					'value'		  => array(
						'Horizontal' => 'horizontal',
						'Vertical'   => 'vertical',
						'Fade'		 => 'fade'
					)
				),

				array(
					'type'        => 'dropdown',
					'holder'	  => 'div',
					'class'		  => '',
					'heading'	  => 'Easing',
					'param_name'  => 'easing',
					'description' => 'Select the easing',
					'value'		  => $mint_easing
				),

				array(
					'type'        => 'dropdown',
					'holder'	  => 'div',
					'class'		  => '',
					'heading'	  => 'Text Type',
					'param_name'  => 'text_type',
					'description' => 'Select the text type. ',
					'value'		  => array(
						'None' =>   'none',
						'Minimalistic' => 'minimalistic',
						'Extended'     => 'extended',
						'Full'		   => 'full',
					)
				),
				

				array(
					'type'    => 'textfield',
					'holder'  => 'div',
					'class'   => '',
					'heading' => 'Slider Images Width',
					'param_name' => 'slidew',
					'description' => 'Enter the images width',
					'value' => '940'
				)

 				
			)
		)
	);
}
