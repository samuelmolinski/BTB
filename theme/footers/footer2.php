<div class="footer-common">
	<div class="footer-header-label">
		<canvas width="281" height="58" id="footer-header-label-img" data-src="<?php echo get_template_directory_uri(); ?>/images/footer-header-label.png" data-color="<?php echo MintOptions::get("customize-c-dcolor-dark", "#7dbd22"); ?>"></canvas>
		<h3 class="mtn mbn strong"><?php echo MintOptions::get("footer_label"); ?></h3>
	</div>

	<?php mint_get_footer_body(); // footer body with widgets ?>
	<div class="footer-caption">
		<div class="elastic">
			<div class="pull-left"><?php echo MintOptions::get("footer_copyright"); ?></div>
			<div class="pull-right"><?php mint_get_footer_context("bottom"); ?></div>
			<div class="clearfix"></div>
			<?php 
$image = MintOptions::get("footer-img");
if (!empty($image)){ 

?>		
				<div class="imagebg" style="position:absolute;bottom:0px;<?php echo MintOptions::get("footer-img-pos"); ?>:<?php echo MintOptions::get("footer-img-ppos"); ?>">
<img src="<?php echo MintOptions::get("footer-img");  ?>">
</div><?php } ?>
		</div>
	</div>
</div>