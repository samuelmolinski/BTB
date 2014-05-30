<?php
/* Tour section
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);

if (class_exists('WPBMap'))
{


  WPBMap::map( 'vc_tour', array(
    "name" => __("Tour Section", "js_composer"),
    "base" => "vc_tour",
    "show_settings_on_create" => false,
    "is_container" => true,
    "container_not_allowed" => true,
    "icon" => "icon-wpb-ui-tab-content-vertical",
    "category" => __('Content', 'js_composer'),
    "wrapper_class" => "clearfix",
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "js_composer"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Auto rotate slides", "js_composer"),
        "param_name" => "interval",
        "value" => array(__("Disable", "js_composer") => 0, 3, 5, 10, 15),
        "description" => __("Auto rotate slides each X seconds.", "js_composer")
      ),
      array(
        "type" => "dropdown",
        "heading" =>"Tour Section Style",
        "param_name" => "el_class",
        "description" => "If you wish to style particular content element differently, then use this field to select the style.",
        "value" => array(
          "Tour Section Style A" => "mint-toursection-a",
          "Tour Section Style B" => "mint-toursection-b",
        )
      )
    ),
    "custom_markup" => '  
    <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
    <ul class="tabs_controls">
    </ul>
    %content%
    </div>'
    ,
    'default_content' => '
    [vc_tab title="'.__('Slide 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
    [vc_tab title="'.__('Slide 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
    ',
    "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
  ) );

}