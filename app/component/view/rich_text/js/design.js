var html = '<div class="rich-text-list">';
		html += '<div v-bind:id="id" style="width:100%;height:320px;padding-left: 10px; box-sizing: border-box;"></div>';
		
		html += '<div class="template-edit-title">';
			html += '<h3>其他设置</h3>';
			html += '<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>';
		html += '</div>';
		
		html += '<div class="template-edit-wrap">';
			html += '<color v-bind:data="{ field : \'backgroundColor\', \'label\' : \'背景颜色\' }"></color>';
			html += '<slide v-bind:data="{ field : \'marginTop\', label : \'页面边距\' }"></slide>';
		html += '</div>';
	html += '</div>';

Vue.component("rich-text", {
	template: html,
	data: function () {

		return {
			data : this.$parent.data,
			id: ns.gen_non_duplicate(10),
			editor : null,
			padding : this.$parent.data.padding,
		}
	},
	created: function () {

		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		
		var self = this;
		setTimeout(function () {
			
			self.editor = UE.getEditor(self.id);
			
			self.editor.ready(function () {
				if(self.$parent.data.html) self.editor.setContent(self.$parent.data.html);
			});
			
			self.editor.addListener("contentChange",function(){
				self.$parent.data.html = self.editor.getContent();
			});
			
		}, 10);
		
	},
	methods:{

		verify : function () {
			var res = {code: true, message: ""};
			if (this.$parent.data.html == "") {
				res.code = false;
				res.message = "请输入富文本内容";
			}
			return res;
		}
	}
});