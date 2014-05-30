<?php
//mint-parallax-scene
if (!function_exists('mint_vc_parallax_sc'))
{
	function mint_vc_parallax_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'ids' => null
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$gallery_images = explode("," , $ids);
		if (empty($gallery_images)) $gallery_images = array();

		ob_start();
		?>

		<div class="mint-parallax-scene">
			<div class="inside-content"><div class="elastic"><?php echo $content; ?></div></div>
			<?php
				if( !empty($gallery_images) && is_array($gallery_images)) // slider main images
				{
					foreach($gallery_images as $id)
					{
						$parallax_img = get_post($id);
						?>
						<div class="layer" data-depth="1.00"><img src="<?php echo $parallax_img->guid; ?>" alt="" /></div>
						<?php
					}
				}
			?>
		</div>

		<?php
		$html = ob_get_clean();
		return $html;
	}
}

add_shortcode( 'parallax', 'mint_vc_parallax_sc' );

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Parallax',
			'base'     => 'parallax',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-parallax',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'attach_images',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Parallax Image',
					'param_name'  => 'ids',
					'value'       => '',
					'description' => 'Upload your parallax images here'
 				),

 				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Text',
					'param_name'  => 'content',
					'value'       => 'Your text goes here'
				)

 				
			)
		)
	);
}