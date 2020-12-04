var map;
/**
 * 创建地图
 * @param latlng
 */

function createMap(id, lnglat) {
    var map_json = {
        zoom: 14
    }
    if(lnglat["lat"] != ''|| lnglat["lng"] != '' ){
        map_json["center"] = [lnglat["lng"], lnglat["lat"]]//初始化地图中心点}
    }

    map = new AMap.Map(id, map_json);
}


var overlayers_array = {};
var editor_array = {};
/**
 * 创建一个圆, 并且给与编辑权限
 */
function createCircle(key, color, border_color, path_param){

    if(path_param == undefined){
        var center = map.getCenter(); //获取当前地图中心位置
        var radius = 1000;
    }else{
        var center = [path_param.center.longitude,path_param.center.latitude]
        var radius = path_param.radius;
    }


    var circle = new AMap.Circle({
        center:  center,
        radius: radius, //半径
        borderWeight: 3,
        strokeColor: border_color,
        strokeOpacity: 1,
        strokeWeight: 6,
        strokeOpacity: 0.2,
        fillOpacity: 0.4,
        strokeStyle: 'solid',
        strokeDasharray: [10, 10],
        // 线样式还支持 'dashed'
        fillColor: color,
        zIndex: 50,
    })


    circle.setMap(map);
    // 缩放地图到合适的视野级别
    map.setFitView(getArray(overlayers_array));

    overlayers_array[key] = circle;
    var circleEditor = new AMap.CircleEditor(map, circle)
    editor_array[key] = circleEditor;

    circle.on('click', function(){
        $.each(editor_array, function(i, item){
            item.close();
        });
        circleEditor.open();
    });
    circleEditor.on('move', function(event) {
        // log.info('触发事件：move')
    })

    circleEditor.on('adjust', function(event) {
        // log.info('触发事件：adjust')
    })

    circleEditor.on('end', function(event) {
        // log.info('触发事件： end')
        // event.target 即为编辑后的圆形对象
    })
}

/**
 * 创建多边形
 * @param key
 */
function createPolygon(key, color, border_color, path_param){

    var center = map.getCenter();
    var lat = center.lat;
    var lng = center.lng;
    if(path_param == undefined){
        var path = [
            [lng+0.01, lat+0.01],
            [lng+0.01, lat-0.01],
            [lng-0.01, lat-0.01],
            [lng-0.01, lat+0.01]
        ]
    }else{
        var path = [
        ]
        $.each(path_param, function(i, item){
            path.push([item.longitude,item.latitude]);
        });
    }


    var polygon = new AMap.Polygon({
        path: path,
        strokeColor: border_color,
        strokeWeight: 6,
        strokeOpacity: 0.2,
        fillOpacity: 0.4,
        fillColor: color,
        zIndex: 50,
    })

    map.add(polygon)
    overlayers_array[key] = polygon;
    // 缩放地图到合适的视野级别

    map.setFitView(getArray(overlayers_array));

    var polyEditor = new AMap.PolyEditor(map, polygon)
    editor_array[key] = polyEditor;

    polygon.on('click', function(){
        $.each(editor_array, function(i, item){
            item.close();
        });
        polyEditor.open();
    });

    polyEditor.on('addnode', function(event) {
        // log.info('触发事件：addnode')
    })

    polyEditor.on('adjust', function(event) {
        // log.info('触发事件：adjust')
    })

    polyEditor.on('removenode', function(event) {
        // log.info('触发事件：removenode')
    })

    polyEditor.on('end', function(event) {
        // log.info('触发事件： end')
        // event.target 即为编辑后的多边形对象
    })
}


/**
 * 移除覆盖物
 * @param overlayers
 */
function removeOverlayers(key){
    var overlayers_item = overlayers_array[key];
    var editor_item = editor_array[key];
    editor_item.close();//关闭覆盖物编辑
    map.remove(overlayers_item);//删除覆盖物

}

/**
 * 给与覆盖物焦点
 */
function foursOverlayers(key){
    var editor_item = editor_array[key];
    foursOverlayersAction(editor_item);
}

function foursOverlayersAction(obj){
    $.each(editor_array, function(i, item){
        item.close();
    });
    obj.open();
}

/**
 * 获取覆盖物实例
 * @param key
 * @returns {*}
 */
function getOverlayersPath(key, type){
    var overlayers_item = overlayers_array[key];
    switch(type){
        //多边形
        case 'polygon':{
            var return_json = [];
            var path = overlayers_item.getPath();
            $.each(path, function(i, item){
                var item_json = {longitude:item.lng,latitude:item.lat};
                return_json.push(item_json);
            });
            return return_json;
            break;
        }
        //圆
        case 'circle':{
            var return_json = {};
            var center = overlayers_item.getCenter();
            return_json['center'] = {longitude:center.lng,latitude:center.lat};
            return_json['radius'] = overlayers_item.getRadius();
            return return_json;
            break;
        }
    }


}
function getArray(array){
    var temp_array = [];
    $.each(array, function(i, item){
        temp_array.push(item);
    });
    return temp_array;
}