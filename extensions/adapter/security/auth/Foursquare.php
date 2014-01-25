<?php
namespace li3_socialauth\extensions\adapter\security\auth ;

use li3_socialauth\extensions\adapter\security\auth\OAuth2 ;

/**
 * Foursquare authentication.
 */
class Foursquare extends OAuth2 {

	/**
	 * Service name
	 */
	const NAME = 'Foursquare' ;

	/**
	 * User infos URL
	 */
	const USER_INFO = 'https://api.foursquare.com/v2/users/self?v=20130302' ;

	/**
	 * Constructor
	 *
	 * @param array $config [description]
	 */
	public function __construct(array $config = array()) {
		$config += array('tokenKey' => 'oauth_token', 'scope' => array()) ;
		parent::__construct($config) ;
	}
}
