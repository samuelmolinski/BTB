<?php 
if (!defined('ABSPATH')) die();
require_once(ABSPATH . 'wp-admin/includes/plugin.php');

if(is_plugin_active("js_composer/js_composer.php")){
$visual_dir = get_template_directory_uri() . '/theme/visual-composer/';
vc_set_template_dir($visual_dir);
}

if (file_exists('mint-pre.php'))
{
	require_once 'mint-pre.php';
}

require_once "theme/init.php";

if (file_exists('mint-post.php'))
{
	require_once 'mint-post.php';
}


$protocol = (is_ssl()) ? "https://" : "http://";

if (!function_exists('mint_register_assets'))
{
	function mint_register_assets()
	{	
		// Register Styles
		wp_register_style( 'bootstrap', get_template_directory_uri() .'/css/bootstrap.min.css', null,'3.0.0');
		wp_register_style( 'animate', get_template_directory_uri() .'/css/animate.css', null,'1.0.0');
		wp_register_style( 'entypo', get_template_directory_uri() . '/css/entypo.css', null, '2.0.0');

		if (file_exists(get_template_directory() . '/css/generated.css') && filesize(get_template_directory() . '/css/generated.css') > 0)
		{
			wp_register_style( 'mint-main', get_template_directory_uri() . '/css/generated.css', array('bootstrap', 'entypo'), MINT_VERSION );
		}
		else 
		{
			wp_register_style( 'mint-main', get_template_directory_uri() . '/css/mint.css', array('bootstrap', 'entypo'), MINT_VERSION );
		}
		wp_register_style( 'mint-menu-simple', get_template_directory_uri() . '/css/menus/mint-menu-simple.css', array('bootstrap', 'entypo','mint-main'), MINT_VERSION );
		wp_register_style( 'mint-menu-full', get_template_directory_uri() . '/css/menus/mint-menu-full.css', array('bootstrap', 'entypo','mint-main'), MINT_VERSION );
		wp_register_style( 'mint-menu-uber', get_template_directory_uri() . '/css/menus/mint-menu-uber.css', array('bootstrap', 'entypo','mint-main'), MINT_VERSION );
		wp_register_style( 'mint-responsive', get_template_directory_uri() . '/css/responsive.css', array('mint-main'), MINT_VERSION );

		// Register Scripts
		wp_register_script( 'preloadjs', get_template_directory_uri() . '/js/preload.min.js', array('jquery'), '0.3.1', false);
		wp_register_script( 'bxslider.js', get_template_directory_uri() . '/js/bxslider/jquery.bxslider.min.js', array('jquery'), '4.1.1', true);
		wp_register_script( 'wookmark.js', get_template_directory_uri() . '/js/wookmark/jquery.wookmark.min.js', array('jquery'), '1.4.3', true);
		wp_register_script( 'infinite-scroll', get_template_directory_uri() . '/js/infinite.scroll/jquery.infinite.scroll.min.js', array('jquery'), '2.0b' );
		wp_register_script( 'waypoints.js', get_template_directory_uri() . '/js/waypoints.js', array('jquery'), '2.0.3', true);
		wp_register_script( 'Animo.js', get_template_directory_uri() . '/js/Animo.js', array('jquery'), '1.0.0', true);
		wp_register_script( 'mint.animation.js', get_template_directory_uri() . '/js/mint.animation.js', array('jquery', 'Animo.js'), '1.0.0', true);
		wp_register_script( 'jquery.parallax.js', get_template_directory_uri() . '/js/jquery.parallax.js', array('jquery'), MINT_VERSION, true);

		wp_register_script( 'scripts.js', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'waypoints.js', 'Animo.js', 'jquery.parallax.js'), MINT_VERSION, true);

		wp_register_script( 'retina.js', get_template_directory_uri() . '/js/retina/retina.js', array('jquery'), '1.0', true );
		
		wp_register_style('bbpress-custom', get_template_directory_uri() . '/css/bbpress.css', array('bootstrap'), '1.0' );

		wp_register_script('mint.woocommerce.js', get_template_directory_uri() . '/js/mint.woocommerce.js', array('jquery', 'scripts.js'), MINT_VERSION, true);

		$ssl = (is_ssl()) ? "https:" : "http:";

		wp_register_script('webfont.js', $ssl . "//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js", array('jquery'), '1.4.7', true);

		wp_register_script( 'nivo-js',  get_template_directory_uri() . '/js/nivoSlider/jquery.nivo.slider.pack.js', array('jquery'), '3.2', true);
		wp_register_style ( 'nivo-css', get_template_directory_uri() . '/js/nivoSlider/nivo-slider.css', null, '3.2');

		wp_register_script('flexslider-js',  get_template_directory_uri() . '/js/FlexSlider/jquery.flexslider-min.js', array('jquery'), '2', true);
		wp_register_style ('flexslider-css', get_template_directory_uri() . '/js/FlexSlider/flexslider.css', null, '2' );
	
	}

}

add_action('wp_enqueue_scripts', 'mint_register_assets');


if (!function_exists('mint_enqueue_assets'))
{
	function mint_enqueue_assets()
	{
		// Enqueue style
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'animate' ); 
		wp_enqueue_style( 'entypo' ); 
		wp_enqueue_style( 'mint-main'); 
		wp_enqueue_style( 'mint-theme'); 

		if(MintOptions::get('menu-type') == "uber")
		{
			wp_enqueue_style('mint-menu-uber');
		}
		else
		{
			wp_enqueue_style('mint-menu-simple');
		}

		if(MintOptions::get('responsive'))
		{
			wp_enqueue_style('mint-responsive');
		}
		
		// Enqueue Scripts
		wp_enqueue_script( 'preloadjs' );
		wp_enqueue_script( 'bxslider.js' );
		wp_enqueue_script( 'wp-mediaelement');
		wp_enqueue_script( 'wookmark.js'); // load on everypage [sc exist]
		wp_enqueue_script( 'waypoints.js' );
		wp_enqueue_script( 'Animo.js' );
		wp_enqueue_script( 'mint.animation.js' );
		wp_enqueue_script( 'jquery.parallax.js' );

		if(function_exists("is_plugin_active"))
		{
			if(is_plugin_active("woocommerce/woocommerce.php"))
			{
				wp_enqueue_script('mint.woocommerce.js');
			}
		}

		if (MintOptions::get('blog-pagination-type') == "infinite")
		{
			wp_enqueue_script( 'infinite-scroll' );
		}

		
		if (MintOptions::get('retina-support'))
		{
			wp_enqueue_script( 'retina.js' ); 
		}

		wp_enqueue_script( 'scripts.js' );

		if ( is_singular() ) wp_enqueue_script( "comment-reply" );

		if (function_exists('is_bbpress'))
		{
			if (is_bbpress())
			{
				wp_enqueue_style('bbpress-custom');
			}
		}

		wp_enqueue_script('webfont.js');

	}

}
add_action('wp_enqueue_scripts', 'mint_enqueue_assets');


if (!function_exists('mint_footer_assets'))
{
	function mint_footer_assets()
	{
		global $is_nivo, $is_flexslider;

		if ($is_nivo)
		{
			wp_enqueue_script( 'nivo-js' );
			wp_enqueue_style ( 'nivo-css' );

			echo "<script> jQuery(function() { jQuery('.mint-nivo-slider .nivoSlider').nivoSlider({height:250}); }); </script>";
		}

		if ($is_flexslider)
		{
			wp_enqueue_script('flexslider-js');
			wp_enqueue_style ('flexslider-css');
			echo "<script> 
					jQuery(function() { jQuery('.mint-flex-slider').each(function() {
							var data = jQuery(this).data();
							data.controlNav = data.controlnav;
						jQuery('.flexslider',this).flexslider( jQuery(this).data() );
					});  });
				</script>";
		}

	}
}
add_action('wp_footer', 'mint_footer_assets');

if (!function_exists('mint_enqueue_lightbox'))
{
	function mint_enqueue_lightbox()
	{
		$lightbox = MintOptions::get('lightbox');
		$params = "";

		if ($lightbox == "fancybox")
		{
			wp_register_script( 'lightbox', get_template_directory_uri() . "/js/fancybox/jquery.fancybox-1.3.4.pack.js", array('jquery'), '1.3.4', true);
			wp_register_style('lightbox', get_template_directory_uri() . "/js/fancybox/jquery.fancybox-1.3.4.css", null, "1.3.4");
		}
		else if ($lightbox == "lightbox")
		{
			wp_register_script( 'lightbox', get_template_directory_uri() . "/js/lightbox/js/lightbox-2.6.min.js", array('jquery'), '2.6', true);
			wp_register_style('lightbox', get_template_directory_uri() . "/js/lightbox/css/lightbox.css", null, "2.6");
		}
		else if ($lightbox == "prettyPhoto")
		{
			wp_register_script( 'lightbox', get_template_directory_uri() . "/js/prettyPhoto/jquery.prettyPhoto.js", array('jquery'), '3.1.5', true);
			wp_register_style('lightbox', get_template_directory_uri() . "/js/prettyPhoto/css/prettyPhoto.css", null, "3.1.5");
			$template = MintOptions::get('prettyPhoto');
			$params = "?template=" . $template;
		}
		else
		{

			$template = MintOptions::get('colorbox');
			wp_register_script( 'lightbox', get_template_directory_uri() . "/js/colorbox/jquery.colorbox-min.js", array('jquery'), '1.4.31', true);
			wp_register_style('lightbox', get_template_directory_uri() . "/js/colorbox/" . $template . "/colorbox.css", null, "1.4.31");
		}

		wp_enqueue_script( 'lightbox'); 
		wp_enqueue_style( 'lightbox'); 

		wp_register_script('lightbox-init', get_template_directory_uri() . "/js/".$lightbox."/mint-".$lightbox.".js" . $params, array('jquery'), MINT_VERSION, true);
		wp_enqueue_script('lightbox-init');

	}
}

add_action('wp_enqueue_scripts', 'mint_enqueue_lightbox');


if (!function_exists('mint_admin_register_assets'))
{
	function mint_admin_register_assets()
	{
		wp_register_script('admin-js', get_template_directory_uri() . '/js/admin.js', array('jquery'), MINT_VERSION);
		wp_enqueue_script('admin-js');
	}
}

add_action('admin_enqueue_scripts', 'mint_admin_register_assets');
if (!function_exists('checkAccessed')){ 
function checkAccessed(){
        if ( !isset($_COOKIE['accessed']) ) { 
            setcookie('accessed', 'yes', time() + 3600*24*30); 
            define("ACCESSED", false);
        }else{
            define("ACCESSED", true);
        }
}
}
add_action("init", "checkAccessed");