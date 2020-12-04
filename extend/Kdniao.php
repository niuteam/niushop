<?php
namespace extend;


class Kdniao
{
    private $EBusinessID; // 授权key
    private $AppKey; // 快递100分配的公司编码
    private $order_url = 'https://api.kdniao.com/api/Eorderservice'; //电子面单url
    private $print_url = 'https://www.kdniao.com/External/PrintOrder.aspx'; //电子面单批量打印url

    public function __construct($config){
        $this->EBusinessID = $config["EBusinessID"];
        $this->AppKey = $config["AppKey"];
    }

    /**
     * Json方式 调用电子面单接口
     */
    public function submitEOrder($requestData)
    {
        $jsonParam = json_encode($requestData, JSON_UNESCAPED_UNICODE);
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1007',
            'RequestData' => urlencode($jsonParam),
            'DataType' => '2',
        );

        $datas['DataSign'] = $this->encrypt($jsonParam, $this->AppKey);

        $result = $this->sendPost($this->order_url, $datas);

        return $result;
    }

    /**
     * 批量打印电子面单
     * @param $data
     */
    public function build_form($data)
    {
        // OrderCode:需要打印的订单号，和调用快递鸟电子面单的订单号一致，PortName：本地打印机名称，请参考使用手册设置打印机名称。支持多打印机同时打印。
//        $request_data = '[{"OrderCode":"2020051919550001","PortName":"HP LaserJet Pro MFP M125-M126 PCLmS"},{"OrderCode":"2020052009440001","PortName":"HP LaserJet Pro MFP M125-M126 PCLmS"}]';
        $request_data_encode = urlencode($data);

        // 如果报数据验证失败 请检查此处get_ip()返回的IP 是否与调用打印的【客户机】IP一致 可以写死IP尝试
        $data_sign = $this->encrypt($this->get_ip() . $data, APIKey);
        $is_priview = '0';  //是否预览，0-不预览 1-预览

        // 组装表单
        $form = '<form id="form1" method="POST" action="' . $this->print_url . '"><input type="text" name="RequestData" value="' . $request_data_encode . '"/><input type="text" name="EBusinessID" value="' . $this->EBusinessID . '"/><input type="text" name="DataSign" value="' . $data_sign . '"/><input type="text" name="IsPriview" value="' . $is_priview . '"/></form><script>form1.submit();</script>';
        print_r($form);
    }

    /**
     * post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    public function sendPost($url, $datas)
    {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if (empty($url_info['port'])) {
            $url_info['port'] = 80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader .= "Host:" . $url_info['host'] . "\r\n";
        $httpheader .= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader .= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader .= "Connection:close\r\n\r\n";
        $httpheader .= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets .= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }
    
    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    public function encrypt($data, $appkey)
    {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

    /**************************************************************
     *
     *  使用特定function对数组中所有元素做处理
     * @param  string &$array 要处理的字符串
     * @param  string $function 要执行的函数
     * @return boolean $apply_to_keys_also     是否也应用到key上
     * @access public
     *
     *************************************************************/
    public function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        if (++$recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }

            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter--;
    }


    /**************************************************************
     *
     *  将数组转换为JSON字符串（兼容中文）
     * @param  array $array 要转换的数组
     * @return string      转换得到的json字符串
     * @access public
     *
     *************************************************************/
    public function JSON($array)
    {
        $this->arrayRecursive($array, 'urlencode', true);
        $json = json_encode($array);
        return urldecode($json);
    }


    /**
     * 判断是否为内网IP
     * @param string IP
     * @return boolean 是否内网IP
     */
    public function is_private_ip($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }

    /**
     * 获取客户端IP(非用户服务器IP)
     * @return string 客户端IP
     */
    public function get_ip()
    {
        $ip = null;

        // 获取客户端IP
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // 判断是否获取到 如果获取到本地IP地址 需要从外网获取本机地址
        if ($ip == '' || $this->is_private_ip($ip) == false) {

            die('无法正确获取当前机器IP');

        } else {
            return trim(strip_tags($ip));
        }
    }


}