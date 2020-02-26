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
            <li>公告热点图片最佳尺寸为100*60，GIF动画图片效果更佳哦~</li>
      <li>公告文字尽量不要超过30个字！</li>
      <li>注意：链接必须加“http”的完整链接，设置字体大小，可在字体颜色输入框内直接输入： font-size: 10px; 常用字体颜色可参考颜色对照表：<a href="http://tool.oschina.net/commons?type=3"  target="_blank">点击查看颜色对照表</a></li>
            <li>警告：极有客商城程序（包括PC/WAP端）由极有客开发团队开发，均有记录ID，任何人未经允许，不得对外传播。否则追究责任，后果自负！</li>
      </ul></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
<div class="index_block home13">
      <?php if($item_edit_flag) { ?>
  <h3>公告滚动条 - 极有客</h3>
  <?php } ?>
  
  <div nctype="item_content" class="content">
      <?php if($item_edit_flag) { ?>
    <h5>公告图片，如“商城公告”：</h5>
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
  <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>内容一：<tt style="margin-left:178px;">字体颜色：(格式为：#FF0000)</tt> <tt style="margin-left:20px;">链接：</tt></h5>
    <input id="home1_title" type="text" class="txt w200" name="item_data[title]" value="<?php echo $item_data['title'];?>">
  <input id="home1_title" type="text" class="txt w211" name="item_data[title20]" value="<?php echo $item_data['title20'];?>">
  <input id="home1_title" type="text" class="txt w212" name="item_data[title6]" value="<?php echo $item_data['title6'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title'];?></span><span><?php echo $item_data['title20'];?></span><span><?php echo $item_data['title6'];?></span>
    <?php } ?>  
  </div>
  
  
   <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>内容二：<tt style="margin-left:178px;">字体颜色：(格式为：#FF0000)</tt> <tt style="margin-left:20px;">链接：</tt></h5>
  <input id="home1_title" type="text" class="txt w200" name="item_data[title1]" value="<?php echo $item_data['title1'];?>">
  <input id="home1_title" type="text" class="txt w211" name="item_data[title21]" value="<?php echo $item_data['title21'];?>">
  <input id="home1_title" type="text" class="txt w212" name="item_data[title7]" value="<?php echo $item_data['title7'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title1'];?></span><span><?php echo $item_data['title21'];?></span><span><?php echo $item_data['title7'];?></span>
    <?php } ?>
  </div> 
  
   <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>内容三：<tt style="margin-left:178px;">字体颜色：(格式为：#FF0000)</tt> <tt style="margin-left:20px;">链接：</tt></h5>
    <input id="home1_title" type="text" class="txt w200" name="item_data[title2]" value="<?php echo $item_data['title2'];?>">
  <input id="home1_title" type="text" class="txt w211" name="item_data[title22]" value="<?php echo $item_data['title22'];?>">
  <input id="home1_title" type="text" class="txt w212" name="item_data[title8]" value="<?php echo $item_data['title8'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title2'];?></span><span><?php echo $item_data['title22'];?></span><span><?php echo $item_data['title8'];?></span>
    <?php } ?>
  </div>
    
  
   <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>内容四：<tt style="margin-left:178px;">字体颜色：(格式为：#FF0000)</tt> <tt style="margin-left:20px;">链接：</tt></h5>
    <input id="home1_title" type="text" class="txt w200" name="item_data[title3]" value="<?php echo $item_data['title3'];?>">
  <input id="home1_title" type="text" class="txt w211" name="item_data[title23]" value="<?php echo $item_data['title23'];?>">
  <input id="home1_title" type="text" class="txt w212" name="item_data[title9]" value="<?php echo $item_data['title9'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title3'];?></span><span><?php echo $item_data['title23'];?></span><span><?php echo $item_data['title9'];?></span>
    <?php } ?>
  </div>
  
  
   <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>内容五：<tt style="margin-left:178px;">字体颜色：(格式为：#FF0000)</tt> <tt style="margin-left:20px;">链接：</tt></h5>
    <input id="home1_title" type="text" class="txt w200" name="item_data[title4]" value="<?php echo $item_data['title4'];?>">
  <input id="home1_title" type="text" class="txt w211" name="item_data[title24]" value="<?php echo $item_data['title24'];?>">
  <input id="home1_title" type="text" class="txt w212" name="item_data[title10]" value="<?php echo $item_data['title10'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title4'];?></span><span><?php echo $item_data['title24'];?></span><span><?php echo $item_data['title10'];?></span>
    <?php } ?>
  </div>
   
  
   <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>内容六：<tt style="margin-left:178px;">字体颜色：(格式为：#FF0000)</tt> <tt style="margin-left:20px;">链接：</tt></h5>
    <input id="home1_title" type="text" class="txt w200" name="item_data[title5]" value="<?php echo $item_data['title5'];?>">
  <input id="home1_title" type="text" class="txt w211" name="item_data[title25]" value="<?php echo $item_data['title25'];?>">
  <input id="home1_title" type="text" class="txt w212" name="item_data[title11]" value="<?php echo $item_data['title11'];?>">
    <?php } else { ?>
    <span><?php echo $item_data['title5'];?></span><span><?php echo $item_data['title25'];?></span><span><?php echo $item_data['title11'];?></span>
    <?php } ?>
  </div>
</div>
