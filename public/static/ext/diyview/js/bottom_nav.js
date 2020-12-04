/**
 * 底部导航·组件
 */
var bottomMenuHtml = '<div class="bottom-menu-config">';
		bottomMenuHtml += '<div class="layui-form-item">';
			bottomMenuHtml += '<label class="layui-form-label sm">导航类型</label>';
			bottomMenuHtml += '<div class="layui-input-block">';
				bottomMenuHtml += '<template v-for="(item,index) in typeList" v-bind:k="index">';
					bottomMenuHtml += '<div v-on:click="($parent.data.type=item.value)" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : ($parent.data.type==item.value) }"><i class="layui-anim layui-icon">&#xe643;</i><div>{{item.label}}</div></div>';
				bottomMenuHtml += '</template>';
			bottomMenuHtml += '</div>';
		bottomMenuHtml += '</div>';

		// bottomMenuHtml += '<font-size v-bind:data="{ value : $parent.data.fontSize }"></font-size>';
		bottomMenuHtml += '<color v-bind:data="{ field: \'backgroundColor\', label: \'背景颜色\' }"></color>';
		bottomMenuHtml += '<color v-show="$parent.data.type == 1 || $parent.data.type == 3"></color>';
		bottomMenuHtml += '<color v-bind:data="{ field: \'textHoverColor\', label: \'选中颜色\' }" v-show="$parent.data.type == 1 || $parent.data.type == 3"></color>';

		bottomMenuHtml += '<div class="layui-form-item">';
			bottomMenuHtml += '<label class="layui-form-label sm">导航悬浮</label>';
			bottomMenuHtml += '<div class="layui-input-block">';
				bottomMenuHtml += '<div class="layui-unselect layui-form-switch" v-bind:class="{ \'layui-form-onswitch\' : $parent.data.bulge }" v-on:click="$parent.data.bulge=!$parent.data.bulge"><em></em><i></i></div>';
			bottomMenuHtml += '</div>';
		bottomMenuHtml += '</div>';
		
		bottomMenuHtml += '<p class="hint">当有5个底部导航时，中间导航会悬浮显示</p>';

		bottomMenuHtml += '<ul>';
			bottomMenuHtml += '<li v-for="(item,index) in menuList">';
				bottomMenuHtml += '<div class="image-block" v-show="$parent.data.type != 3">';
					bottomMenuHtml += '<img-upload v-bind:data="{ data : item,field : \'iconPath\' }"></img-upload>';
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

				bottomMenuHtml += '<div class="img-hover-block">';
					bottomMenuHtml += '<img-upload v-bind:data="{ data : item, field : \'selectedIconPath\', text : \'选中图片\' }" v-show="$parent.data.type != 3"></img-upload>';
				bottomMenuHtml += '</div>';
	
				bottomMenuHtml += '<i class="del" v-on:click="menuList.splice(index,1)" data-disabled="1">x</i>';
	
				bottomMenuHtml += '<div class="error-msg"></div>';

			bottomMenuHtml += '</li>';

		bottomMenuHtml += '</ul>';

		bottomMenuHtml += '<div class="add-item ns-text-color" v-if="showAddItem" v-on:click="menuList.push({iconPath: \'\', selectedIconPath: \'\', text: \'菜单\', link: {}})">';
			bottomMenuHtml += '<i>+</i>';
			bottomMenuHtml += '<span>添加一个图文导航</span>';
		bottomMenuHtml += '</div>';

		bottomMenuHtml += '<p class="hint">建议上传比例相同的图片，最多添加 {{maxTip}} 个底部导航，拖动选中的导航可对其排序</p>';

	bottomMenuHtml += '</div>';

Vue.component("bottom-menu", {
	
	template: bottomMenuHtml,
	data: function () {
		
		return {
			data: this.$parent.data,
			typeList: [
				{label: "图文", value: 1},
				{label: "图片", value: 2},
				{label: "文字", value: 3},
			],
			menuList: this.$parent.data.list,
			showAddItem: true,
			maxTip: 5,
		};
		
	},
	created: function () {
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
	
	if (repeat_flag) return;
	repeat_flag = true;
	
	$.ajax({
		type: "post",
		url: ns.url("admin/diy/bottomNavDesign"),
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