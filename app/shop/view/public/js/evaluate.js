Evaluate = function(limit = 0, limits = []) {
	var _this = this;
	_this.listCount = 0;
	_this.page = 1;
	_this.limits = limits;
	_this.limit = limit == false ? 10 : limit;
};

Evaluate.prototype.getList = function(d) {
	var _this = d._this;
	var page = _this.page;
	var limit = _this.limit;
	var search_type = d.search_type;
	var search_text = d.search_text == null ? {} : d.search_text;
	var explain_type = d.explain_type;
	var start_time = d.start_time;
	var end_time = d.end_time;
	var goods_id = d.goods_id;

	$.ajax({
		url: ns.url("shop/goods/evaluate"),
		async: false,
		data: {
			"page": page,
			"page_size": limit,
			"search_type": search_type,
			"search_text": search_text,
			"explain_type": explain_type,
			"start_time": start_time,
			"end_time": end_time,
			"goods_id" : goods_id
		},
		type: "POST",
		dataType: "JSON",
		success: function (res) {
			_this.listCount = res.data.count;
			$(".ns-evaluate-table").find("tbody").empty();
			var d = res.data.list;

			if (d.length == 0) {
				var html = '<tr><td colspan="4" align="center">无数据</td></tr>';
				$(".ns-evaluate-table").find("tbody").append(html);
			}

			for (var i in d) {
				var html = '';
				var isFirstExplain  = Boolean(d[i].explain_first) ? 1 : 0;//是否第一次评价
				html += '<tr>' +
							'<td colspan="4">' +
								'<input class="evaluate_id" type="hidden" value=' + d[i].evaluate_id + ' data-is-first-explain="' + isFirstExplain + '" />' +
								'<div class="ns-evaluate-title">' +
									'<input type="checkbox" name="evaluate" value=' + d[i].evaluate_id + ' lay-skin="primary" lay-filter="evaluate" ' + ($("input[name='check_all']").is(":checked") ? "checked" : "") + ' />' +
									'<p>评论时间：' + ns.time_to_date(d[i].create_time) + '</p>' +
									'<p>客户姓名：' + d[i].member_name + '</p>';

				if (d[i].explain_type == 1) {
					html += `<p class="evaluate-level-good"><img src= "${SHOPIMG}/good_evaluate.png" /><span>好评</span></p>`;
				} else if (d[i].explain_type == 2) {
					html += `<p class="evaluate-level-middel"><img src= "${SHOPIMG}/middel_evaluate.png" /><span>中评</span></p>`;
				} else {
					html += `<p class="evaluate-level-bad"><img src= "${SHOPIMG}/bad_evaluate.png" /><span>差评</span></p>`;
				}

				html +=			'</div>' +
							'</td>' +
						'</tr>';

				html += '<tr>';
				html += '<td>';
				html += '<div class="ns-evaluate">'+
							'<span class="again-evaluate required">[用户评论]</span>'+
							'<p>' + d[i].content + '</p>'+
						'</div>';

				if (d[i].images) {
					html += '<div class="ns-evaluate-img">';

					var images = d[i].images.split(",");
					for (var j=0; j<images.length; j++) {
						html += '<div class="ns-title-pic" id="eva_img_'+ i +'_'+ j +'">';
						html +=  	'<img layer-src src="' + ns.img(images[j]) + '" onerror=src="'+ns.img('public/static/img/null.png')+'">';
						html += '</div>';
					}

					html += '</div>';
				}

				if (d[i].explain_first) {
					html += '<div class="ns-evaluate-explain">'+
								'<span class="again-evaluate required">[商家回复]</span>'+
								'<p>' + d[i].explain_first + '</p>' +
							'</div>';
				}

				if (d[i].again_content) {
					html += '<hr />';
					html += '<div class="ns-evaluate-again">' +
								'<span class="again-evaluate required">[追加评论]</span>' +
								'<p>' + d[i].again_content + '</p>' +
							'</div>';

					if (d[i].again_images) {
						html += '<div class="ns-evaluate-img">';

						var again_images = d[i].again_images.split(",");
						for (var k=0; k<again_images.length; k++) {
							html += '<div class="ns-title-pic" id="again_img_'+ i +'_'+ k +'">';
							html += 	'<img layer-src src="' + ns.img(again_images[k]) + '" onerror=src="'+ns.img('public/static/img/null.png')+'">';
							html += '</div>';
						}

						html += '</div>';
					}
				}

				if (d[i].again_explain) {
					html += '<div class="ns-evaluate-again-explain">'+
								'<span class="again-evaluate required">[商家回复]</span>'+
								'<p>' + d[i].again_explain + '</p>' +
							'</div>';
				}

				html += '</td>';
				html += '<td>' +
							'<div class="ns-table-title">' +
								'<div class="ns-title-pic" id="goods_img_'+ i +'">' +
									'<img layer-src src="' + ns.img(d[i].sku_image,'small') + '">' +
								'</div>' +
								'<div class="ns-title-content">' +
									'<p>商品名称：' + d[i].sku_name + '</p>' +
									'<p>商品价格：' + d[i].sku_price + '</p>' +
								'</div>' +
							'</div>' +
						'</td>';

				var audit = "已审核";
				var audit_action = '';
				if(d[i].is_audit == 0){
					audit = "未审核";
					audit_action = '<a class="default layui-btn" onclick="audit(this,1)">通过</a>';
					audit_action += '<a class="default layui-btn" onclick="audit(this,-1)">拒绝</a>';
				}else if(d[i].is_audit == 1){
					audit = "审核通过";
				}else if(d[i].is_audit == -1){
					audit = "审核拒绝";
				}

				html += '<td>' + audit + '</td>';

				html += '<td><div class="ns-table-btn">';

				html += audit_action;
				if(d[i].is_audit == 1) {

					if ((d[i].content != "" && d[i].explain_first == "")) {
						html += '<a class="default layui-btn" onclick="replay(this)">回复</a>';
					} else if ((d[i].again_content != "" && d[i].again_explain == "")) {
						html += '<a class="default layui-btn" onclick="replay(this)">追评回复</a>';
					}

					if ((d[i].content != "" && d[i].explain_first != "")) {
						html += '<a class="default layui-btn" onclick="deleteContent(this,0)">删除回复</a>';
					}
					if ((d[i].again_content != "" && d[i].again_explain != "")) {
						html += '<a class="default layui-btn" onclick="deleteContent(this,1)">删除追评回复</a>';
					}
				}

				html +=	'</div></td>';
				html += '</tr>';
				$(".ns-evaluate-table").find("tbody").append(html);

				layui.use(['form', 'layer'],function(){
					var form = layui.form,
						layer = layui.layer;
					form.render();

					layer.photos({
					  	photos: '.ns-title-pic',
						anim: 5
					});
				});
			}
		}
	});
};

Evaluate.prototype.pageInit = function (d) {
	var _this = d._this;
	layui.use('laypage', function () {
		var laypage = layui.laypage;

		laypage.render({
			elem: 'laypage',
			count: _this.listCount,
			limit: _this.limit,
			limits: _this.limits,
			prev: '<i class="layui-icon layui-icon-left"></i>',
			next: '<i class="layui-icon layui-icon-right"></i>',
			layout: ['count','limit','prev', 'page', 'next'],
			// curr: location.hash.replace('#!page=', ''), //获取起始页
			// hash: 'page',
			jump: function (obj, first) {
				_this.limit = obj.limit;
				if (!first) {
					_this.page = obj.curr;
					_this.getList({
						_this: _this,
						"search_type": d.search_type,
						"search_text": d.search_text,
						"explain_type": d.explain_type,
						"start_time": d.start_time,
						"end_time": d.end_time,
						"goods_id" : d.goods_id
					});
				}
			}
		});
	});
};