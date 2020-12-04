var vue = new Vue({
	el: "#diyView",
	data: {
		currentIndex: 0,// 当前编辑的位置
		bgColorList: ["#ff454f", "#1e9fff", "#ff547b", "#c3a769", "#ff8d17", "#b2b2b2", "#98cb71", "#333333", "#0adb9a", "#5fb878"],
		topStyleList: [
			{
				text: "系统风格",
				value: "default"
			},
			{
				text: "自定义风格",
				value: "diy"
			}
		],
		menuStyleList: [
			{
				text: "宫格式",
				value: "palace"
			},
			{
				text: "列表式",
				value: "list"
			}
		],
		tempLink: {},
		repeat_flag: false,
		data: {
			textColor: "#ffffff",
			bgImg: 'upload/uniapp/member/index/member_bg.png',
			bgColor: "#ff454f",
			topStyle: 'default',
			menuStyle: "palace",
			level:1,
			insertGap: 0, // 插入间隔
			menuList: [
				{
					tag: 'membersignin',
					text: '签到',
					img: 'upload/uniapp/member/index/menu/default_sign.png',
					link: {
						"name": "SIGN_IN",
						"title": "签到",
						"wap_url": "/otherpages/member/signin/signin",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					text: '个人资料',
					img: 'upload/uniapp/member/index/menu/default_person.png',
					link: {
						"name": "MEMBER_INFO",
						"title": "个人资料",
						"wap_url": "/pages/member/info/info",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					text: '收货地址',
					img: 'upload/uniapp/member/index/menu/default_address.png',
					link: {
						"name": "SHIPPING_ADDRESS",
						"title": "收货地址",
						"wap_url": "/otherpages/member/address/address",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					tag: 'memberwithdraw',
					text: '账户列表',
					img: 'upload/uniapp/member/index/menu/default_cash.png',
					link: {
						"name": "ACCOUNT",
						"title": "账户列表",
						"wap_url": "/otherpages/member/account/account",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					tag: 'coupon',
					text: '优惠券',
					img: 'upload/uniapp/member/index/menu/default_discount.png',
					link: {
						"name": "COUPON",
						"title": "优惠券",
						"wap_url": "/otherpages/member/coupon/coupon",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					tag: 'pintuan',
					text: '我的拼单',
					img: 'upload/uniapp/member/index/menu/default_store.png',
					link: {
						"name": "MY_PINTUAN",
						"title": "我的拼团",
						"wap_url": "/promotionpages/pintuan/my_spell/my_spell",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					text: '我的关注',
					img: 'upload/uniapp/member/index/menu/default_like.png',
					link: {
						"name": "ATTENTION",
						"title": "我的关注",
						"wap_url": "/otherpages/member/collection/collection",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					text: '我的足迹',
					img: 'upload/uniapp/member/index/menu/default_toot.png',
					link: {
						"name": "FOOTPRINT",
						"title": "我的足迹",
						"wap_url": "/otherpages/member/footprint/footprint",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					tag: 'pointexchange',
					text: '积分兑换',
					img: 'upload/uniapp/member/index/menu/default_point_recond.png',
					link: {
						"name": "INTEGRAL_CONVERSION",
						"title": "积分兑换",
						"wap_url": "/promotionpages/point/order_list/order_list",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					tag: 'verifier',
					text: '核销台',
					img: 'upload/uniapp/member/index/menu/default_verification.png',
					link: {
						"name": "VERIFICATION_PLATFORM",
						"title": "核销台",
						"wap_url": "/otherpages/verification/index/index",
					},
					isShow: 1,
					isSystem: 1,
					remark: '成为核销员时显示'
				},
				{
					tag: 'fenxiao',
					text: '分销中心',
					img: 'upload/uniapp/member/index/menu/default_fenxiao.png',
					link: {
						"name": "DISTRIBUTION_CENTRE",
						"title": "分销中心",
						"wap_url": "/otherpages/fenxiao/index/index",
					},
					isShow: 1,
					isSystem: 1
				},
				{
					tag: 'bargain',
					text: '我的砍价',
					img: 'upload/uniapp/member/index/menu/default_bargain.png',
					link: {
						"name": "MY_BARGAIN",
						"title": "我的砍价",
						"wap_url": "/promotionpages/bargain/my_bargain/my_bargain",
					},
					isShow: 1,
					isSystem: 1
				}
			],
		}
	},
	created: function () {
		var info = JSON.parse($("#info").val().toString());
		for (var k in info) {
			if (this.data[k] != undefined) this.data[k] = info[k];
		}
	},
	methods: {
		//转换图片路径
		changeImgUrl: function (url) {
			if (url == null || url == "") return '';
			else return ns.img(url);
		},
		editMenu: function (i) {
			var self = this;
			var data = JSON.parse(JSON.stringify(self.data.menuList[i]));
			data.i = i;
			this.openEditMenu('edit', data, i);
		},
		addMenu: function () {
			this.openEditMenu("add");
		},
		deleteMenu: function (i) {
			this.data.menuList.splice(i, 1);
		},
		openEditMenu: function (tag, data, i) {
			var self = this;
			if (tag == 'add') data = {};
			laytpl($("#editMenuHtml").html()).render(data, function (html) {
				layer.open({
					title: '编辑菜单',
					btn: ['保存', '取消'],
					type: 1,
					area: ['400px'],
					content: html,
					success: function (layero, index) {
						var $parent = $("#menuImgUpload").parent();
						$("#menuImgUpload").click(function () {
							openAlbum(function (data) {
								$parent.find("input[type='hidden']").val(data[0].pic_path);
								$parent.find(".del").addClass("show");
								$parent.find(".upload-img-box").html("<img src=" + ns.img(data[0].pic_path) + " >");
							}, 1);
						});

						$parent.find(".del").click(function () {
							var path = $parent.find("input[type='hidden']").val();
							if (!path) return;
							$parent.find("input[type='hidden']").val("");
							$(this).removeClass("show");
							$parent.find(".upload-img-box").html(`<div class="ns-upload-default"><img src="${ns_url.SHOPIMG}/upload_img.png" /></div>`);

						});
					},
					yes: function (index, layero) {
						if ($("input[name='menu_text']").val().length == 0) {
							layer.msg("请输入菜单名称");
							$("input[name='menu_text']").focus();
							return;
						}
						if ($("input[name='menu_img']").val().length == 0) {
							layer.msg("请上传菜单图标");
							return;
						}
						if (tag == 'add') {
							if (!self.tempLink.title) {
								layer.msg("请选择跳转链接");
								return;
							}
							self.data.menuList.push({
								text: $("input[name='menu_text']").val(),
								img: $("input[name='menu_img']").val(),
								link: self.tempLink,
								isShow: 1,
								isSystem: 0
							});
							self.tempLink = {};
						} else {
							self.data.menuList[i].link = self.tempLink;
							if (!self.data.menuList[i].link.title) {
								layer.msg("请选择跳转链接");
								return;
							}
							self.data.menuList[i].text = $("input[name='menu_text']").val();
							self.data.menuList[i].img = $("input[name='menu_img']").val();
						}
						layer.closeAll();
					}
				});
			});
		},
		//刷新数据排序
		refresh: function () {
			var self = this;
			//vue框架执行，异步操作组件列表的排序
			setTimeout(function () {

				$(".menu-list>ul li").each(function (i) {
					$(this).attr("data-sort", i);
				});

				for (var i = 0; i < self.data.menuList.length; i++) {
					self.data.menuList[i].index = $(".menu-list>ul li[data-index=" + i + "]").attr("data-index");
					self.data.menuList[i].sort = $(".menu-list>ul li[data-index=" + i + "]").attr("data-sort");
				}

				//触发变异方法，进行视图更新。不能用sort()方法，会改变组件的顺序，导致显示的顺序错乱
				self.data.menuList.push({});
				self.data.menuList.pop();
				// console.log("触发变异方法，进行视图更新。不能用sort()方法，会改变组件的顺序，导致显示的顺序错乱");

			}, 50);

		},
		save: function () {
			var self = this;
			if (this.repeat_flag) return;
			this.repeat_flag = true;

			//组件属性
			var data = JSON.parse(JSON.stringify(vue.data));

			//重新排序
			data.menuList.sort(function(a,b){
				return a.sort-b.sort;
			});

			for (var i=0;i<data.menuList.length;i++){
				delete data.menuList[i].index;
				delete data.menuList[i].sort;
			}

			$.ajax({
				type: 'POST',
				url: ns.url("shop/diy/memberindex"),
				data: {data: data},
				dataType: 'JSON',
				success: function (res) {
					layer.msg(res.message);
					self.repeat_flag = false;
					if (res.code == 0) {
						location.reload();
					}
				}
			});
		},
	},
	computed:{
		handleMenuList:function () {
			var data = JSON.parse(JSON.stringify(this.data.menuList));
			for (var i=0;i<data.length;i++){
				if(data[i].isShow == 0) data.splice(i,1);
			}
			data.sort(function(a,b){
				return a.sort-b.sort;
			});
			return data;
		}
	}
});

function selectLink(i) {
	var d = {};
	if (i == undefined) d = vue.tempLink;
	else d = vue.data.menuList[i].link;
	ns.select_link(d, '', function (data) {
		vue.tempLink = data;
		$('.js-select-link-text').text(data.title).show();
	}, post);
}

/**
 * 绑定拖拽事件
 * 创建时间：2018年7月3日18:50:11
 */
$('.menu-list>ul').DDSort({

	//拖拽数据源
	target: 'li',

	//拖拽时显示的样式
	floatStyle: {
		'border': '1px solid #FF6A00',
		'background-color': '#ffffff'
	},

	//设置可拖拽区域
	draggableArea: "info-wrap",

	//拖拽中，隐藏右侧编辑属性栏
	move: function (index) {
	},
	//拖拽结束后，选择当前拖拽，并且显示右侧编辑属性栏，刷新数据
	up: function (index) {
		vue.refresh();
	}
});