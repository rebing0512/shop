<?php defined('TTShop') or exit('Access Invalid!');?>
<div class="page">
    <div class="fixed-bar">
            <div class="item-title"><a class="back" href="index.php?con=mb_recommend" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>绑定标签信息</h3>
                <h5>
                    在此设置在微信端绑定标签
                </h5>
            </div>
        </div>
    </div>
    <div id="flexigrid"></div>
</div>
<script type="text/javascript">
    $(function(){
        $("#flexigrid").flexigrid({
            url: 'index.php?con=mb_recommend&fun=tag_get_xml&type='+'<?=$_GET['type'];?>',
            colModel : [
                {display: '操作', name : 'operation', width :200 , sortable : false, align: 'center', className: ''},
                {display: '名字', name : 'name', width : 200, sortable : false, align : 'center'},
                {display: '排序', name : 'sort', width : 200, sortable : false, align : ''},
                {display: '推荐商品数量', name : 'url', width : 200, sortable : false, align : ''}
            ],
            buttons : [
                {display: '<i class="fa fa-plus"></i>新增绑定标签', name : 'add', bclass : 'add', title : '添加新的标签', onpress : fg_operate }
            ],
            searchitems : [
                {display: '名称', name : 'name'},
            ],
            sortname: "id",
            sortorder: "desc",
            title: '微信端绑定标签'
        });
    });
    function fg_operate(name, grid) {
        if (name == 'add') {
            window.location.href = 'index.php?con=mb_recommend&fun=tag_add&type='+'<?=$_GET['type'];?>';
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
            url: "index.php?con=mb_recommend&fun=tag_del",
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
