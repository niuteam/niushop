/**
 * 图片广告的图片上传
 */
var imageAdsCarouselHtml = '<div class="layui-carousel" v-bind:id="id" :class="{\'ns-carousel-ind-line\': data.carouselChangeStyle == \'line\'}">';
		imageAdsCarouselHtml += '<div carousel-item>';
			imageAdsCarouselHtml += '<div class="image-ads-item carousel-posters" v-for="(item,index) in list">';
			
				imageAdsCarouselHtml += '<p v-show="item.imageUrl==\'\'">';
					imageAdsCarouselHtml += '<span>图片广告</span>';
				imageAdsCarouselHtml += '</p>';
			
				imageAdsCarouselHtml += '<div v-show="item.imageUrl" v-bind:class="[$parent.data.fillStyle]">';
					imageAdsCarouselHtml += '<img v-bind:src="$parent.$parent.changeImgUrl(item.imageUrl)" :style="{borderRadius: $parent.data.imageRadius==\'right-angle\' ? \'\' : \'5px\'}" draggable="false"/>';
				imageAdsCarouselHtml += '</div>';

				// imageAdsCarouselHtml += '<span v-show="item.title">{{item.title}}</span>';
				
			imageAdsCarouselHtml += '</div>';
		imageAdsCarouselHtml += '</div>';
	imageAdsCarouselHtml += '</div>';

Vue.component("image-ads-carouse",{
	
	props : ['index'],
	data : function(){
		return {
			id : ns.gen_non_duplicate(10) + this.index,
			selectedTemplate : this.$parent.data.selectedTemplate,
			list : this.$parent.data.list,
			carousel : null,
            carousel_render : null,
			data: this.$parent.data
		}
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		var self = this;
		
		setTimeout(function(){
			var elem = "#" + self.id;
			layui.use('carousel', function(){
				self.carousel = layui.carousel;
				self.carousel_render = self.carousel.render({ elem: elem , width : '100%' , height : '170px' , indicator : 'inside' });
			});
		},10);
	},
	
	template : imageAdsCarouselHtml,
	
	watch : {
		list : function(){
			var self = this;
			setTimeout(function(){
                self.carousel_render.reload();//重置轮播
			},10);
		}
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
});

var imageAdsListHtml = '<div class="image-ad-list">';
		imageAdsListHtml += '<p class="ns-word-aux">建议上传尺寸相同的图片，推荐尺寸750*350</p>';//，拖动选中的图片广告可对其排序
		imageAdsListHtml += '<ul>';
			imageAdsListHtml += '<li v-for="(item,index) in list" v-bind:data-sort="index" v-bind:data-index="index">';
				imageAdsListHtml += '<img-upload v-bind:data="{ data : item }"></img-upload>';
				imageAdsListHtml += '<div class="content-block">';
					/* imageAdsListHtml += '<div class="layui-form-item">';
						imageAdsListHtml += '<label class="layui-form-label sm">标题 </label>';
						imageAdsListHtml += '<div class="layui-input-block">';
							imageAdsListHtml += '<input type="text" v-model="item.title" class="layui-input" />';
						imageAdsListHtml += '</div>';
					imageAdsListHtml += '</div>'; */
					imageAdsListHtml += '<nc-link v-bind:data="{ field : $parent.data.list[index].link }"></nc-link>';
				imageAdsListHtml += '</div>';
				imageAdsListHtml += '<i class="del" v-on:click="deleteItem(index)" data-disabled="1">x</i>';
				imageAdsListHtml += '<div class="error-msg"></div>';
			imageAdsListHtml += '</li>';
		imageAdsListHtml += '</ul>';
		
		imageAdsListHtml += '<div class="add-item ns-text-color" v-if="list.length < 5" v-on:click="addItem">';
			imageAdsListHtml += '<p>';
				imageAdsListHtml += '<i>+</i>';
				imageAdsListHtml += '<span>添加一个图片广告</span>';
			imageAdsListHtml += '</p>';
		imageAdsListHtml += '</div>';
	imageAdsListHtml += '</div>';

Vue.component("image-ads-list",{
	
	data : function(){
		return {
            data : this.$parent.data,
			list : this.$parent.data.list,
//			parentList : this.$parent.data.list
		}
	},
	created : function(){

		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
//		//采用单项绑定，复制当前对象
//		this.list = JSON.parse(JSON.stringify(this.parentList));
//		
//		//初始化原始下标
//		for(var i=0;i<this.list.length;i++) this.list[i].originalIndex = i;
//		
//		var self = this;
//		var parent = vue.data[vue.currentIndex];
//		var index = vue.currentIndex;

//		setTimeout(function(){
//			$('.draggable-element[data-index="' + vue.currentIndex + '"] .image-ads .image-ad-list ul').DDSort({
//				
//				//拖拽数据源
//				target: 'li',
//				
//				//拖拽时显示的样式
//				floatStyle: {
//					'border': '1px solid #38f',
//					'background-color': '#ffffff'
//				},
//				
//				//拖拽结束后
//				up : function(){
//					
//					//记录拖拽后的顺序
//					var sortArray = new Array();
//
//					//遍历集合
//					$(".draggable-element[data-index='" + index + "'] .image-ad-list li").each(function(i){
//						
//						self.list[$(this).attr("data-index")].originalIndex = i;
//						
//						//因为是单项绑定，需要记录原始下标，用于后续CURD操作
//						sortArray.push($(this).attr("data-sort"));
//						
//						//还原排序
//						$(this).attr("data-sort",i);
//						
//					});
//
//					//复制当前对象
//					var tempList = JSON.parse(JSON.stringify(parent.list));
//					
//					for(var i=0;i<sortArray.length;i++){
//						parent.list[i] = tempList[sortArray[i]];
//					}
//
//					//触发变异方法，进行视图更新。
//					parent.list.push({});
//					parent.list.pop();
//					
//				}
//			});
//		},20);

	},
	
	methods : {
		
		addItem : function(){
			this.list.push({ imageUrl : "", title : "", link : {} });
		},
		verify :function () {
			var res = {code: true, message: ""};
			var _self = this;
			$(".draggable-element[data-index='" + this.data.index + "'] .image-ads .image-ad-list>ul>li").each(function (index) {
				
				if (_self.list[index].imageUrl == "") {
					res.code = false;
					res.message = "请添加图片";
					$(this).find(".error-msg").text("请添加图片").show();
					return res;
				} else {
					$(this).find(".error-msg").text("").hide();
				}
			});
			
			return res;
		},
//		changeTitle : function(event,index){
//			
//			console.log(this.list[index].originalIndex);
//			
//			//改变内部数据
//			this.list[index].title = event.target.value;
//			
//			//改变外层原数据
//			this.parentList[this.list[index].originalIndex].title = event.target.value;
//
//			this.parentList.push({});
//			this.parentList.pop();
//		},
//		
		deleteItem : function(index){

			this.list.splice(index,1);
//			var originalIndex = this.list[index].originalIndex;
//			console.log(index,originalIndex,this.$parent.data.list.length);
//			console.log("删除父级集合中的第" + (originalIndex+1)+"个");
//			var a = this.getDeleteOriginalIndex(originalIndex);
//			console.log("A:"+a,"index:" + index);
////			if(originalIndex >=this.$parent.data.list.length){
////				console.log();
////			}
////				originalIndex--;
//			this.$parent.data.list.splice(a,1);
//			this.list.splice(index,1);
//			console.log(JSON.stringify(this.$parent.data.list));
//			console.log(JSON.stringify(this.$parent.data.list));
		},
//		getDeleteOriginalIndex : function(index){
//			if(index>=this.$parent.data.list.length){
//				index--;
//				return this.getDeleteOriginalIndex(index);
//			}
//			return index;
//		}
	
	},
	
	template : imageAdsListHtml
});

var imageAdsSingleHtml = '<div class="image-ad-list">';
		imageAdsSingleHtml += '<ul>';
			imageAdsSingleHtml += '<li v-for="(item,index) in list" v-bind:data-sort="index" v-bind:data-index="index">';
				imageAdsSingleHtml += '<img-sec-upload v-bind:data="{ data : item }"></img-sec-upload>';
				imageAdsSingleHtml += '<div class="content-block">';
					imageAdsSingleHtml += '<nc-link v-bind:data="{ field : $parent.data.list[index].link }"></nc-link>';
				imageAdsSingleHtml += '</div>';
				// imageAdsSingleHtml += '<i class="del" v-on:click="deleteItem(index)" data-disabled="1">x</i>';
				imageAdsSingleHtml += '<div class="error-msg"></div>';
			imageAdsSingleHtml += '</li>';
		imageAdsSingleHtml += '</ul>';
	imageAdsSingleHtml += '</div>';

Vue.component("image-ads-single",{
	
	data : function(){
		return {
            data : this.$parent.data,
			list : this.$parent.data.list,
		}
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		
		if (this.list.length > 0) {
			var obj = this.list[0];
			this.list = [];
			this.list.push(obj);
		}
	},
	
	methods : {
		verify :function () {
			var res = {code: true, message: ""};
			var _self = this;
			$(".draggable-element[data-index='" + this.data.index + "'] .image-ads .image-ad-list>ul>li").each(function (index) {
				
				if (_self.list[index].imageUrl == "") {
					res.code = false;
					res.message = "请添加图片";
					$(this).find(".error-msg").text("请添加图片").show();
					return res;
				} else {
					$(this).find(".error-msg").text("").hide();
				}
			});
			
			return res;
		},
	},
	
	template : imageAdsSingleHtml
});


var imgAdsRadiusHtml = '<div class="layui-form-item ns-icon-radio">';
		imgAdsRadiusHtml += '<label class="layui-form-label sm">图片圆角</label>';
		imgAdsRadiusHtml += '<div class="layui-input-block">';
			imgAdsRadiusHtml += '<template v-for="(item, index) in imgAdsRadius" v-bind:k="index">';
				imgAdsRadiusHtml += '<span :class="[item.value == data.imageRadius ? \'\' : \'layui-hide\']">{{item.text}}</span>';
			imgAdsRadiusHtml += '</template>';
			imgAdsRadiusHtml += '<ul class="ns-icon">';
				imgAdsRadiusHtml += '<li v-for="(item, index) in imgAdsRadius" v-bind:k="index" :class="[item.value == data.imageRadius ? \'ns-text-color ns-border-color ns-bg-color-diaphaneity\' : \'\']" @click="data.imageRadius=item.value">';
					imgAdsRadiusHtml += '<img v-if="item.value == data.imageRadius" :src="item.selectedSrc" />'
					imgAdsRadiusHtml += '<img v-else :src="item.src" />'
				imgAdsRadiusHtml += '</li>';
			imgAdsRadiusHtml += '</ul>';
		imgAdsRadiusHtml += '</div>';
	imgAdsRadiusHtml += '</div>';

Vue.component("img-ads-radius",{
	template : imgAdsRadiusHtml,
	data : function(){
		return {
			data : this.$parent.data,
			imgAdsRadius: [
				{
					text: "直角",
					value: "right-angle",
					src: imageAdsResourcePath + "/image_ads/img/right-angle.png",
					selectedSrc: imageAdsResourcePath + "/image_ads/img/right-angle_1.png"
				},
				{
					text: "圆角",
					value: "fillet",
					src: imageAdsResourcePath + "/image_ads/img/fillet.png",
					selectedSrc: imageAdsResourcePath + "/image_ads/img/fillet_1.png"
				}
			],
		}
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods : {
		verify :function () {
			var res = {code: true, message: ""};		
			return res;
		},
	},
	
});


var imgAdsCarouselHtml = '<div class="layui-form-item ns-icon-radio">';
		imgAdsCarouselHtml += '<label class="layui-form-label sm">轮播切换</label>';
		imgAdsCarouselHtml += '<div class="layui-input-block">';
			imgAdsCarouselHtml += '<template v-for="(item, index) in imgAdsCarousel" v-bind:k="index">';
				imgAdsCarouselHtml += '<span :class="[item.value == data.carouselChangeStyle ? \'\' : \'layui-hide\']">{{item.text}}</span>';
			imgAdsCarouselHtml += '</template>';
			imgAdsCarouselHtml += '<ul class="ns-icon">';
				imgAdsCarouselHtml += '<li v-for="(item, index) in imgAdsCarousel" v-bind:k="index" :class="[item.value == data.carouselChangeStyle ? \'ns-text-color ns-border-color ns-bg-color-diaphaneity\' : \'\']" @click="data.carouselChangeStyle=item.value">';
					imgAdsCarouselHtml += '<img v-if="item.value == data.carouselChangeStyle" :src="item.selectedSrc" />'
					imgAdsCarouselHtml += '<img v-else :src="item.src" />'
				imgAdsCarouselHtml += '</li>';
			imgAdsCarouselHtml += '</ul>';
		imgAdsCarouselHtml += '</div>';
	imgAdsCarouselHtml += '</div>';

Vue.component("img-ads-carousel",{
	template : imgAdsCarouselHtml,
	data : function(){
		return {
			data : this.$parent.data,
			imgAdsCarousel: [
				{
					text: "圆点",
					value: "circle",
					src: imageAdsResourcePath + "/image_ads/img/circle.png",
					selectedSrc: imageAdsResourcePath + "/image_ads/img/circle_1.png"
				},
				{
					text: "直线",
					value: "line",
					src: imageAdsResourcePath + "/image_ads/img/line.png",
					selectedSrc: imageAdsResourcePath + "/image_ads/img/line_1.png"
				}
			],
		}
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods : {
		verify :function () {
			var res = {code: true, message: ""};		
			return res;
		},
	}
});