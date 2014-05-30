<?php
	$fullwidth = MintOptions::get("blog-content-width");
	$has_author_icon 	= MintOptions::get("blog-show-author-icon");
	$has_author 	 	= MintOptions::get("blog-show-author");
	$has_date 		 	= MintOptions::get("blog-show-date");
	$has_categories  	= MintOptions::get("blog-show-category");
	$has_tags 		 	= MintOptions::get("blog-show-tags");
	$has_comments_count = MintOptions::get("blog-show-comments-count");

	$thumb_width = ($fullwidth) ? 940 : 700;

	$quote_author = get_post_meta( get_the_ID(), MINT_PX . "quote_author", true );
	$quote_text = get_post_meta( get_the_ID(), MINT_PX . "quote_text", true );
?>

<article <?php post_class(); ?>>
	<div class="media">
		<div class="media-body">
			<div class="article-quote">
				<blockquote class="mint-quote-a">
					<div class="mint-quote-text"><?php echo $quote_text; ?></div>
					<?php if($quote_author) : ?>
						<div class="mint-quote-author pull-right">&mdash; <?php echo $quote_author; ?></div>
					<?php endif; ?>
					<div class="clearfix"></div>
				</blockquote>
			</div>
		
			<div class="article-body">
				<h2 class="article-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
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