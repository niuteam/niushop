(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pages/goods/cart/cart"],{"6a21":function(t,a,n){"use strict";var i=n("9c89"),e=n.n(i);e.a},"7d03":function(t,a,n){"use strict";var i=n("a490"),e=n.n(i);e.a},8076:function(t,a,n){"use strict";n.r(a);var i=n("ba85"),e=n("a40b");for(var o in e)"default"!==o&&function(t){n.d(a,t,(function(){return e[t]}))}(o);n("7d03"),n("6a21");var c,r=n("f0c5"),s=Object(r["a"])(e["default"],i["b"],i["c"],!1,null,"38538a93",null,!1,i["a"],c);a["default"]=s.exports},"867b":function(t,a,n){"use strict";(function(t){n("34b0");i(n("66fd"));var a=i(n("8076"));function i(t){return t&&t.__esModule?t:{default:t}}t(a.default)}).call(this,n("543d")["createPage"])},9056:function(t,a,n){"use strict";(function(t){Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var i=o(n("f385")),e=o(n("c409"));function o(t){return t&&t.__esModule?t:{default:t}}var c=function(){n.e("components/ns-goods-recommend/ns-goods-recommend").then(function(){return resolve(n("1044"))}.bind(null,n)).catch(n.oe)},r=function(){n.e("components/uni-number-box/uni-number-box").then(function(){return resolve(n("092d"))}.bind(null,n)).catch(n.oe)},s=function(){n.e("components/diy-bottom-nav/diy-bottom-nav").then(function(){return resolve(n("df22"))}.bind(null,n)).catch(n.oe)},u=function(){n.e("components/toTop/toTop").then(function(){return resolve(n("1aeb"))}.bind(null,n)).catch(n.oe)},l={components:{nsGoodsRecommend:c,uniNumberBox:r,diyBottomNav:s,toTop:u},mixins:[i.default,e.default],data:function(){return{token:"",cartData:[],checkAll:!0,totalPrice:"0.00",totalCount:0,modifyFlag:!1,isSub:!1,invalidGoods:[],isIphoneX:!1,cartBottom:"56px",isAction:!1,startX:"",endX:""}},onLoad:function(){t.hideTabBar()},onShow:function(){this.$langConfig.refresh(),t.getStorageSync("token")?this.getCartData():(this.token="",this.cartData=[],this.calculationTotalPrice()),this.isIphoneX=this.$util.uniappIsIPhoneX(),this.$util.uniappIsIPhone11()&&(this.cartBottom="90px")},onReady:function(){t.getStorageSync("token")||this.$refs.loadingCover&&this.$refs.loadingCover.hide()},computed:{hasData:function(){return this.cartData.length>0||this.invalidGoods.length>0},storeToken:function(){return this.$store.state.token}},watch:{storeToken:function(t,a){this.getCartData()}},methods:{initNum:function(t){var a=t.max_buy>0&&t.max_buy<t.stock?t.max_buy:t.stock;return a=0==a?1:a,t.num>a?a:t.num},getCartData:function(){var a=this;this.$api.sendRequest({url:"/api/cart/goodslists",success:function(n){n.code>=0?(a.token=t.getStorageSync("token"),n.data.length?a.handleCartData(n.data):a.cartData=[]):a.token="",a.$refs.loadingCover&&a.$refs.loadingCover.hide()},fail:function(t){a.$refs.loadingCover&&a.$refs.loadingCover.hide()}})},handleCartData:function(t){var a=this;this.invalidGoods=[],this.cartData=[];var n={};t.forEach((function(t,i){1==t.goods_state?t.min_buy>0&&t.min_buy>t.stock?a.invalidGoods.push(t):(t.checked=!0,t.edit=!1,void 0!=n["site_"+t.site_id]?n["site_"+t.site_id].cartList.push(t):n["site_"+t.site_id]={siteId:t.site_id,siteName:t.site_name,edit:!1,checked:!0,cartList:[t]}):a.invalidGoods.push(t)})),this.cartData=[],Object.keys(n).forEach((function(t){a.cartData.push(n[t])})),this.calculationTotalPrice(),this.cartData.length&&this.cartData[0].cartList.forEach((function(t){t.sku_spec_format?t.sku_spec_format=JSON.parse(t.sku_spec_format):t.sku_spec_format=[]})),this.invalidGoods.length&&this.invalidGoods.forEach((function(t){t.sku_spec_format?t.sku_spec_format=JSON.parse(t.sku_spec_format):t.sku_spec_format=[]}))},singleElection:function(t,a){this.cartData[t].cartList[a].checked=!this.cartData[t].cartList[a].checked,this.calculationTotalPrice()},siteAllElection:function(t,a){this.cartData[a].checked=t,this.cartData[a].cartList.forEach((function(a){a.checked=t})),this.calculationTotalPrice()},allElection:function(t){var a=this;this.checkAll="boolean"==typeof t?t:!this.checkAll,this.cartData.length&&this.cartData.forEach((function(t){t.checked=a.checkAll,t.cartList.forEach((function(t){t.checked=a.checkAll}))})),this.calculationTotalPrice()},calculationTotalPrice:function(){if(this.cartData.length){var t=0,a=0,n=0;this.cartData.forEach((function(i){var e=0;i.cartList.forEach((function(n){n.checked&&(e+=1,a+=parseInt(n.num),Number(n.member_price)>0&&Number(n.member_price)<Number(n.discount_price)?t+=n.member_price*n.num:t+=n.discount_price*n.num)})),i.cartList.length==e?(i.checked=!0,n+=1):i.checked=!1})),this.totalPrice=t.toFixed(2),this.totalCount=a,this.checkAll=this.cartData.length==n}else this.totalPrice="0.00",this.totalCount=0;this.modifyFlag=!1},deleteCart:function(a,n,i){var e=this,o=[];if("all"==a)for(var c=0;c<this.cartData.length;c++)for(var r=0;r<this.cartData[c].cartList.length;r++)this.cartData[c].cartList[r].checked&&o.push(this.cartData[c].cartList[r].cart_id);else o.push(this.cartData[n].cartList[i].cart_id);0!=o.length?t.showModal({title:"提示",content:"确定要删除这些商品吗？",success:function(t){t.confirm&&(o=o.toString(),e.calculationTotalPrice(),e.getCartNumber(),e.$api.sendRequest({url:"/api/cart/delete",data:{cart_id:o},success:function(t){if(t.code>=0){if("all"==a)for(var o=0;o<e.cartData.length;o++){for(var c=0;c<e.cartData[o].cartList.length;c++){var r=e.cartData[o].cartList[c];r.checked&&(e.cartData[o].cartList.splice(c,1),c=-1)}0==e.cartData[o].cartList.length&&e.cartData.splice(o,1)}else e.cartData[n].cartList.splice(i,1),0==e.cartData[n].cartList.length&&e.cartData.splice(n,1);e.calculationTotalPrice(),e.getCartNumber()}else e.$util.showToast({title:t.message})}}))}}):this.$util.showToast({title:"请选择要删除的商品"})},cartNumChange:function(t,a){var n=this;if(!isNaN(t)){var i=this.cartData[a.siteIndex].cartList[a.cartIndex],e=i.max_buy>0&&i.max_buy<i.stock?i.max_buy:i.stock,o=i.min_buy>0?i.min_buy:1;t>e&&(t=e),t<o&&(t=o),this.modifyFlag=!0,this.$api.sendRequest({url:"/api/cart/edit",data:{num:t,cart_id:this.cartData[a.siteIndex].cartList[a.cartIndex].cart_id},success:function(i){i.code>=0?(n.cartData[a.siteIndex].cartList[a.cartIndex].num=t,n.calculationTotalPrice(),n.getCartNumber()):n.$util.showToast({title:i.message})}})}},settlement:function(){var a=this;if(this.totalCount>0){var n=[];if(this.cartData.forEach((function(t){t.cartList.forEach((function(t){t.checked&&n.push(t.cart_id)}))})),this.isSub)return;this.isSub=!0,t.setStorage({key:"orderCreateData",data:{cart_ids:n.toString()},success:function(){a.$util.redirectTo("/pages/order/payment/payment"),a.isSub=!1}})}},clearInvalidGoods:function(){var a=this;t.showModal({title:"提示",content:"确定要清空这些商品吗？",success:function(t){if(t.confirm){var n=[];a.invalidGoods.forEach((function(t){n.push(t.cart_id)})),n.length&&a.$api.sendRequest({url:"/api/cart/delete",data:{cart_id:n.toString()},success:function(t){t.code>=0?(a.invalidGoods=[],a.getCartNumber()):a.$util.showToast({title:t.message})}})}}})},imageError:function(t,a){this.cartData[t].cartList[a].sku_image=this.$util.getDefaultImage().default_goods_img,this.$forceUpdate()},toGoodsDetail:function(t){this.$util.redirectTo("/pages/goods/detail/detail",{sku_id:t.sku_id})},getCartNumber:function(){t.getStorageSync("token")&&(this.$store.dispatch("getCartNumber"),this.resetEditStatus())},goodsLimit:function(t,a){var n=this.cartData[0].cartList[a];"plus"==t.type?n.max_buy>0&&n.max_buy<n.stock?this.$util.showToast({title:"该商品每人限购"+n.max_buy+"件"}):this.$util.showToast({title:"库存不足"}):this.$util.showToast({title:"最少购买"+t.value+"件"})},toLogin:function(){this.$refs.login.open()},touchS:function(t){this.startX=t.touches[0].clientX},touchE:function(t,a){this.endX=t.changedTouches[0].clientX;var n=this.startX-this.endX;n>50?a.edit=!0:n<0&&(a.edit=!1),this.$forceUpdate()},resetEditStatus:function(){for(var t=0;t<this.cartData[0].cartList.length;t++)this.cartData[0].cartList[t].edit=!1;this.$forceUpdate()},changeAction:function(){this.isAction=!this.isAction,this.resetEditStatus()}}};a.default=l}).call(this,n("543d")["default"])},"9c89":function(t,a,n){},a40b:function(t,a,n){"use strict";n.r(a);var i=n("9056"),e=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(a,t,(function(){return i[t]}))}(o);a["default"]=e.a},a490:function(t,a,n){},ba85:function(t,a,n){"use strict";n.d(a,"b",(function(){return e})),n.d(a,"c",(function(){return o})),n.d(a,"a",(function(){return i}));var i={uniNumberBox:function(){return n.e("components/uni-number-box/uni-number-box").then(n.bind(null,"092d"))},loadingCover:function(){return n.e("components/loading-cover/loading-cover").then(n.bind(null,"790a"))},diyBottomNav:function(){return n.e("components/diy-bottom-nav/diy-bottom-nav").then(n.bind(null,"df22"))},nsLogin:function(){return Promise.all([n.e("common/vendor"),n.e("components/ns-login/ns-login")]).then(n.bind(null,"2893"))}},e=function(){var t=this,a=t.$createElement,n=(t._self._c,t.cartData.length&&t.isAction?t.$lang("complete"):null),i=t.cartData.length&&!t.isAction?t.$lang("edit"):null,e=t.hasData?t.__map(t.cartData,(function(a,n){var i=t.__get_orig(a),e=t.$lang("del"),o=t.__map(a.cartList,(function(a,n){var i=t.__get_orig(a),e=t.$util.img(a.sku_image,{size:"mid"}),o=1==a.promotion_type?Number(a.member_price):null,c=1==a.promotion_type?Number(a.member_price):null,r=1==a.promotion_type?Number(a.discount_price):null,s=1==a.promotion_type&&o>0&&c<r?t.$lang("common.currencySymbol"):null,u=1==a.promotion_type&&o>0&&c<r?t.$util.img("upload/uniapp/index/VIP.png"):null,l=1!=a.promotion_type||o>0&&c<r?null:t.$lang("common.currencySymbol"),d=1!=a.promotion_type||o>0&&c<r?null:t.$util.img("upload/uniapp/index/discount.png"),h=1!=a.promotion_type?Number(a.member_price):null,m=1!=a.promotion_type&&h>0?t.$lang("common.currencySymbol"):null,f=1!=a.promotion_type&&h>0?t.$util.img("upload/uniapp/index/VIP.png"):null,g=1==a.promotion_type||h>0?null:t.$lang("common.currencySymbol"),p=t.initNum(a);return{$orig:i,g0:e,m2:o,m3:c,m4:r,m5:s,g1:u,m6:l,g2:d,m7:h,m8:m,g3:f,m9:g,m10:p}}));return{$orig:i,m11:e,l0:o}})):null,o=t.$lang("common.currencySymbol"),c=t.hasData&&t.invalidGoods.length?t.__map(t.invalidGoods,(function(a,n){var i=t.__get_orig(a),e=t.$util.img(a.sku_image,{size:"mid"});return{$orig:i,g4:e}})):null,r=t.hasData?null:t.$util.img("upload/uniapp/common-empty.png"),s=t.hasData?null:t.$lang("emptyTips"),u=t.hasData?t.$lang("allElection"):null,l=t.hasData?t.$lang("total"):null,d=t.hasData?t.$lang("common.currencySymbol"):null,h=t.hasData&&t.isAction?t.$lang("del"):null,m=t.hasData&&!t.isAction&&0!=t.totalCount?t.$lang("settlement"):null,f=t.hasData&&!t.isAction&&0==t.totalCount?t.$lang("settlement"):null;t._isMounted||(t.e0=function(a){return t.$util.redirectTo("/pages/index/index/index",{},"reLaunch")}),t.$mp.data=Object.assign({},{$root:{m0:n,m1:i,l1:e,m12:o,l2:c,g5:r,m13:s,m14:u,m15:l,m16:d,m17:h,m18:m,m19:f}})},o=[]}},[["867b","common/runtime","common/vendor"]]]);