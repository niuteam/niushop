var ns = window.ns_url;
/* 基础对象检测 */
ns || $.error("js-ns_url基础配置没有正确加载！");
/**
 * 解析URL
 * @param  {string} url 被解析的URL
 * @return {object}     解析后的数据
 */
ns.parse_url = function(url){
    var parse = url.match(/^(?:([a-z]+):\/\/)?([\w-]+(?:\.[\w-]+)+)?(?::(\d+))?([\w-\/]+)?(?:\?((?:\w+=[^#&=\/]*)?(?:&\w+=[^#&=\/]*)*))?(?:#([\w-]+))?$/i);
    parse || $.error("url格式不正确！");
    return {
  "scheme"   : parse[1],
  "host"     : parse[2],
  "port"     : parse[3],
  "path"     : parse[4],
  "query"    : parse[5],
  "fragment" : parse[6]
    };
}
ns.parse_str = function(str){
    var value = str.split("&"), vars = {}, param;
    for(val in value){
  param = value[val].split("=");
  vars[param[0]] = param[1];
    }
    return vars;
}
ns.parse_name = function(name, type){
    if(type){
  /* 下划线转驼峰 */
  name = name.replace(/_([a-z])/g, function($0, $1){
return $1.toUpperCase();
  });
  /* 首字母大写 */
  name = name.replace(/[a-z]/, function($0){
return $0.toUpperCase();
  });
    } else {
  /* 大写字母转小写 */
  name = name.replace(/[A-Z]/g, function($0){
return "_" + $0.toLowerCase();
  });
  /* 去掉首字符的下划线 */
  if(0 === name.indexOf("_")){
name = name.substr(1);
  }
    }
    return name;
}
//scheme://host:port/path?query#fragment
ns.url = function(url, vars, suffix){
    var info = this.parse_url(url), path = [], param = {}, reg;
    
    /* 验证info */
    info.path || $.error("url格式错误！");
    url = info.path;
    /* 解析URL */
    path = url.split("/");
    path = [path.pop(), path.pop(), path.pop()].reverse();
    path[1] = path[1] || this.route[1];
    path[0] = path[0] || this.route[0];
//  param[this.route[0]] = path[0];
//  param[this.route[1]] = path[1];
//  param[this.route[2]] = path[2].toLowerCase();
//	url = param[this.route[0]] + '/' + param[this.route[1]] + '/' + param[this.route[2]];
    param[this.route[2]] = path[0];
    param[this.route[3]] = path[1];
    param[this.route[4]] = path[2].toLowerCase();
    url = param[this.route[2]] + '/' + param[this.route[3]] + '/' + param[this.route[4]];
    /* 解析参数 */
    if(typeof vars === "string"){
  vars = this.parse_str(vars);
    } else if(!$.isPlainObject(vars)){
  vars = {};
    }
    /* 添加伪静态后缀 */
    if(false !== suffix){
  suffix = suffix || 'html';
  if(suffix){
url += "." + suffix;
  }
    }
    /* 解析URL自带的参数 */
    info.query && $.extend(vars, this.parse_str(info.query));
    /* 判断站点id是否存在 */
    var site = '';
    if(vars.site_id){
    	var site_id = vars.site_id;
    	delete vars.site_id;
    	site = 's'+parseInt(site_id) + '/';
    }else{
    	var site_id = this.route[0];
    	site = site_id > 0 ? 's' + parseInt(site_id) + '/' : '';
    }
    var addon = '';
    if(info.scheme != '' && info.scheme != undefined){
    	addon = info.scheme + '/';
    }
    url = site + addon + url;
    if(vars){
  var param_str = $.param(vars);
  if('' !== param_str) {
url += ((this.baseUrl + url).indexOf('?') !== -1 ? '&' : '?') + param_str;
  }
    }
    url = this.baseUrl + url;
    return url;
}

/**
 * 处理图片路径
 */
ns.img = function(path, type = '') {
    if(path.indexOf("http://") == -1 && path.indexOf("https://") == -1) {
        var start = path.lastIndexOf('.');
        type = type ? '_' + type : '';
        var base_url = this.baseUrl.replace('/?s=', '');
        var suffix = path.substring(start);
        var path = path.substring(0, start);
        var true_path = base_url + 'attachment/' + path + type + suffix;
    }else{
        var true_path = path;
    }
	return true_path;
}

/**
 * 时间戳转时间
 * 
 */
ns.time_to_date = function(timeStamp){
	if(timeStamp > 0){
		var date = new Date();
		date.setTime(timeStamp * 1000);
		var y = date.getFullYear();
		var m = date.getMonth() + 1;
		m = m < 10 ? ('0' + m) : m;
		var d = date.getDate();
		d = d < 10 ? ('0' + d) : d;
		var h = date.getHours();
		h = h < 10 ? ('0' + h) : h;
		var minute = date.getMinutes();
		var second = date.getSeconds();
		minute = minute < 10 ? ('0' + minute) : minute;
		second = second < 10 ? ('0' + second) : second;
		return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;
	}else{
		return "";
	}
}
/**
 * url 反转义
 * @param url
 */
ns.urlReplace = function(url){
    var new_url = url.replace(/%2B/g, "+");//"+"转义
    new_url= new_url.replace(/%26/g,"&");//"&"
    new_url= new_url.replace(/%23/g, "#");//"#"
    new_url= new_url.replace(/%20/g," ");//" "
    new_url= new_url.replace(/%3F/g, "?");//"#"
    new_url= new_url.replace(/%25/g, "%");//"#"
    new_url= new_url.replace(/&3D/g,"=");//"#"
    new_url= new_url.replace(/%2F/g, "/");//"#"
    return new_url;
}