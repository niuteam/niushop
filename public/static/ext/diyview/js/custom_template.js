//最外层组件
var ncComponentHtml = '<div v-show="data.lazyLoadCss && data.lazyLoad">';

ncComponentHtml += '<div class="preview-draggable">';//拖拽区域
	ncComponentHtml += '<slot name="preview"></slot>';
	ncComponentHtml += '<i class="del" v-show="parseInt(data.is_delete) !== 1" v-on:click.stop="$parent.delComponent(data.index)" data-disabled="1">x</i>';
ncComponentHtml += '</div>';

// ($slots.edit ? '1' : '0')
ncComponentHtml += '<div class="edit-attribute" v-bind:data-have-edit="1" v-show="$parent.currentIndex==data.index">';//  && $slots.edit
	ncComponentHtml += '<div class="attr-wrap">';
			ncComponentHtml += '<div class="restore-wrap">';
				ncComponentHtml += '<h2 class="attr-title">{{data.name}}</h2>';
				ncComponentHtml += '<slot name="edit"></slot>';
		ncComponentHtml += '</div>';
	ncComponentHtml += '</div>';
ncComponentHtml += '</div>';

ncComponentHtml += '<div style="display:none;">';
ncComponentHtml += '<slot name="resource"></slot>';
ncComponentHtml += '</div>';

ncComponentHtml += '</div>';

var ncComponent = {
	props: ["data"],
	template: ncComponentHtml,
	created: function () {

		//如果当前添加的组件没有添加过资源
		if (!this.$slots.resource) {
			this.data.lazyLoadCss = true;
			this.data.lazyLoad = true;
		} else {
			//检测是否只添加了JS或者CSS，没有添加默认为true
			var countCss = 0, countJs = 0, outerCountJs = 0;
			for (var i = 0; i < this.$slots.resource.length; i++) {
				if (this.$slots.resource[i].componentOptions) {
					if (this.$slots.resource[i].componentOptions.tag == "css") {
						countCss++;
					} else if (this.$slots.resource[i].componentOptions.tag == "js") {
						countJs++;
						//统计外部JS数量
						if (!$.isEmptyObject(this.$slots.resource[i].componentOptions.propsData)) outerCountJs++;
					}
				}
			}

			if (countCss == 0) this.data.lazyLoadCss = true;
			if (countJs == 0) this.data.lazyLoad = true;

			this.data.outerCountJs = outerCountJs;

		}
	}
};

/**
 * 手机端自定义模板Vue对象
 */
var vue = new Vue({

	el: "#diyView",

	data: {
		//当前编辑的组件位置
		currentIndex: -99,
		changeIndex: -1,
		isAdd: false,
		globalLazyLoad: false,

		//全局属性
		global: {
			title: "页面名称",
			bgColor: "#ffffff",
			topNavColor: "#ffffff",
			topNavbg:false,
			textNavColor: "#333333",
			topNavImg:"",
			moreLink:{},
			//是否显示底部导航标识
			openBottomNav: false,
			navStyle:1,
			textImgStyleLink:'1',
			textImgPosLink:'left',
			mpCollect:false,
			// 弹框形式，不弹出 -1，首次弹出 1，每次弹出 0
			popWindow: {
				imageUrl: "",
				count: -1,
				link: {},
				imgWidth: '',
				imgHeight: ''
			},
		},
		textImgStyleList:[
			{
				text: "图片超链接",
				value: "1",
				src: STATICEXT+"/diyview/img/nav_style/img_link.png",
				selectedSrc:STATICEXT+"/diyview/img/nav_style/img_link_hover.png"
			},
			{
				text: "文字超链接",
				value: "2",
				src: STATICEXT+"/diyview/img/nav_style/text_link.png",
				selectedSrc: STATICEXT+"/diyview/img/nav_style/text_link_hover.png"
			}
		],
		textImgPositionList:[
			{
				text: "居左",
				value: "left",
				src: STATICEXT+"/diyview/img/nav_style/text_left.png",
				selectedSrc:STATICEXT+"/diyview/img/nav_style/text_left_hover.png"
			},
			{
				text: "居中",
				value: "center",
				src: STATICEXT+"/diyview/img/nav_style/text_right.png",
				selectedSrc: STATICEXT+"/diyview/img/nav_style/text_right_hover.png"
			}
		],
		//自定义组件集合
		data: [],
	},
	
	components: {
		'nc-component': ncComponent,//最外层组件
	},
	created:function(){
		// console.log(this.global)
		// console.log(JSON.stringify(this.global))
	},
	
	mounted: function () {
		this.refresh();
		// console.log("vue is mounted");

	},
	
	methods: {
		addComponent: function (obj, other) {
			// console.log(other,78)
			//附加公共字段
			obj.index = 0;
			obj.sort = 0;
			obj.lazyLoadCss = false;//资源懒加载，防止看到界面缓慢加载
			obj.lazyLoad = false;//资源懒加载，防止看到界面缓慢加载
			obj.outerCountJs = 0;

			//第一次添加组件时，添加以下字段
			if (other) {
				obj.addon_name = other.addon_name;
				obj.type = other.name;
				obj.name = other.title;
				obj.controller = other.controller;
				obj.is_delete = other.is_delete;
			}

			if (other && !this.checkComponentIsAdd(obj.type, other.max_count)) {
				this.autoSelected(obj.type);
				return;	
			}

			this.data.push(obj);

			// 添加组件后（不是编辑调用的），选择最后一个
			if(other) this.currentIndex = this.data.length - 1;

			this.isAdd = true;

			this.refresh();

			var self = this;

			$(".edit-attribute-placeholder").show();
			setTimeout(function () {
				$(".edit-attribute-placeholder").hide();
				if(obj.controller == "FloatBtn"){
				}else{
					if (self.changeIndex == -1 || (self.changeIndex != self.currentIndex)) {
						$(".preview-wrap .preview-restore-wrap .dv-wrap").scrollTop($(".diy-view-wrap").height());
					}
				}
				
			},60);

//			console.log(JSON.stringify(this.data));
		
		},
		
		//检测组件是否允许添加，true：允许 false：不允许
		checkComponentIsAdd: function (type, max_count) {
			//max_count为0时不处理
			if (max_count == 0) return true;
			
			var count = 0;
			
			//遍历已添加的自定义组件，检测是否超出数量
			for (var i in this.data) if (this.data[i].type == type) count++;
			
			if (count >= max_count) return false;
			else return true;
		},

		// 获取组件添加数量
		getComponentAddCount: function (type) {
			var count = 0;
			//遍历已添加的自定义组件，检测是否超出数量
			for (var i in this.data) if (this.data[i].type == type) count++;
			return count;
		},
		
		//改变当前编辑的组件选中
		changeCurrentIndex: function (sort) {
			this.currentIndex = parseInt(sort);
			this.changeIndex = this.currentIndex;
			this.isAdd = false;
			this.refresh();
		},
		//选择页面顶部风格
		selectPageStyle: function() {
			var self = this;
			// console.log(self.data)
			layer.open({
				type: 1,
				title: '风格选择',
				area:['930px','630px'],
				btn: ['确定', '返回'],
				content: $(".nav_style").html(),
				success: function(layero, index) {
					// $(".layui-layer-content input[name='style']").val(self.data.style);
					// $("body").on("click", ".layui-layer-content .style-list-con-goods .style-li-goods", function () {
					// 	$(this).addClass("selected ns-border-color").siblings().removeClass("selected ns-border-color");
					// 	$(".layui-layer-content input[name='style']").val($(this).index() + 1);
					// });
				},
				yes: function (index, layero) {
					// self.data.style = $(".layui-layer-content input[name='style']").val();
					layer.closeAll()
				}
			});
		},
		// changeStyle(val){
		// 	console.log(val)
		// 	this.global.navStyle = val
		// },
		
		//改变当前的删除弹出框的显示状态
		delComponent: function (i) {
			var self = this;
			
			layer.confirm('确定要删除吗?', {title: '操作提示'}, function (index) {
				
				self.data.splice(i, 1);
				//删除当前组件后，选中最后一个组件进行编辑
				if (self.data[self.data.length - 1]) {
					self.currentIndex = $(".draggable-element:last").attr("data-index");
					//删除组件后，进行重新排序
					self.refresh();
				}
				layer.close(index);
				
			});
		},
		
		//刷新数据排序
		refresh: function () {
			var self = this;
			//vue框架执行，异步操作组件列表的排序
			setTimeout(function () {

				$(".draggable-element").each(function (i) {
					$(this).attr("data-sort", i);
				});

				for (var i = 0; i < self.data.length; i++) {
					self.data[i].index = $(".draggable-element[data-index=" + i + "]").attr("data-index");
					self.data[i].sort = $(".draggable-element[data-index=" + i + "]").attr("data-sort");
				}

				//触发变异方法，进行视图更新。不能用sort()方法，会改变组件的顺序，导致显示的顺序错乱
				self.data.push({});
				self.data.pop();
				// console.log(self.currentIndex);
				// console.log("触发变异方法，进行视图更新。不能用sort()方法，会改变组件的顺序，导致显示的顺序错乱");

				//如果当前编辑的组件不存在了，则选中最后一个
				if (parseInt(self.currentIndex) >= self.data.length) self.currentIndex--;

				$(".draggable-element[data-index=" + self.currentIndex + "] .edit-attribute .attr-wrap").css("height", ($(window).height() - 214) + "px");

				if (self.isAdd && self.changeIndex > -1 && (self.changeIndex != self.currentIndex) && self.changeIndex < (self.data.length - 1)) {
					var curr = $(".draggable-element[data-index=" + self.changeIndex + "]");
					var last = $(".draggable-element[data-index=" + (self.data.length - 1) + "]");
					// 调试代码，勿删
					// window.curr = curr;
					// window.last = last;
					// console.log("curr",curr);
					// console.log("last",last);
					curr.after(last);
					self.changeIndex = self.currentIndex;

					// 定位到当前位置
					// setTimeout(function () {
						// console.log("定位到当前位置",parseFloat((curr.position().top + last.outerHeight())));
						// $(".preview-wrap .preview-restore-wrap .dv-wrap").scrollTop(curr.position().top + last.outerHeight());
					// },1600);
					// console.log("self.changeIndex",self.changeIndex);
					// console.log("self.currentIndex",self.currentIndex);
				}

				// 显示插件添加的数量，防止一进入看到代码
				$(".js-component-add-count").show();

			}, 50);

		},
		
		//转换图片路径
		changeImgUrl: function (url) {
			if (url == null || url == "") return '';
			if (url.indexOf("static/img/") > -1) return ns.img(STATICIMG + "/" + url.replace("static/img/", ""));
			else return ns.img(url);
		},
		
		//设置全局对象属性
		setGlobal: function (obj) {
			for (var k in obj) {
				if(k) this.$set(this.global, k, obj[k]);
			}
			this.globalLazyLoad = true;
		},
		verify:function () {
			
			if (this.global.title == "") {
				layer.msg('请输入页面名称');
				this.currentIndex = -99;
				this.refresh();
				return false;
			}else if (this.global.title.length > 50) {
				layer.msg('页面名称最多50个字符');
				this.currentIndex = -99;
				this.refresh();
				return false;
			}

			if(this.global.popWindow.count != -1 && this.global.popWindow.imageUrl == ''){
				layer.msg('请上传弹框广告');
				this.currentIndex = -99;
				this.refresh();
				return false;
			}
			
			for (var i = 0; i < this.data.length; i++) {
				
				try {
					if(this.data[i].verify) {
						for (var j = 0; j < this.data[i].verify.length; j++) {
							var res = this.data[i].verify[j]();
							if (!res.code) {
								this.currentIndex = i;
								this.refresh();
								layer.msg(res.message);
								return false;
							}
						}
					}
				} catch (e) {
					console.log("verify Error:" + e, i, this.data[i]);
				}
			}
			return true;
		},
		autoSelected(type){
			for (var i in this.data) {
				if (this.data[i].type == type) {
					this.changeCurrentIndex(this.data[i].index);
					var element = $('.preview-wrap .preview-restore-wrap [data-index="'+ this.data[i].index +'"]'),
						warp = $(".preview-wrap .preview-restore-wrap .dv-wrap"),
						warpTop = warp.offset().top,
						warpBottom = warpTop + warp.height(),
						elementTop = element.offset().top,
						elementBottom = elementTop + element.height(),
						scrollTop = $(".preview-wrap .preview-restore-wrap .dv-wrap").scrollTop();

						if (elementBottom > warpBottom) {
							scrollTop += (elementBottom - warpBottom) + 2;
						} else if (warpTop > elementTop) {
							scrollTop -= (warpTop - elementTop);
						}
					$(".preview-wrap .preview-restore-wrap .dv-wrap").animate({ scrollTop: scrollTop }, 300);
					return;
				}	
			} 
		}
		// test: function () {
		// 	var url = "http://localhost/niucloud_service/s10155/Draw/component/Design/headEdit";
		// 	$.post(url, {}, function (str) {
		// 		layer.open({
		// 			title: "业务信息",
		// 			type: 0,
		// 			// btn: [],
		// 			content: str,
		// 			maxWidth: 1020,
		// 		});
		// 	});
		//
		// }
		
	}
});

/**
 * 绑定拖拽事件
 * 创建时间：2018年7月3日18:50:11
 */
$('.preview-block').DDSort({
	
	//拖拽数据源
	target: '.draggable-element',
	
	//拖拽时显示的样式
	floatStyle: {
		'border': '1px solid #FF6A00',
		'background-color': '#ffffff'
	},
	
	//设置可拖拽区域
	draggableArea: "preview-draggable",
	
	//拖拽中，隐藏右侧编辑属性栏
	move: function (index) {
		if ($(".draggable-element[data-index='" + index + "'] .edit-attribute").attr("data-have-edit") == 1)
			$(".draggable-element[data-index='" + index + "'] .edit-attribute").hide();
	},
	
	//拖拽结束后，选择当前拖拽，并且显示右侧编辑属性栏，刷新数据
	up: function (index) {
		if ($(".draggable-element[data-index='" + index + "'] .edit-attribute").attr("data-have-edit") == 1) {
			vue.currentIndex = index;
			$(".draggable-element[data-index='" + index + "'] .edit-attribute").show();
		}
		vue.refresh();
	}
});