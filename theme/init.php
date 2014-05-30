<?php
	if (!defined('ABSPATH')) die();
	
	define("MINT_VERSION", "1.0");

	// Init all third party libraries
	require_once get_template_directory() . "/theme/libs/init.php";


	// Ask for default plugins to be installed
	require_once get_template_directory() . "/theme/plugins.php";

	// Include theme files
	require_once get_template_directory() . "/theme/prerequisites.php";
	require_once get_template_directory() . "/theme/vars.php";
	require_once get_template_directory() . "/theme/genopt.php";
	require_once get_template_directory() . "/theme/theme-options.php";
	require_once get_template_directory() . "/theme/shortcodes.php";
	require_once get_template_directory() . "/theme/admin.php";
	require_once get_template_directory() . "/theme/author-profile.php";
	require_once get_template_directory() . "/theme/assets.php";
	require_once get_template_directory() . "/theme/common.php";
	require_once get_template_directory() . "/theme/header.php";
	require_once get_template_directory() . "/theme/functions.php";
	require_once get_template_directory() . "/theme/cpt-portfolio.php";
	require_once get_template_directory() . "/theme/cpt-timeline.php";
	require_once get_template_directory() . "/theme/headers/header-common.php";
	require_once get_template_directory() . "/theme/inner-headers/inner-common.php";
	require_once get_template_directory() . "/theme/footers/footer-common.php";
	require_once get_template_directory() . "/theme/sidebars.php";
	require_once get_template_directory() . "/theme/load-template.php";
	require_once get_template_directory() . "/theme/widgets/widgets.php";
	require_once get_template_directory() . "/theme/metabox.php";
	require_once get_template_directory() . "/theme/generate-style.php";
	require_once get_template_directory() . "/theme/documentation.php";
	require_once get_template_directory() . "/theme/columns.php";
	require_once get_template_directory() . "/theme/woocommerce.php";
	require_once get_template_directory() . "/theme/visual-composer/extend.php";
	require_once get_template_directory() . "/theme/tinymce/tinymce.php";