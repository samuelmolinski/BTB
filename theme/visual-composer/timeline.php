<?php
/* Space Shortcode for Visual Composer */
if (!function_exists('mint_vc_timeline_sc'))
{
	function mint_vc_timeline_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'cat' => 'all',
			'more' => false,
			'show' => 4,
			'type' => 'press',
			'bg_color' => '#ffffff'
		) , $atts));

		global $post;
		$content = wpb_js_remove_wpautop($content);

		$show = (is_int($show)) ? (int)$show : 4;
		$separator_padding_bottom = ($more) ? "50px" : "0";

		$posts = null;
		if($cat == "all")
		{
			$posts = get_posts(array(
				'post_type' => 'timeline',
				'posts_per_page' => (int)$show
			));
		}
		else
		{
			$posts = get_posts(array(
				'post_type' => 'timeline',
				'posts_per_page' => (int)$show,
				'tax_query' => array(
					array(
						'taxonomy' => 'timeline-category',
						'field' => 'id',
						'terms' => (int)$cat
					)
				)
			));
		}

		ob_start();

		if($type == "press")
		{
			?>

			<div class="mint-timeline row">
				<div class="mint-timeline-separator" style="background-color:<?php echo $bg_color; ?>;bottom:<?php echo $separator_padding_bottom; ?>"></div>
				<?php
				if(is_array($posts) && !empty($posts))
				{
					$i = 0;
					foreach ($posts as $post) {
						$arrow_class = ($i % 2 == 0) ? "mint-timeline-arrow-right" : "mint-timeline-arrow-left";
						$arrow_style = ($i % 2 == 0) ? "border-color: transparent transparent transparent " . $bg_color : "border-color: transparent " . $bg_color . " transparent transparent;";
						?>
						<div class="mint-timeline-item col-sm-6  " style="margin-bottom:15px">
							<div class="media" style="background-color:<?php echo $bg_color; ?>">
								<div class="<?php echo $arrow_class; ?>" style="<?php echo $arrow_style; ?>"></div>

								<div class="article-info pull-left">
									<img src='<?php echo MintUtils::thumb(get_the_ID(), 48, 48); ?>' alt='' />
									<p class='article-date'><span class='article-date-month'><?php echo get_the_date("M"); ?></span><span class='article-date-day'><?php echo get_the_date("d"); ?></span></p>
								</div>
								<div class="media-body">
									<h4 class="timeline-title"><a class="h4" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<?php the_excerpt();  ?>
									<div class="article-more"><a href="<?php the_permalink(); ?>"><i class="icon-right-thin"></i><?php _e("Read Ahead", "Mint"); ?></a></div>
								</div>

								<div class="clearfix"></div>
							</div>
						</div>
						<?php
						$i++;
					}
				}

				if($more) // show load more btn
				{
					?>
					<div class="clearfix"></div>
					<div class="space20">&nbsp;</div>
					<div class="center mint-timeline-btn"><a href="#" class="btn ajax-timeline-load" data-mint-type="press" data-mint-cat="<?php echo $cat; ?>" data-mint-show="<?php echo $show; ?>" data-mint-current="1" data-mint-color="<?php echo $bg_color; ?>">Load More</a></div>
					<?php
				}
				?>
			</div>

			<?php
		}
		else if($type == "testimonials")
		{
			?>

			<div class="mint-timeline row">
				<div class="mint-timeline-separator" style="background-color:<?php echo $bg_color; ?>;bottom:<?php echo $separator_padding_bottom; ?>"></div>
				<?php
				if(is_array($posts) && !empty($posts))
				{
					$i = 0;
					foreach ($posts as $post) {
						$arrow_class = ($i % 2 == 0) ? "mint-timeline-arrow-right" : "mint-timeline-arrow-left";
						$arrow_style = ($i % 2 == 0) ? "border-color: transparent transparent transparent " . $bg_color : "border-color: transparent " . $bg_color . " transparent transparent;";
						$rating = (int)rwmb_meta("timeline_rating") * 100 / 5;
						$recommend_text = rwmb_meta("timeline_recommanded");
						?>
						<div class="mint-timeline-item col-sm-6" style="margin-bottom:15px">
							<div class="media" style="background-color:<?php echo $bg_color; ?>">
								<div class="<?php echo $arrow_class; ?>" style="<?php echo $arrow_style; ?>"></div>

								<div class="pull-left">
									<img class="mint-timeline-testimonials-thumb" src='<?php echo MintUtils::thumb(get_the_ID(), 85, 85); ?>' alt='' />
								</div>
								<div class="media-body">
									<h4 class="timeline-title"><?php the_title(); ?><br /><small><?php echo get_the_date("d F, Y"); ?></small></h4>
									<?php the_excerpt();  ?>
									<hr />
									<div class="timeline-media-caption">
										<div class="pull-left">
											<div class="timeline-rating">
												<span style="width:<?php echo $rating; ?>%"></span>
											</div>
										</div>
										<div class="pull-right"><?php echo $recommend_text; ?></div>
									</div>
									<div class="clearfix"></div>
								</div>

								<div class="clearfix"></div>
							</div>
						</div>
						<?php
						$i++;
					}
				}

				if($more) // show load more btn
				{
					?>
					<div class="clearfix"></div>
					<div class="space20">&nbsp;</div>
					<div class="center mint-timeline-btn"><a href="#" class="btn ajax-timeline-load" data-mint-type="testimonials" data-mint-cat="<?php echo $cat; ?>" data-mint-show="<?php echo $show; ?>" data-mint-current="1" data-mint-color="<?php echo $bg_color; ?>">Load More</a></div>
					<?php
				}
				?>
			</div>

			<?php
		}
		else {}
		
		$html = ob_get_clean();
		return $html;
	}
}
add_shortcode( 'timeline', 'mint_vc_timeline_sc' );


function mint_register_vc_timeline_mapper()
{
	if (function_exists('wpb_map'))
	{
		$cats = array('All' => 'all');
		$terms = get_terms('timeline-category');
		if(is_array($terms) && !empty($terms))
		{
			foreach ($terms as $term) {
				$cats[$term->name] = $term->term_id;
			}
		}

		$show = array(4 => 4, 2 => 2,6 => 6,8 => 8,10 => 10,12 => 12);

		wpb_map(
			array(
				'name'     => 'Mint - Timeline',
				'base'     => 'timeline',
				'class'    => '',
				'controls' => 'full',
				'icon'     => 'mint-icon-timeline',
				'category' => __('Content', 'js_composer'),
				'params'   => array(

					array(
	 					'type' => 'dropdown',
	 					'holder' => 'div',
	 					'class' => '',
	 					'heading' => 'Type',
	 					'description' => 'Select your timeline type',
	 					'param_name' => 'type',
	 					'value' => array(
	 						'Press Release' => 'press',
	 						'Testimonials' => 'testimonials'
	 					)
	 				),

					array(
						'type'        => 'dropdown',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Category',
						'param_name'  => 'cat',
						'value'       => $cats,
						'description' => 'Select the category of your timeline.'
	 				),

	 				array(
	 					'type' => 'dropdown',
	 					'holder' => 'div',
	 					'class' => '',
	 					'heading' => 'Show',
	 					'description' => 'Select how many post timeline to show',
	 					'param_name' => 'show',
	 					'value' => $show
	 				),

	 				array(
				      "type" => 'checkbox',
				      "heading" => "Enable Load More?",
				      "param_name" => "more",
				      "value" => array( "Yes" => 'yes')
				    ),

				    array(
				    	'type' => 'colorpicker',
				    	'heading' => 'Background Color',
				    	'param_name' => 'bg_color',
				    	'value' => '#ffffff'
				    )
				    

	 				
				)
			)
		);
	}
}


add_action('init', 'mint_register_vc_timeline_mapper');

// ajax handler for timeline load
if(!function_exists("mint_ajax_timeline_load"))
{
	function mint_ajax_timeline_load()
	{
		global $post;

		$data = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
		$bg_color = $data['color'];

		if($data['action'] == "timeline_load")
		{
			$posts = null;
			if($data['cat'] == "all")
			{
				$posts = get_posts(array(
					'post_type' => 'timeline',
					'posts_per_page' => (int)$data['show'],
					'offset' => (int)$data['offset']
				));
			}
			else
			{
				$posts = get_posts(array(
					'post_type' => 'timeline',
					'posts_per_page' => (int)$data['show'],
					'offset' => (int)$data['offset'],
					'tax_query' => array(
						array(
							'taxonomy' => 'timeline-category',
							'field' => 'id',
							'terms' => (int)$data['cat']
						)
					)
				));
			}

			if(is_array($posts) && !empty($posts))
			{
				if($data['type'] == "press")
				{
					$i = 0;
					foreach ($posts as $post) {
						$arrow_class = ($i % 2 == 0) ? "mint-timeline-arrow-right" : "mint-timeline-arrow-left";
						$arrow_style = ($i % 2 == 0) ? "border-color: transparent transparent transparent " . $bg_color : "border-color: transparent " . $bg_color . " transparent transparent;";
						?>
						<div class="mint-timeline-item col-sm-6" style="margin-bottom:15px">
							<div class="media" style="background-color:<?php echo $bg_color; ?>">
								<div class="<?php echo $arrow_class; ?>" style="<?php echo $arrow_style; ?>"></div>

								<div class="article-info pull-left">
									<img src='<?php echo MintUtils::thumb(get_the_ID(), 48, 48); ?>' alt='' />
									<p class='article-date'><span class='article-date-month'><?php echo get_the_date("M"); ?></span><span class='article-date-day'><?php echo get_the_date("d"); ?></span></p>
								</div>
								<div class="media-body">
									<h4 class="timeline-title"><a class="h4" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<?php the_excerpt();  ?>
									<div class="article-more"><a href="<?php the_permalink(); ?>"><i class="icon-right-thin"></i><?php _e("Read Ahead", "Mint"); ?></a></div>
								</div>

								<div class="clearfix"></div>
							</div>
						</div>
						<?php
						$i++;
					}
				}
				else if($data['type'] == "testimonials")
				{
					$i = 0;
					foreach ($posts as $post) {
						$arrow_class = ($i % 2 == 0) ? "mint-timeline-arrow-right" : "mint-timeline-arrow-left";
						$arrow_style = ($i % 2 == 0) ? "border-color: transparent transparent transparent " . $bg_color : "border-color: transparent " . $bg_color . " transparent transparent;";
						$rating = (int)rwmb_meta("timeline_rating") * 100 / 5;
						$recommend_text = rwmb_meta("timeline_recommanded");
						?>
						<div class="mint-timeline-item col-sm-6" style="margin-bottom:15px">
							<div class="media" style="background-color:<?php echo $bg_color; ?>">
								<div class="<?php echo $arrow_class; ?>" style="<?php echo $arrow_style; ?>"></div>

								<div class="pull-left">
									<img class="mint-timeline-testimonials-thumb" src='<?php echo MintUtils::thumb(get_the_ID(), 85, 85); ?>' alt='' />
								</div>
								<div class="media-body">
									<h4 class="timeline-title"><?php the_title(); ?><br /><small><?php echo get_the_date("d F, Y"); ?></small></h4>
									<?php the_excerpt();  ?>
									<hr />
									<div class="timeline-media-caption">
										<div class="pull-left">
											<div class="timeline-rating">
												<span style="width:<?php echo $rating; ?>%"></span>
											</div>
										</div>
										<div class="pull-right"><?php echo $recommend_text; ?></div>
									</div>
									<div class="clearfix"></div>
								</div>

								<div class="clearfix"></div>
							</div>
						</div>
						<?php
						$i++;
					}
				}
				else {}
			}
			else
			{
				wp_send_json_success(array("msg" => "No more results to load"));
			}
		}
		else
		{
			wp_send_json_error(array("msg" => "An error was occured"));
		}

		die();
	}
}
add_action("wp_ajax_timeline_load", "mint_ajax_timeline_load");
add_action("wp_ajax_nopriv_timeline_load", "mint_ajax_timeline_load");