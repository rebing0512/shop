<?php defined('TTShop') or exit('Access Invalid!');?>
<style type="text/css">
  .ncap-form-default .input-txt{
    width: 500px !important;
  }
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['suo_keyword'];?></h3>
        <h5><?php echo $lang['seach_set_subhead'];?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li>资讯搜索设置对资讯项进行操作。</li>
    </ul>
  </div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="site_name">关键字设置</label>
        </dt>
        <dd class="opt">
       
          <input id="cms_keyword" name="cms_keyword" value="<?php echo $output['cms_keyword'];?>" class="input-txt" type="text"  />
         
      
          <p class="notic">配置搜索数据关键字，关键字之间以逗号(,)隔开</p>
        </dd>
      </dl>
      
   
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.form1.submit()"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript">
$(function(){
    $('#time_zone').attr('value','<?php echo $output['list_setting']['time_zone'];?>'); 
});
</script> 
