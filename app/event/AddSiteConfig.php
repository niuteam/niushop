<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\event;

use app\model\goods\Config;

/**
 * 增加默认配置项
 */
class AddSiteConfig
{

    public function handle($param)
    {
        if (!empty($param['site_id'])) {
            $document_model = new Config();
            $content        = '<p style="white-space: normal;"><span style="color: rgb(255, 0, 0);"><strong>权利声明：</strong></span><br/>商城上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是商城重要的经营资源，未经许可，禁止非法转载使用。</p><p style="white-space: normal;"><span style="color: rgb(63, 63, 63);"><strong>注：</strong></span>本站商品信息均来自于合作方，其真实性、准确性和合法性由信息拥有者（合作方）负责。本站不提供任何保证，并不承担任何法律责任。</p><p style="white-space: normal;"><br/><span style="color: rgb(255, 0, 0);"><strong>价格说明：</strong></span><br/></p><p style="white-space: normal;"><span style="color: rgb(63, 63, 63);"><strong>价格：</strong></span>价格为商品的销售价，是您最终决定是否购买商品的依据。</p><p style="white-space: normal;"><span style="color: rgb(63, 63, 63);"><strong>划线价：</strong></span>商品展示的划横线价格为参考价，该价格可能是品牌专柜标价、商品吊牌价或由品牌供应商提供的正品零售价（如厂商指导价、建议零售价等）或该商品在商城平台上曾经展示过的销售价；由于地区、时间的差异性和市场行情波动，品牌专柜标价、商品吊牌价等可能会与您购物时展示的不一致，该价格仅供您参考。</p><p style="white-space: normal;"><span style="color: rgb(63, 63, 63);"><strong>折扣：</strong></span>如无特殊说明，折扣指销售商在原价、或划线价（如品牌专柜标价、商品吊牌价、厂商指导价、厂商建议零售价）等某一价格基础上计算出的优惠比例或优惠金额；如有疑问，您可在购买前联系销售商进行咨询。</p><p style="white-space: normal;"><span style="color: rgb(63, 63, 63);"><strong>异常问题：</strong></span>商品促销信息以商品详情页“促销”栏中的信息为准；商品的具体售价以订单结算页价格为准；如您发现活动商品售价或促销信息有异常，建议购买前先联系销售商咨询。</p>';
            $res            = $document_model->setAfterSaleConfig('售后保障协议', $content, $param['site_id']);
            return $res;
        }

    }

}