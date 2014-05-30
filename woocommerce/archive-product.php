<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('MINT_REWRITE_PAGE_ID', get_option('woocommerce_shop_page_id') );
$wc_fullwidth = MintOptions::get("wc-fullwidth");
$wc_sidebar = MintOptions::get("wc-sidebar");
$wc_sidebar_position = MintOptions::get("wc-sidebar-position", "pull-right");
$content_position = "";

if($wc_sidebar_position == "pull-left")
{
	$content_position = "pull-right";
}

get_header('shop'); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

	<div class="row">

		<?php
			if($wc_fullwidth)
			{
				?>
				<div class="mint-wc-content col-sm-12">
					<?php get_template_part("pages/wc-pages/wc", "archive-product"); ?>
				</div>
				<?php
			}
			else
			{
				?>
				
				<div class="mint-wc-content col-sm-9 <?php echo $content_position; ?>">
					<?php get_template_part("pages/wc-pages/wc", "archive-product"); ?>
				</div>

				<?php
				if($wc_sidebar)
				{
					?>
					<div id="mint_wc_sidebar" class="mint-wc-sidebar col-sm-3">
						<?php
							/**
							 * woocommerce_sidebar hook
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							do_action('woocommerce_sidebar');
						?>
					</div>
					<?php
				}
			}
		?>

	</div> <!-- end of row wrapper -->

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer('shop'); ?>