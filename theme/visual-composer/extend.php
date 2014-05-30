<?php 
	if (!function_exists('mint_vc_extend_assets'))
	{
		function mint_vc_extend_assets()
		{
			wp_register_style( 'entypo', get_template_directory_uri() . '/css/entypo.css', null, '2.0.0');
			wp_enqueue_style(  'entypo' ); 
		}
	}

	add_action('admin_enqueue_scripts', 'mint_vc_extend_assets');



		// Custom Shortcodes
		require_once get_template_directory() . "/theme/visual-composer/quote.php";
		require_once get_template_directory() . "/theme/visual-composer/bars.php";
		require_once get_template_directory() . "/theme/visual-composer/icon-box.php";
		require_once get_template_directory() . "/theme/visual-composer/mslider.php";
		require_once get_template_directory() . "/theme/visual-composer/mcarousel.php";
		require_once get_template_directory() . "/theme/visual-composer/space.php";
		require_once get_template_directory() . "/theme/visual-composer/teambox.php";
		require_once get_template_directory() . "/theme/visual-composer/teamboxavo.php";
		require_once get_template_directory() . "/theme/visual-composer/dropcap.php";
		require_once get_template_directory() . "/theme/visual-composer/highlight.php";
		require_once get_template_directory() . "/theme/visual-composer/list.php";
		require_once get_template_directory() . "/theme/visual-composer/social.php";
		require_once get_template_directory() . "/theme/visual-composer/testimonials.php";
		require_once get_template_directory() . "/theme/visual-composer/fullwidth.php";
		require_once get_template_directory() . "/theme/visual-composer/portfolio.php";
		require_once get_template_directory() . "/theme/visual-composer/portfolio-sub.php";
		require_once get_template_directory() . "/theme/visual-composer/counter.php";
		require_once get_template_directory() . "/theme/visual-composer/promobox.php";
		require_once get_template_directory() . "/theme/visual-composer/blog-loop.php";
		require_once get_template_directory() . "/theme/visual-composer/products.php";
		require_once get_template_directory() . "/theme/visual-composer/latest-posts.php";
		require_once get_template_directory() . "/theme/visual-composer/twitter.php";
		require_once get_template_directory() . "/theme/visual-composer/mint-woocommerce.php";
		require_once get_template_directory() . "/theme/visual-composer/sticky-notes.php";
		require_once get_template_directory() . "/theme/visual-composer/nivo-slider.php";
		require_once get_template_directory() . "/theme/visual-composer/flex-slider.php";
		require_once get_template_directory() . "/theme/visual-composer/timeline.php";
		require_once get_template_directory() . "/theme/visual-composer/macbook_slider.php";
		require_once get_template_directory() . "/theme/visual-composer/mbuttons.php";
		require_once get_template_directory() . "/theme/visual-composer/next-prev.php";
		require_once get_template_directory() . "/theme/visual-composer/parallax.php";
		require_once get_template_directory() . "/theme/visual-composer/pagination.php";
		require_once get_template_directory() . "/theme/visual-composer/alert-messages.php";
		require_once get_template_directory() . "/theme/visual-composer/price-table.php";

		// Modified Mappers
		require_once get_template_directory() . "/theme/visual-composer/accordion.php";
		require_once get_template_directory() . "/theme/visual-composer/tabs.php";
		require_once get_template_directory() . "/theme/visual-composer/tour-section.php";
		require_once get_template_directory() . "/theme/visual-composer/button.php";
		require_once get_template_directory() . "/theme/visual-composer/progress-bar.php";
		require_once get_template_directory() . "/theme/visual-composer/google-map.php";
