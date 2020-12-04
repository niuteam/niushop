var form;
//权限列表目标标记
var tree_target = [];
var total_level = 5;//权限总级别

//背景颜色配置
var bg_arr = ['#FFF', '#FFF', '#FFF', '#FFF'];
layui.use(['form'], function () {
    form = layui.form;
	form.render();

    form.on('checkbox(group_form)', function(data){
        var checked = $(this).prop('checked');
        var target = $(this).attr('data-target');
        target = target.split(',');

        var curr_data = find_data_by_target(tree_data, target);
        curr_data['checked'] = checked;

        down_alter(curr_data['child_list'], checked);
        up_alter(tree_data, target);

        $("#tree_box").html(createTable(tree_data));
        form.render();

    });

    $("#tree_box").html(createTable(tree_data));
    form.render();
});


function createTable(data){
    var html = "<table  class='layui-table'>";
    var compile_tree_result = compile_tree(data, 0, '');
    html += '<tr>'+compile_tree_result.first_html+'</tr>';
    html += compile_tree_result.last_html;
    html += "</table>";
    return html;
}
//编译树
function compile_tree(data, level, html) {

    var child_num_arr = [];
    var rowspan_num = 0;
    var total_child_num = 0;
    var total_num = 0;
    var html_obj = [];

    var first_html = "";
    var last_html = "";
    $.each(data,function(i,data_item){
        var child_num = data_item['child_num'];
        child_num_arr.push(child_num);
        total_num += 1;
        total_child_num += child_num;
        var checked = data_item['checked'];
        html_obj.push({checked:checked,child_num:child_num,data:data_item,name:data_item.name});
    })
    if(total_num > 0){
        if(total_child_num > 0){
            var is_first = true;
            $.each(html_obj,function(i,item){
                var item_obj = item.data;
                var item_html = "";
                var rowspan = 0;
                var name = item['name'];
                tree_target[level] = name;
                tree_target = tree_target.slice(0, level + 1);


                var checked_html = item.checked ? 'checked' : '';
                var input_html = '<input class="group-checkbox" type="checkbox"  ' + checked_html + ' lay-filter="group_form" lay-skin="primary" '+ checked_html +' title="'+item['data']['title']+'" data-target="' + tree_target.toString() + '" value="' + name + '"/>';


                var child_num = item.child_num;
                var colspan_html = "";

                var child_first_html = "";
                var child_last_html = "";
                if (child_num > 0){
                    var item_result = compile_tree(item_obj['child_list'], level + 1, '');
                    var rowspan = item_result.rowspan;
                    var child_first_html = item_result.first_html;
                    var child_last_html = item_result.last_html;
                }

                if(child_first_html == '' ){
                    var colspan_num = total_level - level;
                    colspan_html = " colspan="+colspan_num;
                }

                if(!is_first){
                    item_html += '<tr>';
                }

                if(rowspan > 1){
                    rowspan_num = rowspan_num + rowspan;
                    item_html += '<td rowspan = "'+rowspan+'" '+colspan_html+' >';
                }else{
                    rowspan_num += 1;
                    item_html += '<td '+colspan_html+'>';
                }
                item_html += input_html;
                item_html += '</td>';

                item_html += child_first_html;

                if(!is_first) {
                    item_html += '</tr>';
                }

                item_html += child_last_html;
                if(is_first){
                    first_html += item_html;
                    is_first = false;
                }else{
                    last_html += item_html;
                }

            })

        }else{
            var colspan_num = total_level - level;
            var colspan_html = " colspan="+colspan_num;
            first_html += '<td '+colspan_html+' >';
            rowspan_num = 1;
            $.each(html_obj,function(i,item){
                var name = item['name'];
                tree_target[level] = name;
                tree_target = tree_target.slice(0, level + 1);

                var checked_html = item.checked ? 'checked' : '';
                var input_html = '<input class="group-checkbox" type="checkbox"  ' + checked_html + ' lay-filter="group_form" lay-skin="primary" '+ checked_html +' title="'+item['data']['title']+'" data-target="' + tree_target.toString() + '" value="' + name + '"/>';

                first_html += input_html;
            })
            first_html += '</td>';
        }
    }



    return {rowspan:rowspan_num,first_html:first_html,last_html:last_html};

}

//通过标记找到数据位置
function find_data_by_target(list, target) {
    var data = list;
    for (var per in target) {
        if (per == 0) {
            data = data[target[per]];
        } else {
            data = data['child_list'][target[per]];
        }
    }
    return data;
}

//向上遍历
function up_alter(list, target) {

    target = target.slice(0, target.length - 1);
    if (target.length == 0) return;

    var curr_data = find_data_by_target(tree_data, target);

    var count = 0;
    for (var per in curr_data['child_list']) {
        if (curr_data['child_list'][per]['checked']) {
            count++;
            break;
        }
    }
    if (count == 0) {
        curr_data['checked'] = false;
    } else {
        curr_data['checked'] = true;
    }

    up_alter(list, target);
}

//向下遍历
function down_alter(list, checked) {
    for (var per in list) {
        list[per]['checked'] = checked;
        if (list[per]['child_num'] > 0) down_alter(list[per]['child_list'], checked)
    }
}

//绑定点击事件
$("#tree_box").on('click', '.menu-cell input', function () {
    var checked = $(this).prop('checked');
    var target = $(this).attr('data-target');
    target = target.split(',');

    var curr_data = find_data_by_target(tree_data, target);
    curr_data['checked'] = checked;

    down_alter(curr_data['child_list'], checked);
    up_alter(tree_data, target);

    $("#tree_box").html(createTable(tree_data));
    form.render();
});