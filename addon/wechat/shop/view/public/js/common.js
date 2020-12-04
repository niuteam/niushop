/**
 * 素材库
 * @param type
 */
function material(type){
    layui.use(['layer'], function() {
        layer.open({
            type: 2,
            title: "素材库",
            area: ['890px', '700px'],
            fixed: false, //不固定
            maxmin: false,
            content: ns.url("wechat://shop/material/material", {type: type})
        })
    })
}