<?php defined('TTShop') or exit('Access Invalid!'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_common.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_store.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/index.css">

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

<header id="header" class="nctouch-store-header ">

    <div class="header-wrap">

        <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>

        <a class="header-inp" id="goods_search" href=""><i class="icon"></i><span
                class="search-input">搜索店铺内商品</span></a>
        <!--
            <div class="header-r"> <a id="store_categroy" href="" class="store-categroy"><i></i>

              </a> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>
        -->
    </div>

    <?php include template('layout/toptip'); ?>

</header>

<div class="nctouch-main-layout fixed-Width mb25">

    <div id="store-wrapper" class="nctouch-store-con">

        <!-- banner  <div class="nctouch-store-top" id="store_banner"></div>-->
        <div class="banner">
            <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/guan_02.jpg">

            <div class="imgs" style="margin:2vw 2vw;"><img
                    src="<?= getStoreLogo($output['store_info']['store_avatar']) ?>"></div>
            <p><?php echo $output['store_info']['store_name']; ?><i style="color: #710808"> | </i>Artist</p>
        </div>

        <section class="text" style="background-color: white;margin-top: -10px;">
            <p style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 5;overflow: hidden;"><?php echo $output['store_info']['store_description']; ?></p>
            <?php if (!empty($output['store_info']['intro'])) { ?>
                <p style="text-align: right;padding: 20px 10px;font-size: .6rem;}">
                    <a href="<?php echo $output['store_info']['intro']; ?>" style="color: #750000;">
                        + 详情
                    </a>
                </p>
            <?php } ?>
        </section>

        <!--
      <section class="coll" style="margin-top: 10px;background-color: white;">
          <a href="<?php echo $output['store_info']['intro']; ?>">
          <div class="coll_l"><img src="<?php echo UPLOAD_SITE_URL . '/' . ATTACH_STORE . '/' . $output['store_info']['store_label']; ?>">
              <div style="    float: right;
    position: relative;
    width: 45vw;line-height: 2vw;">
                  <span style="font-size:.7rem;color: black;font-weight: 900;position: absolute;margin: 5px 0;">
                      <?php echo trim($output['store_info']['store_type']) == 1 ? '巧匠营' : '大师坊'; ?>——<?php echo $output['store_info']['store_name']; ?>
                  </span><br>
                  <span style="font-size: 13px;color: #7d7d7d;position:absolute;    padding: 10px 0;line-height: 4vw;">

                      <?php echo $output['store_info']['talk']; ?>

                  </span>

                  <br>
                  <span style="font-size: 10px;color: #c1c1c1;">
                      1天前|福州市民间艺术馆
                  </span>

              </div>
          </div>
          <div class="clear"></div>
          </a>
      </section>
-->
        <!-- 导航条

        <div id="nav_tab_con" class="nctouch-single-nav nctouch-store-nav">

          <ul id="nav_tab">

            <li class="selected"><a href="javascript: void(0);" data-type="storeindex"><i class="store"></i>店铺首页</a></li>

            <li><a href="javascript: void(0);" data-type="allgoods"><i class="goods"></i>全部商品</a></li>

            <li><a href="javascript: void(0);" data-type="newgoods"><i class="new"></i>商品上新</a></li>

            <li><a href="javascript: void(0);" data-type="storeactivity"><i class="sale"></i>店铺活动</a></li>

          </ul>

        </div>
    -->


        <!-- 首页s -->

        <div id="storeindex_con" style="position: relative; z-index: 1;">

            <!-- 轮播图

            <div class="nctouch-store-block">

              <div id="store_sliders" class="nctouch-store-wapper nctouch-store-sliders"></div>

            </div>
      -->
            <!-- 店铺排行榜

            <div class="nctouch-store-block nctouch-store-ranking">

              <div class="title">店铺排行榜</div>

              <div class="nctouch-single-nav">

                <ul id="goods_rank_tab">

                  <li><a href="javascript: void(0);" data-type="collect">收藏排行</a></li>

                  <li><a href="javascript: void(0);" data-type="salenum">销量排行</a></li>

                </ul>

              </div>

              <div class="top-list" nc_type="goodsranklist" id="goodsrank_collect"></div>

              <div class="top-list" nc_type="goodsranklist" id="goodsrank_salenum"></div>

            </div>
      -->
            <!-- 店主推荐

            <div class="nctouch-store-block">

              <div class="title">店主推荐</div>

              <div class="nctouch-store-goods-list" id="goods_recommend"></div>

            </div>

          </div><%=v.goods_image_url;%>
      -->

            <script type="text/html" id="goods_list_tpl">
                <% for (var k in rec_goods_list) { var v = rec_goods_list[k];%>
                <li>
                    <a href="<?php echo urlMobile('goods', 'detail'); ?>&goods_id=<%=v.goods_id;%>"><img id="pic"
                                                                                                         src="<%=v.goods_image_url;%>"
                                                                                                         alt=""></a>
                    <div style="line-height: 1.3rem;">
                        <a href="<?php echo urlMobile('goods', 'detail'); ?>&goods_id=<%=v.goods_id;%>"
                           style="color: #525252;"><%=v.goods_name;%></a>
                        <% if(v.goods_price == 0.01){ %>
                        <div style="color: #c8000b;"><%='私洽';%></div>
                        <% } else if (v.goods_price == 0.02){ %>
                        <div style="color: #c8000b;"><%='价格待询';%></div>
                        <% }else{ %>
                        <div style="color: #c8000b;padding-left: 0.2rem">
                            ￥<%=v.goods_price;%>
                            <a href="javascript:void(0);">
                                <img src="<?php echo RESOURCE_SITE_URL; ?>/images/index_icon/car.png"
                                     data-ik="<%=v.goods_id;%>" class="add-cart" style="width: 15%;float: right;"/>
                            </a>
                        </div>
                        <% } %>
                    </div>
                </li>
                <% } %>
            </script>


            <!-- 首页e -->

            <!-- 全部宝贝 -->
            <div style="background-color: white;margin-top: 10px;">
                <?php if ($output['num'] > 0) { ?>
                    <p style="font-size: .8rem;padding: 15px 0;text-align: center;color: #b10013;">个人作品</p>
                <?php } ?>
                <ul id="allgoods_con" class="final tem" style="margin-top: 0;"></ul>

                <!-- 商品上新 -->

                <div id="newgoods_con" class="nctouch-store-goods-list">
                    <ul id="newgoods"></ul>
                </div>

                <!-- 店铺活动 -->

                <div id="storeactivity_con"></div>
            </div>
        </div>

    </div>

    <div class="fix-block-r">

        <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>

    </div>

    <div id="store_voucher_con"></div>


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

