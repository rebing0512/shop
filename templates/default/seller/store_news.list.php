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
<a href="index.php?con=store_news&fun=news_add" class="ncbtn ncbtn-mint" title="发布新商品"> 发布新闻</a>
<table class="ncsc-default-table">
  <thead>
    <tr>
      <th class="w30"></th>
      <th class="w220">标题</th>
      <th class="w120">所属分类</th>
      <th class="w70">点击次数</th>
      <th class="w150">添加时间</th>
      <th class="w150">操作</th>
    </tr>
    <tr>
      <td class="tc"><input id="all" class="checkall" type="checkbox" /></td>
      <td colspan="20"><label for="all">全选</label>
        <?php if ($_SESSION['seller_is_admin']) {?>
        <a href="javascript:void(0);" nc_type="batchbutton" uri="<?php echo urlShop('store_news', 'news_drop')?>" name="id" class="ncbtn-mini"><i class="icon-trash"></i>删除</a>
        <?php }?>
      </td>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($output['news_list'])) { ?>
    <?php foreach($output['news_list'] as $val) { ?>
    <tr class="bd-line">
      <td class="tc"><input class="checkitem" type="checkbox" value="<?php echo $val['id'];?>" /></td>
      <td class="tl"><?php echo $val['s_title']?></td>
      <td class="tc"><?php echo $val['cate_name']?></td>
      <td class="tc"><?php echo $val['s_click']?></td>
      <td><?php echo date('Y-m-d H:i:s', $val['s_time']);?></td>
      <td class="nscs-table-handle">
      <span>
        <a href="javascript:void(0);" class="btn-bluejeans" dialog_id="store_msg_info" dialog_title="系统消息" dialog_width="480" nc_type="dialog" uri="<?php echo urlShop('store_msg', 'msg_info', array('sm_id' => $val['sm_id']));?>"><i class="icon-eye-open"></i>
        <p>查看</p>
        </a>
      </span>
      <span>
        <a href="<?php echo urlShop('store_news', 'news_edit', array('id' => $val['id']));?>" class="btn-bluejeans"><i class="icon-edit"></i>
        <p><?php echo $lang['nc_edit'];?></p>
        </a>
      </span> 
      <span>
        <a href="javascript:void(0);" onclick="ajax_get_confirm('<?php echo $lang['nc_ensure_del'];?>', '<?php echo urlShop('store_news', 'news_drop', array('id' => $val['id']));?>');" class="btn-grapefruit"><i class="icon-trash"></i>
        <p><?php echo $lang['nc_del'];?></p>
        </a>
      </span> 
      </td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <?php if (!empty($output['news_list'])) { ?>
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
       $('a[nctype="batch"]').click(function(){
        if($('.checkitem:checked').length == 0){    //没有选择
          showDialog('请选择需要操作的记录');
            return false;
        }
        var _items = '';
        $('.checkitem:checked').each(function(){
            _items += $(this).val() + ',';
        });
        _items = _items.substr(0, (_items.length - 1));

        var data_str = '';
        eval('data_str = ' + $(this).attr('data-param'));

        if (data_str.sign == 'jingle') {
            ajax_form('ajax_jingle', '批量删除', data_str.url + '&id=' + _items + '&inajax=1', '480');
        }
    });
});
</script>