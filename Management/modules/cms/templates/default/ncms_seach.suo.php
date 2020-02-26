<?php defined('TTShop') or exit('Access Invalid!');?>
<style type="text/css">
  .ncap-form-default .input-txt{
    width: 100px !important;
  }
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['suo_dump'];?></h3>
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
      <li>最好是有选择性的重建，如果全部重建，当信息量比较大的时候会比较久！此操作不可逆!</li>
    </ul>
  </div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="site_name">选择模型</label>
        </dt>
        <dd class="opt">
         <input id="modelid" name="modelid" value="0" class="input-txt" type="radio"  checked="true" />不限制模型
        <?php if(is_array($output['list']) && !empty($output['list'])){?>
         <?php foreach($output['list'] as $k=>$v){?>
          <input id="modelid" name="modelid" value="<?php echo $v['modelid'];?>" class="input-txt" type="radio"  /><?php echo $v['name'];?>
         
          <?php }?>
        <?php }?>
          <p class="notic">最好是有选择性的重建，如果全部重建，当信息量比较大的时候会比较久！此操作不可逆！</p>
        </dd>
       
      </dl>
      
       <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="site_name">每轮更新</label>
        </dt>
          <dd class="opt">
          <input id="pagesize" name="pagesize" value="10" class="input-txt" type="text"  />条
          <p class="notic">每轮更新条数</p>
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
