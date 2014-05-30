<?php if (!defined("ABSPATH")) die(); ?><?php 

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
		$title = __('Blog', 'Mint');
	}
	if (!defined('MINT_GLOB_TITLE')) define('MINT_GLOB_TITLE', $title);
	get_header(); 

	get_template_part( "header", "inner" );

	$fullwidth = MintOptions::get("blog-content-width", false);
	$blog_layout = MintOptions::get("blog-layout");
	$sidebar_position = MintOptions::get("blog-sidebar-position");
	$content_position = ($sidebar_position == "left") ? "mint-pull-right" : "";

	// check if is grid layout always show fullwidth content
	if($blog_layout == "grid2" || $blog_layout == "grid3" || $blog_layout == "grid4")
	{
		$fullwidth = 1;
	}

?>

<div class="blog-layout-<?php echo $blog_layout; ?>" id="mint-content">
	<div class="elastic">
		<div class="mint-content-section">
		<?php
			if(!$fullwidth) // no fullwidth content, with sidebar
			{
				?>
				<div class="row">
					<div class="col-sm-9 <?php echo $content_position; ?>">
						<?php mint_get_blog_layout(); ?>
						<?php if (MintOptions::get('blog-pagination-type')) { ?>
							<div id="pagination">
								<?php global $wp_query; echo MintUtils::pagination($wp_query); ?>
							</div>
						<?php } else { ?>
								<div id="infinite-scroll">&nbsp;</div>
						<?php } ?>
					</div>
					<div class="col-sm-3">
						<div class="mint-aside"><?php if($sidebar_position != "no-sidebar") { dynamic_sidebar("blog-sidebar"); } ?></div>
					</div>
				</div>
				<?php
			}
			else // fullwidth content, no sidebar
			{
				?>
				<div class="mint-content-fullwidth">
					<?php mint_get_blog_layout(); ?>
					<?php if (MintOptions::get('blog-pagination-type')) { ?>
						<div id="pagination">
							<?php global $wp_query; echo MintUtils::pagination($wp_query); ?>
						</div>
					<?php } else { ?>
							<div id="infinite-scroll">&nbsp;</div>
					<?php } ?>
				</div>
				<?php
			}
		?>
		</div> <!-- end of mint content section -->
	</div>
</div>

	<?php get_footer(); ?>
