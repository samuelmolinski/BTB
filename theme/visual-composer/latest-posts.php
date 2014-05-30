<?php

/* Space Shortcode for Visual Composer */
if (!function_exists('mint_vc_latest_posts_sc'))
{
	function mint_vc_latest_posts_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'title'           => "Latest Blog Posts",
			'show'            => 4,
			'per_row'         => "col-4",
			'cat'             => null,
			'style'           => "posts-style-a"
		) , $atts));

		$content = wpb_js_remove_wpautop($content);

		ob_start();
		?>
		
		<div class="latest-posts">
			<h3><?php echo $title; ?></h3>
			<div class="<?php echo $style . " " . $per_row; ?>">
				<?php
					query_posts("posts_per_page=" . $show . "&cat=" . $cat);
					if(have_posts())
					{
						while (have_posts())
						{
							the_post();
							$post_format = (get_post_format()) ? get_post_format() : "standard";
							get_template_part( "pages/classic-post-formats/format", $post_format );
						}
					}
				?>
			</div>
		</div>

		<?php
		$html = ob_get_clean();
		return $html;
	}
}

add_shortcode( 'latest-posts', 'mint_vc_latest_posts_sc' );


$posts_display = array();
$i = 2;

while($i < 21)
{
	$posts_display[] = $i;
	$i++;
}

$categories = get_categories();
$latest_posts_categories = array();
foreach ($categories as $cat) {
	$latest_posts_categories[ $cat->name ] = (int)$cat->term_id;
}

if (function_exists('wpb_map'))
{
	wpb_map(
		array(
			'name'     => 'Mint - Latest Posts',
			'base'     => 'latest-posts',
			'class'    => '',
			'controls' => 'full',
			'icon'     => 'mint-icon-latest-posts',
			'category' => __('Content', 'js_composer'),
			'params'   => array(

				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Title",
					"param_name" => "title",
					"value" => "Latest Blog Posts"
				),

				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Latest Posts',
					'param_name'  => 'per_row',
					'value'       => array(
						"2 Columns" => "col-2",
						"3 Columns" => "col-3",
						"4 Columns" => "col-4"
					),
					'description' => 'Select the columns per row.'
 				),

 				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Show',
					'param_name'  => 'show',
					'value'       => $posts_display,
					'description' => 'Posts to display.'
 				),

 				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Latest Posts Style',
					'param_name'  => 'style',
					'value'       => array(
						"Style A" => "posts-style-a",
						"Style B" => "posts-style-b"
					),
					'description' => 'Select the Latest Post Style.'
 				),

 				array(
 					'type' => 'dropdown',
 					'holder' => 'div',
 					'class' => '',
 					'heading' => 'Category',
 					'param_name' => 'cat',
 					'value' => $latest_posts_categories,
 					'description' => 'Selecte the category from where to show posts'
 				),
 				
			)
		)
	);
}