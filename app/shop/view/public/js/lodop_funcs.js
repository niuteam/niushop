var CLodopJsState;

//====加载C-Lodop的过程(用script元素动态引用主文件CLodopfuncs.js)====
function loadCLodop() {
    if (CLodopJsState == "loading" || CLodopJsState == "complete")
        return;
    CLodopJsState = "loading";
    var head = document.head || document.getElementsByTagName("head")[0] || document.documentElement;
    var JS1 = document.createElement("script");
    var JS2 = document.createElement("script");
    var JS3 = document.createElement("script");

    //优先调用本地(Localhost)8000端口服务：
    JS1.src = "http://localhost:8000/CLodopfuncs.js?priority=2";

    //如果失败，则调用本地18000端口：
    JS2.src = "http://localhost:18000/CLodopfuncs.js?priority=1";

    //最后如本地无C-Lodop时，则演示通过本服务远程打印：
    JS3.src = "/CLodopfuncs.js";

    JS1.onload  = JS2.onload  = JS3.onload = function() {CLodopJsState = "complete";}
    JS1.onerror = JS2.onerror = JS3.onerror = function(evt) {CLodopJsState = "complete";}
    head.insertBefore(JS1, head.firstChild);
    head.insertBefore(JS2, head.firstChild);
    head.insertBefore(JS3, head.firstChild);
}

//本例演示所有浏览器都调用C-Lodop:
function needCLodop() {
    return true;
}

//执行加载:
if (needCLodop()) {
    loadCLodop();
}

//====获取LODOP对象的主过程：====
function getLodop(oOBJECT, oEMBED) {
    var LODOP;
    var strCLodopUpdate = "<br><font color='#FF00FF'>Web打印服务CLodop需升级!点击这里<a href='CLodop_Setup_for_Win32NT.zip' target='_self'>执行升级</a>,升级后请刷新页面。</font>";
    try {
        try {
            LODOP = getCLodop(); //获得主对象（getCLodop是在CLodopfuncs.js定义的）
        } catch (err) {}

        if (!LODOP && CLodopJsState !== "complete") {
            if (CLodopJsState == "loading")
                alert("网页还没下载完毕，请稍等一下再操作.");
            else
                alert("没有加载CLodop的主js，请先调用loadCLodop过程.");
            return;
        }
		
		if (!LODOP) {
			// document.body.innerHTML = strCLodopInstall_1 + (CLodopIsLocal ? strCLodopInstall_2 : "") + strCLodopInstall_3 + document.body.innerHTML;
			layer.open({
				type: 1,
				area: ['450px'],
				content: "Web打印服务CLodop未安装启动，点击这里<a class='ns-text-color' href='http://www.lodop.net/download.html' target='_black'>去下载安装</a><br />（若此前已安装过，可<a class='ns-text-color' href='CLodop.protocol:setup' target='_self'>点这里直接再次启动</a>）" //这里content是一个普通的String
			});
			return;
		} else {
			if (CLODOP.CVERSION < "4.0.9.9") {

                layer.open({
                    type: 1,
                    area: ['450px'],
                    content: "Web打印服务CLodop版本过低，需升级，请点击这里<a class='ns-text-color' href='http://www.lodop.net/download.html' target='_black'>去下载安装</a><br />（若此前已安装过，可<a class='ns-text-color' href='CLodop.protocol:setup' target='_self'>点这里直接再次启动</a>）" //这里content是一个普通的String
                });
                return;
			}
			if (oEMBED && oEMBED.parentNode)
				oEMBED.parentNode.removeChild(oEMBED);
			if (oOBJECT && oOBJECT.parentNode)
				oOBJECT.parentNode.removeChild(oOBJECT);
		}

        //清理旧例子的object或embed元素(避免乱提示干扰理解)：
        if (oEMBED && oEMBED.parentNode)   oEMBED.parentNode.removeChild(oEMBED);
        if (oOBJECT && oOBJECT.parentNode) oOBJECT.parentNode.removeChild(oOBJECT);

        return LODOP;
    } catch (err) {
        alert("getLodop出错:" + err);
    }
}
