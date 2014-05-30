<?php
	$has_author_icon 	= MintOptions::get("blog-show-author-icon");
	$has_author 	 	= MintOptions::get("blog-show-author");
	$has_date 		 	= MintOptions::get("blog-show-date");
	if (!defined('MINT_SINGLE_HAS_AUTHOR_BIO'))
	{
		$has_author_bio = MintOptions::get('blog-author-bio');
	}
	else
	{
		$has_author_bio = MINT_SINGLE_HAS_AUTHOR_BIO;
	}

	$show_comments = MintOptions::get('blog-comments');

	$post_format = (get_post_format()) ? get_post_format() : "standard";

	$has_tags = (!defined('MINT_SINGLE_HAS_TAGS')) ? true : MINT_SINGLE_HAS_TAGS;
	
	
?>

<article <?php post_class(); ?>>
	<div class="media">
		<?php if($has_date || $has_author_icon) : ?>
			<div class="article-info pull-left">
				<?php 
					if($has_author_icon) {
						$post = get_post( mint_get_page_id() );
						echo get_avatar( get_the_author_meta('user_email', $post->post_author), 48 ); 
					}

					if($has_date) {
						echo "<p class='article-date'><span class='article-date-month'>" . get_the_date("M") . "</span><span class='article-date-day'>". get_the_date("d") ."</span></p>";
					}
				?>
			</div>
		<?php endif; ?>
		<div class="media-body">
			<?php get_template_part( "pages/single-post-formats/format", $post_format ); ?>
			
			<?php if ( $has_tags ) : ?>
				<?php mint_get_single_tags( get_the_ID() ); ?>
			<?php endif; ?>

			<?php 
				if ($has_author_bio) 
				{ 
					get_template_part( 'pages/single-author', 'bio' );
				} 
			?>
			<?php mint_related_posts(); ?>
			<?php if($show_comments) { comments_template(); } ?> 
		</div>
	</div>
</article>