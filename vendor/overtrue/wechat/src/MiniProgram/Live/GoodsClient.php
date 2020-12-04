<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\MiniProgram\Live;

use EasyWeChat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class GoodsClient extends BaseClient
{
    /**
     * 商品添加并提审
     * @param $param
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add($param) {
        return $this->httpPostJson('wxaapi/broadcast/goods/add', $param);
    }

    /**
     * 撤回审核
     * @param $param
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function resetAudit($param) {
        return $this->httpPostJson('wxaapi/broadcast/goods/resetaudit', $param);
    }

    /**
     * 重新提交审核
     * @param $param
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function audit($param) {
        return $this->httpPostJson('wxaapi/broadcast/goods/audit', $param);
    }

    /**
     * 删除商品
     * @param $param
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($param) {
        return $this->httpPostJson('wxaapi/broadcast/goods/delete', $param);
    }

    /**
     * 更新商品
     * @param $param
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($param) {
        return $this->httpPostJson('wxaapi/broadcast/goods/update', $param);
    }

    /**
     * 获取商品状态
     * @param $param
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStatus($param) {
        return $this->httpPostJson('wxa/business/getgoodswarehouse', $param);
    }

    /**
     * 获取商品列表
     * @param $param
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGoodsList($param) {
        return $this->httpGet('wxaapi/broadcast/goods/getapproved', $param);
    }
}
