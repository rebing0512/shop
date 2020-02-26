<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>手机端设置</h3>
        <h5>手机端的相关设置</h5>
      </div>
    </div>
  </div>
  <form method="post" name="settingForm" id="settingForm"  enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">会员签到</dt>
        <dd class="opt">
          <div class="onoff">
            <label for="signin_isuse_1" class="cb-enable <?php if($output['list_setting']['signin_isuse'] == '1'){ ?>selected<?php } ?>" title="开启">开启</label>
            <label for="signin_isuse_0" class="cb-disable <?php if($output['list_setting']['signin_isuse'] == '0'){ ?>selected<?php } ?>" title="关闭">关闭</label>
            <input id="signin_isuse_1" name="signin_isuse" <?php echo $output['list_setting']['signin_isuse']==1?'checked=checked':''; ?> value="1" type="radio">
            <input id="signin_isuse_0" name="signin_isuse" value="0" type="radio" <?php echo $output['list_setting']['signin_isuse']==0?'checked=checked':''; ?>>
          </div>
          <p class="notic">签到启用后，会员将可以通过移动端商城签到获取积分</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">签到送积分</dt>
        <dd class="opt">
          <input id="points_signin" name="points_signin" value="<?php echo $output['list_setting']['points_signin'];?>" class="input-txt" type="text">
          <p class="notic">例:设置为5，表明签到一次赠送5积分</p>
        </dd>
      </dl>
        <dl class="row">
            <dt class="tit">使用帮助链接</dt>
            <dd class="opt">
                <input id="instruction" name="instruction" value="<?php echo $output['list_setting']['instruction'];?>" class="input-txt" type="text">
                <p class="notic">商城功能使用说明</p>
            </dd>
        </dl>
        <dl class="row">
        <dt class="tit">
          <label for="mobile_logo">手机logo</label>
        </dt>
        <dd class="opt">
          <div class="input-file-show"><span class="show"><a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['list_setting']['mobile_logo']);?>"> <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['list_setting']['mobile_logo']);?>>')" onMouseOut="toolTip()"/></i> </a></span><span class="type-file-box">
            <input type="text" name="textfield" id="textfield1" class="type-file-text" />
            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button" />
            <input class="type-file-file" id="mobile_logo" name="mobile_logo" type="file" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
            </span></div>
          <span class="err"></span>
          <p class="notic">默认网站LOGO,通用头部显示，最佳显示尺寸为130*50像素</p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
    </div>
  </form>
</div>
<script>
$(function(){$("#submitBtn").click(function(){
    if($("#settingForm").valid()){
      $("#settingForm").submit();
	}
	});
});
</script>