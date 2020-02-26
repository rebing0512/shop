<?php defined('TTShop') or exit('Access Invalid!');?>
<?php if($item_edit_flag) { ?>
<table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"> <div class="title nomargin">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span> </div>
        </th>
      </tr>
      <tr>
        <td><ul>
            <li>点击添加新的块内容按钮可以添加新的内容</li>
            <li>鼠标移动到已有的内容上点击出现的删除按钮可以对其进行删除</li>
            <li>操作完成后点击保存编辑按钮进行保存</li>
      <li>最佳宽度为128，分类图标最佳为128*100</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
<div class="index_block home9">
      <?php if($item_edit_flag) { ?>
  <h3>五图模版-极有客</h3>
  <?php } ?>
  <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>标题：</h5>
    <input id="home1_title" type="text" class="txt w200" name="item_data[title]" value="<?php echo $item_data['title'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title'];?></span>
    <?php } ?>
  </div>
  <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>导航颜色：</h5>
    <input id="home1_color" type="text" class="txt w150" name="item_data[color]" value="<?php echo $item_data['color'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title'];?></span>
    <?php } ?>
  </div>
  <div nctype="item_content" class="content">
      <?php if($item_edit_flag) { ?>
    <h5>内容：</h5>
    <?php } ?>
    <?php if(!empty($item_data['item']) && is_array($item_data['item'])) {?>
    <?php foreach($item_data['item'] as $item_key => $item_value) {?>
    <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_value['image']);?>" alt="">
      <?php if($item_edit_flag) { ?>
      <input nctype="image_name" name="item_data[item][<?php echo $item_key;?>][image]" type="hidden" value="<?php echo $item_value['image'];?>">
      <input nctype="image_type" name="item_data[item][<?php echo $item_key;?>][type]" type="hidden" value="<?php echo $item_value['type'];?>">
      <input nctype="image_data" name="item_data[item][<?php echo $item_key;?>][data]" type="hidden" value="<?php echo $item_value['data'];?>">
      <a nctype="btn_del_item_image" href="javascript:;"><i class="icon-trash"></i>删除</a>
      <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
  <?php if($item_edit_flag) { ?>
  <a nctype="btn_add_item_image" class="btn-add" data-desc="213*85" href="javascript:;">添加新的块内容</a>
  <?php } ?>
</div>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/colorpicker/evol.colorpicker.css" rel="stylesheet" type="text/css">
<script src="<?php echo RESOURCE_SITE_URL;?>/js/colorpicker/evol.colorpicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#home1_color").colorpicker();
    });
</script>
