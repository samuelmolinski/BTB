<?php

// // Highlight Shortcode
// if(!function_exists("mint_sc_highlight"))
// {
// 	function mint_sc_highlight($attrs, $content = null)
// 	{
// 		extract( shortcode_atts( array(
// 			'type' => 'background', // background, text
// 			'color' => '#7dbd22',
// 		), $attrs ) );

// 		$style = ($type == "background") ? "padding:2px 5px;color:#fff;background-color:" . $color : "text-decoration:underline;color:". $color;

// 		return "<span style='{$style}'>" . do_shortcode($content) . "</span>";
// 	}
// 	add_shortcode("highlight", "mint_sc_highlight");
// }

// // Lists Shortcode
// if(!function_exists("mint_sc_list"))
// {
// 	function mint_sc_list($attrs, $content = null)
// 	{
// 		extract( shortcode_atts( array(
// 			'type' => 'arrow' // circle, arrow, disc, ok, decimal, upper-roman, lower-roman, lower-alpha, upper-alpha
// 		), $attrs ) );

// 		return "<div class='mint-list mint-list-{$type}'>". do_shortcode($content) ."</div>";
// 	}
// 	add_shortcode("list", "mint_sc_list");
// }

// if(!function_exists("mint_sc_dropcap"))
// {
// 	function mint_sc_dropcap($attrs, $content = null)
// 	{
// 		extract( shortcode_atts( array(
// 			'type' => 'default', // default, circle
// 			'color' => '#7dbd22'
// 		), $attrs ) );

// 		$style = ($type == "default") ? "color:" . $color : "background-color:" . $color;
// 		$id = uniqid("mint-");	
// 		return "<style>.{$id}:first-letter {".$style."}</style><div class='mint-dropcap {$id} mint-dropcap-{$type}'>" . do_shortcode($content) . "</div>";
// 	}
// 	add_shortcode("dropcap", "mint_sc_dropcap");
// }

if(!function_exists("mint_sc_wc_myaccount"))
{
	function mint_sc_wc_myaccount()
	{
		$items = "";
		$user = wp_get_current_user();
		if (is_user_logged_in()) {
	        $items .=  sprintf( __("Hi %s.", "Mint") , $user->display_name ) .  ' <a href="'. wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) ) .'">' . __("Log Out", "Mint") . '</a>';
	    }
	    elseif (!is_user_logged_in()) {
	        $items .= __("Welcome Guest", "Mint") . ', <a href="' . get_permalink( woocommerce_get_page_id( 'myaccount' ) ) . '">' . __("Log In", "Mint") . '</a> ' . __("or", "Mint") . ' <a href="'. get_permalink( woocommerce_get_page_id( 'myaccount' ) ) .'">' . __("Create an account", "Mint") . '</a>';
	    }
   		return $items;
	}
	add_shortcode("wc_myaccount", "mint_sc_wc_myaccount");
}