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
        <h3><?php echo $lang['nc_ncms_model_field_manage'];?></h3>
        <h5><?php echo $lang['nc_ncms_model_field_manage_subhead'];?></h5>
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
      <li><?php echo $lang['nc_ncms_model_list_tip3'];?></li>
    </ul>
  </div>
  <div id="flexigrid"></div>



<script>
$(function(){

   
    $('#btn_verify_submit').on('click', function() {
        $('#verify_form').submit();
    });

    var flexUrl = 'index.php?con=ncms_model_field&fun=ncms_model_field_list_xml';

    $("#flexigrid").flexigrid({
        url: flexUrl,
        colModel: [
            {display: '操作', name: 'operation', width: 400, sortable: false, align: 'left', className: 'handle'},
            {display: '字段名', name: 'field', width: 150, sortable: false, align: 'center'},
            {display: '别名', name: 'name', width: 150, sortable: false, align: 'left'},
            {display: '字段类型', name: 'formtype', width: 150, sortable: false, align: 'left'},
            {display: '排序', name: 'listorder', width: 150, sortable: false, align: 'left',className:'sort'},
            {display: '主表', name: 'issystem', width: 100, sortable: false, align: 'left'},
            {display: '必填', name: 'minlength', width: 100, sortable: false, align: 'left'},
       
            {display: '排序', name: 'isorder', width: 100, sortable: false, align: 'left'},
            {display: '投稿', name: 'isadd', width: 100, sortable: false, align: 'left'},
          
        ],
        buttons: [
           
               {display: '<i class="fa fa-plus"></i>添加字段', name : 'add', bclass : 'add', title : '添加字段', onpress : fg_operation },
               {display: '<i class="fa  fa-desktop"></i>预览模型', name : 'preview', bclass : 'preview', title : '预览模型', onpress : fg_operation }, 
        ],
        qtype:'modelid',
        query:<?php echo $output['modelid']; ?>,
        title: '模型字段列表'
    });

  $('body').on('click','span[nc_type="inline_edit"]',function(){

         var span = $(this);
           var old_value = $(this).html();
           var fieldid = $(this).attr("fieldid");
      
           $('<input type="text">')
           .insertAfter($(this))
           .focus()
           .select()
           .val(old_value)
           .blur(function(){
               var new_value = $(this).attr("value");
               if(new_value != '') {
                   $.get('index.php?con=ncms_model_field&fun=ajax',{id:fieldid,column:'listorder',value:new_value},function(data){
                       data = $.parseJSON(data);
                       if(data) {
                           span.show().text(new_value);
                           $("#flexigrid").flexReload();
                       } else {
                           span.show().text(old_value);
                           alert(data.message);
                       }
                   });
               } else {
                   span.show().text(old_value);
               }
               $(this).remove();
           })
           $(this).hide();
     })

});

$("a[data-j='drop']").live('click', function() {
    if (!confirm('确定删除?')) {
        return false;
    }
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_model_field&fun=ncms_model_field_drop&field='+id;
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
    location.href = 'index.php?con=ncms_model_field&fun=ncms_model_field_edit&fieldid='+id+'&modelid='+<?php echo $output['modelid']; ?>;
});

$("a[data-j='audit']").live('click', function() {
    var id = $(this).parents('tr[data-id]').attr('data-id');
    $('#verify_article_id').val(id);
    $('#dialog_verify').nc_show_dialog({title:'审核'});
});


$("a[data-j='disabled']").live('click', function() {

    var column = $(this).attr('data-j');
    var value = $(this).attr('data-val');
    var id = $(this).parents('tr[data-id]').attr('data-id');
    $.get('index.php?con=ncms_model_field&fun=ajax', {
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
        window.location.href = 'index.php?con=ncms_model_field&fun=ncms_model_field_add&modelid='+<?php echo $output['modelid']; ?>;
    }
    if (name == 'preview'){
      window.location.href = 'index.php?con=ncms_model_field&fun=ncms_model_field_preview&modelid='+<?php echo $output['modelid']; ?>;
    }

}
</script>
