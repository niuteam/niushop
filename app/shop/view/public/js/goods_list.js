var laytpl, form, element, repeat_flag, table;
$(function () {
	$("body").on("click", ".contraction", function () {
		var goods_id = $(this).attr("data-goods-id");
		var open = $(this).attr("data-open");
		var tr = $(this).parent().parent().parent().parent();
		var index = tr.attr("data-index");

		if (open == 1) {
			$(this).children("span").text("+");
			$(".js-sku-list-" + index).remove();
		} else {
			$(this).children("span").text("-");
			$.ajax({
				url: ns.url("shop/goods/getGoodsSkuList"),
				data: {goods_id: goods_id},
				dataType: 'JSON',
				type: 'POST',
				async: false,
				success: function (res) {
					var list = res.data;
					var sku_list = $("#skuList").html();
					var data = {
						list: list,
						index: index,
						member_price_is_exit: member_price_is_exit
					};
					laytpl(sku_list).render(data, function (html) {
						tr.after(html);
					});

					layer.photos({
					  	photos: '.img-wrap',
						anim: 5
					});
				}
			});
		}
		$(this).attr("data-open", (open == 0 ? 1 : 0));
	});

	layui.use(['form', 'laytpl', 'element'], function () {
		form = layui.form;
		repeat_flag = false; //防重复标识
		element = layui.element;
		laytpl = layui.laytpl;

		form.render();
		refreshTable();

		//监听Tab切换，以改变地址hash值
		element.on('tab(goods_list_tab)', function () {
			var type = this.getAttribute('data-type');
			$("input[name='goods_state']").val("");
			if (type) {
				var id = this.getAttribute('lay-id');
				$("input[name='" + type + "']").val(id);
			}
			var html = '<button class="layui-btn layui-btn-primary" lay-event="delete">批量删除</button>';
			if (type == "goods_state" && id == 1) {
				// 销售中状态：下架
				html += '<button class="layui-btn layui-btn-primary" lay-event="off_goods">批量下架</button>';
			} else if (type == "goods_state" && id == 0) {
				// 仓库中状态：上架
				html += '<button class="layui-btn layui-btn-primary" lay-event="on_goods">批量上架</button>';
			}

			html += '<button class="layui-btn layui-btn-primary" lay-event="batch_set">批量设置</button>';

			$("#toolbarOperation").html(html);
			$("#batchOperation").html(html);

			refreshTable();

		});

		// 监听工具栏操作
		table.tool(function (obj) {
			var data = obj.data;
			switch (obj.event) {
                case 'member_price':

                    var url = ns.url("memberprice://shop/goods/config", {goods_id: data.goods_id});
                    //iframe层-父子操作
                    var layerIndex = layer.open({
                        title: "自定义会员价",
                        type: 2,
                        area: ['1000px', '600px'],
                        // btn: '保存',
                        content: url,
                        success: function(layero, index){
                            var dom_save = layer.getChildFrame("#save_member_price", index);
                            var dom_back = layer.getChildFrame("#back_goods_list", index);
                            var iframeWin = window[layero.find('iframe')[0]['name']];//得到iframe页的窗口对象，执行iframe页的方法
                            $(dom_save).click(function(){
                                setTimeout(function(){
                                    iframeWin.formSubmit(function(data){
                                        if (data == 1) {
                                            layer.close(layerIndex);
											table.reload();
                                        }
                                    });
                                },300)
                            });
                            $(dom_back).click(function(){
                                layer.close(layerIndex);
                            })
                        }
                    });

                    break;

				case 'select': //推广
					goodsUrl(data);
					break;
				case 'preview': //预览
					goodsPreview(data);
					break;
				case 'edit':
					//编辑
					if (data.goods_class == 1) {
						window.open(ns.url("shop/goods/editgoods", {"goods_id": data.goods_id}))
					} else {
						window.open(ns.url("shop/virtualgoods/editgoods", {"goods_id": data.goods_id}))
					}
					break;
				case 'copy':
					// 复制
					copyGoods(data.goods_id);
					break;
				case 'delete':
					//删除
					deleteGoods(data.goods_id);
					break;
				case 'off_goods':
					//下架
					offGoods(data.goods_id);
					break;
				case 'on_goods':
					//上架
					onGoods(data.goods_id);
					break;
				case 'editStock':
					editStock(data);
					break;
				case 'browse_records':
					location.href = ns.url("shop/goods/goodsBrowse", {goods_id:data.goods_id});
					break;
				case 'evaluate':
					location.href = ns.url("shop/goods/evaluate", {goods_id:data.goods_id});
					break;
                case 'more': //更多
                    $('.more-operation').css('display', 'none');
                    $(obj.tr).find('.more-operation').css('display', 'block');
                    break;
			}
		});

		// 提交修改后的库存
		form.on('submit(edit_stock)', function (obj) {
			var field = obj.field;
			if (repeat_flag) return false;
			repeat_flag = true;

			$.ajax({
				type: "POST",
				url: ns.url("shop/goods/editGoodsStock"),
				data: {
					'sku_list': field
				},
				dataType: 'JSON',
				success: function (res) {
					layer.msg(res.message);
					repeat_flag = false;
					if (res.code == 0) {
						table.reload();
						layer.closeAll('page');
					}
				}
			});
		});

        $(document).click(function(event) {
            if ($(event.target).attr('lay-event') != 'more' && $('.more-operation').not(':hidden').length) {
                $('.more-operation').css('display', 'none');
            }
        });

		// 批量操作
		table.bottomToolbar(function (obj) {

			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}
			var id_array = new Array();
			for (i in obj.data) id_array.push(obj.data[i].goods_id);
			switch (obj.event) {
				case "delete":
					deleteGoods(id_array.toString());
					break;
				case 'off_goods':
					//下架
					offGoods(id_array);
					break;
				case 'on_goods':
					//上架
					onGoods(id_array);
					break;
				case 'batch_set':
				 	layer.open({
                        title: "批量设置",
                        type: 1,
                        area: ['700px', '600px'],
                        content: $('#batchSet').html(),
                        success: function(){
                        	form.render();
                        }
                    });
					break;
			}
		});

		table.toolbar(function(obj){
			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}
			var id_array = new Array();
			for (i in obj.data) id_array.push(obj.data[i].goods_id);
			switch (obj.event) {
				case "delete":
					deleteGoods(id_array.toString());
					break;
				case 'off_goods':
					//下架
					offGoods(id_array);
					break;
				case 'on_goods':
					//上架
					onGoods(id_array);
					break;
				case 'batch_set':
				 	layer.open({
			            title: "批量设置",
			            type: 1,
			            area: ['700px', '600px'],
			            content: $('#batchSet').html(),
			            success: function(){
			            	form.render();
			            }
			        });
					break;
			}
		});

		table.on("sort",function (obj) {
			table.reload({
				page: {
					curr: 1
				},
				where: {
					order:obj.field,
					sort:obj.type
				}
			});
		});

		// 搜索功能
		form.on('submit(search)', function (data) {
			table.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
			return false;
		});

		// 验证
		form.verify({
			int: function (value) {
				if (value < 0) {
					return '销量不能小于0!'
				}
				if (value % 1 != 0) {
					return '销量不能为小数!'
				}
			},
		})

	});

	$('body').on('click', '.batch-set-wrap .tab-wrap li', function(){
		var type = $(this).attr('data-type');
		$(this).addClass('active').siblings('li').removeClass('active');
		$('.batch-set-wrap .content-wrap .tab-item.'+ type).addClass('tab-show').siblings('.tab-item').removeClass('tab-show');
		$('.batch-set-wrap .footer-wrap').show();
	});

	$('body').on('click', '.batch-set-wrap .shipping .layui-form-radio', function(){
		if ($('[name="is_free_shipping"]:checked').val() == 1) {
			$('.batch-set-wrap .shipping .shipping_template').addClass('hide');
		} else {
			$('.batch-set-wrap .shipping .shipping_template').removeClass('hide');
		}
	})

});

/**
 * 刷新表格列表
 */
function refreshTable() {
	var cols = [
		[{
			type: 'checkbox',
			unresize: 'false',
			width: '3%'
		}, {
			title: '商品信息',
			unresize: 'false',
			width: '37%',
			templet: '#goods_info'
		}, {
			field: 'price',
			title: '价格',
			unresize: 'false',
			width: '7%',
			align: 'right',
			templet: function (data) {
				return '￥' + data.price;
			}
		}, {
			field: 'goods_stock',
			title: '库存',
			unresize: 'false',
			width: '6%',
			templet: function (data) {
				if (data.goods_stock_alarm > 0 && data.goods_stock <= data.goods_stock_alarm) {
					return `<span style='color: red;'>${data.goods_stock}</span>`;
				}
				return data.goods_stock;
			},
			sort: true
		}, {
			field: 'sale_num',
			title: '销量',
			unresize: 'false',
			width: '4%',
			sort: true
		},{
			field: 'sort',
			unresize:'false',
			title: `<div class="ns-prompt-block">排序
							<div class="ns-prompt">
								<i class="iconfont iconwenhao1 required ns-growth"></i>
								<div class="ns-growth-box ns-reason-box ns-reason-growth ns-prompt-box">
									<div class="ns-prompt-con">
									<p>商品默认排序号为0，数字越小，排序越靠前，数字重复，则最新添加的靠前。</p>
								</div>
							</div>
							</div>
						</div>`,
			width: '7%',
			align: 'center',
			templet: '#editSort',
			sort: true
		}, {
			title: '创建时间',
			unresize: 'false',
			width: '12%',
			templet: function (data) {
				return ns.time_to_date(data.create_time);
			}
		}, {
			title: '状态',
			unresize: 'false',
			width: '9%',
			templet: function (data) {
				var str = '';
				if (data.goods_state == 1) {
					str = '销售中';
				} else if (data.goods_state == 0) {
					str = '仓库中';
				}
				return str;
			}
		}, {
			title: '操作',
			toolbar: '#operation',
			unresize: 'false',
			width: '15%'
		}]
	];

	if(member_price_is_exit == 1){
		cols = [
			[{
				type: 'checkbox',
				unresize: 'false',
				width: '3%'
			}, {
				title: '商品信息',
				unresize: 'false',
				width: '33%',
				templet: '#goods_info'
			}, {
				field: 'price',
				title: '价格',
				unresize: 'false',
				width: '7%',
				align: 'right',
				templet: function (data) {
					return '￥' + data.price;
				}
			}, {
				field: 'goods_stock',
				title: '库存',
				unresize: 'false',
				width: '5%',
				templet: function (data) {
					if (data.goods_stock_alarm > 0 && data.goods_stock < data.goods_stock_alarm) {
						return `<span style='color: red;'>${data.goods_stock}</span>`;
					}
					return data.goods_stock;
				},
				sort: true
			}, {
				field: 'sale_num',
				title: '销量',
				unresize: 'false',
				width: '4%',
				sort: true
			},{
				field: 'sort',
				unresize:'false',
				title: `<div class="ns-prompt-block">排序
							<div class="ns-prompt">
								<i class="iconfont iconwenhao1 required ns-growth"></i>
								<div class="ns-growth-box ns-reason-box ns-reason-growth ns-prompt-box">
									<div class="ns-prompt-con">
									<p>商品默认排序号为0，数字越小，排序越靠前，数字重复，则最新添加的靠前。</p>
								</div>
							</div>
							</div>
						</div>`,
				width: '7%',
				align: 'center',
				templet: '#editSort',
				sort: true
			}, {
				title: '创建时间',
				unresize: 'false',
				width: '12%',
				templet: function (data) {
					return ns.time_to_date(data.create_time);
				}
			}, {
				title: '会员等级折扣',
				unresize: 'false',
				width: '9%',
				templet: function (data) {
					var str='';
					if(data.is_consume_discount == 1){
						if(data.discount_config == 1){
							if(data.discount_method == 'discount'){
								str = '打折';
							}else if(data.discount_method == 'manjian'){
								str = '减现';
							}else if(data.discount_method == 'fixed_price'){
								str = '指定价格';
							}
						}else{
							str ='默认规则';
						}
					}else{
						str ='不参与';
					}
					return str;
				}
			}, {
				title: '状态',
				unresize: 'false',
				width: '6%',
				templet: function (data) {
					var str = '';
					if (data.goods_state == 1) {
						str = '销售中';
					} else if (data.goods_state == 0) {
						str = '仓库中';
					}
					return str;
				}
			}, {
				title: '操作',
				toolbar: '#operation',
				unresize: 'false',
				width: '15%'
			}]
		];
	}

	table = new Table({
		id: 'goods_list',
		elem: '#goods_list',
		url: ns.url("shop/goods/lists"),
		cols: cols,
		toolbar: '#toolbarOperation',
		bottomToolbar: "#batchOperation",
		where: {
			search_text: $("input[name='search_text']").val(),
			goods_state: $("input[name='goods_state']").val(),
			start_sale: $("input[name='start_sale']").val(),
			end_sale: $("input[name='end_sale']").val(),
			category_id: $("input[name='category_id']").val(),
			goods_class: $("select[name='goods_class'] option:checked").val(),
			label_id: $("select[name='label_id'] option:checked").val(),
			promotion_type: $("select[name='promotion_type'] option:checked").val()
		}
	});
}

function add() {
	location.href = ns.url('shop/goods/addGoods');
	// var html = $("#selectAddGoods").html();
	// laytpl(html).render({}, function (html) {
	// 	layer.open({
	// 		type: 1,
	// 		title: '选择商品类型',
	// 		area: ['600px'],
	// 		content: html
	//
	// 	});
	// });
}

// 复制
function copyGoods(goods_id) {
	layer.confirm('确定要复制该商品吗?', function () {
		if (repeat_flag) return;
		repeat_flag = true;

		$.ajax({
			url: ns.url("shop/goods/copyGoods"),
			data: {goods_id: goods_id},
			dataType: 'JSON',
			type: 'POST',
			success: function (res) {
				layer.msg(res.message);
				repeat_flag = false;
				if (res.code == 0) {
					table.reload();
				}
			}
		});
	});
}

// 删除
function deleteGoods(goods_ids) {
	layer.confirm('删除后进入回收站，确定删除吗?', function () {
		if (repeat_flag) return;
		repeat_flag = true;

		$.ajax({
			url: ns.url("shop/goods/deleteGoods"),
			data: {goods_ids: goods_ids.toString()},
			dataType: 'JSON',
			type: 'POST',
			success: function (res) {
				layer.msg(res.message);
				repeat_flag = false;
				if (res.code == 0) {
					table.reload();
				}
			}
		});
	});
}

//商品下架
function offGoods(goods_ids) {
	if (repeat_flag) return;
	repeat_flag = true;

	$.ajax({
		url: ns.url("shop/goods/offGoods"),
		data: {goods_state: 0, goods_ids: goods_ids.toString()},
		dataType: 'JSON',
		type: 'POST',
		success: function (res) {
			layer.msg(res.message);
			repeat_flag = false;
			if (res.code == 0) {
				table.reload();
			}
		}
	});
}

//商品上架
function onGoods(goods_ids) {

	if (repeat_flag) return;
	repeat_flag = true;

	$.ajax({
		url: ns.url("shop/goods/onGoods"),
		data: {goods_state: 1, goods_ids: goods_ids.toString()},
		dataType: 'JSON',
		type: 'POST',
		success: function (res) {
			layer.msg(res.message);
			repeat_flag = false;
			if (res.code == 0) {
				table.reload();
			}
		}
	});
}

// 编辑库存
function editStock(data) {
	$.ajax({
		type: "POST",
		url: ns.url("shop/goods/getGoodsSkuList"),
		data: {
			'goods_id': data.goods_id,
		},
		dataType: 'JSON',
		success: function (res) {
			laytpl($("#edit_stock").html()).render(res.data, function (html) {
				layer_stock = layer.open({
					title: '修改库存',
					skin: 'layer-tips-class',
					type: 1,
					area: ['1000px'],
					content: html,
				});
			});
		}
	});

}

// 商品推广
function goodsUrl(data) {
	$(".operation-wrap[data-goods-id='" + data.goods_id + "'] .popup-qrcode-wrap").css("display", "block");
	$('#goods_name').html(data.goods_name);
	$.ajax({
		type: "POST",
		url: ns.url("shop/goods/goodsUrl"),
		data: {
			'goods_id': data.goods_id
		},
		dataType: 'JSON',
		success: function (res) {
			if (res.data.path.h5.status == 1) {
				res.data.goods_id = data.goods_id;
				laytpl($("#goods_url").html()).render(res.data, function (html) {
					$(".operation-wrap[data-goods-id='" + data.goods_id + "'] .popup-qrcode-wrap").html(html).show();

					$("body").click(function (e) {
						if (!$(e.target).closest(".popup-qrcode-wrap").length) {
							$(".operation-wrap[data-goods-id='" + data.goods_id + "'] .popup-qrcode-wrap").hide();
						}
					});
				});
			} else {
				layer.msg(res.data.path.h5.message);
			}
		}
	});

}

// 商品预览
var isOpenGoodsPreviewPopup = false;//防止重复弹出商品预览框
function goodsPreview(data) {
	if (isOpenGoodsPreviewPopup) return;
	isOpenGoodsPreviewPopup = true;
	$.ajax({
		type: "POST",
		url: ns.url("shop/goods/goodsPreview"),
		data: {
			'goods_id': data.goods_id
		},
		dataType: 'JSON',
		success: function (res) {
			if (res.data.path.h5.status == 1) {
				res.data.goods_id = data.goods_id;
				$.ajax({
					type: 'get',
					url: res.data.path.h5.url + "?preview=1",
					dataType: 'json',
					error: function (obj) {
						laytpl($("#h5_preview").html()).render(res.data, function (html) {
							var layerIndex = layer.open({
								title: '商品预览',
								skin: 'layer-tips-class',
								type: 1,
								area: ['600px', '600px'],
								content: html,
								success: function () {
									if(obj.status == 0 || obj.status == 200){
										isOpenGoodsPreviewPopup = false;
										$("#iframe").show();
										$(".goods-preview .phone-wrap .iframe-wrap .empty").hide();
									} else {
										$(".goods-preview .phone-wrap .iframe-wrap .empty").show();
										$("#iframe").hide();
									}
								}
							});
						});
					}
				});

			} else {
				layer.msg(res.data.path.h5.message);
			}
		}
	});
}

function closeStock() {
	layer.close(layer_stock);
}

// 批量设置
var setSub = false;
function batchSetting(){
	var id_array = new Array(),
		setType = $('.batch-set-wrap .tab-wrap .active').attr('data-type'),
		checkedData = table.checkStatus('goods_list').data,
		field = {},
		regExp = {
			number: /^\d{0,10}$/,
			digit: /^\d{0,10}(.?\d{0,2})$/
		};
		for (i in checkedData) id_array.push(checkedData[i].goods_id);

	switch(setType){
		case 'group':
			field.group = $('[name="batch_goods_label"]').val();
		break;
		case 'service':
			var service = [];
			$('[name="batch_goods_service"]:checked').each(function(e){
				service.push($(this).val());
			});
			field.server_ids = service.length ? service.toString() : '';
		break;
		case 'sale':
			field.sale = $('[name="batch_virtual_sale"]').val();
			if (isNaN(field.sale) || !regExp.number.test(field.sale)) {
				layer.msg('销量格式输入错误');
				return;
			}
			if (field.sale < 0) {
				layer.msg('销量不能小于0');
				return;
			}
		break;
		case 'purchase_limit':
			field.max_buy = $('[name="batch_max_buy"]').val();
			if (isNaN(field.max_buy) || !regExp.number.test(field.max_buy)) {
				layer.msg('限购数量格式输入错误');
				return;
			}
			if (field.max_buy < 0) {
				layer.msg('限购数量不能小于0');
				return;
			}
		break;
		case 'shipping':
			field.is_free_shipping = $('[name="is_free_shipping"]:checked').val();
			field.shipping_template = $('[name="batch_shipping_template"]').val();
			if (field.is_free_shipping == 0 && field.shipping_template == 0) {
				layer.msg('请选择运费模板');
				return;
			}
		break;
		case 'category':
			var category_id = [];
			$(".ns-goods-cate .layui-block").each(function () {
				var cate_id = $(this).find(".category_id").val();
				category_id.push(cate_id);
			});
			field.category_id = category_id;
			if (field.category_id == 0) {
				layer.msg('请选择商品分类');
				return;
			}
			break;
		case 'shop_intor':
			field.recom_way = $('[name="recom_way"]:checked').val();
			if (field.recom_way == 0) {
				layer.msg('请选择推荐方式');
				return;
			}
			break;
	}

	if (setSub) return;
	setSub = true;

	$.ajax({
		type: "POST",
		url: ns.url("shop/goods/batchSet"),
		data: {
			'type': setType,
			'goods_ids': id_array.toString(),
			'field' : JSON.stringify(field)
		},
		dataType: 'JSON',
		success: function (res) {
			setSub = false;
			if (res.code >= 0) {
				$('.batch-set-wrap .footer-wrap').hide();
				$('.batch-set-wrap .content-wrap .tab-item.result').addClass('tab-show').siblings('.tab-item').removeClass('tab-show');
			} else {
				layer.msg(res.message);
			}
		}
	})
}

// 监听单元格编辑
function editSort(goods_id, event){
	var data = $(event).val();

	if (data == '') {
		$(event).val(0);
		data = 0;
	}

	if(!new RegExp("^-?[0-9]\\d*$").test(data)){
		layer.msg("排序号只能是整数");
		return ;
	}
	if(data<0){
		layer.msg("排序号必须大于0");
		return ;
	}
	$.ajax({
		type: 'POST',
		url: ns.url("shop/goods/modifySort"),
		data: {
			goods_id: goods_id,
			sort: data
		},
		dataType: 'JSON',
		success: function(res) {
			layer.msg(res.message);
			if(res.code==0){
				table.reload();
			}
		}
	});
}