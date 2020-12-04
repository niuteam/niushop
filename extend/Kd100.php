<?php
namespace extend;


class Kd100
{
    private $key; // 授权key
    private $customer; // 快递100分配的公司编码
    private $http_type;
    
    public function __construct($config){

        $this->key = $config["appkey"];
        $this->customer = $config["customer"];
        $this->http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    }
    
    /**
     * 查询物流轨迹企业版
     * @param unknown $express_no 物流公司编码
     * @param unknown $send_no 快递单号
     */
    public function getExpressTracesEnterpriseEdition($express_no, $send_no){
        $data = array();
        $data["customer"] = $this->customer;
        $data["param"] = '{"com" : "'.$express_no.'", "num" : "'.$send_no.'"}';
        $data["sign"] = md5($data["param"].$this->key.$data["customer"]);
        $data["sign"] = strtoupper($data["sign"]);
        // 测试地址仅可测试100单实际使用时使用“实际地址”
//         $url = $this->http_type."poll.kuaidi100.com/test/poll/query.do"; // 测试地址
        $url = $this->http_type."poll.kuaidi100.com/poll/query.do"; // 实际地址
        $data_url = "";
        foreach ($data as $k => $v)
        {
            $data_url .= "$k=".urlencode($v)."&";		//默认UTF-8编码格式
        }
        $data = substr($data_url, 0, -1);
        $result = $this->sendRequest($url, 2, $data);
        return $result;
    }
    
    
    /**
     * 发送请求
     * @param unknown $url
     * @param unknown $type 1免费版 2企业版
     * @param unknown $data
     */
    public function sendRequest($url, $type, $data = []){
        if (function_exists('curl_init') == 1){
            $curl = curl_init();
            curl_setopt ($curl, CURLOPT_URL, $url);
            curl_setopt ($curl, CURLOPT_HEADER,0);
            curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
            if(!empty($data)){
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt ($curl, CURLOPT_TIMEOUT,5);
            $result = curl_exec($curl);
            $result = json_decode($result, true);
            return $this->handleReturnResult($result);
        }else{
            return ["success" => false, "reason" => "curl扩展未开启"];
        }
    }
    
    /**
     * 处理返回数据
     * @param unknown $data
     */
    public function handleReturnResult($data){

        $result = array();
        // 处理100企业版返回数据
        if(isset($data["result"])){
            $result["success"] = false;
            $result["reason"] = $data["message"];
        }else{
            $result["success"] = true;
            $result["reason"] = $data["message"];
            $result["status"] = $data["state"];
            $result["status_name"] = $this->getStatusName($data["state"]);
            $result["shipper_code"] = $data["com"];
            $result["logistic_code"] = $data["nu"];
            $list = [];
            foreach($data["data"] as $k => $v){
                $list[] = array(
                    "datetime" => $v["ftime"],
                    "remark" => $v["context"],
                );
            }
            $result["list"] = $list;
        }

        return $result;
    }

    /**
     * 物流跟踪状态
     * @param $state
     */
    public function getStatusName($status){
        $data = array(
            0 => "在途",
            1 => "揽收",
            2 => "疑难",
            3 => "签收",
            4 => "退签",
            5 => "派件",
            6 => "退回",
        );
        $status_name = isset($data[$status]) ? $data[$status] : '';
        return $status_name;
    }
}