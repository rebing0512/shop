<?php defined('TTShop') or exit('Access Invalid!'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_common.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_store.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/index.css">

<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/jquery-weui.min.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/weui.min.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/swiper.min.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/store.css" />
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
</style>
</head>

<body>
<section style="margin-top: 0;">
    <div class="nav">
        <div class="weui_panel_bd">
            <a href="javascript:void(0);" class="nav_a">
                <div class="nav_a_l">
                    <img class="nav_a_l_thumb" src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/store/1.jpg" alt="">
                </div>
                <div class="nav_a_c">
                    <h4 class="nav_a_c_title">红木e家</h4>
                    <p class="nav_a_c_desc">全球品种最全一站式红木批发平台</p>
                </div>
                <div class="nav_a_r">
                    坚持裸照<br/>素颜呈现
                </div>
            </a>

        </div>
    </div>

    <?php if ($output['store_info']['store_type']==0):?>
    <div class="section">
        <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/store/01_05.jpg">

        <div class="section_img">
            <a href="javascript:;"><img src="<?=getStoreLogo($output['store_info']['store_avatar'])?>"/></a>
            <p class="section_img2"><img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/store/12.jpg"></p>
        </div>
    </div>
    <div class="section_body">

        <div class="section_body_name"><?=$output['store_info']['store_name']?></div>
        <div class="section_body_text">
            <p class="section_body_text_l"><?=$output['store_info']['store_collect']?>粉丝</p>
            <p class="section_body_text_r" data-store_id="<?=$output['store_info']['store_id']?>"><img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/store/13.jpg">关注</p>
        </div>

    </div>
<?php elseif ($output['store_info']['store_type']==1):?>

        <div class="store_nav">
            <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/store/01_05.jpg">

            <div class="store_nav_img">
                <a href="javascript:;"><img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/store/2.jpg" /></a>
                <p class="store_nav_name"><?=$output['store_info']['store_name']?><br/>
                    <span class="store_nav_name1">钻石店铺</span>
                </p>

            </div>
            <p class="store_nav_guanzhu">关注</p>
            <div class="store_nav_fensi">
                <p><?=$output['store_info']['store_collect']?></p>粉丝</div>
        </div>

    <?php endif;?>

    <div class="article">
        <div class="weui_tab" id='page-ptr-navbar'>
            <div class="weui_navbar">
                <a href='#tab1' class="weui_navbar_item weui_bar_item_on">
                    店铺首页
                </a>
                <a href='#tab2' class="weui_navbar_item">
                    全部宝贝
                </a>
                <a href='#tab3' class="weui_navbar_item">
                    商品上新
                </a>
                <a href='#tab4' class="weui_navbar_item">
                    店铺活动
                </a>
            </div>
            <div class="weui_tab_bd">
                <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">

                </div>
                <div id="tab2" class="weui_tab_bd_item">
                    <div class="tab1_body_ft">
                        <div class="weui-row final" id="allgoods_con">
                            <!--商品模版加载位置-->
                        </div>
                    </div>
                </div>
                <div id="tab3" class="weui_tab_bd_item">

                    <h1 class="doc-head">页面三</h1>
                </div>
                <div id="tab4" class="weui_tab_bd_item">
                    <div class="acheck1">
                        <h1 class="doc-head">11111</h1>
                        <h2>1133</h2>
                        <div style="text-align: justify;">到哪里吃饭你收到了到哪里吃饭你收到了到哪里吃饭你收到了到哪里吃饭你收到了到哪里吃饭你收到了到哪里吃饭你收到了到哪里吃饭你收到了</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab1_body_tt">
        <div class="weui-row">
            <div class="weui-col-33">
                商家信息
            </div>
            <span>|</span>
            <div class="weui-col-33">
                店铺分类
            </div>
            <span>|</span>
            <div class="weui-col-33">
                联系客服
            </div>

        </div>
    </div>
</section>
</body>

            <script type="text/html" id="goods_list_tpl">
                <% for (var k in rec_goods_list) { var v = rec_goods_list[k];%>
                    <div class="weui-col-50">
                        <a href="<?php echo urlMobile('goods', 'detail'); ?>&goods_id=<%=v.goods_id;%>">
                            <div class="tab1_body_img"><img src="<%=v.goods_image_url;%>" /></div>
                            <p class="tab1_body_text1"><%=v.goods_name;%></p>
                            <p class="tab1_body_text2">
                                <% if(v.goods_price == 0.01){ %>
                                私洽
                                <% } else if (v.goods_price == 0.02){ %>
                                价格待询
                                <% }else{ %>
                                    ￥<%=v.goods_price;%>
                                <% } %>
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

    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/store.js"></script>

    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/addcart.js"></script>

    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-weui.min.js" ></script>

