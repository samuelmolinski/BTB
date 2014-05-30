<?php 
	$countdown = (MintOptions::get('coming-soon-type', 'count-down') == 'count-down') ? "down" : "up";
	$to_date   = date('D M d Y H:i:s O', strtotime( MintOptions::get('coming-soon-date') ) ) . "";

	$options = "{format: '" .  MintOptions::get('coming-soon-format', "DHM") . "',";



	if ($countdown == "up")
	{
		$options .= "since: new Date('" . $to_date . "')";
	}
	else
	{
		$options .= "until: new Date('" . $to_date . "')";
	}

	$options .= "}";

	if (!function_exists('mint_enqueue_coming_soon_script'))
	{
		function mint_enqueue_coming_soon_script()
		{
			wp_register_script( 'jquery.countdown', get_template_directory_uri() . '/js/jquery.countdown.js', array('jquery'), "1.6.3", true );
			wp_enqueue_script( 'jquery.countdown' );

			wp_register_style( 'coming-soon', get_template_directory_uri() . '/css/countdown.css', null, '1.0' );
			wp_enqueue_style( 'coming-soon' );
	 	}
	}

	add_action('wp_enqueue_scripts', 'mint_enqueue_coming_soon_script');
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php _e('Coming Soon', 'Mint'); ?> &mdash; <?php bloginfo('title'); ?></title>
	<?php wp_head(); ?>
</head>
<body class="tpl-coming-soon">
	
<div class="coming-soon">
	<div class="coming-soon-header"><a class="coming-soon-logo" href="<?php echo site_url(); ?>"><img src="<?php echo MintOptions::get("logo"); ?>" alt="" /></a></div>
	<div class="coming-soon-body">
		<div class="elastic coming-soon-body-inside">
			<h1 class="coming-soon-title"><?php echo MintOptions::get('coming-soon-title'); ?></h1>
			<p><?php echo MintOptions::get('coming-soon-subtitle'); ?></p>
			<div class="space20">&nbsp;</div>
			<div id="coming-soon-counter">&nbsp;</div>
			<div class="clearfix"></div>
			<div class="space25">&nbsp;</div>

			<?php if (MintOptions::get('coming-soon-newsletter')) : ?>
				<?php
					if(shortcode_exists("mc4wp_form"))
					{
						?>
						<div class="newsletter-wrapper"><?php echo do_shortcode("[mc4wp_form]"); ?></div>
						<div class="clearfix"></div>
						<?php
					}
				?>
			<?php endif; ?>

			<?php if (MintOptions::get('coming-soon-socials')) : ?>
				<?php mint_get_social("ib coming-soon-social"); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="coming-soon-caption"><p class="coming-copyright center"><?php echo MintOptions::get('footer_copyright'); ?></p></div>
</div>

<script>
	jQuery(function() {
		jQuery('#coming-soon-counter').countdown(<?php echo $options; ?>);
	});
</script>

<?php wp_footer(); ?>

</body>
</html>