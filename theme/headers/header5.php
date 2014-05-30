<div class="header-main-border"></div>

<div class="elastic">
	<div class="header-main height-large line-height-large">
		<div class="row">
			<div class="col-sm-4"><?php mint_get_header_context('left'); ?></div>
			<div class="col-sm-4 center"><?php echo mint_get_logo( array("class" => "logo-center") ); ?></div>
			<div class="col-sm-4"><div class="pull-right"><?php mint_get_header_context('right'); ?></div></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="header-assets height-small line-height-small ov">
	<div class="elastic center" data-menu="<?php echo MintOptions::get("menu-type"); ?>" data-header="5" id="menu-<?php echo MintOptions::get("menu-type"); ?>">
		<?php echo mint_get_main_menu( array("position" => "wrap-middle menu-center", "menu_class" => "middle height-small line-height-small" ) ); ?>
		<div class="clearfix"></div>
	</div>
</div>