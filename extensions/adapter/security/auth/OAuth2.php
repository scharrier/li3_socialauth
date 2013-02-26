<?php
namespace li3_socialauth\extensions\adapter\security\auth;

use OAuth\OAuth1\Signature\Signature;
use OAuth\Common\Storage\Memory;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\Uri;
use OAuth\ServiceFactory ;

/**
 * Twitter authentication.
 */
abstract class OAuth2 extends \lithium\core\Object {

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
		$this->_storage = new Memory();
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
		$here = new Uri($request->to('url')) ;
		$here->setQuery('') ;
		$credentials = new Credentials(
		    $this->_config['key'],
		    $this->_config['secret'],
		    $here->getAbsoluteUri()
		);

		$serviceFactory = new ServiceFactory();
		$service = $serviceFactory->createService(static::NAME, $credentials, $this->_storage, $this->_config['scope']);

		if (empty($request->query['code'])) {
		    $url = $service->getAuthorizationUri();
		    header('Location: ' . $url);
		} else {
		    $service->requestAccessToken($request->query['code']);
		    $result = json_decode($service->request(static::USER_INFO), true);
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
		$this->_storage = null ;
	}

}