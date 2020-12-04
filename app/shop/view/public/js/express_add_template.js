layui.use(['form', 'layer'], function () {
	// 加载资源
	var $ = layui.jquery, layer = layui.layer, form = layui.form;
	form.render();

	//模板ID
	var template_id = Number($("#template_id").val());
	//地区等级
	var area_level = Number($("#area_level").val());
	//剩余地区 id数据
	var surplus_area_ids = $("#surplus_area_ids").val();
	//剩余地区完整数据
	var surplus_area = {};
	//选中地区完整数据
	var selected_area = {};
	//提交表单数据
	var submit_data = {};

	//地区位置标识
	var area_target = [0];
	//操作类型
	var opt_type = 1;
	//当前操作序号
	var opt_num = 0;
	//总操作序号
	var opt_total = 0;

	//临时数据
	var temp_area = {};
	//计费方式
	var fee_type = 1;

	//计费方式初始化数据
	var init_data = {'snum': 1, 'xnum': 0, 'sprice': 0.00, 'xprice': 0.00};
	//计费方式对象数据
	var fee_type_obj = JSON.parse($("#fee_type_json").val());
	//layer弹框的标记
	var layer_index;
	//layer加载标记
	var layer_load;
	//ajax是否已经返回数据
	var area_data_flag = false;
	//是否已经点击提交按钮
	var submit_flag = false;

	var is_default = $('#is_default').val();
	/**
	 * 获取地区列表 立即执行
	 */
	(function () {
		if (template_id > 0) {
			fee_type = $("#fee_type").val();//计费方式
			opt_total = Number($("#opt_total").val());
		}

		$.ajax({
			type: "post",
			url: ns.url('shop/express/getarealist'),
			data: {
				level: area_level,
			},
			dataType: 'json',
			success: function (data) {
				if (template_id == 0) {
					surplus_area = copy_obj(data);
				} else {
					surplus_area = get_data_by_ids(data, surplus_area_ids);
					submit_data = initSubmitData();
					for (var num in submit_data) {
						selected_area[num] = get_data_by_ids(data, submit_data[num]['area_ids']);
					}
				}
				//改变地区加载标记 关闭弹框 重新渲染数据
				area_data_flag = true;
				if (layer_load) {
					layer.close(layer_load);
					if (opt_type == 2) {
						// 将临时数据对象清零并重新赋值
						temp_area = new Object();
						temp_area = copy_obj(selected_area[opt_num]);
					}
					compile_new_data();
				}
			}
		})
	}());

	/**
	 * 未选中数据
	 */
	function initSurplus(data) {
		var area_list = get_area_ids(copy_obj(data));

		$('.area_ids').each(function (i, e) {
			var surplus_ids = JSON.parse($(e).val());
			for (var level = count_obj(surplus_ids); level > 0; level--) {
				for (var i in surplus_ids[level]) {
					for (var i2 in surplus_ids[level][i]) {
						area_list = delData(area_list, level, i, surplus_ids[level][i][i2]);
					}
				}

			}
		});
		return JSON.stringify(area_list);
	}

	/**
	 * 提交数据
	 */
	function initSubmitData() {
		var data = {};
		var num = 1;
		$('.area_ids').each(function (i, e) {
			var other = {};
			other['snum'] = $(e).attr('data-snum');
			other['sprice'] = $(e).attr('data-sprice');
			other['xnum'] = $(e).attr('data-xnum');
			other['xprice'] = $(e).attr('data-xprice');
			data[num] = {};
			data[num]['area_ids'] = $(e).val();
			data[num]['area_names'] = $(e).attr('data-name');
			data[num]['other'] = other;
			num++;
		});
		return data;
	}

	/**
	 * 删除指定数据
	 */
	function delData(list, level, pid, id) {
		for (var i in list[level]) {
			if (list[level] && list[level][pid] && level == 4) {
				for (var i2 in list[level][pid]) {
					if (list[level][pid][i2] && list[level][pid][i2] == id) {
						delete list[level][pid][i2];
						compactObj(list[level][pid]);
						return list;
					}
				}
			}

			if (list[level] && list[level][pid]) {
				for (var i2 in list[level][pid]) {

					if (list[level][pid][i2] && list[level][pid][i2] == id && count_obj(list[level + 1][id]) == 0) {
						delete list[level][pid][i2];
						compactObj(list[level][pid]);
						return list;
					}
				}
			}
		}
		return list;
	}

	/**
	 * 渲染列表
	 */
	function compile_list(area_list, level, pid, html) {
		if (!area_list[level] || !area_list[level][pid]) return html;
		html += '<ul>';
		for (var id in area_list[level][pid]['child_list']) {
			var item = area_list[level][pid]['child_list'][id];
			if (item == undefined) {
				continue;
			}
			var has_num = 0;
			if (area_list[level + 1] && area_list[level + 1][id]) has_num = count_obj(area_list[level + 1][id]['child_list']);

			var extended = item.extended ? item.extended : item.extended = 0;
			var selected = item.selected ? item.selected : item.selected = 0;

			var extended_html = extended == 0 ? '+' : '-';
			var selected_html = selected == 1 ? 'selected' : '';

			area_target[level] = item.id;
			area_target = area_target.slice(0, level + 1);

			html += '<li class="' + selected_html + '" data-level="' + item.level + '" data-pid="' + item.pid + '" data-id="' + item.id + '" data-extended="' + extended + '" data-selected="' + selected + '" data-target="' + area_target.toString() + '">';
			html += '<div class="title-div" >';

			if (has_num > 0 && item.level != area_level) html += '<div class="area-btn ' + selected_html + '" >' + extended_html + '</div>';
			else html += '<div class="area-btn-null"></div>';
			html += '<div class="name-div" >' + item.name + '</div>';
			html += '<div class="area-delete">×</div>';
			html += '</div>';
			if (extended == 1 && has_num > 0) html += compile_list(area_list, level + 1, id, '');
			html += '</li>';
		}
		html += '</ul>';
		return html;
	}

	/**
	 * 渲染列表数据
	 */
	function compile_new_data() {
		var surplus_html = compile_list(surplus_area, 1, 0, '');
		$(".area-modal .all-area .box").html(surplus_html);
		var temp_html = compile_list(temp_area, 1, 0, '');
		$(".area-modal .selected-area .box").html(temp_html);
	}

	/**
	 * 统计对象属性个数
	 */
	function count_obj(obj) {
		var count = 0;
		if (!obj) return count;
		for (var index in obj) {
			count++
		}
		return count;
	}

	/**
	 * 拷贝一个对象
	 */
	function copy_obj(obj) {
		var res = new Object();
		for (var i in obj) {
			res[i] = obj[i];
		}
		return res;
	}

	/**
	 * 向下遍历改变数据对象的状态
	 */
	function area_down_alter(area_list, level, pid, alter_res, key) {

		if (area_list[level + 1] && area_list[level + 1][pid]) {

			for (var id in area_list[level + 1][pid]['child_list']) {
				var item = area_list[level + 1][pid]['child_list'][id];
				if (item == undefined) {
					continue;
				}
				item[key] = alter_res;
				item['choosed'] = alter_res;
				if (area_list[level + 2]) area_down_alter(area_list, level + 1, item['id'], alter_res, key);
			}
		}
	}

	/**
	 * 向上遍历改变数据对象的状态
	 */
	function area_up_alter(area_list, level, target, key) {
		if (level > 1) {
			var alter_res = 1;
			for (var id in area_list[level][target[level - 1]]['child_list']) {
				if (!area_list[level][target[level - 1]]['child_list'][id][key]) {
					alter_res = 0;
					break;
				}
			}
			var choosed = 0;
			for (var id in area_list[level][target[level - 1]]['child_list']) {
				if (area_list[level][target[level - 1]]['child_list'][id] == undefined) {
					continue;
				}
				if (area_list[level][target[level - 1]]['child_list'][id]['choosed'] == 1) {
					choosed = 1;
					break;
				}
			}
			area_list[level - 1][target[level - 2]]['child_list'][target[level - 1]][key] = alter_res;
			area_list[level - 1][target[level - 2]]['child_list'][target[level - 1]]['choosed'] = choosed;
			area_up_alter(area_list, level - 1, target, key);
		}
	}

	/**
	 * 处理数据
	 */
	function deal_data(area_list, key) {
		var temp = {};
		for (var level in area_list) {
			var level_temp = {};
			for (var pid in area_list[level]) {
				var pid_temp = {child_list: {}};
				var total_num = 0;
				var del_num = 0;
				for (var id in area_list[level][pid]['child_list']) {
					if (area_list[level][pid]['child_list'][id] == undefined) {
						continue;
					}
					total_num++;
					if (area_list[level][pid]['child_list'][id]['choosed'] == 1) {
						pid_temp['child_list'][id] = area_list[level][pid]['child_list'][id];
					}
					if (area_list[level][pid]['child_list'][id][key] == 1) {
						delete area_list[level][pid]['child_list'][id];
						del_num++;
					}
					if (pid_temp['child_list'][id]) {
						pid_temp['child_list'][id][key] = 0;
						pid_temp['child_list'][id]['choosed'] = 0;
					}
				}
				if (count_obj(pid_temp['child_list']) > 0) {
					pid_temp['child_num'] = area_list[level][pid]['child_num'] ? area_list[level][pid]['child_num'] : 0;
					level_temp[pid] = pid_temp;
				}
				if (total_num == del_num && total_num > 0) delete area_list[level][pid];
			}
			if (count_obj(level_temp) > 0) temp[level] = level_temp;
		}
		return temp;
	}

	/**
	 * 合并两个对象
	 * selected 提供数据的对象
	 * receive 接收数据的对象
	 * 思路：如果receive没有就直接添加到receive 如果有就进入下层循环
	 */
	function combine_data(give, receive) {
		for (var level in give) {
			if (receive[level]) {
				for (var pid in give[level]) {
					if (receive[level][pid]) {
						for (var id in give[level][pid]['child_list']) {
							receive[level][pid]['child_list'][id] = give[level][pid]['child_list'][id];
						}
					} else {
						receive[level][pid] = give[level][pid];
					}
				}
			} else {
				receive[level] = give[level];
			}
		}
	}

	/**
	 * 将选中地区结构转换为文字说明
	 * 思路：选中下级个数同总下级个数相同，说明选中全部，显示当前地区即可，否则要把下级地区也显示出来
	 */
	function alter_text(area_list, level, pid, html) {
		var has_num = 0;
		for (var id in area_list[level][pid]['child_list']) {
			html += area_list[level][pid]['child_list'][id]['name'];
			if (area_list[level + 1] && area_list[level + 1][id]) {
				var alter_res = alter_text(area_list, level + 1, id, '');
				if (alter_res['has_num'] == area_list[level + 1][id]['child_num']) {
					has_num++;
				} else {
					html += '（';
					html += alter_res['html'];
					html += '）';
				}
			} else {
				has_num++;
			}
			html += '、';
		}
		html = html.substring(0, html.length - 1);
		return {
			html: html,
			has_num: has_num,
		};
	}

	/**
	 * 编译表格
	 * 用在两个地方
	 * 1：在点击保存的时候编译添加和修改的所有模板项
	 * 2：在刚进入页面的时候初始化数据
	 */
	function compile_table() {

		var html = '';
		for (var index in submit_data) {
			if (count_obj(submit_data[index]) > 0) {
				html += '<tr data-selected="' + index + '">';
				html += '<td>';
				html += '<p class="area-show">' + submit_data[index]['area_names'];
				html += '<span class="right-opt"><span class="opt-update ns-text-color" data-selected="' + index + '">修改</span>&nbsp;<span class="opt-delete" data-selected="' + index + '">删除</span></span>';
				html += '</p>';
				html += '</td>';
				for (var per in submit_data[index]['other']) {
					html += '<td>';
					html += '<div class="layui-input-inline">';
					html += '<input type="text" name="' + per + '" data-selected="' + index + '" class="layui-input" value="' + submit_data[index]['other'][per] + '">';
					html += '</div>';
					html += '</td>';
				}
				html += '</td>';
				html += '</tr>';
			}
		}
		html += '<tr>';
		html += '<td colspan="5" class="ns-text-color add-distribution js-add-record">指定可配送区域和运费</td>';
		html += '</tr>';
		$("#distributionArea tbody").html(html);
	}

	/**
	 * 获取ID数据对象
	 */
	function get_area_ids(area_list) {
		var obj = {};
		for (var level in area_list) {
			obj[level] = {};
			for (var pid in area_list[level]) {
				obj[level][pid] = [];
				for (var id in area_list[level][pid]['child_list']) {
					obj[level][pid].push(id);
				}
			}
		}
		return obj;
	}

	/**
	 * 改变整个对象的某一属性
	 */
	function alter_data_attr(area_list, key, value) {
		for (var level in area_list) {
			for (var pid in area_list[level]) {
				for (var id in area_list[level][pid]['child_list']) {
					area_list[level][pid]['child_list'][id][key] = value;
				}
			}
		}
	}

	/**
	 * 由id得到完整数据
	 */
	function get_data_by_ids(area_list, ids) {
		var obj = JSON.parse(ids);
		var temp = {};
		for (var level in obj) {
			var level_temp = {};
			for (var pid in obj[level]) {
				var pid_temp = {};
				pid_temp['child_list'] = {};
				for (var id in obj[level][pid]) {
					var area_id = obj[level][pid][id];
					pid_temp['child_list'][area_id] = area_list[level][pid]['child_list'][area_id];
				}
				pid_temp['child_num'] = area_list[level][pid]['child_num'];
				level_temp[pid] = pid_temp;
			}
			temp[level] = level_temp;
		}
		return temp;
	}

	/**
	 * 展开与收起 思路为先改变数据 再重新渲染
	 */
	$("body").on('click', '.area-list .area-btn', function () {
		var li = $(this).parent().parent();
		var extended = li.attr('data-extended');
		var level = li.attr('data-level');
		var pid = li.attr('data-pid');
		var id = li.attr('data-id');

		var alter_res = extended == 1 ? 0 : 1;

		if (surplus_area[level] && surplus_area[level][pid] && surplus_area[level][pid]['child_list'][id]) surplus_area[level][pid]['child_list'][id]['extended'] = alter_res;
		if (temp_area[level] && temp_area[level][pid] && temp_area[level][pid]['child_list'][id]) temp_area[level][pid]['child_list'][id]['extended'] = alter_res;

		compile_new_data();
	});

	/**
	 * 选中与取消 思路同展开与收起 也是先改变数据 再重新渲染
	 */
	$("body").on('click', '.area-list.all-area ul li .title-div .name-div', function () {
		var li = $(this).parent().parent();
		var selected = li.attr('data-selected');
		var level = li.attr('data-level');
		var pid = li.attr('data-pid');
		var id = li.attr('data-id');
		var target = li.attr('data-target');
		target = target.split(',');

		var alter_res = selected == 1 ? 0 : 1;

		surplus_area[level][pid]['child_list'][id]['selected'] = alter_res;
		surplus_area[level][pid]['child_list'][id]['choosed'] = alter_res;
		area_down_alter(surplus_area, Number(level), id, alter_res, 'selected');
		area_up_alter(surplus_area, Number(level), target, 'selected');
		compile_new_data();
	});

	/**
	 * 将选中部分添加到已选中 思路为先遍历和处理数据 再渲染两边的列表
	 */
	$("body").on("click", ".area-modal .add", function () {
		// 找到新选中部分
		var choose = deal_data(surplus_area, 'selected');
		combine_data(choose, temp_area);
		compile_new_data();
	});

	/**
	 * 归还右边删除部分到左边
	 * 思路：相当于是执行了两步操作 1：选中 2：反向添加
	 */
	$("body").on("click", ".area-modal .area-list.selected-area .area-delete", function () {

		// 改变状态
		var li = $(this).parent().parent();
		var level = li.attr('data-level');
		var pid = li.attr('data-pid');
		var id = li.attr('data-id');
		var target = li.attr('data-target');
		target = target.split(',');
		var alter_res = 1;

		temp_area[level][pid]['child_list'][id]['selected'] = alter_res;
		temp_area[level][pid]['child_list'][id]['choosed'] = alter_res;
		area_down_alter(temp_area, Number(level), id, alter_res, 'selected');
		area_up_alter(temp_area, Number(level), target, 'selected');

		// 找到 删除 合并
		var choose = deal_data(temp_area, 'selected');
		combine_data(choose, surplus_area);

		compile_new_data();
	});

	/**
	 * 验证表单数据
	 * 1：转换为数字类型，同时过滤掉左右两边的0（结果中可能包含‘-’、‘.’、‘+’等字符，所以要做进一步处理）
	 * 2：转换为整型或浮点型
	 * 3：变成非负数
	 * 注：中间任何一步出错都初始化数据
	 */
	$("#distributionArea").on("change", "input", function () {
		var value = $(this).val();
		var name = $(this).attr('name');
		var selected_num = $(this).attr('data-selected');

		value = Number(value);
		if (isNaN(value)) value = init_data[name];
		if (name == 'snum' || name == 'xnum') {
			if (fee_type == 'NUM') {
				value = parseInt(value);
				if (isNaN(value)) value = init_data[name];
			} else {
				value = parseFloat(value);
				if (isNaN(value)) {
					value = init_data[name];
				} else {
					value = value.toFixed(1);
				}
			}
		} else {
			value = parseFloat(value);
			if (isNaN(value)) {
				value = init_data[name];
			} else {
				value = value.toFixed(2);
			}
		}
		if (value < 0) value *= -1;
		submit_data[selected_num]['other'][name] = value;
		$(this).val(value);

	});

	/**
	 * 获取弹框html
	 */
	function get_modal_html() {
		var modal_html = '';
		modal_html += '<div class="area-modal">' +
			'<div class="area-list all-area">' +
			'<div class="title ns-bg-color-gray">可选省、市、区</div>' +
			'<div class="box"></div>' +
			'</div>' +
			'<button class="add">添加</button>' +
			'<div class="area-list selected-area">' +
			'<div class="title ns-bg-color-gray">已选省、市、区</div>' +
			'<div class="box"></div>' +
			'</div>' +
			'</div>' +
			'<div class="modal-operation">' +
			'<button class="layui-btn ns-bg-color save-btn">确定</button>' +
			'<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>' +
			'</div>';
		return modal_html;
	}

	/**
	 * 开始添加操作
	 */
	$("#distributionArea").on("click", ".js-add-record", function () {
		//打开弹框
		layer_index = layer.open({
			title: '编辑配送区域',
			type: 1,
			area: ['700px', '542px'], //宽高
			content: get_modal_html(),
		});
		opt_type = 1;
		// 重置临时数据对象
		temp_area = new Object();
		compile_new_data();
		if (area_data_flag == false) {
			layer_load = layer.load(1, {
				shade: [0.1, '#fff'] //0.1透明度的白色背景
			});
		}
	});

	/**
	 * 开始修改操作
	 */
	$("#distributionArea").on("click", ".opt-update", function () {
		// 操作类型为添加
		opt_type = 2;
		// 确定正在操作的数据序列
		opt_num = parseInt($(this).attr('data-selected'));
		// 将临时数据对象清零并重新赋值
		temp_area = new Object();
		temp_area = copy_obj(selected_area[opt_num]);
		//打开弹框
		layer_index = layer.open({
			title: '编辑配送区域',
			type: 1,
			area: ['700px', '542px'], //宽高
			content: get_modal_html(),
		});
		// 渲染数据
		compile_new_data();
		if (area_data_flag == false) {
			layer_load = layer.load(1, {
				shade: [0.1, '#fff'] //0.1透明度的白色背景
			});
		}
	});

	/**
	 * 保存操作
	 */
	$("body").on("click", ".save-btn", function () {
		layer.close(layer_index);
		if (count_obj(temp_area) == 0) return;
		if (opt_type == 1) {
			opt_total++;
			opt_num = opt_total;
			// 选中地区数据
			selected_area[opt_num] = new Object();

			// 提交表单数据
			submit_data[opt_num] = new Object();
			submit_data[opt_num]['other'] = {
				'snum': 1.00,
				'sprice': 0.00,
				'xnum': 0.00,
				'xprice': 0.00,
			};
		}
		submit_data[opt_num]['area_ids'] = new Object();
		// 把临时数据变为正式数据
		for (var per in temp_area) {
			selected_area[opt_num][per] = temp_area[per];
		}
		submit_data[opt_num]['area_names'] = alter_text(temp_area, 1, 0, '')['html'];
		// 编译数据表格
		compile_table();
		// 获取剩余地区和选中地区的ID数据
		surplus_area_ids = JSON.stringify(get_area_ids(surplus_area));
		submit_data[opt_num]['area_ids'] = JSON.stringify(get_area_ids(temp_area));

	});

	/**
	 * 取消操作
	 */
	$("body").on("click", ".area-modal .cancel-btn", function () {
		layer.close(layer_index);
	});

	/**
	 * 删除操作
	 */
	$("#distributionArea").on("click", ".opt-delete", function () {
		// 确定正在删除的数据序列是哪一个
		opt_num = parseInt($(this).attr('data-selected'));
		//询问框
		layer_index = layer.confirm('确定要删除该记录吗', {
			btn: ['确定', '取消'] //按钮
		}, function () {
			alter_data_attr(selected_area[opt_num], 'choosed', 1);
			// 归还数据到总数据
			combine_data(selected_area[opt_num], surplus_area);
			// 销毁当前数据
			delete selected_area[opt_num];
			//selected_area[opt_num] = new Object();
			// 销毁提交数据
			delete submit_data[opt_num];
			// submit_data[opt_num] = new Object();
			// 删除当前行
			$("tr[data-selected='" + opt_num + "']").remove();
			layer.close(layer_index);
		}, function () {

		});
	});

	// 切换计费模式
	form.on('radio(fee_type)', function (e) {
		fee_type = e.value;
		// 改变名称
		for (var per in fee_type_obj[fee_type]) {
			$("#distributionArea th[data-name='" + per + "']").html(fee_type_obj[fee_type][per]);
		}
		// 初始化js数据
		for (var per1 in submit_data) {
			if (count_obj(submit_data[per1]) != 0) {
				var data_cell = submit_data[per1]['other'];
				for (var per2 in data_cell) {
					data_cell[per2] = init_data[per2];
				}
			}
		}
		// 初始化页面数据
		for (var per3 in init_data) {
			$("#distributionArea input[name='" + per3 + "']").val(init_data[per3]);
		}
	});

	// 是否默认
	form.on('switch(is_default)', function (e) {
		if (e.elem.checked) {
			is_default = 1;
		} else {
			is_default = 0;
		}

	});

	form.on('submit(save)', function (form_data) {

		if (submit_flag == true) return false;
		var url = ns.url('shop/express/addtemplate');
		if (template_id) url = ns.url('shop/express/editTemplate');

		//过滤数据
		var real_data = new Object();
		for (var per in submit_data) {
			if (count_obj(submit_data[per]) > 0) {
				real_data[per] = submit_data[per];
			}
		}
		//拼接数据
		for (var i in real_data) {
			real_data[i]['snum'] = real_data[i]['other']['snum'];
			real_data[i]['sprice'] = real_data[i]['other']['sprice'];
			real_data[i]['xnum'] = real_data[i]['other']['xnum'];
			real_data[i]['xprice'] = real_data[i]['other']['xprice'];
			delete real_data[i]['other'];
		}

		if (form_data['field']['template_name'] == 0) {
			layer.msg('请输入模板名称');
			return false;
		}
		if (count_obj(real_data) == 0) {
			layer.msg('至少要设置一个配送地区');
			return false;
		}

		var data_json = {
			'fee_type': fee_type,
			'template_name': form_data['field']['template_name'],
			'is_default': is_default,
			'json': JSON.stringify(real_data),
			'template_id': template_id,
			'surplus_area_ids': surplus_area_ids
		};

		submit_falg = true;
		$.ajax({
			type: "post",
			url: url,
			data: data_json,
			dataType: 'json',
			success: function (res) {
				layer.msg(res.message, {}, function () {
					if (res.code == 0) {
						window.location.href = ns.url('shop/express/template');
					}
				});
			}
		});

		return false;
	});

	/**
	 * 去除对象中所有符合条件的对象
	 * @param {Object} obj 来源对象
	 */
	function compactObj(obj) {
		if (!(typeof obj == 'object')) {
			return;
		}
		for (var key in obj) {
			if (obj.hasOwnProperty(key)
				&& (obj[key] == null || obj[key] == undefined || obj[key] == '')) {
				delete obj[key];
			}
		}
		return obj;
	}


});