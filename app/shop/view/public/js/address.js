var form;
layui.use('form',function () {
    form = layui.form;
	form.render();

    //省 - 监听地址操作
    form.on('select(province_id)', function (obj) {
        getAreaList(obj.value, 2);//重新渲染地址
    });
    //市 - 监听地址操作
    form.on('select(city_id)', function (obj) {
        getAreaList(obj.value, 3);//重新渲染地址
    });
    //区 - 监听地址操作
    form.on('select(district_id)', function (obj) {
        getAreaList(obj.value, 4);//重新渲染地址
    });
    //乡镇 - 监听地址操作
    form.on('select(community_id)', function (obj) {
        getAreaList(obj.value, 5);//重新渲染地址
    });
    
    //省 - 监听地址操作
    $('body').on("change",'select[name=province_id]',function (obj) {
        getAreaList(this.value, 2);//重新渲染地址
        form.render();
    });
    //市 - 监听地址操作
    $('body').on("change",'select[name=city_id]',function (obj) {
        getAreaList(this.value, 3);//重新渲染地址
        form.render();
    });
    //区县 - 监听地址操作
    $('body').on("change",'select[name=district_id]',function (obj) {
        getAreaList(this.value, 4);//重新渲染地址
        form.render();
    });
    
});

/**
 * 获取地区列表
 * @param pid
 * @param level
 */
function getAreaList(pid, level){
    if(level <= 5){
        $.ajax({
            type : "POST",
            dataType: 'JSON',
            url : ns.url("shop/address/getAreaList"),
            data : {level,pid},
            async : false,
            success : function(res) {
                if(res.code == 0){
                    if(level == 1){
                        $("select[name=province_id] option:gt(0)").remove();
                        $("select[name=city_id] option:gt(0)").remove();
                        $("select[name=district_id] option:gt(0)").remove();
                        $.each(res.data, function(name, value) {
                            $("select[name=province_id]").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });
                    }else if(level == 2){
                        $("select[name=city_id] option:gt(0)").remove();
                        $("select[name=district_id] option:gt(0)").remove();
                        $.each(res.data, function(name, value) {
                            $("select[name=city_id]").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });
                    }else if(level == 3){
                        $("select[name=district_id] option:gt(0)").remove();
                        $.each(res.data, function(name, value) {
                            $("select[name=district_id]").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });

                    }else if(level == 4){
                        $("select[name=community_id] option:gt(0)").remove();
                        $.each(res.data, function(name, value) {
                            $("select[name=community_id]").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });
                    }
                }else{
                    layer.msg(res.message);
                }
                form.render();
            }
        });
    }
}
/**
 * 初始化地址
 * @param obj {"province_id" : '', "city_id" : '', "district_id" : '', "community_id" : ''}
 */
function initAddress(obj, filter){
    form.val(filter, {
        "province_id": obj.province_id
    });
    $("select[name=province_id]").change();
    form.val(filter, {
        "city_id":  obj.city_id
    });
    $("select[name=city_id]").change();
    form.val(filter, {
        "district_id": obj.district_id
    });
    $("select[name=district_id]").change();
    form.val(filter, {
        "community_id":  obj.community_id
    });
    form.render();
}
