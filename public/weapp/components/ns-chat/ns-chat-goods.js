(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ns-chat/ns-chat-goods"],{"2fd6":function(n,t,o){"use strict";var e;o.d(t,"b",(function(){return s})),o.d(t,"c",(function(){return u})),o.d(t,"a",(function(){return e}));var s=function(){var n=this,t=n.$createElement,o=(n._self._c,n.goodsInfo.goods_name?n.$util.img(n.goodsInfo.sku_image):null);n.$mp.data=Object.assign({},{$root:{g0:o}})},u=[]},3703:function(n,t,o){"use strict";o.r(t);var e=o("2fd6"),s=o("f985");for(var u in s)"default"!==u&&function(n){o.d(t,n,(function(){return s[n]}))}(u);o("8331");var a,i=o("f0c5"),d=Object(i["a"])(s["default"],e["b"],e["c"],!1,null,null,null,!1,e["a"],a);t["default"]=d.exports},8331:function(n,t,o){"use strict";var e=o("b7f9"),s=o.n(e);s.a},b7f9:function(n,t,o){},be00:function(n,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var e={name:"ns-chat-goods",props:{skuId:{type:[Number,String]},isCanSend:Boolean},data:function(){return{goodsInfo:{}}},mounted:function(){this.getGoodsInfo()},methods:{getGoodsInfo:function(){var n=this;this.$api.sendRequest({url:"/api/goodssku/detail",data:{sku_id:this.skuId},success:function(t){t.code>=0&&(n.goodsInfo=t.data.goods_sku_detail)}})},sendMsg:function(){this.$emit("sendMsg","goods")}}};t.default=e},f985:function(n,t,o){"use strict";o.r(t);var e=o("be00"),s=o.n(e);for(var u in e)"default"!==u&&function(n){o.d(t,n,(function(){return e[n]}))}(u);t["default"]=s.a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ns-chat/ns-chat-goods-create-component',
    {
        'components/ns-chat/ns-chat-goods-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('543d')['createComponent'](__webpack_require__("3703"))
        })
    },
    [['components/ns-chat/ns-chat-goods-create-component']]
]);
