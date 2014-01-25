<?php
namespace li3_socialauth\extensions\adapter\security\auth ;

use li3_socialauth\extensions\adapter\security\auth\OAuth2 ;

/**
 * Microsoft authentication.
 */
class Microsoft extends OAuth2 {

	/**
	 * Service name
	 */
	const NAME = 'Microsoft' ;

	/**
	 * User info URL
	 */
	const USER_INFO = 'https://apis.live.net/v5.0/me' ;

	/**
	 * Constructor
	 *
	 * @param array $config [description]
	 */
	public function __construct(array $config = array()) {
		$config += array('tokenKey' => 'oauth_token', 'scope' => array('basic')) ;
		parent::__construct($config) ;
	}
}
