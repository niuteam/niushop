(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pages/order/detail_point/detail_point"],{"6eee":function(e,t,o){},"6f6e":function(e,t,o){"use strict";o.d(t,"b",(function(){return i})),o.d(t,"c",(function(){return r})),o.d(t,"a",(function(){return n}));var n={loadingCover:function(){return o.e("components/loading-cover/loading-cover").then(o.bind(null,"790a"))}},i=function(){var e=this,t=e.$createElement,o=(e._self._c,e.$util.img("upload/uniapp/order/status-wrap-bg.png")),n=0==e.orderData.order_status?e.$util.img("/upload/uniapp/order/order-icon.png"):null,i=1==e.orderData.order_status?e.$util.img("/upload/uniapp/order/order-icon-received.png"):null,r=-1==e.orderData.order_status?e.$util.img("/upload/uniapp/order/order-icon-close.png"):null,a=e.exchangeImage(e.orderData),u=e.orderData.price>0?e.$lang("common.currencySymbol"):null,d=e.$util.timeStampTurnTime(e.orderData.create_time),s=e.orderData.close_time>0?e.$util.timeStampTurnTime(e.orderData.close_time):null,c=e.orderData.price>0?e.$lang("common.currencySymbol"):null;e._isMounted||(e.e0=function(t){return e.$util.copy(e.orderData.order_no)}),e.$mp.data=Object.assign({},{$root:{g0:o,g1:n,g2:i,g3:r,m0:a,m1:u,g4:d,g5:s,m2:c}})},r=[]},c02d:function(e,t,o){"use strict";o.r(t);var n=o("fc7e"),i=o.n(n);for(var r in n)"default"!==r&&function(e){o.d(t,e,(function(){return n[e]}))}(r);t["default"]=i.a},c0cd:function(e,t,o){"use strict";var n=o("6eee"),i=o.n(n);i.a},d912:function(e,t,o){"use strict";(function(e){o("34b0");n(o("66fd"));var t=n(o("ddec"));function n(e){return e&&e.__esModule?e:{default:e}}e(t.default)}).call(this,o("543d")["createPage"])},ddec:function(e,t,o){"use strict";o.r(t);var n=o("6f6e"),i=o("c02d");for(var r in i)"default"!==r&&function(e){o.d(t,e,(function(){return i[e]}))}(r);o("c0cd");var a,u=o("f0c5"),d=Object(u["a"])(i["default"],n["b"],n["c"],!1,null,null,null,!1,n["a"],a);t["default"]=d.exports},fc7e:function(e,t,o){"use strict";(function(e){Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=i(o("c409"));function i(e){return e&&e.__esModule?e:{default:e}}function r(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}var a=function(){o.e("components/payment/payment").then(function(){return resolve(o("4ef4"))}.bind(null,o)).catch(o.oe)},u={mixins:[n.default],data:function(){return{isIphoneX:!1,orderId:0,orderData:{action:[]},action:{icon:""},storeDetail:{},kefuConfig:{weapp:"",system:"",open:"",open_url:""}}},components:{nsPayment:a},onLoad:function(e){e.order_id&&(this.orderId=e.order_id)},onShow:function(){this.$langConfig.refresh(),this.isIphoneX=this.$util.uniappIsIPhoneX(),e.getStorageSync("token")?this.getOrderData():this.$util.redirectTo("/pages/login/login/login",{back:"/pages/order/detail_point/detail_point?order_id="+this.orderId}),this.getKekuConfig()},methods:r({goConnect:function(){var t=this;if(e.getStorageSync("token")){var o={order_id:t.orderData.order_id};return 1==this.kefuConfig.system?(t.$util.redirectTo("/otherpages/chat/room/room",o),!1):void 0}this.$refs.login.open("/pages/goods/detail/detail?sku_id="+t.orderData.sku_id)},getKekuConfig:function(){var e=this;this.$api.sendRequest({url:"/api/config/servicer",success:function(t){0==t.code&&(e.kefuConfig=t.data,e.kefuConfig.system&&!e.addonIsExit.servicer&&(e.kefuConfig.system=0))}})},goRefund:function(e){this.$util.redirectTo("/pages/order/refund/refund",{order_goods_id:e})},goRefundDetail:function(e){this.$util.redirectTo("/pages/order/refund_detail/refund_detail",{order_goods_id:e})},goDetail:function(e){this.$util.redirectTo("/promotionpages/point/detail/detail",{id:e})},navigateBack:function(){this.$util.goBack()},getOrderData:function(){var t=this;this.$api.sendRequest({url:"/pointexchange/api/order/info",data:{order_id:this.orderId},success:function(o){e.stopPullDownRefresh(),o.code>=0?(t.$refs.loadingCover&&t.$refs.loadingCover.hide(),t.orderData=o.data,""!=t.orderData.delivery_store_info&&(t.orderData.delivery_store_info=JSON.parse(t.orderData.delivery_store_info))):(t.$util.showToast({title:"未获取到订单信息！"}),setTimeout((function(){t.$util.redirectTo("/pages/order/list/list")}),1500))},fail:function(o){e.stopPullDownRefresh(),t.$refs.loadingCover&&t.$refs.loadingCover.hide()}})},onPullDownRefresh:function(){this.getOrderData()},orderClose:function(){var t=this;e.showModal({title:"提示",content:"确定关闭此次兑换？",success:function(e){e.confirm&&t.$api.sendRequest({url:"/pointexchange/api/order/close",data:{order_id:t.orderData.order_id},success:function(e){e.code>=0&&(t.$util.showToast({title:"关闭成功"}),t.getOrderData())}})}})},openChoosePayment:function(){this.$refs.choosePaymentPopup.open()},orderPay:function(){this.$refs.choosePaymentPopup.getPayInfo(this.orderData.out_trade_no)},exchangeImage:function(e){switch(e.type){case 1:return this.$util.img(e.exchange_image,{size:"mid"});case 2:return e.exchange_image?this.$util.img(e.exchange_image):this.$util.img("upload/uniapp/point/coupon.png");case 3:return e.exchange_image?this.$util.img(e.exchange_image):this.$util.img("upload/uniapp/point/hongbao.png")}},imageError:function(){switch(this.orderData.type){case 2:this.orderData.exchange_image=this.$util.img("upload/uniapp/point/coupon.png");break;case 3:this.orderData.exchange_image=this.$util.img("upload/uniapp/point/hongbao.png");break;default:this.orderData.exchange_image=this.$util.getDefaultImage().default_goods_img}this.$forceUpdate()}},"openChoosePayment",(function(){this.$refs.choosePaymentPopup.open()})),filters:{abs:function(e){return Math.abs(parseFloat(e)).toFixed(2)}}};t.default=u}).call(this,o("543d")["default"])}},[["d912","common/runtime","common/vendor"]]]);