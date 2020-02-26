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
    <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[0]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[0]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[0][image_name]" type="hidden" value="<?php echo $item_data[0]['image_name'];?>">
        <input nctype="image_type" name="item_data[0][image_type]" type="hidden" value="<?php echo $item_data[0]['image_type'];?>">
        <input nctype="image_data" name="item_data[0][image_data]" type="hidden" value="<?php echo $item_data[0]['image_data'];?>">
        <input nctype="image_title" name="item_data[0][image_title]" type="hidden" value="<?php echo $item_data[0]['image_title'];?>">
        <input nctype="image_color" name="item_data[0][image_color]" type="hidden" value="<?php echo $item_data[0]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>

       <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[1]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[1]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[1][image_name]" type="hidden" value="<?php echo $item_data[1]['image_name'];?>">
        <input nctype="image_type" name="item_data[1][image_type]" type="hidden" value="<?php echo $item_data[1]['image_type'];?>">
        <input nctype="image_data" name="item_data[1][image_data]" type="hidden" value="<?php echo $item_data[1]['image_data'];?>">
        <input nctype="image_title" name="item_data[1][image_title]" type="hidden" value="<?php echo $item_data[1]['image_title'];?>">
        <input nctype="image_color" name="item_data[1][image_color]" type="hidden" value="<?php echo $item_data[1]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
       <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[2]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[2]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[2][image_name]" type="hidden" value="<?php echo $item_data[2]['image_name'];?>">
        <input nctype="image_type" name="item_data[2][image_type]" type="hidden" value="<?php echo $item_data[2]['image_type'];?>">
        <input nctype="image_data" name="item_data[2][image_data]" type="hidden" value="<?php echo $item_data[2]['image_data'];?>">
        <input nctype="image_title" name="item_data[2][image_title]" type="hidden" value="<?php echo $item_data[2]['image_title'];?>">
        <input nctype="image_color" name="item_data[2][image_color]" type="hidden" value="<?php echo $item_data[2]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
       <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[3]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[3]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[3][image_name]" type="hidden" value="<?php echo $item_data[3]['image_name'];?>">
        <input nctype="image_type" name="item_data[3][image_type]" type="hidden" value="<?php echo $item_data[3]['image_type'];?>">
        <input nctype="image_data" name="item_data[3][image_data]" type="hidden" value="<?php echo $item_data[3]['image_data'];?>">
        <input nctype="image_title" name="item_data[3][image_title]" type="hidden" value="<?php echo $item_data[3]['image_title'];?>">
        <input nctype="image_color" name="item_data[3][image_color]" type="hidden" value="<?php echo $item_data[3]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
    <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[4]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[4]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[4][image_name]" type="hidden" value="<?php echo $item_data[4]['image_name'];?>">
        <input nctype="image_type" name="item_data[4][image_type]" type="hidden" value="<?php echo $item_data[4]['image_type'];?>">
        <input nctype="image_data" name="item_data[4][image_data]" type="hidden" value="<?php echo $item_data[4]['image_data'];?>">
        <input nctype="image_title" name="item_data[4][image_title]" type="hidden" value="<?php echo $item_data[4]['image_title'];?>">
        <input nctype="image_color" name="item_data[4][image_color]" type="hidden" value="<?php echo $item_data[4]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>

       <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[5]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[5]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[5][image_name]" type="hidden" value="<?php echo $item_data[5]['image_name'];?>">
        <input nctype="image_type" name="item_data[5][image_type]" type="hidden" value="<?php echo $item_data[5]['image_type'];?>">
        <input nctype="image_data" name="item_data[5][image_data]" type="hidden" value="<?php echo $item_data[5]['image_data'];?>">
        <input nctype="image_title" name="item_data[5][image_title]" type="hidden" value="<?php echo $item_data[5]['image_title'];?>">
        <input nctype="image_color" name="item_data[5][image_color]" type="hidden" value="<?php echo $item_data[5]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
       <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[6]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[6]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[6][image_name]" type="hidden" value="<?php echo $item_data[6]['image_name'];?>">
        <input nctype="image_type" name="item_data[6][image_type]" type="hidden" value="<?php echo $item_data[6]['image_type'];?>">
        <input nctype="image_data" name="item_data[6][image_data]" type="hidden" value="<?php echo $item_data[6]['image_data'];?>">
        <input nctype="image_title" name="item_data[6][image_title]" type="hidden" value="<?php echo $item_data[6]['image_title'];?>">
        <input nctype="image_color" name="item_data[6][image_color]" type="hidden" value="<?php echo $item_data[6]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>
       <div class="navbox" >
      <div nctype="item_image" class="item" style="background:<?php echo $item_data[7]['image_color'];?>"> <img nctype="image" src="<?php echo getMbSpecialImageUrl($item_data[7]['image_name']);?>" alt="">
        <?php if($item_edit_flag) { ?>
        <input nctype="image_name" name="item_data[7][image_name]" type="hidden" value="<?php echo $item_data[7]['image_name'];?>">
        <input nctype="image_type" name="item_data[7][image_type]" type="hidden" value="<?php echo $item_data[7]['image_type'];?>">
        <input nctype="image_data" name="item_data[7][image_data]" type="hidden" value="<?php echo $item_data[7]['image_data'];?>">
        <input nctype="image_title" name="item_data[7][image_title]" type="hidden" value="<?php echo $item_data[7]['image_title'];?>">
        <input nctype="image_color" name="item_data[7][image_color]" type="hidden" value="<?php echo $item_data[7]['image_color'];?>">
        <a nctype="btn_edit_item_image" data-desc="90*90" href="javascript:;"><i class="fa fa-pencil-square-o"></i>编辑</a>
        <?php } ?>
      </div>
    </div>


  </div>
</div>
