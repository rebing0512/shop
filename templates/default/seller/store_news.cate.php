<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block mt10"> <strong>说明：</strong>
  <ul class="mt5">
    <li>1、管理员可以看见全部消息。</li>
    <li>2、只有管理员可以删除消息，删除后其他账户的该条消息也将被删除。</li>
  </ul>
</div>
<a href="index.php?con=store_news&fun=news_cateadd" class="ncbtn ncbtn-mint" title="发布新商品"> 添加分类</a>
<table class="ncsc-default-table">
  <thead>
    <tr>
      
      <th class="w150">分类名称</th>
      <th class="w150">跳转地址</th>
      <th class="w150">排序</th>
      <th class="w150">是否显示</th>
      <th class="w150">操作</th>
    </tr>

  </thead>
  <tbody>
    <?php if (!empty($output['news_cate'])) { ?>
    <?php foreach($output['news_cate'] as $val) { ?>
    <tr class="bd-line">
      <td><?php echo $val['cate_name'];?></td>
      <td><?php echo $val['cate_jump'];?></td>
      
      <td><?php echo $val['cate_sort'];?></td>
      <td><?php  if($val['cate_display'] == 1){?>是<?php }else{?> 否<?php }?>
      </td>
      <td class="nscs-table-handle">
       <span><a href="<?php echo urlShop('store_news', 'news_cateedit', array('id' => $val['id']));?>" class="btn-bluejeans"><i class="icon-edit"></i>
        <p><?php echo $lang['nc_edit'];?></p>
        </a></span> 
        <span><a href="javascript:void(0);" onclick="ajax_get_confirm('<?php echo $lang['nc_ensure_del'];?>', '<?php echo urlShop('store_news', 'news_catedrop', array('id' => $val['id']));?>');" class="btn-grapefruit"><i class="icon-trash"></i>
        <p><?php echo $lang['nc_del'];?></p>
        </a></span> 
      </td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php } ?>
  </tbody>

</table>
<script>
$(function(){
    $('a[nc_type="dialog"]').click(function(){
        $(this).parents('tr:first').children('.tl').removeClass('fb dark');
    });
});
</script>