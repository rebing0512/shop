<?php defined('TTShop') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="back"></i> </a> </div>
    <div class="header-title">
      <h1>提交验证码</h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="login.html" class="text">登录</a> </div>
  </div>
</header>
<div class="nctouch-main-layout fixed-Width">
  <div class="register-mobile-tip">
    <p>请输入<em id="usermobile"></em>收到的短信验证码</p>
  </div>
  <div class="nctouch-inp-con">
    <form action="" method ="">
      <ul class="form-box">
        <li class="form-item">
          <h4>验&nbsp;证&nbsp;码</h4>
          <div class="input-box">
            <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp no-follow" autocomplete="off" placeholder="输入图形验证码！" />
            <span class="input-del code"></span><a href="javascript:void(0)" id="refreshcode" class="code-img"><img border="0" id="codeimage" name="codeimage"></a>
            <input type="hidden" id="codekey" name="codekey" value="">
          </div>
        </li>
      </ul>
    </form>
    <form action="" method ="">
      <ul class="form-box mt5">
        <li class="form-item">
          <h4>动&nbsp;态&nbsp;码</h4>
          <div class="input-box">
            <input type="text" pattern="[0-9]*" placeholder="请输入短信动态验证码！" class="inp" name="mobilecode" id="mobilecode" oninput="writeClear($(this));"/>
            <span class="input-del code"></span> <span class="code-countdown" style=" display: none;">
            <p>重新获取验证码</p>
            <p>(<em>59</em>s)</p>
            </span> <span class="code-again"><a href="javascript: void(0);" id="again">再次短信获取</a></span> </div>
        </li>
      </ul>
      <div class="error-tips"></div>
      <div class="form-btn"><a href="javascript:void(0);" class="btn" id="find_password_code">下一步</a></div>
    </form>
  </div>
  <input type="hidden" name="referurl">
</div>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/simple-plugin.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/find_password_code.js"></script>
