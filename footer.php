<?php if (!defined("ABSPATH")) die(); ?><?php do_action('mint_before_footer_start'); ?>
<?php if (!defined('MINT_LOAD_CUSTOM_FOOTER')) { ?><?php $footer_version = MintOptions::get("footer_layout", "v1"); ?>
		
		<footer class="<?php echo $footer_version; ?>">
			<?php
				switch ($footer_version) {
					case 'v1':
						include get_template_directory() . "/theme/footers/footer1.php"; 
						break;
					case 'v2':
						include get_template_directory() . "/theme/footers/footer2.php"; 
						break;
					case 'v3':
						include get_template_directory() . "/theme/footers/footer3.php"; 
						break;
					case 'v4':
						include get_template_directory() . "/theme/footers/footer4.php"; 
						break;
					case 'v5':
						include get_template_directory() . "/theme/footers/footer5.php"; 
						break;
					case 'v6':
						include get_template_directory() . "/theme/footers/footer6.php"; 
						break;
					case 'v7':
						include get_template_directory() . "/theme/footers/footer7.php"; 
						break;
					default:
						include get_template_directory() . "/theme/footers/footer1.php"; 
						break;
				}
			?>
		</footer>

		
		<?php 
			$mpid = mint_get_page_id();
			$boxed = get_post_meta($mpid, MINT_PX . 'boxed_layout', true);

			if ($boxed != "fullwidth")
			{
				if(MintOptions::get("page-boxed", false) || $boxed == "boxed") { echo '</div> <!-- end of all elastic -->'; }
			}
		?>

		<?php if (MintOptions::get('enable-to-top', true)) : ?>
			<div class="btn" id="toTop">
				<span class="icon-up-open">&nbsp;</span>
			</div>
		<?php endif; ?>

		<?php echo MintOptions::get('tracking-code'); ?>
		<script>
	jQuery(window).load(function() {
		window.setTimeout(function() {
			jQuery('#loader').fadeOut(1000);
		}, 100);
	});
	</script>
		<?php wp_footer(); ?>




	</body>
</html>
<?php } ?>