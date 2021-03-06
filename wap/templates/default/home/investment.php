<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <style>
        .mb_activity_list img{
            width:98%;

        }
        .tupianshuoming{
            width: 100%;
            height: 30px;
            background-color: rgba(255,255,255,0.3);
            font-size: 0.7rem;
            padding-left: 10px;
            position: absolute;
            bottom: 0px;
            color: white;
            line-height: 30px;
        }
        .mb_activity_list {
            width: 100%;
            margin-bottom: 10px;
            position: relative;
        }
    </style>
    </head>
    <body>
    <div class="pre-loading">

        <div class="pre-block">

            <div class="spinner"><i></i></div>

            数据加载中...

        </div>

    </div>
    <header id="header" class="fixed">

        <div class="header-wrap">

            <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>

            <!--<div class="header-tab"><a href="<?php echo urlMobile('shop');?>" class="cur">所有店铺</a><a href="<?php echo urlMobile('shop','shopclass');?>">店铺分类</a></div>-->

            <div class="header-title">
                <h1 style="color:#890101">巧匠营</h1>
            </div>
<!--
            <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>
-->
        </div>

        <?php include template('layout/toptip');?>

    </header>
    <div style="margin-top:47px;background-color:white;margin-bottom: 50px" class="main">
        <div  class="mb_activity_list">
            <?php echo loadadv(172);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(182);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(183);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(184);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(200);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(201);?>
        </div>
    </div>

<?php require_once template('footer-nav'); ?>
    </body>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/swiper.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/addtohomescreen.js"></script>
<script>
    $(function () {
        $('.main img').height('');
        $('.mb_activity_list').find('a').find('img').width('100%');
        $('.pre-loading').remove();
    })
</script>
</html>
