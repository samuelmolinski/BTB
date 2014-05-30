<?php
extract(shortcode_atts( array(
			'author' => null,
			'image' => null
		) , $atts));

$content = wpb_js_remove_wpautop($content);
$imgClass = ($image) ? "" : "quote-no-image";

$html = "<blockquote class='mint-quote-a {$imgClass}'>";
$html .= "<div class='mint-quote-text'>" . $content . "</div>";
if (!empty($author))
{
	$html .= "<div class='mint-quote-author pull-right'> &mdash; ". $author ."</div>";
}
$html .= "</blockquote>";
echo $html;