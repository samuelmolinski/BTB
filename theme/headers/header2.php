<?php	
$image = MintOptions::get('header-bg', '');
$hbr = MintOptions::get('header-bg-repeat', true);
$hbs = MintOptions::get('header-bg-streach');

if($image==null){
$styles="";	
}else{ 
$styles = "background: url(". $image. ")  center center;background-repeat:".$hbr."; background-size:".$hbs."; ";
}			?>
<div class="header-assets height-extra-small line-height-extra-small" style="<?php echo $styles; ?>">
	<div class="elastic">
		<div class="pull-left">
			<?php mint_get_header_context('left'); ?>
		</div>
		 <div class="pull-right">
		 	<?php mint_get_header_context('right'); ?>
		 </div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="elastic">
	<div class="header-main height-extra-large line-height-extra-large" data-menu="<?php echo MintOptions::get("menu-type"); ?>" data-header="2" id="menu-<?php echo MintOptions::get("menu-type"); ?>">
		<?php echo mint_get_logo(); ?>
		<?php echo mint_get_main_menu(); ?>
	</div>
</div>