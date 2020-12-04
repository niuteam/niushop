/**
 * 空的验证组件，后续如果增加业务，则更改组件
 */
var goodsCategoryHtml = '<div class="goods-category-edit layui-form">';

// goodsCategoryHtml += '<div class="layui-form-item">';
// 	goodsCategoryHtml += '<label class="layui-form-label sm">分类样式</label>';
// 	goodsCategoryHtml += '<div class="layui-input-block">';
// 		goodsCategoryHtml += '<template v-for="(item,index) in templateList" v-bind:k="index">';
// 			goodsCategoryHtml += '<div v-on:click="data.level=(index+1)" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (data.level==item.value) }"><i class="layui-anim layui-icon">&#xe643;</i><div>{{item.text}}</div></div>';
// 		goodsCategoryHtml += '</template>';
// 	goodsCategoryHtml += '</div>';
// goodsCategoryHtml += '</div>';
//
// goodsCategoryHtml += '<div class="layui-form-item">';
// 	goodsCategoryHtml += '<label class="layui-form-label sm">模板展示</label>';
// 	goodsCategoryHtml += '<div class="layui-input-block">';
// 		goodsCategoryHtml += '<template v-for="(item,index) in pictureList" v-bind:k="index">';
// 			goodsCategoryHtml += '<template v-if="data.level == (index + 1)">';
// 				goodsCategoryHtml += '<div class="templet-list">';
// 					goodsCategoryHtml += '<template v-for="(sublevel_item,sublevel_index) in item" v-bind:k="sublevel_index">';
// 						goodsCategoryHtml += '<div v-bind:class="{\'ns-border-color\': currIndex == sublevel_index }" v-on:click="data.template=sublevel_item.value;templetSelect(sublevel_index)" class="templet-img-box"><img v-bind:src="sublevel_item.url" alt=""></div>';
// 					goodsCategoryHtml += '</template>';
// 				goodsCategoryHtml += '</div>';
// 			goodsCategoryHtml += '</template>';
// 		goodsCategoryHtml += '</template>';
// 	goodsCategoryHtml += '</div>';
// goodsCategoryHtml += '</div>';

goodsCategoryHtml += '<div class="layui-form-item">';
goodsCategoryHtml += '<label class="layui-form-label sm">分类样式</label>';
goodsCategoryHtml += '<div class="layui-input-block">';
goodsCategoryHtml += '<p class="ns-input-text ns-text-color" v-on:click="selectClassificationStyle">选择</p>';
goodsCategoryHtml += '</div>';
goodsCategoryHtml += '</div>';
// goodsCategoryHtml += '<color v-bind:data="{ field : \'topNavColor\', label : \'顶部导航\', value : \'#ffffff\' }"></color>';
goodsCategoryHtml += '</div>';
// goodsCategoryHtml += '<p class="hint">商品数量选择 0 时，前台会自动上拉加载更多</p>';

goodsCategoryHtml += '</div>';

Vue.component("goods-category", {
	template: goodsCategoryHtml,
	data: function () {
		return {
			data: this.$parent.data,
			currIndex: 0,
			form: null,
			// templateList: [
			// 	{
			// 		text: "一级分类",
			// 		value: "1"
			// 	},
			// 	{
			// 		text: "二级分类",
			// 		value: "2"
			// 	},
			// 	{
			// 		text: "三级分类",
			// 		value: "3"
			// 	},
			// ],
			pictureList: [
				[
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_1_1.png",
						value: "1"
					},
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_1_2.png",
						value: "2"
					},
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_1_3.png",
						value: "3"
					}
				],
				[
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_2_1.png",
						value: "1"
					},
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_2_2.png",
						value: "2"
					},
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_2_3.png",
						value: "3"
					}
				],
				[
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_3_1.png",
						value: "1"
					},
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_3_2.png",
						value: "2"
					},
					{
						url: goodsCategoryResourcePath + "/goods_category/img/category_3_3.png",
						value: "3"
					}
				]
			]
		}
	},
	created:function() {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
	},
	methods: {
		
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
		templetSelect: function (index) {
			this.currIndex = index;
		},
		selectClassificationStyle: function () {
			var self = this;
			layer.open({
				type: 1,
				title: '分类样式',
				area:['930px','630px'],
				content: $(".draggable-element[data-index='" + self.data.index + "'] .edit-attribute .goods-category-popup-wrap").html(),
				success: function(layero, index){
					layui.use(['form'], function() {
						form = layui.form;
						form.render();
						
						// level
						$(".layui-layer-content input[name='level']").val(self.data.level);
						// template
						$(".layui-layer-content input[name='template']").val(self.data.template);
						
						$("body").on("click",".layui-layer-content .goods-classification-style .style-title li",function () {
							$(this).addClass("selected ns-bg-color").siblings().removeClass("selected ns-bg-color");
							$(".layui-layer-content .goods-classification-style .style-content li").eq($(this).index()).removeClass("layui-hide").siblings().addClass('layui-hide');
							
							// 清除所有
							$(".layui-layer-content .goods-classification-style .style-content li .style-img-box").removeClass("selected ns-border-color ns-bg-color-after");
							// 选中第一个
							$(".layui-layer-content .goods-classification-style .style-content li").eq($(this).index()).find(".style-img-box").eq(0).addClass("selected ns-border-color  ns-bg-color-after");
							// level
							$(".layui-layer-content input[name='level']").val($(this).index() + 1);
							// template
							$(".layui-layer-content input[name='template']").val(1);
						});
						
						$("body").on("click",".layui-layer-content .goods-classification-style .style-content li .style-img-box",function () {
							// template
							$(".layui-layer-content input[name='template']").val($(this).index() + 1);
							
							$(this).addClass("selected ns-border-color  ns-bg-color-after").siblings().removeClass("selected ns-border-color  ns-bg-color-after");
						});
						
						//确定
						form.on("submit(confirm)",function (data) {
							self.data.level = data.field.level;
							self.data.template = data.field.template;
							layer.closeAll()
						});
						
						// 返回
						$(".layui-layer-content .back").click(function () {
							layer.closeAll()
						});
						
					});
				}
			});
		}
	}
});