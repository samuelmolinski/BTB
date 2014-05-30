<?php
/* Blogloop Shortcode for Visual Composer */
if (!function_exists('mint_vc_blogloop_sc'))
{
	function mint_vc_blogloop_sc($atts, $content = null)
	{
		global $mint_video_embed, $mint_easing;

		extract(shortcode_atts( array(
			'posts_per_page' => 10,
			'post_type'      => 'post',
			'hide_empty'     => 0,
			'layout'         => 'classic',
			'grid'           => 3,
			'cat'            => null
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		$query = $atts;
		unset($query['layout']);
		unset($query['grid']);

		// set category
		if($cat)
		{
			$query['cat'] = (int)$cat;
		}


		$blog_layout = @$atts['layout'];
		
		if ( !in_array($blog_layout, array('classic', 'grid', 'pinterest') ) )
		{
			$blog_layout = "classic";
		}


			extract( (array) mint_get_page_settings() );

			$thumb_width = ($fullwidth) ? 940 : 700;


		$inner_class = "";
		$ssa = "";

		if ($blog_layout == "pinterest")
		{
			$inner_class = "blog-pinterest blog-inner-content";
			$ssa = ($fullwidth) ? "" : "max-width:700px;";
		}
		elseif ($blog_layout == "grid")
		{
			$inner_class = "blog-pinterest blog-inner-content";
			$ssa = ($fullwidth) ? "" : "max-width:700px;";

		}


			

			$strings = array(
				'in'         => __('In', 'Mint'),
				'by'         => __('By', 'Mint'),
				'read_ahead' => __('Read Ahead', 'Mint'),
				'posted'     => __("Posted", "Mint"),
				'more'       => __("More", 'Mint')
			);

			$common_data = array(
				'fullwidth'			 => $fullwidth,
				'has_author_icon' 	 => MintOptions::get("blog-show-author-icon"),
				'has_author' 	 	 => MintOptions::get("blog-show-author"),
				'has_date' 		 	 => MintOptions::get("blog-show-date"),
				'has_categories'  	 => MintOptions::get("blog-show-category"),
				'has_tags' 		 	 => MintOptions::get("blog-show-tags"),
				'has_comments_count' => MintOptions::get("blog-show-comments-count"),
			);	

			$common_data['str'] = $strings;

			ob_start();
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$query['paged'] = $paged;

			query_posts($query);


		?>

		<div class="blog-layout-<?php echo $blog_layout; ?> blog-inner-content" >
			<div class="elastic">
				<div class="mint-content-section">

				
						<div style='<?php echo $ssa; ?>' class="mint-content-fullwidth">
							<div class="<?php echo $inner_class; ?>">
							<?php 

								if (!$fullwidth) { 
									echo "<div class='row'>";
									echo '<div class="col-sm-9">';
								}

								if (have_posts())
								{
									while (have_posts())
									{
										the_post();
										$post_format = (get_post_format()) ? get_post_format() : "standard";

										ob_start();
										the_category(",");
										$categories = ob_get_clean();

										ob_start();
										the_tags();
										$tags = ob_get_clean();

										ob_start();
										comments_number(__("No Comments", "Mint"), __("1 Comment", "Mint"), __("% Comments", "Mint"));
										$comments_number = ob_get_clean();

										ob_start();
										the_author_link();
										$author_link = ob_get_clean();


											$mp3 = get_post_meta(get_the_ID() , MINT_PX . 'audio_mp3', true);
											$ogg = get_post_meta(get_the_ID() , MINT_PX . 'audio_ogg', true);	
											$embed = "";

											$has_audio = false;

											if ($mp3)
											{
												$embed     = do_shortcode('[audio mp3="'. $mp3 . '"]');
												$has_audio = true;
											}
											else if ($ogg)
											{
												$embed     = do_shortcode('[audio ogg="'. $ogg . '"]');
												$has_audio = true;
											}

											if ($ogg && $mp3)
											{
												$embed     = do_shortcode('[audio mp3="'.$mp3.'" ogv="'.$ogg.'" ]');
												$has_audio = true;
											}

											$embed = "<div class='mint-html5-player'>" . $embed . '</div>';


											$video_url = get_post_meta( get_the_ID() , MINT_PX . 'video_url', true );
											$source	   = false;
											$has_video = false;

											$embed_video = '';
											if (preg_match('/youtube.com/Uis', $video_url))
											{
												$source    = "youtube";
												$id        = MintUtils::parseYoutubeUrl($video_url);
												$embed_video     = str_replace( "%id%", $id,  $mint_video_embed->youtube );
												$has_video = true;

											} 	
											elseif (preg_match('/vimeo.com/Uis', $video_url)) 	
											{
												$source    = "vimeo";
												$id        = MintUtils::parseVimeoUrl( $video_url );
												$embed_video    = str_replace( "%id%", $id,  $mint_video_embed->vimeo );
												$has_video = true;
											} 	
											else  	
											{
												
												$mp4 = get_post_meta(get_the_ID() , MINT_PX . 'video_mp4', true);
												$ogg = get_post_meta(get_the_ID() , MINT_PX . 'video_ogg', true);	

												if ($mp4)
												{
													$embed_video     = do_shortcode('[video mp4="'. $mp4 . '"]');
													$has_video = true;
												}
												else if ($ogg)
												{
													$embed_video     = do_shortcode('[video ogv="'. $ogg . '"]');
													$has_video = true;
												}

												if ($ogg && $mp4)
												{
													$embed_video     = do_shortcode('[video mp4="'.$mp4.'" ogv="'.$ogg.'" ]');
													$has_video = true;
												}

												$embed_video = "<div class='mint-html5-player'>" . $embed_video . '</div>';
												
											}


											$embed_video = str_replace("%w%", 680, $embed_video);
											$embed_video = str_replace("%h%", 310, $embed_video);



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

											$gallery_slider = do_shortcode( 
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

										$post_data = array(
											'has_post_thumbnail' => has_post_thumbnail( get_the_ID() ),
											'post'               => (array)get_post( get_the_ID() ),
											'permalink'          => get_permalink(),
											'thumb'              => MintUtils::thumb( get_the_ID(), $thumb_width, null),
											'retina'             => mint_get_retina( get_the_ID(), $thumb_width, null, false ),
											'comments_number'    => $comments_number,
											'categories'         => $categories,
											'tags'               => $tags,
											'excerpt'            => get_the_excerpt(),
											'date'               => array( 'month' => get_the_date('M'), 'date' => get_the_date('d') ),
											'the_date'           => get_the_date("F d, Y"),
											'avatar'             => get_avatar( get_the_author_meta('user_email'), 48 ),
											'the_author_link'    => $author_link,
											'has_audio'          => $has_audio,
											'embed'              => $embed,
											'title'              => get_the_title(),
											'quote_author'       => get_post_meta( get_the_ID(), MINT_PX . "quote_author", true ),
											'quote_text'         => get_post_meta( get_the_ID(), MINT_PX . "quote_text", true ),
											'status_text'        => get_post_meta( get_the_ID(), MINT_PX . "status_text", true ),
											'has_video'          => $has_video,
											'embed_video'        => $embed_video,
											'post_class'         => "class='" . implode(" ", get_post_class()) . "'",
											'thumb_width'        => $thumb_width,
											'gallery_slider'     => $gallery_slider, 
											'daylink'            => get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')),
											'has_gallery'        => (!empty($gallery_images))
 										);

										
										$post_data = array_merge_recursive( $post_data, $common_data );
										

										$template_file = get_template_directory() . '/templates/blog/'.$blog_layout.'/format-' . $post_format. ".tpl";


										if (file_exists( $template_file ))
										{
											$parser = new LexParser();
											echo $parser->parse( file_get_contents( $template_file ) , $post_data );
										}


										
									}
								}
							?>

							<?php if (!$fullwidth){ echo "</div>"; echo "</div>"; } ?>
						</div>
					</div>
				
				</div> <!-- end of mint content section -->
				<?php if (MintOptions::get('blog-pagination-type')) { ?>
					<div id="pagination">
						<?php global $wp_query; echo MintUtils::pagination($wp_query); ?>
					</div>
				<?php } else { ?>
						<div id="infinite-scroll">&nbsp;</div>
				<?php } ?>
			</div>
		</div>

		<?php

		$html = ob_get_clean();
		wp_reset_query();
		return $html;
	}
}

add_shortcode( 'blogloop', 'mint_vc_blogloop_sc' );


if (function_exists('wpb_map'))
{
	$blog_categories = get_categories();
	$bcat = array(
		"All" => null
	);

	if(is_array($blog_categories) && !empty($blog_categories))
	{
		foreach ($blog_categories as $cat) {
			$bcat[$cat->name] = $cat->term_id;
		}
	}

	wpb_map(
		array(
			'name'     => 'Mint - Blog Loop',
			'base'     => 'blogloop',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-blogloop',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Loop Layout',
					'param_name'  => 'layout',
					'value'       => array( "Classic" => "classic", "Pinterest" => "pinterest" ),
					'description' => 'Select the layout of the loop.'
 				),

 				

 				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Posts Per Page',
					'param_name'  => 'posts_per_page',
					'value'       => 10,
					'description' => 'How many posts to show on a page?'
 				),

 				array(
 					'type' => 'dropdown',
 					'holder' => 'div',
 					'class' => '',
 					'heading' => 'Category',
 					'param_name' => 'cat',
 					'value' => $bcat
 				)			

 				
			)
		)
	);
}