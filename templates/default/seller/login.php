<?php defined('TTShop') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>商家管理中心登录</title>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<!-- <link href="<?php echo SHOP_TEMPLATES_URL?>/css/base.css" rel="stylesheet" type="text/css"> -->
<link href="<?php echo SHOP_TEMPLATES_URL?>/css/seller_center.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
<![endif]-->
<script language="JavaScript" type="text/javascript">
window.onload = function() {
    tips = new Array(1);
    tips[0] = document.getElementById("loginBG01");
    // tips[1] = document.getElementById("loginBG02");
    index = Math.floor(Math.random() * tips.length);
    tips[index].style.display = "block";
};
$(document).ready(function() {
    //更换验证码
    function change_seccode() {
        $('#codeimage').attr('src', 'index.php?con=seccode&fun=makecode&nchash=<?php echo $output['nchash'];?>&t=' + Math.random());
        $('#captcha').select();
    }

    $('[nctype="btn_change_seccode"]').on('click', function() {
        change_seccode();
    });

    //登陆表单验证
    $("#form_login").validate({
        errorPlacement:function(error, element) {
            element.prev(".repuired").append(error);
        },
        onkeyup: false,
        rules:{
            seller_name:{
                required:true
            },
            password:{
                required:true
            },
            captcha:{
                required:true,
                remote:{
                    url:"index.php?con=seccode&fun=check&nchash=<?php echo $output['nchash'];?>",
                    type:"get",
                    data:{
                        captcha:function() {
                            return $("#captcha").val();
                        }
                    },
                    complete: function(data) {
                        if(data.responseText == 'false') {
                            change_seccode();
                        }
                    }
                }
            }
        },
        messages:{
            seller_name:{
                required:"<i class='icon-exclamation-sign'></i>用户名不能为空"
            },
            password:{
                required:"<i class='icon-exclamation-sign'></i>密码不能为空"
            },
            captcha:{
                required:"<i class='icon-exclamation-sign'></i>验证码不能为空",
                remote:"<i class='icon-frown'></i>验证码错误"
            }
        }
    });
  //Hide Show verification code
    $("#hide").click(function(){
        $(".code").fadeOut("slow");
    });
    $("#captcha").focus(function(){
        $(".code").fadeIn("fast");
    });

});
</script>
<style type="text/css">
#form_login{ color: #FFF;}
  .input_outer{
  height: 46px;
  padding: 0 5px;
  margin-bottom: 20px;
  border-radius: 50px;
  position: relative;
  border: rgba(255,255,255,0.2) 2px solid !important;
}
.text {
    width: 220px;
    height:33px;
    outline: none;
    display: inline-block;
    font: 14px "microsoft yahei",Helvetica,Tahoma,Arial,"Microsoft jhengHei";
    border: none;
    background: none;
    line-height: 33px;
    color:#FFF;
}


</style>
</head>
<body>
<div id="loginBG01" class="ncsc-login-bg">
  <p class="pngFix"></p>
</div>
<div id="loginBG02" class="ncsc-login-bg">
  <p class="pngFix"></p>
</div>
<div class="ncsc-login-container">
  <div class="ncsc-login-title">
    <h2 style="margin-bottom:35px; height:30px; line-height:30px;font-size:30px; text-align:center;letter-spacing:10px; width:320px; color:#FFF">商家管理中心</h2>
 <!-- <h4><a href="<?php echo urlChain('login');?>">门店管理登录</a></h4> -->
</div>
  <form id="form_login" action="index.php?con=seller_login&fun=login" method="post" >
    <?php Security::getToken();?>
    <input name="nchash" type="hidden" value="<?php echo $output['nchash'];?>" />
    <input type="hidden" name="form_submit" value="ok" />


    <div class="input_outer">
      <b class="yd"></b>
      <span class="repuired"></span>
      <input name="seller_name" placeholder="输入用户名" type="text" autocomplete="off" class="text" autofocus>
    </div>

    <div class="input_outer">
      <b class="yds"></b>
      <span class="repuired"></span>
      <input name="password" placeholder="输入密码" type="password" autocomplete="off" class="text">
      </div>
    <div class="input_outer">
     <b class="ydss"></b>

      <input type="text" name="captcha" id="captcha" placeholder="输入验证码" autocomplete="off" class="text" style="width: 220px;" maxlength="4" size="10" />
      <div class="code">
        <div class="arrow"></div>
        <div class="code-img"><a href="javascript:void(0)" nctype="btn_change_seccode"><img src="index.php?con=seccode&fun=makecode&nchash=<?php echo $output['nchash'];?>" name="codeimage" border="0" id="codeimage"></a></div>
        <a href="JavaScript:void(0);" id="hide" class="close" title="<?php echo $lang['login_index_close_checkcode'];?>"><i></i></a> <a href="JavaScript:void(0);" class="change" nctype="btn_change_seccode" title="<?php echo $lang['login_index_change_checkcode'];?>"><i></i></a> </div>
    </div>
    <div class="input_outer" style="background:#0096e6; ">
      <input type="submit" value="确认登录" style="height:50px; width:300px; background:none; font-size:18px;">
      </div>
  </form>
</div>
</body>
</html>
