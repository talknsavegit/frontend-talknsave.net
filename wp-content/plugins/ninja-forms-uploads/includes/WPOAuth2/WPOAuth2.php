<?php

namespace NinjaForms\FileUploads\WPOAuth2;

use NinjaForms\FileUploads\Common\Handlers\Logger;
use NinjaForms\FileUploads\Common\Interfaces\NfLogger;
use NinjaForms\FileUploads\WPOAuth2\TokenManager;


class WPOAuth2 {

	/**
	 * @var WPOAuth2
	 */
	private static $instance;

	/**
	 * @var string
	 */
	protected $oauth_proxy_url;

	/**
	 * @var TokenManager
	 */
	public $token_manager;

	/** @var NfLogger */
	protected $logger;

	/**
	 * @param string $oauth_proxy_url
	 *
	 * @return WPOAuth2 Instance
	 */
	public static function instance( $oauth_proxy_url ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WPOAuth2 ) ) {
			self::$instance = new WPOAuth2();
			self::$instance->init( $oauth_proxy_url );
		}

		return self::$instance;
	}

	/**
	 * @param string $oauth_proxy_url
	 */
	public function init( $oauth_proxy_url ) {
		$this->oauth_proxy_url = $oauth_proxy_url;

		$this->token_manager = new TokenManager();
	}

	/**
	 * @return string
	 */
	public function get_oauth_proxy_url() {
		return $this->oauth_proxy_url;
	}

	/**
	 * Register the admin hooks for the plugin.
	 *
	 * @param string $redirect_url
	 */
	public function register_admin_handler( $redirect_url ) {
		$admin_handler = new AdminHandler( $this->token_manager, $redirect_url, $this->get_method() );
		$admin_handler->init();
	}

	/**
	 * Get the URL to the proxy server to redirect to, to start the auth process.
	 *
	 * @param string $provider
	 * @param string $client_id
	 * @param string $callback_url
	 * @param array  $args
	 *
	 * @return string
	 */
	public function get_authorize_url( $provider, $client_id, $callback_url, $args = array() ) {
		$params = array(
			'redirect_uri' => $callback_url,
			'client_id'    => $client_id,
			'key'          => $this->generate_key( $provider ),
			'method'       => $this->get_method(),
		);

		if ( ! empty( $args ) ) {
			$params['args'] = base64_encode( serialize( $args ) );
		}

		$url = $this->oauth_proxy_url . '?' . http_build_query( $params, '', '&' );

		$logEntryArray =[
			'timestamp'=>time(),
			'logPoint'=>'NinjaForms\FileUploads\WPOAuth2\WPOAuth2_get_authorize_url',
			'supportingData'=>json_encode([
				'provider'=>$provider,
				'callback_url'=>$callback_url,
				'constructedUrl'=>$url
			])
		];

		$this->logger->debug('File Uploads get authorize url',$logEntryArray);
		return $url;
	}

	/**
	 * Send a refresh token to the proxy server for a client and get a new access token back.
	 *
	 * @param string $client_id
	 * @param string $provider
	 *
	 * @return bool|string
	 */
	public function refresh_access_token( $client_id, $provider ) {
		$logEntryArray =[
			'timestamp'=>time(),
			'logPoint'=>'NinjaForms\FileUploads\WPOAuth2\WPOAuth2_refresh_access_token'
		];

		$refresh_token = $this->token_manager->get_refresh_token( $provider );

		$params = array(
			'client_id'     => $client_id,
			'refresh_token' => $refresh_token,
		);

		$url = $this->oauth_proxy_url . '/refresh?' . http_build_query( $params, '', '&' );

		$request = wp_remote_get( $url );

		$supportingDataArray = [
			'url'=>$url
		];

		if ( is_wp_error( $request ) ) {

			$supportingDataArray['request']=$request;

			$logEntryArray['supportingData'] =json_encode($supportingDataArray);

			$this->logger->debug('WP error when requesting access token',$logEntryArray);
			
			return false; // Bail early
		}

		/** @var string $body */
		$body = wp_remote_retrieve_body( $request );

		/** @var array $data */
		$data = json_decode( $body, true );

		$supportingDataArray['data']=$data;

		if ( ! $data || ! isset( $data['token'] ) ) {
			
			$logEntryArray['supportingData'] =json_encode($supportingDataArray);

			$this->logger->debug('Successful request to generate access token was not approved',$logEntryArray);
			
			return false;
		}

		if(isset($supportingDataArray['data']['token'])){

			$supportingDataArray['data']['token']='redacted';
		}
		
		$expires = isset( $data['expires'] ) ? $data['expires'] : null;

		$this->token_manager->set_access_token( $provider, $data['token'], $refresh_token, $expires );
		
		$logEntryArray['supportingData'] =json_encode($supportingDataArray);

		$this->logger->debug('Successful request with successful generation of access token',$logEntryArray);
		
		return $data['token'];
	}

	public function get_method() {
		$methods = openssl_get_cipher_methods();

		return $methods[0];
	}

	/**
	 * @param string $provider
	 *
	 * @return string
	 */
	protected function generate_key( $provider ) {
		$keys = get_site_transient( 'wp-oauth2-key' );

		if ( ! is_array( $keys ) ) {
			$keys = array();
		}

		$key = wp_generate_password();

		$keys[ $provider ] = $key;

		set_site_transient( 'wp-oauth2-key', $keys );

		return $key;
	}

	public function get_disconnect_url( $provider, $url ) {
		$url = add_query_arg( array( 'wp-oauth2' => $provider, 'action' => 'disconnect' ), $url );

		return $url;
	}

	public function disconnect( $provider ) {
		$this->token_manager->remove_access_token( $provider );
	}

	public function is_authorized( $provider ) {
		$token = $this->token_manager->get_access_token( $provider );

		return (bool) $token;
	}

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * class via the `new` operator from outside of this class.
	 */
	protected function __construct() {
	}

	/**
	 * As this class is a singleton it should not be clone-able
	 */
	protected function __clone() {
	}

	/**
	 * As this class is a singleton it should not be able to be unserialized
	 */
	public function __wakeup() {
	}

	/**
	 * Set logger
	 *
	 * @param NfLogger $logger
	 * @return WPOAuth2
	 */
	public function setLogger(NfLogger $logger): WPOAuth2
	{
		$this->logger = $logger;

		return $this;
	}

	/**
	 * Get the logger
	 *
	 * @return NfLogger
	 */
	protected function getLogger( ): NfLogger
	{
		if(is_null($this->logger)){
			// fallback to empty logger
			$this->logger = new Logger();
		}

		return $this->logger;
	}
}