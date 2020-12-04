var layer_index = '';
var add_layer_index = '';
var limit = 15;
var laytpl;
var laypage;
var repeat_flag = false;//防重复标识

function chooseMaterial(type) {
	loadMaterialList(type);
	var content_id = $('#marterial_graphic_message');
	if (type == 1) {
		content_id = $('#marterial_graphic_message');
	} else if (type == 2) {
		content_id = $('#material_image');
	} else if (type == 5) {
		content_id = $('#material_text');
	}
	layer_index = layer.open({
		type: 1,
		title: false,
		//	shade: [0],
		area: ['800px', '450px'],
		content: content_id,
		success: function (layero, index) {
			var mask = $(".layui-layer-shade");
			mask.appendTo(layero.parent());
		}
	});
}

/**
 * 素材列表
 */
function loadMaterialList(type) {
	if (type == 1) {
		var table = new Table({
			elem: '#marterial_graphic_message_list',
			filter: "marterial_graphic_message",
			// width: '780',
			url: ns.url("wechat://shop/material/lists"),
			where: {type: 1, limit},
			cols: [[
				{field: 'value', width: '35%', title: '标题', align: 'center', templet: '#graphic_message_title'},
				{field: 'create_time', width: '25%', title: '创建时间', align: 'center', templet: '#create_time'},
				{field: 'update_time', width: '20%', title: '更新时间', align: 'center', templet: '#update_time'},
				{title: '操作', width: '20%', toolbar: '#operation', align: 'center'}
			]]
		});
		
		//监听工具条
		table.tool(function (obj) {
			var data = obj.data;
			switch (obj.event) {
				case "choose":
                    try{
                        parent.chooseGraphicMessage(data);
                    }catch(e){
                        console.error("chooseGraphicMessage()");
                    }
                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                    parent.layer.close(index);
					// chooseGraphicMessage(data);
					// layer.close(layer_index);
					break;
			}
		});
	}else if (type == 5) {
		var table = new Table({
			elem: '#material_text_list',
			filter: "material_text",
			// width: '780',
			url: ns.url("wechat://shop/material/lists"),
			where: {type: 5},
			cols: [[
				{field: 'value', width: '40%', title: '内容', align: 'center', templet: '#text_content'},
				{field: 'create_time', width: '25%', title: '创建时间', align: 'center', templet: '#create_time'},
				{field: 'update_time', width: '25%', title: '更新时间', align: 'center', templet: '#update_time'},
				{title: '操作', width: '10%',toolbar: '#operation', align: 'center'}
			]]
		});
		
		//监听工具条
		table.tool(function (obj) {
			var data = obj.data;
			switch (obj.event) {
				case "choose":
                    try{
                        parent.chooseTextMessage(data);

                    }catch(e){
                        console.error("chooseTextMessage()");
                    }
                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                    parent.layer.close(index);
                    //
					// chooseTextMessage(data);
					// layer.close(layer_index);
					break;
			}
		});
	}
}

/**
 * 图文消息预览
 */
function preview(id, index = 0) {
	var parme = {"id": id, "i": index};
	var url = ns.url("wechat://shop/material/previewgraphicmessage");
	url = url.replace('.html', '') + '/id/' + id + '/i/' + index + '.html';
	window.open(url);
}

/**
 * 文本消息预览
 */
function previewText(content) {
	layer.open({
		title: '文本内容',
		content: content
	})
}

function addMaterial(type) {
	addMaterialForm(type);
	var content_id = $('#add_material_text');

	add_layer_index = layer.open({
		type: 1,
		title: false,
		//	shade: [0],
		area: ['800px', '646px'],
		content: content_id,
		success: function (layero, index) {
			var mask = $(".layui-layer-shade");
			mask.appendTo(layero.parent());
		}
	});
}

function addMaterialForm(type) {
	if (type == 5) {
		layui.use('form', function () {
			var form = layui.form;

			$('#material_text_content').on('input', function (e) {
				var num = e.target.value.length;
				num = 300 - parseInt(num);
				$('#add_material_text .input-text-hint').html('剩余' + num);
			});
			form.verify({
				'material_text_content': function (value, item) {
					if (value == '' || value == undefined) {
						return '文本内容不可为空';
					}
				}
			});

			form.on('submit(addText)', function (data) {
				var value = JSON.stringify(data.field);
				if (repeat_flag) return;
				repeat_flag = true;
				$.ajax({
					type: 'post',
					url: ns.url('wechat://shop/material/addTextMaterial'),
					data: {type: 5, value},
					dataType: "JSON",
					success: function (res) {
						layer.msg(res.message);
						repeat_flag = false;
						if (res.code == 0) {
							layer.close(add_layer_index);
							var _data = {
								id: res.data,
								value: data.field
							};
						}
					}
				});
			});
		});
	}
}