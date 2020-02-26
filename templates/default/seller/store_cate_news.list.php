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
<a href="index.php?con=store_news&fun=news_cate_save" class="ncbtn ncbtn-mint" title="添加分类"> 添加分类</a>
<table class="ncsc-default-table">
  <thead>
    <tr>
      <th class="w30"></th>
      <th>分类名称</th>
      
      <th class="w70">所属类型</th>
      <th class="w150">是否显示</th>
      <th class="w120">排序</th>
      <th class="w70">操作</th>
    </tr>
   
  </thead>
  <tbody>
    <?php if (!empty($output['msg_list'])) { ?>
    <?php foreach($output['msg_list'] as $val) { ?>
    <tr class="bd-line">
      <td class="tc"><input class="checkitem" type="checkbox" value="<?php echo $val['sm_id'];?>" /></td>
      <td class="tl <?php if (empty($val['sm_readids']) || !in_array($_SESSION['seller_id'], $val['sm_readids'])) {?>fb dark<?php }?>"><?php echo $val['sm_content']?></td>
      <td><?php echo date('Y-m-d H:i:s', $val['sm_addtime']);?></td>
      <td class="nscs-table-handle"><span><a href="javascript:void(0);" class="btn-bluejeans" dialog_id="store_msg_info" dialog_title="系统消息" dialog_width="480" nc_type="dialog" uri="<?php echo urlShop('store_msg', 'msg_info', array('sm_id' => $val['sm_id']));?>"><i class="icon-eye-open"></i>
        <p>查看</p>
        </a></span></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <?php if (!empty($output['msg_list'])) { ?>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
    <?php } ?>
  </tfoot>
</table>
<script>
$(function(){
    $('a[nc_type="dialog"]').click(function(){
        $(this).parents('tr:first').children('.tl').removeClass('fb dark');
    });
});
</script>