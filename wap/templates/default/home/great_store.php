<?php defined('TTShop') or exit('Access Invalid!'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>好店</title>
    <style type="text/css">
        .dis_content_a {
            width: 100%;
            margin: 10px 0px;
            position: relative;
            background-color: white;

        }

        .dis_content_a-user_hd {
            padding: 10px 15px;
            background: #fff;
        }

        .dis_content_a-user_hd img {
            float: left;
            position: relative;
        }

        .dis_content_a .dis_content_a-header {
            width: 50px;
            height: 50px;
            margin-right: 6px;
            border-radius: 100%;
            vertical-align: middle;
        }

        .dis_content_a-user_center {
            display: inline-block;
            height: 50px;
            line-height: 1.5;
        }

        .dis_content_a-text {
            font-size: 16px;
            color: black;
        }

        .dis_content_a-text_a {
            font-size: 13px;
            color: gray;
            margin-top: 4px;
        }

        .dis_content_a-user_right {
            margin-top: 2.5%;
            display: inline-block;
            float: right;
            font-size: 14px;
            padding: 9.5px 12px;
            border-radius: 3px;
        }

        .icon-tiezi {
            position: absolute;
            color: #fff;
        }

        .icon-tiezi {
            font-size: 13px;
            overflow: visible;
            left: 49px;
            top: 40px;
            width: 20px;
            height: 20px;
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            line-height: 20px;
            background: #ff3e0b;
            border-radius: 50%;
        }

        img {
            width: 100%;
        }

        .dis_content_a-user_ft {
            width: 100%;
            height: 40px;
            line-height: 40px;
            font-size: 16px;
            color: #666;
            padding-left: 10px;
        }
        .left {
            width: 100%;
            position: relative;
            margin-left: -0.25rem;
            padding: 2px 0px;
        }
        .right li {
         float: left;
        }
    </style>
</head>
<body>

<div id="shop_list">
    <!--好店模板-->
</div>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-2.1.0.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/template.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js"></script>
<script type="text/javascript">
    var resize = function () {
        var margin = 8;  //分类主图
        var padding = 4;  //图片的间隙
        var window_width = $(window).width();
        var width = window_width - 2 * margin;
        var img_width = (window_width - 2 * padding) / 3;
        img_width = Math.floor(img_width * 10) / 10;
        var img_height = img_width;
        $('.dis_content_a-user_bd').find('div').find('img').width(img_width);
        $('.dis_content_a-user_bd').find('div').find('img').height(img_height);
        $('.dis_content_a-user_bd').find('.top').find('li').attr('style', 'margin:0px; padding:0px; float:left;overflow:hidden;margin-right:' + padding + 'px;margin-bottom:' + padding + 'px;')
        $('.dis_content_a-user_bd').find('.top').find('li:nth-child(3n+3)').attr('style', 'margin:0px; padding:0px; float:left;overflow:hidden;margin-right:0px;')
        $('.dis_content_a-user_bd').find('.bottom').find('li').attr('style', 'margin:0px; padding:0px; float:left;overflow:hidden;margin-right:' + padding + 'px;margin-bottom:0px;')
        $('.dis_content_a-user_bd').find('.bottom').find('li:nth-child(3n+3)').attr('style', 'margin:0px; padding:0px; float:left;overflow:hidden;margin-right:0px;')

    };
</script>
<script type="text/html" id="store_tpl">
    <div class="dis_content_a">
        <div class="dis_content_a-user_hd">
            <a href="javascript:;" data-href="<%=store_info.store_url%>" data-title="<%=store_info.store_name%>"
               class="dis_content_a-moder">
                <img src="<%=store_info.avatar_url%>" class="dis_content_a-header">
                <div class="dis_content_a-user_center">
                    <p class="dis_content_a-text"><%=store_info.store_name%></p>
                    <p class="dis_content_a-text_a"><span><%=store_info.store_collect%></span>人收藏</p>
                </div>
                <div class="dis_content_a-user_right general_border weui-row_active"
                     data-href="<%=store_info.store_url%>" data-title="<%=store_info.store_name%>">进入店铺
                </div>
                <i class="iconfont icon-tiezi"></i>
            </a>
        </div>
        <div class="dis_content_a-user_bd" style="overflow: hidden">
            <div class="top">
                <ul>
                    <li>
                        <a href="javascript:;" data-href="__url1__" data-title="__name1__">
                            <img src="__img1__">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-href="__url2__" data-title="__name2__">
                            <img src="__img2__">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-href="__url3__" data-title="__name3__">
                            <img src="__img3__">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom">
                <ul>


                    <li>
                        <a href="javascript:;" data-href="__url4__" data-title="__name4__">
                            <img src="__img4__">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-href="__url5__" data-title="__name5__">
                            <img src="__img5__">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-href="__url6__" data-title="__name6__">
                            <img src="__img6__">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clear:both"></div>
        </div>
        <!--<div class="dis_content_a-user_ft">
            付费推荐 5.5-6.5
        </div>-->
    </div>
</script>
<script>
    var page = 5;
    var curpage = 1;
    var hasmore = true;
    var param = {};
    var ajax_running = false;
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
        $.getJSON(ApiUrl + "/index.php?con=shop&fun=store_list", param, function (e) {
            if (!e) {
                e = [];
            }
            curpage++;
            hasmore = e.hasmore;
            var html = '';
            for (var k in e.datas.list) {
                console.log(k)
                var v = e.datas.list[k];
                var goods = v.goods_list || [];
                var tmp = template.render('store_tpl', v);
                console.log(goods)
                if (typeof(goods[0]) !== 'undefined') {
                    tmp = tmp.replace('__img1__', goods[0]['goods_img']);
                    tmp = tmp.replace('__url1__', goods[0]['goods_url']);
                    tmp = tmp.replace('__name1__', goods[0]['goods_name']);
                } else {
                    tmp = tmp.replace('__img1__', 'https://guoshizhijiashop.confolsc.com/data/upload/shop/common/default_store_avatar.gif')
                    tmp = tmp.replace('__url1__', '');
                    tmp = tmp.replace('__name1__', 'null');
                }
                if (typeof(goods[1]) !== 'undefined') {
                    tmp = tmp.replace('__img2__', goods[1]['goods_img']);
                    tmp = tmp.replace('__url2__', goods[1]['goods_url']);
                    tmp = tmp.replace('__name2__', goods[1]['goods_name']);
                } else {
                    tmp = tmp.replace('__img2__', 'https://guoshizhijiashop.confolsc.com/data/upload/shop/common/default_store_avatar.gif')
                    tmp = tmp.replace('__url2__', '');
                    tmp = tmp.replace('__name2__', 'null');
                }
                if (typeof(goods[2]) !== 'undefined') {
                    tmp = tmp.replace('__img3__', goods[2]['goods_img']);
                    tmp = tmp.replace('__url3__', goods[2]['goods_url']);
                    tmp = tmp.replace('__name3__', goods[2]['goods_name']);
                } else {
                    tmp = tmp.replace('__img3__', 'https://guoshizhijiashop.confolsc.com/data/upload/shop/common/default_store_avatar.gif')
                    tmp = tmp.replace('__url3__', '');
                    tmp = tmp.replace('__name3__', 'null');
                }
                if (typeof(goods[3]) !== 'undefined') {
                    tmp = tmp.replace('__img4__', goods[3]['goods_img']);
                    tmp = tmp.replace('__url4__', goods[3]['goods_url']);
                    tmp = tmp.replace('__name4__', goods[3]['goods_name']);
                } else {
                    tmp = tmp.replace('__img4__', 'https://guoshizhijiashop.confolsc.com/data/upload/shop/common/default_store_avatar.gif')
                    tmp = tmp.replace('__url4__', '');
                    tmp = tmp.replace('__name4__', 'null');
                }
                if (typeof(goods[4]) !== 'undefined') {
                    tmp = tmp.replace('__img5__', goods[4]['goods_img']);
                    tmp = tmp.replace('__url5__', goods[4]['goods_url']);
                    tmp = tmp.replace('__name5__', goods[4]['goods_name']);
                } else {
                    tmp = tmp.replace('__img5__', 'https://guoshizhijiashop.confolsc.com/data/upload/shop/common/default_store_avatar.gif')
                    tmp = tmp.replace('__url5__', '')
                    tmp = tmp.replace('__name5__', 'null');
                }
                if (typeof(goods[5]) !== 'undefined') {
                    tmp = tmp.replace('__img6__', goods[5]['goods_img']);
                    tmp = tmp.replace('__url6__', goods[5]['goods_url']);
                    tmp = tmp.replace('__name6__', goods[5]['goods_name']);
                } else {
                    tmp = tmp.replace('__img6__', 'https://guoshizhijiashop.confolsc.com/data/upload/shop/common/default_store_avatar.gif')
                    tmp = tmp.replace('__url6__', '');
                    tmp = tmp.replace('__name6__', 'null');
                }
                html += tmp;
            }
            $('#shop_list').append(html);
            resize();
            ajax_running = false;
        })
    }

    $(function () {
        $('#shop_list').on('click', '*[data-href]', function () {
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
        get_list();
        $(window).scroll(function () {

            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {

                get_list()

            }

        });
    })
</script>
</body>
</html>



