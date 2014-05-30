<?php

/**
* @param Sidebars array to check
* @return return array of active sidebars
*/
if(!function_exists("mint_get_active_sidebars"))
{
	function mint_get_active_sidebars( $sidebars = array() )
	{
		$active_sidebars = array();
		if(is_array( $sidebars ))
		{
			foreach($sidebars as $sidebar)
			{
				if(is_active_sidebar( $sidebar ))
				{
					$active_sidebars[] = $sidebar;
				}
			}
		}
		return $active_sidebars;
	}
}

if(!function_exists("mint_get_footer_body"))
{
	function mint_get_footer_body()
	{
		$active_sidebars = mint_get_active_sidebars(array( "footer-sidebar", "footer-sidebar-2", "footer-sidebar-3", "footer-sidebar-4"));
		$activated = count($active_sidebars); // active footer sidebars int
		$cols = ($activated > 0) ? "col-sm-" . (12 / $activated) : "";
		$i = 0;
		
		if($activated > 0)
		{
			?>
			<div class="footer-body">
				<div class="elastic">
					<div class="row">
						<?php while($i < $activated) : ?>
						<div class="<?php echo $cols?>">
							<?php dynamic_sidebar( $active_sidebars[$i] ); ?>
						</div>
						<?php $i++; endwhile; ?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

if(!function_exists("mint_get_footer_nav"))
{
	function mint_get_footer_nav($class = "")
	{
		if(has_nav_menu("footer-nav"))
		{
			wp_nav_menu( array('theme_location' => 'footer-nav', 'menu_class' => 'l-inline footer-nav ' . $class) );
		}
	}
}

if(!function_exists("mint_get_footer_context"))
{
	function mint_get_footer_context($context = "top")
	{
		$context = MintOptions::get('footer-'. $context . '-content');
		$footer_version = MintOptions::get("footer_layout");

		switch ($context) {
			case 'social-links':
				mint_get_social();
				break;
			case 'navigation':
				mint_get_footer_nav();
				break;
			case 'text':
				echo MintOptions::get('footer_text');
				break;
			case 'search':
				get_search_form();
				break;
			default:
				# code...
				break;
		}
	}
}



if (!function_exists('mint_load_webfonts'))
{
	function mint_load_webfonts()
	{
		
		global $LOAD_WEB_FONTS, $of_options;

		$LOAD_WEB_FONTS[] = "Lato";

		$options = MintOptions::getSaved();

		foreach($of_options as $option)
		{
			if (is_array($option) && isset($option['type']) && $option['type'] == "webfont_typography")
			{
				
				$s = MintOptions::get($option['id']);
				if (is_array($s) && isset($s['face']))
				{
					$LOAD_WEB_FONTS[] = $s['face'];
				}
			}
		}

		$wf = "[";

		if (is_array($LOAD_WEB_FONTS))
		{
			$LOAD_WEB_FONTS = array_unique($LOAD_WEB_FONTS);
			foreach($LOAD_WEB_FONTS as $w)
			{
				$wf .= '"'.$w.'",';
			}
		}


		$wf = substr($wf, 0, -1) . "]";

		?>
		<script>

		jQuery(function() {
			WebFont.load({
			    google: {
			      families: <?php echo $wf; echo "\n"; ?>
			    }
			  });
		});
			 
		</script>
		<?php
		
	}
}

add_action('wp_footer', 'mint_load_webfonts');


if (!function_exists('mint_render_footer'))
{
	function mint_render_footer()
	{
		if (MintOptions::get('disable-right-click')) {
			echo "<script> jQuery('body').on('contextmenu', function() { alert('".MintOptions::get('disable-right-click-text')."'); return false; });</script>";
		}
	}
}

add_action('wp_footer', 'mint_render_footer');