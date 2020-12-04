
SET NAMES 'utf8';

--
--
--
DROP TABLE IF EXISTS addon;

--
--
--
DROP TABLE IF EXISTS addon_quick;

--
--
--
DROP TABLE IF EXISTS adv;

--
--
--
DROP TABLE IF EXISTS adv_position;

--
--
--
DROP TABLE IF EXISTS album;

--
--
--
DROP TABLE IF EXISTS album_pic;

--
--
--
DROP TABLE IF EXISTS area;

--
--
--
DROP TABLE IF EXISTS config;

--
--
--
DROP TABLE IF EXISTS cron;

--
--
--
DROP TABLE IF EXISTS cron_log;

--
--
--
DROP TABLE IF EXISTS div_template;

--
--
--
DROP TABLE IF EXISTS diy_view_temp;

--
--
--
DROP TABLE IF EXISTS diy_view_util;

--
--
--
DROP TABLE IF EXISTS document;

--
--
--
DROP TABLE IF EXISTS express_company;

--
--
--
DROP TABLE IF EXISTS express_company_template;

--
--
--
DROP TABLE IF EXISTS express_delivery_package;

--
--
--
DROP TABLE IF EXISTS express_electronicsheet;

--
--
--
DROP TABLE IF EXISTS express_template;

--
--
--
DROP TABLE IF EXISTS express_template_item;

--
--
--
DROP TABLE IF EXISTS fenxiao;

--
--
--
DROP TABLE IF EXISTS fenxiao_account;

--
--
--
DROP TABLE IF EXISTS fenxiao_apply;

--
--
--
DROP TABLE IF EXISTS fenxiao_goods;

--
--
--
DROP TABLE IF EXISTS fenxiao_goods_collect;

--
--
--
DROP TABLE IF EXISTS fenxiao_goods_sku;

--
--
--
DROP TABLE IF EXISTS fenxiao_level;

--
--
--
DROP TABLE IF EXISTS fenxiao_order;

--
--
--
DROP TABLE IF EXISTS fenxiao_withdraw;

--
--
--
DROP TABLE IF EXISTS goods;

--
--
--
DROP TABLE IF EXISTS goods_attribute;

--
--
--
DROP TABLE IF EXISTS goods_attribute_value;

--
--
--
DROP TABLE IF EXISTS goods_attr_class;

--
--
--
DROP TABLE IF EXISTS goods_browse;

--
--
--
DROP TABLE IF EXISTS goods_cart;

--
--
--
DROP TABLE IF EXISTS goods_category;

--
--
--
DROP TABLE IF EXISTS goods_collect;

--
--
--
DROP TABLE IF EXISTS goods_evaluate;

--
--
--
DROP TABLE IF EXISTS goods_label;

--
--
--
DROP TABLE IF EXISTS goods_service;

--
--
--
DROP TABLE IF EXISTS goods_sku;

--
--
--
DROP TABLE IF EXISTS goods_virtual;

--
--
--
DROP TABLE IF EXISTS `group`;

--
--
--
DROP TABLE IF EXISTS help;

--
--
--
DROP TABLE IF EXISTS help_class;

--
--
--
DROP TABLE IF EXISTS link;

--
--
--
DROP TABLE IF EXISTS `local`;

--
--
--
DROP TABLE IF EXISTS local_delivery_package;

--
--
--
DROP TABLE IF EXISTS member;

--
--
--
DROP TABLE IF EXISTS member_account;

--
--
--
DROP TABLE IF EXISTS member_address;

--
--
--
DROP TABLE IF EXISTS member_auth;

--
--
--
DROP TABLE IF EXISTS member_bank_account;

--
--
--
DROP TABLE IF EXISTS member_cancel;

--
--
--
DROP TABLE IF EXISTS member_cluster;

--
--
--
DROP TABLE IF EXISTS member_import_log;

--
--
--
DROP TABLE IF EXISTS member_import_record;

--
--
--
DROP TABLE IF EXISTS member_label;

--
--
--
DROP TABLE IF EXISTS member_level;

--
--
--
DROP TABLE IF EXISTS member_log;

--
--
--
DROP TABLE IF EXISTS member_recharge;

--
--
--
DROP TABLE IF EXISTS member_recharge_card;

--
--
--
DROP TABLE IF EXISTS member_recharge_order;

--
--
--
DROP TABLE IF EXISTS member_withdraw;

--
--
--
DROP TABLE IF EXISTS menu;

--
--
--
DROP TABLE IF EXISTS message;

--
--
--
DROP TABLE IF EXISTS message_email_records;

--
--
--
DROP TABLE IF EXISTS message_send_log;

--
--
--
DROP TABLE IF EXISTS message_sms_records;

--
--
--
DROP TABLE IF EXISTS message_template;

--
--
--
DROP TABLE IF EXISTS message_variable;

--
--
--
DROP TABLE IF EXISTS message_wechat_records;

--
--
--
DROP TABLE IF EXISTS notes;

--
--
--
DROP TABLE IF EXISTS notes_dianzan_record;

--
--
--
DROP TABLE IF EXISTS notes_group;

--
--
--
DROP TABLE IF EXISTS notice;

--
--
--
DROP TABLE IF EXISTS `order`;

--
--
--
DROP TABLE IF EXISTS order_export;

--
--
--
DROP TABLE IF EXISTS order_goods;

--
--
--
DROP TABLE IF EXISTS order_import_file;

--
--
--
DROP TABLE IF EXISTS order_import_file_log;

--
--
--
DROP TABLE IF EXISTS order_log;

--
--
--
DROP TABLE IF EXISTS order_promotion_detail;

--
--
--
DROP TABLE IF EXISTS order_refund_export;

--
--
--
DROP TABLE IF EXISTS order_refund_log;

--
--
--
DROP TABLE IF EXISTS pay;

--
--
--
DROP TABLE IF EXISTS pay_refund;

--
--
--
DROP TABLE IF EXISTS printer;

--
--
--
DROP TABLE IF EXISTS printer_template;

--
--
--
DROP TABLE IF EXISTS promotion_bargain;

--
--
--
DROP TABLE IF EXISTS promotion_bargain_goods;

--
--
--
DROP TABLE IF EXISTS promotion_bargain_launch;

--
--
--
DROP TABLE IF EXISTS promotion_bargain_record;

--
--
--
DROP TABLE IF EXISTS promotion_bundling;

--
--
--
DROP TABLE IF EXISTS promotion_bundling_goods;

--
--
--
DROP TABLE IF EXISTS promotion_coupon;

--
--
--
DROP TABLE IF EXISTS promotion_coupon_type;

--
--
--
DROP TABLE IF EXISTS promotion_discount;

--
--
--
DROP TABLE IF EXISTS promotion_discount_goods;

--
--
--
DROP TABLE IF EXISTS promotion_exchange;

--
--
--
DROP TABLE IF EXISTS promotion_exchange_goods;

--
--
--
DROP TABLE IF EXISTS promotion_exchange_order;

--
--
--
DROP TABLE IF EXISTS promotion_freeshipping;

--
--
--
DROP TABLE IF EXISTS promotion_games;

--
--
--
DROP TABLE IF EXISTS promotion_games_award;

--
--
--
DROP TABLE IF EXISTS promotion_games_draw_record;

--
--
--
DROP TABLE IF EXISTS promotion_groupbuy;

--
--
--
DROP TABLE IF EXISTS promotion_manjian;

--
--
--
DROP TABLE IF EXISTS promotion_manjian_goods;

--
--
--
DROP TABLE IF EXISTS promotion_mansong_record;

--
--
--
DROP TABLE IF EXISTS promotion_pintuan;

--
--
--
DROP TABLE IF EXISTS promotion_pintuan_goods;

--
--
--
DROP TABLE IF EXISTS promotion_pintuan_group;

--
--
--
DROP TABLE IF EXISTS promotion_pintuan_order;

--
--
--
DROP TABLE IF EXISTS promotion_present;

--
--
--
DROP TABLE IF EXISTS promotion_seckill;

--
--
--
DROP TABLE IF EXISTS promotion_seckill_goods;

--
--
--
DROP TABLE IF EXISTS promotion_seckill_time;

--
--
--
DROP TABLE IF EXISTS promotion_topic;

--
--
--
DROP TABLE IF EXISTS promotion_topic_goods;

--
--
--
DROP TABLE IF EXISTS servicer;

--
--
--
DROP TABLE IF EXISTS servicer_dialogue;

--
--
--
DROP TABLE IF EXISTS servicer_member;

--
--
--
DROP TABLE IF EXISTS shop;

--
--
--
DROP TABLE IF EXISTS shop_accept_message;

--
--
--
DROP TABLE IF EXISTS shop_address;

--
--
--
DROP TABLE IF EXISTS site;

--
--
--
DROP TABLE IF EXISTS site_diy_view;

--
--
--
DROP TABLE IF EXISTS sms_template;

--
--
--
DROP TABLE IF EXISTS stat_shop;

--
--
--
DROP TABLE IF EXISTS store;

--
--
--
DROP TABLE IF EXISTS store_goods;

--
--
--
DROP TABLE IF EXISTS store_goods_sku;

--
--
--
DROP TABLE IF EXISTS store_member;

--
--
--
DROP TABLE IF EXISTS store_settlement;

--
--
--
DROP TABLE IF EXISTS store_stock_import;

--
--
--
DROP TABLE IF EXISTS store_stock_import_log;

--
--
--
DROP TABLE IF EXISTS supplier;

--
--
--
DROP TABLE IF EXISTS sys_upgrade_log;

--
--
--
DROP TABLE IF EXISTS `user`;

--
--
--
DROP TABLE IF EXISTS user_log;

--
--
--
DROP TABLE IF EXISTS v3_upgrade_log;

--
--
--
DROP TABLE IF EXISTS verifier;

--
--
--
DROP TABLE IF EXISTS verify;

--
--
--
DROP TABLE IF EXISTS weapp_audit_record;

--
--
--
DROP TABLE IF EXISTS weapp_experiencer;

--
--
--
DROP TABLE IF EXISTS weapp_goods;

--
--
--
DROP TABLE IF EXISTS weapp_live_room;

--
--
--
DROP TABLE IF EXISTS wechat_fans;

--
--
--
DROP TABLE IF EXISTS wechat_fans_tag;

--
--
--
DROP TABLE IF EXISTS wechat_mass_recording;

--
--
--
DROP TABLE IF EXISTS wechat_media;

--
--
--
DROP TABLE IF EXISTS wechat_qrcode;

--
--
--
DROP TABLE IF EXISTS wechat_replay_rule;

--
-- `wechat_replay_rule`
--
CREATE TABLE wechat_replay_rule (
  rule_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  rule_name varchar(50) NOT NULL DEFAULT '' COMMENT '规则名称',
  rule_type varchar(255) NOT NULL DEFAULT 'KEYWORDS' COMMENT '规则类型KEYWORDS表示关键字,DEFAULT表示默认,AFTER表示关注后',
  keywords_json text DEFAULT NULL COMMENT '关键字json',
  replay_json text DEFAULT NULL COMMENT '回复内容json',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (rule_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信回复规则',
ROW_FORMAT = DYNAMIC;

--
-- `wechat_qrcode`
--
CREATE TABLE wechat_qrcode (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT '实例ID',
  background varchar(255) NOT NULL DEFAULT '' COMMENT '背景图片',
  nick_font_color varchar(255) NOT NULL DEFAULT '#000' COMMENT '昵称字体颜色',
  nick_font_size smallint(6) NOT NULL DEFAULT 12 COMMENT '昵称字体大小',
  is_logo_show smallint(6) NOT NULL DEFAULT 1 COMMENT 'logo是否显示',
  header_left varchar(6) NOT NULL DEFAULT '0px' COMMENT '头部左边距',
  header_top varchar(6) NOT NULL DEFAULT '0px' COMMENT '头部上边距',
  name_left varchar(6) NOT NULL DEFAULT '0px' COMMENT '昵称左边距',
  name_top varchar(6) NOT NULL DEFAULT '0px' COMMENT '昵称上边距',
  logo_left varchar(6) NOT NULL DEFAULT '0px' COMMENT 'logo左边距',
  logo_top varchar(6) NOT NULL DEFAULT '0px' COMMENT 'logo上边距',
  code_left varchar(6) NOT NULL DEFAULT '0px' COMMENT '二维码左边距',
  code_top varchar(6) NOT NULL DEFAULT '0px' COMMENT '二维码上边距',
  is_default tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否默认',
  is_remove tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否删除  0未删除 1删除',
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信推广二维码模板管理',
ROW_FORMAT = DYNAMIC;

--
-- `wechat_media`
--
CREATE TABLE wechat_media (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  type varchar(255) NOT NULL DEFAULT '' COMMENT '类型',
  value text DEFAULT NULL COMMENT '值',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  media_id varchar(70) NOT NULL DEFAULT '0' COMMENT '微信端返回的素材id',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信素材表',
ROW_FORMAT = DYNAMIC;

--
-- `wechat_mass_recording`
--
CREATE TABLE wechat_mass_recording (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  status int(50) NOT NULL DEFAULT 0 COMMENT '发送状态1-成功  0-失败',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  member_label varchar(255) NOT NULL DEFAULT '' COMMENT '发送群体（会员标签）',
  media_id varchar(255) NOT NULL DEFAULT '0' COMMENT '素材id',
  err varchar(1000) NOT NULL DEFAULT '' COMMENT '错误信息',
  content text DEFAULT NULL COMMENT '内容',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信消息记录',
ROW_FORMAT = DYNAMIC;

--
-- `wechat_fans_tag`
--
CREATE TABLE wechat_fans_tag (
  id int(11) NOT NULL AUTO_INCREMENT,
  tags varchar(3000) NOT NULL DEFAULT '' COMMENT '微信拉取到的标签内容 json格式',
  tag_id int(11) NOT NULL DEFAULT 0 COMMENT '标签id',
  tag_name varchar(50) NOT NULL DEFAULT '' COMMENT '标签名称',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信粉丝标签表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_wechat_fans_tag` on table `wechat_fans_tag`
--
ALTER TABLE wechat_fans_tag
ADD INDEX IDX_ns_wechat_fans_tag (tag_id);

--
-- `wechat_fans`
--
CREATE TABLE wechat_fans (
  fans_id int(11) NOT NULL AUTO_INCREMENT COMMENT '粉丝ID',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '昵称',
  nickname_decode varchar(255) NOT NULL DEFAULT '' COMMENT '昵称编码',
  headimgurl varchar(500) NOT NULL DEFAULT '' COMMENT '头像',
  sex smallint(6) NOT NULL DEFAULT 1 COMMENT '性别',
  language varchar(20) NOT NULL DEFAULT '' COMMENT '用户语言',
  country varchar(60) NOT NULL DEFAULT '' COMMENT '国家',
  province varchar(255) NOT NULL DEFAULT '' COMMENT '省',
  city varchar(255) NOT NULL DEFAULT '' COMMENT '城市',
  district varchar(255) NOT NULL DEFAULT '' COMMENT '行政区/县',
  openid varchar(255) NOT NULL DEFAULT '' COMMENT '用户的标识，对当前公众号唯一     用户的唯一身份ID',
  unionid varchar(255) NOT NULL DEFAULT '' COMMENT '粉丝unionid',
  groupid int(11) NOT NULL DEFAULT 0 COMMENT '粉丝所在组id',
  is_subscribe bigint(1) NOT NULL DEFAULT 1 COMMENT '是否订阅',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  subscribe_time int(11) NOT NULL DEFAULT 0 COMMENT '关注时间',
  subscribe_scene varchar(100) NOT NULL DEFAULT '' COMMENT '返回用户关注的渠道来源',
  unsubscribe_time int(11) NOT NULL DEFAULT 0 COMMENT '取消关注时间',
  update_date int(11) NOT NULL DEFAULT 0 COMMENT '粉丝信息最后更新时间',
  tagid_list varchar(255) NOT NULL DEFAULT '' COMMENT '用户被打上的标签ID列表',
  subscribe_scene_name varchar(50) NOT NULL DEFAULT '' COMMENT '返回用户关注的渠道来源名称',
  qr_scene varchar(255) NOT NULL DEFAULT '' COMMENT 'qr_scene',
  qr_scene_str varchar(255) NOT NULL DEFAULT '' COMMENT 'qr_scene_str',
  PRIMARY KEY (fans_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信粉丝列表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_weixin_fans` on table `wechat_fans`
--
ALTER TABLE wechat_fans
ADD INDEX IDX_ns_weixin_fans (unionid, openid);

--
-- `weapp_live_room`
--
CREATE TABLE weapp_live_room (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  roomid int(11) NOT NULL DEFAULT 0 COMMENT '直播间id',
  name varchar(255) NOT NULL DEFAULT '' COMMENT '房间名称',
  cover_img varchar(1000) NOT NULL DEFAULT '' COMMENT '房间背景封面',
  share_img varchar(1000) NOT NULL DEFAULT '' COMMENT '分享卡片图片',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '直播计划开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '直播计划结束时间',
  anchor_name varchar(255) NOT NULL DEFAULT '' COMMENT '主播昵称',
  goods text DEFAULT NULL COMMENT '直播间商品',
  live_status varchar(255) NOT NULL DEFAULT '' COMMENT 'live_status  101: 直播中, 102: 未开始, 103: 已结束, 104: 禁播, 105: 暂停中, 106: 异常, 107: 已过期',
  anchor_img varchar(1000) NOT NULL DEFAULT '' COMMENT '主播头像',
  banner varchar(1000) NOT NULL DEFAULT '' COMMENT '直播间横幅',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '小程序直播直播间表',
ROW_FORMAT = DYNAMIC;

--
-- `weapp_goods`
--
CREATE TABLE weapp_goods (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL COMMENT '站点id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '小程序商品库商品id 非商城商品id',
  name varchar(2000) NOT NULL DEFAULT '' COMMENT '商品名称',
  cover_img varchar(2000) NOT NULL DEFAULT '' COMMENT '商品图片链接',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品价格',
  status int(255) NOT NULL DEFAULT 0 COMMENT '商品状态，0：未审核。1：审核中，2：审核通过，3：审核驳回',
  url varchar(2000) NOT NULL DEFAULT '' COMMENT '商品小程序链接',
  audit_id int(11) NOT NULL DEFAULT 0 COMMENT '审核单id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品sku_id',
  third_party_tag int(1) NOT NULL DEFAULT 1 COMMENT '商品来源 0在小程序平台添加的商品  1/2通过api添加的商品',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
ROW_FORMAT = DYNAMIC;

--
-- `weapp_experiencer`
--
CREATE TABLE weapp_experiencer (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL COMMENT '站点id',
  wechatid varchar(255) NOT NULL COMMENT '微信号',
  userstr varchar(255) NOT NULL COMMENT '微信用户唯一值',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信小程序体验者',
ROW_FORMAT = DYNAMIC;

--
-- `weapp_audit_record`
--
CREATE TABLE weapp_audit_record (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT '审核id',
  site_id int(11) NOT NULL COMMENT '站点id',
  auditid varchar(255) NOT NULL COMMENT '审核编号',
  version varchar(255) NOT NULL COMMENT '版本号',
  status varchar(255) NOT NULL DEFAULT '0' COMMENT '审核状态 0审核中 1通过 -1失败 2延后 3已发布 4已撤回',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '审核提交时间',
  audit_time int(11) NOT NULL DEFAULT 0 COMMENT '审核通过时间',
  release_time int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  reason text DEFAULT NULL COMMENT '未通过和延后的原因',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '小程序审核记录表',
ROW_FORMAT = DYNAMIC;

--
-- `verify`
--
CREATE TABLE verify (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  verify_code varchar(255) NOT NULL DEFAULT '' COMMENT '核销码',
  verify_type varchar(255) NOT NULL DEFAULT '' COMMENT '核销类型',
  verify_type_name varchar(255) NOT NULL DEFAULT '' COMMENT '核销类型名称',
  verify_content_json varchar(5000) NOT NULL DEFAULT '' COMMENT '核销相关数据',
  verifier_id int(11) NOT NULL DEFAULT 0 COMMENT '核销员id',
  verifier_name varchar(255) NOT NULL DEFAULT '' COMMENT '核销员姓名',
  is_verify int(11) NOT NULL DEFAULT 0 COMMENT '是否已经核销',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  verify_time int(11) NOT NULL DEFAULT 0 COMMENT '核销时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '核销编码管理',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_verify_is_verify` on table `verify`
--
ALTER TABLE verify
ADD INDEX IDX_ns_verify_is_verify (is_verify);

--
-- `IDX_ns_verify_site_id` on table `verify`
--
ALTER TABLE verify
ADD INDEX IDX_ns_verify_site_id (site_id);

--
-- `IDX_ns_verify_verify_code` on table `verify`
--
ALTER TABLE verify
ADD INDEX IDX_ns_verify_verify_code (verify_code);

--
-- `IDX_ns_verify_verify_time` on table `verify`
--
ALTER TABLE verify
ADD INDEX IDX_ns_verify_verify_time (verify_time);

--
-- `IDX_ns_verify_verify_type` on table `verify`
--
ALTER TABLE verify
ADD INDEX IDX_ns_verify_verify_type (verify_type);

--
-- `verifier`
--
CREATE TABLE verifier (
  verifier_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '核销员id',
  verifier_name varchar(255) NOT NULL DEFAULT '' COMMENT '核销员姓名',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '商家id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '前台会员id',
  uid int(11) NOT NULL DEFAULT 0 COMMENT '后台用户id',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (verifier_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '核销员（商品或订单商品）',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_verifier_member_id` on table `verifier`
--
ALTER TABLE verifier
ADD INDEX IDX_ns_verifier_member_id (member_id);

--
-- `IDX_ns_verifier_site_id` on table `verifier`
--
ALTER TABLE verifier
ADD INDEX IDX_ns_verifier_site_id (site_id);

--
-- `v3_upgrade_log`
--
CREATE TABLE v3_upgrade_log (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  module varchar(255) NOT NULL DEFAULT '' COMMENT '模块标识',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '模块名称',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '迁移时间',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  status int(11) NOT NULL DEFAULT 0 COMMENT '迁移完成状态 1：完成 0 ：未完成',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = 'v3Tov4迁移数据日志',
ROW_FORMAT = DYNAMIC;

--
-- `user_log`
--
CREATE TABLE user_log (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  uid int(11) NOT NULL DEFAULT 0 COMMENT '操作用户ID',
  username varchar(255) NOT NULL DEFAULT '' COMMENT '昵称',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  url varchar(255) NOT NULL DEFAULT '' COMMENT '对应url',
  data text DEFAULT NULL COMMENT '传输数据',
  ip varchar(255) NOT NULL DEFAULT '' COMMENT 'ip地址',
  action_name varchar(255) NOT NULL DEFAULT '' COMMENT '操作行为',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '用户操作日志',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_user_log` on table `user_log`
--
ALTER TABLE user_log
ADD INDEX IDX_ns_user_log (uid, site_id);

--
-- `user`
--
CREATE TABLE `user` (
  uid int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  sys_uid int(11) NOT NULL DEFAULT 0 COMMENT '系统用户id',
  app_module varchar(255) NOT NULL DEFAULT '' COMMENT '应用模块',
  app_group int(11) NOT NULL DEFAULT 0 COMMENT '应用所属组',
  is_admin tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否是管理员',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  group_id int(11) NOT NULL DEFAULT 0 COMMENT '权限id',
  group_name varchar(50) NOT NULL DEFAULT '' COMMENT '权限组',
  username varchar(50) NOT NULL DEFAULT '' COMMENT '账号',
  password varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT 0,
  status int(11) NOT NULL DEFAULT 1 COMMENT '状态 1 正常',
  login_time int(11) NOT NULL DEFAULT 0 COMMENT '最新一次登陆时间',
  login_ip varchar(255) NOT NULL DEFAULT '' COMMENT '最新登录ip',
  PRIMARY KEY (uid)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '站点后台用户表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_user` on table `user`
--
ALTER TABLE `user`
ADD INDEX IDX_ns_user (group_id, app_module);

--
-- `IDX_ns_user_member_id` on table `user`
--
ALTER TABLE `user`
ADD INDEX IDX_ns_user_member_id (member_id);

--
-- `IDX_ns_user_site_id` on table `user`
--
ALTER TABLE `user`
ADD INDEX IDX_ns_user_site_id (site_id);

--
-- `IDX_ns_user_username` on table `user`
--
ALTER TABLE `user`
ADD INDEX IDX_ns_user_username (username);

--
-- `sys_upgrade_log`
--
CREATE TABLE sys_upgrade_log (
  log_id int(11) NOT NULL AUTO_INCREMENT,
  upgrade_no varchar(255) NOT NULL DEFAULT '' COMMENT '升级编号 每次的编号都不同',
  upgrade_time int(11) NOT NULL DEFAULT 0 COMMENT '升级时间 记录开始时间',
  version_info longtext DEFAULT NULL COMMENT '版本信息 json数据 包含升级前和升级后的基本信息',
  backup_root varchar(255) NOT NULL DEFAULT '' COMMENT '备份文件和sql的根目录',
  download_root varchar(255) NOT NULL DEFAULT '' COMMENT '下载文件的根目录',
  status tinyint(3) NOT NULL DEFAULT 0 COMMENT '升级状态 0 进行中 1 升级成功 2 升级失败',
  error_message varchar(255) NOT NULL DEFAULT '' COMMENT '升级失败错误信息',
  PRIMARY KEY (log_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '系统升级日志',
ROW_FORMAT = DYNAMIC;

--
-- `supplier`
--
CREATE TABLE supplier (
  supplier_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  supplier_site_id int(10) NOT NULL DEFAULT 0 COMMENT '供应商站点',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '供应商名称',
  logo varchar(255) NOT NULL DEFAULT '' COMMENT '供应商logo',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '供应商简介',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '供应商关键字',
  supplier_address varchar(255) NOT NULL DEFAULT '' COMMENT '供应商地址',
  supplier_email varchar(50) NOT NULL DEFAULT '' COMMENT '供应商邮箱',
  supplier_phone varchar(255) NOT NULL DEFAULT '' COMMENT '联系电话',
  supplier_qq varchar(255) NOT NULL DEFAULT '' COMMENT '供应商qq',
  supplier_weixin varchar(255) NOT NULL DEFAULT '' COMMENT '联系人微信号',
  account decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '账户金额',
  account_withdraw decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '已提现金额',
  account_withdraw_apply decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现中金额',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  username varchar(255) NOT NULL DEFAULT 'admin' COMMENT '供应商管理员',
  settlement_bank_account_name varchar(50) NOT NULL DEFAULT '' COMMENT '结算银行开户名',
  settlement_bank_account_number varchar(50) NOT NULL DEFAULT '' COMMENT '结算公司银行账号',
  settlement_bank_name varchar(50) NOT NULL DEFAULT '' COMMENT '结算开户银行支行名称',
  settlement_bank_address varchar(50) NOT NULL DEFAULT '' COMMENT '结算开户银行所在地',
  PRIMARY KEY (supplier_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '供应商',
ROW_FORMAT = DYNAMIC;

--
-- `store_stock_import_log`
--
CREATE TABLE store_stock_import_log (
  id int(11) NOT NULL AUTO_INCREMENT,
  store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  file_id int(11) NOT NULL DEFAULT 0 COMMENT '文件id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  goods_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'skuid',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT 'sku名称',
  stock int(11) NOT NULL DEFAULT 0 COMMENT '库存（增/减）',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态（0成功 -1失败）',
  reason varchar(255) NOT NULL DEFAULT '' COMMENT '原因',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '门店导入库存失败记录',
ROW_FORMAT = DYNAMIC;

--
-- `store_stock_import`
--
CREATE TABLE store_stock_import (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0,
  store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  filename varchar(255) NOT NULL DEFAULT '' COMMENT '文件名称',
  path varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  sku_num int(11) NOT NULL DEFAULT 0 COMMENT '导入的sku商品数',
  error_num int(11) NOT NULL DEFAULT 0 COMMENT '失败数量',
  create_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = ' 门店库存导入批量修改',
ROW_FORMAT = DYNAMIC;

--
-- `store_settlement`
--
CREATE TABLE store_settlement (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  settlement_no varchar(255) NOT NULL DEFAULT '' COMMENT '流水号',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  store_name varchar(255) NOT NULL DEFAULT '' COMMENT '门店名称',
  order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单总金额',
  shop_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '店铺金额',
  refund_platform_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '平台退款抽成',
  platform_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '平台抽成',
  refund_shop_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '店铺退款金额',
  refund_money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '退款金额',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '账期开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '账期结束时间',
  commission decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '佣金支出',
  is_settlement tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否结算',
  remark varchar(500) NOT NULL DEFAULT '' COMMENT '备注',
  offline_order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '线下支付的订单金额',
  offline_refund_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '线下退款金额',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
ROW_FORMAT = DYNAMIC;

--
-- `store_member`
--
CREATE TABLE store_member (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店站点id',
  order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '付款后-消费金额',
  order_complete_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单完成-消费金额',
  order_num int(11) NOT NULL DEFAULT 0 COMMENT '付款后-消费次数',
  order_complete_num int(11) NOT NULL DEFAULT 0 COMMENT '订单完成-消费次数',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '门店会员管理',
ROW_FORMAT = DYNAMIC;

--
-- `store_goods_sku`
--
CREATE TABLE store_goods_sku (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'sku_id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  store_stock int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存',
  store_sale_num int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '销量',
  store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '门店sku表',
ROW_FORMAT = DYNAMIC;

--
-- `store_goods`
--
CREATE TABLE store_goods (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  store_goods_stock int(11) NOT NULL DEFAULT 0 COMMENT '商品库存',
  store_sale_num int(11) NOT NULL DEFAULT 0 COMMENT '销量',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '门店商品表',
ROW_FORMAT = DYNAMIC;

--
-- `store`
--
CREATE TABLE store (
  store_id int(11) NOT NULL AUTO_INCREMENT COMMENT '门店站点id',
  store_name varchar(50) NOT NULL DEFAULT '' COMMENT '门店名称',
  telphone varchar(255) NOT NULL DEFAULT '' COMMENT '联系电话',
  store_image varchar(255) NOT NULL DEFAULT '' COMMENT '门店图片',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '商家id',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  status int(11) NOT NULL DEFAULT 0 COMMENT '状态',
  province_id int(11) NOT NULL DEFAULT 0 COMMENT '省id',
  city_id int(11) NOT NULL DEFAULT 0 COMMENT '市id',
  district_id int(11) NOT NULL DEFAULT 0 COMMENT '区县id',
  community_id int(11) NOT NULL DEFAULT 0 COMMENT '社区id',
  address varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  full_address varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  longitude varchar(10) NOT NULL DEFAULT '' COMMENT '经度',
  latitude varchar(10) NOT NULL DEFAULT '' COMMENT '纬度',
  is_pickup tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否启用自提',
  is_o2o tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否启用本地配送',
  open_date varchar(1000) NOT NULL DEFAULT '' COMMENT '营业时间',
  o2o_fee_json varchar(1000) NOT NULL DEFAULT '0' COMMENT '配送费用设置',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  username varchar(255) NOT NULL DEFAULT '' COMMENT '门店管理员',
  order_money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '付款后订单金额',
  order_complete_money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '订单完成-订单金额',
  order_num int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单数',
  order_complete_num int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单完成数量',
  is_frozen tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否冻结0-未冻结 1已冻结',
  uid int(11) DEFAULT 0 COMMENT '门店管理员id',
  PRIMARY KEY (store_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '线下门店表',
ROW_FORMAT = DYNAMIC;

--
-- `stat_shop`
--
CREATE TABLE stat_shop (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  year int(11) NOT NULL DEFAULT 0 COMMENT '年',
  month int(11) NOT NULL DEFAULT 0 COMMENT '月',
  day int(11) NOT NULL DEFAULT 0 COMMENT '日',
  day_time int(11) NOT NULL DEFAULT 0 COMMENT '当日时间',
  order_total decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单金额',
  shipping_total decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '运费金额',
  refund_total decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '退款金额',
  order_pay_count int(11) NOT NULL DEFAULT 0 COMMENT '订单总数',
  goods_pay_count int(11) NOT NULL DEFAULT 0 COMMENT '订单商品总数',
  shop_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '店铺金额',
  platform_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '平台金额',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  collect_shop int(11) NOT NULL DEFAULT 0 COMMENT '店铺收藏量',
  collect_goods int(11) NOT NULL DEFAULT 0 COMMENT '商品收藏量',
  visit_count int(11) NOT NULL DEFAULT 0 COMMENT '浏览量',
  order_count int(11) NOT NULL DEFAULT 0 COMMENT '订单量（总）',
  goods_count int(11) NOT NULL DEFAULT 0 COMMENT '订单商品量（总）',
  add_goods_count int(11) NOT NULL DEFAULT 0 COMMENT '添加商品数',
  member_count int(11) NOT NULL DEFAULT 0 COMMENT '会员统计',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_stat_shop_day` on table `stat_shop`
--
ALTER TABLE stat_shop
ADD INDEX IDX_ns_stat_shop_day (day);

--
-- `IDX_ns_stat_shop_day_time` on table `stat_shop`
--
ALTER TABLE stat_shop
ADD INDEX IDX_ns_stat_shop_day_time (day_time);

--
-- `IDX_ns_stat_shop_month` on table `stat_shop`
--
ALTER TABLE stat_shop
ADD INDEX IDX_ns_stat_shop_month (month);

--
-- `IDX_ns_stat_shop_site_id` on table `stat_shop`
--
ALTER TABLE stat_shop
ADD INDEX IDX_ns_stat_shop_site_id (site_id);

--
-- `IDX_ns_stat_shop_year` on table `stat_shop`
--
ALTER TABLE stat_shop
ADD INDEX IDX_ns_stat_shop_year (year);

--
-- `sms_template`
--
CREATE TABLE sms_template (
  template_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  tem_id int(11) NOT NULL DEFAULT 0 COMMENT '返回的模板id',
  keywords varchar(255) NOT NULL DEFAULT '',
  template_type tinyint(1) NOT NULL DEFAULT 0 COMMENT '模板类型（1验证码  2行业通知  3营销推广 ）',
  template_name varchar(255) NOT NULL DEFAULT '' COMMENT '模板名称',
  template_content varchar(255) NOT NULL DEFAULT '' COMMENT '模板内容',
  param_json varchar(255) NOT NULL DEFAULT '' COMMENT '模板变量json',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '启用状态（1 启用，0 禁用）',
  audit_status tinyint(1) NOT NULL DEFAULT 0 COMMENT '审核状态（0 未审核，1 待审核，2 审核通过， 3 审核不通过）',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (template_id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 28,
AVG_ROW_LENGTH = 862,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '牛云短信模板',
ROW_FORMAT = DYNAMIC;

--
-- `site_diy_view`
--
CREATE TABLE site_diy_view (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  name varchar(50) NOT NULL DEFAULT '',
  addon_name varchar(50) NOT NULL DEFAULT '' COMMENT '插件名称',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '模板名称',
  value text DEFAULT NULL COMMENT '配置值',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  type varchar(255) NOT NULL DEFAULT 'shop' COMMENT '应用模块:shop、store',
  icon varchar(255) NOT NULL DEFAULT '' COMMENT '图标',
  template_id int(11) NOT NULL DEFAULT 0 COMMENT '模板id',
  click_num int(11) NOT NULL DEFAULT 0 COMMENT '浏览量',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '店铺自定义模板表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_nc_site_diy_view` on table `site_diy_view`
--
ALTER TABLE site_diy_view
ADD INDEX IDX_nc_site_diy_view (site_id, name);

--
-- `site`
--
CREATE TABLE site (
  site_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '站点id',
  site_type varchar(255) NOT NULL DEFAULT '' COMMENT '站点类型',
  site_domain varchar(255) NOT NULL DEFAULT '' COMMENT '站点域名',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  username varchar(255) NOT NULL DEFAULT '' COMMENT '站点用户',
  logo varchar(255) NOT NULL DEFAULT '' COMMENT '站点logo',
  seo_keywords varchar(255) NOT NULL DEFAULT '' COMMENT '站点关键字',
  seo_description varchar(255) NOT NULL DEFAULT '' COMMENT '站点描述',
  PRIMARY KEY (site_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '站点基础表',
ROW_FORMAT = DYNAMIC;

--
-- `shop_address`
--
CREATE TABLE shop_address (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0,
  contact_name varchar(50) NOT NULL DEFAULT '' COMMENT '联系人',
  mobile varchar(255) NOT NULL DEFAULT '' COMMENT '联系人手机号',
  postcode varchar(255) NOT NULL DEFAULT '' COMMENT '邮政编码',
  province_id int(11) NOT NULL DEFAULT 0 COMMENT '省',
  city_id int(11) NOT NULL DEFAULT 0 COMMENT '市',
  district_id int(11) NOT NULL DEFAULT 0 COMMENT '县',
  community_id int(11) NOT NULL DEFAULT 0 COMMENT '乡镇',
  address varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  full_address varchar(255) NOT NULL DEFAULT '' COMMENT '收票地址',
  is_return tinyint(1) NOT NULL DEFAULT 0 COMMENT '退货地址',
  is_return_default tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否是默认退货地址',
  is_delivery tinyint(1) NOT NULL DEFAULT 0 COMMENT '发货地址',
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商家地址库',
ROW_FORMAT = DYNAMIC;

--
-- `shop_accept_message`
--
CREATE TABLE shop_accept_message (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0,
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id（接受消息的会员id）',
  type tinyint(1) NOT NULL DEFAULT 0 COMMENT '类型（0统一设置   1单独设置）',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '消息关键字（针对单独设置有效）',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商家接受消息设置',
ROW_FORMAT = DYNAMIC;

--
-- `shop`
--
CREATE TABLE shop (
  site_id int(11) NOT NULL,
  shop_status int(11) NOT NULL DEFAULT 1 COMMENT '店铺经营状态（0.关闭，1正常）',
  close_info varchar(255) NOT NULL DEFAULT '' COMMENT '店铺关闭原因',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序号',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '经营时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '关闭时间',
  avatar varchar(255) NOT NULL DEFAULT '' COMMENT '店铺头像（大图）',
  banner varchar(255) NOT NULL DEFAULT '' COMMENT '店铺条幅',
  qq varchar(20) NOT NULL DEFAULT '' COMMENT '联系人qq',
  ww varchar(20) NOT NULL DEFAULT '' COMMENT '联系人阿里旺旺',
  name varchar(255) NOT NULL DEFAULT '' COMMENT '联系人姓名',
  telephone varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  mobile varchar(11) NOT NULL DEFAULT '' COMMENT '联系手机号',
  workingtime int(11) NOT NULL DEFAULT 0 COMMENT '工作时间',
  province int(11) NOT NULL DEFAULT 0 COMMENT '省id',
  province_name varchar(50) NOT NULL DEFAULT '' COMMENT '省名称',
  city int(11) NOT NULL DEFAULT 0 COMMENT '城市id',
  city_name varchar(50) NOT NULL DEFAULT '' COMMENT '城市名称',
  district int(11) NOT NULL DEFAULT 0 COMMENT '区县id',
  district_name varchar(50) NOT NULL DEFAULT '' COMMENT '区县地址',
  community int(11) NOT NULL DEFAULT 0 COMMENT '乡镇地址id',
  community_name varchar(50) NOT NULL DEFAULT '' COMMENT '乡镇地址名称',
  address varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  full_address varchar(255) NOT NULL DEFAULT '' COMMENT '完整地址',
  longitude varchar(20) NOT NULL DEFAULT '' COMMENT '经度',
  latitude varchar(20) NOT NULL DEFAULT '' COMMENT '纬度',
  email varchar(50) NOT NULL DEFAULT '',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  store_settlement_time int(11) NOT NULL DEFAULT 0 COMMENT '门店最后结算时间',
  work_week varchar(50) NOT NULL DEFAULT '' COMMENT '工作日',
  PRIMARY KEY (site_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '店铺表',
ROW_FORMAT = DYNAMIC;

--
-- `servicer_member`
--
CREATE TABLE servicer_member (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT '数据ID',
  member_id int(11) NOT NULL COMMENT '关联会员ID',
  servicer_id int(11) NOT NULL DEFAULT 0 COMMENT '关联客服ID',
  member_name varchar(64) NOT NULL DEFAULT '' COMMENT '会员名称',
  online tinyint(2) NOT NULL DEFAULT 0 COMMENT '是否在线',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '登录时间',
  last_online_time int(11) NOT NULL DEFAULT 0 COMMENT '上次在线时间',
  delete_time int(11) NOT NULL DEFAULT 0 COMMENT '删除时间',
  headimg varchar(255) NOT NULL DEFAULT '' COMMENT '会员头像',
  client_id varchar(64) NOT NULL DEFAULT '' COMMENT 'session会话临时ID',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '聊天会员在线状态表',
ROW_FORMAT = DYNAMIC;

--
-- `servicer_dialogue`
--
CREATE TABLE servicer_dialogue (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT '数据ID',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员ID（匿名聊天则为0）',
  servicer_id int(11) NOT NULL COMMENT '客服ID',
  create_day date NOT NULL COMMENT '聊天创建日',
  create_time time NOT NULL COMMENT '聊天创建时间',
  content_type tinyint(4) NOT NULL DEFAULT 0 COMMENT '内容类型（0：文本（包括表情，1：图片，2：订单信息，3：商品信息）',
  `read` tinyint(2) NOT NULL DEFAULT 0 COMMENT '消息是否已读',
  shop_id int(11) NOT NULL DEFAULT 0 COMMENT '商户ID',
  goods_sku_id int(11) NOT NULL DEFAULT 0 COMMENT '关联商品ID',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '关联订单ID',
  consumer_say text DEFAULT NULL COMMENT '顾客说',
  servicer_say text DEFAULT NULL COMMENT '客服说',
  type tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: say,客户咨询，1：answer,客服回答',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '客服对话内容',
ROW_FORMAT = DYNAMIC;

--
-- `index_create_day` on table `servicer_dialogue`
--
ALTER TABLE servicer_dialogue
ADD INDEX index_create_day (create_day) COMMENT '聊天日期索引';

--
-- `servicer`
--
CREATE TABLE servicer (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT '客服ID',
  is_platform tinyint(2) NOT NULL DEFAULT 1 COMMENT '是否平台客服',
  shop_id int(11) DEFAULT 0 COMMENT '商户ID',
  user_id int(11) NOT NULL DEFAULT 0 COMMENT '客服账号归属用户ID',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '客服创建时间',
  last_online_time int(11) NOT NULL DEFAULT 0 COMMENT '最近在线时间',
  delete_time int(11) NOT NULL DEFAULT 0 COMMENT '删除时间',
  client_id varchar(64) NOT NULL DEFAULT '' COMMENT 'session会话临时ID',
  online tinyint(2) NOT NULL DEFAULT 0 COMMENT '是否在线',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '客服基础表',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_topic_goods`
--
CREATE TABLE promotion_topic_goods (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  topic_id int(11) NOT NULL DEFAULT 0 COMMENT '对应活动Id',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'skuId',
  topic_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '折扣价',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `default` int(1) NOT NULL DEFAULT 0 COMMENT '是否为默认展示规格',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '限时折扣商品列表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_topic_goods_end_time` on table `promotion_topic_goods`
--
ALTER TABLE promotion_topic_goods
ADD INDEX IDX_ns_promotion_topic_goods_end_time (end_time);

--
-- `IDX_ns_promotion_topic_goods_site_id` on table `promotion_topic_goods`
--
ALTER TABLE promotion_topic_goods
ADD INDEX IDX_ns_promotion_topic_goods_site_id (site_id);

--
-- `IDX_ns_promotion_topic_goods_sku_id` on table `promotion_topic_goods`
--
ALTER TABLE promotion_topic_goods
ADD INDEX IDX_ns_promotion_topic_goods_sku_id (sku_id);

--
-- `IDX_ns_promotion_topic_goods_start_time` on table `promotion_topic_goods`
--
ALTER TABLE promotion_topic_goods
ADD INDEX IDX_ns_promotion_topic_goods_start_time (start_time);

--
-- `IDX_ns_promotion_topic_goods_topic_id` on table `promotion_topic_goods`
--
ALTER TABLE promotion_topic_goods
ADD INDEX IDX_ns_promotion_topic_goods_topic_id (topic_id);

--
-- `promotion_topic`
--
CREATE TABLE promotion_topic (
  topic_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(10) NOT NULL DEFAULT 0 COMMENT '站点id',
  topic_name varchar(255) NOT NULL DEFAULT '' COMMENT '专题名称',
  topic_adv varchar(255) NOT NULL DEFAULT '' COMMENT '专题广告',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT '活动状态 1未开始  2进行中  3已结束',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  bg_color varchar(255) NOT NULL DEFAULT '#ffffff' COMMENT '背景色',
  PRIMARY KEY (topic_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '专题活动',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_seckill_time`
--
CREATE TABLE promotion_seckill_time (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '秒杀时段名称',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time varchar(255) NOT NULL DEFAULT '0' COMMENT '修改时间',
  seckill_start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间点',
  seckill_end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间点',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '秒杀时段',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_seckill_goods`
--
CREATE TABLE promotion_seckill_goods (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  seckill_id int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '主键',
  seckill_time_id varchar(255) NOT NULL DEFAULT '' COMMENT '秒杀时间段',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品sku_id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  seckill_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '秒杀金额',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '原价',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点ID',
  stock int(11) NOT NULL DEFAULT 0 COMMENT '秒杀库存',
  max_buy int(11) NOT NULL DEFAULT 0 COMMENT '每人限购',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '活动状态 0未开始 1进行中 2已结束 -1已关闭（手动）',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '秒杀参与商品',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_seckill`
--
CREATE TABLE promotion_seckill (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 1 COMMENT '站点id',
  seckill_name varchar(255) NOT NULL DEFAULT '' COMMENT '活动名称',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '活动状态 0未开始 1进行中 2已结束 -1已关闭（手动）',
  remark varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  goods_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  goods_image varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  seckill_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '秒杀金额，只做展示',
  seckill_time_id varchar(255) NOT NULL DEFAULT '' COMMENT '秒杀时段id',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '秒杀活动',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_present`
--
CREATE TABLE promotion_present (
  present_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺ID',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品ID',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品sku',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  is_virtual tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否是虚拟商品（0否 1是）',
  sku_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品原价',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  sale_num int(11) NOT NULL DEFAULT 0 COMMENT '已赠送数量',
  limit_num int(11) NOT NULL DEFAULT 0 COMMENT '每人限制领取数量',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  status tinyint(3) NOT NULL DEFAULT 1 COMMENT '状态（1未开始  2进行中  3已结束）',
  stock int(11) NOT NULL DEFAULT 0 COMMENT '赠品库存',
  PRIMARY KEY (present_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '赠品',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_present_goods_id` on table `promotion_present`
--
ALTER TABLE promotion_present
ADD INDEX IDX_ns_promotion_present_goods_id (goods_id);

--
-- `IDX_ns_promotion_present_site_id` on table `promotion_present`
--
ALTER TABLE promotion_present
ADD INDEX IDX_ns_promotion_present_site_id (site_id);

--
-- `IDX_ns_promotion_present_sku_id` on table `promotion_present`
--
ALTER TABLE promotion_present
ADD INDEX IDX_ns_promotion_present_sku_id (sku_id);

--
-- `IDX_ns_promotion_present_status` on table `promotion_present`
--
ALTER TABLE promotion_present
ADD INDEX IDX_ns_promotion_present_status (status);

--
-- `promotion_pintuan_order`
--
CREATE TABLE promotion_pintuan_order (
  id int(11) NOT NULL AUTO_INCREMENT,
  pintuan_id int(11) NOT NULL DEFAULT 0 COMMENT '拼团id',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  order_no varchar(50) NOT NULL DEFAULT '' COMMENT '订单编号',
  group_id int(11) NOT NULL DEFAULT 0 COMMENT '拼团分组id',
  pintuan_status int(11) NOT NULL DEFAULT 0 COMMENT '拼团状态(0未支付 1拼团失败 2组团中 3拼团成功)',
  order_type int(11) NOT NULL DEFAULT 1 COMMENT '订单类型',
  head_id int(11) NOT NULL DEFAULT 1 COMMENT '团长id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '订单会员id',
  member_img varchar(255) NOT NULL DEFAULT '' COMMENT '会员头像图',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '会员昵称',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '拼团订单',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_pintuan_order_head_id` on table `promotion_pintuan_order`
--
ALTER TABLE promotion_pintuan_order
ADD INDEX IDX_ns_promotion_pintuan_order_head_id (head_id);

--
-- `IDX_ns_promotion_pintuan_order_member_id` on table `promotion_pintuan_order`
--
ALTER TABLE promotion_pintuan_order
ADD INDEX IDX_ns_promotion_pintuan_order_member_id (member_id);

--
-- `IDX_ns_promotion_pintuan_order_order_id` on table `promotion_pintuan_order`
--
ALTER TABLE promotion_pintuan_order
ADD INDEX IDX_ns_promotion_pintuan_order_order_id (order_id);

--
-- `IDX_ns_promotion_pintuan_order_pintuan_id` on table `promotion_pintuan_order`
--
ALTER TABLE promotion_pintuan_order
ADD INDEX IDX_ns_promotion_pintuan_order_pintuan_id (pintuan_id);

--
-- `IDX_ns_promotion_pintuan_order_site_id` on table `promotion_pintuan_order`
--
ALTER TABLE promotion_pintuan_order
ADD INDEX IDX_ns_promotion_pintuan_order_site_id (site_id);

--
-- `promotion_pintuan_group`
--
CREATE TABLE promotion_pintuan_group (
  group_id int(11) NOT NULL AUTO_INCREMENT COMMENT '拼团分组id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  is_virtual_goods tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否虚拟商品',
  pintuan_id int(11) NOT NULL DEFAULT 0 COMMENT '拼团活动id',
  head_id int(11) NOT NULL DEFAULT 0 COMMENT '团长id',
  pintuan_num int(11) NOT NULL DEFAULT 0 COMMENT '拼团数量',
  pintuan_count int(11) NOT NULL DEFAULT 1 COMMENT '当前数量',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '拼团结束时间',
  status int(11) NOT NULL DEFAULT 0 COMMENT '当前状态 0未支付 1拼团失败 2.组团中3.拼团成功',
  is_virtual_buy tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否虚拟成团',
  is_single_buy tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否单独购买',
  is_promotion tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否团长优惠',
  buy_num int(11) NOT NULL DEFAULT 0 COMMENT '拼团限制购买',
  head_member_img varchar(255) NOT NULL DEFAULT '' COMMENT '组长会员头像',
  head_nickname varchar(255) NOT NULL DEFAULT '' COMMENT '组长会员昵称',
  PRIMARY KEY (group_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '拼团组',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_pintuan_group_end_time` on table `promotion_pintuan_group`
--
ALTER TABLE promotion_pintuan_group
ADD INDEX IDX_ns_promotion_pintuan_group_end_time (end_time);

--
-- `IDX_ns_promotion_pintuan_group_goods_id` on table `promotion_pintuan_group`
--
ALTER TABLE promotion_pintuan_group
ADD INDEX IDX_ns_promotion_pintuan_group_goods_id (goods_id);

--
-- `IDX_ns_promotion_pintuan_group_head_id` on table `promotion_pintuan_group`
--
ALTER TABLE promotion_pintuan_group
ADD INDEX IDX_ns_promotion_pintuan_group_head_id (head_id);

--
-- `IDX_ns_promotion_pintuan_group_pintuan_id` on table `promotion_pintuan_group`
--
ALTER TABLE promotion_pintuan_group
ADD INDEX IDX_ns_promotion_pintuan_group_pintuan_id (pintuan_id);

--
-- `IDX_ns_promotion_pintuan_group_site_id` on table `promotion_pintuan_group`
--
ALTER TABLE promotion_pintuan_group
ADD INDEX IDX_ns_promotion_pintuan_group_site_id (site_id);

--
-- `IDX_ns_promotion_pintuan_group_status` on table `promotion_pintuan_group`
--
ALTER TABLE promotion_pintuan_group
ADD INDEX IDX_ns_promotion_pintuan_group_status (status);

--
-- `promotion_pintuan_goods`
--
CREATE TABLE promotion_pintuan_goods (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  pintuan_id int(11) NOT NULL DEFAULT 0 COMMENT '拼团id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'skuid',
  pintuan_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '拼团价',
  promotion_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '团长优惠价',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '拼团商品表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_pintuan_goods_goods_id` on table `promotion_pintuan_goods`
--
ALTER TABLE promotion_pintuan_goods
ADD INDEX IDX_ns_promotion_pintuan_goods_goods_id (goods_id);

--
-- `IDX_ns_promotion_pintuan_goods_pintuan_id` on table `promotion_pintuan_goods`
--
ALTER TABLE promotion_pintuan_goods
ADD INDEX IDX_ns_promotion_pintuan_goods_pintuan_id (pintuan_id);

--
-- `IDX_ns_promotion_pintuan_goods_site_id` on table `promotion_pintuan_goods`
--
ALTER TABLE promotion_pintuan_goods
ADD INDEX IDX_ns_promotion_pintuan_goods_site_id (site_id);

--
-- `IDX_ns_promotion_pintuan_goods_sku_id` on table `promotion_pintuan_goods`
--
ALTER TABLE promotion_pintuan_goods
ADD INDEX IDX_ns_promotion_pintuan_goods_sku_id (sku_id);

--
-- `promotion_pintuan`
--
CREATE TABLE promotion_pintuan (
  pintuan_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '拼团id',
  site_id int(11) NOT NULL COMMENT '店铺id',
  site_name varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名称',
  pintuan_name varchar(30) NOT NULL DEFAULT '' COMMENT '活动名称',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  is_virtual_goods tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否是虚拟商品（0否 1是）',
  pintuan_num int(11) NOT NULL DEFAULT 0 COMMENT '参团人数',
  pintuan_time int(11) NOT NULL DEFAULT 1 COMMENT '拼团有效期',
  remark text CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL COMMENT '备注',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  is_recommend int(11) NOT NULL DEFAULT 0 COMMENT '是否推荐',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  buy_num int(11) NOT NULL DEFAULT 0 COMMENT '拼团限制购买',
  pintuan_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '拼团价',
  is_single_buy tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否单独购买',
  is_virtual_buy tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否虚拟成团',
  is_promotion tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否团长优惠',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态（0正常 1活动进行中  2活动已结束  3失效  4删除）',
  group_num int(11) NOT NULL DEFAULT 0 COMMENT '开团组数',
  success_group_num int(11) NOT NULL DEFAULT 0 COMMENT '成团组数',
  order_num int(11) NOT NULL DEFAULT 0 COMMENT '购买人数',
  PRIMARY KEY (pintuan_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '拼团活动表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_pintuan_end_time` on table `promotion_pintuan`
--
ALTER TABLE promotion_pintuan
ADD INDEX IDX_ns_promotion_pintuan_end_time (end_time);

--
-- `IDX_ns_promotion_pintuan_goods_id` on table `promotion_pintuan`
--
ALTER TABLE promotion_pintuan
ADD INDEX IDX_ns_promotion_pintuan_goods_id (goods_id);

--
-- `IDX_ns_promotion_pintuan_is_recommend` on table `promotion_pintuan`
--
ALTER TABLE promotion_pintuan
ADD INDEX IDX_ns_promotion_pintuan_is_recommend (is_recommend);

--
-- `IDX_ns_promotion_pintuan_site_id` on table `promotion_pintuan`
--
ALTER TABLE promotion_pintuan
ADD INDEX IDX_ns_promotion_pintuan_site_id (site_id);

--
-- `IDX_ns_promotion_pintuan_start_time` on table `promotion_pintuan`
--
ALTER TABLE promotion_pintuan
ADD INDEX IDX_ns_promotion_pintuan_start_time (start_time);

--
-- `IDX_ns_promotion_pintuan_status` on table `promotion_pintuan`
--
ALTER TABLE promotion_pintuan
ADD INDEX IDX_ns_promotion_pintuan_status (status);

--
-- `promotion_mansong_record`
--
CREATE TABLE promotion_mansong_record (
  id int(11) NOT NULL AUTO_INCREMENT,
  manjian_id int(11) NOT NULL DEFAULT 0 COMMENT '满减送活动id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  manjian_name varchar(255) NOT NULL DEFAULT '' COMMENT '满减送活动名称',
  point int(11) NOT NULL DEFAULT 0 COMMENT '所送积分数',
  coupon int(11) NOT NULL DEFAULT 0 COMMENT '所送优惠券',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  member_id int(11) NOT NULL DEFAULT 0,
  order_sku_ids varchar(255) NOT NULL DEFAULT '' COMMENT '满足条件的商品规格id',
  status int(11) NOT NULL DEFAULT 0 COMMENT '0未发放 1已发放',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '满送记录表',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_manjian_goods`
--
CREATE TABLE promotion_manjian_goods (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  manjian_id int(11) NOT NULL DEFAULT 0 COMMENT '满减活动id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  manjian_type tinyint(1) NOT NULL DEFAULT 1 COMMENT '1全部商品参与  2指定商品 3指定商品不参与 ',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态（0未开始1进行中2已结束-1已关闭）',
  rule_json varchar(2000) NOT NULL DEFAULT '' COMMENT '满减规则json',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '满减商品表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_manjian_goods_end_time` on table `promotion_manjian_goods`
--
ALTER TABLE promotion_manjian_goods
ADD INDEX IDX_ns_promotion_manjian_goods_end_time (end_time);

--
-- `IDX_ns_promotion_manjian_goods_goods_id` on table `promotion_manjian_goods`
--
ALTER TABLE promotion_manjian_goods
ADD INDEX IDX_ns_promotion_manjian_goods_goods_id (goods_id);

--
-- `IDX_ns_promotion_manjian_goods_manjian_id` on table `promotion_manjian_goods`
--
ALTER TABLE promotion_manjian_goods
ADD INDEX IDX_ns_promotion_manjian_goods_manjian_id (manjian_id);

--
-- `IDX_ns_promotion_manjian_goods_manjian_type` on table `promotion_manjian_goods`
--
ALTER TABLE promotion_manjian_goods
ADD INDEX IDX_ns_promotion_manjian_goods_manjian_type (manjian_type);

--
-- `IDX_ns_promotion_manjian_goods_start_time` on table `promotion_manjian_goods`
--
ALTER TABLE promotion_manjian_goods
ADD INDEX IDX_ns_promotion_manjian_goods_start_time (start_time);

--
-- `promotion_manjian`
--
CREATE TABLE promotion_manjian (
  manjian_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL COMMENT '站点id',
  manjian_name varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  manjian_type tinyint(1) NOT NULL DEFAULT 1 COMMENT '1全部商品参与  2指定商品 3指定商品不参与 ',
  type int(1) NOT NULL DEFAULT 0 COMMENT '条件类型 0:满N元  1:满N件',
  goods_ids text DEFAULT NULL COMMENT '商品id集',
  status int(11) NOT NULL DEFAULT 0 COMMENT '状态（0未开始1进行中2已结束-1已关闭）',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  rule_json varchar(2000) NOT NULL DEFAULT '{}' COMMENT '规则json',
  remark varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (manjian_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '满减活动',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_manjian_end_time` on table `promotion_manjian`
--
ALTER TABLE promotion_manjian
ADD INDEX IDX_ns_promotion_manjian_end_time (end_time);

--
-- `IDX_ns_promotion_manjian_manjian_type` on table `promotion_manjian`
--
ALTER TABLE promotion_manjian
ADD INDEX IDX_ns_promotion_manjian_manjian_type (manjian_type);

--
-- `IDX_ns_promotion_manjian_site_id` on table `promotion_manjian`
--
ALTER TABLE promotion_manjian
ADD INDEX IDX_ns_promotion_manjian_site_id (site_id);

--
-- `IDX_ns_promotion_manjian_start_time` on table `promotion_manjian`
--
ALTER TABLE promotion_manjian
ADD INDEX IDX_ns_promotion_manjian_start_time (start_time);

--
-- `IDX_ns_promotion_manjian_status` on table `promotion_manjian`
--
ALTER TABLE promotion_manjian
ADD INDEX IDX_ns_promotion_manjian_status (status);

--
-- `IDX_ns_promotion_manjian_type` on table `promotion_manjian`
--
ALTER TABLE promotion_manjian
ADD INDEX IDX_ns_promotion_manjian_type (type);

--
-- `promotion_groupbuy`
--
CREATE TABLE promotion_groupbuy (
  groupbuy_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺ID',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '店铺名称',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品ID',
  goods_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  goods_image varchar(1000) NOT NULL DEFAULT '' COMMENT '商品图片',
  is_virtual_goods tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否是虚拟商品（0否 1是）',
  goods_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品原价',
  groupbuy_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '团购价',
  buy_num int(11) NOT NULL DEFAULT 0 COMMENT '最低购买量',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  sell_num int(11) NOT NULL DEFAULT 0 COMMENT '已出售数量',
  status tinyint(3) NOT NULL DEFAULT 1 COMMENT '状态（1未开始  2进行中  3已结束）',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品sku',
  PRIMARY KEY (groupbuy_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '团购',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_groupbuy_end_time` on table `promotion_groupbuy`
--
ALTER TABLE promotion_groupbuy
ADD INDEX IDX_ns_promotion_groupbuy_end_time (end_time);

--
-- `IDX_ns_promotion_groupbuy_goods_id` on table `promotion_groupbuy`
--
ALTER TABLE promotion_groupbuy
ADD INDEX IDX_ns_promotion_groupbuy_goods_id (goods_id);

--
-- `IDX_ns_promotion_groupbuy_site_id` on table `promotion_groupbuy`
--
ALTER TABLE promotion_groupbuy
ADD INDEX IDX_ns_promotion_groupbuy_site_id (site_id);

--
-- `IDX_ns_promotion_groupbuy_start_time` on table `promotion_groupbuy`
--
ALTER TABLE promotion_groupbuy
ADD INDEX IDX_ns_promotion_groupbuy_start_time (start_time);

--
-- `IDX_ns_promotion_groupbuy_status` on table `promotion_groupbuy`
--
ALTER TABLE promotion_groupbuy
ADD INDEX IDX_ns_promotion_groupbuy_status (status);

--
-- `promotion_games_draw_record`
--
CREATE TABLE promotion_games_draw_record (
  record_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  game_id int(11) NOT NULL DEFAULT 0 COMMENT '游戏id',
  game_type varchar(30) NOT NULL DEFAULT '' COMMENT '游戏类型（插件名称）',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  member_nick_name varchar(255) NOT NULL DEFAULT '' COMMENT '会员昵称',
  points int(11) NOT NULL DEFAULT 0 COMMENT '参与消耗积分',
  is_winning tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否中奖（0未中  1中奖）',
  award_id int(11) NOT NULL DEFAULT 0 COMMENT '奖品id',
  award_name varchar(255) NOT NULL DEFAULT '' COMMENT '奖品名称',
  award_type tinyint(3) NOT NULL DEFAULT 0 COMMENT '奖品类型（1积分  2余额（不可提现）  3优惠券  4赠品）',
  relate_id int(11) NOT NULL DEFAULT 0 COMMENT '关联id（根据奖品类型）',
  relate_name varchar(255) NOT NULL DEFAULT '' COMMENT '关联商品名称（优惠券或者赠品名称）',
  is_receive tinyint(3) NOT NULL DEFAULT 0 COMMENT '是否领取（0未领取 1领取）奖品为优惠券 赠品是使用',
  point int(11) NOT NULL DEFAULT 0 COMMENT '奖励积分数',
  balance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '奖励余额',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '说明',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '参与时间',
  PRIMARY KEY (record_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '抽奖记录',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_games_award`
--
CREATE TABLE promotion_games_award (
  award_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  game_id int(11) NOT NULL DEFAULT 0 COMMENT '游戏id',
  award_name varchar(255) NOT NULL DEFAULT '' COMMENT '奖品名称',
  award_img varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  award_type tinyint(3) NOT NULL DEFAULT 0 COMMENT '奖品类型（1积分  2余额（不可提现）  3优惠券  4赠品）',
  relate_id int(11) NOT NULL DEFAULT 0 COMMENT '关联id（根据奖品类型）',
  relate_name varchar(255) NOT NULL DEFAULT '' COMMENT '关联商品名称（优惠券或者赠品名称）',
  point int(11) NOT NULL DEFAULT 0 COMMENT '积分数',
  balance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额',
  award_num int(11) NOT NULL DEFAULT 0 COMMENT '奖品数量',
  award_winning_rate int(11) NOT NULL DEFAULT 0 COMMENT '奖品中奖概率',
  remaining_num int(11) NOT NULL DEFAULT 0 COMMENT '剩余数量',
  receive_num int(11) NOT NULL DEFAULT 0 COMMENT '已领取数量',
  no_winning_img varchar(255) NOT NULL DEFAULT '' COMMENT '未中奖图片',
  PRIMARY KEY (award_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '游戏奖品',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_games`
--
CREATE TABLE promotion_games (
  game_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '游戏id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  game_name varchar(255) NOT NULL DEFAULT '' COMMENT '游戏活动名称',
  game_type varchar(30) NOT NULL DEFAULT '1' COMMENT '游戏类型（插件名称）',
  game_type_name varchar(255) NOT NULL DEFAULT '' COMMENT '游戏类型名称',
  level_id varchar(255) NOT NULL DEFAULT '' COMMENT '参与的会员等级0表示全部参与',
  level_name varchar(255) NOT NULL DEFAULT '' COMMENT '参与活动会员名称',
  points int(11) NOT NULL DEFAULT 0 COMMENT '参与一次扣除积分',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  status int(11) NOT NULL DEFAULT 0 COMMENT '活动状态 0未开始 1已开始 2已结束 3已关闭',
  remark varchar(1000) NOT NULL DEFAULT '' COMMENT '活动说明',
  winning_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '中奖率',
  no_winning_img varchar(255) NOT NULL DEFAULT '',
  no_winning_desc varchar(255) NOT NULL DEFAULT '' COMMENT '未中奖说明',
  is_show_winner int(11) NOT NULL DEFAULT 0 COMMENT '中奖名单是否显示 0不显示 1显示',
  join_type int(11) NOT NULL DEFAULT 0 COMMENT '参加类型 0活动全过程 1每天',
  join_frequency int(11) NOT NULL DEFAULT 1 COMMENT '根据类型计算参加次数',
  join_num int(11) NOT NULL DEFAULT 0 COMMENT '抽奖人数',
  winning_num int(11) NOT NULL DEFAULT 0 COMMENT '中奖人数',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (game_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '营销游戏（概率游戏）';

--
-- `IDX_ns_promotion_games_end_time` on table `promotion_games`
--
ALTER TABLE promotion_games
ADD INDEX IDX_ns_promotion_games_end_time (end_time);

--
-- `IDX_ns_promotion_games_game_type` on table `promotion_games`
--
ALTER TABLE promotion_games
ADD INDEX IDX_ns_promotion_games_game_type (game_type);

--
-- `IDX_ns_promotion_games_site_id` on table `promotion_games`
--
ALTER TABLE promotion_games
ADD INDEX IDX_ns_promotion_games_site_id (site_id);

--
-- `IDX_ns_promotion_games_start_time` on table `promotion_games`
--
ALTER TABLE promotion_games
ADD INDEX IDX_ns_promotion_games_start_time (start_time);

--
-- `IDX_ns_promotion_games_status` on table `promotion_games`
--
ALTER TABLE promotion_games
ADD INDEX IDX_ns_promotion_games_status (status);

--
-- `promotion_freeshipping`
--
CREATE TABLE promotion_freeshipping (
  freeshipping_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '金额',
  area_ids text DEFAULT NULL COMMENT '地区ids',
  area_names text DEFAULT NULL COMMENT '地区名称',
  surplus_area_ids text DEFAULT NULL,
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (freeshipping_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '满额包邮',
ROW_FORMAT = DYNAMIC;

--
-- `promotion_exchange_order`
--
CREATE TABLE promotion_exchange_order (
  order_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  order_no varchar(255) NOT NULL DEFAULT '' COMMENT '订单编号',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '对应会员',
  out_trade_no varchar(255) NOT NULL DEFAULT '' COMMENT '支付流水号（线上支付有效）',
  point int(11) NOT NULL DEFAULT 0 COMMENT '兑换积分数',
  exchange_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '兑换价格',
  delivery_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '邮费',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '实际应付金额',
  express_no varchar(255) NOT NULL DEFAULT '' COMMENT '物流单号（礼品发货）',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  pay_time int(11) NOT NULL DEFAULT 0 COMMENT '兑换成功时间',
  exchange_id int(11) NOT NULL DEFAULT 0 COMMENT '兑换商品id',
  exchange_name varchar(255) NOT NULL DEFAULT '' COMMENT '兑换商品名称',
  exchange_image varchar(255) NOT NULL DEFAULT '' COMMENT '兑换商品图片',
  num int(11) NOT NULL DEFAULT 0 COMMENT '兑换数量',
  order_status int(11) NOT NULL DEFAULT 0 COMMENT '状态',
  type int(11) NOT NULL DEFAULT 0 COMMENT '类型',
  type_name varchar(255) NOT NULL DEFAULT '' COMMENT '类型名称',
  name varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  mobile varchar(50) NOT NULL DEFAULT '' COMMENT '手机号',
  telephone varchar(50) NOT NULL DEFAULT '' COMMENT '电话',
  province_id int(11) NOT NULL DEFAULT 0 COMMENT '省id',
  city_id int(11) NOT NULL DEFAULT 0 COMMENT '市id',
  district_id int(11) NOT NULL DEFAULT 0 COMMENT '区县id',
  community_id int(11) NOT NULL DEFAULT 0 COMMENT '社区id',
  address varchar(255) NOT NULL DEFAULT '' COMMENT '地址信息',
  full_address varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址信息',
  longitude varchar(50) NOT NULL DEFAULT '' COMMENT '经度',
  latitude varchar(50) NOT NULL DEFAULT '' COMMENT '纬度',
  buyer_message varchar(255) NOT NULL DEFAULT '' COMMENT '买家留言',
  order_from varchar(255) NOT NULL DEFAULT '' COMMENT '订单来源',
  order_from_name varchar(255) NOT NULL DEFAULT '' COMMENT '订单来源名称',
  type_id int(11) NOT NULL DEFAULT 0 COMMENT '关联id',
  balance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '赠送红包',
  site_id int(11) NOT NULL DEFAULT 0,
  delivery_type varchar(255) NOT NULL DEFAULT '' COMMENT '物流类型',
  delivery_type_name varchar(255) NOT NULL DEFAULT '' COMMENT '配送方式名称',
  delivery_status int(11) NOT NULL DEFAULT 0 COMMENT '发货状态',
  delivery_status_name varchar(255) NOT NULL DEFAULT '' COMMENT '发货状态名称',
  delivery_code varchar(255) NOT NULL DEFAULT '' COMMENT '配送单号',
  delivery_store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  delivery_store_name varchar(255) NOT NULL DEFAULT '' COMMENT '门店名称',
  delivery_store_info varchar(255) NOT NULL DEFAULT '0' COMMENT '门店信息',
  buyer_ask_delivery_time varchar(255) NOT NULL DEFAULT '' COMMENT '到达时间',
  relate_order_id int(11) NOT NULL DEFAULT 0 COMMENT '关联订单',
  exchange_goods_id int(11) NOT NULL DEFAULT 0 COMMENT '积分兑换主表',
  PRIMARY KEY (order_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '积分兑换订单',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_exchange_order` on table `promotion_exchange_order`
--
ALTER TABLE promotion_exchange_order
ADD INDEX IDX_ns_promotion_exchange_order (member_id, order_status);

--
-- `IDX_ns_promotion_exchange_order_relate_order_id` on table `promotion_exchange_order`
--
ALTER TABLE promotion_exchange_order
ADD INDEX IDX_ns_promotion_exchange_order_relate_order_id (relate_order_id);

--
-- `promotion_exchange_goods`
--
CREATE TABLE promotion_exchange_goods (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT ' 站点id',
  type int(11) NOT NULL DEFAULT 1 COMMENT '兑换形式',
  type_name varchar(255) NOT NULL DEFAULT '' COMMENT '兑换类型名称',
  type_id int(11) NOT NULL DEFAULT 0 COMMENT '关联id',
  name varchar(255) NOT NULL DEFAULT '' COMMENT '兑换名称',
  image varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  point int(11) NOT NULL DEFAULT 0 COMMENT '积分数',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '兑换价',
  delivery_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '物流费用（礼品有效）',
  balance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额红包（余额有效）',
  state int(11) NOT NULL DEFAULT 1 COMMENT '状态（上下架）',
  content text DEFAULT NULL COMMENT '兑换说明',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  pay_type int(11) NOT NULL DEFAULT 0 COMMENT '兑换类型 0-积分 1-积分+余额',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '积分兑换(主表)',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_exchange_site_id` on table `promotion_exchange_goods`
--
ALTER TABLE promotion_exchange_goods
ADD INDEX IDX_ns_promotion_exchange_site_id (site_id);

--
-- `IDX_ns_promotion_exchange_state` on table `promotion_exchange_goods`
--
ALTER TABLE promotion_exchange_goods
ADD INDEX IDX_ns_promotion_exchange_state (state);

--
-- `IDX_ns_promotion_exchange_type` on table `promotion_exchange_goods`
--
ALTER TABLE promotion_exchange_goods
ADD INDEX IDX_ns_promotion_exchange_type (type);

--
-- `IDX_ns_promotion_exchange_type_id` on table `promotion_exchange_goods`
--
ALTER TABLE promotion_exchange_goods
ADD INDEX IDX_ns_promotion_exchange_type_id (type_id);

--
-- `promotion_exchange`
--
CREATE TABLE promotion_exchange (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT ' 站点id',
  type int(11) NOT NULL DEFAULT 1 COMMENT '兑换形式',
  type_name varchar(255) NOT NULL DEFAULT '' COMMENT '兑换类型名称',
  type_id int(11) NOT NULL DEFAULT 0 COMMENT '关联id',
  name varchar(255) NOT NULL DEFAULT '' COMMENT '兑换名称',
  image varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  stock int(11) NOT NULL DEFAULT 0 COMMENT '当前库存',
  pay_type tinyint(1) NOT NULL DEFAULT 0 COMMENT '支付类型（0积分  1积分加钱）',
  point int(11) NOT NULL DEFAULT 0 COMMENT '积分数',
  market_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '市场价',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '兑换价',
  limit_num int(11) NOT NULL DEFAULT 0 COMMENT '限制兑换数量',
  delivery_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '物流费用（礼品有效）',
  balance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额红包（余额有效）',
  state int(11) NOT NULL DEFAULT 1 COMMENT '状态（上下架）',
  content text DEFAULT NULL COMMENT '兑换说明',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  exchange_goods_id int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '积分兑换',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_exchange_site_id` on table `promotion_exchange`
--
ALTER TABLE promotion_exchange
ADD INDEX IDX_ns_promotion_exchange_site_id (site_id);

--
-- `IDX_ns_promotion_exchange_state` on table `promotion_exchange`
--
ALTER TABLE promotion_exchange
ADD INDEX IDX_ns_promotion_exchange_state (state);

--
-- `IDX_ns_promotion_exchange_type` on table `promotion_exchange`
--
ALTER TABLE promotion_exchange
ADD INDEX IDX_ns_promotion_exchange_type (type);

--
-- `IDX_ns_promotion_exchange_type_id` on table `promotion_exchange`
--
ALTER TABLE promotion_exchange
ADD INDEX IDX_ns_promotion_exchange_type_id (type_id);

--
-- `promotion_discount_goods`
--
CREATE TABLE promotion_discount_goods (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  discount_id int(11) NOT NULL DEFAULT 0 COMMENT '对应活动Id',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'skuId',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品价格',
  discount_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '折扣价',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_image varchar(1000) NOT NULL DEFAULT '0' COMMENT '商品图片',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '限时折扣商品列表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_discount_goods_discount_id` on table `promotion_discount_goods`
--
ALTER TABLE promotion_discount_goods
ADD INDEX IDX_ns_promotion_discount_goods_discount_id (discount_id);

--
-- `IDX_ns_promotion_discount_goods_end_time` on table `promotion_discount_goods`
--
ALTER TABLE promotion_discount_goods
ADD INDEX IDX_ns_promotion_discount_goods_end_time (end_time);

--
-- `IDX_ns_promotion_discount_goods_goods_id` on table `promotion_discount_goods`
--
ALTER TABLE promotion_discount_goods
ADD INDEX IDX_ns_promotion_discount_goods_goods_id (goods_id);

--
-- `IDX_ns_promotion_discount_goods_sku_id` on table `promotion_discount_goods`
--
ALTER TABLE promotion_discount_goods
ADD INDEX IDX_ns_promotion_discount_goods_sku_id (sku_id);

--
-- `IDX_ns_promotion_discount_goods_start_time` on table `promotion_discount_goods`
--
ALTER TABLE promotion_discount_goods
ADD INDEX IDX_ns_promotion_discount_goods_start_time (start_time);

--
-- `promotion_discount`
--
CREATE TABLE promotion_discount (
  discount_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 1 COMMENT '站点id',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  discount_name varchar(255) NOT NULL DEFAULT '' COMMENT '活动名称',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '活动状态 0未开始 1进行中 2已结束 -1已关闭（手动）',
  remark varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  discount_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '折扣金额，只做展示',
  PRIMARY KEY (discount_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '限时折扣',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_discount_end_time` on table `promotion_discount`
--
ALTER TABLE promotion_discount
ADD INDEX IDX_ns_promotion_discount_end_time (end_time);

--
-- `IDX_ns_promotion_discount_start_time` on table `promotion_discount`
--
ALTER TABLE promotion_discount
ADD INDEX IDX_ns_promotion_discount_start_time (start_time);

--
-- `IDX_ns_promotion_discount_status` on table `promotion_discount`
--
ALTER TABLE promotion_discount
ADD INDEX IDX_ns_promotion_discount_status (status);

--
-- `promotion_coupon_type`
--
CREATE TABLE promotion_coupon_type (
  coupon_type_id int(11) NOT NULL AUTO_INCREMENT COMMENT '优惠券类型Id',
  type varchar(32) NOT NULL DEFAULT '' COMMENT '优惠券类型 reward-满减 discount-折扣 random-随机',
  site_id int(11) NOT NULL DEFAULT 1 COMMENT '站点id',
  coupon_name varchar(50) NOT NULL DEFAULT '' COMMENT '优惠券名称',
  coupon_name_remark varchar(255) NOT NULL DEFAULT '' COMMENT '名称备注',
  image varchar(255) NOT NULL DEFAULT '' COMMENT '优惠券图片',
  count int(11) NOT NULL DEFAULT 0 COMMENT '发放数量',
  lead_count int(11) NOT NULL DEFAULT 0 COMMENT '已领取数量',
  used_count int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已使用数量',
  goods_type tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '适用商品类型1-全部商品可用；2-指定商品可用；3-指定商品不可用',
  goods_ids varchar(2000) NOT NULL DEFAULT '' COMMENT '适用商品id',
  is_limit tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用门槛0-无门槛 1-有门槛',
  at_least decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '满多少元使用 0代表无限制',
  money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '发放面额 当type为reward时需要添加',
  discount decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '1 =< 折扣 <= 9.9 当type为discount时需要添加',
  discount_limit decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '最多折扣金额 当type为discount时可选择性添加',
  min_money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '最低金额 当type为radom时需要添加',
  max_money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '最大金额 当type为radom时需要添加',
  validity_type tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '过期类型1-时间范围过期 2-领取之日固定日期后过期 3-领取次日固定日期后过期',
  start_use_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用开始日期 过期类型1时必填',
  end_use_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用结束日期 过期类型1时必填',
  fixed_term int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当validity_type为2或者3时需要添加 领取之日起或者次日N天内有效',
  is_limit_member tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否限制会员身份0-不限制 1限制',
  member_level_ids varchar(255) NOT NULL DEFAULT '' COMMENT '若开启会员身份限制,需要添加会员等级id',
  is_limitless tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否无限制0-否 1是',
  max_fetch int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '每人最大领取个数',
  is_expire_notice tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否开启过期提醒0-不开启 1-开启',
  expire_notice_fixed_term int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '过期前N天提醒',
  is_mark tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否同时给会员打标签 0-否 1-是',
  member_label_ids varchar(255) NOT NULL DEFAULT '' COMMENT '会员标签id',
  is_share tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分享设置 优惠券允许分享给好友领取',
  is_handsel tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '转赠设置 优惠券允许转赠给好友',
  is_forbid_preference tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠叠加 0-不限制 1- 优惠券仅原价购买商品时可用',
  is_show int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否显示',
  discount_order_money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '订单的优惠总金额',
  order_money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '用券总成交额',
  is_forbidden tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否禁止发放0-否 1-是',
  old_member_num int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用优惠券的老会员数',
  new_member_num int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '平台第一次购买使用优惠券的会员数',
  order_goods_num int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用优惠券购买的商品数量',
  status int(11) NOT NULL DEFAULT 0 COMMENT '状态（1进行中2已结束-1已关闭）',
  create_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  update_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '修改时间',
  end_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '有效日期结束时间',
  PRIMARY KEY (coupon_type_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '优惠券类型表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_coupon_type_site_id` on table `promotion_coupon_type`
--
ALTER TABLE promotion_coupon_type
ADD INDEX IDX_ns_promotion_coupon_type_site_id (site_id);

--
-- `promotion_coupon`
--
CREATE TABLE promotion_coupon (
  coupon_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '优惠券id',
  type varchar(255) NOT NULL DEFAULT '' COMMENT '优惠券类型 reward-满减 discount-折扣 random-随机',
  coupon_name varchar(50) NOT NULL DEFAULT '' COMMENT '优惠券名称',
  coupon_type_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠券类型id',
  site_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点Id',
  coupon_code varchar(255) NOT NULL DEFAULT '' COMMENT '优惠券编码',
  member_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '领用人',
  use_order_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠券使用订单id',
  goods_type tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '适用商品类型1-全部商品可用；2-指定商品可用；3-指定商品不可用',
  goods_ids varchar(2000) NOT NULL DEFAULT '' COMMENT '适用商品id',
  at_least decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '最小金额',
  money decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '面额',
  discount decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '1 =< 折扣 <= 9.9 当type为discount时需要添加',
  discount_limit decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '最多折扣金额 当type为discount时可选择性添加',
  is_mark tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否同时给会员打标签 0-否 1-是',
  member_label_ids varchar(255) NOT NULL DEFAULT '' COMMENT '会员标签id',
  is_share tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分享设置 优惠券允许分享给好友领取',
  is_handsel tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '转赠设置 优惠券允许转赠给好友',
  is_forbid_preference tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠叠加 0-不限制 1- 优惠券仅原价购买商品时可用',
  is_expire_notice tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否开启过期提醒0-不开启 1-开启',
  expire_notice_fixed_term int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '过期前N天提醒',
  is_noticed tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否已提醒',
  state tinyint(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠券状态 1已领用（未使用） 2已使用 3已过期',
  get_type tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '获取方式1订单2.直接领取3.活动领取 4转赠 5分享获取',
  related_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '获取优惠券的关联id',
  fetch_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '领取时间',
  use_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用时间',
  start_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '可使用的开始时间',
  end_time int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '有效期结束时间',
  PRIMARY KEY (coupon_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '优惠券表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_coupon_coupon_type_id` on table `promotion_coupon`
--
ALTER TABLE promotion_coupon
ADD INDEX IDX_ns_promotion_coupon_coupon_type_id (coupon_type_id);

--
-- `IDX_ns_promotion_coupon_end_time` on table `promotion_coupon`
--
ALTER TABLE promotion_coupon
ADD INDEX IDX_ns_promotion_coupon_end_time (end_time);

--
-- `IDX_ns_promotion_coupon_member_id` on table `promotion_coupon`
--
ALTER TABLE promotion_coupon
ADD INDEX IDX_ns_promotion_coupon_member_id (member_id);

--
-- `IDX_ns_promotion_coupon_site_id` on table `promotion_coupon`
--
ALTER TABLE promotion_coupon
ADD INDEX IDX_ns_promotion_coupon_site_id (site_id);

--
-- `promotion_bundling_goods`
--
CREATE TABLE promotion_bundling_goods (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  bl_id int(11) NOT NULL DEFAULT 0 COMMENT '组合id',
  sku_id int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品skuid',
  sku_name varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品sku原价',
  sku_image varchar(100) NOT NULL DEFAULT '' COMMENT 'sku图片',
  promotion_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '套餐价格',
  site_id int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '组合套餐活动商品表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_bundling_goods_bl_id` on table `promotion_bundling_goods`
--
ALTER TABLE promotion_bundling_goods
ADD INDEX IDX_ns_promotion_bundling_goods_bl_id (bl_id);

--
-- `IDX_ns_promotion_bundling_goods_site_id` on table `promotion_bundling_goods`
--
ALTER TABLE promotion_bundling_goods
ADD INDEX IDX_ns_promotion_bundling_goods_site_id (site_id);

--
-- `IDX_ns_promotion_bundling_goods_sku_id` on table `promotion_bundling_goods`
--
ALTER TABLE promotion_bundling_goods
ADD INDEX IDX_ns_promotion_bundling_goods_sku_id (sku_id);

--
-- `promotion_bundling`
--
CREATE TABLE promotion_bundling (
  bl_id int(11) NOT NULL AUTO_INCREMENT COMMENT '组合ID',
  bl_name varchar(50) NOT NULL DEFAULT '' COMMENT '组合名称',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  site_name varchar(100) NOT NULL DEFAULT '' COMMENT '站点名称',
  bl_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品组合价格',
  goods_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品总价',
  shipping_fee_type tinyint(1) NOT NULL DEFAULT 1 COMMENT '运费承担方式 1卖家承担运费 2买家承担运费',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT '组合状态 0-关闭/1-开启',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (bl_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '组合套餐活动表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_bundling_site_id` on table `promotion_bundling`
--
ALTER TABLE promotion_bundling
ADD INDEX IDX_ns_promotion_bundling_site_id (site_id);

--
-- `IDX_ns_promotion_bundling_status` on table `promotion_bundling`
--
ALTER TABLE promotion_bundling
ADD INDEX IDX_ns_promotion_bundling_status (status);

--
-- `promotion_bargain_record`
--
CREATE TABLE promotion_bargain_record (
  id int(11) NOT NULL AUTO_INCREMENT,
  launch_id int(11) NOT NULL DEFAULT 0 COMMENT '砍价发起id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '帮砍会员id',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '昵称',
  headimg varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '帮砍金额',
  bargain_time int(11) NOT NULL DEFAULT 0 COMMENT '帮砍时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_bargain_record_bargain_time` on table `promotion_bargain_record`
--
ALTER TABLE promotion_bargain_record
ADD INDEX IDX_ns_promotion_bargain_record_bargain_time (bargain_time);

--
-- `IDX_ns_promotion_bargain_record_launch_id` on table `promotion_bargain_record`
--
ALTER TABLE promotion_bargain_record
ADD INDEX IDX_ns_promotion_bargain_record_launch_id (launch_id);

--
-- `IDX_ns_promotion_bargain_record_member_id` on table `promotion_bargain_record`
--
ALTER TABLE promotion_bargain_record
ADD INDEX IDX_ns_promotion_bargain_record_member_id (member_id);

--
-- `promotion_bargain_launch`
--
CREATE TABLE promotion_bargain_launch (
  launch_id int(11) NOT NULL AUTO_INCREMENT,
  bargain_id int(11) NOT NULL DEFAULT 0 COMMENT '砍价活动id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品sku_id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '商品图',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品原价',
  floor_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '底价',
  buy_type int(1) NOT NULL DEFAULT 0 COMMENT '购买方式（0任意金额可购买 1砍到指定价格）',
  bargain_type int(1) NOT NULL DEFAULT 0 COMMENT '砍价金额类型（0固定金额 1随机金额）',
  need_num int(11) NOT NULL DEFAULT 0 COMMENT '帮砍人数需达到数',
  curr_num int(11) NOT NULL DEFAULT 0 COMMENT '当前已帮砍人数',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  status int(1) NOT NULL DEFAULT 0 COMMENT '0砍价中 1已成功 2未成功',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '砍价发起用户',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '昵称',
  headimg varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  is_fenxiao int(1) NOT NULL DEFAULT 0 COMMENT '是否参与分销（0不参与  1参与）',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  first_bargain_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '首刀金额',
  curr_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '当前金额',
  is_own int(11) NOT NULL DEFAULT 0 COMMENT '是否自己砍价（0不支持  1支持）',
  PRIMARY KEY (launch_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '砍价发起表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_bargain_launch_bargain_id` on table `promotion_bargain_launch`
--
ALTER TABLE promotion_bargain_launch
ADD INDEX IDX_ns_promotion_bargain_launch_bargain_id (bargain_id);

--
-- `IDX_ns_promotion_bargain_launch_end_time` on table `promotion_bargain_launch`
--
ALTER TABLE promotion_bargain_launch
ADD INDEX IDX_ns_promotion_bargain_launch_end_time (end_time);

--
-- `IDX_ns_promotion_bargain_launch_goods_id` on table `promotion_bargain_launch`
--
ALTER TABLE promotion_bargain_launch
ADD INDEX IDX_ns_promotion_bargain_launch_goods_id (goods_id);

--
-- `IDX_ns_promotion_bargain_launch_site_id` on table `promotion_bargain_launch`
--
ALTER TABLE promotion_bargain_launch
ADD INDEX IDX_ns_promotion_bargain_launch_site_id (site_id);

--
-- `IDX_ns_promotion_bargain_launch_sku_id` on table `promotion_bargain_launch`
--
ALTER TABLE promotion_bargain_launch
ADD INDEX IDX_ns_promotion_bargain_launch_sku_id (sku_id);

--
-- `IDX_ns_promotion_bargain_launch_start_time` on table `promotion_bargain_launch`
--
ALTER TABLE promotion_bargain_launch
ADD INDEX IDX_ns_promotion_bargain_launch_start_time (start_time);

--
-- `promotion_bargain_goods`
--
CREATE TABLE promotion_bargain_goods (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺id',
  bargain_id int(11) NOT NULL DEFAULT 0 COMMENT '砍价id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'sku商品id',
  first_bargain_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '首刀金额',
  bargain_stock int(11) NOT NULL DEFAULT 0 COMMENT '砍价库存',
  floor_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '底价',
  bargain_name varchar(50) NOT NULL DEFAULT '' COMMENT '砍价活动名称',
  is_fenxiao tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否参与分销（0不参与  1参与）',
  buy_type tinyint(1) NOT NULL DEFAULT 0 COMMENT '购买方式（0任意金额可购买 1砍到指定价格）',
  bargain_type tinyint(1) NOT NULL DEFAULT 0 COMMENT '砍价金额类型（0固定金额 1随机金额）',
  bargain_num int(11) NOT NULL DEFAULT 0 COMMENT '帮砍价人数',
  bargain_time int(11) NOT NULL DEFAULT 1 COMMENT '砍价有效期',
  remark text NOT NULL COMMENT '活动规则说明',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态（0未开始 1活动进行中  2活动已结束  3已关闭）',
  status_name varchar(20) NOT NULL DEFAULT '' COMMENT '状态名称',
  is_own tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否自己砍价（0不支持  1支持）',
  sale_num int(11) NOT NULL DEFAULT 0 COMMENT '销量',
  join_num int(11) NOT NULL DEFAULT 0 COMMENT '参与人数',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '砍价活动表';

--
-- `IDX_ns_promotion_bargain_goods_bargain_id` on table `promotion_bargain_goods`
--
ALTER TABLE promotion_bargain_goods
ADD INDEX IDX_ns_promotion_bargain_goods_bargain_id (bargain_id);

--
-- `IDX_ns_promotion_bargain_goods_goods_id` on table `promotion_bargain_goods`
--
ALTER TABLE promotion_bargain_goods
ADD INDEX IDX_ns_promotion_bargain_goods_goods_id (goods_id);

--
-- `IDX_ns_promotion_bargain_goods_is_own` on table `promotion_bargain_goods`
--
ALTER TABLE promotion_bargain_goods
ADD INDEX IDX_ns_promotion_bargain_goods_is_own (is_own);

--
-- `IDX_ns_promotion_bargain_goods_sku_id` on table `promotion_bargain_goods`
--
ALTER TABLE promotion_bargain_goods
ADD INDEX IDX_ns_promotion_bargain_goods_sku_id (sku_id);

--
-- `IDX_ns_promotion_bargain_goods_status` on table `promotion_bargain_goods`
--
ALTER TABLE promotion_bargain_goods
ADD INDEX IDX_ns_promotion_bargain_goods_status (status);

--
-- `promotion_bargain`
--
CREATE TABLE promotion_bargain (
  bargain_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '砍价id',
  site_id int(11) NOT NULL COMMENT '店铺id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'sku_id',
  bargain_name varchar(50) NOT NULL DEFAULT '' COMMENT '砍价活动名称',
  is_fenxiao tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否参与分销（0不参与  1参与）',
  buy_type tinyint(1) NOT NULL DEFAULT 0 COMMENT '购买方式（0任意金额可购买 1砍到指定价格）',
  bargain_type tinyint(1) NOT NULL DEFAULT 0 COMMENT '砍价金额类型（0固定金额 1随机金额）',
  bargain_num int(11) NOT NULL DEFAULT 0 COMMENT '帮砍价人数',
  bargain_time int(11) NOT NULL DEFAULT 1 COMMENT '砍价有效期（小时）',
  remark text CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL COMMENT '活动规则说明',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态（0未开始 1活动进行中  2活动已结束  3失效  4删除）',
  status_name varchar(20) NOT NULL DEFAULT '' COMMENT '状态名称',
  is_own tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否自己砍价（0不支持  1支持）',
  sale_num int(11) NOT NULL DEFAULT 0 COMMENT '销量',
  join_num int(11) NOT NULL DEFAULT 0 COMMENT '参与人数',
  bargain_stock int(11) NOT NULL DEFAULT 0 COMMENT '砍价总库存',
  floor_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '底价',
  PRIMARY KEY (bargain_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '砍价活动表';

--
-- `IDX_ns_promotion_bargain_end_time` on table `promotion_bargain`
--
ALTER TABLE promotion_bargain
ADD INDEX IDX_ns_promotion_bargain_end_time (end_time);

--
-- `IDX_ns_promotion_bargain_start_time` on table `promotion_bargain`
--
ALTER TABLE promotion_bargain
ADD INDEX IDX_ns_promotion_bargain_start_time (start_time);

--
-- `printer_template`
--
CREATE TABLE printer_template (
  template_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名',
  template_type varchar(255) NOT NULL DEFAULT '' COMMENT '模板类型（预留字段）',
  template_name varchar(255) NOT NULL DEFAULT '' COMMENT '模板名称',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '小票名称',
  head tinyint(1) NOT NULL DEFAULT 0 COMMENT '头部内容',
  buy_notes tinyint(1) NOT NULL DEFAULT 0 COMMENT '买家留言（0否 1是）',
  seller_notes tinyint(1) NOT NULL DEFAULT 0 COMMENT '卖家留言（0否  1是）',
  buy_name tinyint(1) NOT NULL DEFAULT 0 COMMENT '买家姓名',
  buy_mobile tinyint(1) NOT NULL DEFAULT 0 COMMENT '买家联系电话',
  buy_address tinyint(1) NOT NULL DEFAULT 0 COMMENT '买家地址',
  shop_mobile tinyint(1) NOT NULL DEFAULT 0 COMMENT '商家联系电话',
  shop_address tinyint(1) NOT NULL DEFAULT 0 COMMENT '商家地址',
  shop_qrcode tinyint(1) NOT NULL DEFAULT 0 COMMENT '商家二维码',
  qrcode_url varchar(255) NOT NULL DEFAULT '' COMMENT '二维码链接',
  bottom varchar(255) NOT NULL DEFAULT '' COMMENT '底部内容',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (template_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '打印机模板',
ROW_FORMAT = DYNAMIC;

--
-- `printer`
--
CREATE TABLE printer (
  printer_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  brand varchar(255) NOT NULL DEFAULT '' COMMENT '小票打印机品牌（365 飞鹤 易联云）',
  printer_name varchar(255) NOT NULL DEFAULT '' COMMENT '打印机名称',
  printer_code varchar(255) NOT NULL DEFAULT '' COMMENT '打印机编号',
  printer_key varchar(255) NOT NULL DEFAULT '' COMMENT '打印机秘钥',
  open_id varchar(255) NOT NULL DEFAULT '' COMMENT '开发者id',
  apikey varchar(255) NOT NULL DEFAULT '' COMMENT '开发者密钥',
  print_num tinyint(3) NOT NULL DEFAULT 1 COMMENT '打印张数',
  order_type varchar(255) NOT NULL DEFAULT '' COMMENT '打印的订单类型',
  template_id int(11) NOT NULL DEFAULT 0 COMMENT '模板id',
  store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (printer_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '小票打印机',
ROW_FORMAT = DYNAMIC;

--
-- `pay_refund`
--
CREATE TABLE pay_refund (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  refund_no varchar(255) NOT NULL DEFAULT '' COMMENT '退款编号',
  out_trade_no varchar(255) NOT NULL DEFAULT '' COMMENT '对应支付流水号',
  refund_detail varchar(255) NOT NULL DEFAULT '' COMMENT '退款详情',
  refund_type varchar(255) NOT NULL DEFAULT '' COMMENT '退款类型',
  refund_fee decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '退款金额',
  total_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '实际支付金额',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '退款记录',
ROW_FORMAT = DYNAMIC;

--
-- `UK_ns_pay_refund_out_trade_no` on table `pay_refund`
--
ALTER TABLE pay_refund
ADD INDEX UK_ns_pay_refund_out_trade_no (out_trade_no);

--
-- `pay`
--
CREATE TABLE pay (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  out_trade_no varchar(255) NOT NULL DEFAULT '' COMMENT '支付流水号',
  pay_type varchar(255) NOT NULL DEFAULT '' COMMENT '支付方式',
  trade_no varchar(255) NOT NULL DEFAULT '' COMMENT '交易单号',
  pay_no varchar(255) NOT NULL DEFAULT '' COMMENT '支付账号',
  pay_body varchar(1000) NOT NULL DEFAULT '' COMMENT '支付主体',
  pay_detail varchar(1000) NOT NULL DEFAULT '' COMMENT '支付详情',
  pay_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '支付金额',
  pay_addon varchar(255) NOT NULL DEFAULT '' COMMENT '支付插件',
  pay_voucher varchar(255) NOT NULL DEFAULT '' COMMENT '支付票据',
  pay_status int(11) NOT NULL DEFAULT 0 COMMENT '支付状态（0.待支付 1. 支付中 2. 已支付 -1已取消）',
  return_url varchar(255) NOT NULL DEFAULT '' COMMENT '同步回调网址',
  event varchar(255) NOT NULL DEFAULT '' COMMENT '支付成功后事件(事件，网址)',
  mch_info varchar(1000) NOT NULL DEFAULT '' COMMENT '商户信息',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  pay_time int(11) NOT NULL DEFAULT 0 COMMENT '支付时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '支付记录',
ROW_FORMAT = DYNAMIC;

--
-- `UK_ns_pay_out_trade_no` on table `pay`
--
ALTER TABLE pay
ADD UNIQUE INDEX UK_ns_pay_out_trade_no (out_trade_no);

--
-- `order_refund_log`
--
CREATE TABLE order_refund_log (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  order_goods_id int(11) NOT NULL DEFAULT 0 COMMENT '订单项id',
  refund_status int(11) NOT NULL DEFAULT 0 COMMENT '退款状态',
  refund_status_name varchar(255) NOT NULL DEFAULT '' COMMENT '退款状态名称',
  action varchar(255) NOT NULL DEFAULT '' COMMENT '操作内容',
  action_way int(11) NOT NULL DEFAULT 2 COMMENT '操作类型1买家2卖家',
  action_userid int(11) NOT NULL DEFAULT 0 COMMENT '操作人id',
  username varchar(255) NOT NULL DEFAULT '' COMMENT '操作人名称',
  action_time int(11) NOT NULL DEFAULT 0 COMMENT '操作时间',
  `desc` text NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单退款操作表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_order_refund_log_order_goods_id` on table `order_refund_log`
--
ALTER TABLE order_refund_log
ADD INDEX IDX_ns_order_refund_log_order_goods_id (order_goods_id, site_id);

--
-- `order_refund_export`
--
CREATE TABLE order_refund_export (
  export_id int(11) NOT NULL AUTO_INCREMENT,
  `condition` varchar(2000) NOT NULL DEFAULT '' COMMENT '条件  json',
  status int(11) NOT NULL DEFAULT 0 COMMENT '导出状态  0 正在导出 1 已导出  2 已删除',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '导出时间',
  path varchar(255) NOT NULL DEFAULT '' COMMENT '导出文件的物理路径',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  PRIMARY KEY (export_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单维权导出记录表',
ROW_FORMAT = DYNAMIC;

--
-- `order_promotion_detail`
--
CREATE TABLE order_promotion_detail (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL COMMENT '站点id',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  promotion_text varchar(255) NOT NULL DEFAULT '' COMMENT '订单优惠说明',
  sku_list varchar(255) NOT NULL DEFAULT '' COMMENT '参与的商品项',
  type int(11) NOT NULL DEFAULT 0 COMMENT '类型 1优惠，2赠送',
  num int(11) NOT NULL DEFAULT 0 COMMENT '相关数量',
  money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '相关金额',
  type_event varchar(255) NOT NULL DEFAULT '' COMMENT '相关执行事件',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单满减优惠表',
ROW_FORMAT = DYNAMIC;

--
-- `order_log`
--
CREATE TABLE order_log (
  id int(11) NOT NULL AUTO_INCREMENT,
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  action varchar(255) NOT NULL DEFAULT '' COMMENT '操作',
  uid int(11) NOT NULL DEFAULT 0 COMMENT '操作人id',
  nick_name varchar(50) NOT NULL DEFAULT '' COMMENT '操作元',
  order_status int(11) NOT NULL DEFAULT 0 COMMENT '订单状态',
  action_way bigint(2) NOT NULL DEFAULT 0,
  order_status_name varchar(255) NOT NULL DEFAULT '' COMMENT '订单状态名称',
  action_time int(11) NOT NULL DEFAULT 0 COMMENT '操作时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单操作表(传统表，不用设计)',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_order_log_order_id` on table `order_log`
--
ALTER TABLE order_log
ADD INDEX IDX_ns_order_log_order_id (order_id);

--
-- `order_import_file_log`
--
CREATE TABLE order_import_file_log (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0,
  file_id int(11) NOT NULL DEFAULT 0 COMMENT '上传文件id',
  order_no varchar(255) NOT NULL DEFAULT '' COMMENT '订单编号',
  order_name varchar(255) NOT NULL DEFAULT '' COMMENT '订单内容',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  reason varchar(255) NOT NULL DEFAULT '' COMMENT '原因',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单导入明细',
ROW_FORMAT = DYNAMIC;

--
-- `order_import_file`
--
CREATE TABLE order_import_file (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0,
  filename varchar(255) NOT NULL DEFAULT '' COMMENT '文件名称',
  path varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  order_num int(11) NOT NULL DEFAULT 0 COMMENT '导入的订单数',
  success_num int(11) NOT NULL DEFAULT 0 COMMENT '成功数',
  error_num int(11) NOT NULL DEFAULT 0 COMMENT '失败数',
  create_time int(11) NOT NULL DEFAULT 0,
  delivery_time int(11) NOT NULL DEFAULT 0 COMMENT '发货时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单批量导入发货',
ROW_FORMAT = DYNAMIC;

--
-- `order_goods`
--
CREATE TABLE order_goods (
  order_goods_id int(11) NOT NULL AUTO_INCREMENT,
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  order_no varchar(20) NOT NULL DEFAULT '' COMMENT '订单编号',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '商家id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '购买会员id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品skuid',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  sku_no varchar(255) NOT NULL DEFAULT '' COMMENT '商品编码',
  is_virtual int(11) NOT NULL DEFAULT 0 COMMENT '是否是虚拟商品',
  goods_class int(11) NOT NULL DEFAULT 0 COMMENT '商品种类(1.实物 2.虚拟3.卡券)',
  goods_class_name varchar(50) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品卖价',
  cost_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '成本价',
  num int(11) NOT NULL DEFAULT 0 COMMENT '购买数量',
  goods_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品总价',
  cost_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '成本总价',
  delivery_status int(11) NOT NULL DEFAULT 0 COMMENT '配送状态',
  delivery_no varchar(50) NOT NULL DEFAULT '' COMMENT '配送单号',
  gift_flag int(11) NOT NULL DEFAULT 0 COMMENT '赠品标识',
  refund_no varchar(50) NOT NULL DEFAULT '' COMMENT '退款编号（申请产生）',
  refund_status int(11) NOT NULL DEFAULT 0 COMMENT '退款状态',
  refund_status_name varchar(50) NOT NULL DEFAULT '' COMMENT '退款状态名称',
  refund_status_action varchar(1000) NOT NULL DEFAULT '' COMMENT '退款操作',
  refund_type int(11) NOT NULL DEFAULT 0 COMMENT '退款方式',
  refund_apply_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '退款申请金额',
  refund_reason varchar(255) NOT NULL DEFAULT '' COMMENT '退款原因',
  refund_real_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '实际退款金额',
  refund_delivery_name varchar(50) NOT NULL DEFAULT '' COMMENT '退款公司名称',
  refund_delivery_no varchar(20) NOT NULL DEFAULT '' COMMENT '退款单号',
  refund_time int(11) NOT NULL DEFAULT 0 COMMENT '实际退款时间',
  refund_refuse_reason varchar(255) NOT NULL DEFAULT '' COMMENT '退款拒绝原因',
  refund_action_time int(11) NOT NULL DEFAULT 0 COMMENT '退款时间',
  delivery_status_name varchar(50) NOT NULL DEFAULT '' COMMENT '配送状态名称',
  real_goods_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '实际商品购买价',
  refund_remark varchar(255) NOT NULL DEFAULT '' COMMENT '退款说明',
  refund_delivery_remark varchar(255) NOT NULL DEFAULT '' COMMENT '买家退货说明',
  refund_address varchar(255) NOT NULL DEFAULT '' COMMENT '退货地址',
  is_refund_stock int(11) NOT NULL DEFAULT 0 COMMENT '是否返还库存',
  refund_money_type int(11) NOT NULL DEFAULT 1 COMMENT '退款方式   1 原路退款 2线下退款',
  promotion_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '优惠金额',
  coupon_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '优惠券金额',
  adjust_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '调整金额',
  goods_name varchar(400) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_spec_format varchar(1000) NOT NULL DEFAULT '' COMMENT 'sku规格格式',
  is_fenxiao int(1) NOT NULL DEFAULT 1,
  use_point int(11) NOT NULL DEFAULT 0 COMMENT '积分抵扣所用积分数',
  point_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '积分抵扣金额',
  PRIMARY KEY (order_goods_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单商品表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_order_goods_goods_id` on table `order_goods`
--
ALTER TABLE order_goods
ADD INDEX IDX_ns_order_goods_goods_id (goods_id);

--
-- `IDX_ns_order_goods_is_fenxiao` on table `order_goods`
--
ALTER TABLE order_goods
ADD INDEX IDX_ns_order_goods_is_fenxiao (is_fenxiao);

--
-- `IDX_ns_order_goods_is_virtual` on table `order_goods`
--
ALTER TABLE order_goods
ADD INDEX IDX_ns_order_goods_is_virtual (is_virtual);

--
-- `IDX_ns_order_goods_member_id` on table `order_goods`
--
ALTER TABLE order_goods
ADD INDEX IDX_ns_order_goods_member_id (member_id);

--
-- `IDX_ns_order_goods_order_id` on table `order_goods`
--
ALTER TABLE order_goods
ADD INDEX IDX_ns_order_goods_order_id (order_id);

--
-- `IDX_ns_order_goods_refund_status` on table `order_goods`
--
ALTER TABLE order_goods
ADD INDEX IDX_ns_order_goods_refund_status (refund_status);

--
-- `IDX_ns_order_goods_sku_id` on table `order_goods`
--
ALTER TABLE order_goods
ADD INDEX IDX_ns_order_goods_sku_id (sku_id);

--
-- `order_export`
--
CREATE TABLE order_export (
  export_id int(11) NOT NULL AUTO_INCREMENT,
  `condition` varchar(2000) NOT NULL DEFAULT '' COMMENT '条件  json',
  status int(11) NOT NULL DEFAULT 0 COMMENT '导出状态  0 正在导出 1 已导出  2 已删除',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '导出时间',
  type int(11) NOT NULL DEFAULT 0 COMMENT '导出类型',
  path varchar(255) NOT NULL DEFAULT '' COMMENT '导出文件的物理路径',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  PRIMARY KEY (export_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单导出记录表',
ROW_FORMAT = DYNAMIC;

--
-- `order`
--
CREATE TABLE `order` (
  order_id int(11) NOT NULL AUTO_INCREMENT,
  order_no varchar(50) NOT NULL DEFAULT '' COMMENT '订单编号',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '商家id',
  site_name varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名称',
  website_id int(11) NOT NULL DEFAULT 0 COMMENT '分站id',
  order_name varchar(1000) NOT NULL DEFAULT '' COMMENT '订单内容',
  order_from varchar(55) NOT NULL DEFAULT '' COMMENT '订单来源',
  order_from_name varchar(50) NOT NULL DEFAULT '' COMMENT '订单来源名称',
  order_type int(11) NOT NULL DEFAULT 0 COMMENT '订单类型 1. 普通订单  2. 门店订单  3. 本地配送订单4. 虚拟订单',
  order_type_name varchar(50) NOT NULL DEFAULT '' COMMENT '订单类型名称',
  order_promotion_type int(11) NOT NULL DEFAULT 0 COMMENT '订单营销类型',
  order_promotion_name varchar(50) NOT NULL DEFAULT '' COMMENT '营销活动类型名称',
  promotion_id int(11) NOT NULL DEFAULT 0 COMMENT '营销活动id',
  out_trade_no varchar(50) NOT NULL DEFAULT '' COMMENT '支付流水号',
  out_trade_no_2 varchar(50) NOT NULL DEFAULT '' COMMENT '支付流水号（多次支付）',
  delivery_code varchar(50) NOT NULL DEFAULT '' COMMENT '整体提货编码',
  order_status int(11) NOT NULL DEFAULT 0 COMMENT '订单状态',
  order_status_name varchar(50) NOT NULL DEFAULT '' COMMENT '订单状态名称',
  order_status_action varchar(1000) NOT NULL DEFAULT '' COMMENT '订单操作',
  pay_status int(11) NOT NULL DEFAULT 0 COMMENT '支付状态',
  delivery_status int(11) NOT NULL DEFAULT 0 COMMENT '配送状态',
  refund_status int(11) NOT NULL DEFAULT 0 COMMENT '退款状态',
  pay_type varchar(55) NOT NULL DEFAULT '' COMMENT '支付方式',
  pay_type_name varchar(50) NOT NULL DEFAULT '' COMMENT '支付类型名称',
  delivery_type varchar(50) NOT NULL DEFAULT '0' COMMENT '配送方式',
  delivery_type_name varchar(50) NOT NULL DEFAULT '' COMMENT '配送方式名称',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '购买人uid',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '购买人姓名',
  mobile varchar(11) NOT NULL DEFAULT '' COMMENT '购买人手机',
  telephone varchar(20) NOT NULL DEFAULT '' COMMENT '购买人固定电话',
  province_id int(11) NOT NULL DEFAULT 0 COMMENT '购买人省id',
  city_id int(11) NOT NULL DEFAULT 0 COMMENT '购买人市id',
  district_id int(11) NOT NULL DEFAULT 0 COMMENT '购买人区县id',
  community_id int(11) NOT NULL DEFAULT 0 COMMENT '购买人社区id',
  address varchar(255) NOT NULL DEFAULT '' COMMENT '购买人地址',
  full_address varchar(255) NOT NULL DEFAULT '' COMMENT '购买人详细地址',
  longitude varchar(50) NOT NULL DEFAULT '' COMMENT '购买人地址经度',
  latitude varchar(50) NOT NULL DEFAULT '' COMMENT '购买人地址纬度',
  buyer_ip varchar(20) NOT NULL DEFAULT '' COMMENT '购买人ip',
  buyer_ask_delivery_time int(11) NOT NULL DEFAULT 0 COMMENT '购买人要求配送时间',
  buyer_message varchar(50) NOT NULL DEFAULT '' COMMENT '购买人留言信息',
  goods_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品总金额',
  delivery_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '配送费用',
  promotion_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单优惠金额（满减）',
  coupon_id int(11) NOT NULL DEFAULT 0 COMMENT '优惠券id',
  coupon_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '优惠券金额',
  invoice_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '发票金额',
  order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单合计金额',
  adjust_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单调整金额',
  balance_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额支付金额',
  pay_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '抵扣之后应付金额',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  pay_time int(11) NOT NULL DEFAULT 0 COMMENT '订单支付时间',
  delivery_time int(11) NOT NULL DEFAULT 0 COMMENT '订单配送时间',
  sign_time int(11) NOT NULL DEFAULT 0 COMMENT '订单签收时间',
  finish_time int(11) NOT NULL DEFAULT 0 COMMENT '订单完成时间',
  close_time int(11) NOT NULL DEFAULT 0 COMMENT '订单关闭时间',
  is_lock int(11) NOT NULL DEFAULT 0 COMMENT '是否锁定订单（针对维权，锁定不可操作）',
  is_evaluate int(11) NOT NULL DEFAULT 0 COMMENT '是否允许订单评价',
  is_delete int(11) NOT NULL DEFAULT 0 COMMENT '是否删除(针对后台)',
  is_enable_refund int(11) NOT NULL DEFAULT 0 COMMENT '是否允许退款',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '卖家留言',
  goods_num int(11) NOT NULL DEFAULT 0 COMMENT '商品件数',
  delivery_store_id int(11) NOT NULL DEFAULT 0 COMMENT '门店id',
  delivery_status_name varchar(50) NOT NULL DEFAULT '' COMMENT '发货状态',
  is_settlement tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否进行结算',
  store_settlement_id int(11) NOT NULL DEFAULT 0 COMMENT '门店结算id',
  delivery_store_name varchar(255) NOT NULL DEFAULT '' COMMENT '门店名称',
  promotion_type varchar(255) NOT NULL DEFAULT '' COMMENT '营销类型',
  promotion_type_name varchar(255) NOT NULL DEFAULT '' COMMENT '营销类型名称',
  promotion_status_name varchar(255) NOT NULL DEFAULT '' COMMENT '营销状态名称',
  delivery_store_info text DEFAULT NULL COMMENT '门店信息(json)',
  virtual_code varchar(255) NOT NULL DEFAULT '' COMMENT '虚拟商品码',
  evaluate_status int(11) NOT NULL DEFAULT 0 COMMENT '评价状态，0：未评价，1：已评价，2：已追评',
  evaluate_status_name varchar(20) NOT NULL DEFAULT '' COMMENT '评价状态名称，未评价，已评价，已追评',
  refund_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单退款金额',
  commission decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '总支出佣金',
  is_invoice int(11) NOT NULL DEFAULT 0 COMMENT '是否需要发票 0 无发票  1 有发票',
  invoice_type int(11) NOT NULL DEFAULT 1 COMMENT '发票类型  1 纸质发票 2 电子发票',
  invoice_title varchar(255) NOT NULL DEFAULT '' COMMENT '发票抬头',
  taxpayer_number varchar(255) NOT NULL DEFAULT '' COMMENT '纳税人识别号',
  invoice_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '发票税率',
  invoice_content varchar(255) NOT NULL DEFAULT '' COMMENT '发票内容',
  invoice_delivery_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '发票邮寄费用',
  invoice_full_address varchar(255) NOT NULL DEFAULT '' COMMENT '发票邮寄地址',
  is_tax_invoice int(11) NOT NULL DEFAULT 0 COMMENT '是否需要增值税专用发票',
  invoice_email varchar(255) NOT NULL DEFAULT '' COMMENT '发票发送邮件',
  invoice_title_type int(11) NOT NULL DEFAULT 0 COMMENT '发票抬头类型  1 个人  2 企业',
  is_fenxiao int(1) NOT NULL DEFAULT 1 COMMENT '是否参与分销 0不参与 1参与',
  point_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '积分抵现金额',
  PRIMARY KEY (order_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '订单表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_order_create_time` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_create_time (create_time);

--
-- `IDX_ns_order_finish_time` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_finish_time (finish_time);

--
-- `IDX_ns_order_is_tax_invoice` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_is_tax_invoice (is_tax_invoice);

--
-- `IDX_ns_order_member_id` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_member_id (member_id);

--
-- `IDX_ns_order_order_from` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_order_from (order_from);

--
-- `IDX_ns_order_order_status` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_order_status (order_status);

--
-- `IDX_ns_order_order_type` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_order_type (order_type);

--
-- `IDX_ns_order_pay_status` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_pay_status (pay_status);

--
-- `IDX_ns_order_promotion_id` on table `order`
--
ALTER TABLE `order`
ADD INDEX IDX_ns_order_promotion_id (promotion_id);

--
-- `notice`
--
CREATE TABLE notice (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(10) NOT NULL DEFAULT 0 COMMENT '站点id',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '主题',
  content text NOT NULL COMMENT '内容',
  is_top int(11) NOT NULL DEFAULT 0 COMMENT '是否置顶',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  receiving_type varchar(50) NOT NULL DEFAULT '' COMMENT '接受对象',
  receiving_name varchar(50) NOT NULL DEFAULT '' COMMENT '接受对象名称',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '公告排序',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '公告',
ROW_FORMAT = DYNAMIC;

--
-- `notes_group`
--
CREATE TABLE notes_group (
  group_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  group_name varchar(255) NOT NULL DEFAULT '' COMMENT '分组名称',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  notes_num int(11) NOT NULL DEFAULT 0 COMMENT '笔记数',
  release_num int(11) NOT NULL DEFAULT 0 COMMENT '发布数',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (group_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '笔记分组',
ROW_FORMAT = DYNAMIC;

--
-- `notes_dianzan_record`
--
CREATE TABLE notes_dianzan_record (
  record_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  note_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '分组名称',
  PRIMARY KEY (record_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '笔记点赞记录',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_notes_dianzan_record_member_id` on table `notes_dianzan_record`
--
ALTER TABLE notes_dianzan_record
ADD INDEX IDX_ns_notes_dianzan_record_member_id (member_id);

--
-- `IDX_ns_notes_dianzan_record_note_id` on table `notes_dianzan_record`
--
ALTER TABLE notes_dianzan_record
ADD INDEX IDX_ns_notes_dianzan_record_note_id (note_id);

--
-- `notes`
--
CREATE TABLE notes (
  note_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  note_type varchar(255) NOT NULL DEFAULT '' COMMENT '笔记类型',
  note_title varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  note_abstract varchar(255) NOT NULL DEFAULT '' COMMENT '摘要',
  group_id int(11) NOT NULL DEFAULT 0 COMMENT '分组id',
  cover_type tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '封面图片类型（0单图 1多图）',
  cover_img varchar(2000) NOT NULL DEFAULT '' COMMENT '封面图片',
  goods_ids varchar(255) NOT NULL DEFAULT '' COMMENT '商品id（根据类型判断商品是单个还是多个）',
  goods_highlights varchar(255) NOT NULL DEFAULT '' COMMENT '商品亮点（单品有效）',
  note_content text DEFAULT NULL COMMENT '内容',
  status tinyint(3) NOT NULL DEFAULT 0 COMMENT '状态（0草稿箱  1发布）',
  is_show_release_time tinyint(1) NOT NULL DEFAULT 0 COMMENT '发布时间是否显示',
  is_show_read_num tinyint(1) NOT NULL DEFAULT 0 COMMENT '阅读数是否显示',
  is_show_dianzan_num tinyint(1) NOT NULL COMMENT '点赞数是否显示',
  read_num int(11) NOT NULL DEFAULT 0 COMMENT '阅读数',
  dianzan_num int(11) NOT NULL DEFAULT 0 COMMENT '点赞数',
  create_time int(11) DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  initial_read_num int(11) NOT NULL DEFAULT 0 COMMENT '初始阅读数',
  initial_dianzan_num int(11) NOT NULL DEFAULT 0 COMMENT '初始点赞数',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (note_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '店铺笔记',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_promotion_notes_group_id` on table `notes`
--
ALTER TABLE notes
ADD INDEX IDX_ns_promotion_notes_group_id (group_id);

--
-- `IDX_ns_promotion_notes_site_id` on table `notes`
--
ALTER TABLE notes
ADD INDEX IDX_ns_promotion_notes_site_id (site_id);

--
-- `message_wechat_records`
--
CREATE TABLE message_wechat_records (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  open_id varchar(255) NOT NULL DEFAULT '' COMMENT '接收者账号',
  status int(11) NOT NULL DEFAULT 0 COMMENT '发送状态',
  keyword_json varchar(255) NOT NULL DEFAULT '' COMMENT '模板消息字段',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '消息类型关键字',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  send_time int(11) NOT NULL DEFAULT 0 COMMENT '发送时间',
  result varchar(255) NOT NULL DEFAULT '' COMMENT '发送结果',
  url varchar(255) NOT NULL DEFAULT '' COMMENT '发送模板消息携带链接',
  keywords_name varchar(50) NOT NULL DEFAULT '' COMMENT '关键字名称',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '微信公众号消息发送记录',
ROW_FORMAT = DYNAMIC;

--
-- `message_variable`
--
CREATE TABLE message_variable (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(50) NOT NULL DEFAULT '' COMMENT '变量名',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '变量',
  support_message_array varchar(255) NOT NULL DEFAULT '' COMMENT '支持消息',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 4,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '消息模板变量',
ROW_FORMAT = DYNAMIC;

--
-- `message_template`
--
CREATE TABLE message_template (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  addon varchar(255) NOT NULL DEFAULT '' COMMENT '插件',
  keywords varchar(50) NOT NULL DEFAULT '' COMMENT '关键字',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '主题',
  message_type int(11) NOT NULL DEFAULT 1 COMMENT '消息类型 1 买家消息  2 卖家消息',
  message_json varchar(1000) NOT NULL DEFAULT '' COMMENT '配置参数',
  sms_addon varchar(255) NOT NULL DEFAULT '' COMMENT '发送短信插件',
  sms_json varchar(1000) NOT NULL DEFAULT '' COMMENT '短信配置参数',
  sms_content varchar(1000) NOT NULL DEFAULT '' COMMENT '短信内容',
  wechat_json varchar(1000) NOT NULL DEFAULT '' COMMENT '配置参数',
  weapp_json varchar(1000) NOT NULL DEFAULT '' COMMENT '微信小程序配置参数',
  aliapp_json varchar(1000) NOT NULL DEFAULT '' COMMENT '支付宝小程序配置参数',
  support_type varchar(255) NOT NULL DEFAULT '' COMMENT '支持场景 如小程序  wep端',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 28,
AVG_ROW_LENGTH = 862,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '消息管理',
ROW_FORMAT = DYNAMIC;

--
-- `message_sms_records`
--
CREATE TABLE message_sms_records (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  account varchar(255) NOT NULL DEFAULT '' COMMENT '接收人账号',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '消息类型关键字',
  status int(11) NOT NULL DEFAULT 0 COMMENT '发送状态',
  result varchar(255) NOT NULL DEFAULT '' COMMENT '结果',
  content varchar(255) NOT NULL DEFAULT '' COMMENT '短信内容',
  var_parse varchar(255) NOT NULL DEFAULT '' COMMENT '短信内容变量解析 json',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  send_time int(11) NOT NULL DEFAULT 0 COMMENT '发送时间',
  code varchar(255) NOT NULL DEFAULT '' COMMENT '模板编号',
  addon varchar(50) NOT NULL DEFAULT '' COMMENT '发送插件',
  addon_name varchar(50) NOT NULL DEFAULT '' COMMENT '发送方式名称',
  keywords_name varchar(50) NOT NULL DEFAULT '' COMMENT '关键字名称',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  sys_uid int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '短信消息发送记录',
ROW_FORMAT = DYNAMIC;

--
-- `message_send_log`
--
CREATE TABLE message_send_log (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  message_type varchar(255) NOT NULL DEFAULT '' COMMENT '消息类型',
  addon varchar(255) NOT NULL DEFAULT '' COMMENT '执行插件',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '主题',
  message_json varchar(1000) NOT NULL DEFAULT '' COMMENT '消息内容json',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  send_time int(11) NOT NULL DEFAULT 0 COMMENT '发送时间',
  send_log text DEFAULT NULL COMMENT '发送结果',
  is_success int(11) NOT NULL DEFAULT 0 COMMENT '是否发送成功',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '消息发送日志',
ROW_FORMAT = DYNAMIC;

--
-- `message_email_records`
--
CREATE TABLE message_email_records (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  account varchar(255) NOT NULL DEFAULT '' COMMENT '接收者账号',
  status int(11) NOT NULL DEFAULT 0 COMMENT '发送状态',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  content varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '消息类型关键字',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  send_time int(11) NOT NULL DEFAULT 0 COMMENT '发送时间',
  result varchar(255) NOT NULL DEFAULT '' COMMENT '发送结果',
  keywords_name varchar(50) NOT NULL DEFAULT '' COMMENT '关键字名称',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '邮箱信息发送记录',
ROW_FORMAT = DYNAMIC;

--
-- `message`
--
CREATE TABLE message (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  keywords varchar(50) NOT NULL DEFAULT '' COMMENT '关键字',
  sms_is_open tinyint(1) NOT NULL DEFAULT 0 COMMENT '短信消息是否启动',
  wechat_is_open int(11) NOT NULL DEFAULT 0 COMMENT '微信公众号消息',
  wechat_template_id varchar(255) NOT NULL DEFAULT '' COMMENT '微信公众号ID',
  weapp_is_open int(11) NOT NULL DEFAULT 0 COMMENT '微信小程序是否启动',
  weapp_json varchar(1000) NOT NULL DEFAULT '' COMMENT '微信小程序配置参数',
  aliapp_is_open int(11) NOT NULL DEFAULT 0 COMMENT '支付宝小程序是否启动',
  aliapp_json varchar(1000) NOT NULL DEFAULT '' COMMENT '支付宝小程序配置参数',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '消息管理',
ROW_FORMAT = DYNAMIC;

--
-- `menu`
--
CREATE TABLE menu (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  app_module varchar(255) NOT NULL DEFAULT 'admin' COMMENT '应用模块',
  addon varchar(255) NOT NULL DEFAULT '' COMMENT '所属插件',
  title varchar(50) NOT NULL DEFAULT '' COMMENT '菜单标题',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '菜单关键字',
  parent varchar(255) NOT NULL DEFAULT '' COMMENT '上级菜单',
  level int(11) NOT NULL DEFAULT 1 COMMENT '深度等级',
  url varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  is_show tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否展示',
  sort int(10) NOT NULL DEFAULT 0 COMMENT '排序（同级有效）',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  is_icon tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否是矢量菜单图',
  picture varchar(255) NOT NULL DEFAULT '' COMMENT '图片(矢量图)',
  picture_select varchar(255) NOT NULL DEFAULT '' COMMENT '图片(矢量图)(选中)',
  is_control tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否控制权限',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '菜单表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_menu_app_module` on table `menu`
--
ALTER TABLE menu
ADD INDEX IDX_ns_menu_app_module (app_module);

--
-- `IDX_ns_menu_is_control` on table `menu`
--
ALTER TABLE menu
ADD INDEX IDX_ns_menu_is_control (is_control);

--
-- `IDX_ns_menu_is_show` on table `menu`
--
ALTER TABLE menu
ADD INDEX IDX_ns_menu_is_show (is_show);

--
-- `IDX_ns_menu_name` on table `menu`
--
ALTER TABLE menu
ADD INDEX IDX_ns_menu_name (name);

--
-- `IDX_ns_menu_parent` on table `menu`
--
ALTER TABLE menu
ADD INDEX IDX_ns_menu_parent (parent);

--
-- `IDX_ns_menu_url` on table `menu`
--
ALTER TABLE menu
ADD INDEX IDX_ns_menu_url (url);

--
-- `member_withdraw`
--
CREATE TABLE member_withdraw (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  withdraw_no varchar(50) NOT NULL DEFAULT '' COMMENT '提现交易号',
  member_name varchar(50) NOT NULL DEFAULT '' COMMENT '会员姓名',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  transfer_type varchar(20) NOT NULL DEFAULT '0' COMMENT '转账提现类型',
  realname varchar(50) NOT NULL DEFAULT '' COMMENT '真实姓名',
  apply_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现申请金额',
  rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现手续费比率',
  service_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现手续费',
  money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现到账金额',
  apply_time int(11) NOT NULL DEFAULT 0 COMMENT '申请时间',
  audit_time int(11) NOT NULL DEFAULT 0 COMMENT '审核时间',
  payment_time int(11) NOT NULL DEFAULT 0 COMMENT '转账时间',
  status int(11) NOT NULL DEFAULT 0 COMMENT '状态0待审核1.待转账2已转账 -1拒绝',
  memo varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  refuse_reason varchar(100) NOT NULL DEFAULT '' COMMENT '拒绝理由',
  member_headimg varchar(255) NOT NULL DEFAULT '',
  status_name varchar(20) NOT NULL DEFAULT '' COMMENT '提现状态名称',
  transfer_type_name varchar(20) NOT NULL DEFAULT '' COMMENT '转账方式名称',
  bank_name varchar(255) NOT NULL DEFAULT '' COMMENT '银行名称',
  account_number varchar(255) NOT NULL DEFAULT '' COMMENT '收款账号',
  mobile varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  certificate varchar(255) NOT NULL DEFAULT '' COMMENT '凭证',
  certificate_remark varchar(255) NOT NULL DEFAULT '' COMMENT '凭证说明',
  account_name varchar(50) NOT NULL DEFAULT '' COMMENT '账号',
  applet_type int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员提现表',
ROW_FORMAT = DYNAMIC;

--
-- `member_recharge_order`
--
CREATE TABLE member_recharge_order (
  order_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  recharge_id int(11) NOT NULL DEFAULT 0 COMMENT '套餐ID',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺ID',
  site_name varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名称',
  order_no varchar(255) NOT NULL DEFAULT '' COMMENT '订单编号',
  out_trade_no varchar(255) NOT NULL DEFAULT '' COMMENT '订单流水号',
  recharge_name varchar(255) NOT NULL DEFAULT '' COMMENT '套餐名称',
  cover_img varchar(255) NOT NULL DEFAULT '' COMMENT '封面',
  face_value decimal(11, 2) NOT NULL DEFAULT 0.00 COMMENT '面值',
  buy_price decimal(11, 2) NOT NULL DEFAULT 0.00 COMMENT '价格',
  point int(11) NOT NULL DEFAULT 0 COMMENT '积分',
  growth int(11) NOT NULL DEFAULT 0 COMMENT '成长值',
  coupon_id varchar(255) NOT NULL DEFAULT '0' COMMENT '优惠券ID',
  price int(11) NOT NULL DEFAULT 0 COMMENT '实付金额',
  pay_type varchar(20) NOT NULL DEFAULT '' COMMENT '支付方式',
  pay_type_name varchar(255) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  status varchar(255) NOT NULL DEFAULT '1' COMMENT '支付状态（1未支付 2已支付）',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  pay_time int(11) NOT NULL DEFAULT 0 COMMENT '支付时间',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '用户ID',
  member_img varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '用户昵称',
  order_from varchar(50) NOT NULL DEFAULT '' COMMENT '订单来源',
  order_from_name varchar(255) NOT NULL DEFAULT '' COMMENT '订单来源名称',
  PRIMARY KEY (order_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '充值卡订单',
ROW_FORMAT = DYNAMIC;

--
-- `member_recharge_card`
--
CREATE TABLE member_recharge_card (
  card_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  recharge_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '套餐ID',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺ID',
  site_name varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名称',
  card_account varchar(255) NOT NULL DEFAULT '' COMMENT '充值卡号',
  recharge_name varchar(255) NOT NULL DEFAULT '' COMMENT '套餐名称',
  cover_img varchar(255) NOT NULL DEFAULT '' COMMENT '封面',
  face_value decimal(11, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '面值',
  point int(11) NOT NULL DEFAULT 0 COMMENT '积分',
  growth int(11) NOT NULL DEFAULT 0 COMMENT '成长值',
  coupon_id varchar(255) NOT NULL DEFAULT '' COMMENT '优惠券ID',
  buy_price decimal(11, 2) NOT NULL DEFAULT 0.00 COMMENT '购买金额',
  member_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  member_img varchar(255) NOT NULL DEFAULT '' COMMENT '会员头像',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '会员昵称',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单ID',
  order_no varchar(255) NOT NULL DEFAULT '' COMMENT '订单编号',
  from_type tinyint(3) NOT NULL DEFAULT 0 COMMENT '获取来源',
  use_status tinyint(3) NOT NULL DEFAULT 1 COMMENT '使用状态（1未使用 2已使用）',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  use_time int(11) NOT NULL DEFAULT 0 COMMENT '使用时间',
  PRIMARY KEY (card_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '充值卡',
ROW_FORMAT = DYNAMIC;

--
-- `member_recharge`
--
CREATE TABLE member_recharge (
  recharge_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺ID',
  site_name varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名称',
  recharge_name varchar(255) NOT NULL DEFAULT '' COMMENT '套餐名称',
  cover_img varchar(255) NOT NULL DEFAULT '' COMMENT '封面',
  face_value decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '面值',
  buy_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '购买金额',
  point int(11) NOT NULL DEFAULT 0 COMMENT '积分',
  growth int(11) NOT NULL DEFAULT 0 COMMENT '成长值',
  coupon_id varchar(255) NOT NULL DEFAULT '0' COMMENT '优惠券ID',
  sale_num int(11) NOT NULL DEFAULT 0 COMMENT '发放数量',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态（1正常 2关闭）',
  PRIMARY KEY (recharge_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员充值套餐',
ROW_FORMAT = DYNAMIC;

--
-- `member_log`
--
CREATE TABLE member_log (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  action varchar(255) NOT NULL DEFAULT '' COMMENT '操作行为插件',
  action_name varchar(255) NOT NULL DEFAULT '' COMMENT '操作行为名称',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  remark varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员操作日志表',
ROW_FORMAT = DYNAMIC;

--
-- `member_level`
--
CREATE TABLE member_level (
  level_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '会员等级',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  level_name varchar(50) NOT NULL DEFAULT '' COMMENT '等级名称',
  sort int(11) NOT NULL DEFAULT 1 COMMENT '等级排序列',
  growth decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '所需成长值',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  is_default int(11) NOT NULL DEFAULT 0 COMMENT '是否默认，0：否，1：是',
  is_free_shipping tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否包邮',
  consume_discount decimal(10, 2) NOT NULL DEFAULT 100.00 COMMENT '消费折扣',
  point_feedback decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '积分回馈倍率',
  send_point int(11) NOT NULL DEFAULT 0 COMMENT '赠送积分（等级礼包）',
  send_balance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '赠送红包（等级礼包）',
  send_coupon varchar(255) NOT NULL DEFAULT '' COMMENT '赠送优惠券',
  PRIMARY KEY (level_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员等级',
ROW_FORMAT = DYNAMIC;

--
-- `member_label`
--
CREATE TABLE member_label (
  label_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '标签id',
  site_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'site_id',
  label_name varchar(50) NOT NULL DEFAULT '' COMMENT '标签名称',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  remark varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (label_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员标签',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_nc_member_label_label_id` on table `member_label`
--
ALTER TABLE member_label
ADD INDEX IDX_nc_member_label_label_id (label_id);

--
-- `member_import_record`
--
CREATE TABLE member_import_record (
  id int(11) NOT NULL AUTO_INCREMENT,
  member_num int(11) DEFAULT 0 COMMENT '会员总数',
  success_num int(11) DEFAULT 0 COMMENT '会员导入成功数量',
  error_num int(11) DEFAULT 0 COMMENT '会员导入失败数量',
  status_name varchar(255) DEFAULT '' COMMENT '导入状态',
  create_time int(11) DEFAULT 0 COMMENT '导入时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员导入记录',
ROW_FORMAT = DYNAMIC;

--
-- `member_import_log`
--
CREATE TABLE member_import_log (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  mobile varchar(255) NOT NULL DEFAULT '' COMMENT '手机号',
  username varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '昵称',
  password varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  realname varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  wx_openid varchar(255) NOT NULL DEFAULT '' COMMENT '微信公众号openid',
  weapp_openid varchar(255) NOT NULL DEFAULT '' COMMENT '小程序openid',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  content varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  record_id int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员导入记录',
ROW_FORMAT = DYNAMIC;

--
-- `member_cluster`
--
CREATE TABLE member_cluster (
  cluster_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '会员群体ID',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点ID',
  cluster_name varchar(255) NOT NULL DEFAULT '' COMMENT '群体名称',
  rule_json text NOT NULL COMMENT '规则json',
  member_num int(11) NOT NULL DEFAULT 0 COMMENT '群体内会员 数量',
  member_ids text NOT NULL COMMENT '群体内会员ID',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (cluster_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员群体表',
ROW_FORMAT = DYNAMIC;

--
-- `member_cancel`
--
CREATE TABLE member_cancel (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  username varchar(255) NOT NULL DEFAULT '' COMMENT '会员账号',
  mobile varchar(255) NOT NULL DEFAULT '' COMMENT '电话',
  nickname varchar(255) NOT NULL DEFAULT '' COMMENT '会员昵称',
  status tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  audit_uid int(11) NOT NULL DEFAULT 0 COMMENT '审核人UID',
  audit_username varchar(255) NOT NULL DEFAULT '' COMMENT '审核人账号',
  reason varchar(255) NOT NULL DEFAULT '' COMMENT '审核拒绝原因',
  audit_time int(11) NOT NULL DEFAULT 0 COMMENT '审核时间',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '申请注销时间',
  member_json text NOT NULL COMMENT '会员信息',
  fenxiao_json text NOT NULL COMMENT '分销信息',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员注销表',
ROW_FORMAT = DYNAMIC;

--
-- `member_bank_account`
--
CREATE TABLE member_bank_account (
  id int(11) NOT NULL AUTO_INCREMENT,
  member_id int(11) NOT NULL COMMENT '会员id',
  realname varchar(50) NOT NULL DEFAULT '' COMMENT '真实姓名',
  mobile varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  withdraw_type varchar(32) DEFAULT '' COMMENT '账户类型 alipay-支付宝  bank银行卡',
  branch_bank_name varchar(50) NOT NULL DEFAULT '' COMMENT '银行名称',
  bank_account varchar(50) NOT NULL DEFAULT '' COMMENT '银行账号',
  is_default int(11) NOT NULL DEFAULT 0 COMMENT '是否默认账号',
  create_time int(11) DEFAULT 0 COMMENT '创建日期',
  modify_time int(11) DEFAULT 0 COMMENT '修改日期',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员提现账号',
ROW_FORMAT = DYNAMIC;

--
-- `member_auth`
--
CREATE TABLE member_auth (
  auth_id int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员ID',
  member_username varchar(50) NOT NULL DEFAULT '' COMMENT '会员用户名',
  auth_card_name varchar(50) NOT NULL DEFAULT '' COMMENT '实名姓名',
  auth_card_no varchar(18) NOT NULL DEFAULT '' COMMENT '实名身份证',
  auth_card_hand varchar(255) NOT NULL DEFAULT '' COMMENT '申请人手持身份证电子版',
  auth_card_front varchar(255) NOT NULL DEFAULT '' COMMENT '申请人身份证正面',
  auth_card_back varchar(255) NOT NULL DEFAULT '' COMMENT '申请人身份证反面',
  status int(11) NOT NULL DEFAULT 0 COMMENT '审核状态0待审核1.已审核-1已拒绝',
  remark varchar(255) DEFAULT '' COMMENT '审核意见',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  audit_time int(11) NOT NULL DEFAULT 0 COMMENT '审核通过时间',
  PRIMARY KEY (auth_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员实名认证表',
ROW_FORMAT = DYNAMIC;

--
-- `member_address`
--
CREATE TABLE member_address (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  name varchar(255) NOT NULL DEFAULT '' COMMENT '用户姓名',
  mobile varchar(255) NOT NULL DEFAULT '' COMMENT '手机',
  telephone varchar(255) NOT NULL DEFAULT '' COMMENT '联系电话',
  province_id int(11) NOT NULL DEFAULT 0 COMMENT '省id',
  city_id int(11) NOT NULL DEFAULT 0 COMMENT '市id',
  district_id int(11) NOT NULL DEFAULT 0 COMMENT '区县id',
  community_id int(11) NOT NULL DEFAULT 0 COMMENT '社区id',
  address varchar(255) NOT NULL DEFAULT '' COMMENT '地址信息',
  full_address varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址信息',
  longitude varchar(255) NOT NULL DEFAULT '' COMMENT '经度',
  latitude varchar(255) NOT NULL DEFAULT '' COMMENT '纬度',
  is_default tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否是默认地址',
  type int(11) NOT NULL DEFAULT 1 COMMENT '地址类型  1 普通地址  2 定位地址',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '用户地址管理',
ROW_FORMAT = DYNAMIC;

--
-- `member_account`
--
CREATE TABLE member_account (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  account_type varchar(255) NOT NULL DEFAULT 'point' COMMENT '账户类型',
  account_data decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '账户数据',
  from_type varchar(255) NOT NULL DEFAULT '' COMMENT '来源类型',
  type_name varchar(50) NOT NULL DEFAULT '' COMMENT '来源类型名称',
  type_tag varchar(255) NOT NULL DEFAULT '' COMMENT '关联关键字',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '备注信息',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  username varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  mobile varchar(255) NOT NULL DEFAULT '' COMMENT '手机',
  email varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '账户流水',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_member_account_account_type` on table `member_account`
--
ALTER TABLE member_account
ADD INDEX IDX_ns_member_account_account_type (account_type);

--
-- `IDX_ns_member_account_create_time` on table `member_account`
--
ALTER TABLE member_account
ADD INDEX IDX_ns_member_account_create_time (create_time);

--
-- `IDX_ns_member_account_from_type` on table `member_account`
--
ALTER TABLE member_account
ADD INDEX IDX_ns_member_account_from_type (from_type);

--
-- `IDX_ns_member_account_member_id` on table `member_account`
--
ALTER TABLE member_account
ADD INDEX IDX_ns_member_account_member_id (member_id);

--
-- `member`
--
CREATE TABLE member (
  member_id int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) DEFAULT 0 COMMENT '站点id',
  source_member int(11) NOT NULL DEFAULT 0 COMMENT '推荐人',
  fenxiao_id int(11) NOT NULL DEFAULT 0 COMMENT '分销商（分销有效）',
  is_fenxiao tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否是分销商',
  username varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  nickname varchar(50) NOT NULL DEFAULT '' COMMENT '用户昵称',
  mobile varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  email varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  password varchar(255) NOT NULL DEFAULT '' COMMENT '用户密码（MD5）',
  status int(11) NOT NULL DEFAULT 1 COMMENT '用户状态  用户状态默认为1',
  headimg varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  member_level int(11) NOT NULL DEFAULT 0 COMMENT '用户等级',
  member_level_name varchar(50) NOT NULL DEFAULT '' COMMENT '会员等级名称',
  member_label varchar(255) NOT NULL DEFAULT ',' COMMENT '用户标签',
  member_label_name varchar(255) NOT NULL DEFAULT '' COMMENT '会员标签名称',
  qq varchar(255) NOT NULL DEFAULT '' COMMENT 'qq号',
  qq_openid varchar(255) NOT NULL DEFAULT '' COMMENT 'qq互联id',
  wx_openid varchar(255) NOT NULL DEFAULT '' COMMENT '微信用户openid',
  weapp_openid varchar(255) NOT NULL DEFAULT '' COMMENT '微信小程序openid',
  wx_unionid varchar(255) NOT NULL DEFAULT '' COMMENT '微信unionid',
  ali_openid varchar(255) NOT NULL DEFAULT '' COMMENT '支付宝账户id',
  baidu_openid varchar(255) NOT NULL DEFAULT '' COMMENT '百度账户id',
  toutiao_openid varchar(255) NOT NULL DEFAULT '' COMMENT '头条账号',
  douyin_openid varchar(255) NOT NULL DEFAULT '' COMMENT '抖音小程序openid',
  login_ip varchar(255) NOT NULL DEFAULT '' COMMENT '当前登录ip',
  login_type varchar(255) NOT NULL DEFAULT 'h5' COMMENT '当前登录的操作终端类型',
  login_time int(11) NOT NULL DEFAULT 0 COMMENT '当前登录时间',
  last_login_ip varchar(255) NOT NULL DEFAULT '' COMMENT '上次登录ip',
  last_login_type varchar(11) NOT NULL DEFAULT 'h5' COMMENT '上次登录的操作终端类型',
  last_login_time int(11) NOT NULL DEFAULT 0 COMMENT '上次登录时间',
  login_num int(11) NOT NULL DEFAULT 0 COMMENT '登录次数',
  realname varchar(50) NOT NULL DEFAULT '' COMMENT '真实姓名',
  sex smallint(6) NOT NULL DEFAULT 0 COMMENT '性别 0保密 1男 2女',
  location varchar(255) NOT NULL DEFAULT '' COMMENT '定位地址',
  birthday int(11) NOT NULL DEFAULT 0 COMMENT '出生日期',
  reg_time int(11) NOT NULL DEFAULT 0 COMMENT '注册时间',
  point decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '积分',
  balance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额',
  growth decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '成长值',
  balance_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '现金余额(可提现)',
  account5 decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '账户5',
  is_auth int(11) NOT NULL DEFAULT 0 COMMENT '是否认证',
  sign_time int(11) NOT NULL DEFAULT 0 COMMENT '最后一次签到时间',
  sign_days_series int(11) NOT NULL DEFAULT 0 COMMENT '持续签到天数',
  pay_password varchar(32) NOT NULL DEFAULT '' COMMENT '交易密码',
  order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '付款后-消费金额',
  order_complete_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单完成-消费金额',
  order_num int(11) NOT NULL DEFAULT 0 COMMENT '付款后-消费次数',
  order_complete_num int(11) NOT NULL DEFAULT 0 COMMENT '订单完成-消费次数',
  balance_withdraw_apply decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现中余额',
  balance_withdraw decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '已提现余额',
  is_delete tinyint(1) NOT NULL DEFAULT 0 COMMENT '0正常  1已删除',
  PRIMARY KEY (member_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '系统用户表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_member_weapp_openid` on table `member`
--
ALTER TABLE member
ADD INDEX IDX_ns_member_weapp_openid (weapp_openid);

--
-- `IDX_sys_user_user_email` on table `member`
--
ALTER TABLE member
ADD INDEX IDX_sys_user_user_email (email);

--
-- `IDX_sys_user_user_name` on table `member`
--
ALTER TABLE member
ADD INDEX IDX_sys_user_user_name (username);

--
-- `IDX_sys_user_user_password` on table `member`
--
ALTER TABLE member
ADD INDEX IDX_sys_user_user_password (password);

--
-- `IDX_sys_user_user_tel` on table `member`
--
ALTER TABLE member
ADD INDEX IDX_sys_user_user_tel (mobile);

--
-- `IDX_sys_user_wx_openid` on table `member`
--
ALTER TABLE member
ADD INDEX IDX_sys_user_wx_openid (wx_openid);

--
-- `IDX_sys_user_wx_unionid` on table `member`
--
ALTER TABLE member
ADD INDEX IDX_sys_user_wx_unionid (wx_unionid);

--
-- `local_delivery_package`
--
CREATE TABLE local_delivery_package (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  order_goods_id_array varchar(1000) NOT NULL DEFAULT '' COMMENT '订单项商品组合列表',
  goods_id_array varchar(1000) NOT NULL DEFAULT '' COMMENT '商品组合列表',
  package_name varchar(50) NOT NULL DEFAULT '' COMMENT '包裹名称  （包裹- 1 包裹 - 2）',
  delivery_type varchar(50) NOT NULL DEFAULT 'default' COMMENT '发货方式 default 商家自配送 other 第三方配送',
  delivery_no varchar(50) NOT NULL DEFAULT '' COMMENT '运单编号',
  delivery_time int(11) NOT NULL DEFAULT 0 COMMENT '发货时间',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  member_name varchar(50) NOT NULL DEFAULT '' COMMENT '会员名称',
  deliverer varchar(255) NOT NULL DEFAULT '' COMMENT '配送员',
  deliverer_mobile varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '外卖配送物流信息表',
ROW_FORMAT = DYNAMIC;

--
-- `local`
--
CREATE TABLE `local` (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  type varchar(255) NOT NULL DEFAULT 'default' COMMENT '配送方式  default 商家自配送  other 第三方配送',
  area_type int(11) NOT NULL DEFAULT 1 COMMENT '配送区域',
  local_area_json varchar(2000) NOT NULL DEFAULT '' COMMENT '区域配送设置',
  time_is_open int(11) NOT NULL DEFAULT 0 COMMENT '订单达是否开启 0 关闭 1 开启',
  time_type int(11) NOT NULL DEFAULT 0 COMMENT '时间选取类型 0 全天  1 自定义',
  time_week varchar(255) NOT NULL DEFAULT '' COMMENT '营业时间  周一 周二.......',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '当日的起始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '当日的营业结束时间',
  update_time int(11) NOT NULL DEFAULT 0,
  is_open_step int(11) NOT NULL DEFAULT 0 COMMENT '是否启用阶梯价(适用于行政区域)',
  start_distance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '多少距离以内,...',
  start_delivery_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '多少距离以内,多少钱',
  continued_distance decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '每增加多少距离',
  continued_delivery_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '每增加多少距离,运费增加',
  start_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '起送价',
  delivery_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '配送费',
  area_array varchar(255) NOT NULL DEFAULT '' COMMENT '地域集合',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '本地配送设置',
ROW_FORMAT = DYNAMIC;

--
-- `link`
--
CREATE TABLE link (
  id int(11) NOT NULL AUTO_INCREMENT,
  addon_name varchar(50) NOT NULL DEFAULT '',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '标识',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '中文名称',
  parent varchar(255) NOT NULL DEFAULT '' COMMENT '父级',
  sort int(11) NOT NULL COMMENT '排序',
  level int(11) NOT NULL DEFAULT 0 COMMENT '级别',
  web_url varchar(255) NOT NULL DEFAULT '' COMMENT 'pc端页面跳转路径',
  wap_url varchar(255) NOT NULL DEFAULT '' COMMENT 'wap端跳转路径',
  icon varchar(255) NOT NULL DEFAULT '' COMMENT '图标',
  support_diy_view varchar(255) NOT NULL DEFAULT '' COMMENT '支持的自定义页面（为空表示公共组件都支持）',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '链接入口',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_nc_link` on table `link`
--
ALTER TABLE link
ADD INDEX IDX_nc_link (addon_name);

--
-- `help_class`
--
CREATE TABLE help_class (
  class_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'site_id',
  app_module varchar(255) NOT NULL DEFAULT '' COMMENT '应用模块',
  class_name varchar(50) NOT NULL DEFAULT '' COMMENT '帮助类型名称',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序号',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (class_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '帮助类型',
ROW_FORMAT = DYNAMIC;

--
-- `help`
--
CREATE TABLE help (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  site_id int(10) NOT NULL DEFAULT 0 COMMENT 'site_id',
  app_module varchar(255) NOT NULL DEFAULT '' COMMENT '应用模块',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '帮助主题',
  link_address varchar(1000) NOT NULL DEFAULT '' COMMENT '链接地址',
  content text DEFAULT NULL COMMENT '帮助内容',
  class_id int(11) NOT NULL DEFAULT 0 COMMENT '帮助类型id',
  class_name varchar(50) NOT NULL DEFAULT '' COMMENT '帮助类型名称',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序号',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '帮助文章表',
ROW_FORMAT = DYNAMIC;

--
-- `group`
--
CREATE TABLE `group` (
  group_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id（店铺，分站,门店，供应商）,总平台端为0',
  app_module varchar(255) NOT NULL DEFAULT '' COMMENT '使用端口',
  group_name varchar(50) NOT NULL DEFAULT '' COMMENT '用户组名称',
  group_status int(11) NOT NULL DEFAULT 1 COMMENT '用户组状态',
  is_system int(1) NOT NULL DEFAULT 0 COMMENT '是否是系统用户组',
  menu_array text DEFAULT NULL COMMENT '系统菜单权限组，用，隔开',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (group_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '用户组表',
ROW_FORMAT = DYNAMIC;

--
-- `goods_virtual`
--
CREATE TABLE goods_virtual (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺id',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  order_no varchar(255) NOT NULL DEFAULT '' COMMENT '订单编号',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品sku_id',
  sku_name varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称',
  code varchar(255) NOT NULL DEFAULT '' COMMENT '虚拟商品编码',
  is_veirfy int(11) NOT NULL DEFAULT 0 COMMENT '是否已经核销',
  verify_time int(11) NOT NULL DEFAULT 0 COMMENT '核销时间',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '所属人',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '虚拟商品图片',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '用户虚拟商品表',
ROW_FORMAT = DYNAMIC;

--
-- `goods_sku`
--
CREATE TABLE goods_sku (
  sku_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品sku_id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '所属店铺id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品sku名称',
  sku_no varchar(255) NOT NULL DEFAULT '' COMMENT '商品sku编码',
  sku_spec_format text DEFAULT NULL COMMENT 'sku规格格式',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT 'sku单价',
  market_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT 'sku划线价',
  cost_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT 'sku成本价',
  discount_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT 'sku折扣价（默认等于单价）',
  promotion_type tinyint(4) NOT NULL DEFAULT 0 COMMENT '活动类型1.限时折扣',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  stock int(11) NOT NULL DEFAULT 0 COMMENT '商品sku库存',
  weight decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '重量（单位g）',
  volume decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '体积（单位立方米）',
  click_num int(11) NOT NULL DEFAULT 0 COMMENT '点击量',
  sale_num int(11) NOT NULL DEFAULT 0 COMMENT '销量',
  collect_num int(11) NOT NULL DEFAULT 0 COMMENT '收藏量',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT 'sku主图',
  sku_images varchar(1000) NOT NULL DEFAULT '' COMMENT 'sku图片',
  goods_class int(11) NOT NULL DEFAULT 1 COMMENT '商品种类1.实物商品2.虚拟商品3.卡券商品',
  goods_class_name varchar(25) NOT NULL DEFAULT '' COMMENT '商品种类',
  goods_attr_class int(11) NOT NULL DEFAULT 1 COMMENT '商品类型id',
  goods_attr_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  goods_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  goods_content text DEFAULT NULL COMMENT '商品详情',
  goods_state tinyint(4) NOT NULL DEFAULT 1 COMMENT '商品状态（1.正常0下架）',
  goods_stock_alarm int(11) NOT NULL DEFAULT 0 COMMENT '库存预警',
  is_virtual tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否虚拟类商品（0实物1.虚拟）',
  virtual_indate int(11) NOT NULL DEFAULT 1 COMMENT '虚拟商品有效期',
  is_free_shipping tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否免邮',
  shipping_template int(11) NOT NULL DEFAULT 0 COMMENT '指定运费模板',
  goods_spec_format text DEFAULT NULL COMMENT '商品规格格式',
  goods_attr_format text DEFAULT NULL COMMENT '商品属性格式',
  is_delete tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否已经删除',
  introduction varchar(255) NOT NULL DEFAULT '' COMMENT '促销语',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  unit varchar(255) NOT NULL DEFAULT '' COMMENT '单位',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  video_url varchar(555) NOT NULL DEFAULT '' COMMENT '视频',
  evaluate int(11) NOT NULL DEFAULT 0 COMMENT '评价数',
  evaluate_shaitu int(11) NOT NULL DEFAULT 0 COMMENT '晒图评价数',
  evaluate_shipin int(11) NOT NULL DEFAULT 0 COMMENT '视频评价数',
  evaluate_zhuiping int(11) NOT NULL DEFAULT 0 COMMENT '追评数',
  evaluate_haoping int(11) NOT NULL DEFAULT 0 COMMENT '好评数',
  evaluate_zhongping int(11) NOT NULL DEFAULT 0 COMMENT '中评数',
  evaluate_chaping int(11) NOT NULL DEFAULT 0 COMMENT '差评数',
  spec_name varchar(255) NOT NULL DEFAULT '' COMMENT '规格名称',
  supplier_id int(11) NOT NULL DEFAULT 0 COMMENT '供应商id',
  is_consume_discount tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否参与会员等级折扣',
  discount_config tinyint(1) NOT NULL DEFAULT 0 COMMENT '优惠设置（0默认 1自定义）',
  discount_method varchar(20) NOT NULL DEFAULT '' COMMENT '优惠方式（discount打折 manjian 满减 fixed_price 指定价格）',
  member_price varchar(255) NOT NULL DEFAULT '' COMMENT '会员价',
  goods_service_ids varchar(255) NOT NULL DEFAULT '' COMMENT '商品服务id',
  virtual_sale int(11) NOT NULL DEFAULT 0 COMMENT '虚拟销量',
  max_buy int(11) NOT NULL DEFAULT 0 COMMENT '限购',
  min_buy int(11) NOT NULL DEFAULT 0,
  recommend_way int(11) NOT NULL DEFAULT 0 COMMENT '推荐方式，1：新品，2：精品，3；推荐',
  fenxiao_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '分销计算价格',
  stock_alarm int(11) NOT NULL DEFAULT 0 COMMENT 'sku库存预警',
  sale_sort int(11) NOT NULL DEFAULT 0 COMMENT '销量排序字段 占位用',
  is_default tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认',
  PRIMARY KEY (sku_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_goods_goods_class` on table `goods_sku`
--
ALTER TABLE goods_sku
ADD INDEX IDX_ns_goods_goods_class (goods_class);

--
-- `IDX_ns_goods_is_delete` on table `goods_sku`
--
ALTER TABLE goods_sku
ADD INDEX IDX_ns_goods_is_delete (is_delete);

--
-- `IDX_ns_goods_site_id` on table `goods_sku`
--
ALTER TABLE goods_sku
ADD INDEX IDX_ns_goods_site_id (site_id);

--
-- `IDX_ns_goods_sort` on table `goods_sku`
--
ALTER TABLE goods_sku
ADD INDEX IDX_ns_goods_sort (sort);

--
-- `goods_service`
--
CREATE TABLE goods_service (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  service_name varchar(50) NOT NULL DEFAULT '' COMMENT '服务名称',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品服务',
ROW_FORMAT = DYNAMIC;

--
-- `goods_label`
--
CREATE TABLE goods_label (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  label_name varchar(50) NOT NULL DEFAULT '' COMMENT '标签名称',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  sort int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品标签';

--
-- `goods_evaluate`
--
CREATE TABLE goods_evaluate (
  evaluate_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评价ID',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  website_id int(11) NOT NULL DEFAULT 0 COMMENT '分站id',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单ID',
  order_no bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单编号',
  order_goods_id int(11) NOT NULL DEFAULT 0 COMMENT '订单项ID',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品ID',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品skuid',
  sku_name varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品价格',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  content varchar(255) NOT NULL DEFAULT '' COMMENT '评价内容',
  images varchar(1000) NOT NULL DEFAULT '' COMMENT '评价图片',
  explain_first varchar(255) NOT NULL DEFAULT '' COMMENT '解释内容',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '评价人id',
  member_name varchar(100) NOT NULL DEFAULT '' COMMENT '评价人名称',
  member_headimg varchar(255) NOT NULL DEFAULT '' COMMENT '评价人头像',
  is_anonymous tinyint(1) NOT NULL DEFAULT 0 COMMENT '0表示不是 1表示是匿名评价',
  scores tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-5分',
  again_content varchar(255) NOT NULL DEFAULT '' COMMENT '追加评价内容',
  again_images varchar(1000) NOT NULL DEFAULT '' COMMENT '追评评价图片',
  again_explain varchar(255) NOT NULL DEFAULT '' COMMENT '追加解释内容',
  explain_type int(11) NOT NULL DEFAULT 0 COMMENT '1好评2中评3差评',
  is_show int(1) NOT NULL DEFAULT 1 COMMENT '1显示 0隐藏',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '评价时间',
  again_time int(11) NOT NULL DEFAULT 0 COMMENT '追加评价时间',
  shop_desccredit decimal(10, 2) NOT NULL DEFAULT 5.00 COMMENT '描述分值',
  shop_servicecredit decimal(10, 2) NOT NULL DEFAULT 5.00 COMMENT '服务分值',
  shop_deliverycredit decimal(10, 2) NOT NULL DEFAULT 5.00 COMMENT '配送分值',
  is_audit int(11) NOT NULL DEFAULT 1 COMMENT '审核状态：0 未审核 1 审核通过，-1 审核拒绝',
  PRIMARY KEY (evaluate_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品评价表',
ROW_FORMAT = DYNAMIC;

--
-- `goods_collect`
--
CREATE TABLE goods_collect (
  collect_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'skuid',
  category_id int(11) NOT NULL DEFAULT 0 COMMENT '商品分类id',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  sku_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品价格',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '收藏时间',
  site_id int(10) NOT NULL DEFAULT 0 COMMENT '站点id',
  PRIMARY KEY (collect_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品收藏表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_goods_collect_member_id` on table `goods_collect`
--
ALTER TABLE goods_collect
ADD INDEX IDX_ns_goods_collect_member_id (member_id);

--
-- `IDX_ns_goods_collect_sku_id` on table `goods_collect`
--
ALTER TABLE goods_collect
ADD INDEX IDX_ns_goods_collect_sku_id (sku_id);

--
-- `goods_category`
--
CREATE TABLE goods_category (
  category_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  category_name varchar(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  short_name varchar(50) NOT NULL DEFAULT '' COMMENT '简称',
  pid int(11) NOT NULL DEFAULT 0 COMMENT '分类上级',
  level int(11) NOT NULL DEFAULT 0 COMMENT '层级',
  is_show int(11) NOT NULL DEFAULT 0 COMMENT '是否显示（0显示  -1不显示）',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  image varchar(255) NOT NULL DEFAULT '' COMMENT '分类图片',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '分类页面关键字',
  description varchar(255) NOT NULL DEFAULT '' COMMENT '分类介绍',
  attr_class_id int(11) NOT NULL DEFAULT 0 COMMENT '关联商品类型id',
  attr_class_name varchar(255) NOT NULL DEFAULT '' COMMENT '关联商品类型名称',
  category_id_1 int(11) NOT NULL DEFAULT 0 COMMENT '一级分类id',
  category_id_2 int(11) NOT NULL DEFAULT 0 COMMENT '二级分类id',
  category_id_3 int(11) NOT NULL DEFAULT 0 COMMENT '三级分类id',
  category_full_name varchar(255) NOT NULL DEFAULT '' COMMENT '组装名称',
  image_adv varchar(255) NOT NULL DEFAULT '' COMMENT '分类广告图',
  commission_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '佣金比率%',
  PRIMARY KEY (category_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = ' 商品分类',
ROW_FORMAT = DYNAMIC;

--
-- `pid_level` on table `goods_category`
--
ALTER TABLE goods_category
ADD INDEX pid_level (pid, level);

--
-- `goods_cart`
--
CREATE TABLE goods_cart (
  cart_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'sku_id',
  num int(11) NOT NULL DEFAULT 0 COMMENT '数量',
  PRIMARY KEY (cart_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = ' 购物车',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_goods_cart_member_id` on table `goods_cart`
--
ALTER TABLE goods_cart
ADD INDEX IDX_ns_goods_cart_member_id (member_id);

--
-- `goods_browse`
--
CREATE TABLE goods_browse (
  id int(11) NOT NULL AUTO_INCREMENT,
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '浏览人',
  browse_time int(11) NOT NULL DEFAULT 0 COMMENT '浏览时间',
  site_id int(10) NOT NULL DEFAULT 0 COMMENT '站点id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'sku_id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品浏览历史',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_goods_browse_member_id` on table `goods_browse`
--
ALTER TABLE goods_browse
ADD INDEX IDX_ns_goods_browse_member_id (member_id);

--
-- `IDX_ns_goods_browse_sku_id` on table `goods_browse`
--
ALTER TABLE goods_browse
ADD INDEX IDX_ns_goods_browse_sku_id (sku_id);

--
-- `goods_attr_class`
--
CREATE TABLE goods_attr_class (
  class_id int(11) NOT NULL AUTO_INCREMENT,
  class_name varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '所属店铺id',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序号',
  PRIMARY KEY (class_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = ' 商品类型',
ROW_FORMAT = DYNAMIC;

--
-- `goods_attribute_value`
--
CREATE TABLE goods_attribute_value (
  attr_value_id int(11) NOT NULL AUTO_INCREMENT,
  attr_value_name varchar(50) NOT NULL DEFAULT '' COMMENT '属性值名称',
  attr_id int(11) NOT NULL DEFAULT 0 COMMENT '属性id',
  attr_class_id int(11) NOT NULL DEFAULT 0 COMMENT '类型id',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (attr_value_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品属性值表',
ROW_FORMAT = DYNAMIC;

--
-- `goods_attribute`
--
CREATE TABLE goods_attribute (
  attr_id int(11) NOT NULL AUTO_INCREMENT,
  attr_name varchar(50) NOT NULL DEFAULT '' COMMENT '属性名称',
  attr_class_id int(11) NOT NULL DEFAULT 0 COMMENT '商品类型id',
  attr_class_name varchar(50) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '属性排序号',
  is_query int(11) NOT NULL DEFAULT 0 COMMENT '是否参与筛选',
  is_spec int(11) NOT NULL DEFAULT 0 COMMENT '是否是规格属性',
  attr_value_list varchar(255) NOT NULL DEFAULT '' COMMENT '属性值列表（'',''隔开注意键值对）',
  attr_value_format varchar(1000) NOT NULL DEFAULT '' COMMENT '属性值格式json',
  attr_type int(11) NOT NULL DEFAULT 0 COMMENT '属性类型  （1.单选 2.多选3. 输入 注意输入不参与筛选）',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  site_name varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名称',
  PRIMARY KEY (attr_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品属性',
ROW_FORMAT = DYNAMIC;

--
-- `goods`
--
CREATE TABLE goods (
  goods_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品id',
  goods_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  goods_class int(11) NOT NULL DEFAULT 1 COMMENT '商品种类1.实物商品2.虚拟商品3.卡券商品',
  goods_class_name varchar(25) NOT NULL DEFAULT '' COMMENT '商品种类',
  goods_attr_class int(11) NOT NULL DEFAULT 1 COMMENT '商品类型id',
  goods_attr_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '所属店铺id',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '所属店铺名称',
  goods_image varchar(1000) NOT NULL DEFAULT '' COMMENT '商品主图路径',
  goods_content text DEFAULT NULL COMMENT '商品详情',
  goods_state tinyint(4) NOT NULL DEFAULT 1 COMMENT '商品状态（1.正常0下架）',
  category_id varchar(255) NOT NULL DEFAULT '' COMMENT '商品分类id,逗号隔开',
  category_json varchar(500) NOT NULL DEFAULT '' COMMENT '分类json字符串',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品价格（取第一个sku）',
  market_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '划线价格（取第一个sku）',
  cost_price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '成本价（取第一个sku）',
  goods_stock int(11) NOT NULL DEFAULT 0 COMMENT '商品库存（总和）',
  goods_stock_alarm int(11) NOT NULL DEFAULT 0 COMMENT '库存预警',
  is_virtual tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否虚拟类商品（0实物1.虚拟）',
  virtual_indate int(11) NOT NULL DEFAULT 1 COMMENT '虚拟商品有效期',
  is_free_shipping tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否免邮',
  shipping_template int(11) NOT NULL DEFAULT 0 COMMENT '指定运费模板',
  goods_spec_format text DEFAULT NULL COMMENT '商品规格格式',
  goods_attr_format text DEFAULT NULL COMMENT '商品属性格式',
  is_delete tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否已经删除',
  introduction varchar(255) NOT NULL DEFAULT '' COMMENT '促销语',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  unit varchar(255) NOT NULL DEFAULT '' COMMENT '单位',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  video_url varchar(555) NOT NULL DEFAULT '' COMMENT '视频',
  sale_num int(11) NOT NULL DEFAULT 0 COMMENT '销量',
  evaluate int(11) NOT NULL DEFAULT 0 COMMENT '评价数',
  evaluate_shaitu int(11) NOT NULL DEFAULT 0 COMMENT '评价晒图数',
  evaluate_shipin int(11) NOT NULL DEFAULT 0 COMMENT '评价视频数',
  evaluate_zhuiping int(11) NOT NULL DEFAULT 0 COMMENT '评价追评数',
  evaluate_haoping int(11) NOT NULL DEFAULT 0 COMMENT '评价好评数',
  evaluate_zhongping int(11) NOT NULL DEFAULT 0 COMMENT '评价中评数',
  evaluate_chaping int(11) NOT NULL DEFAULT 0 COMMENT '评价差评数',
  is_fenxiao tinyint(1) NOT NULL DEFAULT 0 COMMENT '参与分销（0不参与 1参与）',
  fenxiao_type tinyint(1) NOT NULL DEFAULT 1 COMMENT '分销佣金类型（1默认  2自行设置）',
  supplier_id int(11) NOT NULL DEFAULT 0 COMMENT '供应商id',
  is_consume_discount tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否参与会员等级折扣',
  discount_config tinyint(1) NOT NULL DEFAULT 0 COMMENT '优惠设置（0默认 1自定义）',
  discount_method varchar(20) NOT NULL DEFAULT '' COMMENT '优惠方式（discount打折 manjian 满减 fixed_price 指定价格）',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'sku_id',
  promotion_addon varchar(255) NOT NULL DEFAULT '' COMMENT '当前参与的营销活动，逗号分隔（限时折扣、团购、拼团、秒杀、专题活动）',
  goods_service_ids varchar(255) NOT NULL DEFAULT '' COMMENT '商品服务id',
  label_id int(11) NOT NULL DEFAULT 0 COMMENT '商品分组id',
  virtual_sale int(11) NOT NULL DEFAULT 0 COMMENT '虚拟销量',
  max_buy int(11) NOT NULL DEFAULT 0 COMMENT '限购',
  min_buy int(11) NOT NULL DEFAULT 0 COMMENT '起购数',
  recommend_way int(11) NOT NULL DEFAULT 0 COMMENT '推荐方式，1：新品，2：精品，3；推荐',
  timer_on int(11) NOT NULL DEFAULT 0 COMMENT '定时上架',
  timer_off int(11) NOT NULL DEFAULT 0 COMMENT '定时下架',
  PRIMARY KEY (goods_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_goods_category_id` on table `goods`
--
ALTER TABLE goods
ADD INDEX IDX_ns_goods_category_id (category_id);

--
-- `IDX_ns_goods_goods_class` on table `goods`
--
ALTER TABLE goods
ADD INDEX IDX_ns_goods_goods_class (goods_class);

--
-- `IDX_ns_goods_is_delete` on table `goods`
--
ALTER TABLE goods
ADD INDEX IDX_ns_goods_is_delete (is_delete);

--
-- `IDX_ns_goods_site_id` on table `goods`
--
ALTER TABLE goods
ADD INDEX IDX_ns_goods_site_id (site_id);

--
-- `IDX_ns_goods_sku_id` on table `goods`
--
ALTER TABLE goods
ADD INDEX IDX_ns_goods_sku_id (sku_id);

--
-- `IDX_ns_goods_sort` on table `goods`
--
ALTER TABLE goods
ADD INDEX IDX_ns_goods_sort (sort);

--
-- `fenxiao_withdraw`
--
CREATE TABLE fenxiao_withdraw (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  withdraw_no varchar(255) NOT NULL DEFAULT '' COMMENT '提现流水号',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  fenxiao_id int(11) NOT NULL DEFAULT 0 COMMENT '分销商id',
  fenxiao_name varchar(255) NOT NULL DEFAULT '' COMMENT '分销商名称',
  withdraw_type varchar(32) NOT NULL DEFAULT '' COMMENT '提现类型（weixin-微信 alipay-支付宝 balance-余额 bank银行卡）',
  bank_name varchar(50) NOT NULL DEFAULT '' COMMENT '提现银行名称',
  account_number varchar(50) NOT NULL DEFAULT '' COMMENT '提现银行账号',
  realname varchar(10) NOT NULL DEFAULT '' COMMENT '提现账户姓名',
  mobile varchar(20) NOT NULL DEFAULT '' COMMENT '手机',
  money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现金额',
  withdraw_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现手续费率',
  withdraw_rate_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现手续费金额',
  real_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '实际到账金额',
  status smallint(6) NOT NULL DEFAULT 1 COMMENT '当前状态 1待审核 2已审核 -1 已拒绝',
  remark varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '申请日期',
  payment_time int(11) NOT NULL DEFAULT 0 COMMENT '到账日期',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改日期',
  transfer_type int(11) NOT NULL DEFAULT 1 COMMENT '转账方式   1 线下转账  2线上转账',
  transfer_name varchar(50) NOT NULL DEFAULT '' COMMENT '转账银行名称',
  transfer_remark varchar(255) NOT NULL DEFAULT '' COMMENT '转账备注',
  transfer_no varchar(255) NOT NULL DEFAULT '' COMMENT '转账流水号',
  transfer_account_no varchar(255) NOT NULL DEFAULT '' COMMENT '转账银行账号',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '会员余额提现记录表',
ROW_FORMAT = DYNAMIC;

--
-- `fenxiao_order`
--
CREATE TABLE fenxiao_order (
  fenxiao_order_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  order_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单ID',
  order_no varchar(255) NOT NULL DEFAULT '' COMMENT '订单编号',
  order_goods_id int(11) NOT NULL DEFAULT 0 COMMENT '订单项ID',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点ID',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品ID',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品skuid',
  sku_name varchar(255) NOT NULL DEFAULT '' COMMENT '商品sku名称',
  sku_image varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品卖价',
  num int(11) NOT NULL DEFAULT 0 COMMENT '商品数量',
  real_goods_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品总价',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '购买人ID',
  member_name varchar(255) NOT NULL DEFAULT '' COMMENT '购买人名称',
  member_mobile varchar(255) NOT NULL DEFAULT '' COMMENT '购买人电话',
  full_address varchar(255) NOT NULL DEFAULT '' COMMENT '购买人详细地址',
  commission decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '总佣金',
  commission_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '分销总比率',
  one_fenxiao_id int(11) NOT NULL DEFAULT 0 COMMENT '一级分销商ID',
  one_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '一级分销比例',
  one_commission decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '一级分销佣金',
  one_fenxiao_name varchar(255) NOT NULL DEFAULT '' COMMENT '一级分销商名',
  two_fenxiao_id int(11) NOT NULL DEFAULT 0 COMMENT '二级分销商ID',
  two_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '二级分销比例',
  two_commission decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '二级分销佣金',
  two_fenxiao_name varchar(255) NOT NULL DEFAULT '' COMMENT '二级分销商名',
  three_fenxiao_id int(11) NOT NULL DEFAULT 0 COMMENT '三级分销商ID',
  three_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '三级分销比例',
  three_commission decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '三级分销佣金',
  three_fenxiao_name varchar(255) NOT NULL DEFAULT '' COMMENT '三级分销商名',
  is_settlement tinyint(3) NOT NULL DEFAULT 0 COMMENT '是否结算',
  is_refund tinyint(3) NOT NULL DEFAULT 0 COMMENT '是否退款',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (fenxiao_order_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销配置表',
ROW_FORMAT = DYNAMIC;

--
-- `fenxiao_level`
--
CREATE TABLE fenxiao_level (
  level_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  level_num int(11) NOT NULL DEFAULT 0 COMMENT '等级权重',
  level_name varchar(30) NOT NULL DEFAULT '' COMMENT '等级名称',
  one_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '一级佣金比例',
  two_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '二级佣金比例',
  three_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '三级佣金比例',
  upgrade_type tinyint(3) NOT NULL DEFAULT 0 COMMENT '升级方式（0满足任意条件  1满足全部条件）',
  fenxiao_order_num int(11) NOT NULL DEFAULT 0 COMMENT '订单总数',
  fenxiao_order_meney decimal(10, 2) DEFAULT 0.00 COMMENT '订单总金额',
  one_fenxiao_order_num int(11) NOT NULL DEFAULT 0 COMMENT '一级分销订单总数',
  one_fenxiao_order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '一级分销订单总额',
  order_num int(11) NOT NULL DEFAULT 0 COMMENT '自购订单总数',
  order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '自购订单总额',
  child_num int(11) NOT NULL DEFAULT 0 COMMENT '下线人数',
  child_fenxiao_num int(11) NOT NULL DEFAULT 0 COMMENT '下线分销商人数',
  one_child_num int(11) NOT NULL DEFAULT 0 COMMENT '一级下线人数',
  one_child_fenxiao_num int(11) NOT NULL DEFAULT 0 COMMENT '一级下线分销商',
  status tinyint(3) NOT NULL DEFAULT 0 COMMENT '状态（0关闭 1启用）',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  is_default int(1) NOT NULL DEFAULT 0 COMMENT '是否是默认等级',
  PRIMARY KEY (level_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销等级配置表',
ROW_FORMAT = DYNAMIC;

--
-- `fenxiao_goods_sku`
--
CREATE TABLE fenxiao_goods_sku (
  goods_sku_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品ID',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT '商品skuID',
  level_id int(11) NOT NULL DEFAULT 0 COMMENT '分销等级ID',
  one_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '一级佣金比例',
  one_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '一级佣金金额',
  two_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '二级佣金比例',
  two_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '二级佣金金额',
  three_rate decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '三级佣金比例',
  three_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '三级佣金金额',
  PRIMARY KEY (goods_sku_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销商品sku表',
ROW_FORMAT = DYNAMIC;

--
-- `fenxiao_goods_collect`
--
CREATE TABLE fenxiao_goods_collect (
  collect_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  fenxiao_id int(11) NOT NULL DEFAULT 0 COMMENT '分销商id',
  goods_id int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  sku_id int(11) NOT NULL DEFAULT 0 COMMENT 'skuid',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '收藏时间',
  site_id int(10) NOT NULL DEFAULT 0 COMMENT '站点id',
  PRIMARY KEY (collect_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销商关注商品表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_fenxiao_goods_collect_member_id` on table `fenxiao_goods_collect`
--
ALTER TABLE fenxiao_goods_collect
ADD INDEX IDX_ns_fenxiao_goods_collect_member_id (member_id);

--
-- `IDX_ns_fenxiao_goods_collect_sku_id` on table `fenxiao_goods_collect`
--
ALTER TABLE fenxiao_goods_collect
ADD INDEX IDX_ns_fenxiao_goods_collect_sku_id (sku_id);

--
-- `fenxiao_goods`
--
CREATE TABLE fenxiao_goods (
  fenxiao_goods_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  goods_id int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品ID',
  one_rate decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '一级佣金',
  two_rate decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '二级佣金',
  three_rate decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '三级佣金',
  state tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否参与',
  PRIMARY KEY (fenxiao_goods_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销商品表',
ROW_FORMAT = DYNAMIC;

--
-- `fenxiao_apply`
--
CREATE TABLE fenxiao_apply (
  apply_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  fenxiao_name varchar(255) NOT NULL DEFAULT '' COMMENT '分销商店铺名',
  parent int(11) NOT NULL DEFAULT 0 COMMENT '上级分销商ID',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员ID',
  mobile varchar(20) NOT NULL DEFAULT '0' COMMENT '联系电话',
  nickname varchar(50) NOT NULL DEFAULT '' COMMENT '用户昵称',
  headimg varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  level_id int(11) NOT NULL DEFAULT 0 COMMENT '申请等级',
  level_name varchar(50) NOT NULL DEFAULT '' COMMENT '等级名称',
  order_complete_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单完成-消费金额',
  order_complete_num int(10) NOT NULL DEFAULT 0 COMMENT '订单完成-消费次数',
  reg_time int(11) NOT NULL DEFAULT 0 COMMENT '注册时间',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '申请时间',
  update_time int(11) NOT NULL DEFAULT 0,
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT '申请状态（1申请中  2通过 -1拒绝）',
  PRIMARY KEY (apply_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销商申请表',
ROW_FORMAT = DYNAMIC;

--
-- `fenxiao_account`
--
CREATE TABLE fenxiao_account (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  account_no varchar(255) NOT NULL DEFAULT '' COMMENT '账单编号',
  fenxiao_id int(11) NOT NULL DEFAULT 0 COMMENT '分销商ID',
  fenxiao_name varchar(255) NOT NULL DEFAULT '' COMMENT '分销商名称',
  money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '费用',
  type varchar(50) NOT NULL DEFAULT '1' COMMENT '类型（withdraw提现 order订单结算）',
  type_name varchar(255) NOT NULL DEFAULT '' COMMENT '类型名称',
  relate_id int(11) NOT NULL DEFAULT 0 COMMENT '关联id',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销商流水表';

--
-- `fenxiao`
--
CREATE TABLE fenxiao (
  fenxiao_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) DEFAULT 0 COMMENT '站点id',
  fenxiao_no varchar(255) NOT NULL DEFAULT '' COMMENT '分销商编号',
  fenxiao_name varchar(255) NOT NULL DEFAULT '' COMMENT '分销店铺名',
  mobile varchar(20) NOT NULL DEFAULT '0' COMMENT '联系电话',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员ID',
  level_id int(11) NOT NULL DEFAULT 0 COMMENT '分销商等级id',
  level_name varchar(255) NOT NULL DEFAULT '' COMMENT '等级名称',
  parent int(11) NOT NULL DEFAULT 0 COMMENT '上级ID',
  grand_parent int(11) NOT NULL DEFAULT 0 COMMENT '上上级id',
  account decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '当前佣金',
  account_withdraw decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '已提现佣金',
  account_withdraw_apply decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '提现中佣金',
  status tinyint(3) NOT NULL DEFAULT 1 COMMENT '状态（1已审核 2拒绝 -1已冻结）',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  audit_time int(11) NOT NULL DEFAULT 0 COMMENT '成为经分销商时间',
  lock_time int(11) NOT NULL DEFAULT 0 COMMENT '冻结时间',
  one_fenxiao_order_num int(11) NOT NULL DEFAULT 0 COMMENT '一级分销订单总数',
  one_fenxiao_order_money decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '一级分销订单总额',
  one_child_num int(11) NOT NULL DEFAULT 0 COMMENT '一级下线人数',
  one_child_fenxiao_num int(11) NOT NULL DEFAULT 0 COMMENT '一级下线分销商',
  two_child_fenxiao_num int(11) NOT NULL DEFAULT 0 COMMENT '二级下线分销商',
  total_commission decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '累计佣金',
  is_delete tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否删除 0未删除 1已删除',
  PRIMARY KEY (fenxiao_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '分销商表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_fenxiao_audit_time` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_audit_time (audit_time);

--
-- `IDX_ns_fenxiao_create_time` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_create_time (create_time);

--
-- `IDX_ns_fenxiao_grand_parent` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_grand_parent (grand_parent);

--
-- `IDX_ns_fenxiao_level_id` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_level_id (level_id);

--
-- `IDX_ns_fenxiao_member_id` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_member_id (member_id);

--
-- `IDX_ns_fenxiao_parent` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_parent (parent);

--
-- `IDX_ns_fenxiao_site_id` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_site_id (site_id);

--
-- `IDX_ns_fenxiao_status` on table `fenxiao`
--
ALTER TABLE fenxiao
ADD INDEX IDX_ns_fenxiao_status (status);

--
-- `express_template_item`
--
CREATE TABLE express_template_item (
  item_id int(11) NOT NULL AUTO_INCREMENT,
  template_id int(11) NOT NULL DEFAULT 0 COMMENT '模板id',
  area_ids mediumtext DEFAULT NULL COMMENT '地址id序列',
  area_names mediumtext DEFAULT NULL COMMENT '地址名称序列',
  snum int(11) NOT NULL DEFAULT 0 COMMENT '起步计算标准',
  sprice decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '起步计算价格',
  xnum int(11) NOT NULL DEFAULT 0 COMMENT '续步计算标准',
  xprice decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '续步计算价格',
  fee_type int(11) NOT NULL DEFAULT 1 COMMENT '运费计算方式',
  PRIMARY KEY (item_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '运费模板细节',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_express_template_item_fee_type` on table `express_template_item`
--
ALTER TABLE express_template_item
ADD INDEX IDX_ns_express_template_item_fee_type (fee_type);

--
-- `IDX_ns_express_template_item_template_id` on table `express_template_item`
--
ALTER TABLE express_template_item
ADD INDEX IDX_ns_express_template_item_template_id (template_id);

--
-- `express_template`
--
CREATE TABLE express_template (
  template_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '商家店铺id',
  template_name varchar(50) NOT NULL DEFAULT '' COMMENT '模板名称',
  fee_type int(11) NOT NULL DEFAULT 0 COMMENT '运费计算方式1.重量2体积3按件',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  is_default int(11) NOT NULL DEFAULT 0 COMMENT '是否默认',
  surplus_area_ids mediumtext DEFAULT NULL COMMENT '剩余地址id',
  PRIMARY KEY (template_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '运费模板',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_express_template_is_default` on table `express_template`
--
ALTER TABLE express_template
ADD INDEX IDX_ns_express_template_is_default (is_default);

--
-- `IDX_ns_express_template_site_id` on table `express_template`
--
ALTER TABLE express_template
ADD INDEX IDX_ns_express_template_site_id (site_id);

--
-- `express_electronicsheet`
--
CREATE TABLE express_electronicsheet (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  template_name varchar(255) NOT NULL DEFAULT '' COMMENT '模板名称',
  company_id int(1) NOT NULL DEFAULT 0 COMMENT '物流公司id',
  company_name varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司名称',
  express_no varchar(255) NOT NULL DEFAULT '' COMMENT '编码',
  customer_name varchar(255) NOT NULL DEFAULT '' COMMENT 'CustomerName',
  customer_pwd varchar(255) NOT NULL DEFAULT '' COMMENT 'CustomerPwd',
  send_site varchar(255) NOT NULL DEFAULT '' COMMENT 'SendSite',
  send_staff varchar(255) NOT NULL DEFAULT '' COMMENT 'SendStaff',
  month_code varchar(255) NOT NULL DEFAULT '' COMMENT 'MonthCode',
  postage_payment_method tinyint(3) NOT NULL DEFAULT 0 COMMENT '邮费支付方式（1现付 2到付 3月结）',
  is_notice tinyint(3) NOT NULL DEFAULT 0 COMMENT '快递员上门揽件（0否 1是）',
  status tinyint(3) NOT NULL DEFAULT 0 COMMENT '状态（0正常 -1不使用）',
  is_default tinyint(3) NOT NULL DEFAULT 0 COMMENT '是否默认（0否 1是）',
  create_time int(11) NOT NULL DEFAULT 0,
  update_time int(11) NOT NULL DEFAULT 0,
  print_style int(11) NOT NULL DEFAULT 0 COMMENT '模板风格',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '电子面单',
ROW_FORMAT = DYNAMIC;

--
-- `express_delivery_package`
--
CREATE TABLE express_delivery_package (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  order_id int(11) NOT NULL DEFAULT 0 COMMENT '订单id',
  order_goods_id_array varchar(1000) NOT NULL DEFAULT '' COMMENT '订单项商品组合列表',
  goods_id_array varchar(1000) NOT NULL DEFAULT '' COMMENT '商品组合列表',
  package_name varchar(50) NOT NULL DEFAULT '' COMMENT '包裹名称  （包裹- 1 包裹 - 2）',
  delivery_type tinyint(4) NOT NULL DEFAULT 0 COMMENT '发货方式1 需要物流 0无需物流',
  express_company_id int(11) NOT NULL DEFAULT 0 COMMENT '快递公司id',
  express_company_name varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司名称',
  delivery_no varchar(50) NOT NULL DEFAULT '' COMMENT '运单编号',
  delivery_time int(11) NOT NULL DEFAULT 0 COMMENT '发货时间',
  member_id int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
  member_name varchar(50) NOT NULL DEFAULT '' COMMENT '会员名称',
  express_company_image varchar(255) NOT NULL DEFAULT '' COMMENT '发货公司图片',
  type varchar(20) NOT NULL DEFAULT '' COMMENT '发货方式（manual 手动发货  electronicsheet 电子面单发货）',
  template_id int(11) NOT NULL DEFAULT 0 COMMENT '电子面单模板id',
  template_name varchar(255) NOT NULL DEFAULT '' COMMENT '电子面单模板名称',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 3,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '商品订单物流信息表（多次发货）',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_express_delivery_package_order_id` on table `express_delivery_package`
--
ALTER TABLE express_delivery_package
ADD INDEX IDX_ns_express_delivery_package_order_id (order_id);

--
-- `IDX_ns_express_delivery_package_site_id` on table `express_delivery_package`
--
ALTER TABLE express_delivery_package
ADD INDEX IDX_ns_express_delivery_package_site_id (site_id);

--
-- `express_company_template`
--
CREATE TABLE express_company_template (
  company_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  company_name varchar(50) NOT NULL DEFAULT '' COMMENT '物流公司名称',
  logo varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司logo',
  url varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司网址',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  express_no varchar(20) NOT NULL DEFAULT '' COMMENT '编码',
  express_no_kd100 varchar(20) NOT NULL DEFAULT '' COMMENT '编码（快递100）',
  express_no_cainiao varchar(20) NOT NULL DEFAULT '' COMMENT '编码（菜鸟）',
  content_json text DEFAULT NULL COMMENT '打印内容',
  background_image varchar(255) NOT NULL DEFAULT '' COMMENT '背景图',
  font_size int(11) NOT NULL DEFAULT 14 COMMENT '打印字体',
  width int(11) NOT NULL DEFAULT 0 COMMENT '宽度',
  height int(11) NOT NULL DEFAULT 0 COMMENT '高度',
  scale decimal(10, 2) NOT NULL DEFAULT 1.00 COMMENT '真实尺寸（mm）与显示尺寸（px）的比例',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  is_electronicsheet tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否支持电子面单（0不支持  1支持）',
  print_style varchar(2000) NOT NULL DEFAULT '' COMMENT '电子面单打印风格',
  PRIMARY KEY (company_id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 10,
AVG_ROW_LENGTH = 1820,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '系统物流公司表',
ROW_FORMAT = DYNAMIC;

--
-- `express_company`
--
CREATE TABLE express_company (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '店铺id',
  company_id int(11) NOT NULL DEFAULT 0 COMMENT '物流公司id',
  company_name varchar(50) NOT NULL DEFAULT '' COMMENT '物流公司名称',
  logo varchar(255) NOT NULL DEFAULT '' COMMENT 'logo',
  express_no varchar(20) NOT NULL DEFAULT '' COMMENT '编码',
  content_json text DEFAULT NULL COMMENT '打印内容',
  background_image varchar(255) NOT NULL DEFAULT '' COMMENT '背景图',
  font_size varchar(10) NOT NULL DEFAULT '' COMMENT '打印字体',
  width varchar(10) NOT NULL DEFAULT '' COMMENT '宽度',
  height varchar(10) NOT NULL DEFAULT '' COMMENT '高度',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  scale decimal(10, 2) NOT NULL DEFAULT 1.00 COMMENT '真实尺寸（mm）与显示尺寸（px）的比例',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '店铺物流公司',
ROW_FORMAT = DYNAMIC;

--
-- `document`
--
CREATE TABLE document (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id（店铺，分站）,总平台端为0',
  app_module varchar(255) NOT NULL DEFAULT '' COMMENT '应用模块',
  document_key varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '文本关键字',
  content text DEFAULT NULL COMMENT '文本内容',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '系统配置性相关文件',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_document_app_module` on table `document`
--
ALTER TABLE document
ADD INDEX IDX_ns_document_app_module (app_module);

--
-- `IDX_ns_document_document_key` on table `document`
--
ALTER TABLE document
ADD INDEX IDX_ns_document_document_key (document_key);

--
-- `IDX_ns_document_site_id` on table `document`
--
ALTER TABLE document
ADD INDEX IDX_ns_document_site_id (site_id);

--
-- `diy_view_util`
--
CREATE TABLE diy_view_util (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL DEFAULT '' COMMENT '标识',
  title varchar(50) NOT NULL DEFAULT '' COMMENT '组件名称',
  type varchar(50) NOT NULL DEFAULT 'SYSTEM' COMMENT '组件类型，SYSTEM 基础组件，ADDON 营销组件，OTHER 其他组件',
  controller varchar(255) NOT NULL DEFAULT '' COMMENT '组件控制器名称',
  value text DEFAULT NULL COMMENT '配置:json格式',
  addon_name varchar(50) NOT NULL DEFAULT '' COMMENT '插件标识',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序号',
  support_diy_view varchar(500) NOT NULL DEFAULT '' COMMENT '支持的自定义页面（为空表示公共组件都支持）',
  max_count int(11) NOT NULL DEFAULT 0 COMMENT '限制添加次数',
  is_delete int(11) NOT NULL DEFAULT 0 COMMENT '是否可以删除，0 允许，1 禁用',
  icon varchar(255) NOT NULL DEFAULT '' COMMENT '组件图标',
  icon_selected varchar(255) NOT NULL DEFAULT '' COMMENT '选中组件图标',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '自定义模板组件',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_nc_diy_view_util_controller` on table `diy_view_util`
--
ALTER TABLE diy_view_util
ADD INDEX IDX_nc_diy_view_util_controller (controller);

--
-- `IDX_nc_diy_view_util_sort` on table `diy_view_util`
--
ALTER TABLE diy_view_util
ADD INDEX IDX_nc_diy_view_util_sort (sort);

--
-- `IDX_nc_diy_view_util_type` on table `diy_view_util`
--
ALTER TABLE diy_view_util
ADD INDEX IDX_nc_diy_view_util_type (type);

--
-- `name` on table `diy_view_util`
--
ALTER TABLE diy_view_util
ADD UNIQUE INDEX name (name);

--
-- `diy_view_temp`
--
CREATE TABLE diy_view_temp (
  id int(11) NOT NULL AUTO_INCREMENT,
  addon_name varchar(50) NOT NULL DEFAULT '' COMMENT '插件标识名称',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '自定义模板标识',
  title varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  value text DEFAULT NULL COMMENT '默认配置值',
  type varchar(255) NOT NULL DEFAULT 'SHOP' COMMENT '应用模块:SHOP',
  icon varchar(255) NOT NULL DEFAULT '' COMMENT '图标',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '插件中的自定义模板',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_nc_diy_view_temp_addon_name` on table `diy_view_temp`
--
ALTER TABLE diy_view_temp
ADD INDEX IDX_nc_diy_view_temp_addon_name (addon_name);

--
-- `IDX_nc_diy_view_temp_name` on table `diy_view_temp`
--
ALTER TABLE diy_view_temp
ADD INDEX IDX_nc_diy_view_temp_name (name);

--
-- `IDX_nc_diy_view_temp_type` on table `diy_view_temp`
--
ALTER TABLE diy_view_temp
ADD INDEX IDX_nc_diy_view_temp_type (type);

--
-- `div_template`
--
CREATE TABLE div_template (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(50) NOT NULL DEFAULT '' COMMENT '模板名称',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  mark varchar(255) NOT NULL DEFAULT '' COMMENT '模板标识',
  type varchar(255) NOT NULL DEFAULT '' COMMENT '类型 DIYVIEW_INDEX：主页',
  value text NOT NULL COMMENT '模板数据',
  image varchar(255) NOT NULL COMMENT '模板图片',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 7,
AVG_ROW_LENGTH = 16384,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
ROW_FORMAT = DYNAMIC;

--
-- `IDX_ns_div_template_mark` on table `div_template`
--
ALTER TABLE div_template
ADD INDEX IDX_ns_div_template_mark (mark);

--
-- `IDX_ns_div_template_type` on table `div_template`
--
ALTER TABLE div_template
ADD INDEX IDX_ns_div_template_type (type);

--
-- `cron_log`
--
CREATE TABLE cron_log (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL DEFAULT '' COMMENT '任务名称',
  event varchar(255) NOT NULL DEFAULT '' COMMENT '任务事件',
  execute_time varchar(255) NOT NULL DEFAULT '' COMMENT '执行时间',
  relate_id int(11) NOT NULL DEFAULT 0 COMMENT '关联id',
  is_success int(11) NOT NULL DEFAULT 1 COMMENT '是否成功',
  message text DEFAULT NULL COMMENT '返回结果',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '事件执行记录',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_nc_cron_execute_list_execute_time` on table `cron_log`
--
ALTER TABLE cron_log
ADD INDEX IDX_nc_cron_execute_list_execute_time (execute_time);

--
-- `cron`
--
CREATE TABLE cron (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  type int(11) NOT NULL DEFAULT 1 COMMENT '1.固定任务 2.循环任务',
  period int(11) NOT NULL DEFAULT 0 COMMENT '循环周期（分钟）',
  period_type int(11) NOT NULL DEFAULT 0 COMMENT '循环周期类型 0默认分钟 1.月 2.周 3. 日',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '任务名称',
  event varchar(255) NOT NULL DEFAULT '' COMMENT '执行事件',
  execute_time int(11) NOT NULL DEFAULT 0 COMMENT '待执行时间',
  relate_id int(11) NOT NULL DEFAULT 0 COMMENT '关联关键字id',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '计划任务表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_sys_cron_execute_time` on table `cron`
--
ALTER TABLE cron
ADD INDEX IDX_sys_cron_execute_time (execute_time);

--
-- `config`
--
CREATE TABLE config (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id（店铺，分站）,总平台端为0',
  app_module varchar(255) NOT NULL DEFAULT '' COMMENT '应用端口关键字',
  config_key varchar(255) NOT NULL DEFAULT '' COMMENT '配置项关键字',
  value varchar(5000) NOT NULL DEFAULT '' COMMENT '配置值json',
  config_desc varchar(1000) NOT NULL DEFAULT '' COMMENT '描述',
  is_use tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否启用 1启用 0不启用',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  modify_time int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '系统配置表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_sys_config_site_id` on table `config`
--
ALTER TABLE config
ADD UNIQUE INDEX IDX_sys_config_site_id (site_id, app_module, config_key);

--
-- `area`
--
CREATE TABLE area (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  pid int(11) NOT NULL DEFAULT 0 COMMENT '父级',
  name varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  shortname varchar(30) NOT NULL DEFAULT '' COMMENT '简称',
  longitude varchar(30) NOT NULL DEFAULT '' COMMENT '经度',
  latitude varchar(30) NOT NULL DEFAULT '' COMMENT '纬度',
  level smallint(6) NOT NULL DEFAULT 0 COMMENT '级别',
  sort mediumint(9) NOT NULL DEFAULT 0 COMMENT '排序',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态1有效',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 659004503,
AVG_ROW_LENGTH = 84,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '地址表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_nc_area` on table `area`
--
ALTER TABLE area
ADD INDEX IDX_nc_area (name, shortname);

--
-- `level` on table `area`
--
ALTER TABLE area
ADD INDEX level (level, sort, status);

--
-- `longitude` on table `area`
--
ALTER TABLE area
ADD INDEX longitude (longitude, latitude);

--
-- `pid` on table `area`
--
ALTER TABLE area
ADD INDEX pid (pid);

--
-- `album_pic`
--
CREATE TABLE album_pic (
  pic_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  pic_name varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  pic_path varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  pic_spec varchar(255) NOT NULL DEFAULT '' COMMENT '规格',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  album_id int(11) NOT NULL DEFAULT 0 COMMENT '相册id',
  PRIMARY KEY (pic_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '相册图片表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_sys_album_pic_site_id` on table `album_pic`
--
ALTER TABLE album_pic
ADD INDEX IDX_sys_album_pic_site_id (site_id);

--
-- `album`
--
CREATE TABLE album (
  album_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  site_name varchar(255) NOT NULL DEFAULT '' COMMENT '站点名称',
  album_name varchar(50) NOT NULL DEFAULT '' COMMENT '相册,名称',
  sort int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  cover varchar(255) NOT NULL DEFAULT '' COMMENT '背景图',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
  is_default tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否默认',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  num int(11) NOT NULL DEFAULT 0 COMMENT '相册图片数',
  PRIMARY KEY (album_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '相册表',
ROW_FORMAT = DYNAMIC;

--
-- `IDX_sys_album_is_default` on table `album`
--
ALTER TABLE album
ADD INDEX IDX_sys_album_is_default (is_default);

--
-- `IDX_sys_album_site_id` on table `album`
--
ALTER TABLE album
ADD INDEX IDX_sys_album_site_id (site_id);

--
-- `IDX_sys_album_sort` on table `album`
--
ALTER TABLE album
ADD INDEX IDX_sys_album_sort (sort);

--
-- `adv_position`
--
CREATE TABLE adv_position (
  ap_id mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '广告位置id',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  ap_name varchar(100) NOT NULL DEFAULT '' COMMENT '广告位置名',
  ap_intro varchar(255) NOT NULL DEFAULT '' COMMENT '广告位简介',
  ap_height int(10) NOT NULL DEFAULT 0 COMMENT '广告位高度',
  ap_width int(10) NOT NULL DEFAULT 0 COMMENT '广告位宽度',
  default_content varchar(300) NOT NULL DEFAULT '',
  ap_background_color varchar(50) NOT NULL DEFAULT '#FFFFFF' COMMENT '广告位背景色 默认白色',
  type tinyint(4) NOT NULL DEFAULT 1 COMMENT '广告位所在位置类型   1 pc端  2 手机端',
  keyword varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  PRIMARY KEY (ap_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '广告位表',
ROW_FORMAT = DYNAMIC;

--
-- `adv`
--
CREATE TABLE adv (
  adv_id int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  site_id int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
  ap_id int(11) NOT NULL DEFAULT 0 COMMENT '广告位id',
  adv_title varchar(255) NOT NULL DEFAULT '' COMMENT '广告内容描述',
  adv_url varchar(2000) NOT NULL DEFAULT '' COMMENT '广告链接',
  adv_image varchar(255) NOT NULL DEFAULT '' COMMENT '广告内容图片',
  slide_sort int(11) NOT NULL DEFAULT 0 COMMENT '排序号',
  price decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '广告价格/月',
  background varchar(255) NOT NULL DEFAULT '#FFFFFF' COMMENT '背景色',
  PRIMARY KEY (adv_id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '广告表',
ROW_FORMAT = DYNAMIC;

--
-- `addon_quick`
--
CREATE TABLE addon_quick (
  id int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  name varchar(40) NOT NULL DEFAULT '' COMMENT '插件名称或者标识',
  package_name varchar(255) NOT NULL DEFAULT '' COMMENT '套餐名称',
  type varchar(255) NOT NULL DEFAULT '' COMMENT '插件类型',
  icon varchar(255) NOT NULL DEFAULT '' COMMENT '插件图标',
  title varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  description text DEFAULT NULL COMMENT '插件描述',
  author varchar(40) NOT NULL DEFAULT '' COMMENT '作者',
  version varchar(20) NOT NULL DEFAULT '' COMMENT '版本号',
  version_no varchar(255) NOT NULL DEFAULT '' COMMENT '版本编号',
  content text NOT NULL COMMENT '详情',
  create_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '插件表',
ROW_FORMAT = DYNAMIC;

--
-- `UK_nc_addons_name` on table `addon_quick`
--
ALTER TABLE addon_quick
ADD UNIQUE INDEX UK_nc_addons_name (name);

--
-- `addon`
--
CREATE TABLE addon (
  id int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  name varchar(40) NOT NULL DEFAULT '' COMMENT '插件名称或者标识',
  type varchar(255) NOT NULL DEFAULT '' COMMENT '插件类型',
  icon varchar(255) NOT NULL DEFAULT '' COMMENT '插件图标',
  title varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  description text DEFAULT NULL COMMENT '插件描述',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  author varchar(40) NOT NULL DEFAULT '' COMMENT '作者',
  version varchar(20) NOT NULL DEFAULT '' COMMENT '版本号',
  version_no varchar(255) NOT NULL DEFAULT '' COMMENT '版本编号',
  content text NOT NULL COMMENT '详情',
  create_time int(11) NOT NULL DEFAULT 0 COMMENT '安装时间',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci,
COMMENT = '插件表',
ROW_FORMAT = DYNAMIC;

--
-- `UK_nc_addons_name` on table `addon`
--
ALTER TABLE addon
ADD UNIQUE INDEX UK_nc_addons_name (name);

--
-- Dumping data for table wechat_replay_rule
--
-- Table niushop_b2c_v4_2020_1127_0936.wechat_replay_rule does not contain any data (it is empty)

--
-- Dumping data for table wechat_qrcode
--
-- Table niushop_b2c_v4_2020_1127_0936.wechat_qrcode does not contain any data (it is empty)

--
-- Dumping data for table wechat_media
--
-- Table niushop_b2c_v4_2020_1127_0936.wechat_media does not contain any data (it is empty)

--
-- Dumping data for table wechat_mass_recording
--
-- Table niushop_b2c_v4_2020_1127_0936.wechat_mass_recording does not contain any data (it is empty)

--
-- Dumping data for table wechat_fans_tag
--
-- Table niushop_b2c_v4_2020_1127_0936.wechat_fans_tag does not contain any data (it is empty)

--
-- Dumping data for table wechat_fans
--
-- Table niushop_b2c_v4_2020_1127_0936.wechat_fans does not contain any data (it is empty)

--
-- Dumping data for table weapp_live_room
--
-- Table niushop_b2c_v4_2020_1127_0936.weapp_live_room does not contain any data (it is empty)

--
-- Dumping data for table weapp_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.weapp_goods does not contain any data (it is empty)

--
-- Dumping data for table weapp_experiencer
--
-- Table niushop_b2c_v4_2020_1127_0936.weapp_experiencer does not contain any data (it is empty)

--
-- Dumping data for table weapp_audit_record
--
-- Table niushop_b2c_v4_2020_1127_0936.weapp_audit_record does not contain any data (it is empty)

--
-- Dumping data for table verify
--
-- Table niushop_b2c_v4_2020_1127_0936.verify does not contain any data (it is empty)

--
-- Dumping data for table verifier
--
-- Table niushop_b2c_v4_2020_1127_0936.verifier does not contain any data (it is empty)

--
-- Dumping data for table v3_upgrade_log
--
-- Table niushop_b2c_v4_2020_1127_0936.v3_upgrade_log does not contain any data (it is empty)

--
-- Dumping data for table user_log
--
-- Table niushop_b2c_v4_2020_1127_0936.user_log does not contain any data (it is empty)

--
-- Dumping data for table user
--
-- Table niushop_b2c_v4_2020_1127_0936.user does not contain any data (it is empty)

--
-- Dumping data for table sys_upgrade_log
--
-- Table niushop_b2c_v4_2020_1127_0936.sys_upgrade_log does not contain any data (it is empty)

--
-- Dumping data for table supplier
--
-- Table niushop_b2c_v4_2020_1127_0936.supplier does not contain any data (it is empty)

--
-- Dumping data for table store_stock_import_log
--
-- Table niushop_b2c_v4_2020_1127_0936.store_stock_import_log does not contain any data (it is empty)

--
-- Dumping data for table store_stock_import
--
-- Table niushop_b2c_v4_2020_1127_0936.store_stock_import does not contain any data (it is empty)

--
-- Dumping data for table store_settlement
--
-- Table niushop_b2c_v4_2020_1127_0936.store_settlement does not contain any data (it is empty)

--
-- Dumping data for table store_member
--
-- Table niushop_b2c_v4_2020_1127_0936.store_member does not contain any data (it is empty)

--
-- Dumping data for table store_goods_sku
--
-- Table niushop_b2c_v4_2020_1127_0936.store_goods_sku does not contain any data (it is empty)

--
-- Dumping data for table store_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.store_goods does not contain any data (it is empty)

--
-- Dumping data for table store
--
-- Table niushop_b2c_v4_2020_1127_0936.store does not contain any data (it is empty)

--
-- Dumping data for table stat_shop
--
-- Table niushop_b2c_v4_2020_1127_0936.stat_shop does not contain any data (it is empty)

--
-- Dumping data for table sms_template
--
INSERT INTO sms_template VALUES
(1, 1, 0, 'ORDER_CREATE', 2, '订单创建通知', '尊敬的会员，您的订单已创建，订单号{orderno}。', '{"orderno":"other_number"}', 0, 0, 0, 1596437584),
(2, 1, 0, 'ORDER_CLOSE', 2, '订单关闭通知', '尊敬的会员，您的订单{orderno}，已关闭。', '{"orderno":"other_number"}', 0, 0, 0, 1596427379),
(3, 1, 0, 'ORDER_COMPLETE', 2, '订单完成通知', '尊敬的会员，您的订单{orderno}，交易成功。', '{"orderno":"other_number"}', 0, 0, 0, 1596427376),
(4, 1, 0, 'ORDER_PAY', 2, '订单支付通知', '亲爱的{username},你的订单号为{orderno}的订单已成功支付,支付金额{ordermoney}', '{"username":"others","orderno":"other_number","ordermoney":"amount"}', 0, 0, 0, 1596428621),
(5, 1, 0, 'ORDER_DELIVERY', 2, '订单发货通知', '尊敬的会员，您的订单已发货，订单号{orderno}。', '{"orderno":"other_number"}', 0, 0, 0, 1596427369),
(6, 1, 0, 'ORDER_TAKE_DELIVERY', 2, '订单收货通知', '尊敬的会员，您的订单{orderno}，收货成功。', '{"orderno":"other_number"}', 0, 0, 0, 1596427365),
(7, 1, 0, 'ORDER_REFUND_AGREE', 2, '商家同意退款', '尊敬的会员，您的订单{orderno}，商家同意退款。', '{"orderno":"other_number"}', 0, 0, 0, 1596427356),
(8, 1, 0, 'ORDER_REFUND_REFUSE', 2, '商家拒绝退款', '尊敬的会员，您的订单{orderno}，商家拒绝退款。', '{"orderno":"other_number"}', 0, 0, 0, 1596427352),
(9, 1, 0, 'VERIFY', 2, '核销取货', '尊敬的会员，您的订单{orderno}，商家核销成功。', '{"orderno":"other_number"}', 0, 0, 0, 1596427347),
(10, 1, 0, 'REGISTER_CODE', 1, '注册验证', '您的验证码为：{code}，该验证码 5 分钟内有效，请勿泄漏于他人！', '{"code":"valid_code"}', 0, 0, 0, 1596426737),
(11, 1, 0, 'REGISTER_SUCCESS', 2, '注册成功', '尊敬的{username},您以成功注册为{shopname}用户。', '{"username":"others","shopname":"others"}', 0, 0, 0, 1596426734),
(12, 1, 0, 'FIND_PASSWORD', 1, '找回密码', '您的验证码{code}，该验证码5分钟内有效，请勿泄漏于他人！', '{"code":"valid_code"}', 0, 0, 0, 1596426730),
(13, 1, 0, 'LOGIN', 2, '会员登录', '尊敬的{name}，您的账号登陆成功。', '{"name":"others"}', 0, 0, 0, 1596426726),
(14, 1, 0, 'MEMBER_BIND', 1, '账户绑定', '您的验证码为：{code}，该验证码 5 分钟内有效，请勿泄漏于他人！', '{"code":"valid_code"}', 0, 0, 0, 1596426723),
(15, 1, 0, 'LOGIN_CODE', 1, '动态码登录', '您的验证码为：{code}，该验证码 5 分钟内有效，请勿泄漏于他人！', '{"code":"valid_code"}', 0, 0, 0, 1596426719),
(16, 1, 0, 'SET_PASSWORD', 1, '设置密码', '您的验证码{code}，该验证码5分钟内有效，请勿泄漏于他人！', '{"code":"valid_code"}', 0, 0, 0, 1596426714),
(17, 1, 0, 'BUYER_REFUND', 2, '买家已退货提醒', '订单号为{orderno}，买家退货。', '{"orderno":"other_number"}', 0, 0, 0, 1596436982),
(18, 1, 0, 'BUYER_DELIVERY_REFUND', 2, '买家发起退款提醒', '{username}申请了退款，订单号为{orderno}的商品{goodsname}，退款单号为{refundno}，退款金额{refundmoney}，退款原因{refundreason}。', '{"username":"others","orderno":"other_number","goodsname":"others","refundno":"other_number","refundmoney":"amount","refundreason":"others"}', 0, 0, 0, 1596437579),
(19, 1, 0, 'BUYER_TAKE_DELIVERY', 2, '买家收货提醒', '订单号为{orderno}，买家已收货。', '{"orderno":"other_number"}', 0, 0, 0, 1599040477),
(20, 1, 0, 'BUYER_PAY', 2, '买家支付提醒', '订单号为{orderno}，买家已支付，支付金额为{ordermoney}。', '{"orderno":"other_number","ordermoney":"amount"}', 0, 0, 0, 1599040486),
(21, 1, 0, 'USER_WITHDRAWAL_APPLY', 2, '会员申请提现通知', '会员{username}申请余额提现，提现金额为{money}', '{"username":"others","money":"amount"}', 0, 0, 0, 1599876409),
(22, 1, 0, 'FENXIAO_WITHDRAWAL_APPLY', 2, '分销申请提现通知', '分销商{fenxiaoname}申请佣金提现，提现金额为{money}', '{"fenxiaorname":"others","money":"amount"}', 0, 0, 0, 1599820140),
(23, 1, 0, 'USER_WITHDRAWAL_SUCCESS', 2, '会员提现成功通知', '尊敬的{username}，您申请的{money}余额，已提现成功。', '{"username":"others","money":"amount"}', 0, 0, 0, 1599876399),
(24, 1, 0, 'FENXIAO_WITHDRAWAL_SUCCESS', 2, '分销提现成功通知', '尊敬的{username}，您申请的{money}佣金，已提现成功。', '{"fenxiaorname":"others","money":"amount"}', 0, 0, 0, 1599820115),
(25, 1, 0, 'USER_CANCEL_SUCCESS', 2, '会员注销成功', '尊敬的{username}，您的账号已注销成功。', '{"username":"others"}', 0, 0, 0, 1603694000),
(26, 1, 0, 'USER_CANCEL_FAIL', 2, '会员注销失败', '尊敬的{username}，您的账号商家拒绝注销。', '{"username":"others"}', 0, 0, 0, 1603693993),
(27, 1, 0, 'USER_CANCEL_APPLY', 2, '会员注销申请', '账号为{username}，会员申请注销。', '{"username":"others"}', 0, 0, 0, 1603693989);

--
-- Dumping data for table site_diy_view
--
-- Table niushop_b2c_v4_2020_1127_0936.site_diy_view does not contain any data (it is empty)

--
-- Dumping data for table site
--
-- Table niushop_b2c_v4_2020_1127_0936.site does not contain any data (it is empty)

--
-- Dumping data for table shop_address
--
-- Table niushop_b2c_v4_2020_1127_0936.shop_address does not contain any data (it is empty)

--
-- Dumping data for table shop_accept_message
--
-- Table niushop_b2c_v4_2020_1127_0936.shop_accept_message does not contain any data (it is empty)

--
-- Dumping data for table shop
--
-- Table niushop_b2c_v4_2020_1127_0936.shop does not contain any data (it is empty)

--
-- Dumping data for table servicer_member
--
-- Table niushop_b2c_v4_2020_1127_0936.servicer_member does not contain any data (it is empty)

--
-- Dumping data for table servicer_dialogue
--
-- Table niushop_b2c_v4_2020_1127_0936.servicer_dialogue does not contain any data (it is empty)

--
-- Dumping data for table servicer
--
-- Table niushop_b2c_v4_2020_1127_0936.servicer does not contain any data (it is empty)

--
-- Dumping data for table promotion_topic_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_topic_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_topic
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_topic does not contain any data (it is empty)

--
-- Dumping data for table promotion_seckill_time
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_seckill_time does not contain any data (it is empty)

--
-- Dumping data for table promotion_seckill_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_seckill_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_seckill
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_seckill does not contain any data (it is empty)

--
-- Dumping data for table promotion_present
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_present does not contain any data (it is empty)

--
-- Dumping data for table promotion_pintuan_order
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_pintuan_order does not contain any data (it is empty)

--
-- Dumping data for table promotion_pintuan_group
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_pintuan_group does not contain any data (it is empty)

--
-- Dumping data for table promotion_pintuan_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_pintuan_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_pintuan
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_pintuan does not contain any data (it is empty)

--
-- Dumping data for table promotion_mansong_record
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_mansong_record does not contain any data (it is empty)

--
-- Dumping data for table promotion_manjian_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_manjian_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_manjian
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_manjian does not contain any data (it is empty)

--
-- Dumping data for table promotion_groupbuy
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_groupbuy does not contain any data (it is empty)

--
-- Dumping data for table promotion_games_draw_record
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_games_draw_record does not contain any data (it is empty)

--
-- Dumping data for table promotion_games_award
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_games_award does not contain any data (it is empty)

--
-- Dumping data for table promotion_games
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_games does not contain any data (it is empty)

--
-- Dumping data for table promotion_freeshipping
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_freeshipping does not contain any data (it is empty)

--
-- Dumping data for table promotion_exchange_order
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_exchange_order does not contain any data (it is empty)

--
-- Dumping data for table promotion_exchange_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_exchange_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_exchange
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_exchange does not contain any data (it is empty)

--
-- Dumping data for table promotion_discount_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_discount_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_discount
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_discount does not contain any data (it is empty)

--
-- Dumping data for table promotion_coupon_type
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_coupon_type does not contain any data (it is empty)

--
-- Dumping data for table promotion_coupon
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_coupon does not contain any data (it is empty)

--
-- Dumping data for table promotion_bundling_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_bundling_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_bundling
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_bundling does not contain any data (it is empty)

--
-- Dumping data for table promotion_bargain_record
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_bargain_record does not contain any data (it is empty)

--
-- Dumping data for table promotion_bargain_launch
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_bargain_launch does not contain any data (it is empty)

--
-- Dumping data for table promotion_bargain_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_bargain_goods does not contain any data (it is empty)

--
-- Dumping data for table promotion_bargain
--
-- Table niushop_b2c_v4_2020_1127_0936.promotion_bargain does not contain any data (it is empty)

--
-- Dumping data for table printer_template
--
-- Table niushop_b2c_v4_2020_1127_0936.printer_template does not contain any data (it is empty)

--
-- Dumping data for table printer
--
-- Table niushop_b2c_v4_2020_1127_0936.printer does not contain any data (it is empty)

--
-- Dumping data for table pay_refund
--
-- Table niushop_b2c_v4_2020_1127_0936.pay_refund does not contain any data (it is empty)

--
-- Dumping data for table pay
--
-- Table niushop_b2c_v4_2020_1127_0936.pay does not contain any data (it is empty)

--
-- Dumping data for table order_refund_log
--
-- Table niushop_b2c_v4_2020_1127_0936.order_refund_log does not contain any data (it is empty)

--
-- Dumping data for table order_refund_export
--
-- Table niushop_b2c_v4_2020_1127_0936.order_refund_export does not contain any data (it is empty)

--
-- Dumping data for table order_promotion_detail
--
-- Table niushop_b2c_v4_2020_1127_0936.order_promotion_detail does not contain any data (it is empty)

--
-- Dumping data for table order_log
--
-- Table niushop_b2c_v4_2020_1127_0936.order_log does not contain any data (it is empty)

--
-- Dumping data for table order_import_file_log
--
-- Table niushop_b2c_v4_2020_1127_0936.order_import_file_log does not contain any data (it is empty)

--
-- Dumping data for table order_import_file
--
-- Table niushop_b2c_v4_2020_1127_0936.order_import_file does not contain any data (it is empty)

--
-- Dumping data for table order_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.order_goods does not contain any data (it is empty)

--
-- Dumping data for table order_export
--
-- Table niushop_b2c_v4_2020_1127_0936.order_export does not contain any data (it is empty)

--
-- Dumping data for table `order`
--
-- Table niushop_b2c_v4_2020_1127_0936.`order` does not contain any data (it is empty)

--
-- Dumping data for table notice
--
-- Table niushop_b2c_v4_2020_1127_0936.notice does not contain any data (it is empty)

--
-- Dumping data for table notes_group
--
-- Table niushop_b2c_v4_2020_1127_0936.notes_group does not contain any data (it is empty)

--
-- Dumping data for table notes_dianzan_record
--
-- Table niushop_b2c_v4_2020_1127_0936.notes_dianzan_record does not contain any data (it is empty)

--
-- Dumping data for table notes
--
-- Table niushop_b2c_v4_2020_1127_0936.notes does not contain any data (it is empty)

--
-- Dumping data for table message_wechat_records
--
-- Table niushop_b2c_v4_2020_1127_0936.message_wechat_records does not contain any data (it is empty)

--
-- Dumping data for table message_variable
--
INSERT INTO message_variable VALUES
(1, '店铺名称', 'shopname', ',REGISTER,NEW_ORDER,LOGIN,'),
(2, '会员名称', 'membername', ',REGISTER,NEW_ORDER,LOGIN,'),
(3, '验证码', 'number', ',REGISTER,LOGIN,');

--
-- Dumping data for table message_template
--
INSERT INTO message_template VALUES
(1, '', 'ORDER_CREATE', '订单创建通知', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_186948179","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355\\u5df2\\u521b\\u5efa\\uff0c\\u8ba2\\u5355\\u53f7${orderno}\\u3002","smssign":""}}', '【{sitename}】,您的验证码{code},请不要泄露得1其他人', '{"template_id_short":"OPENTM401874876","template_id":"gX4RlhMwl-lyGdfUujvR_NFcezUSyIhpSgGQB7hyjtg","headtext":"1234545","bottomtext":"456","headtextcolor":"#9a13e8","bottomtextcolor":"#7e2b2b","content":"\\u8ba2\\u5355\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u4e0b\\u5355\\u65f6\\u95f4\\uff1a{{keyword2.DATA}}\\n\\u4ea7\\u54c1\\u8be6\\u60c5\\uff1a{{keyword3.DATA}}\\n\\u9700\\u652f\\u4ed8\\u91d1\\u989d\\uff1a{{keyword4.DATA}}\\n\\u6536\\u8d27\\u8be6\\u60c5\\uff1a{{keyword5.DATA}}"}', '', '', 'sms,wechat'),
(2, '', 'ORDER_CLOSE', '订单关闭通知', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190728268","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355${orderno}\\uff0c\\u5df2\\u5173\\u95ed\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM205543831","template_id":"v3WG7D2sXYbFxSr34tn4H37mYOod6le3aCrc9Ifr0co","headtext":"456","bottomtext":"789","headtextcolor":"#dc6a13","bottomtextcolor":"#2a9a08","content":"\\u8ba2\\u5355\\u5546\\u54c1\\uff1a{{keyword1.DATA}}\\n\\u8ba2\\u5355\\u7f16\\u53f7\\uff1a{{keyword2.DATA}}\\n\\u4e0b\\u5355\\u65f6\\u95f4\\uff1a{{keyword3.DATA}}\\n\\u8ba2\\u5355\\u91d1\\u989d\\uff1a{{keyword4.DATA}}\\n\\u5173\\u95ed\\u65f6\\u95f4\\uff1a{{keyword5.DATA}}"}', '', '', 'sms,wechat'),
(3, '', 'ORDER_COMPLETE', '订单完成通知', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190728270","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355${orderno}\\uff0c\\u4ea4\\u6613\\u6210\\u529f\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM412034601","template_id":"VhtPPIYyYkS93uuZ7CKqYqApnB3YmtrA8mVBTC6gd1k","headtext":"\\u60a8\\u7684\\u8ba2\\u5355\\u5df2\\u5b8c\\u6210\\u3002","bottomtext":"\\u8be6\\u60c5\\u8bf7\\u767b\\u5f55\\u516c\\u4f17\\u53f7\\u67e5\\u770b\\u3002","headtextcolor":"#fe0000","bottomtextcolor":"#1f7af2","content":"\\u8ba2\\u5355\\u5355\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u8ba2\\u5355\\u5546\\u54c1\\uff1a{{keyword2.DATA}}\\n\\u4e0b\\u5355\\u65f6\\u95f4\\uff1a{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(4, '', 'ORDER_PAY', '订单支付通知', 1, '{"orderno":"订单号","username":"会员名称","ordermoney":"订单金额"}', '', '{"alisms":{"template_id":"SMS_190782764","content":"\\u4eb2\\u7231\\u7684${username},\\u4f60\\u7684\\u8ba2\\u5355\\u53f7\\u4e3a${orderno}\\u7684\\u8ba2\\u5355\\u5df2\\u6210\\u529f\\u652f\\u4ed8,\\u652f\\u4ed8\\u91d1\\u989d${ordermoney}","smssign":""}}', '', '{"template_id_short":"OPENTM402074360","template_id":"W703NbjLcYFPo230M_LuuwRCOsPitGZyb0JHIb9hYhU","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u4e0b\\u5355\\u65f6\\u95f4\\uff1a{{keyword1.DATA}}\\n\\u8ba2\\u5355\\u7f16\\u53f7\\uff1a{{keyword2.DATA}}\\n\\u5546\\u54c1\\u4fe1\\u606f\\uff1a{{keyword3.DATA}}\\n\\u8ba2\\u5355\\u91d1\\u989d\\uff1a{{keyword4.DATA}}"}', '', '', 'sms,wechat'),
(5, '', 'ORDER_DELIVERY', '订单发货通知', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190728272","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355\\u5df2\\u53d1\\u8d27\\uff0c\\u8ba2\\u5355\\u53f7${orderno}\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM406700005","template_id":"Lbk1erxo_tvieaEFJmKP7pQ0EjwqlbsN1kQ2-G80TjE","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u8ba2\\u5355\\u7f16\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u5546\\u54c1\\u540d\\u79f0\\uff1a{{keyword2.DATA}}\\n\\u5546\\u54c1\\u4ef6\\u6570\\uff1a{{keyword3.DATA}}\\n\\u652f\\u4ed8\\u91d1\\u989d\\uff1a{{keyword4.DATA}}\\n\\u53d1\\u8d27\\u65f6\\u95f4\\uff1a{{keyword5.DATA}}"}', '', '', 'sms,wechat'),
(6, '', 'ORDER_TAKE_DELIVERY', '订单收货通知', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190787796","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355${orderno}\\uff0c\\u6536\\u8d27\\u6210\\u529f\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM418052192","template_id":"jkR8-41zym5_CEbQ1H4ftccCmD_56ga298LeMSiMeOw","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u6536\\u8d27\\u5730\\u5740\\uff1a{{keyword1.DATA}}\\n\\u8054\\u7cfb\\u4eba\\uff1a{{keyword2.DATA}}\\n\\u8ba2\\u5355\\u53f7\\uff1a{{keyword3.DATA}}\\n\\u8ba2\\u5355\\u8be6\\u60c5\\uff1a{{keyword4.DATA}}\\n\\u64cd\\u4f5c\\u65f6\\u95f4\\uff1a{{keyword5.DATA}}"}', '', '', 'sms,wechat'),
(7, '', 'ORDER_REFUND_AGREE', '商家同意退款', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190792661","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355${orderno}\\uff0c\\u5546\\u5bb6\\u540c\\u610f\\u9000\\u6b3e\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM412135258","template_id":"dGuS1yW7yxsclYRL9M6bE4cLCvy-eQ5j7Ur3O56TaVI","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u8ba2\\u5355\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u9000\\u6b3e\\u91d1\\u989d\\uff1a{{keyword2.DATA}}\\n\\u65f6\\u95f4\\uff1a{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(8, '', 'ORDER_REFUND_REFUSE', '商家拒绝退款', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190792662","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355${orderno}\\uff0c\\u5546\\u5bb6\\u62d2\\u7edd\\u9000\\u6b3e\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM417819857","template_id":"Z-NHMwRfF53v_WI5o7pTef3NFONmFDa0r86OI-CpIbQ","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u5355\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u91d1\\u989d\\uff1a{{keyword2.DATA}}\\n\\u65f6\\u95f4\\uff1a{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(9, '', 'VERIFY', '核销取货', 1, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190782769","content":"\\u5c0a\\u656c\\u7684\\u4f1a\\u5458\\uff0c\\u60a8\\u7684\\u8ba2\\u5355${orderno}\\uff0c\\u5546\\u5bb6\\u6838\\u9500\\u6210\\u529f\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM416687547","template_id":"", "headtext": "", "bottomtext": "", "headtextcolor": "", "bottomtextcolor": "", "content": "商品名称：{{keyword1.DATA}}\\n商品数量：{{keyword2.DATA}}\\n核销时间：{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(10, '', 'BUYER_REFUND', '订单维权通知', 2, '{"username":"会员名称","goodsname":"商品名称","orderno":"订单号","refundmoney":"退款金额","refundreason":"退款原因","refundno":"退款单号"}', '', '{"alisms":{"template_id":"SMS_190792667","content":"${username}\\u7533\\u8bf7\\u4e86\\u9000\\u6b3e\\uff0c\\u8ba2\\u5355\\u53f7\\u4e3a${orderno}\\u7684\\u5546\\u54c1${goodsname}\\uff0c\\u9000\\u6b3e\\u5355\\u53f7\\u4e3a${refundno}\\uff0c\\u9000\\u6b3e\\u91d1\\u989d${refundmoney}\\uff0c\\u9000\\u6b3e\\u539f\\u56e0${refundreason}\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM412244458","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u9000\\u6b3e\\u5355\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u7533\\u8bf7\\u65f6\\u95f4\\uff1a{{keyword2.DATA}}\\n\\u9000\\u6b3e\\u91d1\\u989d\\uff1a{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(11, '', 'BUYER_DELIVERY_REFUND', '买家已退货通知', 2, '{"orderno":"订单号"}', '', '{"alisms":{"template_id":"SMS_190787803","content":"\\u8ba2\\u5355\\u53f7\\u4e3a${orderno}\\uff0c\\u4e70\\u5bb6\\u9000\\u8d27\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM206905995","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u9000\\u8d27\\u8ba2\\u5355\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u9000\\u8d27\\u5546\\u54c1\\uff1a{{keyword2.DATA}}\\n\\u9000\\u8d27\\u6570\\u91cf\\uff1a{{keyword3.DATA}}\\n\\u9000\\u8d27\\u91d1\\u989d\\uff1a{{keyword4.DATA}}"}', '', '', 'sms,wechat'),
(12, '', 'REGISTER_CODE', '注册验证', 1, '{"code":"验证码","site_name":"站点名称"}', '', '{"alisms":{"template_id":"SMS_190792675","content":"\\u60a8\\u7684\\u9a8c\\u8bc1\\u7801\\u4e3a\\uff1a${code}\\uff0c\\u8be5\\u9a8c\\u8bc1\\u7801 5 \\u5206\\u949f\\u5185\\u6709\\u6548\\uff0c\\u8bf7\\u52ff\\u6cc4\\u6f0f\\u4e8e\\u4ed6\\u4eba\\u3002","smssign":""}}', '', '', '', '', 'sms'),
(13, '', 'REGISTER_SUCCESS', '注册成功', 1, '{"shopname":"商城名称","username":"会员名称"}', '', '{"alisms":{"template_id":"SMS_190782770","content":"\\u5c0a\\u656c\\u7684${username},\\u60a8\\u4ee5\\u6210\\u529f\\u6ce8\\u518c\\u4e3a${shopname}\\u7528\\u6237\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM409413579","template_id":"tC_BqfMf4nEdOqinD4vHWgyanVl5DO__bRyTOTA2NfQ","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u6ce8\\u518c\\u8d26\\u53f7\\uff1a{{keyword1.DATA}}\\n\\u6ce8\\u518c\\u65f6\\u95f4\\uff1a{{keyword2.DATA}}"}', '', '', 'sms,wechat'),
(14, '', 'FIND_PASSWORD', '找回密码', 1, '{"code":"验证码","site_name":"站点名称"}', '', '{"alisms":{"template_id":"SMS_190792678","content":"\\u60a8\\u7684\\u9a8c\\u8bc1\\u7801${code}\\uff0c\\u8be5\\u9a8c\\u8bc1\\u78015\\u5206\\u949f\\u5185\\u6709\\u6548\\uff0c\\u8bf7\\u52ff\\u6cc4\\u6f0f\\u4e8e\\u4ed6\\u4eba\\uff01","smssign":""}}', '', '', '', '', 'sms'),
(15, '', 'LOGIN', '会员登录', 1, '{"name":"会员名称"}', '', '{"alisms":{"template_id":"SMS_190728279","content":"\\u5c0a\\u656c\\u7684${name}\\uff0c\\u60a8\\u7684\\u8d26\\u53f7\\u767b\\u9646\\u6210\\u529f\\u3002","smssign":""}}', '', '{"template_id_short":"OPENTM412447375","template_id":"jQcfV222-1xer1O5diwLZfPFldGW9-3-XmtfJrvkSag","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"登录账号：{{keyword1.DATA}}\\n登录状态：{{keyword2.DATA}}\\n登录时间：{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(16, '', 'MEMBER_BIND', '账户绑定', 1, '{"code":"验证码","site_name":"站点名称"}', '', '{"alisms":{"template_id":"SMS_190792680","content":"\\u60a8\\u7684\\u9a8c\\u8bc1\\u7801\\u4e3a\\uff1a${code}\\uff0c\\u8be5\\u9a8c\\u8bc1\\u7801 5 \\u5206\\u949f\\u5185\\u6709\\u6548\\uff0c\\u8bf7\\u52ff\\u6cc4\\u6f0f\\u4e8e\\u4ed6\\u4eba\\u3002","smssign":""}}', '', '', '', '', 'sms'),
(17, '', 'LOGIN_CODE', '动态码登录', 1, '{"code":"验证码"}', '', '{"alisms":{"template_id":"SMS_190792665","content":"\\u60a8\\u7684\\u9a8c\\u8bc1\\u7801\\u4e3a\\uff1a${code}\\uff0c\\u8be5\\u9a8c\\u8bc1\\u7801 5 \\u5206\\u949f\\u5185\\u6709\\u6548\\uff0c\\u8bf7\\u52ff\\u6cc4\\u6f0f\\u4e8e\\u4ed6\\u4eba\\u3002","smssign":""}}', '', '', '', '', 'sms'),
(18, '', 'SET_PASSWORD', '设置密码', 1, '{"code":"验证码"}', '', '{"alisms":{"template_id":"SMS_190728294","content":"\\u60a8\\u7684\\u9a8c\\u8bc1\\u7801${code}\\uff0c\\u8be5\\u9a8c\\u8bc1\\u78015\\u5206\\u949f\\u5185\\u6709\\u6548\\uff0c\\u8bf7\\u52ff\\u6cc4\\u6f0f\\u4e8e\\u4ed6\\u4eba\\uff01","smssign":""}}', '', '', '', '', 'sms'),
(19, '', 'BUYER_TAKE_DELIVERY', '买家收货通知', 2, '{"orderno":"订单号"}', '', '', '', '{"template_id_short":"OPENTM418052192","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u6536\\u8d27\\u5730\\u5740\\uff1a{{keyword1.DATA}}\\n\\u8054\\u7cfb\\u4eba\\uff1a{{keyword2.DATA}}\\n\\u8ba2\\u5355\\u53f7\\uff1a{{keyword3.DATA}}\\n\\u8ba2\\u5355\\u8be6\\u60c5\\uff1a{{keyword4.DATA}}\\n\\u64cd\\u4f5c\\u65f6\\u95f4\\uff1a{{keyword5.DATA}}"}', '', '', 'sms,wechat'),
(20, '', 'BUYER_PAY', '买家支付通知', 2, '{"orderno":"订单号","ordermoney":"订单金额"}', '', '', '', '{"template_id_short":"OPENTM402074360","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"\\u4e0b\\u5355\\u65f6\\u95f4\\uff1a{{keyword1.DATA}}\\n\\u8ba2\\u5355\\u7f16\\u53f7\\uff1a{{keyword2.DATA}}\\n\\u5546\\u54c1\\u4fe1\\u606f\\uff1a{{keyword3.DATA}}\\n\\u8ba2\\u5355\\u91d1\\u989d\\uff1a{{keyword4.DATA}}"}', '', '', 'sms,wechat'),
(21, '', 'USER_WITHDRAWAL_APPLY', '会员申请提现通知', 2, '{"username":"会员名称","money":"提现金额"}', '', '', '', '{"template_id_short":"OPENTM416719519","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"申请人：{{keyword1.DATA}}\\n创建时间：{{keyword2.DATA}}\\n申请金额：{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(22, '', 'FENXIAO_WITHDRAWAL_APPLY', '分销申请提现通知', 2, '{"fenxiaoname":"分销商名称","money":"提现金额"}', '', '', '', '{"template_id_short":"OPENTM416719519","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"申请人：{{keyword1.DATA}}\\n创建时间：{{keyword2.DATA}}\\n申请金额：{{keyword3.DATA}}"}', '', '', 'sms,wechat'),
(23, '', 'USER_WITHDRAWAL_SUCCESS', '会员提现成功通知', 1, '{"username":"会员名称","money":"提现金额"}', '', '', '', '{"template_id_short":"OPENTM203174659","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"提现金额：{{keyword1.DATA}}\\n到账时间：{{keyword2.DATA}}"}', '', '', 'sms,wechat'),
(24, '', 'FENXIAO_WITHDRAWAL_SUCCESS', '分销提现成功通知', 1, '{"fenxiaoname":"分销商名称","money":"提现金额"}', '', '', '', '{"template_id_short":"OPENTM203174659","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"提现金额：{{keyword1.DATA}}\\n到账时间：{{keyword2.DATA}}"}', '', '', 'sms,wechat'),
(25, '', 'USER_CANCEL_SUCCESS', '会员注销成功', 1, '{"username":"会员账号"}', '', '', '', '', '', '', 'sms'),
(26, '', 'USER_CANCEL_FAIL', '会员注销失败', 1, '{"username":"会员账号"}', '', '', '', '', '', '', 'sms'),
(27, '', 'USER_CANCEL_APPLY', '会员注销申请', 2, '{"username":"会员账号"}', '', '', '', '{"template_id_short":"OPENTM413481457","template_id":"","headtext":"","bottomtext":"","headtextcolor":"","bottomtextcolor":"","content":"申请人：{{keyword1.DATA}}\\n手机号码：{{keyword2.DATA}}"}', '', '', 'sms,wechat');

--
-- Dumping data for table message_sms_records
--
-- Table niushop_b2c_v4_2020_1127_0936.message_sms_records does not contain any data (it is empty)

--
-- Dumping data for table message_send_log
--
-- Table niushop_b2c_v4_2020_1127_0936.message_send_log does not contain any data (it is empty)

--
-- Dumping data for table message_email_records
--
-- Table niushop_b2c_v4_2020_1127_0936.message_email_records does not contain any data (it is empty)

--
-- Dumping data for table message
--
-- Table niushop_b2c_v4_2020_1127_0936.message does not contain any data (it is empty)

--
-- Dumping data for table menu
--
-- Table niushop_b2c_v4_2020_1127_0936.menu does not contain any data (it is empty)

--
-- Dumping data for table member_withdraw
--
-- Table niushop_b2c_v4_2020_1127_0936.member_withdraw does not contain any data (it is empty)

--
-- Dumping data for table member_recharge_order
--
-- Table niushop_b2c_v4_2020_1127_0936.member_recharge_order does not contain any data (it is empty)

--
-- Dumping data for table member_recharge_card
--
-- Table niushop_b2c_v4_2020_1127_0936.member_recharge_card does not contain any data (it is empty)

--
-- Dumping data for table member_recharge
--
-- Table niushop_b2c_v4_2020_1127_0936.member_recharge does not contain any data (it is empty)

--
-- Dumping data for table member_log
--
-- Table niushop_b2c_v4_2020_1127_0936.member_log does not contain any data (it is empty)

--
-- Dumping data for table member_level
--
-- Table niushop_b2c_v4_2020_1127_0936.member_level does not contain any data (it is empty)

--
-- Dumping data for table member_label
--
-- Table niushop_b2c_v4_2020_1127_0936.member_label does not contain any data (it is empty)

--
-- Dumping data for table member_import_record
--
-- Table niushop_b2c_v4_2020_1127_0936.member_import_record does not contain any data (it is empty)

--
-- Dumping data for table member_import_log
--
-- Table niushop_b2c_v4_2020_1127_0936.member_import_log does not contain any data (it is empty)

--
-- Dumping data for table member_cluster
--
-- Table niushop_b2c_v4_2020_1127_0936.member_cluster does not contain any data (it is empty)

--
-- Dumping data for table member_cancel
--
-- Table niushop_b2c_v4_2020_1127_0936.member_cancel does not contain any data (it is empty)

--
-- Dumping data for table member_bank_account
--
-- Table niushop_b2c_v4_2020_1127_0936.member_bank_account does not contain any data (it is empty)

--
-- Dumping data for table member_auth
--
-- Table niushop_b2c_v4_2020_1127_0936.member_auth does not contain any data (it is empty)

--
-- Dumping data for table member_address
--
-- Table niushop_b2c_v4_2020_1127_0936.member_address does not contain any data (it is empty)

--
-- Dumping data for table member_account
--
-- Table niushop_b2c_v4_2020_1127_0936.member_account does not contain any data (it is empty)

--
-- Dumping data for table member
--
-- Table niushop_b2c_v4_2020_1127_0936.member does not contain any data (it is empty)

--
-- Dumping data for table local_delivery_package
--
-- Table niushop_b2c_v4_2020_1127_0936.local_delivery_package does not contain any data (it is empty)

--
-- Dumping data for table local
--
-- Table niushop_b2c_v4_2020_1127_0936.local does not contain any data (it is empty)

--
-- Dumping data for table link
--
-- Table niushop_b2c_v4_2020_1127_0936.link does not contain any data (it is empty)

--
-- Dumping data for table help_class
--
-- Table niushop_b2c_v4_2020_1127_0936.help_class does not contain any data (it is empty)

--
-- Dumping data for table help
--
-- Table niushop_b2c_v4_2020_1127_0936.help does not contain any data (it is empty)

--
-- Dumping data for table `group`
--
-- Table niushop_b2c_v4_2020_1127_0936.`group` does not contain any data (it is empty)

--
-- Dumping data for table goods_virtual
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_virtual does not contain any data (it is empty)

--
-- Dumping data for table goods_sku
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_sku does not contain any data (it is empty)

--
-- Dumping data for table goods_service
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_service does not contain any data (it is empty)

--
-- Dumping data for table goods_label
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_label does not contain any data (it is empty)

--
-- Dumping data for table goods_evaluate
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_evaluate does not contain any data (it is empty)

--
-- Dumping data for table goods_collect
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_collect does not contain any data (it is empty)

--
-- Dumping data for table goods_category
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_category does not contain any data (it is empty)

--
-- Dumping data for table goods_cart
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_cart does not contain any data (it is empty)

--
-- Dumping data for table goods_browse
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_browse does not contain any data (it is empty)

--
-- Dumping data for table goods_attr_class
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_attr_class does not contain any data (it is empty)

--
-- Dumping data for table goods_attribute_value
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_attribute_value does not contain any data (it is empty)

--
-- Dumping data for table goods_attribute
--
-- Table niushop_b2c_v4_2020_1127_0936.goods_attribute does not contain any data (it is empty)

--
-- Dumping data for table goods
--
-- Table niushop_b2c_v4_2020_1127_0936.goods does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_withdraw
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_withdraw does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_order
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_order does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_level
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_level does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_goods_sku
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_goods_sku does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_goods_collect
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_goods_collect does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_goods
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_goods does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_apply
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_apply does not contain any data (it is empty)

--
-- Dumping data for table fenxiao_account
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao_account does not contain any data (it is empty)

--
-- Dumping data for table fenxiao
--
-- Table niushop_b2c_v4_2020_1127_0936.fenxiao does not contain any data (it is empty)

--
-- Dumping data for table express_template_item
--
-- Table niushop_b2c_v4_2020_1127_0936.express_template_item does not contain any data (it is empty)

--
-- Dumping data for table express_template
--
-- Table niushop_b2c_v4_2020_1127_0936.express_template does not contain any data (it is empty)

--
-- Dumping data for table express_electronicsheet
--
-- Table niushop_b2c_v4_2020_1127_0936.express_electronicsheet does not contain any data (it is empty)

--
-- Dumping data for table express_delivery_package
--
-- Table niushop_b2c_v4_2020_1127_0936.express_delivery_package does not contain any data (it is empty)

--
-- Dumping data for table express_company_template
--
-- Table niushop_b2c_v4_2020_1127_0936.express_company_template does not contain any data (it is empty)

--
-- Dumping data for table express_company
--
-- Table niushop_b2c_v4_2020_1127_0936.express_company does not contain any data (it is empty)

--
-- Dumping data for table document
--
-- Table niushop_b2c_v4_2020_1127_0936.document does not contain any data (it is empty)

--
-- Dumping data for table diy_view_util
--
-- Table niushop_b2c_v4_2020_1127_0936.diy_view_util does not contain any data (it is empty)

--
-- Dumping data for table diy_view_temp
--
-- Table niushop_b2c_v4_2020_1127_0936.diy_view_temp does not contain any data (it is empty)

--
-- Dumping data for table div_template
--
INSERT INTO div_template VALUES
(1, '水果生鲜商城', '牛之云网络科技专注模板设计与开发，智能装修，操作简单，助您提升店铺装修视觉体验，提高店铺转化！售后有保障，牛之云网络科技愿竭诚为您服务！', 'fresh_template', 'DIYVIEW_INDEX', '{"global":{"title":"水果生鲜商城","bgColor":"#ffffff","bgUrl":"public/diy_view/style1/img/bg_img.png","moreLink":{},"mpCollect":false,"navStyle":1,"openBottomNav":true,"popWindow":{"imageUrl":"","count":-1,"link":{},"imgWidth":"","imgHeight":""},"textImgPosLink":"center","textImgStyleLink":"1","textNavColor":"#333333","topNavColor":"#ffffff","topNavImg":"","topNavbg":false},"value":[{"style":1,"styleName":"风格一","backgroundColor":"","textColor":"#ffffff","defaultTextColor":"#333333","addon_name":"store","type":"STORE_CHANGE","name":"门店展示","controller":"StoreShow","is_delete":"0"},{"title":"搜索","textColor":"#999999","textAlign":"left","backgroundColor":"","bgColor":"#ffffff","defaultTextColor":"#999999","borderType":2,"searchType":1,"searchImg":"","searchStyle":1,"addon_name":"","type":"SEARCH","name":"商品搜索","controller":"Search","is_delete":"0"},{"selectedTemplate":"carousel-posters","imageClearance":0,"imageRadius":"fillet","carouselChangeStyle":"circle","marginTop":0,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style1/img/adv_01.png","title":"","link":{},"imgWidth":"702","imgHeight":"230"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"textColor":"#666666","defaultTextColor":"#666666","backgroundColor":"","selectedTemplate":"imageNavigation","showType":5,"scrollSetting":"fixed","padding":20,"marginTop":10,"list":[{"imageUrl":"public/diy_view/style1/img/pintuan.png","title":"超值拼团","link":{"id":11539,"addon_name":"pintuan","name":"PINTUAN_PREFECTURE","title":"拼团专区","parent":"PINTUAN","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/pintuan/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"80","imgHeight":"80"},{"imageUrl":"public/diy_view/style1/img/grup_purchase.png","title":"精彩团购","link":{"id":11536,"addon_name":"groupbuy","name":"GROUPBUY_PREFECTURE","title":"团购专区","parent":"GROUPBUY","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/groupbuy/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"80","imgHeight":"80"},{"imageUrl":"public/diy_view/style1/img/seckill.png","title":"限时秒杀","link":{"id":11543,"addon_name":"seckill","name":"SECKILL_PREFECTURE","title":"秒杀专区","parent":"SECKILL","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/seckill/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"80","imgHeight":"80"},{"imageUrl":"public/diy_view/style1/img/integral.png","title":"积分商城","link":{"id":3541,"addon_name":"pointexchange","name":"INTEGRAL_STORE","title":"积分商城","parent":"INTEGRAL","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/point/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"80","imgHeight":"80"},{"imageUrl":"public/diy_view/style1/img/notice.png","title":"公告","link":{"id":11504,"addon_name":"","name":"SHOPPING_NOTICE","title":"公告","parent":"BASICS_LINK","sort":0,"level":4,"web_url":"","wap_url":"/otherpages/notice/list/list","icon":"","support_diy_view":"","selected":false,"parents":"MALL_LINK"},"imgWidth":"80","imgHeight":"80"}],"addon_name":"","type":"GRAPHIC_NAV","navRadius":"fillet","name":"图文导航","controller":"GraphicNav","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":12,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style1/img/adv_05.png","title":"","link":{},"imgWidth":"747","imgHeight":"185"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"selectedTemplate":"row1-of2","backgroundColor":"","list":[{"imageUrl":"public/diy_view/style1/img/adv_02.png","link":{}},{"imageUrl":"public/diy_view/style1/img/adv_03.png","link":{}}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":10,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"height":10,"backgroundColor":"","marginLeftRight":0,"addon_name":"","type":"HORZ_BLANK","name":"辅助空白","controller":"HorzBlank","is_delete":"0"},{"selectedTemplate":"row1-of4","backgroundColor":"","list":[{"imageUrl":"public/diy_view/style1/img/function_03.png","link":{}},{"imageUrl":"public/diy_view/style1/img/function_01.png","link":{}},{"imageUrl":"public/diy_view/style1/img/function_04.png","link":{}},{"imageUrl":"public/diy_view/style1/img/function_02.png","link":{}}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":10,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"sources":"default","categoryId":0,"goodsCount":"6","goodsId":[],"style":1,"styleName":"风格一","changeType":1,"backgroundColor":"","bgSelect":"yellow","marginTop":10,"list":{"imageUrl":"public/diy_view/style1/img/groupbuy_title.png","title":"团购专区"},"listMore":{"imageUrl":"","title":"查看更多"},"titleTextColor":"#000","defaultTitleTextColor":"#000","moreTextColor":"#858585","defaultMoreTextColor":"#858585","addon_name":"groupbuy","type":"GROUPBUY_LIST","name":"团购","controller":"Groupbuy","is_delete":"0"},{"style":1,"backgroundColor":"","marginTop":10,"styleName":"风格一","bgSelect":"red","changeType":1,"paddingLeftRight":0,"isShowGoodsName":1,"isShowGoodsDesc":0,"isShowGoodsPrice":1,"isShowGoodsPrimary":1,"isShowGoodsStock":0,"list":{"imageUrl":"public/diy_view/style1/img/seckill_title.png","title":"秒杀专区"},"listMore":{"imageUrl":"","title":"更多秒杀"},"titleTextColor":"#000","defaultTitleTextColor":"#000","moreTextColor":"#858585","defaultMoreTextColor":"#858585","addon_name":"seckill","type":"SECKILL_LIST","name":"秒杀","controller":"Seckill","is_delete":"0"},{"title":"今日热销","textColor":"#333333","defaultTextColor":"#333333","alignStyle":"center","subTitle":"","marginTop":20,"padding":0,"backgroundColor":"","link":{},"fontSize":16,"fontSizeSub":14,"colorSub":"#999999","defaultColorSub":"#999","style":"1","sub":"0","styleName":"模板一","isShowMore":0,"fontWeight":600,"moreText":"查看更多","moreLink":{},"btnColor":"#999999","defaultBtnColor":"#999","addon_name":"","type":"TEXT","name":"文本","controller":"Text","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":10,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style1/img/adv_04.png","title":"","link":{},"imgWidth":"702","imgHeight":"188"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"sources":"default","categoryId":0,"categoryName":"请选择","goodsCount":"6","goodsId":[],"style":"2","backgroundColor":"","marginTop":10,"paddingLeftRight":0,"isShowCart":0,"cartStyle":1,"isShowGoodName":1,"isShowMarketPrice":1,"isShowGoodSaleNum":1,"isShowGoodSubTitle":0,"goodsTag":"default","tagImg":{"imageUrl":""},"addon_name":"","type":"GOODS_LIST","name":"商品列表","controller":"GoodsList","is_delete":"0"}]}', 'public/diy_view/style1/img/cover.png'),
(2, '时尚简约商城', '牛之云网络科技专注模板设计与开发，智能装修，操作简单，助您提升店铺装修视觉体验，提高店铺转化！售后有保障，牛之云网络科技愿竭诚为您服务！', 'shop_template', 'DIYVIEW_INDEX', '{"global":{"title":"时尚简约商城","bgColor":"#f8f8f8","topNavColor":"#ffffff","topNavbg":false,"textNavColor":"#303133","topNavImg":"","moreLink":{},"openBottomNav":true,"navStyle":1,"textImgStyleLink":"1","textImgPosLink":"center","popWindow":{"imageUrl":"","count":-1,"link":{},"imgWidth":"","imgHeight":""},"bgUrl":"","mpCollect":false},"value":[{"style":"3","styleName":"风格三","backgroundColor":"","textColor":"#303133","defaultTextColor":"#333333","addon_name":"store","type":"STORE_CHANGE","name":"门店展示","controller":"StoreShow","is_delete":"0"},{"selectedTemplate":"carousel-posters","imageClearance":0,"imageRadius":"fillet","carouselChangeStyle":"circle","marginTop":0,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style2/img/posters_1.png","title":"","link":{},"imgWidth":"750","imgHeight":"350"},{"imageUrl":"public/diy_view/style2/img/posters_2.png","title":"","link":{},"imgWidth":"750","imgHeight":"350"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"textColor":"#303133","defaultTextColor":"#666666","backgroundColor":"#ffffff","selectedTemplate":"imageNavigation","showType":5,"scrollSetting":"fixed","padding":20,"marginTop":10,"list":[{"imageUrl":"public/diy_view/style2/img/icon1.png","title":"拼团","link":{"id":11539,"addon_name":"pintuan","name":"PINTUAN_PREFECTURE","title":"拼团专区","parent":"PINTUAN","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/pintuan/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon2.png","title":"团购","link":{"id":11536,"addon_name":"groupbuy","name":"GROUPBUY_PREFECTURE","title":"团购专区","parent":"GROUPBUY","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/groupbuy/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon3.png","title":"秒杀","link":{"id":11543,"addon_name":"seckill","name":"SECKILL_PREFECTURE","title":"秒杀专区","parent":"SECKILL","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/seckill/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon4.png","title":"积分商城","link":{"id":3541,"addon_name":"pointexchange","name":"INTEGRAL_STORE","title":"积分商城","parent":"INTEGRAL","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/point/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon5.png","title":"专题活动","link":{"id":3532,"addon_name":"topic","name":"THEMATIC_ACTIVITIES_LIST","title":"专题活动列表","parent":"THEMATIC_ACTIVITIES","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/topics/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon6.png","title":"砍价","link":{"id":11532,"addon_name":"bargain","name":"BARGAIN_PREFECTURE","title":"砍价专区","parent":"BARGAIN","sort":0,"level":4,"web_url":"","wap_url":"/promotionpages/bargain/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon7.png","title":"直播","link":{"id":11556,"addon_name":"live","name":"LIVE_LIST","title":"直播","parent":"LIVE","sort":0,"level":4,"web_url":"","wap_url":"/otherpages/live/list/list","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon8.png","title":"领券","link":{"id":11545,"addon_name":"coupon","name":"COUPON_PREFECTURE","title":"优惠券专区","parent":"COUPON_LIST","sort":0,"level":4,"web_url":"","wap_url":"/otherpages/goods/coupon/coupon","icon":"","support_diy_view":"","parents":"MARKETING_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon9.png","title":"公告","link":{"id":11504,"addon_name":"","name":"SHOPPING_NOTICE","title":"公告","parent":"BASICS_LINK","sort":0,"level":4,"web_url":"","wap_url":"/otherpages/notice/list/list","icon":"","support_diy_view":"","selected":false,"parents":"MALL_LINK"},"imgWidth":"70","imgHeight":"70"},{"imageUrl":"public/diy_view/style2/img/icon10.png","title":"帮助","link":{"id":11505,"addon_name":"","name":"SHOPPING_HELP","title":"帮助","parent":"BASICS_LINK","sort":0,"level":4,"web_url":"","wap_url":"/otherpages/help/list/list","icon":"","support_diy_view":"","selected":false,"parents":"MALL_LINK"},"imgWidth":"70","imgHeight":"70"}],"addon_name":"","type":"GRAPHIC_NAV","name":"图文导航","navRadius":"fillet","controller":"GraphicNav","is_delete":"0"},{"sources":"default","backgroundColor":"#ffffff","marginTop":10,"style":1,"isEdit":1,"styleName":"风格一","textColor":"#606266","defaultTextColor":"#333333","fontSize":14,"list":[{"title":"单商户V4.0.4更新啦！","link":{}}],"noticeIds":[],"addon_name":"","type":"NOTICE","name":"公告","controller":"Notice","is_delete":"0"},{"marginTop":10,"isShowAnchorInfo":"1","isShowLiveGood":"1","addon_name":"live","type":"WEAPP_LIVE","name":"小程序直播","controller":"LiveInfo","is_delete":"0"},{"height":10,"backgroundColor":"","marginLeftRight":0,"addon_name":"","type":"HORZ_BLANK","name":"辅助空白","controller":"HorzBlank","is_delete":"0"},{"selectedTemplate":"row1-lt-of2-rt","backgroundColor":"","list":[{"imageUrl":"public/diy_view/style2/img/adv1.png","link":{}},{"imageUrl":"public/diy_view/style2/img/adv2.png","link":{}},{"imageUrl":"public/diy_view/style2/img/adv3.png","link":{}}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":10,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"sources":"default","style":1,"couponCount":"6","styleName":"风格一","backgroundColor":"","marginTop":10,"status":1,"couponIds":[],"addon_name":"coupon","type":"COUPON","name":"优惠券","controller":"Coupon","is_delete":"0"},{"style":1,"backgroundColor":"","marginTop":10,"styleName":"风格一","bgSelect":"red","changeType":1,"paddingLeftRight":0,"isShowGoodsName":1,"isShowGoodsDesc":0,"isShowGoodsPrice":1,"isShowGoodsPrimary":1,"isShowGoodsStock":0,"list":{"imageUrl":"public/diy_view/style2/img/title1.png","title":"秒杀专区"},"listMore":{"imageUrl":"","title":"更多秒杀"},"titleTextColor":"#000","defaultTitleTextColor":"#000","moreTextColor":"#858585","defaultMoreTextColor":"#858585","addon_name":"seckill","type":"SECKILL_LIST","name":"秒杀","controller":"Seckill","is_delete":"0"},{"sources":"default","categoryId":0,"goodsCount":"6","goodsId":[],"style":1,"styleName":"风格一","changeType":1,"backgroundColor":"","bgSelect":"blue","marginTop":10,"list":{"imageUrl":"public/diy_view/style2/img/title2.png","title":"爱拼才会赢"},"listMore":{"imageUrl":"","title":"好友都在拼"},"titleTextColor":"#000","defaultTitleTextColor":"#000","moreTextColor":"#858585","defaultMoreTextColor":"#858585","addon_name":"pintuan","type":"PINTUAN_LIST","name":"拼团","controller":"Pintuan","is_delete":"0"},{"sources":"default","categoryId":0,"goodsCount":"6","goodsId":[],"style":1,"styleName":"风格一","changeType":1,"backgroundColor":"","bgSelect":"yellow","marginTop":10,"list":{"imageUrl":"public/diy_view/style2/img/title3.png","title":"一起团才更实惠"},"listMore":{"imageUrl":"","title":"查看更多"},"titleTextColor":"#000","defaultTitleTextColor":"#000","moreTextColor":"#858585","defaultMoreTextColor":"#858585","addon_name":"groupbuy","type":"GROUPBUY_LIST","name":"团购","controller":"Groupbuy","is_delete":"0"},{"sources":"default","categoryId":0,"goodsCount":"6","styleName":"风格一","goodsId":[],"style":1,"changeType":1,"backgroundColor":"","bgSelect":"violet","marginTop":10,"list":{"imageUrl":"public/diy_view/style2/img/title4.png","title":"低价一目了然"},"listMore":{"imageUrl":"","title":"更多"},"titleTextColor":"#000","defaultTitleTextColor":"#000","moreTextColor":"#858585","defaultMoreTextColor":"#858585","addon_name":"bargain","type":"BARGAIN_LIST","name":"砍价","controller":"Bargain","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":25,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style2/img/title.png","title":"","link":{},"imgWidth":"690","imgHeight":"65"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"sources":"default","categoryId":0,"categoryName":"请选择","goodsCount":"6","goodsId":[],"style":"2","backgroundColor":"","marginTop":10,"paddingLeftRight":0,"isShowCart":0,"cartStyle":1,"isShowGoodName":1,"isShowMarketPrice":1,"isShowGoodSaleNum":1,"isShowGoodSubTitle":0,"goodsTag":"default","tagImg":{"imageUrl":""},"addon_name":"","type":"GOODS_LIST","name":"商品列表","controller":"GoodsList","is_delete":"0"}]}', 'public/diy_view/style2/img/cover.png'),
(3, '外卖美食商城', '牛之云网络科技专注模板设计与开发，智能装修，操作简单，助您提升店铺装修视觉体验，提高店铺转化！售后有保障，牛之云网络科技愿竭诚为您服务！', 'toke_template', 'DIYVIEW_INDEX', '{"global":{"title":"外卖美食商城","bgColor":"#f7f7f7","topNavColor":"#ffffff","topNavbg":false,"textNavColor":"#303133","topNavImg":"","moreLink":{},"openBottomNav":true,"navStyle":1,"textImgStyleLink":"1","textImgPosLink":"center","popWindow":{"imageUrl":"","count":-1,"link":{},"imgWidth":"","imgHeight":""},"bgUrl":"public/diy_view/style3/img/bg_img.png","mpCollect":false},"value":[{"style":"2","styleName":"风格二","backgroundColor":"","textColor":"#ffffff","defaultTextColor":"#333333","addon_name":"store","type":"STORE_CHANGE","name":"门店展示","controller":"StoreShow","is_delete":"0"},{"selectedTemplate":"carousel-posters","imageClearance":0,"imageRadius":"fillet","carouselChangeStyle":"circle","marginTop":0,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style3/img/posters_1.png","title":"","link":{},"imgWidth":"702","imgHeight":"337"},{"imageUrl":"public/diy_view/style3/img/posters_2.png","title":"","link":{},"imgWidth":"702","imgHeight":"337"},{"imageUrl":"public/diy_view/style3/img/posters_3.png","title":"","link":{},"imgWidth":"702","imgHeight":"337"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"sources":"default","backgroundColor":"#ffffff","marginTop":10,"style":1,"isEdit":1,"styleName":"风格一","textColor":"#333333","defaultTextColor":"#333333","fontSize":14,"list":[{"title":"多端小程序即将上线","link":{}}],"noticeIds":[],"addon_name":"","type":"NOTICE","name":"公告","controller":"Notice","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":10,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style3/img/adv_01.png","title":"","link":{},"imgWidth":"702","imgHeight":"161"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"height":10,"backgroundColor":"","marginLeftRight":0,"addon_name":"","type":"HORZ_BLANK","name":"辅助空白","controller":"HorzBlank","is_delete":"0"},{"selectedTemplate":"row1-lt-of2-rt","backgroundColor":"","list":[{"imageUrl":"public/diy_view/style3/img/adv_02.png","link":{}},{"imageUrl":"public/diy_view/style3/img/adv_03.png","link":{}},{"imageUrl":"public/diy_view/style3/img/adv_04.png","link":{}}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":15,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"height":7,"backgroundColor":"","marginLeftRight":0,"addon_name":"","type":"HORZ_BLANK","name":"辅助空白","controller":"HorzBlank","is_delete":"0"},{"selectedTemplate":"row1-of3","backgroundColor":"","list":[{"imageUrl":"public/diy_view/style3/img/adv_05.png","link":{}},{"imageUrl":"public/diy_view/style3/img/adv_06.png","link":{}},{"imageUrl":"public/diy_view/style3/img/adv_07.png","link":{}}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":15,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":20,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style3/img/title.png","title":"","link":{},"imgWidth":"750","imgHeight":"62"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"sources":"default","categoryId":0,"categoryName":"请选择","goodsCount":"6","goodsId":[],"style":"2","backgroundColor":"","marginTop":10,"paddingLeftRight":0,"isShowCart":0,"cartStyle":1,"isShowGoodName":1,"isShowMarketPrice":1,"isShowGoodSaleNum":1,"isShowGoodSubTitle":0,"goodsTag":"default","tagImg":{"imageUrl":""},"addon_name":"","type":"GOODS_LIST","name":"商品列表","controller":"GoodsList","is_delete":"0"}]}', 'public/diy_view/style3/img/cover.png'),
(4, '母婴生活馆', '牛之云网络科技专注模板设计与开发，智能装修，操作简单，助您提升店铺装修视觉体验，提高店铺转化！售后有保障，牛之云网络科技愿竭诚为您服务！', 'motherandbaby_template', 'DIYVIEW_INDEX', '{"global":{"title":"母婴生活馆","bgColor":"#ffffff","topNavColor":"#ffffff","topNavbg":false,"textNavColor":"#333333","topNavImg":"","moreLink":{},"openBottomNav":true,"navStyle":1,"textImgStyleLink":"1","textImgPosLink":"center","popWindow":{"imageUrl":"public/diy_view/style4/img/adv_supernatant.png","count":1,"link":{},"imgWidth":"362","imgHeight":"502"},"bgUrl":"public/diy_view/style4/img/bg_img.png","mpCollect":false},"value":[{"style":"2","styleName":"风格二","backgroundColor":"","textColor":"#ffffff","defaultTextColor":"#333333","addon_name":"store","type":"STORE_CHANGE","name":"门店展示","controller":"StoreShow","is_delete":"0"},{"title":"搜索","textColor":"#999999","textAlign":"left","backgroundColor":"","bgColor":"#ffffff","defaultTextColor":"#999999","borderType":2,"searchType":1,"searchImg":"","searchStyle":1,"addon_name":"","type":"SEARCH","name":"商品搜索","controller":"Search","is_delete":"0"},{"selectedTemplate":"carousel-posters","imageClearance":0,"imageRadius":"fillet","carouselChangeStyle":"circle","marginTop":0,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style4/img/banner1.png","title":"","link":{},"imgWidth":"702","imgHeight":"348"},{"imageUrl":"public/diy_view/style4/img/banner2.png","title":"","link":{},"imgWidth":"702","imgHeight":"349"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"textColor":"#666666","defaultTextColor":"#666666","backgroundColor":"","selectedTemplate":"imageNavigation","showType":5,"scrollSetting":"fixed","padding":20,"marginTop":5,"list":[{"imageUrl":"public/diy_view/style4/img/icon1.png","title":"爆款特卖","link":{"id":3541,"addon_name":"pointexchange","name":"","title":"","parent":"INTEGRAL","sort":0,"level":4,"web_url":"","wap_url":"","icon":"","support_diy_view":"","parents":""},"imgWidth":"127","imgHeight":"127"},{"imageUrl":"public/diy_view/style4/img/icon2.png","title":"积分商城","link":{"id":11539,"addon_name":"pintuan","name":"","title":"","parent":"PINTUAN","sort":0,"level":4,"web_url":"","wap_url":"","icon":"","support_diy_view":"","parents":""},"imgWidth":"127","imgHeight":"127"},{"imageUrl":"public/diy_view/style4/img/icon3.png","title":"儿童玩具","link":{"id":11536,"addon_name":"groupbuy","name":"","title":"","parent":"GROUPBUY","sort":0,"level":4,"web_url":"","wap_url":"","icon":"","support_diy_view":"","parents":""},"imgWidth":"127","imgHeight":"127"},{"imageUrl":"public/diy_view/style4/img/icon4.png","title":"签到积分","link":{"id":3532,"addon_name":"topic","name":"","title":"","parent":"THEMATIC_ACTIVITIES","sort":0,"level":4,"web_url":"","wap_url":"","icon":"","support_diy_view":"","parents":""},"imgWidth":"127","imgHeight":"127"},{"imageUrl":"public/diy_view/style4/img/icon5.png","title":"商品分类","link":{"id":11532,"addon_name":"bargain","name":"","title":"","parent":"BARGAIN","sort":0,"level":4,"web_url":"","wap_url":"","icon":"","support_diy_view":"","parents":""},"imgWidth":"127","imgHeight":"127"}],"addon_name":"","type":"GRAPHIC_NAV","name":"图文导航","navRadius":"fillet","controller":"GraphicNav","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":5,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style4/img/adv.png","title":"","link":{},"imgWidth":"732","imgHeight":"166"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"height":10,"backgroundColor":"","marginLeftRight":0,"addon_name":"","type":"HORZ_BLANK","name":"辅助空白","controller":"HorzBlank","is_delete":"0"},{"selectedTemplate":"row1-lt-of2-rt","backgroundColor":"","list":[{"imageUrl":"public/diy_view/style4/img/adv1.png","link":{}},{"imageUrl":"public/diy_view/style4/img/adv2.png","link":{}},{"imageUrl":"public/diy_view/style4/img/adv3.png","link":{}}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":10,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":30,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style4/img/title.png","title":"","link":{},"imgWidth":"750","imgHeight":"82"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"sources":"default","categoryId":0,"categoryName":"请选择","goodsCount":"6","goodsId":[],"style":"2","backgroundColor":"","marginTop":0,"paddingLeftRight":0,"isShowCart":0,"cartStyle":1,"isShowGoodName":1,"isShowMarketPrice":1,"isShowGoodSaleNum":1,"isShowGoodSubTitle":0,"goodsTag":"default","tagImg":{"imageUrl":""},"addon_name":"","type":"GOODS_LIST","name":"商品列表","controller":"GoodsList","is_delete":"0"}]}', 'public/diy_view/style4/img/cover.png'),
(5, '精品家居商城', '牛之云网络科技专注模板设计与开发，智能装修，操作简单，助您提升店铺装修视觉体验，提高店铺转化！售后有保障，牛之云网络科技愿竭诚为您服务！', 'furniture_template', 'DIYVIEW_INDEX', '{"global":{"title":"精品家居商城","bgColor":"#ffffff","topNavColor":"#ffffff","topNavbg":false,"textNavColor":"#333333","topNavImg":"","moreLink":{},"openBottomNav":true,"navStyle":1,"textImgStyleLink":"1","textImgPosLink":"center","popWindow":{"imageUrl":"public/diy_view/style5/img/adv_supernatant.png","count":1,"link":{},"imgWidth":"362","imgHeight":"502"},"bgUrl":"public/diy_view/style5/img/bg_img.png","mpCollect":false},"value":[{"style":1,"styleName":"风格一","backgroundColor":"","textColor":"#333333","defaultTextColor":"#333333","addon_name":"store","type":"STORE_CHANGE","name":"门店展示","controller":"StoreShow","is_delete":"0"},{"selectedTemplate":"carousel-posters","imageClearance":0,"imageRadius":"fillet","carouselChangeStyle":"circle","marginTop":0,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style5/img/banner1.png","title":"","link":{},"imgWidth":"702","imgHeight":"348"},{"imageUrl":"public/diy_view/style5/img/banner2.png","title":"","link":{},"imgWidth":"702","imgHeight":"348"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"textColor":"#666666","defaultTextColor":"#666666","backgroundColor":"","selectedTemplate":"imageNavigation","showType":5,"scrollSetting":"fixed","padding":20,"marginTop":10,"list":[{"imageUrl":"public/diy_view/style5/img/icon1.png","title":"沙发","link":{},"imgWidth":"100","imgHeight":"100"},{"imageUrl":"public/diy_view/style5/img/icon2.png","title":"床品","link":{},"imgWidth":"100","imgHeight":"100"},{"imageUrl":"public/diy_view/style5/img/icon3.png","title":"柜子","link":{},"imgWidth":"100","imgHeight":"100"},{"imageUrl":"public/diy_view/style5/img/icon4.png","title":"灯具","link":{},"imgWidth":"100","imgHeight":"100"},{"imageUrl":"public/diy_view/style5/img/icon5.png","title":"更多","link":{},"imgWidth":"100","imgHeight":"100"}],"addon_name":"","type":"GRAPHIC_NAV","name":"图文导航","navRadius":"fillet","controller":"GraphicNav","is_delete":"0"},{"height":10,"backgroundColor":"","marginLeftRight":0,"addon_name":"","type":"HORZ_BLANK","name":"辅助空白","controller":"HorzBlank","is_delete":"0"},{"selectedTemplate":"row1-of3","backgroundColor":"","list":[{"imageUrl":"public/diy_view/style5/img/adv1.png","link":{}},{"imageUrl":"public/diy_view/style5/img/adv2.png","link":{}},{"imageUrl":"public/diy_view/style5/img/adv3.png","link":{}}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":15,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":15,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style5/img/adv.png","title":"","link":{},"imgWidth":"702","imgHeight":"306"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":30,"padding":0,"height":0,"list":[{"imageUrl":"public/diy_view/style5/img/title.png","title":"","link":{},"imgWidth":"750","imgHeight":"82"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"sources":"default","categoryId":0,"categoryName":"请选择","goodsCount":"6","goodsId":[],"style":1,"backgroundColor":"","marginTop":0,"paddingLeftRight":0,"isShowCart":0,"cartStyle":1,"isShowGoodName":1,"isShowMarketPrice":1,"isShowGoodSaleNum":1,"isShowGoodSubTitle":0,"goodsTag":"default","tagImg":{"imageUrl":""},"addon_name":"","type":"GOODS_LIST","name":"商品列表","controller":"GoodsList","is_delete":"0"}]}', 'public/diy_view/style5/img/cover.png');

--
-- Dumping data for table cron_log
--
-- Table niushop_b2c_v4_2020_1127_0936.cron_log does not contain any data (it is empty)

--
-- Dumping data for table cron
--
-- Table niushop_b2c_v4_2020_1127_0936.cron does not contain any data (it is empty)

--
-- Dumping data for table config
--
-- Table niushop_b2c_v4_2020_1127_0936.config does not contain any data (it is empty)

--
-- Dumping data for table area
--
INSERT INTO area VALUES
(110000, 0, '北京市', '北京', '116.40529', '39.904987', 1, 1, 1),
(110100, 110000, '北京市', '北京', '116.40529', '39.904987', 2, 1, 1),
(110101, 110100, '东城区', '东城', '116.418755', '39.917545', 3, 3, 1),
(110102, 110100, '西城区', '西城', '116.36679', '39.91531', 3, 15, 1),
(110105, 110100, '朝阳区', '朝阳', '116.48641', '39.92149', 3, 2, 1),
(110106, 110100, '丰台区', '丰台', '116.286964', '39.863644', 3, 6, 1),
(110107, 110100, '石景山区', '石景山', '116.19544', '39.9146', 3, 12, 1),
(110108, 110100, '海淀区', '海淀', '116.31032', '39.956074', 3, 7, 1),
(110109, 110100, '门头沟区', '门头沟', '116.10538', '39.937183', 3, 9, 1),
(110111, 110100, '房山区', '房山', '116.13916', '39.735535', 3, 5, 1),
(110112, 110100, '通州区', '通州', '116.6586', '39.902485', 3, 14, 1),
(110113, 110100, '顺义区', '顺义', '116.65353', '40.128937', 3, 13, 1),
(110114, 110100, '昌平区', '昌平', '116.23591', '40.218086', 3, 1, 1),
(110115, 110100, '大兴区', '大兴', '116.338036', '39.72891', 3, 4, 1),
(110116, 110100, '怀柔区', '怀柔', '116.63712', '40.324272', 3, 8, 1),
(110117, 110100, '平谷区', '平谷', '117.112335', '40.144783', 3, 11, 1),
(110228, 110100, '密云县', '密云', '116.84335', '40.37736', 3, 10, 1),
(110229, 110100, '延庆县', '延庆', '115.98501', '40.465324', 3, 16, 1),
(120000, 0, '天津市', '天津', '117.190186', '39.125595', 1, 2, 1),
(120100, 120000, '天津市', '天津', '117.190186', '39.125595', 2, 1, 1),
(120101, 120100, '和平区', '和平', '117.19591', '39.11833', 3, 7, 1),
(120102, 120100, '河东区', '河东', '117.22657', '39.122124', 3, 6, 1),
(120103, 120100, '河西区', '河西', '117.21754', '39.1019', 3, 8, 1),
(120104, 120100, '南开区', '南开', '117.16415', '39.120476', 3, 13, 1),
(120105, 120100, '河北区', '河北', '117.20157', '39.15663', 3, 5, 1),
(120106, 120100, '红桥区', '红桥', '117.1633', '39.175068', 3, 9, 1),
(120110, 120100, '东丽区', '东丽', '117.313965', '39.087765', 3, 4, 1),
(120111, 120100, '西青区', '西青', '117.012245', '39.139446', 3, 16, 1),
(120112, 120100, '津南区', '津南', '117.382545', '38.98958', 3, 11, 1),
(120113, 120100, '北辰区', '北辰', '117.13482', '39.225555', 3, 2, 1),
(120114, 120100, '武清区', '武清', '117.05796', '39.376926', 3, 15, 1),
(120115, 120100, '宝坻区', '宝坻', '117.30809', '39.716965', 3, 1, 1),
(120116, 120100, '滨海新区', '滨海', '117.654175', '39.032845', 3, 3, 1),
(120221, 120100, '宁河县', '宁河', '117.82828', '39.328884', 3, 14, 1),
(120223, 120100, '静海县', '静海', '116.9253', '38.935673', 3, 10, 1),
(120225, 120100, '蓟县', '蓟县', '117.40745', '40.04534', 3, 12, 1),
(130000, 0, '河北省', '河北', '114.502464', '38.045475', 1, 3, 1),
(130100, 130000, '石家庄市', '石家庄', '114.502464', '38.045475', 2, 8, 1),
(130102, 130100, '长安区', '长安', '114.54815', '38.0475', 3, 1, 1),
(130103, 130100, '桥东区', '桥东', '114.50289', '38.040154', 3, 11, 1),
(130104, 130100, '桥西区', '桥西', '114.46293', '38.02838', 3, 12, 1),
(130105, 130100, '新华区', '新华', '114.46597', '38.067142', 3, 16, 1),
(130107, 130100, '井陉矿区', '井陉矿', '114.05818', '38.069748', 3, 4, 1),
(130108, 130100, '裕华区', '裕华', '114.53326', '38.027695', 3, 20, 1),
(130121, 130100, '井陉县', '井陉', '114.144485', '38.033615', 3, 5, 1),
(130123, 130100, '正定县', '正定', '114.569885', '38.147835', 3, 23, 1),
(130124, 130100, '栾城县', '栾城', '114.65428', '37.88691', 3, 8, 1),
(130125, 130100, '行唐县', '行唐', '114.552734', '38.437424', 3, 15, 1),
(130126, 130100, '灵寿县', '灵寿', '114.37946', '38.306545', 3, 7, 1),
(130127, 130100, '高邑县', '高邑', '114.6107', '37.605713', 3, 3, 1),
(130128, 130100, '深泽县', '深泽', '115.20021', '38.18454', 3, 13, 1),
(130129, 130100, '赞皇县', '赞皇', '114.38776', '37.6602', 3, 21, 1),
(130130, 130100, '无极县', '无极', '114.977844', '38.176376', 3, 14, 1),
(130131, 130100, '平山县', '平山', '114.18414', '38.25931', 3, 10, 1),
(130132, 130100, '元氏县', '元氏', '114.52618', '37.762512', 3, 19, 1),
(130133, 130100, '赵县', '赵县', '114.77536', '37.75434', 3, 22, 1),
(130181, 130100, '辛集市', '辛集', '115.21745', '37.92904', 3, 17, 1),
(130182, 130100, '藁城市', '藁城', '114.84965', '38.033768', 3, 2, 1),
(130183, 130100, '晋州市', '晋州', '115.04488', '38.027477', 3, 6, 1),
(130184, 130100, '新乐市', '新乐', '114.68578', '38.34477', 3, 18, 1),
(130185, 130100, '鹿泉市', '鹿泉', '114.32102', '38.093994', 3, 9, 1),
(130200, 130000, '唐山市', '唐山', '118.17539', '39.635113', 2, 9, 1),
(130202, 130200, '路南区', '路南', '118.21082', '39.61516', 3, 10, 1),
(130203, 130200, '路北区', '路北', '118.174736', '39.628536', 3, 9, 1),
(130204, 130200, '古冶区', '古冶', '118.45429', '39.715736', 3, 4, 1),
(130205, 130200, '开平区', '开平', '118.26443', '39.67617', 3, 5, 1),
(130207, 130200, '丰南区', '丰南', '118.110794', '39.56303', 3, 2, 1),
(130208, 130200, '丰润区', '丰润', '118.15578', '39.831364', 3, 3, 1),
(130223, 130200, '滦县', '滦县', '118.69955', '39.74485', 3, 8, 1),
(130224, 130200, '滦南县', '滦南', '118.68155', '39.506203', 3, 7, 1),
(130225, 130200, '乐亭县', '乐亭', '118.90534', '39.42813', 3, 6, 1),
(130227, 130200, '迁西县', '迁西', '118.30514', '40.146236', 3, 12, 1),
(130229, 130200, '玉田县', '玉田', '117.75366', '39.88732', 3, 13, 1),
(130230, 130200, '曹妃甸区', '曹妃甸', '118.44659', '39.27828', 3, 1, 1),
(130281, 130200, '遵化市', '遵化', '117.96587', '40.188618', 3, 14, 1),
(130283, 130200, '迁安市', '迁安', '118.701935', '40.012108', 3, 11, 1),
(130300, 130000, '秦皇岛市', '秦皇岛', '119.58658', '39.94253', 2, 7, 1),
(130302, 130300, '海港区', '海港', '119.59622', '39.94346', 3, 4, 1),
(130303, 130300, '山海关区', '山海关', '119.75359', '39.998024', 3, 7, 1),
(130304, 130300, '北戴河区', '北戴河', '119.48628', '39.825123', 3, 1, 1),
(130321, 130300, '青龙满族自治县', '青龙', '118.95455', '40.40602', 3, 6, 1),
(130322, 130300, '昌黎县', '昌黎', '119.16454', '39.70973', 3, 2, 1),
(130323, 130300, '抚宁县', '抚宁', '119.240654', '39.887054', 3, 3, 1),
(130324, 130300, '卢龙县', '卢龙', '118.881805', '39.89164', 3, 5, 1),
(130400, 130000, '邯郸市', '邯郸', '114.490685', '36.612274', 2, 4, 1),
(130402, 130400, '邯山区', '邯山', '114.484985', '36.603195', 3, 11, 1),
(130403, 130400, '丛台区', '丛台', '114.494705', '36.61108', 3, 3, 1),
(130404, 130400, '复兴区', '复兴', '114.458244', '36.615482', 3, 7, 1),
(130406, 130400, '峰峰矿区', '峰峰矿', '114.20994', '36.420486', 3, 6, 1),
(130421, 130400, '邯郸县', '邯郸', '114.53108', '36.593906', 3, 10, 1),
(130423, 130400, '临漳县', '临漳', '114.6107', '36.337605', 3, 13, 1),
(130424, 130400, '成安县', '成安', '114.68036', '36.443832', 3, 1, 1),
(130425, 130400, '大名县', '大名', '115.15259', '36.283318', 3, 4, 1),
(130426, 130400, '涉县', '涉县', '113.673294', '36.563145', 3, 16, 1),
(130427, 130400, '磁县', '磁县', '114.38208', '36.367672', 3, 2, 1),
(130428, 130400, '肥乡县', '肥乡', '114.80515', '36.55578', 3, 5, 1),
(130429, 130400, '永年县', '永年', '114.49616', '36.776413', 3, 19, 1),
(130430, 130400, '邱县', '邱县', '115.16859', '36.81325', 3, 14, 1),
(130431, 130400, '鸡泽县', '鸡泽', '114.87852', '36.91491', 3, 12, 1),
(130432, 130400, '广平县', '广平', '114.95086', '36.483604', 3, 8, 1),
(130433, 130400, '馆陶县', '馆陶', '115.289055', '36.53946', 3, 9, 1),
(130434, 130400, '魏县', '魏县', '114.93411', '36.354248', 3, 17, 1),
(130435, 130400, '曲周县', '曲周', '114.95759', '36.7734', 3, 15, 1),
(130481, 130400, '武安市', '武安', '114.19458', '36.696114', 3, 18, 1),
(130500, 130000, '邢台市', '邢台', '114.50885', '37.0682', 2, 10, 1),
(130502, 130500, '桥东区', '桥东', '114.50713', '37.064125', 3, 12, 1),
(130503, 130500, '桥西区', '桥西', '114.47369', '37.06801', 3, 13, 1),
(130521, 130500, '邢台县', '邢台', '114.561134', '37.05073', 3, 18, 1),
(130522, 130500, '临城县', '临城', '114.506874', '37.444008', 3, 4, 1),
(130523, 130500, '内丘县', '内丘', '114.51152', '37.287663', 3, 9, 1),
(130524, 130500, '柏乡县', '柏乡', '114.69338', '37.483597', 3, 1, 1),
(130525, 130500, '隆尧县', '隆尧', '114.776344', '37.350925', 3, 6, 1),
(130526, 130500, '任县', '任县', '114.68447', '37.12995', 3, 15, 1),
(130527, 130500, '南和县', '南和', '114.691376', '37.00381', 3, 8, 1),
(130528, 130500, '宁晋县', '宁晋', '114.92103', '37.618958', 3, 10, 1),
(130529, 130500, '巨鹿县', '巨鹿', '115.03878', '37.21768', 3, 3, 1),
(130530, 130500, '新河县', '新河', '115.247536', '37.526215', 3, 19, 1),
(130531, 130500, '广宗县', '广宗', '115.1428', '37.075546', 3, 2, 1),
(130532, 130500, '平乡县', '平乡', '115.02922', '37.069405', 3, 11, 1),
(130533, 130500, '威县', '威县', '115.27275', '36.983273', 3, 17, 1),
(130534, 130500, '清河县', '清河', '115.669', '37.05999', 3, 14, 1),
(130535, 130500, '临西县', '临西', '115.49869', '36.8642', 3, 5, 1),
(130581, 130500, '南宫市', '南宫', '115.3981', '37.35967', 3, 7, 1),
(130582, 130500, '沙河市', '沙河', '114.504906', '36.861904', 3, 16, 1),
(130600, 130000, '保定市', '保定', '115.48233', '38.867657', 2, 1, 1),
(130602, 130600, '新市区', '新市', '115.47066', '38.88662', 3, 21, 1),
(130603, 130600, '北市区', '北市', '115.50093', '38.865005', 3, 3, 1),
(130604, 130600, '南市区', '南市', '115.49867', '38.8567', 3, 14, 1),
(130621, 130600, '满城县', '满城', '115.32442', '38.95138', 3, 13, 1),
(130622, 130600, '清苑县', '清苑', '115.49222', '38.77101', 3, 15, 1),
(130623, 130600, '涞水县', '涞水', '115.71198', '39.393147', 3, 10, 1),
(130624, 130600, '阜平县', '阜平', '114.1988', '38.847275', 3, 7, 1),
(130625, 130600, '徐水县', '徐水', '115.64941', '39.020393', 3, 23, 1),
(130626, 130600, '定兴县', '定兴', '115.7969', '39.266193', 3, 5, 1),
(130627, 130600, '唐县', '唐县', '114.98124', '38.748543', 3, 19, 1),
(130628, 130600, '高阳县', '高阳', '115.77888', '38.69009', 3, 9, 1),
(130629, 130600, '容城县', '容城', '115.86625', '39.05282', 3, 17, 1),
(130630, 130600, '涞源县', '涞源', '114.692566', '39.35755', 3, 11, 1),
(130631, 130600, '望都县', '望都', '115.15401', '38.707447', 3, 20, 1),
(130632, 130600, '安新县', '安新', '115.93198', '38.929913', 3, 2, 1),
(130633, 130600, '易县', '易县', '115.501144', '39.35297', 3, 24, 1),
(130634, 130600, '曲阳县', '曲阳', '114.704056', '38.61999', 3, 16, 1),
(130635, 130600, '蠡县', '蠡县', '115.58363', '38.49643', 3, 12, 1),
(130636, 130600, '顺平县', '顺平', '115.13275', '38.845127', 3, 18, 1),
(130637, 130600, '博野县', '博野', '115.4618', '38.45827', 3, 4, 1),
(130638, 130600, '雄县', '雄县', '116.107475', '38.990818', 3, 22, 1),
(130681, 130600, '涿州市', '涿州', '115.97341', '39.485764', 3, 25, 1),
(130682, 130600, '定州市', '定州', '114.99139', '38.5176', 3, 6, 1),
(130683, 130600, '安国市', '安国', '115.33141', '38.421368', 3, 1, 1),
(130684, 130600, '高碑店市', '高碑店', '115.882706', '39.32769', 3, 8, 1),
(130700, 130000, '张家口市', '张家口', '114.884094', '40.8119', 2, 11, 1),
(130702, 130700, '桥东区', '桥东', '114.88566', '40.813873', 3, 7, 1),
(130703, 130700, '桥西区', '桥西', '114.882126', '40.824387', 3, 8, 1),
(130705, 130700, '宣化区', '宣化区', '115.0632', '40.609367', 3, 12, 1),
(130706, 130700, '下花园区', '下花园', '115.281', '40.488644', 3, 11, 1),
(130721, 130700, '宣化县', '宣化县', '115.03308', '40.56221', 3, 13, 1),
(130722, 130700, '张北县', '张北', '114.71595', '41.151714', 3, 16, 1),
(130723, 130700, '康保县', '康保', '114.61581', '41.850044', 3, 6, 1),
(130724, 130700, '沽源县', '沽源', '115.68484', '41.66742', 3, 3, 1),
(130725, 130700, '尚义县', '尚义', '113.977715', '41.08009', 3, 9, 1),
(130726, 130700, '蔚县', '蔚县', '114.582695', '39.83718', 3, 15, 1),
(130727, 130700, '阳原县', '阳原', '114.16734', '40.11342', 3, 14, 1),
(130728, 130700, '怀安县', '怀安', '114.42236', '40.671272', 3, 4, 1),
(130729, 130700, '万全县', '万全', '114.73613', '40.765137', 3, 10, 1),
(130730, 130700, '怀来县', '怀来', '115.52084', '40.405403', 3, 5, 1),
(130731, 130700, '涿鹿县', '涿鹿', '115.219246', '40.3787', 3, 17, 1),
(130732, 130700, '赤城县', '赤城', '115.83271', '40.912083', 3, 1, 1),
(130733, 130700, '崇礼县', '崇礼', '115.281654', '40.971302', 3, 2, 1),
(130800, 130000, '承德市', '承德', '117.939156', '40.976204', 2, 3, 1),
(130802, 130800, '双桥区', '双桥', '117.939156', '40.976204', 3, 8, 1),
(130803, 130800, '双滦区', '双滦', '117.797485', '40.959755', 3, 7, 1),
(130804, 130800, '鹰手营子矿区', '鹰手营子矿', '117.661156', '40.546955', 3, 11, 1),
(130821, 130800, '承德县', '承德', '118.17249', '40.76864', 3, 1, 1),
(130822, 130800, '兴隆县', '兴隆', '117.507095', '40.418526', 3, 10, 1),
(130823, 130800, '平泉县', '平泉', '118.69024', '41.00561', 3, 6, 1),
(130824, 130800, '滦平县', '滦平', '117.33713', '40.936646', 3, 5, 1),
(130825, 130800, '隆化县', '隆化', '117.73634', '41.316666', 3, 4, 1),
(130826, 130800, '丰宁满族自治县', '丰宁', '116.65121', '41.209904', 3, 2, 1),
(130827, 130800, '宽城满族自治县', '宽城', '118.48864', '40.607983', 3, 3, 1),
(130828, 130800, '围场满族蒙古族自治县', '围场', '117.764084', '41.949406', 3, 9, 1),
(130900, 130000, '沧州市', '沧州', '116.85746', '38.31058', 2, 2, 1),
(130902, 130900, '新华区', '新华', '116.87305', '38.308273', 3, 14, 1),
(130903, 130900, '运河区', '运河', '116.840065', '38.307404', 3, 16, 1),
(130921, 130900, '沧县', '沧县', '117.00748', '38.219856', 3, 2, 1),
(130922, 130900, '青县', '青县', '116.83839', '38.569645', 3, 9, 1),
(130923, 130900, '东光县', '东光', '116.54206', '37.88655', 3, 3, 1),
(130924, 130900, '海兴县', '海兴', '117.496605', '38.141582', 3, 4, 1),
(130925, 130900, '盐山县', '盐山', '117.22981', '38.05614', 3, 15, 1),
(130926, 130900, '肃宁县', '肃宁', '115.83585', '38.4271', 3, 11, 1),
(130927, 130900, '南皮县', '南皮', '116.70917', '38.04244', 3, 8, 1),
(130928, 130900, '吴桥县', '吴桥', '116.39151', '37.62818', 3, 12, 1),
(130929, 130900, '献县', '献县', '116.12384', '38.18966', 3, 13, 1),
(130930, 130900, '孟村回族自治县', '孟村', '117.1051', '38.057953', 3, 7, 1),
(130981, 130900, '泊头市', '泊头', '116.57016', '38.07348', 3, 1, 1),
(130982, 130900, '任丘市', '任丘', '116.106766', '38.706512', 3, 10, 1),
(130983, 130900, '黄骅市', '黄骅', '117.3438', '38.36924', 3, 6, 1),
(130984, 130900, '河间市', '河间', '116.089455', '38.44149', 3, 5, 1),
(131000, 130000, '廊坊市', '廊坊', '116.70444', '39.523926', 2, 6, 1),
(131002, 131000, '安次区', '安次', '116.69454', '39.502567', 3, 1, 1),
(131003, 131000, '广阳区', '广阳', '116.71371', '39.52193', 3, 5, 1),
(131022, 131000, '固安县', '固安', '116.2999', '39.436466', 3, 6, 1),
(131023, 131000, '永清县', '永清', '116.49809', '39.319717', 3, 10, 1),
(131024, 131000, '香河县', '香河', '117.007164', '39.757214', 3, 9, 1),
(131025, 131000, '大城县', '大城', '116.64073', '38.699215', 3, 4, 1),
(131026, 131000, '文安县', '文安', '116.460106', '38.866802', 3, 8, 1),
(131028, 131000, '大厂回族自治县', '大厂', '116.9865', '39.889267', 3, 3, 1),
(131081, 131000, '霸州市', '霸州', '116.39202', '39.117332', 3, 2, 1),
(131082, 131000, '三河市', '三河', '117.07702', '39.982777', 3, 7, 1),
(131100, 130000, '衡水市', '衡水', '115.66599', '37.735096', 2, 5, 1),
(131102, 131100, '桃城区', '桃城', '115.69495', '37.73224', 3, 8, 1),
(131121, 131100, '枣强县', '枣强', '115.7265', '37.511513', 3, 11, 1),
(131122, 131100, '武邑县', '武邑', '115.89242', '37.803776', 3, 10, 1),
(131123, 131100, '武强县', '武强', '115.97024', '38.03698', 3, 9, 1),
(131124, 131100, '饶阳县', '饶阳', '115.72658', '38.23267', 3, 6, 1),
(131125, 131100, '安平县', '安平', '115.51963', '38.233513', 3, 1, 1),
(131126, 131100, '故城县', '故城', '115.96674', '37.350983', 3, 3, 1),
(131127, 131100, '景县', '景县', '116.258446', '37.686623', 3, 4, 1),
(131128, 131100, '阜城县', '阜城', '116.16473', '37.869946', 3, 2, 1),
(131181, 131100, '冀州市', '冀州', '115.57917', '37.54279', 3, 5, 1),
(131182, 131100, '深州市', '深州', '115.554596', '38.00347', 3, 7, 1),
(140000, 0, '山西省', '山西', '112.54925', '37.857014', 1, 4, 1),
(140100, 140000, '太原市', '太原', '112.54925', '37.857014', 2, 8, 1),
(140105, 140100, '小店区', '小店', '112.56427', '37.817974', 3, 7, 1),
(140106, 140100, '迎泽区', '迎泽', '112.55885', '37.855804', 3, 10, 1),
(140107, 140100, '杏花岭区', '杏花岭', '112.560745', '37.87929', 3, 8, 1),
(140108, 140100, '尖草坪区', '尖草坪', '112.48712', '37.93989', 3, 2, 1),
(140109, 140100, '万柏林区', '万柏林', '112.522255', '37.86265', 3, 6, 1),
(140110, 140100, '晋源区', '晋源', '112.47785', '37.71562', 3, 3, 1),
(140121, 140100, '清徐县', '清徐', '112.35796', '37.60729', 3, 5, 1),
(140122, 140100, '阳曲县', '阳曲', '112.67382', '38.058796', 3, 9, 1),
(140123, 140100, '娄烦县', '娄烦', '111.7938', '38.066036', 3, 4, 1),
(140181, 140100, '古交市', '古交', '112.174355', '37.908535', 3, 1, 1),
(140200, 140000, '大同市', '大同', '113.29526', '40.09031', 2, 2, 1),
(140202, 140200, '城区', '城区', '113.30144', '40.09051', 3, 1, 1),
(140203, 140200, '矿区', '矿区', '113.168655', '40.03626', 3, 5, 1),
(140211, 140200, '南郊区', '南郊', '113.16892', '40.01802', 3, 7, 1),
(140212, 140200, '新荣区', '新荣', '113.141045', '40.25827', 3, 9, 1),
(140221, 140200, '阳高县', '阳高', '113.74987', '40.364925', 3, 10, 1),
(140222, 140200, '天镇县', '天镇', '114.09112', '40.421337', 3, 8, 1),
(140223, 140200, '广灵县', '广灵', '114.27925', '39.76305', 3, 3, 1),
(140224, 140200, '灵丘县', '灵丘', '114.23576', '39.438866', 3, 6, 1),
(140225, 140200, '浑源县', '浑源', '113.69809', '39.6991', 3, 4, 1),
(140226, 140200, '左云县', '左云', '112.70641', '40.012875', 3, 11, 1),
(140227, 140200, '大同县', '大同', '113.611305', '40.039345', 3, 2, 1),
(140300, 140000, '阳泉市', '阳泉', '113.58328', '37.861187', 2, 10, 1),
(140302, 140300, '城区', '城区', '113.58651', '37.86094', 3, 1, 1),
(140303, 140300, '矿区', '矿区', '113.55907', '37.870087', 3, 3, 1),
(140311, 140300, '郊区', '郊区', '113.58328', '37.861187', 3, 2, 1),
(140321, 140300, '平定县', '平定', '113.63105', '37.80029', 3, 4, 1),
(140322, 140300, '盂县', '盂县', '113.41223', '38.086132', 3, 5, 1),
(140400, 140000, '长治市', '长治', '113.113556', '36.191113', 2, 1, 1),
(140421, 140400, '长治县', '长治', '113.05668', '36.052437', 3, 1, 1),
(140423, 140400, '襄垣县', '襄垣', '113.050095', '36.532852', 3, 12, 1),
(140424, 140400, '屯留县', '屯留', '112.89274', '36.31407', 3, 10, 1),
(140425, 140400, '平顺县', '平顺', '113.43879', '36.200203', 3, 7, 1),
(140426, 140400, '黎城县', '黎城', '113.38737', '36.50297', 3, 5, 1),
(140427, 140400, '壶关县', '壶关', '113.20614', '36.11094', 3, 3, 1),
(140428, 140400, '长子县', '长子', '112.88466', '36.119484', 3, 13, 1),
(140429, 140400, '武乡县', '武乡', '112.8653', '36.834316', 3, 11, 1),
(140430, 140400, '沁县', '沁县', '112.70138', '36.757122', 3, 8, 1),
(140431, 140400, '沁源县', '沁源', '112.34088', '36.50078', 3, 9, 1),
(140481, 140400, '潞城市', '潞城', '113.22324', '36.332233', 3, 6, 1),
(140482, 140400, '城区', '城区', '113.114105', '36.187897', 3, 2, 1),
(140483, 140400, '郊区', '郊区', '113.10121', '36.218388', 3, 4, 1),
(140500, 140000, '晋城市', '晋城', '112.85127', '35.497555', 2, 3, 1),
(140502, 140500, '城区', '城区', '112.8531', '35.49664', 3, 1, 1),
(140521, 140500, '沁水县', '沁水', '112.18721', '35.689472', 3, 4, 1),
(140522, 140500, '阳城县', '阳城', '112.42201', '35.482178', 3, 5, 1),
(140524, 140500, '陵川县', '陵川', '113.27888', '35.775616', 3, 3, 1),
(140525, 140500, '泽州县', '泽州', '112.89914', '35.61722', 3, 6, 1),
(140581, 140500, '高平市', '高平', '112.930695', '35.791355', 3, 2, 1),
(140600, 140000, '朔州市', '朔州', '112.43339', '39.33126', 2, 7, 1),
(140602, 140600, '朔城区', '朔城', '112.42867', '39.324524', 3, 4, 1),
(140603, 140600, '平鲁区', '平鲁', '112.29523', '39.515602', 3, 2, 1),
(140621, 140600, '山阴县', '山阴', '112.8164', '39.52677', 3, 3, 1),
(140622, 140600, '应县', '应县', '113.18751', '39.55919', 3, 5, 1),
(140623, 140600, '右玉县', '右玉', '112.46559', '39.98881', 3, 6, 1),
(140624, 140600, '怀仁县', '怀仁', '113.10051', '39.82079', 3, 1, 1),
(140700, 140000, '晋中市', '晋中', '112.736465', '37.696495', 2, 4, 1),
(140702, 140700, '榆次区', '榆次', '112.74006', '37.6976', 3, 9, 1),
(140721, 140700, '榆社县', '榆社', '112.97352', '37.06902', 3, 10, 1),
(140722, 140700, '左权县', '左权', '113.37783', '37.079674', 3, 11, 1),
(140723, 140700, '和顺县', '和顺', '113.57292', '37.327026', 3, 1, 1),
(140724, 140700, '昔阳县', '昔阳', '113.70617', '37.60437', 3, 8, 1),
(140725, 140700, '寿阳县', '寿阳', '113.17771', '37.891136', 3, 6, 1),
(140726, 140700, '太谷县', '太谷', '112.5541', '37.424595', 3, 7, 1),
(140727, 140700, '祁县', '祁县', '112.33053', '37.358738', 3, 5, 1),
(140728, 140700, '平遥县', '平遥', '112.17406', '37.195473', 3, 4, 1),
(140729, 140700, '灵石县', '灵石', '111.77276', '36.84747', 3, 3, 1),
(140781, 140700, '介休市', '介休', '111.91386', '37.027615', 3, 2, 1),
(140800, 140000, '运城市', '运城', '111.00396', '35.022778', 2, 11, 1),
(140802, 140800, '盐湖区', '盐湖', '111.000626', '35.025642', 3, 11, 1),
(140821, 140800, '临猗县', '临猗', '110.77493', '35.141884', 3, 4, 1),
(140822, 140800, '万荣县', '万荣', '110.84356', '35.41704', 3, 7, 1),
(140823, 140800, '闻喜县', '闻喜', '111.22031', '35.35384', 3, 8, 1),
(140824, 140800, '稷山县', '稷山', '110.979', '35.60041', 3, 3, 1),
(140825, 140800, '新绛县', '新绛', '111.225204', '35.613697', 3, 10, 1),
(140826, 140800, '绛县', '绛县', '111.57618', '35.49045', 3, 2, 1),
(140827, 140800, '垣曲县', '垣曲', '111.67099', '35.298294', 3, 13, 1),
(140828, 140800, '夏县', '夏县', '111.223175', '35.14044', 3, 9, 1),
(140829, 140800, '平陆县', '平陆', '111.21238', '34.837257', 3, 5, 1),
(140830, 140800, '芮城县', '芮城', '110.69114', '34.69477', 3, 6, 1),
(140881, 140800, '永济市', '永济', '110.44798', '34.865124', 3, 12, 1),
(140882, 140800, '河津市', '河津', '110.710266', '35.59715', 3, 1, 1),
(140900, 140000, '忻州市', '忻州', '112.733536', '38.41769', 2, 9, 1),
(140902, 140900, '忻府区', '忻府', '112.734116', '38.417744', 3, 13, 1),
(140921, 140900, '定襄县', '定襄', '112.963234', '38.484947', 3, 3, 1),
(140922, 140900, '五台县', '五台', '113.25901', '38.72571', 3, 11, 1),
(140923, 140900, '代县', '代县', '112.96252', '39.06514', 3, 2, 1),
(140924, 140900, '繁峙县', '繁峙', '113.26771', '39.188103', 3, 4, 1),
(140925, 140900, '宁武县', '宁武', '112.30794', '39.001717', 3, 8, 1),
(140926, 140900, '静乐县', '静乐', '111.94023', '38.355946', 3, 6, 1),
(140927, 140900, '神池县', '神池', '112.20044', '39.088467', 3, 10, 1),
(140928, 140900, '五寨县', '五寨', '111.84102', '38.91276', 3, 12, 1),
(140929, 140900, '岢岚县', '岢岚', '111.56981', '38.705624', 3, 7, 1),
(140930, 140900, '河曲县', '河曲', '111.14661', '39.381893', 3, 5, 1),
(140931, 140900, '保德县', '保德', '111.085686', '39.022575', 3, 1, 1),
(140932, 140900, '偏关县', '偏关', '111.50048', '39.442154', 3, 9, 1),
(140981, 140900, '原平市', '原平', '112.713135', '38.729187', 3, 14, 1),
(141000, 140000, '临汾市', '临汾', '111.517975', '36.08415', 2, 5, 1),
(141002, 141000, '尧都区', '尧都', '111.52294', '36.080364', 3, 15, 1),
(141021, 141000, '曲沃县', '曲沃', '111.47553', '35.641388', 3, 11, 1),
(141022, 141000, '翼城县', '翼城', '111.71351', '35.73862', 3, 16, 1),
(141023, 141000, '襄汾县', '襄汾', '111.44293', '35.87614', 3, 12, 1),
(141024, 141000, '洪洞县', '洪洞', '111.67369', '36.25574', 3, 6, 1),
(141025, 141000, '古县', '古县', '111.920204', '36.26855', 3, 5, 1),
(141026, 141000, '安泽县', '安泽', '112.25137', '36.14603', 3, 1, 1),
(141027, 141000, '浮山县', '浮山', '111.85004', '35.97136', 3, 4, 1),
(141028, 141000, '吉县', '吉县', '110.68285', '36.099354', 3, 9, 1),
(141029, 141000, '乡宁县', '乡宁', '110.85737', '35.975403', 3, 13, 1),
(141030, 141000, '大宁县', '大宁', '110.75128', '36.46383', 3, 2, 1),
(141031, 141000, '隰县', '隰县', '110.93581', '36.692677', 3, 14, 1),
(141032, 141000, '永和县', '永和', '110.63128', '36.760612', 3, 17, 1),
(141033, 141000, '蒲县', '蒲县', '111.09733', '36.411682', 3, 10, 1),
(141034, 141000, '汾西县', '汾西', '111.56302', '36.65337', 3, 3, 1),
(141081, 141000, '侯马市', '侯马', '111.37127', '35.6203', 3, 7, 1),
(141082, 141000, '霍州市', '霍州', '111.72311', '36.57202', 3, 8, 1),
(141100, 140000, '吕梁市', '吕梁', '111.13434', '37.524364', 2, 6, 1),
(141102, 141100, '离石区', '离石', '111.13446', '37.524036', 3, 7, 1),
(141121, 141100, '文水县', '文水', '112.03259', '37.436314', 3, 10, 1),
(141122, 141100, '交城县', '交城', '112.15916', '37.555157', 3, 3, 1),
(141123, 141100, '兴县', '兴县', '111.12482', '38.464134', 3, 12, 1),
(141124, 141100, '临县', '临县', '110.995964', '37.960808', 3, 6, 1),
(141125, 141100, '柳林县', '柳林', '110.89613', '37.431664', 3, 8, 1),
(141126, 141100, '石楼县', '石楼', '110.83712', '36.999428', 3, 9, 1),
(141127, 141100, '岚县', '岚县', '111.671555', '38.278652', 3, 5, 1),
(141128, 141100, '方山县', '方山', '111.238884', '37.89263', 3, 1, 1),
(141129, 141100, '中阳县', '中阳', '111.19332', '37.342052', 3, 13, 1),
(141130, 141100, '交口县', '交口', '111.18319', '36.983067', 3, 4, 1),
(141181, 141100, '孝义市', '孝义', '111.78157', '37.144474', 3, 11, 1),
(141182, 141100, '汾阳市', '汾阳', '111.78527', '37.267742', 3, 2, 1),
(150000, 0, '内蒙古自治区', '内蒙古', '111.6708', '40.81831', 1, 5, 1),
(150100, 150000, '呼和浩特市', '呼和浩特', '111.6708', '40.81831', 2, 6, 1),
(150102, 150100, '新城区', '新城', '111.68597', '40.826225', 3, 8, 1),
(150103, 150100, '回民区', '回民', '111.66216', '40.815147', 3, 2, 1),
(150104, 150100, '玉泉区', '玉泉', '111.66543', '40.79942', 3, 9, 1),
(150105, 150100, '赛罕区', '赛罕', '111.69846', '40.807835', 3, 4, 1),
(150121, 150100, '土默特左旗', '土默特左', '111.13361', '40.720417', 3, 5, 1),
(150122, 150100, '托克托县', '托克托', '111.19732', '40.27673', 3, 6, 1),
(150123, 150100, '和林格尔县', '和林格尔', '111.82414', '40.380287', 3, 1, 1),
(150124, 150100, '清水河县', '清水河', '111.67222', '39.91248', 3, 3, 1),
(150125, 150100, '武川县', '武川', '111.456566', '41.094482', 3, 7, 1),
(150200, 150000, '包头市', '包头', '109.84041', '40.65817', 2, 2, 1),
(150202, 150200, '东河区', '东河', '110.02689', '40.587055', 3, 3, 1),
(150203, 150200, '昆都仑区', '昆都仑', '109.82293', '40.661346', 3, 6, 1),
(150204, 150200, '青山区', '青山', '109.88005', '40.668556', 3, 7, 1),
(150205, 150200, '石拐区', '石拐', '110.27257', '40.672092', 3, 8, 1),
(150206, 150200, '白云鄂博矿区', '白云矿区', '109.97016', '41.769245', 3, 1, 1),
(150207, 150200, '九原区', '九原', '109.968124', '40.600582', 3, 5, 1),
(150221, 150200, '土默特右旗', '土默特右', '110.526764', '40.566433', 3, 9, 1),
(150222, 150200, '固阳县', '固阳', '110.06342', '41.030003', 3, 4, 1),
(150223, 150200, '达尔罕茂明安联合旗', '达尔罕茂明安联合', '109.84041', '40.65817', 3, 2, 1),
(150300, 150000, '乌海市', '乌海', '106.82556', '39.673733', 2, 9, 1),
(150302, 150300, '海勃湾区', '海勃湾', '106.817764', '39.673527', 3, 1, 1),
(150303, 150300, '海南区', '海南', '106.88479', '39.44153', 3, 2, 1),
(150304, 150300, '乌达区', '乌达', '106.72271', '39.50229', 3, 3, 1),
(150400, 150000, '赤峰市', '赤峰', '118.9568', '42.27532', 2, 4, 1),
(150402, 150400, '红山区', '红山', '118.96109', '42.269733', 3, 5, 1),
(150403, 150400, '元宝山区', '元宝山', '119.28988', '42.04117', 3, 12, 1),
(150404, 150400, '松山区', '松山', '118.93896', '42.281048', 3, 10, 1),
(150421, 150400, '阿鲁科尔沁旗', '阿鲁科尔沁', '120.09497', '43.87877', 3, 1, 1),
(150422, 150400, '巴林左旗', '巴林左', '119.39174', '43.980717', 3, 4, 1),
(150423, 150400, '巴林右旗', '巴林右', '118.678345', '43.52896', 3, 3, 1),
(150424, 150400, '林西县', '林西', '118.05775', '43.605328', 3, 8, 1),
(150425, 150400, '克什克腾旗', '克什克腾', '117.542465', '43.256233', 3, 7, 1),
(150426, 150400, '翁牛特旗', '翁牛特', '119.02262', '42.937126', 3, 11, 1),
(150428, 150400, '喀喇沁旗', '喀喇沁', '118.70857', '41.92778', 3, 6, 1),
(150429, 150400, '宁城县', '宁城', '119.33924', '41.598694', 3, 9, 1),
(150430, 150400, '敖汉旗', '敖汉', '119.90649', '42.28701', 3, 2, 1),
(150500, 150000, '通辽市', '通辽', '122.26312', '43.617428', 2, 8, 1),
(150502, 150500, '科尔沁区', '科尔沁', '122.264046', '43.61742', 3, 3, 1),
(150521, 150500, '科尔沁左翼中旗', '科尔沁左翼中', '123.31387', '44.127167', 3, 5, 1),
(150522, 150500, '科尔沁左翼后旗', '科尔沁左翼后', '122.355156', '42.954563', 3, 4, 1),
(150523, 150500, '开鲁县', '开鲁', '121.3088', '43.602432', 3, 2, 1),
(150524, 150500, '库伦旗', '库伦', '121.77489', '42.73469', 3, 6, 1),
(150525, 150500, '奈曼旗', '奈曼', '120.662544', '42.84685', 3, 7, 1),
(150526, 150500, '扎鲁特旗', '扎鲁特', '120.90527', '44.555294', 3, 8, 1),
(150581, 150500, '霍林郭勒市', '霍林郭勒', '119.65786', '45.53236', 3, 1, 1),
(150600, 150000, '鄂尔多斯市', '鄂尔多斯', '109.99029', '39.81718', 2, 5, 1),
(150602, 150600, '东胜区', '东胜', '109.98945', '39.81788', 3, 2, 1),
(150621, 150600, '达拉特旗', '达拉特', '110.04028', '40.404076', 3, 1, 1),
(150622, 150600, '准格尔旗', '准格尔', '111.238335', '39.86522', 3, 8, 1),
(150623, 150600, '鄂托克前旗', '鄂托克前', '107.48172', '38.183258', 3, 4, 1),
(150624, 150600, '鄂托克旗', '鄂托克', '107.982605', '39.095753', 3, 3, 1),
(150625, 150600, '杭锦旗', '杭锦', '108.73632', '39.831787', 3, 5, 1),
(150626, 150600, '乌审旗', '乌审', '108.84245', '38.59661', 3, 6, 1),
(150627, 150600, '伊金霍洛旗', '伊金霍洛', '109.7874', '39.604313', 3, 7, 1),
(150700, 150000, '呼伦贝尔市', '呼伦贝尔', '119.75817', '49.215332', 2, 7, 1),
(150702, 150700, '海拉尔区', '海拉尔', '119.76492', '49.21389', 3, 7, 1),
(150703, 150700, '扎赉诺尔区', '扎赉诺尔', '117.7927', '49.486942', 3, 13, 1),
(150721, 150700, '阿荣旗', '阿荣', '123.464615', '48.130505', 3, 1, 1),
(150722, 150700, '莫力达瓦达斡尔族自治旗', '莫力达瓦', '124.5074', '48.478386', 3, 9, 1),
(150723, 150700, '鄂伦春自治旗', '鄂伦春', '123.725685', '50.590176', 3, 4, 1),
(150724, 150700, '鄂温克族自治旗', '鄂温克', '119.75404', '49.14329', 3, 5, 1),
(150725, 150700, '陈巴尔虎旗', '陈巴尔虎', '119.43761', '49.328423', 3, 2, 1),
(150726, 150700, '新巴尔虎左旗', '新巴尔虎左', '118.267456', '48.21657', 3, 11, 1),
(150727, 150700, '新巴尔虎右旗', '新巴尔虎右', '116.82599', '48.669132', 3, 10, 1),
(150781, 150700, '满洲里市', '满洲里', '117.45556', '49.59079', 3, 8, 1),
(150782, 150700, '牙克石市', '牙克石', '120.729004', '49.287025', 3, 12, 1),
(150783, 150700, '扎兰屯市', '扎兰屯', '122.7444', '48.007412', 3, 14, 1),
(150784, 150700, '额尔古纳市', '额尔古纳', '120.178635', '50.2439', 3, 3, 1),
(150785, 150700, '根河市', '根河', '121.53272', '50.780453', 3, 6, 1),
(150800, 150000, '巴彦淖尔市', '巴彦淖尔', '107.41696', '40.7574', 2, 3, 1),
(150802, 150800, '临河区', '临河', '107.417015', '40.75709', 3, 3, 1),
(150821, 150800, '五原县', '五原', '108.27066', '41.097637', 3, 7, 1),
(150822, 150800, '磴口县', '磴口', '107.00606', '40.33048', 3, 1, 1),
(150823, 150800, '乌拉特前旗', '乌拉特前', '108.656815', '40.72521', 3, 5, 1),
(150824, 150800, '乌拉特中旗', '乌拉特中', '108.51526', '41.57254', 3, 6, 1),
(150825, 150800, '乌拉特后旗', '乌拉特后', '107.07494', '41.08431', 3, 4, 1),
(150826, 150800, '杭锦后旗', '杭锦后', '107.14768', '40.888798', 3, 2, 1),
(150900, 150000, '乌兰察布市', '乌兰察布', '113.11454', '41.034126', 2, 10, 1),
(150902, 150900, '集宁区', '集宁', '113.116455', '41.034134', 3, 6, 1),
(150921, 150900, '卓资县', '卓资', '112.577705', '40.89576', 3, 11, 1),
(150922, 150900, '化德县', '化德', '114.01008', '41.899334', 3, 5, 1),
(150923, 150900, '商都县', '商都', '113.560646', '41.56016', 3, 8, 1),
(150924, 150900, '兴和县', '兴和', '113.83401', '40.872437', 3, 10, 1),
(150925, 150900, '凉城县', '凉城', '112.50091', '40.531628', 3, 7, 1),
(150926, 150900, '察哈尔右翼前旗', '察哈尔右翼前', '113.21196', '40.786858', 3, 2, 1),
(150927, 150900, '察哈尔右翼中旗', '察哈尔右翼中', '112.63356', '41.27421', 3, 3, 1),
(150928, 150900, '察哈尔右翼后旗', '察哈尔右翼后', '113.1906', '41.447212', 3, 1, 1),
(150929, 150900, '四子王旗', '四子王', '111.70123', '41.528114', 3, 9, 1),
(150981, 150900, '丰镇市', '丰镇', '113.16346', '40.437534', 3, 4, 1),
(152200, 150000, '兴安盟', '兴安', '122.07032', '46.076267', 2, 12, 1),
(152201, 152200, '乌兰浩特市', '乌兰浩特', '122.06898', '46.077236', 3, 5, 1),
(152202, 152200, '阿尔山市', '阿尔山', '119.94366', '47.177', 3, 1, 1),
(152221, 152200, '科尔沁右翼前旗', '科尔沁右翼前', '121.95754', '46.076496', 3, 2, 1),
(152222, 152200, '科尔沁右翼中旗', '科尔沁右翼中', '121.47282', '45.059647', 3, 3, 1),
(152223, 152200, '扎赉特旗', '扎赉特', '122.90933', '46.725136', 3, 6, 1),
(152224, 152200, '突泉县', '突泉', '121.56486', '45.380985', 3, 4, 1),
(152500, 150000, '锡林郭勒盟', '锡林郭勒', '116.090996', '43.94402', 2, 11, 1),
(152501, 152500, '二连浩特市', '二连浩特', '111.97981', '43.652897', 3, 4, 1),
(152502, 152500, '锡林浩特市', '锡林浩特', '116.0919', '43.9443', 3, 9, 1),
(152522, 152500, '阿巴嘎旗', '阿巴嘎', '114.97062', '44.022728', 3, 1, 1),
(152523, 152500, '苏尼特左旗', '苏尼特左', '113.65341', '43.854107', 3, 6, 1),
(152524, 152500, '苏尼特右旗', '苏尼特右', '112.65539', '42.746662', 3, 5, 1),
(152525, 152500, '东乌珠穆沁旗', '东乌珠穆沁', '116.98002', '45.510307', 3, 2, 1),
(152526, 152500, '西乌珠穆沁旗', '西乌珠穆沁', '117.61525', '44.586147', 3, 10, 1),
(152527, 152500, '太仆寺旗', '太仆寺', '115.28728', '41.8952', 3, 7, 1),
(152528, 152500, '镶黄旗', '镶黄', '113.84387', '42.239227', 3, 8, 1),
(152529, 152500, '正镶白旗', '正镶白', '115.031425', '42.286808', 3, 12, 1),
(152530, 152500, '正蓝旗', '正蓝', '116.00331', '42.245895', 3, 11, 1),
(152531, 152500, '多伦县', '多伦', '116.47729', '42.197964', 3, 3, 1),
(152900, 150000, '阿拉善盟', '阿拉善', '105.70642', '38.844814', 2, 1, 1),
(152921, 152900, '阿拉善左旗', '阿拉善左', '105.70192', '38.84724', 3, 2, 1),
(152922, 152900, '阿拉善右旗', '阿拉善右', '101.67198', '39.21159', 3, 1, 1),
(152923, 152900, '额济纳旗', '额济纳', '101.06944', '41.958813', 3, 3, 1),
(210000, 0, '辽宁省', '辽宁', '123.42909', '41.79677', 1, 6, 1),
(210100, 210000, '沈阳市', '沈阳', '123.42909', '41.79677', 2, 12, 1),
(210102, 210100, '和平区', '和平', '123.40666', '41.788074', 3, 4, 1),
(210103, 210100, '沈河区', '沈河', '123.445694', '41.79559', 3, 9, 1),
(210104, 210100, '大东区', '大东', '123.469955', '41.808502', 3, 1, 1),
(210105, 210100, '皇姑区', '皇姑', '123.40568', '41.822334', 3, 5, 1),
(210106, 210100, '铁西区', '铁西', '123.35066', '41.787807', 3, 11, 1),
(210111, 210100, '苏家屯区', '苏家屯', '123.341606', '41.665905', 3, 10, 1),
(210112, 210100, '东陵区', '东陵', '123.458984', '41.741947', 3, 2, 1),
(210114, 210100, '于洪区', '于洪', '123.31083', '41.795834', 3, 13, 1),
(210122, 210100, '辽中县', '辽中', '122.73127', '41.512726', 3, 7, 1),
(210123, 210100, '康平县', '康平', '123.3527', '42.74153', 3, 6, 1),
(210124, 210100, '法库县', '法库', '123.416725', '42.507046', 3, 3, 1),
(210181, 210100, '新民市', '新民', '122.828865', '41.99651', 3, 12, 1),
(210184, 210100, '沈北新区', '沈北', '123.52147', '42.05231', 3, 8, 1),
(210200, 210000, '大连市', '大连', '121.61862', '38.91459', 2, 4, 1),
(210202, 210200, '中山区', '中山', '121.64376', '38.921555', 3, 4, 1),
(210203, 210200, '西岗区', '西岗', '121.61611', '38.914265', 3, 9, 1),
(210204, 210200, '沙河口区', '沙河口', '121.593704', '38.91286', 3, 7, 1),
(210211, 210200, '甘井子区', '甘井子', '121.58261', '38.975147', 3, 2, 1),
(210212, 210200, '旅顺口区', '旅顺口', '121.26713', '38.812042', 3, 5, 1),
(210213, 210200, '金州区', '金州', '121.78941', '39.052746', 3, 3, 1),
(210224, 210200, '长海县', '长海', '122.58782', '39.2724', 3, 1, 1),
(210281, 210200, '瓦房店市', '瓦房店', '122.002655', '39.63065', 3, 8, 1),
(210282, 210200, '普兰店市', '普兰店', '121.9705', '39.401554', 3, 6, 1),
(210283, 210200, '庄河市', '庄河', '122.97061', '39.69829', 3, 10, 1),
(210300, 210000, '鞍山市', '鞍山', '122.99563', '41.110626', 2, 1, 1),
(210302, 210300, '铁东区', '铁东', '122.99448', '41.110344', 3, 5, 1),
(210303, 210300, '铁西区', '铁西', '122.97183', '41.11069', 3, 6, 1),
(210304, 210300, '立山区', '立山', '123.0248', '41.150623', 3, 2, 1),
(210311, 210300, '千山区', '千山', '122.95788', '41.07072', 3, 3, 1),
(210321, 210300, '台安县', '台安', '122.42973', '41.38686', 3, 4, 1),
(210323, 210300, '岫岩满族自治县', '岫岩', '123.28833', '40.28151', 3, 7, 1),
(210381, 210300, '海城市', '海城', '122.7522', '40.85253', 3, 1, 1),
(210400, 210000, '抚顺市', '抚顺', '123.92111', '41.875957', 2, 6, 1),
(210402, 210400, '新抚区', '新抚', '123.902855', '41.86082', 3, 7, 1),
(210403, 210400, '东洲区', '东洲', '124.04722', '41.86683', 3, 1, 1),
(210404, 210400, '望花区', '望花', '123.801506', '41.851803', 3, 5, 1),
(210411, 210400, '顺城区', '顺城', '123.91717', '41.88113', 3, 4, 1),
(210421, 210400, '抚顺县', '抚顺', '124.09798', '41.922646', 3, 2, 1),
(210422, 210400, '新宾满族自治县', '新宾', '125.037544', '41.732456', 3, 6, 1),
(210423, 210400, '清原满族自治县', '清原', '124.92719', '42.10135', 3, 3, 1),
(210500, 210000, '本溪市', '本溪', '123.770515', '41.29791', 2, 2, 1),
(210502, 210500, '平山区', '平山', '123.76123', '41.29158', 3, 5, 1),
(210503, 210500, '溪湖区', '溪湖', '123.76523', '41.330055', 3, 6, 1),
(210504, 210500, '明山区', '明山', '123.76329', '41.30243', 3, 3, 1),
(210505, 210500, '南芬区', '南芬', '123.74838', '41.10409', 3, 4, 1),
(210521, 210500, '本溪满族自治县', '本溪', '124.12616', '41.300343', 3, 1, 1),
(210522, 210500, '桓仁满族自治县', '桓仁', '125.35919', '41.268997', 3, 2, 1),
(210600, 210000, '丹东市', '丹东', '124.38304', '40.124294', 2, 5, 1),
(210602, 210600, '元宝区', '元宝', '124.39781', '40.136482', 3, 4, 1),
(210603, 210600, '振兴区', '振兴', '124.36115', '40.102802', 3, 6, 1),
(210604, 210600, '振安区', '振安', '124.42771', '40.158558', 3, 5, 1),
(210624, 210600, '宽甸满族自治县', '宽甸', '124.78487', '40.73041', 3, 3, 1),
(210681, 210600, '东港市', '东港', '124.14944', '39.88347', 3, 1, 1),
(210682, 210600, '凤城市', '凤城', '124.07107', '40.457565', 3, 2, 1),
(210700, 210000, '锦州市', '锦州', '121.13574', '41.11927', 2, 9, 1),
(210702, 210700, '古塔区', '古塔', '121.13009', '41.11572', 3, 2, 1),
(210703, 210700, '凌河区', '凌河', '121.151306', '41.114662', 3, 5, 1),
(210711, 210700, '太和区', '太和', '121.1073', '41.105377', 3, 6, 1),
(210726, 210700, '黑山县', '黑山', '122.11791', '41.691803', 3, 3, 1),
(210727, 210700, '义县', '义县', '121.24283', '41.537224', 3, 7, 1),
(210781, 210700, '凌海市', '凌海', '121.364235', '41.171738', 3, 4, 1),
(210782, 210700, '北镇市', '北镇', '121.79596', '41.598763', 3, 1, 1),
(210800, 210000, '营口市', '营口', '122.23515', '40.66743', 2, 14, 1),
(210802, 210800, '站前区', '站前', '122.253235', '40.66995', 3, 6, 1),
(210803, 210800, '西市区', '西市', '122.21007', '40.663086', 3, 5, 1),
(210804, 210800, '鲅鱼圈区', '鲅鱼圈', '122.12724', '40.263645', 3, 1, 1),
(210811, 210800, '老边区', '老边', '122.38258', '40.682724', 3, 4, 1),
(210881, 210800, '盖州市', '盖州', '122.35554', '40.405235', 3, 3, 1),
(210882, 210800, '大石桥市', '大石桥', '122.5059', '40.633972', 3, 2, 1),
(210900, 210000, '阜新市', '阜新', '121.648964', '42.011795', 2, 7, 1),
(210902, 210900, '海州区', '海州', '121.65764', '42.01116', 3, 2, 1),
(210903, 210900, '新邱区', '新邱', '121.79054', '42.0866', 3, 6, 1),
(210904, 210900, '太平区', '太平', '121.677574', '42.011147', 3, 4, 1),
(210905, 210900, '清河门区', '清河门', '121.42018', '41.780476', 3, 3, 1),
(210911, 210900, '细河区', '细河', '121.65479', '42.01922', 3, 5, 1),
(210921, 210900, '阜新蒙古族自治县', '阜新', '121.743126', '42.058605', 3, 1, 1),
(210922, 210900, '彰武县', '彰武', '122.537445', '42.384823', 3, 7, 1),
(211000, 210000, '辽阳市', '辽阳', '123.18152', '41.2694', 2, 10, 1),
(211002, 211000, '白塔区', '白塔', '123.17261', '41.26745', 3, 1, 1),
(211003, 211000, '文圣区', '文圣', '123.188225', '41.266766', 3, 7, 1),
(211004, 211000, '宏伟区', '宏伟', '123.20046', '41.205746', 3, 4, 1),
(211005, 211000, '弓长岭区', '弓长岭', '123.43163', '41.15783', 3, 3, 1),
(211011, 211000, '太子河区', '太子河', '123.18533', '41.251682', 3, 6, 1),
(211021, 211000, '辽阳县', '辽阳', '123.07967', '41.21648', 3, 5, 1),
(211081, 211000, '灯塔市', '灯塔', '123.32587', '41.427837', 3, 2, 1),
(211100, 210000, '盘锦市', '盘锦', '122.06957', '41.124485', 2, 11, 1),
(211102, 211100, '双台子区', '双台子', '122.05573', '41.190365', 3, 3, 1),
(211103, 211100, '兴隆台区', '兴隆台', '122.071625', '41.12242', 3, 4, 1),
(211121, 211100, '大洼县', '大洼', '122.07171', '40.994427', 3, 1, 1),
(211122, 211100, '盘山县', '盘山', '121.98528', '41.2407', 3, 2, 1),
(211200, 210000, '铁岭市', '铁岭', '123.84428', '42.290585', 2, 13, 1),
(211202, 211200, '银州区', '银州', '123.84488', '42.29228', 3, 7, 1),
(211204, 211200, '清河区', '清河', '124.14896', '42.542976', 3, 4, 1),
(211221, 211200, '铁岭县', '铁岭', '123.72567', '42.223316', 3, 5, 1),
(211223, 211200, '西丰县', '西丰', '124.72332', '42.73809', 3, 6, 1),
(211224, 211200, '昌图县', '昌图', '124.11017', '42.784443', 3, 1, 1),
(211281, 211200, '调兵山市', '调兵山', '123.545364', '42.450733', 3, 2, 1),
(211282, 211200, '开原市', '开原', '124.04555', '42.54214', 3, 3, 1),
(211300, 210000, '朝阳市', '朝阳', '120.45118', '41.57676', 2, 3, 1),
(211302, 211300, '双塔区', '双塔', '120.44877', '41.579388', 3, 7, 1),
(211303, 211300, '龙城区', '龙城', '120.413376', '41.576748', 3, 6, 1),
(211321, 211300, '朝阳县', '朝阳', '120.40422', '41.52634', 3, 2, 1),
(211322, 211300, '建平县', '建平', '119.642365', '41.402576', 3, 3, 1),
(211324, 211300, '喀喇沁左翼蒙古族自治县', '喀左', '119.74488', '41.125427', 3, 4, 1),
(211381, 211300, '北票市', '北票', '120.76695', '41.803288', 3, 1, 1),
(211382, 211300, '凌源市', '凌源', '119.40479', '41.243088', 3, 5, 1),
(211400, 210000, '葫芦岛市', '葫芦岛', '120.85639', '40.755573', 2, 8, 1),
(211402, 211400, '连山区', '连山', '120.85937', '40.755142', 3, 2, 1),
(211403, 211400, '龙港区', '龙港', '120.83857', '40.70999', 3, 3, 1),
(211404, 211400, '南票区', '南票', '120.75231', '41.098812', 3, 4, 1),
(211421, 211400, '绥中县', '绥中', '120.34211', '40.328407', 3, 5, 1),
(211422, 211400, '建昌县', '建昌', '119.80778', '40.81287', 3, 1, 1),
(211481, 211400, '兴城市', '兴城', '120.72936', '40.61941', 3, 6, 1),
(220000, 0, '吉林省', '吉林', '125.3245', '43.88684', 1, 7, 1),
(220100, 220000, '长春市', '长春', '125.3245', '43.88684', 2, 3, 1),
(220102, 220100, '南关区', '南关', '125.337234', '43.890236', 3, 7, 1),
(220103, 220100, '宽城区', '宽城', '125.34283', '43.903824', 3, 5, 1),
(220104, 220100, '朝阳区', '朝阳', '125.31804', '43.86491', 3, 1, 1),
(220105, 220100, '二道区', '二道', '125.38473', '43.870823', 3, 3, 1),
(220106, 220100, '绿园区', '绿园', '125.27247', '43.892178', 3, 6, 1),
(220112, 220100, '双阳区', '双阳', '125.65902', '43.52517', 3, 9, 1),
(220122, 220100, '农安县', '农安', '125.175285', '44.43126', 3, 8, 1),
(220181, 220100, '九台市', '九台', '125.84468', '44.157154', 3, 4, 1),
(220182, 220100, '榆树市', '榆树', '126.55011', '44.82764', 3, 10, 1),
(220183, 220100, '德惠市', '德惠', '125.70332', '44.53391', 3, 2, 1),
(220200, 220000, '吉林市', '吉林', '126.55302', '43.84358', 2, 4, 1),
(220202, 220200, '昌邑区', '昌邑', '126.57076', '43.851116', 3, 1, 1),
(220203, 220200, '龙潭区', '龙潭', '126.56143', '43.909756', 3, 6, 1),
(220204, 220200, '船营区', '船营', '126.55239', '43.843803', 3, 2, 1),
(220211, 220200, '丰满区', '丰满', '126.56076', '43.816593', 3, 3, 1),
(220221, 220200, '永吉县', '永吉', '126.501625', '43.667416', 3, 9, 1),
(220281, 220200, '蛟河市', '蛟河', '127.342735', '43.720577', 3, 5, 1),
(220282, 220200, '桦甸市', '桦甸', '126.745445', '42.97209', 3, 4, 1),
(220283, 220200, '舒兰市', '舒兰', '126.947815', '44.410908', 3, 8, 1),
(220284, 220200, '磐石市', '磐石', '126.05993', '42.942474', 3, 7, 1),
(220300, 220000, '四平市', '四平', '124.37079', '43.170345', 2, 6, 1),
(220302, 220300, '铁西区', '铁西', '124.36089', '43.17626', 3, 5, 1),
(220303, 220300, '铁东区', '铁东', '124.388466', '43.16726', 3, 4, 1),
(220322, 220300, '梨树县', '梨树', '124.3358', '43.30831', 3, 2, 1),
(220323, 220300, '伊通满族自治县', '伊通', '125.30312', '43.345463', 3, 6, 1),
(220381, 220300, '公主岭市', '公主岭', '124.81759', '43.509476', 3, 1, 1),
(220382, 220300, '双辽市', '双辽', '123.50528', '43.518276', 3, 3, 1),
(220400, 220000, '辽源市', '辽源', '125.14535', '42.90269', 2, 5, 1),
(220402, 220400, '龙山区', '龙山', '125.145164', '42.902702', 3, 3, 1),
(220403, 220400, '西安区', '西安', '125.15142', '42.920414', 3, 4, 1),
(220421, 220400, '东丰县', '东丰', '125.529625', '42.67523', 3, 1, 1),
(220422, 220400, '东辽县', '东辽', '124.992', '42.927723', 3, 2, 1),
(220500, 220000, '通化市', '通化', '125.9365', '41.721176', 2, 8, 1),
(220502, 220500, '东昌区', '东昌', '125.936714', '41.721233', 3, 1, 1),
(220503, 220500, '二道江区', '二道江', '126.04599', '41.777565', 3, 2, 1),
(220521, 220500, '通化县', '通化', '125.75312', '41.677917', 3, 7, 1),
(220523, 220500, '辉南县', '辉南', '126.04282', '42.68346', 3, 3, 1),
(220524, 220500, '柳河县', '柳河', '125.74054', '42.281483', 3, 5, 1),
(220581, 220500, '梅河口市', '梅河口', '125.68734', '42.530003', 3, 6, 1),
(220582, 220500, '集安市', '集安', '126.1862', '41.126274', 3, 4, 1),
(220600, 220000, '白山市', '白山', '126.42784', '41.942505', 2, 2, 1),
(220602, 220600, '浑江区', '浑江', '126.42803', '41.943066', 3, 3, 1),
(220621, 220600, '抚松县', '抚松', '127.273796', '42.33264', 3, 2, 1),
(220622, 220600, '靖宇县', '靖宇', '126.80839', '42.38969', 3, 5, 1),
(220623, 220600, '长白朝鲜族自治县', '长白', '128.20338', '41.41936', 3, 1, 1),
(220625, 220600, '江源区', '江源', '126.58423', '42.048107', 3, 4, 1),
(220681, 220600, '临江市', '临江', '126.9193', '41.810688', 3, 6, 1),
(220700, 220000, '松原市', '松原', '124.82361', '45.118244', 2, 7, 1),
(220702, 220700, '宁江区', '宁江', '124.82785', '45.1765', 3, 3, 1),
(220721, 220700, '前郭尔罗斯蒙古族自治县', '前郭', '124.826805', '45.116287', 3, 5, 1),
(220722, 220700, '长岭县', '长岭', '123.98518', '44.27658', 3, 1, 1),
(220723, 220700, '乾安县', '乾安', '124.02436', '45.006847', 3, 4, 1),
(220724, 220700, '扶余市', '扶余', '126.042755', '44.9862', 3, 2, 1),
(220800, 220000, '白城市', '白城', '122.84111', '45.619026', 2, 1, 1),
(220802, 220800, '洮北区', '洮北', '122.8425', '45.61925', 3, 2, 1),
(220821, 220800, '镇赉县', '镇赉', '123.20225', '45.84609', 3, 5, 1),
(220822, 220800, '通榆县', '通榆', '123.08855', '44.80915', 3, 4, 1),
(220881, 220800, '洮南市', '洮南', '122.783775', '45.33911', 3, 3, 1),
(220882, 220800, '大安市', '大安', '124.29151', '45.50765', 3, 1, 1),
(222400, 220000, '延边朝鲜族自治州', '延边朝鲜族', '129.51323', '42.904823', 2, 9, 1),
(222401, 222400, '延吉市', '延吉', '129.5158', '42.906963', 3, 8, 1),
(222402, 222400, '图们市', '图们', '129.8467', '42.96662', 3, 6, 1),
(222403, 222400, '敦化市', '敦化', '128.22986', '43.36692', 3, 2, 1),
(222404, 222400, '珲春市', '珲春', '130.36578', '42.871056', 3, 4, 1),
(222405, 222400, '龙井市', '龙井', '129.42575', '42.77103', 3, 5, 1),
(222406, 222400, '和龙市', '和龙', '129.00874', '42.547005', 3, 3, 1),
(222424, 222400, '汪清县', '汪清', '129.76616', '43.315426', 3, 7, 1),
(222426, 222400, '安图县', '安图', '128.90187', '43.110992', 3, 1, 1),
(230000, 0, '黑龙江省', '黑龙江', '126.64246', '45.756966', 1, 8, 1),
(230100, 230000, '哈尔滨市', '哈尔滨', '126.64246', '45.756966', 2, 3, 1),
(230102, 230100, '道里区', '道里', '126.61253', '45.762035', 3, 4, 1),
(230103, 230100, '南岗区', '南岗', '126.6521', '45.75597', 3, 10, 1),
(230104, 230100, '道外区', '道外', '126.648834', '45.78454', 3, 5, 1),
(230106, 230100, '香坊区', '香坊', '126.667046', '45.713066', 3, 6, 1),
(230108, 230100, '平房区', '平房', '126.62926', '45.605568', 3, 11, 1),
(230109, 230100, '松北区', '松北', '126.563065', '45.814655', 3, 14, 1),
(230111, 230100, '呼兰区', '呼兰', '126.6033', '45.98423', 3, 8, 1),
(230123, 230100, '依兰县', '依兰', '129.5656', '46.315105', 3, 18, 1),
(230124, 230100, '方正县', '方正', '128.83614', '45.839535', 3, 7, 1),
(230125, 230100, '宾县', '宾县', '127.48594', '45.75937', 3, 3, 1),
(230126, 230100, '巴彦县', '巴彦', '127.4036', '46.08189', 3, 2, 1),
(230127, 230100, '木兰县', '木兰', '128.04268', '45.949825', 3, 9, 1),
(230128, 230100, '通河县', '通河', '128.74779', '45.97762', 3, 15, 1),
(230129, 230100, '延寿县', '延寿', '128.33188', '45.455647', 3, 17, 1),
(230181, 230100, '阿城区', '阿城', '126.972725', '45.538372', 3, 1, 1),
(230182, 230100, '双城市', '双城', '126.308784', '45.37794', 3, 13, 1),
(230183, 230100, '尚志市', '尚志', '127.96854', '45.214954', 3, 12, 1),
(230184, 230100, '五常市', '五常', '127.15759', '44.91942', 3, 16, 1),
(230200, 230000, '齐齐哈尔市', '齐齐哈尔', '123.95792', '47.34208', 2, 9, 1),
(230202, 230200, '龙沙区', '龙沙', '123.95734', '47.341736', 3, 10, 1),
(230203, 230200, '建华区', '建华', '123.95589', '47.354492', 3, 6, 1),
(230204, 230200, '铁锋区', '铁锋', '123.97356', '47.3395', 3, 15, 1),
(230205, 230200, '昂昂溪区', '昂昂溪', '123.81318', '47.156868', 3, 1, 1),
(230206, 230200, '富拉尔基区', '富拉尔基', '123.63887', '47.20697', 3, 3, 1),
(230207, 230200, '碾子山区', '碾子山', '122.88797', '47.51401', 3, 13, 1),
(230208, 230200, '梅里斯达斡尔族区', '梅里斯达斡尔族', '123.7546', '47.31111', 3, 11, 1),
(230221, 230200, '龙江县', '龙江', '123.187225', '47.336388', 3, 9, 1),
(230223, 230200, '依安县', '依安', '125.30756', '47.8901', 3, 16, 1),
(230224, 230200, '泰来县', '泰来', '123.41953', '46.39233', 3, 14, 1),
(230225, 230200, '甘南县', '甘南', '123.506035', '47.91784', 3, 5, 1),
(230227, 230200, '富裕县', '富裕', '124.46911', '47.797173', 3, 4, 1),
(230229, 230200, '克山县', '克山', '125.87435', '48.034344', 3, 8, 1),
(230230, 230200, '克东县', '克东', '126.24909', '48.03732', 3, 7, 1),
(230231, 230200, '拜泉县', '拜泉', '126.09191', '47.607365', 3, 2, 1),
(230281, 230200, '讷河市', '讷河', '124.88217', '48.481133', 3, 12, 1),
(230300, 230000, '鸡西市', '鸡西', '130.97597', '45.300045', 2, 7, 1),
(230302, 230300, '鸡冠区', '鸡冠', '130.97438', '45.30034', 3, 6, 1),
(230303, 230300, '恒山区', '恒山', '130.91063', '45.21324', 3, 3, 1),
(230304, 230300, '滴道区', '滴道', '130.84682', '45.348812', 3, 2, 1),
(230305, 230300, '梨树区', '梨树', '130.69778', '45.092194', 3, 7, 1),
(230306, 230300, '城子河区', '城子河', '131.0105', '45.33825', 3, 1, 1),
(230307, 230300, '麻山区', '麻山', '130.48112', '45.209606', 3, 8, 1),
(230321, 230300, '鸡东县', '鸡东', '131.14891', '45.250893', 3, 5, 1),
(230381, 230300, '虎林市', '虎林', '132.97388', '45.767986', 3, 4, 1),
(230382, 230300, '密山市', '密山', '131.87413', '45.54725', 3, 9, 1),
(230400, 230000, '鹤岗市', '鹤岗', '130.27748', '47.332085', 2, 4, 1),
(230402, 230400, '向阳区', '向阳', '130.29248', '47.34537', 3, 6, 1),
(230403, 230400, '工农区', '工农', '130.27666', '47.331676', 3, 2, 1),
(230404, 230400, '南山区', '南山', '130.27553', '47.31324', 3, 4, 1),
(230405, 230400, '兴安区', '兴安', '130.23618', '47.25291', 3, 7, 1),
(230406, 230400, '东山区', '东山', '130.31714', '47.337383', 3, 1, 1),
(230407, 230400, '兴山区', '兴山', '130.30534', '47.35997', 3, 8, 1),
(230421, 230400, '萝北县', '萝北', '130.82909', '47.577576', 3, 3, 1),
(230422, 230400, '绥滨县', '绥滨', '131.86052', '47.28989', 3, 5, 1),
(230500, 230000, '双鸭山市', '双鸭山', '131.1573', '46.64344', 2, 11, 1),
(230502, 230500, '尖山区', '尖山', '131.15897', '46.64296', 3, 3, 1),
(230503, 230500, '岭东区', '岭东', '131.16368', '46.591076', 3, 5, 1),
(230505, 230500, '四方台区', '四方台', '131.33318', '46.594345', 3, 7, 1),
(230506, 230500, '宝山区', '宝山', '131.4043', '46.573364', 3, 2, 1),
(230521, 230500, '集贤县', '集贤', '131.13933', '46.72898', 3, 4, 1),
(230522, 230500, '友谊县', '友谊', '131.81062', '46.775158', 3, 8, 1),
(230523, 230500, '宝清县', '宝清', '132.20642', '46.32878', 3, 1, 1),
(230524, 230500, '饶河县', '饶河', '134.02116', '46.80129', 3, 6, 1),
(230600, 230000, '大庆市', '大庆', '125.11272', '46.590733', 2, 1, 1),
(230602, 230600, '萨尔图区', '萨尔图', '125.11464', '46.596355', 3, 7, 1),
(230603, 230600, '龙凤区', '龙凤', '125.1458', '46.573948', 3, 5, 1),
(230604, 230600, '让胡路区', '让胡路', '124.86834', '46.653255', 3, 6, 1),
(230605, 230600, '红岗区', '红岗', '124.88953', '46.40305', 3, 3, 1),
(230606, 230600, '大同区', '大同', '124.81851', '46.034306', 3, 1, 1),
(230621, 230600, '肇州县', '肇州', '125.273254', '45.708687', 3, 9, 1),
(230622, 230600, '肇源县', '肇源', '125.08197', '45.518833', 3, 8, 1),
(230623, 230600, '林甸县', '林甸', '124.87774', '47.186413', 3, 4, 1),
(230624, 230600, '杜尔伯特蒙古族自治县', '杜尔伯特', '124.44626', '46.865974', 3, 2, 1),
(230700, 230000, '伊春市', '伊春', '128.8994', '47.724773', 2, 13, 1),
(230702, 230700, '伊春区', '伊春', '128.89928', '47.726852', 3, 16, 1),
(230703, 230700, '南岔区', '南岔', '129.28246', '47.137314', 3, 7, 1),
(230704, 230700, '友好区', '友好', '128.83896', '47.8543', 3, 17, 1),
(230705, 230700, '西林区', '西林', '129.31145', '47.47944', 3, 14, 1),
(230706, 230700, '翠峦区', '翠峦', '128.67175', '47.726227', 3, 1, 1),
(230707, 230700, '新青区', '新青', '129.52995', '48.288292', 3, 15, 1),
(230708, 230700, '美溪区', '美溪', '129.1334', '47.6361', 3, 6, 1),
(230709, 230700, '金山屯区', '金山屯', '129.43594', '47.41295', 3, 5, 1),
(230710, 230700, '五营区', '五营', '129.24503', '48.108204', 3, 13, 1),
(230711, 230700, '乌马河区', '乌马河', '128.80295', '47.72696', 3, 11, 1),
(230712, 230700, '汤旺河区', '汤旺河', '129.57224', '48.45365', 3, 9, 1),
(230713, 230700, '带岭区', '带岭', '129.02115', '47.02753', 3, 2, 1),
(230714, 230700, '乌伊岭区', '乌伊岭', '129.43785', '48.59112', 3, 12, 1),
(230715, 230700, '红星区', '红星', '129.3888', '48.23837', 3, 3, 1),
(230716, 230700, '上甘岭区', '上甘岭', '129.02509', '47.974857', 3, 8, 1),
(230722, 230700, '嘉荫县', '嘉荫', '130.39769', '48.891376', 3, 4, 1),
(230781, 230700, '铁力市', '铁力', '128.03056', '46.98577', 3, 10, 1),
(230800, 230000, '佳木斯市', '佳木斯', '130.36163', '46.809605', 2, 6, 1),
(230803, 230800, '向阳区', '向阳', '130.36179', '46.809647', 3, 10, 1),
(230804, 230800, '前进区', '前进', '130.37769', '46.812344', 3, 7, 1),
(230805, 230800, '东风区', '东风', '130.40329', '46.822475', 3, 1, 1),
(230811, 230800, '郊区', '郊区', '130.36163', '46.809605', 3, 6, 1),
(230822, 230800, '桦南县', '桦南', '130.57011', '46.240116', 3, 5, 1),
(230826, 230800, '桦川县', '桦川', '130.72371', '47.02304', 3, 4, 1),
(230828, 230800, '汤原县', '汤原', '129.90446', '46.73005', 3, 8, 1),
(230833, 230800, '抚远县', '抚远', '134.2945', '48.364708', 3, 3, 1),
(230881, 230800, '同江市', '同江', '132.51012', '47.65113', 3, 9, 1),
(230882, 230800, '富锦市', '富锦', '132.03795', '47.250748', 3, 2, 1),
(230900, 230000, '七台河市', '七台河', '131.01558', '45.771267', 2, 10, 1),
(230902, 230900, '新兴区', '新兴', '130.88948', '45.79426', 3, 4, 1),
(230903, 230900, '桃山区', '桃山', '131.01585', '45.771217', 3, 3, 1),
(230904, 230900, '茄子河区', '茄子河', '131.07156', '45.77659', 3, 2, 1),
(230921, 230900, '勃利县', '勃利', '130.57503', '45.75157', 3, 1, 1),
(231000, 230000, '牡丹江市', '牡丹江', '129.6186', '44.582962', 2, 8, 1),
(231002, 231000, '东安区', '东安', '129.62329', '44.582397', 3, 2, 1),
(231003, 231000, '阳明区', '阳明', '129.63464', '44.59633', 3, 10, 1),
(231004, 231000, '爱民区', '爱民', '129.60123', '44.595444', 3, 1, 1),
(231005, 231000, '西安区', '西安', '129.61311', '44.58103', 3, 9, 1),
(231024, 231000, '东宁县', '东宁', '131.12529', '44.06358', 3, 3, 1),
(231025, 231000, '林口县', '林口', '130.2684', '45.286644', 3, 5, 1),
(231081, 231000, '绥芬河市', '绥芬河', '131.16486', '44.396866', 3, 8, 1),
(231083, 231000, '海林市', '海林', '129.38791', '44.57415', 3, 4, 1),
(231084, 231000, '宁安市', '宁安', '129.47002', '44.346836', 3, 7, 1),
(231085, 231000, '穆棱市', '穆棱', '130.52708', '44.91967', 3, 6, 1),
(231100, 230000, '黑河市', '黑河', '127.49902', '50.249584', 2, 5, 1),
(231102, 231100, '爱辉区', '爱辉', '127.49764', '50.249027', 3, 1, 1),
(231121, 231100, '嫩江县', '嫩江', '125.229904', '49.17746', 3, 3, 1),
(231123, 231100, '逊克县', '逊克', '128.47615', '49.582973', 3, 6, 1),
(231124, 231100, '孙吴县', '孙吴', '127.32732', '49.423943', 3, 4, 1),
(231181, 231100, '北安市', '北安', '126.508736', '48.245438', 3, 2, 1),
(231182, 231100, '五大连池市', '五大连池', '126.19769', '48.512688', 3, 5, 1),
(231200, 230000, '绥化市', '绥化', '126.99293', '46.637394', 2, 12, 1),
(231202, 231200, '北林区', '北林', '126.99066', '46.63491', 3, 2, 1),
(231221, 231200, '望奎县', '望奎', '126.48419', '46.83352', 3, 9, 1),
(231222, 231200, '兰西县', '兰西', '126.289314', '46.259037', 3, 4, 1),
(231223, 231200, '青冈县', '青冈', '126.11227', '46.686596', 3, 7, 1),
(231224, 231200, '庆安县', '庆安', '127.510025', '46.879204', 3, 6, 1),
(231225, 231200, '明水县', '明水', '125.90755', '47.18353', 3, 5, 1),
(231226, 231200, '绥棱县', '绥棱', '127.11112', '47.247196', 3, 8, 1),
(231281, 231200, '安达市', '安达', '125.329926', '46.410614', 3, 1, 1),
(231282, 231200, '肇东市', '肇东', '125.9914', '46.06947', 3, 10, 1),
(231283, 231200, '海伦市', '海伦', '126.96938', '47.460426', 3, 3, 1),
(232700, 230000, '大兴安岭地区', '大兴安岭', '124.711525', '52.335262', 2, 2, 1),
(232702, 232700, '松岭区', '松岭', '124.711525', '52.335262', 3, 5, 1),
(232703, 232700, '新林区', '新林', '124.711525', '52.335262', 3, 7, 1),
(232704, 232700, '呼中区', '呼中', '123.6035', '52.037003', 3, 2, 1),
(232721, 232700, '呼玛县', '呼玛', '126.6621', '51.726997', 3, 1, 1),
(232722, 232700, '塔河县', '塔河', '124.71052', '52.335228', 3, 6, 1),
(232723, 232700, '漠河县', '漠河', '122.536255', '52.972073', 3, 4, 1),
(232724, 232700, '加格达奇区', '加格达奇', '124.12672', '50.424652', 3, 3, 1),
(310000, 0, '上海', '上海', '121.47264', '31.231707', 1, 9, 1),
(310100, 310000, '上海市', '上海', '121.47264', '31.231707', 2, 1, 1),
(310101, 310100, '黄浦区', '黄浦', '121.49032', '31.22277', 3, 7, 1),
(310104, 310100, '徐汇区', '徐汇', '121.43752', '31.179974', 3, 15, 1),
(310105, 310100, '长宁区', '长宁', '121.4222', '31.218122', 3, 2, 1),
(310106, 310100, '静安区', '静安', '121.44823', '31.229004', 3, 9, 1),
(310107, 310100, '普陀区', '普陀', '121.3925', '31.241701', 3, 12, 1),
(310108, 310100, '闸北区', '闸北', '121.46569', '31.25318', 3, 17, 1),
(310109, 310100, '虹口区', '虹口', '121.49183', '31.26097', 3, 6, 1),
(310110, 310100, '杨浦区', '杨浦', '121.5228', '31.270756', 3, 16, 1),
(310112, 310100, '闵行区', '闵行', '121.37597', '31.111658', 3, 11, 1),
(310113, 310100, '宝山区', '宝山', '121.48994', '31.398895', 3, 1, 1),
(310114, 310100, '嘉定区', '嘉定', '121.250336', '31.383524', 3, 8, 1),
(310115, 310100, '浦东新区', '浦东', '121.5677', '31.245943', 3, 4, 1),
(310116, 310100, '金山区', '金山', '121.330734', '30.724697', 3, 10, 1),
(310117, 310100, '松江区', '松江', '121.22354', '31.03047', 3, 14, 1),
(310118, 310100, '青浦区', '青浦', '121.11302', '31.151209', 3, 13, 1),
(310120, 310100, '奉贤区', '奉贤', '121.45847', '30.912346', 3, 5, 1),
(310230, 310100, '崇明县', '崇明', '121.397514', '31.626945', 3, 3, 1),
(320000, 0, '江苏省', '江苏', '118.76741', '32.041546', 1, 10, 1),
(320100, 320000, '南京市', '南京', '118.76741', '32.041546', 2, 4, 1),
(320102, 320100, '玄武区', '玄武', '118.7922', '32.05068', 3, 10, 1),
(320104, 320100, '秦淮区', '秦淮', '118.78609', '32.033817', 3, 1, 1),
(320105, 320100, '建邺区', '建邺', '118.73269', '32.00454', 3, 5, 1),
(320106, 320100, '鼓楼区', '鼓楼', '118.76974', '32.066967', 3, 3, 1),
(320111, 320100, '浦口区', '浦口', '118.625305', '32.05839', 3, 8, 1),
(320113, 320100, '栖霞区', '栖霞', '118.8087', '32.102146', 3, 9, 1),
(320114, 320100, '雨花台区', '雨花台', '118.77207', '31.995947', 3, 11, 1),
(320115, 320100, '江宁区', '江宁', '118.850624', '31.953419', 3, 4, 1),
(320116, 320100, '六合区', '六合', '118.85065', '32.340656', 3, 7, 1),
(320124, 320100, '溧水区', '溧水', '119.02873', '31.65306', 3, 6, 1),
(320125, 320100, '高淳区', '高淳', '118.87589', '31.327131', 3, 2, 1),
(320200, 320000, '无锡市', '无锡', '120.30167', '31.57473', 2, 9, 1),
(320202, 320200, '崇安区', '崇安', '120.30163', '31.574705', 3, 3, 1),
(320203, 320200, '南长区', '南长', '120.30845', '31.563759', 3, 6, 1),
(320204, 320200, '北塘区', '北塘', '120.29516', '31.586575', 3, 1, 1),
(320205, 320200, '锡山区', '锡山', '120.3573', '31.58556', 3, 7, 1),
(320206, 320200, '惠山区', '惠山', '120.30354', '31.681019', 3, 4, 1),
(320211, 320200, '滨湖区', '滨湖', '120.26605', '31.550228', 3, 2, 1),
(320281, 320200, '江阴市', '江阴', '120.275894', '31.910984', 3, 5, 1),
(320282, 320200, '宜兴市', '宜兴', '119.82054', '31.364384', 3, 8, 1),
(320300, 320000, '徐州市', '徐州', '117.184814', '34.26179', 2, 10, 1),
(320302, 320300, '鼓楼区', '鼓楼', '117.19294', '34.269398', 3, 2, 1),
(320303, 320300, '云龙区', '云龙', '117.19459', '34.254807', 3, 10, 1),
(320305, 320300, '贾汪区', '贾汪', '117.45021', '34.441643', 3, 3, 1),
(320311, 320300, '泉山区', '泉山', '117.18223', '34.26225', 3, 7, 1),
(320321, 320300, '丰县', '丰县', '116.59289', '34.696945', 3, 1, 1),
(320322, 320300, '沛县', '沛县', '116.93718', '34.729046', 3, 5, 1),
(320323, 320300, '铜山区', '铜山', '117.18389', '34.19288', 3, 4, 1),
(320324, 320300, '睢宁县', '睢宁', '117.95066', '33.899223', 3, 8, 1),
(320381, 320300, '新沂市', '新沂', '118.345825', '34.36878', 3, 9, 1),
(320382, 320300, '邳州市', '邳州', '117.96392', '34.31471', 3, 6, 1),
(320400, 320000, '常州市', '常州', '119.946976', '31.772753', 2, 1, 1),
(320402, 320400, '天宁区', '天宁', '119.96378', '31.779633', 3, 4, 1),
(320404, 320400, '钟楼区', '钟楼', '119.94839', '31.78096', 3, 7, 1),
(320405, 320400, '戚墅堰区', '戚墅堰', '120.06475', '31.721663', 3, 3, 1),
(320411, 320400, '新北区', '新北', '119.974655', '31.824663', 3, 6, 1),
(320412, 320400, '武进区', '武进', '119.95877', '31.718567', 3, 5, 1),
(320481, 320400, '溧阳市', '溧阳', '119.487816', '31.42708', 3, 2, 1),
(320482, 320400, '金坛市', '金坛', '119.573395', '31.744398', 3, 1, 1),
(320500, 320000, '苏州市', '苏州', '120.61958', '31.29938', 2, 7, 1),
(320505, 320500, '虎丘区', '虎丘', '120.56683', '31.294846', 3, 3, 1),
(320506, 320500, '吴中区', '吴中', '120.62462', '31.27084', 3, 7, 1),
(320507, 320500, '相城区', '相城', '120.61896', '31.396685', 3, 8, 1),
(320508, 320500, '姑苏区', '姑苏', '120.622246', '31.311415', 3, 2, 1),
(320581, 320500, '常熟市', '常熟', '120.74852', '31.658155', 3, 1, 1),
(320582, 320500, '张家港市', '张家港', '120.54344', '31.865553', 3, 9, 1),
(320583, 320500, '昆山市', '昆山', '120.95814', '31.381926', 3, 4, 1),
(320584, 320500, '吴江区', '吴江', '120.6416', '31.160404', 3, 6, 1),
(320585, 320500, '太仓市', '太仓', '121.112274', '31.452568', 3, 5, 1),
(320600, 320000, '南通市', '南通', '120.86461', '32.016212', 2, 5, 1),
(320602, 320600, '崇川区', '崇川', '120.86635', '32.015278', 3, 1, 1),
(320611, 320600, '港闸区', '港闸', '120.8339', '32.0403', 3, 2, 1),
(320612, 320600, '通州区', '通州', '121.07317', '32.084286', 3, 8, 1),
(320621, 320600, '海安县', '海安', '120.465996', '32.54029', 3, 3, 1),
(320623, 320600, '如东县', '如东', '121.18609', '32.311832', 3, 6, 1),
(320681, 320600, '启东市', '启东', '121.65972', '31.810158', 3, 5, 1),
(320682, 320600, '如皋市', '如皋', '120.56632', '32.39159', 3, 7, 1),
(320684, 320600, '海门市', '海门', '121.176605', '31.893528', 3, 4, 1),
(320700, 320000, '连云港市', '连云港', '119.17882', '34.600018', 2, 3, 1),
(320703, 320700, '连云区', '连云', '119.366486', '34.73953', 3, 6, 1),
(320705, 320700, '新浦区', '新浦', '119.182106', '34.597046', 3, 7, 1),
(320706, 320700, '海州区', '海州', '119.137146', '34.57129', 3, 5, 1),
(320721, 320700, '赣榆县', '赣榆', '119.12878', '34.839153', 3, 2, 1),
(320722, 320700, '东海县', '东海', '118.76649', '34.522858', 3, 1, 1),
(320723, 320700, '灌云县', '灌云', '119.25574', '34.298435', 3, 4, 1),
(320724, 320700, '灌南县', '灌南', '119.35233', '34.092552', 3, 3, 1),
(320800, 320000, '淮安市', '淮安', '119.02126', '33.597507', 2, 2, 1),
(320802, 320800, '清河区', '清河', '119.019455', '33.603233', 3, 6, 1),
(320803, 320800, '淮安区', '淮安', '119.14634', '33.5075', 3, 2, 1),
(320804, 320800, '淮阴区', '淮阴', '119.02082', '33.62245', 3, 3, 1),
(320811, 320800, '清浦区', '清浦', '119.030495', '33.58074', 3, 7, 1),
(320826, 320800, '涟水县', '涟水', '119.266075', '33.77131', 3, 5, 1),
(320829, 320800, '洪泽县', '洪泽', '118.867874', '33.294975', 3, 1, 1),
(320830, 320800, '盱眙县', '盱眙', '118.49382', '33.00439', 3, 8, 1),
(320831, 320800, '金湖县', '金湖', '119.01694', '33.01816', 3, 4, 1),
(320900, 320000, '盐城市', '盐城', '120.14', '33.377632', 2, 11, 1),
(320902, 320900, '亭湖区', '亭湖', '120.13608', '33.38391', 3, 7, 1),
(320903, 320900, '盐都区', '盐都', '120.139755', '33.34129', 3, 9, 1),
(320921, 320900, '响水县', '响水', '119.579575', '34.19996', 3, 8, 1),
(320922, 320900, '滨海县', '滨海', '119.82844', '33.989887', 3, 1, 1),
(320923, 320900, '阜宁县', '阜宁', '119.805336', '33.78573', 3, 4, 1),
(320924, 320900, '射阳县', '射阳', '120.25745', '33.77378', 3, 6, 1),
(320925, 320900, '建湖县', '建湖', '119.793106', '33.472622', 3, 5, 1),
(320981, 320900, '东台市', '东台', '120.3141', '32.853172', 3, 3, 1),
(320982, 320900, '大丰市', '大丰', '120.47032', '33.19953', 3, 2, 1),
(321000, 320000, '扬州市', '扬州', '119.421005', '32.393158', 2, 12, 1),
(321002, 321000, '广陵区', '广陵', '119.44227', '32.392155', 3, 3, 1),
(321003, 321000, '邗江区', '邗江', '119.39777', '32.3779', 3, 4, 1),
(321023, 321000, '宝应县', '宝应', '119.32128', '33.23694', 3, 1, 1),
(321081, 321000, '仪征市', '仪征', '119.18244', '32.271965', 3, 6, 1),
(321084, 321000, '高邮市', '高邮', '119.44384', '32.785164', 3, 2, 1),
(321088, 321000, '江都区', '江都', '119.56748', '32.426563', 3, 5, 1),
(321100, 320000, '镇江市', '镇江', '119.45275', '32.204403', 2, 13, 1),
(321102, 321100, '京口区', '京口', '119.454575', '32.206192', 3, 3, 1),
(321111, 321100, '润州区', '润州', '119.41488', '32.2135', 3, 5, 1),
(321112, 321100, '丹徒区', '丹徒', '119.43388', '32.12897', 3, 1, 1),
(321181, 321100, '丹阳市', '丹阳', '119.58191', '31.991459', 3, 2, 1),
(321182, 321100, '扬中市', '扬中', '119.82806', '32.237267', 3, 6, 1),
(321183, 321100, '句容市', '句容', '119.16714', '31.947355', 3, 4, 1),
(321200, 320000, '泰州市', '泰州', '119.91518', '32.484882', 2, 8, 1),
(321202, 321200, '海陵区', '海陵', '119.92019', '32.488407', 3, 2, 1),
(321203, 321200, '高港区', '高港', '119.88166', '32.3157', 3, 1, 1),
(321281, 321200, '兴化市', '兴化', '119.840164', '32.938065', 3, 6, 1),
(321282, 321200, '靖江市', '靖江', '120.26825', '32.01817', 3, 4, 1),
(321283, 321200, '泰兴市', '泰兴', '120.020226', '32.168785', 3, 5, 1),
(321284, 321200, '姜堰区', '姜堰', '120.14821', '32.508484', 3, 3, 1),
(321300, 320000, '宿迁市', '宿迁', '118.27516', '33.96301', 2, 6, 1),
(321302, 321300, '宿城区', '宿城', '118.278984', '33.937725', 3, 4, 1),
(321311, 321300, '宿豫区', '宿豫', '118.33001', '33.94107', 3, 5, 1),
(321322, 321300, '沭阳县', '沭阳', '118.77589', '34.129097', 3, 1, 1),
(321323, 321300, '泗阳县', '泗阳', '118.68128', '33.711433', 3, 3, 1),
(321324, 321300, '泗洪县', '泗洪', '118.21182', '33.45654', 3, 2, 1),
(330000, 0, '浙江省', '浙江', '120.15358', '30.287458', 1, 11, 1),
(330100, 330000, '杭州市', '杭州', '120.15358', '30.287458', 2, 1, 1),
(330102, 330100, '上城区', '上城', '120.17146', '30.250237', 3, 8, 1),
(330103, 330100, '下城区', '下城', '120.17276', '30.276272', 3, 10, 1),
(330104, 330100, '江干区', '江干', '120.20264', '30.266603', 3, 6, 1),
(330105, 330100, '拱墅区', '拱墅', '120.150055', '30.314697', 3, 4, 1),
(330106, 330100, '西湖区', '西湖', '120.14738', '30.272934', 3, 12, 1),
(330108, 330100, '滨江区', '滨江', '120.21062', '30.206615', 3, 1, 1),
(330109, 330100, '萧山区', '萧山', '120.27069', '30.162931', 3, 11, 1),
(330110, 330100, '余杭区', '余杭', '120.301735', '30.421186', 3, 13, 1),
(330122, 330100, '桐庐县', '桐庐', '119.68504', '29.797438', 3, 9, 1),
(330127, 330100, '淳安县', '淳安', '119.04427', '29.604177', 3, 2, 1),
(330182, 330100, '建德市', '建德', '119.27909', '29.472284', 3, 5, 1),
(330183, 330100, '富阳市', '富阳', '119.94987', '30.049871', 3, 3, 1),
(330185, 330100, '临安市', '临安', '119.7151', '30.231153', 3, 7, 1),
(330200, 330000, '宁波市', '宁波', '121.54979', '29.868387', 2, 6, 1),
(330203, 330200, '海曙区', '海曙', '121.539696', '29.874453', 3, 4, 1),
(330204, 330200, '江东区', '江东', '121.57299', '29.866543', 3, 6, 1),
(330205, 330200, '江北区', '江北', '121.55928', '29.888361', 3, 5, 1),
(330206, 330200, '北仑区', '北仑', '121.83131', '29.90944', 3, 1, 1),
(330211, 330200, '镇海区', '镇海', '121.713165', '29.952106', 3, 11, 1),
(330212, 330200, '鄞州区', '鄞州', '121.55843', '29.831661', 3, 9, 1),
(330225, 330200, '象山县', '象山', '121.87709', '29.470205', 3, 8, 1),
(330226, 330200, '宁海县', '宁海', '121.43261', '29.299835', 3, 7, 1),
(330281, 330200, '余姚市', '余姚', '121.156296', '30.045404', 3, 10, 1),
(330282, 330200, '慈溪市', '慈溪', '121.248055', '30.177141', 3, 2, 1),
(330283, 330200, '奉化市', '奉化', '121.41089', '29.662348', 3, 3, 1),
(330300, 330000, '温州市', '温州', '120.67211', '28.000574', 2, 10, 1),
(330302, 330300, '鹿城区', '鹿城', '120.67423', '28.003351', 3, 4, 1),
(330303, 330300, '龙湾区', '龙湾', '120.763466', '27.970255', 3, 3, 1),
(330304, 330300, '瓯海区', '瓯海', '120.637146', '28.006445', 3, 5, 1),
(330322, 330300, '洞头县', '洞头', '121.15618', '27.836058', 3, 2, 1),
(330324, 330300, '永嘉县', '永嘉', '120.69097', '28.153887', 3, 10, 1),
(330326, 330300, '平阳县', '平阳', '120.564384', '27.6693', 3, 6, 1),
(330327, 330300, '苍南县', '苍南', '120.40626', '27.507744', 3, 1, 1),
(330328, 330300, '文成县', '文成', '120.09245', '27.789133', 3, 9, 1),
(330329, 330300, '泰顺县', '泰顺', '119.71624', '27.557308', 3, 8, 1),
(330381, 330300, '瑞安市', '瑞安', '120.64617', '27.779322', 3, 7, 1),
(330382, 330300, '乐清市', '乐清', '120.96715', '28.116083', 3, 11, 1),
(330400, 330000, '嘉兴市', '嘉兴', '120.75086', '30.762653', 2, 3, 1),
(330402, 330400, '南湖区', '南湖', '120.749954', '30.764652', 3, 4, 1),
(330411, 330400, '秀洲区', '秀洲', '120.72043', '30.763323', 3, 7, 1),
(330421, 330400, '嘉善县', '嘉善', '120.92187', '30.841352', 3, 3, 1),
(330424, 330400, '海盐县', '海盐', '120.94202', '30.522223', 3, 2, 1),
(330481, 330400, '海宁市', '海宁', '120.68882', '30.525543', 3, 1, 1),
(330482, 330400, '平湖市', '平湖', '121.01466', '30.698921', 3, 5, 1),
(330483, 330400, '桐乡市', '桐乡', '120.55109', '30.629065', 3, 6, 1),
(330500, 330000, '湖州市', '湖州', '120.1024', '30.867199', 2, 2, 1),
(330502, 330500, '吴兴区', '吴兴', '120.10142', '30.867252', 3, 5, 1),
(330503, 330500, '南浔区', '南浔', '120.4172', '30.872742', 3, 4, 1),
(330521, 330500, '德清县', '德清', '119.96766', '30.534927', 3, 3, 1),
(330522, 330500, '长兴县', '长兴', '119.910126', '31.00475', 3, 2, 1),
(330523, 330500, '安吉县', '安吉', '119.68789', '30.631973', 3, 1, 1),
(330600, 330000, '绍兴市', '绍兴', '120.582115', '29.997116', 2, 8, 1),
(330602, 330600, '越城区', '越城', '120.58531', '29.996992', 3, 5, 1),
(330621, 330600, '绍兴县', '绍兴', '120.582115', '29.997116', 3, 2, 1),
(330624, 330600, '新昌县', '新昌', '120.90566', '29.501205', 3, 4, 1),
(330681, 330600, '诸暨市', '诸暨', '120.24432', '29.713661', 3, 6, 1),
(330682, 330600, '上虞市', '上虞', '120.582115', '29.997116', 3, 1, 1),
(330683, 330600, '嵊州市', '嵊州', '120.82888', '29.586605', 3, 3, 1),
(330700, 330000, '金华市', '金华', '119.649506', '29.089523', 2, 4, 1),
(330702, 330700, '婺城区', '婺城', '119.65258', '29.082607', 3, 6, 1),
(330703, 330700, '金东区', '金东', '119.68127', '29.095835', 3, 2, 1),
(330723, 330700, '武义县', '武义', '119.81916', '28.896563', 3, 7, 1),
(330726, 330700, '浦江县', '浦江', '119.893364', '29.451254', 3, 5, 1),
(330727, 330700, '磐安县', '磐安', '120.44513', '29.052628', 3, 4, 1),
(330781, 330700, '兰溪市', '兰溪', '119.46052', '29.210066', 3, 3, 1),
(330782, 330700, '义乌市', '义乌', '120.07491', '29.306864', 3, 8, 1),
(330783, 330700, '东阳市', '东阳', '120.23334', '29.262547', 3, 1, 1),
(330784, 330700, '永康市', '永康', '120.03633', '28.895292', 3, 9, 1),
(330800, 330000, '衢州市', '衢州', '118.87263', '28.941708', 2, 7, 1),
(330802, 330800, '柯城区', '柯城', '118.87304', '28.944538', 3, 4, 1),
(330803, 330800, '衢江区', '衢江', '118.95768', '28.973194', 3, 6, 1),
(330822, 330800, '常山县', '常山', '118.52165', '28.90004', 3, 1, 1),
(330824, 330800, '开化县', '开化', '118.41444', '29.136503', 3, 3, 1),
(330825, 330800, '龙游县', '龙游', '119.17252', '29.031364', 3, 5, 1),
(330881, 330800, '江山市', '江山', '118.62788', '28.734674', 3, 2, 1),
(330900, 330000, '舟山市', '舟山', '122.106865', '30.016027', 2, 11, 1),
(330902, 330900, '定海区', '定海', '122.1085', '30.016422', 3, 2, 1),
(330903, 330900, '普陀区', '普陀', '122.301956', '29.945614', 3, 3, 1),
(330921, 330900, '岱山县', '岱山', '122.20113', '30.242865', 3, 1, 1),
(330922, 330900, '嵊泗县', '嵊泗', '122.45781', '30.727165', 3, 4, 1),
(331000, 330000, '台州市', '台州', '121.4286', '28.661379', 2, 9, 1),
(331002, 331000, '椒江区', '椒江', '121.431046', '28.67615', 3, 2, 1),
(331003, 331000, '黄岩区', '黄岩', '121.26214', '28.64488', 3, 1, 1),
(331004, 331000, '路桥区', '路桥', '121.37292', '28.581799', 3, 4, 1),
(331021, 331000, '玉环县', '玉环', '121.23234', '28.12842', 3, 9, 1),
(331022, 331000, '三门县', '三门', '121.37643', '29.118956', 3, 5, 1),
(331023, 331000, '天台县', '天台', '121.03123', '29.141127', 3, 6, 1),
(331024, 331000, '仙居县', '仙居', '120.73508', '28.849213', 3, 8, 1),
(331081, 331000, '温岭市', '温岭', '121.37361', '28.36878', 3, 7, 1),
(331082, 331000, '临海市', '临海', '121.131226', '28.845442', 3, 3, 1),
(331100, 330000, '丽水市', '丽水', '119.92178', '28.451994', 2, 5, 1),
(331102, 331100, '莲都区', '莲都', '119.922295', '28.451103', 3, 3, 1),
(331121, 331100, '青田县', '青田', '120.29194', '28.135246', 3, 5, 1),
(331122, 331100, '缙云县', '缙云', '120.078964', '28.654207', 3, 2, 1),
(331123, 331100, '遂昌县', '遂昌', '119.27589', '28.5924', 3, 8, 1),
(331124, 331100, '松阳县', '松阳', '119.48529', '28.449938', 3, 7, 1),
(331125, 331100, '云和县', '云和', '119.56946', '28.111076', 3, 9, 1),
(331126, 331100, '庆元县', '庆元', '119.06723', '27.61823', 3, 6, 1),
(331127, 331100, '景宁畲族自治县', '景宁', '119.63467', '27.977247', 3, 1, 1),
(331181, 331100, '龙泉市', '龙泉', '119.13232', '28.069178', 3, 4, 1),
(340000, 0, '安徽省', '安徽', '117.28304', '31.86119', 1, 12, 1),
(340100, 340000, '合肥市', '合肥', '117.28304', '31.86119', 2, 7, 1),
(340102, 340100, '瑶海区', '瑶海', '117.31536', '31.86961', 3, 9, 1),
(340103, 340100, '庐阳区', '庐阳', '117.283775', '31.86901', 3, 7, 1),
(340104, 340100, '蜀山区', '蜀山', '117.26207', '31.855867', 3, 8, 1),
(340111, 340100, '包河区', '包河', '117.28575', '31.82956', 3, 1, 1),
(340121, 340100, '长丰县', '长丰', '117.164696', '32.478546', 3, 2, 1),
(340122, 340100, '肥东县', '肥东', '117.46322', '31.883991', 3, 4, 1),
(340123, 340100, '肥西县', '肥西', '117.166115', '31.719646', 3, 5, 1),
(340200, 340000, '芜湖市', '芜湖', '118.37645', '31.326319', 2, 15, 1),
(340202, 340200, '镜湖区', '镜湖', '118.37634', '31.32559', 3, 2, 1),
(340203, 340200, '弋江区', '弋江', '118.37748', '31.313395', 3, 8, 1),
(340207, 340200, '鸠江区', '鸠江', '118.40018', '31.362717', 3, 3, 1),
(340208, 340200, '三山区', '三山', '118.233986', '31.225424', 3, 5, 1),
(340221, 340200, '芜湖县', '芜湖', '118.5723', '31.145262', 3, 6, 1),
(340222, 340200, '繁昌县', '繁昌', '118.20135', '31.080896', 3, 1, 1),
(340223, 340200, '南陵县', '南陵', '118.337105', '30.919638', 3, 4, 1),
(340300, 340000, '蚌埠市', '蚌埠', '117.36323', '32.939667', 2, 2, 1),
(340302, 340300, '龙子湖区', '龙子湖', '117.38231', '32.95045', 3, 5, 1),
(340303, 340300, '蚌山区', '蚌山', '117.35579', '32.938065', 3, 1, 1),
(340304, 340300, '禹会区', '禹会', '117.35259', '32.931934', 3, 7, 1),
(340311, 340300, '淮上区', '淮上', '117.34709', '32.963146', 3, 3, 1),
(340321, 340300, '怀远县', '怀远', '117.20017', '32.956936', 3, 4, 1),
(340322, 340300, '五河县', '五河', '117.88881', '33.146202', 3, 6, 1),
(340323, 340300, '固镇县', '固镇', '117.31596', '33.31868', 3, 2, 1),
(340400, 340000, '淮南市', '淮南', '117.018326', '32.647575', 2, 9, 1),
(340402, 340400, '大通区', '大通', '117.052925', '32.632065', 3, 2, 1),
(340403, 340400, '田家庵区', '田家庵', '117.01832', '32.64434', 3, 5, 1),
(340404, 340400, '谢家集区', '谢家集', '116.86536', '32.59829', 3, 6, 1),
(340405, 340400, '八公山区', '八公山', '116.84111', '32.628227', 3, 1, 1),
(340406, 340400, '潘集区', '潘集', '116.81688', '32.782116', 3, 4, 1),
(340421, 340400, '凤台县', '凤台', '116.72277', '32.705383', 3, 3, 1),
(340500, 340000, '马鞍山市', '马鞍山', '118.507904', '31.689362', 2, 12, 1),
(340503, 340500, '花山区', '花山', '118.51131', '31.69902', 3, 5, 1),
(340504, 340500, '雨山区', '雨山', '118.4931', '31.685911', 3, 6, 1),
(340506, 340500, '博望区', '博望', '118.84374', '31.56232', 3, 1, 1),
(340521, 340500, '当涂县', '当涂', '118.489876', '31.556168', 3, 2, 1),
(340600, 340000, '淮北市', '淮北', '116.79466', '33.971706', 2, 8, 1),
(340602, 340600, '杜集区', '杜集', '116.83392', '33.99122', 3, 1, 1),
(340603, 340600, '相山区', '相山', '116.79077', '33.970917', 3, 4, 1),
(340604, 340600, '烈山区', '烈山', '116.80946', '33.88953', 3, 2, 1),
(340621, 340600, '濉溪县', '濉溪', '116.76743', '33.91641', 3, 3, 1),
(340700, 340000, '铜陵市', '铜陵', '117.816574', '30.929935', 2, 14, 1),
(340702, 340700, '铜官山区', '铜官山', '117.81843', '30.93182', 3, 3, 1),
(340703, 340700, '狮子山区', '狮子山', '117.8641', '30.946249', 3, 2, 1),
(340711, 340700, '郊区', '郊区', '117.816574', '30.929935', 3, 1, 1),
(340721, 340700, '铜陵县', '铜陵', '117.79229', '30.952337', 3, 4, 1),
(340800, 340000, '安庆市', '安庆', '117.04355', '30.50883', 2, 1, 1),
(340802, 340800, '迎江区', '迎江', '117.04497', '30.506374', 3, 8, 1),
(340803, 340800, '大观区', '大观', '117.034515', '30.505632', 3, 1, 1),
(340811, 340800, '宜秀区', '宜秀', '117.07', '30.541323', 3, 9, 1),
(340822, 340800, '怀宁县', '怀宁', '116.82867', '30.734995', 3, 2, 1),
(340823, 340800, '枞阳县', '枞阳', '117.22203', '30.700615', 3, 11, 1),
(340824, 340800, '潜山县', '潜山', '116.57367', '30.638222', 3, 3, 1),
(340825, 340800, '太湖县', '太湖', '116.30522', '30.451868', 3, 5, 1),
(340826, 340800, '宿松县', '宿松', '116.1202', '30.158327', 3, 4, 1),
(340827, 340800, '望江县', '望江', '116.690926', '30.12491', 3, 7, 1),
(340828, 340800, '岳西县', '岳西', '116.36048', '30.848501', 3, 10, 1),
(340881, 340800, '桐城市', '桐城', '116.959656', '31.050575', 3, 6, 1),
(341000, 340000, '黄山市', '黄山', '118.31732', '29.709238', 2, 10, 1),
(341002, 341000, '屯溪区', '屯溪', '118.31735', '29.709187', 3, 5, 1),
(341003, 341000, '黄山区', '黄山', '118.13664', '30.294518', 3, 1, 1),
(341004, 341000, '徽州区', '徽州', '118.339745', '29.825201', 3, 2, 1),
(341021, 341000, '歙县', '歙县', '118.428024', '29.867748', 3, 4, 1),
(341022, 341000, '休宁县', '休宁', '118.18853', '29.788877', 3, 6, 1),
(341023, 341000, '黟县', '黟县', '117.94291', '29.923813', 3, 7, 1),
(341024, 341000, '祁门县', '祁门', '117.71724', '29.853472', 3, 3, 1),
(341100, 340000, '滁州市', '滁州', '118.31626', '32.303627', 2, 5, 1),
(341102, 341100, '琅琊区', '琅琊', '118.316475', '32.3038', 3, 4, 1),
(341103, 341100, '南谯区', '南谯', '118.29695', '32.32984', 3, 6, 1),
(341122, 341100, '来安县', '来安', '118.4333', '32.45023', 3, 3, 1),
(341124, 341100, '全椒县', '全椒', '118.26858', '32.09385', 3, 7, 1),
(341125, 341100, '定远县', '定远', '117.683716', '32.527103', 3, 1, 1),
(341126, 341100, '凤阳县', '凤阳', '117.56246', '32.867146', 3, 2, 1),
(341181, 341100, '天长市', '天长', '119.011215', '32.6815', 3, 8, 1),
(341182, 341100, '明光市', '明光', '117.99805', '32.781204', 3, 5, 1),
(341200, 340000, '阜阳市', '阜阳', '115.81973', '32.89697', 2, 6, 1),
(341202, 341200, '颍州区', '颍州', '115.81391', '32.89124', 3, 8, 1),
(341203, 341200, '颍东区', '颍东', '115.85875', '32.90886', 3, 5, 1),
(341204, 341200, '颍泉区', '颍泉', '115.80453', '32.924797', 3, 6, 1),
(341221, 341200, '临泉县', '临泉', '115.26169', '33.0627', 3, 3, 1),
(341222, 341200, '太和县', '太和', '115.62724', '33.16229', 3, 4, 1),
(341225, 341200, '阜南县', '阜南', '115.59053', '32.638103', 3, 1, 1),
(341226, 341200, '颍上县', '颍上', '116.259125', '32.637066', 3, 7, 1),
(341282, 341200, '界首市', '界首', '115.362114', '33.26153', 3, 2, 1),
(341300, 340000, '宿州市', '宿州', '116.984085', '33.633892', 2, 13, 1),
(341302, 341300, '埇桥区', '埇桥', '116.98331', '33.633854', 3, 5, 1),
(341321, 341300, '砀山县', '砀山', '116.35111', '34.426247', 3, 1, 1),
(341322, 341300, '萧县', '萧县', '116.9454', '34.183266', 3, 4, 1),
(341323, 341300, '灵璧县', '灵璧', '117.55149', '33.54063', 3, 2, 1),
(341324, 341300, '泗县', '泗县', '117.885445', '33.47758', 3, 3, 1),
(341400, 340100, '巢湖市', '巢湖', '117.87415', '31.600517', 3, 3, 1),
(341421, 340100, '庐江县', '庐江', '117.28984', '31.251488', 3, 6, 1),
(341422, 340200, '无为县', '无为', '117.91143', '31.303076', 3, 7, 1),
(341423, 340500, '含山县', '含山', '118.105545', '31.727758', 3, 3, 1),
(341424, 340500, '和县', '和县', '118.363', '31.716635', 3, 4, 1),
(341500, 340000, '六安市', '六安', '116.507675', '31.75289', 2, 11, 1),
(341502, 341500, '金安区', '金安', '116.50329', '31.754492', 3, 3, 1),
(341503, 341500, '裕安区', '裕安', '116.494545', '31.750692', 3, 7, 1),
(341521, 341500, '寿县', '寿县', '116.78535', '32.577305', 3, 5, 1),
(341522, 341500, '霍邱县', '霍邱', '116.27888', '32.341305', 3, 1, 1),
(341523, 341500, '舒城县', '舒城', '116.94409', '31.462849', 3, 6, 1),
(341524, 341500, '金寨县', '金寨', '115.87852', '31.681623', 3, 4, 1),
(341525, 341500, '霍山县', '霍山', '116.33308', '31.402456', 3, 2, 1),
(341600, 340000, '亳州市', '亳州', '115.782936', '33.86934', 2, 3, 1),
(341602, 341600, '谯城区', '谯城', '115.78121', '33.869286', 3, 4, 1),
(341621, 341600, '涡阳县', '涡阳', '116.21155', '33.50283', 3, 1, 1),
(341622, 341600, '蒙城县', '蒙城', '116.56033', '33.260815', 3, 3, 1),
(341623, 341600, '利辛县', '利辛', '116.20778', '33.1435', 3, 2, 1),
(341700, 340000, '池州市', '池州', '117.48916', '30.656036', 2, 4, 1),
(341702, 341700, '贵池区', '贵池', '117.48834', '30.657377', 3, 2, 1),
(341721, 341700, '东至县', '东至', '117.02148', '30.096567', 3, 1, 1),
(341722, 341700, '石台县', '石台', '117.48291', '30.210323', 3, 4, 1),
(341723, 341700, '青阳县', '青阳', '117.85739', '30.63818', 3, 3, 1),
(341800, 340000, '宣城市', '宣城', '118.757996', '30.945667', 2, 16, 1),
(341802, 341800, '宣州区', '宣州', '118.758415', '30.946003', 3, 7, 1),
(341821, 341800, '郎溪县', '郎溪', '119.18502', '31.127834', 3, 5, 1),
(341822, 341800, '广德县', '广德', '119.41752', '30.893116', 3, 1, 1),
(341823, 341800, '泾县', '泾县', '118.4124', '30.685974', 3, 3, 1),
(341824, 341800, '绩溪县', '绩溪', '118.5947', '30.065268', 3, 4, 1),
(341825, 341800, '旌德县', '旌德', '118.54308', '30.288057', 3, 2, 1),
(341881, 341800, '宁国市', '宁国', '118.983406', '30.62653', 3, 6, 1),
(350000, 0, '福建省', '福建', '119.30624', '26.075302', 1, 13, 1),
(350100, 350000, '福州市', '福州', '119.30624', '26.075302', 2, 1, 1),
(350102, 350100, '鼓楼区', '鼓楼', '119.29929', '26.082285', 3, 4, 1),
(350103, 350100, '台江区', '台江', '119.31016', '26.058617', 3, 12, 1),
(350104, 350100, '仓山区', '仓山', '119.32099', '26.038912', 3, 1, 1),
(350105, 350100, '马尾区', '马尾', '119.458725', '25.991976', 3, 8, 1),
(350111, 350100, '晋安区', '晋安', '119.3286', '26.078836', 3, 5, 1),
(350121, 350100, '闽侯县', '闽侯', '119.14512', '26.148567', 3, 9, 1),
(350122, 350100, '连江县', '连江', '119.53837', '26.202108', 3, 6, 1),
(350123, 350100, '罗源县', '罗源', '119.55264', '26.487234', 3, 7, 1),
(350124, 350100, '闽清县', '闽清', '118.868416', '26.223793', 3, 10, 1),
(350125, 350100, '永泰县', '永泰', '118.93909', '25.864824', 3, 13, 1),
(350128, 350100, '平潭县', '平潭', '119.7912', '25.503672', 3, 11, 1),
(350181, 350100, '福清市', '福清', '119.37699', '25.720402', 3, 3, 1),
(350182, 350100, '长乐市', '长乐', '119.51085', '25.960583', 3, 2, 1),
(350200, 350000, '厦门市', '厦门', '118.11022', '24.490475', 2, 8, 1),
(350203, 350200, '思明区', '思明', '118.08783', '24.462059', 3, 4, 1),
(350205, 350200, '海沧区', '海沧', '118.03636', '24.492512', 3, 1, 1),
(350206, 350200, '湖里区', '湖里', '118.10943', '24.512764', 3, 2, 1),
(350211, 350200, '集美区', '集美', '118.10087', '24.572874', 3, 3, 1),
(350212, 350200, '同安区', '同安', '118.15045', '24.729334', 3, 5, 1),
(350213, 350200, '翔安区', '翔安', '118.24281', '24.63748', 3, 6, 1),
(350300, 350000, '莆田市', '莆田', '119.00756', '25.431011', 2, 5, 1),
(350302, 350300, '城厢区', '城厢', '119.00103', '25.433737', 3, 1, 1),
(350303, 350300, '涵江区', '涵江', '119.1191', '25.459272', 3, 2, 1),
(350304, 350300, '荔城区', '荔城', '119.02005', '25.430046', 3, 3, 1),
(350305, 350300, '秀屿区', '秀屿', '119.092606', '25.316141', 3, 5, 1),
(350322, 350300, '仙游县', '仙游', '118.69433', '25.35653', 3, 4, 1),
(350400, 350000, '三明市', '三明', '117.635', '26.265444', 2, 7, 1),
(350402, 350400, '梅列区', '梅列', '117.63687', '26.269209', 3, 4, 1),
(350403, 350400, '三元区', '三元', '117.607414', '26.234192', 3, 8, 1),
(350421, 350400, '明溪县', '明溪', '117.20184', '26.357374', 3, 5, 1),
(350423, 350400, '清流县', '清流', '116.81582', '26.17761', 3, 7, 1),
(350424, 350400, '宁化县', '宁化', '116.65972', '26.259932', 3, 6, 1),
(350425, 350400, '大田县', '大田', '117.84936', '25.690804', 3, 1, 1),
(350426, 350400, '尤溪县', '尤溪', '118.188576', '26.169262', 3, 12, 1),
(350427, 350400, '沙县', '沙县', '117.78909', '26.397362', 3, 9, 1),
(350428, 350400, '将乐县', '将乐', '117.47356', '26.728666', 3, 2, 1),
(350429, 350400, '泰宁县', '泰宁', '117.17752', '26.897995', 3, 10, 1),
(350430, 350400, '建宁县', '建宁', '116.84583', '26.831398', 3, 3, 1),
(350481, 350400, '永安市', '永安', '117.36445', '25.974075', 3, 11, 1),
(350500, 350000, '泉州市', '泉州', '118.589424', '24.908854', 2, 6, 1),
(350502, 350500, '鲤城区', '鲤城', '118.58893', '24.907644', 3, 7, 1),
(350503, 350500, '丰泽区', '丰泽', '118.60515', '24.896042', 3, 3, 1),
(350504, 350500, '洛江区', '洛江', '118.67031', '24.941153', 3, 8, 1),
(350505, 350500, '泉港区', '泉港', '118.912285', '25.12686', 3, 10, 1),
(350521, 350500, '惠安县', '惠安', '118.79895', '25.028719', 3, 4, 1),
(350524, 350500, '安溪县', '安溪', '118.18601', '25.056824', 3, 1, 1),
(350525, 350500, '永春县', '永春', '118.29503', '25.32072', 3, 12, 1),
(350526, 350500, '德化县', '德化', '118.24299', '25.489004', 3, 2, 1),
(350527, 350500, '金门县', '金门', '118.32322', '24.436417', 3, 6, 1),
(350581, 350500, '石狮市', '石狮', '118.6284', '24.731977', 3, 11, 1),
(350582, 350500, '晋江市', '晋江', '118.57734', '24.807322', 3, 5, 1),
(350583, 350500, '南安市', '南安', '118.38703', '24.959494', 3, 9, 1),
(350600, 350000, '漳州市', '漳州', '117.661804', '24.510897', 2, 9, 1),
(350602, 350600, '芗城区', '芗城', '117.65646', '24.509954', 3, 8, 1),
(350603, 350600, '龙文区', '龙文', '117.67139', '24.515656', 3, 5, 1),
(350622, 350600, '云霄县', '云霄', '117.34094', '23.950485', 3, 9, 1),
(350623, 350600, '漳浦县', '漳浦', '117.61402', '24.117907', 3, 10, 1),
(350624, 350600, '诏安县', '诏安', '117.17609', '23.710835', 3, 11, 1),
(350625, 350600, '长泰县', '长泰', '117.75591', '24.621475', 3, 1, 1),
(350626, 350600, '东山县', '东山', '117.42768', '23.702845', 3, 2, 1),
(350627, 350600, '南靖县', '南靖', '117.36546', '24.516424', 3, 6, 1),
(350628, 350600, '平和县', '平和', '117.313545', '24.366158', 3, 7, 1),
(350629, 350600, '华安县', '华安', '117.53631', '25.001415', 3, 3, 1),
(350681, 350600, '龙海市', '龙海', '117.81729', '24.445341', 3, 4, 1),
(350700, 350000, '南平市', '南平', '118.17846', '26.635628', 2, 3, 1),
(350702, 350700, '延平区', '延平', '118.17892', '26.63608', 3, 9, 1),
(350721, 350700, '顺昌县', '顺昌', '117.80771', '26.79285', 3, 6, 1),
(350722, 350700, '浦城县', '浦城', '118.53682', '27.920412', 3, 4, 1),
(350723, 350700, '光泽县', '光泽', '117.3379', '27.542803', 3, 1, 1),
(350724, 350700, '松溪县', '松溪', '118.78349', '27.525785', 3, 7, 1),
(350725, 350700, '政和县', '政和', '118.85866', '27.365398', 3, 10, 1),
(350781, 350700, '邵武市', '邵武', '117.49155', '27.337952', 3, 5, 1),
(350782, 350700, '武夷山市', '武夷山', '118.0328', '27.751734', 3, 8, 1),
(350783, 350700, '建瓯市', '建瓯', '118.32176', '27.03502', 3, 2, 1),
(350784, 350700, '建阳市', '建阳', '118.12267', '27.332067', 3, 3, 1),
(350800, 350000, '龙岩市', '龙岩', '117.02978', '25.091602', 2, 2, 1),
(350802, 350800, '新罗区', '新罗', '117.03072', '25.0918', 3, 5, 1),
(350821, 350800, '长汀县', '长汀', '116.36101', '25.842278', 3, 1, 1),
(350822, 350800, '永定县', '永定', '116.73269', '24.720442', 3, 6, 1),
(350823, 350800, '上杭县', '上杭', '116.424774', '25.050018', 3, 3, 1),
(350824, 350800, '武平县', '武平', '116.10093', '25.08865', 3, 4, 1),
(350825, 350800, '连城县', '连城', '116.75668', '25.708506', 3, 2, 1),
(350881, 350800, '漳平市', '漳平', '117.42073', '25.291597', 3, 7, 1),
(350900, 350000, '宁德市', '宁德', '119.527084', '26.65924', 2, 4, 1),
(350902, 350900, '蕉城区', '蕉城', '119.52722', '26.659252', 3, 4, 1),
(350921, 350900, '霞浦县', '霞浦', '120.00521', '26.882069', 3, 7, 1),
(350922, 350900, '古田县', '古田', '118.74316', '26.577492', 3, 3, 1),
(350923, 350900, '屏南县', '屏南', '118.98754', '26.910826', 3, 5, 1),
(350924, 350900, '寿宁县', '寿宁', '119.50674', '27.457798', 3, 6, 1),
(350925, 350900, '周宁县', '周宁', '119.33824', '27.103106', 3, 9, 1),
(350926, 350900, '柘荣县', '柘荣', '119.898224', '27.236162', 3, 8, 1),
(350981, 350900, '福安市', '福安', '119.650795', '27.084246', 3, 1, 1),
(350982, 350900, '福鼎市', '福鼎', '120.219765', '27.318884', 3, 2, 1),
(360000, 0, '江西省', '江西', '115.89215', '28.676493', 1, 14, 1),
(360100, 360000, '南昌市', '南昌', '115.89215', '28.676493', 2, 6, 1),
(360102, 360100, '东湖区', '东湖', '115.88967', '28.682987', 3, 2, 1),
(360103, 360100, '西湖区', '西湖', '115.91065', '28.6629', 3, 8, 1),
(360104, 360100, '青云谱区', '青云谱', '115.907295', '28.635723', 3, 6, 1),
(360105, 360100, '湾里区', '湾里', '115.73132', '28.714804', 3, 7, 1),
(360111, 360100, '青山湖区', '青山湖', '115.94904', '28.689293', 3, 5, 1),
(360121, 360100, '南昌县', '南昌', '115.94247', '28.543781', 3, 4, 1),
(360122, 360100, '新建县', '新建', '115.82081', '28.690788', 3, 9, 1),
(360123, 360100, '安义县', '安义', '115.55311', '28.841333', 3, 1, 1),
(360124, 360100, '进贤县', '进贤', '116.26767', '28.36568', 3, 3, 1),
(360200, 360000, '景德镇市', '景德镇', '117.21466', '29.29256', 2, 4, 1),
(360202, 360200, '昌江区', '昌江', '117.19502', '29.288465', 3, 1, 1),
(360203, 360200, '珠山区', '珠山', '117.21481', '29.292812', 3, 4, 1),
(360222, 360200, '浮梁县', '浮梁', '117.21761', '29.352251', 3, 2, 1),
(360281, 360200, '乐平市', '乐平', '117.12938', '28.967361', 3, 3, 1),
(360300, 360000, '萍乡市', '萍乡', '113.85219', '27.622946', 2, 7, 1),
(360302, 360300, '安源区', '安源', '113.85504', '27.625826', 3, 1, 1),
(360313, 360300, '湘东区', '湘东', '113.7456', '27.639318', 3, 5, 1),
(360321, 360300, '莲花县', '莲花', '113.95558', '27.127808', 3, 2, 1),
(360322, 360300, '上栗县', '上栗', '113.80052', '27.87704', 3, 4, 1),
(360323, 360300, '芦溪县', '芦溪', '114.04121', '27.633633', 3, 3, 1),
(360400, 360000, '九江市', '九江', '115.99281', '29.712034', 2, 5, 1),
(360402, 360400, '庐山区', '庐山', '115.99012', '29.676174', 3, 6, 1),
(360403, 360400, '浔阳区', '浔阳', '115.99595', '29.72465', 3, 12, 1),
(360421, 360400, '九江县', '九江', '115.892975', '29.610264', 3, 5, 1),
(360423, 360400, '武宁县', '武宁', '115.105644', '29.260181', 3, 9, 1),
(360424, 360400, '修水县', '修水', '114.573425', '29.032728', 3, 11, 1),
(360425, 360400, '永修县', '永修', '115.80905', '29.018211', 3, 13, 1),
(360426, 360400, '德安县', '德安', '115.76261', '29.327475', 3, 1, 1),
(360427, 360400, '星子县', '星子', '116.04374', '29.45617', 3, 10, 1),
(360428, 360400, '都昌县', '都昌', '116.20512', '29.275105', 3, 2, 1),
(360429, 360400, '湖口县', '湖口', '116.244316', '29.7263', 3, 4, 1),
(360430, 360400, '彭泽县', '彭泽', '116.55584', '29.898865', 3, 7, 1),
(360481, 360400, '瑞昌市', '瑞昌', '115.66908', '29.6766', 3, 8, 1),
(360483, 360400, '共青城市', '共青城', '115.80571', '29.247885', 3, 3, 1),
(360500, 360000, '新余市', '新余', '114.93083', '27.810835', 2, 9, 1),
(360502, 360500, '渝水区', '渝水', '114.92392', '27.819172', 3, 2, 1),
(360521, 360500, '分宜县', '分宜', '114.67526', '27.8113', 3, 1, 1),
(360600, 360000, '鹰潭市', '鹰潭', '117.03384', '28.238638', 2, 11, 1),
(360602, 360600, '月湖区', '月湖', '117.03411', '28.239077', 3, 2, 1),
(360622, 360600, '余江县', '余江', '116.82276', '28.206177', 3, 3, 1),
(360681, 360600, '贵溪市', '贵溪', '117.212105', '28.283693', 3, 1, 1),
(360700, 360000, '赣州市', '赣州', '114.94028', '25.85097', 2, 2, 1),
(360702, 360700, '章贡区', '章贡', '114.93872', '25.851368', 3, 18, 1),
(360721, 360700, '赣县', '赣县', '115.01846', '25.865433', 3, 5, 1),
(360722, 360700, '信丰县', '信丰', '114.93089', '25.38023', 3, 13, 1),
(360723, 360700, '大余县', '大余', '114.36224', '25.395937', 3, 3, 1),
(360724, 360700, '上犹县', '上犹', '114.540535', '25.794285', 3, 12, 1),
(360725, 360700, '崇义县', '崇义', '114.30735', '25.68791', 3, 2, 1),
(360726, 360700, '安远县', '安远', '115.39233', '25.13459', 3, 1, 1),
(360727, 360700, '龙南县', '龙南', '114.792656', '24.90476', 3, 7, 1),
(360728, 360700, '定南县', '定南', '115.03267', '24.774277', 3, 4, 1),
(360729, 360700, '全南县', '全南', '114.531586', '24.742651', 3, 10, 1),
(360730, 360700, '宁都县', '宁都', '116.01878', '26.472054', 3, 9, 1),
(360731, 360700, '于都县', '于都', '115.4112', '25.955032', 3, 17, 1),
(360732, 360700, '兴国县', '兴国', '115.3519', '26.330488', 3, 15, 1),
(360733, 360700, '会昌县', '会昌', '115.79116', '25.599125', 3, 6, 1),
(360734, 360700, '寻乌县', '寻乌', '115.6514', '24.954136', 3, 16, 1),
(360735, 360700, '石城县', '石城', '116.34225', '26.326582', 3, 14, 1),
(360781, 360700, '瑞金市', '瑞金', '116.03485', '25.875278', 3, 11, 1),
(360782, 360700, '南康市', '南康', '114.756935', '25.66172', 3, 8, 1),
(360800, 360000, '吉安市', '吉安', '114.986374', '27.111698', 2, 3, 1),
(360802, 360800, '吉州区', '吉州', '114.98733', '27.112368', 3, 5, 1),
(360803, 360800, '青原区', '青原', '115.016304', '27.105879', 3, 6, 1),
(360821, 360800, '吉安县', '吉安', '114.90511', '27.040043', 3, 2, 1),
(360822, 360800, '吉水县', '吉水', '115.13457', '27.213446', 3, 4, 1),
(360823, 360800, '峡江县', '峡江', '115.31933', '27.580862', 3, 10, 1),
(360824, 360800, '新干县', '新干', '115.39929', '27.755758', 3, 11, 1),
(360825, 360800, '永丰县', '永丰', '115.43556', '27.321087', 3, 12, 1),
(360826, 360800, '泰和县', '泰和', '114.90139', '26.790165', 3, 8, 1),
(360827, 360800, '遂川县', '遂川', '114.51689', '26.323706', 3, 7, 1),
(360828, 360800, '万安县', '万安', '114.78469', '26.462086', 3, 9, 1),
(360829, 360800, '安福县', '安福', '114.61384', '27.382746', 3, 1, 1),
(360830, 360800, '永新县', '永新', '114.24253', '26.944721', 3, 13, 1),
(360881, 360800, '井冈山市', '井冈山', '114.284424', '26.745918', 3, 3, 1),
(360900, 360000, '宜春市', '宜春', '114.391136', '27.8043', 2, 10, 1),
(360902, 360900, '袁州区', '袁州', '114.38738', '27.800117', 3, 9, 1),
(360921, 360900, '奉新县', '奉新', '115.3899', '28.700672', 3, 2, 1),
(360922, 360900, '万载县', '万载', '114.44901', '28.104528', 3, 7, 1),
(360923, 360900, '上高县', '上高', '114.932655', '28.234789', 3, 5, 1),
(360924, 360900, '宜丰县', '宜丰', '114.787384', '28.388288', 3, 8, 1),
(360925, 360900, '靖安县', '靖安', '115.36175', '28.86054', 3, 4, 1),
(360926, 360900, '铜鼓县', '铜鼓', '114.37014', '28.520956', 3, 6, 1),
(360981, 360900, '丰城市', '丰城', '115.786', '28.191584', 3, 1, 1),
(360982, 360900, '樟树市', '樟树', '115.54339', '28.055899', 3, 10, 1),
(360983, 360900, '高安市', '高安', '115.38153', '28.420952', 3, 3, 1),
(361000, 360000, '抚州市', '抚州', '116.35835', '27.98385', 2, 1, 1),
(361002, 361000, '临川区', '临川', '116.361404', '27.981918', 3, 7, 1),
(361021, 361000, '南城县', '南城', '116.63945', '27.55531', 3, 8, 1),
(361022, 361000, '黎川县', '黎川', '116.91457', '27.29256', 3, 6, 1),
(361023, 361000, '南丰县', '南丰', '116.533', '27.210133', 3, 9, 1),
(361024, 361000, '崇仁县', '崇仁', '116.05911', '27.760906', 3, 1, 1),
(361025, 361000, '乐安县', '乐安', '115.83843', '27.420101', 3, 5, 1),
(361026, 361000, '宜黄县', '宜黄', '116.22302', '27.546513', 3, 10, 1),
(361027, 361000, '金溪县', '金溪', '116.77875', '27.907387', 3, 4, 1),
(361028, 361000, '资溪县', '资溪', '117.06609', '27.70653', 3, 11, 1),
(361029, 361000, '东乡县', '东乡', '116.60534', '28.2325', 3, 2, 1),
(361030, 361000, '广昌县', '广昌', '116.32729', '26.838427', 3, 3, 1),
(361100, 360000, '上饶市', '上饶', '117.97118', '28.44442', 2, 8, 1),
(361102, 361100, '信州区', '信州', '117.97052', '28.445377', 3, 6, 1),
(361121, 361100, '上饶县', '上饶', '117.90612', '28.453897', 3, 5, 1),
(361122, 361100, '广丰县', '广丰', '118.18985', '28.440285', 3, 2, 1),
(361123, 361100, '玉山县', '玉山', '118.24441', '28.67348', 3, 12, 1),
(361124, 361100, '铅山县', '铅山', '117.71191', '28.310892', 3, 9, 1),
(361125, 361100, '横峰县', '横峰', '117.608246', '28.415104', 3, 3, 1),
(361126, 361100, '弋阳县', '弋阳', '117.435005', '28.402391', 3, 10, 1),
(361127, 361100, '余干县', '余干', '116.69107', '28.69173', 3, 11, 1),
(361128, 361100, '鄱阳县', '鄱阳', '116.673744', '28.993374', 3, 4, 1),
(361129, 361100, '万年县', '万年', '117.07015', '28.692589', 3, 7, 1),
(361130, 361100, '婺源县', '婺源', '117.86219', '29.254015', 3, 8, 1),
(361181, 361100, '德兴市', '德兴', '117.578735', '28.945034', 3, 1, 1),
(370000, 0, '山东省', '山东', '117.00092', '36.675808', 1, 15, 1),
(370100, 370000, '济南市', '济南', '117.00092', '36.675808', 2, 5, 1),
(370102, 370100, '历下区', '历下', '117.03862', '36.66417', 3, 5, 1),
(370103, 370100, '市中区', '市中', '116.99898', '36.657352', 3, 8, 1),
(370104, 370100, '槐荫区', '槐荫', '116.94792', '36.668205', 3, 2, 1),
(370105, 370100, '天桥区', '天桥', '116.996086', '36.693375', 3, 9, 1),
(370112, 370100, '历城区', '历城', '117.06374', '36.681744', 3, 4, 1),
(370113, 370100, '长清区', '长清', '116.74588', '36.56105', 3, 1, 1),
(370124, 370100, '平阴县', '平阴', '116.455055', '36.286922', 3, 6, 1),
(370125, 370100, '济阳县', '济阳', '117.17603', '36.976772', 3, 3, 1),
(370126, 370100, '商河县', '商河', '117.15637', '37.310543', 3, 7, 1),
(370181, 370100, '章丘市', '章丘', '117.54069', '36.71209', 3, 10, 1),
(370200, 370000, '青岛市', '青岛', '120.35517', '36.08298', 2, 10, 1),
(370202, 370200, '市南区', '市南', '120.395966', '36.070892', 3, 10, 1),
(370203, 370200, '市北区', '市北', '120.35503', '36.08382', 3, 9, 1),
(370211, 370200, '黄岛区', '黄岛', '119.99552', '35.875137', 3, 2, 1),
(370212, 370200, '崂山区', '崂山', '120.46739', '36.10257', 3, 6, 1),
(370213, 370200, '李沧区', '李沧', '120.421234', '36.160023', 3, 7, 1),
(370214, 370200, '城阳区', '城阳', '120.38914', '36.30683', 3, 1, 1),
(370281, 370200, '胶州市', '胶州', '120.0062', '36.285877', 3, 3, 1),
(370282, 370200, '即墨市', '即墨', '120.44735', '36.390846', 3, 4, 1),
(370283, 370200, '平度市', '平度', '119.959015', '36.78883', 3, 8, 1),
(370285, 370200, '莱西市', '莱西', '120.52622', '36.86509', 3, 5, 1),
(370300, 370000, '淄博市', '淄博', '118.047646', '36.814938', 2, 17, 1),
(370302, 370300, '淄川区', '淄川', '117.9677', '36.64727', 3, 8, 1),
(370303, 370300, '张店区', '张店', '118.05352', '36.80705', 3, 6, 1),
(370304, 370300, '博山区', '博山', '117.85823', '36.497566', 3, 1, 1),
(370305, 370300, '临淄区', '临淄', '118.306015', '36.816658', 3, 4, 1),
(370306, 370300, '周村区', '周村', '117.851036', '36.8037', 3, 7, 1),
(370321, 370300, '桓台县', '桓台', '118.101555', '36.959774', 3, 3, 1),
(370322, 370300, '高青县', '高青', '117.82984', '37.169582', 3, 2, 1),
(370323, 370300, '沂源县', '沂源', '118.16616', '36.186283', 3, 5, 1),
(370400, 370000, '枣庄市', '枣庄', '117.55796', '34.856422', 2, 16, 1),
(370402, 370400, '市中区', '市中', '117.55728', '34.85665', 3, 2, 1),
(370403, 370400, '薛城区', '薛城', '117.26529', '34.79789', 3, 5, 1),
(370404, 370400, '峄城区', '峄城', '117.58632', '34.76771', 3, 6, 1),
(370405, 370400, '台儿庄区', '台儿庄', '117.73475', '34.564816', 3, 3, 1),
(370406, 370400, '山亭区', '山亭', '117.45897', '35.096077', 3, 1, 1),
(370481, 370400, '滕州市', '滕州', '117.1621', '35.088497', 3, 4, 1),
(370500, 370000, '东营市', '东营', '118.66471', '37.434563', 2, 3, 1),
(370502, 370500, '东营区', '东营', '118.507545', '37.461567', 3, 1, 1),
(370503, 370500, '河口区', '河口', '118.52961', '37.886017', 3, 3, 1),
(370521, 370500, '垦利县', '垦利', '118.551315', '37.58868', 3, 4, 1),
(370522, 370500, '利津县', '利津', '118.248856', '37.493366', 3, 5, 1),
(370523, 370500, '广饶县', '广饶', '118.407524', '37.05161', 3, 2, 1),
(370600, 370000, '烟台市', '烟台', '121.39138', '37.539295', 2, 15, 1),
(370602, 370600, '芝罘区', '芝罘', '121.38588', '37.540924', 3, 12, 1),
(370611, 370600, '福山区', '福山', '121.26474', '37.496876', 3, 2, 1),
(370612, 370600, '牟平区', '牟平', '121.60151', '37.388355', 3, 8, 1),
(370613, 370600, '莱山区', '莱山', '121.44887', '37.47355', 3, 4, 1),
(370634, 370600, '长岛县', '长岛', '120.73834', '37.916195', 3, 1, 1),
(370681, 370600, '龙口市', '龙口', '120.52833', '37.648445', 3, 7, 1),
(370682, 370600, '莱阳市', '莱阳', '120.71115', '36.977036', 3, 5, 1),
(370683, 370600, '莱州市', '莱州', '119.94214', '37.182724', 3, 6, 1),
(370684, 370600, '蓬莱市', '蓬莱', '120.76269', '37.81117', 3, 9, 1),
(370685, 370600, '招远市', '招远', '120.403145', '37.364918', 3, 11, 1),
(370686, 370600, '栖霞市', '栖霞', '120.8341', '37.305855', 3, 10, 1),
(370687, 370600, '海阳市', '海阳', '121.16839', '36.78066', 3, 3, 1),
(370700, 370000, '潍坊市', '潍坊', '119.10708', '36.70925', 2, 13, 1),
(370702, 370700, '潍城区', '潍城', '119.10378', '36.71006', 3, 11, 1),
(370703, 370700, '寒亭区', '寒亭', '119.20786', '36.772102', 3, 6, 1),
(370704, 370700, '坊子区', '坊子', '119.16633', '36.654617', 3, 4, 1),
(370705, 370700, '奎文区', '奎文', '119.13736', '36.709496', 3, 7, 1),
(370724, 370700, '临朐县', '临朐', '118.53988', '36.516373', 3, 8, 1),
(370725, 370700, '昌乐县', '昌乐', '118.84', '36.703255', 3, 2, 1),
(370781, 370700, '青州市', '青州', '118.484695', '36.697857', 3, 9, 1),
(370782, 370700, '诸城市', '诸城', '119.40318', '35.997093', 3, 12, 1),
(370783, 370700, '寿光市', '寿光', '118.73645', '36.874413', 3, 10, 1),
(370784, 370700, '安丘市', '安丘', '119.20689', '36.427418', 3, 1, 1),
(370785, 370700, '高密市', '高密', '119.757034', '36.37754', 3, 5, 1),
(370786, 370700, '昌邑市', '昌邑', '119.3945', '36.85494', 3, 3, 1),
(370800, 370000, '济宁市', '济宁', '116.58724', '35.415394', 2, 6, 1),
(370802, 370800, '市中区', '市中', '116.58724', '35.415394', 3, 6, 1),
(370811, 370800, '任城区', '任城', '116.63102', '35.431835', 3, 5, 1),
(370826, 370800, '微山县', '微山', '117.12861', '34.809525', 3, 8, 1),
(370827, 370800, '鱼台县', '鱼台', '116.650024', '34.997707', 3, 11, 1),
(370828, 370800, '金乡县', '金乡', '116.31036', '35.06977', 3, 2, 1),
(370829, 370800, '嘉祥县', '嘉祥', '116.34289', '35.398098', 3, 1, 1),
(370830, 370800, '汶上县', '汶上', '116.487144', '35.721745', 3, 9, 1),
(370831, 370800, '泗水县', '泗水', '117.273605', '35.653217', 3, 7, 1),
(370832, 370800, '梁山县', '梁山', '116.08963', '35.80184', 3, 3, 1),
(370881, 370800, '曲阜市', '曲阜', '116.99188', '35.59279', 3, 4, 1),
(370882, 370800, '兖州市', '兖州', '116.58724', '35.415394', 3, 10, 1),
(370883, 370800, '邹城市', '邹城', '116.96673', '35.40526', 3, 12, 1),
(370900, 370000, '泰安市', '泰安', '117.12907', '36.19497', 2, 12, 1),
(370902, 370900, '泰山区', '泰山', '117.12998', '36.189312', 3, 5, 1),
(370903, 370900, '岱岳区', '岱岳', '117.04353', '36.1841', 3, 1, 1),
(370921, 370900, '宁阳县', '宁阳', '116.79929', '35.76754', 3, 4, 1),
(370923, 370900, '东平县', '东平', '116.46105', '35.930466', 3, 2, 1),
(370982, 370900, '新泰市', '新泰', '117.76609', '35.910385', 3, 6, 1),
(370983, 370900, '肥城市', '肥城', '116.7637', '36.1856', 3, 3, 1),
(371000, 370000, '威海市', '威海', '122.116394', '37.50969', 2, 14, 1),
(371002, 371000, '环翠区', '环翠', '122.11619', '37.510754', 3, 1, 1),
(371081, 371000, '文登市', '文登', '122.05714', '37.196213', 3, 4, 1),
(371082, 371000, '荣成市', '荣成', '122.4229', '37.160133', 3, 2, 1),
(371083, 371000, '乳山市', '乳山', '121.53635', '36.91962', 3, 3, 1),
(371100, 370000, '日照市', '日照', '119.461205', '35.42859', 2, 11, 1),
(371102, 371100, '东港区', '东港', '119.4577', '35.42615', 3, 1, 1),
(371103, 371100, '岚山区', '岚山', '119.31584', '35.119793', 3, 3, 1),
(371121, 371100, '五莲县', '五莲', '119.20674', '35.751938', 3, 4, 1),
(371122, 371100, '莒县', '莒县', '118.832855', '35.588116', 3, 2, 1),
(371200, 370000, '莱芜市', '莱芜', '117.677734', '36.214397', 2, 7, 1),
(371202, 371200, '莱城区', '莱城', '117.67835', '36.21366', 3, 2, 1),
(371203, 371200, '钢城区', '钢城', '117.82033', '36.058037', 3, 1, 1),
(371300, 370000, '临沂市', '临沂', '118.32645', '35.06528', 2, 9, 1),
(371302, 371300, '兰山区', '兰山', '118.32767', '35.06163', 3, 5, 1),
(371311, 371300, '罗庄区', '罗庄', '118.2848', '34.997204', 3, 7, 1),
(371312, 371300, '河东区', '河东', '118.39829', '35.085003', 3, 3, 1),
(371321, 371300, '沂南县', '沂南', '118.4554', '35.547', 3, 11, 1),
(371322, 371300, '郯城县', '郯城', '118.342964', '34.614742', 3, 10, 1),
(371323, 371300, '沂水县', '沂水', '118.634544', '35.78703', 3, 12, 1),
(371324, 371300, '苍山县', '苍山', '118.32645', '35.06528', 3, 1, 1),
(371325, 371300, '费县', '费县', '117.96887', '35.269173', 3, 2, 1),
(371326, 371300, '平邑县', '平邑', '117.63188', '35.51152', 3, 9, 1),
(371327, 371300, '莒南县', '莒南', '118.838326', '35.17591', 3, 4, 1),
(371328, 371300, '蒙阴县', '蒙阴', '117.94327', '35.712437', 3, 8, 1),
(371329, 371300, '临沭县', '临沭', '118.64838', '34.91706', 3, 6, 1),
(371400, 370000, '德州市', '德州', '116.30743', '37.453968', 2, 2, 1),
(371402, 371400, '德城区', '德城', '116.307076', '37.453922', 3, 1, 1),
(371421, 371400, '陵县', '陵县', '116.57493', '37.332848', 3, 3, 1),
(371422, 371400, '宁津县', '宁津', '116.79372', '37.64962', 3, 5, 1),
(371423, 371400, '庆云县', '庆云', '117.39051', '37.777725', 3, 8, 1),
(371424, 371400, '临邑县', '临邑', '116.86703', '37.192043', 3, 4, 1),
(371425, 371400, '齐河县', '齐河', '116.75839', '36.795498', 3, 7, 1),
(371426, 371400, '平原县', '平原', '116.43391', '37.164467', 3, 6, 1),
(371427, 371400, '夏津县', '夏津', '116.003815', '36.9505', 3, 10, 1),
(371428, 371400, '武城县', '武城', '116.07863', '37.209526', 3, 9, 1),
(371481, 371400, '乐陵市', '乐陵', '117.21666', '37.729115', 3, 2, 1),
(371482, 371400, '禹城市', '禹城', '116.642555', '36.934486', 3, 11, 1),
(371500, 370000, '聊城市', '聊城', '115.98037', '36.456013', 2, 8, 1),
(371502, 371500, '东昌府区', '东昌府', '115.98003', '36.45606', 3, 2, 1),
(371521, 371500, '阳谷县', '阳谷', '115.78429', '36.11371', 3, 8, 1),
(371522, 371500, '莘县', '莘县', '115.66729', '36.2376', 3, 7, 1),
(371523, 371500, '茌平县', '茌平', '116.25335', '36.591934', 3, 1, 1),
(371524, 371500, '东阿县', '东阿', '116.248856', '36.336002', 3, 3, 1),
(371525, 371500, '冠县', '冠县', '115.44481', '36.483753', 3, 5, 1),
(371526, 371500, '高唐县', '高唐', '116.22966', '36.859756', 3, 4, 1),
(371581, 371500, '临清市', '临清', '115.71346', '36.842598', 3, 6, 1),
(371600, 370000, '滨州市', '滨州', '118.016975', '37.38354', 2, 1, 1),
(371602, 371600, '滨城区', '滨城', '118.02015', '37.384842', 3, 1, 1),
(371621, 371600, '惠民县', '惠民', '117.50894', '37.483875', 3, 3, 1),
(371622, 371600, '阳信县', '阳信', '117.58133', '37.64049', 3, 5, 1),
(371623, 371600, '无棣县', '无棣', '117.616325', '37.74085', 3, 4, 1),
(371624, 371600, '沾化县', '沾化', '118.129906', '37.698456', 3, 6, 1),
(371625, 371600, '博兴县', '博兴', '118.12309', '37.147003', 3, 2, 1),
(371626, 371600, '邹平县', '邹平', '117.73681', '36.87803', 3, 7, 1),
(371700, 370000, '菏泽市', '菏泽', '115.46938', '35.246532', 2, 4, 1),
(371702, 371700, '牡丹区', '牡丹', '115.47095', '35.24311', 3, 7, 1),
(371721, 371700, '曹县', '曹县', '115.549484', '34.823254', 3, 1, 1),
(371722, 371700, '单县', '单县', '116.08262', '34.79085', 3, 8, 1),
(371723, 371700, '成武县', '成武', '115.89735', '34.947365', 3, 2, 1),
(371724, 371700, '巨野县', '巨野', '116.08934', '35.391', 3, 6, 1),
(371725, 371700, '郓城县', '郓城', '115.93885', '35.594772', 3, 9, 1),
(371726, 371700, '鄄城县', '鄄城', '115.51434', '35.560257', 3, 5, 1),
(371727, 371700, '定陶县', '定陶', '115.5696', '35.0727', 3, 3, 1),
(371728, 371700, '东明县', '东明', '115.09841', '35.28964', 3, 4, 1),
(410000, 0, '河南省', '河南', '113.66541', '34.757977', 1, 16, 1),
(410100, 410000, '郑州市', '郑州', '113.66541', '34.757977', 2, 16, 1),
(410102, 410100, '中原区', '中原', '113.61157', '34.748287', 3, 12, 1),
(410103, 410100, '二七区', '二七', '113.645424', '34.730934', 3, 2, 1),
(410104, 410100, '管城回族区', '管城回族', '113.68531', '34.746452', 3, 4, 1),
(410105, 410100, '金水区', '金水', '113.686035', '34.775837', 3, 6, 1),
(410106, 410100, '上街区', '上街', '113.29828', '34.80869', 3, 7, 1),
(410108, 410100, '惠济区', '惠济', '113.61836', '34.82859', 3, 5, 1),
(410122, 410100, '中牟县', '中牟', '114.02252', '34.721977', 3, 11, 1),
(410181, 410100, '巩义市', '巩义', '112.98283', '34.75218', 3, 3, 1),
(410182, 410100, '荥阳市', '荥阳', '113.391525', '34.789078', 3, 8, 1),
(410183, 410100, '新密市', '新密', '113.380615', '34.537846', 3, 9, 1),
(410184, 410100, '新郑市', '新郑', '113.73967', '34.39422', 3, 10, 1),
(410185, 410100, '登封市', '登封', '113.037766', '34.459938', 3, 1, 1),
(410200, 410000, '开封市', '开封', '114.341446', '34.79705', 2, 5, 1),
(410202, 410200, '龙亭区', '龙亭', '114.35335', '34.79983', 3, 5, 1),
(410203, 410200, '顺河回族区', '顺河回族', '114.364876', '34.80046', 3, 7, 1),
(410204, 410200, '鼓楼区', '鼓楼', '114.3485', '34.79238', 3, 1, 1),
(410205, 410200, '禹王台区', '禹王台', '114.35024', '34.779728', 3, 10, 1),
(410211, 410200, '金明区', '金明', '114.30068', '34.79151', 3, 2, 1),
(410221, 410200, '杞县', '杞县', '114.77047', '34.554585', 3, 6, 1),
(410222, 410200, '通许县', '通许', '114.467735', '34.477303', 3, 8, 1),
(410223, 410200, '尉氏县', '尉氏', '114.193924', '34.412254', 3, 9, 1),
(410224, 410200, '开封县', '开封', '114.43762', '34.756477', 3, 3, 1),
(410225, 410200, '兰考县', '兰考', '114.82057', '34.8299', 3, 4, 1),
(410300, 410000, '洛阳市', '洛阳', '112.43447', '34.66304', 2, 7, 1),
(410302, 410300, '老城区', '老城', '112.477295', '34.682945', 3, 4, 1),
(410303, 410300, '西工区', '西工', '112.44323', '34.667847', 3, 11, 1),
(410304, 410300, '瀍河回族区', '瀍河回族', '112.49162', '34.68474', 3, 1, 1),
(410305, 410300, '涧西区', '涧西', '112.39925', '34.65425', 3, 2, 1),
(410306, 410300, '吉利区', '吉利', '112.58479', '34.899094', 3, 3, 1),
(410307, 410300, '洛龙区', '洛龙', '112.456635', '34.618557', 3, 6, 1),
(410322, 410300, '孟津县', '孟津', '112.44389', '34.826485', 3, 8, 1),
(410323, 410300, '新安县', '新安', '112.1414', '34.72868', 3, 12, 1),
(410324, 410300, '栾川县', '栾川', '111.618385', '33.783195', 3, 5, 1),
(410325, 410300, '嵩县', '嵩县', '112.08777', '34.13156', 3, 10, 1),
(410326, 410300, '汝阳县', '汝阳', '112.473785', '34.15323', 3, 9, 1),
(410327, 410300, '宜阳县', '宜阳', '112.17999', '34.51648', 3, 15, 1),
(410328, 410300, '洛宁县', '洛宁', '111.655396', '34.38718', 3, 7, 1),
(410329, 410300, '伊川县', '伊川', '112.42938', '34.423416', 3, 14, 1),
(410381, 410300, '偃师市', '偃师', '112.78774', '34.72304', 3, 13, 1),
(410400, 410000, '平顶山市', '平顶山', '113.30772', '33.73524', 2, 9, 1),
(410402, 410400, '新华区', '新华', '113.299065', '33.73758', 3, 8, 1),
(410403, 410400, '卫东区', '卫东', '113.310326', '33.739285', 3, 6, 1),
(410404, 410400, '石龙区', '石龙', '112.889885', '33.90154', 3, 5, 1),
(410411, 410400, '湛河区', '湛河', '113.32087', '33.72568', 3, 10, 1),
(410421, 410400, '宝丰县', '宝丰', '113.06681', '33.86636', 3, 1, 1),
(410422, 410400, '叶县', '叶县', '113.3583', '33.62125', 3, 9, 1),
(410423, 410400, '鲁山县', '鲁山', '112.9067', '33.740326', 3, 3, 1),
(410425, 410400, '郏县', '郏县', '113.22045', '33.971992', 3, 2, 1),
(410481, 410400, '舞钢市', '舞钢', '113.52625', '33.302082', 3, 7, 1),
(410482, 410400, '汝州市', '汝州', '112.84534', '34.167408', 3, 4, 1),
(410500, 410000, '安阳市', '安阳', '114.352486', '36.103443', 2, 1, 1),
(410502, 410500, '文峰区', '文峰', '114.35256', '36.098103', 3, 8, 1),
(410503, 410500, '北关区', '北关', '114.352646', '36.10978', 3, 2, 1),
(410505, 410500, '殷都区', '殷都', '114.300095', '36.108974', 3, 9, 1),
(410506, 410500, '龙安区', '龙安', '114.323524', '36.09557', 3, 5, 1),
(410522, 410500, '安阳县', '安阳', '114.1302', '36.130585', 3, 1, 1),
(410523, 410500, '汤阴县', '汤阴', '114.36236', '35.922348', 3, 7, 1),
(410526, 410500, '滑县', '滑县', '114.524', '35.574627', 3, 3, 1),
(410527, 410500, '内黄县', '内黄', '114.90458', '35.9537', 3, 6, 1),
(410581, 410500, '林州市', '林州', '113.82377', '36.063404', 3, 4, 1),
(410600, 410000, '鹤壁市', '鹤壁', '114.29544', '35.748238', 2, 2, 1),
(410602, 410600, '鹤山区', '鹤山', '114.16655', '35.936127', 3, 1, 1),
(410603, 410600, '山城区', '山城', '114.184204', '35.896057', 3, 4, 1),
(410611, 410600, '淇滨区', '淇滨', '114.293915', '35.748383', 3, 2, 1),
(410621, 410600, '浚县', '浚县', '114.55016', '35.671284', 3, 5, 1),
(410622, 410600, '淇县', '淇县', '114.20038', '35.609478', 3, 3, 1),
(410700, 410000, '新乡市', '新乡', '113.88399', '35.302616', 2, 14, 1),
(410702, 410700, '红旗区', '红旗', '113.87816', '35.302685', 3, 4, 1),
(410703, 410700, '卫滨区', '卫滨', '113.866066', '35.304905', 3, 8, 1),
(410704, 410700, '凤泉区', '凤泉', '113.906715', '35.379856', 3, 3, 1),
(410711, 410700, '牧野区', '牧野', '113.89716', '35.312973', 3, 7, 1),
(410721, 410700, '新乡县', '新乡', '113.80618', '35.19002', 3, 10, 1),
(410724, 410700, '获嘉县', '获嘉', '113.65725', '35.261684', 3, 6, 1),
(410725, 410700, '原阳县', '原阳', '113.965965', '35.054', 3, 12, 1),
(410726, 410700, '延津县', '延津', '114.20098', '35.149513', 3, 11, 1),
(410727, 410700, '封丘县', '封丘', '114.42341', '35.04057', 3, 2, 1),
(410728, 410700, '长垣县', '长垣', '114.673805', '35.19615', 3, 1, 1),
(410781, 410700, '卫辉市', '卫辉', '114.06586', '35.404297', 3, 9, 1),
(410782, 410700, '辉县市', '辉县', '113.80252', '35.46132', 3, 5, 1),
(410800, 410000, '焦作市', '焦作', '113.238266', '35.23904', 2, 3, 1),
(410802, 410800, '解放区', '解放', '113.22613', '35.241352', 3, 2, 1),
(410803, 410800, '中站区', '中站', '113.17548', '35.236145', 3, 10, 1),
(410804, 410800, '马村区', '马村', '113.3217', '35.265453', 3, 3, 1),
(410811, 410800, '山阳区', '山阳', '113.26766', '35.21476', 3, 6, 1),
(410821, 410800, '修武县', '修武', '113.447464', '35.229923', 3, 9, 1),
(410822, 410800, '博爱县', '博爱', '113.06931', '35.17035', 3, 1, 1),
(410823, 410800, '武陟县', '武陟', '113.40833', '35.09885', 3, 8, 1),
(410825, 410800, '温县', '温县', '113.07912', '34.941235', 3, 7, 1),
(410881, 410000, '济源市', '济源', '112.59005', '35.090378', 2, 4, 1),
(410882, 410800, '沁阳市', '沁阳', '112.93454', '35.08901', 3, 5, 1),
(410883, 410800, '孟州市', '孟州', '112.78708', '34.90963', 3, 4, 1),
(410900, 410000, '濮阳市', '濮阳', '115.0413', '35.768234', 2, 10, 1),
(410902, 410900, '华龙区', '华龙', '115.03184', '35.76047', 3, 2, 1),
(410922, 410900, '清丰县', '清丰', '115.107285', '35.902412', 3, 5, 1),
(410923, 410900, '南乐县', '南乐', '115.20434', '36.075203', 3, 3, 1),
(410926, 410900, '范县', '范县', '115.50421', '35.85198', 3, 1, 1),
(410927, 410900, '台前县', '台前', '115.85568', '35.996475', 3, 6, 1),
(410928, 410900, '濮阳县', '濮阳', '115.02384', '35.71035', 3, 4, 1),
(411000, 410000, '许昌市', '许昌', '113.826065', '34.022957', 2, 15, 1),
(411002, 411000, '魏都区', '魏都', '113.82831', '34.02711', 3, 2, 1),
(411023, 411000, '许昌县', '许昌', '113.842896', '34.005016', 3, 4, 1),
(411024, 411000, '鄢陵县', '鄢陵', '114.18851', '34.100502', 3, 5, 1),
(411025, 411000, '襄城县', '襄城', '113.493164', '33.85594', 3, 3, 1),
(411081, 411000, '禹州市', '禹州', '113.47131', '34.154404', 3, 6, 1),
(411082, 411000, '长葛市', '长葛', '113.76891', '34.219257', 3, 1, 1),
(411100, 410000, '漯河市', '漯河', '114.026405', '33.575855', 2, 6, 1),
(411102, 411100, '源汇区', '源汇', '114.017944', '33.56544', 3, 4, 1),
(411103, 411100, '郾城区', '郾城', '114.016815', '33.588898', 3, 3, 1),
(411104, 411100, '召陵区', '召陵', '114.05169', '33.567554', 3, 5, 1),
(411121, 411100, '舞阳县', '舞阳', '113.610565', '33.43628', 3, 2, 1),
(411122, 411100, '临颍县', '临颍', '113.93889', '33.80609', 3, 1, 1),
(411200, 410000, '三门峡市', '三门峡', '111.1941', '34.777336', 2, 11, 1),
(411202, 411200, '湖滨区', '湖滨', '111.19487', '34.77812', 3, 1, 1),
(411221, 411200, '渑池县', '渑池', '111.76299', '34.76349', 3, 4, 1),
(411222, 411200, '陕县', '陕县', '111.10385', '34.720245', 3, 5, 1),
(411224, 411200, '卢氏县', '卢氏', '111.05265', '34.053993', 3, 3, 1),
(411281, 411200, '义马市', '义马', '111.869415', '34.74687', 3, 6, 1),
(411282, 411200, '灵宝市', '灵宝', '110.88577', '34.521263', 3, 2, 1),
(411300, 410000, '南阳市', '南阳', '112.54092', '32.99908', 2, 8, 1),
(411302, 411300, '宛城区', '宛城', '112.54459', '32.994858', 3, 8, 1),
(411303, 411300, '卧龙区', '卧龙', '112.528786', '32.989876', 3, 9, 1),
(411321, 411300, '南召县', '南召', '112.435585', '33.488617', 3, 3, 1),
(411322, 411300, '方城县', '方城', '113.01093', '33.25514', 3, 2, 1),
(411323, 411300, '西峡县', '西峡', '111.48577', '33.302982', 3, 12, 1),
(411324, 411300, '镇平县', '镇平', '112.23272', '33.03665', 3, 13, 1),
(411325, 411300, '内乡县', '内乡', '111.8438', '33.046356', 3, 4, 1),
(411326, 411300, '淅川县', '淅川', '111.48903', '33.136105', 3, 10, 1),
(411327, 411300, '社旗县', '社旗县', '112.93828', '33.056126', 3, 5, 1),
(411328, 411300, '唐河县', '唐河', '112.83849', '32.687893', 3, 6, 1),
(411329, 411300, '新野县', '新野', '112.36562', '32.524006', 3, 11, 1),
(411330, 411300, '桐柏县', '桐柏', '113.40606', '32.367153', 3, 7, 1),
(411381, 411300, '邓州市', '邓州', '112.09271', '32.68164', 3, 1, 1),
(411400, 410000, '商丘市', '商丘', '115.6505', '34.437054', 2, 12, 1),
(411402, 411400, '梁园区', '梁园', '115.65459', '34.436554', 3, 1, 1),
(411403, 411400, '睢阳区', '睢阳', '115.65382', '34.390537', 3, 5, 1),
(411421, 411400, '民权县', '民权', '115.14815', '34.648457', 3, 2, 1),
(411422, 411400, '睢县', '睢县', '115.07011', '34.428432', 3, 4, 1),
(411423, 411400, '宁陵县', '宁陵', '115.32005', '34.4493', 3, 3, 1),
(411424, 411400, '柘城县', '柘城', '115.307434', '34.075275', 3, 9, 1),
(411425, 411400, '虞城县', '虞城', '115.86381', '34.399635', 3, 8, 1),
(411426, 411400, '夏邑县', '夏邑', '116.13989', '34.240894', 3, 6, 1),
(411481, 411400, '永城市', '永城', '116.44967', '33.931316', 3, 7, 1),
(411500, 410000, '信阳市', '信阳', '114.07503', '32.123276', 2, 13, 1),
(411502, 411500, '浉河区', '浉河', '114.07503', '32.123276', 3, 8, 1),
(411503, 411500, '平桥区', '平桥', '114.12603', '32.098396', 3, 6, 1),
(411521, 411500, '罗山县', '罗山', '114.53342', '32.203205', 3, 5, 1),
(411522, 411500, '光山县', '光山', '114.90358', '32.0104', 3, 1, 1),
(411523, 411500, '新县', '新县', '114.87705', '31.63515', 3, 9, 1),
(411524, 411500, '商城县', '商城', '115.406296', '31.799982', 3, 7, 1),
(411525, 411500, '固始县', '固始', '115.66733', '32.183075', 3, 2, 1),
(411526, 411500, '潢川县', '潢川', '115.050125', '32.134026', 3, 4, 1),
(411527, 411500, '淮滨县', '淮滨', '115.41545', '32.45264', 3, 3, 1),
(411528, 411500, '息县', '息县', '114.740715', '32.344746', 3, 10, 1),
(411600, 410000, '周口市', '周口', '114.64965', '33.620358', 2, 17, 1),
(411602, 411600, '川汇区', '川汇', '114.65214', '33.614838', 3, 1, 1),
(411621, 411600, '扶沟县', '扶沟', '114.392006', '34.05406', 3, 3, 1),
(411622, 411600, '西华县', '西华', '114.53007', '33.784378', 3, 10, 1),
(411623, 411600, '商水县', '商水', '114.60927', '33.543846', 3, 6, 1),
(411624, 411600, '沈丘县', '沈丘', '115.07838', '33.395515', 3, 7, 1),
(411625, 411600, '郸城县', '郸城', '115.189', '33.643852', 3, 2, 1),
(411626, 411600, '淮阳县', '淮阳', '114.87016', '33.732548', 3, 4, 1),
(411627, 411600, '太康县', '太康', '114.853836', '34.06531', 3, 8, 1),
(411628, 411600, '鹿邑县', '鹿邑', '115.48639', '33.86107', 3, 5, 1),
(411681, 411600, '项城市', '项城', '114.89952', '33.443085', 3, 9, 1),
(411700, 410000, '驻马店市', '驻马店', '114.024734', '32.980167', 2, 18, 1),
(411702, 411700, '驿城区', '驿城', '114.02915', '32.97756', 3, 9, 1),
(411721, 411700, '西平县', '西平', '114.02686', '33.382317', 3, 8, 1),
(411722, 411700, '上蔡县', '上蔡', '114.26689', '33.264717', 3, 5, 1),
(411723, 411700, '平舆县', '平舆', '114.63711', '32.955627', 3, 2, 1),
(411724, 411700, '正阳县', '正阳', '114.38948', '32.601826', 3, 10, 1),
(411725, 411700, '确山县', '确山', '114.02668', '32.801537', 3, 3, 1),
(411726, 411700, '泌阳县', '泌阳', '113.32605', '32.72513', 3, 1, 1),
(411727, 411700, '汝南县', '汝南', '114.3595', '33.004536', 3, 4, 1),
(411728, 411700, '遂平县', '遂平', '114.00371', '33.14698', 3, 6, 1),
(411729, 411700, '新蔡县', '新蔡', '114.97524', '32.749947', 3, 7, 1),
(420000, 0, '湖北省', '湖北', '114.29857', '30.584354', 1, 17, 1),
(420100, 420000, '武汉市', '武汉', '114.29857', '30.584354', 2, 12, 1),
(420102, 420100, '江岸区', '江岸', '114.30304', '30.594912', 3, 7, 1),
(420103, 420100, '江汉区', '江汉', '114.28311', '30.578772', 3, 8, 1),
(420104, 420100, '硚口区', '硚口', '114.264565', '30.57061', 3, 10, 1),
(420105, 420100, '汉阳区', '汉阳', '114.26581', '30.549326', 3, 4, 1),
(420106, 420100, '武昌区', '武昌', '114.30734', '30.546535', 3, 12, 1),
(420107, 420100, '青山区', '青山', '114.39707', '30.634214', 3, 11, 1),
(420111, 420100, '洪山区', '洪山', '114.40072', '30.50426', 3, 5, 1),
(420112, 420100, '东西湖区', '东西湖', '114.14249', '30.622467', 3, 2, 1),
(420113, 420100, '汉南区', '汉南', '114.08124', '30.309637', 3, 3, 1),
(420114, 420100, '蔡甸区', '蔡甸', '114.02934', '30.582186', 3, 1, 1),
(420115, 420100, '江夏区', '江夏', '114.31396', '30.349045', 3, 9, 1),
(420116, 420100, '黄陂区', '黄陂', '114.37402', '30.874155', 3, 6, 1),
(420117, 420100, '新洲区', '新洲', '114.80211', '30.84215', 3, 13, 1),
(420200, 420000, '黄石市', '黄石', '115.07705', '30.220074', 2, 4, 1),
(420202, 420200, '黄石港区', '黄石港', '115.090164', '30.212086', 3, 2, 1),
(420203, 420200, '西塞山区', '西塞山', '115.09335', '30.205364', 3, 5, 1),
(420204, 420200, '下陆区', '下陆', '114.97575', '30.177845', 3, 4, 1),
(420205, 420200, '铁山区', '铁山', '114.90137', '30.20601', 3, 3, 1),
(420222, 420200, '阳新县', '阳新', '115.21288', '29.841572', 3, 6, 1),
(420281, 420200, '大冶市', '大冶', '114.97484', '30.098804', 3, 1, 1),
(420300, 420000, '十堰市', '十堰', '110.78792', '32.646908', 2, 9, 1),
(420302, 420300, '茅箭区', '茅箭', '110.78621', '32.644463', 3, 3, 1),
(420303, 420300, '张湾区', '张湾', '110.77236', '32.652515', 3, 6, 1),
(420321, 420300, '郧县', '郧县', '110.812096', '32.83827', 3, 4, 1),
(420322, 420300, '郧西县', '郧西', '110.426476', '32.99146', 3, 5, 1),
(420323, 420300, '竹山县', '竹山', '110.2296', '32.22586', 3, 7, 1),
(420324, 420300, '竹溪县', '竹溪', '109.71719', '32.315342', 3, 8, 1),
(420325, 420300, '房县', '房县', '110.74197', '32.055', 3, 2, 1),
(420381, 420300, '丹江口市', '丹江口', '111.513794', '32.538837', 3, 1, 1),
(420500, 420000, '宜昌市', '宜昌', '111.29084', '30.702637', 2, 17, 1),
(420502, 420500, '西陵区', '西陵', '111.29547', '30.702477', 3, 6, 1),
(420503, 420500, '伍家岗区', '伍家岗', '111.30721', '30.679052', 3, 5, 1),
(420504, 420500, '点军区', '点军', '111.268166', '30.692322', 3, 3, 1),
(420505, 420500, '猇亭区', '猇亭', '111.29084', '30.702637', 3, 8, 1),
(420506, 420500, '夷陵区', '夷陵', '111.326744', '30.770199', 3, 10, 1),
(420525, 420500, '远安县', '远安', '111.64331', '31.059626', 3, 11, 1),
(420526, 420500, '兴山县', '兴山', '110.7545', '31.34795', 3, 7, 1),
(420527, 420500, '秭归县', '秭归', '110.97678', '30.823908', 3, 13, 1),
(420528, 420500, '长阳土家族自治县', '长阳', '111.19848', '30.466534', 3, 1, 1),
(420529, 420500, '五峰土家族自治县', '五峰', '110.674934', '30.199251', 3, 4, 1),
(420581, 420500, '宜都市', '宜都', '111.45437', '30.387234', 3, 9, 1),
(420582, 420500, '当阳市', '当阳', '111.79342', '30.824492', 3, 2, 1),
(420583, 420500, '枝江市', '枝江', '111.7518', '30.425364', 3, 12, 1),
(420600, 420000, '襄阳市', '襄阳', '112.14415', '32.042427', 2, 13, 1),
(420602, 420600, '襄城区', '襄城', '112.15033', '32.015087', 3, 6, 1),
(420606, 420600, '樊城区', '樊城', '112.13957', '32.05859', 3, 2, 1),
(420607, 420600, '襄州区', '襄州', '112.19738', '32.085518', 3, 7, 1),
(420624, 420600, '南漳县', '南漳', '111.84442', '31.77692', 3, 5, 1),
(420625, 420600, '谷城县', '谷城', '111.640144', '32.262676', 3, 3, 1),
(420626, 420600, '保康县', '保康', '111.26224', '31.873507', 3, 1, 1),
(420682, 420600, '老河口市', '老河口', '111.675735', '32.385437', 3, 4, 1),
(420683, 420600, '枣阳市', '枣阳', '112.76527', '32.12308', 3, 9, 1),
(420684, 420600, '宜城市', '宜城', '112.261444', '31.709204', 3, 8, 1),
(420700, 420000, '鄂州市', '鄂州', '114.890594', '30.396536', 2, 2, 1),
(420702, 420700, '梁子湖区', '梁子湖', '114.68197', '30.09819', 3, 3, 1),
(420703, 420700, '华容区', '华容', '114.74148', '30.534468', 3, 2, 1),
(420704, 420700, '鄂城区', '鄂城', '114.890015', '30.39669', 3, 1, 1),
(420800, 420000, '荆门市', '荆门', '112.204254', '31.03542', 2, 5, 1),
(420802, 420800, '东宝区', '东宝', '112.2048', '31.03346', 3, 1, 1),
(420804, 420800, '掇刀区', '掇刀', '112.19841', '30.980799', 3, 2, 1),
(420821, 420800, '京山县', '京山', '113.11459', '31.022457', 3, 3, 1),
(420822, 420800, '沙洋县', '沙洋', '112.595215', '30.70359', 3, 4, 1),
(420881, 420800, '钟祥市', '钟祥', '112.587265', '31.165573', 3, 5, 1),
(420900, 420000, '孝感市', '孝感', '113.92666', '30.926422', 2, 16, 1),
(420902, 420900, '孝南区', '孝南', '113.92585', '30.925966', 3, 5, 1),
(420921, 420900, '孝昌县', '孝昌', '113.98896', '31.251617', 3, 4, 1),
(420922, 420900, '大悟县', '大悟', '114.12625', '31.565483', 3, 2, 1),
(420923, 420900, '云梦县', '云梦', '113.75062', '31.02169', 3, 7, 1),
(420981, 420900, '应城市', '应城', '113.573845', '30.939037', 3, 6, 1),
(420982, 420900, '安陆市', '安陆', '113.6904', '31.26174', 3, 1, 1),
(420984, 420900, '汉川市', '汉川', '113.835304', '30.652164', 3, 3, 1),
(421000, 420000, '荆州市', '荆州', '112.23813', '30.326857', 2, 6, 1),
(421002, 421000, '沙市区', '沙市', '112.25743', '30.315895', 3, 6, 1),
(421003, 421000, '荆州区', '荆州', '112.19535', '30.350674', 3, 5, 1),
(421022, 421000, '公安县', '公安', '112.23018', '30.059065', 3, 1, 1),
(421023, 421000, '监利县', '监利', '112.90434', '29.82008', 3, 4, 1),
(421024, 421000, '江陵县', '江陵', '112.41735', '30.033918', 3, 3, 1),
(421081, 421000, '石首市', '石首', '112.40887', '29.716436', 3, 7, 1),
(421083, 421000, '洪湖市', '洪湖', '113.47031', '29.81297', 3, 2, 1),
(421087, 421000, '松滋市', '松滋', '111.77818', '30.176037', 3, 8, 1),
(421100, 420000, '黄冈市', '黄冈', '114.879364', '30.447712', 2, 3, 1),
(421102, 421100, '黄州区', '黄州', '114.87894', '30.447435', 3, 3, 1),
(421121, 421100, '团风县', '团风', '114.87203', '30.63569', 3, 7, 1),
(421122, 421100, '红安县', '红安', '114.6151', '31.284777', 3, 1, 1),
(421123, 421100, '罗田县', '罗田', '115.39899', '30.78168', 3, 4, 1),
(421124, 421100, '英山县', '英山', '115.67753', '30.735794', 3, 10, 1),
(421125, 421100, '浠水县', '浠水', '115.26344', '30.454838', 3, 9, 1),
(421126, 421100, '蕲春县', '蕲春', '115.43397', '30.234926', 3, 6, 1),
(421127, 421100, '黄梅县', '黄梅', '115.94255', '30.075113', 3, 2, 1),
(421181, 421100, '麻城市', '麻城', '115.02541', '31.177906', 3, 5, 1),
(421182, 421100, '武穴市', '武穴', '115.56242', '29.849342', 3, 8, 1),
(421200, 420000, '咸宁市', '咸宁', '114.328964', '29.832798', 2, 14, 1),
(421202, 421200, '咸安区', '咸安', '114.33389', '29.824717', 3, 6, 1),
(421221, 421200, '嘉鱼县', '嘉鱼', '113.92155', '29.973364', 3, 3, 1),
(421222, 421200, '通城县', '通城', '113.81413', '29.246077', 3, 4, 1),
(421223, 421200, '崇阳县', '崇阳', '114.04996', '29.54101', 3, 2, 1),
(421224, 421200, '通山县', '通山', '114.493164', '29.604456', 3, 5, 1),
(421281, 421200, '赤壁市', '赤壁', '113.88366', '29.716879', 3, 1, 1),
(421300, 420000, '随州市', '随州', '113.37377', '31.717497', 2, 10, 1),
(421302, 421300, '曾都区', '曾都', '113.37452', '31.717522', 3, 3, 1),
(421321, 421300, '随县', '随县', '113.301384', '31.854246', 3, 2, 1),
(421381, 421300, '广水市', '广水', '113.8266', '31.617731', 3, 1, 1),
(422800, 420000, '恩施土家族苗族自治州', '恩施', '109.48699', '30.283113', 2, 1, 1),
(422801, 422800, '恩施市', '恩施', '109.48676', '30.282406', 3, 2, 1),
(422802, 422800, '利川市', '利川', '108.94349', '30.294247', 3, 6, 1),
(422822, 422800, '建始县', '建始', '109.72382', '30.601631', 3, 4, 1),
(422823, 422800, '巴东县', '巴东', '110.33666', '31.041403', 3, 1, 1),
(422825, 422800, '宣恩县', '宣恩', '109.48282', '29.98867', 3, 8, 1),
(422826, 422800, '咸丰县', '咸丰', '109.15041', '29.678967', 3, 7, 1),
(422827, 422800, '来凤县', '来凤', '109.408325', '29.506945', 3, 5, 1),
(422828, 422800, '鹤峰县', '鹤峰', '110.0337', '29.887299', 3, 3, 1),
(429004, 420000, '仙桃市', '仙桃', '113.45397', '30.364952', 2, 15, 1),
(429005, 420000, '潜江市', '潜江', '112.896866', '30.421215', 2, 7, 1),
(429006, 420000, '天门市', '天门', '113.16586', '30.65306', 2, 11, 1),
(429021, 420000, '神农架林区', '神农架', '114.29857', '30.584354', 2, 8, 1),
(430000, 0, '湖南省', '湖南', '112.98228', '28.19409', 1, 18, 1),
(430100, 430000, '长沙市', '长沙', '112.98228', '28.19409', 2, 2, 1),
(430102, 430100, '芙蓉区', '芙蓉', '112.98809', '28.193106', 3, 2, 1),
(430103, 430100, '天心区', '天心', '112.97307', '28.192375', 3, 6, 1),
(430104, 430100, '岳麓区', '岳麓', '112.91159', '28.213043', 3, 8, 1),
(430105, 430100, '开福区', '开福', '112.98553', '28.201336', 3, 3, 1),
(430111, 430100, '雨花区', '雨花', '113.016335', '28.109938', 3, 9, 1),
(430121, 430100, '长沙县', '长沙', '113.0801', '28.237888', 3, 1, 1),
(430122, 430100, '望城区', '望城', '112.81955', '28.347458', 3, 7, 1),
(430124, 430100, '宁乡县', '宁乡', '112.553185', '28.253927', 3, 5, 1),
(430181, 430100, '浏阳市', '浏阳', '113.6333', '28.141111', 3, 4, 1),
(430200, 430000, '株洲市', '株洲', '113.15173', '27.835806', 2, 14, 1),
(430202, 430200, '荷塘区', '荷塘', '113.162544', '27.833036', 3, 2, 1),
(430203, 430200, '芦淞区', '芦淞', '113.15517', '27.827246', 3, 4, 1),
(430204, 430200, '石峰区', '石峰', '113.11295', '27.871944', 3, 5, 1),
(430211, 430200, '天元区', '天元', '113.13625', '27.826908', 3, 6, 1),
(430221, 430200, '株洲县', '株洲', '113.14618', '27.705845', 3, 9, 1),
(430223, 430200, '攸县', '攸县', '113.34577', '27.00007', 3, 8, 1),
(430224, 430200, '茶陵县', '茶陵', '113.54651', '26.789534', 3, 1, 1),
(430225, 430200, '炎陵县', '炎陵', '113.776886', '26.489458', 3, 7, 1),
(430281, 430200, '醴陵市', '醴陵', '113.50716', '27.657873', 3, 3, 1),
(430300, 430000, '湘潭市', '湘潭', '112.94405', '27.82973', 2, 8, 1),
(430302, 430300, '雨湖区', '雨湖', '112.907425', '27.86077', 3, 5, 1),
(430304, 430300, '岳塘区', '岳塘', '112.927704', '27.828854', 3, 4, 1),
(430321, 430300, '湘潭县', '湘潭', '112.95283', '27.7786', 3, 2, 1),
(430381, 430300, '湘乡市', '湘乡', '112.525215', '27.734919', 3, 3, 1),
(430382, 430300, '韶山市', '韶山', '112.52848', '27.922682', 3, 1, 1),
(430400, 430000, '衡阳市', '衡阳', '112.6077', '26.900358', 2, 4, 1),
(430405, 430400, '珠晖区', '珠晖', '112.62633', '26.891064', 3, 12, 1),
(430406, 430400, '雁峰区', '雁峰', '112.61224', '26.893694', 3, 10, 1),
(430407, 430400, '石鼓区', '石鼓', '112.607635', '26.903908', 3, 9, 1),
(430408, 430400, '蒸湘区', '蒸湘', '112.57061', '26.89087', 3, 11, 1),
(430412, 430400, '南岳区', '南岳', '112.734146', '27.240536', 3, 7, 1),
(430421, 430400, '衡阳县', '衡阳', '112.37965', '26.962387', 3, 5, 1),
(430422, 430400, '衡南县', '衡南', '112.67746', '26.739973', 3, 3, 1),
(430423, 430400, '衡山县', '衡山', '112.86971', '27.234808', 3, 4, 1),
(430424, 430400, '衡东县', '衡东', '112.95041', '27.08353', 3, 2, 1),
(430426, 430400, '祁东县', '祁东', '112.11119', '26.78711', 3, 8, 1),
(430481, 430400, '耒阳市', '耒阳', '112.84721', '26.414162', 3, 6, 1),
(430482, 430400, '常宁市', '常宁', '112.39682', '26.406773', 3, 1, 1),
(430500, 430000, '邵阳市', '邵阳', '111.46923', '27.237843', 2, 7, 1),
(430502, 430500, '双清区', '双清', '111.47976', '27.240002', 3, 8, 1),
(430503, 430500, '大祥区', '大祥', '111.46297', '27.233593', 3, 3, 1),
(430511, 430500, '北塔区', '北塔', '111.45232', '27.245687', 3, 1, 1),
(430521, 430500, '邵东县', '邵东', '111.74317', '27.257273', 3, 6, 1),
(430522, 430500, '新邵县', '新邵', '111.45976', '27.311428', 3, 12, 1),
(430523, 430500, '邵阳县', '邵阳', '111.2757', '26.989714', 3, 7, 1),
(430524, 430500, '隆回县', '隆回', '111.03879', '27.116001', 3, 5, 1),
(430525, 430500, '洞口县', '洞口', '110.57921', '27.062286', 3, 4, 1),
(430527, 430500, '绥宁县', '绥宁', '110.155075', '26.580622', 3, 9, 1),
(430528, 430500, '新宁县', '新宁', '110.859116', '26.438911', 3, 11, 1),
(430529, 430500, '城步苗族自治县', '城步', '110.313225', '26.363575', 3, 2, 1),
(430581, 430500, '武冈市', '武冈', '110.6368', '26.732086', 3, 10, 1),
(430600, 430000, '岳阳市', '岳阳', '113.13286', '29.37029', 2, 12, 1),
(430602, 430600, '岳阳楼区', '岳阳楼', '113.12075', '29.366783', 3, 7, 1),
(430603, 430600, '云溪区', '云溪', '113.27387', '29.473394', 3, 9, 1),
(430611, 430600, '君山区', '君山', '113.00408', '29.438063', 3, 2, 1),
(430621, 430600, '岳阳县', '岳阳', '113.11607', '29.144842', 3, 8, 1),
(430623, 430600, '华容县', '华容', '112.55937', '29.524107', 3, 1, 1),
(430624, 430600, '湘阴县', '湘阴', '112.88975', '28.677498', 3, 6, 1),
(430626, 430600, '平江县', '平江', '113.59375', '28.701523', 3, 5, 1),
(430681, 430600, '汨罗市', '汨罗', '113.07942', '28.803148', 3, 4, 1),
(430682, 430600, '临湘市', '临湘', '113.450806', '29.471594', 3, 3, 1),
(430700, 430000, '常德市', '常德', '111.691345', '29.040224', 2, 1, 1),
(430702, 430700, '武陵区', '武陵', '111.69072', '29.040478', 3, 9, 1),
(430703, 430700, '鼎城区', '鼎城', '111.685326', '29.014425', 3, 2, 1),
(430721, 430700, '安乡县', '安乡', '112.17229', '29.414482', 3, 1, 1),
(430722, 430700, '汉寿县', '汉寿', '111.968506', '28.907318', 3, 3, 1),
(430723, 430700, '澧县', '澧县', '111.76168', '29.64264', 3, 6, 1),
(430724, 430700, '临澧县', '临澧', '111.6456', '29.443216', 3, 5, 1),
(430725, 430700, '桃源县', '桃源', '111.484505', '28.902735', 3, 8, 1),
(430726, 430700, '石门县', '石门', '111.37909', '29.584703', 3, 7, 1),
(430781, 430700, '津市市', '津市', '111.87961', '29.630867', 3, 4, 1),
(430800, 430000, '张家界市', '张家界', '110.47992', '29.127401', 2, 13, 1),
(430802, 430800, '永定区', '永定', '110.48456', '29.125961', 3, 4, 1),
(430811, 430800, '武陵源区', '武陵源', '110.54758', '29.347828', 3, 3, 1),
(430821, 430800, '慈利县', '慈利', '111.132706', '29.423876', 3, 1, 1),
(430822, 430800, '桑植县', '桑植', '110.16404', '29.399939', 3, 2, 1),
(430900, 430000, '益阳市', '益阳', '112.35504', '28.570066', 2, 10, 1),
(430902, 430900, '资阳区', '资阳', '112.33084', '28.592772', 3, 6, 1),
(430903, 430900, '赫山区', '赫山', '112.36095', '28.568327', 3, 2, 1),
(430921, 430900, '南县', '南县', '112.4104', '29.37218', 3, 3, 1),
(430922, 430900, '桃江县', '桃江', '112.13973', '28.520992', 3, 4, 1),
(430923, 430900, '安化县', '安化', '111.221825', '28.37742', 3, 1, 1),
(430981, 430900, '沅江市', '沅江', '112.36109', '28.839712', 3, 5, 1),
(431000, 430000, '郴州市', '郴州', '113.03207', '25.793589', 2, 3, 1),
(431002, 431000, '北湖区', '北湖', '113.03221', '25.792627', 3, 2, 1),
(431003, 431000, '苏仙区', '苏仙', '113.0387', '25.793158', 3, 8, 1),
(431021, 431000, '桂阳县', '桂阳', '112.73447', '25.737448', 3, 4, 1),
(431022, 431000, '宜章县', '宜章', '112.94788', '25.394344', 3, 9, 1),
(431023, 431000, '永兴县', '永兴', '113.11482', '26.129393', 3, 10, 1),
(431024, 431000, '嘉禾县', '嘉禾', '112.37062', '25.587309', 3, 5, 1),
(431025, 431000, '临武县', '临武', '112.56459', '25.27912', 3, 6, 1),
(431026, 431000, '汝城县', '汝城', '113.685684', '25.553759', 3, 7, 1),
(431027, 431000, '桂东县', '桂东', '113.94588', '26.073917', 3, 3, 1),
(431028, 431000, '安仁县', '安仁', '113.27217', '26.708626', 3, 1, 1),
(431081, 431000, '资兴市', '资兴', '113.23682', '25.974152', 3, 11, 1),
(431100, 430000, '永州市', '永州', '111.60802', '26.434517', 2, 11, 1),
(431102, 431100, '零陵区', '零陵', '111.62635', '26.223347', 3, 7, 1),
(431103, 431100, '冷水滩区', '冷水滩', '111.607155', '26.434364', 3, 6, 1),
(431121, 431100, '祁阳县', '祁阳', '111.85734', '26.58593', 3, 9, 1),
(431122, 431100, '东安县', '东安', '111.313034', '26.397278', 3, 2, 1),
(431123, 431100, '双牌县', '双牌', '111.66215', '25.959396', 3, 10, 1),
(431124, 431100, '道县', '道县', '111.59161', '25.518444', 3, 1, 1),
(431125, 431100, '江永县', '江永', '111.3468', '25.268154', 3, 4, 1),
(431126, 431100, '宁远县', '宁远', '111.94453', '25.584112', 3, 8, 1),
(431127, 431100, '蓝山县', '蓝山', '112.1942', '25.375256', 3, 5, 1),
(431128, 431100, '新田县', '新田', '112.220345', '25.906927', 3, 11, 1),
(431129, 431100, '江华瑶族自治县', '江华', '111.57728', '25.182596', 3, 3, 1),
(431200, 430000, '怀化市', '怀化', '109.97824', '27.550081', 2, 5, 1),
(431202, 431200, '鹤城区', '鹤城', '109.98224', '27.548473', 3, 2, 1),
(431221, 431200, '中方县', '中方', '109.94806', '27.43736', 3, 12, 1),
(431222, 431200, '沅陵县', '沅陵', '110.39916', '28.455553', 3, 10, 1),
(431223, 431200, '辰溪县', '辰溪', '110.19695', '28.005474', 3, 1, 1),
(431224, 431200, '溆浦县', '溆浦', '110.593376', '27.903803', 3, 9, 1),
(431225, 431200, '会同县', '会同', '109.72079', '26.870789', 3, 4, 1),
(431226, 431200, '麻阳苗族自治县', '麻阳', '109.80281', '27.865992', 3, 6, 1),
(431227, 431200, '新晃侗族自治县', '新晃', '109.174446', '27.359898', 3, 8, 1),
(431228, 431200, '芷江侗族自治县', '芷江', '109.687775', '27.437996', 3, 11, 1),
(431229, 431200, '靖州苗族侗族自治县', '靖州', '109.69116', '26.573511', 3, 5, 1),
(431230, 431200, '通道侗族自治县', '通道', '109.783356', '26.158348', 3, 7, 1),
(431281, 431200, '洪江市', '洪江', '109.831764', '27.201876', 3, 3, 1),
(431300, 430000, '娄底市', '娄底', '112.0085', '27.728136', 2, 6, 1),
(431302, 431300, '娄星区', '娄星', '112.008484', '27.726643', 3, 3, 1),
(431321, 431300, '双峰县', '双峰', '112.19824', '27.459126', 3, 4, 1),
(431322, 431300, '新化县', '新化', '111.30675', '27.737455', 3, 5, 1),
(431381, 431300, '冷水江市', '冷水江', '111.43468', '27.685759', 3, 1, 1),
(431382, 431300, '涟源市', '涟源', '111.670845', '27.6923', 3, 2, 1),
(433100, 430000, '湘西土家族苗族自治州', '湘西', '109.73974', '28.314297', 2, 9, 1),
(433101, 433100, '吉首市', '吉首', '109.73827', '28.314827', 3, 5, 1),
(433122, 433100, '泸溪县', '泸溪', '110.21443', '28.214516', 3, 7, 1),
(433123, 433100, '凤凰县', '凤凰', '109.59919', '27.948309', 3, 2, 1),
(433124, 433100, '花垣县', '花垣', '109.479065', '28.581352', 3, 4, 1),
(433125, 433100, '保靖县', '保靖', '109.65144', '28.709604', 3, 1, 1),
(433126, 433100, '古丈县', '古丈', '109.94959', '28.616974', 3, 3, 1),
(433127, 433100, '永顺县', '永顺', '109.853294', '28.998068', 3, 8, 1),
(433130, 433100, '龙山县', '龙山', '109.44119', '29.453438', 3, 6, 1),
(440000, 0, '广东省', '广东', '113.28064', '23.125177', 1, 19, 1),
(440100, 440000, '广州市', '广州', '113.28064', '23.125177', 2, 5, 1),
(440103, 440100, '荔湾区', '荔湾', '113.243034', '23.124943', 3, 7, 1),
(440104, 440100, '越秀区', '越秀', '113.280716', '23.125624', 3, 3, 1),
(440105, 440100, '海珠区', '海珠', '113.26201', '23.10313', 3, 4, 1),
(440106, 440100, '天河区', '天河', '113.335365', '23.13559', 3, 11, 1),
(440111, 440100, '白云区', '白云', '113.26283', '23.162281', 3, 1, 1),
(440112, 440100, '黄埔区', '黄埔', '113.45076', '23.10324', 3, 6, 1),
(440113, 440100, '番禺区', '番禺', '113.36462', '22.938581', 3, 10, 1),
(440114, 440100, '花都区', '花都', '113.21118', '23.39205', 3, 5, 1),
(440115, 440100, '南沙区', '南沙', '113.53738', '22.79453', 3, 9, 1),
(440116, 440100, '萝岗区', '萝岗', '113.28064', '23.125177', 3, 8, 1),
(440183, 440100, '增城市', '增城', '113.28064', '23.125177', 3, 12, 1),
(440184, 440100, '从化市', '从化', '113.28064', '23.125177', 3, 2, 1),
(440200, 440000, '韶关市', '韶关', '113.591545', '24.801323', 2, 15, 1),
(440203, 440200, '武江区', '武江', '113.58829', '24.80016', 3, 8, 1),
(440204, 440200, '浈江区', '浈江', '113.59922', '24.803976', 3, 10, 1),
(440205, 440200, '曲江区', '曲江', '113.60558', '24.680195', 3, 3, 1),
(440222, 440200, '始兴县', '始兴', '114.06721', '24.948364', 3, 6, 1),
(440224, 440200, '仁化县', '仁化', '113.74863', '25.088226', 3, 4, 1),
(440229, 440200, '翁源县', '翁源', '114.13129', '24.353888', 3, 7, 1),
(440232, 440200, '乳源瑶族自治县', '乳源', '113.27842', '24.77611', 3, 5, 1),
(440233, 440200, '新丰县', '新丰', '114.20703', '24.055412', 3, 9, 1),
(440281, 440200, '乐昌市', '乐昌', '113.35241', '25.128445', 3, 1, 1),
(440282, 440200, '南雄市', '南雄', '114.31123', '25.115328', 3, 2, 1),
(440300, 440000, '深圳市', '深圳', '114.085945', '22.547', 2, 16, 1),
(440303, 440300, '罗湖区', '罗湖', '114.123886', '22.555342', 3, 7, 1),
(440304, 440300, '福田区', '福田', '114.05096', '22.54101', 3, 3, 1),
(440305, 440300, '南山区', '南山', '113.92943', '22.531221', 3, 8, 1),
(440306, 440300, '宝安区', '宝安', '113.828674', '22.754742', 3, 1, 1),
(440307, 440300, '龙岗区', '龙岗', '114.25137', '22.721512', 3, 5, 1),
(440308, 440300, '盐田区', '盐田', '114.23537', '22.555069', 3, 10, 1),
(440320, 440300, '光明新区', '光明', '113.90504', '22.561985', 3, 4, 1),
(440321, 440300, '坪山新区', '坪山', '114.34625', '22.691254', 3, 9, 1),
(440322, 440300, '大鹏新区', '大鹏', '114.4746', '22.597641', 3, 2, 1),
(440323, 440300, '龙华新区', '龙华', '114.01935', '22.656408', 3, 6, 1),
(440400, 440000, '珠海市', '珠海', '113.553986', '22.22498', 2, 22, 1),
(440402, 440400, '香洲区', '香洲', '113.55027', '22.27125', 3, 3, 1),
(440403, 440400, '斗门区', '斗门', '113.29774', '22.209118', 3, 1, 1),
(440404, 440400, '金湾区', '金湾', '113.34507', '22.139122', 3, 2, 1),
(440500, 440000, '汕头市', '汕头', '116.708466', '23.37102', 2, 13, 1),
(440507, 440500, '龙湖区', '龙湖', '116.73202', '23.373755', 3, 6, 1),
(440511, 440500, '金平区', '金平', '116.70358', '23.367071', 3, 5, 1),
(440512, 440500, '濠江区', '濠江', '116.72953', '23.279345', 3, 4, 1),
(440513, 440500, '潮阳区', '潮阳', '116.6026', '23.262337', 3, 2, 1),
(440514, 440500, '潮南区', '潮南', '116.42361', '23.249798', 3, 1, 1),
(440515, 440500, '澄海区', '澄海', '116.76336', '23.46844', 3, 3, 1),
(440523, 440500, '南澳县', '南澳', '117.02711', '23.419561', 3, 7, 1),
(440600, 440000, '佛山市', '佛山', '113.12272', '23.028763', 2, 4, 1),
(440604, 440600, '禅城区', '禅城', '113.11241', '23.019644', 3, 1, 1),
(440605, 440600, '南海区', '南海', '113.14558', '23.031563', 3, 3, 1),
(440606, 440600, '顺德区', '顺德', '113.28182', '22.75851', 3, 5, 1),
(440607, 440600, '三水区', '三水', '112.899414', '23.16504', 3, 4, 1),
(440608, 440600, '高明区', '高明', '112.882126', '22.893854', 3, 2, 1),
(440700, 440000, '江门市', '江门', '113.09494', '22.590431', 2, 8, 1),
(440703, 440700, '蓬江区', '蓬江', '113.07859', '22.59677', 3, 5, 1),
(440704, 440700, '江海区', '江海', '113.1206', '22.57221', 3, 3, 1),
(440705, 440700, '新会区', '新会', '113.03858', '22.520247', 3, 7, 1),
(440781, 440700, '台山市', '台山', '112.79341', '22.250713', 3, 6, 1),
(440783, 440700, '开平市', '开平', '112.69226', '22.366285', 3, 4, 1),
(440784, 440700, '鹤山市', '鹤山', '112.96179', '22.768105', 3, 2, 1),
(440785, 440700, '恩平市', '恩平', '112.31405', '22.182957', 3, 1, 1),
(440800, 440000, '湛江市', '湛江', '110.364975', '21.274899', 2, 19, 1),
(440802, 440800, '赤坎区', '赤坎', '110.36163', '21.273365', 3, 1, 1),
(440803, 440800, '霞山区', '霞山', '110.40638', '21.19423', 3, 8, 1),
(440804, 440800, '坡头区', '坡头', '110.455635', '21.24441', 3, 5, 1),
(440811, 440800, '麻章区', '麻章', '110.32917', '21.265997', 3, 4, 1),
(440823, 440800, '遂溪县', '遂溪', '110.25532', '21.376915', 3, 6, 1),
(440825, 440800, '徐闻县', '徐闻', '110.17572', '20.326082', 3, 9, 1),
(440881, 440800, '廉江市', '廉江', '110.28496', '21.61128', 3, 3, 1),
(440882, 440800, '雷州市', '雷州', '110.08827', '20.908524', 3, 2, 1),
(440883, 440800, '吴川市', '吴川', '110.78051', '21.428453', 3, 7, 1),
(440900, 440000, '茂名市', '茂名', '110.91923', '21.659752', 2, 10, 1),
(440902, 440900, '茂南区', '茂南', '110.92054', '21.660425', 3, 5, 1),
(440903, 440900, '茂港区', '茂港', '111.05215', '21.463388', 3, 4, 1),
(440923, 440900, '电白县', '电白', '111.00726', '21.50722', 3, 1, 1),
(440981, 440900, '高州市', '高州', '110.85325', '21.915154', 3, 2, 1),
(440982, 440900, '化州市', '化州', '110.63839', '21.654953', 3, 3, 1),
(440983, 440900, '信宜市', '信宜', '110.94166', '22.35268', 3, 6, 1),
(441200, 440000, '肇庆市', '肇庆', '112.47253', '23.051546', 2, 20, 1),
(441202, 441200, '端州区', '端州', '112.47233', '23.052662', 3, 3, 1),
(441203, 441200, '鼎湖区', '鼎湖', '112.56525', '23.155823', 3, 2, 1),
(441223, 441200, '广宁县', '广宁', '112.44042', '23.631487', 3, 6, 1),
(441224, 441200, '怀集县', '怀集', '112.182465', '23.913073', 3, 7, 1),
(441225, 441200, '封开县', '封开', '111.502975', '23.43473', 3, 4, 1),
(441226, 441200, '德庆县', '德庆', '111.78156', '23.14171', 3, 1, 1),
(441283, 441200, '高要市', '高要', '112.460846', '23.027695', 3, 5, 1),
(441284, 441200, '四会市', '四会', '112.69503', '23.340324', 3, 8, 1),
(441300, 440000, '惠州市', '惠州', '114.4126', '23.079405', 2, 7, 1),
(441302, 441300, '惠城区', '惠城', '114.41398', '23.079884', 3, 2, 1),
(441303, 441300, '惠阳区', '惠阳', '114.469444', '22.78851', 3, 4, 1),
(441322, 441300, '博罗县', '博罗', '114.284256', '23.167576', 3, 1, 1),
(441323, 441300, '惠东县', '惠东', '114.72309', '22.983036', 3, 3, 1),
(441324, 441300, '龙门县', '龙门', '114.25999', '23.723894', 3, 5, 1),
(441400, 440000, '梅州市', '梅州', '116.117584', '24.299112', 2, 11, 1),
(441402, 441400, '梅江区', '梅江', '116.12116', '24.302593', 3, 4, 1),
(441421, 441400, '梅县', '梅县', '116.08348', '24.267824', 3, 5, 1),
(441422, 441400, '大埔县', '大埔', '116.69552', '24.351587', 3, 1, 1),
(441423, 441400, '丰顺县', '丰顺', '116.18442', '23.752771', 3, 2, 1),
(441424, 441400, '五华县', '五华', '115.775', '23.925425', 3, 7, 1),
(441426, 441400, '平远县', '平远', '115.89173', '24.56965', 3, 6, 1),
(441427, 441400, '蕉岭县', '蕉岭', '116.17053', '24.653313', 3, 3, 1),
(441481, 441400, '兴宁市', '兴宁', '115.73165', '24.138077', 3, 8, 1),
(441500, 440000, '汕尾市', '汕尾', '115.364235', '22.774485', 2, 14, 1),
(441502, 441500, '城区', '城区', '115.36367', '22.776228', 3, 1, 1),
(441521, 441500, '海丰县', '海丰', '115.337326', '22.971043', 3, 2, 1),
(441523, 441500, '陆河县', '陆河', '115.65756', '23.302683', 3, 4, 1),
(441581, 441500, '陆丰市', '陆丰', '115.6442', '22.946104', 3, 3, 1),
(441600, 440000, '河源市', '河源', '114.6978', '23.746265', 2, 6, 1),
(441602, 441600, '源城区', '源城', '114.69683', '23.746256', 3, 5, 1),
(441621, 441600, '紫金县', '紫金', '115.18438', '23.633743', 3, 6, 1),
(441622, 441600, '龙川县', '龙川', '115.25642', '24.101173', 3, 4, 1),
(441623, 441600, '连平县', '连平', '114.49595', '24.364227', 3, 3, 1),
(441624, 441600, '和平县', '和平', '114.941475', '24.44318', 3, 2, 1),
(441625, 441600, '东源县', '东源', '114.742714', '23.789093', 3, 1, 1),
(441700, 440000, '阳江市', '阳江', '111.975105', '21.859222', 2, 17, 1),
(441702, 441700, '江城区', '江城', '111.96891', '21.859182', 3, 1, 1),
(441721, 441700, '阳西县', '阳西', '111.61755', '21.75367', 3, 4, 1),
(441723, 441700, '阳东县', '阳东', '112.01127', '21.864729', 3, 3, 1),
(441781, 441700, '阳春市', '阳春', '111.7905', '22.169598', 3, 2, 1),
(441800, 440000, '清远市', '清远', '113.05122', '23.685022', 2, 12, 1),
(441802, 441800, '清城区', '清城', '113.0487', '23.688976', 3, 5, 1),
(441821, 441800, '佛冈县', '佛冈', '113.534096', '23.86674', 3, 1, 1),
(441823, 441800, '阳山县', '阳山', '112.63402', '24.470285', 3, 7, 1),
(441825, 441800, '连山壮族瑶族自治县', '连山', '112.086555', '24.56727', 3, 3, 1),
(441826, 441800, '连南瑶族自治县', '连南', '112.29081', '24.719097', 3, 2, 1),
(441827, 441800, '清新区', '清新', '113.015205', '23.73695', 3, 6, 1),
(441881, 441800, '英德市', '英德', '113.4054', '24.18612', 3, 8, 1),
(441882, 441800, '连州市', '连州', '112.37927', '24.783966', 3, 4, 1),
(441900, 440000, '东莞市', '东莞', '113.74626', '23.046238', 2, 2, 1),
(442000, 440000, '中山市', '中山', '113.38239', '22.521112', 2, 21, 1),
(442101, 440000, '东沙群岛', '东沙', '112.55295', '21.810463', 2, 3, 1),
(445100, 440000, '潮州市', '潮州', '116.6323', '23.661701', 2, 1, 1),
(445102, 445100, '湘桥区', '湘桥', '116.63365', '23.664675', 3, 3, 1),
(445121, 445100, '潮安区', '潮安', '116.67931', '23.461012', 3, 1, 1),
(445122, 445100, '饶平县', '饶平', '117.00205', '23.66817', 3, 2, 1),
(445200, 440000, '揭阳市', '揭阳', '116.355736', '23.543777', 2, 9, 1),
(445202, 445200, '榕城区', '榕城', '116.35705', '23.535524', 3, 5, 1),
(445221, 445200, '揭东区', '揭东', '116.41295', '23.569887', 3, 2, 1),
(445222, 445200, '揭西县', '揭西', '115.83871', '23.4273', 3, 3, 1),
(445224, 445200, '惠来县', '惠来', '116.29583', '23.029835', 3, 1, 1),
(445281, 445200, '普宁市', '普宁', '116.165085', '23.29788', 3, 4, 1),
(445300, 440000, '云浮市', '云浮', '112.04444', '22.929802', 2, 18, 1),
(445302, 445300, '云城区', '云城', '112.04471', '22.930826', 3, 5, 1),
(445321, 445300, '新兴县', '新兴', '112.23083', '22.703203', 3, 2, 1),
(445322, 445300, '郁南县', '郁南', '111.53592', '23.237709', 3, 3, 1),
(445323, 445300, '云安县', '云安', '112.00561', '23.073153', 3, 4, 1),
(445381, 445300, '罗定市', '罗定', '111.5782', '22.765415', 3, 1, 1),
(450000, 0, '广西壮族自治区', '广西', '108.32001', '22.82402', 1, 20, 1),
(450100, 450000, '南宁市', '南宁', '108.32001', '22.82402', 2, 11, 1),
(450102, 450100, '兴宁区', '兴宁', '108.32019', '22.819511', 3, 10, 1),
(450103, 450100, '青秀区', '青秀', '108.346115', '22.816614', 3, 7, 1),
(450105, 450100, '江南区', '江南', '108.31048', '22.799593', 3, 3, 1),
(450107, 450100, '西乡塘区', '西乡塘', '108.3069', '22.832779', 3, 11, 1),
(450108, 450100, '良庆区', '良庆', '108.322105', '22.75909', 3, 4, 1),
(450109, 450100, '邕宁区', '邕宁', '108.48425', '22.756598', 3, 12, 1),
(450122, 450100, '武鸣县', '武鸣', '108.280716', '23.157164', 3, 9, 1),
(450123, 450100, '隆安县', '隆安', '107.68866', '23.174763', 3, 5, 1),
(450124, 450100, '马山县', '马山', '108.172905', '23.711758', 3, 6, 1),
(450125, 450100, '上林县', '上林', '108.603935', '23.431768', 3, 8, 1),
(450126, 450100, '宾阳县', '宾阳', '108.816734', '23.216885', 3, 1, 1),
(450127, 450100, '横县', '横县', '109.27099', '22.68743', 3, 2, 1),
(450200, 450000, '柳州市', '柳州', '109.411705', '24.314617', 2, 10, 1),
(450202, 450200, '城中区', '城中', '109.41175', '24.312325', 3, 1, 1),
(450203, 450200, '鱼峰区', '鱼峰', '109.41537', '24.303848', 3, 10, 1),
(450204, 450200, '柳南区', '柳南', '109.395935', '24.287012', 3, 5, 1),
(450205, 450200, '柳北区', '柳北', '109.40658', '24.359144', 3, 2, 1),
(450221, 450200, '柳江县', '柳江', '109.3345', '24.257511', 3, 4, 1),
(450222, 450200, '柳城县', '柳城', '109.24581', '24.65512', 3, 3, 1),
(450223, 450200, '鹿寨县', '鹿寨', '109.74081', '24.483404', 3, 6, 1),
(450224, 450200, '融安县', '融安', '109.40362', '25.214703', 3, 7, 1),
(450225, 450200, '融水苗族自治县', '融水', '109.25275', '25.068811', 3, 8, 1),
(450226, 450200, '三江侗族自治县', '三江', '109.614845', '25.78553', 3, 9, 1),
(450300, 450000, '桂林市', '桂林', '110.29912', '25.274216', 2, 6, 1),
(450302, 450300, '秀峰区', '秀峰', '110.29244', '25.278543', 3, 13, 1),
(450303, 450300, '叠彩区', '叠彩', '110.30078', '25.301334', 3, 1, 1),
(450304, 450300, '象山区', '象山', '110.28488', '25.261986', 3, 11, 1),
(450305, 450300, '七星区', '七星', '110.31757', '25.25434', 3, 9, 1),
(450311, 450300, '雁山区', '雁山', '110.305664', '25.077646', 3, 15, 1),
(450321, 450300, '阳朔县', '阳朔', '110.4947', '24.77534', 3, 14, 1),
(450322, 450300, '临桂区', '临桂', '110.20549', '25.246258', 3, 5, 1),
(450323, 450300, '灵川县', '灵川', '110.325714', '25.40854', 3, 4, 1),
(450324, 450300, '全州县', '全州', '111.07299', '25.929897', 3, 10, 1),
(450325, 450300, '兴安县', '兴安', '110.670784', '25.609554', 3, 12, 1),
(450326, 450300, '永福县', '永福', '109.989204', '24.986692', 3, 16, 1),
(450327, 450300, '灌阳县', '灌阳', '111.16025', '25.489098', 3, 3, 1),
(450328, 450300, '龙胜各族自治县', '龙胜', '110.00942', '25.796429', 3, 7, 1),
(450329, 450300, '资源县', '资源', '110.642586', '26.0342', 3, 17, 1),
(450330, 450300, '平乐县', '平乐', '110.64282', '24.632215', 3, 8, 1),
(450331, 450300, '荔浦县', '荔浦', '110.40015', '24.497786', 3, 6, 1),
(450332, 450300, '恭城瑶族自治县', '恭城', '110.82952', '24.833612', 3, 2, 1),
(450400, 450000, '梧州市', '梧州', '111.29761', '23.474804', 2, 13, 1),
(450403, 450400, '万秀区', '万秀', '111.31582', '23.471317', 3, 4, 1),
(450405, 450400, '长洲区', '长洲', '111.27568', '23.4777', 3, 3, 1),
(450406, 450400, '龙圩区', '龙圩', '111.24603', '23.40996', 3, 5, 1),
(450421, 450400, '苍梧县', '苍梧', '111.54401', '23.845097', 3, 1, 1),
(450422, 450400, '藤县', '藤县', '110.93182', '23.373962', 3, 7, 1),
(450423, 450400, '蒙山县', '蒙山', '110.5226', '24.19983', 3, 6, 1),
(450481, 450400, '岑溪市', '岑溪', '110.998116', '22.918406', 3, 2, 1),
(450500, 450000, '北海市', '北海', '109.119255', '21.473343', 2, 1, 1),
(450502, 450500, '海城区', '海城', '109.10753', '21.468443', 3, 1, 1),
(450503, 450500, '银海区', '银海', '109.118706', '21.444908', 3, 4, 1),
(450512, 450500, '铁山港区', '铁山港', '109.45058', '21.5928', 3, 3, 1),
(450521, 450500, '合浦县', '合浦', '109.20069', '21.663553', 3, 2, 1),
(450600, 450000, '防城港市', '防城港', '108.345474', '21.614632', 2, 4, 1),
(450602, 450600, '港口区', '港口', '108.34628', '21.614407', 3, 3, 1),
(450603, 450600, '防城区', '防城', '108.35843', '21.764757', 3, 2, 1),
(450621, 450600, '上思县', '上思', '107.98214', '22.151423', 3, 4, 1),
(450681, 450600, '东兴市', '东兴', '107.97017', '21.541172', 3, 1, 1),
(450700, 450000, '钦州市', '钦州', '108.624176', '21.967127', 2, 12, 1),
(450702, 450700, '钦南区', '钦南', '108.62663', '21.966808', 3, 4, 1),
(450703, 450700, '钦北区', '钦北', '108.44911', '22.132761', 3, 3, 1),
(450721, 450700, '灵山县', '灵山', '109.293465', '22.418041', 3, 1, 1),
(450722, 450700, '浦北县', '浦北', '109.55634', '22.268335', 3, 2, 1),
(450800, 450000, '贵港市', '贵港', '109.60214', '23.0936', 2, 5, 1),
(450802, 450800, '港北区', '港北', '109.59481', '23.107677', 3, 1, 1),
(450803, 450800, '港南区', '港南', '109.60467', '23.067516', 3, 2, 1),
(450804, 450800, '覃塘区', '覃塘', '109.415695', '23.132814', 3, 5, 1),
(450821, 450800, '平南县', '平南', '110.397484', '23.544546', 3, 4, 1),
(450881, 450800, '桂平市', '桂平', '110.07467', '23.382473', 3, 3, 1),
(450900, 450000, '玉林市', '玉林', '110.154396', '22.63136', 2, 14, 1),
(450902, 450900, '玉州区', '玉州', '110.154915', '22.632132', 3, 7, 1),
(450903, 450900, '福绵区', '福绵', '110.05143', '22.579947', 3, 3, 1),
(450921, 450900, '容县', '容县', '110.55247', '22.856436', 3, 5, 1),
(450922, 450900, '陆川县', '陆川', '110.26484', '22.321054', 3, 4, 1),
(450923, 450900, '博白县', '博白', '109.98', '22.271284', 3, 2, 1),
(450924, 450900, '兴业县', '兴业', '109.87777', '22.74187', 3, 6, 1),
(450981, 450900, '北流市', '北流', '110.34805', '22.701649', 3, 1, 1),
(451000, 450000, '百色市', '百色', '106.61629', '23.897741', 2, 2, 1),
(451002, 451000, '右江区', '右江', '106.61573', '23.897675', 3, 12, 1),
(451021, 451000, '田阳县', '田阳', '106.90431', '23.736078', 3, 10, 1),
(451022, 451000, '田东县', '田东', '107.12426', '23.600445', 3, 8, 1),
(451023, 451000, '平果县', '平果', '107.58041', '23.320478', 3, 7, 1),
(451024, 451000, '德保县', '德保', '106.618164', '23.321465', 3, 1, 1),
(451025, 451000, '靖西县', '靖西', '106.41755', '23.134766', 3, 2, 1),
(451026, 451000, '那坡县', '那坡', '105.83355', '23.400785', 3, 6, 1),
(451027, 451000, '凌云县', '凌云', '106.56487', '24.345642', 3, 4, 1),
(451028, 451000, '乐业县', '乐业', '106.55964', '24.782204', 3, 3, 1),
(451029, 451000, '田林县', '田林', '106.23505', '24.290262', 3, 9, 1),
(451030, 451000, '西林县', '西林', '105.095024', '24.49204', 3, 11, 1),
(451031, 451000, '隆林各族自治县', '隆林', '105.34236', '24.774319', 3, 5, 1),
(451100, 450000, '贺州市', '贺州', '111.552055', '24.41414', 2, 8, 1),
(451102, 451100, '八步区', '八步', '111.551994', '24.412445', 3, 1, 1),
(451119, 451100, '平桂管理区', '平桂', '111.552055', '24.41414', 3, 3, 1),
(451121, 451100, '昭平县', '昭平', '110.81087', '24.172958', 3, 4, 1),
(451122, 451100, '钟山县', '钟山', '111.30363', '24.528566', 3, 5, 1),
(451123, 451100, '富川瑶族自治县', '富川', '111.27723', '24.81896', 3, 2, 1),
(451200, 450000, '河池市', '河池', '108.0621', '24.695898', 2, 7, 1),
(451202, 451200, '金城江区', '金城江', '108.06213', '24.695625', 3, 7, 1),
(451221, 451200, '南丹县', '南丹', '107.54661', '24.983192', 3, 9, 1),
(451222, 451200, '天峨县', '天峨', '107.17494', '24.985964', 3, 10, 1),
(451223, 451200, '凤山县', '凤山', '107.04459', '24.544561', 3, 5, 1),
(451224, 451200, '东兰县', '东兰', '107.373695', '24.509367', 3, 3, 1),
(451225, 451200, '罗城仫佬族自治县', '罗城', '108.90245', '24.779327', 3, 8, 1),
(451226, 451200, '环江毛南族自治县', '环江', '108.25867', '24.827627', 3, 6, 1),
(451227, 451200, '巴马瑶族自治县', '巴马', '107.25313', '24.139538', 3, 1, 1),
(451228, 451200, '都安瑶族自治县', '都安', '108.10276', '23.934963', 3, 4, 1),
(451229, 451200, '大化瑶族自治县', '大化', '107.9945', '23.739595', 3, 2, 1),
(451281, 451200, '宜州市', '宜州', '108.65397', '24.492193', 3, 11, 1),
(451300, 450000, '来宾市', '来宾', '109.229774', '23.733767', 2, 9, 1),
(451302, 451300, '兴宾区', '兴宾', '109.23054', '23.732925', 3, 6, 1),
(451321, 451300, '忻城县', '忻城', '108.66736', '24.06478', 3, 5, 1),
(451322, 451300, '象州县', '象州', '109.684555', '23.959824', 3, 4, 1),
(451323, 451300, '武宣县', '武宣', '109.66287', '23.604162', 3, 3, 1),
(451324, 451300, '金秀瑶族自治县', '金秀', '110.18855', '24.134941', 3, 2, 1),
(451381, 451300, '合山市', '合山', '108.88858', '23.81311', 3, 1, 1),
(451400, 450000, '崇左市', '崇左', '107.35393', '22.404108', 2, 3, 1),
(451402, 451400, '江州区', '江州', '107.35445', '22.40469', 3, 3, 1),
(451421, 451400, '扶绥县', '扶绥', '107.91153', '22.63582', 3, 2, 1),
(451422, 451400, '宁明县', '宁明', '107.06762', '22.131353', 3, 5, 1),
(451423, 451400, '龙州县', '龙州', '106.857506', '22.343716', 3, 4, 1),
(451424, 451400, '大新县', '大新', '107.200806', '22.833368', 3, 1, 1),
(451425, 451400, '天等县', '天等', '107.14244', '23.082483', 3, 7, 1),
(451481, 451400, '凭祥市', '凭祥', '106.75904', '22.108883', 3, 6, 1),
(460000, 0, '海南省', '海南', '110.33119', '20.031971', 1, 21, 1),
(460100, 460000, '海口市', '海口', '110.33119', '20.031971', 2, 8, 1),
(460105, 460100, '秀英区', '秀英', '110.282394', '20.008144', 3, 4, 1),
(460106, 460100, '龙华区', '龙华', '110.330376', '20.031027', 3, 1, 1),
(460107, 460100, '琼山区', '琼山', '110.35472', '20.00105', 3, 3, 1),
(460108, 460100, '美兰区', '美兰', '110.35657', '20.03074', 3, 2, 1),
(460200, 460000, '三亚市', '三亚', '109.50827', '18.247871', 2, 15, 1),
(460300, 460000, '三沙市', '三沙', '112.34882', '16.83104', 2, 14, 1),
(460321, 460300, '西沙群岛', '西沙', '111.792946', '16.204546', 3, 2, 1),
(460322, 460300, '南沙群岛', '南沙', '116.75', '11.471888', 3, 1, 1),
(460323, 460300, '中沙群岛的岛礁及其海域', '中沙', '117.740074', '15.112856', 3, 3, 1),
(469001, 460000, '五指山市', '五指山', '109.51666', '18.77692', 2, 19, 1),
(469002, 460000, '琼海市', '琼海', '110.46678', '19.246012', 2, 12, 1),
(469003, 460000, '儋州市', '儋州', '109.57678', '19.517487', 2, 5, 1),
(469005, 460000, '文昌市', '文昌', '110.753975', '19.612986', 2, 18, 1),
(469006, 460000, '万宁市', '万宁', '110.388794', '18.796215', 2, 17, 1),
(469007, 460000, '东方市', '东方', '108.653786', '19.10198', 2, 7, 1),
(469025, 460000, '定安县', '定安', '110.349236', '19.684965', 2, 6, 1),
(469026, 460000, '屯昌县', '屯昌', '110.102776', '19.362917', 2, 16, 1),
(469027, 460000, '澄迈县', '澄迈', '110.00715', '19.737095', 2, 4, 1),
(469028, 460000, '临高县', '临高', '109.6877', '19.908293', 2, 10, 1),
(469030, 460000, '白沙黎族自治县', '白沙', '109.45261', '19.224585', 2, 1, 1),
(469031, 460000, '昌江黎族自治县', '昌江', '109.05335', '19.260967', 2, 3, 1),
(469033, 460000, '乐东黎族自治县', '乐东', '109.175446', '18.74758', 2, 9, 1),
(469034, 460000, '陵水黎族自治县', '陵水', '110.03722', '18.505007', 2, 11, 1),
(469035, 460000, '保亭黎族苗族自治县', '保亭', '109.70245', '18.636372', 2, 2, 1),
(469036, 460000, '琼中黎族苗族自治县', '琼中', '109.84', '19.03557', 2, 13, 1),
(500000, 0, '重庆', '重庆', '106.50496', '29.533155', 1, 22, 1),
(500100, 500000, '重庆市', '重庆', '106.50496', '29.533155', 2, 1, 1),
(500101, 500100, '万州区', '万州', '108.38025', '30.807808', 3, 28, 1),
(500102, 500100, '涪陵区', '涪陵', '107.394905', '29.703651', 3, 11, 1),
(500103, 500100, '渝中区', '渝中', '106.56288', '29.556742', 3, 37, 1),
(500104, 500100, '大渡口区', '大渡口', '106.48613', '29.481003', 3, 6, 1),
(500105, 500100, '江北区', '江北', '106.532845', '29.575352', 3, 13, 1),
(500106, 500100, '沙坪坝区', '沙坪坝', '106.4542', '29.541224', 3, 24, 1),
(500107, 500100, '九龙坡区', '九龙坡', '106.48099', '29.523493', 3, 15, 1),
(500108, 500100, '南岸区', '南岸', '106.560814', '29.523993', 3, 18, 1),
(500109, 500100, '北碚区', '北碚', '106.43787', '29.82543', 3, 2, 1),
(500112, 500100, '渝北区', '渝北', '106.51285', '29.601452', 3, 35, 1),
(500113, 500100, '巴南区', '巴南', '106.519424', '29.38192', 3, 1, 1),
(500114, 500100, '黔江区', '黔江', '108.78258', '29.527548', 3, 21, 1),
(500115, 500100, '长寿区', '长寿', '107.07485', '29.833672', 3, 4, 1),
(500222, 500100, '綦江区', '綦江', '106.65142', '29.028091', 3, 22, 1),
(500223, 500100, '潼南县', '潼南', '105.84182', '30.189554', 3, 27, 1),
(500224, 500100, '铜梁县', '铜梁', '106.05495', '29.839945', 3, 26, 1),
(500225, 500100, '大足区', '大足', '105.71532', '29.700499', 3, 7, 1),
(500226, 500100, '荣昌县', '荣昌', '105.59406', '29.403627', 3, 23, 1),
(500227, 500100, '璧山县', '璧山', '106.231125', '29.59358', 3, 3, 1),
(500228, 500100, '梁平县', '梁平', '107.80003', '30.672169', 3, 17, 1),
(500229, 500100, '城口县', '城口', '108.6649', '31.946293', 3, 5, 1),
(500230, 500100, '丰都县', '丰都', '107.73248', '29.866425', 3, 9, 1),
(500231, 500100, '垫江县', '垫江', '107.348694', '30.330011', 3, 8, 1),
(500232, 500100, '武隆县', '武隆', '107.75655', '29.32376', 3, 29, 1),
(500233, 500100, '忠县', '忠县', '108.03752', '30.291536', 3, 38, 1),
(500234, 500100, '开县', '开县', '108.413315', '31.167734', 3, 16, 1),
(500235, 500100, '云阳县', '云阳', '108.6977', '30.930529', 3, 36, 1),
(500236, 500100, '奉节县', '奉节', '109.465775', '31.019966', 3, 10, 1),
(500237, 500100, '巫山县', '巫山', '109.87893', '31.074842', 3, 30, 1),
(500238, 500100, '巫溪县', '巫溪', '109.628914', '31.3966', 3, 31, 1),
(500240, 500100, '石柱土家族自治县', '石柱', '108.11245', '29.99853', 3, 25, 1),
(500241, 500100, '秀山土家族苗族自治县', '秀山', '108.99604', '28.444773', 3, 32, 1),
(500242, 500100, '酉阳土家族苗族自治县', '酉阳', '108.767204', '28.839828', 3, 34, 1),
(500243, 500100, '彭水苗族土家族自治县', '彭水', '108.16655', '29.293856', 3, 20, 1),
(500381, 500100, '江津区', '江津', '106.25316', '29.283386', 3, 14, 1),
(500382, 500100, '合川区', '合川', '106.26556', '29.990993', 3, 12, 1),
(500383, 500100, '永川区', '永川', '105.894714', '29.348747', 3, 33, 1),
(500384, 500100, '南川区', '南川', '107.09815', '29.156647', 3, 19, 1),
(510000, 0, '四川省', '四川', '104.065735', '30.659462', 1, 23, 1),
(510100, 510000, '成都市', '成都', '104.065735', '30.659462', 2, 3, 1),
(510104, 510100, '锦江区', '锦江', '104.080986', '30.657688', 3, 5, 1),
(510105, 510100, '青羊区', '青羊', '104.05573', '30.667648', 3, 13, 1),
(510106, 510100, '金牛区', '金牛', '104.04349', '30.692059', 3, 6, 1),
(510107, 510100, '武侯区', '武侯', '104.05167', '30.630861', 3, 17, 1),
(510108, 510100, '成华区', '成华', '104.10308', '30.660275', 3, 1, 1),
(510112, 510100, '龙泉驿区', '龙泉驿', '104.26918', '30.56065', 3, 8, 1),
(510113, 510100, '青白江区', '青白江', '104.25494', '30.883438', 3, 12, 1),
(510114, 510100, '新都区', '新都', '104.16022', '30.824223', 3, 18, 1),
(510115, 510100, '温江区', '温江', '103.83678', '30.697996', 3, 16, 1),
(510121, 510100, '金堂县', '金堂', '104.4156', '30.858418', 3, 7, 1),
(510122, 510100, '双流县', '双流', '103.92271', '30.573242', 3, 15, 1),
(510124, 510100, '郫县', '郫县', '103.88784', '30.808752', 3, 10, 1),
(510129, 510100, '大邑县', '大邑', '103.5224', '30.586601', 3, 3, 1),
(510131, 510100, '蒲江县', '蒲江', '103.51154', '30.194359', 3, 11, 1),
(510132, 510100, '新津县', '新津', '103.81245', '30.414284', 3, 19, 1),
(510181, 510100, '都江堰市', '都江堰', '103.6279', '30.99114', 3, 4, 1),
(510182, 510100, '彭州市', '彭州', '103.94117', '30.98516', 3, 9, 1),
(510183, 510100, '邛崃市', '邛崃', '103.46143', '30.41327', 3, 14, 1),
(510184, 510100, '崇州市', '崇州', '103.67105', '30.631477', 3, 2, 1),
(510300, 510000, '自贡市', '自贡', '104.773445', '29.352764', 2, 20, 1),
(510302, 510300, '自流井区', '自流井', '104.77819', '29.343231', 3, 6, 1),
(510303, 510300, '贡井区', '贡井', '104.71437', '29.345675', 3, 3, 1),
(510304, 510300, '大安区', '大安', '104.783226', '29.367136', 3, 1, 1),
(510311, 510300, '沿滩区', '沿滩', '104.87642', '29.27252', 3, 5, 1),
(510321, 510300, '荣县', '荣县', '104.423935', '29.454851', 3, 4, 1),
(510322, 510300, '富顺县', '富顺', '104.98425', '29.181282', 3, 2, 1),
(510400, 510000, '攀枝花市', '攀枝花', '101.716', '26.580446', 2, 16, 1),
(510402, 510400, '东区', '东区', '101.71513', '26.580887', 3, 1, 1),
(510403, 510400, '西区', '西区', '101.63797', '26.596775', 3, 4, 1),
(510411, 510400, '仁和区', '仁和', '101.737915', '26.497185', 3, 3, 1),
(510421, 510400, '米易县', '米易', '102.10988', '26.887474', 3, 2, 1),
(510422, 510400, '盐边县', '盐边', '101.851845', '26.67762', 3, 5, 1),
(510500, 510000, '泸州市', '泸州', '105.44335', '28.889137', 2, 11, 1),
(510502, 510500, '江阳区', '江阳', '105.44513', '28.882889', 3, 3, 1),
(510503, 510500, '纳溪区', '纳溪', '105.37721', '28.77631', 3, 6, 1),
(510504, 510500, '龙马潭区', '龙马潭', '105.43523', '28.897572', 3, 4, 1),
(510521, 510500, '泸县', '泸县', '105.376335', '29.151287', 3, 5, 1),
(510522, 510500, '合江县', '合江', '105.8341', '28.810326', 3, 2, 1),
(510524, 510500, '叙永县', '叙永', '105.437775', '28.16792', 3, 7, 1),
(510525, 510500, '古蔺县', '古蔺', '105.81336', '28.03948', 3, 1, 1),
(510600, 510000, '德阳市', '德阳', '104.39865', '31.12799', 2, 5, 1),
(510603, 510600, '旌阳区', '旌阳', '104.38965', '31.130428', 3, 2, 1),
(510623, 510600, '中江县', '中江', '104.67783', '31.03681', 3, 6, 1),
(510626, 510600, '罗江县', '罗江', '104.507126', '31.303282', 3, 3, 1),
(510681, 510600, '广汉市', '广汉', '104.281906', '30.97715', 3, 1, 1),
(510682, 510600, '什邡市', '什邡', '104.17365', '31.12688', 3, 5, 1),
(510683, 510600, '绵竹市', '绵竹', '104.200165', '31.343084', 3, 4, 1),
(510700, 510000, '绵阳市', '绵阳', '104.74172', '31.46402', 2, 13, 1),
(510703, 510700, '涪城区', '涪城', '104.740974', '31.463556', 3, 3, 1),
(510704, 510700, '游仙区', '游仙', '104.770004', '31.484772', 3, 8, 1),
(510722, 510700, '三台县', '三台', '105.09032', '31.090908', 3, 6, 1),
(510723, 510700, '盐亭县', '盐亭', '105.39199', '31.22318', 3, 7, 1),
(510724, 510700, '安县', '安县', '104.56034', '31.53894', 3, 1, 1),
(510725, 510700, '梓潼县', '梓潼', '105.16353', '31.635225', 3, 9, 1),
(510726, 510700, '北川羌族自治县', '北川', '104.46807', '31.615864', 3, 2, 1),
(510727, 510700, '平武县', '平武', '104.530556', '32.40759', 3, 5, 1),
(510781, 510700, '江油市', '江油', '104.74443', '31.776386', 3, 4, 1),
(510800, 510000, '广元市', '广元', '105.82976', '32.433666', 2, 8, 1),
(510802, 510800, '利州区', '利州', '105.826195', '32.432278', 3, 4, 1),
(510811, 510800, '昭化区', '昭化', '105.96412', '32.32279', 3, 7, 1),
(510812, 510800, '朝天区', '朝天', '105.88917', '32.64263', 3, 2, 1),
(510821, 510800, '旺苍县', '旺苍', '106.29043', '32.22833', 3, 6, 1),
(510822, 510800, '青川县', '青川', '105.238846', '32.585655', 3, 5, 1),
(510823, 510800, '剑阁县', '剑阁', '105.52704', '32.28652', 3, 3, 1),
(510824, 510800, '苍溪县', '苍溪', '105.939705', '31.73225', 3, 1, 1),
(510900, 510000, '遂宁市', '遂宁', '105.57133', '30.513311', 2, 17, 1),
(510903, 510900, '船山区', '船山', '105.582214', '30.502647', 3, 2, 1),
(510904, 510900, '安居区', '安居', '105.45938', '30.34612', 3, 1, 1),
(510921, 510900, '蓬溪县', '蓬溪', '105.7137', '30.774883', 3, 4, 1),
(510922, 510900, '射洪县', '射洪', '105.38185', '30.868752', 3, 5, 1),
(510923, 510900, '大英县', '大英', '105.25219', '30.581572', 3, 3, 1),
(511000, 510000, '内江市', '内江', '105.06614', '29.58708', 2, 15, 1),
(511002, 511000, '市中区', '市中', '105.06547', '29.585264', 3, 3, 1),
(511011, 511000, '东兴区', '东兴', '105.0672', '29.600107', 3, 1, 1),
(511024, 511000, '威远县', '威远', '104.66833', '29.52686', 3, 4, 1),
(511025, 511000, '资中县', '资中', '104.85246', '29.775295', 3, 5, 1),
(511028, 511000, '隆昌县', '隆昌', '105.28807', '29.338161', 3, 2, 1),
(511100, 510000, '乐山市', '乐山', '103.76126', '29.582024', 2, 9, 1),
(511102, 511100, '市中区', '市中', '103.75539', '29.588327', 3, 10, 1),
(511111, 511100, '沙湾区', '沙湾', '103.54996', '29.416536', 3, 9, 1),
(511112, 511100, '五通桥区', '五通桥', '103.81683', '29.406185', 3, 11, 1),
(511113, 511100, '金口河区', '金口河', '103.07783', '29.24602', 3, 5, 1),
(511123, 511100, '犍为县', '犍为', '103.94427', '29.209782', 3, 8, 1),
(511124, 511100, '井研县', '井研', '104.06885', '29.651646', 3, 4, 1),
(511126, 511100, '夹江县', '夹江', '103.578865', '29.741018', 3, 3, 1),
(511129, 511100, '沐川县', '沐川', '103.90211', '28.956339', 3, 7, 1),
(511132, 511100, '峨边彝族自治县', '峨边', '103.262146', '29.23027', 3, 1, 1),
(511133, 511100, '马边彝族自治县', '马边', '103.54685', '28.838934', 3, 6, 1),
(511181, 511100, '峨眉山市', '峨眉山', '103.492485', '29.597479', 3, 2, 1),
(511300, 510000, '南充市', '南充', '106.08298', '30.79528', 2, 14, 1),
(511302, 511300, '顺庆区', '顺庆', '106.08409', '30.795572', 3, 6, 1),
(511303, 511300, '高坪区', '高坪', '106.10899', '30.781809', 3, 1, 1),
(511304, 511300, '嘉陵区', '嘉陵', '106.067024', '30.762976', 3, 2, 1),
(511321, 511300, '南部县', '南部', '106.061134', '31.349407', 3, 4, 1),
(511322, 511300, '营山县', '营山', '106.564896', '31.075907', 3, 9, 1),
(511323, 511300, '蓬安县', '蓬安', '106.41349', '31.027979', 3, 5, 1),
(511324, 511300, '仪陇县', '仪陇', '106.29708', '31.271261', 3, 8, 1),
(511325, 511300, '西充县', '西充', '105.89302', '30.994616', 3, 7, 1),
(511381, 511300, '阆中市', '阆中', '105.975266', '31.580465', 3, 3, 1),
(511400, 510000, '眉山市', '眉山', '103.83179', '30.048319', 2, 12, 1),
(511402, 511400, '东坡区', '东坡', '103.83155', '30.048128', 3, 2, 1),
(511421, 511400, '仁寿县', '仁寿', '104.147644', '29.996721', 3, 6, 1),
(511422, 511400, '彭山县', '彭山', '103.8701', '30.192299', 3, 4, 1),
(511423, 511400, '洪雅县', '洪雅', '103.37501', '29.904867', 3, 3, 1),
(511424, 511400, '丹棱县', '丹棱', '103.51833', '30.01275', 3, 1, 1),
(511425, 511400, '青神县', '青神', '103.84613', '29.831469', 3, 5, 1),
(511500, 510000, '宜宾市', '宜宾', '104.63082', '28.76019', 2, 19, 1),
(511502, 511500, '翠屏区', '翠屏', '104.63023', '28.76018', 3, 2, 1),
(511521, 511500, '宜宾县', '宜宾', '104.54149', '28.695679', 3, 10, 1),
(511522, 511500, '南溪区', '南溪', '104.98113', '28.839806', 3, 7, 1),
(511523, 511500, '江安县', '江安', '105.068695', '28.728102', 3, 5, 1),
(511524, 511500, '长宁县', '长宁', '104.92112', '28.57727', 3, 1, 1),
(511525, 511500, '高县', '高县', '104.51919', '28.435677', 3, 3, 1),
(511526, 511500, '珙县', '珙县', '104.712265', '28.449041', 3, 4, 1),
(511527, 511500, '筠连县', '筠连', '104.50785', '28.162018', 3, 6, 1),
(511528, 511500, '兴文县', '兴文', '105.23655', '28.302988', 3, 9, 1),
(511529, 511500, '屏山县', '屏山', '104.16262', '28.64237', 3, 8, 1),
(511600, 510000, '广安市', '广安', '106.63337', '30.456398', 2, 7, 1),
(511602, 511600, '广安区', '广安', '106.632904', '30.456463', 3, 1, 1),
(511603, 511600, '前锋区', '前锋', '106.89328', '30.4963', 3, 4, 1),
(511621, 511600, '岳池县', '岳池', '106.44445', '30.533539', 3, 6, 1),
(511622, 511600, '武胜县', '武胜', '106.29247', '30.344292', 3, 5, 1),
(511623, 511600, '邻水县', '邻水', '106.93497', '30.334324', 3, 3, 1),
(511681, 511600, '华蓥市', '华蓥', '106.777885', '30.380573', 3, 2, 1),
(511700, 510000, '达州市', '达州', '107.50226', '31.209484', 2, 4, 1),
(511702, 511700, '通川区', '通川', '107.50106', '31.213522', 3, 5, 1),
(511721, 511700, '达川区', '达川', '107.50793', '31.199062', 3, 1, 1),
(511722, 511700, '宣汉县', '宣汉', '107.72225', '31.355024', 3, 7, 1),
(511723, 511700, '开江县', '开江', '107.864136', '31.085537', 3, 3, 1),
(511724, 511700, '大竹县', '大竹', '107.20742', '30.736288', 3, 2, 1),
(511725, 511700, '渠县', '渠县', '106.97075', '30.836348', 3, 4, 1),
(511781, 511700, '万源市', '万源', '108.037544', '32.06777', 3, 6, 1),
(511800, 510000, '雅安市', '雅安', '103.00103', '29.987722', 2, 18, 1),
(511802, 511800, '雨城区', '雨城', '103.003395', '29.98183', 3, 8, 1),
(511821, 511800, '名山区', '名山', '103.11221', '30.084719', 3, 4, 1),
(511822, 511800, '荥经县', '荥经', '102.84467', '29.795528', 3, 7, 1),
(511823, 511800, '汉源县', '汉源', '102.67715', '29.349915', 3, 2, 1),
(511824, 511800, '石棉县', '石棉', '102.35962', '29.234062', 3, 5, 1),
(511825, 511800, '天全县', '天全', '102.76346', '30.059956', 3, 6, 1),
(511826, 511800, '芦山县', '芦山', '102.92402', '30.152906', 3, 3, 1),
(511827, 511800, '宝兴县', '宝兴', '102.81338', '30.369026', 3, 1, 1),
(511900, 510000, '巴中市', '巴中', '106.75367', '31.858809', 2, 2, 1),
(511902, 511900, '巴州区', '巴州', '106.75367', '31.858366', 3, 1, 1),
(511903, 511900, '恩阳区', '恩阳', '106.63608', '31.789442', 3, 2, 1),
(511921, 511900, '通江县', '通江', '107.24762', '31.91212', 3, 5, 1),
(511922, 511900, '南江县', '南江', '106.843414', '32.353165', 3, 3, 1),
(511923, 511900, '平昌县', '平昌', '107.10194', '31.562815', 3, 4, 1),
(512000, 510000, '资阳市', '资阳', '104.641914', '30.122211', 2, 21, 1),
(512002, 512000, '雁江区', '雁江', '104.64234', '30.121687', 3, 4, 1),
(512021, 512000, '安岳县', '安岳', '105.33676', '30.099207', 3, 1, 1),
(512022, 512000, '乐至县', '乐至', '105.03114', '30.27562', 3, 3, 1),
(512081, 512000, '简阳市', '简阳', '104.55034', '30.390665', 3, 2, 1),
(513200, 510000, '阿坝藏族羌族自治州', '阿坝', '102.221375', '31.899792', 2, 1, 1),
(513221, 513200, '汶川县', '汶川', '103.58067', '31.47463', 3, 12, 1),
(513222, 513200, '理县', '理县', '103.16549', '31.436764', 3, 6, 1),
(513223, 513200, '茂县', '茂县', '103.850685', '31.680407', 3, 8, 1),
(513224, 513200, '松潘县', '松潘', '103.599174', '32.63838', 3, 11, 1),
(513225, 513200, '九寨沟县', '九寨沟', '104.23634', '33.262096', 3, 5, 1),
(513226, 513200, '金川县', '金川', '102.064644', '31.476357', 3, 4, 1),
(513227, 513200, '小金县', '小金', '102.36319', '30.999016', 3, 13, 1),
(513228, 513200, '黑水县', '黑水', '102.99081', '32.06172', 3, 2, 1),
(513229, 513200, '马尔康县', '马尔康', '102.22118', '31.899761', 3, 7, 1),
(513230, 513200, '壤塘县', '壤塘', '100.97913', '32.26489', 3, 9, 1),
(513231, 513200, '阿坝县', '阿坝', '101.70099', '32.904224', 3, 1, 1),
(513232, 513200, '若尔盖县', '若尔盖', '102.96372', '33.575935', 3, 10, 1),
(513233, 513200, '红原县', '红原', '102.54491', '32.793903', 3, 3, 1),
(513300, 510000, '甘孜藏族自治州', '甘孜', '101.96381', '30.050663', 2, 6, 1),
(513321, 513300, '康定县', '康定', '101.96406', '30.050737', 3, 10, 1),
(513322, 513300, '泸定县', '泸定', '102.23322', '29.912481', 3, 12, 1),
(513323, 513300, '丹巴县', '丹巴', '101.88612', '30.877083', 3, 3, 1),
(513324, 513300, '九龙县', '九龙', '101.50694', '29.001974', 3, 9, 1),
(513325, 513300, '雅江县', '雅江', '101.01573', '30.03225', 3, 18, 1),
(513326, 513300, '道孚县', '道孚', '101.12333', '30.978767', 3, 5, 1),
(513327, 513300, '炉霍县', '炉霍', '100.6795', '31.392673', 3, 13, 1),
(513328, 513300, '甘孜县', '甘孜', '99.99175', '31.61975', 3, 8, 1),
(513329, 513300, '新龙县', '新龙', '100.312096', '30.93896', 3, 17, 1),
(513330, 513300, '德格县', '德格', '98.57999', '31.806728', 3, 6, 1),
(513331, 513300, '白玉县', '白玉', '98.82434', '31.208805', 3, 1, 1),
(513332, 513300, '石渠县', '石渠', '98.10088', '32.975304', 3, 15, 1),
(513333, 513300, '色达县', '色达', '100.33166', '32.268776', 3, 14, 1),
(513334, 513300, '理塘县', '理塘', '100.26986', '29.991808', 3, 11, 1),
(513335, 513300, '巴塘县', '巴塘', '99.10904', '30.005724', 3, 2, 1),
(513336, 513300, '乡城县', '乡城', '99.79994', '28.930855', 3, 16, 1),
(513337, 513300, '稻城县', '稻城', '100.29669', '29.037544', 3, 4, 1),
(513338, 513300, '得荣县', '得荣', '99.28803', '28.71134', 3, 7, 1),
(513400, 510000, '凉山彝族自治州', '凉山', '102.25874', '27.886763', 2, 10, 1),
(513401, 513400, '西昌市', '西昌', '102.25876', '27.885786', 3, 13, 1),
(513422, 513400, '木里藏族自治县', '木里', '101.28018', '27.926859', 3, 10, 1),
(513423, 513400, '盐源县', '盐源', '101.50891', '27.423414', 3, 15, 1),
(513424, 513400, '德昌县', '德昌', '102.17885', '27.403828', 3, 2, 1),
(513425, 513400, '会理县', '会理', '102.24955', '26.658703', 3, 5, 1),
(513426, 513400, '会东县', '会东', '102.57899', '26.630713', 3, 4, 1),
(513427, 513400, '宁南县', '宁南', '102.75738', '27.065205', 3, 11, 1),
(513428, 513400, '普格县', '普格', '102.541084', '27.376827', 3, 12, 1),
(513429, 513400, '布拖县', '布拖', '102.8088', '27.709063', 3, 1, 1),
(513430, 513400, '金阳县', '金阳', '103.2487', '27.695915', 3, 6, 1),
(513431, 513400, '昭觉县', '昭觉', '102.843994', '28.010553', 3, 17, 1),
(513432, 513400, '喜德县', '喜德', '102.41234', '28.305487', 3, 14, 1),
(513433, 513400, '冕宁县', '冕宁', '102.170044', '28.550844', 3, 9, 1),
(513434, 513400, '越西县', '越西', '102.50887', '28.639631', 3, 16, 1),
(513435, 513400, '甘洛县', '甘洛', '102.775925', '28.977095', 3, 3, 1),
(513436, 513400, '美姑县', '美姑', '103.132', '28.327946', 3, 8, 1),
(513437, 513400, '雷波县', '雷波', '103.57159', '28.262945', 3, 7, 1),
(520000, 0, '贵州省', '贵州', '106.71348', '26.578342', 1, 24, 1),
(520100, 520000, '贵阳市', '贵阳', '106.71348', '26.578342', 2, 3, 1),
(520102, 520100, '南明区', '南明', '106.715965', '26.573744', 3, 5, 1),
(520103, 520100, '云岩区', '云岩', '106.713394', '26.58301', 3, 10, 1),
(520111, 520100, '花溪区', '花溪', '106.67079', '26.410463', 3, 3, 1),
(520112, 520100, '乌当区', '乌当', '106.76212', '26.630928', 3, 7, 1),
(520113, 520100, '白云区', '白云', '106.63303', '26.67685', 3, 1, 1),
(520121, 520100, '开阳县', '开阳', '106.96944', '27.056793', 3, 4, 1),
(520122, 520100, '息烽县', '息烽', '106.73769', '27.092665', 3, 8, 1),
(520123, 520100, '修文县', '修文', '106.59922', '26.840672', 3, 9, 1),
(520151, 520100, '观山湖区', '观山湖', '106.71348', '26.578342', 3, 2, 1),
(520181, 520100, '清镇市', '清镇', '106.470276', '26.551289', 3, 6, 1),
(520200, 520000, '六盘水市', '六盘水', '104.84674', '26.584642', 2, 4, 1),
(520201, 520200, '钟山区', '钟山', '104.846245', '26.584805', 3, 4, 1),
(520203, 520200, '六枝特区', '六枝特', '105.474236', '26.210663', 3, 1, 1),
(520221, 520200, '水城县', '水城', '104.95685', '26.540478', 3, 3, 1),
(520222, 520200, '盘县', '盘县', '104.46837', '25.706966', 3, 2, 1),
(520300, 520000, '遵义市', '遵义', '106.93726', '27.706627', 2, 9, 1),
(520302, 520300, '红花岗区', '红花岗', '106.94379', '27.694395', 3, 4, 1),
(520303, 520300, '汇川区', '汇川', '106.93726', '27.706627', 3, 5, 1),
(520321, 520300, '遵义县', '遵义', '106.831665', '27.535288', 3, 14, 1),
(520322, 520300, '桐梓县', '桐梓', '106.82659', '28.13156', 3, 9, 1),
(520323, 520300, '绥阳县', '绥阳', '107.191025', '27.951342', 3, 8, 1),
(520324, 520300, '正安县', '正安', '107.44187', '28.550337', 3, 13, 1),
(520325, 520300, '道真仡佬族苗族自治县', '道真', '107.60534', '28.880089', 3, 2, 1),
(520326, 520300, '务川仡佬族苗族自治县', '务川', '107.887856', '28.521566', 3, 10, 1),
(520327, 520300, '凤冈县', '凤冈', '107.72202', '27.960857', 3, 3, 1),
(520328, 520300, '湄潭县', '湄潭', '107.485725', '27.765839', 3, 6, 1),
(520329, 520300, '余庆县', '余庆', '107.89256', '27.221552', 3, 12, 1),
(520330, 520300, '习水县', '习水', '106.20095', '28.327826', 3, 11, 1),
(520381, 520300, '赤水市', '赤水', '105.69811', '28.587057', 3, 1, 1),
(520382, 520300, '仁怀市', '仁怀', '106.412476', '27.803377', 3, 7, 1),
(520400, 520000, '安顺市', '安顺', '105.93219', '26.245544', 2, 1, 1),
(520402, 520400, '西秀区', '西秀', '105.94617', '26.248323', 3, 4, 1),
(520421, 520400, '平坝县', '平坝', '106.25994', '26.40608', 3, 2, 1),
(520422, 520400, '普定县', '普定', '105.745605', '26.305794', 3, 3, 1),
(520423, 520400, '镇宁布依族苗族自治县', '镇宁', '105.768654', '26.056095', 3, 5, 1),
(520424, 520400, '关岭布依族苗族自治县', '关岭', '105.618454', '25.944248', 3, 1, 1),
(520425, 520400, '紫云苗族布依族自治县', '紫云', '106.08452', '25.751568', 3, 6, 1),
(522200, 520000, '铜仁市', '铜仁', '109.19155', '27.718346', 2, 8, 1),
(522201, 522200, '碧江区', '碧江', '109.192116', '27.718744', 3, 1, 1),
(522222, 522200, '江口县', '江口', '108.84843', '27.691904', 3, 3, 1),
(522223, 522200, '玉屏侗族自治县', '玉屏', '108.917885', '27.238024', 3, 10, 1),
(522224, 522200, '石阡县', '石阡', '108.22985', '27.519386', 3, 4, 1),
(522225, 522200, '思南县', '思南', '108.25583', '27.941332', 3, 5, 1),
(522226, 522200, '印江土家族苗族自治县', '印江', '108.40552', '27.997976', 3, 9, 1),
(522227, 522200, '德江县', '德江', '108.11732', '28.26094', 3, 2, 1),
(522228, 522200, '沿河土家族自治县', '沿河', '108.49574', '28.560488', 3, 8, 1),
(522229, 522200, '松桃苗族自治县', '松桃', '109.20263', '28.165419', 3, 6, 1),
(522230, 522200, '万山区', '万山', '109.21199', '27.51903', 3, 7, 1),
(522300, 520000, '黔西南布依族苗族自治州', '黔西南', '104.89797', '25.08812', 2, 7, 1),
(522301, 522300, '兴义市', '兴义', '104.89798', '25.088598', 3, 7, 1),
(522322, 522300, '兴仁县', '兴仁', '105.19278', '25.431377', 3, 6, 1),
(522323, 522300, '普安县', '普安', '104.955345', '25.786404', 3, 3, 1),
(522324, 522300, '晴隆县', '晴隆', '105.21877', '25.832882', 3, 4, 1),
(522325, 522300, '贞丰县', '贞丰', '105.65013', '25.385752', 3, 8, 1),
(522326, 522300, '望谟县', '望谟', '106.09156', '25.166668', 3, 5, 1),
(522327, 522300, '册亨县', '册亨', '105.81241', '24.983337', 3, 2, 1),
(522328, 522300, '安龙县', '安龙', '105.4715', '25.10896', 3, 1, 1),
(522400, 520000, '毕节市', '毕节', '105.28501', '27.301693', 2, 2, 1),
(522401, 522400, '七星关区', '七星关', '105.28485', '27.302086', 3, 6, 1),
(522422, 522400, '大方县', '大方', '105.60925', '27.14352', 3, 1, 1),
(522423, 522400, '黔西县', '黔西', '106.0383', '27.024923', 3, 5, 1),
(522424, 522400, '金沙县', '金沙', '106.2221', '27.459694', 3, 3, 1),
(522425, 522400, '织金县', '织金', '105.769', '26.668497', 3, 8, 1),
(522426, 522400, '纳雍县', '纳雍', '105.37532', '26.769875', 3, 4, 1),
(522427, 522400, '威宁彝族回族苗族自治县', '威宁', '104.28652', '26.859098', 3, 7, 1),
(522428, 522400, '赫章县', '赫章', '104.72644', '27.119244', 3, 2, 1),
(522600, 520000, '黔东南苗族侗族自治州', '黔东南', '107.977486', '26.583351', 2, 5, 1),
(522601, 522600, '凯里市', '凯里', '107.97754', '26.582964', 3, 7, 1),
(522622, 522600, '黄平县', '黄平', '107.90134', '26.896973', 3, 4, 1),
(522623, 522600, '施秉县', '施秉', '108.12678', '27.034657', 3, 13, 1),
(522624, 522600, '三穗县', '三穗', '108.68112', '26.959885', 3, 12, 1),
(522625, 522600, '镇远县', '镇远', '108.42365', '27.050234', 3, 16, 1),
(522626, 522600, '岑巩县', '岑巩', '108.81646', '27.173244', 3, 1, 1),
(522627, 522600, '天柱县', '天柱', '109.2128', '26.909683', 3, 15, 1),
(522628, 522600, '锦屏县', '锦屏', '109.20252', '26.680626', 3, 6, 1),
(522629, 522600, '剑河县', '剑河', '108.4405', '26.727348', 3, 5, 1),
(522630, 522600, '台江县', '台江', '108.31464', '26.669138', 3, 14, 1),
(522631, 522600, '黎平县', '黎平', '109.136505', '26.230637', 3, 9, 1),
(522632, 522600, '榕江县', '榕江', '108.52103', '25.931086', 3, 11, 1),
(522633, 522600, '从江县', '从江', '108.91265', '25.747059', 3, 2, 1),
(522634, 522600, '雷山县', '雷山', '108.07961', '26.381027', 3, 8, 1),
(522635, 522600, '麻江县', '麻江', '107.59317', '26.494802', 3, 10, 1),
(522636, 522600, '丹寨县', '丹寨', '107.79481', '26.199497', 3, 3, 1),
(522700, 520000, '黔南布依族苗族自治州', '黔南', '107.51716', '26.258219', 2, 6, 1),
(522701, 522700, '都匀市', '都匀', '107.51702', '26.258205', 3, 3, 1),
(522702, 522700, '福泉市', '福泉', '107.51351', '26.702509', 3, 4, 1),
(522722, 522700, '荔波县', '荔波', '107.8838', '25.41224', 3, 7, 1),
(522723, 522700, '贵定县', '贵定', '107.23359', '26.580807', 3, 5, 1),
(522725, 522700, '瓮安县', '瓮安', '107.47842', '27.06634', 3, 12, 1),
(522726, 522700, '独山县', '独山', '107.542755', '25.826283', 3, 2, 1),
(522727, 522700, '平塘县', '平塘', '107.32405', '25.831802', 3, 10, 1),
(522728, 522700, '罗甸县', '罗甸', '106.75001', '25.429893', 3, 9, 1),
(522729, 522700, '长顺县', '长顺', '106.44737', '26.022116', 3, 1, 1),
(522730, 522700, '龙里县', '龙里', '106.97773', '26.448809', 3, 8, 1),
(522731, 522700, '惠水县', '惠水', '106.657845', '26.128637', 3, 6, 1),
(522732, 522700, '三都水族自治县', '三都', '107.87747', '25.985184', 3, 11, 1),
(530000, 0, '云南省', '云南', '102.71225', '25.04061', 1, 25, 1),
(530100, 530000, '昆明市', '昆明', '102.71225', '25.04061', 2, 7, 1),
(530102, 530100, '五华区', '五华', '102.704414', '25.042166', 3, 11, 1),
(530103, 530100, '盘龙区', '盘龙', '102.72904', '25.070238', 3, 8, 1),
(530111, 530100, '官渡区', '官渡', '102.723434', '25.021212', 3, 5, 1),
(530112, 530100, '西山区', '西山', '102.7059', '25.02436', 3, 12, 1),
(530113, 530100, '东川区', '东川', '103.182', '26.08349', 3, 3, 1),
(530121, 530100, '呈贡区', '呈贡', '102.801384', '24.889275', 3, 2, 1),
(530122, 530100, '晋宁县', '晋宁', '102.594986', '24.666945', 3, 6, 1),
(530124, 530100, '富民县', '富民', '102.49789', '25.219667', 3, 4, 1),
(530125, 530100, '宜良县', '宜良', '103.14599', '24.918215', 3, 14, 1),
(530126, 530100, '石林彝族自治县', '石林', '103.271965', '24.754545', 3, 9, 1),
(530127, 530100, '嵩明县', '嵩明', '103.03878', '25.335087', 3, 10, 1),
(530128, 530100, '禄劝彝族苗族自治县', '禄劝', '102.46905', '25.556534', 3, 7, 1),
(530129, 530100, '寻甸回族彝族自治县', '寻甸', '103.25759', '25.559475', 3, 13, 1),
(530181, 530100, '安宁市', '安宁', '102.48554', '24.921785', 3, 1, 1),
(530300, 530000, '曲靖市', '曲靖', '103.79785', '25.501556', 2, 12, 1),
(530302, 530300, '麒麟区', '麒麟', '103.79806', '25.501268', 3, 6, 1),
(530321, 530300, '马龙县', '马龙', '103.57876', '25.429451', 3, 5, 1),
(530322, 530300, '陆良县', '陆良', '103.655235', '25.022879', 3, 3, 1),
(530323, 530300, '师宗县', '师宗', '103.993805', '24.825682', 3, 7, 1),
(530324, 530300, '罗平县', '罗平', '104.309265', '24.885708', 3, 4, 1),
(530325, 530300, '富源县', '富源', '104.25692', '25.67064', 3, 1, 1),
(530326, 530300, '会泽县', '会泽', '103.30004', '26.41286', 3, 2, 1),
(530328, 530300, '沾益县', '沾益', '103.81926', '25.600878', 3, 9, 1),
(530381, 530300, '宣威市', '宣威', '104.09554', '26.227777', 3, 8, 1),
(530400, 530000, '玉溪市', '玉溪', '102.54391', '24.35046', 2, 15, 1),
(530402, 530400, '红塔区', '红塔', '102.543465', '24.350754', 3, 3, 1),
(530421, 530400, '江川县', '江川', '102.74984', '24.291006', 3, 5, 1),
(530422, 530400, '澄江县', '澄江', '102.91665', '24.66968', 3, 1, 1),
(530423, 530400, '通海县', '通海', '102.76004', '24.112206', 3, 6, 1),
(530424, 530400, '华宁县', '华宁', '102.928986', '24.189808', 3, 4, 1),
(530425, 530400, '易门县', '易门', '102.16211', '24.669598', 3, 8, 1),
(530426, 530400, '峨山彝族自治县', '峨山', '102.40436', '24.173256', 3, 2, 1),
(530427, 530400, '新平彝族傣族自治县', '新平', '101.990906', '24.0664', 3, 7, 1),
(530428, 530400, '元江哈尼族彝族傣族自治县', '元江', '101.99966', '23.597618', 3, 9, 1),
(530500, 530000, '保山市', '保山', '99.16713', '25.111801', 2, 1, 1),
(530502, 530500, '隆阳区', '隆阳', '99.165825', '25.112144', 3, 3, 1),
(530521, 530500, '施甸县', '施甸', '99.18376', '24.730846', 3, 4, 1),
(530522, 530500, '腾冲县', '腾冲', '98.49729', '25.01757', 3, 5, 1),
(530523, 530500, '龙陵县', '龙陵', '98.693565', '24.591911', 3, 2, 1),
(530524, 530500, '昌宁县', '昌宁', '99.61234', '24.823662', 3, 1, 1),
(530600, 530000, '昭通市', '昭通', '103.71722', '27.337', 2, 16, 1),
(530602, 530600, '昭阳区', '昭阳', '103.71727', '27.336636', 3, 10, 1),
(530621, 530600, '鲁甸县', '鲁甸', '103.54933', '27.191637', 3, 2, 1),
(530622, 530600, '巧家县', '巧家', '102.92928', '26.9117', 3, 3, 1),
(530623, 530600, '盐津县', '盐津', '104.23506', '28.106922', 3, 7, 1),
(530624, 530600, '大关县', '大关', '103.89161', '27.747114', 3, 1, 1),
(530625, 530600, '永善县', '永善', '103.63732', '28.231525', 3, 9, 1),
(530626, 530600, '绥江县', '绥江', '103.9611', '28.599953', 3, 5, 1),
(530627, 530600, '镇雄县', '镇雄', '104.873055', '27.436268', 3, 11, 1),
(530628, 530600, '彝良县', '彝良', '104.04849', '27.627424', 3, 8, 1),
(530629, 530600, '威信县', '威信', '105.04869', '27.843382', 3, 6, 1),
(530630, 530600, '水富县', '水富', '104.415375', '28.629688', 3, 4, 1),
(530700, 530000, '丽江市', '丽江', '100.233025', '26.872108', 2, 8, 1),
(530702, 530700, '古城区', '古城', '100.23441', '26.872229', 3, 1, 1),
(530721, 530700, '玉龙纳西族自治县', '玉龙', '100.23831', '26.830593', 3, 5, 1),
(530722, 530700, '永胜县', '永胜', '100.7509', '26.685623', 3, 4, 1),
(530723, 530700, '华坪县', '华坪', '101.2678', '26.628834', 3, 2, 1),
(530724, 530700, '宁蒗彝族自治县', '宁蒗', '100.852425', '27.281109', 3, 3, 1),
(530800, 530000, '普洱市', '普洱', '100.97234', '22.77732', 2, 11, 1),
(530802, 530800, '思茅区', '思茅', '100.97323', '22.776594', 3, 8, 1),
(530821, 530800, '宁洱哈尼族彝族自治县', '宁洱', '101.04524', '23.062508', 3, 7, 1),
(530822, 530800, '墨江哈尼族自治县', '墨江', '101.68761', '23.428165', 3, 6, 1),
(530823, 530800, '景东彝族自治县', '景东', '100.84001', '24.448523', 3, 2, 1),
(530824, 530800, '景谷傣族彝族自治县', '景谷', '100.70142', '23.500278', 3, 3, 1),
(530825, 530800, '镇沅彝族哈尼族拉祜族自治县', '镇沅', '101.10851', '24.005713', 3, 10, 1),
(530826, 530800, '江城哈尼族彝族自治县', '江城', '101.859146', '22.58336', 3, 1, 1),
(530827, 530800, '孟连傣族拉祜族佤族自治县', '孟连', '99.5854', '22.325924', 3, 5, 1),
(530828, 530800, '澜沧拉祜族自治县', '澜沧', '99.9312', '22.553083', 3, 4, 1),
(530829, 530800, '西盟佤族自治县', '西盟', '99.594376', '22.644423', 3, 9, 1),
(530900, 530000, '临沧市', '临沧', '100.08697', '23.886566', 2, 9, 1),
(530902, 530900, '临翔区', '临翔', '100.08649', '23.886562', 3, 4, 1),
(530921, 530900, '凤庆县', '凤庆', '99.91871', '24.592737', 3, 2, 1),
(530922, 530900, '云县', '云县', '100.12563', '24.439026', 3, 7, 1),
(530923, 530900, '永德县', '永德', '99.25368', '24.028158', 3, 6, 1),
(530924, 530900, '镇康县', '镇康', '98.82743', '23.761415', 3, 8, 1),
(530925, 530900, '双江拉祜族佤族布朗族傣族自治县', '双江', '99.82442', '23.477476', 3, 5, 1),
(530926, 530900, '耿马傣族佤族自治县', '耿马', '99.4025', '23.534578', 3, 3, 1),
(530927, 530900, '沧源佤族自治县', '沧源', '99.2474', '23.146887', 3, 1, 1),
(532300, 530000, '楚雄彝族自治州', '楚雄', '101.54604', '25.041988', 2, 2, 1),
(532301, 532300, '楚雄市', '楚雄', '101.54614', '25.040913', 3, 1, 1),
(532322, 532300, '双柏县', '双柏', '101.63824', '24.685095', 3, 6, 1),
(532323, 532300, '牟定县', '牟定', '101.543045', '25.31211', 3, 4, 1),
(532324, 532300, '南华县', '南华', '101.274994', '25.192408', 3, 5, 1),
(532325, 532300, '姚安县', '姚安', '101.238396', '25.505404', 3, 8, 1),
(532326, 532300, '大姚县', '大姚', '101.3236', '25.722347', 3, 2, 1),
(532327, 532300, '永仁县', '永仁', '101.67117', '26.056316', 3, 9, 1),
(532328, 532300, '元谋县', '元谋', '101.870834', '25.703314', 3, 10, 1),
(532329, 532300, '武定县', '武定', '102.406784', '25.5301', 3, 7, 1),
(532331, 532300, '禄丰县', '禄丰', '102.07569', '25.14327', 3, 3, 1),
(532500, 530000, '红河哈尼族彝族自治州', '红河', '103.384186', '23.366776', 2, 6, 1),
(532501, 532500, '个旧市', '个旧', '103.154755', '23.360382', 3, 1, 1),
(532502, 532500, '开远市', '开远', '103.25868', '23.713833', 3, 6, 1),
(532522, 532500, '蒙自市', '蒙自', '103.385', '23.366842', 3, 9, 1),
(532523, 532500, '屏边苗族自治县', '屏边', '103.687225', '22.987013', 3, 11, 1),
(532524, 532500, '建水县', '建水', '102.820496', '23.618387', 3, 4, 1),
(532525, 532500, '石屏县', '石屏', '102.48447', '23.712568', 3, 12, 1),
(532526, 532500, '弥勒市', '弥勒', '103.43699', '24.40837', 3, 10, 1),
(532527, 532500, '泸西县', '泸西', '103.75962', '24.532368', 3, 7, 1),
(532528, 532500, '元阳县', '元阳', '102.83706', '23.219772', 3, 13, 1),
(532529, 532500, '红河县', '红河', '102.42121', '23.36919', 3, 3, 1),
(532530, 532500, '金平苗族瑶族傣族自治县', '金平', '103.228355', '22.779982', 3, 5, 1),
(532531, 532500, '绿春县', '绿春', '102.39286', '22.99352', 3, 8, 1),
(532532, 532500, '河口瑶族自治县', '河口', '103.96159', '22.507563', 3, 2, 1),
(532600, 530000, '文山壮族苗族自治州', '文山', '104.24401', '23.36951', 2, 13, 1),
(532621, 532600, '文山市', '文山', '104.24428', '23.369217', 3, 6, 1),
(532622, 532600, '砚山县', '砚山', '104.34399', '23.6123', 3, 8, 1),
(532623, 532600, '西畴县', '西畴', '104.67571', '23.437439', 3, 7, 1),
(532624, 532600, '麻栗坡县', '麻栗坡', '104.7019', '23.124203', 3, 4, 1),
(532625, 532600, '马关县', '马关', '104.39862', '23.011723', 3, 3, 1),
(532626, 532600, '丘北县', '丘北', '104.19437', '24.040981', 3, 5, 1),
(532627, 532600, '广南县', '广南', '105.05669', '24.050272', 3, 2, 1),
(532628, 532600, '富宁县', '富宁', '105.62856', '23.626493', 3, 1, 1),
(532800, 530000, '西双版纳傣族自治州', '西双版纳', '100.79794', '22.001724', 2, 14, 1),
(532801, 532800, '景洪市', '景洪', '100.79795', '22.002087', 3, 1, 1),
(532822, 532800, '勐海县', '勐海', '100.44829', '21.955866', 3, 2, 1),
(532823, 532800, '勐腊县', '勐腊', '101.567055', '21.479448', 3, 3, 1),
(532900, 530000, '大理白族自治州', '大理', '100.22567', '25.589449', 2, 3, 1),
(532901, 532900, '大理市', '大理', '100.24137', '25.593067', 3, 2, 1),
(532922, 532900, '漾濞彝族自治县', '漾濞', '99.95797', '25.669542', 3, 10, 1),
(532923, 532900, '祥云县', '祥云', '100.55402', '25.477072', 3, 9, 1),
(532924, 532900, '宾川县', '宾川', '100.57896', '25.825905', 3, 1, 1),
(532925, 532900, '弥渡县', '弥渡', '100.49067', '25.342594', 3, 6, 1),
(532926, 532900, '南涧彝族自治县', '南涧', '100.518684', '25.041279', 3, 7, 1),
(532927, 532900, '巍山彝族回族自治县', '巍山', '100.30793', '25.23091', 3, 8, 1),
(532928, 532900, '永平县', '永平', '99.53354', '25.46128', 3, 11, 1),
(532929, 532900, '云龙县', '云龙', '99.3694', '25.884954', 3, 12, 1),
(532930, 532900, '洱源县', '洱源', '99.951706', '26.111183', 3, 3, 1),
(532931, 532900, '剑川县', '剑川', '99.90588', '26.530066', 3, 5, 1),
(532932, 532900, '鹤庆县', '鹤庆', '100.17338', '26.55839', 3, 4, 1),
(533100, 530000, '德宏傣族景颇族自治州', '德宏', '98.57836', '24.436693', 2, 4, 1),
(533102, 533100, '瑞丽市', '瑞丽', '97.85588', '24.010735', 3, 4, 1),
(533103, 533100, '芒市', '芒市', '98.57761', '24.436699', 3, 3, 1),
(533122, 533100, '梁河县', '梁河', '98.298195', '24.80742', 3, 1, 1),
(533123, 533100, '盈江县', '盈江', '97.93393', '24.709541', 3, 5, 1),
(533124, 533100, '陇川县', '陇川', '97.79444', '24.184065', 3, 2, 1),
(533300, 530000, '怒江傈僳族自治州', '怒江', '98.8543', '25.850948', 2, 10, 1),
(533321, 533300, '泸水县', '泸水', '98.854065', '25.851143', 3, 4, 1),
(533323, 533300, '福贡县', '福贡', '98.86742', '26.902739', 3, 1, 1),
(533324, 533300, '贡山独龙族怒族自治县', '贡山', '98.66614', '27.738054', 3, 2, 1),
(533325, 533300, '兰坪白族普米族自治县', '兰坪', '99.42138', '26.453838', 3, 3, 1),
(533400, 530000, '迪庆藏族自治州', '迪庆', '99.70647', '27.826853', 2, 5, 1),
(533421, 533400, '香格里拉县', '香格里拉', '99.708664', '27.825804', 3, 3, 1),
(533422, 533400, '德钦县', '德钦', '98.91506', '28.483273', 3, 1, 1),
(533423, 533400, '维西傈僳族自治县', '维西', '99.286354', '27.180948', 3, 2, 1),
(540000, 0, '西藏自治区', '西藏', '91.13221', '29.66036', 1, 26, 1),
(540100, 540000, '拉萨市', '拉萨', '91.13221', '29.66036', 2, 3, 1),
(540102, 540100, '城关区', '城关', '91.13291', '29.659472', 3, 1, 1),
(540121, 540100, '林周县', '林周', '91.26184', '29.895754', 3, 5, 1),
(540122, 540100, '当雄县', '当雄', '91.10355', '30.47482', 3, 2, 1),
(540123, 540100, '尼木县', '尼木', '90.16554', '29.431347', 3, 7, 1),
(540124, 540100, '曲水县', '曲水', '90.73805', '29.349895', 3, 8, 1),
(540125, 540100, '堆龙德庆县', '堆龙德庆', '91.00282', '29.647346', 3, 4, 1),
(540126, 540100, '达孜县', '达孜', '91.350975', '29.670315', 3, 3, 1),
(540127, 540100, '墨竹工卡县', '墨竹工卡', '91.731155', '29.834658', 3, 6, 1),
(542100, 540000, '昌都地区', '昌都', '97.17845', '31.136875', 2, 2, 1),
(542121, 542100, '昌都县', '昌都', '97.17825', '31.137035', 3, 3, 1),
(542122, 542100, '江达县', '江达', '98.21835', '31.499535', 3, 7, 1),
(542123, 542100, '贡觉县', '贡觉', '98.271194', '30.859205', 3, 6, 1),
(542124, 542100, '类乌齐县', '类乌齐', '96.60126', '31.213049', 3, 8, 1),
(542125, 542100, '丁青县', '丁青', '95.59775', '31.41068', 3, 5, 1),
(542126, 542100, '察雅县', '察雅', '97.565704', '30.653038', 3, 4, 1),
(542127, 542100, '八宿县', '八宿', '96.91789', '30.053408', 3, 1, 1),
(542128, 542100, '左贡县', '左贡', '97.84053', '29.671335', 3, 11, 1),
(542129, 542100, '芒康县', '芒康', '98.59644', '29.686615', 3, 10, 1),
(542132, 542100, '洛隆县', '洛隆', '95.82342', '30.741947', 3, 9, 1),
(542133, 542100, '边坝县', '边坝', '94.707504', '30.93385', 3, 2, 1),
(542200, 540000, '山南地区', '山南', '91.766525', '29.236023', 2, 7, 1),
(542221, 542200, '乃东县', '乃东', '91.76525', '29.236107', 3, 8, 1),
(542222, 542200, '扎囊县', '扎囊', '91.338', '29.246475', 3, 12, 1),
(542223, 542200, '贡嘎县', '贡嘎', '90.98527', '29.289078', 3, 3, 1),
(542224, 542200, '桑日县', '桑日', '92.01573', '29.259773', 3, 11, 1),
(542225, 542200, '琼结县', '琼结', '91.683754', '29.025242', 3, 9, 1),
(542226, 542200, '曲松县', '曲松', '92.201065', '29.063656', 3, 10, 1),
(542227, 542200, '措美县', '措美', '91.43235', '28.437353', 3, 1, 1),
(542228, 542200, '洛扎县', '洛扎', '90.858246', '28.385765', 3, 7, 1),
(542229, 542200, '加查县', '加查', '92.59104', '29.14092', 3, 4, 1),
(542231, 542200, '隆子县', '隆子', '92.46331', '28.408548', 3, 6, 1),
(542232, 542200, '错那县', '错那', '91.96013', '27.991707', 3, 2, 1),
(542233, 542200, '浪卡子县', '浪卡子', '90.39875', '28.96836', 3, 5, 1),
(542300, 540000, '日喀则地区', '日喀则', '88.88515', '29.267519', 2, 6, 1),
(542301, 542300, '日喀则市', '日喀则', '88.88667', '29.267002', 3, 13, 1),
(542322, 542300, '南木林县', '南木林', '89.099434', '29.680458', 3, 10, 1),
(542323, 542300, '江孜县', '江孜', '89.60504', '28.908846', 3, 6, 1),
(542324, 542300, '定日县', '定日', '87.123886', '28.656668', 3, 4, 1),
(542325, 542300, '萨迦县', '萨迦', '88.02301', '28.901077', 3, 15, 1),
(542326, 542300, '拉孜县', '拉孜', '87.63743', '29.085136', 3, 9, 1),
(542327, 542300, '昂仁县', '昂仁', '87.23578', '29.294758', 3, 1, 1),
(542328, 542300, '谢通门县', '谢通门', '88.26051', '29.431597', 3, 16, 1),
(542329, 542300, '白朗县', '白朗', '89.26362', '29.106627', 3, 2, 1),
(542330, 542300, '仁布县', '仁布', '89.84321', '29.230299', 3, 12, 1),
(542331, 542300, '康马县', '康马', '89.6834', '28.55472', 3, 8, 1),
(542332, 542300, '定结县', '定结', '87.76772', '28.36409', 3, 3, 1),
(542333, 542300, '仲巴县', '仲巴', '84.03283', '29.768335', 3, 18, 1),
(542334, 542300, '亚东县', '亚东', '88.90681', '27.482773', 3, 17, 1),
(542335, 542300, '吉隆县', '吉隆', '85.29835', '28.852415', 3, 7, 1),
(542336, 542300, '聂拉木县', '聂拉木', '85.98196', '28.15595', 3, 11, 1),
(542337, 542300, '萨嘎县', '萨嘎', '85.23462', '29.328194', 3, 14, 1),
(542338, 542300, '岗巴县', '岗巴', '88.518906', '28.27437', 3, 5, 1),
(542400, 540000, '那曲地区', '那曲', '92.06021', '31.476004', 2, 5, 1),
(542421, 542400, '那曲县', '那曲', '92.06186', '31.475756', 3, 6, 1),
(542422, 542400, '嘉黎县', '嘉黎', '93.23291', '30.640846', 3, 5, 1),
(542423, 542400, '比如县', '比如', '93.68044', '31.479918', 3, 4, 1),
(542424, 542400, '聂荣县', '聂荣', '92.30366', '32.107857', 3, 7, 1),
(542425, 542400, '安多县', '安多', '91.68188', '32.2603', 3, 1, 1),
(542426, 542400, '申扎县', '申扎', '88.70978', '30.929056', 3, 9, 1),
(542427, 542400, '索县', '索县', '93.784966', '31.886173', 3, 11, 1),
(542428, 542400, '班戈县', '班戈', '90.011826', '31.394579', 3, 2, 1),
(542429, 542400, '巴青县', '巴青', '94.05405', '31.918692', 3, 3, 1),
(542430, 542400, '尼玛县', '尼玛', '87.23665', '31.784979', 3, 8, 1),
(542432, 542400, '双湖县', '双湖', '88.83858', '33.18698', 3, 10, 1),
(542500, 540000, '阿里地区', '阿里', '80.1055', '32.503185', 2, 1, 1),
(542521, 542500, '普兰县', '普兰', '81.17759', '30.291897', 3, 5, 1),
(542522, 542500, '札达县', '札达', '79.80319', '31.478586', 3, 7, 1),
(542523, 542500, '噶尔县', '噶尔', '80.105', '32.503372', 3, 2, 1),
(542524, 542500, '日土县', '日土', '79.73193', '33.382454', 3, 6, 1),
(542525, 542500, '革吉县', '革吉', '81.1429', '32.38919', 3, 4, 1),
(542526, 542500, '改则县', '改则', '84.062386', '32.302074', 3, 3, 1),
(542527, 542500, '措勤县', '措勤', '85.159256', '31.016773', 3, 1, 1),
(542600, 540000, '林芝地区', '林芝', '94.36235', '29.654694', 2, 4, 1),
(542621, 542600, '林芝县', '林芝', '94.360985', '29.653732', 3, 5, 1),
(542622, 542600, '工布江达县', '工布江达', '93.24651', '29.88447', 3, 3, 1),
(542623, 542600, '米林县', '米林', '94.21368', '29.213812', 3, 6, 1),
(542624, 542600, '墨脱县', '墨脱', '95.332245', '29.32573', 3, 7, 1),
(542625, 542600, '波密县', '波密', '95.76815', '29.85877', 3, 1, 1),
(542626, 542600, '察隅县', '察隅', '97.465004', '28.660244', 3, 2, 1),
(542627, 542600, '朗县', '朗县', '93.073425', '29.0446', 3, 4, 1),
(610000, 0, '陕西省', '陕西', '108.94802', '34.26316', 1, 27, 1),
(610100, 610000, '西安市', '西安', '108.94802', '34.26316', 2, 7, 1),
(610102, 610100, '新城区', '新城', '108.9599', '34.26927', 3, 10, 1),
(610103, 610100, '碑林区', '碑林', '108.94699', '34.25106', 3, 2, 1),
(610104, 610100, '莲湖区', '莲湖', '108.9332', '34.2656', 3, 7, 1),
(610111, 610100, '灞桥区', '灞桥', '109.06726', '34.267452', 3, 1, 1),
(610112, 610100, '未央区', '未央', '108.94602', '34.30823', 3, 9, 1),
(610113, 610100, '雁塔区', '雁塔', '108.92659', '34.21339', 3, 12, 1),
(610114, 610100, '阎良区', '阎良', '109.22802', '34.66214', 3, 11, 1),
(610115, 610100, '临潼区', '临潼', '109.21399', '34.372066', 3, 8, 1),
(610116, 610100, '长安区', '长安', '108.94158', '34.157097', 3, 3, 1),
(610122, 610100, '蓝田县', '蓝田', '109.317635', '34.15619', 3, 6, 1),
(610124, 610100, '周至县', '周至', '108.21647', '34.161533', 3, 13, 1),
(610125, 610100, '户县', '户县', '108.60738', '34.10867', 3, 5, 1),
(610126, 610100, '高陵县', '高陵', '109.0889', '34.535065', 3, 4, 1),
(610200, 610000, '铜川市', '铜川', '108.97961', '34.91658', 2, 5, 1),
(610202, 610200, '王益区', '王益', '109.07586', '35.0691', 3, 1, 1),
(610203, 610200, '印台区', '印台', '109.100815', '35.111927', 3, 4, 1),
(610204, 610200, '耀州区', '耀州', '108.96254', '34.910206', 3, 2, 1),
(610222, 610200, '宜君县', '宜君', '109.11828', '35.398766', 3, 3, 1),
(610300, 610000, '宝鸡市', '宝鸡', '107.14487', '34.369316', 2, 2, 1),
(610302, 610300, '渭滨区', '渭滨', '107.14447', '34.37101', 3, 12, 1),
(610303, 610300, '金台区', '金台', '107.14994', '34.37519', 3, 5, 1),
(610304, 610300, '陈仓区', '陈仓', '107.383644', '34.35275', 3, 1, 1),
(610322, 610300, '凤翔县', '凤翔', '107.40057', '34.521667', 3, 3, 1),
(610323, 610300, '岐山县', '岐山', '107.624466', '34.44296', 3, 10, 1),
(610324, 610300, '扶风县', '扶风', '107.89142', '34.375496', 3, 4, 1),
(610326, 610300, '眉县', '眉县', '107.75237', '34.272137', 3, 8, 1),
(610327, 610300, '陇县', '陇县', '106.85706', '34.89326', 3, 7, 1),
(610328, 610300, '千阳县', '千阳', '107.13299', '34.642586', 3, 9, 1),
(610329, 610300, '麟游县', '麟游', '107.79661', '34.677715', 3, 6, 1),
(610330, 610300, '凤县', '凤县', '106.525215', '33.912464', 3, 2, 1),
(610331, 610300, '太白县', '太白', '107.316536', '34.059216', 3, 11, 1),
(610400, 610000, '咸阳市', '咸阳', '108.70512', '34.33344', 2, 8, 1),
(610402, 610400, '秦都区', '秦都', '108.69864', '34.3298', 3, 7, 1),
(610403, 610400, '杨陵区', '杨陵', '108.08635', '34.27135', 3, 13, 1),
(610404, 610400, '渭城区', '渭城', '108.73096', '34.336845', 3, 9, 1),
(610422, 610400, '三原县', '三原', '108.94348', '34.613995', 3, 8, 1),
(610423, 610400, '泾阳县', '泾阳', '108.83784', '34.528492', 3, 4, 1),
(610424, 610400, '乾县', '乾县', '108.247406', '34.52726', 3, 6, 1),
(610425, 610400, '礼泉县', '礼泉', '108.428314', '34.482582', 3, 5, 1),
(610426, 610400, '永寿县', '永寿', '108.14313', '34.69262', 3, 14, 1),
(610427, 610400, '彬县', '彬县', '108.08367', '35.034233', 3, 1, 1),
(610428, 610400, '长武县', '长武', '107.79584', '35.206123', 3, 2, 1),
(610429, 610400, '旬邑县', '旬邑', '108.337234', '35.112232', 3, 12, 1),
(610430, 610400, '淳化县', '淳化', '108.58118', '34.79797', 3, 3, 1),
(610431, 610400, '武功县', '武功', '108.21286', '34.25973', 3, 10, 1),
(610481, 610400, '兴平市', '兴平', '108.488495', '34.297134', 3, 11, 1),
(610500, 610000, '渭南市', '渭南', '109.502884', '34.499382', 2, 6, 1),
(610502, 610500, '临渭区', '临渭', '109.503296', '34.50127', 3, 9, 1),
(610521, 610500, '华县', '华县', '109.76141', '34.51196', 3, 7, 1),
(610522, 610500, '潼关县', '潼关', '110.24726', '34.544514', 3, 11, 1),
(610523, 610500, '大荔县', '大荔', '109.94312', '34.79501', 3, 3, 1),
(610524, 610500, '合阳县', '合阳', '110.14798', '35.2371', 3, 6, 1),
(610525, 610500, '澄城县', '澄城', '109.93761', '35.184', 3, 2, 1),
(610526, 610500, '蒲城县', '蒲城', '109.58965', '34.956036', 3, 10, 1),
(610527, 610500, '白水县', '白水', '109.59431', '35.17729', 3, 1, 1),
(610528, 610500, '富平县', '富平', '109.18717', '34.746677', 3, 4, 1),
(610581, 610500, '韩城市', '韩城', '110.45239', '35.47524', 3, 5, 1),
(610582, 610500, '华阴市', '华阴', '110.08952', '34.565357', 3, 8, 1),
(610600, 610000, '延安市', '延安', '109.49081', '36.59654', 2, 9, 1),
(610602, 610600, '宝塔区', '宝塔', '109.49069', '36.59629', 3, 2, 1),
(610621, 610600, '延长县', '延长', '110.01296', '36.578304', 3, 9, 1),
(610622, 610600, '延川县', '延川', '110.190315', '36.882065', 3, 10, 1),
(610623, 610600, '子长县', '子长', '109.675964', '37.14207', 3, 13, 1),
(610624, 610600, '安塞县', '安塞', '109.32534', '36.86441', 3, 1, 1),
(610625, 610600, '志丹县', '志丹', '108.7689', '36.823032', 3, 12, 1),
(610626, 610600, '吴起县', '吴起', '108.17698', '36.92485', 3, 8, 1),
(610627, 610600, '甘泉县', '甘泉', '109.34961', '36.27773', 3, 4, 1),
(610628, 610600, '富县', '富县', '109.38413', '35.996494', 3, 3, 1),
(610629, 610600, '洛川县', '洛川', '109.435715', '35.762135', 3, 7, 1),
(610630, 610600, '宜川县', '宜川', '110.17554', '36.050392', 3, 11, 1),
(610631, 610600, '黄龙县', '黄龙', '109.83502', '35.583275', 3, 6, 1),
(610632, 610600, '黄陵县', '黄陵', '109.26247', '35.580166', 3, 5, 1),
(610700, 610000, '汉中市', '汉中', '107.02862', '33.077667', 2, 3, 1),
(610702, 610700, '汉台区', '汉台', '107.02824', '33.077675', 3, 3, 1),
(610721, 610700, '南郑县', '南郑', '106.94239', '33.00334', 3, 7, 1),
(610722, 610700, '城固县', '城固', '107.32989', '33.1531', 3, 1, 1),
(610723, 610700, '洋县', '洋县', '107.549965', '33.22328', 3, 10, 1),
(610724, 610700, '西乡县', '西乡', '107.76586', '32.98796', 3, 9, 1),
(610725, 610700, '勉县', '勉县', '106.680176', '33.155617', 3, 6, 1),
(610726, 610700, '宁强县', '宁强', '106.25739', '32.830807', 3, 8, 1),
(610727, 610700, '略阳县', '略阳', '106.1539', '33.32964', 3, 5, 1),
(610728, 610700, '镇巴县', '镇巴', '107.89531', '32.535854', 3, 11, 1),
(610729, 610700, '留坝县', '留坝', '106.92438', '33.61334', 3, 4, 1),
(610730, 610700, '佛坪县', '佛坪', '107.98858', '33.520744', 3, 2, 1),
(610800, 610000, '榆林市', '榆林', '109.741196', '38.29016', 2, 10, 1),
(610802, 610800, '榆阳区', '榆阳', '109.74791', '38.299267', 3, 11, 1),
(610821, 610800, '神木县', '神木', '110.497', '38.83564', 3, 8, 1),
(610822, 610800, '府谷县', '府谷', '111.06965', '39.029243', 3, 2, 1),
(610823, 610800, '横山县', '横山', '109.292595', '37.964046', 3, 3, 1),
(610824, 610800, '靖边县', '靖边', '108.80567', '37.596085', 3, 5, 1),
(610825, 610800, '定边县', '定边', '107.60128', '37.59523', 3, 1, 1),
(610826, 610800, '绥德县', '绥德', '110.26537', '37.5077', 3, 9, 1),
(610827, 610800, '米脂县', '米脂', '110.17868', '37.759083', 3, 6, 1),
(610828, 610800, '佳县', '佳县', '110.49337', '38.0216', 3, 4, 1),
(610829, 610800, '吴堡县', '吴堡', '110.73931', '37.451923', 3, 10, 1),
(610830, 610800, '清涧县', '清涧', '110.12146', '37.087704', 3, 7, 1),
(610831, 610800, '子洲县', '子洲', '110.03457', '37.611572', 3, 12, 1),
(610900, 610000, '安康市', '安康', '109.029274', '32.6903', 2, 1, 1),
(610902, 610900, '汉滨区', '汉滨', '109.0291', '32.69082', 3, 2, 1),
(610921, 610900, '汉阴县', '汉阴', '108.51095', '32.89112', 3, 3, 1),
(610922, 610900, '石泉县', '石泉', '108.25051', '33.038513', 3, 7, 1),
(610923, 610900, '宁陕县', '宁陕', '108.31371', '33.312183', 3, 5, 1),
(610924, 610900, '紫阳县', '紫阳', '108.53779', '32.520176', 3, 10, 1),
(610925, 610900, '岚皋县', '岚皋', '108.900665', '32.31069', 3, 4, 1),
(610926, 610900, '平利县', '平利', '109.36186', '32.38793', 3, 6, 1),
(610927, 610900, '镇坪县', '镇坪', '109.526436', '31.883394', 3, 9, 1),
(610928, 610900, '旬阳县', '旬阳', '109.36815', '32.83357', 3, 8, 1),
(610929, 610900, '白河县', '白河', '110.11419', '32.809483', 3, 1, 1),
(611000, 610000, '商洛市', '商洛', '109.93977', '33.86832', 2, 4, 1),
(611002, 611000, '商州区', '商州', '109.93768', '33.86921', 3, 4, 1),
(611021, 611000, '洛南县', '洛南', '110.14571', '34.0885', 3, 2, 1),
(611022, 611000, '丹凤县', '丹凤', '110.33191', '33.69471', 3, 1, 1),
(611023, 611000, '商南县', '商南', '110.88544', '33.526367', 3, 3, 1),
(611024, 611000, '山阳县', '山阳', '109.88043', '33.53041', 3, 5, 1),
(611025, 611000, '镇安县', '镇安', '109.15108', '33.42398', 3, 7, 1),
(611026, 611000, '柞水县', '柞水', '109.11125', '33.682774', 3, 6, 1),
(620000, 0, '甘肃省', '甘肃', '103.823555', '36.05804', 1, 28, 1),
(620100, 620000, '兰州市', '兰州', '103.823555', '36.05804', 2, 7, 1),
(620102, 620100, '城关区', '城关', '103.841034', '36.049114', 3, 2, 1),
(620103, 620100, '七里河区', '七里河', '103.784325', '36.06673', 3, 5, 1),
(620104, 620100, '西固区', '西固', '103.62233', '36.10037', 3, 6, 1),
(620105, 620100, '安宁区', '安宁', '103.72404', '36.10329', 3, 1, 1),
(620111, 620100, '红古区', '红古', '102.86182', '36.344177', 3, 4, 1),
(620121, 620100, '永登县', '永登', '103.2622', '36.73443', 3, 7, 1),
(620122, 620100, '皋兰县', '皋兰', '103.94933', '36.331253', 3, 3, 1),
(620123, 620100, '榆中县', '榆中', '104.114975', '35.84443', 3, 8, 1),
(620200, 620000, '嘉峪关市', '嘉峪关', '98.277306', '39.78653', 2, 4, 1),
(620300, 620000, '金昌市', '金昌', '102.18789', '38.514236', 2, 5, 1),
(620302, 620300, '金川区', '金川', '102.18768', '38.513794', 3, 1, 1),
(620321, 620300, '永昌县', '永昌', '101.971954', '38.247353', 3, 2, 1),
(620400, 620000, '白银市', '白银', '104.17361', '36.54568', 2, 1, 1),
(620402, 620400, '白银区', '白银', '104.17425', '36.54565', 3, 1, 1),
(620403, 620400, '平川区', '平川', '104.81921', '36.72921', 3, 5, 1),
(620421, 620400, '靖远县', '靖远', '104.68697', '36.561424', 3, 4, 1),
(620422, 620400, '会宁县', '会宁', '105.05434', '35.692486', 3, 2, 1),
(620423, 620400, '景泰县', '景泰', '104.06639', '37.19352', 3, 3, 1),
(620500, 620000, '天水市', '天水', '105.725', '34.57853', 2, 12, 1),
(620502, 620500, '秦州区', '秦州', '105.72448', '34.578644', 3, 5, 1),
(620503, 620500, '麦积区', '麦积', '105.89763', '34.563503', 3, 2, 1),
(620521, 620500, '清水县', '清水', '106.13988', '34.75287', 3, 4, 1),
(620522, 620500, '秦安县', '秦安', '105.6733', '34.862354', 3, 3, 1),
(620523, 620500, '甘谷县', '甘谷', '105.332344', '34.747326', 3, 1, 1),
(620524, 620500, '武山县', '武山', '104.89169', '34.721954', 3, 6, 1),
(620525, 620500, '张家川回族自治县', '张家川', '106.21242', '34.993237', 3, 7, 1),
(620600, 620000, '武威市', '武威', '102.6347', '37.929996', 2, 13, 1),
(620602, 620600, '凉州区', '凉州', '102.63449', '37.93025', 3, 2, 1),
(620621, 620600, '民勤县', '民勤', '103.09065', '38.624622', 3, 3, 1),
(620622, 620600, '古浪县', '古浪', '102.89805', '37.47057', 3, 1, 1),
(620623, 620600, '天祝藏族自治县', '天祝', '103.14204', '36.97168', 3, 4, 1),
(620700, 620000, '张掖市', '张掖', '100.455475', '38.932896', 2, 14, 1),
(620702, 620700, '甘州区', '甘州', '100.454865', '38.931774', 3, 1, 1),
(620721, 620700, '肃南裕固族自治县', '肃南', '99.61709', '38.83727', 3, 6, 1),
(620722, 620700, '民乐县', '民乐', '100.81662', '38.434456', 3, 4, 1),
(620723, 620700, '临泽县', '临泽', '100.166336', '39.15215', 3, 3, 1),
(620724, 620700, '高台县', '高台', '99.81665', '39.37631', 3, 2, 1),
(620725, 620700, '山丹县', '山丹', '101.08844', '38.78484', 3, 5, 1),
(620800, 620000, '平凉市', '平凉', '106.68469', '35.54279', 2, 10, 1),
(620802, 620800, '崆峒区', '崆峒', '106.68422', '35.54173', 3, 5, 1),
(620821, 620800, '泾川县', '泾川', '107.36522', '35.33528', 3, 3, 1),
(620822, 620800, '灵台县', '灵台', '107.62059', '35.06401', 3, 6, 1),
(620823, 620800, '崇信县', '崇信', '107.03125', '35.30453', 3, 1, 1),
(620824, 620800, '华亭县', '华亭', '106.64931', '35.215343', 3, 2, 1),
(620825, 620800, '庄浪县', '庄浪', '106.04198', '35.203426', 3, 7, 1),
(620826, 620800, '静宁县', '静宁', '105.73349', '35.52524', 3, 4, 1),
(620900, 620000, '酒泉市', '酒泉', '98.510796', '39.744022', 2, 6, 1),
(620902, 620900, '肃州区', '肃州', '98.511154', '39.74386', 3, 6, 1),
(620921, 620900, '金塔县', '金塔', '98.90296', '39.983036', 3, 4, 1),
(620922, 620900, '瓜州县', '瓜州', '95.780594', '40.516525', 3, 3, 1),
(620923, 620900, '肃北蒙古族自治县', '肃北', '94.87728', '39.51224', 3, 5, 1),
(620924, 620900, '阿克塞哈萨克族自治县', '阿克塞', '94.33764', '39.63164', 3, 1, 1),
(620981, 620900, '玉门市', '玉门', '97.03721', '40.28682', 3, 7, 1),
(620982, 620900, '敦煌市', '敦煌', '94.664276', '40.141117', 3, 2, 1),
(621000, 620000, '庆阳市', '庆阳', '107.638374', '35.73422', 2, 11, 1),
(621002, 621000, '西峰区', '西峰', '107.638824', '35.73371', 3, 6, 1),
(621021, 621000, '庆城县', '庆城', '107.885666', '36.013504', 3, 5, 1),
(621022, 621000, '环县', '环县', '107.308754', '36.56932', 3, 3, 1),
(621023, 621000, '华池县', '华池', '107.98629', '36.457302', 3, 2, 1),
(621024, 621000, '合水县', '合水', '108.01987', '35.819004', 3, 1, 1),
(621025, 621000, '正宁县', '正宁', '108.36107', '35.490643', 3, 7, 1),
(621026, 621000, '宁县', '宁县', '107.92118', '35.50201', 3, 4, 1),
(621027, 621000, '镇原县', '镇原', '107.19571', '35.677807', 3, 8, 1),
(621100, 620000, '定西市', '定西', '104.6263', '35.57958', 2, 2, 1),
(621102, 621100, '安定区', '安定', '104.62577', '35.579765', 3, 1, 1),
(621121, 621100, '通渭县', '通渭', '105.2501', '35.208923', 3, 5, 1),
(621122, 621100, '陇西县', '陇西', '104.63755', '35.00341', 3, 3, 1),
(621123, 621100, '渭源县', '渭源', '104.21174', '35.133022', 3, 6, 1),
(621124, 621100, '临洮县', '临洮', '103.86218', '35.376232', 3, 2, 1),
(621125, 621100, '漳县', '漳县', '104.46676', '34.84864', 3, 7, 1),
(621126, 621100, '岷县', '岷县', '104.03988', '34.439106', 3, 4, 1),
(621200, 620000, '陇南市', '陇南', '104.92938', '33.3886', 2, 9, 1),
(621202, 621200, '武都区', '武都', '104.92986', '33.388157', 3, 8, 1),
(621221, 621200, '成县', '成县', '105.734436', '33.739864', 3, 1, 1),
(621222, 621200, '文县', '文县', '104.68245', '32.94217', 3, 7, 1),
(621223, 621200, '宕昌县', '宕昌', '104.39448', '34.042656', 3, 2, 1),
(621224, 621200, '康县', '康县', '105.609535', '33.328266', 3, 4, 1),
(621225, 621200, '西和县', '西和', '105.299736', '34.013718', 3, 9, 1),
(621226, 621200, '礼县', '礼县', '105.18162', '34.18939', 3, 6, 1),
(621227, 621200, '徽县', '徽县', '106.08563', '33.767784', 3, 3, 1),
(621228, 621200, '两当县', '两当', '106.30696', '33.91073', 3, 5, 1),
(622900, 620000, '临夏回族自治州', '临夏', '103.212006', '35.599445', 2, 8, 1),
(622901, 622900, '临夏市', '临夏市', '103.21163', '35.59941', 3, 6, 1),
(622921, 622900, '临夏县', '临夏县', '102.99387', '35.49236', 3, 7, 1),
(622922, 622900, '康乐县', '康乐', '103.709854', '35.371906', 3, 5, 1),
(622923, 622900, '永靖县', '永靖', '103.31987', '35.938934', 3, 8, 1),
(622924, 622900, '广河县', '广河', '103.57619', '35.48169', 3, 2, 1),
(622925, 622900, '和政县', '和政', '103.35036', '35.425972', 3, 3, 1),
(622926, 622900, '东乡族自治县', '东乡', '103.389565', '35.66383', 3, 1, 1),
(622927, 622900, '积石山保安族东乡族撒拉族自治县', '积石山', '102.87747', '35.712906', 3, 4, 1),
(623000, 620000, '甘南藏族自治州', '甘南', '102.91101', '34.986355', 2, 3, 1),
(623001, 623000, '合作市', '合作', '102.91149', '34.985973', 3, 2, 1),
(623021, 623000, '临潭县', '临潭', '103.35305', '34.69164', 3, 3, 1),
(623022, 623000, '卓尼县', '卓尼', '103.50851', '34.588165', 3, 8, 1),
(623023, 623000, '舟曲县', '舟曲', '104.37027', '33.782963', 3, 7, 1),
(623024, 623000, '迭部县', '迭部', '103.22101', '34.055347', 3, 1, 1),
(623025, 623000, '玛曲县', '玛曲', '102.07577', '33.99807', 3, 5, 1),
(623026, 623000, '碌曲县', '碌曲', '102.488495', '34.589592', 3, 4, 1),
(623027, 623000, '夏河县', '夏河', '102.520744', '35.20085', 3, 6, 1),
(630000, 0, '青海省', '青海', '101.778915', '36.623177', 1, 29, 1),
(630100, 630000, '西宁市', '西宁', '101.778915', '36.623177', 2, 7, 1),
(630102, 630100, '城东区', '城东', '101.7961', '36.616043', 3, 2, 1),
(630103, 630100, '城中区', '城中', '101.78455', '36.62118', 3, 4, 1),
(630104, 630100, '城西区', '城西', '101.76365', '36.628323', 3, 3, 1),
(630105, 630100, '城北区', '城北', '101.7613', '36.64845', 3, 1, 1),
(630121, 630100, '大通回族土族自治县', '大通', '101.68418', '36.931343', 3, 5, 1),
(630122, 630100, '湟中县', '湟中', '101.56947', '36.50042', 3, 7, 1),
(630123, 630100, '湟源县', '湟源', '101.263435', '36.68482', 3, 6, 1),
(632100, 630000, '海东市', '海东', '102.10327', '36.502914', 2, 3, 1),
(632121, 632100, '平安县', '平安', '102.104294', '36.502712', 3, 5, 1),
(632122, 632100, '民和回族土族自治县', '民和', '102.80421', '36.329453', 3, 4, 1),
(632123, 632100, '乐都区', '乐都', '102.40243', '36.48029', 3, 3, 1),
(632126, 632100, '互助土族自治县', '互助', '101.95673', '36.83994', 3, 2, 1),
(632127, 632100, '化隆回族自治县', '化隆', '102.26233', '36.098324', 3, 1, 1),
(632128, 632100, '循化撒拉族自治县', '循化', '102.486534', '35.847248', 3, 6, 1),
(632200, 630000, '海北藏族自治州', '海北', '100.90106', '36.959435', 2, 2, 1),
(632221, 632200, '门源回族自治县', '门源', '101.61846', '37.37663', 3, 3, 1),
(632222, 632200, '祁连县', '祁连', '100.24978', '38.175407', 3, 4, 1),
(632223, 632200, '海晏县', '海晏', '100.90049', '36.95954', 3, 2, 1),
(632224, 632200, '刚察县', '刚察', '100.13842', '37.326263', 3, 1, 1),
(632300, 630000, '黄南藏族自治州', '黄南', '102.01999', '35.517742', 2, 6, 1),
(632321, 632300, '同仁县', '同仁', '102.0176', '35.51634', 3, 3, 1),
(632322, 632300, '尖扎县', '尖扎', '102.03195', '35.938206', 3, 2, 1),
(632323, 632300, '泽库县', '泽库', '101.469345', '35.036842', 3, 4, 1),
(632324, 632300, '河南蒙古族自治县', '河南', '101.61188', '34.734524', 3, 1, 1),
(632500, 630000, '海南藏族自治州', '海南藏族', '100.619545', '36.280354', 2, 4, 1),
(632521, 632500, '共和县', '共和', '100.6196', '36.280285', 3, 1, 1),
(632522, 632500, '同德县', '同德', '100.57947', '35.254494', 3, 4, 1),
(632523, 632500, '贵德县', '贵德', '101.431854', '36.040455', 3, 2, 1),
(632524, 632500, '兴海县', '兴海', '99.98696', '35.58909', 3, 5, 1),
(632525, 632500, '贵南县', '贵南', '100.74792', '35.587086', 3, 3, 1),
(632600, 630000, '果洛藏族自治州', '果洛', '100.24214', '34.4736', 2, 1, 1),
(632621, 632600, '玛沁县', '玛沁', '100.24353', '34.473385', 3, 6, 1),
(632622, 632600, '班玛县', '班玛', '100.73795', '32.931587', 3, 1, 1),
(632623, 632600, '甘德县', '甘德', '99.90259', '33.966988', 3, 3, 1),
(632624, 632600, '达日县', '达日', '99.65172', '33.753258', 3, 2, 1),
(632625, 632600, '久治县', '久治', '101.484886', '33.430218', 3, 4, 1),
(632626, 632600, '玛多县', '玛多', '98.21134', '34.91528', 3, 5, 1),
(632700, 630000, '玉树藏族自治州', '玉树', '97.00852', '33.004047', 2, 8, 1),
(632721, 632700, '玉树市', '玉树', '97.00876', '33.00393', 3, 4, 1),
(632722, 632700, '杂多县', '杂多', '95.29343', '32.891888', 3, 5, 1),
(632723, 632700, '称多县', '称多', '97.11089', '33.367886', 3, 1, 1),
(632724, 632700, '治多县', '治多', '95.616844', '33.85232', 3, 6, 1),
(632725, 632700, '囊谦县', '囊谦', '96.4798', '32.203205', 3, 2, 1),
(632726, 632700, '曲麻莱县', '曲麻莱', '95.800674', '34.12654', 3, 3, 1),
(632800, 630000, '海西蒙古族藏族自治州', '海西', '97.37079', '37.374664', 2, 5, 1),
(632801, 632800, '格尔木市', '格尔木', '94.90578', '36.401543', 3, 3, 1),
(632802, 632800, '德令哈市', '德令哈', '97.37014', '37.374554', 3, 1, 1),
(632821, 632800, '乌兰县', '乌兰', '98.47985', '36.93039', 3, 5, 1),
(632822, 632800, '都兰县', '都兰', '98.089165', '36.298553', 3, 2, 1),
(632823, 632800, '天峻县', '天峻', '99.02078', '37.29906', 3, 4, 1),
(640000, 0, '宁夏回族自治区', '宁夏', '106.278175', '38.46637', 1, 30, 1),
(640100, 640000, '银川市', '银川', '106.278175', '38.46637', 2, 4, 1),
(640104, 640100, '兴庆区', '兴庆', '106.2784', '38.46747', 3, 4, 1),
(640105, 640100, '西夏区', '西夏', '106.13212', '38.492424', 3, 5, 1),
(640106, 640100, '金凤区', '金凤', '106.228485', '38.477352', 3, 2, 1),
(640121, 640100, '永宁县', '永宁', '106.253784', '38.28043', 3, 6, 1),
(640122, 640100, '贺兰县', '贺兰', '106.3459', '38.55456', 3, 1, 1),
(640181, 640100, '灵武市', '灵武', '106.3347', '38.09406', 3, 3, 1),
(640200, 640000, '石嘴山市', '石嘴山', '106.376175', '39.01333', 2, 2, 1),
(640202, 640200, '大武口区', '大武口', '106.37665', '39.014156', 3, 1, 1),
(640205, 640200, '惠农区', '惠农', '106.77551', '39.230095', 3, 2, 1),
(640221, 640200, '平罗县', '平罗', '106.54489', '38.90674', 3, 3, 1),
(640300, 640000, '吴忠市', '吴忠', '106.19941', '37.986164', 2, 3, 1),
(640302, 640300, '利通区', '利通', '106.19942', '37.985966', 3, 2, 1),
(640303, 640300, '红寺堡区', '红寺堡', '106.067314', '37.421616', 3, 1, 1),
(640323, 640300, '盐池县', '盐池', '107.40541', '37.78422', 3, 5, 1),
(640324, 640300, '同心县', '同心', '105.914764', '36.9829', 3, 4, 1),
(640381, 640300, '青铜峡市', '青铜峡', '106.07539', '38.021507', 3, 3, 1),
(640400, 640000, '固原市', '固原', '106.28524', '36.004562', 2, 1, 1),
(640402, 640400, '原州区', '原州', '106.28477', '36.005337', 3, 5, 1),
(640422, 640400, '西吉县', '西吉', '105.731804', '35.965385', 3, 4, 1),
(640423, 640400, '隆德县', '隆德', '106.12344', '35.618233', 3, 2, 1),
(640424, 640400, '泾源县', '泾源', '106.33868', '35.49344', 3, 1, 1),
(640425, 640400, '彭阳县', '彭阳', '106.64151', '35.849976', 3, 3, 1),
(640500, 640000, '中卫市', '中卫', '105.18957', '37.51495', 2, 5, 1),
(640502, 640500, '沙坡头区', '沙坡头', '105.19054', '37.514565', 3, 2, 1),
(640521, 640500, '中宁县', '中宁', '105.67578', '37.489735', 3, 3, 1),
(640522, 640500, '海原县', '海原', '105.64732', '36.562008', 3, 1, 1),
(650000, 0, '新疆维吾尔自治区', '新疆', '87.61773', '43.792816', 1, 31, 1),
(650100, 650000, '乌鲁木齐市', '乌鲁木齐', '87.61773', '43.792816', 2, 17, 1),
(650102, 650100, '天山区', '天山', '87.62012', '43.79643', 3, 5, 1),
(650103, 650100, '沙依巴克区', '沙依巴克', '87.59664', '43.78887', 3, 3, 1),
(650104, 650100, '新市区', '新市', '87.56065', '43.87088', 3, 8, 1),
(650105, 650100, '水磨沟区', '水磨沟', '87.61309', '43.816746', 3, 4, 1),
(650106, 650100, '头屯河区', '头屯河', '87.42582', '43.876053', 3, 6, 1),
(650107, 650100, '达坂城区', '达坂城', '88.30994', '43.36181', 3, 1, 1),
(650109, 650100, '米东区', '米东', '87.6918', '43.960983', 3, 2, 1),
(650121, 650100, '乌鲁木齐县', '乌鲁木齐', '1.0', '0.0', 3, 7, 1),
(650200, 650000, '克拉玛依市', '克拉玛依', '84.87395', '45.595886', 2, 10, 1),
(650202, 650200, '独山子区', '独山子', '84.88227', '44.327206', 3, 2, 1),
(650203, 650200, '克拉玛依区', '克拉玛依', '84.86892', '45.600475', 3, 3, 1),
(650204, 650200, '白碱滩区', '白碱滩', '85.12988', '45.689022', 3, 1, 1),
(650205, 650200, '乌尔禾区', '乌尔禾', '85.69777', '46.08776', 3, 4, 1),
(652100, 650000, '吐鲁番地区', '吐鲁番', '89.184074', '42.947613', 2, 14, 1),
(652101, 652100, '吐鲁番市', '吐鲁番', '89.18233', '42.947628', 3, 2, 1),
(652122, 652100, '鄯善县', '鄯善', '90.21269', '42.8655', 3, 1, 1),
(652123, 652100, '托克逊县', '托克逊', '88.65577', '42.793537', 3, 3, 1),
(652200, 650000, '哈密地区', '哈密', '93.51316', '42.83325', 2, 7, 1),
(652201, 652200, '哈密市', '哈密', '93.50917', '42.83389', 3, 2, 1),
(652222, 652200, '巴里坤哈萨克自治县', '巴里坤', '93.0218', '43.599033', 3, 1, 1),
(652223, 652200, '伊吾县', '伊吾', '94.69277', '43.25201', 3, 3, 1),
(652300, 650000, '昌吉回族自治州', '昌吉', '87.30401', '44.014576', 2, 6, 1),
(652301, 652300, '昌吉市', '昌吉', '87.304115', '44.013184', 3, 1, 1),
(652302, 652300, '阜康市', '阜康', '87.98384', '44.152153', 3, 2, 1),
(652323, 652300, '呼图壁县', '呼图壁', '86.88861', '44.189342', 3, 3, 1),
(652324, 652300, '玛纳斯县', '玛纳斯', '86.21769', '44.305626', 3, 5, 1),
(652325, 652300, '奇台县', '奇台', '89.59144', '44.021996', 3, 7, 1),
(652327, 652300, '吉木萨尔县', '吉木萨尔', '89.18129', '43.99716', 3, 4, 1),
(652328, 652300, '木垒哈萨克自治县', '木垒', '90.28283', '43.832443', 3, 6, 1),
(652700, 650000, '博尔塔拉蒙古自治州', '博尔塔拉', '82.074776', '44.90326', 2, 5, 1),
(652701, 652700, '博乐市', '博乐', '82.072235', '44.903088', 3, 2, 1),
(652702, 652700, '阿拉山口市', '阿拉山口', '82.074776', '44.90326', 3, 1, 1),
(652722, 652700, '精河县', '精河', '82.89294', '44.605644', 3, 3, 1),
(652723, 652700, '温泉县', '温泉', '81.03099', '44.97375', 3, 4, 1),
(652800, 650000, '巴音郭楞蒙古自治州', '巴音郭楞', '86.15097', '41.76855', 2, 4, 1),
(652801, 652800, '库尔勒市', '库尔勒', '86.14595', '41.763123', 3, 5, 1),
(652822, 652800, '轮台县', '轮台', '84.24854', '41.781265', 3, 6, 1),
(652823, 652800, '尉犁县', '尉犁', '86.26341', '41.33743', 3, 9, 1),
(652824, 652800, '若羌县', '若羌', '88.16881', '39.023808', 3, 7, 1),
(652825, 652800, '且末县', '且末', '85.53263', '38.13856', 3, 4, 1),
(652826, 652800, '焉耆回族自治县', '焉耆', '86.5698', '42.06435', 3, 8, 1),
(652827, 652800, '和静县', '和静', '86.39107', '42.31716', 3, 2, 1),
(652828, 652800, '和硕县', '和硕', '86.864944', '42.268864', 3, 3, 1),
(652829, 652800, '博湖县', '博湖', '86.63158', '41.980167', 3, 1, 1),
(652900, 650000, '阿克苏地区', '阿克苏', '80.26507', '41.17071', 2, 1, 1),
(652901, 652900, '阿克苏市', '阿克苏', '80.2629', '41.171272', 3, 1, 1),
(652922, 652900, '温宿县', '温宿', '80.24327', '41.272995', 3, 7, 1),
(652923, 652900, '库车县', '库车', '82.96304', '41.71714', 3, 5, 1),
(652924, 652900, '沙雅县', '沙雅', '82.78077', '41.22627', 3, 6, 1),
(652925, 652900, '新和县', '新和', '82.610825', '41.551174', 3, 9, 1),
(652926, 652900, '拜城县', '拜城', '81.86988', '41.7961', 3, 3, 1),
(652927, 652900, '乌什县', '乌什', '79.230804', '41.21587', 3, 8, 1),
(652928, 652900, '阿瓦提县', '阿瓦提', '80.378426', '40.63842', 3, 2, 1),
(652929, 652900, '柯坪县', '柯坪', '79.04785', '40.50624', 3, 4, 1),
(653000, 650000, '克孜勒苏柯尔克孜自治州', '克孜勒苏柯尔克孜', '76.17283', '39.713432', 2, 11, 1),
(653001, 653000, '阿图什市', '阿图什', '76.17394', '39.7129', 3, 3, 1),
(653022, 653000, '阿克陶县', '阿克陶', '75.94516', '39.14708', 3, 2, 1),
(653023, 653000, '阿合奇县', '阿合奇', '78.450165', '40.93757', 3, 1, 1),
(653024, 653000, '乌恰县', '乌恰', '75.25969', '39.716633', 3, 4, 1),
(653100, 650000, '喀什地区', '喀什', '75.989136', '39.467663', 2, 9, 1),
(653101, 653100, '喀什市', '喀什', '75.98838', '39.46786', 3, 3, 1),
(653121, 653100, '疏附县', '疏附', '75.863075', '39.378307', 3, 6, 1),
(653122, 653100, '疏勒县', '疏勒', '76.05365', '39.39946', 3, 7, 1),
(653123, 653100, '英吉沙县', '英吉沙', '76.17429', '38.92984', 3, 10, 1),
(653124, 653100, '泽普县', '泽普', '77.27359', '38.191216', 3, 12, 1),
(653125, 653100, '莎车县', '莎车', '77.248886', '38.414497', 3, 5, 1),
(653126, 653100, '叶城县', '叶城', '77.42036', '37.884678', 3, 9, 1),
(653127, 653100, '麦盖提县', '麦盖提', '77.651535', '38.903385', 3, 4, 1),
(653128, 653100, '岳普湖县', '岳普湖', '76.7724', '39.23525', 3, 11, 1),
(653129, 653100, '伽师县', '伽师', '76.74198', '39.494324', 3, 2, 1),
(653130, 653100, '巴楚县', '巴楚', '78.55041', '39.783478', 3, 1, 1),
(653131, 653100, '塔什库尔干塔吉克自治县', '塔什库尔干', '75.228065', '37.775436', 3, 8, 1),
(653200, 650000, '和田地区', '和田', '79.92533', '37.110687', 2, 8, 1),
(653201, 653200, '和田市', '和田市', '79.92754', '37.108944', 3, 2, 1),
(653221, 653200, '和田县', '和田县', '79.81907', '37.12003', 3, 3, 1),
(653222, 653200, '墨玉县', '墨玉', '79.736626', '37.27151', 3, 6, 1),
(653223, 653200, '皮山县', '皮山', '78.2823', '37.616333', 3, 7, 1),
(653224, 653200, '洛浦县', '洛浦', '80.18404', '37.074375', 3, 4, 1),
(653225, 653200, '策勒县', '策勒', '80.80357', '37.00167', 3, 1, 1),
(653226, 653200, '于田县', '于田', '81.66785', '36.85463', 3, 8, 1),
(653227, 653200, '民丰县', '民丰', '82.69235', '37.06491', 3, 5, 1),
(654000, 650000, '伊犁哈萨克自治州', '伊犁', '81.31795', '43.92186', 2, 18, 1),
(654002, 654000, '伊宁市', '伊宁市', '81.316345', '43.92221', 3, 8, 1),
(654003, 654000, '奎屯市', '奎屯', '84.9016', '44.423447', 3, 4, 1),
(654021, 654000, '伊宁县', '伊宁县', '81.52467', '43.977875', 3, 9, 1),
(654022, 654000, '察布查尔锡伯自治县', '察布查尔', '81.15087', '43.838882', 3, 1, 1),
(654023, 654000, '霍城县', '霍城', '80.872505', '44.04991', 3, 3, 1),
(654024, 654000, '巩留县', '巩留', '82.22704', '43.481617', 3, 2, 1),
(654025, 654000, '新源县', '新源', '83.25849', '43.43425', 3, 7, 1),
(654026, 654000, '昭苏县', '昭苏', '81.12603', '43.157764', 3, 10, 1),
(654027, 654000, '特克斯县', '特克斯', '81.84006', '43.214863', 3, 6, 1),
(654028, 654000, '尼勒克县', '尼勒克', '82.50412', '43.789738', 3, 5, 1),
(654200, 650000, '塔城地区', '塔城', '82.98573', '46.7463', 2, 13, 1),
(654201, 654200, '塔城市', '塔城', '82.983986', '46.74628', 3, 4, 1),
(654202, 654200, '乌苏市', '乌苏', '84.67763', '44.430115', 3, 6, 1),
(654221, 654200, '额敏县', '额敏', '83.622116', '46.522556', 3, 1, 1),
(654223, 654200, '沙湾县', '沙湾', '85.622505', '44.329544', 3, 3, 1),
(654224, 654200, '托里县', '托里', '83.60469', '45.935863', 3, 5, 1),
(654225, 654200, '裕民县', '裕民', '82.982155', '46.20278', 3, 7, 1),
(654226, 654200, '和布克赛尔蒙古自治县', '和布克赛尔', '85.73355', '46.793', 3, 2, 1),
(654300, 650000, '阿勒泰地区', '阿勒泰', '88.13963', '47.848392', 2, 3, 1),
(654301, 654300, '阿勒泰市', '阿勒泰', '88.13874', '47.84891', 3, 1, 1),
(654321, 654300, '布尔津县', '布尔津', '86.86186', '47.70453', 3, 2, 1),
(654322, 654300, '富蕴县', '富蕴', '89.524994', '46.993107', 3, 4, 1),
(654323, 654300, '福海县', '福海', '87.49457', '47.11313', 3, 3, 1),
(654324, 654300, '哈巴河县', '哈巴河', '86.41896', '48.059284', 3, 5, 1),
(654325, 654300, '青河县', '青河', '90.38156', '46.672447', 3, 7, 1),
(654326, 654300, '吉木乃县', '吉木乃', '85.87606', '47.43463', 3, 6, 1),
(659001, 650000, '石河子市', '石河子', '86.04108', '44.305885', 2, 12, 1),
(659002, 650000, '阿拉尔市', '阿拉尔', '81.28588', '40.541916', 2, 2, 1),
(659003, 650000, '图木舒克市', '图木舒克', '79.07798', '39.867317', 2, 15, 1),
(659004, 650000, '五家渠市', '五家渠', '87.526886', '44.1674', 2, 16, 1),
(710000, 0, '台湾', '台湾', '121.50906', '25.044333', 1, 34, 1),
(710100, 710000, '台北市', '台北', '121.50906', '25.044333', 2, 12, 1),
(710101, 710100, '中正区', '中正', '121.50906', '25.044333', 3, 12, 1),
(710102, 710100, '大同区', '大同', '121.50906', '25.044333', 3, 3, 1),
(710103, 710100, '中山区', '中山', '121.50906', '25.044333', 3, 11, 1),
(710104, 710100, '松山区', '松山', '121.50906', '25.044333', 3, 8, 1),
(710105, 710100, '大安区', '大安', '121.50906', '25.044333', 3, 2, 1),
(710106, 710100, '万华区', '万华', '121.50906', '25.044333', 3, 9, 1),
(710107, 710100, '信义区', '信义', '121.50906', '25.044333', 3, 6, 1),
(710108, 710100, '士林区', '士林', '121.50906', '25.044333', 3, 7, 1),
(710109, 710100, '北投区', '北投', '121.50906', '25.044333', 3, 1, 1),
(710110, 710100, '内湖区', '内湖', '121.50906', '25.044333', 3, 5, 1),
(710111, 710100, '南港区', '南港', '121.50906', '25.044333', 3, 4, 1),
(710112, 710100, '文山区', '文山', '121.50906', '25.044333', 3, 10, 1),
(710200, 710000, '高雄市', '高雄', '121.50906', '25.044333', 2, 1, 1),
(710201, 710200, '新兴区', '新兴', '121.50906', '25.044333', 3, 34, 1),
(710202, 710200, '前金区', '前金', '121.50906', '25.044333', 3, 21, 1),
(710203, 710200, '芩雅区', '芩雅', '121.50906', '25.044333', 3, 26, 1),
(710204, 710200, '盐埕区', '盐埕', '121.50906', '25.044333', 3, 36, 1),
(710205, 710200, '鼓山区', '鼓山', '121.50906', '25.044333', 3, 7, 1),
(710206, 710200, '旗津区', '旗津', '121.50906', '25.044333', 3, 25, 1),
(710207, 710200, '前镇区', '前镇', '121.50906', '25.044333', 3, 22, 1),
(710208, 710200, '三民区', '三民', '121.50906', '25.044333', 3, 29, 1),
(710209, 710200, '左营区', '左营', '121.50906', '25.044333', 3, 39, 1),
(710210, 710200, '楠梓区', '楠梓', '121.50906', '25.044333', 3, 18, 1),
(710211, 710200, '小港区', '小港', '121.50906', '25.044333', 3, 33, 1),
(710241, 710200, '苓雅区', '苓雅', '121.50906', '25.044333', 3, 10, 1),
(710242, 710200, '仁武区', '仁武', '121.50906', '25.044333', 3, 28, 1),
(710243, 710200, '大社区', '大社', '121.50906', '25.044333', 3, 3, 1),
(710244, 710200, '冈山区', '冈山', '121.50906', '25.044333', 3, 6, 1),
(710245, 710200, '路竹区', '路竹', '121.50906', '25.044333', 3, 13, 1),
(710246, 710200, '阿莲区', '阿莲', '121.50906', '25.044333', 3, 1, 1),
(710247, 710200, '田寮区', '田寮', '121.50906', '25.044333', 3, 32, 1),
(710248, 710200, '燕巢区', '燕巢', '121.50906', '25.044333', 3, 35, 1),
(710249, 710200, '桥头区', '桥头', '121.50906', '25.044333', 3, 23, 1),
(710250, 710200, '梓官区', '梓官', '121.50906', '25.044333', 3, 38, 1),
(710251, 710200, '弥陀区', '弥陀', '121.50906', '25.044333', 3, 16, 1),
(710252, 710200, '永安区', '永安', '121.50906', '25.044333', 3, 37, 1),
(710253, 710200, '湖内区', '湖内', '121.50906', '25.044333', 3, 8, 1),
(710254, 710200, '凤山区', '凤山', '121.50906', '25.044333', 3, 5, 1),
(710255, 710200, '大寮区', '大寮', '121.50906', '25.044333', 3, 2, 1),
(710256, 710200, '林园区', '林园', '121.50906', '25.044333', 3, 11, 1),
(710257, 710200, '鸟松区', '鸟松', '121.50906', '25.044333', 3, 20, 1),
(710258, 710200, '大树区', '大树', '121.50906', '25.044333', 3, 4, 1),
(710259, 710200, '旗山区', '旗山', '121.50906', '25.044333', 3, 27, 1),
(710260, 710200, '美浓区', '美浓', '121.50906', '25.044333', 3, 15, 1),
(710261, 710200, '六龟区', '六龟', '121.50906', '25.044333', 3, 12, 1),
(710262, 710200, '内门区', '内门', '121.50906', '25.044333', 3, 19, 1),
(710263, 710200, '杉林区', '杉林', '121.50906', '25.044333', 3, 30, 1),
(710264, 710200, '甲仙区', '甲仙', '121.50906', '25.044333', 3, 9, 1),
(710265, 710200, '桃源区', '桃源', '121.50906', '25.044333', 3, 31, 1),
(710266, 710200, '那玛夏区', '那玛夏', '121.50906', '25.044333', 3, 17, 1),
(710267, 710200, '茂林区', '茂林', '121.50906', '25.044333', 3, 14, 1),
(710268, 710200, '茄萣区', '茄萣', '121.50906', '25.044333', 3, 24, 1),
(710300, 710000, '台南市', '台南', '121.50906', '25.044333', 2, 14, 1),
(710301, 710300, '中西区', '中西', '121.50906', '25.044333', 3, 36, 1),
(710302, 710300, '东区', '东区', '121.50906', '25.044333', 3, 8, 1),
(710303, 710300, '南区', '南区', '121.50906', '25.044333', 3, 21, 1),
(710304, 710300, '北区', '北区', '121.50906', '25.044333', 3, 6, 1),
(710305, 710300, '安平区', '安平', '121.50906', '25.044333', 3, 3, 1),
(710306, 710300, '安南区', '安南', '121.50906', '25.044333', 3, 2, 1),
(710339, 710300, '永康区', '永康', '121.50906', '25.044333', 3, 34, 1),
(710340, 710300, '归仁区', '归仁', '121.50906', '25.044333', 3, 12, 1),
(710341, 710300, '新化区', '新化', '121.50906', '25.044333', 3, 29, 1),
(710342, 710300, '左镇区', '左镇', '121.50906', '25.044333', 3, 37, 1),
(710343, 710300, '玉井区', '玉井', '121.50906', '25.044333', 3, 35, 1),
(710344, 710300, '楠西区', '楠西', '121.50906', '25.044333', 3, 22, 1),
(710345, 710300, '南化区', '南化', '121.50906', '25.044333', 3, 20, 1),
(710346, 710300, '仁德区', '仁德', '121.50906', '25.044333', 3, 24, 1),
(710347, 710300, '关庙区', '关庙', '121.50906', '25.044333', 3, 10, 1),
(710348, 710300, '龙崎区', '龙崎', '121.50906', '25.044333', 3, 18, 1),
(710349, 710300, '官田区', '官田', '121.50906', '25.044333', 3, 11, 1),
(710350, 710300, '麻豆区', '麻豆', '121.50906', '25.044333', 3, 19, 1),
(710351, 710300, '佳里区', '佳里', '121.50906', '25.044333', 3, 14, 1),
(710352, 710300, '西港区', '西港', '121.50906', '25.044333', 3, 28, 1),
(710353, 710300, '七股区', '七股', '121.50906', '25.044333', 3, 23, 1),
(710354, 710300, '将军区', '将军', '121.50906', '25.044333', 3, 15, 1),
(710355, 710300, '学甲区', '学甲', '121.50906', '25.044333', 3, 32, 1),
(710356, 710300, '北门区', '北门', '121.50906', '25.044333', 3, 5, 1),
(710357, 710300, '新营区', '新营', '121.50906', '25.044333', 3, 31, 1),
(710358, 710300, '后壁区', '后壁', '121.50906', '25.044333', 3, 13, 1),
(710359, 710300, '白河区', '白河', '121.50906', '25.044333', 3, 4, 1),
(710360, 710300, '东山区', '东山', '121.50906', '25.044333', 3, 9, 1),
(710361, 710300, '六甲区', '六甲', '121.50906', '25.044333', 3, 16, 1),
(710362, 710300, '下营区', '下营', '121.50906', '25.044333', 3, 27, 1),
(710363, 710300, '柳营区', '柳营', '121.50906', '25.044333', 3, 17, 1),
(710364, 710300, '盐水区', '盐水', '121.50906', '25.044333', 3, 33, 1),
(710365, 710300, '善化区', '善化', '121.50906', '25.044333', 3, 25, 1),
(710366, 710300, '大内区', '大内', '121.50906', '25.044333', 3, 7, 1),
(710367, 710300, '山上区', '山上', '121.50906', '25.044333', 3, 26, 1),
(710368, 710300, '新市区', '新市', '121.50906', '25.044333', 3, 30, 1),
(710369, 710300, '安定区', '安定', '121.50906', '25.044333', 3, 1, 1),
(710400, 710000, '台中市', '台中', '121.50906', '25.044333', 2, 15, 1),
(710401, 710400, '中区', '中区', '121.50906', '25.044333', 3, 29, 1),
(710402, 710400, '东区', '东区', '121.50906', '25.044333', 3, 8, 1),
(710403, 710400, '南区', '南区', '121.50906', '25.044333', 3, 14, 1),
(710404, 710400, '西区', '西区', '121.50906', '25.044333', 3, 27, 1),
(710405, 710400, '北区', '北区', '121.50906', '25.044333', 3, 1, 1),
(710406, 710400, '北屯区', '北屯', '121.50906', '25.044333', 3, 2, 1),
(710407, 710400, '西屯区', '西屯', '121.50906', '25.044333', 3, 28, 1),
(710408, 710400, '南屯区', '南屯', '121.50906', '25.044333', 3, 15, 1),
(710431, 710400, '太平区', '太平', '121.50906', '25.044333', 3, 20, 1),
(710432, 710400, '大里区', '大里', '121.50906', '25.044333', 3, 6, 1),
(710433, 710400, '雾峰区', '雾峰', '121.50906', '25.044333', 3, 23, 1),
(710434, 710400, '乌日区', '乌日', '121.50906', '25.044333', 3, 25, 1),
(710435, 710400, '丰原区', '丰原', '121.50906', '25.044333', 3, 10, 1),
(710436, 710400, '后里区', '后里', '121.50906', '25.044333', 3, 12, 1),
(710437, 710400, '石冈区', '石冈', '121.50906', '25.044333', 3, 19, 1),
(710438, 710400, '东势区', '东势', '121.50906', '25.044333', 3, 9, 1),
(710439, 710400, '和平区', '和平', '121.50906', '25.044333', 3, 11, 1),
(710440, 710400, '新社区', '新社', '121.50906', '25.044333', 3, 26, 1),
(710441, 710400, '潭子区', '潭子', '121.50906', '25.044333', 3, 21, 1),
(710442, 710400, '大雅区', '大雅', '121.50906', '25.044333', 3, 7, 1),
(710443, 710400, '神冈区', '神冈', '121.50906', '25.044333', 3, 18, 1),
(710444, 710400, '大肚区', '大肚', '121.50906', '25.044333', 3, 4, 1),
(710445, 710400, '沙鹿区', '沙鹿', '121.50906', '25.044333', 3, 17, 1),
(710446, 710400, '龙井区', '龙井', '121.50906', '25.044333', 3, 13, 1),
(710447, 710400, '梧栖区', '梧栖', '121.50906', '25.044333', 3, 24, 1),
(710448, 710400, '清水区', '清水', '121.50906', '25.044333', 3, 16, 1),
(710449, 710400, '大甲区', '大甲', '121.50906', '25.044333', 3, 5, 1),
(710450, 710400, '外埔区', '外埔', '121.50906', '25.044333', 3, 22, 1),
(710451, 710400, '大安区', '大安', '121.50906', '25.044333', 3, 3, 1),
(710500, 710000, '金门县', '金门', '121.50906', '25.044333', 2, 6, 1),
(710507, 710500, '金沙镇', '金沙', '121.50906', '25.044333', 3, 4, 1),
(710508, 710500, '金湖镇', '金湖', '121.50906', '25.044333', 3, 2, 1),
(710509, 710500, '金宁乡', '金宁', '121.50906', '25.044333', 3, 3, 1),
(710510, 710500, '金城镇', '金城', '121.50906', '25.044333', 3, 1, 1),
(710511, 710500, '烈屿乡', '烈屿', '121.50906', '25.044333', 3, 5, 1),
(710512, 710500, '乌坵乡', '乌坵', '121.50906', '25.044333', 3, 6, 1),
(710600, 710000, '南投县', '南投', '121.50906', '25.044333', 2, 9, 1),
(710614, 710600, '南投市', '南投', '121.50906', '25.044333', 3, 8, 1),
(710615, 710600, '中寮乡', '中寮', '121.50906', '25.044333', 3, 3, 1),
(710616, 710600, '草屯镇', '草屯', '121.50906', '25.044333', 3, 1, 1),
(710617, 710600, '国姓乡', '国姓', '121.50906', '25.044333', 3, 2, 1),
(710618, 710600, '埔里镇', '埔里', '121.50906', '25.044333', 3, 9, 1),
(710619, 710600, '仁爱乡', '仁爱', '121.50906', '25.044333', 3, 10, 1),
(710620, 710600, '名间乡', '名间', '121.50906', '25.044333', 3, 7, 1),
(710621, 710600, '集集镇', '集集', '121.50906', '25.044333', 3, 5, 1),
(710622, 710600, '水里乡', '水里', '121.50906', '25.044333', 3, 11, 1),
(710623, 710600, '鱼池乡', '鱼池', '121.50906', '25.044333', 3, 13, 1),
(710624, 710600, '信义乡', '信义', '121.50906', '25.044333', 3, 12, 1),
(710625, 710600, '竹山镇', '竹山', '121.50906', '25.044333', 3, 4, 1),
(710626, 710600, '鹿谷乡', '鹿谷', '121.50906', '25.044333', 3, 6, 1),
(710700, 710000, '基隆市', '基隆', '121.50906', '25.044333', 2, 5, 1),
(710701, 710700, '仁爱区', '仁爱', '121.50906', '25.044333', 3, 4, 1),
(710702, 710700, '信义区', '信义', '121.50906', '25.044333', 3, 5, 1),
(710703, 710700, '中正区', '中正', '121.50906', '25.044333', 3, 7, 1),
(710704, 710700, '中山区', '中山', '121.50906', '25.044333', 3, 6, 1),
(710705, 710700, '安乐区', '安乐', '121.50906', '25.044333', 3, 1, 1),
(710706, 710700, '暖暖区', '暖暖', '121.50906', '25.044333', 3, 2, 1),
(710707, 710700, '七堵区', '七堵', '121.50906', '25.044333', 3, 3, 1),
(710800, 710000, '新竹市', '新竹', '121.50906', '25.044333', 2, 18, 1),
(710801, 710800, '东区', '东区', '121.50906', '25.044333', 3, 2, 1),
(710802, 710800, '北区', '北区', '121.50906', '25.044333', 3, 1, 1),
(710803, 710800, '香山区', '香山', '121.50906', '25.044333', 3, 3, 1),
(710900, 710000, '嘉义市', '嘉义', '121.50906', '25.044333', 2, 3, 1),
(710901, 710900, '东区', '东区', '121.50906', '25.044333', 3, 1, 1),
(710902, 710900, '西区', '西区', '121.50906', '25.044333', 3, 2, 1),
(711100, 710000, '新北市', '新北', '121.50906', '25.044333', 2, 17, 1),
(711130, 711100, '万里区', '万里', '121.50906', '25.044333', 3, 25, 1),
(711131, 711100, '金山区', '金山', '121.50906', '25.044333', 3, 6, 1),
(711132, 711100, '板桥区', '板桥', '121.50906', '25.044333', 3, 2, 1),
(711133, 711100, '汐止区', '汐止', '121.50906', '25.044333', 3, 20, 1),
(711134, 711100, '深坑区', '深坑', '121.50906', '25.044333', 3, 15, 1),
(711135, 711100, '石碇区', '石碇', '121.50906', '25.044333', 3, 16, 1),
(711136, 711100, '瑞芳区', '瑞芳', '121.50906', '25.044333', 3, 11, 1),
(711137, 711100, '平溪区', '平溪', '121.50906', '25.044333', 3, 10, 1),
(711138, 711100, '双溪区', '双溪', '121.50906', '25.044333', 3, 18, 1),
(711139, 711100, '贡寮区', '贡寮', '121.50906', '25.044333', 3, 4, 1),
(711140, 711100, '新店区', '新店', '121.50906', '25.044333', 3, 21, 1),
(711141, 711100, '坪林区', '坪林', '121.50906', '25.044333', 3, 9, 1),
(711142, 711100, '乌来区', '乌来', '121.50906', '25.044333', 3, 27, 1),
(711143, 711100, '永和区', '永和', '121.50906', '25.044333', 3, 29, 1),
(711144, 711100, '中和区', '中和', '121.50906', '25.044333', 3, 5, 1),
(711145, 711100, '土城区', '土城', '121.50906', '25.044333', 3, 24, 1),
(711146, 711100, '三峡区', '三峡', '121.50906', '25.044333', 3, 14, 1),
(711147, 711100, '树林区', '树林', '121.50906', '25.044333', 3, 19, 1),
(711148, 711100, '莺歌区', '莺歌', '121.50906', '25.044333', 3, 28, 1),
(711149, 711100, '三重区', '三重', '121.50906', '25.044333', 3, 12, 1),
(711150, 711100, '新庄区', '新庄', '121.50906', '25.044333', 3, 22, 1),
(711151, 711100, '泰山区', '泰山', '121.50906', '25.044333', 3, 23, 1),
(711152, 711100, '林口区', '林口', '121.50906', '25.044333', 3, 7, 1),
(711153, 711100, '芦洲区', '芦洲', '121.50906', '25.044333', 3, 8, 1),
(711154, 711100, '五股区', '五股', '121.50906', '25.044333', 3, 26, 1),
(711155, 711100, '八里区', '八里', '121.50906', '25.044333', 3, 1, 1),
(711156, 711100, '淡水区', '淡水', '121.50906', '25.044333', 3, 3, 1),
(711157, 711100, '三芝区', '三芝', '121.50906', '25.044333', 3, 13, 1),
(711158, 711100, '石门区', '石门', '121.50906', '25.044333', 3, 17, 1),
(711200, 710000, '宜兰县', '宜兰', '121.50906', '25.044333', 2, 20, 1),
(711214, 711200, '宜兰市', '宜兰', '121.50906', '25.044333', 3, 12, 1),
(711215, 711200, '头城镇', '头城', '121.50906', '25.044333', 3, 10, 1),
(711216, 711200, '礁溪乡', '礁溪', '121.50906', '25.044333', 3, 5, 1),
(711217, 711200, '壮围乡', '壮围', '121.50906', '25.044333', 3, 4, 1),
(711218, 711200, '员山乡', '员山', '121.50906', '25.044333', 3, 13, 1),
(711219, 711200, '罗东镇', '罗东', '121.50906', '25.044333', 3, 6, 1),
(711220, 711200, '三星乡', '三星', '121.50906', '25.044333', 3, 8, 1),
(711221, 711200, '大同乡', '大同', '121.50906', '25.044333', 3, 1, 1),
(711222, 711200, '五结乡', '五结', '121.50906', '25.044333', 3, 11, 1),
(711223, 711200, '冬山乡', '冬山', '121.50906', '25.044333', 3, 3, 1),
(711224, 711200, '苏澳镇', '苏澳', '121.50906', '25.044333', 3, 9, 1),
(711225, 711200, '南澳乡', '南澳', '121.50906', '25.044333', 3, 7, 1),
(711226, 711200, '钓鱼台', '钓鱼', '121.50906', '25.044333', 3, 2, 1),
(711300, 710000, '新竹县', '新竹', '121.50906', '25.044333', 2, 19, 1),
(711314, 711300, '竹北市', '竹北', '121.50906', '25.044333', 3, 8, 1),
(711315, 711300, '湖口乡', '湖口', '121.50906', '25.044333', 3, 7, 1),
(711316, 711300, '新丰乡', '新丰', '121.50906', '25.044333', 3, 11, 1),
(711317, 711300, '新埔镇', '新埔', '121.50906', '25.044333', 3, 12, 1),
(711318, 711300, '关西镇', '关西', '121.50906', '25.044333', 3, 5, 1),
(711319, 711300, '芎林乡', '芎林', '121.50906', '25.044333', 3, 3, 1),
(711320, 711300, '宝山乡', '宝山', '121.50906', '25.044333', 3, 1, 1),
(711321, 711300, '竹东镇', '竹东', '121.50906', '25.044333', 3, 9, 1),
(711322, 711300, '五峰乡', '五峰', '121.50906', '25.044333', 3, 13, 1),
(711323, 711300, '横山乡', '横山', '121.50906', '25.044333', 3, 6, 1),
(711324, 711300, '尖石乡', '尖石', '121.50906', '25.044333', 3, 10, 1),
(711325, 711300, '北埔乡', '北埔', '121.50906', '25.044333', 3, 2, 1),
(711326, 711300, '峨眉乡', '峨眉', '121.50906', '25.044333', 3, 4, 1),
(711400, 710000, '桃园县', '桃园', '121.50906', '25.044333', 2, 16, 1),
(711414, 711400, '中坜市', '中坜', '121.50906', '25.044333', 3, 7, 1),
(711415, 711400, '平镇市', '平镇', '121.50906', '25.044333', 3, 10, 1),
(711416, 711400, '龙潭乡', '龙潭', '121.50906', '25.044333', 3, 8, 1),
(711417, 711400, '杨梅市', '杨梅', '121.50906', '25.044333', 3, 13, 1),
(711418, 711400, '新屋乡', '新屋', '121.50906', '25.044333', 3, 11, 1),
(711419, 711400, '观音乡', '观音', '121.50906', '25.044333', 3, 5, 1),
(711420, 711400, '桃园市', '桃园', '121.50906', '25.044333', 3, 12, 1),
(711421, 711400, '龟山乡', '龟山', '121.50906', '25.044333', 3, 6, 1),
(711422, 711400, '八德市', '八德', '121.50906', '25.044333', 3, 1, 1),
(711423, 711400, '大溪镇', '大溪', '121.50906', '25.044333', 3, 2, 1),
(711424, 711400, '复兴乡', '复兴', '121.50906', '25.044333', 3, 4, 1),
(711425, 711400, '大园乡', '大园', '121.50906', '25.044333', 3, 3, 1),
(711426, 711400, '芦竹乡', '芦竹', '121.50906', '25.044333', 3, 9, 1),
(711500, 710000, '苗栗县', '苗栗', '121.50906', '25.044333', 2, 8, 1),
(711519, 711500, '竹南镇', '竹南', '121.50906', '25.044333', 3, 4, 1),
(711520, 711500, '头份镇', '头份', '121.50906', '25.044333', 3, 15, 1),
(711521, 711500, '三湾乡', '三湾', '121.50906', '25.044333', 3, 8, 1),
(711522, 711500, '南庄乡', '南庄', '121.50906', '25.044333', 3, 7, 1),
(711523, 711500, '狮潭乡', '狮潭', '121.50906', '25.044333', 3, 10, 1),
(711524, 711500, '后龙镇', '后龙', '121.50906', '25.044333', 3, 3, 1),
(711525, 711500, '通霄镇', '通霄', '121.50906', '25.044333', 3, 14, 1),
(711526, 711500, '苑里镇', '苑里', '121.50906', '25.044333', 3, 17, 1),
(711527, 711500, '苗栗市', '苗栗', '121.50906', '25.044333', 3, 6, 1),
(711528, 711500, '造桥乡', '造桥', '121.50906', '25.044333', 3, 18, 1),
(711529, 711500, '头屋乡', '头屋', '121.50906', '25.044333', 3, 16, 1),
(711530, 711500, '公馆乡', '公馆', '121.50906', '25.044333', 3, 2, 1),
(711531, 711500, '大湖乡', '大湖', '121.50906', '25.044333', 3, 1, 1),
(711532, 711500, '泰安乡', '泰安', '121.50906', '25.044333', 3, 12, 1),
(711533, 711500, '铜锣乡', '铜锣', '121.50906', '25.044333', 3, 13, 1),
(711534, 711500, '三义乡', '三义', '121.50906', '25.044333', 3, 9, 1),
(711535, 711500, '西湖乡', '西湖', '121.50906', '25.044333', 3, 11, 1),
(711536, 711500, '卓兰镇', '卓兰', '121.50906', '25.044333', 3, 5, 1),
(711700, 710000, '彰化县', '彰化', '121.50906', '25.044333', 2, 22, 1),
(711727, 711700, '彰化市', '彰化', '121.50906', '25.044333', 3, 11, 1),
(711728, 711700, '芬园乡', '芬园', '121.50906', '25.044333', 3, 7, 1),
(711729, 711700, '花坛乡', '花坛', '121.50906', '25.044333', 3, 10, 1),
(711730, 711700, '秀水乡', '秀水', '121.50906', '25.044333', 3, 22, 1),
(711731, 711700, '鹿港镇', '鹿港', '121.50906', '25.044333', 3, 13, 1),
(711732, 711700, '福兴乡', '福兴', '121.50906', '25.044333', 3, 8, 1),
(711733, 711700, '线西乡', '线西', '121.50906', '25.044333', 3, 19, 1),
(711734, 711700, '和美镇', '和美', '121.50906', '25.044333', 3, 9, 1),
(711735, 711700, '伸港乡', '伸港', '121.50906', '25.044333', 3, 17, 1),
(711736, 711700, '员林镇', '员林', '121.50906', '25.044333', 3, 26, 1),
(711737, 711700, '社头乡', '社头', '121.50906', '25.044333', 3, 18, 1),
(711738, 711700, '永靖乡', '永靖', '121.50906', '25.044333', 3, 25, 1),
(711739, 711700, '埔心乡', '埔心', '121.50906', '25.044333', 3, 15, 1),
(711740, 711700, '溪湖镇', '溪湖', '121.50906', '25.044333', 3, 20, 1),
(711741, 711700, '大村乡', '大村', '121.50906', '25.044333', 3, 3, 1),
(711742, 711700, '埔盐乡', '埔盐', '121.50906', '25.044333', 3, 16, 1),
(711743, 711700, '田中镇', '田中', '121.50906', '25.044333', 3, 23, 1),
(711744, 711700, '北斗镇', '北斗', '121.50906', '25.044333', 3, 1, 1),
(711745, 711700, '田尾乡', '田尾', '121.50906', '25.044333', 3, 24, 1),
(711746, 711700, '埤头乡', '埤头', '121.50906', '25.044333', 3, 14, 1),
(711747, 711700, '溪州乡', '溪州', '121.50906', '25.044333', 3, 21, 1),
(711748, 711700, '竹塘乡', '竹塘', '121.50906', '25.044333', 3, 12, 1),
(711749, 711700, '二林镇', '二林', '121.50906', '25.044333', 3, 4, 1),
(711750, 711700, '大城乡', '大城', '121.50906', '25.044333', 3, 2, 1),
(711751, 711700, '芳苑乡', '芳苑', '121.50906', '25.044333', 3, 6, 1),
(711752, 711700, '二水乡', '二水', '121.50906', '25.044333', 3, 5, 1),
(711900, 710000, '嘉义县', '嘉义', '121.50906', '25.044333', 2, 4, 1),
(711919, 711900, '番路乡', '番路', '121.50906', '25.044333', 3, 7, 1),
(711920, 711900, '梅山乡', '梅山', '121.50906', '25.044333', 3, 11, 1),
(711921, 711900, '竹崎乡', '竹崎', '121.50906', '25.044333', 3, 9, 1),
(711922, 711900, '阿里山乡', '阿里山', '121.50906', '25.044333', 3, 1, 1),
(711923, 711900, '中埔乡', '中埔', '121.50906', '25.044333', 3, 8, 1),
(711924, 711900, '大埔乡', '大埔', '121.50906', '25.044333', 3, 5, 1),
(711925, 711900, '水上乡', '水上', '121.50906', '25.044333', 3, 14, 1),
(711926, 711900, '鹿草乡', '鹿草', '121.50906', '25.044333', 3, 2, 1),
(711927, 711900, '太保市', '太保', '121.50906', '25.044333', 3, 17, 1),
(711928, 711900, '朴子市', '朴子', '121.50906', '25.044333', 3, 13, 1),
(711929, 711900, '东石乡', '东石', '121.50906', '25.044333', 3, 6, 1),
(711930, 711900, '六脚乡', '六脚', '121.50906', '25.044333', 3, 10, 1),
(711931, 711900, '新港乡', '新港', '121.50906', '25.044333', 3, 16, 1),
(711932, 711900, '民雄乡', '民雄', '121.50906', '25.044333', 3, 12, 1),
(711933, 711900, '大林镇', '大林', '121.50906', '25.044333', 3, 4, 1),
(711934, 711900, '溪口乡', '溪口', '121.50906', '25.044333', 3, 15, 1),
(711935, 711900, '义竹乡', '义竹', '121.50906', '25.044333', 3, 18, 1),
(711936, 711900, '布袋镇', '布袋', '121.50906', '25.044333', 3, 3, 1),
(712100, 710000, '云林县', '云林', '121.50906', '25.044333', 2, 21, 1),
(712121, 712100, '斗南镇', '斗南', '121.50906', '25.044333', 3, 7, 1),
(712122, 712100, '大埤乡', '大埤', '121.50906', '25.044333', 3, 4, 1),
(712123, 712100, '虎尾镇', '虎尾', '121.50906', '25.044333', 3, 10, 1),
(712124, 712100, '土库镇', '土库', '121.50906', '25.044333', 3, 19, 1),
(712125, 712100, '褒忠乡', '褒忠', '121.50906', '25.044333', 3, 1, 1),
(712126, 712100, '东势乡', '东势', '121.50906', '25.044333', 3, 5, 1),
(712127, 712100, '台西乡', '台西', '121.50906', '25.044333', 3, 18, 1),
(712128, 712100, '仑背乡', '仑背', '121.50906', '25.044333', 3, 13, 1),
(712129, 712100, '麦寮乡', '麦寮', '121.50906', '25.044333', 3, 14, 1),
(712130, 712100, '斗六市', '斗六', '121.50906', '25.044333', 3, 6, 1),
(712131, 712100, '林内乡', '林内', '121.50906', '25.044333', 3, 12, 1),
(712132, 712100, '古坑乡', '古坑', '121.50906', '25.044333', 3, 9, 1),
(712133, 712100, '莿桐乡', '莿桐', '121.50906', '25.044333', 3, 3, 1),
(712134, 712100, '西螺镇', '西螺', '121.50906', '25.044333', 3, 17, 1),
(712135, 712100, '二仑乡', '二仑', '121.50906', '25.044333', 3, 8, 1),
(712136, 712100, '北港镇', '北港', '121.50906', '25.044333', 3, 2, 1),
(712137, 712100, '水林乡', '水林', '121.50906', '25.044333', 3, 15, 1),
(712138, 712100, '口湖乡', '口湖', '121.50906', '25.044333', 3, 11, 1),
(712139, 712100, '四湖乡', '四湖', '121.50906', '25.044333', 3, 16, 1),
(712140, 712100, '元长乡', '元长', '121.50906', '25.044333', 3, 20, 1),
(712400, 710000, '屏东县', '屏东', '121.50906', '25.044333', 2, 11, 1),
(712434, 712400, '屏东市', '屏东', '121.50906', '25.044333', 3, 24, 1),
(712435, 712400, '三地门乡', '三地门', '121.50906', '25.044333', 3, 25, 1),
(712436, 712400, '雾台乡', '雾台', '121.50906', '25.044333', 3, 32, 1),
(712437, 712400, '玛家乡', '玛家', '121.50906', '25.044333', 3, 19, 1),
(712438, 712400, '九如乡', '九如', '121.50906', '25.044333', 3, 12, 1),
(712439, 712400, '里港乡', '里港', '121.50906', '25.044333', 3, 15, 1),
(712440, 712400, '高树乡', '高树', '121.50906', '25.044333', 3, 8, 1),
(712441, 712400, '盐埔乡', '盐埔', '121.50906', '25.044333', 3, 33, 1),
(712442, 712400, '长治乡', '长治', '121.50906', '25.044333', 3, 1, 1),
(712443, 712400, '麟洛乡', '麟洛', '121.50906', '25.044333', 3, 17, 1),
(712444, 712400, '竹田乡', '竹田', '121.50906', '25.044333', 3, 10, 1),
(712445, 712400, '内埔乡', '内埔', '121.50906', '25.044333', 3, 23, 1),
(712446, 712400, '万丹乡', '万丹', '121.50906', '25.044333', 3, 30, 1),
(712447, 712400, '潮州镇', '潮州', '121.50906', '25.044333', 3, 2, 1),
(712448, 712400, '泰武乡', '泰武', '121.50906', '25.044333', 3, 29, 1),
(712449, 712400, '来义乡', '来义', '121.50906', '25.044333', 3, 14, 1),
(712450, 712400, '万峦乡', '万峦', '121.50906', '25.044333', 3, 31, 1),
(712451, 712400, '崁顶乡', '崁顶', '121.50906', '25.044333', 3, 13, 1),
(712452, 712400, '新埤乡', '新埤', '121.50906', '25.044333', 3, 27, 1),
(712453, 712400, '南州乡', '南州', '121.50906', '25.044333', 3, 22, 1),
(712454, 712400, '林边乡', '林边', '121.50906', '25.044333', 3, 16, 1),
(712455, 712400, '东港镇', '东港', '121.50906', '25.044333', 3, 5, 1),
(712456, 712400, '琉球乡', '琉球', '121.50906', '25.044333', 3, 18, 1),
(712457, 712400, '佳冬乡', '佳冬', '121.50906', '25.044333', 3, 11, 1),
(712458, 712400, '新园乡', '新园', '121.50906', '25.044333', 3, 28, 1),
(712459, 712400, '枋寮乡', '枋寮', '121.50906', '25.044333', 3, 6, 1),
(712460, 712400, '枋山乡', '枋山', '121.50906', '25.044333', 3, 7, 1),
(712461, 712400, '春日乡', '春日', '121.50906', '25.044333', 3, 4, 1),
(712462, 712400, '狮子乡', '狮子', '121.50906', '25.044333', 3, 26, 1),
(712463, 712400, '车城乡', '车城', '121.50906', '25.044333', 3, 3, 1),
(712464, 712400, '牡丹乡', '牡丹', '121.50906', '25.044333', 3, 21, 1),
(712465, 712400, '恒春镇', '恒春', '121.50906', '25.044333', 3, 9, 1),
(712466, 712400, '满州乡', '满州', '121.50906', '25.044333', 3, 20, 1),
(712500, 710000, '台东县', '台东', '121.50906', '25.044333', 2, 13, 1),
(712517, 712500, '台东市', '台东', '121.50906', '25.044333', 3, 14, 1),
(712518, 712500, '绿岛乡', '绿岛', '121.50906', '25.044333', 3, 13, 1),
(712519, 712500, '兰屿乡', '兰屿', '121.50906', '25.044333', 3, 11, 1),
(712520, 712500, '延平乡', '延平', '121.50906', '25.044333', 3, 16, 1),
(712521, 712500, '卑南乡', '卑南', '121.50906', '25.044333', 3, 1, 1),
(712522, 712500, '鹿野乡', '鹿野', '121.50906', '25.044333', 3, 12, 1),
(712523, 712500, '关山镇', '关山', '121.50906', '25.044333', 3, 8, 1),
(712524, 712500, '海端乡', '海端', '121.50906', '25.044333', 3, 9, 1),
(712525, 712500, '池上乡', '池上', '121.50906', '25.044333', 3, 4, 1),
(712526, 712500, '东河乡', '东河', '121.50906', '25.044333', 3, 7, 1),
(712527, 712500, '成功镇', '成功', '121.50906', '25.044333', 3, 3, 1),
(712528, 712500, '长滨乡', '长滨', '121.50906', '25.044333', 3, 2, 1),
(712529, 712500, '金峰乡', '金峰', '121.50906', '25.044333', 3, 10, 1),
(712530, 712500, '大武乡', '大武', '121.50906', '25.044333', 3, 6, 1),
(712531, 712500, '达仁乡', '达仁', '121.50906', '25.044333', 3, 5, 1),
(712532, 712500, '太麻里乡', '太麻里', '121.50906', '25.044333', 3, 15, 1),
(712600, 710000, '花莲县', '花莲', '121.50906', '25.044333', 2, 2, 1),
(712615, 712600, '花莲市', '花莲', '121.50906', '25.044333', 3, 5, 1),
(712616, 712600, '新城乡', '新城', '121.50906', '25.044333', 3, 10, 1),
(712617, 712600, '太鲁阁', '太鲁', '121.50906', '25.044333', 3, 12, 1),
(712618, 712600, '秀林乡', '秀林', '121.50906', '25.044333', 3, 11, 1),
(712619, 712600, '吉安乡', '吉安', '121.50906', '25.044333', 3, 7, 1),
(712620, 712600, '寿丰乡', '寿丰', '121.50906', '25.044333', 3, 9, 1),
(712621, 712600, '凤林镇', '凤林', '121.50906', '25.044333', 3, 2, 1),
(712622, 712600, '光复乡', '光复', '121.50906', '25.044333', 3, 4, 1),
(712623, 712600, '丰滨乡', '丰滨', '121.50906', '25.044333', 3, 1, 1),
(712624, 712600, '瑞穗乡', '瑞穗', '121.50906', '25.044333', 3, 8, 1),
(712625, 712600, '万荣乡', '万荣', '121.50906', '25.044333', 3, 13, 1),
(712626, 712600, '玉里镇', '玉里', '121.50906', '25.044333', 3, 14, 1),
(712627, 712600, '卓溪乡', '卓溪', '121.50906', '25.044333', 3, 6, 1),
(712628, 712600, '富里乡', '富里', '121.50906', '25.044333', 3, 3, 1),
(712700, 710000, '澎湖县', '澎湖', '121.50906', '25.044333', 2, 10, 1),
(712707, 712700, '马公市', '马公', '121.50906', '25.044333', 3, 4, 1),
(712708, 712700, '西屿乡', '西屿', '121.50906', '25.044333', 3, 5, 1),
(712709, 712700, '望安乡', '望安', '121.50906', '25.044333', 3, 6, 1),
(712710, 712700, '七美乡', '七美', '121.50906', '25.044333', 3, 2, 1),
(712711, 712700, '白沙乡', '白沙', '121.50906', '25.044333', 3, 1, 1),
(712712, 712700, '湖西乡', '湖西', '121.50906', '25.044333', 3, 3, 1),
(712800, 710000, '连江县', '连江', '121.50906', '25.044333', 2, 7, 1),
(712805, 712800, '南竿乡', '南竿', '121.50906', '25.044333', 3, 4, 1),
(712806, 712800, '北竿乡', '北竿', '121.50906', '25.044333', 3, 1, 1),
(712807, 712800, '莒光乡', '莒光', '121.50906', '25.044333', 3, 3, 1),
(712808, 712800, '东引乡', '东引', '121.50906', '25.044333', 3, 2, 1),
(810000, 0, '香港特别行政区', '香港', '114.173355', '22.320047', 1, 32, 1),
(810100, 810000, '香港岛', '香港岛', '114.173355', '22.320047', 2, 2, 1),
(810101, 810100, '中西区', '中西', '114.173355', '22.320047', 3, 4, 1),
(810102, 810100, '湾仔', '湾仔', '114.173355', '22.320047', 3, 3, 1),
(810103, 810100, '东区', '东区', '114.173355', '22.320047', 3, 1, 1),
(810104, 810100, '南区', '南区', '114.173355', '22.320047', 3, 2, 1),
(810200, 810000, '九龙', '九龙', '114.173355', '22.320047', 2, 1, 1),
(810201, 810200, '九龙城区', '九龙城', '114.173355', '22.320047', 3, 3, 1),
(810202, 810200, '油尖旺区', '油尖旺', '114.173355', '22.320047', 3, 5, 1),
(810203, 810200, '深水埗区', '深水埗', '114.173355', '22.320047', 3, 4, 1),
(810204, 810200, '黄大仙区', '黄大仙', '114.173355', '22.320047', 3, 2, 1),
(810205, 810200, '观塘区', '观塘', '114.173355', '22.320047', 3, 1, 1),
(810300, 810000, '新界', '新界', '114.173355', '22.320047', 2, 3, 1),
(810301, 810300, '北区', '北区', '114.173355', '22.320047', 3, 1, 1),
(810302, 810300, '大埔区', '大埔', '114.173355', '22.320047', 3, 2, 1),
(810303, 810300, '沙田区', '沙田', '114.173355', '22.320047', 3, 6, 1),
(810304, 810300, '西贡区', '西贡', '114.173355', '22.320047', 3, 8, 1),
(810305, 810300, '元朗区', '元朗', '114.173355', '22.320047', 3, 9, 1),
(810306, 810300, '屯门区', '屯门', '114.173355', '22.320047', 3, 7, 1),
(810307, 810300, '荃湾区', '荃湾', '114.173355', '22.320047', 3, 5, 1),
(810308, 810300, '葵青区', '葵青', '114.173355', '22.320047', 3, 3, 1),
(810309, 810300, '离岛区', '离岛', '114.173355', '22.320047', 3, 4, 1),
(820000, 0, '澳门特别行政区', '澳门', '113.54909', '22.198952', 1, 33, 1),
(820100, 820000, '澳门半岛', '澳门半岛', '113.54913', '22.198751', 2, 1, 1),
(820200, 820000, '离岛', '离岛', '113.54909', '22.198952', 2, 2, 1),
(419001001, 410881, '沁园街道', '沁园街道', '112.94053', '35.084732', 3, 8, 1),
(419001002, 410881, '济水街道', '济水街道', '112.5899', '35.0905', 3, 4, 1),
(419001003, 410881, '北海街道', '北海街道', '112.59323', '35.097412', 3, 1, 1),
(419001004, 410881, '天坛街道', '天坛街道', '112.56196', '35.092518', 3, 11, 1),
(419001005, 410881, '玉泉街道', '玉泉街道', '112.61578', '35.09176', 3, 15, 1),
(419001100, 410881, '克井镇', '克井镇', '112.54303', '35.160297', 3, 5, 1),
(419001101, 410881, '五龙口镇', '五龙口镇', '112.68937', '35.13504', 3, 13, 1),
(419001102, 410881, '轵城镇', '轵城镇', '112.60099', '35.04613', 3, 16, 1),
(419001103, 410881, '承留镇', '承留镇', '112.49927', '35.077713', 3, 2, 1),
(419001104, 410881, '邵原镇', '邵原镇', '112.13353', '35.160957', 3, 9, 1),
(419001105, 410881, '坡头镇', '坡头镇', '112.52476', '34.928432', 3, 7, 1),
(419001106, 410881, '梨林镇', '梨林镇', '112.7135', '35.07768', 3, 6, 1),
(419001107, 410881, '大峪镇', '大峪镇', '112.39616', '34.937622', 3, 3, 1),
(419001108, 410881, '思礼镇', '思礼镇', '112.507286', '35.10113', 3, 10, 1),
(419001109, 410881, '王屋镇', '王屋镇', '112.27247', '35.113907', 3, 12, 1),
(419001110, 410881, '下冶镇', '下冶镇', '112.200226', '35.03283', 3, 14, 1),
(429004001, 429004, '沙嘴街道', '沙嘴街道', '113.45212', '30.356764', 3, 17, 1),
(429004002, 429004, '干河街道', '干河街道', '113.42643', '30.374418', 3, 4, 1),
(429004003, 429004, '龙华山办事处', '龙华山办事处', '113.46133', '30.369509', 3, 9, 1),
(429004100, 429004, '郑场镇', '郑场镇', '113.03368', '30.48722', 3, 25, 1),
(429004101, 429004, '毛嘴镇', '毛嘴镇', '113.03534', '30.41731', 3, 10, 1),
(429004102, 429004, '豆河镇', '豆河镇', '113.45397', '30.364952', 3, 3, 1),
(429004103, 429004, '三伏潭镇', '三伏潭镇', '113.20843', '30.37174', 3, 14, 1),
(429004104, 429004, '胡场镇', '胡场镇', '113.30809', '30.377514', 3, 7, 1),
(429004105, 429004, '长倘口镇', '长倘口镇', '113.45397', '30.364952', 3, 23, 1),
(429004106, 429004, '西流河镇', '西流河镇', '113.67766', '30.314503', 3, 20, 1),
(429004107, 429004, '沙湖镇', '沙湖镇', '113.68513', '30.166756', 3, 16, 1),
(429004108, 429004, '杨林尾镇', '杨林尾镇', '113.509285', '30.137066', 3, 21, 1),
(429004109, 429004, '彭场镇', '彭场镇', '113.50644', '30.263346', 3, 13, 1),
(429004110, 429004, '张沟镇', '张沟镇', '113.38597', '30.246231', 3, 22, 1),
(429004111, 429004, '郭河镇', '郭河镇', '113.30176', '30.23751', 3, 6, 1),
(429004112, 429004, '沔城回族镇', '沔城回族镇', '113.23088', '30.19298', 3, 11, 1),
(429004113, 429004, '通海口镇', '通海口镇', '113.162', '30.193304', 3, 18, 1),
(429004114, 429004, '陈场镇', '陈场镇', '113.08773', '30.235126', 3, 1, 1),
(429004400, 429004, '工业园区', '工业园区', '113.415016', '30.336159', 3, 5, 1),
(429004401, 429004, '九合垸原种场', '九合垸原种场', '113.45397', '30.364952', 3, 8, 1),
(429004402, 429004, '沙湖原种场', '沙湖原种场', '113.68513', '30.166756', 3, 15, 1),
(429004404, 429004, '五湖渔场', '五湖渔场', '113.45397', '30.364952', 3, 19, 1),
(429004405, 429004, '赵西垸林场', '赵西垸林场', '113.0154', '30.309315', 3, 24, 1),
(429004407, 429004, '畜禽良种场', '畜禽良种场', '113.45397', '30.364952', 3, 2, 1),
(429004408, 429004, '排湖风景区', '排湖风景区', '113.25985', '30.287945', 3, 12, 1),
(429005001, 429005, '园林办事处', '园林办事处', '112.89226', '30.412252', 3, 18, 1),
(429005002, 429005, '杨市办事处', '杨市办事处', '112.90617', '30.36862', 3, 17, 1),
(429005003, 429005, '周矶办事处', '周矶办事处', '112.78836', '30.410257', 3, 22, 1),
(429005004, 429005, '广华办事处', '广华办事处', '112.69871', '30.4433', 3, 4, 1),
(429005005, 429005, '泰丰办事处', '泰丰办事处', '112.896866', '30.421215', 3, 13, 1),
(429005006, 429005, '高场办事处', '高场办事处', '112.896866', '30.421215', 3, 2, 1),
(429005100, 429005, '竹根滩镇', '竹根滩镇', '112.90665', '30.493507', 3, 24, 1),
(429005101, 429005, '渔洋镇', '渔洋镇', '112.91528', '30.1706', 3, 20, 1),
(429005102, 429005, '王场镇', '王场镇', '112.77432', '30.504892', 3, 14, 1),
(429005103, 429005, '高石碑镇', '高石碑镇', '112.67327', '30.547512', 3, 3, 1),
(429005104, 429005, '熊口镇', '熊口镇', '112.78727', '30.303913', 3, 16, 1),
(429005105, 429005, '老新镇', '老新镇', '112.85718', '30.188774', 3, 10, 1),
(429005106, 429005, '浩口镇', '浩口镇', '112.65', '30.378738', 3, 6, 1),
(429005107, 429005, '积玉口镇', '积玉口镇', '112.602844', '30.445454', 3, 9, 1),
(429005108, 429005, '张金镇', '张金镇', '112.59658', '30.19193', 3, 21, 1),
(429005109, 429005, '龙湾镇', '龙湾镇', '112.71678', '30.229498', 3, 11, 1),
(429005400, 429005, '江汉石油管理局', '江汉石油管理局', '112.896866', '30.421215', 3, 8, 1),
(429005401, 429005, '潜江经济开发区', '潜江经济开发区', '112.896866', '30.421215', 3, 12, 1),
(429005450, 429005, '周矶管理区', '周矶管理区', '112.78836', '30.410257', 3, 23, 1),
(429005451, 429005, '后湖管理区', '后湖管理区', '112.896866', '30.421215', 3, 7, 1),
(429005452, 429005, '熊口管理区', '熊口管理区', '112.78727', '30.303913', 3, 15, 1),
(429005453, 429005, '总口管理区', '总口管理区', '112.896866', '30.421215', 3, 25, 1),
(429005454, 429005, '白鹭湖管理区', '白鹭湖管理区', '112.896866', '30.421215', 3, 1, 1),
(429005455, 429005, '运粮湖管理区', '运粮湖管理区', '112.58782', '30.309473', 3, 19, 1),
(429005457, 429005, '浩口原种场', '浩口原种场', '112.65', '30.378738', 3, 5, 1),
(429006001, 429006, '竟陵街道', '竟陵街道', '113.16709', '30.64568', 3, 12, 1),
(429006002, 429006, '侨乡街道开发区', '侨乡街道开发区', '113.16586', '30.65306', 3, 19, 1),
(429006003, 429006, '杨林街道', '杨林街道', '113.19488', '30.639917', 3, 24, 1),
(429006100, 429006, '多宝镇', '多宝镇', '112.70365', '30.665754', 3, 3, 1),
(429006101, 429006, '拖市镇', '拖市镇', '112.839005', '30.723396', 3, 21, 1),
(429006102, 429006, '张港镇', '张港镇', '112.886406', '30.566088', 3, 28, 1),
(429006103, 429006, '蒋场镇', '蒋场镇', '112.94748', '30.603558', 3, 10, 1),
(429006104, 429006, '汪场镇', '汪场镇', '113.041016', '30.61378', 3, 22, 1),
(429006105, 429006, '渔薪镇', '渔薪镇', '112.99056', '30.675339', 3, 26, 1),
(429006106, 429006, '黄潭镇', '黄潭镇', '113.090805', '30.659422', 3, 8, 1),
(429006107, 429006, '岳口镇', '岳口镇', '113.084274', '30.50957', 3, 25, 1),
(429006108, 429006, '横林镇', '横林镇', '113.19619', '30.527416', 3, 7, 1),
(429006109, 429006, '彭市镇', '彭市镇', '113.19632', '30.447777', 3, 18, 1),
(429006110, 429006, '麻洋镇', '麻洋镇', '113.274025', '30.432419', 3, 17, 1),
(429006111, 429006, '多祥镇', '多祥镇', '113.37303', '30.423721', 3, 4, 1),
(429006112, 429006, '干驿镇', '干驿镇', '113.39288', '30.539343', 3, 6, 1),
(429006113, 429006, '马湾镇', '马湾镇', '113.3402', '30.570574', 3, 16, 1),
(429006114, 429006, '卢市镇', '卢市镇', '113.34396', '30.667866', 3, 15, 1),
(429006115, 429006, '小板镇', '小板镇', '113.23028', '30.605022', 3, 23, 1),
(429006116, 429006, '九真镇', '九真镇', '113.227196', '30.741203', 3, 14, 1),
(429006118, 429006, '皂市镇', '皂市镇', '113.34936', '30.856178', 3, 27, 1),
(429006119, 429006, '胡市镇', '胡市镇', '113.38961', '30.779594', 3, 9, 1),
(429006120, 429006, '石河镇', '石河镇', '113.08601', '30.75847', 3, 20, 1),
(429006121, 429006, '佛子山镇', '佛子山镇', '113.011284', '30.752449', 3, 5, 1),
(429006201, 429006, '净潭乡', '净潭乡', '113.40454', '30.652748', 3, 13, 1),
(429006450, 429006, '蒋湖农场', '蒋湖农场', '113.316765', '30.552017', 3, 11, 1),
(429006451, 429006, '白茅湖农场', '白茅湖农场', '113.16586', '30.65306', 3, 1, 1),
(429006452, 429006, '沉湖管委会', '沉湖管委会', '113.16586', '30.65306', 3, 2, 1),
(429021100, 429021, '松柏镇', '松柏镇', '110.66154', '31.746908', 3, 4, 1),
(429021101, 429021, '阳日镇', '阳日镇', '110.819534', '31.737394', 3, 8, 1),
(429021102, 429021, '木鱼镇', '木鱼镇', '110.3993', '31.468685', 3, 3, 1),
(429021103, 429021, '红坪镇', '红坪镇', '110.4293', '31.672834', 3, 1, 1),
(429021104, 429021, '新华镇', '新华镇', '110.89154', '31.592997', 3, 7, 1),
(429021105, 429021, '九湖镇', '九湖镇', '114.29857', '30.584354', 3, 2, 1),
(429021200, 429021, '宋洛乡', '宋洛乡', '110.60796', '31.660862', 3, 5, 1),
(429021202, 429021, '下谷坪土家族乡', '下谷坪土家族乡', '110.245255', '31.365767', 3, 6, 1),
(441901003, 441900, '东城街道', '东城街道', '113.78323', '23.028143', 3, 6, 1),
(441901004, 441900, '南城街道', '南城街道', '113.744095', '23.01848', 3, 20, 1),
(441901005, 441900, '万江街道', '万江街道', '113.7384', '23.047073', 3, 31, 1),
(441901006, 441900, '莞城街道', '莞城街道', '113.74917', '23.038525', 3, 11, 1),
(441901101, 441900, '石碣镇', '石碣镇', '113.81312', '23.09935', 3, 25, 1),
(441901102, 441900, '石龙镇', '石龙镇', '113.87434', '23.105394', 3, 26, 1),
(441901103, 441900, '茶山镇', '茶山镇', '113.86909', '23.076267', 3, 2, 1),
(441901104, 441900, '石排镇', '石排镇', '113.94031', '23.090315', 3, 27, 1),
(441901105, 441900, '企石镇', '企石镇', '114.022026', '23.072874', 3, 23, 1),
(441901106, 441900, '横沥镇', '横沥镇', '113.9664', '23.019423', 3, 12, 1),
(441901107, 441900, '桥头镇', '桥头镇', '114.10331', '23.023918', 3, 21, 1),
(441901108, 441900, '谢岗镇', '谢岗镇', '114.148476', '22.961075', 3, 32, 1),
(441901109, 441900, '东坑镇', '东坑镇', '113.93387', '22.995838', 3, 8, 1),
(441901110, 441900, '常平镇', '常平镇', '113.99312', '22.9749', 3, 1, 1),
(441901111, 441900, '寮步镇', '寮步镇', '113.87497', '22.99732', 3, 18, 1),
(441901112, 441900, '樟木头镇', '樟木头镇', '114.08351', '22.91393', 3, 34, 1),
(441901113, 441900, '大朗镇', '大朗镇', '113.94408', '22.940058', 3, 3, 1),
(441901114, 441900, '黄江镇', '黄江镇', '114.00367', '22.915295', 3, 15, 1),
(441901115, 441900, '清溪镇', '清溪镇', '114.16422', '22.843819', 3, 22, 1),
(441901116, 441900, '塘厦镇', '塘厦镇', '114.10061', '22.81431', 3, 29, 1),
(441901117, 441900, '凤岗镇', '凤岗镇', '114.136955', '22.746191', 3, 9, 1),
(441901118, 441900, '大岭山镇', '大岭山镇', '113.8419', '22.899944', 3, 4, 1),
(441901119, 441900, '长安镇', '长安镇', '113.80273', '22.815367', 3, 33, 1),
(441901121, 441900, '虎门镇', '虎门镇', '113.67278', '22.814705', 3, 17, 1),
(441901122, 441900, '厚街镇', '厚街镇', '113.67033', '22.93529', 3, 14, 1),
(441901123, 441900, '沙田镇', '沙田镇', '113.61779', '22.919003', 3, 24, 1),
(441901124, 441900, '道滘镇', '道滘镇', '113.67493', '23.004396', 3, 5, 1),
(441901125, 441900, '洪梅镇', '洪梅镇', '113.6089', '22.994719', 3, 13, 1),
(441901126, 441900, '麻涌镇', '麻涌镇', '113.58176', '23.051554', 3, 19, 1),
(441901127, 441900, '望牛墩镇', '望牛墩镇', '113.656235', '23.055334', 3, 30, 1),
(441901128, 441900, '中堂镇', '中堂镇', '113.65742', '23.092388', 3, 35, 1),
(441901129, 441900, '高埗镇', '高埗镇', '113.71937', '23.083626', 3, 10, 1),
(441901401, 441900, '松山湖管委会', '松山湖管委会', '113.74626', '23.046238', 3, 28, 1),
(441901402, 441900, '虎门港管委会', '虎门港管委会', '113.74626', '23.046238', 3, 16, 1),
(441901403, 441900, '东莞生态园', '东莞生态园', '113.74626', '23.046238', 3, 7, 1),
(442001001, 442000, '石岐区街道', '石岐区街道', '113.38239', '22.521112', 3, 20, 1),
(442001002, 442000, '东区街道', '东区街道', '113.398575', '22.5137', 3, 4, 1),
(442001003, 442000, '火炬开发区街道', '火炬开发区街道', '113.28064', '23.125177', 3, 11, 1),
(442001004, 442000, '西区街道', '西区街道', '113.358986', '22.520088', 3, 24, 1),
(442001005, 442000, '南区街道', '南区街道', '113.354416', '22.48543', 3, 14, 1),
(442001006, 442000, '五桂山街道', '五桂山街道', '113.40242', '22.446247', 3, 22, 1),
(442001100, 442000, '小榄镇', '小榄镇', '113.2514', '22.671394', 3, 23, 1),
(442001101, 442000, '黄圃镇', '黄圃镇', '113.33915', '22.710865', 3, 10, 1),
(442001102, 442000, '民众镇', '民众镇', '113.49384', '22.621553', 3, 12, 1),
(442001103, 442000, '东凤镇', '东凤镇', '113.25752', '22.701674', 3, 3, 1),
(442001104, 442000, '东升镇', '东升镇', '113.291664', '22.62273', 3, 5, 1),
(442001105, 442000, '古镇镇', '古镇镇', '113.190735', '22.612547', 3, 8, 1),
(442001106, 442000, '沙溪镇', '沙溪镇', '113.321236', '22.50866', 3, 18, 1),
(442001107, 442000, '坦洲镇', '坦洲镇', '113.46751', '22.254837', 3, 21, 1),
(442001108, 442000, '港口镇', '港口镇', '113.38492', '22.585398', 3, 7, 1),
(442001109, 442000, '三角镇', '三角镇', '113.41821', '22.676245', 3, 16, 1),
(442001110, 442000, '横栏镇', '横栏镇', '113.2497', '22.534708', 3, 9, 1),
(442001111, 442000, '南头镇', '南头镇', '113.29173', '22.717037', 3, 15, 1),
(442001112, 442000, '阜沙镇', '阜沙镇', '113.34991', '22.66725', 3, 6, 1),
(442001113, 442000, '南朗镇', '南朗镇', '113.53129', '22.498753', 3, 13, 1),
(442001114, 442000, '三乡镇', '三乡镇', '113.440956', '22.35817', 3, 17, 1),
(442001115, 442000, '板芙镇', '板芙镇', '113.32265', '22.416782', 3, 1, 1),
(442001116, 442000, '大涌镇', '大涌镇', '113.30093', '22.465063', 3, 2, 1),
(442001117, 442000, '神湾镇', '神湾镇', '113.363815', '22.302496', 3, 19, 1),
(460201100, 460200, '海棠湾镇', '海棠湾镇', '109.75254', '18.400051', 3, 6, 1),
(460201101, 460200, '吉阳镇', '吉阳镇', '109.57856', '18.281801', 3, 9, 1),
(460201102, 460200, '凤凰镇', '凤凰镇', '109.4527', '18.299265', 3, 1, 1),
(460201103, 460200, '崖城镇', '崖城镇', '109.171844', '18.357288', 3, 11, 1),
(460201104, 460200, '天涯镇', '天涯镇', '109.32742', '18.307486', 3, 10, 1),
(460201105, 460200, '育才镇', '育才镇', '109.309784', '18.416534', 3, 12, 1),
(460201400, 460200, '国营南田农场', '国营南田农场', '109.50827', '18.247871', 3, 4, 1),
(460201401, 460200, '国营南新农场', '国营南新农场', '109.52357', '18.295216', 3, 5, 1),
(460201403, 460200, '国营立才农场', '国营立才农场', '109.50827', '18.247871', 3, 2, 1),
(460201404, 460200, '国营南滨农场', '国营南滨农场', '109.50827', '18.247871', 3, 3, 1),
(460201451, 460200, '河西区街道', '河西区街道', '109.50827', '18.247871', 3, 8, 1),
(460201452, 460200, '河东区街道', '河东区街道', '109.50827', '18.247871', 3, 7, 1),
(469001100, 469001, '通什镇', '通什镇', '109.51666', '18.77692', 3, 8, 1),
(469001101, 469001, '南圣镇', '南圣镇', '109.59654', '18.735611', 3, 6, 1),
(469001102, 469001, '毛阳镇', '毛阳镇', '109.50804', '18.936964', 3, 5, 1),
(469001103, 469001, '番阳镇', '番阳镇', '109.3979', '18.874456', 3, 2, 1),
(469001200, 469001, '畅好乡', '畅好乡', '109.487404', '18.733683', 3, 1, 1),
(469001201, 469001, '毛道乡', '毛道乡', '109.4164', '18.790749', 3, 4, 1),
(469001202, 469001, '水满乡', '水满乡', '109.67126', '18.880068', 3, 7, 1),
(469001400, 469001, '国营畅好农场', '国营畅好农场', '109.51666', '18.77692', 3, 3, 1),
(469002100, 469002, '嘉积镇', '嘉积镇', '110.48599', '19.242966', 3, 8, 1),
(469002101, 469002, '万泉镇', '万泉镇', '110.409584', '19.24299', 3, 13, 1),
(469002102, 469002, '石壁镇', '石壁镇', '110.30859', '19.163334', 3, 10, 1),
(469002103, 469002, '中原镇', '中原镇', '110.468475', '19.15191', 3, 16, 1),
(469002104, 469002, '博鳌镇', '博鳌镇', '110.58657', '19.159786', 3, 2, 1),
(469002105, 469002, '阳江镇', '阳江镇', '110.35224', '19.096958', 3, 14, 1),
(469002106, 469002, '龙江镇', '龙江镇', '110.32497', '19.146788', 3, 9, 1),
(469002107, 469002, '潭门镇', '潭门镇', '110.58416', '19.230127', 3, 11, 1),
(469002108, 469002, '塔洋镇', '塔洋镇', '110.514565', '19.287613', 3, 12, 1),
(469002109, 469002, '长坡镇', '长坡镇', '110.60677', '19.335619', 3, 15, 1),
(469002110, 469002, '大路镇', '大路镇', '110.477974', '19.383337', 3, 3, 1),
(469002111, 469002, '会山镇', '会山镇', '110.26938', '19.067148', 3, 7, 1),
(469002400, 469002, '国营东太农场', '国营东太农场', '110.46678', '19.246012', 3, 6, 1),
(469002402, 469002, '国营东红农场', '国营东红农场', '110.46678', '19.246012', 3, 4, 1),
(469002403, 469002, '国营东升农场', '国营东升农场', '110.46678', '19.246012', 3, 5, 1),
(469002500, 469002, '彬村山华侨农场', '彬村山华侨农场', '110.46678', '19.246012', 3, 1, 1),
(469003100, 469003, '那大镇', '那大镇', '109.54641', '19.514877', 3, 16, 1),
(469003101, 469003, '和庆镇', '和庆镇', '109.64342', '19.524551', 3, 11, 1),
(469003102, 469003, '南丰镇', '南丰镇', '109.55929', '19.407114', 3, 15, 1),
(469003103, 469003, '大成镇', '大成镇', '109.39966', '19.507965', 3, 2, 1),
(469003104, 469003, '雅星镇', '雅星镇', '109.26911', '19.444077', 3, 22, 1),
(469003105, 469003, '兰洋镇', '兰洋镇', '109.66439', '19.460398', 3, 13, 1),
(469003106, 469003, '光村镇', '光村镇', '109.48655', '19.813633', 3, 5, 1),
(469003107, 469003, '木棠镇', '木棠镇', '109.35583', '19.804586', 3, 14, 1),
(469003108, 469003, '海头镇', '海头镇', '108.95339', '19.503315', 3, 10, 1),
(469003109, 469003, '峨蔓镇', '峨蔓镇', '109.26678', '19.854773', 3, 4, 1),
(469003110, 469003, '三都镇', '三都镇', '109.223366', '19.785944', 3, 18, 1),
(469003111, 469003, '王五镇', '王五镇', '109.29955', '19.652266', 3, 19, 1),
(469003112, 469003, '白马井镇', '白马井镇', '109.2272', '19.707598', 3, 1, 1),
(469003113, 469003, '中和镇', '中和镇', '109.35499', '19.73966', 3, 23, 1),
(469003114, 469003, '排浦镇', '排浦镇', '109.16808', '19.637236', 3, 17, 1),
(469003115, 469003, '东成镇', '东成镇', '109.46137', '19.703707', 3, 3, 1),
(469003116, 469003, '新州镇', '新州镇', '109.31617', '19.71431', 3, 20, 1),
(469003400, 469003, '国营西培农场', '国营西培农场', '109.57678', '19.517487', 3, 9, 1),
(469003404, 469003, '国营西联农场', '国营西联农场', '109.57678', '19.517487', 3, 8, 1),
(469003405, 469003, '国营蓝洋农场', '国营蓝洋农场', '109.57678', '19.517487', 3, 7, 1),
(469003407, 469003, '国营八一农场', '国营八一农场', '109.57678', '19.517487', 3, 6, 1),
(469003499, 469003, '洋浦经济开发区', '洋浦经济开发区', '109.18472', '19.766945', 3, 21, 1),
(469003500, 469003, '华南热作学院', '华南热作学院', '109.57678', '19.517487', 3, 12, 1),
(469005100, 469005, '文城镇', '文城镇', '110.75387', '19.613781', 3, 17, 1),
(469005101, 469005, '重兴镇', '重兴镇', '110.60394', '19.409794', 3, 20, 1),
(469005102, 469005, '蓬莱镇', '蓬莱镇', '110.54115', '19.536718', 3, 14, 1),
(469005103, 469005, '会文镇', '会文镇', '110.73176', '19.462574', 3, 11, 1),
(469005104, 469005, '东路镇', '东路镇', '110.7065', '19.791948', 3, 5, 1),
(469005105, 469005, '潭牛镇', '潭牛镇', '110.73536', '19.710085', 3, 16, 1),
(469005106, 469005, '东阁镇', '东阁镇', '110.85467', '19.65524', 3, 3, 1),
(469005107, 469005, '文教镇', '文教镇', '110.91449', '19.66635', 3, 19, 1),
(469005108, 469005, '东郊镇', '东郊镇', '110.86616', '19.572903', 3, 4, 1),
(469005109, 469005, '龙楼镇', '龙楼镇', '110.968605', '19.653286', 3, 13, 1),
(469005110, 469005, '昌洒镇', '昌洒镇', '110.9005', '19.761791', 3, 2, 1),
(469005111, 469005, '翁田镇', '翁田镇', '110.88374', '19.928175', 3, 18, 1),
(469005112, 469005, '抱罗镇', '抱罗镇', '110.74893', '19.843477', 3, 1, 1),
(469005113, 469005, '冯坡镇', '冯坡镇', '110.78701', '19.962193', 3, 6, 1),
(469005114, 469005, '锦山镇', '锦山镇', '110.70207', '19.994598', 3, 12, 1),
(469005115, 469005, '铺前镇', '铺前镇', '110.58436', '20.023079', 3, 15, 1),
(469005116, 469005, '公坡镇', '公坡镇', '110.813896', '19.786879', 3, 7, 1),
(469005400, 469005, '国营东路农场', '国营东路农场', '110.753975', '19.612986', 3, 8, 1),
(469005401, 469005, '国营南阳农场', '国营南阳农场', '110.753975', '19.612986', 3, 10, 1),
(469005402, 469005, '国营罗豆农场', '国营罗豆农场', '110.753975', '19.612986', 3, 9, 1),
(469006100, 469006, '万城镇', '万城镇', '110.397026', '18.794436', 3, 15, 1),
(469006101, 469006, '龙滚镇', '龙滚镇', '110.51908', '19.058695', 3, 11, 1),
(469006102, 469006, '和乐镇', '和乐镇', '110.48232', '18.902359', 3, 8, 1),
(469006103, 469006, '后安镇', '后安镇', '110.457146', '18.862373', 3, 9, 1),
(469006104, 469006, '大茂镇', '大茂镇', '110.39649', '18.848959', 3, 2, 1),
(469006105, 469006, '东澳镇', '东澳镇', '110.40175', '18.714792', 3, 4, 1),
(469006106, 469006, '礼纪镇', '礼纪镇', '110.322685', '18.747631', 3, 10, 1),
(469006107, 469006, '长丰镇', '长丰镇', '110.32756', '18.800581', 3, 17, 1),
(469006108, 469006, '山根镇', '山根镇', '110.486595', '18.967335', 3, 14, 1),
(469006109, 469006, '北大镇', '北大镇', '110.37514', '18.955702', 3, 1, 1),
(469006110, 469006, '南桥镇', '南桥镇', '110.15255', '18.680067', 3, 12, 1),
(469006111, 469006, '三更罗镇', '三更罗镇', '110.19091', '18.859282', 3, 13, 1),
(469006400, 469006, '国营东兴农场', '国营东兴农场', '110.388794', '18.796215', 3, 6, 1),
(469006401, 469006, '国营东和农场', '国营东和农场', '110.388794', '18.796215', 3, 5, 1),
(469006404, 469006, '国营新中农场', '国营新中农场', '110.388794', '18.796215', 3, 7, 1),
(469006500, 469006, '兴隆华侨农场', '兴隆华侨农场', '110.202', '18.75622', 3, 16, 1),
(469006501, 469006, '地方国营六连林场', '地方国营六连林场', '110.388794', '18.796215', 3, 3, 1),
(469007100, 469007, '八所镇', '八所镇', '108.64629', '19.09816', 3, 2, 1),
(469007101, 469007, '东河镇', '东河镇', '108.94435', '19.045336', 3, 5, 1),
(469007102, 469007, '大田镇', '大田镇', '108.8749', '19.16498', 3, 3, 1),
(469007103, 469007, '感城镇', '感城镇', '108.64743', '18.847603', 3, 6, 1),
(469007104, 469007, '板桥镇', '板桥镇', '108.688614', '18.794859', 3, 1, 1),
(469007105, 469007, '三家镇', '三家镇', '108.761314', '19.244938', 3, 9, 1),
(469007106, 469007, '四更镇', '四更镇', '108.68211', '19.225616', 3, 10, 1),
(469007107, 469007, '新龙镇', '新龙镇', '108.68454', '18.952023', 3, 12, 1),
(469007200, 469007, '天安乡', '天安乡', '108.91625', '19.015745', 3, 11, 1),
(469007201, 469007, '江边乡', '江边乡', '108.97684', '18.894428', 3, 8, 1),
(469007400, 469007, '国营广坝农场', '国营广坝农场', '108.653786', '19.10198', 3, 7, 1),
(469007500, 469007, '东方华侨农场', '东方华侨农场', '108.941765', '19.04545', 3, 4, 1),
(469021100, 469025, '定城镇', '定城镇', '110.36809', '19.680178', 3, 1, 1),
(469021101, 469025, '新竹镇', '新竹镇', '110.20896', '19.617783', 3, 13, 1),
(469021102, 469025, '龙湖镇', '龙湖镇', '110.400826', '19.5737', 3, 11, 1),
(469021103, 469025, '黄竹镇', '黄竹镇', '110.44675', '19.472883', 3, 7, 1),
(469021104, 469025, '雷鸣镇', '雷鸣镇', '110.330315', '19.555216', 3, 8, 1),
(469021105, 469025, '龙门镇', '龙门镇', '110.32794', '19.439392', 3, 12, 1),
(469021106, 469025, '龙河镇', '龙河镇', '110.2191', '19.381926', 3, 10, 1),
(469021107, 469025, '岭口镇', '岭口镇', '110.308235', '19.34264', 3, 9, 1),
(469021108, 469025, '翰林镇', '翰林镇', '110.2647', '19.333858', 3, 6, 1),
(469021109, 469025, '富文镇', '富文镇', '110.24426', '19.550978', 3, 2, 1),
(469021400, 469025, '国营中瑞农场', '国营中瑞农场', '110.349236', '19.684965', 3, 5, 1),
(469021401, 469025, '国营南海农场', '国营南海农场', '110.349236', '19.684965', 3, 4, 1),
(469021402, 469025, '国营金鸡岭农场', '国营金鸡岭农场', '110.349236', '19.684965', 3, 3, 1),
(469022100, 469026, '屯城镇', '屯城镇', '110.10489', '19.371561', 3, 7, 1),
(469022101, 469026, '新兴镇', '新兴镇', '110.1828', '19.506744', 3, 10, 1),
(469022102, 469026, '枫木镇', '枫木镇', '110.019485', '19.214453', 3, 1, 1),
(469022103, 469026, '乌坡镇', '乌坡镇', '110.07781', '19.181501', 3, 8, 1),
(469022104, 469026, '南吕镇', '南吕镇', '110.08538', '19.247383', 3, 5, 1),
(469022105, 469026, '南坤镇', '南坤镇', '109.94827', '19.318367', 3, 4, 1),
(469022106, 469026, '坡心镇', '坡心镇', '110.096115', '19.303465', 3, 6, 1),
(469022107, 469026, '西昌镇', '西昌镇', '110.0455', '19.433662', 3, 9, 1),
(469022400, 469026, '国营中建农场', '国营中建农场', '110.102776', '19.362917', 3, 2, 1),
(469022401, 469026, '国营中坤农场', '国营中坤农场', '110.102776', '19.362917', 3, 3, 1),
(469023100, 469027, '金江镇', '金江镇', '110.0101', '19.73665', 3, 7, 1),
(469023101, 469027, '老城镇', '老城镇', '110.12589', '19.961864', 3, 8, 1),
(469023102, 469027, '瑞溪镇', '瑞溪镇', '110.13417', '19.731674', 3, 11, 1),
(469023103, 469027, '永发镇', '永发镇', '110.19736', '19.74392', 3, 13, 1),
(469023104, 469027, '加乐镇', '加乐镇', '110.00106', '19.585', 3, 6, 1),
(469023105, 469027, '文儒镇', '文儒镇', '110.05305', '19.537165', 3, 12, 1),
(469023106, 469027, '中兴镇', '中兴镇', '109.86128', '19.564772', 3, 14, 1),
(469023107, 469027, '仁兴镇', '仁兴镇', '109.88246', '19.49205', 3, 10, 1),
(469023108, 469027, '福山镇', '福山镇', '109.93339', '19.835', 3, 2, 1),
(469023109, 469027, '桥头镇', '桥头镇', '109.93353', '19.954138', 3, 9, 1),
(469023110, 469027, '大丰镇', '大丰镇', '110.03815', '19.855536', 3, 1, 1),
(469023400, 469027, '国营红光农场', '国营红光农场', '110.00715', '19.737095', 3, 3, 1),
(469023402, 469027, '国营西达农场', '国营西达农场', '110.00715', '19.737095', 3, 5, 1),
(469023405, 469027, '国营金安农场', '国营金安农场', '110.00715', '19.737095', 3, 4, 1),
(469024100, 469028, '临城镇', '临城镇', '109.69685', '19.896698', 3, 10, 1),
(469024101, 469028, '波莲镇', '波莲镇', '109.64849', '19.868223', 3, 2, 1),
(469024102, 469028, '东英镇', '东英镇', '109.653046', '19.956057', 3, 4, 1),
(469024103, 469028, '博厚镇', '博厚镇', '109.74996', '19.878716', 3, 1, 1),
(469024104, 469028, '皇桐镇', '皇桐镇', '109.84971', '19.832893', 3, 9, 1),
(469024105, 469028, '多文镇', '多文镇', '109.77106', '19.773836', 3, 5, 1),
(469024106, 469028, '和舍镇', '和舍镇', '109.727554', '19.596283', 3, 8, 1),
(469024107, 469028, '南宝镇', '南宝镇', '109.59954', '19.680483', 3, 11, 1),
(469024108, 469028, '新盈镇', '新盈镇', '109.53635', '19.89513', 3, 12, 1),
(469024109, 469028, '调楼镇', '调楼镇', '109.54441', '19.935062', 3, 3, 1),
(469024400, 469028, '国营红华农场', '国营红华农场', '109.6877', '19.908293', 3, 6, 1),
(469024401, 469028, '国营加来农场', '国营加来农场', '109.6877', '19.908293', 3, 7, 1),
(469025100, 469030, '牙叉镇', '牙叉镇', '109.44501', '19.212597', 3, 13, 1),
(469025101, 469030, '七坊镇', '七坊镇', '109.24449', '19.295347', 3, 9, 1),
(469025102, 469030, '邦溪镇', '邦溪镇', '109.10347', '19.37', 3, 1, 1),
(469025103, 469030, '打安镇', '打安镇', '109.37367', '19.283888', 3, 2, 1),
(469025200, 469030, '细水乡', '细水乡', '109.568504', '19.206415', 3, 12, 1),
(469025201, 469030, '元门乡', '元门乡', '109.48646', '19.158072', 3, 14, 1),
(469025202, 469030, '南开乡', '南开乡', '109.41838', '19.076944', 3, 8, 1),
(469025203, 469030, '阜龙乡', '阜龙乡', '109.460785', '19.32259', 3, 3, 1),
(469025204, 469030, '青松乡', '青松乡', '109.2772', '19.154446', 3, 10, 1),
(469025205, 469030, '金波乡', '金波乡', '109.17847', '19.23661', 3, 7, 1),
(469025206, 469030, '荣邦乡', '荣邦乡', '109.17073', '19.41395', 3, 11, 1),
(469025401, 469030, '国营白沙农场', '国营白沙农场', '109.45261', '19.224585', 3, 4, 1),
(469025404, 469030, '国营龙江农场', '国营龙江农场', '109.45261', '19.224585', 3, 6, 1),
(469025408, 469030, '国营邦溪农场', '国营邦溪农场', '109.45261', '19.224585', 3, 5, 1),
(469026100, 469031, '石碌镇', '石碌镇', '109.05581', '19.277552', 3, 8, 1),
(469026101, 469031, '叉河镇', '叉河镇', '108.955536', '19.234667', 3, 1, 1),
(469026102, 469031, '十月田镇', '十月田镇', '108.952225', '19.32811', 3, 9, 1),
(469026103, 469031, '乌烈镇', '乌烈镇', '108.79233', '19.288578', 3, 11, 1),
(469026104, 469031, '昌化镇', '昌化镇', '108.685074', '19.329235', 3, 2, 1),
(469026105, 469031, '海尾镇', '海尾镇', '108.8203', '19.42556', 3, 6, 1),
(469026106, 469031, '七叉镇', '七叉镇', '109.05552', '19.11238', 3, 7, 1),
(469026200, 469031, '王下乡', '王下乡', '109.150475', '19.003399', 3, 10, 1),
(469026401, 469031, '国营红林农场', '国营红林农场', '109.05335', '19.260967', 3, 4, 1),
(469026500, 469031, '国营霸王岭林场', '国营霸王岭林场', '109.05335', '19.260967', 3, 3, 1),
(469026501, 469031, '海南矿业联合有限公司', '海南矿业联合有限公司', '109.05335', '19.260967', 3, 5, 1),
(469027100, 469033, '抱由镇', '抱由镇', '109.179535', '18.74478', 3, 1, 1),
(469027101, 469033, '万冲镇', '万冲镇', '109.32286', '18.844719', 3, 14, 1),
(469027102, 469033, '大安镇', '大安镇', '109.21475', '18.69133', 3, 2, 1),
(469027103, 469033, '志仲镇', '志仲镇', '109.265114', '18.629242', 3, 16, 1),
(469027104, 469033, '千家镇', '千家镇', '109.11732', '18.51982', 3, 13, 1),
(469027105, 469033, '九所镇', '九所镇', '108.91811', '18.4386', 3, 11, 1),
(469027106, 469033, '利国镇', '利国镇', '108.882904', '18.468538', 3, 12, 1),
(469027107, 469033, '黄流镇', '黄流镇', '108.79313', '18.50459', 3, 9, 1),
(469027108, 469033, '佛罗镇', '佛罗镇', '108.73637', '18.578474', 3, 3, 1),
(469027109, 469033, '尖峰镇', '尖峰镇', '108.79249', '18.690414', 3, 10, 1),
(469027110, 469033, '莺歌海镇', '莺歌海镇', '108.69735', '18.510155', 3, 15, 1),
(469027401, 469033, '国营山荣农场', '国营山荣农场', '109.175446', '18.74758', 3, 7, 1),
(469027402, 469033, '国营乐光农场', '国营乐光农场', '109.175446', '18.74758', 3, 6, 1),
(469027405, 469033, '国营保国农场', '国营保国农场', '109.175446', '18.74758', 3, 4, 1),
(469027500, 469033, '国营尖峰岭林业公司', '国营尖峰岭林业公司', '109.175446', '18.74758', 3, 5, 1),
(469027501, 469033, '国营莺歌海盐场', '国营莺歌海盐场', '109.175446', '18.74758', 3, 8, 1),
(469028100, 469034, '椰林镇', '椰林镇', '110.03632', '18.506138', 3, 13, 1),
(469028101, 469034, '光坡镇', '光坡镇', '110.04878', '18.54339', 3, 2, 1),
(469028102, 469034, '三才镇', '三才镇', '110.003296', '18.474579', 3, 9, 1),
(469028103, 469034, '英州镇', '英州镇', '109.863235', '18.416092', 3, 14, 1),
(469028104, 469034, '隆广镇', '隆广镇', '109.90715', '18.501219', 3, 7, 1),
(469028105, 469034, '文罗镇', '文罗镇', '109.96226', '18.514065', 3, 11, 1),
(469028106, 469034, '本号镇', '本号镇', '109.966774', '18.608374', 3, 1, 1),
(469028107, 469034, '新村镇', '新村镇', '109.97133', '18.412445', 3, 12, 1),
(469028108, 469034, '黎安镇', '黎安镇', '110.07401', '18.430515', 3, 6, 1),
(469028200, 469034, '提蒙乡', '提蒙乡', '110.013016', '18.5648', 3, 10, 1),
(469028201, 469034, '群英乡', '群英乡', '109.88007', '18.581532', 3, 8, 1),
(469028400, 469034, '国营岭门农场', '国营岭门农场', '110.03722', '18.505007', 3, 4, 1),
(469028401, 469034, '国营南平农场', '国营南平农场', '110.03722', '18.505007', 3, 5, 1),
(469028500, 469034, '国营吊罗山林业公司', '国营吊罗山林业公司', '110.03722', '18.505007', 3, 3, 1),
(469029100, 469035, '保城镇', '保城镇', '109.70354', '18.641565', 3, 1, 1),
(469029101, 469035, '什玲镇', '什玲镇', '109.78778', '18.661955', 3, 11, 1),
(469029102, 469035, '加茂镇', '加茂镇', '109.70734', '18.552235', 3, 6, 1),
(469029103, 469035, '响水镇', '响水镇', '109.61628', '18.592228', 3, 12, 1),
(469029104, 469035, '新政镇', '新政镇', '109.62892', '18.541697', 3, 13, 1),
(469029105, 469035, '三道镇', '三道镇', '109.673355', '18.462975', 3, 10, 1),
(469029200, 469035, '六弓乡', '六弓乡', '109.790855', '18.539494', 3, 7, 1),
(469029201, 469035, '南林乡', '南林乡', '109.621475', '18.40351', 3, 9, 1),
(469029202, 469035, '毛感乡', '毛感乡', '109.51241', '18.611052', 3, 8, 1),
(469029401, 469035, '国营新星农场', '国营新星农场', '109.70245', '18.636372', 3, 4, 1),
(469029402, 469035, '海南保亭热带作物研究所', '海南保亭热带作物研究所', '109.70245', '18.636372', 3, 5, 1),
(469029403, 469035, '国营金江农场', '国营金江农场', '109.70245', '18.636372', 3, 2, 1),
(469029405, 469035, '国营三道农场', '国营三道农场', '109.70245', '18.636372', 3, 3, 1),
(469030100, 469036, '营根镇', '营根镇', '109.83431', '19.032547', 3, 13, 1),
(469030101, 469036, '湾岭镇', '湾岭镇', '109.94503', '19.169888', 3, 12, 1),
(469030102, 469036, '黎母山镇', '黎母山镇', '109.79276', '19.266226', 3, 9, 1),
(469030103, 469036, '和平镇', '和平镇', '110.02921', '18.897423', 3, 7, 1),
(469030104, 469036, '长征镇', '长征镇', '109.88254', '18.957058', 3, 14, 1),
(469030105, 469036, '红毛镇', '红毛镇', '109.67457', '19.021948', 3, 8, 1),
(469030106, 469036, '中平镇', '中平镇', '110.06206', '19.058533', 3, 15, 1),
(469030200, 469036, '吊罗山乡', '吊罗山乡', '109.88283', '18.790903', 3, 1, 1),
(469030201, 469036, '上安乡', '上安乡', '109.83728', '18.87683', 3, 10, 1),
(469030202, 469036, '什运乡', '什运乡', '109.60797', '18.992018', 3, 11, 1),
(469030402, 469036, '国营阳江农场', '国营阳江农场', '109.84', '19.03557', 3, 5, 1),
(469030403, 469036, '国营乌石农场', '国营乌石农场', '109.84', '19.03557', 3, 4, 1),
(469030406, 469036, '国营加钗农场', '国营加钗农场', '109.84', '19.03557', 3, 2, 1),
(469030407, 469036, '国营长征农场', '国营长征农场', '109.84', '19.03557', 3, 6, 1),
(469030500, 469036, '国营黎母山林业公司', '国营黎母山林业公司', '109.84', '19.03557', 3, 3, 1),
(620201100, 620200, '新城镇', '新城镇', '98.277306', '39.78653', 3, 3, 1),
(620201101, 620200, '峪泉镇', '峪泉镇', '98.225876', '39.8066', 3, 5, 1),
(620201102, 620200, '文殊镇', '文殊镇', '98.37836', '39.69396', 3, 2, 1),
(620201401, 620200, '雄关区', '雄关区', '98.277306', '39.78653', 3, 4, 1),
(620201402, 620200, '镜铁区', '镜铁区', '98.277306', '39.78653', 3, 1, 1),
(620201403, 620200, '长城区', '长城区', '98.277306', '39.78653', 3, 6, 1),
(659001001, 659001, '新城街道', '新城街道', '86.04108', '44.305885', 3, 8, 1),
(659001002, 659001, '向阳街道', '向阳街道', '85.3936', '44.429943', 3, 7, 1),
(659001003, 659001, '红山街道', '红山街道', '86.04108', '44.305885', 3, 4, 1),
(659001004, 659001, '老街街道', '老街街道', '86.04108', '44.305885', 3, 5, 1),
(659001005, 659001, '东城街道', '东城街道', '86.04108', '44.305885', 3, 3, 1),
(659001100, 659001, '北泉镇', '北泉镇', '86.01673', '44.33384', 3, 1, 1),
(659001200, 659001, '石河子乡', '石河子乡', '86.03577', '44.28742', 3, 6, 1),
(659001500, 659001, '兵团一五二团', '兵团一五二团', '86.04108', '44.305885', 3, 2, 1),
(659002001, 659002, '金银川路街道', '金银川路街道', '81.28588', '40.541916', 3, 14, 1),
(659002002, 659002, '幸福路街道', '幸福路街道', '81.28588', '40.541916', 3, 18, 1),
(659002003, 659002, '青松路街道', '青松路街道', '81.28588', '40.541916', 3, 16, 1),
(659002004, 659002, '南口街道', '南口街道', '81.28588', '40.541916', 3, 15, 1),
(659002200, 659002, '托喀依乡', '托喀依乡', '81.120056', '40.538677', 3, 17, 1),
(659002402, 659002, '工业园区', '工业园区', '81.28588', '40.541916', 3, 13, 1),
(659002500, 659002, '兵团七团', '兵团七团', '81.28588', '40.541916', 3, 6, 1),
(659002501, 659002, '兵团八团', '兵团八团', '81.28588', '40.541916', 3, 2, 1),
(659002503, 659002, '兵团十团', '兵团十团', '81.28588', '40.541916', 3, 11, 1),
(659002504, 659002, '兵团十一团', '兵团十一团', '81.28588', '40.541916', 3, 12, 1),
(659002505, 659002, '兵团十二团', '兵团十二团', '81.28588', '40.541916', 3, 7, 1),
(659002506, 659002, '兵团十三团', '兵团十三团', '81.28588', '40.541916', 3, 9, 1),
(659002507, 659002, '兵团十四团', '兵团十四团', '81.28588', '40.541916', 3, 10, 1),
(659002509, 659002, '兵团十六团', '兵团十六团', '81.28588', '40.541916', 3, 8, 1),
(659002511, 659002, '兵团第一师水利水电工程处', '兵团第一师水利水电工程处', '81.28588', '40.541916', 3, 3, 1),
(659002512, 659002, '兵团第一师塔里木灌区水利管理处', '兵团第一师塔里木灌区水利管理处', '81.28588', '40.541916', 3, 4, 1),
(659002513, 659002, '阿拉尔农场', '阿拉尔农场', '81.266075', '40.54336', 3, 1, 1),
(659002514, 659002, '兵团第一师幸福农场', '兵团第一师幸福农场', '81.28588', '40.541916', 3, 5, 1),
(659002515, 659002, '中心监狱', '中心监狱', '81.28588', '40.541916', 3, 19, 1),
(659003001, 659003, '齐干却勒街道', '齐干却勒街道', '79.07798', '39.867317', 3, 9, 1),
(659003002, 659003, '前海街道', '前海街道', '79.07798', '39.867317', 3, 8, 1),
(659003003, 659003, '永安坝街道', '永安坝街道', '79.07798', '39.867317', 3, 10, 1),
(659003504, 659003, '兵团四十四团', '兵团四十四团', '79.07798', '39.867317', 3, 2, 1),
(659003509, 659003, '兵团四十九团', '兵团四十九团', '79.07798', '39.867317', 3, 1, 1),
(659003510, 659003, '兵团五十团', '兵团五十团', '79.07798', '39.867317', 3, 6, 1),
(659003511, 659003, '兵团五十一团', '兵团五十一团', '79.07798', '39.867317', 3, 7, 1),
(659003513, 659003, '兵团五十三团', '兵团五十三团', '79.07798', '39.867317', 3, 5, 1),
(659003514, 659003, '兵团图木舒克市喀拉拜勒镇', '兵团图木舒克市喀拉拜勒镇', '79.07798', '39.867317', 3, 3, 1),
(659003515, 659003, '兵团图木舒克市永安坝', '兵团图木舒克市永安坝', '79.01864', '39.848866', 3, 4, 1),
(659004001, 659004, '军垦路街道', '军垦路街道', '87.526886', '44.1674', 3, 4, 1),
(659004002, 659004, '青湖路街道', '青湖路街道', '87.526886', '44.1674', 3, 5, 1),
(659004003, 659004, '人民路街道', '人民路街道', '87.526886', '44.1674', 3, 6, 1),
(659004500, 659004, '兵团一零一团', '兵团一零一团', '87.526886', '44.1674', 3, 3, 1),
(659004501, 659004, '兵团一零二团', '兵团一零二团', '87.526886', '44.1674', 3, 1, 1),
(659004502, 659004, '兵团一零三团', '兵团一零三团', '87.526886', '44.1674', 3, 2, 1);
