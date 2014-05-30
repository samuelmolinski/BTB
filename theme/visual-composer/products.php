<?php
if(!function_exists("mint_vc_products_sc"))
{
	function mint_vc_products_sc($attrs, $content = null)
	{
		extract( shortcode_atts( array(
			'per_page' => 12,
			'columns' => 4,
			'orderby' => 'date',
			'order' => 'desc'
		), $attrs ) );

		return "<div id='mint_wc'><div id='mint_wc_<?php echo $columns; ?>'>". do_shortcode("[recent_products per_page=$per_page columns=$columns orderby=$orderby order=$order ]") ."</div></div>";

	}
}
if(mint_is_wc_active()) { add_shortcode("mint_products", "mint_vc_products_sc"); }

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Products',
			'base'     => 'mint_products',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-products',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Products Per Page',
					'param_name'  => 'per_page',
					'value'       => 12
				),

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Columns',
					'param_name'  => 'columns',
					'value'       => array( '4 Columns' => 4, '3 Columns' => 3, '2 Columns' => 2)
 				),

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Order By',
					'param_name'  => 'orderby',
					'value'       => array( 'Date' => 'date', 'ID' => 'ID', 'Title' => 'title', 'Slug' => 'name', 'Rand' => 'rand', 'Menu Order' => 'menu_order')
 				),

 				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Order',
					'param_name'  => 'order',
					'value'       => array( 'Descending' => 'desc', 'Ascending' => 'asc')
 				)
 				
			)
		)
	);
}