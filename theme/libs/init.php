<?php
	if (!defined('ABSPATH')) die();

	define('RWMB_URL', get_template_directory_uri() . '/theme/libs/MetaBox/');

	require_once get_template_directory() . '/theme/libs/' . "GoogleWebFonts/GoogleWebFonts.php";
	require_once get_template_directory() . '/theme/libs/' . "MetaBox/meta-box.php";
	require_once get_template_directory() . '/theme/libs/' . "Options/Options.php";
	require_once get_template_directory() . '/theme/libs/' . "Utils/Utils.php";
	require_once get_template_directory() . '/theme/libs/' . 'TGM_Plugin_Activation/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/theme/libs/' . 'custom-sidebars/custom-sidebars.php';
	require_once get_template_directory() . '/theme/libs/' . 'LexParser/Parser.php';