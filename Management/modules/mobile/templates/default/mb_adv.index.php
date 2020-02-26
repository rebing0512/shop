<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>集市首页广告</h3>
                <h5>集市首页广告设置</h5>
            </div>
        </div>
    </div>
    <form method="post" name="settingForm" id="settingForm"  enctype="multipart/form-data">
        <input type="hidden" name="form_submit" value="ok">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="promise">广告图片</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show"><span class="show"><a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['adv_picture']['value']);?>"> <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['adv_picture']['value']);?>>')" onMouseOut="toolTip()"/></i> </a></span><span class="type-file-box">
            <input type="text" name="textfield" id="textfield1" class="type-file-text" />
            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button" />
            <input class="type-file-file" id="picture" name="picture" type="file" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
            </span></div>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">广播标题</dt>
                <dd class="opt">
                    <input id="title" name="title" value="<?php echo $output['adv_url'][0];?>" class="input-txt" />
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">广播描述</dt>
                <dd class="opt">
                    <input id="description" name="description" value="<?php echo $output['adv_url'][1];?>" class="input-txt" />
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">广播链接</dt>
                <dd class="opt">
                    <input id="url" name="url" value="<?php echo $output['adv_url'][2];?>" class="input-txt" />
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
<script type="text/javascript" src="<?php echo ADMIN_RESOURCE_URL;?>/js/jquery.nyroModal.js"></script>
<script type="text/javascript">
    // 模拟网站LOGO上传input type='file'样式
    $(function(){
        $("#picture").change(function(){
            $("#textfield1").val($(this).val());
        });
        });
// 上传图片类型
        $('input[class="type-file-file"]').change(function(){
            var filepath=$(this).val();
            var extStart=filepath.lastIndexOf(".");
            var ext=filepath.substring(extStart,filepath.length).toUpperCase();
            if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
                alert("<?php echo $lang['default_img_wrong'];?>");
                $(this).attr('value','');
                return false;
            }
        });
</script>
