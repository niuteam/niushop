(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ns-chat/ns-chat-order"],{"280c":function(n,e,t){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o={name:"ns-chat-order",props:{orderId:{type:[Number,String]},isCanSend:Boolean},data:function(){return{orderInfo:{}}},mounted:function(){this.getGoodsInfo()},methods:{getGoodsInfo:function(){var n=this;this.$api.sendRequest({url:"/api/order/detail",data:{order_id:this.orderId},success:function(e){e.code>=0&&(n.orderInfo=e.data)}})},sendMsg:function(){this.$emit("sendMsg","order")}}};e.default=o},"283b":function(n,e,t){"use strict";t.r(e);var o=t("dee3"),r=t("3d34");for(var d in r)"default"!==d&&function(n){t.d(e,n,(function(){return r[n]}))}(d);t("b180");var u,a=t("f0c5"),s=Object(a["a"])(r["default"],o["b"],o["c"],!1,null,null,null,!1,o["a"],u);e["default"]=s.exports},"3d34":function(n,e,t){"use strict";t.r(e);var o=t("280c"),r=t.n(o);for(var d in o)"default"!==d&&function(n){t.d(e,n,(function(){return o[n]}))}(d);e["default"]=r.a},b180:function(n,e,t){"use strict";var o=t("d0f1"),r=t.n(o);r.a},d0f1:function(n,e,t){},dee3:function(n,e,t){"use strict";var o;t.d(e,"b",(function(){return r})),t.d(e,"c",(function(){return d})),t.d(e,"a",(function(){return o}));var r=function(){var n=this,e=n.$createElement,t=(n._self._c,n.orderInfo.order_goods?n.$util.img(n.orderInfo.order_goods?n.orderInfo.order_goods[0].sku_image:""):null);n.$mp.data=Object.assign({},{$root:{g0:t}})},d=[]}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ns-chat/ns-chat-order-create-component',
    {
        'components/ns-chat/ns-chat-order-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('543d')['createComponent'](__webpack_require__("283b"))
        })
    },
    [['components/ns-chat/ns-chat-order-create-component']]
]);
