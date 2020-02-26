<?php defined('TTShop') or exit('Access Invalid!'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>店铺街</title>
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/swiper.min.css"/>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        ul {
            list-style: none;
        }

        html {
            font-size: 12px;
        }

        body {
            -webkit-text-size-adjust: none
        }

        html,
        body {
            color: #555;
            overflow: -Scroll;
            overflow-x: hidden;
            background-color: whitesmoke;

        }

        header {
            /*background-color: #335F62;*/
            width: 100%;
            height: 2.35rem;
            z-index: 1000;
            /*position: relative;*/
        }

        a {
            color: #2a2a2a;
            text-decoration: none;
            font-size: 16px;
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

        .swiper-container-horizontal > .swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction {
            bottom: 3px;
        }

        .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet {
            margin: 0 2.5px;
        }

        .swiper-pagination-bullet {
            width: 4px;
            height: 4px;
        }

        .simu-brand {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 999;
            -webkit-overflow-scrolling: touch;
        }

        .simu-brand dl {
            width: 100%;
            height: 100%;
            overflow: auto;
            overflow-x: hidden;
            position: relative;
        }

        .simu-brand dl dt {
            display: block;
            width: 100%;
            background: #f3f3f3;
            height: 31px;
            padding-left: 12px;
            line-height: 1.75rem;
            font-size: .6rem;
        }

        .simu-brand img {
            width: 40px;
            vertical-align: middle;
            margin-right: .5rem;
        }

        .simu-brand dl dd {
            display: block;
            /*width: 100%;*/
            padding: 10px 0;
            font-size: 14px;
            text-indent: 8px;
            border-bottom: 1px solid #f5f5f5;
            margin-right: 1rem;
        }

        .simu-brand .letter-abc a {
            display: block;
            font-size: 12px;
            text-align: center;
            cursor: pointer;
            font-weight: 400;
            line-height: 18px;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .simu-brand .letter-abc {
            position: fixed;
            right: 0;
            top: 6rem;
            margin-right: 5px;
        }

        .store_street {
            clear: both;
            /*width: 100%;*/
            height: 1rem;
            text-align: left;
            padding: 0.5rem 6vw 0;
            font-size: 15.5px;
            background-color: white;
            padding-top: 0.7rem;
            margin-right: 1.25rem;
        }

        .store_street_1 {
            border-top: 1px solid #E7E7E7;
            padding-top: 0.6rem;
            padding-bottom: 3px;
        }

        .weui-row_store1 {
            padding: 0 1vw 10px;

        }

        .weui-row_store1 .weui-col-20 {
            width: 16%;
            text-align: center;
            float: left;
            margin: 9px 2% 13px 2%;
        }

        .weui-row_store1 .weui-col-20 img {

            width: 100%;
            height: 100%;
            border-radius: 10%;
            margin: 0;
        }

        header, .header {
            border: none;
        }

        .asdf {
            display: block;
        }

        .title {
            font-size: 12px;
            -webkit-transform: scale(0.6);
        }

        .navd {
            background-color: white;
            padding: 0.2rem 0rem 0.5rem 0rem;
        }

        .navd li img {
            width: 1.6rem;
            vertical-align: middle;
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

        i {
            float: left;
            line-height: 2.35rem;
            font-size: .4rem;
        }

        .topd .head_hd {
            color: #346063;
        }

        a .tag {
            width: 12vw;
        }

        .weui-col-10 {
            width: 18%;
            text-align: center;
            float: left;
            margin: 5px 3% 10px;
        }

        .weui-row_store1 .weui-col-10 img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            margin: 0;
        }

        .section_nav_img1 {
            margin-top: 2.35rem;
            text-align: center;
            width: 100%;
        }

        .section_nav_img1 img {
            width: 100%;
        }

        .list_content {
            background-color: #f3f3f3;
            padding: 13.5px 2%;
        }

        .list_content ul li {
            float: left;
            width: 20%;
        }

        .yuan {
            position: relative;
            left: 0;
            top: 0;
            display: block;
            width: 43px;
            height: 43px;
            border: 1px solid #4d4d4d;
            border-radius: 55px;
            margin: 0 auto;
            font-size: 13px;
            text-align: center;
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
            line-height: 100%;
        }

        .remen {
            clear: both;
            width: 100%;
            height: 2px;
            background-color: white;
        }

        .remen1 {
            height: 11px;
        }

        @media only screen and (max-width: 320px) {
            .weui-row_store1 {
                padding: 0 0vw 10px;

            }
        }

        .header-wrap ul a li {
            color: #444;
        }

        <?php if (in_array($output['platform'],['ios'])): ?>
        @media only screen and (min-width: 320px) {
            .simu-brand .letter-abc {
                top: 4rem !important;
            }
        }

        <?php endif; ?>
    </style>
</head>

<body>
<?php if ((trim($_GET['type']) == 'dp') || (!$_GET['type'])): ?>
    <header id="header" class="transparent"
            style="top: 0;position:fixed;background-color: white;height: 2.35rem;border-bottom: 1px #f0f0f0 solid;">
        <div class="header-wrap asd nav_body" style="position:relative;height:2.35rem;">

            <ul style="margin-left: 3vw;">
                <?php if (in_array(C('app_alias'), ['guoshizhijia', 'zhile'])):?>
                    <a href="<?=urlMobile('goods', 'supermarket')?>">
                        <li style="padding-left:1px;"><?= $output['top_nav'][0]['name'] ?></li>
                    </a><i>|</i>
                    <!--                <a href="--><? //=$output['sale_url']?><!--"><li>拍卖</li></a><i>|</i>-->
                    <a href="javascript:;"
                       onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][1]['name'] ?>',url:'<?= $output['top_nav'][1]['url'] ?>',removeHeader:false})">
                        <li><?= $output['top_nav'][1]['name'] ?></li>
                    </a><i>|</i>
                    <a href="javascript:;"
                       onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][2]['name'] ?>',url:'<?= $output['top_nav'][2]['url'] ?>',removeHeader:false})">
                        <li><?= $output['top_nav'][2]['name'] ?></li>
                    </a><i>|</i>
                    <a href="<?= $output['street_url'] ?>">
                        <li class="weui-row_active" style="margin-left:9px;"><?= $output['street_title'] ?></li>
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
                <?php else:?>
                    <a href="<?= urlMobile('goods', 'supermarket', ['__ccid' => $_GET['__ccid']]) ?>">
                        <li style="padding-left:1px;"><?= $output['top_nav'][0]['name'] ?></li>
                    </a><i>|</i>
                    <!--                <a href="--><? //=$output['sale_url']?><!--"><li>拍卖</li></a><i>|</i>-->
                    <a href="javascript:;"
                       onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][1]['name'] ?>',url:'<?= $output['top_nav'][1]['url'] ?>',removeHeader:false})">
                        <li><?= $output['top_nav'][1]['name'] ?></li>
                    </a><i>|</i>
                    <a href="<?=urlMobile('index')?>">
                        <li>商城</li>
                    </a><i>|</i>
                    <a href="<?= $output['street_url'] ?>">
                        <li class="weui-row_active" style="margin-left:9px;"><?= $output['street_title'] ?></li>
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
                <?php endif;?>

            </ul>
        </div>
    </header>
<?php endif; ?>
<section class="secction_xinxiu simu-brand">
    <dl class="brand-dl abe-fr">
        <div class="section_nav_img1" id="tgidaa">
            <?php if (C('app_alias') == 'guoshizhijia'): ?>
                <div id="swiper" class="swiper-container"><!--style="margin-top: 1.95rem;"-->
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="javascript:;" onclick="window.MBC.openNew({pageTitle:'免费开店',url:'https://weixin.confolsc.com/index.php?act=view&op=details&article_id=910&domain=https://guoshizhijia.confolsc.com',removeHeader:false})">
                                <img style="width:100%;"
                                     src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/freeopen.jpeg"/>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:;" onclick="window.MBC.openNew({pageTitle:'大师坊',url:'https://guoshizhijiashop.confolsc.com/wap/index.php?con=index&fun=master&type_id=5&__ccid=11&domain=https://guoshizhijia.confolsc.com',removeHeader:false})">
                                <img style="width:100%;"
                                     src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/dashifang.jpeg"/>
                            </a>
                        </div>
                    </div>
                    <!-- Add Pagination-->
                    <div class="swiper-pagination"></div>
                </div>
            <?php elseif (C('app_alias') == 'hongmuzhijia'): ?>
                <img src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/banner.jpg">
            <?php endif; ?>
        </div>
        <div class="list_content" style="clear: both;">
            <ul class="clearfix" style="padding-right: 1rem;padding-left: 0.37rem;">
                <?php foreach ((array)$output['core_category']['result']['category'] as $cate): ?>
                    <li class="<?php echo $_SESSION['__ccid'] == $cate['id'] ? 'xz' : ''; ?>">
                        <a href="<?php echo urlMobile('shop', 'store_street', array('__ccid' => $cate['id'], 'type' => $_GET['type'])); ?>"
                           class="yuan <?php echo $_SESSION['__ccid'] == $cate['id'] ? 'circled' : ''; ?>">
                            <span><?php echo $cate['name'];//mb_substr($cate['name'],0,2,'utf-8'); //substr($str , 0 , 5);?> </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php if (!empty($output['hot_brand'])): ?>
            <div class="store_street" id="tgidaa">名铺推荐</div>
            <div class="weui-row weui-row_store1 weui-no-gutter" style="padding-right: .95rem;">
                <?php foreach ($output['hot_brand'] as $item): ?>
                    <div class="weui-col-20">
                        <a class="asdf" href="javascript:;" data-url="<?= $item['url'] ?>"
                           data-title="<?= $item['name'] ?>" data-removeHeader="<?= $item['app_title'] ?>">
                            <img class="lazyload" data-original="<?php echo UPLOAD_SITE_URL . DS . 'contacts' . DS . (empty($item['picture']) ? 'default.png' : $item['picture']); ?>">
                            <span class="title"><?= mb_substr($item['name'], 0, 4, 'UTF-8') ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
                <!--            <div class="remen"></div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://h5.youzan.com/v2/showcase/homepage?kdt_id=47999&source=yzapp&reft=1489171034752&spm=mars20002&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/sf.png">-->
                <!--                    <span class="title">三福</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotgoods?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/kfl.png">-->
                <!--                    <span class="title">凯丰里</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://h5.youzan.com/v2/showcase/homepage?kdt_id=179049&source=yzapp&reft=1489171083158&spm=mars20002&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/ly.png">-->
                <!--                    <span class="title">鲁艺</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/djzj.png">-->
                <!--                    <span class="title">大家之家</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotgoods?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/gpx.png">-->
                <!--                    <span class="title">贡品轩</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://h5.youzan.com/v2/showcase/homepage?kdt_id=179049&source=yzapp&reft=1489171083158&spm=mars20002&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/hg.png">-->
                <!--                    <span class="title">怀古</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/ysmy.png">-->
                <!--                    <span class="title">颜氏木艺</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/fhsj.png">-->
                <!--                    <span class="title">福辉世家</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/xl.png">-->
                <!--                    <span class="title">协立</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-20">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/hmhj.png">-->
                <!--                    <span class="title">华名华居</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <div class="remen"></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($output['hot_type'])): ?>
            <div class="store_street store_street_1">热点匠人</div>
            <div class="weui-row weui-row_store1 weui-no-gutter" style="padding-bottom: 0;">
                <?php foreach ($output['hot_type'] as $item): ?>
                    <div class="weui-col-10">
                        <a class="asdf" href="javascript:;" data-url="<?= $item['url'] ?>"
                           data-title="<?= $item['name'] ?>" data-removeHeader="<?= $item['app_title'] ?>">
                            <img class="lazyload" data-original="<?php echo UPLOAD_SITE_URL . DS . 'contacts' . DS . (empty($item['picture']) ? 'default.png' : $item['picture']); ?>">
                            <span class="title"><?= mb_substr($item['name'], 0, 4, 'UTF-8') ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://h5.youzan.com/v2/showcase/homepage?kdt_id=47999&source=yzapp&reft=1489171034752&spm=mars20002&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/1.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotgoods?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/2.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://h5.youzan.com/v2/showcase/homepage?kdt_id=179049&source=yzapp&reft=1489171083158&spm=mars20002&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/3.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/4.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotgoods?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/5.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://h5.youzan.com/v2/showcase/homepage?kdt_id=179049&source=yzapp&reft=1489171083158&spm=mars20002&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/6.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/7.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="weui-col-10">-->
                <!--                <a class="asdf" href="https://maijia.youzan.com/mars/rank/hotshops?source=yzapp&sf=wx_menu">-->
                <!--                    <img src="https://mushop.confolsc.com/data/upload/contacts/8.jpg">-->
                <!--                    <span class="title">沙发</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <div class="remen remen1"></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($output['hot_new'])): ?>
            <div class="store_street " style="padding-top: 0.6rem;">最新上线</div>
            <div class="weui-row weui-row_store1 weui-no-gutter" style="padding-right: 1rem;">
                <?php foreach ($output['hot_new'] as $item): ?>
                    <div class="weui-col-20">
                        <a class="asdf" href="javascript:;" data-url="<?= $item['url'] ?>"
                           data-title="<?= $item['name'] ?>" data-removeHeader="<?= $item['app_title'] ?>">
                            <img  class="lazyload" data-original="<?php echo UPLOAD_SITE_URL . DS . 'contacts' . DS . (empty($item['picture']) ? 'default.png' : $item['picture']); ?>">
                            <span class="title"><?= mb_substr($item['name'], 0, 4, 'UTF-8') ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
                <div class="remen"></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($output['null'])): ?>
            <p style="text-align: center;"><?= $output['null'] ?></p>
        <?php endif; ?>
        <?php if (!empty($output['list'])): foreach ($output['list'] as $k => $v) { ?>

            <dt style="clear: both;">

                <a id="tgid<?php echo $k; ?>" style="vertical-align: super;line-height: 1.2rem;">

                    <?php echo $k; ?>

                </a>

            </dt>

            <?php foreach ($v as $value) { ?>

                <dd>

                    <a href="javascript:;" data-url="<?= $value['url'] ?>" data-title="<?php echo $value['name'] ?>"
                       data-removeHeader="<?= $value['app_title'] ?>">

                        <img class="lazyload" data-original="<?php echo UPLOAD_SITE_URL . DS . 'contacts' . DS . (empty($value['picture']) ? 'default.png' : $value['picture']); ?>">

                        <?php echo $value['name'] ?>

                    </a>
                </dd>

            <?php } ?>

        <?php } endif; ?>
        <div class="letter-abc abe-fl">
            <a id="idaa">↑</a>
            <?php if (!empty($output['list'])): foreach ($output['list'] as $k => $v) { ?>

                <a id="id<?php echo $k; ?>"><?php echo $k; ?></a>

            <?php } endif; ?>

        </div>
        <?php if (in_array($output['platform'], ['ios'])): ?>
            <div style="height: 56px;width: 100%;"></div>
        <?php endif; ?>
        <?php if (in_array($output['platform'], ['wechat', 'pc', 'iphone-wap', 'android-wap'])) { ?>
            <div class="fix-block-share" style="bottom:1rem;">
                <a href="javascript:void(0);" class="" id="fullshare" onclick="fullshare()"><i></i></a>
            </div>
        <?php } elseif ($output['platform'] == 'android') { ?>
            <div class="fix-block-share" style="bottom:0.6rem;">
                <a href="javascript:void(0);" class="" id="fullshare" onclick="fullshare()"> <i></i></a>
            </div>
        <?php } elseif ($output['platform'] == 'ios') { ?>
            <div class="fix-block-share" style="bottom:2.8rem;">
                <a href="javascript:void(0);" class="" id="fullshare" onclick="fullshare()"><i></i></a>
            </div>
        <?php } ?>

</section>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-2.1.0.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/layer/layer.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/lazyload.min.js"></script>
<?php if (in_array($output['platform'], ['wechat', 'pc', 'iphone-wap', 'android-wap'])) { ?>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type='text/javascript' src='https://mbcsc.confolsc.com/wx_js.php?alias=<?= C('app_alias') ?>'></script>
    <script type='text/javascript'
            src='https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/wechat.js?_=<?= uniqid() ?>'></script>
<?php } elseif ($output['platform'] == 'android'){ ?>
    <script type="text/javascript" src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/webview.js"></script>
    <script type="text/javasctipt"
            src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/WebViewJavascriptBridge.js"></script>
    <script type="text/javascript"
            src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/MBCore.js?_=<?= uniqid() ?>"></script>
<?php } elseif ($output['platform'] == 'ios'){ ?>
    <script type="text/javascript"
            src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/webView_ios.js"></script>
    <script type="text/javascript"
            src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/MBCore.js?_=<?= uniqid() ?>"></script>
<?php } ?>
<script type="text/javascript">
    $(function () {

        $("img.lazyload").lazyload({
            effect : "show",
            threshold:200,
            container: $(".brand-dl")
        });

        $('a[data-url]').on('click', function () {
            var removeHeader;
            if ($(this).attr('data-removeheader') == 1){
                removeHeader = true;
            } else {
                removeHeader = false;
            }
            window.MBC.openNew({
                url: $(this).attr('data-url'),
                pageTitle: $(this).attr('data-title') || '店铺街',
                removeHeader: removeHeader
            });
            return false;
        })
    });
    var client = getQueryString('type');
    $(document).ready(function (e) {
        $(".letter-abc a").click(function () {
            var id = $(this).attr("id");
            var tgid = 'tg' + id;
            var tgtop = $("#" + tgid).position().top + $(".brand-dl").scrollTop() - $("#header").height();
            $(".brand-dl").animate({
                scrollTop: tgtop
            }, 500);
        });
    });
    console.log(client);
    $(function () {
        if ((client != 'dp') && (client)) {
            $('.section_nav_img1').css('margin-top', 0);
        }
        new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 3000
        });
    })

    function fullshare() {
        var scfg = {
            title: '<?= $output['street_title'] ?>',
            image: '<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?=C('app_alias')?>.jpg',
            url: get_share_url(window.location.href),
            description: '<?= $output['street_title'] ?>首页',
            success: function (rd) {
                $('.share-mask').remove();
                try {
                    if (typeof(rd) !== 'object')
                        rd = JSON.parse(rd);
                    if (rd.code == 0) {
                        layer.open({
                            content: '分享失败',
                            time: 1.5
                        })
                        return false;
                    } else {
                        layer.open({
                            content: '分享成功',
                            time: 1.5
                        })
                    }
                } catch (e) {
                    layer.open({
                        content: '取消分享',
                        time: 1.5
                    })
                }
            }
        };

        window.MBC.share(scfg);
    }
</script>
</body>

</html>