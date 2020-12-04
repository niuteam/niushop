<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+
namespace addon\wechat\shop\controller;

use addon\wechat\model\Wechat as WechatModel;
use addon\wechat\model\Fans as FansModel;

/**
 * 微信粉丝控制器
 */
class Fans extends BaseWechat
{

    /**
     * 粉丝列表
     * @return \multitype
     */
    public function lists()
    {
        $fans_model = new FansModel();
        if (request()->isAjax()) {
            $page         = input('page', 1);
            $limit        = input('page_size', PAGE_LIST_ROWS);
            $is_subscribe = input('is_subscribe', '');//关注
            $nickname     = input('nickname', '');//粉丝名称
            $start_time   = input('start_time', '');
            $end_time     = input('end_time', '');
            $condition[]  = ['site_id', '=', $this->site_id];
            if ($is_subscribe !== '') {
                $condition[] = ['is_subscribe', "=", $is_subscribe];
            }
            if ($nickname != '') {
                $condition[] = ['nickname', 'like', '%' . $nickname . '%'];
            }
            if (!empty($start_time) && empty($end_time)) {
                $condition[] = ["subscribe_time", ">=", date_to_time($start_time)];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = ["subscribe_time", "<=", date_to_time($end_time)];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = ['subscribe_time', 'between', [date_to_time($start_time), date_to_time($end_time)]];
            }
            $fans_list = $fans_model->getFansPageList($condition, $page, $limit);
            return $fans_list;
        }

        $tag_list = $fans_model->getFansTagList();
        $this->assign('tag_list', $tag_list['data']);

        return $this->fetch('fans/lists', [], $this->replace);
    }

    /**
     * 更新粉丝信息
     */
    public function syncWechatFans()
    {
        $page_index   = input('page', 0);
        $page_size    = input('limit', PAGE_LIST_ROWS);
        $wechat_model = new WechatModel($this->site_id);
        if ($page_index == 0) {
            //建立连接，同时获取所有用户openid  拉去粉丝信息列表(一次拉取调用最多拉取10000个关注者的OpenID，可以通过多次拉取的方式来满足需求。)
            $openid_list = [];
            $is_continue = true;
            $next_openid = null;
            do {
                $item_result = $wechat_model->user($next_openid);

                if ($item_result["code"] < 0)
                    return $item_result;

                if(empty($item_result['data']['data'])){
                    return success(0, '公众号暂无粉丝');
                }

                $next_openid = $item_result["data"]["next_openid"];
                $openid_item = $item_result["data"]['data']["openid"];
                if (empty($openid_item)) {
                    $is_continue = false;
                } else {
                    $is_continue = false;
                    foreach ($openid_item as $k => $v) {
                        $openid_list[] = $v;
                    }
                }
            } while ($is_continue);

            //将粉丝列表存入session
            session('wechat_openid_list', $openid_list);
            $total = count($openid_list);
            if ($openid_list % $page_size == 0) {
                $page_count = $total / $page_size;
            } else {
                $page_count = (int)($total / $page_size) + 1;
            }
            $data = array(
                'total'      => $total,
                'page_count' => $page_count,
            );
            return success(0, '', $data);

        } else {
            //对应页数更新用户粉丝信息
            $openid_list = session('wechat_openid_list');
            if (empty($openid_list)) {
                return error();
            }

            $start                 = ($page_index - 1) * $page_size;
            $page_fans_openid_list = array_slice($openid_list, $start, $page_size);

            if (empty($page_fans_openid_list)) {
                return error();
            }

            $fans_model = new FansModel();

            $result = $wechat_model->selectUser($page_fans_openid_list);
            if ($result['data'] && $result['data']['user_info_list']) {
                foreach ($result['data']['user_info_list'] as $k => $v) {
                    $nickname_decode = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $v['nickname']);
                    $nickname        = preg_replace_callback('/./u',
                        function (array $match) {
                            return strlen($match[0]) >= 4 ? '' : $match[0];
                        },
                        $v['nickname']);
                    $add_data        = [
                        'site_id'          => $this->site_id,
                        'nickname'         => $nickname,
                        'nickname_decode'  => $nickname_decode,
                        'headimgurl'       => $v['headimgurl'],
                        'sex'              => $v['sex'],
                        'language'         => $v['language'],
                        'country'          => $v['country'],
                        'province'         => $v['province'],
                        'city'             => $v['city'],
                        'openid'           => $v['openid'],
                        'unionid'          => $v['unionid'] ?? '',
                        'groupid'          => '',
                        'is_subscribe'     => 1,
                        'remark'           => $v['remark'],
                        'subscribe_time'   => $v['subscribe_time'] ?? 0,
                        'subscribe_scene'  => $v['subscribe_scene'] ?? 0,
                        'unsubscribe_time' => $v['unsubscribe_time'] ?? 0,
                        'update_date'      => time()
                    ];
                    $info            = $fans_model->getFansInfo(['openid' => $v['openid'], 'site_id' => $this->site_id], 'openid');
                    if (!empty($info['data'])) {
                        $fans_model->editFans($add_data, [['openid', '=', $v['openid']], ['site_id', '=', $this->site_id]]);
                    } else {
                        $fans_model->addFans($add_data);
                    }
                }
            }

            return $result;
        }
    }

    /**
     * 微信粉丝标签
     */
    public function fansTagList()
    {
        if (request()->isAjax()) {
            $fans_model = new FansModel();
            $page       = input('page', 1);
            $limit      = input('limit', PAGE_LIST_ROWS);
            $condition  = [];
            $list       = $fans_model->getFansTagPageList($condition, $page, $limit);
            return $list;
        } else {
            return $this->fetch('fans/fans_tag_list');
        }

    }

    /**
     * 为微信粉丝批量打标签
     */
    public function batchtagging()
    {
        if (request()->isAjax()) {
            $fans_model = new FansModel();
            $tagids     = input('tag_id', '');
            $openids    = input('openid', '');
            if (!empty($openids)) {
                $tag_id_list = explode(',', $tagids);
                $openid_list = explode(',', $openids);
                $data        = [
                    'tag_id_list' => $tag_id_list,
                    'openid_list' => $openid_list
                ];
                $res         = $fans_model->batchtagging($data);
                return $res;
            }
        }
    }

    /**
     * 为微信粉丝打标签
     */
    public function fansTagging()
    {
        if (request()->isAjax()) {
            $fans_model        = new FansModel();
            $openid            = input('openid', '');
            $tagid_list        = input('tagid_list', '');
            $cancel_tagid_list = input('cancel_tagid_list', '');
            if (!empty($openid)) {
                $tagid_list_arr        = !empty($tagid_list) ? explode(',', $tagid_list) : [];
                $cancel_tagid_list_arr = !empty($cancel_tagid_list) ? explode(',', $cancel_tagid_list) : [];
                $data                  = [
                    'tag_id_list' => $tagid_list_arr,
                    'openid_list' => [$openid]
                ];
                $res                   = $fans_model->batchtagging($data);//批量增加标签
                $data['tag_id_list']   = $cancel_tagid_list_arr;
                $fans_model->batchUnTagging($data);//批量减少标签
                return $res;
            }
        }
    }

    /**
     * 添加标签
     * @return multitype:string
     */
    public function addFansTag()
    {
        if (request()->isAjax()) {
            $fans_model = new FansModel();
            $tag_name   = input('tag_name', '');
            if (!empty($tag_name)) {
                $data           = [
                    'tag_name' => $tag_name,
                ];
                $data["tags"]   = time();
                $data["tag_id"] = time();
                $res            = $fans_model->addFansTag($data);
                return $res;
            }
        }
    }

    /**
     * 编辑标签
     */
    public function editFansTag()
    {
        if (request()->isAjax()) {
            $fans_model = new FansModel();
            $id         = input('id', '');
            $tag_name   = input('tag_name', '');
            if (!empty($tag_name)) {
                $data      = [
                    'tag_name' => $tag_name,
                ];
                $condition = array(
                    ["id", "=", $id]
                );
                $res       = $fans_model->editFansTag($data, $condition);
                return $res;
            } else {
                return error("", "标签名称不可为空!");
            }
        }
    }

    /**
     * 删除标签
     */
    public function deleteFansTag()
    {
        if (request()->isAjax()) {
            $fans_model = new FansModel();
            $id         = input('id', '');
            $condition  = [
                ['id', "=", $id],
            ];
            $res        = $fans_model->deleteFansTag($condition);
            return $res;

        }
    }

    /**
     * 同步粉丝标签
     */
    public function syncFansTag()
    {
        if (request()->isAjax()) {
            $fans_model = new FansModel();
            $res        = $fans_model->syncFansTag();
            return $res;
        }
    }
}