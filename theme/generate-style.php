<?php 
	
	if (!defined('ABSPATH')) return;
	if (!current_user_can('manage_options')) return;

	if (!function_exists('mint_generate_style'))
	{
		function mint_generate_style()
		{

			
			require_once get_template_directory() . "/theme/libs/CssMin/cssmin.php"; // Allows us to minify the CSS
			require_once get_template_directory() . "/theme/libs/lessphp/lessc.inc.php"; // Allows us to compile LESS
			$lessc = new lessc;
			$lessc->setImportDir( array( get_template_directory() . "/css/", get_template_directory() . "/css/menus/") ); 
			$lessPath = get_template_directory() . "/css/mint.less";

			parse_str( urldecode( $_POST['data'] ) , $saved );
		    
		    $opacity_menu = 1;
		    
		    if ($saved['opacity-menu']) 
		    {
		        $opacity_menu = (int)$saved['opacity-procent'];
                if ($opacity_menu == 0 )
                {
                    $opacity_menu = 1;
                }
                $opacity_menu = $opacity_menu / 100;
            }
        
              
		
			
			// USE $saved variable for saved data!
			$replaces = array(
				'body-bg'             => $saved['customize-body-bg'],
				'font-family-base'    => $saved['customize-main-font']['face'],
				'font-size-base'      => $saved['customize-main-font']['size'],
				'font-family-heading' => $saved['customize-headings-font']['face'],
				'font-family-menu'    => $saved['customize-menu-font']['face'],
				'font-size-menu'      => $saved['customize-menu-font']['size'],
				'font-size-submenu'   => $saved['customize-submenu-size'] . "px",
				'dcolor-dark'         => $saved['customize-c-dcolor-dark'],
				'white'               => $saved['customize-c-white'],
				'black'               => $saved['customize-c-black'],
				'tcolor'              => $saved['customize-c-tcolor'],
				'hcolor'              => $saved['customize-c-hcolor'],
				'dcolor2'             => $saved['customize-c-dcolor2'],
				'dcolor'              => $saved['customize-c-dcolor'],
				'dcolor2-light'       => $saved['customize-c-dcolor2-light'],
				'dcolor2-dark'        => $saved['customize-c-dcolor2-dark'],

				// footer colors
				'dcolor-lighter'      => $saved['customize-c-dcolor-lighter'],
				'dcolor-light'        => $saved['customize-c-dcolor-light'],
				'dcolor-darken'       => $saved['customize-c-dcolor-darken'],
				'dcolor-extra-dark'   => $saved['customize-c-dcolor-extra-dark'],
				'dcolor-extra-darken'   => $saved['customize-c-dcolor-extra-darken'],

				// footer common
				'dcolor3'             => $saved['customize-c-dcolor3'],
				'dcolor3-dark'        => $saved['customize-c-dcolor3-dark'],
				'dcolor3-darken'      => $saved['customize-c-dcolor3-darken'],
				'dcolor3-light'       => $saved['customize-c-dcolor3-light'],
				'dcolor3-lighter'     => $saved['customize-c-dcolor3-lighter'],
				'footer-separator'    => $saved['customize-c-footer-separator'],

				// others
				'separator'           => $saved['customize-c-separator'],
				'widget-separator'    => $saved['customize-c-widget-separator'],

				// sticky notes
				'sticky-note-color'   => $saved['customize-c-sticky-note-color'],
				'sticky-note-bg'      => $saved['customize-c-sticky-note-bg'],
				'sticky-attention-color'   => $saved['customize-c-sticky-attention-color'],
				'sticky-attention-bg'      => $saved['customize-c-sticky-attention-bg'],
				'sticky-alert-color'   => $saved['customize-c-sticky-alert-color'],
				'sticky-alert-bg'      => $saved['customize-c-sticky-alert-bg'],
				'sticky-success-color'   => $saved['customize-c-sticky-success-color'],
				'sticky-success-bg'      => $saved['customize-c-sticky-success-bg'],
				
				// menu
				'menu-opacity'      => $opacity_menu,
			
			);


			$varscss = <<<HEREDOC
@body-bg : {$replaces['body-bg']};
@font-family-base: '{$replaces['font-family-base']}', Arial, sans-serif;
@font-family-heading : '{$replaces['font-family-heading']}', Arial, sans-serif;
@font-family-menu : '{$replaces['font-family-menu']}', Arial, sans-serif;
@font-size-base: {$replaces['font-size-base']};
@font-size-menu : {$replaces['font-size-menu']};
@font-size-submenu : {$replaces['font-size-submenu']};
@small-size : 12px;
@line-height-base: 22px;
@separator: {$replaces['separator']};
@height-extra-small : 37px;
@height-small : 47px;
@height-base : 58px;
@height-large : 78px;
@height-extra-large : 86px;
@line-height-extra-small : @height-extra-small;
@line-height-small : @height-small;
@line-height-base : @height-base;
@line-height-large : @height-large;
@line-height-extra-large : @height-extra-large;
@content-margin-top : 100px;
@content-margin-bottom : 100px;
@margin-none : 0px;
@margin-extra-small : 5px;
@margin-base : 20px;
@footer-height-extra-small : 47px;
@footer-height-small : 55px;
@footer-height-base : 58px;
@footer-line-height-extra-small : @footer-height-extra-small;
@footer-line-height-small : @footer-height-small;
@footer-line-height-base : @footer-height-base;
@inner-bg-image : "";
@inner-bg-repeat: no-repeat;
@inner-bg-color : #f7f7f7;
@inner-bg-stretch : cover;
@inner-height-small : 55px;
@inner-height-base : 60px;
@inner-height-large : 90px;
@inner-height-extra-large : 225px;
@inner-line-height-small : 55px;
@inner-line-height-base : 60px;
@inner-line-height-large : 90px;
@breadcrumbs-font-size: 11px;
@input-height-base : 30px;
@white : {$replaces['white']};
@black : {$replaces['black']};
@white-darker : #efefef;
@gray-extra-light: #f7f7f7;
@gray-lighter : #e0e0e0;
@gray-dark : #d0d0d0;
@gray-e : #eeeeee;
@dcolor-lighter : {$replaces['dcolor-lighter']};
@dcolor-light : {$replaces['dcolor-light']};
@dcolor : {$replaces['dcolor']};
@dcolor-dark : {$replaces['dcolor-dark']};
@dcolor-darken : {$replaces['dcolor-darken']};
@dcolor-extra-dark : {$replaces['dcolor-extra-dark']};
@dcolor-extra-darken : {$replaces['dcolor-extra-darken']};
@dcolor2-light: {$replaces['dcolor2-light']}; // menu text color
@dcolor2 : {$replaces['dcolor2']}; // default color 2
@dcolor2-dark : {$replaces['dcolor2-dark']}; // for menu active and others
@dcolor3-lighter : {$replaces['dcolor3-lighter']};
@dcolor3-light : {$replaces['dcolor3-light']};
@dcolor3 : {$replaces['dcolor3']}; // default color 3 (gray by default)
@dcolor3-dark : {$replaces['dcolor3-dark']};
@dcolor3-darken : {$replaces['dcolor3-darken']};
@footer-separator : {$replaces['footer-separator']};
@widget-separator : {$replaces['widget-separator']};
@dcolor4-light : #8ce3ff;
@dcolor4 : #2cafda; // used on footer
@dcolor4-dark : #2694b8;
@hcolor : {$replaces['hcolor']}; // header color. Ex: h1 - h6
@lcolor : #484747; // list color. Ex: ol, ul
@tcolor : {$replaces['tcolor']}; // text color.
// slider colors 
@slider-text-color : #d0d0d0;
// widget
@twitter-bird : #d0d0d0;
// coming soon
@coming-soon-bg : #313d53;
@countdown-color1: #70aa1d;
@countdown-color2: #7dbd22;
@coming-soon-separator: #eeeeee;
// WOOCOMMERCE -----------------------------------------------------------
@wc-product-border: #eeeeee;
@wc-product-caption-bg: #f7f7f7;
@wc-product-caption-bg-active: @dcolor-dark;
@wc-sale-flash-bg: #e27c7c;
@wc-stars: #e27c7c;
@wc-tab-bg: #f7f7f7;
// 404 page
@error-menu-color : #d0d0d0;

// sticky notes 
@sticky-note-color           : {$replaces['sticky-note-color']};
@sticky-note-background      : {$replaces['sticky-note-bg']};
@sticky-note-border          : @sticky-note-color;

@sticky-attention-color      : {$replaces['sticky-attention-color']};
@sticky-attention-background : {$replaces['sticky-attention-bg']};
@sticky-attention-border     : @sticky-attention-color;

@sticky-alert-color          : {$replaces['sticky-alert-color']};
@sticky-alert-background     : {$replaces['sticky-alert-bg']};
@sticky-alert-border         : @sticky-alert-color;

@sticky-success-color        : {$replaces['sticky-success-color']}; 
@sticky-success-background   : {$replaces['sticky-success-bg']};
@sticky-success-border       : @sticky-success-color;
@menu-opacity                : {$replaces['menu-opacity']};
HEREDOC;

			
			if (file_exists($lessPath) && is_readable($lessPath))
			{
				$less = file_get_contents( $lessPath );
				$lessc->setVariables($replaces);
		

				try {
					@rename( get_template_directory() . '/css/variables.less', get_template_directory() .'/css/variables.less.bak');

					$fh = fopen( get_template_directory() . '/css/variables.less', 'w');
					fwrite($fh, $varscss);
					fclose($fh);

					$lessc->compileFile($lessPath, get_template_directory() . '/css/generated.css');

					$lessc = new lessc;
					$lessc->setImportDir( array( get_template_directory() . "/css/", get_template_directory() . "/css/menus/") ); 
					$lessc->compileFile( get_template_directory() . '/css/menus/mint-menu-simple.less', get_template_directory() . '/css/menus/mint-menu-simple.css');

					
					$lessc = new lessc;
					$lessc->setImportDir( array( get_template_directory() . "/css/", get_template_directory() . "/css/menus/") ); 
					$lessc->compileFile( get_template_directory() . '/css/responsive.less', get_template_directory() . '/css/responsive.css');

					// And minimize
					
					$css = file_get_contents(get_template_directory() . '/css/generated.css');

					$min = CssMin::minify( $css );

					$fh = fopen(get_template_directory() . '/css/generated.css', 'w');
					fwrite($fh, $min);
					fclose($fh);



				} catch(Exception $e)
				{
					die(json_encode(array('error' => true, 'message' => $e->getMessage() )));
				}

		
				

			}
			die("1");
		}
	}
	
	add_action('options_framework_save_option_data', 'mint_generate_style');
?>