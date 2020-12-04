<?php

namespace extend\api;

use think\Log;


class WebClient
{
	private $version = '1.0';
	
	private $request_url;
	private $app_key;
	private $app_secret;
	private $format = 'json';
	private $sign_method = 'md5';
	
	public function __construct($app_key, $app_secret)
	{
		if ('' == $app_key || '' == $app_secret) throw new \Exception('app_key 和 app_secret 不能为空');
		
		$this->app_key = $app_key;
		$this->app_secret = $app_secret;
		$this->request_url = 'http://localhost/ncweb/auth.php';
	}
	
	public function get($method, $params = array(), $api_version = '1.0')
	{
		return $this->parse_response(
			HttpClient::get($this->url($method, $api_version), $this->build_request_params($method, $params))
		);
	}
	
	public function post($method, $params = array(), $files = array(), $api_version = '1.0')
	{
		
		$this->version = $api_version;
		return $this->parse_response(
			HttpClient::post($this->url($method, $api_version), $this->build_request_params($method, $params), $files)
		);
	}
	
	public function url($method, $api_version = '1.0')
	{
		$url = $this->request_url;
		return $url;
	}
	
	public function set_format($format)
	{
		if (!in_array($format, ApiProtocol::allowed_format()))
			throw new \Exception('设置的数据格式错误');
		
		$this->format = $format;
		
		return $this;
	}
	
	public function set_sign_method($method)
	{
		if (!in_array($method, ApiProtocol::allowed_sign_methods()))
			throw new \Exception('设置的签名方法错误');
		
		$this->sign_method = $method;
		
		return $this;
	}
	
	private function parse_response($response_data)
	{
		$data = json_decode($response_data, true);
		return $data;
	}
	
	private function build_request_params($method, $api_params)
	{
		if (!is_array($api_params)) $api_params = array();
		$pairs = $this->get_common_params($method);
		foreach ($api_params as $k => $v) {
			if (isset($pairs[ $k ])) throw new \Exception('参数名冲突');
			$pairs[ $k ] = $v;
		}
		$pairs[ ApiProtocol::SIGN_KEY ] = ApiProtocol::sign($this->app_secret, $pairs, $this->sign_method);
		return $pairs;
	}
	
	private function get_common_params($method)
	{
		$params = array();
		$params[ ApiProtocol::APP_ID_KEY ] = $this->app_key;
		$params[ ApiProtocol::METHOD_KEY ] = $method;
		$params[ ApiProtocol::TIMESTAMP_KEY ] = date('Y-m-d H:i:s');
		$params[ ApiProtocol::FORMAT_KEY ] = $this->format;
		$params[ ApiProtocol::SIGN_METHOD_KEY ] = $this->sign_method;
		$params[ ApiProtocol::VERSION_KEY ] = $this->version;
		return $params;
	}
}