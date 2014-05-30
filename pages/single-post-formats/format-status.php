<?php
	$fullwidth = MintOptions::get("blog-content-width");
	$has_author_icon 	= MintOptions::get("blog-show-author-icon");
	$has_author 	 	= MintOptions::get("blog-show-author");
	$has_date 		 	= MintOptions::get("blog-show-date");
	$has_categories  	= MintOptions::get("blog-show-category");
	$has_tags 		 	= MintOptions::get("blog-show-tags");
	$has_comments_count = MintOptions::get("blog-show-comments-count");

	$thumb_width = ($fullwidth) ? 940 : 700;

	$status_text = get_post_meta( get_the_ID(), MINT_PX . "status_text", true );

	the_post();

	$hide_meta = !defined("BLOG_HIDE_META") ? false : BLOG_HIDE_META;
?>

<div class="article-quote">
	<blockquote class="mint-quote-a">
		<div class="mint-quote-text"><?php echo $status_text; ?></div>
		<div class="clearfix"></div>
	</blockquote>
</div>

<div class="article-body">
	<h2 class="article-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

	<?php if (!$hide_meta) : ?>
	<div class="article-meta">
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
	</div>
	<?php endif; ?>

	<div class="article-content">
		<?php the_content(); ?>
	</div>
</div>