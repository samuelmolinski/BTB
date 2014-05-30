<?php 

define('ADMIN_PATH', get_template_directory() . '/theme/libs/Options/smof-options-framework/admin/');
define('ADMIN_DIR',  get_template_directory_uri() . '/theme/libs/Options/smof-options-framework/admin/');

require_once get_template_directory() . '/theme/libs/Options/smof-options-framework/functions.php';


/* Neat hack, redirect users to the real SMOF page */
if (isset($_GET['page']) && $_GET['page'] == "mint-theme-options")
{
	header("Location: themes.php?page=optionsframework");
}


class MintOptions
{

	private static $options   = array();
	private static $dbMintOptions = array();

	public static function add_menu_page()
	{
		add_menu_page( "Theme Options", "Theme Options", "manage_options", "mint-theme-options", array('Options', 'redirect_to_of'), get_template_directory_uri() . '/images/theme-options.png' );
	}
	public static function getThemeName()
	{
		if( is_child_theme() ) 
		{

			$child = wp_get_theme();
			$theme = wp_get_theme( $child->get('Template') );
			
		} 
		else 
		{
			$theme = wp_get_theme();    
		}
	
		return $theme->{'Name'};

	}

	public static function of() 
	{
		global $of_options;
		$of_options = self::$options;
	} 

	public static function add()
	{
		$args = func_get_args();
		

		if (is_array($args[0]))
		{
			self::$options[] = $args[0];

		}
		else
		{
			$opts = array(
						'id'   => @$args[0],
						'name' => @$args[1],
						'desc' => @$args[2],
						'type' => @$args[3],
						'std'  => @$args[4]
	 				);

			if (isset($args[5]) && is_array($args[5]))
			{
				$opts = array_merge($opts , @$args[5]);
			}

			self::$options[@$args[0]] = $opts;
		}

		self::of();
		return;
	}

	public static function backup( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'backup',
			$default,
			$params
		);
		return;
	}

	public static function border( $id , $name, $description = null, array $default = array(), array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'border',
			$default,
			$params
		);
		return;
	}


	public static function checkbox( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'checkbox',
			$default,
			$params
		);
		return;
	}


	public static function color( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'color',
			$default,
			$params
		);
		return;
	}


	public static function google_webfont( $id , $name, $description = null, $default = null, array $options = null,   array $params = null)
	{
		self::select_google_font( $id, $name, $description, $default, $options, $params);
	}

	public static function image($title, $src)
	{
		self::$options['image-' . rand() ] = array(
			'type' => 'image',
			'std' => $src,
			'name' => $title,
			'id'   => 'image-' . rand()
		);
		self::of();
		return;
	}

	public static function images($id, $name, $description = null, $default = null, array $options = null, array $params = null)
	{
		$params['options'] = $options;
		self::add(
			$id,
			$name,
			$description,
			'images',
			$default,
			$params
		);
	}

	public static function info($title, $desc = null )
	{
		self::$options['info-' . rand() ] = array(
			'type' => 'info',
			'std' => $title,
			'name' => rand(),
			'id'   => 'info-' . rand()
		);
		self::of();
		return;
	}


	public static function messagebox($type, $title )
	{
		if ($type == "error") $type = "danger"; // sugar
		self::$options['mb-' . rand() ] = array(
			'type'  => 'messagebox',
			'std'   => $title,
			'mbtype'=> $type,
			'name'  => false,
			'id'    => 'mb-' . rand()
		);
		self::of();
		return;
	}


	public static function media( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'media',
			$default,
			$params
		);
		return;
	}

	public static function multicheck( $id, $name, $description = null, $default = null, array $options,  array $params = null)
	{

		$params['options'] = $options;

		self::add(
			$id,
			$name,
			$description,
			'multicheck',
			$default,
			$params
		);
	}	

	public static function radio( $id, $name, $description = null, $default = null, array $options,  array $params = null)
	{

		$params['options'] = $options;

		self::add(
			$id,
			$name,
			$description,
			'radio',
			$default,
			$params
		);
	}

	public static function retina( $id , $name, $description = null, array $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'retina',
			$default,
			$params
		);
		return;
	}


	public static function section($title , $desc = null) 
	{
		return self::add( rand() , $title, $desc, 'heading' );
	}


	public static function select( $id , $name, $description = null, $default = null, array $options = null,   array $params = null)
	{

		$params['options'] = $options;

		self::add(
			$id,
			$name,
			$description,
			'select',
			$default,
			$params
		);
		return;
	}

	public static function select_range( $id , $name, $description = null, $default = null, array $options = null, $sprintf = "", array $params = null)
	{
		$opts = array();
		for ($i=$options[0]; $i<$options[1]+1;$i++)
		{
			$opts[$i] = sprintf($sprintf, $i);
		}



		$params['options'] = $opts;

		self::add(
			$id,
			$name,
			$description,
			'select',
			$default,
			$params
		);
		return;
	}

	public static function select_google_font( $id , $name, $description = null, $default = null, array $options = null,   array $params = null)
	{

		if (is_null($options) && class_exists('GoogleWebFonts'))
		{
			$wf = new GoogleWebFonts();
			$options = $wf->getList();	
		}
		$params['options'] = $options;

		self::add(
			$id,
			$name,
			$description,
			'select_google_font',
			$default,
			$params
		);
		return;
	}

	public static function slider( $id, $name, $description = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'slider',
			null,
			$params
		);
	}

	public static function sliderui( $id, $name, $description = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'slider',
			null,
			$params
		);
	}

	public static function sorter( $id, $name, $description = null, array $options,  array $params = null)
	{

		$params['options'] = $options;

		self::add(
			$id,
			$name,
			$description,
			'sorter',
			$options,
			$params
		);
	}


	public static function _switch( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'switch',
			$default,
			$params
		);
		return;
	}


	public static function text( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'text',
			$default,
			$params
		);
		return;
	}


	public static function textarea( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'textarea',
			$default,
			$params
		);
		return;
	}

	

	public static function tiles( $id, $name, $description = null, $default = null, array $options,  array $params = null)
	{

		$params['options'] = $options;

		self::add(
			$id,
			$name,
			$description,
			'tiles',
			$default,
			$params
		);
	}


	public static function transfer( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'transfer',
			$default,
			$params
		);
		return;
	}




	public static function typography( $id , $name, $description = null, array $default = array(), array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'typography',
			$default,
			$params
		);
		return;
	}	



	public static function upload( $id , $name, $description = null, $default = null, array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'upload',
			$default,
			$params
		);
		return;
	}


	public static function webfont( $id , $name, $description = null, $default = null, array $options = null,   array $params = null)
	{
		self::select_google_font( $id, $name, $description, $default, $options, $params);
	}

	public static function webfont_typography( $id , $name, $description = null, array $default = array(), array $params = null)
	{
		self::add(
			$id,
			$name,
			$description,
			'webfont_typography',
			$default,
			$params
		);
		return;
	}

	public static function getSaved()
	{
		return get_option( self::getThemeName() . "_options" );
	}


	public static function get($option, $default = null) 
	{
		
		$saved = self::getSaved();

		if (is_array($saved)) 
		{

			if (!array_key_exists( $option, $saved ))
			{
				if (isset($default))
				{
					$return = apply_filters( 'MintOptions_get', $default , $option );
				}
				else
				{
					$return = apply_filters( 'MintOptions_get', self::$options[$option]['std'], $option );	
				}
			}
			else
			{
				$return = apply_filters( 'MintOptions_get', $saved[$option] , $option );
			}
		}
		else
		{

			$value = @self::$options[$option]['std'];
			if (!empty($value))
			{
				$return = apply_filters( 'MintOptions_get', $value );
			}
			else
			{
				$return = apply_filters( 'MintOptions_get', $default );
			}
		}

		
		return $return;
		 
	}


}

/* Add fake item into the menu */
add_action('admin_menu', array("MintOptions", "add_menu_page") );

/* Leave this function here */
function of_options()
{	global $of_options;
	if (!isset($of_options) || !is_array($of_options))
	{
		$of_options = array();
	}
	return;
}
