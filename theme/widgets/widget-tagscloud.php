<?php

/********************************************* Customize default wp widgets *********************/
function ww_tagcloud_custom($return, $args)
{
	$return = "";
	$tags = get_tags();
	foreach($tags as $tag)
	{
		$return .= '<a href="'. get_tag_link($tag->term_id) .'" class="mint-tag mint-tag-aside">'.$tag->name.' <span>'.$tag->count.'</span></a>';
	}

	return $return;
}
add_filter('wp_tag_cloud','ww_tagcloud_custom', 10, 2);