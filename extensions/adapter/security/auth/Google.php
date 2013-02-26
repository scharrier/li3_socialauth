<?php
namespace li3_socialauth\extensions\adapter\security\auth ;

use li3_socialauth\extensions\adapter\security\auth\OAuth2 ;

/**
 * Google authentication.
 */
class Google extends OAuth2 {

	/**
	 * Service name
	 */
	const NAME = 'google' ;

	/**
	 * User infos URL
	 */
	const USER_INFO = 'https://www.googleapis.com/oauth2/v1/userinfo' ;

	/**
	 * Constructor
	 * 
	 * @param array $config [description]
	 */
	public function __construct(array $config = array()) {
		$config += array('tokenKey' => 'oauth_token', 'scope' => array('userinfo_email', 'userinfo_profile')) ;
		parent::__construct($config) ;
	}
}