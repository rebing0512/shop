<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['control_set'];?></h3>
        <h5><?php echo $lang['control_set_subhead'];?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li>在这里可以设置网店运维开发的一些基本功能。</li>
    </ul>
  </div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="control_stitle"><?php echo $lang['control_stitle'];?></label>
        </dt>
        <dd class="opt">
          <input id="control_stitle" name="control_stitle" value="<?php echo $output['list_setting']['control_stitle'];?>" class="input-txt" type="text" />
          <p class="notic"><?php echo $lang['control_stitle_notice'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="control_phone"><?php echo $lang['control_phone'];?></label>
        </dt>
        <dd class="opt">
          <input id="control_phone" name="control_phone" value="<?php echo $output['list_setting']['control_phone'];?>" class="input-txt" type="text" />
          <p class="notic"><?php echo $lang['control_phone_notice'];?></p>
        </dd>
      </dl>
            <dl class="row">
        <dt class="tit">
          <label for="control_time"><?php echo $lang['control_time'];?></label>
        </dt>
        <dd class="opt">
          <input id="control_time" name="control_time" value="<?php echo $output['list_setting']['control_time'];?>" class="input-txt" type="text" />
          <p class="notic"><?php echo $lang['control_time_notice'];?></p>
        </dd>
      </dl>
       
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.form1.submit()"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>