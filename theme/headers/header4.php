<div class="elastic">
	<div class="header-main height-large line-height-large">
		<div class="pull-left">
			<?php echo mint_get_logo(); ?>
		</div>
		 <div class="pull-right">
		 	<?php mint_get_header_context('left'); ?>
		 </div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="header-assets height-small line-height-small ov">
	<div class="elastic">
		<div class="pull-left height-small line-height-small" data-menu="<?php echo MintOptions::get("menu-type"); ?>" data-header="4" id="menu-<?php echo MintOptions::get("menu-type"); ?>">
			<?php echo mint_get_main_menu( array("position" => "wrap-middle", "menu_class" => "middle height-small line-height-small" ) ); ?>
		</div>
		<div class="pull-right"><?php mint_get_header_context('right'); ?></div>
		<div class="clearfix"></div>
	</div>
</div>