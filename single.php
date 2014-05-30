<?php if (!defined("ABSPATH")) die(); 
	get_header(); ?>
<?php get_template_part( "header", "inner" ); ?>
<?php 

	extract( (array) mint_get_page_settings() );


?>
<div id="mint-content">
	<div class="elastic">
		<div class="mint-content-section">
			<?php
				if(!$fullwidth) // no fullwidth content, with sidebar
				{
					?>
					<div class="row">
						<div class="col-sm-9 <?php echo $content_position; ?>"><?php get_template_part( "pages/single", "content" ); ?></div>
						<div class="col-sm-3 pull-<?php echo $sidebar_position; ?>">
							<div class="mint-aside"><?php if($sidebar_position != "no-sidebar") { dynamic_sidebar("blog-sidebar"); } ?></div>
						</div>
					</div>
					<?php
				}
				else // fullwidth content, no sidebar
				{
					?>
					<div class="mint-content-fullwidth"><?php get_template_part( "pages/single", "content" ); ?></div>
					<?php
				}
			?>
			<?php wp_link_pages('before=<div id="pagination"><div class="pagination center"><ul class="pagination">&after=</ul></div></div>&link_before=<li class="mint-link-pages">&link_after=</li>'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>