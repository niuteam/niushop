<?php
namespace extend;


class Kdbird
{
    private $EBusinessID; // 授权key
    private $AppKey; // 快递100分配的公司编码
    private $url;

    public function __construct($config){
        $this->EBusinessID = $config["EBusinessID"];
        $this->AppKey = $config["AppKey"];
        $this->url ='http://api.kdniao.com/Ebusiness/EbusinessOrderHandle.aspx';
    }

    public function orderTracesSubByJson($shipper_code, $logistic_code){
        $requestData="{'ShipperCode':'".$shipper_code."',".
            "'LogisticCode':'". $logistic_code ."'}";
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);
        $result = $this->sendPost($this->url, $datas);
        //根据公司业务处理返回的信息......
        $result = json_decode($result, true);

        $res = [];
        if($result["Success"] == false){
            $res["success"] = false;
            $res["reason"] = $result["Reason"];
        }else{
            $list = [];
            if (!empty($result['Traces'])) {
                foreach ($result['Traces'] as $trace) {
                    $list[] = [
                        'datetime' => $trace['AcceptTime'],
                        'remark' => $trace['AcceptStation']
                    ];
                }
            }
            $res = [
                'success' => $result['Success'],
                'reason' => !empty($result['Reason']) ? $result['Reason'] : '',
                'status' => !empty($result['State']) ? $result['State'] : '',
                'status_name' => !empty($result['State']) ? $this->getStatusName($result['State']) : '',
                'shipper_code' => !empty($result['ShipperCode']) ? $result['ShipperCode']: '',
                'logistic_code' => !empty($result['LogisticCode']) ? $result['LogisticCode'] : '',
                'list' => $list
            ];
        }
        return $res;
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    public function sendPost($url, $datas) {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
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
            $gets.= fread($fd, 128);
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
    public function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

    /**
     * 物流跟踪状态
     * @param $state
     */
    public function getStatusName($status){
        $data = [
            0 => "无轨迹",
            1 => "揽收",
            2 => "途中",
            3 => "签收",
            4 => "退签",
        ];
        $status_name = isset($data[$status]) ? $data[$status] : '';
        return $status_name;
    }
}