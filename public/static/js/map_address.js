//author  周
// var map, marker, infoWindow,  geolocation, geocoder;//地图加载默认参数
mapClass = function(id, lnglat, map_success_back){
    /*******************************************************地图加载事件start**********************************************************/
    //加载地图，调用浏览器定位服务
    _this = this;

    this.init(id, lnglat, map_success_back);//初始化函数
};
mapClass.prototype = {
    init : function(id, lnglat, map_success_back){
        _this.setAttr();

        _this.map_callback = map_success_back;

        var msp_json = {
            zoom: _this.zoom
        }
        if(lnglat["lat"] != ''|| lnglat["lng"] != '' ){
            msp_json["center"] = [lnglat["lng"], lnglat["lat"]]//初始化地图中心点}
        }
        _this.map = new AMap.Map(id, msp_json);

        //加载地图插件
        _this.map.plugin('AMap.Geolocation', function() {
            _this.geolocation = new AMap.Geolocation({
                enableHighAccuracy: false,//是否使用高精度定位，默认:true
                timeout: 1,          //超过10秒后停止定位，默认：无穷大
                buttonOffset: new AMap.Pixel(2.5, 2.5),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
                zoomToAccuracy: false,      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
                buttonPosition:'RB',
                showMarker: false,        //定位成功后在定位到的位置显示点标记，默认：true
            });
            _this.map.plugin(["AMap.ToolBar"], function() {
                _this.map.addControl(new AMap.ToolBar());
            });

            // _this.geolocation.getCurrentPosition();

            _this.marker = new AMap.Marker({
                map:_this.map,
                bubble:true
            })
            _this.infoWindow = new AMap.InfoWindow({
                content: '',
                offset: {x: 0, y: -30}
            });


            _this.map.plugin('AMap.Geocoder',function(){
                _this.geocoder = new AMap.Geocoder({
                    radius: 500 //范围，默认：500
                });
            });
            AMap.event.addListener(_this.geolocation, 'complete', function(data){
                _this.map_change = false;
                _this.markerMove(data.position, data.formattedAddress, data.addressComponent);

            });//返回定位信息
            AMap.event.addListener(_this.geolocation, 'error', function(){});      //返回定位出错信息

        });
        _this.map.on('click',function(e){
            if(_this.map_click){
                _this.map_change = false;
                _this.geocoder.getAddress(e.lnglat,function(status,result){
                    if(status == 'complete'){
                        _this.markerMove(e.lnglat, result.regeocode.formattedAddress,result.regeocode.addressComponent);
                    }else{
                        _this.markerMove(e.lnglat, "定位失败");
                    }
                })
            }else{
                return false;
            }

        })

        if(_this.map_callback != undefined){
            _this.map_callback(_this);
        }

    },
    getCurrentPosition : function (){
        _this.geolocation.getCurrentPosition();

    },
    onComplete : function(data){
        // console.log(data);
        // if (_this.location) {
            _this.map_change = false;
            _this.markerMove(data.position, data.formattedAddress, data.addressComponent);
        // }else{
        //     _this.location = true;
        //     if(_this.map_callback != undefined){
        //         _this.map_callback(_this);
        //     }
        //
        // }
    },
    onError : function(){

    },
    markerMove : function(position, address, data){
        var address_detail = address;
        address_detail = address_detail.replace(data.province,'');
        address_detail = address_detail.replace(data.city,'');
        address_detail = address_detail.replace(data.district,'');
        address_detail = address_detail.replace(data.township,'');

        _this.marker.setPosition(position);
        _this.infoWindow.setContent("<p>当前位置：<span class='nc-text-color'>" + address + "</span>");
        // _this.infoWindow.setPosition("<p>当前位置：<span style='color:#0689e1;'>" + address + "</span>");
        // _this.infoWindow.setPosition();
        _this.infoWindow.open(_this.map, position);
        _this.map.setZoomAndCenter(20, _this.marker.getPosition());//设置地图放大级别及居中

        _this.address.province_name = data.province;
        if(data.city == ""){
            _this.address.city_name = data.province;
        }else{
            _this.address.city_name = data.city;
        }
        _this.address.district_name = data.district;
        _this.address.township_name = data.township;
        _this.address.area = _this.address.province_name+","+_this.address.city_name+","+_this.address.district_name+","+_this.address.township_name;

        _this.address.longitude = position.lng;
        _this.address.latitude = position.lat;
        _this.address.address = address_detail;
        if(!_this.map_change){
            console.log( _this.address);
            mapChangeCallBack();
        }else{
            selectCallBack();

        }
    },
    mapChange : function(address){
        if (_this.map_change) {

                var province_name = _this.address.province > 0 ? _this.address.province_name : '';
                var city_name = _this.address.province > 0 && _this.address.city > 0 ? _this.address.city_name : '';
                var districts_name = _this.address.province > 0 && _this.address.city > 0 && _this.address.district > 0 ? _this.address.district_name : '';
                // var township_name = _this.address.province > 0 && _this.address.city > 0 && _this.address.district > 0 && _this.address.township > 0 ? _this.address.township_name : '';
                // var address_detail = _this.address.province > 0 && _this.address.city > 0 && _this.address.district > 0 && _this.address.township > 0 ? _this.address.detail_address : '';
				var address_detail = _this.address.province > 0 && _this.address.city > 0 && _this.address.district > 0 ? _this.address.detail_address : '';
                if(!address){
                	// address = province_name + city_name + districts_name + township_name + address_detail;
					address = province_name + city_name + districts_name + address_detail;
                }
                _this.geocoder.getLocation(address, function (status, result) {
                    if (status === 'complete' && result.info === 'OK') {
                        _this.markerMove(result.geocodes[0].location, result.geocodes[0].formattedAddress, result.geocodes[0].addressComponent);
                    }
                });
        }

    },
    setAttr : function(){
        _this.map = "";
        _this.marker = "";
        _this.infoWindow = "";
        _this.geolocation = "";
        _this.geocoder = "";
        _this.location = false;
        _this.map_change = true;
        _this.map_click = true;
        _this.zoom = 15;
        _this.address = {
            province : "",
            province_name : "",
            city : "",
            city_name : "",
            district : "",
            district_name : "",
            township : "",
            township_name : "",
            address : "",
            longitude : "",
            latitude : "",
            area : ""
        };
    },
    destroy : function(){
        _this.map.destroy( );//销毁地图
    },
    setMapCircle : function(radius_num, position){
        if(radius_num == undefined && radius_num <= 0){
            return;
        }
        _this.map.clearMap();
        // var circle_arr = map.getAllOverlays('circle');
        // if(circle_arr.length > 0){{
        //     map.remove(circle)
        // }
        console.log(position);

        if(position != undefined){
            var center_position = new AMap.LngLat(position['lon'], position['lat'])
        }else{
            var center_position = _this.marker.getPosition();
        }
        var circle = new AMap.Circle({
            center:  center_position,// 圆心位置
            radius: radius_num*1000, //半径
            strokeColor: "#F33", //线颜色
            strokeOpacity: 1, //线透明度
            strokeWeight: 3, //线粗细度
            fillColor: "#ee2200", //填充颜色
            fillOpacity: 0.35//填充透明度
        });
        _this.map.add(_this.marker);
        circle.setMap(_this.map);
    }

}


