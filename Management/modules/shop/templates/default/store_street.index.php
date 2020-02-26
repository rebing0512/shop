<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>店铺街维护</h3>
            </div>
        </div>
    </div>
    <div id="flexigrid"></div>
</div>
<script type="text/javascript">
    $(function(){
        $("#flexigrid").flexigrid({
            url: 'index.php?con=store_street&fun=get_xml',
            colModel : [
                {display: '操作', name : 'operation', width :200 , sortable : false, align: 'left', className: ''},
                {display: 'id', name : 'id', width : 50, sortable : true, align: 'left'},
                {display: '名称', name : 'name', width : 90, sortable : false, align : 'left'},
                {display: '分类', name : 'class', width : 100, sortable : false, align : 'left'},
                {display: '排序', name : 'sort', width : 90, sortable : true, align : 'left'},
                {display: '显示图片', name : 'goods_name', width : 300, sortable : false, align : 'left'}
            ],
            buttons : [
                {display: '<i class="fa fa-plus"></i>新增数据', name : 'add', bclass : 'add', title : '新增数据', onpress : fg_operate }
            ],
            searchitems : [
                {display: 'ID', name : 'id'},
                {display: '名称', name : 'name'}
            ],
            sortname: "id",
            sortorder: "desc",
            title: '店铺街列表'
        });
    });
    function fg_operate(name, grid) {
        if (name == 'add') {
            window.location.href = 'index.php?con=store_street&fun=add';
        }else if (name == 'delete') {
            if($('.trSelected',grid).length>0){
                var itemlist = new Array();
                $('.trSelected',grid).each(function(){
                    itemlist.push($(this).attr('data-id'));
                });
                fg_delete(itemlist);
            } else {
                return false;
            }
        }
    }
    function fg_delete(id) {
        if (typeof id == 'number') {
            var id = new Array(id.toString());
        }
        if(confirm('删除后将不能恢复，确认删除这 ' + id.length + ' 项吗？')){
            id = id.join(',');
        } else {
            return false;
        }
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "index.php?con=store_street&fun=delete",
            data: "del_id="+id,
            success: function(data){
                if (data.state){
                    $("#flexigrid").flexReload();
                } else {
                    alert(data.msg);
                }
            }
        });
    }
</script>
