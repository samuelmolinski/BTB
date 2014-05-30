<?php

if (function_exists('vc_map'))
{
	 vc_map( array(
	  "name" => __("Google Maps", "js_composer"),
	  "base" => "vc_gmaps",
	  "icon" => "icon-wpb-map-pin",
	  "category" => __('Content', 'js_composer'),
	  "description" => __('Map block', 'js_composer'),
	  "params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Widget title", "js_composer"),
	      "param_name" => "title",
	      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Google map link", "js_composer"),
	      "param_name" => "link",
	      "admin_label" => true,
	      "description" => sprintf(__('Enter your address and click "Get Link" to automatically generate a link <span id="mint-vc-gmap" class="button button-primary">Get Link</span> <br /> or alternatively visit %s find your address and then click "Link" button to obtain your map link.', "js_composer"), '<a href="http://maps.google.com" target="_blank">Google maps</a>')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Map height", "js_composer"),
	      "param_name" => "size",
	      "description" => __('Enter map height in pixels. Example: 200.', "js_composer")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Map type", "js_composer"),
	      "param_name" => "type",
	      "value" => array(__("Map", "js_composer") => "m", __("Satellite", "js_composer") => "k", __("Map + Terrain", "js_composer") => "p"),
	      "description" => __("Select map type.", "js_composer")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Map Zoom", "js_composer"),
	      "param_name" => "zoom",
	      "value" => array(__("14 - Default", "js_composer") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
	    ),
	    array(
	      "type" => 'checkbox',
	      "heading" => __("Remove info bubble", "js_composer"),
	      "param_name" => "bubble",
	      "description" => __("If selected, information bubble will be hidden.", "js_composer"),
	      "value" => Array(__("Yes, please", "js_composer") => true),
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "js_composer"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
	    )
	  )
	) );

}


function mint_enqueue_gmap_sensor()
{
	wp_register_script('gmap-cc', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', null);
	wp_enqueue_script ('gmap-cc');
}
add_action('admin_enqueue_scripts', 'mint_enqueue_gmap_sensor');