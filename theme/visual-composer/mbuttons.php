<?php
/* Quote Shortcode for Visual Composer */
if (!function_exists('mint_vc_mbuttons_sc'))
{
	function mint_vc_mbuttons_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			"type" => "default",
			'el_class' => null,
			"href" => null
		) , $atts));

		ob_start();

		$href = vc_build_link($href);
		?>
			<a class="btn btn-<?php echo $type; ?> <?php echo $el_class; ?>" href="<?php echo $href['url']; ?>" target="<?php echo $href['target']; ?>"><?php echo $href['title']; ?></a>
		<?php
		$html = ob_get_clean();
		#wp_reset_query();
		return $html;
	}
}

add_shortcode( 'mbuttons', 'mint_vc_mbuttons_sc' );


if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint Buttons',
			'base'     => 'mbuttons',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-mbuttons',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

			    array(
			      "type" => "vc_link",
			      "param_name" => "href"
			    ),
			    array(
			    	"type" => "dropdown",
			    	"heading" => __("Choose your Button Type", "js_composer"),
			    	"param_name" => "type",
			    	"value" => array(
			    		"Default"    => "default",
			    		"Sky Blue"   => "sky_blue",
			    		"Sea Blue"   => "sea_blue",
			    		"Dull Blue"  => "dull_blue",
			    		"Orange"     => "orange",
			    		"Purple"     => "purple",
			    		"Bright Red" => "bright_red",
			    		"Maroon"     => "maroon",
			    		"Yellow"     => "yellow",
			    		"Silver"     => "silver"
			    	),
			    	

			    ),
			    array(
					'type'        => 'textfield',
					'holder'      => 'a',
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