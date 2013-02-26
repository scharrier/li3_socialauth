<?php
namespace li3_socialauth\extensions\security ;

/**
 * Multi auth : gives the ability to check multiple auth adapters with only one call. You can
 * define as many authentication processes, but call Auth::check() without name : the API will
 * return the first auth adapter with an authenticated user.
 *
 * If you specify the $name, works exactly as the standard Auth API.
 */
class Auth extends \lithium\security\Auth {

	/**
	 * Check if the user is connected. If no $name is given, check for each authentication
	 * registered configuration.
	 * 
	 * @param  string 	$name        Name of config, if specified
	 * @param  mixed 	$credentials Credentials
	 * @param  array  	$options     Options
	 * @return array                 Current user, if authenticated
	 */
	public static function check($name = null, $credentials = null, array $options = array()) {
		if (!isset($name)) {
			foreach(static::$_configurations as $name => $config) {
				$results = parent::check($name, $credentials, $options) ;
				if ($results) {
					return $results ;
				}
			}
			return false ;
		}
		return parent::check($name, $credentials, $options) ;
	}

	/**
	 * Clean every auth configuration.
	 * 
	 * @param  string $name    Name of configuration, if specified
	 * @param  array  $options Clear options
	 */
	public static function clear($name = null, array $options = array()) {
		if (!isset($name)) {
			foreach(static::$_configurations as $name => $config) {
				parent::clear($name, $options) ;
			}
		} else {
			parent::clear($name, $credentials, $options) ;
		}
	}
}