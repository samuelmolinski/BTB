<?php 
	if (!function_exists('mint_enqueue_admin_scripts'))
	{
		function mint_enqueue_admin_scripts()
		{
			wp_register_style( 'admin-css', get_template_directory_uri() . '/css/admin.css', null );
			wp_enqueue_style( 'admin-css' ); 
		}
	}

	add_action('admin_enqueue_scripts', 'mint_enqueue_admin_scripts');


	if (!function_exists('mint_customize_login_screen'))
	{
		function mint_customize_login_screen()
		{
			?>
			<style>	
				@import url(http://fonts.googleapis.com/css?family=Lato);
				.login h1 a {background: url("<?php echo MintOptions::get("admin-logo", get_template_directory_uri() . "/images/logo2x.png"); ?>") no-repeat center center; width: 124px; height:76px;}
				body { background: #313D53 !important; font-family:"Lato" !important;}
				input[type="submit"] {background: #7DBD22 !important;	border:none !important;	border-radius:0 !important;	}
				input:hover[type="submit"] 	{background:#74b020 !important;	}
				a{color:white !important;}
				#login_error a {color:#313D53 !important;}
				a:hover { color: #fafafa;}
			</style>
			<?php
		}
	}

	add_action('login_enqueue_scripts', 'mint_customize_login_screen');
?>