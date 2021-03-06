<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['brand_index_brand'];?></h3>
        <h5><?php echo $lang['brand_index_brand_subhead'];?></h5>
      </div>
      <ul class="tab-base nc-row">
        <li><a href="JavaScript:void(0);" class="current"><?php echo $lang['nc_manage'];?></a></li>
        <li><a href="index.php?con=brand&fun=brand_apply"><?php echo $lang['brand_index_to_audit'];?></a></li>
      </ul>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li><?php echo $lang['brand_index_help1'];?></li>
      <li><?php echo $lang['brand_index_help2'];?></li>
      <li><?php echo $lang['brand_index_help3'];?></li>
    </ul>
  </div>
  <div id="flexigrid"></div>
</div>
<script type="text/javascript">
$(function(){
    $("#flexigrid").flexigrid({
        url: 'index.php?con=brand&fun=get_xml',
        colModel : [
            {display: '操作', name : 'operation', width : 150, sortable : false, align: 'center', className: 'handle'},
            {display: '品牌ID', name : 'brand_id', width : 40, sortable : true, align: 'center'},
            {display: '品牌名称', name : 'brand_name', width : 150, sortable : false, align: 'left'},
            {display: '首字母', name : 'brand_initial', width : 120, sortable : true, align: 'center'},
            {display: '品牌图片', name : 'brand_pic', width : 120, sortable : false, align: 'left'},
            {display: '品牌排序', name : 'brand_sort', width: 60, sortable : true, align : 'center'},
            {display: '品牌推荐', name : 'brand_recommend', width: 60, sortable : true, align : 'center'},
            {display: '展示形式', name : 'show_type', width : 80, sortable : true, align: 'center'}
            ],
        buttons : [
			{display: '<i class="fa fa-plus"></i>新增数据', name : 'add', bclass : 'add', title : '添加一条新数据到列表', onpress : fg_operation },
            {display: '<i class="fa fa-file-excel-o"></i>导出数据', name : 'csv', bclass : 'csv', title : '将选定行数据导出CVS文件', onpress : fg_operation },
            {display: '<i class="fa fa-trash"></i>批量删除', name : 'del', bclass : 'del', title : '将选定行数据批量删除', onpress : fg_operate }						
        ],
        searchitems : [
            {display: '品牌ID', name : 'brand_id', isdefault: true},
            {display: '品牌名称', name : 'brand_name'},
            {display: '首字母', name : 'brand_initial'}
            ],
        sortname: "brand_id",
        sortorder: "desc",
        title: '品牌列表'
    });
});
function fg_operate(name, bDiv) {
    if (name == 'del') {
        if($('.trSelected',bDiv).length>0){
            var itemlist = new Array();
      $('.trSelected',bDiv).each(function(){
        itemlist.push($(this).attr('data-id'));
      });
            fg_delete(itemlist);
        } else {
            return false;
        }
    }
}
function fg_operation(name, bDiv) {
    if (name == 'add') {
        window.location.href = 'index.php?con=brand&fun=brand_add';
    }
    if (name == 'csv') {
        if ($('.trSelected', bDiv).length == 0) {
            if (!confirm('您确定要下载全部数据吗？')) {
                return false;
            }
        }
        var itemids = new Array();
        $('.trSelected', bDiv).each(function(i){
            itemids[i] = $(this).attr('data-id');
        });
        fg_csv(itemids);
    }
}

function fg_csv(ids) {
    id = ids.join(',');
    window.location.href = $("#flexigrid").flexSimpleSearchQueryString()+'&fun=export_csv&id=' + id;
}

//删除
// function fg_del(id) {
//     if(!confirm('删除后将不能恢复，确认删除这项吗？')){
//         return false;
//     }
//     $.getJSON('index.php?con=brand&fun=brand_del', {id:id}, function(data){
//         if (data.state) {
//             $("#flexigrid").flexReload();
//         } else {
//             showError(data.msg)
//         }
//     });
// }
function fg_delete(id) {
    if (typeof id == 'number') {
        var id = new Array(id.toString());
    };
    if(confirm('删除后将不能恢复，确认删除这 ' + id.length + ' 项吗？')){
        id = id.join(',');
    } else {
        return false;
    }
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "index.php?con=brand&fun=brand_del",
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
