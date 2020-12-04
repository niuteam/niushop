(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/l-time/l-time"],{"3a15":function(t,e,n){"use strict";var a;n.d(e,"b",(function(){return u})),n.d(e,"c",(function(){return i})),n.d(e,"a",(function(){return a}));var u=function(){var t=this,e=t.$createElement;t._self._c},i=[]},"5deb":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=u(n("8eac"));function u(t){return t&&t.__esModule?t:{default:t}}var i={name:"l-time",props:{text:{type:[String,Number,Date],default:""},maxDate:{type:Boolean,default:!1}},data:function(){return{textVal:this.text}},watch:{text:function(){this.textVal=this.text}},computed:{temp:function(){return this.getText()}},methods:{getText:function(){var t=this,e=a.default.getFormatTime(t.textVal,t.maxDate);return e&&(e.endsWith("刚刚")||e.endsWith("分钟前"))&&setTimeout((function(){var e=t.textVal;t.textVal="",t.textVal=e}),6e4),this.textVal?e:""},onClick:function(){this.$emit("on-tap",this.textVal)}}};e.default=i},9050:function(t,e,n){"use strict";n.r(e);var a=n("3a15"),u=n("f232");for(var i in u)"default"!==i&&function(t){n.d(e,t,(function(){return u[t]}))}(i);var r,o=n("f0c5"),l=Object(o["a"])(u["default"],a["b"],a["c"],!1,null,null,null,!1,a["a"],r);e["default"]=l.exports},f232:function(t,e,n){"use strict";n.r(e);var a=n("5deb"),u=n.n(a);for(var i in a)"default"!==i&&function(t){n.d(e,t,(function(){return a[t]}))}(i);e["default"]=u.a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/l-time/l-time-create-component',
    {
        'components/l-time/l-time-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('543d')['createComponent'](__webpack_require__("9050"))
        })
    },
    [['components/l-time/l-time-create-component']]
]);
