<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/jquery-weui.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/swiper.js"></script>
<script type="text/javascript"
        src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/Refresh-LoadingMore.js"></script>
<link href="<?php echo MOBILE_TEMPLATES_URL; ?>/market/main.css?v=23" type="text/css" rel="stylesheet"/>
<link href="<?php echo MOBILE_TEMPLATES_URL; ?>/market/weui.min.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo MOBILE_TEMPLATES_URL; ?>/market/jquery-weui.css" type="text/css" rel="stylesheet"/>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/swiper.min.css"/>
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
</head>
<body>
<script>
    var member_avatar = '<?php echo $output['__user_avatar']; ?>';
</script>
<div class="weui-pull-to-refresh-layer">
    <div class="pull-to-refresh-arrow"></div>
    <div class="pull-to-refresh-preloader"></div>
    <div class="down">下拉刷新</div>
    <div class="up">释放刷新</div>
    <div class="refresh">正在刷新...</div>
</div>
<header id="header" class="transparent"
        style="top: 0;position:fixed;background-color: white;height: 2.35rem;border-bottom: 1px #f0f0f0 solid;">
    <div class="header-wrap asd nav_body" style="position:relative;height:2.35rem;">

        <ul style="margin-left: 3vw;">

            <?php if (in_array(C('app_alias'), ['guoshizhijia', 'zhile'])): ?>
                <a href="<?=urlMobile('goods', 'supermarket')?>">
                    <li class="weui-row_active" style="padding-left:1px;"><?= $output['top_nav'][0]['name'] ?></li>
                </a><i>|</i>
                <a href="javascript:;"
                   onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][1]['name'] ?>',url:'<?= $output['top_nav'][1]['url'] ?>',removeHeader:false})">
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
                    <li class="weui-row_active" style="padding-left:1px;"><?= $output['top_nav'][0]['name'] ?></li>
                </a><i>|</i>
                <a href="javascript:;"
                   onclick="window.MBC.openNew({pageTitle:'<?= $output['top_nav'][1]['name'] ?>',url:'<?= $output['top_nav'][1]['url'] ?>',removeHeader:false})">
                    <li><?= $output['top_nav'][1]['name'] ?></li>
                </a><i>|</i>
                <a href="<?=urlMobile('index')?>">
                    <li>商城</li>
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
</header>
<div class="swiper-container section_nav_img1"><!--style="margin-top: 1.95rem;"-->
    <div class="swiper-wrapper">
        <?php if (C('app_alias') == 'guoshizhijia'): ?>
            <div class="swiper-slide">
                <a href="javascript:;"
                   onclick="window.MBC.openNew({pageTitle:'免费开店',url:'https://weixin.confolsc.com/index.php?act=view&op=details&article_id=910&domain=https://guoshizhijia.confolsc.com',removeHeader:false})">
                    <img style="width:100%;"
                         src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/freeopen.jpeg">
                </a>
            </div>
        <?php else: ?>
            <?php foreach ((array)$output['adv'] as $slide): ?>
                <div class="swiper-slide"><a href="<?php echo swiperLink($slide); ?>"><img style="width:100%;"
                                                                                           src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_PATH . DS . $slide['link_pic']; ?>"/></a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
<div class="list_content">
    <ul class="clearfix">
        <?php foreach ((array)$output['core_category']['result']['category'] as $cate): ?>

            <li class="<?php echo $_SESSION['__ccid'] == $cate['id'] ? 'xz' : ''; ?>">
                <a href="<?php echo urlMobile('goods', 'supermarket', array('__ccid' => $cate['id'])); ?>"
                   class="yuan <?php echo $_SESSION['__ccid'] == $cate['id'] ? 'circled' : ''; ?>">
                    <span><?php echo $cate['name'];//mb_substr($cate['name'],0,2,'utf-8'); //substr($str , 0 , 5);?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="details_wrap" id="datas" style="margin-bottom:15px;">
</div>


<div class="weui-infinite-scroll" id="infinite-div" style="display:none;">
    <div class="infinite-preloader"></div>
    正在加载...
</div>


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
<script type="text/html" id="template">
    <div class="details_content no_xuran" id="goods.goods_id.">
        <ul>
            <li class="clearfix">
                <div class="header_l flt">
                    <img class="avatar_img" src="{avatar}" style="margin-left: 18px;">
                    <a href="javascript:;"
                       data-url="<?php echo urlMobile('store', 'index', array('store_id' => '.store_id.')); ?>"
                       class="a_box a_box_1">
                        <i class="iconfont icon-home weui-row_active"></i>
                        <p class="">店铺</p>
                    </a>
                    <a href="javascript:void(0);" data-phone="{store_phone}" class="store_phone a_box margin_top">
                        <i class="iconfont icon-dianhua weui-row_active"></i>
                        <p class="">私洽</p>
                    </a>
                    <?php if (in_array($output['platform'], ['ios', 'android'])) { ?>

                        <a href="javascript:void(0);" data-supershare='{super_share_img}' data-jingle="{goods_jingle}"
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
                    <a href="javascript:void(0);" data-store_id=".store_id." class="focus a_box margin_top">
                        <i class="iconfont icon-shoucang_xing weui-row_active"></i>
                        <p class="">关注</p>
                    </a>
                    <a href="javascript:void(0);" data-goods_id=".goods_id." class="digg a_box margin_top">
                        <i class="iconfont icon-dianzan_px weui-row_active"></i>
                        <p class="">点赞</p>
                    </a>
                    <a href="javascript:void(0);" data-goods_id="" class="a_box margin_top complaint">
                        <i class="iconfont icon-tousu_px weui-row_active"></i>
                        <p class="">投诉</p>
                    </a>
                </div>
                <div class="header_r frt">
                    <div class="text">
                        {store_name}
                        <!--<span>认证V3</span>-->
                    </div>
                    <div class="title weui-row_active">
                        {goods_name}
                    </div>
                    <div class="picture clearfix" img-data='{json_data}' store-id="{store_id}">
                    </div>
                    <div class="text2">
                        <div class="you general_bgc">{shipping}</div>
                        <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/time.png" class="time">
                        <span class="font">{created_at}</span>
                        <div class="position_num">
                            <div class="text_top2 weui-row_active">{goods_price}</div>
                        </div>
                    </div>

                    <a href="javascript:;" data-url="{target_url}" data-title="{goods_name}">
                        <div class="price general_bgc">
                            我要购买
                        </div>
                    </a>
                    <div style="clear: both; margin-top: 8px;"></div>
                    <div class="picture2 clearfix digg_users_lists_container" style="width:92%">
                        <div class="flt one-line digg_users_lists" style="width: 85%;">
                        </div>
                        <div class="gengduo" style="width: 10%;">更多</div>
                    </div>

                </div>
            </li>
        </ul>
    </div>
</script>

<script type="text/html" id="member-item">
    <a href="javascript:void(0);">
        <img src="{avatar}">
    </a>
</script>

<script>

    $(function () {



        $('#datas').on('click', '.complaint', function () {
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

        $('#datas').on('click', '.store_phone', function () {
            var phone = $(this).data('phone');
            if (!phone)
                layer.open({content: '该商户没有填写联系电话', time: 1.5})
            else
                window.location.href = 'tel:' + phone;
        });

        $('#datas').on('click', '.super_share', function () {
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

        $('#datas').on('click', '.focus', function () {
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
        $('#datas').on('click', '.digg', function () {
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
        var base_url = "<?php echo UPLOAD_SITE_URL . DS . ATTACH_GOODS; ?>/";
        var img_wh_min = "_360";
        var img_wh = "";  //"_1280";  //使用原图，而不是被压缩的图片，会降低访问速度


        //渲染函数
        var no_xuran = function () {

            $(".details_content.no_xuran").each(function (index, element) {
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


                //移除标志
                $(this).removeClass("no_xuran");
            });
        };

        var loading = false;
        var last_id = '';
        var hasmore = true;
        var curpage = 1;
        var loadMarketData = function () {
            if (loading)
                return '';
            if (last_id === 0)
                return '';
            loading = true;
            $.ajax({
                url: '/wap/index.php?con=goods&fun=market_api&last_id=' + last_id + '&curpage=' + curpage + '&__ccid=<?=$_GET['__ccid']?>',
                dataType: 'json',
                complete: function (a, b) {
                    loading = false;
                    $("#infinite-div").hide();
                    if (b != 'success') {
                        layer.open({
                            content: '错误:' + b,
                            time: 1.5
                        })
                    } else {
                        try {
                            var data = JSON.parse(a.responseText);
                        } catch (e) {
                            var data = {};
                            data.code = 500;
                            data.datas = {};
                            data.datas.error = 'exception';
                        }

                        $.each(data.datas.datas, function (i, v) {
                            var _tmp_str = $('#template').html();
                            _tmp_str = _tmp_str.replace('{avatar}', v.avatar);
                            _tmp_str = _tmp_str.replace('{goods_name}', v.goods_name);
                            _tmp_str = _tmp_str.replace('{store_name}', v.store_name);
                            _tmp_str = _tmp_str.replace('{json_data}', v.json_data);
                            _tmp_str = _tmp_str.replace('{super_share_img}', v.img_json);
                            _tmp_str = _tmp_str.replace('{goods_jingle}', v.goods_name + v.goods_jingle + '\n 价格：' + v.goods_price);
                            _tmp_str = _tmp_str.replace('{store_id}', v.store_id);
                            _tmp_str = _tmp_str.replace('{shipping}', v.shipping);
                            _tmp_str = _tmp_str.replace('{created_at}', v.created_at);
                            _tmp_str = _tmp_str.replace('{goods_price}', v.goods_price);
                            _tmp_str = _tmp_str.replace('{target_url}', v.target_url);
                            _tmp_str = _tmp_str.replace(/\.store_id\./g, v.store_id);
                            _tmp_str = _tmp_str.replace(/\.goods_id\./g, v.goods_id);
                            _tmp_str = _tmp_str.replace('{store_phone}', v.store_phone ? v.store_phone : '');

                            _tmp_str = $(_tmp_str);

                            if (v.digg_users.length <= 0) {
                                _tmp_str.find('.digg_users_lists_container').hide();
                            } else {
                                $(v.digg_users).each(function (i, v) {
                                    _tmp_str.find('.digg_users_lists:eq(0)').append($("#member-item").html().replace('{avatar}', v.member_avatar));
                                });
                            }
                            $('#datas').append($(_tmp_str));
                        });

                        <?php switch (C('app_alias')) {
                            case 'guoshizhijia':
                                ?>
                        last_id = data.datas.last_id;
                                <?php
                                break;
                            
                            case 'hongmuzhijia':
                                ?>
                        last_id = data.datas.last_id;
                        // curpage++;
                        // hasmore = data.hasmore;
                                <?php
                                break;

                            default:
                                ?>
                        last_id = data.datas.last_id;
                                <?php
                                break;
                        } ?>

                        no_xuran();
                    }
                    $(function () {
                        $('a[data-url]').on('click', function () {
                            window.MBC.openNew({
                                url: $(this).attr('data-url'),
                                pageTitle: $(this).attr('data-title'),
                                removeHeader: true
                            })
                            return false;
                        })
                    })
                },
                beforeSend: function () {
                    $("#infinite-div").show();
                }
            });
        };
        loadMarketData();


        //绑定向下加载事件
        $(document.body).infinite().on("infinite", function () {
            loadMarketData();
        });


    });
</script>
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


<?php if (!in_array($output['client'], ['ios', 'android'])):
    require_once template('footer-nav');
elseif ($output['client'] == 'ios'): ?>
    <!--插入ios端样式-->
<?php endif; ?>

<?php //include template('footer'); ?>


<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/template.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/swipe.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/pullToRefresh.js"></script>


<?php if (!in_array($output['client'], ['ios', 'android'])): ?>
    <div id="fullshare" style="position: fixed;width:1.8rem;height:1.8rem;bottom:5.5rem;right:0.8rem;z-index: 999" data-id="0" onclick="fullshare()"> <i></i></div>
    <div
            class="yimeng_camera" style="position: fixed;right: 0.8rem;bottom:3.1rem;width:1.8rem;z-index: 5;"
            onclick="yimeng_camera()"><i></i>
    </div>
    <div class="fix-block-r" style="bottom: 7.9rem;">
        <a href="javascript:void(0);" class="gotop-btn gotop hide" onclick="goTopBtn()" id="goTopBtn"><i></i></a>
    </div>
<?php else: ?>
    <?php if (in_array($output['client'], ['ios'])): ?>
        <div id="fullshare" style="position: fixed;width:1.8rem;height:1.8rem;bottom:5.5rem;right:0.8rem;z-index: 999" data-id="0" onclick="fullshare()"> <i></i></div>
        <div
                class="yimeng_camera" onclick="yimeng_camera()"
                style="position: fixed;right: 0.8rem;bottom:3.1rem;width:1.8rem;z-index: 5;"><i></i>
        </div>
        <div class="fix-block-r" style="bottom:7.9rem;">
            <a href="javascript:void(0);" class="gotop-btn gotop hide" onclick="goTopBtn()" id="goTopBtn"><i></i></a>
        </div>
    <?php endif; ?>
    <?php if (in_array($output['client'], ['android'])): ?>
        <div id="fullshare" style="position: fixed;width:1.8rem;height:1.8rem;bottom:3rem;right:0.8rem;z-index: 999" data-id="0" onclick="fullshare()"> <i></i></div>
        <div
                class="yimeng_camera" style="position: fixed;right: 0.8rem;bottom:0.6rem;width:1.8rem;z-index: 5;"
                onclick="yimeng_camera()"><i></i>
        </div>
        <div class="fix-block-r" style="bottom: 5.4rem;">
            <a href="javascript:void(0);" class="gotop-btn gotop hide" onclick="goTopBtn()" id="goTopBtn"><i></i></a>
        </div>
    <?php endif; ?>
<?php endif; ?>

<script>
    //    $('div[data-url]').click(function () {
    //
    //    })
    function goTopBtn() {
        $("body").scrollTo({toT: 0});
    };

    function yimeng_camera() {
        window.MBC.openNew({
            pageTitle: "分类",
            url: '<?php echo urlMOBILE('category', 'index', ['from' => 'market']); ?>',
            removeHeader: true
        })
    };
    function fullshare() {
        var scfg = {
            title: '<?=$output['share_info'][C('app_alias')][$_SESSION['__ccid']]['name']?>',
            description: '<?=$output['share_info'][C('app_alias')][$_SESSION['__ccid']]['desc']?>',
            image: '<?=$output['share_info'][C('app_alias')][$_SESSION['__ccid']]['image']?>',
            url:get_share_url(window.location.href),
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
    new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoplay: 3000
    });


    +function ($) {
        "use strict";

        var PTR = function (el) {
            this.container = $(el);
            this.distance = 50;
            this.attachEvents();
        }

        PTR.prototype.touchStart = function (e) {
            if (this.container.hasClass("refreshing")) return;
            var p = $.getTouchPosition(e);
            this.start = p;
            this.diffX = this.diffY = 0;
        };

        PTR.prototype.touchMove = function (e) {
            if (this.container.hasClass("refreshing")) return;
            if (!this.start) return false;
            if (this.container.scrollTop() > 0) return;
            var p = $.getTouchPosition(e);
            this.diffX = p.x - this.start.x;
            this.diffY = p.y - this.start.y;
            if (this.diffY < 0) return;
            this.container.addClass("touching");
            e.preventDefault();
            e.stopPropagation();
            this.diffY = Math.pow(this.diffY, 0.8);
            this.container.css("transform", "translate3d(0, " + this.diffY + "px, 0)");

            if (this.diffY < this.distance) {
                this.container.removeClass("pull-up").addClass("pull-down");
            } else {
                this.container.removeClass("pull-down").addClass("pull-up");
            }
            $(".weui-pull-to-refresh-layer").next().css({'position': 'absolute', 'top': '2.35rem'})
        };
        PTR.prototype.touchEnd = function () {
            this.start = false;
            if (this.diffY <= 0 || this.container.hasClass("refreshing")) return;
            this.container.removeClass("touching");
            this.container.removeClass("pull-down pull-up");
            this.container.css("transform", "");

            if (Math.abs(this.diffY) <= this.distance) {
                $(".weui-pull-to-refresh-layer").next().css({'position': 'absolute', 'top': '0rem'});
            } else {
                this.container.addClass("refreshing");
                this.container.trigger("pull-to-refresh");
            }
        };

        PTR.prototype.attachEvents = function () {
            var el = this.container;
            el.addClass("weui-pull-to-refresh");
            el.on($.touchEvents.start, $.proxy(this.touchStart, this));
            el.on($.touchEvents.move, $.proxy(this.touchMove, this));
            el.on($.touchEvents.end, $.proxy(this.touchEnd, this));
        };

        var pullToRefresh = function (el) {
            new PTR(el);
            $(".weui-pull-to-refresh-layer").next().css({'position': 'fixed', 'top': '0rem'})
            $(".weui-pull-to-refresh-layer").next().next().css({'padding-top': '2.35rem'})
        };

        var pullToRefreshDone = function (el) {
            $(el).removeClass("refreshing");
            $('#head').show();
            $(".weui-pull-to-refresh-layer").next().css({'position': 'fixed', 'top': '0rem'})
            $(".weui-pull-to-refresh-layer").next().next().css({'padding-top': '2.35rem'})
        }

        $.fn.pullToRefresh = function () {
            return this.each(function () {
                pullToRefresh(this);
            });
        }

        $.fn.pullToRefreshDone = function () {
            return this.each(function () {
                pullToRefreshDone(this);
            });
        }

    }($);
    $(document.body).pullToRefresh();
    $(document.body).on("pull-to-refresh", function () {
        window.MBC.refresh();

    });
    $(document.body).pullToRefreshDone();
</script>
</body>