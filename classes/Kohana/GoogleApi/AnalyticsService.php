<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_GoogleApi_AnalyticsService extends Google_AnalyticsService
{

	// Instance of GoogleAnalytics object
	protected static $_instance = null;

	// Kohana Google client
	private $_client = null;

	/**
	 * Build a new Kohana_GoogleApi_AnalyticsService object
	 *
	 * @param {array} $config Parameters
	 */
	public function __construct ( $config = array() )
	{
		$this->_client = new Kohana_GoogleApi_Client($config);

		parent::__construct($this->_client->original());
	}

	/**
	 * Load instance
	 */
	public static function instance ( $config )
	{
		if (is_null(self::$_instance))
		{
			$config['permissions'] = array(
				'https://www.googleapis.com/auth/analytics.readonly',
				'https://www.googleapis.com/auth/userinfo.email',
				'https://www.googleapis.com/auth/userinfo.profile'
			);

			self::$_instance = new self($config);
		}

		return self::$_instance;
	}

}

