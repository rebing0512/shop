<?php defined('TTShop') or exit('Access Invalid!'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_common.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_store.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/index.css">

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-2.1.0.js"></script>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/jquery-weui.min.css"/>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/weui.min.css"/>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/swiper.min.css"/>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/store.css"/>
<link rel="stylesheet" href="//at.alicdn.com/t/font_y2p1v4h3bvg0t3xr.css"/>
<style type="text/css">
    body {
        color: #444;
        background-color: #2D3132 !important;
    }
</style>
</head>

<body>
<div class="body">
    <div class="store_header">
        <div class="store_header_l" id="phone_icon" data-phone="<?php if (!empty($output['card_info']['store_id'])) {
            if (empty($output['store_info']['store_phone'])) {
                echo $output['card_info']['phone'];
            } else {
                echo $output['store_info']['store_phone'];
            }
        } else {
            echo $output['card_info']['phone'];
        } ?>"><i class="iconfont icon-icon"></i></div>
        <div class="store_header_c">

            <a href="javascript:;"><img src="<?= $output['card_info']['picture'] ?>"/></a>
            <?php if (!empty($output['card_info']['store_id'])): ?>
                <p class="section_img2">
                    <img src="<?php echo MOBILE_TEMPLATES_URL . (empty($output['store_info']['store_type']) ? '/images/store/11.png' : '/images/store/12.png'); ?>">
                </p>
            <?php endif; ?>
        </div>
        <div class="store_header_r"><i class="iconfont icon-erweima"></i></div>
    </div>
    <div class="stores_nav">
        <div class="stores_nav_name"><?= $output['card_info']['name'] ?></div>
        <div class="stores_nav_text"><?= $output['card_info']['title'] ?></div>
    </div>
    <div class="store_body">
        <div class="store_body_hd">
            <div class="weui_panel" style="background-color: rgb(255, 255, 255, 0)">
                <div class="weui_panel_bd">
                    <div class="weui_media_box weui_media_small_appmsg">
                        <div class="weui_cells weui_cells_access" style="background-color: rgb(255, 255, 255, 0)">
                            <a class="weui_cell line-bottom" href="javascript:;">
                                <div class="weui_cell_hd">公司名称</div>
                                <div class="weui_cell_bd weui_cell_primary">
                                    <p><?php echo $output['card_info']['company_name'] ?></p>
                                </div>
                            </a>
                            <a class="weui_cell line-bottom" href="javascript:;"
                                <?php if (!empty($output['card_info']['store_id']) && !empty($output['addr'])) {
                                    ?>
                                    id="open_location" data-lat="<?= $output['addr']['baidu_lat'] ?>" data-lng="<?= $output['addr']['baidu_lng'] ?>" data-name="<?= $output['addr']['name_info'] ?>" data-address="<?= $output['addr']['address_info'] ?>"
                                    <?php
                                } else {
                                    echo 'javascript:;';
                                } ?>>

                                <?php if (!empty($output['card_info']['store_id']) && !empty($output['addr'])): ?>
                                    <div class="weui_cell_hd square_wrapper_icon"><i class="iconfont icon-map_line"></i></div>
                                    <div class="weui_cell_bd weui_cell_primary" id="address">
                                        <p><?php if (!empty($output['card_info']['store_id'])) {
                                                if (empty($output['addr'])) {
                                                    echo $output['card_info']['company_addr'];
                                                } else {
                                                    echo $output['addr']['address_info'];
                                                }
                                            } else {
                                                echo $output['card_info']['company_addr'];
                                            } ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="weui_cell_hd">公司地址</div>
                                    <div class="weui_cell_bd weui_cell_primary" id="address">
                                        <p><?php if (!empty($output['card_info']['store_id'])) {
                                                if (empty($output['addr'])) {
                                                    echo $output['card_info']['company_addr'];
                                                } else {
                                                    echo $output['addr']['address_info'];
                                                }
                                            } else {
                                                echo $output['card_info']['company_addr'];
                                            } ?></p>
                                    </div>
                                <?php endif;?>
                            </a>
                            <a class="weui_cell line-bottom" href="javascript:;">
                                <div class="weui_cell_hd">手机号码</div>
                                <div class="weui_cell_bd weui_cell_primary">
                                    <p><?php if (!empty($output['card_info']['store_id'])) {
                                            if (empty($output['store_info']['store_phone'])) {
                                                echo $output['card_info']['phone'];
                                            } else {
                                                echo $output['store_info']['store_phone'];
                                            }
                                        } else {
                                            echo $output['card_info']['phone'];
                                        } ?></p>
                                </div>
                            </a>
                            <a class="weui_cell line-bottom" href="javascript:;">
                                <div class="weui_cell_hd">微信号</div>
                                <div class="weui_cell_bd weui_cell_primary">
                                    <p><?= $output['card_info']['weixin'] ?></p>
                                </div>
                            </a>
                            <a class="weui_cell weui_cell_last" href="javascript:void(0);"
                               <?php if (!empty($output['card_info']['store_id'])): ?>data-url="<?= urlMobile('store', 'index', array('store_id' => $output['card_info']['store_id'])) ?>"<?php endif; ?>>
                                <div class="weui_cell_hd square_wrapper_icon"><i class="iconfont icon-home"></i></div>
                                <div class="weui_cell_bd weui_cell_primary">
                                    <p class="weui_cell_last_text"><?php if (!empty($output['card_info']['store_id'])) {
                                            echo $output['store_info']['store_name'];
                                        } else {
                                            echo $output['card_info']['store_name'];
                                        } ?></p>
                                    <p class="weui_cell_last_txt"><?php if (!empty($output['card_info']['store_id'])) {
                                            echo '共有' . $output['goods_online'] . '件商品，点击进店去逛逛';
                                        } else {
                                            echo '该店铺未在平台开通';
                                        } ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="store_body_hd">
            <div class="store_body_hd_txt">主营</div>
            <div class="store_body_hd_text" id="store_zy">
                <?php if (!empty($output['card_info']['store_id'])) {
                    if (empty($output['store_info']['store_zy'])) {
                        echo $output['card_info']['main'];
                    } else {
                        echo $output['store_info']['store_zy'];
                    }
                } else {
                    echo $output['card_info']['main'];
                } ?>
            </div>
        </div>
        <div class="store_foot">
            <div class="store_foot_top"><img
                        src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?= C('app_alias') ?>.jpg"><?= C('site_name') ?></div>
            <div class="store_foot_bottom">全球品种最全一站式<?= C('site_name') ?>平台</div>
        </div>
    </div>
</div>

    <div id="fullshare" style="position: fixed;width:1.8rem;height:1.8rem;bottom:0.6rem;right:0.8rem;z-index: 999" onclick="fullshare()"> <i></i></div>
<div onclick="$(this).hide();" class="weixin"
     style="display: none; width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 999;">
    <div class="share_a" style="width: 100%;height: 100%;background-color:black;opacity: 0.85;"></div>
    <?php if (!empty($output['card_info']['user_id'])) { ?>
        <div style="background-color: white;width: 50%;margin-left: 20%;position: absolute;top: 8rem;padding: 5%;border-radius: 10px;">
            <img style="width: 100%;" src="<?= $output['qrcode'] ?>"/>
            <p style="font-size: 12px;text-align: center;">用<?= C('site_name') ?>APP扫一扫加我为好友</p>
        </div>
    <?php } else { ?>
        <div style="background-color: white;width: 50%;margin-left: 20%;position: absolute;top: 8rem;padding: 5%;border-radius: 10px;">
            <p style="font-size: 12px;text-align: center;">该用户在平台未注册</p>
        </div>
    <?php } ?>
</div>
</body>

<script>
    function fullshare() {
        var share_name = '<?= $output['card_info']['name'] ?>';
        var site_content = '<?php if (!empty($output['card_info']['store_id'])) {if (empty($output['store_info']['store_zy'])) {echo $output['card_info']['main'];} else {echo $output['store_info']['store_zy'];}} else {echo $output['card_info']['main'];} ?>';
        var scfg = {
            title: share_name,
            description: site_content,
            image: '<?= $output['card_info']['picture'] ?>',
            url:window.location.href,
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
    $('a[data-url]').on('click', function () {
        window.MBC.openNew({
            pageTitle: $(this).attr('data-title'),
            url: $(this).attr('data-url'),
            removeHeader: true
        })
    })
    $(function () {
        var infor = $('#address').find('p').html();
        if (infor == '') {
            $('.weui_cell_rt').hide();
        }
    })
    $(".store_header_r").click(function () {
        $(".weixin").show()
    })
    $('#phone_icon').click(function () {
        var phone = $(this).data('phone');
        if (!phone)
            alert('联系方式尚未填写')
        else
            window.location.href = 'tel:' + phone;
    })
    $('#open_location').on('click', function () {
        var lat = $(this).attr('data-lat');
        var lng = $(this).attr('data-lng');
        var name = $(this).attr('data-name');
        var address = $(this).attr('data-address');

        try {
            window.MBC.openLocation({
                latitude: parseFloat(lat),
                longitude: parseFloat(lng),
                name: name,
                address: address
            });
        } catch (e) {
            alert(e.toString());
        }
    })
</script>
