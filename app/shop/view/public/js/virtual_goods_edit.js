var laytpl, stepTab, element, form, upload, laydate, repeat_flag = false;//防重复标识
var tab = ["basic", "detail", "attr"];
var specSearchableSelectArr = [];//规格项下拉搜索集合
var specValueSearchableSelectArr = [];//规格值下拉搜索集合
var goodsSpecFormat = [];//商品规格格式
var goodsSkuData = [];//商品sku列表
const GOODS_SPEC_MAX = 4;//规格项数量
var goodsContent;//商品详情
var goodsAttrFormat = [];//商品属性json
var goodsImage = [];//商品主图
const GOODS_IMAGE_MAX = 10;//商品主图数量
const GOODS_SKU_MAX = 10;//商品SKU数量
var attribute_img_type = 0;//规格项是否保存图片

//正则表达式
var regExp = {
	number: /^\d{0,10}$/,
	digit: /^\d{0,10}(.?\d{0,2})$/
};

$(function () {

	// $(".fixed-btn").css("width", $(".layui-layout-admin .layui-body").width() - 40);

	//获取hash来切换选项卡
	stepTab = location.hash.replace(/^#tab=/, '');

	goodsContent = UE.getEditor('editor');

	layui.use(['element', 'laytpl', 'form', 'laydate'], function () {
		form = layui.form;
		element = layui.element;
		laytpl = layui.laytpl;
        laydate = layui.laydate;
		form.render();

		// if (stepTab == "")
		stepTab = 'basic';

		element.tabChange('goods_tab', stepTab);

		//渲染商品主图列表
		refreshGoodsImage();

		//监听Tab切换，以改变地址hash值
		element.on('tab(goods_tab)', function () {
			location.hash = 'tab=' + this.getAttribute('lay-id');
			stepTab = this.getAttribute('lay-id');
			refreshStepButton();
		});

		var time = new Date();
		var currentTime = time.toLocaleDateString +" " + time.getHours() +":" + time.getMinutes() +":" + time.getSeconds();
		//定时上架时间
		laydate.render({
			elem: '#timer_on', //指定元素
			type: 'datetime',
			min: currentTime
		});

		//定时下架时间
		laydate.render({
			elem: '#timer_off', //指定元素
			type: 'datetime',
			min: currentTime
		});

		//是否上架
		form.on('radio(goods_state)', function(data){
			value = parseInt(data.value);
			if(value == 0){
				$('.timer_on').remove();
				$('.timer_on_time').remove();
				var html = '<div class="layui-form-item timer_on">' +
					'<label class="layui-form-label">定时上架：</label>' +
					'<div class="layui-input-block">' +
					'<input type="radio" name="timer_on_status" value="1" title="启用" lay-filter="timer_on" checked>' +
					'<input type="radio" name="timer_on_status" value="2" title="不启用" lay-filter="timer_on">' +
					'</div>' +
					'<div class="ns-word-aux">启用定时上架后，到达设定时间，此商品将自动上架。</div>' +
					'</div>' +
					'<div class="layui-form-item timer_on_time">' +
					'<label class="layui-form-label"></label>' +
					'<div class="layui-input-inline">' +
					'<input type="text" id="timer_on" name="timer_on" lay-verify="required" class="layui-input ns-len-mid" autocomplete="off" readonly>' +
					'<i class="ns-calendar"></i>' +
					'</div>' +
					'</div>';
				$('.goods_state').after(html);
				//定时上架时间
				laydate.render({
					elem: '#timer_on', //指定元素
					type: 'datetime',
					min: currentTime
				});
				form.render();
			}else{

				$('.timer_on').remove();
				$('.timer_on_time').remove();
			}
		});

		//定时上架
		form.on('radio(timer_on)', function(data){
			value = parseInt(data.value);
			if(value == 1){
				$('.timer_on_time').removeClass('layui-hide');
				$("input[name='timer_on']").attr("lay-verify", "required");
			}else{
				$("input[name='timer_on']").attr("lay-verify", "");
				$("input[name='timer_on']").val('');
				$('.timer_on_time').addClass('layui-hide');
			}
		});

		//定时下架
		form.on('radio(timer_off)', function(data){
			value = parseInt(data.value);
			if(value == 1){
				$('.timer_off').show();
				$("input[name='timer_off']").attr("lay-verify", "required");
			}else{

				$("input[name='timer_off']").attr("lay-verify", "");
				$("input[name='timer_off']").val('');
				$('.timer_off').hide();
			}
		});

		//编辑商品
		initEditData();
		isNullTable();

		//选择商品分类点击事件
		$("body").on("click", ".category-list .item li", function () {
			var category_id = $(this).attr("data-category-id");
			var level = parseInt($(this).attr("data-level").toString());

			$(this).addClass('selected').siblings("").removeClass("selected");

			if (level < 3) {
				//查询二级商品分类
				getCategoryList(category_id, level, function () {
					refreshCategory();
				});
			} else {
				refreshCategory();
			}

		});

		//启用多规格
		form.on("switch(spec_type)", function (data) {
			var status = data.elem.checked ? 1 : 0;
			if (status) {
				$(".js-more-spec").show();
				$(".js-single-spec").hide();
				$(".js-goods-stock-wrap").hide();
				$("input[name='goods_stock']").attr("disabled", true).val("");
				$("input[name='goods_stock_alarm']").attr("disabled", true).val("");
			} else {
				$(".js-single-spec").show();
				$(".js-more-spec").hide();
				$(".js-goods-stock-wrap").show();
				$("input[name='goods_stock']").removeAttr("disabled");
				$("input[name='goods_stock_alarm']").attr("disabled", true).val("");
			}
		});

		//添加规格项
		$(".js-add-spec button").click(function () {
			addSpec();
		});

		//是否添加规格图片，复选框
		form.on("checkbox(add_spec_img)", function (data) {
			var div = data.othis[0];
			if ($(div).attr("class") == "layui-unselect layui-form-checkbox layui-form-checked") {
				attribute_img_type = 1;
			} else {
				attribute_img_type = 0;
			}
			refreshSpec(false,true);
		});

		// 批量规格操作
		$(".js-more-spec .batch-operation-sku span").click(function () {
			var field = $(this).attr("data-field");
			var verify = $(this).attr("data-verify") || "";
			var placeholder = $(this).text();
			$("input[name='batch_operation_sku']").attr("data-field", field).attr("placeholder", placeholder).attr("data-verify", verify).val("");
			$(".batch-operation-sku span").hide();
			$(".batch-operation-sku input, .batch-operation-sku button").show();
			$(".batch-operation-sku input").focus();
		});

		//批量操作sku输入框
		$(".js-more-spec .batch-operation-sku input").keyup(function (event) {
			if (event.keyCode == 13) $(this).next().click();
		});

		//批量操作确定按钮
		$(".js-more-spec .batch-operation-sku .confirm").click(function () {
			var input = $("input[name='batch_operation_sku']");
			var field = input.attr("data-field");
			var verify = input.attr("data-verify");
			var placeholder = input.attr("placeholder");
			var value = input.val();

			if (value.length == 0) {
				layer.msg("请输入" + placeholder);
				$(this).focus();
				return;
			}
			if (verify) {
				var reg = "";
				switch (verify) {
					// 划线价
					case "market_price":
					// 销售价
					case "price":
					// 成本价
					case "cost_price":
						reg = regExp.digit;
						break;
					// 库存
					case "stock":
					// 库存预警
					case "stock_alarm":
						reg = regExp.number;
						break;
				}
				if (!reg.test(value)) {
					layer.msg('[' + placeholder + ']格式输入错误');
					$(this).focus();
					return;
				}
			}

			//统计库存数量
			var stock = 0;
			var stock_alarm = 0;
			for (var i = 0; i < goodsSkuData.length; i++) {
				goodsSkuData[i][field] = value;
				if (verify == "stock") stock += parseInt(value);
				if (verify == "stock_alarm") stock_alarm += parseInt(stock_alarm);
			}
			if (verify == "stock") {
				$("input[name='goods_stock']").val(stock);
			}
			if (verify == "stock_alarm") {
				$("input[name='goods_stock_alarm']").val(stock_alarm);
			}

			refreshSkuTable();
			$(this).next().click();
		});

		//批量操作取消按钮
		$(".js-more-spec .batch-operation-sku .cancel").click(function () {
			$(".batch-operation-sku input, .batch-operation-sku button").hide();
			$(".batch-operation-sku span").show();
		});

		//添加商品主图
		$("body").on("click", ".js-add-goods-image", function () {
			openAlbum(function (data) {
				for (var i = 0; i < data.length; i++) {
					if (goodsImage.length < GOODS_IMAGE_MAX) goodsImage.push(data[i].pic_path);
				}
				refreshGoodsImage();
			}, GOODS_IMAGE_MAX);
		});

		// 商品类型选择查询属性
		form.on("select(goods_attr_class)", function (data) {
			var is_exsit = isHasAttr(data.value);

			if (is_exsit) delAttrTemplate(data.value);

			if (data.value) {
				$.ajax({
					url: ns.url("shop/goods/getAttributeList"),
					data: {attr_class_id: data.value},
					dataType: 'JSON',
					type: 'POST',
					success: function (res) {
						var list = res.data;
						var attr_template = $("#attrTemplate").html();
						if (goodsAttrFormat.length > 0) {
							for (var i = 0; i < list.length; i++) {
								if (list[i].attr_type == 1 || list[i].attr_type == 2) {
									for (var j = 0; j < list[i].attr_value_format.length; j++) {
										for (var k = 0; k < goodsAttrFormat.length; k++) {
											// 单选、多选
											if (list[i].attr_value_format[j].attr_value_id == goodsAttrFormat[k].attr_value_id) {
												list[i].attr_value_format[j].checked = true;
												list[i].sort = goodsAttrFormat[k].sort;
											}
										}
									}
								} else if (list[i].attr_type == 3) {
									for (var k = 0; k < goodsAttrFormat.length; k++) {
										if (list[i].attr_id == goodsAttrFormat[k].attr_id) {
											list[i].attr_value_format = goodsAttrFormat[k].attr_value_name;
											list[i].sort = goodsAttrFormat[k].sort;
										}
									}
								}
							}
						}
						var data = {
							list: list
						};
						laytpl(attr_template).render(data, function (html) {
							$(".ns-attr-new tr[data-attr-class-id][data-attr-class-id!='" + data.value + "']").remove();
							$(".ns-attr-new").append(html);
							form.render();
							isNullTable();
						});

					}
				});

				if (data.value) $("input[name='goods_attr_name']").val($(data.elem).find("option:selected").text());
			} else {
				goodsAttrFormat = [];
				$(".ns-attr-new .goods-attr-temp").each(function () {
					$(this).remove();
				});
				isNullTable();
				$("input[name='goods_attr_format']").val("");
			}
		});

		var upload = new Upload({
			elem: '#videoUpload',
			url: ns.url("shop/upload/video"),
			accept: "video",
			callback:function (res) {
				if (res.code >= 0) {
					$("input[name='video_url']").val(res.data.path);
					loadVideo();
				}
			}
		});

		//视频地址输入加载
		$("input[name='video_url']").blur(function () {
			loadVideo();
		});

		//上一步
		form.on('submit(prev)', function (data) {
			var prev = tab[tab.indexOf(stepTab) - 1];
			if (prev) element.tabChange('goods_tab', prev);
			refreshStepButton();
			return false;

		});

		//下一步
		form.on('submit(next)', function (data) {
			var next = tab[tab.indexOf(stepTab) + 1];

			if (next == 'detail') {

				if (goodsImage.length == 0) {
					layer.msg("请上传商品主图");
					element.tabChange('goods_tab', "basic");
					return false;
				}

				if ($("input[name='add_spec_img']").is(":checked")) {
					for(var i=0;i<goodsSpecFormat[0].value.length;i++){
						if(goodsSpecFormat[0].value[i].image == ''){
							layer.msg("请上传规格图片");
							element.tabChange('goods_tab', "basic");
							return false;
						}
					}
					// for (var i = 0; i < goodsSkuData.length; i++) {
					// 	for (var j = 0; j < goodsSkuData[i].sku_spec_format.length; j++) {
					// 		if (goodsSkuData[i].sku_spec_format[j].image == "") {
					// 			layer.msg("请上传规格图片");
					// 			element.tabChange('goods_tab', "basic");
					// 			return false;
					// 		}
					// 	}
					// }
				}

				// if ($("input[name='spec_type']").is(":checked")) {
				// 	for (var i = 0; i < goodsSkuData.length; i++) {
				// 		if (goodsSkuData[i].sku_image == "") {
				// 			layer.msg("请上传SKU商品图片");
				// 			element.tabChange('goods_tab', "basic");
				// 			return false;
				// 		}
				// 	}
				// }
			}

			if (next) element.tabChange('goods_tab', next);
			refreshStepButton();
			return false;

		});

		form.verify({
			//商品名称
			goods_name: function (value) {
				if (value.length == 0) {
					element.tabChange('goods_tab', "basic");
					return "请输入商品名称";
				}
				if (value.length > 60) {
					element.tabChange('goods_tab', "basic");
					return "商品名称不能超过60个字符";
				}
			},
			//促销语
			introduction: function (value) {
				if (value.length > 100) {
					element.tabChange('goods_tab', "basic");
					return '促销语不能超过100个字符';
				}
			},
			//有效期
			virtual_indate: function (value) {
				if (value.length == 0) {
					element.tabChange('goods_tab', "basic");
					return "请输入有效期";
				}

				if (isNaN(value) || !regExp.number.test(value)) {
					element.tabChange('goods_tab', "basic");
					return '[有效期]格式输入错误';
				}
			},
			//销售价
			price: function (value) {
				if (!$("input[name='spec_type']").is(":checked")) {
					if (value.length == 0) {
						element.tabChange('goods_tab', "basic");
						return "请输入销售价";
					}

					if (isNaN(value) || !regExp.digit.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[销售价]格式输入错误';
					}

				}
			},
			//划线价
			market_price: function (value) {
				if (!$("input[name='spec_type']").is(":checked")) {
					if (value.length > 0) {
						if (isNaN(value) || !regExp.digit.test(value)) {
							element.tabChange('goods_tab', "basic");
							return '[划线价]格式输入错误';
						}
					}
				}
			},
			//成本价
			cost_price: function (value) {
				if (!$("input[name='spec_type']").is(":checked")) {
					if (value.length > 0) {
						if (isNaN(value) || !regExp.digit.test(value)) {
							element.tabChange('goods_tab', "basic");
							return '[成本价]格式输入错误';
						}
					}
				}
			},
			// 总库存
			goods_stock: function (value) {
				if (value.length == 0) {
					element.tabChange('goods_tab', "basic");
					return "请输入库存";
				}
				if (isNaN(value) || !regExp.number.test(value)) {
					element.tabChange('goods_tab', "basic");
					return '[库存]格式输入错误';
				}
			},
			// 库存预警
			goods_stock_alarm: function (value) {
				if (value.length > 0) {
					var goods_stock = parseInt($("input[name='goods_stock']").val().toString());
					if (isNaN(value) || !regExp.number.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[库存预警]格式输入错误';
					}
					if (parseInt(value) != 0 && parseInt(value) === goods_stock) {
						element.tabChange('goods_tab', "basic");
						return '[库存预警]不能等于库存数量';
					}
					if (parseInt(value) > goods_stock) {
						element.tabChange('goods_tab', "basic");
						return '[库存预警]不能超过库存数量';
					}
				}
			},
			//sku销售价
			sku_price: function (value) {
				if (value.length == 0) {
					element.tabChange('goods_tab', "basic");
					return "请输入销售价";
				}
				if (isNaN(value) || !regExp.digit.test(value)) {
					element.tabChange('goods_tab', "basic");
					return '[销售价]格式输入错误';
				}
			},
			//sku划线价
			sku_market_price: function (value) {
				if (value.length > 0) {
					if (isNaN(value) || !regExp.digit.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[划线价]格式输入错误';
					}
				}
			},
			//sku成本价
			sku_cost_price: function (value) {
				if (value.length > 0) {
					if (isNaN(value) || !regExp.digit.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[成本价]格式输入错误';
					}
				}
			},
			//sku库存
			sku_stock: function (value) {
				if (value.length == 0) {
					element.tabChange('goods_tab', "basic");
					return "请输入库存";
				}
				if (isNaN(value) || !regExp.number.test(value)) {
					element.tabChange('goods_tab', "basic");
					return '[库存]格式输入错误';
				}
			},
			//sku库存预警
			sku_stock_alarm: function (value, obj) {
				if (value.length > 0) {
					if (isNaN(value) || !regExp.digit.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[库存预警]格式输入错误';
					}

					var sku_stock = parseInt($("input[name='stock'][data-index='" + $(obj).attr("data-index") + "']").val().toString());
					if (parseInt(value) != 0 && parseInt(value) === sku_stock) {
						element.tabChange('goods_tab', "basic");
						return '[库存预警]不能等于库存数量';
					}
					if (parseInt(value) > sku_stock) {
						element.tabChange('goods_tab', "basic");
						return '[库存预警]不能超过库存数量';
					}

				}
			},
			// 开启多规格后，必须编辑规格信息
			spec_type: function (value) {
				if ($("input[name='spec_type']").is(":checked")) {
					if (goodsSkuData.length == 0) {
						element.tabChange('goods_tab', "basic");
						return '请编辑规格信息';
					} else {
						var flag = false;
						for (var i = 0; i < goodsSkuData.length; i++) {
							if (goodsSkuData[i].sku_spec_format.length != $(".spec-edit-list .spec-item").length) {
								flag = true;
								break;
							}
						}
						if (flag) {
							element.tabChange('goods_tab', "basic");
							return '请编辑规格信息';
						}
					}
				}
			},
			// 已售出数量
			virtual_sale: function (value) {
				if (value.length > 0) {
					if (isNaN(value) || !regExp.number.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[已售出数量]格式输入错误';
					}
					if (value < 0) {
						element.tabChange('goods_tab', "basic");
						return '已售出数量不能小于0';
					}
				}
			},
			// 限购
			max_buy: function (value) {
				if (value.length > 0) {
					if (isNaN(value) || !regExp.number.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[限购]格式输入错误';
					}
					if (value < 0) {
						element.tabChange('goods_tab', "basic");
						return '限购数量不能小于0';
					}
				}
			},
			// 起购数
			min_buy: function (value) {
				if (value.length > 0) {
					if (isNaN(value) || !regExp.number.test(value)) {
						element.tabChange('goods_tab', "basic");
						return '[起售]格式输入错误';
					}
					if (value < 0) {
						element.tabChange('goods_tab', "basic");
						return '起售数量不能小于0';
					}
					if (parseInt(value) > parseInt($('[name="max_buy"]').val()) && $('[name="max_buy"]').val() > 0) {
						element.tabChange('goods_tab', "basic");
						return '起售数量不能大于限购数量';
					}
				}
			}
		});

		form.on('submit(save)', function (data) {

			if (goodsImage.length == 0) {
				layer.msg("请上传商品主图");
				element.tabChange('goods_tab', "basic");
				return false;
			}

			// 商品分类
			var category_id = [];
			$(".ns-goods-cate .layui-block").each(function () {
				var cate_id = $(this).find(".category_id").val();
				category_id.push(cate_id);
			});
			data.field.category_id = category_id;

			if ($("input[name='goods_service_ids']:checked").length) {
				data.field.goods_service_ids = [];
				$("input[name='goods_service_ids']:checked").each(function () {
					data.field.goods_service_ids.push($(this).val());
				});
				data.field.goods_service_ids = data.field.goods_service_ids.toString();
			}

			if ($("input[name='add_spec_img']").is(":checked")) {
				for(var i=0;i<goodsSpecFormat[0].value.length;i++){
					if(goodsSpecFormat[0].value[i].image == ''){
						layer.msg("请上传规格图片");
						element.tabChange('goods_tab', "basic");
						return false;
					}
				}
				// for (var i = 0; i < goodsSkuData.length; i++) {
				// 	for (var j = 0; j < goodsSkuData[i].sku_spec_format.length; j++) {
				// 		if (goodsSkuData[i].sku_spec_format[j].image == "") {
				// 			layer.msg("请上传规格图片");
				// 			element.tabChange('goods_tab', "basic");
				// 			return false;
				// 		}
				// 	}
				// }
			}

			// if ($("input[name='spec_type']").is(":checked")) {
			// 	for (var i = 0; i < goodsSkuData.length; i++) {
			// 		if (goodsSkuData[i].sku_image == "") {
			// 			layer.msg("请上传SKU商品图片");
			// 			element.tabChange('goods_tab', "basic");
			// 			return false;
			// 		}
			// 	}
			// }

			var goods_content = goodsContent.getContent();

			if (goods_content == "") {
				layer.msg("请填写商品详情");
				element.tabChange('goods_tab', "detail");
				return false;
			} else if (goods_content.length < 5 || goods_content.length > 25000) {
				$(".goods-nav ul li:eq(3)").click();
				layer.msg("商品描述字符数应在5～25000之间");
				element.tabChange('goods_tab', "detail");
				return false;
			}

			data.field.goods_content = goods_content;//商品详情
			data.field.goods_image = goodsImage.toString();//商品主图

			//刷新商品属性格式json
			refreshGoodsAttrData();

            //商品sku列表
            var spec_type = 0;
            if($("input[name='spec_type']").is(":checked")){
                spec_type = 1;
            }
            if (spec_type == 0) {
				//单规格
				var sku_data = JSON.stringify([{
					sku_id: (data.field.goods_id ? $("input[name='edit_sku_id']").val() : 0),
					sku_name: data.field.goods_name,
					spec_name: '',
					sku_no: data.field.sku_no,
					sku_spec_format: '',
					price: data.field.price,
					market_price: data.field.market_price,
					cost_price: data.field.cost_price,
					stock: data.field.goods_stock,
					stock_alarm: data.field.goods_stock_alarm,
					sku_image: goodsImage[0],
					sku_images: data.field.goods_image
				}]);
				data.field.goods_sku_data = sku_data;
                data.field.goods_spec_format = '';
            } else {
				//多规格
				data.field.goods_sku_data = JSON.stringify(goodsSkuData);
                if (goodsSpecFormat.length) data.field.goods_spec_format = JSON.stringify(goodsSpecFormat);//商品规格格式
            }

            var spec_type_status = $('#spec_type_status').val();
            if(spec_type_status == spec_type){
                data.field.spec_type_status = 0;
            }else{
                data.field.spec_type_status = 1;
            }

			// 属性模板
			$(".ns-attr-new .goods-attr-temp").each(function() {
				var attr_class_id = $(this).attr("data-attr-class-id");
				var attr_id = $(this).attr("data-attr-id");
				var sort = $(this).find(".attr-sort").val();

				$.each(goodsAttrFormat, function(index, item) {
					if (item.attr_class_id == attr_class_id && item.attr_id == attr_id) {
						item.sort = sort;
					}
				})
			})

			// 自定义属性
			$(".ns-attr-new .goods-new-attr-tr").each(function (i) {
				var attr_name = $(this).find(".add-attr-name").val();
				var attr_value = $(this).find(".add-attr-value").val();
				var sort = $(this).find(".add-attr-sort").val();
				var attr = {};
				if (attr_name != "" && attr_value != "") {
					attr.attr_class_id = -(i + Math.floor(new Date().getSeconds()) + Math.floor(new Date().getMilliseconds()));
					attr.attr_id = attr.attr_class_id + -(i + Math.floor(new Date().getSeconds()) + Math.floor(new Date().getMilliseconds()));
					attr.attr_name = attr_name;
					attr.attr_value_id = attr.attr_id + -(i + Math.floor(new Date().getSeconds()) + Math.floor(new Date().getMilliseconds()));
					attr.attr_value_name = attr_value;
					attr.sort = sort;
					goodsAttrFormat.push(attr);
				}
			});

			if (goodsAttrFormat.length) data.field.goods_attr_format = JSON.stringify(goodsAttrFormat);//商品属性格式

			// console.log(data);return;

			if (repeat_flag) return false;
			repeat_flag = true;

			var url = ns.url("shop/virtualgoods/addGoods");
			if (data.field.goods_id) url = ns.url("shop/virtualgoods/editGoods");

			$.ajax({
				url: url,
				data: data.field,
				dataType: 'JSON',
				type: 'POST',
				success: function (data) {
					layer.msg(data.message);
					if (data.code == 0) {
						location.href = ns.url("shop/goods/lists");
					} else {
						repeat_flag = false;
					}
				}
			});
		});

	});

});

//商品分类弹出框
var isOpenSelectedCategoryPopup = false;//防止重复弹出商品分类框
function selectedCategoryPopup(obj) {
	var parent = $(obj).parents(".layui-block");
	var i = $(obj).parents(".layui-block").index();
	if (isOpenSelectedCategoryPopup) return;
	var selected_category = $("#selectedCategory").html();
	var data = {
		category_id: $(parent).find(".category_id").val(),
		category_id_1: $(parent).find(".category_id_1").val(),
		category_id_2: $(parent).find(".category_id_2").val(),
		category_id_3: $(parent).find(".category_id_3").val()
	};
	laytpl(selected_category).render(data, function (html) {
		var layerIndex = layer.open({
			title: '选择商品分类',
			skin: 'layer-tips-class',
			type: 1,
			area: ['810px', '500px'],
			content: html,
			btn: ['保存', '关闭'],
			yes: function () {
				refreshCategory(obj, true);
				var li_level_1 = 0, li_level_2 = 0, li_level_3 = 0, id_1 = "", id_2 = "", id_3 = "",
					len_level_1 = $(".category-list .item li[data-level=1]").length;
				len_level_2 = $(".category-list .item li[data-level=2]").length;
				len_level_3 = $(".category-list .item li[data-level=3]").length;

				$(".category-list .item li[data-level=1]").each(function () {
					if ($(this).hasClass("selected")) {
						li_level_1 = 1;
						id_1 = $(this).attr("data-category-id");
					}
				});

				$(".category-list .item li[data-level=2]").each(function () {
					if ($(this).hasClass("selected")) {
						li_level_2 = 1;
						id_2 = $(this).attr("data-category-id");
					}
				});

				$(".category-list .item li[data-level=3]").each(function () {
					if ($(this).hasClass("selected")) {
						li_level_3 = 1;
						id_3 = $(this).attr("data-category-id");
					}
				});

				if (len_level_1 == 0) {
					layer.msg("暂无商品分类，请先添加商品分类");
					return;
				} else if (li_level_1 == 0 && len_level_1 != 0) {
					layer.msg("请选择商品分类");
					return;
				} else if (li_level_2 == 0 && len_level_2 != 0) {
					// layer.msg("请选择二级分类");
					// return;
				} else if (li_level_3 == 0 && len_level_3 != 0) {
					// layer.msg("请选择三级分类");
					// return;
				}

				var bool = false;
				$(".layui-block").each(function () {
					var cate_id_1 = $(this).find(".category_id_1").val(),
						cate_id_2 = $(this).find(".category_id_2").val(),
						cate_id_3 = $(this).find(".category_id_3").val();
					var j = $(this).index();

					if (cate_id_1 == id_1 && cate_id_2 == id_2 && cate_id_3 == id_3 && i != j) bool = true;
				});

				if (bool) {
					layer.msg("该分类已被选中");
					refreshCategory(obj, bool);
					return;
				} else {
					refreshCategory(obj, false);
				}

				layer.close(layerIndex);
				isOpenSelectedCategoryPopup = false;
			},
			btn2: function () {
				isOpenSelectedCategoryPopup = false;
			},
			cancel: function (index, layero) {
				isOpenSelectedCategoryPopup = false;
			},
			success: function () {
				isOpenSelectedCategoryPopup = true;
				if (data.category_id_1) {

					//查询二级商品分类
					getCategoryList(data.category_id_1, 1, function () {
						if (data.category_id_2) {
							$(".category-list .item li[data-level='2'][data-category-id='" + data.category_id_2 + "']").addClass('selected').siblings("").removeClass("selected");

							//查询三级分类
							getCategoryList(data.category_id_2, 2, function () {
								if (data.category_id_3) {
									$(".category-list .item li[data-level='3'][data-category-id='" + data.category_id_3 + "']").addClass('selected').siblings("").removeClass("selected");
								}
								refreshCategory(obj);
							});

						}
						refreshCategory(obj);
					});
				}

			}
		});
	});
}

// 添加商品分类
function addCategory() {
	if ($(".ns-goods-cate .layui-block").length < 10) {
		var html = `<div class="layui-block">
			<div class="layui-input-inline ns-cate-input-defalut">
			<input type="text" readonly onfocus="selectedCategoryPopup(this)" lay-verify="required" autocomplete="off" class="layui-input ns-len-mid category_name" />
			<input type="hidden" class="category_id" />
			<input type="hidden" class="category_id_1" />
			<input type="hidden" class="category_id_2" />
			<input type="hidden" class="category_id_3" />
			<button class="layui-btn layui-btn-primary" onclick="selectedCategoryPopup(this)">选择</button>
			</div>
			<a href="#" class="default ns-text-color ns-input-text" onclick="delCategory(this)">删除</a>
			</div>`;

		$(".ns-goods-cate").append(html);
	}
	refreshAddCategory();
}

// 删除商品分类
function delCategory(obj) {
	$(obj).parents(".layui-block").remove();
	refreshAddCategory();
}

// 刷新添加商品分类按钮是否显示
function refreshAddCategory() {
	if ($(".ns-goods-cate .layui-block").length < 10) {
		$(".js-add-category").show();
	} else {
		$(".js-add-category").hide();
	}
}

/**
 * 获取商品分类列表
 * @param category_id 分类id
 * @param level 层级
 * @param callback 回调
 */
function getCategoryList(category_id, level, callback) {

	level = parseInt(level) + 1;

	$.ajax({
		url: ns.url("shop/goods/getCategoryList"),
		data: {category_id: category_id},
		dataType: 'json',
		type: 'post',
		success: function (res) {
			var data = res.data;
			if (data) {
				var h = '';
				for (var i = 0; i < data.length; i++) {

					h += '<li data-category-id="' + data[i].category_id + '" data-commission-rate="' + data[i].commission_rate + '" data-level="' + data[i].level + '">';
					h += '<span class="category-name">' + data[i].category_name + '</span>';
					h += '<span class="right-arrow"></span>';
					h += '</li>';

				}

				if (level == 2) {
					$(".category-list .item[data-level='3'] ul").html("");
				}
				$(".category-list .item[data-level='" + level + "'] ul").html(h);

				if (callback) callback();

			}
		}
	});
}

//刷新商品分类数据
function refreshCategory(obj, bool) {
	if (bool) {
		return;
	}

	var parent = $(obj).parents(".layui-block");
	var li = $(".category-list .item li.selected");

	if (li.length > 0) {
		$(parent).find(".category_id").val("");
		$(parent).find(".category_id_1").val("");
		$(parent).find(".category_id_2").val("");
		$(parent).find(".category_id_3").val("");

		var selected = [];//已选商品分类
		var selected_id = []; // 已选商品分类id

		li.each(function (i) {
			selected.push($(this).children(".category-name").text());
			var level = $(this).attr("data-level");
			var category_id = $(this).attr("data-category-id");
			$(parent).find(".category_id_" + level).val(category_id);
			selected_id.push(category_id);
		});

		$(parent).find(".category_id").val(selected_id);
		$(".js-selected-category").html(selected.join(`<span class="right-arrow"></span>`));
		$(parent).find(".category_name").val(selected.join("/"));
	}

}

//刷新步骤按钮
function refreshStepButton() {
	var index = tab.indexOf(location.hash.replace(/^#tab=/, '')) + 1;
	switch (index) {
		case 1:
			$(".js-prev").hide();
			$(".js-next").show();
			break;
		case 2:
			$(".js-prev").show();
			$(".js-next").show();
			break;
		case 3:
			$(".js-prev").show();
			$(".js-next").hide();
			break;
	}
}

//添加规格项
function addSpec() {

	if (goodsSpecFormat.length < GOODS_SPEC_MAX) {
		var spec_id = -(($(".spec-edit-list .spec-item").length - 1) + Math.floor(new Date().getSeconds()) + Math.floor(new Date().getMilliseconds()));
		var spec = {
			spec_id: spec_id,
			spec_name: "",
			value: []
		};

		goodsSpecFormat.push(spec);
		refreshSpec();

		if (goodsSpecFormat.length >= GOODS_SPEC_MAX) $(".js-add-spec").hide();
	} else {
		$(".js-add-spec").hide();
	}

}

/**
 * 刷新规格数据
 * @param isCheckedAddSpecImg 是否选择规格商品
 * @param isRefreshSkuData 是否刷新规格数据，false：刷新，true：不刷新
 */
function refreshSpec(isCheckedAddSpecImg,isRefreshSkuData) {

	var spec_template = $("#specTemplate").html();

	if (isCheckedAddSpecImg){
		attribute_img_type = 1;
		$("input[name='add_spec_img']").prop("checked", isCheckedAddSpecImg);
	}else{
		isCheckedAddSpecImg = $("input[name='add_spec_img']").is(":checked");
	}

	var data = {
		list: goodsSpecFormat,
		add_spec_img: isCheckedAddSpecImg
	};

	laytpl(spec_template).render(data, function (html) {
		$(".spec-edit-list").html(html);
		form.render();

		// 只有添加时可以进行拖拽
		// if ($("input[name='goods_id']").length == 0) {
		// 规格项拖拽
		$('.spec-edit-list .spec-item').arrangeable({
			//拖拽结束后执行回调
			callback: function (e) {
				var indexBefore = $(e).attr("data-index");//拖拽前的原始位置
				var indexAfter = $(e).index();//拖拽后的位置

				var temp = goodsSpecFormat[indexBefore];
				goodsSpecFormat[indexBefore] = goodsSpecFormat[indexAfter];
				goodsSpecFormat[indexAfter] = temp;

				refreshSpec();
			}
		});
		// }

		//删除规格项
		$(".spec-edit-list .spec-item .spec .layui-icon-close").click(function () {
			var index = $(this).attr("data-index");
			goodsSpecFormat.splice(index, 1);
			refreshSpec();
		});

		//添加规格值
		$(".spec-edit-list .spec-item .spec-value > a").click(function () {
			var index = $(this).attr("data-index");
			$(".spec-edit-list .spec-item .add-spec-value-popup").hide();
			$(".spec-edit-list .spec-item[data-index='" + index + "'] .add-spec-value-popup").show();
			//根据当前规格项查询规格值列表
			setTimeout(function () {
				specValueSearchableSelectArr[index].show();
			}, 1);

		});

		//删除规格值
		$(".spec-edit-list .spec-item .spec-value .layui-icon-close").click(function () {
			var parentIndex = $(this).attr("data-parent-index");
			var index = $(this).attr("data-index");
			goodsSpecFormat[parentIndex].value.splice(index, 1);
			refreshSpec();
		});

		//取消
		$(".js-cancel-spec-value").click(function () {
			$(this).parent().hide();
		});

		// 只有添加时可以进行拖拽
		// if ($("input[name='goods_id']").length == 0) {
		// 规格值拖拽
		$(".spec-edit-list .spec-item .spec-value ul li").arrangeable({
			//拖拽结束后执行回调
			callback: function (e) {
				var parentIndex = $(e).attr("data-parent-index");//父级下标
				var temp = JSON.parse(JSON.stringify(goodsSpecFormat[parentIndex].value));
				$(".spec-edit-list .spec-item[data-index='" + parentIndex + "'] .spec-value ul li").each(function () {
					var indexBefore = $(this).attr("data-index");//拖拽前的原始位置
					var indexAfter = $(this).index();//拖拽后的位置
					goodsSpecFormat[parentIndex].value[indexAfter] = temp[indexBefore];
				});

				refreshSpec();
			}
		});
		// }

		//规格值上传图片
		$(".spec-edit-list .spec-item .spec-value ul li .img-wrap").click(function () {
			var parentIndex = $(this).parent().attr("data-parent-index");
			var index = $(this).parent().attr("data-index");
			openAlbum(function (data) {
				for (var i = 0; i < data.length; i++) {
					goodsSpecFormat[parentIndex].value[index].image = data[i].pic_path;
				}
				refreshSpec(false,true);
			}, 1);
		});

		if (attribute_img_type == 0) {
			for (var q = 0; q < goodsSpecFormat.length; q++) {
				for (var r = 0; r < goodsSpecFormat[q]["value"].length; r++) {
					goodsSpecFormat[q]["value"][r]["image"] = "";
				}
			}
		}

		//绑定规格项下拉搜索
		bindSpecSearchableSelect();

		//绑定规格值下拉搜索
		bindSpecValueSearchableSelect();

		//刷新SKU列表
		if(!isRefreshSkuData) refreshGoodsSkuData();

		//刷新SKU表格
		refreshSkuTable();

	});
}

//刷新规格表格
function refreshSkuTable() {

	var sku_template = $("#skuTableTemplate").html();
	var length = 0;
	//统计有效规格数量
	for (var i = 0; i < goodsSpecFormat.length; i++) {
		if (goodsSpecFormat[i].spec_name != '' && goodsSpecFormat[i].value.length > 0) {
			length++;
		}
	}

	var colSpan = length == 0 ? 1 : length;
	var rowSpan = colSpan == 1 ? 1 : 2;

	if (goodsSkuData.length) {
		$(".js-more-spec .batch-operation-sku").show();
		$(".sku-table").show();
	} else {
		$(".js-more-spec .batch-operation-sku").hide();
		$(".sku-table").hide();
	}

	var showSpecName = true;
	for (var j = 0; j < goodsSkuData.length; j++) {
		if (goodsSkuData[j].sku_spec_format.length != $(".spec-edit-list .spec-item").length) {
			showSpecName = false;
			break;
		}
	}

	var data = {
		specList: goodsSpecFormat,
		skuList: goodsSkuData,
		colSpan: colSpan,
		rowSpan: rowSpan,
		length: length,
		goods_sku_max: GOODS_SKU_MAX,
		showSpecName: showSpecName
	};

	laytpl(sku_template).render(data, function (html) {
		$(".sku-table .layui-input-block").html(html);
		form.render();
		if (showSpecName) {
			var c_n = 1;
			for (var x = length - 1; x >= 0; x--) {

				for (var i = 0; i < goodsSkuData.length;) {
					if (goodsSpecFormat[x]['value'].length > 0) {
						for (ele of goodsSpecFormat[x]['value']) {
							$('.sku-table .layui-input-block table tbody tr:eq(' + i + ')').prepend('<td rowspan="' + c_n + '">' + ele.spec_value_name + '</td>');
							i = i + c_n;
						}
					} else {
						i++;
					}
				}
				c_n = c_n * goodsSpecFormat[x]['value'].length;
			}
		}

		//加载图片放大
		loadImgMagnify();

		//绑定SKU列表中输入框键盘事件
		$(".sku-table .layui-input-block input").keyup(function () {
			var index = $(this).attr("data-index");
			var field = $(this).attr("name");
			var value = $(this).val();
			goodsSkuData[index][field] = value;
			//规格特殊处理
			if (field == "stock") {
				var stock = 0;
				//统计库存数量
				$(".sku-table .layui-input-block input[name='stock']").each(function () {
					if ($(this).val()) stock += parseInt($(this).val().toString());
				});
				$("input[name='goods_stock']").val(stock);
			}

			if (field == "stock_alarm") {
				var stock_alarm = 0;
				//统计库存数量
				$(".sku-table .layui-input-block input[name='stock_alarm']").each(function () {
					if ($(this).val()) stock_alarm += parseInt($(this).val().toString());
				});
				$("input[name='goods_stock_alarm']").val(stock_alarm);
			}

		}).blur(function () {
			$(this).keyup();
		});

		$(".sku-table .layui-input-block input[name='is_default']").each(function () {
			var index = $(this).attr("data-index");
			goodsSkuData[index]['is_default'] = 0;

			form.on('switch(is_default_'+ index +')', function(data){
				if(data.elem.checked) {
					goodsSkuData[index]['is_default'] = 1;

					$(".sku-table .layui-input-block input[name='is_default']").each(function () {
						var i = $(this).attr("data-index");

						if (i != index) {
							$(this).prop('checked', false);
							form.render();
							goodsSkuData[i]['is_default'] = 0;
						}
					});
				}
			});
		});

		//SKU图片放大预览
		$(".sku-table .layui-input-block .img-wrap .operation .js-preview").click(function () {
			$(this).parent().prev().find("img").click();
		});

		//SKU图片删除
		$(".sku-table .layui-input-block .img-wrap .operation .js-delete").click(function () {
			var index = $(this).parent().parent().attr("data-index");
			var parentIndex = $(this).parent().parent().attr("data-parent-index");
			goodsSkuData[parentIndex].sku_images_arr.splice(index, 1);
			if (goodsSkuData[parentIndex].sku_images_arr.length == 0) goodsSkuData[parentIndex].sku_image = "";
			goodsSkuData[parentIndex].sku_images = goodsSkuData[parentIndex].sku_images_arr.toString();
			refreshSkuTable();
		});

		//SKU上传图片
		$(".sku-table .layui-input-block .upload-sku-img").click(function () {
			var index = $(this).attr("data-index");
			openAlbum(function (data) {
				for (var i = 0; i < data.length; i++) {
					if (goodsSkuData[index].sku_images_arr.length < GOODS_SKU_MAX) goodsSkuData[index].sku_images_arr.push(data[i].pic_path)
				}
				goodsSkuData[index].sku_image = goodsSkuData[index].sku_images_arr[0];
				goodsSkuData[index].sku_images = goodsSkuData[index].sku_images_arr.toString();
				refreshSkuTable();
			}, GOODS_SKU_MAX);
		});

		// SKU商品图片拖拽排序
		$('.sku-table .img-wrap').arrangeable({
			//拖拽结束后执行回调
			callback: function (e) {
				var parentIndex = $(e).attr("data-parent-index");//拖拽前的原始位置
				var indexBefore = $(e).attr("data-index");//拖拽前的原始位置
				var indexAfter = $(e).index();//拖拽后的位置
				var temp = goodsSkuData[parentIndex].sku_images_arr[indexBefore];
				goodsSkuData[parentIndex].sku_images_arr[indexBefore] = goodsSkuData[parentIndex].sku_images_arr[indexAfter];
				goodsSkuData[parentIndex].sku_images_arr[indexAfter] = temp;
				goodsSkuData[parentIndex].sku_image = goodsSkuData[parentIndex].sku_images_arr[0];
				goodsSkuData[parentIndex].sku_images = goodsSkuData[parentIndex].sku_images_arr.toString();
			}
		});

	});
}

//刷新商品sku数据
refreshGoodsSkuData = function () {

	var arr = goodsSpecFormat;
	var tempGoodsSkuData = JSON.parse(JSON.stringify(goodsSkuData));// 记录原始数据，后续用作对比
	goodsSkuData = [];
	for (var ele_1 of arr) {
		var item_prop_arr = [];
		if (goodsSkuData.length > 0) {

			for (var ele_2 of goodsSkuData) {

				for (var ele_3 of ele_1['value']) {

					var sku_spec_format = JSON.parse(JSON.stringify(ele_2.sku_spec_format));// 防止对象引用
					sku_spec_format.push(ele_3);
					var item = {
						spec_name: `${ele_2.spec_name} ${ele_3.spec_value_name}`,
						sku_no: "",
						sku_spec_format: sku_spec_format,
						price: "",
						market_price: "",
						cost_price: "",
						stock: "",
						stock_alarm: "",
						sku_image: "",
						sku_images: "",
						sku_images_arr: [],
						is_default: 0
					};
					item_prop_arr.push(item);
				}
			}
		} else {
			for (var ele_3 of ele_1['value']) {

				var spec_name = ele_3.spec_value_name;
				var item = {
					spec_name: spec_name,
					sku_no: "",
					sku_spec_format: [ele_3],
					price: "",
					market_price: "",
					cost_price: "",
					stock: "",
					stock_alarm: "",
					sku_image: "",
					sku_images: "",
					sku_images_arr: [],
					is_default: 0
				};
				item_prop_arr.push(item);
			}
		}

		goodsSkuData = item_prop_arr.length > 0 ? item_prop_arr : goodsSkuData;
	}

	// 比对已存在的规格项/值，并且赋值
	for (var i=0;i<tempGoodsSkuData.length;i++) {
		for (var j=0;j<goodsSkuData.length;j++) {
			if(tempGoodsSkuData[i].spec_name == goodsSkuData[j].spec_name){
				goodsSkuData[j] = tempGoodsSkuData[i];
				break;
			}
		}
	}

	// if ($("input[name='goods_id']").length == 1) {
	// 	$(".js-edit-sku-list>div").each(function (i) {
	// 		goodsSkuData[i].sku_id = $(this).children("input[name='edit_sku_id']").val();
	// 		if (!goodsSkuData[i].sku_image) goodsSkuData[i].sku_image = $(this).children("input[name='edit_sku_image']").val();
	// 		if (!goodsSkuData[i].sku_no) goodsSkuData[i].sku_no = $(this).children("input[name='edit_sku_no']").val();
	// 		if (!goodsSkuData[i].sku_spec_format) goodsSkuData[i].sku_spec_format = $(this).children("input[name='edit_sku_spec_format']").val();
	// 		if (!goodsSkuData[i].price) goodsSkuData[i].price = $(this).children("input[name='edit_price']").val();
	// 		if (!goodsSkuData[i].market_price) goodsSkuData[i].market_price = $(this).children("input[name='edit_market_price']").val();
	// 		if (!goodsSkuData[i].cost_price) goodsSkuData[i].cost_price = $(this).children("input[name='edit_cost_price']").val();
	// 		if (!goodsSkuData[i].stock) goodsSkuData[i].stock = $(this).children("input[name='edit_stock']").val();
	// 		if (!goodsSkuData[i].sku_images) goodsSkuData[i].sku_images = $(this).children("input[name='edit_sku_images']").val();
	// 		if (goodsSkuData[i].sku_images_arr.length === 0) goodsSkuData[i].sku_images_arr = $(this).children("input[name='edit_sku_images']").val() ? $(this).children("input[name='edit_sku_images']").val().split(",") : [];
	// 	});
	// }

	return goodsSkuData;
};

//绑定规格项下拉搜索
function bindSpecSearchableSelect() {

	//规格项搜索
	specSearchableSelectArr = [];

	$(".spec-edit-list .spec-item").each(function (i) {
		var _this = this;
		var options = {
			placeholder: "输入规格项，按回车键完成",
			//回车回调
			enterCallback: function (input) {
				var selected = input.next().find(".searchable-select-item.selected");//搜索到到规格
				var spec_id = -(($(".spec-edit-list .spec-item").length - 1) + Math.floor(new Date().getSeconds()) + Math.floor(new Date().getMilliseconds()));
				var spec_name = input.val().trim();
				if (spec_name.length == 0) {
					layer.msg("请输入规格项");
					return;
				}

				var options = '<option value="' + spec_id + '" data-attr-name="' + spec_name + '">' + spec_name + '</option>';
				$(_this).find("select[name='spec_item']").html(options);
				specSearchableSelectArr[i].buildItems();
				goodsSpecFormat[i].spec_id = spec_id;
				goodsSpecFormat[i].spec_name = spec_name;

				//更新规格值
				for (var j = 0; j < goodsSpecFormat[i].value.length; j++) {
					goodsSpecFormat[i].value[j].spec_id = spec_id;
					goodsSpecFormat[i].value[j].spec_name = spec_name;
				}

				refreshSpec();

			},
			//option回调
			optionCallback: function (spec_id, spec_name) {
				goodsSpecFormat[i].spec_id = spec_id;
				goodsSpecFormat[i].spec_name = spec_name;

				//更新规格值
				for (var j = 0; j < goodsSpecFormat[i].value.length; j++) {
					goodsSpecFormat[i].value[j].spec_id = spec_id;
					goodsSpecFormat[i].value[j].spec_name = spec_name;
				}

				refreshSpec();
			}

		};

		specSearchableSelectArr.push($(this).find("select[name='spec_item']").searchableSelect(options));
		$(this).find(".searchable-select-input").attr("data-index", i);

	});

}

//绑定规格值下拉搜索
function bindSpecValueSearchableSelect() {

	//规格值下拉搜索集合
	specValueSearchableSelectArr = [];

	$(".spec-edit-list .spec-item .add-spec-value-popup").each(function (i) {
		var _this = this;
		var index = $(_this).attr("data-index");
		var count = $(_this).parent().find('li').length;

		var options = {
			placeholder: "输入规格值，按回车键完成",
			//回车回调
			enterCallback: function (input) {
				var selected = input.next().find(".searchable-select-item.selected");//搜索到到规格
				var spec_value_id = -(Math.abs(goodsSpecFormat[index].spec_id) + Math.floor(new Date().getSeconds()) + Math.floor(new Date().getMilliseconds())) + count;
				var spec_value_name = input.val().trim();
				if (spec_value_name.length == 0) {
					layer.msg("请输入规格值");
					return;
				}

				var options = '<option value="' + spec_value_id + '" data-attr-name="' + spec_value_name + '">' + spec_value_name + '</option>';
				$(_this).find("select[name='spec_item']").html(options);
				specValueSearchableSelectArr[index].buildItems();

				var item = {
					"spec_id": goodsSpecFormat[index].spec_id,
					"spec_name": goodsSpecFormat[index].spec_name,
					"spec_value_id": spec_value_id,
					"spec_value_name": spec_value_name,
				};
				if (index == 0) {
					item.image = "";
				}
				goodsSpecFormat[index].value.push(item);
				refreshSpec();

			},
			//option回调
			optionCallback: function (spec_value_id, spec_value_name) {

				var item = {
					"spec_id": goodsSpecFormat[index].spec_id,
					"spec_name": goodsSpecFormat[index].spec_name,
					"spec_value_id": spec_value_id,
					"spec_value_name": spec_value_name,
				};
				if (index == 0) {
					item.image = "";
				}
				goodsSpecFormat[index].value.push(item);
				refreshSpec();
			}

		};

		specValueSearchableSelectArr.push($(this).find("select[name='spec_value_item']").searchableSelect(options));
		$(this).find(".searchable-select-input").attr("data-index", index);
	});
}

//刷新商品属性json
function refreshGoodsAttrData() {
	goodsAttrFormat = [];

	$(".goods-attr-temp").each(function () {
		var attr_class_id = $(this).attr("data-attr-class-id");
		// var attr_class_name = $(this).attr("data-attr-class-name");
		var attr_id = $(this).attr("data-attr-id");
		var attr_name = $(this).attr("data-attr-name");
		var attr_type = parseInt($(this).attr("data-attr-type").toString());// 属性类型（1.单选 2.多选 3. 输入）

		var item = {
			attr_class_id: attr_class_id,
			attr_id: attr_id,
			attr_name: attr_name,
			attr_value_id: "",
			attr_value_name: ""
		};

		switch (attr_type) {
			case 1:
				var input = $(this).find("input:checked");
				if (input.length > 0) {
					item.attr_value_id = input.val();
					item.attr_value_name = input.attr("data-attr-value-name");
					goodsAttrFormat.push(item);
				}
				break;
			case 2:
				$(this).find("input:checked").each(function () {
					item = JSON.parse(JSON.stringify(item));
					item.attr_value_id = $(this).val();
					item.attr_value_name = $(this).attr("data-attr-value-name");
					goodsAttrFormat.push(item);
				});
				break;
			case 3:
				item.attr_value_name = $(this).find("input").val();
				if (item.attr_value_name) {
					goodsAttrFormat.push(item);
				}
				break;
		}
	});

}

//删除已选择的视频
function deleteVideo() {
	var src = $("input[name='video_url']").val();
	if (src != "") {
		var video = 'goods_video';
		var myPlayer = videojs(video);
		videojs(video).ready(function () {
			var myPlayer = this;
			myPlayer.pause();
		});

		$("#goods_video").attr('src', "");
		$("input[name='video_url']").val('');
	}
}

//渲染商品主图列表
function refreshGoodsImage() {
	var goods_image_template = $("#goodsImage").html();
	var data = {
		list: goodsImage,
		max: GOODS_IMAGE_MAX
	};

	laytpl(goods_image_template).render(data, function (html) {
		$(".js-goods-image").html(html);
		//加载图片放大
		loadImgMagnify();

		if (goodsImage.length) {

			//预览
			$(".js-goods-image .js-preview").click(function () {
				$(this).parent().prev().find("img").click();
			});

			//图片删除
			$(".js-goods-image .js-delete").click(function () {
				var index = $(this).attr("data-index");
				goodsImage.splice(index, 1);
				refreshGoodsImage();
			});

			// 拖拽
			$('.js-goods-image .upload_img_square_item').arrangeable({
				//拖拽结束后执行回调
				callback: function (e) {
					var indexBefore = $(e).attr("data-index");//拖拽前的原始位置
					var indexAfter = $(e).index();//拖拽后的位置
					var temp = goodsImage[indexBefore];
					goodsImage[indexBefore] = goodsImage[indexAfter];
					goodsImage[indexAfter] = temp;
					refreshGoodsImage();
				}
			});
		}

		//最多传十张图
		if (goodsImage.length < GOODS_IMAGE_MAX) {
			$(".js-add-goods-image").show();
		} else {
			$(".js-add-goods-image").hide();
		}

	});
}

//加载编辑商品的数据
function initEditData() {
	// 商品分类
	$(".layui-block").each(function () {
		var _this = this;
		var ids = $(this).find(".category_id").val().split(",");
		$.each(ids, function (index, item) {
			$(_this).find(".category_id_" + (index + 1)).val(item);
		})
	});

	if ($("input[name='goods_id']").length == 0) return;

	if ($("input[name='spec_type']").is(":checked")) {
		goodsSpecFormat = JSON.parse($("input[name='goods_spec_format']").val().toString());
		// for (var i = 0; i < goodsSpecFormat.length; i++) {
		// 	for (var j = 0; j < goodsSpecFormat[i].value.length; j++) {
		// 		goodsSpecFormat[i].value[j].is_delete = 0;
		// 	}
		// }

		var isCheckedAddSpecImg = false;// 是否勾选规格图片复选框

		if (goodsSpecFormat.length > 0) {
			for (var i = 0; i < goodsSpecFormat[0].value.length; i++) {
				if (goodsSpecFormat[0].value[i].image) {
					isCheckedAddSpecImg = true;
					break;
				}
			}
		}

		refreshSpec(isCheckedAddSpecImg);

		goodsSkuData = [];
		$(".js-edit-sku-list>div").each(function () {
			var item = {
				sku_id: $(this).children("input[name='edit_sku_id']").val(),
				spec_name: $(this).children("input[name='edit_spec_name']").val(),
				sku_no: $(this).children("input[name='edit_sku_no']").val(),
				sku_spec_format: $(this).children("input[name='edit_sku_spec_format']").val().toString() ? JSON.parse($(this).children("input[name='edit_sku_spec_format']").val().toString()) : "",
				price: $(this).children("input[name='edit_price']").val(),
				market_price: $(this).children("input[name='edit_market_price']").val(),
				cost_price: $(this).children("input[name='edit_cost_price']").val(),
				stock: $(this).children("input[name='edit_stock']").val(),
				stock_alarm: $(this).children("input[name='edit_stock_alarm']").val(),
				sku_image: $(this).children("input[name='edit_sku_image']").val(),
				sku_images: $(this).children("input[name='edit_sku_images']").val(),
				sku_images_arr: $(this).children("input[name='edit_sku_images']").val() ? $(this).children("input[name='edit_sku_images']").val().split(",") : [],
				is_default: $(this).children("input[name='edit_is_default']").val(),
			};
			goodsSkuData.push(item);
		});

		refreshSkuTable();
	}

	// 加载商品主图
	goodsImage = $("input[name='goods_image']").val().split(",");
	refreshGoodsImage();

	loadVideo(true);

	// 加载商品详情
	goodsContent.ready(function () {
		goodsContent.setContent($("input[name='goods_content']").val());
	});

	// 加载商品属性关联
	var goods_attr_format = $("input[name='goods_attr_format']").val().toString();

	if (goods_attr_format) {

		try {
			goodsAttrFormat = JSON.parse(goods_attr_format);
		} catch (e) {
			console.log(e);
		}

		var new_attr = [];
		$.each(goodsAttrFormat, function (index, item) {
			if (item.attr_class_id < 0) {
				new_attr.push(item);
			}
		});

		var html = "";
		$.each(new_attr, function (index, item) {
			html += '<tr class="goods-attr-tr goods-new-attr-tr">' +
				'<td>' +
				'<input type="text" class="layui-input add-attr-name" value="' + item.attr_name + '" />' +
				'</td>' +
				'<td>' +
				'<input type="text" class="layui-input add-attr-value" value="' + item.attr_value_name + '" />' +
				'</td>' +
				'<td>' +
				'<input type="text" class="layui-input add-attr-sort" value="' + item.sort + '" />' +
				'</td>' +
				'<td>' +
				'<div class="ns-table-btn"><a class="layui-btn" onclick="delAttr(this)">删除</a></div>' +
				'</td>' +
				'</tr>';
		});
		$(".ns-attr-new").append(html);
	} else {
		var html = '<tr class="ns-null-data"><td colspan="3" align="center">无数据</td></tr>';
		$(".ns-attr-new").html(html);
	}

	//刷新商品属性页面
	setTimeout(function () {
		$("select[name='goods_attr_class']").next().find(".layui-anim.layui-anim-upbit .layui-this").click();
	}, 10);
}

// 添加新属性
function addNewAttr() {
	var html = '<tr class="goods-attr-tr goods-new-attr-tr">' +
		'<td>' +
		'<input type="text" class="layui-input add-attr-name" />' +
		'</td>' +
		'<td>' +
		'<input type="text" class="layui-input add-attr-value" />' +
		'</td>' +
		'<td>' +
		'<input type="number" class="layui-input add-attr-sort" />' +
		'</td>' +
		'<td>' +
		'<div class="ns-table-btn"><a class="layui-btn" onclick="delAttr(this)">删除</a></div>' +
		'</td>' +
		'</tr>';

	$(".ns-attr-new").append(html);
	isNullTable();
}

// 删除属性
function delAttr(obj) {
	$(obj).parents("tr").remove();
	isNullTable();
}

// 属性表格是否为空
function isNullTable() {
	var len = $(".ns-attr-new .goods-attr-tr").length;
	if (len == 0) {
		$(".ns-attr-new").html('<tr class="ns-null-data"><td colspan="4" align="center">无数据</td></tr>');
	} else {
		$(".ns-attr-new .ns-null-data").remove();
	}
}

// 判断表格中是否包含某个属性模板
function isHasAttr(id) {
	var is_exsit = 0;
	$(".ns-attr-new .goods-attr-tr").each(function () {
		if ($(this).attr("data-attr-class-id") == id) {
			is_exsit = 1;
		}
	});
	return is_exsit;
}

// 删除属性模板
function delAttrTemplate(id) {
	var attr_index = [];
	$(".ns-attr-new .goods-attr-tr").each(function () {
		if ($(this).attr("data-attr-class-id") == id) {
			$(this).remove();
		}
	})
}

/**
 * 加载视频
 * @param flag 是否暂停
 */
function loadVideo(flag) {

	var video_url = $("input[name='video_url']").val();
	if (!video_url.length) return;

	var video = "goods_video";
	var myPlayer = videojs(video);
	var value = ns.img(video_url);
	$(".delete-video").show();

	videojs(video).ready(function () {
		var myPlayer = this;
		myPlayer.src(value);
		myPlayer.load(value);
		myPlayer.play();
		if (flag) {
			setTimeout(function () {
				myPlayer.pause();
			}, 10);
		}
		setTimeout(function () {
			if (!$(".video-thumb .vjs-error-display").hasClass("vjs-hidden")) {
				$("input[name='video_url']").val("");//video.js Line:7873
				layer.msg("媒体不能加载，要么是因为服务器或网络失败，要么是因为格式不受支持。");
			} else {
			}
			$(".video-thumb span").removeClass("hide");
		}, 1000);
	});
}
