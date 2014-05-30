<?php if (!defined("ABSPATH")) die(); ?><?php 
	if (!defined('ABSPATH')) die();

	define("MINT_PORTFOLIO_PAGE", true);

	if (is_category()) 
	{
			$title = single_cat_title(false, false) . " ". __('Category', 'Mint'); }
	elseif( is_tag() )
	{ 
		$title = __('Posts Tagged','Mint') . " " . single_tag_title(false, false);
	}
	elseif (is_day())
	{
		$title = __('Archive for', 'Mint') . " ".  get_the_time('F jS, Y'); 
	}
	elseif (is_month())
	{
		$title = __('Archive for', 'Mint') . " ".  get_the_time('F, Y'); 
	}
	elseif (is_year())
	{
		$title = __('Archive for', 'Mint') . " ".  get_the_time('Y'); 
	}
	elseif (is_author())
	{
		$title = __('Author Archive', 'Mint');
	}
	else
	{
		$title = __('Portfolio', 'Mint');
	}
	if (!defined("MINT_GLOB_TITLE")) define('MINT_GLOB_TITLE', $title);

	get_header(); 
	get_template_part( "header", "inner" );

	$portfolio_layout = MintOptions::get("portfolio-layout", "simple");
	$per_row = MintOptions::get("portfolio-columns", 2);

	
	if (defined('POLYLANG_VERSION')) // fix polylang categories
	{
		global $polylang;
		$lang = $polylang->curlang->slug;	
		$portfolio_categories = get_terms("portfolio-category", array('lang' => $lang) );
	}
	else
	{
		$portfolio_categories = get_terms("portfolio-category");
	}

?>

<div id="mint-content">
	<div class="elastic">
		<div class="mint-content-section">
			<div id="filters" class="pull-right portfolio-categories">
				<?php
				foreach ($portfolio_categories as $cat) {
					?>
					<a data-filter="<?php echo $cat->slug; ?>" href="#"><?php echo $cat->name; ?></a>
					<?php
				}
				?>
			</div>
			<div class="clearfix"></div>
			<div class="space40">&nbsp;</div>
			<div class="portfolio-layout portfolio-layout-<?php echo $portfolio_layout; ?>" data-mint-columns="<?php echo $per_row; ?>" data-mint-layout="<?php echo $portfolio_layout; ?>">
				<?php
					if($portfolio_layout == "simple")
					{
						get_template_part( "pages/portfolio", "simple" );
					}

					if($portfolio_layout == "extended")
					{
						get_template_part( "pages/portfolio", "extended" );
					}
				?>
			</div>
			
			<div class="clearfix"></div>
			<div class="space50">&nbsp;</div>
			<div id="pagination" class="pull-right">
				<?php global $wp_query; echo MintUtils::pagination($wp_query); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<?php get_footer(); ?>