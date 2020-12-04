$(function () {
	getGoodsCategoryTree(1, 0);
	var _index = '';
});

// 添加商品分类
function addGoodsCate() {
	if ($(".goods-category-con-wrap .layui-block").length < 10) {
		var html = `
			<div class="layui-block">
				<div class="layui-input-inline ns-cate-input-defalut">
					<input type="text" readonly lay-verify="required" autocomplete="off" class="layui-input ns-len-mid select-category" />
					<input type="hidden" class="category_id" />
					<input type="hidden" class="category_id_1" />
					<input type="hidden" class="category_id_2" />
					<input type="hidden" class="category_id_3" />
					<input type="hidden"  id="select_category_id">
					<input type="hidden"  name="category_id">
				</div>
				<a href="#" class="default ns-text-color ns-input-text" onclick="delGoodsCate(this)">删除</a>
			</div>
		`;

		$(".goods-category-con-wrap").append(html);
	}
	refreshAddCategory();
}

// 删除商品分类
function delGoodsCate(obj) {
	$(obj).parents(".layui-block").remove();
	refreshAddCategory();
}

// 刷新添加商品分类按钮是否显示
function refreshAddCategory() {
	if ($(".goods-category-con-wrap .layui-block").length < 10) {
		$(".js-add-category").css('visibility', '');
	} else {
		$(".js-add-category").css('visibility', 'hidden');
	}
}

//初始化分类
function getGoodsCategoryTree(level, pid) {
	$.ajax({
		url: ns.url("shop/goodscategory/getCategoryByParent"),
		dataType: 'JSON',
		type: 'POST',
		data: {
			'level': level,
			'pid': pid
		},
		async: false,
		success: function(data) {
			var category_html = '';
			if (data['data']) {
				$.each(data.data, function(category_key, category_val) {
					//一级分类
					category_html += '<li data-value="' + category_val.category_id + '" data-level="' + level + '" pid="' + pid +
						'" child="' + (category_val.child_count > 0) + '">';
					category_html += '<span>' + category_val.category_name + '</span>';
					if (category_val.child_count > 0) {
						category_html += '<i class="layui-icon-right layui-icon"></i>';
					}
					category_html += '</li>';
				})
			}
			$('.goodsCategory_' + level + ' ul').html(category_html);
		}
	})
}

$("body").on('click', '.ns-goods-category-wrap-box .goodsCategory ul li', function() {
	var level = $(this).attr('data-level');
	var value = $(this).attr('data-value');
	var isVal = 0;
	
	$('.ns-goods-category-wrap-box .goodsCategory_2, .ns-goods-category-wrap-box .goodsCategory_3').addClass('hide');
	if ($(this).attr('child') == 'true') {
		getGoodsCategoryTree(parseInt(level) + 1, value);
		$('.ns-goods-category-wrap-box .goodsCategory_' + (parseInt(level) + 1) + ' ul li').addClass('hide');
		$('.ns-goods-category-wrap-box .goodsCategory_' + (parseInt(level) + 1) + ' ul li[pid="' + value + '"]').removeClass('hide');
		$('.ns-goods-category-wrap-box .goodsCategory_' + level).removeClass('hide');
		$('.ns-goods-category-wrap-box .goodsCategory_' + (parseInt(level) + 1)).removeClass('hide');
		isVal = 1;
	} else {
		$('.ns-goods-category-wrap-box .category-wrap, .ns-goods-category-wrap-box .goodsCategory, .ns-goods-category-wrap-box .goods-category-mask').addClass('hide');
	}
	
	$('.ns-goods-category-wrap-box .goodsCategory_' + level + ' ul li').removeClass('selected');
	$('.ns-goods-category-wrap-box .goodsCategory_' + (parseInt(level) + 1) + ' ul li').removeClass('selected');
	$('.ns-goods-category-wrap-box .goodsCategory_' + (parseInt(level) + 2) + ' ul li').removeClass('selected');
	$(this).addClass('selected');
	// categoryBottom();
	setSelectGoodsCaregory(isVal);
});


//设置选中分类
function setSelectGoodsCaregory(isVal) {
	var level_text_1 = '';
	var level_text_2 = '';
	var level_text_3 = '';
	var select_id = '';
	$('.ns-goods-category-wrap-box .goodsCategory ul li.selected').each(function(i, e) {
		var level = $(e).attr('data-level');
		if (level == 1) {
			level_text_1 = $(e).find('span').text();
			select_id += $(e).attr('data-value') + ',';
		}
		if (level == 2) {
			level_text_2 = '/' + $(e).find('span').text();
			select_id += $(e).attr('data-value') + ',';
		}
		if (level == 3) {
			level_text_3 = '/' + $(e).find('span').text();
			select_id += $(e).attr('data-value') + ',';
		}
	});
	
	select_id = select_id.substring(0, select_id.length - 1);
	var bool = false;
	if ($(".ns-goods-category-wrap-box .layui-block").length > 1) {
		$(".ns-goods-category-wrap-box .layui-block").each(function() {
			var selectId = $(this).find(".category_id").val();
			if (select_id == selectId) {
				bool = true;
			}
		})
	}
	
	if (bool) {
		layer.msg("该分类已被选中");
		getGoodsCategoryTree(1, 0);
		return;
	} else {
		if (!isVal) {
			$(".ns-goods-category-wrap-box .layui-block").eq(_index).find(".select-category").val(level_text_1 + level_text_2 + level_text_3);
			$(".ns-goods-category-wrap-box .layui-block").eq(_index).find('#select_category_id').val(select_id);
			var category_arr = select_id.split(',');
			$(".ns-goods-category-wrap-box .layui-block").eq(_index).find('.category_id').val(category_arr);
			$(".ns-goods-category-wrap-box .layui-block").eq(_index).find('input[name="category_id"]').val(category_arr.pop());
		}
	}
}

$("body").on('focus', '.ns-goods-category-wrap-box .select-category', function() {
	getGoodsCategoryTree(1, 0);

	$(".ns-goods-category-wrap-box .category-wrap").css('display', 'flex');
	_index = $(this).parents(".layui-block").index();
	var _top = $(this).parents(".layui-block").position().top;
	var _left = $(this).parents(".layui-block").position().left;
	
	$(".ns-goods-category-wrap-box .category-wrap").css({
		'top': _top + 44 + 'px'
	})
	
	var select_id = $(this).parents(".layui-block").find('.category_id').val();
	var category_arr = [];
	if (select_id) {
		category_arr = select_id.split(',');
		
		$.each(category_arr, function(i, e) {
			var level = parseInt(i) + 1;
			$('.ns-goods-category-wrap-box .goodsCategory_' + level).removeClass('hide');
			$('.ns-goods-category-wrap-box .goodsCategory_' + level + ' ul li[data-value="' + e + '"]').addClass('selected');
			
			if (level < category_arr.length) {
				getGoodsCategoryTree(parseInt(level) + 1, e);
			}
		});
	} else {
		$('.ns-goods-category-wrap-box .goodsCategory_1').removeClass('hide');
		$('.ns-goods-category-wrap-box .goodsCategory_2').addClass('hide');
		$('.ns-goods-category-wrap-box .goodsCategory_3').addClass('hide');
	}
});

$("body").on('keyup', '.select-category', function() {
	if ($(this).val().length == 0) {
		$(this).siblings('#select_category_id').val("");
		$(this).siblings('input[name="category_id"]').val("");
		$(this).siblings('.category_id').val("");
		$(this).siblings('.category_id_1').val("");
		$(this).siblings('.category_id_2').val("");
		$(this).siblings('.category_id_3').val("");
	}
});

$('body').on('click', function(e){
	var flag = true;
	$(".goods-category-con-wrap .layui-block").each(function () {
		var con = $(this).find(".select-category");
		if (con.is(e.target) || con.has(e.target).length != 0 || $(".ns-goods-category-wrap-box .category-wrap").has(e.target).length != 0) {
			flag = false;
			return;
		}
	});
	
	if (flag) {
		if($(".ns-goods-category-wrap-box .category-wrap").is(":visible")){
			$(".ns-goods-category-wrap-box .category-wrap").hide();
		}
	}
});