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

use addon\wechat\model\Replay as ReplayModel;

/**
 * 微信回复控制器
 */
class Replay extends BaseWechat
{
    /**
     * 回复设置--关键字自动回复
     */
    public function replay()
    {

        if (request()->isAjax()) {
            $page        = input('page', 1);
            $limit       = input('limit', PAGE_LIST_ROWS);
            $rule_type   = input('rule_type', '');
            $search_text = input('search_text', '');

            $condition = array(
                ['rule_type', "=", $rule_type],
                ['site_id', '=', $this->site_id]
            );

            $condition[] = [
                'rule_name', 'like', '%' . $search_text . '%'
            ];

            $order        = 'create_time desc';
            $replay_model = new ReplayModel();
            $list         = $replay_model->getReplayPageList($condition, $page, $limit, $order);
            foreach ($list['data']['list'] as $k => $v) {
                $list['data']['list'][$k]['key_list']    = $v['keywords_json'] != false ? json_decode($v['keywords_json']) : [];
                $list['data']['list'][$k]['replay_list'] = $v['replay_json'] != false ? json_decode($v['replay_json']) : [];
            }
            return $list;
        } else {

            $this->assign('link_list', []);//链接
            return $this->fetch('replay/replay', [], $this->replace);
        }
    }

    /**
     * 添加关键字回复
     */
    public function addOrEditRule()
    {
        $replay_model = new ReplayModel();
        if (request()->isAjax()) {
            $rule_name = input('rule_name', '');
            $rule_id   = input('rule_id', 0);
            if ($rule_id > 0) {
                $data = [
                    'rule_name'   => $rule_name,
                    'modify_time' => time()
                ];
                $res  = $replay_model->editRule($data, [['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
                return $res;
            } else {
                $data = [
                    'rule_name'     => $rule_name,
                    'rule_type'     => 'KEYWORDS',
                    'keywords_json' => '',
                    'replay_json'   => '',
                    'create_time'   => time(),
                    'site_id'       => $this->site_id
                ];
                $res  = $replay_model->addRule($data);
                return $res;
            }

        }
    }

    /**
     * 添加关键词回复
     */
    public function editKeywords()
    {
        $replay_model = new ReplayModel();
        if (request()->isAjax()) {
            $rule_id       = input('rule_id', '');
            $info_result   = $replay_model->getRuleInfo([['rule_id', "=", $rule_id]]);
            $info          = $info_result["data"];
            $keywords_name = input('keywords_name', '');
            $keywords_type = input('keywords_type', 0);
            $key_id        = input('key_id', -1);
            if ($info['keywords_json']) {
                $data = json_decode($info['keywords_json']);
                if ($key_id > -1) {
                    $data[$key_id] = [
                        'keywords_name' => $keywords_name,
                        'keywords_type' => $keywords_type
                    ];
                } else {
                    array_push($data, [
                        'keywords_name' => $keywords_name,
                        'keywords_type' => $keywords_type
                    ]);
                }
                $data = json_encode($data);
            } else {
                $data = [
                    [
                        'keywords_name' => $keywords_name,
                        'keywords_type' => $keywords_type
                    ]
                ];
                $data = json_encode($data);
            }
            $data = [
                'keywords_json' => $data,
                'modify_time'   => time()
            ];
            $res  = $replay_model->editRule($data, [['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            return $res;
        }
    }

    /**
     * 删除关键字回复
     */
    public function deleteRule()
    {
        if (request()->isAjax()) {
            $rule_id      = input('rule_id', 0);
            $replay_model = new ReplayModel();
            $res          = $replay_model->deleteRule([['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            return $res;
        }
    }

    /**
     * 删除关键词数据
     */
    public function deleteKeywords()
    {
        $replay_model = new ReplayModel();
        if (request()->isAjax()) {
            $rule_id     = input('rule_id', '');
            $key_id      = input('key_id', '');
            $info_result = $replay_model->getRuleInfo([['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            $info        = $info_result["data"];
            if ($info['keywords_json']) {
                $data = json_decode($info['keywords_json']);
                array_splice($data, $key_id, 1);
                $data = json_encode($data);
            }
            $data = [
                'keywords_json' => $data,
            ];
            $res  = $replay_model->editRule($data, [['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            return $res;
        }
    }

    /**
     * 修改回复数据
     * @return mixed
     */
    public function editReplays()
    {
        $replay_model = new ReplayModel();
        if (request()->isAjax()) {
            $rule_id       = input('rule_id', '');
            $reply_content = input('reply_content', '');
            $media_id      = input('media_id', '');
            $key_id        = input('key_id', -1);
            $type          = input('type', '');
            $info_result   = $replay_model->getRuleInfo([['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            $info          = $info_result["data"];
            if ($info['replay_json']) {
                $data = json_decode($info['replay_json']);

                if ($key_id > -1) {
                    $data[$key_id] = [
                        'reply_content' => $reply_content,
                        'type'          => $type,
                    ];
                    if (!empty($media_id)) {
                        $data[$key_id]['media_id'] = $media_id;
                    }
                } else {
                    if (!empty($media_id)) {
                        array_push($data, [
                            'reply_content' => $reply_content,
                            'type'          => $type,
                            'media_id'      => $media_id
                        ]);
                    } else {
                        array_push($data, [
                            'reply_content' => $reply_content,
                            'type'          => $type,
                        ]);
                    }
                }
            } else {
                $data = [
                    [
                        'reply_content' => $reply_content,
                        'type'          => $type,
                    ]
                ];
                if (!empty($media_id)) {
                    $data[0]['media_id'] = $media_id;
                }
            }
            $data = json_encode($data);
            $data = [
                'replay_json' => $data,
                'modify_time' => time()
            ];
            $res  = $replay_model->editRule($data, [['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            return $res;
        }
    }

    /**
     * 删除回复数据
     */
    public function deleteReply()
    {
        $replay_model = new ReplayModel();
        if (request()->isAjax()) {
            $rule_id = input('rule_id', '');
            $key_id  = input('key_id', '');
            $info    = $replay_model->getRuleInfo([['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            $info    = $info['data'];
            if ($info['replay_json']) {
                $data = json_decode($info['replay_json']);
                array_splice($data, $key_id, 1);
                $data = json_encode($data);
            }
            $data = [
                'replay_json' => $data,
            ];
            $res  = $replay_model->editRule($data, [['rule_id', "=", $rule_id], ['site_id', "=", $this->site_id]]);
            return $res;
        }
    }

    /**
     * 关注后回复设置
     */
    public function afterAttention()
    {
        return $this->fetch('replay/aterAttention', [], $this->replace);
    }

    /**
     * 回复设置--关注后自动回复
     */
    public function follow()
    {
        if (request()->isAjax()) {
            $page         = input('page', 1);
            $pagesize     = input('limit', PAGE_LIST_ROWS);
            $rule_type    = input('rule_type', '');
            $condition    = array(
                'rule_type' => $rule_type,
                'site_id'   => $this->site_id
            );
            $order        = 'create_time desc';
            $replay_model = new ReplayModel();
            $list         = $replay_model->getReplayPageList($condition, $page, $pagesize, $order);
            foreach ($list['data']['list'] as $k => $v) {
                $list['data']['list'][$k]['key_list']    = $v['keywords_json'] != false ? json_decode($v['keywords_json']) : [];
                $list['data']['list'][$k]['replay_list'] = $v['replay_json'] != false ? json_decode($v['replay_json']) : [];
            }
            return $list;
        } else {
            $this->assign('link_list', []);//链接
            return $this->fetch('replay/follow', [], $this->replace);
        }
    }

}