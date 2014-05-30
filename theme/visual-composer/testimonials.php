<?php
/* Testimonials Shortcode for Visual Composer */
if (!function_exists('mint_vc_testimonail_sc'))
{
	function mint_vc_testimonail_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'author_img' => null,
			'author' => null,
			'el_class' => null,
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		ob_start();
		?>
			<div class="mint-testimonial ">
				<div class="mint-testimonial-body <?php echo $el_class; ?>"><?php echo $content; ?><div class="mint-testimonial-indicator"></div></div>
				<?php if($author_img || $author) : ?>
				<div class="mint-testimonial-info">
					<?php
						if($author_img)
						{
							$testimonail_img = get_post($author_img);
							?>
							<img class="mint-testimonial-avatar" src="<?php echo MintUtils::resized($testimonail_img->guid, 40, 40); ?>" width="40" height="40" alt="" />
							<?php
						}
					?>

					<?php if($author) : ?>
						<span class="mint-testimonial-author"><?php echo $author; ?></span>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}
}

add_shortcode( 'testimonail', 'mint_vc_testimonail_sc' ); // JESUS CHRIST! SPELLCHECK!
add_shortcode( 'testimonial', 'mint_vc_testimonail_sc' ); 

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Testimonial',
			'base'     => 'testimonail',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-testimonial',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author Title',
					'param_name'  => 'author',
					'description' => 'Wrote the author title.'
 				),


				array(
					'type'        => 'attach_image',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Author Image',
					'param_name'  => 'author_img',
					'description' => 'Upload the author image.'
 				),

 				array(
 					'type' => 'textarea_html',
 					'hoder' => 'div',
 					'class' => '',
 					'heading' => 'Testimonial',
 					'param_name' => 'content',
 					'value' => 'Your Testimonial text here',
 					'description' => 'Testimonial text'
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