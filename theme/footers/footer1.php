<div class="footer-header">
	<div class="elastic">
		<div class="pull-left"><h4 class="strong mbn footer-line-height-small"><?php echo MintOptions::get("footer_label"); ?></h4></div>
		<div class="pull-right"><?php mint_get_footer_context("top"); ?></div>
		<div class="clearfix"></div>
	</div>
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
