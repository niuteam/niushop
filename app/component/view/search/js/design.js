/**
 * 商品搜索·组件
 */
// var productSearchHtml = '<div>';
//
// 	productSearchHtml += '<div class="layui-form-item" >';
// 		productSearchHtml += '<label class="layui-form-label sm">左侧图片</label>';
// 		productSearchHtml += '<div class="layui-input-block">';
// 			productSearchHtml += '<img-upload v-bind:data="{ data : $parent.data, field : \'left_img_url\' }"></img-upload>';
// 		productSearchHtml += '</div>';
// 		productSearchHtml += '<p class="hint">建议尺寸：30 x 30 像素</p>';
// 	productSearchHtml += '</div>';
//
// 	productSearchHtml += '<nc-link v-bind:data="{ field : $parent.data.left_link }"></nc-link>';
//
// 	productSearchHtml += '<div class="layui-form-item" >';
// 		productSearchHtml += '<label class="layui-form-label sm">右侧图片</label>';
// 		productSearchHtml += '<div class="layui-input-block">';
// 			productSearchHtml += '<img-upload v-bind:data="{ data : $parent.data, field : \'right_img_url\' }"></img-upload>';
// 		productSearchHtml += '</div>';
// 		productSearchHtml += '<p class="hint">建议尺寸：30 x 30 像素</p>';
//
// 	productSearchHtml += '</div>';
//
// 	productSearchHtml += '<nc-link v-bind:data="{ field : $parent.data.right_link }"></nc-link>';
//
// 	productSearchHtml += '</div>';
//
// Vue.component("top-search",{
//
// 	template : productSearchHtml,
// 	data : function(){
// 		return {
// 			data : this.$parent.data
// 		};
// 	},
// 	created: function () {
// 		if(!this.$parent.data.verify) this.$parent.data.verify = [];
// 		this.$parent.data.verify.push(this.verify);//加载验证方法
// 	},
// 	methods: {
// 		verify : function () {
// 			var res = { code : true, message : "" };
// 			return res;
// 		},
// 	},
// });
	
var searchHtml = '<div class="layui-form-item ns-icon-radio">';
	searchHtml += '<label class="layui-form-label sm">{{data.label}}</label>';
	searchHtml +=	 '<div class="layui-input-block">';
	searchHtml += 		 '<template v-for="(item,index) in list" v-bind:k="index">';
	searchHtml += 		 	'<span v-if="parent[data.field]==item.value">{{item.label}}</span>';
	searchHtml += 		 '</template>';
	searchHtml +=	 	'<ul class="ns-icon">';
	searchHtml +=		 	'<template v-for="(item,index) in list" v-bind:k="index">';
	// searchHtml +=				 '<div v-on:click="parent[data.field]=item.value" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (parent[data.field]==item.value) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>{{item.label}}</div></div>';
	searchHtml +=		 		'<li v-on:click="parent[data.field]=item.value" :class="{\'ns-text-color ns-border-color ns-bg-color-diaphaneity\':parent[data.field]==item.value}">';
	searchHtml +=		 			'<img :src="item.icon_img_active" v-if="parent[data.field]==item.value"/>';
	searchHtml +=		 			'<img :src="item.icon_img" v-else />';
	searchHtml +=		 		'</li>';
	searchHtml +=		 	'</template>';
	searchHtml +=	 	'</ul>';
	searchHtml +=	 '</div>';
	searchHtml += '</div>';
Vue.component("goods-search", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "textAlign",
					label: "文本位置"
				};
			}
		}
	},
	data: function () {
		return {
			list: [
				{
					label: "居左", 
					value: "left",
					icon_img:searchResourcePath + "/search/img/text_left.png",
					icon_img_active:searchResourcePath + "/search/img/text_left_hover.png"
				},
				{
					label: "居中", 
					value: "center",
					icon_img:searchResourcePath + "/search/img/text_right.png",
					icon_img_active:searchResourcePath + "/search/img/text_right_hover.png"
				},
			],
			parent: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "文本位置";
		if (this.data.field == undefined) this.data.field = "textAlign";
		
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
		//设置默认logo
		var error_img =  $('input[name="d_elem"]').val()
		if(!this.parent.searchImg){this.parent.searchImg = error_img;}
		
	},
	watch: {
		data: function (val, oldVal) {
			if (val.field == undefined) val.field = oldVal.field;
			if (val.label == undefined) val.label = "文本位置";
		},
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		}
	},
	template: searchHtml
});


var borderHtml = '<div class="layui-form-item ns-icon-radio">';
	borderHtml += 	'<label class="layui-form-label sm">{{data.label}}</label>';
	borderHtml +=	 '<div class="layui-input-block">';
	borderHtml += 		 '<template v-for="(item,index) in list" v-bind:k="index">';
	borderHtml += 		 	'<span v-if="parent[data.field]==item.value">{{item.label}}</span>';
	borderHtml += 		 '</template>';
	borderHtml +=	 	'<ul class="ns-icon">';
	borderHtml +=		 	'<template v-for="(item,index) in list" v-bind:k="index">';
	// searchHtml +=				 '<div v-on:click="parent[data.field]=item.value" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (parent[data.field]==item.value) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>{{item.label}}</div></div>';
	borderHtml +=		 		'<li v-on:click="parent[data.field]=item.value" :class="{\'ns-text-color ns-border-color ns-bg-color-diaphaneity\':parent[data.field]==item.value}">';
	borderHtml +=		 			'<img :src="item.icon_img_active" v-if="parent[data.field]==item.value"/>';
	borderHtml +=		 			'<img :src="item.icon_img" v-else />';
	borderHtml +=		 		'</li>';
	borderHtml +=		 	'</template>';
	borderHtml +=	 	'</ul>';
	borderHtml +=	 '</div>';
	borderHtml += '</div>';

Vue.component("search-border", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "borderType",
					label: "框体样式"
				};
			}
		}
	},
	data: function () {
		return {
			list: [
				{
					label: "方形", 
					value: 1,
					icon_img:searchResourcePath + "/search/img/border1.png",
					icon_img_active:searchResourcePath + "/search/img/border1_hover.png"
				},
				{
					label: "圆形",
					value: 2,
					icon_img:searchResourcePath + "/search/img/border2.png",
					icon_img_active:searchResourcePath + "/search/img/border2_hover.png"
				},
			],
			parent: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "框体样式";
		if (this.data.field == undefined) this.data.field = "borderType";
		
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
	},
	watch: {
		data: function (val, oldVal) {
			if (val.field == undefined) val.field = oldVal.field;
			if (val.label == undefined) val.label = "框体样式";
		},
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
	template: borderHtml
});

var typeHtml = '<div class="layui-form-item">';
	typeHtml +=	 	'<label class="layui-form-label sm">{{data.label}}</label>';
	typeHtml +=	 	'<div class="layui-input-block">';
	typeHtml +=			 '<template v-for="(item,index) in list" v-bind:k="index">';
	typeHtml +=				 '<div v-on:click="parent[data.field]=item.value" v-if="parent[data.field]==item.value"><div>{{item.label}}</div></div>';
	typeHtml +=			 '</template>';
	typeHtml +=	 	'</div>';
	typeHtml +=		'<div class="search_type">';
	typeHtml +=			 '<template v-for="(item,index) in list" v-bind:k="index">';
	typeHtml +=		 		'<div class="search_type_left" v-on:click="parent[data.field]=item.value,parent.searchStyle=1" :class="{\'active\':parent[data.field]==item.value}">';
	typeHtml +=		 			'<img :src="item.icon_img_active" v-if="parent[data.field]==item.value"/>';
	typeHtml +=		 			'<img :src="item.icon_img" v-else />';
	typeHtml +=		 		'</div>';
	typeHtml +=			 '</template>';
	typeHtml +=			 '</div>';
	typeHtml +=		 '<div class="search_logo" v-if="parent[data.field] == 2">';
	typeHtml +=		 	'<div class="" ><img-upload v-bind:data="{ data : parent, field : \'searchImg\' }" v-bind:isShow="!1"></img-upload></div>';
	typeHtml +=		 	'<div class="desc" >';
	typeHtml +=		 		'<div class="tip" >最多可添加一张图片</div>';
	typeHtml +=		 		'<div class="spec">85px*30px</div>';
	typeHtml +=	 		'</div>';
	typeHtml +=	 	'</div>';
	
	typeHtml += '</div>';
	

Vue.component("search-type", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "searchType",
					label: "选择模板"
				};
			}
		}
	},
	data: function () {
		return {
			list: [
				{
					label: "样式1", 
					value: 1,
					icon_img:searchResourcePath + "/search/img/search1.png",
					icon_img_active:searchResourcePath + "/search/img/search1_hover.png",
				},
				{
					label: "样式2", 
					value: 2,
					icon_img:searchResourcePath + "/search/img/search2.png",
					icon_img_active:searchResourcePath + "/search/img/search2_hover.png",
				},
			],
			parent: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "选择模板";
		if (this.data.field == undefined) this.data.field = "searchType";
		if(!this.parent.searchType){
			this.parent.searchType = 1
		}
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
	},
	watch: {
		data: function (val, oldVal) {
			if (val.field == undefined) val.field = oldVal.field;
			if (val.label == undefined) val.label = "选择模板";
		},
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
	template: typeHtml
});
var styleHtml = '<div class="layui-form-item">'
	styleHtml += '	<label class="layui-form-label sm">选择风格</label>'
	styleHtml += '	<div class="layui-input-block">'
	styleHtml += '		<div class="ns-input-text ns-text-color selected-style" v-on:click="selectPageStyle">风格{{$parent.data.searchStyle}} <i class="layui-icon layui-icon-right"></i></div>'
	// styleHtml += '		<div v-else class="ns-input-text selected-style" v-on:click="selectPageStyle">选择 <i class="layui-icon layui-icon-right"></i></div>'
	styleHtml += '	</div>'
	styleHtml += '</div>'
	

Vue.component("search-style", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "searchStyle",
					label: "风格1"
				};
			}
		}
	},
	data: function () {
		return {
			parent: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "选择风格";
		if (this.data.field == undefined) this.data.field = "searchStyle";
		if(!this.parent.searchStyle){
			this.parent.searchStyle = 1
		}
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
	},
	watch: {
		data: function (val, oldVal) {
			if (val.field == undefined) val.field = oldVal.field;
			if (val.label == undefined) val.label = "选择风格";
		},
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
		
		//选择页面顶部风格
		selectPageStyle: function() {
			var self = this;
			console.log($('layui-layer-content .search_style'))
			$('layui-layer-content .search_style').css('display','block !important')
			layer.open({
				type: 1,
				title: '风格选择',
				area:['930px','630px'],
				btn: ['确定', '返回'],
				content: $(".search_style").html(),
				success: function(layero, index) {
					$("body").on("click", ".layui-layer-content .sytle .text-title", function () {
							$(this).addClass("active").siblings().removeClass("active");
							var index = $(this).data('index')
							self.$parent.data.searchStyle = index
					});
				},
				yes: function (index, layero) {
					// self.data.style = $(".layui-layer-content input[name='style']").val();
					layer.closeAll()
				}
			});
		},
	},
	template: styleHtml
});
