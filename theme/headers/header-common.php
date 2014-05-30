<?php

if (!defined('ABSPATH')) die();

// get logo
if(!function_exists("mint_get_logo"))
{
	function mint_get_logo( $args = array() )
	{
		$val = array_merge(array(
			"class" => ""
		), $args);

		$logo   = MintOptions::get('logo', get_template_directory_uri(). "/images/logo.png");
		$logo2x = MintOptions::get('logo2x', get_template_directory_uri(). "/images/logo2x.png");
		
		
		?>
		<a href="<?php echo home_url(); ?>" id="logo" class="pull-left <?php echo $val['class']; ?>"><img src="<?php echo $logo; ?>" alt="" data-retina="<?php echo $logo2x; ?>" /></a>
		<?php
	}
}

// get social
if(!function_exists("mint_get_info"))
{
	function mint_get_info( $args = array() )
	{
		$val = array_merge(array(
			"class" => "",
			"separator" => ""
		), $args);

		?>
		<div class="pull-left mint-info <?php echo $val['class'] ?>">
			<a href="mailto:<?php echo MintOptions::get('header-email'); ?>"><i class="icon-mail main-color <?php echo $val['class'] ?>"></i><?php echo MintOptions::get('header-email'); ?></a> <?php echo $val['separator']; ?>
			<a href="tel:<?php echo MintOptions::get('header-phone'); ?>"><i class="icon-phone mint-icon_phone main-color <?php echo $val['class'] ?>"></i><?php echo MintOptions::get('header-phone'); ?></a>
		</div>
		<?php
	}
}

if(!function_exists("mint_get_social"))
{
	function mint_get_social($class = "")
	{
		global $mint_social_networks;
		$custom_icons = array("custom1", "custom2", "custom3", "custom4", "custom5");
		?>
		<div class="mint-social <?php echo $class; ?>">
			<ul class="l-inline">
				<?php 
					foreach($mint_social_networks as $icon => $val)
					{
						$current_social = MintOptions::get("soc-" . $icon); 
						if(!empty($current_social))
						{
							echo "<li><a href='{$current_social}' target='_blank'><i class='icon-{$icon}'></i></a></li>";
						}
					}

					foreach ($custom_icons as $val) {
						$soc_url = MintOptions::get("soc-" . $val . "-url");
						$soc_img = MintOptions::get("soc-" . $val . "-icon");

						if(!empty($soc_url) && !empty($soc_img))
						{
							echo "<li><a href='{$soc_url}' target='_blank'><img src='{$soc_img}' alt=''/></a></li>";
						}
					}
				?>
			</ul>
		</div>
		<?php
	}
}

if(!function_exists("mint_get_main_menu"))
{
	function mint_get_main_menu( $args = array() )
	{
		$menu_type = MintOptions::get("menu-type", "simple"); // get the menu type
		$show_bullets = MintOptions::get("bullets-menu", true);
		

		$hide_bullets = "";
		if($show_bullets == false)
		{
			$hide_bullets = "mint-menu-hide-bullets";
		}

		$val = array_merge(array(
			"position" => "pull-right",
			"menu_class" => ""
		), $args);

		if($val['position'] == "center")
		{
			$val['position'] = "outer-wrapper";
			echo "<div class='outer-menu center'>";
		}

		if(has_nav_menu("main-menu"))
		{
			wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'container_class' => 'main-menu ' . $val['position'] . ' ' . $hide_bullets,
				'menu_class' => 'l-inline ov ' . $val['menu_class'] . " " . $menu_type
			)); 
		}
		else
		{
			wp_nav_menu(array(
				'container_class' => 'main-menu ' . $val['position'] . ' ' . $hide_bullets,
				'menu_class' => 'l-inline ov ' . $val['menu_class'] . " " . $menu_type
			)); 
		}

		if($val['position'] == "outer-wrapper")
		{
			echo "</div>";
		}
		?>
	
		<div class="clearfix"></div>
		<?php

		if(has_nav_menu("main-menu")) // for mobile menu
		{
			wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'container_class' => 'mobile-menu is-hidden ' . $hide_bullets,
				'menu_class' => 'mobile-menu-ul'
			));
		}
		else
		{
			wp_nav_menu(array(
				'container_class' => 'mobile-menu is-hidden ' . $hide_bullets,
				'menu_class' => 'mobile-menu-ul'
			));
		}
	}
}

if(!function_exists("mint_get_header_top_nav"))
{
	function mint_get_header_top_nav()
	{
		if(has_nav_menu("top-nav"))
		{
			wp_nav_menu( array('theme_location' => 'top-nav', 'menu_class' => 'l-inline top-nav', 'container_class' => 'pull-left') );
		}
		else
		{
			wp_nav_menu( array('menu_class' => 'l-inline top-nav', 'container_class' => 'pull-left') );
		}

		if(MintOptions::get("header-show-cart", false))
		{
			if(function_exists("is_plugin_active"))
			{
				if(is_plugin_active("woocommerce/woocommerce.php"))
				{
					echo mint_add_to_cart() . "<div class='clearfix'></div>";
				}
			}
		}
	}
}


if(!function_exists("mint_get_header_context"))
{
	function mint_get_header_context($context = "left")
	{
		$context = MintOptions::get('top-'. $context . '-content');
		$header_version = MintOptions::get("header_layout");

		switch ($context) {
			case 'social-links':
				mint_get_social();
				break;
			case 'contact':
				if($header_version == "v4" || $header_version == "v5")
				{
					mint_get_info( array("class" => "mint-info-minimal", "separator" => "|" ) );
				}
				else
				{
					mint_get_info();
				}
				break;
			case 'navigation':
				mint_get_header_top_nav();
				break;
			case 'text':
				echo do_shortcode(MintOptions::get('header-text'));
				break;
			case 'search':
				get_search_form();
				break;
			case 'language':
				echo MintUtils::getLanguageSelector();
				break;
			default:
				# code...
				break;
		}
	}
}

if(!function_exists("mint_add_to_cart"))
{
	function mint_add_to_cart()
	{
		global $woocommerce;
		$isCartFull = sizeof( $woocommerce->cart->get_cart() ) > 0 ? 1 : 0;
		$active_cart_class = ($isCartFull) ? "mint-active-cart" : "";
		?>
		<div class="mint-add-to-cart pull-left">
			<a class="<?php echo $active_cart_class; ?>" href="#" id="mint-wc-cart"><i class="icon-basket"></i></a>
			<div class="mint-wc-cart-content is-hidden">
				<div class="mint-wc-cart-items">
					<?php
						if ( $isCartFull )
						{
							foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item )
							{
								$product = $cart_item['data'];

								//var_dump($product);
								// Only display if allowed
								if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $product->exists() || $cart_item['quantity'] == 0 )
									continue;

								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $product->get_price_excluding_tax() : $product->get_price_including_tax();
								$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );

								?>
								<div class="mint-cart-item media">
									<div class="mint_ajax_loader is-hidden"></div>
									<div class="pull-left">
										<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo $product->get_image(); ?></a>
									</div>
									<div class="media-body">
										<h5 class="mint-wc-cart-title"><?php echo $product->get_title(); ?></h5>
										<p class="mint-wc-cart-price"><?php echo sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ); ?></p>
										
										<div class="mint-cart-item-remove">
											<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="" title="%s" data-mint-url="%s"> <span class="icon-cancel"></span></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ), $woocommerce->cart->get_cart_url() ), $cart_item_key ); ?>
										</div>
									</div>
								</div>
								<?php
							}
						}
						else
						{
							echo __("No products in the cart.", "Mint");
						}
					?>	
				</div>
				<div class="mint-wc-cart-caption">
					<a class="pull-left" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="icon-basket"></i> <?php _e("View Cart", "Mint"); ?></a>
					<a class="pull-right" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"><i class="icon-right-thin"></i> <?php _e( 'Checkout', 'Mint' ); ?></a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<?php
	}
}


function mint_ajax_remove_item_from_cart()
{
	global $woocommerce;

	if ( isset($_POST['remove_item']) && $_POST['remove_item'] && $woocommerce->verify_nonce('cart', '_GET')) {
		$woocommerce->cart->set_quantity( $_POST['remove_item'], 0 );
		$woocommerce->add_message( __( 'Cart updated.', 'woocommerce' ) );
		wp_send_json_success();
	}

	wp_send_json_error(array("msg" => "An Error Has Occurred"));
	die();
}
add_action( 'wp_ajax_mint_remove_cart_item', 'mint_ajax_remove_item_from_cart' );
add_action( 'wp_ajax_nopriv_mint_remove_cart_item', 'mint_ajax_remove_item_from_cart' );

