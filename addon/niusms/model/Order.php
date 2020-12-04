<?php
/**
 * NiuShop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 */

namespace addon\niusms\model;

use app\model\BaseModel;

/**
 * 牛云短信
 */
class Order extends BaseModel
{
    private $api = "https://www.niushop.com/api";

    /**
     * 创建短信订单
     * @param $data
     * @return mixed
     */
    public function createSmsOrder($data)
    {
        $url = $this->api . '/smsorder/createSmsOrder';
        $res = $this->httpPost($url, $data);
        return $res;
    }

    /**
     * 订单计算
     * @param $data
     * @return mixed
     */
    public function calculate($data)
    {
        $url = $this->api . '/smsorder/calculate';
        $res = $this->httpPost($url, $data);
        return $res;
    }

    /**
     * 获取订单信息
     * @param $data
     * @return mixed
     */
    public function getSmsOrderInfo($data)
    {
        $url = $this->api . '/smsorder/getSmsOrderInfo';
        $res = $this->httpPost($url, $data);
        return $res;
    }

    /**
     * 获取短信充值订单列表
     * @param $data
     * @return mixed
     */
    public function getSmsOrderList($data)
    {
        $url = $this->api . '/smsorder/getSmsOrderList';
        $res = $this->httpPost($url, $data);
        return $res;
    }

    /**
     * 待付款订单
     * @param $data
     * @return mixed
     */
    public function payment($data)
    {
        $url = $this->api . '/smsorder/payment';
        $res = $this->httpPost($url, $data);
        return $res;
    }

    /**
     * 关闭待付款订单
     * @param $out_trade_no
     * @return mixed
     */
    public function cronCloseSmsPayment($out_trade_no)
    {
        $url = $this->api . '/smsorder/closeSmsOrder';
        $res = $this->httpPost($url, [ 'out_trade_no' => $out_trade_no ]);
        return $res;
    }

    /**
     * 数据请求
     * @param $url
     * @param $data
     * @return array|bool|string
     */
    public function httpPost($url, $data)
    {
        // 模拟提交数据函数
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER[ 'HTTP_USER_AGENT' ]); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_POST, true); // 发送一个常规的Post请求

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_HEADER, false); //开启header
        //类型为json
        $result = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            return $this->error('', '系统错误，请联系平台进行处理');
        }
        curl_close($curl); // 关键CURL会话
        $return = json_decode($result, true); // 返回数据
        if (!empty($return)) {
            if ($return[ 'code' ] < 0) {
                return $this->error($return[ 'code' ], $return[ 'message' ]);
            } else {
                return $this->success($return[ 'data' ]);
            }
        } else {
            return $result;
        }
    }

}
