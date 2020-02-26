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
            <li>鼠标移动到内容上出现编辑按钮可以对内容进行修改</li>
            <li>操作完成后点击保存编辑按钮进行保存</li>
      <li>最佳尺寸为640*130 .透明效果请上传透明的PNG图片。</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
<div class="index_block home14">
      <?php if($item_edit_flag) { ?>
  <h3>首页底部漂浮可关闭广告 - 极有客</h3>
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
    <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image']);?>" alt="">
      <?php if($item_edit_flag) { ?>
      <input nctype="image_name" name="item_data[image]" type="hidden" value="<?php echo $item_data['image'];?>">
      <input nctype="image_type" name="item_data[type]" type="hidden" value="<?php echo $item_data['type'];?>">
      <input nctype="image_data" name="item_data[data]" type="hidden" value="<?php echo $item_data['data'];?>">
      <a nctype="btn_edit_item_image" data-desc="640*260" href="javascript:;"><i class="icon-edit"></i>编辑</a>
      <?php } ?>
    </div>
  </div>
</div>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/colorpicker/evol.colorpicker.css" rel="stylesheet" type="text/css">
<script src="<?php echo RESOURCE_SITE_URL;?>/js/colorpicker/evol.colorpicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#home1_color").colorpicker();
    });
</script>