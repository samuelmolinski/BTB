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
	<?php if(has_post_thumbnail( get_the_ID() )) : ?>
		<div class="article-thumbnail pinterest-grid-postformat-image">
			<a href="<?php echo get_permalink(); ?>"><img src="<?php echo MintUtils::thumb( get_the_ID(), $thumb_width, null); ?>"  <?php mint_get_retina( get_the_ID(), $thumb_width, null ); ?> width="<?php echo $thumb_width; ?>" alt="" /></a>
		</div>
	<?php endif; ?>
</article> 