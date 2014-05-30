<?php

if (!function_exists('mint_add_social_fields'))
{
	function mint_add_social_fields($profile_fields) 
	{

		global $mint_social_networks;

		foreach($mint_social_networks as $id => $soc )
		{
			$profile_fields[$id] = $soc;
		}
		return $profile_fields;
	}
}

add_filter('user_contactmethods', 'mint_add_social_fields');