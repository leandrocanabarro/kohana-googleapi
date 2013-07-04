<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_GoogleApi
{

	public static function factory ( $name )
	{
		$config = 'google-'.strtolower($name);
		$class = 'Kohana_GoogleApi_'.$name.'Service';

		return $class::instance(Kohana::$config->load($config));
	}

}

