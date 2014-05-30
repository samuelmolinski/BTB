<?php if (!defined("ABSPATH")) die(); ?><?php define('MINT_COMPACT_HEADER_LOADED', true); ?><!doctype html>
<html lang="en">
<head <?php language_attributes(); ?>
	<meta charset="UTF-8">
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('description'); ?></title>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<?php wp_head(); ?>
</head>
<body class="tpl-compact">
	
<div class="compact">
	<div class="compact-header"><a class="compact-logo" href="<?php echo site_url(); ?>"><img src="<?php echo MintOptions::get("logo"); ?>" alt="" /></a></div>
		<div class="compact-body">
		