<?php defined('TTShop') or exit('Access Invalid!');?>
<?php if($item_edit_flag) { ?>

<div class="explanation" id="explanation">
  <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
    <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
  </div>
  <ul>
    <li>鼠标移动到内容上出现编辑按钮可以对内容进行修改</li>
    <li>操作完成后点击保存编辑按钮进行保存</li>
  </ul>
</div>
<?php } ?>
<div class="index_block home6">
  <?php if($item_edit_flag) { ?>
  <h3>模型版块布局H</h3>
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
   <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>更多链接：</h5>
    <input id="home1_url" type="text" class="txt w150" name="item_data[more_url]" value="<?php echo $item_data['more_url'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title'];?></span>
    <?php } ?>
  </div>
  <div class="content">
    <?php if($item_edit_flag) { ?>
    <h5>内容：</h5>
    <?php } ?>

    
      <div class="home6_1">
      <div class="home6_1_1">
        <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['rectangle1_image']);?>" alt="">
          <?php if($item_edit_flag) { ?>
          <input nctype="image_name" name="item_data[rectangle1_image]" type="hidden" value="<?php echo $item_data['rectangle1_image'];?>">
          <input nctype="image_type" name="item_data[rectangle1_type]" type="hidden" value="<?php echo $item_data['rectangle1_type'];?>">
          <input nctype="image_data" name="item_data[rectangle1_data]" type="hidden" value="<?php echo $item_data['rectangle1_data'];?>">
          <a nctype="btn_edit_item_image" data-desc="428*160" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
          <?php } ?>
        </div>
      </div>
        <div class="home6_1_2">
          <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['rectangle2_image']);?>" alt="">
            <?php if($item_edit_flag) { ?>
            <input nctype="image_name" name="item_data[rectangle2_image]" type="hidden" value="<?php echo $item_data['rectangle2_image'];?>">
            <input nctype="image_type" name="item_data[rectangle2_type]" type="hidden" value="<?php echo $item_data['rectangle2_type'];?>">
            <input nctype="image_data" name="item_data[rectangle2_data]" type="hidden" value="<?php echo $item_data['rectangle2_data'];?>">
            <a nctype="btn_edit_item_image" data-desc="214*160" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
            <?php } ?>
          </div>
        </div>
        <div class="home6_1_2">
          <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['rectangle3_image']);?>" alt="">
            <?php if($item_edit_flag) { ?>
            <input nctype="image_name" name="item_data[rectangle3_image]" type="hidden" value="<?php echo $item_data['rectangle3_image'];?>">
            <input nctype="image_type" name="item_data[rectangle3_type]" type="hidden" value="<?php echo $item_data['rectangle3_type'];?>">
            <input nctype="image_data" name="item_data[rectangle3_data]" type="hidden" value="<?php echo $item_data['rectangle3_data'];?>">
            <a nctype="btn_edit_item_image" data-desc="214*160" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
            <?php } ?>
          </div>
        </div>
        <div class="home6_1_2">
          <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['rectangle4_image']);?>" alt="">
            <?php if($item_edit_flag) { ?>
            <input nctype="image_name" name="item_data[rectangle4_image]" type="hidden" value="<?php echo $item_data['rectangle4_image'];?>">
            <input nctype="image_type" name="item_data[rectangle4_type]" type="hidden" value="<?php echo $item_data['rectangle4_type'];?>">
            <input nctype="image_data" name="item_data[rectangle4_data]" type="hidden" value="<?php echo $item_data['rectangle4_data'];?>">
            <a nctype="btn_edit_item_image" data-desc="214*160" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
            <?php } ?>
          </div>
        </div>
        <div class="home6_1_2">
          <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['rectangle5_image']);?>" alt="">
            <?php if($item_edit_flag) { ?>
            <input nctype="image_name" name="item_data[rectangle5_image]" type="hidden" value="<?php echo $item_data['rectangle5_image'];?>">
            <input nctype="image_type" name="item_data[rectangle5_type]" type="hidden" value="<?php echo $item_data['rectangle5_type'];?>">
            <input nctype="image_data" name="item_data[rectangle5_data]" type="hidden" value="<?php echo $item_data['rectangle5_data'];?>">
            <a nctype="btn_edit_item_image" data-desc="214*160" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
            <?php } ?>
          </div>
        </div>
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