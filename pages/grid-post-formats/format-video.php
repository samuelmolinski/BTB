<?php
	$fullwidth = MintOptions::get("blog-content-width");
	$has_author_icon 	= MintOptions::get("blog-show-author-icon");
	$has_author 	 	= MintOptions::get("blog-show-author");
	$has_date 		 	= MintOptions::get("blog-show-date");
	$has_categories  	= MintOptions::get("blog-show-category");
	$has_tags 		 	= MintOptions::get("blog-show-tags");
	$has_comments_count = MintOptions::get("blog-show-comments-count");

	$thumb_width = ($fullwidth) ? 940 : 700;

	global $mint_video_embed;

	$video_url = get_post_meta( get_the_ID() , MINT_PX . 'video_url', true );
	$source	   = false;
	$embed     = "";
	$has_video = false;

	
	if (preg_match('/youtube.com/Uis', $video_url))
	{
		$source    = "youtube";
		$id        = MintUtils::parseYoutubeUrl($video_url);
		$embed     = str_replace( "%id%", $id,  $mint_video_embed->youtube );
		$has_video = true;

	} 	
	elseif (preg_match('/vimeo.com/Uis', $video_url)) 	
	{
		$source    = "vimeo";
		$id        = MintUtils::parseVimeoUrl( $video_url );
		$embed     = str_replace( "%id%", $id,  $mint_video_embed->vimeo );
		$has_video = true;
	} 	
	else  	
	{
		
		$mp4 = get_post_meta(get_the_ID() , MINT_PX . 'video_mp4', true);
		$ogg = get_post_meta(get_the_ID() , MINT_PX . 'video_ogg', true);	

		if ($mp4)
		{
			$embed     = do_shortcode('[video mp4="'. $mp4 . '"]');
			$has_video = true;
		}
		else if ($ogg)
		{
			$embed     = do_shortcode('[video ogv="'. $ogg . '"]');
			$has_video = true;
		}

		if ($ogg && $mp4)
		{
			$embed     = do_shortcode('[video mp4="'.$mp4.'" ogv="'.$ogg.'" ]');
			$has_video = true;
		}

		$embed = "<div class='mint-html5-player'>" . $embed . '</div>';
		
	}


	$embed = str_replace("%w%", 680, $embed);
	$embed = str_replace("%h%", 310, $embed);

?>

<article <?php post_class(); ?>>
	<div class="media">
		<div class="media-body">
			<?php if( $has_video ) : ?>
				<div class="article-thumbnail">
					<div class="video-elastic"><?php echo $embed; ?></div>
				</div>
			<?php endif; ?>
			
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