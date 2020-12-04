/**
 * 底部导航·组件
 */
var bottomMenuHtml = '<div class="bottom-menu-config">';
		bottomMenuHtml += '<div class="template-edit-title"><h3>导航样式设置</h3><i onclick="closeBox(this)" class="layui-icon layui-icon-down"></i></div>';
		bottomMenuHtml += '<div>';
		bottomMenuHtml += '<div class="layui-form-item ns-icon-radio">';
			bottomMenuHtml += '<label class="layui-form-label sm">导航类型</label>';
			bottomMenuHtml += '<div class="layui-input-block">';
				bottomMenuHtml += '<template v-for="(item, index) in typeList" v-bind:k="index">'
					bottomMenuHtml += '<span :class="[item.value == data.type ? \'\' : \'layui-hide\']">{{item.label}}</span>'
				bottomMenuHtml += '</template>'
				bottomMenuHtml += '<ul class="ns-icon">'
					bottomMenuHtml += '<li v-for="(item, index) in typeList" v-bind:k="index" v-bind:class="{\'ns-text-color ns-border-color ns-bg-color-diaphaneity\':data.type==item.value}" v-on:click="data.type=item.value">'
						bottomMenuHtml += '<img v-if="data.type==item.value" :src="item.selectedSrc" />'
						bottomMenuHtml += '<img v-else :src="item.src" />'
					bottomMenuHtml += '</li>'
				bottomMenuHtml += '</ul>'
				// bottomMenuHtml += '<template v-for="(item,index) in typeList" v-bind:k="index">';
				// 	bottomMenuHtml += '<div v-on:click="($parent.data.type=item.value)" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : ($parent.data.type==item.value) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>{{item.label}}</div></div>';
				// bottomMenuHtml += '</template>';
			bottomMenuHtml += '</div>';
		bottomMenuHtml += '</div>';

		// bottomMenuHtml += '<font-size v-bind:data="{ value : $parent.data.fontSize }"></font-size>';
		bottomMenuHtml += '<color v-bind:data="{ field: \'backgroundColor\', label: \'背景颜色\' }"></color>';
		bottomMenuHtml += '<color v-show="$parent.data.type == 1 || $parent.data.type == 3"></color>';
		bottomMenuHtml += '<color v-bind:data="{ field: \'textHoverColor\', label: \'选中颜色\' }" v-show="$parent.data.type == 1 || $parent.data.type == 3"></color>';

		// bottomMenuHtml += '<div class="layui-form-item ns-checkbox-wrap">';
		// 	bottomMenuHtml += '<label class="layui-form-label sm">导航悬浮</label>';
		// 	bottomMenuHtml += '<div class="layui-input-block">';
		// 		bottomMenuHtml += '<span v-if="$parent.data.bulge == true">是</span>';
		// 		bottomMenuHtml += '<span v-else>否</span>'
		// 		bottomMenuHtml += '<div v-if="$parent.data.bulge == true" v-on:click="$parent.data.bulge=!$parent.data.bulge" class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>'
		// 		bottomMenuHtml += '<div v-else v-on:click="$parent.data.bulge=!$parent.data.bulge" class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>'
		// 		// bottomMenuHtml += '<div class="layui-unselect layui-form-switch" v-bind:class="{ \'layui-form-onswitch\' : $parent.data.bulge }" v-on:click="$parent.data.bulge=!$parent.data.bulge"><em></em><i></i></div>';
		// 	bottomMenuHtml += '</div>';
		// bottomMenuHtml += '</div>';
		bottomMenuHtml += '</div>';

		
		bottomMenuHtml += '<div class="template-edit-title"><h3>导航内容设置</h3><i onclick="closeBox(this)" class="layui-icon layui-icon-down"></i></div>';
		bottomMenuHtml += '<ul>';
			// bottomMenuHtml += '<p class="hint">当有5个底部导航时，中间导航会悬浮显示</p>';
			bottomMenuHtml += '<li v-for="(item,index) in menuList">';
				bottomMenuHtml += '<div class="image-block" v-show="$parent.data.type != 3">';
					bottomMenuHtml += '<img-upload v-bind:data="{ data : item,field : \'iconPath\' }"></img-upload>';
					bottomMenuHtml += '<img-upload v-bind:data="{ data : item, field : \'selectedIconPath\', text : \'选中图片\' }" v-show="$parent.data.type != 3"></img-upload>';
				bottomMenuHtml += '</div>';

				bottomMenuHtml += '<div class="content-block">';
					bottomMenuHtml += '<div class="layui-form-item" v-show="$parent.data.type == 1 || $parent.data.type == 3">';
						bottomMenuHtml += '<label class="layui-form-label sm">标题</label>';
						bottomMenuHtml += '<div class="layui-input-block">';
							bottomMenuHtml += '<input type="text" name=\'text\' v-model="item.text" v-on:keyup="listenText(index,item.text)" class="layui-input" />';
						bottomMenuHtml += '</div>';
					bottomMenuHtml += '</div>';

					bottomMenuHtml += '<nc-link v-bind:data="{ field : $parent.data.list[index].link }"></nc-link>';
				bottomMenuHtml += '</div>';

				// bottomMenuHtml += '<div class="img-hover-block">';
				// 	bottomMenuHtml += '<img-upload v-bind:data="{ data : item, field : \'selectedIconPath\', text : \'选中图片\' }" v-show="$parent.data.type != 3"></img-upload>';
				// bottomMenuHtml += '</div>';
	
				bottomMenuHtml += '<i class="del" v-on:click="menuList.splice(index,1)" data-disabled="1">x</i>';
	
				bottomMenuHtml += '<div class="error-msg"></div>';

			bottomMenuHtml += '</li>';

		bottomMenuHtml += '</ul>';

		bottomMenuHtml += '<div class="add-item ns-text-color" v-if="showAddItem" v-on:click="menuList.push({iconPath: \'\', selectedIconPath: \'\', text: \'菜单\', link: {}})">';
			bottomMenuHtml += '<i>+</i>';
			bottomMenuHtml += '<span>添加一个图文导航</span>';
		bottomMenuHtml += '</div>';

		bottomMenuHtml += '<p class="hint">建议上传比例相同的图片，最多添加 {{maxTip}} 个底部导航</p>';

	bottomMenuHtml += '</div>';

Vue.component("bottom-menu", {
	
	template: bottomMenuHtml,
	data: function () {
		
		return {
			data: this.$parent.data,
			typeList: [
				{
					label: "图文", 
					value: 1,
					src: STATICEXT+"/diyview/img/nav_style/img_text.png",
					selectedSrc:STATICEXT+"/diyview/img/nav_style/img_text_hover.png"
				},
				{
					label: "图片", 
					value: 2,
					src: STATICEXT+"/diyview/img/nav_style/img.png",
					selectedSrc:STATICEXT+"/diyview/img/nav_style/img_1.png"
				},
				{
					label: "文字",
					value: 3,
					src: STATICEXT+"/diyview/img/nav_style/font.png",
					selectedSrc:STATICEXT+"/diyview/img/nav_style/font_1.png"
				},
			],
			menuList: this.$parent.data.list,
			showAddItem: true,
			maxTip: 5,
		};
		
	},
	created: function () {
		this.changeShowAddItem();
	},
	
	methods: {
		
		listenText: function (index, text) {
			if (text.length > 6) {
				this.data.list[index].text = this.data.list[index].text.substr(0, 5);
				layer.msg("字数不能超出5位");
			}
		},
		
		//改变图文导航按钮的显示隐藏
		changeShowAddItem: function () {
			
			if (this.menuList.length >= this.maxTip) this.showAddItem = false;
			else this.showAddItem = true;
			
		},
	},
	
	watch: {
		menuList: function () {
			this.changeShowAddItem();
		}
	}
});

/**
 * 底部导航Vue对象
 */
var vue = new Vue({
	
	el: "#bottomNav",
	
	data: {
		
		data: {
			type: 1,
			// fontSize: 14,
			textColor: "#333333",
			textHoverColor: "#ff0036",
			backgroundColor: "#ffffff",
			bulge : true,
			list: [
				{iconPath: '', selectedIconPath: '', text: '菜单', link: {}},
				{iconPath: '', selectedIconPath: '', text: '菜单', link: {}},
				{iconPath: '', selectedIconPath: '', text: '菜单', link: {}},
				{iconPath: '', selectedIconPath: '', text: '菜单', link: {}},
			],
		},
		selected: -1,
	},
	created: function () {
		if (bottomNavInfo) this.data = bottomNavInfo;
	},
	methods: {
		
		mouseOver: function (index) {
			this.selected = index;
		},
		mouseOut: function () {
			this.selected = -1;
		},
		
		//转换图片路径
		changeImgUrl: function (url) {
			if (url == null || url == "") return '';
			if (url.indexOf("static/img/") > -1) return ns.img(STATICIMG + "/" + url.replace("static/img/", ""));
			else return ns.img(url);
		},
		
	}
});

var repeat_flag = false;//防重复标识
$("button.save").click(function () {
	
	// 验证
	var verify = {
		flag : false,
		message : ""
	};
	for (var i=0;i<vue.data.list.length;i++) {
		var item = vue.data.list[i];
		if (vue.data.type == 1) {
			// 图文
			if (item.text == '') {
				verify.flag = true;
				verify.message = "请输入第[" + (i + 1) + "]个标题";
				break;
			}
			if (item.iconPath == '') {
				verify.flag = true;
				verify.message = "请上传第[" + (i + 1) + "]个图片";
				break;
			}
			if (item.selectedIconPath == '') {
				verify.flag = true;
				verify.message = "请上传第[" + (i + 1) + "]个选中图片";
				break;
			}
		} else if (vue.data.type == 2) {
			// 图片
			if (item.iconPath == '') {
				verify.flag = true;
				verify.message = "请上传第[" + (i + 1) + "]个图片";
				break;
			}
			if (item.selectedIconPath == '') {
				verify.flag = true;
				verify.message = "请上传第[" + (i + 1) + "]个选中图片";
				break;
			}
		} else if (vue.data.type == 3) {
			// 文字
			if (item.text == '') {
				verify.flag = true;
				verify.message = "请输入第[" + (i + 1) + "]个标题";
				break;
			}
		}
		if ($.isEmptyObject(item.link)) {
			verify.flag = true;
			verify.message = "请选择链接地址";
			break;
		}
	}
	
	if(verify.flag){
		layer.msg(verify.message);
		return;
	}
	
	if (repeat_flag) return;
	repeat_flag = true;
	
	$.ajax({
		type: "post",
		url: ns.url("shop/diy/bottomNavDesign"),
		data: {value: JSON.stringify(vue.data)},
		dataType: "JSON",
		success: function (res) {
			layer.msg(res.message);
			if (res.code == 0) {
				location.reload();
			} else {
				repeat_flag = false;
			}
		}
	});
});