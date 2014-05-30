<?php
	$fullwidth = MintOptions::get("blog-content-width");
	$has_author_icon 	= MintOptions::get("blog-show-author-icon");
	$has_author 	 	= MintOptions::get("blog-show-author");
	$has_date 		 	= MintOptions::get("blog-show-date");
	$has_categories  	= MintOptions::get("blog-show-category");
	$has_tags 		 	= MintOptions::get("blog-show-tags");
	$has_comments_count = MintOptions::get("blog-show-comments-count");

	$thumb_width = ($fullwidth) ? 940 : 700;

	$gallery_images = get_post_meta(get_the_ID(), MINT_PX . 'gallery', false);

	$gallery_text_type      = get_post_meta(get_the_ID(), MINT_PX . 'slide_text_type', true);
	$gallery_has_bullets    = get_post_meta(get_the_ID(), MINT_PX . 'gallery_bullets', true);
	$gallery_has_thumbnails = get_post_meta(get_the_ID(), MINT_PX . 'gallery_thumbnails', true);
	$gallery_has_arrows     = get_post_meta(get_the_ID(), MINT_PX . 'gallery_arrows', true);
	
?>

<article <?php post_class(); ?>>
	<div class="media">
		<?php if(MintOptions::get("blog-show-date") || MintOptions::get("blog-show-author-icon")) : ?>
			<div class="article-info pull-left">
				<?php 
					if($has_author_icon) {
						echo get_avatar( get_the_author_meta('user_email'), 48 ); 
					}

					if($has_date) {
						echo "<p class='article-date'><span class='article-date-month'>" . get_the_date("M") . "</span><span class='article-date-day'>". get_the_date("d") ."</span></p>";
					}
				?>
			</div>
		<?php endif; ?>

		<div class="media-body">
			<?php if(has_post_thumbnail( get_the_ID() )) { ?>
				<div class="article-thumbnail">
					<a href="<?php echo get_permalink(); ?>"><img src="<?php echo MintUtils::thumb( get_the_ID(), $thumb_width, null); ?>" width="<?php echo $thumb_width; ?>" <?php mint_get_retina( get_the_ID(), $thumb_width, null ); ?> alt="" /></a>
				</div>
			<?php } elseif (!empty($gallery_images) && is_array($gallery_images)) {  ?>
					
			<?php } ?>
		</div>
	</div>
</article> 