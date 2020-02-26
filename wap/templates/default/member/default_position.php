<?php defined('TTShop') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_member.css">

</head>

<body>

<header id="header">

    <div class="header-wrap">

        <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="back"></i> </a> </div>

        <div class="header-title">

            <h1>设置默认中心</h1>

        </div>

        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>



    </div>

    <?php include template('layout/toptip');?>



</header>

<div class="nctouch-main-layout">

    <div class="nctouch-inp-con">





        <ul class="form-box mt5">

            <li class="form-item">

                <div class="input-box" style="margin-left:0">

                    <select id="default_position" style="width: 100%;vertical-align: sub;height: 75%;">
                        <option value="0" <?php if ($output['default_position']==0){echo 'selected';}?>>买家中心</option>
                        <option value="1" <?php if ($output['default_position']==1){echo 'selected';}?>>卖家中心</option>
                    </select>

                    <span class="input-del"></span>

                </div>

            </li>

        </ul>



        <div class="form-btn ok" ><a href="javascript:void(0);" class="btn" id="default">保存</a></div>



        <div class="register-mobile-tip"> 小提示：更改进入商城的默认中心。</div>

    </div>

</div>

<footer id="footer" class="bottom"></footer>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/simple-plugin.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/member_infos.js"></script>

</body>

</html>

