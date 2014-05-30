<?php
/* Space Shortcode for Visual Composer */
if (!function_exists('mint_vc_sticky_note_sc'))
{
	function mint_vc_sticky_note_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'type' => 'note'
		) , $atts));

		$content = wpb_js_remove_wpautop($content);
		return "<div class='sticky-note sticky-note-{$type}'>{$content}</div>";
	}
}

add_shortcode( 'sticky_note', 'mint_vc_sticky_note_sc' );


if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Sticky Notes',
			'base'     => 'sticky_note',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-sticky-note',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Sticky Type',
					'param_name'  => 'type',
					'value'       => array(
						'Note'      => 'note',
						'Attention' => 'attention',
						'Alert'     => 'alert',
						'Success'   => 'success'
					),
					'description' => 'Select the Sticky Note Type.'
 				),

 				array(
 					'type' => 'textarea_html',
 					'holder' => 'div',
 					'class' => '',
 					'heading' => 'Content',
 					'param_name' => 'content',
 					'value' => 'I am text block. Click edit button to change this text.'
 				)
 				
			)
		)
	);
}