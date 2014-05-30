<?php
/* Button
---------------------------------------------------------- */
$icons_arr = array(
    __("None", "js_composer") => "none",
    __("Address book icon", "js_composer") => "wpb_address_book",
    __("Alarm clock icon", "js_composer") => "wpb_alarm_clock",
    __("Anchor icon", "js_composer") => "wpb_anchor",
    __("Application Image icon", "js_composer") => "wpb_application_image",
    __("Arrow icon", "js_composer") => "wpb_arrow",
    __("Asterisk icon", "js_composer") => "wpb_asterisk",
    __("Hammer icon", "js_composer") => "wpb_hammer",
    __("Balloon icon", "js_composer") => "wpb_balloon",
    __("Balloon Buzz icon", "js_composer") => "wpb_balloon_buzz",
    __("Balloon Facebook icon", "js_composer") => "wpb_balloon_facebook",
    __("Balloon Twitter icon", "js_composer") => "wpb_balloon_twitter",
    __("Battery icon", "js_composer") => "wpb_battery",
    __("Binocular icon", "js_composer") => "wpb_binocular",
    __("Document Excel icon", "js_composer") => "wpb_document_excel",
    __("Document Image icon", "js_composer") => "wpb_document_image",
    __("Document Music icon", "js_composer") => "wpb_document_music",
    __("Document Office icon", "js_composer") => "wpb_document_office",
    __("Document PDF icon", "js_composer") => "wpb_document_pdf",
    __("Document Powerpoint icon", "js_composer") => "wpb_document_powerpoint",
    __("Document Word icon", "js_composer") => "wpb_document_word",
    __("Bookmark icon", "js_composer") => "wpb_bookmark",
    __("Camcorder icon", "js_composer") => "wpb_camcorder",
    __("Camera icon", "js_composer") => "wpb_camera",
    __("Chart icon", "js_composer") => "wpb_chart",
    __("Chart pie icon", "js_composer") => "wpb_chart_pie",
    __("Clock icon", "js_composer") => "wpb_clock",
    __("Fire icon", "js_composer") => "wpb_fire",
    __("Heart icon", "js_composer") => "wpb_heart",
    __("Mail icon", "js_composer") => "wpb_mail",
    __("Play icon", "js_composer") => "wpb_play",
    __("Shield icon", "js_composer") => "wpb_shield",
    __("Video icon", "js_composer") => "wpb_video"
);

if (function_exists('vc_map'))
{
vc_map( array(
  "name" => __("Button", "js_composer"),
  "base" => "vc_button",
  "icon" => "icon-wpb-ui-button",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Text on the button", "js_composer"),
      "holder" => "button",
      "class" => "wpb_button",
      "param_name" => "title",
      "value" => __("Text on the button", "js_composer"),
      "description" => __("Text on the button.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("URL (Link)", "js_composer"),
      "param_name" => "href",
      "description" => __("Button link.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Target", "js_composer"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
   
    array(
      "type" => "dropdown",
      "heading" => __("Icon", "js_composer"),
      "param_name" => "icon",
      "value" => $icons_arr,
      "description" => __("Button icon.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Size", "js_composer"),
      "param_name" => "size",
      "value" => $size_arr,
      "description" => __("Button size.", "js_composer")
    ),
    array(
      "type" => "colorpicker",
      "heading" => "Background Color",
      "param_name" => "el_class",
      "description" =>  "Please choose the color for this button",
    )
  ),
  "js_view" => 'VcButtonView'
) );
}

if (!function_exists('mint_sc_button_vc_fix_custom_color'))
{
	function mint_sc_button_vc_fix_custom_color($args)
	{
		$str = $args;
		if ( preg_match('/\#\w{1,6}+/Uis', $str, $matches) )
		{
			$color = $matches[0];
			$str = str_replace($color, "", $str);
			$str = $str . " \" style=\"background-color:{$color}";
			
		}
		return $str;
	}
}
add_filter(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'mint_sc_button_vc_fix_custom_color');