<?php
	if (!defined('ABSPATH')) die();

	

	if (!function_exists('mint_header'))
	{
		function mint_header()
		{
			
			require_once get_template_directory() . "/theme/libs/lessphp/lessc.inc.php"; // Allows us to compile LESS

				
			$custom_css  = MintOptions::get("custom-css", "");
			$custom_less = MintOptions::get('custom-less', "");

			$boxed = get_post_meta( mint_get_page_id() , MINT_PX . 'boxed_layout', true);

			if ($boxed == "default" || $boxed == false)
			{
				$custom_bg = MintOptions::get('page-boxed'); 
			}
			elseif ($boxed == "boxed")
			{
				$custom_bg = true;
			}
			else
			{
				$custom_bg = false;
			}

			

			try {

				$less = new lessc;
				$compiled_less =  $less->compile($custom_less);
			} catch(Exception $e)
			{
				// bail out
			}

			?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo MintOptions::get('favicon', get_template_directory_uri() . '/images/favicon.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo MintOptions::get('apple-icon', get_template_directory_uri() . '/images/apple-icon.png'); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo MintOptions::get('apple-icon', get_template_directory_uri() . '/images/apple-icon.png'); ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">


			<?php
			if (!empty($custom_css)) {
				echo "<style type='text/css'>" . $custom_css . "</style>";
			}

			if (!empty($compiled_less))
			{
				echo "<style type='text/css'>" . $compiled_less . "</style>";
			}

			if (MintOptions::get("use-custom-css-file"))
			{
				wp_enqueue_style( "custom-css", MintOptions::get("custom-css-file"), null, null, null );
			}

			if($custom_bg)
			{	
				$bg_image   = get_post_meta( mint_get_page_id() , MINT_PX . 'background_image' , true);
				
			
				if (false === $bg_image || $bg_image == "")
				{
					$bg_image   = MintOptions::get("bg-image");
				}
				else
				{
					list($bg_image) = wp_get_attachment_image_src( $bg_image , 'original' );
				}

				$bg_repeat  = get_post_meta( mint_get_page_id() , MINT_PX . 'background_repeat', true);
				if ($bg_repeat == "default" || $bg_repeat == false)
				{
					$bg_repeat  = MintOptions::get("bg-repeat", "no-repeat");
				}

				// YES ! It should be called "stretch" not "streach", jesus! GOOGLEPROOF
				$bg_streach = get_post_meta( mint_get_page_id(), MINT_PX . 'background_stretch', true);
				if ($bg_streach == "default" || $bg_streach == false)
				{
					$bg_streach = MintOptions::get("bg-streach", false); 
				}
				$custom_bg_style = "background:url(".$bg_image.") " . $bg_repeat . ";";

				if($bg_streach && $bg_streach != "no")
				{
					$custom_bg_style .= "-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;";
				}

				$bg_color = get_post_meta( mint_get_page_id(), MINT_PX . 'background_color', true);
				if ($bg_color == "default" || $bg_color == false)
				{
					$bg_color = MintOptions::get('bg-color', '#fff');
				}

				$custom_bg_style .= "background-color: ". $bg_color;

				echo "<style type='text/css'>body { " . $custom_bg_style . " }</style>";
				
			}
					


			// Logo Modifiers
			$offx  = MintOptions::get('logo-offset-x', 0);
			$offy  = MintOptions::get('logo-offset-y', 0);
			$wlogo = MintOptions::get('logo-width', '62px');
			$hlogo = MintOptions::get('logo-height', '38px');
			$css = "#logo img { margin: ".$offy . " " . $offx ."; width: ".$wlogo."; height: ".$hlogo.";  }";


			// Inner Headers
			// 
			// 
			// 
			// Background Image
			$image = get_post_meta( mint_get_page_id(), MINT_PX . 'inner_bg', true );
			if ($image == "default" || $image == false || empty($image))
			{
				$image = MintOptions::get('header-inner-bg', '');
			}
			else
			{
				list($image) = wp_get_attachment_image_src( $image, 'original' );
			}	
			$ihbi = $image;


			// Inner Header Background Repeat
			$ihbr = get_post_meta( mint_get_page_id() , MINT_PX . 'inner_bg_repeat' , true);
			if ($ihbr == "default" || $ihbr == false)
			{
				$ihbr = MintOptions::get('header-inner-bg-repeat', true);
			}

			// Inner Header background stretch
			$ihbs = get_post_meta( mint_get_page_id() , MINT_PX . 'inner_bg_stretch', true);
			if ($ihbs == "default" || $ihbs == false)
			{
				$ihbs = MintOptions::get('header-inner-bg-streach'); // JESUS CHRIST!
			}
			

			// Inner header background color
			$ihbc = get_post_meta( mint_get_page_id(), MINT_PX . 'inner_bg_color', true);
			if ($ihbc == "default" || $ihbc == false)
			{
				$ihbc = MintOptions::get('header-inner-color');
			}

			// Inner Header post title color
			$ihptc = get_post_meta( mint_get_page_id(), MINT_PX . 'page_title_color', true);
			if ($ihptc == "default" || $ihptc == false)
			{
				$ihptc = MintOptions::get('header-inner-page-title-color');
			}


			$styles = "\n.header-inner {background:%s url(%s) %s center center;
							-webkit-background-size:%s;
							-moz-background-size:%s;
							background-size:%s;
						}
						.header-inner.v7 {background: %s;} /* color */
							.upper-inner-section {background:%s url(%s) %s center center;
								-webkit-background-size:%s;
								-moz-background-size:%s;
								background-size:%s;
								padding-top:45px;
							}

						.header-inner h2, .header-inner h3 {color: %s}
						";
	

			$styles = sprintf($styles, $ihbc, $ihbi, $ihbr, $ihbs, $ihbs, $ihbs, $ihbc, $ihbc, $ihbi, $ihbr, $ihbs, $ihbs, $ihbs, $ihptc );

			$css .= $styles;


			if (MintOptions::get('custom-font-ttf'))
            {

            	ob_start();
            ?>

                    @font-face {
                     font-family: 'customfont';
                     src: url('<?php echo MintOptions::get('custom-font-eot'); ?>');
                     src: url('<?php echo MintOptions::get('custom-font-eot'); ?>?#iefix') format('embedded-opentype'),
                     url('<?php echo MintOptions::get('custom-font-woff'); ?>') format('woff'),
                     url('<?php echo MintOptions::get('custom-font-ttf'); ?>') format('truetype'),
                     url('<?php echo MintOptions::get('custom-font-svg'); ?>#customfont') format('svg');
                     font-weight: normal;
                     font-style: normal;

                    }
                                    
            <?php

    			$css .= ob_get_clean();
            }


			echo "<style type='text/css'>" . apply_filters('mint_header_css', $css ) . "</style>";

		}
	}

	add_action('wp_head','mint_header');


	if(!function_exists("mint_header_js"))
	{
		function mint_header_js()
		{
			?>
			<script type="text/javascript">
				window.mint_options = {
					main : {
						responsive : <?php echo (int)MintOptions::get("responsive", 1); ?>,
						hide_sliders : <?php echo (int)MintOptions::get("responsive_hide_sliders", 0); ?>
					},
					header : {
						sticky : <?php echo (int)MintOptions::get("sticky-menu", true); ?>
					},
					ajax_url : '<?php echo get_admin_url() . "admin-ajax.php"; ?>'
				};
			</script>
			<?php
		}
	}
	add_action('wp_head', 'mint_header_js');