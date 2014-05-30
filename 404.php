<?php if (!defined('ABSPATH')) die(); ?>
<?php 
	if (!defined("MINT_GLOB_TITLE")) define("MINT_GLOB_TITLE", "404 Page");
	get_header(); 
?>
<?php get_template_part( "header", "inner" ); ?>

<?php
	$error_image = MintOptions::get("error-image", get_template_directory_uri() . "/images/404.png");
?>

<div id="mint-content">
	<div class="elastic">
		<div class="mint-content-section center" id="error-404">
			<h1 class="error-title"><?php echo MintOptions::get("error-title", "404"); ?></h1>
			<h3 class="error-subtitle"><?php echo MintOptions::get("error-subtitle", "Not Found"); ?></h3>
			<p class="error-image"><img src="<?php echo $error_image; ?>" alt="" /></p>
			<p class="error-description"><?php echo MintOptions::get("error-description", "Sorry the page was not found"); ?></p>
			<p class="error-searchform"><?php echo get_search_form(); ?></p>
			<div class="space60">&nbsp;</div>
			<div class="space20">&nbsp;</div>
			<?php if(MintOptions::get("error-menu", false)) : ?>
			<div class="mint-bar fullwidth error-bar">
				<?php 
					if(has_nav_menu("error-nav"))
					{
						wp_nav_menu(array("theme_location" => "error-nav", "menu_class" => "l-inline ib", "container_id" => "error_menu")); 
					}
					else
					{
						wp_nav_menu(array("menu_class" => "l-inline ib", "container_id" => "error_menu")); 
					}
				?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>