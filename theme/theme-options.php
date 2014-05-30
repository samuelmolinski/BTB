<?php 
	if (!defined('ABSPATH')) die();

	global $wp_registered_sidebars, $mint_default_sidebars;
	$sidebars =  array();
	
	foreach( $wp_registered_sidebars as $id => $sidebar)
	{
		$sidebars[$id] = $sidebar['name'];
	}
	foreach($mint_default_sidebars as $sidebar)
	{
		$sidebars[$sidebar] = $sidebar;
	}

	$font_sizes = array();
	for ($i=0;$i<50;$i++)
	{
		$font_sizes[$i] = $i . "px";
	}
	

	$pages = array();
	foreach( get_pages() as $page)
	{
		$pages[$page->ID] = $page->post_title;
	}

	// Main Settings
	MintOptions::section('Main Settings');
	MintOptions::info('Logo');
	MintOptions::upload('logo', 'Logo', 'Please upload your logo here', get_template_directory_uri() . '/images/logo.png');
	MintOptions::upload('logo2x', 'Logo Retina Sized', 'Please upload your twice the size here', get_template_directory_uri() . '/images/logo2x.png');
 	
	MintOptions::text('logo-width',  'Logo Width', 'Change your logo width here.', '62px');
	MintOptions::text('logo-height', 'Logo Height', 'Change your logo height here.', '38px');
	
	MintOptions::text('logo-offset-x', 'Logo X offset', 'Customize the X position of the logo by changing this value.', '0px');
	MintOptions::text('logo-offset-y', 'Logo Y offset', 'Customize the Y position of the logo by changing this value.', '0px');

	MintOptions::upload('admin-logo', 'Admin Screen Logo', 'You can upload a custom logo to the login screen (124x76)', get_template_directory_uri() . "/images/logo2x.png");

	
	MintOptions::info('Icons');
	MintOptions::upload('favicon', 'Favicon', 'Please upload your custom favicon here', get_template_directory_uri() . '/images/favicon.png');
	MintOptions::upload('apple-icon', 'Apple Icon', 'Please upload your custom apple icon here (114x114)', get_template_directory_uri() . '/images/apple-icon.png');


	MintOptions::info('General Settings');
	MintOptions::_switch('responsive', 'Responsive', 'Switch to off if you want to disable the responsive features', true);
	MintOptions::_switch('responsive_hide_sliders', 'Hide Sliders', 'Enable this if you want to hide the Revolution / Layered Slider on Mobile Devices', false);
	MintOptions::_switch('retina-support', 'Retina Ready', 'Enable or disable if you want to support retina devices.', true);
	MintOptions::textarea('tracking-code', 'Tracking Code (Google Analyitics)', 'Insert your tracking code. Don\'t forget the &lt;script&gt; tag. This will be included in your footer.');


	// Background ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Background");
	MintOptions::info('Background');
	MintOptions::upload("bg-image", 'Background Image', 'Choose your background image');
	MintOptions::color('bg-color', 'Background Color', 'Choose the background color.', '#ffffff');
	MintOptions::select('bg-repeat', 'Background Repeat', '', 'repeat', array(
		'no-repeat' => 'No Repeat',
		'repeat-x' => 'Repeat X',
		'repeat-y' => 'Repeat Y',
		'repeat' => 'Repeat'

	));
	MintOptions::_switch('bg-streach', 'Stretch Image?', 'Choose yes to stretch the image to fullwidth',false);



	// Colors ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Customization");
	$show_err = true;
	// Let's create a blank generated.css file
	if (!file_exists( get_template_directory() . '/css/generated.css') )
	{
		@file_put_contents( get_template_directory() . '/css/generated.css', '');
		
		if (!is_writable( get_template_directory() . '/css/generated.css'))
		{
			MintOptions::info("ERROR");
			MintOptions::messagebox("error", "Please make sure the file: <br />" . get_template_directory() . "/css/generated.css is writable! Right Click on the file and choose 'File Permissions' with the value 777 and ok");
		}
		else
		{
			unlink( get_template_directory() . '/css/generated.css');
			$show_err = false;
		}
	}

	if (!is_writable( get_template_directory() . '/css/generated.css') && $show_err)
	{
		MintOptions::info("ERROR");
		MintOptions::messagebox("error", "Please make sure the file: <br />" . get_template_directory() . "/css/generated.css is writable! Right Click on the file and choose 'File Permissions' with the value 777 and ok.");
	}
	
	MintOptions::info('Predefined color schemes');
	

	MintOptions::select('colors-predefined-set', 'Predefined colors', 'Select a predefined color scheme set', 'default', array(
		'default'   => 'Default',
		'skyblue'   => 'Sky Blue',
		'seablue'   => 'Sea Blue',
		'dullblue'  => 'Dull Blue',
		'orange'    => 'Orange',
		'purple'    => 'Purple',
		'brightred' => 'Bright Red',
		'maroon'    => 'Maroon',
		'yellow'    => 'Yellow',
		'silver'    => 'Silver'
	));


	MintOptions::info('Settings');
	MintOptions::color('customize-body-bg', 'Body Background', 'Choose the color of your background', '#ffffff'); // @body-bg
	MintOptions::webfont_typography('customize-main-font', 'Body Font', '', array('face' => 'Lato', 'size' => '13px')); // @font-family-base; @font-size-base;
	MintOptions::webfont_typography('customize-headings-font', 'Headings Font', '', array('face' => 'Lato' )); // @font-family-heading;
	MintOptions::webfont_typography('customize-menu-font', 'Menu Font', '', array('face' => 'Lato', 'size' => '14px')); // @font-family-menu; @font-size-menu;
	MintOptions::select('customize-submenu-size', 'Submenu Font Size', '', 12, $font_sizes); // @font-size-submenu;
	
	// Test this in other inner settings
	MintOptions::info('Colors');
	MintOptions::color('customize-c-dcolor-dark', 'Main Color', '', '#7dbd22'); // @dcolor-dark
	MintOptions::color('customize-c-dcolor', 'Main Color Lighter', '', '#7cb927'); // @dcolor
	MintOptions::color('customize-c-dcolor2', 'Main Color 2', '', '#313d53'); // @dcolor2
	MintOptions::color('customize-c-white', 'White Color', '', '#ffffff'); // @white
	MintOptions::color('customize-c-black', 'Color Black', '', '#000000'); // @black
	MintOptions::color('customize-c-tcolor', 'Text Color', '', '#a3a2a2'); // @tcolor
	MintOptions::color('customize-c-hcolor', 'Title Color', '', '#484747'); // @hcolor
	MintOptions::color('customize-c-dcolor2-light', 'Menu Text Color', '', '#677999'); // @dcolor2-light
	MintOptions::color('customize-c-dcolor2-dark', 'Menu Active Color', '', '#273144'); // @dcolor2-dark

	MintOptions::info('Footer');
	MintOptions::color('customize-c-dcolor-lighter', 'Footer Color 1', '', '#cef09d'); // @dcolor-lighter
	MintOptions::color('customize-c-dcolor-light', 'Footer Color 2', '', '#a5d75f'); // @dcolor-light
	MintOptions::color('customize-c-dcolor-darken', 'Footer Color 3', '', '#75b11f'); // @dcolor-darken
	MintOptions::color('customize-c-dcolor-extra-dark', 'Footer Color 4', '', '#8bc637'); // @dcolor-extra-dark
	MintOptions::color('customize-c-dcolor-extra-darken', 'Footer Color 5', '', '#66a013'); // @dcolor-extra-darken

	// footer common
	MintOptions::color('customize-c-dcolor3', 'Footer Common Color 1', '', '#404040'); // @dcolor3
	MintOptions::color('customize-c-dcolor3-dark', 'Footer Common Color 2', '', '#363636'); // @dcolor3-dark
	MintOptions::color('customize-c-dcolor3-darken', 'Footer Common Color 3', '', '#5b5b5b'); // @dcolor2-darken
	MintOptions::color('customize-c-dcolor3-light', 'Footer Common Color 4', '', '#717171'); // @dcolor2-light
	MintOptions::color('customize-c-dcolor3-lighter', 'Footer Common Color 5', '', '#949494'); // @dcolor2-lighter
	MintOptions::color('customize-c-footer-separator', 'Footer Separator', '', '#3a3a3a'); // @footer-separator

	MintOptions::info('Others');
	MintOptions::color('customize-c-separator', 'Separator', '', '#f7f7f7'); // @separator
	MintOptions::color('customize-c-widget-separator', 'Widget Separator', '', '#eeeeee'); // @widget-separator

	MintOptions::info('Sticky Notes');
	MintOptions::color('customize-c-sticky-note-color', 'Sticky Note Text Color', '', '#a3a2a2'); // @sticky-note-color
	MintOptions::color('customize-c-sticky-note-bg', 'Sticky Note Background Color', '', '#f7f7f7'); // @sticky-note-background
	MintOptions::color('customize-c-sticky-attention-color', 'Sticky Attention Text Color', '', '#d5a044'); // @sticky-attention-color
	MintOptions::color('customize-c-sticky-attention-bg', 'Sticky Attention Background Color', '', '#ffefb7'); // @sticky-attention-background
	MintOptions::color('customize-c-sticky-alert-color', 'Sticky Alert Text Color', '', '#d66c6c'); // @sticky-alert-color
	MintOptions::color('customize-c-sticky-alert-bg', 'Sticky Alert Background Color', '', '#ffe4e4'); // @sticky-alert-background
	MintOptions::color('customize-c-sticky-success-color', 'Sticky Success Text Color', '', '#93c326'); // @sticky-success-color
	MintOptions::color('customize-c-sticky-success-bg', 'Sticky Success Background Color', '', '#e3ffba'); // @sticky-success-background

	#MintOptions::info('Extra Colors');




	
/*
@dcolor-lighter : #cef09d;
@dcolor-light : #a5d75f;
@dcolor : #7cb927;
@dcolor-dark : #7dbd22;
@dcolor-darken : #75b11f;
@dcolor-extra-dark : #8bc637;
@dcolor-extra-darken : #66a013;
 */





	// Header Settings
	MintOptions::section("Header Settings");

	MintOptions::info('Header Layout');

	MintOptions::images("header_layout", "Header Layout", "", "v1", array(
		'v1' => get_template_directory_uri() . '/images/headers/header-1.png',
		'v2' => get_template_directory_uri() . '/images/headers/header-2.png',
		'v3' => get_template_directory_uri() . '/images/headers/header-3.png',
		'v4' => get_template_directory_uri() . '/images/headers/header-4.png',
		'v5' => get_template_directory_uri() . '/images/headers/header-5.png',
		'v6' => get_template_directory_uri() . '/images/headers/header-6.png',
		'v7' => get_template_directory_uri() . '/images/headers/header-7.png',

	) );

	MintOptions::info('Header Settings');


	MintOptions::select('top-left-content', 'Top Left Content', '', 'contact', array(
			'blank'        => 'Leave Empty',
			'contact'	   => "Contact info",
			'social-links' => 'Social Links',
			'search'       => 'Search Form',
			'text'         => 'Text',
			'navigation'   => 'Navigation',
			'language'     => 'Languages'
		)
	);

	MintOptions::select('top-right-content', 'Top Right Content', '', 'social-links',  array(
			'blank'        => 'Leave Empty',
			'contact'	   => "Contact info",
			'social-links' => 'Social Links',
			'search'       => 'Search Form',
			'text'         => 'Text',
			'navigation'   => 'Navigation',
			'language'     => 'Languages'
		)
	);


	MintOptions::_switch('header-show-cart', 'Show Cart', 'Enable this to show the cart button. This will show after the top menu. Require Top Menu to be activated. Enable only if you\'re using WooCommerce', false);


	MintOptions::text('header-email', 'E-mail', 'Enter your e-mail here. May be left blank', 'hello@mint.com');
	MintOptions::text('header-phone', 'Phone', 'Enter your phone here. May be left blank', '1 911 222-1111');
	MintOptions::textarea('header-text', 'Text', 'Enter your text here. May be HTML. Use this to put arbitrary HTML', '');

	MintOptions::info('Menu Type');
	
	MintOptions::select('menu-type', 'Main Menu Type', '', 'simple', array(
		'simple' => 'Mint Menu',
		'uber'   => 'Uber Menu'
	));
    MintOptions::upload('header-bg', 'Background Image', '', '');
    MintOptions::select('header-bg-repeat', 'Background Repeat', '', 'no-repeat', array(
		'no-repeat' => 'No Repeat',
		'repeat-x' => 'Repeat X',
		'repeat-y' => 'Repeat Y',
		'repeat' => 'Repeat'

	));
	MintOptions::select('header-bg-streach', 'Background Stretch', '', 'cover', array(
		'cover' => 'Yes',
		'auto'  => 'No'
	));
	MintOptions::_switch('bullets-menu', 'Enable Menu Bullets', '', true);
	MintOptions::_switch('sticky-menu', 'Enable Sticky Menu', '', true);
	MintOptions::_switch('shadow-menu', 'Enable Menu Shadow', '', false);
    MintOptions::_switch('flat-shadow-menu', 'Enable Menu Flat Shadow', '', false);
	MintOptions::_switch('opacity-menu', 'Enable Menu Opacity', '', false);
	MintOptions::text('opacity-procent', 'Opacity Procent', 'Enter procentage of opacity ', '95');

	// Inner Starts ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Header Inner");
	MintOptions::info("Enable Inner Headings");
	MintOptions::_switch('enable-inner-heading', 'Enable inner headings', 'Enable or disable inner headings. You can set custom settings for each page afterwards.', true);

	MintOptions::info("Inner Layout");

	MintOptions::images("inner_layout", "Inner Layout", "", "v1", array(
		'v1' => get_template_directory_uri() . '/images/inner-headers/inner-1.png',
		'v2' => get_template_directory_uri() . '/images/inner-headers/inner-2.png',
		'v3' => get_template_directory_uri() . '/images/inner-headers/inner-3.png',
		'v4' => get_template_directory_uri() . '/images/inner-headers/inner-4.png',
		'v5' => get_template_directory_uri() . '/images/inner-headers/inner-5.png',
		'v6' => get_template_directory_uri() . '/images/inner-headers/inner-6.png',
		'v7' => get_template_directory_uri() . '/images/inner-headers/inner-7.png',
	) );

	MintOptions::info("Inner Settings");


	MintOptions::select('inner-section1', 'Header Inner Section 1', '', 'title', array(
			'blank'        => 'Leave Empty',
			'title'	       => 'Page Title',
			'breadcrumbs'  => 'Breadcrumbs',
			'social-links' => 'Social Links',
			'search'       => 'Search Form',
			'text-1'         => 'Text Box 1',
			'text-2'         => 'Text Box 2',
			'text-3'         => 'Text Box 3'
		)
	);

	MintOptions::select('inner-section2', 'Header Inner Section 2', '', 'blank', array(
			'blank'        => 'Leave Empty',
			'title'	       => 'Page Title',
			'breadcrumbs'  => 'Breadcrumbs',
			'social-links' => 'Social Links',
			'search'       => 'Search Form',
			'text-1'         => 'Text Box 1',
			'text-2'         => 'Text Box 2',
			'text-3'         => 'Text Box 3'
		)
	);

	MintOptions::select('inner-section3', 'Header Inner Section 3', '', 'breadcrumbs', array(
			'blank'        => 'Leave Empty',
			'title'	       => 'Page Title',
			'breadcrumbs'  => 'Breadcrumbs',
			'social-links' => 'Social Links',
			'search'       => 'Search Form',
			'text-1'         => 'Text Box 1',
			'text-2'         => 'Text Box 2',
			'text-3'         => 'Text Box 3'
		)
	);

	MintOptions::text('inner-breadcrumbs-divider', 'Breadcrumbs Divider', '', '/');

	MintOptions::upload('header-inner-bg', 'Background Image', '', '');

	MintOptions::select('header-inner-bg-repeat', 'Background Repeat', '', 'no-repeat', array(
		'no-repeat' => 'No Repeat',
		'repeat-x' => 'Repeat X',
		'repeat-y' => 'Repeat Y',
		'repeat' => 'Repeat'

	));

	MintOptions::select('header-inner-bg-streach', 'Background Stretch', '', 'cover', array(
		'cover' => 'Yes',
		'auto'  => 'No'
	));
	MintOptions::color('header-inner-color', 'Background Color', '', '#f7f7f7');

	MintOptions::upload('header-inner-icon', 'Title Icon', 'If you want to have an icon for your title upload it here. Recommended size: 47x47', '');
	MintOptions::color('header-inner-page-title-color', 'Title Color', 'Select a default color for the page title. Will override your color settings.', '#484747');

	MintOptions::textarea('header-inner-text-1', 'Text Box 1', 'Enter the text you would want to show. Shortcodes are enabled!', '');
	MintOptions::textarea('header-inner-text-2', 'Text Box 2', 'Enter the text you would want to show. Shortcodes are enabled!', '');
	MintOptions::textarea('header-inner-text-3', 'Text Box 3', 'Enter the text you would want to show. Shortcodes are enabled!', '');

	// Typography ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Typography");

	MintOptions::info('Custom Font');
	MintOptions::upload('custom-font-ttf', 'Custom Font *.ttf', 'Upload your custom *.ttf font file. <br /> You can use an online webfont generator such as <a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">Font Squirrel</a>', null);
	MintOptions::upload('custom-font-eot', 'Custom Font *.eot', 'Upload your custom *.eot font file.  <br />You can use an online webfont generator such as <a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">Font Squirrel</a>', null);
	MintOptions::upload('custom-font-woff', 'Custom Font *.woff', 'Upload your custom *.woff font file.  <br />You can use an online webfont generator such as <a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">Font Squirrel</a>', null);
	MintOptions::upload('custom-font-svg', 'Custom Font *.svg', 'Upload your custom *.svg font file. <br />You can use an online webfont generator such as <a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">Font Squirrel</a>', null);
	
	// Blog ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section('Page Settings');
	MintOptions::info('Settings');
	MintOptions::_switch('page-boxed','Boxed Layout', 'Should all pages be in boxed layout?', false);
	MintOptions::_switch('page-fullwidth','Full Width', 'Should all pages be full width?', true);
	MintOptions::select('page-sidebar-position','Default Sidebar Position', 'Select the default sidebar position', 'right', array('right' => 'Right', 'left' => 'Left') );
	MintOptions::select('page-sidebar', 'Sidebar', 'Select which sidebar to show by default on all pages.', '', $sidebars);




	// Blog ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section('Blog Settings');
	MintOptions::info('Blog Settings');
	MintOptions::select('blog-layout', 'Blog Layout', 'Choose your blog layout style', 'classic', array(
		'classic' => 'Classic',
		'pinterest' => 'Pinterest ',
		'grid2'    => '2 Columns Grid ',
		'grid3'    => '3 Columns Grid ',
		'grid4'    => '4 Columns Grid '
	));

	MintOptions::_switch('blog-content-width', 'Fullwidth', '', false);

	MintOptions::select('blog-sidebar-position', 'Sidebar Position', 'Choose your sidebar position', 'right', array(
		'left' => 'Sidebar Left',
		'right' => 'Sidebar Right',
		'no-sidebar' => 'No Sidebar'
	));

	MintOptions::select('blog-pagination-type', 'Pagination', '', 'pagination', array(
		'pagination' => 'Plain Pagination',
		'infinite'   => 'Infinite Scroll'
	));



	MintOptions::info('Post Settings');
	MintOptions::_switch('blog-comments', 'Allow Comments', 'Enable or disable the comment form', true);
	MintOptions::_switch('blog-author-bio', 'Show author bio in posts', 'Enable if you want to show users small bio description', true);
	MintOptions::_switch('blog-show-comments-count', 'Show comments count', 'Enable this to show the comments count text. e.g : 12 comments', true);
	MintOptions::_switch('blog-show-author-icon', 'Show Author Icon', 'Enable this if you would like to show the authors icon', true);
	MintOptions::_switch('blog-show-author', 'Show Author', 'Enable this if you would like to show the author name and url', true);
	MintOptions::_switch('blog-show-date',   'Show Date',   'Enable this if you would like to show the date', true);
	MintOptions::_switch('blog-show-category',   'Show Categories',   'Enable this if you would like to show the categories', true);
	MintOptions::_switch('blog-show-tags',   'Show Tags',   'Enable this if you would like to show post tagged in', true);

	// Portfolio ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Portfolio Settings");
	MintOptions::info('Portfolio Settings');
	MintOptions::select('portfolio-layout', 'Portfolio Layout', 'Choose your portfolio layout style', 'simple', array(
		'simple' => 'Simple',
		'extended' => 'Extended'
	));

	MintOptions::select('portfolio-columns', 'Porfolio Columns', 'Choose the amount of columns per row', 2, array(
		2 => 2,
		3 => 3,
		4 => 4
	));

	// Footer ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section('Footer');

	MintOptions::info('Footer Layout');

	MintOptions::images("footer_layout", "Footer Layout", "", "v1", array(
		'v1' => get_template_directory_uri() . '/images/footers/footer-1.png',
		'v2' => get_template_directory_uri() . '/images/footers/footer-2.png',
		'v3' => get_template_directory_uri() . '/images/footers/footer-3.png',
		'v4' => get_template_directory_uri() . '/images/footers/footer-4.png',
		'v5' => get_template_directory_uri() . '/images/footers/footer-5.png',
		'v6' => get_template_directory_uri() . '/images/footers/footer-6.png',
		'v7' => get_template_directory_uri() . '/images/footers/footer-7.png',

	) );

	MintOptions::info('Footer Settings');

	MintOptions::select('footer-top-content', 'Top Content', '', 'social-links', array(
			'blank'        => 'Leave Empty',
			'social-links' => 'Social Links',
			'search'       => 'Search Form',
			'text'         => 'Text',
			'navigation'   => 'Navigation'
		)
	);

	MintOptions::select('footer-bottom-content', 'Bottom Content', '', 'navigation',  array(
			'blank'        => 'Leave Empty',
			'social-links' => 'Social Links',
			'search'       => 'Search Form',
			'text'         => 'Text',
			'navigation'   => 'Navigation',
		)
	);


	MintOptions::text('footer_label', 'Label', 'Title that will appear in footer header', 'Let\'s Connect:');
	MintOptions::text('footer_copyright', 'Copyright', 'Place here your copyright text', '&copy; 2013 Mint');
	MintOptions::textarea('footer_text', 'Text', 'Enter your text here. May be HTML. Use this to put arbitrary HTML', '');
    MintOptions::upload("footer-img", "Custom Footer Image", "Upload your custom image for footer");
    MintOptions::select('footer-img-pos', 'Footer Image Position', '', 'right', array(
		'left' => 'Left',
		'right' => 'Right'
	));
	MintOptions::text('footer-img-ppos', 'Footer Position dimension', 'Put px or % of padding', '10%');
	MintOptions::info('Others');
	MintOptions::_switch('enable-to-top', 'To Top Button', 'Enable or disable the "To Top" button!' , true);

	// Social Networks ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Social Networks");
	MintOptions::info('Social Networks');
	global $mint_social_networks;

   	foreach( $mint_social_networks as $id => $stitle)
   	{
		MintOptions::text("soc-" . $id, $stitle, 'Enter your '.$stitle.' profile url. <br /> <em> Leave empty and no icon will be shown</em>', '');
   	}

   	MintOptions::text("soc-custom1-url", "Custom Social URL 1", "Enter your custom profile url");
   	MintOptions::upload("soc-custom1-icon", "Custom Social Icon 1", "Upload your custom icon here");
   	MintOptions::text("soc-custom2-url", "Custom Social URL 2", "Enter your custom profile url");
   	MintOptions::upload("soc-custom2-icon", "Custom Social Icon 2", "Upload your custom icon here");
   	MintOptions::text("soc-custom3-url", "Custom Social URL 3", "Enter your custom profile url");
   	MintOptions::upload("soc-custom3-icon", "Custom Social Icon 3", "Upload your custom icon here");
   	MintOptions::text("soc-custom4-url", "Custom Social URL 4", "Enter your custom profile url");
   	MintOptions::upload("soc-custom4-icon", "Custom Social Icon 4", "Upload your custom icon here");
   	MintOptions::text("soc-custom5-url", "Custom Social URL 5", "Enter your custom profile url");
   	MintOptions::upload("soc-custom5-icon", "Custom Social Icon 5", "Upload your custom icon here");


   	// Coming Soon ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Coming Soon");
	MintOptions::info('Coming Soon');
	MintOptions::_switch('enable-coming-soon', 'Enable Coming Soon page?', 'Select this to activate the coming soon page. It will block all other content except the admin area and show the countdown.', false);
	MintOptions::select('coming-soon-type', 'Count', 'Choose wether you want to Count Down from a specific date or Count Up until a specific date', 'count-down', array( 'count-down' => 'Count Down', 'count-up' => 'Count Up'));
	MintOptions::text('coming-soon-date', 'Date', 'Enter the date you wish to count to or from. Enter the date in this format: dd-mm-YYYY hh:mm:ss. eg. '. date('d-m-Y H:i:s'), date('d-m-Y H:i:s') );
	MintOptions::text('coming-soon-format', 'Date format' , 'Select the date format. <br /> Y - years <br />O - months <br />W - weeks <br />D - days<br />H - hours<br />M - minutes<br />S -seconds <br /> <a href="http://keith-wood.name/countdownRef.html#format"> Read more </a> ', 'ODHMS');
	MintOptions::info('Title');
	MintOptions::text('coming-soon-title', 'Heading Title', 'Enter the heading title for this page', 'A Minty Surprize is Coming Your Way!');
	MintOptions::text('coming-soon-subtitle', 'Heading Sub-title', 'Enter the heading sub-title for this page', 'We\'re working hard and our estimated time before launch is:' );
	MintOptions::info('Settings');
	MintOptions::_switch('coming-soon-newsletter', 'Enable newsletter form', 'Select this if you would like to show the newsletter form.', true);
	MintOptions::_switch('coming-soon-socials', 'Enable social icons', 'Select this if you would like to show the social icons', true);


	// Maintenance ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Maintenance");

	MintOptions::info('Maintenance Mode');
	MintOptions::_switch('maintenance-mode', 'Enable Maintenance', 'Select this if you want to enable the maintenance mode', false);
	MintOptions::select('maintenance-page', 'Maintenance Page', 'Select the page to show while your site is in maintenance mode', null, $pages );

	MintOptions::info('Export Settings');
	MintOptions::transfer('test-export', 'Export Settings', 'Copy this text and save it for later (export). Now when you\'re ready to import it back replace this text with the exported one and click "Import Options" which will import your saved settings.', null);
	
	MintOptions::info('Backup <small>your current settings</small>');
	MintOptions::backup('test-backup', 'Backup', 'You can save your current settings. Now when you make changes you can always revert them back.', null);


	// Lightbox ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Lightbox");
	MintOptions::info('Lightbox');
	MintOptions::select('lightbox', 'Select the default lightbox', "Here are a few lightbox libraries you can choose from. We suggest using colorbox", 'colorbox', array(
		'colorbox' => 'Colorbox',
		'prettyPhoto' => 'Pretty Photo',
		'fancybox'    => 'Fancybox',
		'lightbox'    => 'Lightbox'
	));

	MintOptions::info('Configure Colorbox');
	MintOptions::select('colorbox', 'If you chose to use colorbox, select the default template', '', 'template1', array(
		'template1' => 'Template 1',
		'template2' => 'Template 2',
		'template3' => 'Template 3',
		'template4' => 'Template 4',
		'template5' => 'Template 5',
	) );

	MintOptions::info('Configure Pretty Photo');
	MintOptions::select('prettyPhoto', 'If you chose to use prettyPhoto, select the default template', '', 'default', array(
		'dark_rounded' => 'Dark Rounded',
		'dark_square'  => 'Dark Square',
		'default'	   => 'Default',
		'facebook'     => 'Facebook',
		'light_rounded'=> 'Light Rounded',
		'light_square' => 'Light Square'
	) );



	// 404 ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Page 404");
	MintOptions::text('error-title', 'Title', '', 'We looked everywhere.' );
	MintOptions::text('error-subtitle', 'Sub-Title', 'Text below the title', 'Error 404: Page not found');
	MintOptions::textarea("error-description", "Description", "", "We couldn't find the page you were looking for so cool down! and have a mint drink or search again the website.");
	MintOptions::_switch("error-menu", "Error Menu", "Add your error menu in the appearance/menus. Set the location to 404_error", true);
	MintOptions::upload('error-image', 'Error Image', 'Custom 404 Error Image', get_template_directory_uri() . "/images/404.png");

	// WooCommerce ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("WooCommerce");
	MintOptions::info('WooCommerce');
	MintOptions::select('wc_per_row', 'Products per row', '', '3', array(
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5
	));
	MintOptions::_switch('wc-fullwidth', 'Fullwidth', '', false);
	MintOptions::_switch('wc-sidebar', 'Sidebar', '', true);
	MintOptions::select('wc-sidebar-position', 'Sidebar Position', '', 'pull-right', array(
		'pull-left' => 'Left',
		'pull-right' => 'Right'
	));

	MintOptions::info('Social Buttons');
	MintOptions::_switch('woo-show-facebook','Show Facebook Share Button', '', true);
	MintOptions::_switch('woo-show-twitter','Show Twitter Share Button', '', true);
	MintOptions::_switch('woo-show-pinterest','Show Pinterest Share Button', '', true);
	MintOptions::_switch('woo-show-email','Show Email Share Button', '', true);

	// Custom CSS ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Custom CSS");
	MintOptions::info('Custom CSS');
	MintOptions::textarea("custom-css", "Custom CSS", "Feel the need to tweak the template? Well you can add your own custom CSS here.", '');


	MintOptions::info('Custom LESS');
	MintOptions::textarea("custom-less", "Custom LESS", "Familiar with LESS? You can write your own LESS here and Mint will compile it", '');

	MintOptions::info('Custom CSS File');
	MintOptions::_switch("use-custom-css-file", "Use custom CSS file", "Enable this if you want to embed a custom css file.");
	MintOptions::text('custom-css-file', 'Custom CSS File URL', 'Want to keep all your changes in a separate file? Add the url to a CSS file here. It will be included automatically.', get_template_directory_uri() . '/custom.css');

	// Other ------------------------------------------------------------------------------------------------------------------------------------
	MintOptions::section("Other");
	MintOptions::info("Other");
	MintOptions::_switch('disable-right-click', 'Disable Right Click', 'You can disable/enable the right click at any time.', false );
	MintOptions::text('disable-right-click-text', 'Right Click Text', 'Enter the text of the alert box when the right click is trigered!', 'Images are copyrighted.', array('fold' => 'disable-right-click'));
	MintOptions::_switch('loading-page', 'Loading Page', 'You can disable/enable loading page.', true );
	MintOptions::upload('loadinglogo', 'Loading Logo', 'Please upload your logo here', get_template_directory_uri() . '/images/logo2x.png');
?>