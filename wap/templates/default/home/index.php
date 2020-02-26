<?php defined('TTShop') or exit('Access Invalid!'); ?>
<?php
function swiperLink($slide)
{

    $module = $action = $args = '';

    switch ($slide['type']) {
        case 'goods':
            $module = 'goods';
            $action = 'detail';
            $args = array('goods_id' => $slide['object']);
            return urlMobile($module, $action, $args);
            break;

        case 'store':
            $module = 'store';
            $action = 'index';
            $args = array('store_id' => $slide['object']);
            return urlMobile($module, $action, $args);
            break;

        case 'url':
            $args = $slide['object'];
            return $args;
            break;
    }


}

?>
<meta name="viewport"
      content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/index.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/swiper.min.css"/>

<style>
    body {
        -webkit-text-size-adjust: none
    }

    section {
        background-color: white;
        padding-top: 8px;
    }

    .back {
        position: relative;
        background-color: black;
        width: 98%;
        margin-top: -18%;
        height: 17%;
        opacity: 0.5;
    }

    #swiper {
        width: 100%;
    }

    #swiper > .swiper-wrapper > .swiper-slide > img {
        width: 100%;
    }

    #swiper > .swiper-wrapper > .swiper-slide {
        float: left;
    }

    #taobao {
        width: 100%;
        margin-top: .4rem;
    }

    #taobao > .swiper-wrapper > .swiper-slide > img {
        width: 100%;
    }

    #taoba > .swiper-wrapper > .swiper-slide {
        float: left;
    }

    .swiper-pagination-bullet {
        width: 4px;
        height: 4px;
    }

    .swiper-container-horizontal > .swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction {
        bottom: 3px;
    }

    .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet {
        margin: 0 2.5px;
    }

    #xiangdu {
        width: 100%;
        margin-top: .4rem;
    }

    #xiangdu > .swiper-wrapper > .swiper-slide > img {
        width: 100%;
    }

    #xiangdu > .swiper-wrapper > .swiper-slide {
        float: left;
    }

    .mbcore_inlinetext {
        /*font-weight:bolder;*/
        padding: 10px 0 20px 0;
        font-size: .5rem;
        margin-bottom: 7px;
        width: 100%;
        text-align: center;
    }

    .mbcore_inlinetext a {
        width: 23%;
        color: black;
        margin: 0;
        display: inline-block;
    }

    .mbcore_inlinetext a {
        font-size: .6rem;
        -webkit-transform: scale(0.9);
    }

    #maskLayer {
        height: 100%;
        position: fixed;
        z-index: 100;
        background-color: #000000;
        -moz-opacity: 0.5;
        filter: alpha(opacity=50);
    }

    .txt p {
        font-weight: 400;
    }

    .txt p {
        font-size: 14px;
    }

    .swiper-container3 {
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .final p {
        padding: 3%;
        padding-left: 0px;
        /*margin-left: -20px;*/
        font-size: 14px;
        height: 35px;
        overflow: hidden;
        text-overflow: ellipsis;
        /*white-space: nowrap;*/
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .g_top a {
        color: white;
        position: relative;
        font-size: 15px;
        top: 20vh;
        margin-left: 23.5vw;
    }

    .g_top img {
        width: 5%;
        vertical-align: sub;
    }

    .g_in img {
        width: 100%;
    }

    .kengdie {
        height: 100%;
        background-color: black;
        bottom: 0;
        position: fixed;
        width: 100%;
        filter: alpha(opacity=50);
        -moz-opacity: 0.5;
        -khtml-opacity: 0.5;
        opacity: 0.5;
        z-index: -1;
    }

    h3 {
        /*font-weight: bold;*/
        font-size: .7rem;
        -webkit-transform: scale(0.9);
    }

    p img {
        float: right;
        vertical-align: middle;
    }

    .dh {
        position: fixed;
        width: 100vw;
        margin: 0 auto;
        padding: 20px 0 20px 0;
        top: 7%;
        background: white;
    }

    .yimeng_camera {
        position: fixed;
        bottom: 6rem;
        right: 0.5rem;
        width: 1.1rem;
        height: 1.1rem;
        border-radius: 50%;
        padding: 0.5rem;
        /*background-color: #862627;*/
        z-index: 1000;
    }

    .yimeng_camera img {
        width: 100%;
    }

    .navd {
        background-color: white;
        padding: 0rem 0rem 0.5rem 0rem;
    }

    txt > li > a {
        font-size: .585rem;
    }

    .txt > li {
        margin-top: -0.3rem;
        padding-bottom: 0.2rem;
    }

    .navd li img {
        width: 2.1rem;
        vertical-align: middle;
        margin-bottom: -0.4rem;
    }

    .header-wrap li {
        float: left;
        width: 16.8vw;
        line-height: 2.35rem;
        font-size: .7rem;
        padding-bottom: -0.5rem;
        font-weight: normal;
    }

    .header-wrap li img {
        width: 1.25rem;
        vertical-align: middle;
        margin-top: -0.15rem;
    }

    .asd {
        position: relative;
        height: 1.95rem;
        background-color: white;
    }

    .header-wrap li li {
        width: 50%;
    }

    .header-wrap li li img {
        width: 1.3rem;
        vertical-align: middle;
    }

    .topd li {
        float: left;
        width: 15vw;
        font-size: 0.8rem;
        text-align: center;
        vertical-align: middle;
        line-height: 1.95rem;
        color: white;
    }

    .topd li img {
        width: 1.2rem;
        vertical-align: middle;
        margin-top: -0.2rem;
    }

    .topd .head_hd {
        color: #346063;
    }

    .active {
        /*color: #890101;*/
    }

    .left {
        width: 100%;
        position: relative;
        margin-left: -0.25rem;
        padding: 2px 0px;
    }

    .pic_left p {
        text-align: center;
        font-size: 0.5rem;
        -webkit-text-size-adjust: none;
        /*-webkit-transform:scale(0.8);;*/
        margin-top: -.5rem;
        color: white;
    }

    .pic_left {
        position: absolute;
        top: 1rem;
        left: 28%;
    }

    .pic_left_name {
        text-align: center;
        line-height: .7rem;
    }

    .right > ul > li > a > p {
        margin-top: -5rem;
        width: 33%;
        text-align: center;
        position: absolute;
        line-height: .7rem;
    }

    .right > ul > li > a > p {
        font-size: 0.5rem;
        -webkit-text-size-adjust: none;
    }

    i {
        float: left;
        line-height: 2.35rem;
        font-size: .4rem;
    }

    a .tag {
        width: 12vw;
    }

    .list_content {
        background-color: #f3f3f3;
        padding: 13.5px 2%;
    }

    .list_content ul li {
        float: left;
        width: 20%;
    }

    .section {
        width: 100%;
        height: 10px;
        background-color: white;
    }

    .yuan {
        position: relative;
        left: 0;
        top: 0;
        display: block;
        width: 43px;
        height: 43px;
        border-radius: 55px;
        margin: 0 auto;
        font-size: 13px;
        text-align: center;
        border: 1px solid #4d4d4d;
        color: #474b53;
    }

    .yuan span {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        width: 28px;
        word-break: break-all;
        text-align: center;
        font-size: 12px;
        -webkit-text-size-adjust: none;
        line-height: 100%;
    }

    .sup {
        /*color: #890101;*/
        /*border: 1px solid #A33D3D;*/
    }

    #taobao img {
        border: none;
        /*border-image-width: 0px !important;*/
    }

    body {
        scrollbar-base-color: #ffffff;
        scrollbar-darkshadow-color: #ffffff;
        scrollbar-highight-color: #ffffff;
        /*overflow:hidden;*/
        margin: 0;
    }

    #taobao {
        overflow: scroll;
        /*width:100%;*/
        /*height:100%;*/
        filter: chroma(color=#ffffff);
    }

    .header-wrap ul a li {
        color: #444;
    }

    .goods_tpl_price {
        color: white;
        text-align: center;
        font-size: 0.5rem;
        width: 100%;
        position: absolute;
        bottom: 1rem;
    }

    .header-wrap ul a li {
        color: #444;
    }

    .pic1 .left1 {
        position: relative;
    }

    .pic1 .left1 .pic1 {
        float: left;
        font-size: .63rem;
        max-width: 64%;
        padding-left: 0.55rem;
        padding-top: 0.9rem;
        line-height: 0.7rem;
    }

    .pic1 .left1 span {
        color: gray;
        height: 0.73rem;
        overflow: hidden;
        line-height: 1rem;
    }

    .pic1.left1 .pic2 {
        width: 60%;
        float: right;
        margin-top: 0.5rem;
    }

    .pic2 {
        position: absolute;
        right: 0.9rem;
        bottom: 0.38rem;
    }

    .pic2 img {
        width: 2rem;
        border-radius: 50%;
    }

    .pic11 {
        display: block;
        font-size: 10px;
    }

    .meirituijian {
        font-size: 23px;
        PingFang-SC-Regular, Helvetica, sans-serif !important
    }

    .meirituijian {
        font-size: 0.7rem;
        text-align: center;
        width: 100%;
        background-color: #f3f3f3;
        font-weight: normal;
        color: #666;
        padding: 0.4rem 0rem;
    }

    <?php if (!in_array($output['platform'],['ios','android']) && in_array(C('app_alias'), ['guoshizhijia', 'zhile'])) : ?>
    #newTopic {
        bottom: 3.1rem !important;
    }

    #return_top {
        bottom: 5.5rem !important;
    }

    <?php endif;?>
</style>
</head>
<body>

<div class="pre-loading">

    <div class="pre-block">

        <div class="spinner"><i></i></div>

        数据加载中...

    </div>

</div>
<!--
<div id="dropin" style="position: fixed;visibility: hidden; z-index: 100;top: 0;" class="hidden">
    <div class="g_top">
        <div class="g_in">
            <img src="<?php echo RESOURCE_SITE_URL . '/images/index_icon/first_picture.jpg'; ?>"/>
        </div>
        <div class="kengdie"></div>
        <a href="javascript:void(0);"><img src="<?php echo RESOURCE_SITE_URL . '/images/index_icon/fx.png'; ?>" /> 分享</a>
        <a href="javascript:dismissbox()"><img src="<?php echo RESOURCE_SITE_URL . '/images/index_icon/close.png'; ?>" /> 关闭</a>
    </div>
    <!--<div align="right"><a href="javascript:dismissbox()"><img src="<?php echo RESOURCE_SITE_URL . '/images/index_icon/738850985704945643.jpg'; ?>" style="margin: 0;padding: 0;width: 100vw;height: 100vh;"/></a></div>

</div>

<div id="maskLayer">
    <img src="">
</div>
-->
<!-- 次级导航 -->
<header id="header" class="transparent"
        style="top: 0;position:fixed;background-color: white;height: 2.35rem;border-bottom: 1px #f0f0f0 solid;">
    <div class="header-wrap asd nav_body" style="position:relative;height:2.35rem;">

        <ul style="margin-left: 3vw;">

            <?php if (in_array(C('app_alias'), ['guoshizhijia', 'zhile'])): ?>
                <a href="<?= urlMobile('goods', 'supermarket') ?>">
                    <li style="padding-left:1px;"><?= $output['top_nav'][0]['name'] ?></li>
                </a><i>|</i>
                <a href="javascript:;"
                   onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][1]['name'] ?>',url:'<?= $output['top_nav'][1][url] ?>',removeHeader:false})">
                    <li><?= $output['top_nav'][1]['name'] ?></li>
                </a><i>|</i>
                <a href="javascript:;"
                   onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][2]['name'] ?>',url:'<?= $output['top_nav'][2]['url'] ?>',removeHeader:false})">
                    <li><?= $output['top_nav'][2]['name'] ?></li>
                </a><i>|</i>
                <a href="<?= $output['street_url'] ?>">
                    <li style="margin-left:9px;"><?= $output['street_title'] ?></li>
                </a>
                <a href="javascript:;" data-url="<?= urlMobile('category', 'index', array('ref' => 'search')) ?>"
                   data-title="分类">
                    <li class="tag" style="margin-left:0px;padding-left: 3px;"><img
                                src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/fenlei.png"></li>
                </a>
                <a href="javascript:;" data-url="<?php echo urlMobile('goods', 'search'); ?>" data-title="搜索">
                    <li class="tag" style="margin-left:-6px;"><img style="width: 1.2rem"
                                                                   src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/search.png">
                    </li>
                </a>
            <?php else: ?>
                <a href="<?= urlMobile('goods', 'supermarket', ['__ccid' => $_GET['__ccid']]) ?>">
                    <li style="padding-left:1px;"><?= $output['top_nav'][0]['name'] ?></li>
                </a><i>|</i>
                <a href="javascript:;"
                   onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][1]['name'] ?>',url:'<?= $output['top_nav'][1]['url'] ?>',removeHeader:false})">
                    <li><?= $output['top_nav'][1]['name'] ?></li>
                </a><i>|</i>
                <a href="<?= urlMobile('index') ?>">
                    <li class="weui-row_active">商城</li>
                </a><i>|</i>
                <a href="<?= $output['street_url'] ?>">
                    <li style="margin-left:9px;"><?= $output['street_title'] ?></li>
                </a>
                <a href="javascript:;" data-url="<?= urlMobile('category', 'index', array('ref' => 'search')) ?>"
                   data-title="分类">
                    <li class="tag" style="margin-left:0px;padding-left: 3px;"><img
                                src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/fenlei.png"></li>
                </a>
                <a href="javascript:;" data-url="<?php echo urlMobile('goods', 'search'); ?>" data-title="搜索">
                    <li class="tag" style="margin-left:-6px;"><img style="width: 1.2rem"
                                                                   src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/search.png">
                    </li>
                </a>
            <?php endif; ?>


        </ul>
    </div>

    <?php include template('layout/fiexd'); ?>
</header>

<div class="daohang" style="overflow: hidden">

    <!-- swiper图片滑动 -->
    <div id="swiper" class="swiper-container"><!--style="margin-top: 1.95rem;"-->
        <div class="swiper-wrapper">
            <?php if (C('app_alias') == 'guoshizhijia'): ?>
                <div class="swiper-slide">
                    <a href="javascript:;"
                       onclick="window.MBC.openNew({pageTitle:'艺术馆',url:'https://guoshizhijiashop.confolsc.com/wap/index.php?con=shop&fun=store_street',removeHeader:false})">
                        <img style="width:100%;"
                             src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/yishuguan.jpeg">
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="javascript:;"
                       onclick="window.MBC.openNew({pageTitle:'大师坊',url:'https://guoshizhijiashop.confolsc.com/wap/index.php?con=index&fun=master&type_id=5&__ccid=11',removeHeader:true})">
                        <img style="width:100%;" src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/dashi_fang.jpeg">
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="javascript:;"
                       onclick="window.MBC.openNew({pageTitle:'掌眼',url:'https://guoshizhijiabbs.confolsc.com/zhang_eye',removeHeader:false})">
                        <img style="width:100%;"
                             src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/chazhengshu.jpeg">
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="javascript:;"
                       onclick="window.MBC.openNew({pageTitle:'附近的店',url:'https://guoshizhijiabbs.confolsc.com/circum',removeHeader:false})">
                        <img style="width:100%;" src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/fujin.jpeg">
                    </a>
                </div>


            <?php else: ?>
                <?php foreach ((array)$output['slides']['ad'] as $slide): ?>
                    <div class="swiper-slide"><a href="javascript:;" data-url="<?php echo swiperLink($slide); ?>"
                                                 data-title="<?= $slide['name'] ?>"><img style="width:100%;"
                                                                                         src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS . $slide['link_pic']; ?>"/></a>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- Add Pagination-->
        <div class="swiper-pagination"></div>
    </div>

    <!--
    <a href="<?php echo urlMobile('goods', 'search'); ?>" class="header-inp-daohang">
        <i class="icon"></i>
    </a>
-->


</div>

<div class="list_content">
    <ul class="clearfix">
        <?php foreach ((array)$output['core_category']['result']['category'] as $cate): ?>
            <li class="<?php echo $_SESSION['__ccid'] == $cate['id'] ? 'xz' : ''; ?>">
                <a href="<?php echo urlMobile('index', 'index', array('__ccid' => $cate['id'])); ?>"
                   class="yuan <?php echo $_SESSION['__ccid'] == $cate['id'] ? 'circled' : ''; ?>">
                    <span><?php echo $cate['name'];//mb_substr($cate['name'],0,2,'utf-8'); //substr($str , 0 , 5);?> </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- 精品检漏 -->
<section style="margin-top: 0px">
    <div class="top" style="overflow: hidden">
        <h3 class="left" style="max-width: 100%;">
            <a href="javascript:;" data-url="<?= $output['config'][0]['url'] ?>"
               data-title="<?= $output['config'][0]['name'] ?>">
                <?= $output['config'][0]['name'] ?>
            </a>
            <a href="javascript:;" data-url="<?= $output['config'][0]['url'] ?>"
               data-title="<?= $output['config'][0]['name'] ?>"
               style="float: right;font-size: 0.9rem;line-height: .8rem;color: #9c9c9c;margin-right: -0.7rem;">
                <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/right_r.png" style="width: .8rem;"/>
            </a>
        </h3>
    </div>
    <div class="pic" style="margin-top:.4rem; overflow: hidden">
        <div class="left" style="margin-left:0;">
            <?php if (!empty($output['slides']['mo_two'])): ?>
                <?php for ($i = 0; $i < 1; $i++): ?>
                    <a href="javascript:;" data-url="<?php echo swiperLink($output['slides']['mo_two'][$i]); ?>"
                       data-title="<?= $output['slides']['mo_two'][$i]['name'] ?>">
                        <img border="0"
                             src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS . $output['slides']['mo_two'][$i]['link_pic']; ?>"
                             alt="">
                    </a>
                    <div class="pic_left" style="width: 33.3%;left: 33.3%;">
                        <p class="pic_left_name"><?= $output['slides']['mo_two'][$i]['name'] ?>
                            <br/><span><?= $output['slides']['mo_two'][$i]['price'] ?></span>
                        <p>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
        <div class="right">
            <ul>
                <?php
                $mo_two_pic = count($output['slides']['mo_two_pic']);
                if ($mo_two_pic > 4) {
                    $mo_two_pic = 4;
                }
                for ($i = 0; $i < $mo_two_pic; $i++) {
                    ?>
                    <li>
                        <a href="javascript:;" data-url="<?php echo swiperLink($output['slides']['mo_two_pic'][$i]); ?>"
                           data-title="<?= $output['slides']['mo_two_pic'][$i]['name'] ?>">
                            <img src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS . $output['slides']['mo_two_pic'][$i]['link_pic']; ?>">
                            <p style="margin-top: -1.5rem;color:white"><?= $output['slides']['mo_two_pic'][$i]['name'] ?></p>
                            <p style="margin-top: -0.8rem;color:white"><?= $output['slides']['mo_two_pic'][$i]['price'] ?></p>
                        </a>
                    </li>
                <?php }; ?>
                <!--				--><?php //foreach ($output['goods_recommend'] as $k=>$v){?>
                <!--				<li><a href="-->
                <?php //echo urlMobile('goods','detail',array('goods_id'=>$v['goods_id']));?><!--"><img src="-->
                <?php //echo cthumb($v['goods_image'], 200);?><!--"><p>-->
                <?php //echo mb_substr($v['goods_name'],0,4);?><!--</br>-->
                <?php //echo _formatPrice($v['goods_price'],'￥');?><!--</p></a></li>-->
                <!--				--><?php //};?>
            </ul>
        </div>
        <div class="clear:both"></div>
    </div>
</section>

<section>
    <div class="week" style="overflow: hidden">
        <h3 class="left">
            <a href="javascript:;" data-url="<?= $output['config'][1]['url'] ?>"
               data-title="<?= $output['config'][1]['name'] ?>">
                <?= $output['config'][1]['name'] ?>
            </a>
            <a href="javascript:;" data-url="<?= $output['config'][1]['url'] ?>"
               data-title="<?= $output['config'][1]['name'] ?>"
               style="float: right;font-size: 0.9rem;line-height: .8rem;color: #9c9c9c;margin-right: -0.8rem;">
                <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/right_r.png" style="width: .8rem;"/>
            </a>
        </h3>
    </div>
    <!-- swiper图片滑动 -->
    <div id="taobao" class="swiper-container3"
         style="width:100%;overflow-y:hidden;overflow-x:inherit;-webkit-overflow-scrolling : touch;">
        <div class="swiper-wrapper" id="adv">
            <!--中部广告加载位置-->
        </div>
        <!--        <div class="swiper-scrollbar" id="swiper-scrollbar"></div>-->
    </div>
</section>
<!--天工开物-->
<section style="background-color:white;padding:8px 0 0 0;overflow: hidden">
    <div class="week">
        <h3 class="left">
            <a href="javascript:;">
                <?= $output['config'][2]['name'] ?>
            </a>
            <a href="javascript:;"
               style="float: right;font-size: 0.9rem;line-height: .8rem;color: #9c9c9c;margin-right: -0.8rem;">
                <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/right_r.png" style="width: .8rem;"/>
            </a>
        </h3>
    </div>
    <div style="clear: both"></div>
    <div class="pic1" style="margin-top:4px;">
        <?php if (!empty($output['slides']['mo_five'])): ?>
            <?php
            $mo_five = count($output['slides']['mo_five']);
            if ($mo_five > 4) {
                $mo_five = 4;
            }
            for ($i = 0; $i < $mo_five; $i++):?>
                <a href="javascript:void(0)" data-url="<?php echo swiperLink($output['slides']['mo_five'][$i]); ?>"
                   data-title="<?= $output['slides']['mo_five'][$i]['name'] ?>">
                    <div class="left1" style="margin-left: 0; overflow: hidden">
                        <p class="pic1"><?= $output['slides']['mo_five'][$i]['name'] ?>
                            <br/>
                            <span class="pic11"><?= $output['slides']['mo_five'][$i]['price'] ?></span>
                        </p>
                        <p class="pic2"><img
                                    src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS . $output['slides']['mo_five'][$i]['link_pic']; ?>">
                        </p>

                    </div>
                </a>
            <?php endfor; ?>
        <?php endif; ?>
        <div class="clear:both"></div>
    </div>
    <div style="clear:both;"></div>
</section>
<!-- 遇见大师 -->

<section style="overflow: hidden;padding-bottom: 8px;">
    <div class="top">
        <h3 class="left" style="max-width: 100%">
            <a href="javascript:;" data-url="<?= $output['config'][2]['url'] ?>"
               data-title="<?= $output['config'][3]['name'] ?>">
                <?= $output['config'][3]['name'] ?>
            </a>
            <a href="javascript:;" data-url="<?= $output['config'][2]['url'] ?>"
               data-title="<?= $output['config'][3]['name'] ?>"
               style="float: right;font-size: 0.9rem;line-height: .8rem;color: #9c9c9c;margin-right: -0.8rem">
                <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/right_r.png" style="width: .8rem;"/>
            </a>
        </h3>
    </div>
    <div class="pic" style="margin-top:.4rem">
        <div class="left" style="margin-left:0;">
            <?php if (!empty($output['slides']['mo_four'])): ?>
                <?php for ($i = 0; $i < 1; $i++): ?>
                    <a href="javascript:;" data-url="<?php echo swiperLink($output['slides']['mo_four'][$i]); ?>"
                       data-title="<?= $output['slides']['mo_four'][$i]['name'] ?>">
                        <img border="0"
                             src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS . $output['slides']['mo_four'][$i]['link_pic']; ?>"
                             alt="">
                    </a>
                    <div class="pic_left" style="width: 33.3%;left: 33.3%;">
                        <p class="pic_left_name"><?= $output['slides']['mo_four'][$i]['name'] ?>
                            <br/><span><?= $output['slides']['mo_four'][$i]['price'] ?></span>
                        <p>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
        <div class="right">
            <ul>
                <?php
                $mo_four_pic = count($output['slides']['mo_four_pic']);
                if ($mo_four_pic > 4) {
                    $mo_four_pic = 4;
                }
                for ($i = 0; $i < $mo_four_pic; $i++) {
                    ?>
                    <li>
                        <a href="javascript:;"
                           data-url="<?php echo swiperLink($output['slides']['mo_four_pic'][$i]); ?>"
                           data-title="<?= $output['slides']['mo_four_pic'][$i]['name'] ?>">
                            <img src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS . $output['slides']['mo_four_pic'][$i]['link_pic']; ?>">
                            <p style="margin-top: -1.5rem;color:white"><?= $output['slides']['mo_four_pic'][$i]['name'] ?></p>
                            <p style="margin-top: -0.8rem;color:white"><?= $output['slides']['mo_four_pic'][$i]['price'] ?></p>
                        </a>
                        <!--                        <div class="back">-->
                        <!---->
                        <!--                        </div>-->
                    </li>
                <?php }; ?>
            </ul>
        </div>
        <div class="clear:both"></div>
    </div>
</section>


<div class="meirituijian">每 日 推 荐</div>

<section style="background-color:white;padding:5px 0 30px 0;margin-top: 0px;overflow: hidden">
    <div class="mbcore_inlinetext" id="index-categories" style="padding: 12px 0px;">
        <?php echo $output['index_category']; ?>
    </div>
    <ul class="final">
        <?php foreach ($output['goods'] as $k => $v) { ?>
            <?php if (!empty($v['goods_id'])): ?>
                <li class="<?php echo 'type' . $v['rec_gc_id']; ?> tem">
                    <a href="javascript:void(0);"
                       data-url="<?php echo urlMobile('goods', 'detail', array('goods_id' => $v['goods_id'])); ?>"
                       data-title="<?php echo $v['goods_name']; ?>">
                        <img src="<?php echo cthumb($v['goods_image'], 360, $v['store_id']); ?>">
                    </a>
                    <p class="final_p"
                       style="padding: 2% 0 0 0;color: #525252; font-size: .5rem;font-weight: 400;height: 35px; overflow: hidden;text-overflow: ellipsis;display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        <?php echo $v['goods_name']; ?>

                    </p>
                    <span class="final_p_money weui-row_active"
                          style="font-weight: 400;margin-left: -0.8rem;margin-bottom: 0.15rem"><?php echo _formatPrice($v['goods_price'], '￥'); ?></span>
                </li>
            <?php endif; ?>
        <?php } ?>
        <div style="clear:both"></div>
    </ul>
</section>
<!--<div class="yimeng_camera"><img src="--><?php //echo RESOURCE_SITE_URL.'/images/camera.png';?><!--"></div>-->

<div class="pd_b" style="height:90px;display:block;background-color: white;z-index: 0"></div>
<!-- 底部导航 -->
<?php if (!in_array($output['client'], ['ios', 'android'])):
    require_once template('footer-nav'); ?>

    <?php if (C('app_alias') == 'hongmuzhijia'): ?>
    <div class="fix-block-r" style="bottom:5.3rem;">
        <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn" onclick="goTopBtn()"><i></i></a>
    </div>
    <div class="xzapp_footer">
    <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?= C('app_alias') ?>.jpg" class="logo1">

    <div class="content">
        <p class="content01">红木e家<span class="weui-row_active">APP</span></p>
        <p class="content02">一站式红木制品批发平台</p>
    </div>
    <a href="https://gateway.confolsc.com/services/qrPage/hongmu?from=singlemessage"
       class="download_btn weui-row_active general_border1">APP下载</a>
    <div class="xzapp_footer_ft" onclick="xzapp_footer_ft()"><i class="iconfont icon-close weui-row_active"></i></div>
<?php elseif (C('app_alias') == 'guoshizhijia'): ?>
    <div class="fix-block-r" style="bottom:3.1rem;">
        <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn" onclick="goTopBtn()"><i></i></a>
    </div>
    <!--        <div class="content">-->
    <!--            <div class="content01">国石之家</div>-->
    <!--            <div class="content02">一站式国石交流交易平台</div>-->
    <!--        </div>-->
    <!--        <a href="https://gateway.confolsc.com/services/qrPage/guoshi?from=singlemessage" class="download_btn">APP下载</a>-->

    </div>
<?php endif; ?>

<?php elseif ($output['client'] == 'ios'): ?>
    <!--插入ios样式-->
<?php endif; ?>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/template.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js?"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/addcart.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/addtohomescreen.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/pullToRefresh.js"></script>
<!-- 取消TouchSlide调用
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/TouchSlide.1.1.js"></script>-->
<script>
    var header = true;

    function _formatPrice(price) {
        if (price == 0.02) {
            return '非卖品';
        } else if (price == 0.01) {
            return '私洽';
        } else {
            return parseInt(price);
        }
    }

    var page = 4;
    var curpage = 1;
    var hasmore = true;
    var param = {};
    var ajax_running = false;
    $(document).ready(function () {
        get_list();
        $("#taobao").scroll(function () {
            var a = $("#taobao")[0].scrollWidth;
            var b = $("#taobao")[0].clientWidth;
            var c = a - b;
            var s = $("#taobao").scrollLeft();
            if (c == s) {
                get_list();
            }
        });
    });
    <?php if (!empty($output['config'][1]['store_id'])):?>
    function get_list() {
        if (ajax_running) {
            return false;
        } else {
            ajax_running = true;
        }
        if (!hasmore) {
            return false;
        }
        param.sort = 4;
        param.page = page;
        param.curpage = curpage;
        //param.type = type;
        $.getJSON(ApiUrl + "/index.php?con=store&fun=sort&store_id=<?=$output['config'][1]['store_id']?>&order=4", param, function (e) {
            if (!e) {
                e = [];
            }
            curpage++;
            hasmore = e.hasmore;
            var html = template.render('goods_tpl', e.datas);
            $('#adv').append(html);
            ajax_running = false;
            $('a[data-url]').on('click', function () {
                if ($(this).attr('data-url') != '') {
                    if ($(this).attr('data-url').indexOf(document.domain) < 0) {
                        header = false;
                    }
//                    alert($(this).attr('data-url').split('.')[1])
                    window.MBC.openNew({
                        url: $(this).attr('data-url'),
                        pageTitle: $(this).attr('data-title') || '购物',
                        removeHeader: header
                    });
                    header = true;
                    return false;
                }
            })
        })
    }
    <?php else:?>
    function get_list() {
        if (ajax_running) {
            return false;
        } else {
            ajax_running = true;
        }
        if (!hasmore) {
            return false;
        }
        param.page = page;
        param.curpage = curpage;
        //param.type = type;
        $.getJSON(ApiUrl + "/index.php?con=index&fun=adv_ajax", param, function (e) {
            if (!e) {
                e = [];
            }
            curpage++;
            hasmore = e.hasmore;
            var html = template.render('adv_tpl', e.datas);
            $('#adv').append(html);
            ajax_running = false;
            $('a[data-url]').on('click', function () {
                if ($(this).attr('data-url').indexOf(document.domain) < 0) {
                    header = false;
                }
                window.MBC.openNew({
                    url: $(this).attr('data-url'),
                    pageTitle: $(this).attr('data-title') || '购物',
                    removeHeader: header
                })
                header = true;
                return false;
            })
        })
    }
    <?php endif;?>
</script>
<script type="text/html" id="goods_tpl">
    <% for (var k in rec_goods_list) { var v = rec_goods_list[k]; %>
    <div class="swiper-slide" style="top: 1px; width: 185.5px; margin-right: 4px;" data-swiper-slide-index="1">
        <a href="javascript:;" data-url="<%=v.url%>" data-title="<%=v.goods_name%>">
            <img style="width:100%;padding: 0px; margin:0px;" src="<%=v.goods_image_url;%>">
            <p class="goods_tpl_price">
                <%=v.goods_price%>
            </p>
        </a>
    </div>
    <% } %>
</script>
<script type="text/html" id="adv_tpl">
    <% for (var k in rec_advs_list) { var v = rec_advs_list[k]; %>
    <div class="swiper-slide" style="top: 1px; width: 185.5px; margin-right: 4px;" data-swiper-slide-index="1">
        <a href="javascript:;" data-url="<%=v.url;%>" data-title="v.name">
            <img style="width:100%;padding: 0px; margin:0px;"
                 src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS; ?><%=v.link_pic;%>">
        </a>
    </div>
    <% } %>
</script>
<script type="text/javascript">
    $('.yimeng_camera').click(function () {
        window.location.href = '<?php echo urlMOBILE('category', 'index');?>';
    })
    $('.yuan').click(function () {
        $(this).addClass('weui-row_active general_border').parent().siblings().find('a').removeClass('weui-row_active general_border');
    })
</script>

<script>
    $('.index-category').click(function () {
        ik = $(this).data('ik');
        $('.final').find('li').hide();
        $('.final').find('.type' + ik).show();
    });
    $('#index-categories').find('.index-category').on('click', function () {
//        $(this).css('color','#890101').siblings().css('color','#525252');
        $(this).addClass('weui-row_active').siblings().removeClass('weui-row_active')
        var _id = $(this).data('ik');
        $('.final').find('li').each(function (i, v) {
            if ($(v).hasClass('type' + _id)) {
                $(v).show();
            } else {
                $(v).hide();
            }
        });
    });
    if ($('#index-categories').find('.index-category').eq(0).length > 0) {
        $('#index-categories').find('.index-category').eq(0).trigger('click');
    } else {
        $('.final').find('li').hide();
    }

    function goTopBtn() {
        $("body").scrollTo({toT: 0});
    };
</script>
<script>


    // .final
    var margin = 8;  //分类主图
    var padding = 4;  //图片的间隙
    new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoplay: 3000
    });
    new Swiper('.swiper-container3', {
        pagination: '.swiper-pagination3',
        paginationClickable: true,
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: true,
        slidesPerView: 2,
        spaceBetween: padding, //2,  //slide之间的距离（单位px）
        loop: true,
        autoplay: 1000,
        speed: 1500
    });
</script>
<script>
    $(function () {
        console.log('--margin--' + margin);
        console.log('--padding--' + padding);
        var window_width = $(window).width();
        var width = window_width - 2 * margin;
        var final_width = width;
        $('.final').width(width);
        $('.final').css('margin', '0px auto');

        /*
                img_height = img_width = (width-2*padding)/3;
                timg_height = img_height*2+padding;

                //左侧图片宽高
                $('.pic').find('.left').find('img').width(img_width);
                $('.pic').find('.left').find('img').height(timg_height);
                //右侧图片宽高
                $('.pic').find('.right').width(width-img_width);
                $('.pic').find('.right').find('img').width(img_width);
                $('.pic').find('.right').find('li').width(img_width);
                $('.pic').find('.right').find('img').height(img_height);
                $('.pic').find('.right').find('li').height(img_height);
                $('.pic').find('.right').find('li').css('margin-left',padding+'px');
                $('.pic').find('.right').find('li').css('margin-bottom',padding+'px');
                //右侧div定位
                var right_height = $('.pic').height();
                $('.pic').find('.right').css('margin-top',-right_height);
        */
        //s=parseFloat(s).toFixed(1);
        var img_width = (window_width - 2 * padding) / 3;
        //console.log('******img_width*****'+img_width);
        img_width = Math.floor(img_width * 10) / 10;
        //parseFloat(img_width).toPrecision(1);
        //console.log('******img_width_tofixed*****'+img_width);
        var img_height = img_width; // = (window_width-2*padding)/3;
        timg_height = img_height * 2 + padding;
        $('.pic').find('div').find('img').width(img_width);
        $('.pic').find('div').find('img').height(img_height);
        $('.pic').find('.left').find('img').height(timg_height);
        $('.pic').find('.right').find('li').width(img_width);
        //$('.pic').find('.right').find('li:nth-child(2n+1)').css('margin-left','1px');
        $('.pic').find('.right').find('li:nth-child(2n+1)').css('margin-right', padding + 'px');
        //$('.pic').find('.left').css('margin-bottom',padding+'px');
        $('.pic').find('.right').find('li').css('margin-bottom', padding + 'px');
        $('.pic').find('.right').find('li:nth-child(4n+3)').css('margin-bottom', '0px');
        $('.pic').find('.right').find('li:nth-child(4n+4)').css('margin-bottom', '0px');
        $('.pic').find('.left').find('li').css('margin-bottom', '0px');
        //宽度限定
        var left_width = img_width;
        var right_width = window_width - img_width;
        $('.pic').find('.left').attr('style', 'margin:0px; padding:0px; float:left;overflow:hidden;')
        $('.pic').find('.right').attr('style', 'margin:0px; padding:0px; float:left; margin-left:' + padding + 'px;overflow:hidden;')
        $('.pic').find('.left').width(left_width - 1);
        $('.pic').find('.right').width(right_width - padding);//+1


        var max_width = window_width;

        $('body > section').width(max_width);
        $('body > section').css('max-width', max_width + 'px');
        $('body > section').append("<div style='clear:both;'></div>");


        var final_width = (final_width - padding) / 2;
        final_width = Math.floor(final_width * 10) / 10;
        $('.final').find('li').width(final_width);
        $('.final').find('li').css('margin-bottom', padding);
        //进行right设置
        //var
        var nod = document.createElement("style");
        str = ".final>li{margin:0px;padding-bottom: 0px;}";
        nod.type = "text/css";
        if (nod.styleSheet) {         //ie下
            nod.styleSheet.cssText = str;
        } else {
            nod.innerHTML = str;       //或者写成 nod.appendChild(document.createTextNode(str))
        }
        console.log(nod);
        $('body').append(nod);

        $("#index-categories>a").each(function (index, element) {
            var dataik = $(element).attr('data-ik');
            console.log("&&&&&&&&&&" + dataik);
            //$('.final').find('li.type'+dataik+':odd').css('margin-right',padding);
            //动态

            var nod = document.createElement("style");
            str = ".final .type" + dataik + ":nth-child(odd){margin-right:" + padding + "px;}";
            nod.type = "text/css";
            if (nod.styleSheet) {         //ie下
                nod.styleSheet.cssText = str;
            } else {
                nod.innerHTML = str;       //或者写成 nod.appendChild(document.createTextNode(str))
            }
            console.log(nod);
            $('body').append(nod);

            $(".final>.type" + dataik).each(function (index, element) {
                //console.log(index);
                var yushu = index % 2;
                if (yushu == 0) {
                    $(element).css('margin-right', padding);
                }
            });

        });

        var img_width1 = (window_width - padding) / 2;
        img_width1 = Math.floor(img_width1 * 10) / 10;
        var img_height1 = img_width1 / 2;
//                timg_height1 = img_height1*1.5;

        $('.pic1').find('.left1').eq(0).width(img_width1);
        $('.pic1').find('.left1').eq(0).height(img_height1);
        //宽度限定
        var left_width1 = img_width1;
        var right_width1 = window_width - img_width1;
        $('.pic1').find('.left1').eq(0).attr('style', 'background-color: #e5e5e5;margin:0px;height: ' + img_height1 + 'px; padding:0px; float:left;overflow:hidden;margin-top:' + padding + 'px')
        $('.pic1').find('.left1').eq(0).width(left_width1);
        $('.pic1').find('.left1').eq(2).attr('style', 'background-color: #e5e5e5;margin:0px;height: ' + img_height1 + 'px; padding:0px; float:left;overflow:hidden;margin-top:' + padding + 'px')
        $('.pic1').find('.left1').eq(2).width(left_width1);
        $('.pic1').find('.left1').eq(1).attr('style', 'width:' + img_width1 + 'px;background-color: #e5e5e5;margin:0px;height: ' + img_height1 + 'px; padding:0px;float:left;overflow:hidden;margin-left:' + padding + 'px;margin-top:' + padding + 'px')
        $('.pic1').find('.left1').eq(1).width(img_width1); //+1
        $('.pic1').find('.left1').eq(3).attr('style', 'width:' + img_width1 + 'px;background-color: #e5e5e5;margin:0px;height: ' + img_height1 + 'px; padding:0px;float:left;overflow:hidden;margin-left:' + padding + 'px;margin-top:' + padding + 'px')
        $('.pic1').find('.left1').eq(3).width(img_width1); //+1


        //重新定义滚动部分的高度
        var swiper_height = $(".swiper-container3").find(".swiper-slide").css('width');
        swiper_height = parseFloat(swiper_height);
        console.log(swiper_height);
        swiper_height = Math.floor(swiper_height * 10) / 10;
        console.log(swiper_height);
        var container3_height = swiper_height - 2;
        console.log(container3_height);
        $(".swiper-container3").height(container3_height);


        $('.back').width(img_width);
        $('.back').css('bottom', -padding);
        $('.pre-loading').remove();
    });
    $('#maskLayer').click(function () {
        $(this).css('display', 'none');
    })

    function xzapp_footer_ft() {
        $('.xzapp_footer').remove();
        $('.pd_b').css('height', '50px');
        $('.fix-block-r').css('bottom', '3.1rem ');
    }

</script>
<!--<style>
section .top .left{ width:auto; max-width:200px;}
html { overflow-x: hidden; overflow-y: auto; }
</style>-->
</body>
</html>




