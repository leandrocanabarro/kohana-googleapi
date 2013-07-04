<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_GoogleApi_Client
{

	/**
	 * Google Api PHP Client
	 */
	private $_client = null;

	/**
	 * Configuration
	 */
	private $_config = null;

	/**
	 * Build a new Kohana_GoogleApi_Client object
	 *
	 * @param {array} $config Parameters
	 */
	public function __construct ( $config = array() )
	{
		$this->_config = $config;

		$this->_client = new Google_Client();
		$this->_client->setApplicationName('Kohana Google API Client');
		$this->_client->setClientId($config['client_id']);

		if (Session::instance()->get('googleapi_client_token'))
			$this->_client->setAccessToken(Session::instance()->get('googleapi_client_token'));

		$this->_client->setAssertionCredentials(new Google_AssertionCredentials(
			$config['service_account_name'],
			$config['permissions'],
			file_get_contents($config['key_file']))
		);

		if (!Session::instance()->get('googleapi_client_token'))
			Session::instance()->set('googleapi_client_token', $this->_client->getAccessToken());
	}

	/**
	 * Get original Google Api Client
	 */
	public function original ()
	{
		return $this->_client;
	}

}

