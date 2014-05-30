<?php
/* Promo Shortcode for Visual Composer */
if (!function_exists('mint_vc_promobox_sc'))
{
	function mint_vc_promobox_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'title' => null,
			'image' => null,
			'type' 	=> 'promobox-a',
			'btn' => null,
			'is_bg_fullwidth' => 0,
			'bg_color' => null,
			'content_offset_y' => 0,
			'el_class' => null,
			'btn_offset_y' => 0
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$promobox_classes = array();
		$promobox_classes[] = "promobox";
		$promobox_classes[] = $is_bg_fullwidth ? "fullwidth" : ""; 
		$promobox_classes[] = $type;

		$bg_color = $bg_color ? "style='background-color:{$bg_color}'" : "";

		ob_start();
		?>
		
		<div <?php echo $bg_color; ?> class="<?php echo mint_class( $promobox_classes ); ?>">
			<div class="media elastic <?php $el_class ?> ">
				<div class="pull-right">
					<?php 
						if($btn)
						{
							$btn = vc_build_link($btn);
							?>
							<a style="margin-top:<?php echo $btn_offset_y; ?>px" class="btn" href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>"><?php echo $btn['title']; ?></a>
							<?php
						}
					?>
				</div>
				<div class="media-body">
					<?php 
						if($image)
						{
							$img = get_post($image);
							?>
							<img class="media-image pull-left" src="<?php echo $img->guid; ?>" alt="">
							<?php
						}
					?>
					<h3 class="media-heading" style="margin-top:<?php echo $content_offset_y; ?>px"><?php echo $title; ?></h3>
					<?php echo $content; ?>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<?php
		$html = ob_get_clean();
		return $html;
	}
}

add_shortcode( 'promobox', 'mint_vc_promobox_sc' );

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Promo Box',
			'base'     => 'promobox',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-promobox',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Title',
					'param_name' => 'title',
					'value' => '',
					'description' => 'Title of the promobox'
				),

				array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Image',
					'param_name' => 'image',
					'value' => ''
				),

				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Description',
					'param_name' => 'content',
					'value' => '',
					'description' => 'Content of the promobox'
				),

				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Button',
					'param_name' => 'btn',
					'value' => '',
					'description' => 'The Button Link and Text'
				),

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Enable Fullwidth Background?',
					'param_name' => 'is_bg_fullwidth',
					"value" => Array( "Yes" => 'yes'),
					'description' => 'The Button Text'
				),

				array(
					'type' => 'colorpicker',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Background Color',
					'param_name' => 'bg_color',
					'value' => '',
					'description' => 'Choose the background color for promobox'
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Content Offset Y',
					'param_name' => 'content_offset_y',
					'value' => 0,
					'description' => 'Choose the content offset from top. Ex: 10'
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Button Offset Y',
					'param_name' => 'btn_offset_y',
					'value' => 0,
					'description' => 'Choose the button offset from top. Ex: 10'
				),

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Promo Box',
					'param_name'  => 'type',
					'value'       => array(
						'Promo Box A' => 'promobox-a',
						'Promo Box B' => 'promobox-b',
						'Promo Box C' => 'promobox-c'
					),
					'description' => 'Select the promobox type.'
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
}