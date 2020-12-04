/**
 * 渲染订单列表	156
 * 创建时间：2018年8月15日18:28:43
 */
Order = function(){};

/**
 * 设置数据集
 */
Order.prototype.setData = function(data){
    Order.prototype.data = data;
};

/**
 * 列名数据
 */
Order.prototype.cols = [
    {
        title : '<span style="margin-left:10px;">商品信息</span>',
        width : "25%",
        className : "product-info",
        template : function(item){
            var h = '<div class="img-block" >';
            h += '<img layer-src src="'+ ns.img(item.sku_image,'small') +'">';
            h += '</div>';
            h += '<div class="info">';
            // h += '<a  href="javascript:void(0);" target="_blank">' + item.sku_name + '</a>';
            h += '<a  href="javascript:void(0);" title="' + item.sku_name + '">' + item.sku_name + '</a>';
            h += '</div>';
            return h;
        }
    },
    {
        title : "发货状态",
        width : "10%",
        align : "center",
        className : "delivery-status",
        template : function(item){
            var h = '<div>';
            h += '<span>' + item.delivery_status_name + '</span>';
            h += '</div>';
            return h;
        }
    },
    {
        title : "订单金额",
        width : "10%",
        align : "right",
        className : "order-money",
        template : function(item){
            var h = '<div style="padding-right: 15px;">';
            h += '<span>￥' + item.real_goods_money + '</span>';
            h += '</div>';
            return h;
        }
    },
    {
        title : "退款金额",
        width : "10%",
        align : "right",
        className : "refund-money",
        template : function(item){
            var h = '<div style="padding-right: 15px;">';
            h += '<span>￥' + item.refund_apply_money + '</span>';
            h += '</div>';
            return h;
        }
    },
    {
        title : "申请时间",
        width : "17%",
        align : "center",
        className : "apply-time",
        merge : true,
        template : function(item){
            return '<div title="'+ ns.time_to_date(item.refund_action_time) +'">' + ns.time_to_date(item.refund_action_time) + '</div>';
        }
    },
    {
        title : "退款状态",
        width : "15%",
        align : "center",
        className : "refund-status",
        merge : true,
        template : function(item){
            return '<div>' + item.refund_status_name + '</div>';
        }
    },
    {
        title : "操作",
        width : "15%",
        align : "left",
        className : "operation",
        merge : true,
        template : function(item){
            var html = '<div class="ns-table-btn"><a class="layui-btn" href="'+ ns.url("shop/orderrefund/detail",{order_goods_id:item.order_goods_id})+'"  target="_blank">查看详情</a></div>';
            return html;

        }
    }
];

/**
 * 渲染表头
 */
Order.prototype.header = function(){
    var colgroup = '<colgroup>';
    var thead = '<thead><tr>';

    for(var i=0;i<this.cols.length;i++){
        var align = this.cols[i].align ? "text-align:" + this.cols[i].align : "";

        colgroup += '<col width="' + this.cols[i].width + '">';
        thead += '<th style="' + align + '" class="' + (this.cols[i].className || "") + '">';
        thead += '<div class="layui-table-cell">' + this.cols[i].title + '</div>';
        thead += '</th>';
    }
    colgroup += '</colgroup>';
    thead += '</tr></thead>';
    return colgroup + thead;
};

/**
 * 渲染内容
 */
Order.prototype.tbody = function(){

    var tbody = '<tbody>';
    for(var i=0;i<this.data.list.length;i++){

        var item = this.data.list[i];

        //分割行
        // tbody += '<tr class="separation-row">';
        // tbody += '<td colspan="' + this.cols.length + '"></td>';
        // tbody += '</tr>';
        var refund_type_name = "";
        if(item.refund_type == 1){
            refund_type_name = "仅退款";
        }else{
            refund_type_name = "退款退货";
        }
		
        //订单项头部
		
		//分割行
		tbody += '<tr class="separation-row">';
		tbody += '<td colspan="' + this.cols.length + '"></td>';
		tbody += '</tr>';
		
		// tbody += '<tr class="separation-row"><td colspan="7"><hr /></td></tr>';
        tbody += '<tr class="header-row">';
        tbody += '<td colspan="7">';
        tbody += '<span class="order-item-header" style="margin-right:50px;">退款编号：' + item.refund_no + '</span>';
        tbody += '<span class="order-item-header" style="margin-right:50px;">订单编号：' + item.order_no + '</span>';
        tbody += '<span class="order-item-header">' + refund_type_name + '</span>';
        tbody += '</td>';
        tbody += '</tr>';

        var orderitemHtml = '';
		loadImgMagnify();
        // for(var j=0;j<orderitemList.length;j++){
        //
        //     var orderitem = orderitemList[j];
            orderitemHtml += '<tr class="content-row">';
            for(var k=0;k<this.cols.length;k++){
        //
        //         if(j == 0 && this.cols[k].merge && this.cols[k].template){
        //
        //             orderitemHtml += '<td class="' + (this.cols[k].className || "") + '" align="' + (this.cols[k].align || "") + '" style="border-right-width: 1px;' + (this.cols[k].style || "") + '" rowspan="' + orderitemList.length + '">';
        //             orderitemHtml += this.cols[k].template(orderitem,order);
        //             orderitemHtml += '</td>';
        //
        //         }else if(this.cols[k].template && !this.cols[k].merge){

                    orderitemHtml += '<td class="' + (this.cols[k].className || "") + '" align="' + (this.cols[k].align || "") + '" style="' + (this.cols[k].style || "") + '">';
                    orderitemHtml += this.cols[k].template(item);
                    orderitemHtml += '</td>';

            //     }
            }
            orderitemHtml += '</tr>';
        // }
        tbody += orderitemHtml;
    }

    tbody += '</tbody>';
    return tbody;
};

/**
 * 渲染表格
 */
Order.prototype.fetch = function(){
    if(this.data.list.length > 0){

        return '<table class="layui-table order-list-table layui-form">' + this.header() + this.tbody() + '</table>';
    }else{
        return '<table class="layui-table order-list-table layui-form">' + this.header() + '</table>'+'<div class="order-no-data-block"><ul><li><i class="layui-icon layui-icon-tabs"></i> </li><li>暂无数据</li></ul></div>';
    }
};