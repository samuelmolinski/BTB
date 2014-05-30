<?php

if (function_exists('vc_map'))
{
  vc_map( array(
      "name" => __("Progress Bar", "js_composer"),
      "base" => "vc_progress_bar",
      "icon" => "icon-wpb-graph",
      "category" => __('Content', 'js_composer'),
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => __("Widget title", "js_composer"),
          "param_name" => "title",
          "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
        ),
        array(
          "type" => "exploded_textarea",
          "heading" => __("Graphic values", "js_composer"),
          "param_name" => "values",
          "description" => __('Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'js_composer'),
          "value" => "90|Development,80|Design,70|Marketing"
        ),
        array(
          "type" => "textfield",
          "heading" => __("Units", "js_composer"),
          "param_name" => "units",
          "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "js_composer")
        ),
        array(
          "type" => "dropdown",
          "heading" => __("Bar color", "js_composer"),
          "param_name" => "bgcolor",
          "value" => array(__("Grey", "js_composer") => "bar_grey", __("Blue", "js_composer") => "bar_blue", __("Turquoise", "js_composer") => "bar_turquoise", __("Green", "js_composer") => "bar_green", __("Orange", "js_composer") => "bar_orange", __("Red", "js_composer") => "bar_red", __("Black", "js_composer") => "bar_black", __("Custom Color", "js_composer") => "custom"),
          "description" => __("Select bar background color.", "js_composer"),
          "admin_label" => true
        ),
        array(
          "type" => "colorpicker",
          "heading" => __("Bar custom color", "js_composer"),
          "param_name" => "custombgcolor",
          "description" => __("Select custom background color for bars.", "js_composer"),
          "dependency" => Array('element' => "bgcolor", 'value' => array('custom'))
        ),
        array(
          "type" => "checkbox",
          "heading" => __("Options", "js_composer"),
          "param_name" => "options",
          "value" => array(__("Add Stripes?", "js_composer") => "striped", __("Add animation? Will be visible with striped bars.", "js_composer") => "animated")
        ),
        array(
          "type" => "dropdown",
          "heading" => "Style",
          "param_name" => "el_class",
          "value" => array(
            "Square" => "mint-bar-square",
            "Round" => "mint-bar-round"
            ),
          "description" => "Choose the progress bar type"
        )
      )
    ) );

}