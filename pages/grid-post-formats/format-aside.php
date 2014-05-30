<?php
	$fullwidth = MintOptions::get("blog-content-width");
	$has_author_icon 	= MintOptions::get("blog-show-author-icon");
	$has_author 	 	= MintOptions::get("blog-show-author");
	$has_date 		 	= MintOptions::get("blog-show-date");
	$has_categories  	= MintOptions::get("blog-show-category");
	$has_tags 		 	= MintOptions::get("blog-show-tags");
	$has_comments_count = MintOptions::get("blog-show-comments-count");

	$thumb_width = ($fullwidth) ? 940 : 700;

?>

<article <?php post_class(); ?>>
	<div class="media">
		<div class="media-body">
			<?php if(has_post_thumbnail( get_the_ID() )) : ?>
				<div class="article-thumbnail">
					<a href="<?php echo get_permalink(); ?>"><img src="<?php echo MintUtils::thumb( get_the_ID(), $thumb_width, null); ?>" <?php mint_get_retina( get_the_ID(), $thumb_width, null ); ?> width="<?php echo $thumb_width; ?>" alt="" /></a>
				</div>
			<?php endif; ?>
			
				<div class="article-body">
					<div class="article-meta">
						<?php if($has_date) : ?>
							<span class="article-meta-date"><?php _e("Posted", "Mint"); ?>: <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php echo get_the_date("F d, Y"); ?></a></span>
						<?php endif; ?>

						<?php if($has_comments_count) : ?>
							<span class="article-meta-comments-count"><a href="<?php the_permalink(); ?>#comments"><?php echo comments_number(__("No Comments", "Mint"), __("1 Comment", "Mint"), __("% Comments", "Mint")); ?></a></span>
						<?php endif; ?>
						
					</div>

					<div class="article-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
		</div>
	</div>
</article> 