<?php
/* Quote Shortcode for Visual Composer */
if (!function_exists('mint_vc_macbook_slider_sc'))
{
	function mint_vc_macbook_slider_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'ids' 		    => null,
			'el_class'      => null
		) , $atts));

		$slidew = 411;
		$gallery_images = explode("," , $ids);
		if (empty($gallery_images)) $gallery_images = array();

		ob_start();

		?>
			<div class="macbook_slider_all <?php $el_class ?>">
				<div class="macbook_slider_glass"></div>
				<div class="macbook_slider">
					<?php
					if( !empty($gallery_images) && is_array($gallery_images)) // slider main images
					{
						foreach($gallery_images as $id)
						{
							$slide = get_post($id);
							?>
							<img src="<?php echo MintUtils::resized($slide->guid, $slidew, NULL); ?>" width="<?php echo $slidew; ?>" alt="" />
							<?php
						}
					}
					?>
				</div>
			</div>
		<?php
		$html = ob_get_clean();
		#wp_reset_query();
		return $html;
	}
}

add_shortcode( 'macbook_slider', 'mint_vc_macbook_slider_sc' );


if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Macbook Slider',
			'base'     => 'macbook_slider',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-macbook_slider',
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
					'heading'     => 'Element Class',
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => ''
 				)

 				
			)
		)
	);
}