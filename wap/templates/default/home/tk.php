<?php defined( 'TTShop') or exit( 'Access Invalid!');?>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/jquery-weui.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/swiper.js"></script>
<script type="text/javascript"
        src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/Refresh-LoadingMore.js"></script>

<!--<script type="text/javascript" src="--><?//= MOBILE_TEMPLATES_URL; ?><!--/js/layer/layer.js"></script>-->
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/template.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/swipe.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/pullToRefresh.js"></script>

<link href="<?php echo MOBILE_TEMPLATES_URL; ?>/market/main.css?v=23" type="text/css" rel="stylesheet"/>
<link href="<?php echo MOBILE_TEMPLATES_URL; ?>/market/weui.min.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo MOBILE_TEMPLATES_URL; ?>/market/jquery-weui.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/swiper.min.css"/>

<style>
    html {
        font-size: 20px;
        color: #2c3e50;
        -webkit-appearance: none;
    }

    /*iphone4*/
    @media only screen and (min-width: 320px) {
        html {
            font-size: 20px !important;
            -webkit-appearance: none;
        }
    }

    /*Note3*/
    @media only screen and (min-width: 360px) {
        html {
            font-size: 22px !important;
            -webkit-appearance: none;
        }
    }

    /*iPhone6*/
    @media only screen and (min-width: 375px) {
        html {
            font-size: 23px !important;
            -webkit-appearance: none;
        }
    }

    /*iPhone6 plus*/
    @media only screen and (min-width: 414px) {
        html {
            font-size: 25px !important;
            -webkit-appearance: none;
        }
    }

    /*big Resolution*/
    @media only screen and (min-width: 641px) {
        html {
            font-size: 25px !important;
            -webkit-appearance: none;
        }
    }

    body {
        background-color: white;
        font-family: Heiti, Heiti SC, DroidSans, DroidSansFallback, Arial, "Microsoft YaHei" !important;
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

    i {
        float: left;
        line-height: 2.35rem;
        font-size: .4rem;
    }

    a .tag {
        width: 12vw;
    }

    .section_nav_img1 {
        padding-top: 2.35rem;
        text-align: center;
        width: 100%;
        /*position: inherit;*/
    }

    .section_nav_img1 img {
        width: 100%;
    }

    .list_content {
        background-color: #F3F3F3;
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
        color: #474b53;
        border-radius: 55px;
        margin: 0 auto;
        font-size: 12px;
        text-align: center;
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

    .sup {
        /*color: #6c0100;*/
        /*border: 1px solid #6c0100;*/
    }

    .active {
        /*color: #890101;*/
    }

    .huomiao {
        position: relative;
        top: -3.5rem;
        height: 3.4rem;
        /*background-color:;*/
        text-align: center;
        border-radius: 50%;
        z-index: -1;
    }

    .huomiao_a {
        width: 2.5rem;
        height: 2.5rem;
        margin: 0.25rem;
        margin-left: 0.45rem;
        border-radius: 50%;
        background-color: #e6e7e9;
    }

    .header-wrap ul a li {
        color: #444;
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
        bottom: 4px;
    }

    .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet {
        margin: 0 2.5px;
    }

    .swiper-pagination-bullet {
        width: 4px;
        height: 4px;
    }
</style>
<style>
    .gengduo {
        float: right;
        font-size: 12px;
        padding-right: 6px;
        padding-top: 8px;
    }

    .one-line {
        height: 32px;
        overflow: hidden;
        margin-bottom: 6px;
    }

    .a_box img {
        width: 25px;
    }

    .a_box p {
        width: 100%;
        vertical-align: middle;
        margin-top: -15px;
    }

    .a_box {
        height: 35px;
        border: none;
        background: none;
        margin-top: 36px;
        padding-left: 10px;
    }

    .a_box_1 {
        margin-top: 10px !important;
    }

    @media only screen and (max-width: 384px) {
        .a_box {
            margin-top: 36px;
            -webkit-appearance: none;
        }
    }

    @media only screen and (max-width: 375px) {
        .a_box {
            margin-top: 30px;
            -webkit-appearance: none;
        }
    }

    @media only screen and (max-width: 360px) {
        .a_box {
            margin-top: 27px;
            -webkit-appearance: none;
        }
    }

    @media only screen and (max-width: 320px) {
        .a_box {
            margin-top: 20px;
            -webkit-appearance: none;
        }
    }

    .fix-block-r {
        position: fixed;
        bottom: 5.5rem;
        right: 0.68rem;
        width: 1.9rem;
        border-radius: 50%;
        z-index: 1000;
    }

    .iconfont {
        font-size: 20px;
        float: inherit;
    }
    .details_content > ul > li:first-child {
        padding-top: 20px;
    }
</style>
<style>
    body {
        line-height: normal;
    }

    .picture .img {
        width: 92%;
        padding-top: 92%;
    }

    /*
     .picture .img:nth-child(2) {
         display: none;
     }
     .picture .img:nth-child(3) {
         display: none;
     }
     .picture .img:nth-child(4) {
         display: none;
     }
     */
</style>
<?php if (in_array($output['platform'], ['ios', 'android'])) { ?>
    <style>
        .a_box {
            margin-top: 27px;
        }

        .a_box_1 {
            margin-top: 6px;
        }

        @media only screen and (max-width: 384px) {
            .a_box {
                margin-top: 23px;
                -webkit-appearance: none;
            }
        }

        @media only screen and (max-width: 375px) {
            .a_box {
                margin-top: 22px;
                -webkit-appearance: none;
            }
        }

        @media only screen and (max-width: 360px) {
            .a_box {
                margin-top: 20px;
                -webkit-appearance: none;
            }
        }

        @media only screen and (max-width: 320px) {
            .a_box {
                margin-top: 14px;
                -webkit-appearance: none;
            }
        }
    </style>

<?php } ?>

<div class="details_content" id="goods<?= $output['data']['goods_id']?>">
    <ul>
        <li class="clearfix">
            <div class="header_l flt">
                <img class="avatar_img" src="<?= $output['data']['avatar']?>" style="margin-left: 18px;">
                <a href="javascript:;" data-title="<?= $output['data']['store_name']?>" data-url="<?= urlMobile('store', 'index', ['store_id' => $output['data']['store_id']])?>" class=" store_store a_box a_box_1">
                    <i class="iconfont icon-home weui-row_active"></i>
                    <p class="">店铺</p>
                </a>
                <a href="javascript:void(0);" data-phone="<?= $output['data']['store_phone']?>" class="store_phone a_box margin_top">
                    <i class="iconfont icon-dianhua weui-row_active"></i>
                    <p class="">私洽</p>
                </a>
                <?php if (in_array($output['platform'], ['ios', 'android'])) { ?>

                    <a href="javascript:void(0);" data-supershare='<?= $output['data']['img_json']?>' data-jingle="<?= $output['data']['goods_jingle']?>"
                       class="super_share a_box margin_top">
                        <?php if (in_array(C('app_alias'), ['guoshizhijia', 'zhile'])): ?>
                            <img style="width: 0.93rem;margin-top: 14px;"
                                 src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/tuike1.png">
                        <?php elseif (C('app_alias') == 'hongmuzhijia'): ?>
                            <img style="width: 0.93rem;margin-top: 14px;"
                                 src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/tuike.png">
                        <?php endif; ?>
                        <!--                            <i class="iconfont icon-dianhua weui-row_active"></i>-->
                        <p class="" style="margin-top: 2px;">推客</p>
                    </a>

                <?php } ?>
                <a href="javascript:void(0);" data-store_id="<?= $output['data']['store_id']?>" class="focus a_box margin_top">
                    <i class="iconfont icon-shoucang_xing weui-row_active"></i>
                    <p class="">关注</p>
                </a>
                <a href="javascript:void(0);" data-goods_id="<?= $output['data']['goods_id']?>" class="digg a_box margin_top">
                    <i class="iconfont icon-dianzan_px weui-row_active"></i>
                    <p class="">点赞</p>
                </a>
                <a href="javascript:void(0);" data-goods_id="<?= $output['data']['goods_id']?>" class="a_box margin_top complaint">
                    <i class="iconfont icon-tousu_px weui-row_active"></i>
                    <p class="">投诉</p>
                </a>
            </div>
            <div class="header_r frt">
                <div class="text">
                    <?= $output['data']['store_name']?>
                    <!--<span>认证V3</span>-->
                </div>
                <div class="title weui-row_active">
                    <?= $output['data']['goods_name']?>
                </div>
                <div class="picture clearfix" img-data="<?= $output['data']['img_json']?>" store-id="<?= $output['data']['store_id']?>">
                    <?php foreach (json_decode($output['data']['img_json'], true) as $index => $item):?>
                        <div class="img" initindex="<?= $index?>" rel="<?= $item?>" style="background-image: url(<?= $item?>);"></div>
                    <?php endforeach;?>
                </div>
                <div class="text2">
                    <div class="you general_bgc">包邮</div>
                    <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/time.png" class="time">
                    <span class="font"><?= $output['data']['created_at']?></span>
                    <div class="position_num">
                        <div class="text_top2 weui-row_active"><?= $output['data']['goods_price']?></div>
                    </div>
                </div>

                <a href="javascript:;" data-url="<?= $output['data']['target_url']?>" data-title="<?= $output['data']['goods_name']?>">
                    <div class="price general_bgc">
                        我要购买
                    </div>
                </a>
                <div style="clear: both; margin-top: 8px;"></div>
                <div class="picture2 clearfix digg_users_lists_container" style="width: 92%; display: none;">
                    <div class="flt one-line digg_users_lists" style="width: 85%;">
                    </div>
                    <div class="gengduo" style="width: 10%;">更多</div>
                </div>

            </div>
        </li>
    </ul>
</div>
<div class="info-img-wrapper"style="width: 100%;padding: 20px 25px;box-sizing: border-box">
    <img style="width: 100%;height: auto;display: block;" src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/zhuanzhuanzhuan.jpg">
</div>
<script type="text/html" id="member-item">
    <a href="javascript:void(0);">
        <img src="{avatar}">
    </a>
</script>
<script>
    var member_avatar = '<?php echo $output['__user_avatar']; ?>';
</script>
<script>
    $(function () {
        $(".details_content").each(function (index, element) {
            var img_data = $(element).find(".picture").attr("img-data");
            var store_id = $(element).find(".picture").attr("store-id");
            //var obj = eval("(" + img_data + ")");
            var obj = {};
            try {
                obj = JSON.parse(img_data);
            } catch (e) {
                obj = {};
            }
            if (obj == null)
                obj = {};
            var this_initindex = 0;
            for (var i = 0; i < obj.length; i++) {
                var v = obj[i];
                var str = "";
                var arr = v.split("_");
                if (arr.length > 1) {
                    str = store_id + "/" + v;
                } else {
                    str = v;
                }
                var narr = str.split(".");
                var nstr_min = base_url + narr[0] + img_wh_min + "." + narr[1];
                var nstr = base_url + narr[0] + img_wh + "." + narr[1];
                var parentdiv = $('<div class="img"></div>');
                parentdiv.attr('initindex', this_initindex);
                parentdiv.attr('rel', nstr);
                parentdiv.css("background-image", "url(" + nstr_min + ")");
                parentdiv.appendTo($(element).find(".picture"));

                this_initindex++;
            }

            //var pb2 =
            var this_img_arr = new Array();
            //var i = 0;
            $(element).find(".picture").find(".img").each(function (index, element) {
                this_img_arr[index] = $(element).attr("rel");
                //i++;
            });

            $(element).find(".picture").find(".img").click(function () {
//                    var this_img_pb = $.photoBrowser({
//                        items: this_img_arr,
//                        initIndex: $(this).attr("initindex"),
//                        //maxScale:this_img_arr.length
//                        onSlideChange: function(index) {
//                           console.log(this, index);
//                        }
//                    });
                window.MBC.previewImage({
                    index: $(this).attr("initindex"),
                    urls: this_img_arr,
                    current: this_img_arr[$(this).attr("initindex")]
                });
                console.log(this_img_arr);
                console.log(this_img_arr.length);
                //this_img_pb.open();  //打开
            });
//
//
//            //移除标志
//            $(this).removeClass("no_xuran");
        });

        $('.details_content').on('click', '.complaint', function () {
            console.log('loading...')
            $.modal({
                title: "官方客服",
                text: "电话：" + "<?= C('site_phone') ?>",
                buttons: [
                    {
                        text: "呼叫", onClick: function () {
                        location.href = 'tel:' + "<?= C('site_phone') ?>"
                    }
                    },
                    {text: "取消", className: "default"},
                ]
            });
        })

        $('.details_content').on('click', '.store_phone', function () {
            var phone = $(this).data('phone');
            if (!phone)
                layer.open({content: '该商户没有填写联系电话', time: 1.5})
            else
                window.location.href = 'tel:' + phone;
        });

        $('.details_content').on('click', '.super_share', function () {
            var img = $(this).data('supershare');
            var text = $(this).data('jingle');
            console.log(img)
            if (!img) {
                layer.open({content: '分享信息获取失败', time: 1.5})
            }
            else {

                window.MBC.superShare({
                    images: img || [],
                    text: text || ''
                })
            }
        });
        $('a[data-url]').on('click', function () {
            window.MBC.openNew({
                url: $(this).attr('data-url'),
                pageTitle: $(this).attr('data-title'),
                removeHeader: true
            })
            return false;
        })

        $('.details_content').on('click', '.focus', function () {
            var store_id = $(this).data('store_id');
            $.ajax({
                url: '/wap/index.php?con=member_favorites_store&fun=favorites_add',
                type: 'post',
                dataType: 'json',
                data: {
                    store_id: store_id,
                    type: 'follow'
                },
                success: function (data) {
                    if (data.nologin) {
                        window.location.href = '/wap/index.php?con=auto&fun=login';
                        return false;
                    }
                    if (data.code != 200) {
                        layer.open({
                            content: data.datas.error,
                            time: 1.5
                        });
                    } else if (typeof data.datas == 'object' && typeof data.datas.error != 'undefined') {
                        layer.open({
                            content: data.datas.error,
                            time: 1.5
                        });
                    } else {
                        layer.open({
                            content: '关注成功',
                            time: 1.5
                        })
                    }
                }
            });
        });
        $('.details_content').on('click', '.digg', function () {
            var goods_id = $(this).data('goods_id');
            $.ajax({
                url: '/wap/index.php?con=member_favorites&fun=favorites_add',
                type: 'post',
                dataType: 'json',
                data: 'goods_id=' + goods_id + '&type=digg',
                success: function (data) {
                    if (data.nologin) {
                        window.location.href = '/wap/index.php?con=auto&fun=login';
                        return false;
                    }
                    if (data.code != 200) {
                        layer.open({
                            content: data.datas.error,
                            time: 1.5
                        })
                    } else {
                        if (data.datas == 1) {
                            var html = $('#member-item').html().replace('{avatar}', member_avatar);
                            $(html).prependTo($("#goods" + goods_id).find('.digg_users_lists:eq(0)'));
                            $("#goods" + goods_id).find('.digg_users_lists_container').show();
                        } else {
                            layer.open({
                                content: data.datas.error,
                                time: 1.5
                            })
                        }
                    }
                }
            });
        });
    })
</script>