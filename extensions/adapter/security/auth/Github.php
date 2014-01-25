<?php
namespace li3_socialauth\extensions\adapter\security\auth ;

use li3_socialauth\extensions\adapter\security\auth\OAuth2 ;

/**
 * Github authentication.
 */
class GitHub extends OAuth2 {

	/**
	 * Service name
	 */
	const NAME = 'GitHub' ;

	/**
	 * User infos URL
	 */
	const USER_INFO = 'https://api.github.com/user' ;

	/**
	 * Constructor
	 *
	 * @param array $config [description]
	 */
	public function __construct(array $config = array()) {
		$config += array('tokenKey' => 'oauth_token', 'scope' => array('user')) ;
		parent::__construct($config) ;
	}
}
