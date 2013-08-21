<?php
namespace li3_socialauth\extensions\adapter\security\auth;

use lithium\security\Auth;
use OAuth\OAuth1\Signature\Signature;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;
use OAuth\ServiceFactory ;

/**
 * Twitter authentication.
 */
class Twitter extends \lithium\core\Object {

	/**
	 * Session storage.
	 *
	 * @var [type]
	 */
	protected $_storage ;

	/**
	 * Constructor
	 *
	 * @param array $config [description]
	 */
	public function __construct(array $config = array()) {
		$config += array('tokenKey' => 'oauth_token') ;
		$this->_storage = new Session(false, $config['tokenKey']);
		parent::__construct($config) ;
	}

	/**
	 * Check the authentication. Will be called two times : first to request a token, and redirect
	 * to the Twitter api url, then to authenticate the user.
	 *
	 * @param  [type] $request [description]
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function check($request, array $options = array()) {
		$credentials = new Credentials(
		    $this->_config['key'],
		    $this->_config['secret'],
		    $request->to('url')
		);

		$serviceFactory = new ServiceFactory();
		$service = $serviceFactory->createService('twitter', $credentials, $this->_storage);

		if (!empty($request->query['denied'])) {
			return false ;
		} elseif (empty($request->query['oauth_token'])) {
			$token = $service->requestRequestToken();
		    $url = $service->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));
		    header('Location: ' . $url);
		} else {
			$token = $this->_storage->retrieveAccessToken('Twitter');
		    $service->requestAccessToken(
		    	$request->query['oauth_token'],
		    	$request->query['oauth_verifier'],
		    	$token->getRequestTokenSecret()
		    );

		    $result = json_decode($service->request( 'account/verify_credentials.json'), true);

		    return $result ;
		}

	}

	/**
	 * Prepare the data to be stored.
	 *
	 * @param [type] $data    [description]
	 * @param array  $options [description]
	 */
	public function set($data, array $options = array()) {
		return $data ;
	}

	/**
	 * Clear the token session key.
	 *
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function clear(array $options = array()) {
		unset($_SESSION[$this->_config['tokenKey']]) ;
	}

}
