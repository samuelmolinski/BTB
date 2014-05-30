<?php

if (!function_exists('mint_get_header_inner_styles'))
{
	function mint_get_header_inner_styles()
	{
		$page_id = mint_get_page_id();

		$background = get_post_meta( $page_id, MINT_PX . 'inner_bg', true);
		$repeat     = get_post_meta( $page_id, MINT_PX . 'inner_bg_repeat', true);
		$color      = get_post_meta( $page_id, MINT_PX . 'inner_bg_color', true);
		$strech     = get_post_meta( $page_id, MINT_PX . 'inner_bg_strech', true);

		$background = ($background == "default" || !$background) ? false : $background;
		$repeat     = ($repeat == "default" || !$repeat) ? false : $repeat;
		$color      = ($color == "default" || !$color) ? false : $color;
		$strech     = ($strech == "default" || !$strech) ? false : $strech;
		


	}
}
add_action('wp_head', 'mint_get_header_inner_styles');

if(!function_exists("mint_get_header_inner_context"))
{
	function mint_get_header_inner_context($section = "section1")
	{
		$page_id = mint_get_page_id();
		$context = get_post_meta( $page_id , MINT_PX . 'header_inner_' . $section, true);
		$mb = true;

		if (!$context || $context == "default")	
		{
			$context = MintOptions::get('inner-' . $section);
			$mb = false;
		}

		$title = (defined('MINT_GLOB_TITLE')) ? MINT_GLOB_TITLE : false;


		$inner_version = MintOptions::get("inner_layout");

		switch ($context) {
			case 'social-links':
				mint_get_social();
				break;
			case 'text-1':
				if (!$mb) {
					echo do_shortcode(MintOptions::get('header-inner-text-1'));
				}
				else
				{
					echo do_shortcode( get_post_meta( $page_id , MINT_PX . 'inner_text_1', true) );
				}
				break;
			case 'text-2':
				if (!$mb) {
					echo do_shortcode(MintOptions::get('header-inner-text-2'));
				}
				else
				{
					echo do_shortcode( get_post_meta( $page_id , MINT_PX . 'inner_text_2', true) );
				}
				break;
			case 'text-3':
				if (!$mb) {
					echo do_shortcode( MintOptions::get('header-inner-text-3') );
				}
				else
				{
					echo do_shortcode( get_post_meta( $page_id , MINT_PX . 'inner_text_3', true) );
				}
				break;
			case 'search':
				get_search_form();
				break;
			case 'title':
				do_shortcode( mint_get_page_title($title) );
				break;
			case 'breadcrumbs':
				mint_get_breadcrumbs();
				break;
			default:
				# ...
				break;
		}
	}
}

if(!function_exists("mint_get_page_title"))
{
	function mint_get_page_title($title = false)
	{
		$page_id = mint_get_page_id();
		if ($title == false)
		{
			$title = get_post_meta( $page_id, MINT_PX . "page_title", true );
			if (!$title) $title = get_the_title();
		}

		$icon = get_post_meta( $page_id, MINT_PX . 'page_icon', true );
		if (!$icon) 
		{
			$icon = MintOptions::get("header-inner-icon");
		} 
		else 
		{
			list($icon) = wp_get_attachment_image_src( $icon, 'original' ); 
		}
		$icon = (empty($icon)) ? "" : "<span class='inner-title-icon'><img src='{$icon}' alt='' /></span> ";
		?>

		<?php if (defined('MINT_GLOB_TITLE')) $title = MINT_GLOB_TITLE; ?>
		<h2><?php echo $icon; ?><?php echo $title; ?></h2>
		<?php
	}
}

if(!function_exists("mint_get_breadcrumbs"))
{
	function mint_get_breadcrumbs()
	{
		
		$divider = MintOptions::get("inner-breadcrumbs-divider");
		?>
		<div class="mint-breadcrumbs"><?php MintUtils::getBreadcrumbs(" " . $divider . " "); ?></div> 
		<?php
	}
}