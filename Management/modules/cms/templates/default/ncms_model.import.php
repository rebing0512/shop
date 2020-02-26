<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?con=ncms_model&fun=ncms_model_list" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['nc_ncms_model_manage'];?> -导入</h3>
        <h5><?php echo $lang['nc_ncms_model_manage_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="add_form" method="post" action="index.php?con=ncms_model&fun=ncms_model_runimport"  enctype="multipart/form-data">
    <div class="ncap-form-default">
     <dl class="row">
        <dt class="tit">
          <label for="name"><?php echo $lang['ncms_model_name'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['data']['name'];?>" name="name" id="name" class="input-txt">
          <span class="err"></span>
          <p class="notic">为空时按配置文件中的</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="tablename"><?php echo $lang['ncms_model_tablename'];?></label>
        </dt>
        <dd class="opt">
          <input id="tablename" name="tablename" type="text" class="input-txt" value="<?php echo $output['data']['tablename'];?>" />
          <span class="err"></span>
          <p class="notic">为空时按配置文件中的</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">选择要上传的模型文件：</dt>
         <dd class="opt">
          <div class="input-file-show"><span class="type-file-box">
            <input type="file" class="type-file-file" id="file_adv_pic" name="file" size="30" hidefocus="true"  nc_type="upload_file_adv_pic" title="点击按钮选择文件并提交表单后上传生效">
            </span></div>
          <span class="err"></span>
          <p class="notic">选择要上传的模型文件eg.s_ncms_model_9.txt</p>
        </dd>
      </dl>

      <div class="bot"><a id="submit" href="javascript:void(0)" class="ncap-btn-big ncap-btn-green"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#submit").click(function(){
        $("#add_form").submit();
    });
      var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />"
    $(textButton).insertBefore("#file_adv_pic");
    $("#file_adv_pic").change(function(){
     $("#textfield1").val($("#file_adv_pic").val());
    });

});
</script>