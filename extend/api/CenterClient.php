<?php

namespace extend\api;

/**
 * 授权中心
 * 创建时间：2018年12月7日18:21:24
 * @author Administrator
 *
 */
class CenterClient
{
	
	// 请求地址
	private $request_url = "http://localhost/niucenter/?s=/niucenter/api/";
	
	
	// 平台标识
	private $name = "NIUCLOUD";
	
	private $app_key = "b61d312d32976df698ca34d098d23a9d";
	
	private $public_key;
	private $private_key;
	private $key_len;
	
	// 参数
	private $params = array();
	
	public function __construct()
	{
		
		$this->initRSA();
		$this->params['params'] = [
			'name' => $this->name,
			'app_key' => $this->app_key
		];
	}
	
	/**
	 * POST请求
	 * 创建时间：2018年12月8日14:49:41
	 * @param unknown $method 请求控制器/方法
	 * @param unknown $params 参数
	 * @return unknown
	 */
	public function post($method, $params = [])
	{
		$this->request_url .= $method;
		$publicEncrypt = $this->publicEncrypt(json_encode($params));
		$this->params['params']['public_encrypt'] = $publicEncrypt;
		$res = HttpClient::post($this->request_url, $this->params);
		if (!empty($res)) {
			
			//对返回数据进行解密，解密需要一些时间，暂时去掉
//             $decrypted = $this->publicDecrypt($res);
//             if(!empty($decrypted)){
//                 $res = json_decode($decrypted, true);
//             }else{
//                 $res = json_decode($res, true);
//             }
			$res = json_decode($res, true);
			return $res;
		} else {
			return json_encode(error("接口发生错误"));
		}
	}
	
	/**
	 * 初始化公钥 长度
	 * 创建时间：2018年12月8日12:33:44
	 *
	 */
	private function initRSA()
	{
		$public_key = ADDON_APP_PATH . '/Niushop/rsa_public_key.pem';
		$public_key_content = file_get_contents($public_key);
		$this->public_key = openssl_pkey_get_public($public_key_content);
		$this->key_len = openssl_pkey_get_details($this->public_key)['bits'];
	}
	
	/*
	 * 公钥加密
	 */
	public function publicEncrypt($data)
	{
		$encrypted = '';
		$part_len = $this->key_len / 8 - 11;
		$parts = str_split($data, $part_len);
		
		//分段加密
		foreach ($parts as $part) {
			$encrypted_temp = '';
			openssl_public_encrypt($part, $encrypted_temp, $this->public_key);
			$encrypted .= $encrypted_temp;
		}
		
		return $this->url_safe_base64_encode($encrypted);
	}
	
	/*
	 * 公钥解密
	 */
	public function publicDecrypt($encrypted)
	{
		$decrypted = "";
		$part_len = $this->key_len / 8;
		$base64_decoded = $this->url_safe_base64_decode($encrypted);
		$parts = str_split($base64_decoded, $part_len);
		
		foreach ($parts as $part) {
			$decrypted_temp = '';
			openssl_public_decrypt($part, $decrypted_temp, $this->public_key);
			$decrypted .= $decrypted_temp;
		}
		return $decrypted;
	}
	
	function url_safe_base64_encode($data)
	{
		return str_replace(array( '+', '/', '=' ), array( '-', '_', '' ), base64_encode($data));
	}
	
	function url_safe_base64_decode($data)
	{
		$base_64 = str_replace(array( '-', '_' ), array( '+', '/' ), $data);
		return base64_decode($base_64);
	}
}