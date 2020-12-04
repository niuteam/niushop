/**
 * 空的验证组件，后续如果增加业务，则更改组件
 */

var emptyHtml = '<div class="layui-form-item"></div>';

Vue.component("title-empty", {
	template: emptyHtml,
	data: function () {
		return {
		}
	},
	created:function() {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods: {
		
		verify : function () {
			
			var res = {code: true, message: ""};
			var _self = this;
			if (this.$parent.data.title.length == 0) {
				res.code = false;
				res.message = "顶部标题不能为空";
				setTimeout(function () {
					$("#title_" + _self.$parent.data.index).focus();
				}, 10);
			}else if (this.$parent.data.title.length > 24) {
				res.code = false;
				res.message = "顶部标题最多24个字符";
				setTimeout(function () {
					$("#title_" + _self.$parent.data.index).focus();
				}, 10);
			}else if (this.$parent.data.isOpenOperation) {
				if (this.$parent.data.operationName.length == 0) {
					res.code = false;
					res.message = "功能名称不能为空";
					setTimeout(function () {
						$("#top_operation_" + _self.$parent.data.index).focus();
					}, 10);
				}
				if (this.$parent.data.operationName.length > 10) {
					res.code = false;
					res.message = "功能名称最多10个字符";
					setTimeout(function () {
						$("#top_operation_" + _self.$parent.data.index).focus();
					}, 10);
				}
			}
			return res;
		}
	}
});