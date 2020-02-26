<?php defined('TTShop') or exit('Access Invalid!'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_common.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_store.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/index.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_products_list.css">
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/jquery-weui.min.css"/>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/weui.min.css"/>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/swiper.min.css"/>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/store.css"/>
<link rel="stylesheet" href="//at.alicdn.com/t/font_qptc26yeb7oav2t9.css"/>
<script>
    var store_id = <?php echo $_GET['store_id']?>;
</script>
<style>
    .left > p {
        text-align: left;
    }

    .coll_r {
        right: 20%;
        margin-top: -90px;
        right: 0;
    }

    .left {
        width: 50%;
        margin-left: 0%;
    }

    .text > p {
        font-size: 62%;
        color: #7d7d7d;
        padding: 10px;
        line-height: 200%;
    }

    li > div > a {
        max-width: 96%;
        height: 50px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 24px;
    }

    .header-inp {
        height: 1.35rem;
    }

    .final > li {
        margin: 0.15rem 0.5%;
        font-size: 13px;
        padding-bottom: 12px;
        background-color: white;
    }

    li > div > a {
        height: 30px;
        padding-left: 0.3rem;
    }

    .weui-row .weui-col-33 {
        width: 100%;
    }

    .tab1_body .tab1_body_bd .weui-row .weui-col-33 {
        width: calc((100% - 15px * 2) / 3);
    }

    .goods-sort-inner {
        width: 100%;
        position: static;
    }

    #nav_ul li a {
        font-size: 0.55rem;
    }

    .lists .weui-col-50 {
        width: 100%;
        border-bottom: solid 0.05rem #EEE;
    }

    .lists .tab1_body_img {
        width: 4.62rem;
        height: 4.62rem;
        float: left;
        margin-right: 0.5rem;
    }

    .lists .tab1_body_text1 {
        font-size: 0.65rem;
        padding-top: 0.2rem;
    }

    .lists .tab1_body_text2 {
        font-size: 0.65rem;
    }

    .goods-sort-inner span a {
        border-top: none;
        border-bottom: solid 0.05rem #EEE;
    }
    .section-top {
        margin-top: 1.95rem;
        margin-bottom: 2rem;
    }
</style>
</head>

<body>
<?php if (in_array($output['platform'],['android','ios'])): ?>
    <header id="header" class="fixed">

        <div class="header-wrap">

            <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>

            <div class="header-title">

                <h1><?= $output['store_info']['store_name'] ?></h1>

            </div>

            <!--   <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>-->

        </div>


    </header>
<?php else:?>
    <style>
        .section-top {
            margin-top: 0;
        }
    </style>
<?php endif; ?>
<section class="section-top">
    <?php if (C('app_alias') == 'hongmuzhijia' && in_array($output['platform'], ['android'])):?>
    <!-- 红木 -->
        <div class="nav">
            <div class="weui_panel_bd">
                <a href="<?= ($output['broadcast'][2] ?: 'javascript:;') ?>" class="nav_a">
                    <div class="nav_a_l">
                        <i class="nav_a_l_thumb iconfont icon-tongzhi weui-row_active"></i>
                    </div>
                    <div class="nav_a_c">
                        <h4 class="nav_a_c_title"><?= $output['broadcast'][0] ?></h4>
                        <p class="nav_a_c_desc"><?= $output['broadcast'][1] ?></p>
                    </div>
                    <div class="nav_a_r  general_bgc" onclick="ondeskTop()">
                        创建店铺<br/>桌面图标
                    </div>
                </a>

            </div>
        </div>
    <?php else:?>
        <!-- 其他 -->
        <div class="nav">
            <div class="weui_panel_bd">
                <a href="<?= ($output['broadcast'][2] ?: 'javascript:;') ?>" class="nav_a">
                    <div class="nav_a_l">
                        <i class="nav_a_l_thumb iconfont icon-tongzhi weui-row_active"></i>
                    </div>
                    <div class="nav_a_c">
                        <h4 class="nav_a_c_title"><?= $output['broadcast'][0] ?></h4>
                        <p class="nav_a_c_desc"><?= $output['broadcast'][1] ?></p>
                    </div>
                    <div class="nav_a_r  general_bgc">
                        坚持裸照<br/>素颜呈现
                    </div>
                </a>

            </div>
        </div>
    <?php endif;?>
    <?php if ($output['store_info']['store_type'] < 4 || $output['store_info']['store_decoration_switch'] == 0): ?>
        <div class="section">
            <img src="<?php echo getStoreLogo($output['store_info']['store_banner'], 'store_banner'); ?>">

            <div class="section_img">
                <a href="javascript:;"><img src="<?= getStoreLogo($output['store_info']['store_avatar']) ?>"/></a>
                <?php if ($output['store_info']['store_type'] > 1): ?>
                    <p class="section_img2">
                        <img src="<?php
                        if ($output['store_info']['store_type'] <= 3) {
                            echo MOBILE_TEMPLATES_URL . '/images/store/11.png';
                        } elseif ($output['store_info']['store_type'] >= 4) {
                            echo MOBILE_TEMPLATES_URL . '/images/store/12.png';
                        }
                        ?>">
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="section_body">

            <div class="section_body_name"><?= $output['store_info']['store_name'] ?></div>
            <div class="section_body_text">
                <p class="section_body_text_l" id="fans"><?= $output['store_info']['store_collect'] ?>粉丝</p>
                <p class="section_body_text_r focus" data-store_id="<?= $output['store_info']['store_id'] ?>"><i
                            class="iconfont weui-row_active">&#xe6a8;</i><span
                            id="gz"><?= $output['collection'] ?></span></p>
            </div>

        </div>
    <?php elseif ($output['store_info']['store_type'] == 4 && $output['store_info']['store_decoration_switch'] != 0): ?>

        <div class="store_nav">
            <img src="<?php echo getStoreLogo($output['store_info']['store_banner'], 'store_banner'); ?>">

            <div class="store_nav_img">
                <a href="javascript:;"><img
                            src="<?php echo getStoreLogo($output['store_info']['store_avatar']); ?>"/></a>
                <?php if ($output['store_info']['store_type'] > 1): ?>
                    <p class="section_img2" style="left: 1.63rem;top: 1.42rem;">
                        <img src="<?php
                        if ($output['store_info']['store_type'] <= 3) {
                            echo MOBILE_TEMPLATES_URL . '/images/store/11.png';
                        } elseif ($output['store_info']['store_type'] >= 4) {
                            echo MOBILE_TEMPLATES_URL . '/images/store/12.png';
                        }
                        ?>">
                    </p>
                <?php endif; ?>
                <p class="store_nav_name"><?= $output['store_info']['store_name'] ?><br/>
                    <span class="store_nav_name1">钻石店铺</span>
                </p>

            </div>
            <p class="store_nav_guanzhu focus weui-row_active" data-store_id="<?= $output['store_info']['store_id'] ?>">
                <span id="gz"><?= $output['collection'] ?></span></p>
            <div class="store_nav_fensi">
                <p id="fans"><?= $output['store_info']['store_collect'] ?>粉丝</p></div>
        </div>

    <?php endif; ?>
    <div class="article">
        <div class="weui_tab" id='page-ptr-navbar'>
            <div class="weui_navbar">
                <?php if ($output['store_info']['store_type'] >= 4 && $output['store_info']['store_decoration_switch'] != 0): ?>
                    <a href='#tab1' class="weui_navbar_item weui_bar_item_on">
                        <i class="iconfont icon-dianpu"></i><br/>
                        首页推荐
                    </a>
                <?php endif; ?>
                <a href='javascript:;' data-url="<?= urlMobile('store', 'store_search', array('store_id' => $_GET['store_id'])) ?>" data-title="全部商品" class="weui_navbar_item">
                    <i class="iconfont icon-gouwu"></i><br/>
                    商品目录
                </a>
                <a href='javascript:;' data-url="<?= urlMobile('store', 'store_goods', array('store_id' => $_GET['store_id'])) ?>" data-title="全部商品" class="weui_navbar_item">
                    <i class="iconfont icon-shangpin"></i><br/>
                    全部商品
                </a>
                <a href='javascript:;' class="weui_navbar_item" id="store_phone"
                   data-phone="<?= $output['store_info']['store_phone'] ?>">
                    <i class="iconfont icon-dianhua"></i><br/>
                    联系商铺
                </a>
            </div>
            <div class="weui_tab_bd">
                <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                    <?php if ($output['store_info']['store_type'] >= 4 && $output['store_info']['store_decoration_switch'] != 0): ?>
                        <div class="swiper-container">
                            <?php if (!empty($output['store_slide']) && is_array($output['store_slide'])) { ?>
                                <div class="swiper-wrapper">
                                    <?php for ($i = 0; $i < 20; $i++) { ?>
                                        <?php if ($output['store_slide'][$i] != '') { ?>
                                            <div class="swiper-slide">
                                                <a href="<?php if ($output['store_slide_url'][$i] != '' && $output['store_slide_url'][$i] != 'https://') {
                                                    echo $output['store_slide_url'][$i];
                                                } else {
                                                    echo 'javascript:;';
                                                } ?>">
                                                    <img src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_SLIDE . DS . $output['store_slide'][$i]; ?>">
                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="tab1_nav">
                            <?php if (!empty($output['store_slide']) && is_array($output['store_slide'])) { ?>
                                <?php for ($i = 20; $i < 21; $i++) { ?>
                                    <?php if ($output['store_slide'][$i] != '') { ?>
                                        <a href="<?php if ($output['store_slide_url'][$i] != '' && $output['store_slide_url'][$i] != 'https://') {
                                            echo $output['store_slide_url'][$i];
                                        } else {
                                            echo 'javascript:;';
                                        } ?>">
                                            <img src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_SLIDE . DS . $output['store_slide'][$i]; ?>">
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="tab1_head">
                            <div class="weui-row">
                                <?php if (!empty($output['store_slide']) && is_array($output['store_slide'])) { ?>
                                    <?php for ($i = 21; $i < 25; $i++) { ?>
                                        <?php if ($output['store_slide'][$i] != '') { ?>
                                            <div class="weui-col-25">
                                                <a href="<?php if ($output['store_slide_url'][$i] != '' && $output['store_slide_url'][$i] != 'https://') {
                                                    echo $output['store_slide_url'][$i];
                                                } else {
                                                    echo 'javascript:;';
                                                } ?>">
                                                    <div class="tab1_head_img"><img
                                                                src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_SLIDE . DS . $output['store_slide'][$i]; ?>">
                                                    </div>
                                                    <span class="ss general_top"></span>
                                                    <p><?= $output['store_slide_title'][$i] ?></p>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab1_body">
                            <?php if (empty($output['store_slide'])): ?>
                                <div class="tab1_body_hd weui-row_active"
                                     style="border-top: 1px solid gainsboro;border-bottom: 1px solid gainsboro;">热卖推荐
                                </div>
                                <div class="tab1_body_ft">
                                    <div class="weui-row" style="margin: .25rem 0;background-color: white;">
                                        <?php foreach ($output['substitute_goods'] as $item): ?>
                                            <div class="weui-col-50">
                                                <a href="javascript:;"
                                                   data-url="<?php echo urlMobile('goods', 'detail', array('goods_id' => $item['goods_id'])); ?>"
                                                   data-title="<?= $item['goods_name'] ?>">
                                                    <div class="tab1_body_img"><img
                                                                src="<?php echo cthumb($item['goods_image'], 360, $item['store_id']); ?>">
                                                    </div>
                                                    <p class="tab1_body_text1"><?= $item['goods_name'] ?></p>
                                                    <p class="tab1_body_text2 weui-row_active">
                                                        <?php echo _formatPrice($item['goods_price'], '¥') ?>
                                                    </p>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="tab1_body_bd">
                                <div class="weui-row">
                                    <?php if (!empty($output['store_slide']) && is_array($output['store_slide'])) { ?>
                                        <?php for ($i = 25; $i < 28; $i++) { ?>
                                            <?php if ($output['store_slide'][$i] != '') { ?>
                                                <div class="weui-col-33">
                                                    <a href="<?php if ($output['store_slide_url'][$i] != '' && $output['store_slide_url'][$i] != 'https://') {
                                                        echo $output['store_slide_url'][$i];
                                                    } else {
                                                        echo 'javascript:;';
                                                    } ?>">
                                                        <div class="tab1_body_img"><img
                                                                    src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_SLIDE . DS . $output['store_slide'][$i]; ?>">
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab1_body_ft">
                            <?php if (!empty($output['store_slide']) && is_array($output['store_slide'])) { ?>
                                <?php for ($i = 28; $i < 86; $i += 3) { ?>
                                    <?php if ($output['store_slide'][$i] != '') { ?>
                                        <div class="tab1_body_ft_img">
                                            <a href="<?php if ($output['store_slide_url'][$i] != '' && $output['store_slide_url'][$i] != 'https://') {
                                                echo $output['store_slide_url'][$i];
                                            } else {
                                                echo 'javascript:;';
                                            } ?>">
                                                <img src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_SLIDE . DS . $output['store_slide'][$i]; ?>">
                                            </a>
                                        </div>
                                        <div class="weui-row" style="margin: 8px 0;">
                                            <?php if ($output['store_slide'][$i + 1] != '') { ?>
                                                <div class="weui-col-50">
                                                    <div class="tab1_body_img">
                                                        <a href="<?php if ($output['store_slide_url'][$i + 1] != '' && $output['store_slide_url'][$i + 1] != 'https://') {
                                                            echo $output['store_slide_url'][$i + 1];
                                                        } else {
                                                            echo 'javascript:;';
                                                        } ?>">
                                                            <img src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_SLIDE . DS . $output['store_slide'][$i + 1]; ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($output['store_slide'][$i + 2] != '') { ?>
                                                <div class="weui-col-50">
                                                    <div class="tab1_body_img">
                                                        <a href="<?php if ($output['store_slide_url'][$i + 2] != '' && $output['store_slide_url'][$i + 2] != 'https://') {
                                                            echo $output['store_slide_url'][$i + 2];
                                                        } else {
                                                            echo 'javascript:;';
                                                        } ?>">
                                                            <img src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_SLIDE . DS . $output['store_slide'][$i + 2]; ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php elseif ($output['store_info']['store_type'] < 4 || $output['store_info']['store_decoration_switch'] == 0) : ?>
                        <?php if (!empty($output['recommend_goods'])): ?>
                            <div class="tab1_body_ft">
                                <div class="weui-row" style="margin: .25rem 0;background-color: white;">
                                    <?php foreach ($output['recommend_goods'] as $item): ?>
                                        <div class="weui-col-50">
                                            <a href="javascript:;"
                                               data-url="<?php echo urlMobile('goods', 'detail', array('goods_id' => $item['goods_id'])); ?>"
                                               data-title="<?= $item['goods_name'] ?>">
                                                <div class="tab1_body_img"><img
                                                            src="<?php echo cthumb($item['goods_image'], 360, $item['store_id']); ?>">
                                                </div>
                                                <p class="tab1_body_text1"><?= $item['goods_name'] ?></p>
                                                <p class="tab1_body_text2 weui-row_active">
                                                    <?php echo _formatPrice($item['goods_price'], '¥') ?>
                                                </p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="tab1_body_ft">
                                <div class="weui-row" style="margin: .25rem 0;background-color: white;">
                                    <?php foreach ($output['substitute_goods'] as $item): ?>
                                        <div class="weui-col-50">
                                            <a href="javascript:;"
                                               data-url="<?php echo urlMobile('goods', 'detail', array('goods_id' => $item['goods_id'])); ?>"
                                               data-title="<?= $item['goods_name'] ?>">
                                                <div class="tab1_body_img"><img
                                                            src="<?php echo cthumb($item['goods_image'], 360, $item['store_id']); ?>">
                                                </div>
                                                <p class="tab1_body_text1"><?= $item['goods_name'] ?></p>
                                                <p class="tab1_body_text2 weui-row_active">
                                                    <?php echo _formatPrice($item['goods_price'], '¥') ?>
                                                </p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (C('app_alias') == 'guoshizhijia') : ?>
                        <div style="text-align: center;background-color: #b7b7b7;padding: 15px 0;">
                            <a href="javascript:;" onclick="window.MBC.openNew({pageTitle:'<?=$output['store_info']['store_name']?>',removeHeader:true,url:'<?=urlMobile('store','store_goods',['store_id' => $output['store_info']['store_id']])?>'})">
                                点击查看全部商品
                            </a>
                        </div>
                    <?php endif;?>
                </div>
                <div id="tab2" class="weui_tab_bd_item">
                    <div class="tab1_body_ft" id="all_goods">
                        <div class="goods-search-list-nav" style="position: static;">

                            <ul id="nav_ul">

                                <li>
                                    <a href="<?= urlMobile('store', 'store_search', array('store_id' => $_GET['store_id'])) ?>"
                                       class="" id="store_classify">商品分类</a></li>

                                <li><a href="javascript:void(0);" class="current" id="price">价格排序<i></i></a></li>

                                <li><a href="javascript:void(0);" id="time">时间排序<i></i></a></li>

                            </ul>

                            <div class="browse-mode"><a href="javascript:void(0);" id="show_style"><span
                                            class="browse-list"></span></a></div>

                        </div>
                        <div id="price_inner" class="goods-sort-inner hide">

                            <span><a href="javascript:void(0);" onclick="init_get_list('1')">价格从高到低<i></i></a></span>

                            <span><a href="javascript:void(0);" onclick="init_get_list('2')">价格从低到高<i></i></a></span>

                        </div>
                        <div id="time_inner" class="goods-sort-inner hide">

                            <span><a href="javascript:void(0);" onclick="init_get_list('3')">时间从前到后<i></i></a></span>

                            <span><a href="javascript:void(0);" onclick="init_get_list('4')">时间从后到前<i></i></a></span>

                        </div>

                        <div class="weui-row final grid" id="allgoods_con">

                            <!--商品模版加载位置-->
                        </div>
                    </div>
                </div>
                <div id="tab3" class="weui_tab_bd_item">
                    <?php if (!empty($output['activity_goods'])): ?>
                        <div class="tab1_body_ft">
                            <div class="weui-row" style="margin: .25rem 0;background-color: white;">
                                <?php foreach ($output['activity_goods'] as $item): ?>
                                    <div class="weui-col-50">
                                        <a href="javascript:;"
                                           data-url="<?php echo urlMobile('goods', 'detail', array('goods_id' => $item['goods_id'])); ?>"
                                           data-title="<?= $item['goods_name'] ?>">
                                            <div class="tab1_body_img"><img
                                                        src="<?php echo cthumb($item['goods_image'], 360, $item['store_id']); ?>">
                                            </div>
                                            <p class="tab1_body_text1"><?= $item['goods_name'] ?></p>
                                            <p class="tab1_body_text2 weui-row_active">
                                                <?php echo '¥' . number_format($item['sole_price'], 2, '.', ',') ?>
                                            </p>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div id="" class="weui_tab_bd_item">


                    <?php if (!empty($output['new_goods'])): ?>
                        <div class="tab1_body_ft">
                            <div class="weui-row" style="margin: .25rem 0;background-color: white;">
                                <?php foreach ($output['new_goods'] as $item): ?>
                                    <div class="weui-col-50">
                                        <a href="javascript:;"
                                           data-url="<?php echo urlMobile('goods', 'detail', array('goods_id' => $item['goods_id'])); ?>"
                                           data-title="<?= $item['goods_name'] ?>">
                                            <div class="tab1_body_img"><img
                                                        src="<?php echo cthumb($item['goods_image'], 360, $item['store_id']); ?>">
                                            </div>
                                            <p class="tab1_body_text1"><?= $item['goods_name'] ?></p>
                                            <p class="tab1_body_text2 weui-row_active">
                                                <?php echo _formatPrice($item['goods_price'], '¥') ?>
                                            </p>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="tab1_body_tt line-top">
        <div class="weui-row">
            <?php if (!empty($output['store_info']['businesscard_id'])): ?>
                <div class="weui-col-33">
                    <a href="javascript:void(0);" id="store_card"
                       data-card="<?= $output['store_info']['businesscard_id'] ?>">
                        商家名片
                    </a>
                </div>
            <?php endif; ?>
            <?php if (!empty($output['store_info']['businesscard_id']) && !empty($output['store_info']['intro'])){
                ?>
                <span>|</span>
                <style>
                    .weui-row .weui-col-33 {
                        width: calc((100% - 15px * 2) / 2);
                    }
                </style>
                <?php
            } ?>
            <?php if ($output['store_info']['intro']){
                ?>
                <div class="weui-col-33">
                    <a href="javascript:void(0);" id="intro" data-intro="<?= $output['store_info']['intro'] ?>">
                        商家介绍
                    </a>
                </div>
                <?php
            } ?>

        </div>
    </div>


    <?php if (in_array($output['platform'], ['android']) && C('app_alias') == 'guoshizhijia'):?>
        <div id="func_desk">
        </div>
    <?php endif;?>


    <div class="fix-block-share" style="bottom:2.5rem;">
        <a href="javascript:void(0);" class="" id="fullshare" onclick="fullshare()"><i></i></a>
    </div>
</section>
</body>
<script>
    //点击隐藏创建桌面图标的消息提示框
    function closePromptBox() {
        $(".prompt_box").css("display","none");
    }
</script>
<script type="text/html" id="goods_list_tpl">
    <% for (var k in rec_goods_list) { var v = rec_goods_list[k];%>
    <div class="weui-col-50">
        <a href="javascript:;" data-url="<?php echo urlMobile('goods', 'detail'); ?>&goods_id=<%=v.goods_id;%>"
           data-title="<%=v.goods_name;%>">
            <div class="tab1_body_img"><img class="asdqwe" src="<%=v.goods_image_url;%>"/></div>
            <p class="tab1_body_text1"><%=v.goods_name;%></p>
            <p class="tab1_body_text2 weui-row_active">
                <%=v.goods_price%>
            </p>
        </a>
    </div>
    <% } %>
</script>

<!-- banner tpl -->

<script type="text/html" id="store_banner_tpl">
    <div class="nctouch-store-bottom fixed-Width">
        <ul>
            <li><a id="store_intro"
                   href='<%=ApiUrl%>index.php?con=store&fun=store_intro&store_id=<%= store_info.store_id %>'>店铺介绍</a>
            </li>
            <li><a id="store_voucher" href="javascript: void(0);">免费领券</a></li>
            <li><a id="store_kefu"
                   href="http://wpa.qq.com/msgrd?v=3&amp;uin=<%= store_info.store_qq%>&amp;site=qq&amp;menu=yes">联系客服</a>
            </li>
        </ul>
    </div>
    <div class="store-top-bg"><span class="img" nc_type="store_banner_img"></span></div>
    <div class="store-top-mask"></div>
    <div class="store-avatar"><img src="<%= store_info.store_avatar %>"/></div>
    <div class="store-name"><%= store_info.store_name %></div>
    <div class="store-favorate"><a href="javascript:void(0);" id="store_collected" class="added">已收藏</a><a
                href="javascript:void(0);" id="store_notcollect">收藏</a><span class="num"><input type="hidden"
                                                                                                id="store_favornum_hide"
                                                                                                value="<%= store_info.store_collect %>"/><em
                    id="store_favornum"><%= store_info.store_collect %></em><p>粉丝</p></span>

    </div>

</script>

<!-- 轮播图 tpl -->

<script type="text/html" id="store_sliders_tpl">

    <ul class="swipe-wrap">

        <% for (var i in store_info.mb_sliders) { var s = store_info.mb_sliders[i]; %>

        <li class="item">

            <% if (s.type == 1 && s.link) { %>

            <a href="<%= s.link %>"><img alt="" src="<%= s.imgUrl %>"/></a>

            <% } else if (s.type == 2 && s.link > 0) { %>

            <a href="<%=ApiUrl%>index.php?con=goods&fun=detail&goods_id=<%= s.link %>"><img alt=""
                                                                                            src="<%= s.imgUrl %>"/></a>

            <% } else { %>

            <a href="javascript:void(0);"><img alt="" src="<%= s.imgUrl %>"/></a>

            <% } %>

        </li>

        <% } %>

    </ul>

</script>

<!-- 店铺排行榜_收藏排行 tpl -->

<script type="text/html" id="goodsrank_collect_tpl">

    <% for (var i in goods_list) { var v = goods_list[i]; %>

    <dl class="goods-item">

        <a href="<%=ApiUrl%>index.php?con=goods&fun=detail&goods_id=<%= v.goods_id %>">

            <dt><img alt="<%= v.goods_name %>" src="<%= v.goods_image_url %>"/></dt>

            <dd><span>已售<em><%= v.goods_salenum %></em></span><span>￥<em><%= v.goods_price %></em></span></dd>

        </a>

    </dl>

    <% } %>

</script>

<!-- 店铺排行榜_销量排行 tpl -->

<script type="text/html" id="goodsrank_salenum_tpl">

    <% for (var i in goods_list) { var v = goods_list[i]; %>

    <dl class="goods-item">

        <a href="<%=ApiUrl%>index.php?con=goods&fun=detail&goods_id=<%= v.goods_id %>">

            <dt><img alt="<%= v.goods_name %>" src="<%= v.goods_image_url %>"/></dt>

            <dd><span>已售<em><%= v.goods_salenum %></em></span><span>￥<em><%= v.goods_price %></em></span></dd>

        </a>

    </dl>

    <% } %>

</script>

<!-- 店主推荐 tpl -->

<script type="text/html" id="goods_recommend_tpl">

    <ul>

        <% for (var i in rec_goods_list) { var g = rec_goods_list[i]; %>

        <li class="goods-item">

            <a href="<%=ApiUrl%>index.php?con=goods&fun=detail&goods_id=<%= g.goods_id %>">

                <div class="goods-item-pic">

                    <img alt="" src="<%= g.goods_image_url %>"/>

                </div>

                <div class="goods-item-name"><%= g.goods_name %></div>

                <div class="goods-item-price">￥<em><%= g.goods_price %></em></div>

            </a>

        </li>

        <% } %>

    </ul>

</script>

<!-- 商品上新 tpl -->

<script type="text/html" id="newgoods_tpl">

    <% if(goods_list.length >0){%>

    <% for (var i in goods_list) { var v = goods_list[i]; %>

    <% if(v.goods_addtime_text_show){ %>

    <li class="addtime" addtimetext='<%=v.goods_addtime_text_show %>'>
        <time><%=v.goods_addtime_text_show %></time>
    </li>

    <% } %>

    <li class="goods-item">

        <a href="<%=ApiUrl%>index.php?con=goods&fun=detail&goods_id=<%= v.goods_id %>">

            <div class="goods-item-pic">

                <img alt="" src="<%= v.goods_image_url %>"/>

            </div>

            <div class="goods-item-name"><%= v.goods_name %></div>

            <div class="goods-item-price">￥<em><%= v.goods_price %></em></div>

        </a>

    </li>

    <% } %>

    <li class="loading">
        <div class="spinner"><i></i></div>
        商品数据读取中...
    </li>

    <% }else { %>

    <div class="nctouch-norecord search">

        <div class="norecord-ico"><i></i></div>

        <dl>

            <dt>商铺最近没有新品上架</dt>

            <dd>收藏店铺经常来逛一逛</dd>

        </dl>

    </div>

    <% } %>

</script>

<!-- 店铺活动 tpl -->

<script type="text/html" id="storeactivity_tpl">

    <% if(promotion.mansong){ var mansong = promotion.mansong %>

    <div class="store-sale-block"><a href="<%ApiUrl%>/index.php?con=store&fun=store_goods&store_id=<%=store_id %>">

            <div class="store-sale-tit"><h3><%=mansong.mansong_name %></h3>

                <time>活动时间：<%=mansong.start_time_text%> 至 <%=mansong.end_time_text%></time>

            </div>

            <div class="sotre-sale-con">

                <ul class="mjs">

                    <% for (var i in mansong.rules) { var rules = mansong.rules[i]; %>

                    <li>单笔订单消费满<em>¥<%=rules.price %></em><% if(rules.discount) { %>，立减现金<em>¥<%=rules.discount
                            %></em><% } %><% if(rules.goods_id > 0) { %>， 还可获赠品<img
                                src="<%=rules.goods_image_url %>" alt="<%=rules.mansong_goods_name %>">&nbsp;。<% }
                        %>
                    </li>

                    <% } %>

                </ul>

                <% if(mansong.remark){ %><p class="note">活动说明：<%=mansong.remark %></p><% } %>

            </div>
        </a>

    </div>

    <% } %>

    <% if(promotion.xianshi){ var xianshi = promotion.xianshi %>

    <% for (var i in xianshi) { var v = xianshi[i]; %>

    <div class="store-sale-block">

        <a href="<%ApiUrl%>/index.php?con=store&fun=store_goods&store_id=<%=store_id %>">

            <div class="store-sale-tit"><h3><%=v.xianshi_name %></h3>

                <time>活动时间：<%=v.start_time_text%> 至 <%=v.end_time_text%></time>

            </div>

            <div class="sotre-sale-con">

                <ul class="xs">

                    <li>单件活动商品满<em><%=v.lower_limit %></em>件即可享受折扣价。</li>

                </ul>

                <% if(v.xianshi_explain){ %><p class="note">活动说明：<%=v.xianshi_explain %></p><% } %>

        </a>

    </div>

    </div>

    <% } %>


    <% } %>


    <% if(promotion.length <= 0){ %>

    <div class="nctouch-norecord search">

        <div class="norecord-ico"><i></i></div>

        <dl>

            <dt>商铺最近没有促销活动</dt>

            <dd>收藏店铺经常来逛一逛</dd>

        </dl>

    </div>

    <% } %>

</script>


<script type="text/html" id="store_voucher_con_tpl">

    <div class="nctouch-bottom-mask">

        <div class="nctouch-bottom-mask-bg"></div>

        <div class="nctouch-bottom-mask-block">

            <div class="nctouch-bottom-mask-tip"><i></i>点击此处返回</div>

            <div class="nctouch-bottom-mask-top store-voucher">

                <i class="icon-store"></i>领取店铺代金券<a href="javascript:void(0);"
                                                    class="nctouch-bottom-mask-close"><i></i></a>

            </div>

            <div class="nctouch-bottom-mask-rolling">

                <div class="nctouch-bottom-mask-con">

                    <ul class="nctouch-voucher-list">

                        <% if(voucher_list.length > 0){ %>

                        <% for (var i=0; i < voucher_list.length; i++) { var v = voucher_list[i]; %>

                        <li>

                            <dl>

                                <dt class="money">面额<em><%=v.voucher_t_price %></em>元</dt>

                                <dd class="need">需消费<%=v.voucher_t_limit %>元使用</dd>

                                <dd class="time">至<%=v.voucher_t_end_date_text %>前使用</dd>

                            </dl>

                            <a href="javascript:void(0);" nc_type="getvoucher" class="btn"
                               data-tid="<%=v.voucher_t_id%>">领取</a>

                        </li>

                        <% } %>

                        <% }else{ %>

                        <div class="nctouch-norecord voucher"
                             style="position: relative; margin: 3rem auto; top: auto; left: auto; text-align: center;">

                            <div class="norecord-ico"><i></i></div>

                            <dl style="margin: 1rem 0 0;">

                                <dt style="color: #333;">暂无代金券可以领取</dt>

                                <dd>店铺代金券可享受商品折扣</dd>

                            </dl>

                        </div>

                        <% } %>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/template.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/swipe.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/simple-plugin.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.waypoints.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/ncscroll-load.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/store.js?_=<?= uniqid() ?>"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/addcart.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-weui.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/swiper.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/layer/layer.js"></script>

<!--<script type="text/javascript" src="--><?php //echo MOBILE_TEMPLATES_URL; ?><!--/js/list/product_list.js"></script>-->

<script>
    $(function () {
        $('.weui_navbar a:eq(0)').click();


    })
    $('#store_phone').click(function () {
        var phone = $(this).data('phone');
        if (!phone) {
            layer.open({
                content: '该商户没有填写联系电话',
                time: 1.5
            })
        } else {
            window.location.href = 'tel:' + phone;
        }
    });
    $('#store_card').click(function () {
        var card_id = $(this).data('card');
        if (!card_id) {
            layer.open({
                content: '该商户尚未绑定名片信息',
                time: 1.5
            })
        } else {
            window.MBC.openNew({
                pageTitle: '<?=$output['store_info']['store_name']?>',
                url: ApiUrl + '/index.php?con=store&fun=store_card&id=' + card_id
            })
        }
    });
    $('#intro').click(function () {
        var intro = $(this).data('intro');
        if (!intro) {
            layer.open({
                content: '该商户尚未编辑店铺简介',
                time: 1.5
            })
        } else {
            window.MBC.openNew({
                pageTitle: '<?=$output['store_info']['store_name']?>',
                url: intro
            })
        }
    });
    //    tab2里边的筛选js
    $("#price").click(function () {

        if ($("#price_inner").hasClass("hide")) {

            $("#price_inner").removeClass("hide");

            $('#time_inner').addClass('hide');

        } else {

            $("#price_inner").addClass("hide")

        }

    });
    $("#time").click(function () {

        if ($("#time_inner").hasClass("hide")) {

            $("#time_inner").removeClass("hide")
            $('#price_inner').addClass('hide');
        } else {

            $("#time_inner").addClass("hide")

        }

    });
    //    $("#nav_ul").find("a").click(function() {
    //
    //        $(this).addClass("current").parent().siblings().find("a").removeClass("current");
    //
    //        if (!$("#price_inner").hasClass("hide") && $(this).parent().index() > 0) {
    //
    //            $("#price_inner").addClass("hide")
    //
    //        }
    //
    //    });
    $("#price_inner").find("a").click(function () {

        $("#price_inner").addClass("hide").find("a").removeClass("cur");

        var e = $(this).addClass("cur").text();

        $("#price").html(e + "<i></i>")

    });

    $("#time_inner").find("a").click(function () {

        $("#time_inner").addClass("hide").find("a").removeClass("cur");

        var e = $(this).addClass("cur").text();

        $("#time").html(e + "<i></i>")

    });
    $("#show_style").click(function () {

        if ($("#allgoods_con").hasClass("grid")) {

            $(this).find("span").removeClass("browse-list").addClass("browse-grid");

            $("#allgoods_con").removeClass("grid").addClass("lists")

        } else {

            $(this).find("span").addClass("browse-list").removeClass("browse-grid");

            $("#allgoods_con").addClass("grid").removeClass("lists")

        }

    });


</script>

<script>
$(function () {
    window.MBC.getAppVersion({
        success: function (data) {
            var version = JSON.parse('<?= C('app_version') ?>');
            if (version.indexOf(data) > -1){
                console.log(data);
                var html = "<div class=\"fix-block-share\" style=\"bottom:5.5rem;\">\n" +
                    "<a href=\"javascript:void(0);\" class=\"\" id=\"ondeskTop\" onclick=\"ondeskTop()\"><i></i></a>\n" +
                    "</div>\n"+
                    "<div class=\"prompt_box\">\n" +
                    "<div class=\"imgWrapper\">\n" +
                    "<img src=\"<?php echo MOBILE_TEMPLATES_URL; ?>/images/prompt_message.png\">\n" +
                    "<a href=\"javascript:;\" onclick=\"closePromptBox()\" class=\"closeMsgBtn\">\n" +
                    "<img src=\"<?php echo MOBILE_TEMPLATES_URL; ?>/images/close_img.png\">\n" +
                    "</a>\n"+
                    "</div>\n"+
                    "</div>";
                $('#func_desk').append(html);
            }
        }
    })
})

</script>

<script type="text/javascript">
    $(".swiper-container").swiper({
        pagination: ".swiper-pagination",
        loop: true,
        autoplay: 3000
    });
    function fullshare() {
        var scfg = {
            title:'<?=$output['store_info']['store_name']?>',
            image:'<?= getStoreLogo($output['store_info']['store_avatar']) ?>' || '<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?=C('app_alias')?>.jpg',
            url:get_share_url(window.location.href),
            description:'<?=$output['store_info']['store_description']?>'||'<?=$output['store_info']['store_name']?>的店铺',
            success:function (rd) {
                $('.share-mask').remove();
                try{
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
    function ondeskTop() {
        var scfg = {
            title:'<?=$output['store_info']['store_name']?>',
            image:'<?= getStoreLogo($output['store_info']['store_avatar']) ?>' || '<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?=C('app_alias')?>.jpg',
            url:get_share_url(window.location.href),
            removeHeader: true,
            success:function (rd) {
                layer.open({
                    content: '添加桌面成功',
                    time: 1.5
                })
            }
        };
        window.MBC.ondesk(scfg);
    }
</script>
