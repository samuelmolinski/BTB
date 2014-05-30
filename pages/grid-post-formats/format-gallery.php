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



?>

<article <?php post_class(); ?>>
	<div class="media">
		<div class="media-body">
			<?php if( !empty($gallery_images) ) : ?> 
				<div class="article-thumbnail">
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
			<?php endif; ?>
		</div>
	</div>
</article> 