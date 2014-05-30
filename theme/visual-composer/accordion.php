<?php

if (function_exists('vc_map'))
{
  vc_map( array(
    "name" => __("Accordion", "js_composer"),
    "base" => "vc_accordion",
    "show_settings_on_create" => false,
    "is_container" => true,
    "icon" => "icon-wpb-ui-accordion",
    "category" => __('Content', 'js_composer'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "js_composer"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Active tab", "js_composer"),
        "param_name" => "active_tab",
        "description" => __("Enter tab number to be active on load or enter false to collapse all tabs.", "js_composer")
      ),
      array(
        "type" => 'checkbox',
        "heading" => __("Allow collapsible all", "js_composer"),
        "param_name" => "collapsible",
        "description" => __("Select checkbox to allow for all sections to be be collapsible.", "js_composer"),
        "value" => Array(__("Allow", "js_composer") => 'yes')
      ),
      array(
        "type" => "dropdown",
        "heading" => "Accordion Style",
        "param_name" => "el_class",
        "description" => "If you wish to style particular content element differently, then use this dropdown to selec the style",
        "value" => array(
        	'Accordion Style A' => 'mint-accordion-a',
        	'Accordion Style B' => 'mint-accordion-b',
        	'Accordion Style C' => 'mint-accordion-c',
        	'Accordion Style D' => 'mint-accordion-d',
        )
      )
    ),
    "custom_markup" => '
    <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
    %content%
    </div>
    <div class="tab_controls">
    <button class="add_tab" title="'.__("Add accordion section", "js_composer").'">'.__("Add accordion section", "js_composer").'</button>
    </div>
    ',
    'default_content' => '
    [vc_accordion_tab title="'.__('Section 1', "js_composer").'"][/vc_accordion_tab]
    [vc_accordion_tab title="'.__('Section 2', "js_composer").'"][/vc_accordion_tab]
    ',
    'js_view' => 'VcAccordionView'
  ) );

}