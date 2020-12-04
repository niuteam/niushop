/**
 * 渲染订单列表
 */
Delivery = function () {
};

/**
 * 设置数据集
 */
Delivery.prototype.setData = function (data) {
    Delivery.prototype.data = data;
};


/**
 * 列名数据
 */
Delivery.prototype.cols = [
    {
        type: 'checkbox',
        fixed: 'left',
        width: '4%',
        merge: true,
        template: function (orderitem, order) {
            var json = {}
            json.order_id = order.order_id;
            json.order_no = order.order_no;
            json.full_address = order.full_address;

            var h = '<div class="sub-selected-checkbox" data-json='+ JSON.stringify(json) +'>';
            h += '<input type="checkbox" lay-skin="primary" lay-filter="subCheckbox" name="">';
            h += '</div>';
            return h;
        }
    },
    {
        title: '<span>商品</span>',
        width: "30%",
        className: "product-info",
        template: function (orderitem, order) {

            var h = '<div class="img-block">';
            h += '<img layer-src src="' + ns.img(orderitem.sku_image,'small') + '">';
            h += '</div>';
            h += '<div class="info">';
            h += '<a href="' + ns.url("shop/order/detail", {order_id: orderitem.order_id}) + '" target="_blank" title="' + orderitem.sku_name + '" class="ns-multi-line-hiding ns-text-color">' + orderitem.sku_name + '</a>';
            if (orderitem.refund_status_name != '') {
                h += '<br/><a href="' + ns.url("shop/orderrefund/detail", {order_goods_id: orderitem.order_goods_id}) + '"  target="_blank" class="ns-text-color">' + orderitem.refund_status_name + '</a>&nbsp;&nbsp;';
            }
            return h;
        }
    },
    {
        title: "单价(元) / 数量",
        width: "10%",
        align: "right",
        className: "order-price",
        template: function (orderitem, order) {
            var h = '<div style="padding-right: 15px;">';
            h += '<div>';
            h += '<span>' + orderitem.price + '</span>';
            h += '</div>';
            h += '<div>';
            h += '<span>' + orderitem.num + '件</span>';
            h += '</div>';
            h += '</div>';
            return h;
        }
    },
    {
        title: "实付金额(元)",
        width: "10%",
        align: "right",
        className: "order-money",
        merge: true,
        template: function (orderitem, order) {
            var h = '<div style="padding-right: 15px;">';
            h += '<span>' + order.order_money + '</span>';
            h += '</div>';
            return h;
        }
    },
    {
        title: "买家/收货人",
        width: "20%",
        align: "left",
        className: "buyers",
        merge: true,
        template: function (orderitem, order) {
            var h = '';
            h += '<p>';
            h += '<a class="ns-text-color" target="_blank" href="' + ns.url("shop/member/editmember?member_id=") + order.member_id + '">' + order.nickname + '</a>';
            h += '</p>';
            if (order.order_type != 4) {
                h += '<p>';
                h += '<span href="javascript:;">' + order.name + '</span>';
                h += '</p>';
                h += '<span>' + order.mobile + '</span>';
                h += '<span class="ns-line-hiding" title="' + order.full_address + '">' + order.full_address + " " + order.address + '</span>';
            } else {
                h += '<p>';
                h += '<span>' + order.mobile + '</span>';
                h += '</p>';
            }

            return h;
        }
    },
    {
        title: "交易状态",
        width: "10%",
        align: "center",
        className: "transaction-status",
        merge: true,
        template: function (orderitem, order) {
            // console.log("orderitem",order);
            // if(order.order_status_name == '待支付'){
            //
            // }else if(order.order_status_name == '待发货'){
            //
            // }

            var html = '<div>' + order.order_status_name + '</div>';
            // html += '<div>' + order.promotion_type_name;
            html += order.promotion_status_name != '' ? '(' + order.promotion_status_name + ')' : '';
            html += '</div>';
            return html;
        }
    },
    // {
    //     title : "下单时间",
    //     width : "10%",
    //     align : "center",
    //     className : "create-time",
    //     merge : true,
    //     template : function(orderitem,order){
    //         return '<div>' + ns.time_to_date(order.create_time) + '</div>';
    //     }
    // },
    // {
    //     title : "结算状态",
    //     width : "10%",
    //     align : "center",
    //     className : "settlement",
    //     merge : true,
    //     template : function(orderitem,order){
    //         var settlement_name = order.is_settlement == 1 ? "已结算" : "待结算";
    //         return '<div>'+settlement_name+'</div>';
    //     }
    // },
    {
        title: "操作",
        width: "16%",
        align: "left",
        className: "operation",
        merge: true,
        template: function (orderitem, order) {
            var url = "shop/order/detail";
            var html = '';
            var action_json = order.order_status_action;
            var action_arr = JSON.parse(action_json);
            var action = action_arr.action;
            html += '<div class="ns-table-btn">';
            for (var k = 0; k < action.length; k++) {
                html += '<a class="layui-btn" href="javascript:orderAction(\'' + action[k].action + '\', ' + order.order_id + ')">' + action[k].title + '</a>';
            }
            html += '</div>';
            return html;

        }
    }
];

/**
 * 渲染表头
 */
Delivery.prototype.header = function (hasThead) {
    var colgroup = '<colgroup>';
    var thead = '';
    if (hasThead) thead = '<thead><tr>';

    for (var i = 0; i < this.cols.length; i++) {

        var align = this.cols[i].align ? "text-align:" + this.cols[i].align : "";

        colgroup += '<col width="' + this.cols[i].width + '">';
        if (hasThead) {
            thead += '<th style="' + align + '" class="' + (this.cols[i].className || "") + '">';
            thead += '<div class="layui-table-cell">';
            if(this.cols[i].type){
                thead += '<div class="all-selected-checkbox">';
                thead += '<input type="checkbox" lay-skin="primary" lay-filter="allCheckbox" name="">';
                thead += '</div>';
            }else{
                thead +=  this.cols[i].title;
            }
            thead += '</div>';
            thead += '</th>';
        }
    }
    colgroup += '</colgroup>';
    if (hasThead) thead += '</tr></thead>';
    return colgroup + thead;
};

/**
 * 渲染内容
 */
Delivery.prototype.tbody = function () {

    var tbody = '<tbody>';
    for (var i = 0; i < this.data.list.length; i++) {

        var order = this.data.list[i];
        var orderitemList = order.order_goods;
        var pay_type_name = order.pay_type_name != '' ? order.pay_type_name : "";

        if (i > 0) {
            //分割行
            tbody += '<tr class="separation-row">';
            tbody += '<td colspan="' + this.cols.length + '"></td>';
            tbody += '</tr>';
        }

        //订单项头部
        tbody += '<tr class="header-row">';
        tbody += '<td colspan="6">';
        tbody += '<span class="order-item-header" style="margin-right:10px;">订单号：' + order.order_no + '</span>';
        tbody += '<span class="order-item-header ns-text-color more" style="margin-right:50px;" onclick="showMore(' + order.order_id + ')">更多';
        tbody += '<div class="more-operation" data-order-id="' + order.order_id + '">';
        tbody += '<span>支付流水号：' + order.out_trade_no + '</span>';
        tbody += '</div></span>';

        tbody += '<span class="order-item-header" style="margin-right:50px;">下单时间：' + ns.time_to_date(order.create_time) + '</span>';
        // tbody += '<span class="order-item-header" style="margin-right:50px;">订单类型：' + order.order_type_name + '</span>';
        if (pay_type_name) tbody += '<span class="order-item-header">支付方式：' + pay_type_name + '</span>';

        tbody += '</td>';
        tbody += '<td>';
        tbody += '<div class="ns-table-btn">';
        if (order.order_type == 1) {
            tbody += '<a class="layui-btn layui-btn-xs" href="javascript:printDeliverOrder(' + order.order_id + ');" >打印发货单</a>';
            // tbody += '<a href="'+ ns.url('shop/order/printOrder',{order_id:order.order_id}) +'" target="_blank" class="layui-btn layui-btn-xs">打印发货单</a>';
        }
        if (order.order_status == -1) {
            tbody += '<a class="layui-btn layui-btn-xs" href="javascript:orderDelete(' + order.order_id + ');" >删除</a>';
        }
        tbody += '<a class="layui-btn layui-btn-xs" href="' + ns.url("shop/order/detail", {order_id: order.order_id}) + '" target="_blank">查看详情</a>';
        if (order.order_status == 0) {
            tbody += '<a class="layui-btn layui-btn-xs" href="javascript:offlinePay(' + order.order_id + ');">线下支付</a> ';
        }


        tbody += '</div>';
        tbody += '</td>';
        tbody += '</tr>';

        // tbody += '<tr class="separation-row"><td colspan="6"><hr /></td></tr>';

        var orderitemHtml = '';
        loadImgMagnify();
        for (var j = 0; j < orderitemList.length; j++) {
            var orderitem = orderitemList[j];
            orderitemHtml += '<tr class="content-row">';
            for (var k = 0; k < this.cols.length; k++) {
                if (j == 0 && this.cols[k].merge && this.cols[k].template) {

                    orderitemHtml += '<td class="' + (this.cols[k].className || "") + '" align="' + (this.cols[k].align || "") + '" style="' + (this.cols[k].style || "") + '" rowspan="' + orderitemList.length + '">';
                    orderitemHtml += this.cols[k].template(orderitem, order);
                    orderitemHtml += '</td>';

                } else if (this.cols[k].template && !this.cols[k].merge) {

                    orderitemHtml += '<td class="' + (this.cols[k].className || "") + '" align="' + (this.cols[k].align || "") + '" style="' + (this.cols[k].style || "") + '">';
                    orderitemHtml += this.cols[k].template(orderitem, order);
                    orderitemHtml += '</td>';

                }
            }
            orderitemHtml += '</tr>';
        }

        tbody += orderitemHtml;

    }

    tbody += '</tbody>';
    return tbody;
};

/**
 * 渲染表格
 */
Delivery.prototype.fetch = function () {
    if (this.data.list.length > 0) {
        return '<table class="layui-table layui-form">' + this.header(true) + '</table><table class="layui-table order-list-table layui-form">' + this.header(false) + this.tbody() + '</table>';
    } else {
        return '<table class="layui-table order-list-table layui-form">' + this.header(true) + '</table>' + '<div class="order-no-data-block"><ul><li><i class="layui-icon layui-icon-tabs"></i> </li><li>暂无订单</li></ul></div>';
    }
};

function showMore(order_id) {
    $(".more-operation[data-order-id]").hide();
    $(".more-operation[data-order-id='" + order_id + "']").show();
    $("body").click(function (e) {
        if (!$(e.target).closest(".order-item-header.more").length) {
            $(".more-operation[data-order-id='" + order_id + "']").hide();
        }
    });
}
