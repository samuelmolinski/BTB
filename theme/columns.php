<?php 
if (!defined('ABSPATH')) die();


if (!function_exists('mint_portfolio_column_head'))
{
	function mint_portfolio_column_head($defaults)
	{
		$defaults['featured_image'] = 'Featured Image';
		return $defaults;
	}	
}


if (!function_exists('mint_portfolio_column_body'))
{
	function mint_portfolio_column_body($column_name, $post_ID)
	{
		if ($column_name == 'featured_image') {  
	        
			$post_thumbnail_id = get_post_thumbnail_id($post_ID);  
			$style = "";

			if ($post_thumbnail_id) {  
			    $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, array(150, 150) );  
			    $post_featured_image = $post_thumbnail_img[0];  
			}  
			else
			{
				$post_featured_image = get_template_directory_uri() . '/images/no-featured-image.jpg';
				$style = "border:1px dashed #cacaca;";
			}

	        
	        echo '<a href="post.php?post='.$post_ID.'&action=edit"><img style="width:80px;height:80px;'.$style.'" src="' . $post_featured_image . '" /></a>';  
	        
	    }  
	}
}

if (isset($_GET['post_type']) && $_GET['post_type'] == "portfolio") // ADD only for portfolio items
{
	add_filter('manage_posts_columns', 'mint_portfolio_column_head');
	add_filter('manage_posts_custom_column', 'mint_portfolio_column_body', 10, 2);  
} 