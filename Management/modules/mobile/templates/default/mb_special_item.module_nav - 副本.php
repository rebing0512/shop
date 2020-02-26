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
<div class="index_block home2">
  <?php if($item_edit_flag) { ?>
  <h3>导航模型布局</h3>
  <?php } ?>
  
  <div class="content">
    <?php if($item_edit_flag) { ?>
    <h5>内容：</h5>
    <?php } ?>
    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name]" type="hidden" value="<?php echo $item_data['image_name'];?>">
        <input nctype="image_type" name="item_data[image_type]" type="hidden" value="<?php echo $item_data['image_type'];?>">
        <input nctype="image_data" name="item_data[image_data]" type="hidden" value="<?php echo $item_data['image_data'];?>">
        <input nctype="image_title" name="item_data[image_title]" type="hidden" value="<?php echo $item_data['image_title'];?>">
        <input nctype="image_color" name="item_data[image_color]" type="hidden" value="<?php echo $item_data['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name1']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name1]" type="hidden" value="<?php echo $item_data['image_name1'];?>">
        <input nctype="image_type" name="item_data[image_type1]" type="hidden" value="<?php echo $item_data['image_type1'];?>">
        <input nctype="image_data" name="item_data[image_data1]" type="hidden" value="<?php echo $item_data['image_data1'];?>">
        <input nctype="image_title" name="item_data[image_title1]" type="hidden" value="<?php echo $item_data['image_title1'];?>">
        <input nctype="image_color" name="item_data[image_color1]" type="hidden" value="<?php echo $item_data['image_color1'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name2']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name2]" type="hidden" value="<?php echo $item_data['image_name2'];?>">
        <input nctype="image_type" name="item_data[image_type2]" type="hidden" value="<?php echo $item_data['image_type2'];?>">
        <input nctype="image_data" name="item_data[image_data2]" type="hidden" value="<?php echo $item_data['image_data2'];?>">
        <input nctype="image_title" name="item_data[image_title2]" type="hidden" value="<?php echo $item_data['image_title2'];?>">
        <input nctype="image_color" name="item_data[image_color2]" type="hidden" value="<?php echo $item_data['image_color2'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name3']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name3]" type="hidden" value="<?php echo $item_data['image_name3'];?>">
        <input nctype="image_type" name="item_data[image_type3]" type="hidden" value="<?php echo $item_data['image_type3'];?>">
        <input nctype="image_data" name="item_data[image_data3]" type="hidden" value="<?php echo $item_data['image_data3'];?>">
        <input nctype="image_title" name="item_data[image_title3]" type="hidden" value="<?php echo $item_data['image_title3'];?>">
        <input nctype="image_color" name="item_data[image_color3]" type="hidden" value="<?php echo $item_data['image_color3'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name4']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name4]" type="hidden" value="<?php echo $item_data['image_name4'];?>">
        <input nctype="image_type" name="item_data[image_type4]" type="hidden" value="<?php echo $item_data['image_type4'];?>">
        <input nctype="image_data" name="item_data[image_data4]" type="hidden" value="<?php echo $item_data['image_data4'];?>">
        <input nctype="image_title" name="item_data[image_title4]" type="hidden" value="<?php echo $item_data['image_title4'];?>">
        <input nctype="image_color" name="item_data[image_color4]" type="hidden" value="<?php echo $item_data['image_color4'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name5']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name5]" type="hidden" value="<?php echo $item_data['image_name5'];?>">
        <input nctype="image_type" name="item_data[image_type5]" type="hidden" value="<?php echo $item_data['image_type5'];?>">
        <input nctype="image_data" name="item_data[image_data5]" type="hidden" value="<?php echo $item_data['image_data5'];?>">
        <input nctype="image_title" name="item_data[image_title5]" type="hidden" value="<?php echo $item_data['image_title5'];?>">
        <input nctype="image_color" name="item_data[image_color5]" type="hidden" value="<?php echo $item_data['image_color5'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>

    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name6']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name6]" type="hidden" value="<?php echo $item_data['image_name6'];?>">
        <input nctype="image_type" name="item_data[image_type6]" type="hidden" value="<?php echo $item_data['image_type6'];?>">
        <input nctype="image_data" name="item_data[image_data6]" type="hidden" value="<?php echo $item_data['image_data6'];?>">
        <input nctype="image_title" name="item_data[image_title6]" type="hidden" value="<?php echo $item_data['image_title6'];?>">
        <input nctype="image_color" name="item_data[image_color6]" type="hidden" value="<?php echo $item_data['image_color6'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
    <div class="navbox">
      <div nctype="item_image" class="item"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data['image_name7']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[image_name7]" type="hidden" value="<?php echo $item_data['image_name7'];?>">
        <input nctype="image_type" name="item_data[image_type7]" type="hidden" value="<?php echo $item_data['image_type7'];?>">
        <input nctype="image_data" name="item_data[image_data7]" type="hidden" value="<?php echo $item_data['image_data7'];?>">
        <input nctype="image_title" name="item_data[image_title7]" type="hidden" value="<?php echo $item_data['image_title7'];?>">
        <input nctype="image_color" name="item_data[image_color7]" type="hidden" value="<?php echo $item_data['image_color7'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>


  </div>
</div>
