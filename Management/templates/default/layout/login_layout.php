<?php defined('TTShop') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<title><?php echo $output['html_title'];?></title>

<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/login.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADMIN_RESOURCE_URL?>/font/css/font-awesome.min.css" rel="stylesheet">

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" type="text/javascript"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>

<script src="<?php echo ADMIN_RESOURCE_URL?>/js/jquery.progressBar.js" type="text/javascript"></script>

</head>
<body>
<?php 
require_once($tpl_file);
?>
<script>
$(function(){
      
	//显示隐藏验证码
    $("#hide").click(function(){
        $(".code").fadeOut("slow");
    });
    $("#captcha").focus(function(){
        $(".code").fadeIn("fast");
    });
    //跳出框架在主窗口登录
   if(top.location!=this.location)	top.location=this.location;
    $('#user_name').focus();
    if ($.browser.msie && ($.browser.version=="6.0" || $.browser.version=="7.0")){
        window.location.href='<?php echo ADMIN_TEMPLATES_URL;?>/ie6update.html';
    }
    $("#captcha").nc_placeholder();
	//动画登录
    $('.btn-submit').click(function(e){
       
            setTimeout(function () {
                 
                      $('.submit2').html('<div class="progress"><div class="progress-bar progress-bar-success" aria-valuetransitiongoal="100"></div></div>');
                      $('.progress .progress-bar').progressbar({
                          done : function() {$('#form_login').submit();}
                      }); 
              },
          300);

          });

    // 回车提交表单
    $('#form_login').keydown(function(event){
        if (event.keyCode == 13) {
            $('.btn-submit').click();
        }
    });
});

</script>
</body>
</html>
