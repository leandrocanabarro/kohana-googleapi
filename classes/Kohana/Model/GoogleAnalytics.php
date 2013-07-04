<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Model_GoogleAnalytics extends Model
{

	/**
	 * Google Analytics Internal Service
	 */
	private $_ga = null;

	/**
	 * Build a new Google Analytics Service
	 */
	public function __construct ()
	{
		$this->_ga = GoogleApi::factory('Analytics');
	}

	/**
	 * Get all accounts
	 */
	public function get_accounts ()
	{
		return $this->_ga->management_accounts->listManagementAccounts();
	}

	/**
	 * Get all accounts items
	 */
	public function get_accounts_items ()
	{
		return self::_get_value_of($this->get_accounts(), 'items', array());
	}

	/**
	 * Get Google Analytics data for a given profile
	 *
	 * get($ids, $start_date, $end_date, $metrics, $optParams = array()) {
	 */
	public function get_data ( $profile_id, $start_date, $end_date, $metrics, $optParams = array() )
	{
		return $this->_ga->data_ga->get('ga:'.$profile_id, $start_date, $end_date, $metrics, $optParams);
	}

	/**
	 * Get all profiles of a given account and property
	 *
	 * @param {int} $account_id An account identifier
	 * @param {int} $property_id A property identifier
	 */
	public function get_profiles ( $account_id, $property_id )
	{
		return $this->_ga->management_profiles->listManagementProfiles($account_id, $property_id);
	}

	/**
	 * Get all profiles items of a given account and property
	 *
	 * @param {int} $account_id An account identifier
	 * @param {int} $property_id A property identifier
	 */
	public function get_profiles_items ( $account_id, $property_id )
	{
		return self::_get_value_of($this->get_profiles($account_id, $property_id), 'items', array());
	}

	/**
	 * Get all properties of a given account
	 *
	 * @param {int} $account_id An account identifier
	 */
	public function get_properties ( $account_id )
	{
		return $this->_ga->management_webproperties->listManagementWebproperties($account_id);
	}

	/**
	 * Get all properties items of a given account
	 *
	 * @param {int} $account_id An account identifier
	 */
	public function get_properties_items ( $account_id )
	{
		return self::_get_value_of($this->get_properties($account_id), 'items', array());
	}
	
	/**
	 * Get the value of a given key
	 *
	 * @param {array} $array
	 * @param {string} $key
	 */
	private static function _get_value_of ( $array, $key, $default = null )
	{
		if (!isset($array[$key]))
			return $default;

		return $array[$key];
	}

}

