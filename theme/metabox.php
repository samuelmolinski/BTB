<?php

	global $mint_easing, $mint_default_sidebars, $wp_registered_sidebars;
	$mint_metaboxes = array();


	if ( isset( $_GET['post'] ) )
		$post_id = $_GET['post'];
	elseif ( isset( $_POST['post_ID'] ) )
		$post_id = $_POST['post_ID'];
	else
		$post_id = false;

	$post_id = (int) $post_id;


	$mint_template = get_post_meta( $post_id, '_wp_page_template', 'Mint' );


	$sidebars =  array();
	$sidebars['default'] = 'Default';
	$sidebars['none']    = 'None';
	
	foreach( $wp_registered_sidebars as $id => $sidebar)
	{
		$sidebars[$id] = $sidebar['name'];
	}


	$prefix = MINT_PX;
	// Page settings ---------------------------------------------------------------------------------------
	// 
	$mint_metaboxes[] = array(
		'id'     => $prefix . '_page_settings',
		'title'  => __('Page Settings', 'Mint'),
		'pages'  => array( 'page', 'post', 'portfolio' ),
		'fields' => array(


			array(
				'id'   => 'page-settings-heading',
				'type' => 'heading',
				'name' => 'Page Settings',
			),

			array(
				'name' => 'Boxed Layout',
				'id'   => $prefix . 'boxed_layout',
				'type' => 'select',
				'options' => array(
					'default'   => 'Default',
					'boxed'     => 'Boxed',
					'fullwidth' => 'Full Width'
				)
			),	

			array(
				'name' => 'Width',
				'id' => $prefix . "width",
				'type' => 'select',
				'options' => array(
					'default' => 'Default',
					'fullwidth' => 'Full Width',
					'cropped'   => "Cropped (has sidebar)"
				),
				'desc' => "Set this option to Cropped in case you want to use a sidebar! <br /> If you're using \"Widgetised Sidebar\" from Visual Composer then set this option back to \"Full Width\".",
				'std' => 'default',
			),

			array(
				'name' => 'Sidebar Position',
				'id' => $prefix . "sidebar_position",
				'type' => 'select',
				'options' => array(

					'default' => 'Default',
					'right' => 'Right',
					'left'  => 'Left',
				),
				'std' => 'default',
			),

			array(
				'name'    => 'Sidebar',
				'id'      => $prefix . 'sidebar',
				'type'    => 'select',
				'options' => $sidebars
			),
		

			array(
				'name' => __( 'Background Image', 'Mint' ),
				'id'   => "{$prefix}background_image",
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array('name' => 'Background Repeat',
				'id' => $prefix . 'background_repeat',
				'type' => 'select',
				'std'  => 'default',
				'options' => array(
					'default' => 'Default',
					'repeat'   => 'Repeat',
					'repeat-x' => "Repeat X",
					'repeat-y' => "Repeat Y",
					'no-repeat' => 'No Repeat'

				)
			),
			array('name' => 'Background Stretch',
				'id' => $prefix . 'background_stretch',
				'type' => 'select',
				'std'  => 'default',
				'options' => array(
					'default' => 'Default',
					'yes'     => 'Yes',
					'no'      => 'No'
				)
			),

			array(
				'name' => 'Background Color',
				'id'   => $prefix . "background_color",
				'type' => 'color',

			),


			array(
				'name' => 'Show Page Header',
				'id' => $prefix . "show_page_header",
				'type' => 'select',
				'std'  => 'default',
				'options' => array(
					'default' => 'Default',
					'yes' => 'Yes',
					'no'  => 'No',
				)
			),

			array(
				'id'   => 'innser-heading-settings',
				'type' => 'heading',
				'name' => 'Inner Heading Settings'
			),

			array(
				'id'   => $prefix . 'show-inner-heading',
				'name' => 'Show Inner Heading',
				'type' => 'select',
				'options' => array(
					'default' => 'Default',
					'show'    => 'Show',
					'hide'    => 'Hide'
				),
				'std'  => 'default'
			),

			array(
				'id' => $prefix . "page_title",
				'name' => "Page Title",
				'type' => 'text'
			),
			array(
				'id' => $prefix . 'page_title_color',
				'name' => 'Page Title Color',
				'type' => 'color',
				'std'  => 'default',
			),
			array(
				'id' => $prefix . 'page_icon',
				'type' => 'image_advanced',
				'name' => "Title Icon",
			),
			array(
				'id' => $prefix . "page_inner_layout",
				'type' => 'select',
				'name' => 'Inner Layout',
				'desc' => 'See all inner layout examples <a href="'.admin_url().'/themes.php?page=optionsframework#of-option-headersettings">here</a>',
				'options' => array(
					'default' => 'Default',
					'v1' => "Inner Heading Type #1",
					'v2' => "Inner Heading Type #2",
					'v3' => "Inner Heading Type #3",
					'v4' => "Inner Heading Type #4",
					'v5' => "Inner Heading Type #5",
					'v6' => "Inner Heading Type #6",
					'v7' => "Inner Heading Type #7",
				),
				'std' => 'default',
			),


			array(
				'id' => $prefix . 'header_inner_section1',
				'type' => 'select',
				'name' => 'Content for section #1',
				'options' => array(
					'default' => 'Default',
					'blank'        => 'Leave Empty',
					'title'	       => 'Page Title',
					'breadcrumbs'  => 'Breadcrumbs',
					'social-links' => 'Social Links',
					'search'       => 'Search Form',
					'text-1'         => 'Text Box 1',
					'text-2'         => 'Text Box 2',
					'text-3'         => 'Text Box 3'
				),
				'std' => 'default'
			),
			array(
				'id' => $prefix . 'header_inner_section2',
				'type' => 'select',
				'name' => 'Content for section #2',
				'options' => array(
					'default' => 'Default',
					'blank'        => 'Leave Empty',
					'title'	       => 'Page Title',
					'breadcrumbs'  => 'Breadcrumbs',
					'social-links' => 'Social Links',
					'search'       => 'Search Form',
					'text-1'         => 'Text Box 1',
					'text-2'         => 'Text Box 2',
					'text-3'         => 'Text Box 3'
				),
				'std' => 'default',
			),
			array(
				'id' => $prefix . 'header_inner_section3',
				'type' => 'select',
				'name' => 'Content for section #3',
				'options' => array(
					'default' => 'Default',
					'blank'        => 'Leave Empty',
					'title'	       => 'Page Title',
					'breadcrumbs'  => 'Breadcrumbs',
					'social-links' => 'Social Links',
					'search'       => 'Search Form',
					'text-1'         => 'Text Box 1',
					'text-2'         => 'Text Box 2',
					'text-3'         => 'Text Box 3'
				),
				'std' => 'default'
			),

			array(
				'id' => $prefix . 'inner_bg',
				'type' => 'image_advanced',
				'name' => "Inner Background",
			),

			array(
				'name' => 'Inner Background Repeat',
				'id' => $prefix . 'inner_bg_repeat',
				'type' => 'select',
				'options' => array(
					'default' => 'Default',
					'repeat'   => 'Repeat',
					'repeat-x' => "Repeat X",
					'repeat-y' => "Repeat Y",
					'no-repeat' => 'No Repeat'
				),
				'std' => 'default'
			),


			array(
				'name' => 'Background Strech',
				'id'   => $prefix . 'inner_bg_stretch',
				'type' => 'Select',
				'options' => array(
					'cover' => 'Yes',
					'auto'  => 'No'
				)
			),
			array(
				'name' => 'Inner Background Color',
				'id'   => $prefix . 'inner_bg_color',
				'type' => 'color',
			),

			array(
				'id'   => $prefix . 'inner_text_1',
				'name' => 'Text Box 1',
				'type' => 'textarea',
			),

			array(
				'id'   => $prefix . 'inner_text_2',
				'name' => 'Text Box 2',
				'type' => 'textarea',
			),


			array(
				'id'   => $prefix . 'inner_text_3',
				'name' => 'Text Box 3',
				'type' => 'textarea',
			),

			array(
				'id' => $prefix . 'content_space',
				'name' => 'Remove Content Space',
				'type' => 'select',
				'options' => array(
					'mint-default' => 'Default',
					'mint-content-nospace' => 'Both Top and Bottom',
					'mint-content-nobottomspace'  => 'From Bottom',
					'mint-content-notopspace' => 'From Top'
				) 
			)

		),

	);

	$mint_metaboxes[] = array(
		'id'     => $prefix . '_post_format',
		'title'  => __('Post Format Settings', 'Mint'),
		'pages'  => array( 'post' ),
		'fields' => array(


			array(
				'id'   => 'post-video-settings',
				'type' => 'heading',
				'name' => 'Video'
			),

			array(
				'name' => 'Video URL',
				'id'   => $prefix . 'video_url',
				'type' => 'text',
				'desc' => 'Youtube or Vimeo URL'
			),

			array(
				'name' => 'Video MP4 Source',
				'id'   => $prefix . 'video_mp4',
				'type' => 'text',
				'desc' => 'If you want to show a HTML5 Video instead of youtube or vimeo, insert your MP4 url here'
			),

			array(
				'name' => 'Video OGG Source',
				'id'   => $prefix . 'video_ogg',
				'type' => 'text',
				'desc' => 'If you want to show a HTML5 Video instead of youtube or vimeo, insert your OGG url here'
			),

			array(
				'id'   => 'post-audio-settings',
				'type' => 'heading',
				'name' => 'Audio'
			),

		
			array(
				'name' => 'Audio MP3 Source',
				'id'   => $prefix . 'audio_mp3',
				'type' => 'text',
				'desc' => 'If you want to show a HTML5 Audio insert your MP3 url here'
			),
			array(
				'name' => 'Audio OGG Source',
				'id'   => $prefix . 'audio_ogg',
				'type' => 'text',
				'desc' => 'If you want to show a HTML5 Audio insert your OGG url here'
			),


			array(
				'id'   => 'post-gallery-settings',
				'type' => 'heading',
				'name' => 'Gallery'
			),


			array(
				'name' => 'Show gallery inside post?',
				'id'   => $prefix . 'gallery_show_inside',
				'type' => 'checkbox',
				'std'  => true,
				'desc' => 'If you want to show the gallery in the blog listing but want to hide it inside the post, you can disable this.'

			),
			array(
				'name' => "Gallery Images",
				'id'   => $prefix . 'gallery',
				'type' => 'image_advanced',
				'max_file_uploads' => 100
			),

			array(
				'name' => 'Slide Text Type',
				'id'   => $prefix . 'slide_text_type',
				'type' => 'select',
				'options' => array(
					'none' =>   'None',
					'minimalistic' => 'Minimalistic',
					'extended'     => 'Extended',
					'full'		   => 'Full',
 				)
			),

			array(
				'name' => "Gallery Bullets",
				'id'   => $prefix . 'gallery_bullets',
				'type' => 'checkbox',
				'std'  => 'on'
			),

			array(
				'name' => "Gallery Thumbnails",
				'id'   => $prefix . 'gallery_thumbnails',
				'type' => 'checkbox',
				'std'  => 'on'
			),

			array(
				'name' => "Gallery Arrows",
				'id'   => $prefix . 'gallery_arrows',
				'type' => 'checkbox',
				'std'  => 'on'
			),

			array(
				'name' => 'Gallery Easing',
				'id'   => $prefix . 'gallery_easing',
				'type' => 'select',
				'options' => $mint_easing,
				'std'  => 'linear'
			),

			array(
				'name' => "Gallery Mode",
				'id'   => $prefix . 'gallery_mode',
				'type' => 'select',
				'options' => array('horizontal' => 'Horizontal', 'vertical' => 'Vertical',  'fade' => 'Fade'),
				'std'  => 'horizontal'
			),
			array(
				'id'   => 'post-quote-settings',
				'type' => 'heading',
				'name' => 'Quote'
			),


			array(
				'name'  => 'Quote Text',
				'type'  => 'textarea',
				'id'    => $prefix . 'quote_text'
			),

			array(
				'name'  => 'Quote Author',
				'type'  => 'text',
				'id'    => $prefix . 'quote_author'
			),

			array(
				'id'   => 'post-status-settings',
				'type' => 'heading',
				'name' => 'Status'
			),

			array(
				'name'  => 'Status Text',
				'type'  => 'textarea',
				'id'    => $prefix . 'status_text'
			),
		)

	);

	$mint_metaboxes[] = array(
		'id'     => $prefix . '_timeline',
		'title'  => __('Timeline Settings', 'Mint'),
		'pages'  => array( 'timeline' ),
		'fields' => array(

			array(
				'id'   => 'timeline-testimonials-settings',
				'type' => 'heading',
				'name' => 'Testimonials Settings'
			),

			array(
				'name' => 'Rating',
				'id'   => 'timeline_rating',
				'type' => 'number',
				'std'  => 5,
				'min'  => 1,
				'max'  => 5
			),

			array(
				'name' => 'Recommanded',
				'id' => 'timeline_recommanded',
				'type' => 'text',
				'std' => '100% Recommended'
			)
		)

	);

	if (!class_exists('RW_Meta_Box')) return; // bail out

	foreach($mint_metaboxes as $metabox)
	{
		new RW_Meta_Box($metabox);
	}

?>