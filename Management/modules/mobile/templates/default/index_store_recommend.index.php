<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>微信端店铺推荐</h3>
                <h5>
                    在此设置在微信端推荐店铺
                </h5>
            </div>
        </div>
    </div>
    <div id="flexigrid"></div>
</div>
<script type="text/javascript">
    $(function(){
        $("#flexigrid").flexigrid({
            url: 'index.php?con=index_store_recommend&fun=get_xml',
            colModel : [
                {display: '操作', name : 'operation', width :200 , sortable : false, align: 'left', className: ''},
                {display: '系统id', name : 'id', width : 50, sortable : true, align: 'left'},
                {display: '排序', name : 'sort', width : 90, sortable : true, align : 'left'},
                {display: '关联店铺名称', name : 'store_name', width : 400, sortable : false, align : 'left'}
            ],
            buttons : [
                {display: '<i class="fa fa-plus"></i>新增推荐', name : 'add', bclass : 'add', title : '添加新的首页推荐', onpress : fg_operate }
            ],
            searchitems : [
                {display: 'ID', name : 'id'},
            ],
            sortname: "id",
            sortorder: "desc",
            title: '微信端店铺推荐'
        });
    });
    function fg_operate(name, grid) {
        if (name == 'add') {
            window.location.href = 'index.php?con=index_store_recommend&fun=add';
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
            url: "index.php?con=index_store_recommend&fun=delete",
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
