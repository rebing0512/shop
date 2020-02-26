<?php defined('TTShop') or exit('Access Invalid!');?>
<style type="text/css">

.flexigrid .hDiv .handle div, .flexigrid .bDiv .handle div{
    max-width: 300px !important;
    min-width: 150px !important;
}


</style>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>文章分类管理</h3>
        <h5>文章分类管理</h5>
      </div>
      
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span>
    </div>
    <ul>
      <li>1、请在添加、修改栏目全部完成后，更新栏目缓存，否则可能出现未知错误！</li>
      <li>2、栏目ID为蓝色才可以添加内容。可以使用“终极属性转换”进行转换！</li>
    </ul>
  </div>
  <form method='post'>
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="submit_type" id="submit_type" value="" />
    <table class="flex-table">
      <thead>
        <tr>
     
          <th width="300" class="handle">管理操作</th>
          <th width="60" align="center">栏目id</th>
          <th width="160" align="left">栏目排序</th>
          <th width="350" align="left">栏目名称</th>

          <th width="80" align="center">所属模型</th>
          <th width="80" align="center">访问</th>
        
          <th></th>
        </tr>
      </thead>
      <tbody>
     
        <?php if(!empty($output['categorydata'])){ ?>
      
        <?php echo $output['categorydata'];?>
    
        <?php }else { ?>
        <tr>
          <td class="no-data" colspan="100"><i class="fa fa-exclamation-circle"></i><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo ADMIN_RESOURCE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
    $('.flex-table').flexigrid({
        height:'500',// 高度自动
        usepager: false,// 不翻页
        striped:false,// 不使用斑马线
        resizable: false,// 不调节大小
        reload: false,// 不使用刷新
        columnControl: false,// 不使用列控制
        buttons : [
                   {display: '<i class="fa fa-plus"></i>添加栏目', name : 'add', bclass : 'add', onpress : fg_operation }
                   
               ]
    });

    $('span[nc_type="inline_edit"]').inline_edit({act: 'ncms_category',op: 'ajax'});
});
$("a[data-j='drop']").live('click', function() {
    if (!confirm('确定删除?')) {
        return false;
    }
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_category&fun=ncms_category_drop&catid='+id;
});
$("a[data-j='add']").live('click', function() {
 
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_category&fun=ncms_category_add&parentid='+id;
});
$("a[data-j='edit']").live('click', function() {
    var id = $(this).parents('tr[data-id]').attr('data-id');
    window.location.href = 'index.php?con=ncms_category&fun=ncms_category_edit&catid='+id;
});

function fg_operation(name, bDiv) {
    if (name == 'add') {
        window.location.href = 'index.php?con=ncms_category&fun=ncms_category_add';
    }
}

</script>