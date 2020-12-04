/**
 * 顶部分类·组件
 */
var topStyleHtml = '<div>';

	topStyleHtml += '<div class="layui-form-item" >';
		topStyleHtml += '<label class="layui-form-label sm">风格选择</label>';
		topStyleHtml += '<div class="layui-input-block">';
			topStyleHtml += '<div v-if="styleName" class="ns-input-text ns-text-color selected-style" v-on:click="selectGroupbuyStyle">{{styleName}} <i class="layui-icon layui-icon-right"></i></div>';
			topStyleHtml += '<div v-else class="ns-input-text selected-style" v-on:click="selectGroupbuyStyle">选择 <i class="layui-icon layui-icon-right"></i></div>';
		topStyleHtml += '</div>';
	topStyleHtml += '</div>';
	
	topStyleHtml += '</div>';

Vue.component("style-choose",{

	template : topStyleHtml,
	data : function(){
		return {
			data : this.$parent.data,
			list: [
				{
					label: "线条标签", 
					value: "line",
					icon_img:topCategoryResourcePath + "/search/img/text_left.png",
					icon_img_active:topCategoryResourcePath + "/search/img/text_left_hover.png"
				},
				{
					label: "填充标签", 
					value: "fill",
					icon_img:topCategoryResourcePath + "/search/img/text_right.png",
					icon_img_active:topCategoryResourcePath + "/search/img/text_right_hover.png"
				},
			],
			styleName:'线条标签'
		};
	},
	created:function(){
		if(this.data.styleType == 'line') this.styleName = '线条标签';
		else  this.styleName = '填充标签';
	},
	methods:{
		selectGroupbuyStyle: function() {
			var self = this;
			layer.open({
				type: 1,
				title: '风格选择',
				area:['930px','630px'],
				btn: ['确定', '返回'],
				content: $(".draggable-element[data-index='" + self.data.index + "'] .edit-attribute .top-category-style").html(),
				success: function(layero, index) {
					$(".layui-layer-content input[name='style']").val(self.data.styleType);
					$(".layui-layer-content input[name='style_name']").val(self.styleName);
					$("body").on("click", ".layui-layer-content .style-list-con-top-category .style-li-top-category", function () {
						$(this).addClass("selected ns-border-color").siblings().removeClass("selected ns-border-color");
						$(".layui-layer-content input[name='style']").val($(this).find("span").attr('data-type'));
						$(".layui-layer-content input[name='style_name']").val($(this).find("span").text());
					});
				},
				yes: function (index, layero) {
					self.data.styleType = $(".layui-layer-content input[name='style']").val();
					self.styleName = $(".layui-layer-content input[name='style_name']").val();
					layer.closeAll()
				}
			});
		},
	}
});