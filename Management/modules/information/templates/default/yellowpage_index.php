<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>黄页信息</h3>
                <h5>
                    在此设置在微信端各类黄页
                </h5>
            </div>
            <?=$output['link']?>
        </div>
    </div>
    <div id="flexigrid"></div>
</div>
<script type="text/javascript">
    $(function(){
        $("#flexigrid").flexigrid({
            url: 'index.php?con=mb_yellowpage&fun=get_xml&type='+'<?=$_GET['type'];?>'+'&sb_type='+'<?=$_GET['sb_type']?:'pt'?>',
            colModel : [
                {display: '操作', name : 'operation', width :150 , sortable : false, align: 'left', className: ''},
                {display: '名字', name : 'name', width : 200, sortable : false, align : 'center'},
                {display: '核心分类', name : 'h_type', width : 200, sortable : false, align : 'center'},
                {display: '排序', name : 'sort', width : 200, sortable : false, align : ''},
                {display: '跳转链接', name : 'url', width : 200, sortable : false, align : ''}
            ],
            buttons : [
                {display: '<i class="fa fa-plus"></i>新增黄页信息', name : 'add', bclass : 'add', title : '添加新的商品推荐', onpress : fg_operate }
            ],
            searchitems : [
                {display: '名称', name : 'name'},
                {display: '核心分类', name : 'h_type'}
            ],
            sortname: "id",
            sortorder: "desc",
            title: '微信端黄页设置'
        });
    });
    function fg_operate(name, grid) {
        if (name == 'add') {
            window.location.href = 'index.php?con=mb_yellowpage&fun=add&type='+'<?=$_GET['type'];?>'+'&sb_type='+'<?=$_GET['sb_type']?:'pt'?>';
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
            url: "index.php?con=mb_yellowpage&fun=delete",
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
