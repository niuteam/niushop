<?php
namespace extend;

class RSA
{
    /**
     * 生成秘钥
     */
    public static function getSecretKey(){
        $config = [
            'digest_alg' => "sha512",
            'private_key_bits' => 4096,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];
        
        $resources = openssl_pkey_new($config);
        openssl_pkey_export($resources, $private_key, null, $config);
        $public_key = openssl_pkey_get_details($resources);
        
        if (empty($private_key) || empty($public_key)) return error(-1, 'API_SECRET_KEY_CREATE_ERROR');
        
        $data = [
            'public_key' => $public_key['key'],
            'private_key' => $private_key 
        ];
        
        return success(0, '', $data);
    }
    
    /**
     * 私钥解密
     * @param string $encrypted
     * @param string $private_key
     */
    public static function decrypt($encrypted, $private_key, $public_key){
        $private_check = openssl_pkey_get_private($private_key);
        if (!$private_check) return error(-1, 'PRIVATE_KEY_ERROR');
        $public_check = openssl_pkey_get_public($public_key);
        if (!$public_check) return error(-1, 'PUBLIC_KEY_ERROR');
        
        $details = openssl_pkey_get_details($public_check);
        $bits = $details['bits'];
        
        $decrypted = '';
        $base64_decoded = self::safe_base64_decode($encrypted);
        // 分段解密
        $parts = str_split($base64_decoded, ($bits / 8));
        foreach ($parts as $part) {
            $decrypted_temp = '';
            $decrypt_res = openssl_private_decrypt($part, $decrypted_temp, $private_key);
            if (!$decrypt_res) return error(-1, 'DECRYPT_FAIL');
            $decrypted .= $decrypted_temp;
        }
        
        return success(0, '', $decrypted);
    }
    
    /**
     * base64解码
     * @param unknown $string
     */
    private static function safe_base64_decode($string){
        $base_64 = str_replace(array( '-', '_' ), array( '+', '/' ), $string);
        return base64_decode($base_64);
    }
}