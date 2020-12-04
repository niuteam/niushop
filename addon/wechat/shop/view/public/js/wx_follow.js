WxReplay = function (limit = 0, limits = []) {
	var _this = this;
	_this._dom = null;
	_this.eventFlg = true;
	
	_this.listCount = 0;
	_this.limit = limit == false ? 15 : limit;
	_this.limits = limit == false ? [15, 20, 50] : limits;
	_this.page = 1;
};

/**
 * 获取关注后回复列表
 */
WxReplay.prototype.getData = function (d) {
	var _this = d._this;
	var page = _this.page;
	var limit = _this.limit;
	var rule_type = d.rule_type;
	_this.sendAjax({
		url: ns.url('wechat://shop/replay/follow'),
		async: false,
		data: {"page": page, "limit": limit, "rule_type": rule_type},
		success: function (data) {
			_this.listCount = data.data.count;
			_this.aD.addReolayList(data.data);
		}
	});
};

/**
 * layui分页
 */
WxReplay.prototype.pageInit = function (d) {
	var _this = d._this;
	layui.use('laypage', function () {
		var laypage = layui.laypage;
		laypage.render({
			elem: 'list_page',
			count: _this.listCount,
			limit: _this.limit,
			limits: _this.limits,
			layout: ns.get_page_param(),
			curr: location.hash.replace('page=', ''), //获取起始页
			hash: 'page',
			jump: function (obj, first) {
				_this.limit = obj.limit;
				if (!first) {
					_this.page = obj.curr;
					_this.getData({_this: _this, "rule_type": 'KEYWORDS'});
				}
			}
		});
	});
};

/**
 * 事件操作
 * @param eName 事件对象
 */
WxReplay.prototype.e = function (e) {
	try {
		//_this为replay对象  //_dom 为元素dom
		var _this = e.data._this;
		_this._dom = e.target;
		var eventFlg = _this.eventFlg;
		if (!eventFlg) return;
		_this.eventFlg = false;
		var _dom = e.target;
		var dataEvent = $(_dom).attr("nc-event");
		var dataAction = $(_dom).attr("nc-action");
		var type = e.type;
		if (dataEvent != type) {
			if ($(_dom).attr("nc-event2") != type) {
				_this.eventFlg = true;
				return;
			} else {
				dataEvent = $(_dom).attr("nc-event2");
				dataAction = $(_dom).attr("nc-action2");
			}
		}
		
		var eventObj = null;
		switch (dataEvent) {
			case "click":
				eventObj = _this.clickEvent;
				break;
			case "mouseenter" :
				eventObj = _this.mouseenterEvent;
				break;
			case "mouseleave" :
				eventObj = _this.mouseleaveEvent;
				break;
		}
		if (eventObj) {
			
			_this.evalFun(eventObj, dataAction, {"_this": _this});
			
			_this.eventFlg = true;
		}
		
	} catch (e) {
		_this.eventFlg = true;
		console.log(e);
	}
};
/**
 *  点击事件
 */
WxReplay.prototype.clickEvent = {
	click: function () {
	
	},
	
	//添加回复
	addRule: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		$("#add_auto_replay").css({"padding": "5px"});
		var index = layer.open({
			type: 1,
			title: "添加规格组",
			area: ['400px', "160px"],
			offset: "auto",
			content: $("#add_auto_replay"),
			success: function(layero) {
				var mask = $(".layui-layer-shade");
				mask.appendTo(layero.parent());
			}
		});
		$("#add_auto_replay").find("button[type='reset']").show();
		$("#add_auto_replay").find("button[type='reset']").click();
		$("#add_auto_replay").find("input[name='rule_id']").val(0);
		
		$("#add_auto_replay").children("input[name='layer_index']").val(index);
		
	},
	
	editRule: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		var ruke_name = $(_dom).attr('data-ruke_name');
		$("#add_auto_replay").css({"padding": "9px 5px"});
		var index = layer.open({
			type: 1,
			title: "修改规格组",
			area: ['400px', "160px"],
			offset: "auto",
			content: $("#add_auto_replay"),
			success: function(layero) {
				var mask = $(".layui-layer-shade");
				mask.appendTo(layero.parent());
			}
		});
		
		$("#add_auto_replay").find("button[type='reset']").hide();
		$("#add_auto_replay").find("input[name='layer_index']").val(index);
		$("#add_auto_replay").find("input[name='rule_id']").val(rule_id);
		$("#add_auto_replay").find("input[name='key_rule_name']").val(ruke_name);
		
	},
	
	delRule: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		var flag = true;
		var index = layer.open({
			type: 1,
			title: "是否删除关键词规则组",
			offset: "auto",
			content: ''
			, btn: ['确定', '取消']
			, yes: function (index, layero) {
				if (!flag) return;
				flag = false;
				_this.sendAjax({
					url: ns.url('wechat://shop/replay/deleterule'),
					data: {"rule_id": rule_id},
					success: function (res) {
						layer.msg(res.message);
						if (res.code < 0) {
							//关闭弹出层
							layer.close(index);
							$(".layui-laypage-btn").click();
						}
					}
				});
				flag = true;
			}
			, btn2: function (index, layero) {
			}
		});
	},
	
	//添加关键词
	addKeywords: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		
		$("#add_keywords").css({"padding": "9px 5px"});
		var index = layer.open({
			type: 1,
			title: "添加关键词",
			area: ['400px', "220px"],
			offset: "auto",
			content: $("#add_keywords"),
			success: function(layero) {
				var mask = $(".layui-layer-shade");
				mask.appendTo(layero.parent());
			}
		});
		$("#add_keywords").find("button[type='reset']").click();
		$("#add_keywords").children("input[name='layer_index']").val(index);
		$("#add_keywords").children("input[name='rule_id']").val(rule_id);
	},
	
	//编辑关键词
	editKeywords: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		var key_id = $(_dom).attr('data-key_id');
		var keyword_name = $(_dom).attr('keyword_name');
		var keywords_type = $(_dom).parent().find('.add-on').attr("keyword_type");
		$("#add_keywords").css({"padding": "9px 5px"});
		var index = layer.open({
			type: 1,
			title: "添加关键词",
			area: ['400px', "220px"],
			offset: "auto",
			content: $("#add_keywords"),
			success: function(layero) {
				var mask = $(".layui-layer-shade");
				mask.appendTo(layero.parent());
			}
		});
		$("#add_keywords").find("button[type='reset']").hide();
		$("#add_keywords").find("input[name='layer_index']").val(index);
		$("#add_keywords").find("input[name='rule_id']").val(rule_id);
		$("#add_keywords").find("input[name='key_id']").val(key_id);
		$("#add_keywords").find("input[name='keywords_name']").val(keyword_name);
		$("#add_keywords").find("input[name='keywords_type']").each(function (i, item) {
			if ($(item).val() == keywords_type) {
				$(item).prop('checked', true);
				var form = layui.form;
				form.render();
			}
		});
	},
	
	//删除关键词
	delKeywords: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		var key_id = $(_dom).attr("data-key_id");
		var flag = true;
		var index = layer.open({
			type: 1,
			title: "是否删除关键词",
			offset: "auto",
			content: ''
			, btn: ['确定', '取消']
			, yes: function (index, layero) {
				if (!flag) return;
				flag = false;
				_this.sendAjax({
					url: ns.url('wechat://shop/replay/deletekeywords'),
					data: {"rule_id": rule_id, "key_id": key_id},
					success: function (res) {
						layer.msg(res.message);
						if (res.code >= 0) {
							//关闭弹出层
							layer.close(index);
							$(".layui-laypage-btn").click();
						}
					}
				});
				flag = true;
			}
			, btn2: function (index, layero) {
			
			}
		});
	},
	
	//添加一条回复
	addReply: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		var key_id = $(_dom).attr('data-key_id');
		var reply_content = $(_dom).attr('reply_content');
		$("#add_reply").css("display", "block");
		
		$("#add_reply").children("input[name='rule_id']").val(rule_id);
		
		$(".complex-backdrop").css("display", "none");  //清空文本框
		$("#add_reply").find("textarea[name='reply_content']").val("");
	},
	
	//编辑回复
	editReply: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		var key_id = $(_dom).attr('data-key_id');
		var reply_content = $(_dom).attr('reply_content');
		var request_type = $(_dom).attr('type');
		$("#hidden_reply_type").val(request_type);
		$("#add_reply").css({"padding": "5px 10px"});
		
		$("#add_reply").css("display", "block");
		
		$("#add_reply").find("input[name='rule_id']").val(rule_id);
		$("#add_reply").find("input[name='key_id']").val(key_id);
		$("#add_reply").find("textarea[name='reply_content']").val(reply_content);
		
		$(".image,.voice").css("display", "none");
		$(".image,.voice").next("span").css("display", "none");
		
		if (request_type == 'music') {
			var active_pic = '';
			active_pic += '<div class="voice-wrapper" data-voice-src="' + reply_content + '">';
			active_pic += '<span class="voice-player">';
			active_pic += '<a href="javascript:;" class="close--circle js-delete-complex">×</a>';
			active_pic += '<span class="stop">点击播放</span>';
			active_pic += '<span class="second"></span>';
			active_pic += '<i class="play" style="display:none;"></i>';
			active_pic += '</span>';
			active_pic += '</div>';
			$("#add_reply").find(".complex-content").html(active_pic);
			$('.complex-backdrop').css("display", "block");
			
		} else if (request_type == 'other') {
			var active_pic = '';
			active_pic += '<div class="ng ng-single">';
			active_pic += '<a href="javascript:;" class="close--circle js-delete-complex">×</a>';
			active_pic += '<div class="ng-item">';
			active_pic += '<a href="h" target="_blank" class="new-window" title="' + reply_content + '"><span class="label label-success">' + reply_content + '</span></a>';
			active_pic += '</div>';
			active_pic += '<div class="ng-item view-more">';
			active_pic += '<a href="" target="_blank" class="clearfix new-window">';
			active_pic += '<span class="pull-left">阅读全文</span>';
			active_pic += '<span class="pull-right">&gt;</span>';
			active_pic += '</a>';
			active_pic += '</div>';
			active_pic += '</div>';
			
			$("#add_reply").find(".complex-content").html(active_pic);
			$('.complex-backdrop').css("display", "block");
		} else if (request_type == 'articles') {
			var active_pic = '';
			active_pic += '<div class="ng ng-single">';
			active_pic += '<a href="javascript:;" class="close--circle js-delete-complex">×</a>';
			active_pic += '<div class="ng-item">';
			active_pic += '<span class="label label-success">图 文</span>';
			active_pic += '<div class="ng-title">';
			active_pic += '<a href="" target="_blank" class="new-window" title="rgrg">' + reply_content + '</a>';
			active_pic += '</div>';
			active_pic += '</div>';
			active_pic += '<div class="ng-item view-more">';
			active_pic += '<a href="" target="_blank" class="clearfix new-window">';
			active_pic += '<span class="pull-left">阅读全文</span>';
			active_pic += '<span class="pull-right">&gt;</span>';
			active_pic += '</a>';
			active_pic += '</div>';
			active_pic += '</div>';
			
			$("#add_reply").find(".complex-content").html(active_pic);
			$('.complex-backdrop').css("display", "block");
		} else {
			$('.complex-backdrop').css("display", "none");
		}
	},
	
	//删除回复
	delReply: function (d) {
		var _this = d._this;
		var _dom = _this._dom;
		var rule_id = $(_dom).parents(".rule-group").attr("data-rule_id");
		var key_id = $(_dom).attr("data-key_id");
		var flag = true;
		var index = layer.open({
			type: 1,
			title: "是否删除该条回复",
			offset: "auto",
			content: ''
			, btn: ['确定', '取消']
			, yes: function (index, layero) {
				if (!flag) return;
				flag = false;
				_this.sendAjax({
					url: ns.url('wechat://shop/replay/deleteReply'),
					data: {"rule_id": rule_id, "key_id": key_id},
					success: function (res) {
						layer.msg(res.message);
						if (res.code >= 0) {
							//关闭弹出层
							$(".layui-laypage-btn").click();
							location.reload();
						}
					}
				});
				flag = true;
			}
			, btn2: function (index, layero) {
			
			}
		});
	},
	
	//插入链接
	hyperlink: function (d) {
		$("#hyperlink").css({"padding": "7px"});
		$("#hidden_reply_type").val('text');
		$(".complex-backdrop").css("display", "none");  //清空文本框
		$("#add_reply").find("textarea[name='reply_content']").val("");
		layer.open({
			type: 1,
			title: false,
			area: ['306px', "auto"],
			offset: "auto",
			content: $("#hyperlink"),
			success: function(layero) {
				var mask = $(".layui-layer-shade");
				mask.appendTo(layero.parent());
			}
		});
		
	},
	
	//音乐
	music: function (d) {
		$("#music").css({"padding": "7px"});
		$("#hidden_reply_type").val('music');
		$(".complex-backdrop").css("display", "none");  //清空文本框
		$("#add_reply").find("textarea[name='reply_content']").val("");
		layer.open({
			type: 1,
			title: '音乐素材',
			area: ['652px', "380px"],
			offset: "auto",
			content: $("#music"),
			success: function(layero) {
				var mask = $(".layui-layer-shade");
				mask.appendTo(layero.parent());
			}
		});
		
	},
	
};

/**
 *  移入事件
 */

WxReplay.prototype.mouseenterEvent = {};

/**
 *  移出事件
 */
WxReplay.prototype.mouseleaveEvent = {};

/**
 * 执行传过来的方法
 * @param eventObj
 * @param funcName
 * @param d
 */
WxReplay.prototype.evalFun = function (eventObj, funcName, d = {}) {
	for (i in eventObj) {
		if (i == funcName) {
			eval(eventObj[i](d));
		}
	}
};

/**
 * 元素操作 da(documeentAction)
 */

WxReplay.prototype.aD = {
	
	addReolayList: function (d) {
		var data = d.list;
		var html = '';
		if (data.length) {
			$.each(data, function (i) {
				var d = data[i];
				html += '<div class="rule-group layui-row" data-rule_id="' + d.rule_id + '">';
				html += '<div class="rule-meta">';
				html += '<h3><span class="rule-name">规则： 关注后自动回复</span></h3>';//title
				html += '</div>';
				html += '<div class="rule-body">';
				html += '</div>';
				html += '<div class="rule-replies layui-col-md12">';
				html += '<div class="rule-inner">';
				// html += '<h4>自动回复： <span class="send-method"> </span></h4>';
				html += '<div class="reply-container">';
				
				if (d.replay_list.length <= 0) {
					html += '<div class="info">还没有任何回复！</div>';
				} else {
					html += '<div class="info"></div>';
				}
				html += '<ol class="reply-list">';
				
				if (d.replay_list.length > 0) {
					for (j in d.replay_list) {
						
						html += '<li>';//回复列表
						html += '<div class="reply-cont">';
						html += '<div class="reply-summary">';
						if (d.replay_list[j].type == 'text') {
							html += '<span class="label label-success">文本</span>&nbsp;';
							html += '<span class="label">' + d.replay_list[j].reply_content + '</span>';
						} else if (d.replay_list[j].type == 'music') {
							html += '<div class="voice-wrapper" data-voice-src="' + d.replay_list[j].reply_content + '">';
							html += '<span class="voice-player">';
							html += '<span class="stop">点击播放</span>';
							html += '<span class="second" style="display: block;"></span>';
							html += '<i class="play" style="display:none;"></i>';
							html += '</span>';
							html += '</div>';
						} else if (d.replay_list[j].type == 'other') {
							html += '<span class="label label-success">' + d.replay_list[j].reply_content + '</span>&nbsp;';
							html += '<span class="label">' + d.replay_list[j].reply_content + '</span>';
						} else if (d.replay_list[j].type == 'articles') {
							html += '<span class="label label-success">图文</span>&nbsp;';
							html += '<span class="label">' + d.replay_list[j].reply_content + '</span>';
						}
						
						html += '</div>';
						html += '</div>';
						html += '<div class="reply-opts">';
						html += '<a class="js-edit-it js-replay" href="javascript:;" reply_content="' + d.replay_list[j].reply_content + '" data-key_id="' + j + '" type="' + d.replay_list[j].type + '" nc-event="click" nc-action="editReply">编辑</a>&nbsp;-&nbsp;';
						html += '<a class="js-delete-it js-replay" href="javascript:;" data-key_id="' + j + '" nc-event="click" nc-action="delReply">删除</a>';
						html += '</div>';
						html += '</li>';
						
					}
				}
				html += '</ol>';
				html += '</div>';
				html += '<hr class="dashed">';
				html += '<div class="opt">';
				if (d.replay_list.length < 1) {
					html += '<a class="js-add-reply add-reply-menu js-replay" href="javascript:;" nc-event="click" nc-action="addReply">设置回复</a>';
				} else {
					html += '<span class="disable-opt hide">最多一条回复</span>';
				}
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
			});
		} else {
			html += '<div class="rule-group layui-row" data-rule_id="">';
			html += '<div class="rule-meta">';
			html += '<h3><span class="rule-name">规则： 关注后自动回复</span></h3>';//title
			html += '</div>';
			html += '<div class="rule-body">';
			html += '</div>';
			html += '<div class="rule-replies layui-col-md12">';
			html += '<div class="rule-inner">';
			// html += '<h4>自动回复： <span class="send-method"> </span></h4>';
			html += '<div class="reply-container">';
			html += '<div class="info">还没有任何回复！</div>';
			html += '</div>';
			html += '<hr class="dashed">';
			html += '<div class="opt">';
			html += '<a class="js-add-reply add-reply-menu js-replay" href="javascript:;" nc-event="click" nc-action="addReply">设置回复</a>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
		}
		
		$("#load_rule_list").html(html);
	}
};

WxReplay.prototype.sendAjax = function (param = {}) {
	var d = $.extend({
		"url": '',
		"type": "post",
		"data": {},
		"async": true,
		"success": ''
	}, param);
	try {
		$.ajax({
			url: d.url,
			type: d.type,
			data: d.data,
			async: d.async,
			dataType: "JSON",
			success: function (res) {
				if (typeof (d.success) == "function") {
					d.success(res);
				}
			}
		})
	} catch (e) {
		console.log(e);
	}
};

/**
 * 页面跳转
 * @param e
 */
function skipPage(e) {
	var url = $(e).attr('data-url');
	location.href = url;
}

//其他
$(".dropdown-menu li").click(function () {
	$("#hidden_reply_type").val('other');
	var title = $(this).text();
	
	var active_pic = '';
	active_pic += '<div class="ng ng-single">';
	active_pic += '<a href="javascript:;" class="close--circle js-delete-complex">×</a>';
	active_pic += '<div class="ng-item">';
	active_pic += '<a href="h" target="_blank" class="new-window" title="' + title + '"><span class="label label-success">' + title + '</span></a>';
	active_pic += '</div>';
	active_pic += '<div class="ng-item view-more">';
	active_pic += '<a href="" target="_blank" class="clearfix new-window">';
	active_pic += '<span class="pull-left">阅读全文</span>';
	active_pic += '<span class="pull-right">&gt;</span>';
	active_pic += '</a>';
	active_pic += '</div>';
	active_pic += '</div>';
	
	$("#add_reply").find(".complex-content").html(active_pic);
	$('.complex-backdrop').css("display", "block");
	$("#add_reply").find("textarea[name='reply_content']").val(title);
	
});