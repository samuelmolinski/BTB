<?php 
	class MintGenOpt extends MintOptions
	{
		static $gen = array();

		public static function color($id , $name, $description = null, $default = null, array $params = array(), $css = null)
		{
			parent::color($id , $name, $description , $default, $params);
			$value = (!MintOptions::get($id)) ? $default : MintOptions::get($id);


			self::$gen[$id] = str_replace( "%s", $value, $css );
			return;
		}

		public static function webfont_typography( $id , $name, $description = null, array $default = array(), array $params = null, $css = null)
		{	
			global $LOAD_WEB_FONTS;
			parent::webfont_typography($id, $name, $description, $default, $params);

			$value = (!MintOptions::get($id)) ? $default : MintOptions::get($id);

			$LOAD_WEB_FONTS[] = @$value['face'];

			self::$gen[$id] = self::parse( $css , $value );
		}

		public static function render()
		{
			echo "<style>";
			echo implode( "\n", self::$gen );
			echo "</style>";
		}

		public static function parse($str, array $args)
		{
			foreach($args as $arg => $value)
			{
				$str = str_replace("%". $arg . "%", $value, $str);
			}
			return $str;
		}
	}


	add_action('wp_head', array('MintGenOpt', 'render') );




?>