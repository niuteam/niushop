var seckillHtml = '<div class="layui-form-item">';
		seckillHtml += '<label class="layui-form-label sm">选择风格</label>';
		seckillHtml += '<div class="layui-input-block choose-style">';
			seckillHtml += '<div class="ns-input-text ns-text-color selected-style" v-on:click="selectTestStyle">选择</div>';
		seckillHtml += '</div>';
	seckillHtml += '</div>';

Vue.component("seckill-style", {
	template: seckillHtml,
	data: function() {
		return {
			data: this.$parent.data,
		}
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
		selectTestStyle: function() {
			var self = this;
			layer.open({
				type: 1,
				title: '风格选择',
				area:['930px','630px'],
				btn: ['确定', '返回'],
				content: $(".draggable-element[data-index='" + self.data.index + "'] .edit-attribute .seckill-list-style").html(),
				success: function(layero, index) {
					$(".layui-layer-content input[name='style']").val(self.data.style);
					$("body").on("click", ".layui-layer-content .style-list-con-seckill .style-li-seckill", function () {
						$(this).addClass("selected ns-border-color").siblings().removeClass("selected ns-border-color");
						$(".layui-layer-content input[name='style']").val($(this).index() + 1);
					});
				},
				yes: function (index, layero) {
					self.data.style = $(".layui-layer-content input[name='style']").val();
					layer.closeAll()
				}
			});
		},
	}
})

// 多选
var seckillContentHtml = '<div class="layui-form-item goods-show-box">';
	seckillContentHtml +=	'<div class="layui-input-inline">';
	seckillContentHtml +=		'<div v-on:click="changeStatus(\'isShowGoodsName\')" class="layui-unselect layui-form-checkbox" v-bind:class="{\'layui-form-checked\': (data.isShowGoodsName == 1)}" lay-skin="primary"><span>商品名称</span><i class="layui-icon layui-icon-ok"></i></div>';
	// seckillContentHtml +=		'<div v-on:click="changeStatus(\'isShowGoodsDesc\', data.isShowGoodsDesc)" id="isShowGoodsDesc" class="layui-unselect layui-form-checkbox" v-bind:class="{\'layui-form-checked\': (data.isShowGoodsDesc == 1)}" lay-skin="primary"><span>商品描述</span><i class="layui-icon layui-icon-ok"></i></div>';
	seckillContentHtml +=		'<div v-on:click="changeStatus(\'isShowGoodsPrice\')" class="layui-unselect layui-form-checkbox" v-bind:class="{\'layui-form-checked\': (data.isShowGoodsPrice == 1)}" lay-skin="primary"><span>商品价格</span><i class="layui-icon layui-icon-ok"></i></div>';
	seckillContentHtml +=		'<div v-on:click="changeStatus(\'isShowGoodsPrimary\')" class="layui-unselect layui-form-checkbox" v-bind:class="{\'layui-form-checked\': (data.isShowGoodsPrimary == 1)}" lay-skin="primary"><span>商品原价</span><i class="layui-icon layui-icon-ok"></i></div>';
	// seckillContentHtml +=		'<div v-on:click="changeStatus(\'isShowGoodsStock\', data.isShowGoodsStock)" id="isShowGoodsStock" class="layui-unselect layui-form-checkbox" v-bind:class="{\'layui-form-checked\': (data.isShowGoodsStock == 1)}" lay-skin="primary"><span>剩余库存</span><i class="layui-icon layui-icon-ok"></i></div>';
	seckillContentHtml +=	'</div>';
	seckillContentHtml += '</div>';

Vue.component("seckill-content", {
	template: seckillContentHtml,
	data: function () {
		return {
			data: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
		changeStatus: function(field) {
			this.$parent.data[field] = this.$parent.data[field] ? 0 : 1;
		}
	}
});


// 顶部内容组件
var seckillTopConHtml = '<div class="goods-head">';
	seckillTopConHtml +=	'<div class="title-wrap">';
	seckillTopConHtml +=		'<div class="left-icon" v-if="list.imageUrl"><img v-bind:src="$parent.$parent.changeImgUrl(list.imageUrl)" /></div>';
	seckillTopConHtml +=		'<span class="name" v-bind:style="{color: data.titleTextColor}">{{list.title}}</span>';
	seckillTopConHtml +=		'<div class="time">距结束<span class="hour">02</span>:<span class="minute">00</span>:<span class="second">00</span></div>';
	seckillTopConHtml +=	'</div>';
	seckillTopConHtml +=	'<div class="more ns-red-color" v-if="listMore.title">';
	seckillTopConHtml +=		'<span v-bind:style="{color: data.moreTextColor}">{{listMore.title}}</span>';
	seckillTopConHtml +=		'<div class="right-icon" v-if="listMore.imageUrl"><img v-bind:src="$parent.$parent.changeImgUrl(listMore.imageUrl)" /></div>';
	seckillTopConHtml +=		'<i class="iconfont iconyoujiantou" v-else v-bind:style="{color: data.moreTextColor}"></i>';
	seckillTopConHtml +=	'</div>';
	seckillTopConHtml +='</div>';

Vue.component("seckill-top-content", {
	data: function () {
		return {
			data: this.$parent.data,
			list: this.$parent.data.list,
			listMore: this.$parent.data.listMore
		}
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
	template: seckillTopConHtml
});


// 图片上传
var seckillTopHtml = '<ul class="fenxiao-addon-title">';
		seckillTopHtml += '<li>';
		
			seckillTopHtml += '<div class="layui-form-item">';
				seckillTopHtml += '<label class="layui-form-label sm">左侧图标</label>';
				seckillTopHtml += '<div class="layui-input-block">';
					seckillTopHtml += '<img-upload v-bind:data="{ data : list }"></img-upload>';
				seckillTopHtml += '</div>';
			seckillTopHtml += '</div>';
			
			seckillTopHtml += '<div class="content-block">';
				seckillTopHtml += '<div class="layui-form-item">';
					seckillTopHtml += '<label class="layui-form-label sm">标题</label>';
					seckillTopHtml += '<div class="layui-input-block">';
						seckillTopHtml += '<input type="text" name=\'title\' v-model="list.title" class="layui-input" />';
					seckillTopHtml += '</div>';
				seckillTopHtml += '</div>';
			seckillTopHtml += '</div>';
			
			seckillTopHtml += '<color v-bind:data="{ field : \'titleTextColor\', label : \'标题颜色\', defaultcolor: \'#000\' }"></color>';
		seckillTopHtml += '</li>';
		
		seckillTopHtml += '<li>';
			// seckillTopHtml += '<div class="layui-form-item">';
			// 	seckillTopHtml += '<label class="layui-form-label sm">右侧图标</label>';
			// 	seckillTopHtml += '<div class="layui-input-block">';
			// 		seckillTopHtml += '<img-upload v-bind:data="{ data : item }"></img-upload>';
			// 	seckillTopHtml += '</div>';
			// seckillTopHtml += '</div>';
			
			seckillTopHtml += '<div class="content-block">';
				seckillTopHtml += '<div class="layui-form-item">';
					seckillTopHtml += '<label class="layui-form-label sm">文本内容</label>';
					seckillTopHtml += '<div class="layui-input-block">';
						seckillTopHtml += '<input type="text" name=\'title\' v-model="listMore.title" class="layui-input" />';
					seckillTopHtml += '</div>';
				seckillTopHtml += '</div>';
				seckillTopHtml += '<color v-bind:data="{ field : \'moreTextColor\', defaultcolor: \'#858585\' }"></color>';
				
				// seckillTopHtml += '<nc-link v-bind:data="{ field : $parent.data.list[index].link }"></nc-link>';
				
			seckillTopHtml += '</div>';
		seckillTopHtml += '</li>';
	seckillTopHtml += '</ul>';

Vue.component("seckill-top-list",{
	template : seckillTopHtml,
	data : function(){
		return {
            data : this.$parent.data,
			list : this.$parent.data.list,
			listMore: this.$parent.data.listMore
		};
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods : {
		verify:function () {
			var res = { code : true, message : "" };
			var _self = this;
			$(".draggable-element[data-index='" + this.data.index + "'] .graphic-navigation .graphic-nav-list>ul>li").each(function(index){
				
				if(_self.selectedTemplate == "imageNavigation"){
					$(this).find("input[name='title']").removeAttr("style");//清空输入框的样式
					//检测是否有未上传的图片
					if(_self.list[index].imageUrl == ""){
						res.code = false;
						res.message = "请选择一张图片";
						$(this).find(".error-msg").text("请选择一张图片").show();
						return res;
					}else{
						$(this).find(".error-msg").text("").hide();
					}
				}else{
					if(_self.list[index].title == ""){
						res.code = false;
						res.message = "请输入标题";
						$(this).find("input[name='title']").attr("style","border-color:red !important;").focus();
						$(this).find(".error-msg").text("请输入标题").show();
						return res;
					}else{
						$(this).find("input[name='title']").removeAttr("style");
						$(this).find(".error-msg").text("").hide();
					}
				}
			});
			return res;
		}
	}
});