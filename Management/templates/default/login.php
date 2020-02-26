<?php defined('TTShop') or exit('Access Invalid!');?>
 
    <script type="text/javascript">
        $(function(){
            //得到焦点
            $("#password").focus(function(){
                $("#left_hand").animate({
                    left: "150",
                    top: " -38"
                },{step: function(){
                    if(parseInt($("#left_hand").css("left"))>140){
                        $("#left_hand").attr("class","left_hand");
                    }
                }}, 2000);
                $("#right_hand").animate({
                    right: "-64",
                    top: "-38px"
                },{step: function(){
                    if(parseInt($("#right_hand").css("right"))> -70){
                        $("#right_hand").attr("class","right_hand");
                    }
                }}, 2000);
            });
            //失去焦点
            $("#password").blur(function(){
                $("#left_hand").attr("class","initial_left_hand");
                $("#left_hand").attr("style","left:100px;top:-12px;");
                $("#right_hand").attr("class","initial_right_hand");
                $("#right_hand").attr("style","right:-112px;top:-12px");
            });
        });
    </script>
<div class="top_div">
  <div class="top">
    <h5>电商平台<em></em></h5>
    <h2>系统管理中心</h2>

  </div>
</div>
  <form method="post" id="form_login">
  <?php Security::getToken();?>
  <input type="hidden" name="form_submit" value="ok" />
  <input type="hidden" name="SiteUrl" id="SiteUrl" value="<?php echo SHOP_SITE_URL;?>" />
  <div style="width: 400px;height: 200px;margin: auto auto;background: #ffffff;text-align: center;margin-top: -100px;border: 1px solid #e7e7e7">
    <div style="width: 165px;height: 96px;position: absolute">
        <div class="tou"></div>
        <div id="left_hand" class="initial_left_hand"></div>
        <div id="right_hand" class="initial_right_hand"></div>
    </div>

    <p style="padding: 30px 0px 10px 0px;position: relative;">
        <span class="u_logo"></span>
        <input class="ipt" type="text" placeholder="帐号" id="user_name" name="user_name"  autocomplete="off"  required>
    </p>
    <p style="position: relative;">
        <span class="p_logo"></span>
        <input id="password" class="ipt" type="password"  placeholder="密码" name="password" autocomplete="off" type="password" required pattern="[\S]{6}[\S]*" title="密码不少于6个字符"> 
    </p>

    <div style="height: 50px;line-height: 50px;margin-top: 30px;border-top: 1px solid #e7e7e7;padding:0 35px;">
    
           <span style="float: left;position: relative;">
            <div class="code">
              <div class="arrow"></div>
              <div class="code-img"><img src="index.php?con=seccode&fun=makecode&admin=1&nchash=<?php echo getNchash();?>" name="codeimage" id="codeimage" border="0"/></div>
              <a href="JavaScript:void(0);" id="hide" class="close" title="<?php echo $lang['login_index_close_checkcode'];?>"><i></i></a><a href="JavaScript:void(0);" onclick="javascript:document.getElementById('codeimage').src='index.php?con=seccode&fun=makecode&admin=1&nchash=<?php echo getNchash();?>&t=' + Math.random();" class="change" title="<?php echo $lang['login_index_change_checkcode'];?>"><i></i></a> </div>
            <input name="captcha" type="text" required class="input-code ipt" id="captcha" placeholder="<?php echo $lang['login_index_checkcode'];?>" pattern="[A-z0-9]{4}" title="<?php echo $lang['login_index_checkcode_pattern'];?>" autocomplete="off" value="" style="width:80px;" >
                  <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
            </span>

           <span style="float: right">
            
               <a href="javascript:void(0)" style="background: #008ead;padding: 7px 10px;border-radius: 4px;border: 1px solid #1a7598;color: #FFF;font-weight: bold;font-size: 16px" class="btn-submit">登录</a>
           </span>
 
    </div>
       <div class="submit2"></div>
 
</div>
 </form>