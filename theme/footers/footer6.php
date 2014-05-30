<div class="footer-common">
	<?php mint_get_footer_body(); // footer body with widgets ?>
	<div class="footer-caption">
		<div class="elastic">
			<div class="center"><?php echo MintOptions::get("footer_copyright"); ?></div>
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