<div class="inside-inner inner-header-2 inner-height-large inner-line-height-large">
	<div class="row">
		<div class="col-sm-9">
			<div class="media">
				<div class="pull-left inner-section1"><?php mint_get_header_inner_context("section1"); ?></div>
				<div class="media-body inner-section2"><?php ob_start(); mint_get_header_inner_context("section2"); 

						$html = ob_get_clean();


						if (!empty($html))
						{
							echo "<span class='pull-left ih2-sep'>&nbsp;</span> ";
							echo $html;
						}


				 ?></div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="pull-right inner-section3"><?php mint_get_header_inner_context("section3"); ?></div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>