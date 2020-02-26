<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.go(-1);" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3><?php echo $output['action'];?>黄页</h3>
                <h5><?php echo $output['action'];?>黄页信息</h5>
            </div>
        </div>
    </div>
    <!-- 操作说明 -->
    <form id="user_form" enctype="multipart/form-data" method="post">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="id" id="id" value="<?php echo $output['page']['id'];?>" />
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="name"><em>*</em>名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['name'];?>" name="name" id="name" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="sort"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['sort']===null?255:$output['page']['sort'];?>" id="sort" name="sort" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">请填写阿拉伯数字，数字越小排名越靠前。</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="type"><em>*</em>核心分类</label>
                </dt>
                <dd class="opt">
                    <select id="h_type" name="h_type" >
                        <?php foreach ($output['category']['result']['category'] as $k=>$v):?>
                            <option value="<?=$v['id']?>" <?php if ($output['page']['h_type']==$v['id']):echo 'selected';endif;?>><?=$v['name']?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="app_title">打开链接是否带有APP头</label>
                </dt>
                <dd class="opt">
                    <label>
                        <input type="radio" value="0" name="app_title" <?php if ($output['page']['app_title'] == 0){echo 'checked';}?>>
                        是</label>
                    <label>
                        <input type="radio" value="1" name="app_title" <?php if ($output['page']['app_title'] == 1){echo 'checked';}?>>
                        否</label>
                    <p class="notic">默认带有APP头布局。</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="first_char">首字母</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['first_char'];?>" id="first_char" name="first_char" class="input-txt">
                    <p class="notic">请填写名称第一个汉字小写首字母。</p>
                    <span class="err"></span> </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="url">URL</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['url'];?>" id="url" name="url" class="input-txt">
                    <p class="notic">请填写跳转地址。</p>
                    <span class="err"></span> </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>图片</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show"><span class="type-file-box">
            <input class="type-file-file" id="_pic" name="_pic" type="file" size="30" hidefocus="true" title="点击按钮选择文件并提交表单后上传生效">
            <input type="text" value="<?php echo $output['page']['picture'];?>" name="member_avatar" id="member_avatar" class="type-file-text" />
            <input type="button" name="button" id="button" value="选择上传..." class="type-file-button" />
            </span></div>
                    <p class="notic"></p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    //裁剪图片后返回接收函数
    function call_back(picname){
        $('#member_avatar').val(picname);
        $('#view_img').attr('src','<?php echo UPLOAD_SITE_URL.'/contacts';?>/'+picname)
            .attr('onmouseover','toolTip("<img src=<?php echo UPLOAD_SITE_URL.'/contacts';?>/'+picname+'>")');
    }
    $(function(){
        $('input[class="type-file-file"]').change(uploadChange);
        function uploadChange(){
            var filepath=$(this).val();
            var extStart=filepath.lastIndexOf(".");
            var ext=filepath.substring(extStart,filepath.length).toUpperCase();
            if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
                alert("file type error");
                $(this).attr('value','');
                return false;
            }
            if ($(this).val() == '') return false;
            ajaxFileUpload();
        }
        function ajaxFileUpload()
        {
            $.ajaxFileUpload
            (
                {
                    url : '<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=pic_upload&form_submit=ok&uploadpath=contacts',
                    secureuri:false,
                    fileElementId:'_pic',
                    dataType: 'json',
                    success: function (data, status)
                    {
                        if (data.status == 1){
                            ajax_form('cutpic','<?php echo $lang['nc_cut'];?>','<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=pic_cut&type=member&x=120&y=120&resize=1&ratio=1&url='+data.url,690);
                        }else{
                            alert(data.msg);
                        }
                        $('input[class="type-file-file"]').bind('change',uploadChange);
                    },
                    error: function (data, status, e)
                    {
                        alert('上传失败');
                        $('input[class="type-file-file"]').bind('change',uploadChange);
                    }
                }
            )
        };
        //按钮先执行验证再提交表单
        $("#submitBtn").click(function(){
            if($("#user_form").valid()){
                $("#user_form").submit();
            }
        });
        $('#user_form').validate({
            errorPlacement: function(error, element){
                var error_td = element.parent('dd').children('span.err');
                error_td.append(error);
            },
            rules : {
                name:{
                    required :true
                },
                first_char:{
                    required :true,
                    maxlength:1
                },
                sort: {
                    required : true,
                    min: 0,
                    max: 1000
                },
                member_passwd: {
                    required : true,
                    maxlength: 20,
                    minlength: 6
                },
                member_email   : {
                    required : true,
                    email : true,
                    remote   : {
                        url :'index.php?con=member&fun=ajax&branch=check_email',
                        type:'get',
                        data:{
                            user_name : function(){
                                return $('#member_email').val();
                            },
                            member_id : '<?php echo $output['member_array']['member_id'];?>'
                        }
                    }
                },
                member_qq : {
                    digits: true,
                    minlength: 5,
                    maxlength: 11
                }
            },
            messages : {
                name:{
                    required : '<i class="fa fa-exclamation-circle"></i>名称必须'
                },
                first_char:{
                    required : '<i class="fa fa-exclamation-circle"></i>首字母必须',
                    maxlength: '<i class="fa fa-exclamation-circle"></i>最多一个字符'
                },
                sort: {
                    required : '<i class="fa fa-exclamation-circle"></i>必须填写数字',
                    min: '<i class="fa fa-exclamation-circle"></i>所填写数字不能小于0',
                    max: '<i class="fa fa-exclamation-circle"></i>所填写数字不能大于1000'
                },
                member_passwd : {
                    required : '<i class="fa fa-exclamation-circle"></i><?php echo '密码不能为空'; ?>',
                    maxlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_password_tip']?>',
                    minlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_password_tip']?>'
                },
                member_email  : {
                    required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_email_null']?>',
                    email   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_valid_email']?>',
                    remote : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_email_exists']?>'
                },
                member_qq : {
                    digits: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_qq_wrong']?>',
                    minlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_qq_wrong']?>',
                    maxlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_qq_wrong']?>'
                }
            }
        });
    });
</script>
