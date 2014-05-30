<?php

if(!function_exists("mint_get_blog_layout"))
{
	function mint_get_blog_layout($blog_layout = null)
	{	
		if (is_null($blog_layout))	$blog_layout = MintOptions::get("blog-layout");

		switch($blog_layout)
		{
			case "classic":
				get_template_part( "pages/blog", "classic" );
				break;
			case "pinterest":
				get_template_part( "pages/blog", "pinterest" );
				break;
			default: // for grid2, grid3, grid4 blog layout
				get_template_part( "pages/blog", "grid" );
				break;
		}
	}
}


// single page function for getting post tags
if(!function_exists("mint_get_single_tags"))
{
	function mint_get_single_tags($id)
	{
		global $post;
		$tags = get_the_tags($id);

		if($tags)
		{
			?>
			<div class="space20">&nbsp;</div>
			<div class='mint-single-tag-group'>
				<span class='mint-single-tag-title hcolor'><?php _e("Tags", "Mint"); ?>:</span>
			<?php 
			foreach ($tags as $tag) {
				?>
				<a class="mint-tag" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
				<?php
			}
			?></div><?php
		}
	}
}

if(!function_exists("mint_related_posts"))
{
	function mint_related_posts()
	{
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
			$first_tag = $tags[0]->term_id;
			$args=array(
				'tag__in' => array($first_tag),
				'post__not_in' => array($post->ID),
				'posts_per_page'=>6,
				'ignore_sticky_posts' => 1,
				'orderby' => 'rand'
			);

			$related_posts = new WP_Query($args);
			if( $related_posts->have_posts() ) {
				echo "<div class='mint-related-posts'>";
					echo "<h3>". __("You Might Also Like This", "Mint") ."</h3>";
				while ($related_posts->have_posts())
				{
					$related_posts->the_post();

					if(has_post_thumbnail( get_the_ID() ))
					{
					?>
						<a class="mint-related-single-item" href="<?php echo get_permalink(); ?>"><img src="<?php echo MintUtils::thumb( get_the_ID(), 100, 90); ?>" width="100" height="90" alt="" /></a>
					<?php
					}
				}
				echo "</div>";
			}
			wp_reset_query();
		}
	}
}



if (!function_exists('mint_is_retina'))
{
	function mint_is_retina( $id )
	{
		$value = MintOptions::get($id . '2x');
		if (!empty($value))
		{
			echo " data-retina='".$value."' ";
		}
	}
}

if (!function_exists('mint_get_retina'))
{
	function mint_get_retina( $post_ID , $w = null, $h = null, $echo = true )
	{

		$src = MintUtils::thumb($post_ID , $w * 2, $h * 2);
		if (!empty($src)) {
			if ($echo) echo " data-retina='".$src."' ";
			return " data-retina='".$src."' ";
		}
	}
}

if(!function_exists("mint_is_wc"))
{
	function mint_is_wc()
	{
		return function_exists( 'is_woocommerce' );
	}
}

if(!function_exists("mint_class"))
{
	function mint_class( $classes = "" )
	{
		return is_array($classes) ? implode(" ", $classes) : $classes;
	}
}

// Add "Theme Options" to the admin bar
if (!function_exists('mint_add_to_admin_bar'))
{
	function mint_add_to_admin_bar () 
	{
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( 
			array(
				'id' => 'smof_options', 
				'title' => "<img src='".get_template_directory_uri()."/images/theme-options-inverted.png' style='float:left;margin-top:6px;padding-right:5px;' />" .  __('Theme Options', 'Mint'), // link title
				'href' => admin_url( 'themes.php?page=optionsframework'), 
				'meta' => array() 
			)
		);
	}	
}

add_action( 'wp_before_admin_bar_render', 'mint_add_to_admin_bar' );


if (!function_exists('mint_get_page_settings'))
{
	function mint_get_page_settings($page = null)
	{
		if (is_null($page)) $page = get_the_ID();

		$fullwidth = get_post_meta(get_the_ID(), MINT_PX . 'width', true);

		if ($fullwidth === false || $fullwidth == "default") {
			$fullwidth = MintOptions::get('page-fullwidth', false);
		}
		else
		{
			if ($fullwidth == "fullwidth") 
			{
				$fullwidth = true;
			}
			else
			{
				$fullwidth = false;
			}
		}

		
		$sidebar_position = get_post_meta(get_the_ID(), MINT_PX . 'sidebar_position', true);
		if (!$sidebar_position || $sidebar_position == "default")
		{
			$sidebar_position = MintOptions::get('page-sidebar-position', "right");
		}

		$sidebar = get_post_meta(get_the_ID(), MINT_PX . 'sidebar', true);
		if (!$sidebar || $sidebar == "default")
		{
			$sidebar = MintOptions::get('page-sidebar', null);
		}

		$content_position = ($sidebar_position == "left") ? "mint-pull-right" : "mint-pull-left";

		$content_space = get_post_meta(get_the_ID(), MINT_PX . 'content_space', true);
	
		
		return (object)array(
			'fullwidth' 	   => $fullwidth,
			'sidebar_position' => $sidebar_position,
			'sidebar' 		   => $sidebar,
			'content_position' => $content_position,
			'content_space'    => $content_space
		);
	}
}

if(!function_exists("mint_is_wc_active"))
{
	function mint_is_wc_active()
	{
		return class_exists('Woocommerce');
	}
}

function mint_fix_wbjs_function()
{
	if (!function_exists('wpb_js_remove_wpautop'))
	{
		function wpb_js_remove_wpautop($content)
		{
			return $content;
		}
	}
}

add_action('wp_head', 'mint_fix_wbjs_function');


// User variables
if (!function_exists('mint_parse_special_vars_theme_options'))
{
	function mint_parse_special_vars_theme_options($option)
	{
		$vars = array(
			'%Y%' => date('Y'),
			'%M%' => date('m'),
			'%D%' => date('d')
		);

		foreach($vars as $s => $v)
		{
			$option = str_replace($s, $v, $option);
		}
		return $option;
	}
}
add_filter('MintOptions_get', 'mint_parse_special_vars_theme_options');



// In your functions.php

/**
 * Add custom field
 *
 * https://gist.github.com/kosinix/5493051/raw/5f1cd2e918924df230f5b61b50599dcb48caa82c/media-gallery-custom.php
*/
function mint_custom_attachment_fields( $fields, $post ) {
    $field_value = get_post_meta( $post->ID, 'custom_url', true );
    $fields['custom_url'] = array(
    	'value' => $field_value ? $field_value : '',
        'label' => 'Custom URL',
        'input' => 'text',
        'show_in_edit' => true,
    );
    return $fields;
}
add_filter( 'attachment_fields_to_edit', 'mint_custom_attachment_fields', 10, 2 );

/**
 * Update custom field on save
*/
function mint_attachment_update_fields($attachment)
{
	if ( isset( $_REQUEST['attachments'][$attachment_id]['custom_url'] ) ) {
		$custom_url = $_REQUEST['attachments'][$attachment_id]['custom_url'];
		update_post_meta( $attachment_id, 'custom_url', $custom_url );
	}
}
add_filter( 'attachment_fields_to_save', 'mint_attachment_update_fields', 4);

/**
 * Update custom field via ajax
*/
function mint_media_ajax_fields() {
    $post_id = (int)$_POST['id'];
    $meta = $_POST['attachments'][$post_id]['custom_url'];
    update_post_meta($post_id , 'custom_url', $meta);
    clean_post_cache($post_id);
}
add_action('wp_ajax_save-attachment-compat', 'mint_media_ajax_fields', 0, 1);