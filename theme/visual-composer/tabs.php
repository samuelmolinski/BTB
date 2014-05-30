<?php
	$tab_id_1 = time().'-1-'.rand(0, 100);
	$tab_id_2 = time().'-2-'.rand(0, 100);

	if (function_exists('vc_map'))
	{


		vc_map( array(
		  "name"  => __("Tabs", "js_composer"),
		  "base" => "vc_tabs",
		  "show_settings_on_create" => false,
		  "is_container" => true,
		  "icon" => "icon-wpb-ui-tab-content",
		  "category" => __('Content', 'js_composer'),
		  "params" => array(
		    array(
		      "type" => "textfield",
		      "heading" => __("Widget title", "js_composer"),
		      "param_name" => "title",
		      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Auto rotate tabs", "js_composer"),
		      "param_name" => "interval",
		      "value" => array(__("Disable", "js_composer") => 0, 3, 5, 10, 15),
		      "description" => __("Auto rotate tabs each X seconds.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => "Tab Style",
		      "param_name" => "el_class",
		      "description" => "If you wish to style particular content element differently, then use this field to customize the tabs",
		      "value" => array(
		      		"Tab Style A" => 'mint-tab-a',
		      		"Tab Style B" => 'mint-tab-b'
		      )
		    ),


		  ),
		  "custom_markup" => '
		  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
		  <ul class="tabs_controls">
		  </ul>
		  %content%
		  </div>'
		  ,
		  'default_content' => '
		  [vc_tab title="'.__('Tab 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
		  [vc_tab title="'.__('Tab 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
		  ',
		  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
		) );

}
?>