<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>购买须知设置</h3>
                <h5>购买须知的相关设置</h5>
            </div>
        </div>
    </div>
    <form method="post" name="settingForm" id="settingForm"  enctype="multipart/form-data">
        <input type="hidden" name="form_submit" value="ok">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="promise">承诺保障</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show"><span class="show"><a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['promise']['value']);?>"> <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['promise']['value']);?>>')" onMouseOut="toolTip()"/></i> </a></span><span class="type-file-box">
            <input type="text" name="textfield" id="textfield1" class="type-file-text" />
            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button" />
            <input class="type-file-file" id="promise" name="promise" type="file" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
            </span></div>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="buy">购买流程</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show"><span class="show"><a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['buy']['value']);?>"> <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['buy']['value']);?>>')" onMouseOut="toolTip()"/></i> </a></span><span class="type-file-box">
            <input type="text" name="textfield" id="textfield1" class="type-file-text" />
            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button" />
            <input class="type-file-file" id="buy" name="buy" type="file" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
            </span></div>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">售后服务</dt>
                <dd class="opt">
                    <textarea id="service" name="service" value="" class="input-txt"><?php echo $output['service']['value'];?></textarea>
                    <p class="notic"></p>
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