<?php
 	
	global $mint_easing;

	$fullwidth = MintOptions::get("blog-content-width");
	$has_author_icon 	= MintOptions::get("blog-show-author-icon");
	$has_author 	 	= MintOptions::get("blog-show-author");
	$has_date 		 	= MintOptions::get("blog-show-date");
	$has_categories  	= MintOptions::get("blog-show-category");
	$has_tags 		 	= MintOptions::get("blog-show-tags");
	$has_comments_count = MintOptions::get("blog-show-comments-count");

	$thumb_width = ($fullwidth) ? 940 : 700;

	$gallery_images         = get_post_meta(get_the_ID(), MINT_PX . 'gallery', false);
	
	$gallery_text_type      = get_post_meta(get_the_ID(), MINT_PX . 'slide_text_type', true);
	$gallery_has_bullets    = get_post_meta(get_the_ID(), MINT_PX . 'gallery_bullets', true);
	$gallery_has_thumbnails = get_post_meta(get_the_ID(), MINT_PX . 'gallery_thumbnails', true);
	$gallery_has_arrows     = get_post_meta(get_the_ID(), MINT_PX . 'gallery_arrows', true);
	$gallery_easing         = get_post_meta(get_the_ID(), MINT_PX . 'gallery_easing', true);
	$gallery_mode           = get_post_meta(get_the_ID(), MINT_PX . 'gallery_mode', true);

	if($gallery_easing)
	{
		$gallery_easing = $mint_easing[$gallery_easing];
	}

	$hide_meta = !defined("BLOG_HIDE_META") ? false : BLOG_HIDE_META;

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
				<div class="article-gallery">
					<?php
						echo do_shortcode( 
								sprintf(
									'[mslider ids="%s" text_type="%s" bullets="%s" thumbnails="%s" arrows="%s" easing="%s" mode="%s" link_to="%s"]', 
									implode($gallery_images, ","),
									$gallery_text_type,
									$gallery_has_bullets,
									$gallery_has_thumbnails,
									$gallery_has_arrows,
									$gallery_easing,
									$gallery_mode,
									get_permalink()
								)
						);
					?>
				</div>
			
				<div class="article-body">
					<h2 class="article-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="article-meta">
					<?php if (!$hide_meta) : ?>
						<?php if($has_author) : ?>
							<span class="article-meta-author"><?php _e("By", "Mint"); ?>: <?php the_author_link(); ?></span>
						<?php endif; ?>
						
						<?php if($has_comments_count) : ?>
							<span class="article-meta-comments-count"><a href="<?php the_permalink(); ?>#comments"><?php echo comments_number(__("No Comments", "Mint"), __("1 Comment", "Mint"), __("% Comments", "Mint")); ?></a></span>
						<?php endif; ?>

						<?php if($has_categories) : ?>
							<span class="article-meta-category"><?php _e("In", "Mint"); ?>: <?php the_category(","); ?></span>
						<?php endif; ?>

						<?php if($has_tags) : ?>
							<span class="article-meta-tags"><?php the_tags(); ?></span>
						<?php endif; ?>
					<?php endif; ?>
					</div>

					<div class="article-excerpt">
						<?php the_excerpt(); ?>
					</div>
					<div class="article-more"><a href="<?php the_permalink(); ?>"><i class="icon-right-thin"></i><?php _e("Read Ahead", "Mint"); ?></a></div>
				</div>
		</div>
	</div>
</article> 