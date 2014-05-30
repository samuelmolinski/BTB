<?php
if (!defined("ABSPATH")) die();
if (!defined("MINT_GLOB_TITLE")) define("MINT_GLOB_TITLE", __("Search", "Mint") ); 
if (!defined("BLOG_HIDE_META")) define("BLOG_HIDE_META", true);


global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

query_posts($search_query);


	get_header(); 

	get_template_part( "header", "inner" );

	$fullwidth = true;
	$blog_layout = "classic";
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
					<div class="col-sm-9 <?php echo $content_position; ?>"><h3><?php _e('Search for:', 'Mint'); ?> <strong><?php echo esc_attr($_GET['s']); ?></strong></h3> <?php mint_get_blog_layout(); ?></div>
					<div class="col-sm-3">
						<div class="mint-aside"><?php if($sidebar_position != "no-sidebar") { dynamic_sidebar("blog-sidebar"); } ?></div>
					</div>
				</div>
				<?php
			}
			else // fullwidth content, no sidebar
			{
				?>
				<div class="mint-content-fullwidth"><h3><?php _e('Search for:', 'Mint'); ?> <strong><?php echo esc_attr($_GET['s']); ?></strong></h3> <?php mint_get_blog_layout($blog_layout); ?></div>
				<?php
			}
		?>
		</div> <!-- end of mint content section -->
		<?php if (MintOptions::get('blog-pagination-type')) { ?>
			<div id="pagination">
				<?php global $wp_query; echo MintUtils::pagination($wp_query); ?>
			</div>
		<?php } else { ?>
				<div id="infinite-scroll">&nbsp;</div>
		<?php } ?>
	</div>
</div>

	<?php get_footer(); ?>
