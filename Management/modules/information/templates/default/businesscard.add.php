<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=mb_businesscard" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3><?php echo $output['action'];?>名片信息</h3>
                <h5><?php echo $output['action'];?>名片信息</h5>
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
                    <input type="text" value="<?php echo $output['page']['name'];?>" name="name" id="name" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic">暂定人员或者店铺皆可，显示在顶部圆图下第一行位置。</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="sort"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['sort'];?>" id="sort" name="sort" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em>*</em>标题</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['title'];?>" id="title" name="title" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic">显示在顶部圆图下第二行位置，可以填写人员荣誉名号或者店铺称号。</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em></em>公司名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['company_name'];?>" id="company_name" name="company_name" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em></em>公司地址</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['company_addr'];?>" id="company_addr" name="company_addr" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em></em>店铺名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['store_name'];?>" id="store_name" name="store_name" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em></em>对公电话</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['phone'];?>" id="phone" name="phone" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em></em>对公微信</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['weixin'];?>" id="weixin" name="weixin" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em></em>用户ID</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['user_id'];?>" id="user_id" name="user_id" class="input-txt" maxlength="20">
                    <span class="err"></span>
                    <p class="notic">用以获取名片二维码</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>顶部图片</label>
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
            <dl class="row">
                <dt class="tit">
                    <label for="articleForm">主营</label>
                </dt>
                <dd class="opt">
                    <textarea type="text"  name="main" id="main" class="tarea"><?php echo $output['page']['main'];?></textarea>
                    <span class="err"></span>
                    <p class="notic">请设置主营信息</p>
                </dd>
            </dl>
<!--            <dl class="row" style="display:none;">-->
<!--                <dt class="tit">-->
<!--                    <label><em>*</em>内容</label>-->
<!--                </dt>-->
<!--                <dd class="opt">-->
<!--                    --><?php //showEditor('detail',$output['page']['detail']);?>
<!--                    <span class="err"></span>-->
<!--                    <p class="notic"></p>-->
<!--                </dd>-->
<!--            </dl>-->
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
        $('#view_img').attr('src','<?php echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR;?>/'+picname)
            .attr('onmouseover','toolTip("<img src=<?php echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR;?>/'+picname+'>")');
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
                    url : '<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=pic_upload&form_submit=ok&uploadpath=<?php echo ATTACH_AVATAR;?>',
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
                name: {
                    required : true,
                    minlength: 3,
                    maxlength: 20
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
                name: {
                    required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_add_name_null']?>',
                    maxlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_add_name_length']?>',
                    minlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_add_name_length']?>'
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
