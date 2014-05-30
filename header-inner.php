<?php 
	if (!defined("ABSPATH")) die();
	if (defined('MINT_COMPACT_HEADER_LOADED')) return;
	$header_inner = get_post_meta( mint_get_page_id(), MINT_PX . 'page_inner_layout', true);
	if (!$header_inner || $header_inner == "default") $header_inner = MintOptions::get("inner_layout", "v1"); 

	$show_inner_header = get_post_meta( mint_get_page_id(), MINT_PX . 'show-inner-heading', true);

	if ($show_inner_header == "default" || $show_inner_header == false)
	{
		$show_inner_header = MintOptions::get('enable-inner-heading');
		
	}
	else
	{
		if ($show_inner_header == "hide")
		{
			$show_inner_header = false;
		}
		else
		{
			$show_inner_header = true;
		}
	}


	if ($show_inner_header)  {
?>

<div class="header-inner <?php echo $header_inner ?>">
	
	<div class="elastic">
		<?php

			switch ($header_inner) {
				case 'v1':
					include get_template_directory() . "/theme/inner-headers/inner1.php"; 
					break;
				case 'v2':
					include get_template_directory() . "/theme/inner-headers/inner2.php"; 
					break;
				case 'v3':
					include get_template_directory() . "/theme/inner-headers/inner3.php"; 
					break;
				case 'v4':
					include get_template_directory() . "/theme/inner-headers/inner4.php"; 
					break;
				case 'v5':
					include get_template_directory() . "/theme/inner-headers/inner5.php"; 
					break;
				case 'v6':
					include get_template_directory() . "/theme/inner-headers/inner6.php"; 
					break;
				case 'v7':
					include get_template_directory() . "/theme/inner-headers/inner7.php"; 
					break;
				default:
					include get_template_directory() . "/theme/inner-headers/inner1.php"; 
					break;
			}
		?>
	</div>

</div>

<?php } ?>