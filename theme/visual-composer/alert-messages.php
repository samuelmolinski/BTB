<?php

/* SC Alert Messages */
if (!function_exists('mint_vc_alert_messages_sc'))
{
	function mint_vc_alert_messages_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'type' => 'general',
			'title' => 'Your Message Goes Here',
			'x'     => false
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$extra_padding = "";
		if($x)
		{
			$extra_padding = "mint-alert-extrapadding";
		}

		ob_start();
		?>
		
		<div class="mint-alert-messages mint-alert-<?php echo $type; ?> <?php echo $extra_padding; ?>">
			<?php if($x) : ?><div class="mint-alert-close icon-cancel-circled"></div><?php endif; ?>
			<span><i class="mint-alert-icon icon-<?php echo $type; ?>"></i> <?php echo $title; ?></span>
		</div>

		<?php
		$html = ob_get_clean();
		return $html;
	}
}
add_shortcode( 'alert_messages', 'mint_vc_alert_messages_sc' );

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Alert Messages',
			'base'     => 'alert_messages',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-alert-messages',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'    => 'textfield',
					'holder'  => 'div',
					'class'   => '',
					'heading' => 'Message Title',
					'param_name' => 'title',
					'description' => 'Enter the alert message title',
					'value' => 'Your Message Goes Here'
				),

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Alert Messages Type',
					'param_name'  => 'type',
					'value'       => array(
						'General Message' => 'mail',
						'Error Message'   => 'attention',
						'Help Message'    => 'lifebuoy',
						'Notice Message'  => 'info-circled',
						'Success Message' => 'flag',
						'Info Message'    => 'lamp'
					),
					'description' => 'Select your alert message type.'
 				),

 				 array(
			    	'type' => 'checkbox',
			    	'heading' => 'Enable Close Button?',
			    	'param_name' => 'x',
			    	'value' => array('Yes' => 'yes')
			    )
 				
			)
		)
	);
}