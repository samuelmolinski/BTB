(function() {
	tinymce.create('tinymce.plugins.MintShortCodes', 
	{
		init : function(d, e) {},
		createControl : function(d, e)
		{
			var ed = tinymce.activeEditor;
			if (d == "MintShortCodes")
			{
				
				d=e.createMenuButton( "MintShortCodes",{
							title: ed.getLang('woocommerce.insert'),
							icons: false,
							image: "http://localhost/Mint/wp-content/themes/mint/theme/tinymce/tinymce.png"
							});

							var a=this;d.onRenderMenu.add(function(c,b){

								c = b.addMenu({title:'Columns'});
										

								a.addImmediate(c, "1/1" ,"[mc_row][mc_column] Your content goes here [/mc_column] [/mc_row]" );
								a.addImmediate(c, "1/2 + 1/2" ,"[mc_row][mc_column width=\"1/2\"] Content here [/mc_column][mc_column width=\"1/2\"] Content here [/mc_column][/mc_row]" );
								a.addImmediate(c, "2/3 + 1/3" ,"[mc_row][mc_column width=\"2/3\"] Content here [/mc_column][mc_column width=\"1/3\"] Content here [/mc_column][/mc_row]" );
								a.addImmediate(c, "1/3 + 1/3 + 1/3" ,'[mc_row][mc_column width="1/3"] Content here [/mc_column][mc_column width="1/3"] Content here [/mc_column][mc_column width="1/3"] Content here [/mc_column][/mc_row]' );
								a.addImmediate(c, "1/4 + 1/4 + 1/4 + 1/4" ,'[mc_row][mc_column width="1/4"] Content here[/mc_column][mc_column width="1/4"] Content here [/mc_column][mc_column width="1/4"] Content here[/mc_column][mc_column width="1/4"] Content here [/mc_column][/mc_row]' );
								a.addImmediate(c, "1/4 + 3/4" ,'[mc_row][mc_column width="1/4"] Content here[/mc_column][mc_column width="3/4"] Content here [/mc_column][/mc_row]');
								a.addImmediate(c, "1/4 + 1/2 + 1/4" ,'[mc_row][mc_column width="1/4"][/mc_column][mc_column width="1/2"][/mc_column][mc_column width="1/4"][/mc_column][/mc_row]');
								a.addImmediate(c, "5/6 + 1/6" ,'[mc_row][mc_column width="5/6"] Content here [/mc_column][mc_column width="1/6"] Content here [/mc_column][/mc_row]');
								a.addImmediate(c, "1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6" ,'[mc_row][mc_column width="1/6"] Content here [/mc_column][mc_column width="1/6"] Content here [/mc_column][mc_column width="1/6"] Content here [/mc_column][mc_column width="1/6"] Content here [/mc_column][mc_column width="1/6"] Content here [/mc_column][mc_column width="1/6"] Content here[/mc_column][/mc_row]');
							 	a.addImmediate(c, "1/6 + 2/3 + 1/6" ,'[mc_row][mc_column width="1/6"] Content here [/mc_column][mc_column width="2/3"] Content here [/mc_column][mc_column width="1/6"] Content here [/mc_column][/mc_row]');
							 	a.addImmediate(c, "1/6 + 1/6 + 1/6 + 1/2" ,'[mc_row][mc_column width="1/6"] Content here [/mc_column][mc_column width="1/6"] Content here [/mc_column][mc_column width="1/6"] Content here[/mc_column][mc_column width="1/2"] Content here [/mc_column][/mc_row]');


							//	a.addImmediate(b, "Row 1/2 - Visual Composer" ,"[vc_row][vc_column width="1/2"] Content here [/vc_column][vc_column width="1/2"] Content here [/vc_column][/vc_row]" );
								b.addSeparator();
								c = b.addMenu({title:'Separator'});

								a.addImmediate(c, "Separator", "[mc_separartor]");
								a.addImmediate(c, "Separator with text on center", '[mc_text_separator title="Your title" title_align="separator_align_center"]' );
								a.addImmediate(c, "Separator with text on left", '[mc_text_separator title="Your title" title_align="separator_align_left"]' );
								a.addImmediate(c, "Separator with text on right", '[mc_text_separator title="Your title" title_align="separator_align_right"]' );

								c = b.addMenu({title: "Message Box"});
								a.addImmediate(c, "Informational Message Box", '[mc_messagebox color="alert-info"] Your content [/mc_messagebox]' );
								a.addImmediate(c, "Error Message Box", '[mc_messagebox color="alert-error"] Your content [/mc_messagebox]' );
								a.addImmediate(c, "Warning Message Box", '[mc_messagebox color="alert-warning"] Your content [/mc_messagebox]' );
								a.addImmediate(c, "Success Message Box", '[mc_messagebox color="alert-success"] Your content [/mc_messagebox]' );

						

								
								a.addImmediate(b, "Toggle", '[mc_toggle title="Your title" open="false"] Your toggle content here [/mc_toggle]');
								a.addImmediate(b, "Tabs", '[mc_tabs el_class="mint-tab-a"][mc_tab title="Tab title 1" tab_id="'+Math.random() +'-1-31"] Your tab content [/mc_tab][mc_tab title="Tab title 2" tab_id="'+Math.random()+'-2-83"][/mc_tab][/mc_tabs]');
								a.addImmediate(b, "Tour Section", '[mc_tour el_class="mint-toursection-a"][mc_tab title="Slide title 1" tab_id="'+Math.random()+'-1-8"]Your content[/mc_tab][mc_tab title="Slide title 2" tab_id="'+Math.random()+'-2-35"] Your content [/mc_tab][/mc_tour]');
								a.addImmediate(b, "Accordion", '[mc_accordion el_class="mint-accordion-a"][mc_accordion_tab title="Section title 1"] Your content [/mc_accordion_tab][mc_accordion_tab title="Section 2"] Your content [/mc_accordion_tab][/mc_accordion]');
								a.addImmediate(b, "Button", '[mc_button title="Text on the button" target="_self" color="wpb_button" icon="none" size="wpb_regularsize" href="#"]');
								a.addImmediate(b, "Video", '[mc_video title="Video title" link="#"]');
								a.addImmediate(b, "Google Maps", '[mc_gmaps type="m" zoom="14" title="Your title" link="#link-to-google-map" size="200"]');
								a.addImmediate(b, "Progres Bar", '[vc_progress_bar title="Your title" values="90|Development,80|Design,70|Marketing" bgcolor="bar_grey"]');
								a.addImmediate(b, "Pie Chart", '[vc_pie value="50" label_value="Your label" color="wpb_button" title="The title" units="%"]');

								b.addSeparator();

								c = b.addMenu({title: "Facebook Like"});
								a.addImmediate(c, "Standard", "[mc_facebook type='standard']");
								a.addImmediate(c, "Button Count", "[mc_facebook type='button_count']");
								a.addImmediate(c, "Box Count", "[mc_facebook type='box_count']");

								c = b.addMenu({title: "Tweetmeme"});
								a.addImmediate(c, "Standard", "[mc_tweetmeme type='horizontal']");
								a.addImmediate(c, "Button Count", "[mc_tweetmeme type='vertical']");
								a.addImmediate(c, "Box Count", "[mc_tweetmeme type='none']");

								c = b.addMenu({title: "Google+"});
								a.addImmediate(c, "Standard", "[mc_googleplus type='standard'  annotation='inline']");
								a.addImmediate(c, "Small", "[mc_googleplus type='small'  annotation='inline']");
								a.addImmediate(c, "Medium", "[mc_googleplus type='medium'  annotation='inline']");
								a.addImmediate(c, "Tall", "[mc_googleplus type='tall'  annotation='inline']");

								c = b.addMenu({title: "Pinterest"});
								a.addImmediate(c, "Vertical", "[mc_pinterest type='vertical']");
								a.addImmediate(c, "horizontal", "[mc_pinterest type='horizontal']");
								a.addImmediate(c, "None", "[mc_pinterest type='none']");

								b.addSeparator();

								c = b.addMenu({title : "Mint"});
								a.addImmediate(c, "Quote", '[mc_quote image="yes" author="Quote author"] Your quote content [/mc_quote]');
								a.addImmediate(c, "Iconbox", '[mc_iconbox title="Your title" icon="icon-info" type="mint-iconbox-a"]Your icon box content[/mc_iconbox]');

								cc = c.addMenu({title: "Space"});
								for (var i = 5; i <= 60; i += 5)
								{
									a.addImmediate(cc, "Space " + i, '[mc_space space="'+i+'"]');
								}

								a.addImmediate(c, "Team Box",  '[mc_teambox link_text="More" link_url="#" facebook="#"] Your teambox HTML [/mc_teambox]');
								a.addImmediate(c, "Dropcap",   '[mc_dropcap type="default" color="#7dbd22"]Your dropcapped content here[/mc_dropcap]');
								a.addImmediate(c, "Highlight", '[mc_highlight type="background" color="#7dbd22"]Your highlighted content[/mc_highlight]');
								a.addImmediate(c, "List",      '[mc_list type="icon-adjust"]Your list items[/mc_list]');


								/*c=b.addMenu({title:ed.getLang('woocommerce.pages')});
										a.addImmediate(c, ed.getLang('woocommerce.cart'),"[woocommerce_cart]" );
										a.addImmediate(c, ed.getLang('woocommerce.checkout'),"[woocommerce_checkout]" );
										a.addImmediate(c, ed.getLang('woocommerce.my_account'),"[woocommerce_my_account]" );
										a.addImmediate(c, ed.getLang('woocommerce.edit_address'),"[woocommerce_edit_address]" );
										a.addImmediate(c, ed.getLang('woocommerce.change_password'),"[woocommerce_change_password]" );
										a.addImmediate(c, ed.getLang('woocommerce.view_order'),"[woocommerce_view_order]" );
										a.addImmediate(c, ed.getLang('woocommerce.pay'),"[woocommerce_pay]" );
										a.addImmediate(c, ed.getLang('woocommerce.thankyou'),"[woocommerce_thankyou]" );*/

							});
						return d
			}

			return null;
		},
		addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})}
	});
	tinymce.PluginManager.add('MintShortCodes', tinymce.plugins.MintShortCodes);
})();
