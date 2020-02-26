<?php defined('TTShop') or exit('Access Invalid!');?>
<style type="text/css">
   .flexigrid .bDiv td.handle{
    min-width: 200px!important;
    max-width: 200px!important;
   } 
   .flexigrid .hDiv .handle div{
    min-width: 180px!important;
    max-width: 180px!important;
   }
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['nc_ncms_model_manage'];?></h3>
        <h5><?php echo $lang['nc_ncms_model_manage_subhead'];?></h5>
      </div>
      <ul class="tab-base nc-row">
        <?php   foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" class="current"><?php echo $menu['menu_name'];?></a></li>
        <?php }  else { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" <?php if($menu['target']=='_blank') echo 'target="_blank"';?> ><?php echo $menu['menu_name'];?></a></li>
        <?php  } }  ?>
      </ul>
    </div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li><?php echo $lang['nc_ncms_model_list_tip1'];?></li>
      <li><?php echo $lang['nc_ncms_model_list_tip2'];?></li>
    
    </ul>
  </div>
  <div id="flexigrid"></div>


<script>
$(function(){


    $('#btn_verify_submit').on('click', function() {
        $('#verify_form').submit();
    });

    var flexUrl = 'index.php?con=ncms_model&fun=ncms_model_list_xml&state=<?php echo $output['currentState']; ?>';

    $("#flexigrid").flexigrid({
        url: flexUrl,
        colModel: [
            {display: '操作', name: 'operation', width: 200, sortable: false, align: 'center', className: 'handle'},
            {display: '模型id', name: 'modelid', width: 60, sortable: false, align: 'left'},
            {display: '名称', name: 'name', width: 150, sortable: false, align: 'left'},
            {display: '数据表', name: 'tablename', width: 150, sortable: false, align: 'left'},
            {display: '描述', name: 'description', width: 300, sortable: false, align: 'left'},
            {display: '文章数', name: 'items', width: 150, sortable: false, align: 'left'},
            {display: '创建时间', name: 'addtime', width: 150, sortable: false, align: 'left'},
            {display: '状态', name: 'disabled', width: 60, sortable: false, align: 'left'},
        
        ],
        buttons: [
           
               {display: '<i class="fa fa-plus"></i>新增模型', name : 'add', bclass : 'add', title : '新增分类', onpress : fg_operation },
               {display: '<i class="fa  fa-file-text-o"></i>导入模型', name : 'import', bclass : 'import', title : '导入模型', onpress : fg_operation }, 
        ],
      
  
        title: '模型列表'
    });

    // 高级搜索提交
    $('#ncsubmit').click(function(){
        $("#flexigrid").flexOptions({url: flexUrl + '&' + $("#formSearch").serialize(),query:'',qtype:''}).flexReload();
    });

    // 高级搜索重置
    $('#ncreset').click(function(){
        $("#flexigrid").flexOptions({url: flexUrl}).flexReload();
        $("#formSearch")[0].reset();
    });

});

$("a[data-j='drop']").live('click', function() {
    if (!confirm('确定删除?')) {
        return false;
    }
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_model&fun=ncms_model_drop&modelid='+id;
});
$("a[data-j='export']").live('click', function() {
    if (!confirm('确定要导出?')) {
        return false;
    }
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_model&fun=ncms_model_export&modelid='+id;
});
$("a[data-j='edit']").live('click', function() {
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_model&fun=ncms_model_edit&modelid='+id;
});

$("a[data-j='field_manage']").live('click', function() {
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_model_field&modelid='+id;
});


$("a[data-j='disabled']").live('click', function() {
    var column = $(this).attr('data-j');
    var value = $(this).attr('data-val');
    var id = $(this).parents('tr[data-id]').attr('data-id');
    $.get('index.php?con=ncms_model&fun=ajax', {
        column: column,
        id: id,
        value: value
    }, function(d) {
        if (d == 'true') {
            $("#flexigrid").flexReload();
        } else {
            alert('操作失败！');
        }
    });
});


function fg_operation(name, bDiv) {
    if (name == 'add') {
        window.location.href = 'index.php?con=ncms_model&fun=ncms_model_add';
    }
    if (name == 'import'){
      window.location.href = 'index.php?con=ncms_model&fun=ncms_model_import';
    }

}
</script>
