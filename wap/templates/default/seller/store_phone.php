<?php defined('TTShop') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_member.css">

</head>

<body>

<header id="header">

    <div class="header-wrap">

        <div class="header-l"> <a href="javascript:;"> <i class="back"></i> </a> </div>

        <div class="header-title">

            <h1><?=$output['title']?></h1>

        </div>

        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>



    </div>

    <?php include template('layout/toptip');?>



</header>

<div class="nctouch-main-layout">

    <div class="nctouch-inp-con">





        <ul class="form-box mt5">

            <?php if (trim($_GET['type'])=='phone'):?>
            <li class="form-item">



                <div class="input-box" style="margin-left:0">

                    <input type="text" id="store_phone"  name="store_phone" class="inp"  placeholder="输入您的私洽电话" oninput="writeClear($(this));" onfocus="writeClear($(this));" value="<?php echo $output['store_phone'];?>" />

                    <span class="input-del"></span>

                </div>

            </li>
            <?php elseif (trim($_GET['type'])=='intro'):?>
            <li class="form-item" style="min-height: 2.95rem;">



                <div class="input-box" style="margin-left:0">

                    <textarea id="store_description"  name="store_description" style="resize: none;" class="inp"  placeholder="输入店铺简介"><?php echo $output['store_description'];?></textarea>

                    <span class="input-del"></span>

                </div>

            </li>
            <?php endif;?>
        </ul>



        <div class="form-btn ok" ><a href="javascript:void(0);" class="btn" id="phone">完成</a></div>



        <?php
        if ($_GET['type'] == 'intro'){
            ?>
            <div class="register-mobile-tip">注意：该内容仅用于店铺分享描述。</div>
            <?php
        }
        ?>

    </div>

</div>

<footer id="footer" class="bottom"></footer>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/simple-plugin.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/seller_center.js?_=asd"></script>

<script>
    $(function () {
        $('.back').parent().click(function () {
            window.MBC.back();
            return false;
        })
    })
</script>

</body>

</html>

