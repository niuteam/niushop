$(document).ready(function() {
	var fontSize = $("#font_size").val();
	$(".tdrag-name").css("fontSize", fontSize + 'px');

	$(".tdrag-header").Tdrag({
		scope: "#divBlock"
	});

	$(".tdrag-logo").Tdrag({
		scope: "#divBlock"
	});

	$(".tdrag-code").Tdrag({
		scope: "#divBlock"
	});

	$(".tdrag-name").Tdrag({
		scope: "#divBlock"
	});
});

layui.use(['form', 'colorpicker'], function() {
	var form = layui.form,
		colorpicker = layui.colorpicker,
		repeat_flag = false; //防重复标识

	/**
	 * 监听保存
	 */
	form.on('submit(save)', function(data) {
		if (repeat_flag) return false;
		repeat_flag = true;
		var field = data.field;
		if(field.is_logo_show == 'on'){
			field.is_logo_show = 1;
		}else{
			field.is_logo_show = 0;
		}
		field.header_left = $("#header").position().left;
		field.header_top = $("#header").position().top;
		field.name_left = $("#name").position().left;
		field.name_top = $("#name").position().top;
		field.logo_left = $("#logo").position().left;
		field.logo_top = $("#logo").position().top;
		field.code_left = $("#code").position().left;
		field.code_top = $("#code").position().top;
		$.ajax({
			type: 'POST',
			url: url,
			data: field,
			dataType: 'JSON',
			success: function(res) {
				layer.msg(res.message);
				setTimeout(function() {
					location.href = ns.url("wechat://shop/wechat/qrcode");
				}, 1000);
				repeat_flag = false;
			}
		});
	});

	/**
	 * 图片上传
	 */
	var posterWidth = 640, posterHeight = 1134;

	var upload = new Upload({
		elem: '#background',
		auto: false,
		choose: function(obj) {
			obj.preview(function(index, file, result) {
				var img = new Image();
				img.onload = function() {
					if (posterWidth == img.width && posterHeight == img.height) {
						obj.upload(index, file);
					} else {
						layer.msg('海报尺寸必须为：' + posterWidth + 'px * ' + posterHeight + 'px');
						return false;
					}
				};
				img.src = result;
			});
		},
		callback: function(res) {
			if (res.code >= 0) {
				$("#imgLogo").attr("src", ns.img(res.data.pic_path));
			}
		}
	});

	/**
	 * 文字颜色
	 */
	colorpicker.render({
		elem: '#font_color', //绑定元素
		color: default_color,
		done: function(color) {
			$(".tdrag-name").css("color", color);
			$("input[name='nick_font_color']").val(color);
		}
	});
	
	/**
	 * 监听字体变化
	 */
	$("input[name=nick_font_size]").blur(function() {
		$("#name").css("fontSize", $(this).val() + "px");
	});

	/**
	 * 表单验证
	 */
	form.verify({
		int: function(value) {
			if (value == "") {
				return false;
			}
			if (value < 0 || !(value % 1 === 0)) {
				return '请输入大于0的整数'
			}
		},
	});

	/**
	 * 是否显示logo
	 */
	form.on('switch(logo)', function(data){
		if(data.elem.checked) {
			//开
			$('#logo').show();
		}else {
			//关
			$('#logo').hide();
		}
	});
	
});

function back() {
	location.href = ns.url("wechat://shop/wechat/qrcode");
}