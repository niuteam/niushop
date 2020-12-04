var vue_obj;
var repeat_flag = false;//防重复标识
$(function () {
	
	initVue();
	if ($('#edit_flag').val()) {
		setTimeout(function () {
			vue_obj.loadGraphicMessageInfo();
		}, 20);
	}
});

// 初始化Vue
function initVue() {
	// 挂载父组件
	vue_obj = new Vue({
		el: '#graphic_message',						// 挂载点标识
		data: {								// 数据
			article_item_list: [
				{
					msg_type: 1, 			// 消息类型
					title: '', 				// 标题
					autor: '', 				// 作者
					content: '', 			// 内容
					url: '', 				// 原文链接
					show_cover_pic: 0,		// 正文是否显示封面图
					cover: {
						path: '', 			// 封面路径
						media_id: ''		// 封面media_id
					},
					digest: '', 			// 摘要
				},
			],
			edit_mask_list: [
				{
					is_show: false,			// 是否显示列表修改菜单 ---对应图文消息列表
				}
			],
			max_item_list: 8,
			current_msg_index: 0, 			// 当前选中消息下标
			material_id: 0,						// 当前图文消息ID
			inputTitle: '',
			inputAutor: '',
			inputOriginalUrl: '',
			checkShowCoverPic: 0,
			coverImg: '',
			editBoxTopPosition: 80,
			move_index: -1,
			loading: false,
			editor: null
		},
		watch: {
			//输入标题
			inputTitle: function (val) {
				this.article_item_list[this.current_msg_index].title = val;
			},
			//输入作者
			inputAutor: function (val) {
				this.article_item_list[this.current_msg_index].autor = val;
			},
			// 输入原文链接
			inputOriginalUrl: function (val) {
				this.article_item_list[this.current_msg_index].url = val;
			},
			// 正文是否显示封面图
			checkShowCoverPic: function (val) {
				this.article_item_list[this.current_msg_index].show_cover_pic = val;
			}
		},
		mounted: function () {
			var _self = this;
			_self.material_id = $('#material_id').val();
			_self.editor = UE.getEditor('editor');
			_self.reloadUpload();
		},
		methods: {
			// 添加图文消息
			addGraphicMessage: function (e) {
				getContent();
				var article_item_list = this.article_item_list;
				if (article_item_list.length > 7) {
					layer.msg('多图文消息内容不可超过8个');
					return false;
				}
				
				var new_item_msg = {
					msg_type: 1, 		// 消息类型
					title: '', 			// 标题
					autor: '', 			// 作者
					content: '', 		// 内容
					url: '', 			// 原文链接
					show_cover_pic: 0,  // 正文是否显示封面
					cover: {
						path: '', 		// 封面路径
						media_id: ''	// 封面media_id
					},
					digest: '', 		// 摘要
				};
				var new_edit_mask = {
					is_show: false
				};
				// 添加新图文消息
				this.article_item_list.push(new_item_msg);
				this.edit_mask_list.push(new_edit_mask);
				// 初始化新图文消息
				this.editor.setContent('');
				this.current_msg_index = article_item_list.length - 1;// 更新当前选中消息
				this.inputTitle = '';// 初始化输入标题
				this.inputAutor = '';// 初始化输入作者
				this.checkShowCoverPic = '';
				this.inputOriginalUrl = '';
				this.coverImg = '';
				var _num = article_item_list.length - 1;
				var _top = 250;
				_top = _num == 0 ? 80 : _top;
				_num = _num > 0 ? _num - 1 : _num;
				this.editBoxTopPosition = 72 * _num + _top;
				
			},
			// 选择编辑中图文消息
			chooseGraphicMessage: function (index) {
				getContent();
				var article = this.article_item_list[index];
				this.current_msg_index = index;
				this.inputTitle = article.title;  	// 初始化输入标题
				this.inputAutor = article.autor; 	// 初始化输入作者
				this.editor.setContent(article.content);  // 初始化ueditor输入
				this.checkShowCoverPic = article.show_cover_pic;
				this.inputOriginalUrl = article.url;
				this.coverImg = article.cover.path;
				var _num = index;
				var _top = 250;
				_top = _num == 0 ? 80 : _top;
				_num = _num > 0 ? _num - 1 : _num;
				this.editBoxTopPosition = 72 * _num + _top;
			},
			//鼠标经过
			moveThis: function (index) {
				this.move_index = index;
			},
			leaveThis: function (index) {
				this.move_index = -1;
			},
			// 加载当前图文消息
			loadGraphicMessageInfo: function () {
				var _self = this;
				var id = _self.material_id;
				_self.loading = true;
				$.ajax({
					type: 'post',
					url: ns.url("wechat://shop/material/getMaterialInfo"),
					data: {id},
					dataType: "JSON",
					success: function (data) {
						data = data.data;
						if (data.value != null && data.id > 0) {
							//延时渲染
							var count_timer = 0;
							var timer = setInterval(function () {
								try {
									// 初始化
									_self.article_item_list = new Array();
									_self.edit_mask_list = new Array();
									// 循环赋值
									count_timer++;
									if (count_timer > 5) {
										clearInterval(timer);
										layer.msg('加载失败');
										return false;
									}
									
									for (var index in data.value) {
										var msg = data.value[index];
										
										var new_item_msg = {
											msg_type: 1, 						// 消息类型
											title: msg.title, 					// 标题
											autor: msg.autor, 					// 作者
											content: msg.content, 				// 内容
											url: msg.url,
											cover: msg.cover, 					// 封面
											show_cover_pic: msg.show_cover_pic,	// 正文是否显示封面
											digest: msg.digest, 				// 摘要
										};
										var new_edit_mask = {
											is_show: false
										};
										// 添加新图文消息
										_self.article_item_list.push(new_item_msg);
										_self.edit_mask_list.push(new_edit_mask);
										// 初始化新图文消息
										_self.current_msg_index = 0; 	// 更新当前选中消息
										
										if (index == 0) {
											_self.inputTitle = msg.title;  	// 初始化输入标题
											_self.inputAutor = msg.autor; 	// 初始化输入作者
											_self.editor.setContent(msg.content);  // 初始化ueditor输入
											_self.checkShowCoverPic = msg.show_cover_pic;
											_self.inputOriginalUrl = msg.url;
											_self.inputDigest = msg.digest;
											_self.coverImg = msg.cover.path;
											_self.loading = false;
										}
									}
									clearInterval(timer);
								} catch (e) {
									
								}
							}, 500)
						}
					},
					error: function () {
						layer.msg('加载失败');
					}
				})
			},
			
			// 修改当前图文消息
			editGraphicMessage: function () {
				getContent();
				
				var _self = this;
				if (!_self.verification(_self)) return;
				
				var id = _self.material_id;
				var article_item_list = JSON.parse(JSON.stringify(_self.article_item_list));
				var value = JSON.stringify(article_item_list);
				
				if (repeat_flag) return;
				repeat_flag = true;
				$.ajax({
					type: 'post',
					url: ns.url('wechat://shop/material/edit'),
					data: {id, value},
					dataType: "JSON",
					success: function (res) {
						layer.msg(res.message);
						if (res.code == 0) {
							location.href = ns.url('wechat://shop/material/lists');
						} else {
							repeat_flag = false;
						}
					}
				})
			},
			// 保存图文消息
			saveGraphicMessage: function (e) {
				getContent();
				
				var _self = this;
				if (!_self.verification(_self)) return;
				
				if (repeat_flag) return;
				repeat_flag = true;
				var article_item_list = JSON.parse(JSON.stringify(_self.article_item_list));
				var value = JSON.stringify(article_item_list);
				
				var type = 1;
				$.ajax({
					type: "post",
					url: ns.url('wechat://shop/material/add'),
					data: {type, value},
					dataType: "JSON",
					success: function (res) {
						if (res.code == 0) {
							//_self.material_id = res.data;
							location.href = ns.url('wechat://shop/material/lists');
						} else {
							repeat_flag = false;
						}
						layer.msg(res.message);
					}
				})
			},
			// 添加封面图
			addCover: function (e) {
				// uploadAlbumalbum_contain();
			},
			// 删除图文消息
			deleteGraphicMessage: function (_index) {
				var _self = this;
				layer.confirm(
					'确认删除？',
					{
						btn: ['确认', '取消'], //可以无限个按钮
					},
					function (index, layero) {
						if (_index == _self.article_item_list.length - 1) {
							_self.chooseGraphicMessage(_index - 1);
						} else {
							if (_self.current_msg_index != 0) {
								var _num = _self.current_msg_index - 1;
								var _top = 250;
								_top = _num == 0 ? 80 : _top;
								_num = _num > 0 ? _num - 1 : _num;
								_self.editBoxTopPosition = 72 * _num + _top;
							}
							_self.current_msg_index = _self.current_msg_index - 1;
						}
						_self.article_item_list.splice(_index, 1);
						layer.close(index);
					},
					function (index) {
						layer.close(index);
					}
				);
			},
			//验证
			verification: function (_self) {
				var article_item_list = _self.article_item_list;
				var falg = true;
				var hint_type = '';
				
				for (var index in article_item_list) {
					var article = article_item_list[index];
					
					if (article.title == '' && falg) {
						layer.msg('标题不可为空 ！');
						hint_type = 'title';
						falg = false;
					}
					
					if (article.cover.path == '' && falg) {
						layer.msg('封面图片不可为空 ！');
						hint_type = 'cover';
						falg = false;
					}
					
					if ((article.content == '' || article.content == '<p><span style="color:#A7A7Ab;">从这里开始输入正文</span></p>') && falg) {
						layer.msg('正文不可为空 ！');
						hint_type = 'content';
						falg = false;
					}
					
					if (article.url != '' && (article.url.indexOf('http://') != 0 && article.url.indexOf('https://') != 0) && falg) {
						layer.msg('原文链接无效，请输入http:// 或 https://为前缀的有效地址 ！');
						hint_type = 'url';
						falg = false;
					}
					
					if (article.digest == '' && falg) {
						var content = article.content.replace(/<\/?.+?>/g, "");
						content = content.replace(/ /g, "");
						content = content.replace("&nbsp;", " ");
						content = content.replace("&#39;", "'");
						content = content.substr(0, 64);
						
						_self.article_item_list[index].digest = content;
					}
					
					if (!falg) {
						_self.chooseGraphicMessage(index);
						
						if (hint_type == 'title') {
							$('#input_title').focus();
						}
						return false;
					}
				}
				return true;
			},
			reloadUpload: function () {
				var upload = new Upload({
					elem: '#uploadImg',
					callback:function (res) {
						if (res.code >= 0) {
							//成功之后将图片的路径存放再隐藏域中，便于提交使用
							// $("input[name='web_qrcode']").val(res.data.pic_path);
							vue_obj.coverImg = ns.img(res.data.pic_path);
							vue_obj.article_item_list[vue_obj.current_msg_index].cover.path = ns.img(res.data.pic_path);
							//将图片展示在页面上
							// $("#webQrcodeUpload").html("<img src=" + ns.img(res.data.pic_path) + " >");
						}
					}
				});
			}
		},
	})

}

/**
 * 相册选择图片回调
 * @param data
 * @param name
 */
function albumUploadSuccess(data, name) {
	if (data.length != undefined && data.length > 0) {
		if (data.length > 1) {
			layer.msg('封面图只可选择一张');
		}
		path = ns.img(data[0].path);
		var article_item_list = vue_obj.article_item_list;
		var index = vue_obj.current_msg_index;
		article_item_list[index].cover.path = path;
		vue_obj.article_item_list = article_item_list;
		vue_obj.coverImg = path;
	} else {
		layer.msg('图片添加失败');
	}
}

//获取富文本内容
function getContent(){
	vue_obj.article_item_list[vue_obj.current_msg_index].content = vue_obj.editor.getContent();
	console.log(vue_obj.article_item_list[vue_obj.current_msg_index].content)
}