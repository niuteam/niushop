var loading_index;
var menu = new Vue({
	el: '#menu',
	data: {
		button: [],
		menuIndex: [-1, -1],	// 分别是一二级菜单的index
		menuObj: {}, // 当前选择的菜单 对应的值
		subMenuPlusShow: true,	// 二级菜单 添加按钮显示
		name: '',
		type: 'media',
		key: '',
		url: '',
		media_type: '',
		media_id: '',
		appid: '',
		pagepath: '',
		error_hint: '',
		picurl: '',
		text: '',
		graphic_message: [],
		position_x: '',
		position_y: '',
		change_active: true,
	},
	watch: {
		name: function (v, ov) {
			this.setValue('name', v);
		},
		type: function (v, ov) {
			if (ov == 'media') {
				this.setValue('media_type', 'text');
				this.media_type = 'text';
			}
			this.setValue('type', v);
		},
		key: function (v, ov) {
			this.setValue('key', v);
		},
		url: function (v, ov) {
			this.setValue('url', v);
		},
		media_id: function (v, ov) {
			this.setValue('media_id', v);
		},
		appid: function (v, ov) {
			this.setValue('appid', v);
		},
		pagepath: function (v, ov) {
			this.setValue('pagepath', v);
		},
		text: function (v, ov) {
			this.setValue('text', v);
		}
	},
	methods: {
		addMenu: function () {
			var _self = this;
			var menuItem = {
				'name': '菜单名称',
			};
			var length = _self.button.length;
			_self.name = '菜单名称';
			_self.button.push(menuItem);
			_self.chooseMenu(length, -1);
			_self.setValue('type', 'media');
			_self.setValue('media_type', 'text');
			_self.media_type = 'text';
			_self.type = 'media';
			
		},
		addSubMenu: function (index) {
			var menuItem, subMenuItem;
			var _self = this;
			if (_self.button[index].sub_button != undefined && _self.button[index].sub_button.length >= 5) {
				layer.msg('每个一级菜单最多包含5个子菜单');
				return false;
			}
			if (_self.button[index].sub_button == undefined || _self.button[index].sub_button.length == 0) {
				menuItem = {
					'name': _self.button[index].name,
					'sub_button': []
				};
				_self.button[index] = menuItem;
			}
			subMenuItem = {
				'name': '子菜单名称'
			};
			this.name = '子菜单名称';
			var second_index = this.button[index].sub_button.length;
			var subMenuLength = second_index + 1;
			_self.button[index].sub_button.push(subMenuItem);
			_self.subMenuPlusShow = subMenuLength >= 5 ? false : true;
			_self.chooseMenu(index, second_index);
			_self.setValue('type', 'media');
			_self.setValue('media_type', 'text');
			_self.type = 'media';
			_self.media_type = 'text';
			delete _self.button[index].type;
			delete _self.button[index].url;
			delete _self.button[index].key;
			delete _self.button[index].media_id;
			delete _self.button[index].appid;
			delete _self.button[index].pagepath;
			delete _self.button[index].media_type;
			delete _self.button[index].picurl;
			delete _self.button[index].text;
			delete _self.button[index].graphic_message;
		},
		// 选择 菜单，first_index = 一级菜单 0-2; second_index = 二级菜单下标 0-4
		chooseMenu: function (first_index, second_index) {
			var _self = this;
			var change_active = _self.change_active;
			if (change_active === false) {
				_self.change_active = true;
				return false;
			}
			_self.menuIndex = [first_index, second_index];
			if (_self.button[first_index].sub_button != undefined) {
				_self.subMenuPlusShow = _self.button[first_index].sub_button.length >= 5 ? false : true;
			} else {
				_self.subMenuPlusShow = true;
			}
			_self.initMenuInfo();
		},
		// 删除菜单
		deleteMenu: function () {
			var _self = this;
			var first_index = _self.menuIndex[0];
			var second_index = _self.menuIndex[1];
			
			layer.open({
				title: '删除确认',
				content: '确定删除菜单 "' + _self.name + '"？',
				btn: ['确认', '关闭'],
				btn1: function () {
					_self.delMenu(first_index, second_index);
				},
				success: function (layero, index) {
					this.enterEsc = function (event) {
						if (event.keyCode === 13) {
							_self.delMenu(first_index, second_index);
							layer.close(index);
							return false; // 阻止系统默认事件
						} else if (event.keyCode === 27) {
							layer.close(index);
							return false; // 阻止系统默认事件
						}
					};
					$(document).on('keydown', this.enterEsc);	// 监听键盘事件，关闭层
				},
				end: function () {
					$(document).off('keydown', this.enterEsc);	// 解除键盘关闭事件
				}
			});
		},
		chooseMediaType: function (type) {
			var _self = this;
			var first_index = _self.menuIndex[0];
			var second_index = _self.menuIndex[1];
			switch (type) {
				case 1 :
					_self.setValue('media_type', 'graphic_message');
					_self.media_type = 'graphic_message';
					break;
				case 2 :
					_self.setValue('media_type', 'picture');
					_self.media_type = 'picture';
					break;
				case 3 :
					_self.setValue('media_type', 'audio');
					_self.media_type = 'audio';
					break;
				case 4 :
					_self.setValue('media_type', 'video');
					_self.media_type = 'video';
					break;
				case 5 :
					_self.setValue('media_type', 'text');
					_self.media_type = 'text';
					break;
			}
		},
        material: function (type) {
			switch (type) {
				case 1 :
                    material(1);
					break;
				case 2 :
                    material(2);
					break;
				case 3 :
					break;
				case 4 :
					break;
				case 5 :
                    material(5);
					break;
			}
		},
		// 添加素材
		addMaterial: function (type) {
			switch (type) {
				case 1 :
					window.open(ns.url("wechat://shop/material/add"));
					break;
				case 2 :
					uploadSingle();
					break;
				case 3 :
					break;
				case 4 :
					break;
				case 5 :
					addMaterial(5);
					break;
			}
		},
		// 删除素材
		deleteMaterial: function (type) {
			var _self = this;
			switch (type) {
				case 1 :
					_self.setValue('media_id', '');
					_self.setValue('graphic_message', []);
					_self.graphic_message = [];
					break;
				case 2 :
					_self.setValue('media_id', '');
					_self.setValue('picurl', '');
					_self.picurl = '';
					break;
				case 3 :
					break;
				case 4 :
					break;
				case 5 :
					_self.setValue('media_id', '');
					_self.setValue('text', '');
					_self.text = '';
					break;
			}
		},
		// 预览图文
		preview: function (id, index = 0) {
			preview(id, index);
		},
		// 预览文本
		previewText: function (text) {
			previewText(text);
		},
		setValue: function (menu_key, menu_value) {
			var index = this.menuIndex[0];
			var subIndex = this.menuIndex[1];
			if (subIndex >= 0) {
				this.button[index].sub_button[subIndex][menu_key] = menu_value;
			} else {
				this.button[index][menu_key] = menu_value;
			}
		},
		initMenuInfo: function () {
			var _self = this;
			var index = _self.menuIndex[0];
			var subIndex = _self.menuIndex[1];
			var info;
			if (subIndex >= 0) {
				info = _self.button[index].sub_button[subIndex];
			} else {
				info = _self.button[index];
			}
			
			_self.name = info.name ? info.name : '';
			_self.type = info.type ? info.type : '';
			_self.key = info.key ? info.key : '';
			_self.url = info.url ? info.url : '';
			_self.media_type = info.media_type ? info.media_type : '';
			_self.media_id = info.media_id ? info.media_id : '';
			_self.appid = info.appid ? info.appid : '';
			_self.pagepath = info.pagepath ? info.pagepath : '';
			_self.picurl = info.picurl ? info.picurl : '';
			_self.text = info.text ? info.text : '';
			_self.graphic_message = info.graphic_message ? info.graphic_message : [];
			
		},
		// 执行删除
		delMenu: function (first_index, second_index) {
			var _self = this;
			if (second_index == -1) {
				var length = _self.button.length;
				_self.button.splice(first_index, 1);
				if (length == 1) {
					this.menuIndex[0] = -1;
				}
				first_index = first_index == length - 1 ? first_index - 1 : first_index;
				length = length - 1 <= 0 ? -1 : length;
			} else {
				var length = _self.button[first_index].sub_button.length;
				_self.button[first_index].sub_button.splice(second_index, 1);
				second_index = second_index == length - 1 ? second_index - 1 : second_index;
				if (length == 1) {
					_self.button[first_index].media_type = 'text';
					_self.button[first_index].type = 'media';
				}
			}
			layer.msg('成功删除菜单 "' + _self.name + '"', {icon: 1});
			if (length != -1) _self.chooseMenu(first_index, second_index);
		},
		// 加载自定义菜单
		loadMenu: function () {
			var _self = this;
			$.ajax({
				url: ns.url('wechat://shop/menu/menu'),
				data: {},
				dataType: "JSON",
				success: function (res) {
					if (res.code != 0) {
						layer.msg(res.message);
					}
					res = res.data;
					try {
						var data = {};
						if (res.value == '') return false;
							if (res.value.button == undefined || res.value.button == '' || res.value.button == null) {
								return false;
							}
							_self.button = res.value.button;
							_self.menuIndex[-1, -1];
					} catch (e) {
						console.log(e);
					}
				},
				error: function (e) {
					layer.msg('加载失败');
				}
			})
		},
		// 保存自定义菜单
		saveMenu: function () {
			var _self = this;
			var value = {};
			var json_data = {};
			var button = JSON.parse(JSON.stringify(_self.button));
			
			if (!_self.verification(button)[0]) {
				return;
			}
			var button_backup = JSON.parse(JSON.stringify(button));
			value.button = button;
			value = JSON.stringify(value);
			
			json_data.button = _self.dataProcessing(button_backup);
			json_data = JSON.stringify(json_data);
			
			$.ajax({
				url: ns.url("wechat://shop/menu/edit"),
				data: {value, json_data},
				dataType: "JSON",
				success: function (res) {
					layer.msg(res.message);
				},
				error: function (e) {
					layer.msg('保存失败');
				}
			})
		},
		// 输入名称验证
		checkName: function (e, type = '') {
			var _self = this;
			var str = e.target.value;
			_self.error_hint = '';
			
			if (str == '') {
				return;
			}
			
			if (type == 'sub_button') {
				var res = /^[a-zA-Z-0-9]{1,16}$/.test((str + '').replace(/[\u4e00-\u9fa5]/g, 'aa'));
				if (!res) {
					layer.msg('菜单名称不可超过8个汉字或16个字母');
					_self.error_hint = 'name';
					_self.name = subStringLen(_self.name, 16);
					return false;
				}
			} else {
				var res = /^[a-zA-Z-0-9]{1,8}$/.test((str + '').replace(/[\u4e00-\u9fa5]/g, 'aa'));
				if (!res) {
					layer.msg('菜单名称不可超过4个汉字或8个字母');
					_self.error_hint = 'name';
					_self.name = subStringLen(_self.name, 8);
					return false;
				}
			}
		},
		verification: function (button, _times = 0) {
			var _self = this;
			var _flag = true;
			var _index = -1;
			var _arr = [];
			for (var index in button) {
				var value = button[index];
				if (value.sub_button == undefined || value.sub_button == null || value.sub_button.length == 0) {
					
					if (value.name == '' || value.name == undefined) {
						_flag = false;
						_index = index;
						layer.msg('请输入菜单名称');
						break;
					}
					
					if (value.type == '' || value.type == undefined) {
						_flag = false;
						_index = index;
						layer.msg('请选择菜单内容');
						break;
					}
					
					if (value.type == 'view') {
						delete value.key;
						delete value.appid;
						delete value.pagepath;
						delete value.media_type;
						delete value.media_id;
						delete value.picurl;
						delete value.graphic_message;
						delete value.text;
						if (value.url == '' || value.url == undefined) {
							_flag = false;
							_index = index;
							layer.msg('页面地址不可为空');
							break;
						}
						
						if (value.url.indexOf('https://') != 0 && value.url.indexOf('http://') != 0) {
							_flag = false;
							_index = index;
							layer.msg('请输入 http:// 或  https:// 为前缀的有效地址');
							break;
						}
						
					} else if (value.type == 'miniprogram') {
						delete value.key;
						delete value.media_type;
						delete value.media_id;
						delete value.picurl;
						delete value.graphic_message;
						delete value.text;
						if (value.url == '' || value.url == undefined) {
							_flag = false;
							_index = index;
							layer.msg('备用网页不可为空');
							break;
						}
						
						if (value.url.indexOf('https://') != 0 && value.url.indexOf('http://') != 0) {
							_flag = false;
							_index = index;
							layer.msg('请输入 http:// 或  https:// 为前缀的有效地址');
							break;
						}
						
						if (value.appid == '' || value.appid == undefined) {
							_flag = false;
							_index = index;
							layer.msg('小程序appid不可为空');
							break;
						}
						
						if (value.pagepath == '' || value.pagepath == undefined) {
							_flag = false;
							_index = index;
							layer.msg('小程序页面路径不可为空');
							break;
						}
					} else if (value.type == 'media') {
						delete value.key;
						delete value.appid;
						delete value.pagepath;
						delete value.url;
						if (value.media_type == 'graphic_message') {
							delete value.picurl;
							delete value.text;
							if (value.graphic_message == undefined || value.graphic_message[0] == undefined) {
								_flag = false;
								_index = index;
								layer.msg('图文消息不可为空');
								break;
							}
						}
						
						if (value.media_type == 'picture') {
							delete value.graphic_message;
							delete value.text;
							if (value.picurl == undefined || value.picurl == undefined) {
								_flag = false;
								_index = index;
								layer.msg('图片素材不可为空');
								break;
							}
						}
						
						if (value.media_type == 'text') {
							delete value.picurl;
							delete value.graphic_message;
							if (value.text == '' || value.text == undefined) {
								_flag = false;
								_index = index;
								layer.msg('文本素材不可为空');
								break;
							}
						}
					}
				} else {
					_index = index;
					_arr = _self.verification(value.sub_button, 1);
					if (!_arr[0]) {
						_flag = false;
						break;
					}
				}
				
				if (!_flag) {
					break;
				}
			}
			
			if (_times == 0 && !_flag) {
				if (_arr[0] != undefined && !_arr[0]) {
					_flag = false;
					_self.chooseMenu(_index, _arr[1]);
				} else {
					_self.chooseMenu(_index, -1);
				}
			}
			
			return [_flag, _index, button];
		},
		//media 事件 转换为 click 事件
		dataProcessing: function (buttons) {
			var _self = this;
			for (var first_index in buttons) {
				if (first_index == 'indexOfElem' || first_index == 'removeElem') {
					delete buttons[first_index];
					continue;
				}
				if (buttons[first_index].sub_button == undefined || buttons[first_index].sub_button == null || buttons[first_index].sub_button.length == 0) {
					delete buttons[first_index].sub_button;
					if (buttons[first_index].type == 'media') {
						delete buttons[first_index].media_type;
						delete buttons[first_index].picurl;
						delete buttons[first_index].text;
						delete buttons[first_index].graphic_message;
						buttons[first_index].type = 'click';
						buttons[first_index].key = buttons[first_index].media_id;
						delete buttons[first_index].media_id;
					}
				} else {
					for (var second_index in buttons[first_index].sub_button) {
						if (buttons[first_index].sub_button[second_index].type == 'media') {
							delete buttons[first_index].sub_button[second_index].media_type;
							delete buttons[first_index].sub_button[second_index].picurl;
							delete buttons[first_index].sub_button[second_index].text;
							delete buttons[first_index].sub_button[second_index].graphic_message;
							buttons[first_index].sub_button[second_index].type = 'click';
							buttons[first_index].sub_button[second_index].key = buttons[first_index].sub_button[second_index].media_id;
							delete buttons[first_index].sub_button[second_index].media_id;
						}
					}
				}
			}
			return buttons;
		},
		// 菜单拖拽移动
		// dragMove(e,  index){
		//     var _self = this;
		//     var button = _self.button;
		//     var menuIndex = _self.menuIndex;
		//
		//     var length = button.length;
		//
		//     if (length != undefined && length > 1) {
		//         var odiv = e.target;
		//         var disX = e.clientX;
		//         var ele = $('.wx-menu-item-box-' + index);
		//         // var min = 0 - index * 93.67;
		//         // var max = 0 + (length - index - 1) * 93.67;
		//         ele.css({'left': 0, 'z-index': 0, 'opacity' : 1});
		//         document.onmousemove = (e)=>{
		//             var left = e.clientX - disX;
		//             if (index == 0) {
		//                 if (left > 47 && left < 94) {
		//                     var new_item = button[index];
		//                     button[index] = button[index + 1];
		//                     button[index + 1] = new_item;
		//                     console.log(button);
		//                     console.log();
		//                     _self.button = button;
		//                     _self.menuIndex[0] = index + 1;
		//                     _self.initMenuInfo();
		//                     console.log(_self.button);
		//                 }
		//             } else if (index == 1) {
		//
		//             } else {
		//
		//             }
		//             ele.css({'left': left + 'px', 'z-index': 10});
		//             if ((left > 5 || left < -5) && _self.change_active !== false) {
		//                 _self.change_active = false;
		//             }
		//         };
		//         document.onmouseup = (e) => {
		//             ele.css({'left': 0, 'z-index': 0, 'opacity' : 1});
		//             document.onmousemove = null;
		//             document.onmouseup = null;
		//         };
		//     }
		// },
		// // 子菜单拖拽移动
		// dragMoveItem(e, second_index){
		//     var _self = this;
		//     var button = _self.button;
		//     var menuIndex = _self.menuIndex;
		//     var index = menuIndex[0];
		//     var length = button[index].sub_button.length;
		//     // var min = 0 - second_index * 50;
		//     // var max = 0 + (length - second_index - 1) * 50;
		//     if (length != undefined && length > 1) {
		//         var odiv = e.target;
		//         var disY = e.clientY;
		//         var ele = $('.wx-sub-menu-item-' + second_index);
		//         ele.css({'top': 0, 'z-index': 0, 'opacity' : 1});
		//         document.onmousemove = (e)=>{
		//             var top = e.clientY - disY;
		//             ele.css({'top': top, 'z-index': 10});
		//             if ((top > 5 || top < -5) && _self.change_active !== false) {
		//                 _self.change_active = false;
		//             }
		//         };
		//         document.onmouseup = (e) => {
		//             ele.css({'top': 0, 'z-index': 0, 'opacity' : 1});
		//             document.onmousemove = null;
		//             document.onmouseup = null;
		//         };
		//     }
		// }
	},
});

$(function () {
	setTimeout(function () {
		menu.loadMenu();
	}, 50)
});

/**
 * 单图上传回调
 *
 * @param _data
 * @param _name
 */
function singleImageUploadSuccess(_data, _name) {
	if (_data.path != undefined) {
		layer.closeAll('page');
		loading_index = layer.load(2, {time: 10 * 1000});
		$.ajax({
			type: 'post',
			url: ns.url('wechat://shop/material/add'),
			dataType: "JSON",
			data: {
				'type': 2,
				'path': _data.path,
				'title': _data.file_name
			},
			success: function (res) {
				layer.msg(res.message);
				layer.close(loading_index);
				if (res.code == 0) {
					menu.setValue('media_id', 'MATERIAL_PICTURE_' + res.data);
					menu.setValue('picurl', ns.img(_data.path));
					menu.picurl = ns.img(_data.path);
				}
				return true;
			}
		})
	}
}

/**
 * 图片素材选择回调
 */
function materialPicCallBack(_data) {
	menu.setValue('media_id', 'MATERIAL_PICTURE_' + _data.file_id);
	menu.setValue('picurl', _data.path);
	menu.picurl = _data.path;
}

/**
 * 图文选择回调
 * @param data
 */
function chooseGraphicMessage(_data) {
	var graphic_message = new Array();
	for (var index in _data.value) {
		graphic_message[index] = {};
		graphic_message[index].title = _data.value[index].title;
		graphic_message[index].id = _data.id;
	}
	menu.setValue('media_id', 'MATERIAL_GRAPHIC_MESSAGE_' + _data.id);
	menu.setValue('graphic_message', graphic_message);
	menu.graphic_message = graphic_message;
}

/**
 * 文本选择回调
 */
function chooseTextMessage(_data) {
	menu.setValue('media_id', 'MATERIAL_TEXT_MESSAGE_' + _data.id);
	menu.setValue('text', _data.value.content);
	menu.text = _data.value.content;
}

/**
 * 添加文本回调
 */
function textMessageAddSuccess(_data) {
	menu.setValue('media_id', 'MATERIAL_TEXT_MESSAGE_' + _data.id);
	menu.setValue('text', _data.value.content);
	menu.text = _data.value.content;
}

function subStringLen(str, len) {
	var regexp = /[^\x00-\xff]/g;
	if (str.replace(regexp, "aa").length <= len) {
		return str;
	}
	var m = Math.floor(len / 2);
	for (var i = m, j = str.length; i < j; i++) {
		if (str.substring(0, i).replace(regexp, "aa").length >= len) {
			return str.substring(0, i);
		}
	}
	return str;
}