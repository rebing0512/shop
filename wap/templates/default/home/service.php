<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<style>
    .mb_activity_list{
        width: 50%;
        margin-bottom: 2%;
        margin: 25% auto 0;
    }
    .mb_activity_list img{
        width:98%;
        padding: 0 1%;

    }
    p{
        color: black;
        text-align: center;
        padding: 10px;
        font-size: .7rem;
        margin: 5% auto 15%;
    }
    .main span{
        position: relative;
    }
    .phone img{
        vertical-align: sub;
        width:5%;
        padding: 0 2%;
    }
    .dlp{
        text-align: left;
        border-bottom: 1px #dedede solid;
        border-top: 1px #dedede solid;
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
            <h1 style="color:#890101">客服</h1>
        </div>

        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>

    </div>

    <?php include template('layout/toptip');?>

</header>
<div style="margin-top:47px;margin-bottom: 50px" class="main">
    <div  class="mb_activity_list">
            <img style="width: 98%;" border="0" src="<?php echo MOBILE_TEMPLATES_URL;?>/images/servicer.jpg">
    </div>
    <p>长按关注"福州市民间艺术馆"客服</p>
    <div style="background-color: white;color: black;font-size: .8rem;">
        <a href="tel:0591-83788999">
            <p class="dlp"><i class="phone"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/phone.png"></i><span style="left: 0;">客服电话</span><span style="position: absolute;right: 0;padding-right: 10px;color: #8e8e8e;">0591-83788999</span></p>
        </a>
    </div>
</div>

</body>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/swiper.min.js"></script>

<script>
    $(function () {
        $('.pre-loading').remove();
    })
</script>

</html>
