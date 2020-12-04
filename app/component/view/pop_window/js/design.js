/**
 * 弹窗广告·组件
 */

//[弹窗广告]属性组件
var html = '<div class="pop-window-config">';
		html +='<div class="layui-form-item">';
			html +=	'<label class="layui-form-label sm">显示次数</label>';
			html +=	'<div class="layui-input-block">';
				html +=	'<input type="number" class="layui-input" v-model="showCount" />';
			html +=	'</div>';
		html +='</div>';

		html += '<ul>';
			html += '<li >';
			html += '<div class="image-block">';
				html += '<img-upload v-bind:data="{ data : $parent.data, field : \'imageUrl\' }"></img-upload>';
			html += '</div>';
			
			html += '<div class="content-block">';
				html += '<nc-link v-bind:data="{ field : $parent.data.link }"></nc-link>';
			html += '</div>';
			
			html += '<div class="error-msg"></div>';
			html += '</li>';
		html += '</ul>';
	html += '</div>';

Vue.component("pop-window",{
	template : html,
	data : function(){
		return {
			data : this.$parent.data,
			showCount: this.$parent.data.showCount
		};
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	watch: {
		showCount: {
			handler:function(val,oldval){
				this.$parent.data.showCount = val;
			}
		}
	},
	methods: {
		verify: function () {
			var res = {code: true, message: ""};
			if (this.$parent.data.showCount == null || this.$parent.data.showCount.length === 0) {
				res.code = false;
				res.message = "请输入显示次数";
			}else if (this.$parent.data.imageUrl == null || this.$parent.data.imageUrl.length === 0) {
				res.code = false;
				res.message = "请上传弹框广告图片";
			}else if (this.$parent.data.link == null) {
				res.code = false;
				res.message = "请选择或输入弹框广告的链接地址";
			}
			return res;
		}
	}
});