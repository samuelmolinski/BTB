<?php

if (!defined('ABSPATH')) die();

// Init languages
load_theme_textdomain( 'Mint', get_template_directory() . '/languages' );

// Shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Set default content width
if (!isset($content_width)) $content_width = 940;

// Blog post formats
add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat', 'status' ) );


