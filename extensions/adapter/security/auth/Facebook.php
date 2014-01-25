<?php
namespace li3_socialauth\extensions\adapter\security\auth ;

use li3_socialauth\extensions\adapter\security\auth\OAuth2 ;

/**
 * Facebook authentication.
 */
class Facebook extends OAuth2 {

	/**
	 * Service name
	 */
	const NAME = 'Facebook' ;

	/**
	 * User infos URL
	 */
	const USER_INFO = 'https://graph.facebook.com/me' ;

	/**
	 * Constructor
	 *
	 * @param array $config [description]
	 */
	public function __construct(array $config = array()) {
		$config += array('tokenKey' => 'oauth_token', 'scope' => array('email')) ;
		parent::__construct($config) ;
	}
}
