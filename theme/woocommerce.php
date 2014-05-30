<?php 
	
if (!function_exists('mint_set_shop_titles'))
{
	function mint_set_shop_titles()
	{
		if (is_shop())
		{
			if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', __('Shop', 'Mint') );
		}
		else if (is_cart())
		{
			if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', __('Cart', 'Mint'));
		}
		else if (is_checkout())
		{
			if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', __('Checkout', 'Mint') );
		}
		else if (is_product())
		{
			if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', get_the_title() );
		}
		else if (is_product_category())
		{
			$term = get_term_by( 'slug', get_query_var('product_cat') , 'product_cat' ); 
			if ($term)
			{
				if (isset($term->name))
				{
					if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', $term->name);
				}
			}
		}
		else if (is_product_tag())
		{
			$term = get_term_by( 'slug', get_query_var('product_tag') , 'product_tag' ); 
			if ($term)
			{
				if (isset($term->name))
				{
					if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', $term->name);
				}
			}
		}
		else if (is_woocommerce())
		{
			if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', __('Shop', 'Mint') );
		}

		if (is_woocommerce() && !defined('MINT_GLOB_TITLE'))
		{
			if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', __('Shop', 'Mint'));
		}
	}
}

add_action('woocommerce_before_main_content', 'mint_set_shop_titles');


if (!function_exists('mint_woocommerce_before_main_content'))
{
	function mint_woocommerce_before_main_content()
	{
		get_template_part( "header", "inner" );

		?>
			<div id="mint-content" <?php post_class("elastic", mint_get_page_id() ); ?>>
		<?php
	}
}

add_action('woocommerce_before_main_content', 'mint_woocommerce_before_main_content');


if (!function_exists('mint_woocommerce_after_main_content'))
{
	function mint_woocommerce_after_main_content()
	{
		?>
			<div id="mint-content" <?php post_class(); ?>>
		<?php
	}
}

add_action('woocommerce_after_main_content', 'mint_woocommerce_after_main_content');


if (!function_exists('mint_woocommerce_show_page_title'))
{
	function mint_woocommerce_show_page_title()
	{
		return false;
	}
}
add_filter('woocommerce_show_page_title', 'mint_woocommerce_show_page_title');


if (!function_exists('mint_load_custom_header'))
{
	function mint_load_custom_header()
	{
		
	}
}
add_action('mint_before_html_start', 'mint_load_custom_header');	

if (!function_exists('mint_load_custom_footer'))
{
	function mint_load_custom_footer()
	{
		
	}
}
add_action('mint_before_footer_start', 'mint_load_custom_footer');

// register woocommerce sidebar if woocoomerce exist
if(mint_is_wc())
{
	register_sidebar(array(
		'name' => __('Woocommerce Sidebar', 'Mint'),
		'id' => 'mint-woocommerce',
		'description' => 'This is the default woocommerce sidebar',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="sidebar-widget-title">',
		'after_title' => '</h4>'
	));
}

add_filter('loop_shop_columns', 'mint_loop_columns');
if (!function_exists('mint_loop_columns')) {
	function mint_loop_columns() {
		return (int)MintOptions::get("wc_per_row"); // products per row
	}
}

add_action('woocommerce_share', 'mint_single_product_wc_share');
if(!function_exists("mint_single_product_wc_share"))
{
	function mint_single_product_wc_share()
	{	
		$return = "";
		$image = MintUtils::thumb( get_the_ID(), 150, 150);
		

		$facebook = MintOptions::get('woo-show-facebook', true);
		if ($facebook) 
		{
			$return .= "<a target='_blank' href='http://www.facebook.com/sharer.php?u=".get_permalink()."&t=".urlencode(get_the_title())."'><span class='icon-facebook'></span></a>";
		}

		$twitter = MintOptions::get('woo-show-twitter', true);
		if ($twitter)
		{
			$return .= '<a target="_blank" href="http://twitter.com/home?status='.urlencode(get_the_title() . " ") . get_permalink().'"><span class="icon-twitter"></span></a>';
		}

		$pinterest = MintOptions::get('woo-show-pinterest', true);
		if ($pinterest)
		{
			$return .= "<a target='_blank' href='http://pinterest.com/pin/create/button/?url=".urlencode(get_permalink())."&description=".urlencode(get_permalink())."&media=". $image . "'><span class='icon-pinterest'></span></a>";
		}

		$email = MintOptions::get('woo-show-email', true);
		if ($email)
		{
			$return .= "<a href='mailto:?subject=".get_the_title()."&body=".get_permalink()."'> <span class='icon-mail'></span></a>";
		}

		echo $return;
	}
}


if (!function_exists('mint_cart_page_related_products'))
{
	function mint_cart_page_related_products () 
	{
	
	$products = new WP_Query('post_type=product&orderby=rand&posts_per_page=4');
	$found = $products->post_count;

		$i = 1;
		if (!empty($products))
		{


			?>

			<div class="more-related-products">
				<h2><?php _e('You may be interested in', 'Mint'); ?></h2>
			
			
				<div id="mint_wc">
					<div id="mint_wc_4">
						<ul class="products">
							<?php while($products->have_posts()) : $products->the_post(); ?>
								<?php $class = ($i == $found) ? "last" : ""; ?> 
								<li <?php post_class($class); ?>>

									<a href="<?php the_permalink(); ?>"> <?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?> </a>

					<div class="mint-product-caption">
						<h5 class="mint-product-caption-title"><?php the_title(); ?></h5>

						<?php woocommerce_template_loop_price(); // show price template ?>
						<hr>
						<?php woocommerce_template_loop_rating(); // show rating template ?>

					</div>

					<div class="mint-product-caption-under animate">
						<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
						<a class="pull-right" href="<?php the_permalink(); ?>"><i class="icon-right-thin"></i><?php _e("More", "Mint"); ?></a>
						<div class="clearfix"></div>
					</div>
								</li>
							<?php $i++; ?>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			
			</div>
			<?php
		}
	}
}

add_action('woocommerce_after_cart', 'mint_cart_page_related_products');


if (class_exists('WC_Shortcodes'))
{

	$mint_wcs = new WC_Shortcodes();


	// recent_products
	if (!function_exists('mint_sc_recent_products'))
	{
		function mint_sc_recent_products($atts, $content = null)
		{
			global $mint_wcs;
			$cols =  (isset($atts['columns'])) ? $atts['columns'] : 4;
 			return "<div id='mint_wc'><div id='mint_wc_".$cols."'>". $mint_wcs->recent_products( $atts ) ."</div></div>";
		}
	}

	// sale_products 
	if (!function_exists('mint_sc_sale_products'))
	{
		function mint_sc_sale_products($atts, $content = null)
		{
			global $mint_wcs;
			$cols =  (isset($atts['columns'])) ? $atts['columns'] : 4;
			return "<div id='mint_wc'><div id='mint_wc_".$cols."'>". $mint_wcs->sale_products( $atts ) ."</div></div>";
		}
	}

	// best_selling_products 
	if (!function_exists('mint_sc_best_selling_products'))
	{
		function mint_sc_best_selling_products($atts, $content = null)
		{
			global $mint_wcs;
			$cols =  (isset($atts['columns'])) ? $atts['columns'] : 4;
			return "<div id='mint_wc'><div id='mint_wc_".$cols."'>". $mint_wcs->best_selling_products( $atts ) ."</div></div>";
		}
	}

	// top_rated_products
	if (!function_exists('mint_sc_top_rated_products'))
	{
		function mint_sc_top_rated_products($atts, $content = null)
		{
			global $mint_wcs;
			$cols =  (isset($atts['columns'])) ? $atts['columns'] : 4;
			return "<div id='mint_wc'><div id='mint_wc_".$columns."'>". $mint_wcs->top_rated_products( $atts ) ."</div></div>";
		}
	}
	
	// featured_products
	if (!function_exists('mint_sc_featured_products'))
	{
		function mint_sc_featured_products($atts, $content = null)
		{
			global $mint_wcs;
			$cols =  (isset($atts['columns'])) ? $atts['columns'] : 4;
			return "<div id='mint_wc'><div id='mint_wc_".$cols."'>". $mint_wcs->featured_products( $atts ) ."</div></div>";
		}
	}
	// related_products
	if (!function_exists('mint_sc_related_products'))
	{
		function mint_sc_related_products($atts, $content = null)
		{
			global $mint_wcs;
			$cols =  (isset($atts['columns'])) ? $atts['columns'] : 4;
			return "<div id='mint_wc'><div id='mint_wc_".$cols."'>". $mint_wcs->related_products( $atts ) ."</div></div>";
		}
	}
	
	

	if (!function_exists('mint_override_wc_shortcodes'))
	{
		function mint_override_wc_shortcodes()
		{
			add_shortcode('recent_products',       'mint_sc_recent_products');
			add_shortcode('sale_products',         'mint_sc_sale_products');
			add_shortcode('best_selling_products', 'mint_sc_best_selling_products');
			add_shortcode('top_rated_products',    'mint_sc_top_rated_products');
			add_shortcode('featured_products',     'mint_sc_featured_products');
			add_shortcode('related_products',      'mint_sc_related_products');
		}
	}

	// Hook the callbacks after WC is instantiated to replace the shortcodes callbacks
	add_action('init', 'mint_override_wc_shortcodes', 10, 2);
}

// flip product image on hover
add_action( 'woocommerce_before_shop_loop_item_title', 'mint_wc_flip_image', 11 );
if(!function_exists('mint_wc_flip_image'))
{
	function mint_wc_flip_image() {
		global $product, $woocommerce;

		$attachment_ids = $product->get_gallery_attachment_ids();

		if ( $attachment_ids ) {
			$secondary_image_id = $attachment_ids['0'];
			echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'mint-secondary-image' ) );
		}
	}
}