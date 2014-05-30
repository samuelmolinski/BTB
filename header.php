<?php if (!defined("ABSPATH")) die(); ?><?php do_action('mint_before_html_start'); ?>
<?php if (!defined('MINT_LOAD_CUSTOM_HEADER')) { ?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php if (!defined("MINT_GLOB_TITLE")) { echo wp_title('|', true, 'right'); } else { echo MINT_GLOB_TITLE . " |"; } ?> <?php bloginfo('description'); ?> | <?php bloginfo('name'); ?></title>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php

if(!ACCESSED){
$loadpage = MintOptions::get("loading-page", false);
$logo = MintOptions::get("loadinglogo");
if($loadpage == true){ ?> 
<div id="loader">
<div id="loder" ><div class="loading-container">
    <div class="loading-screen"></div>
    <div id="loading-text"><img src="<?php echo $logo; ?>"></div>
</div></div></div>
<?php } }?>
	<!-- Nav goes here -->
<?php
	$mpid = mint_get_page_id();
	$boxed = get_post_meta($mpid, MINT_PX . 'boxed_layout', true);

	if ($boxed != "fullwidth")
	{
		if(MintOptions::get("page-boxed", false) || $boxed == "boxed") { echo '<div class="all-elastic">'; }
	}
 

	$header = MintOptions::get("header_layout", "v1");
	$show_shadow = MintOptions::get("shadow-menu", false);
	$show_flat_shadow = MintOptions::get("flat-shadow-menu", false);

    $shadow = "";
		if($show_shadow == true){ $shadow = "menu-shadow"; }
	$shadow_flat = "";
		if($show_flat_shadow == true){ $shadow_flat = "menu-shadow-flat"; }

?>
<header class="h<?php echo $header ; ?> <?php echo $shadow ; ?> <?php echo $shadow_flat ; ?> ">
	<?php 
		switch ($header) {
			case 'v1':
				include get_template_directory() . "/theme/headers/header1.php"; 
				break;
			case 'v2':
				include get_template_directory() . "/theme/headers/header2.php"; 
				break;
			case 'v3':
				include get_template_directory() . "/theme/headers/header3.php"; 
				break;
			case 'v4':
				include get_template_directory() . "/theme/headers/header4.php"; 
				break;
			case 'v5':
				include get_template_directory() . "/theme/headers/header5.php"; 
				break;
			case 'v6':
				include get_template_directory() . "/theme/headers/header6.php"; 
				break;
			case 'v7':
				include get_template_directory() . "/theme/headers/header7.php"; 
				break;
			default:
				include get_template_directory() . "/theme/headers/header1.php"; 
				break;
		}
	?>
<span class="clearfix"></span>
</header></div>

<?php } ?>