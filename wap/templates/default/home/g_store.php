<?php defined('TTShop') or exit('Access Invalid!'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>好店</title>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_259076_7x1bm11n7trcnmi.css">
    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/g_store/jquery-weui.min.css">
    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/g_store/weui.min.css">
    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/g_store/base.css">
    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/g_store/good_shop.css" >
    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/artTemplate.js"></script>
    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/layer/layer.js"></script>

    <script>
        //template.config('openTag', '{MBTS');
        //template.config('closeTag', 'MBTE}');
        // 标准语法的界定符规则
        template.defaults.rules[1].test = /{MBTS([@#]?)[ \t]*(\/?)([\w\W]*?)[ \t]*MBTE}/;

        // 做第一次请求 接口地址 https://hongmuzhijiashop.confolsc.com/wap/index.php?con=shop&fun=get_favorites_list
        var goods_ids = [];
        var store_ids = [];

        template.defaults.imports.goods_index_of = function (id) {
            if (goods_ids.indexOf(id) >= 0){
                return '__goods-active__';
            } else {
                return '__goods-disactive__';
            }
        };
        template.defaults.imports.store_index_of = function (id) {
            if (store_ids.indexOf(id) >= 0){
                return '__store-active__';
            } else {
                return '__store-disactive__';
            }
        };
        //使用方式  {{ goods_id/store_id | 'goods/store' }}
    </script>
    <style>
        body{
            background-color: #eeeeee;
        }
    </style>
</head>
<body>
<section class="good-shop-list" id="good-shop-list">
    <ul class="innerWrapper"></ul>
    <!-- 滚动加载更多提示 -->
    <div class="weui-loadmore">
        <i class="weui-loading"></i>
        <span class="weui-loadmore__tips">正在加载</span>
    </div>
</section>

<script type="text/html" id="tpl_store">
    {MBTS each data MBTE}
    <li class="good-shop-item">
        <div class="shop-header">
            <a href="javascript:;" class="shop-avatar" data-href="{MBTS $value.store_info.store_url MBTE}" data-title="{MBTS $value.store_info.store_name MBTE}">
                <img src="{MBTS $value.store_info.avatar_url MBTE}">
            </a>
            <div class="right-wrapper clearfix border-bottom" >
                <a class="fl shop-info" href="javascript:;" data-href="{MBTS $value.store_info.store_url MBTE}" data-title="{MBTS $value.store_info.store_name MBTE}">
                    <p class="shop-name">{MBTS $value.store_info.store_name MBTE}</p>
                    <span class="update-time">上新时间: {MBTS $value.store_info.update_time MBTE}</span>
                </a>
                <div class="fr attention-btn-wrapper" data-store_id="{MBTS $value.store_info.store_id MBTE}">
                    {MBTS $value.store_info.store_id | store_index_of MBTE}
                    <a style="display: inline-block" href="javascript:;" data-href="{MBTS $value.store_info.store_url MBTE}" data-title="{MBTS $value.store_info.store_name MBTE}">
                        <i class="iconfont icon-jiantou"></i>
                    </a>
                </div>
            </div>
        </div>
        {MBTS each $value.goods_list as goods_list_item MBTE}
        <div class="pro-info clearfix">
            <div class="fl">
                <a href="javascript:;" data-href="{MBTS goods_list_item.goods_url MBTE}" data-title="{MBTS goods_list_item.goods_name MBTE}">
                <p class="title">{MBTS goods_list_item.goods_name MBTE}</p>
                <span class="price">{MBTS goods_list_item.goods_price MBTE}</span>
                {MBTS if goods_list_item._size !== null MBTE}
                <span class="divide-line-v"></span>
                <span class="tint">规格：{MBTS goods_list_item._size MBTE}</span>
                {MBTS /if MBTE}
                </a>
            </div>
            <div class="fr pro-like-btn-wrapper" data-goods_id="{MBTS goods_list_item.goods_id MBTE}">
                {MBTS goods_list_item.goods_id | goods_index_of MBTE}
                {MBTS if goods_list_item.favorites == null MBTE}
                <span class="count" data-favorites="0">0</span>
                {MBTS else MBTE}
                <span class="count" data-favorites="{MBTS goods_list_item.favorites MBTE}">{MBTS goods_list_item.favorites MBTE}</span>
                {MBTS /if MBTE}
            </div>
        </div>
        <div class="pro-imgs-list">
            <ul class="clearfix">
                {MBTS each goods_list_item.goods_image_array as goods_image_item MBTE}
                <li class="img-item"><a href="javascript:;" data-href="{MBTS goods_list_item.goods_url MBTE}" data-title="{MBTS goods_list_item.goods_name MBTE}"><img src="{MBTS goods_image_item MBTE}"></a></li>
                {MBTS /each MBTE}
            </ul>
        </div>
        {MBTS /each MBTE}
    </li>
    {MBTS /each MBTE}
</script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-2.1.0.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-weui.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<script>
    Array.prototype.indexOf = function(val) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] == val) return i;
        }
        return -1;
    };
    Array.prototype.removeEle = function(val) {
        var index = this.indexOf(val);
        if (index > -1) {
            this.splice(index, 1);
        }
    };
    Array.prototype.pushEle =function(val){
        if(this.indexOf(val) == -1) {
            this.push(val);
        }else {
            return false;
        }
    };
</script>
<script>
    var page = 7;
    var curpage = 1;
    var hasmore = true;
    var param = {};
    var ajax_running = false;
    function get_list(callback) {
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
        //param.type = type;"https://hongmuzhijiashop.confolsc.com/wap/index.php?con=shop&fun=g_store_list"
        $.getJSON("<?= urlMobile('shop', 'g_store_list')?>", param, function (e) {
            if(e.code) {
                if (!e) {
                    e = [];
                }
                curpage++;
                hasmore = e.hasmore;
                    var tem_name = "tpl_store";
                    var tem_data = {
                        data: e.datas.list
                    };

                    var tem_html = template(tem_name, tem_data);
                    tem_html = tem_html.replace(/__store-active__/g, '<a class="attention-btn active" href="javascript:;" >\n' +
                        '                        <span>已关注</span>\n' +
                        '                    </a>');
                    tem_html = tem_html.replace(/__store-disactive__/g, '<a class="attention-btn" href="javascript:;">\n' +
                        '                        <span style="padding: 0 5px;color: #cf0f1a">+</span><span>关注</span>\n' +
                        '                    </a>');
                    tem_html = tem_html.replace(/__goods-active__/g, '<i class="iconfont active icon-like_xin"></i>');
                    tem_html = tem_html.replace(/__goods-disactive__/g, '<i class="iconfont icon-xihuan"></i>');
                    $("#good-shop-list").find(".innerWrapper").append(tem_html);
                    //计算图片尺寸
                    if(callback){
                        callback();
                    }
                    ajax_running = false;
                if (!e.hasmore){
                    $('#good-shop-list').find('.weui-loadmore').remove();
                    var tipHtml = "<div class=\"weui-loadmore weui-loadmore_line\">\n"+
                        "<span class=\"weui-loadmore__tips\">没有更多了</span>\n"+
                        "</div>";
                    $('#good-shop-list').append(tipHtml);
                    ajax_running = false;
                }

            }
        })
    }

    $(function () {
        $('#good-shop-list').on('click', '*[data-href]', function () {
            if ($(this).attr('data-href') != '') {
//                    alert($(this).attr('data-url').split('.')[1])
                window.MBC.openNew({
                    url: $(this).attr('data-href'),
                    pageTitle: $(this).attr('data-title') || '购物',
                    removeHeader: true
                });
                return false;
            }
        });

        $.getJSON("<?= urlMobile('shop', 'get_favorites_list')?>", {}, function (data) {
            if (data.datas.member_id){
                goods_ids = data.datas.goods_list;
                store_ids = data.datas.store_list;
            }
        });

        get_list(calculateStoreImgListWidth);
        $(window).scroll(function () {

            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {

                get_list(calculateStoreImgListWidth);

            }

        });
    })
</script>
<script>
    function calculateStoreImgListWidth() {
        var winWidth = $(window).width();
        //console.log(winWidth);
        var interval = 12;
        var paddingWidth = 14;
        var pro_imgs_list = $(".pro-imgs-list");
        pro_imgs_list.map(function () {
            var img_items = $(this).find(".img-item");
            //console.log(img_items);
            var itemWidth = (winWidth - interval*3 - paddingWidth)/3.5;
            //console.log(itemWidth);
            img_items.map(function () {
                //console.log($(this));
                $(this).css("width",itemWidth + "px");
            });
            $(this).find("ul").css("width",(img_items.length*itemWidth + interval*(img_items.length - 1) ) + "px");
        });
    }
</script>
<script>
    /*关注店铺样式处理*/
    $(function () {
        $(".innerWrapper").on("click",".attention-btn",function () {
            var $this = $(this);
            var store_id = $($this.parent(".attention-btn-wrapper")[0]).data("store_id");
            if($(this).hasClass("active")){
                console.log('取消关注操作');
                $.ajax({
                    url: "<?= urlMobile('member_favorites_store', 'favorites_del')?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        store_id: store_id,
                        key: getCookie("key")
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
                            store_ids.removeEle(store_id);
                            console.log(store_ids);
                            $this.removeClass("active");
                            $this.find("span").remove();
                            var html = "<span style=\"padding: 0 5px;color: #cf0f1a\">+</span><span>关注</span>";
                            $this.html(html);
                        }
                    }
                });
            }else {
                //关注操作
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
                            store_ids.pushEle(store_id);
                            $this.find("span").remove();
                            $this.addClass("active");
                            var html2 = "<span>已关注</span>";
                            $this.addClass("active").html(html2);
                        }
                    }
                });

            }
        });
        $(".innerWrapper").on("click",".pro-like-btn-wrapper",function () {
            var favorites;
            var $this = $(this);
            var goods_id = $this.data("goods_id");
            if($(this).find("i").hasClass("active")){
                $.ajax({
                    url: "<?= urlMobile('member_favorites', 'favorites_del')?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        fav_id: goods_id,
                        key: getCookie("key")
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
                            goods_ids.removeEle(goods_id);
                            $('[data-goods_id ='+ goods_id+']').find("i").remove();
                            favorites = parseInt($('[data-goods_id ='+ goods_id+']').find(".count").data("favorites"));
                            if (favorites > 0){
                                $('[data-goods_id ='+ goods_id+']').find(".count").html((favorites -1));
                                $('[data-goods_id ='+ goods_id+']').find(".count").data("favorites",favorites -1);
                            }
                            var html = "<i class=\"iconfont  icon-xihuan\"></i>";
                            $('[data-goods_id ='+ goods_id+']').prepend(html);
                        }
                    }
                });
            }else {
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
                                goods_ids.pushEle(goods_id);
                                favorites = parseInt($('[data-goods_id ='+ goods_id+']').find(".count").data("favorites"));
                                $('[data-goods_id ='+ goods_id+']').find(".count").html((favorites +1));
                                $('[data-goods_id ='+ goods_id+']').find(".count").data("favorites",favorites +1);
                                $('[data-goods_id ='+ goods_id+']').find("i").remove();
                                var html2 = "<i class=\"iconfont active icon-like_xin\"></i>";
                                $('[data-goods_id ='+ goods_id+']').prepend(html2);
                            } else {
                                layer.open({
                                    content: data.datas.error,
                                    time: 1.5
                                })
                            }
                        }
                    }
                });
                //console.log("我走了这里");
                //console.log($(this).find("i"));

            }
        });
    });
</script>
</body>
</html>



