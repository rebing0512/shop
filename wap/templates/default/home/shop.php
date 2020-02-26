<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_products_list.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_member.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_common.css">

<style type="text/css">

    .nctouch-inp-con ul li h4{width:3.8rem}

    .rzs_info{ width:100%; margin-top:10px; overflow:hidden; background:#FFF; padding-top:10px; padding-bottom:10px;float:left;}

    .rzs_info dl{ width:95%; margin:auto; overflow:hidden;}

    .rzs_info dl span{ width:20%; float:left; overflow:hidden}

    .rzs_info dl span img{ display:block; width:90%; float:left; height:auto;}

    .rzs_info dl dt{ width:64%; float:left;}

    .rzs_info dl dt strong{ width:100%;font-size:20px; line-height:200%;color:#333;font-weight:400;}

    .rzs_info dl dt strong a{color:#333;}

    .rzs_info dl dt p{ width:100%; height:1rem;font-size:0.5rem; line-height:1rem; color:#999;}

    .rzs_info dl dt p img{margin-top:6px;}

    .rzs_info dl dd{ width:auto;}

    .rzs_info dl dd i{ display:block; height:25px; font-size:12px; line-height:25px; color:#FFF; background:#F60; text-align:center; margin-top:0px;padding:0 12px;float:right;border-radius:4px;}



    .rzs_info ul{width:95%; margin:auto; overflow:hidden;}

    .rzs_info ul li{ width:33.3%; float:left; height:50px; text-align:center;clear: none;}

    .rzs_info ul li span{float:left; font-size:13px; line-height:40px; color:#666;}

    .rzs_info ul li strong{float:left; font-size:13px; line-height:40px; color:#DD2726; font-weight:normal; text-align:left}

    .rzs_info ul li em{ float:left; width:13px; height:13px;font-size:10px; line-height:15px; color:#fff;border-radius: 3px; background:#DD2726; text-align:center; margin-left:1px; margin-top:12px; }

    .rzs_img{ width:100%; overflow:hidden}

    .rzs_img img{ width:100% !important; height:auto !important}

    .s_dianpu{ width:100%; margin-top:1rem;display: inline-block; overflow:hidden;}

    .s_dianpu span{ display:block; float:left; width:50%; height:32px;}

    .s_dianpu span a{ display:block; width:70%;height:30px; border:1px solid #0094DE;border-radius:3px; font-size:14px; line-height:30px; text-align:center; text-indent:20px;position:relative; color:#333;}

    .bg1{ display:block; width:25px; height:25px; position:absolute; background:url(<?php echo MOBILE_TEMPLATES_URL;?>/images/rzs.png) no-repeat;background-size: auto 50px;  background-position:0 -5px; margin-top:5px; left:15%;}

    .bg2{ display:block; width:25px; height:25px; position:absolute; background:url(<?php echo MOBILE_TEMPLATES_URL;?>/images/rzs.png) no-repeat;background-size: auto 50px;  background-position:0 -29px; margin-top:6px;left:15%;}

    .index_taocan{overflow-x:auto;margin-top:20px;}

    .index_taocan dl{ width:33%;float:left; overflow:hidden;margin-bottom:10px;border:1px solid #dadada;border-left:none;padding:10px 0 30px; border:none;}

    .index_taocan dl dt{ width:100%; overflow:hidden; position:relative;}

    .index_taocan dl dt em{ display:block; width:90%; height:20px; position:absolute; margin-left:5%; bottom:0px;background-color:rgba(0,0,0,0.5); font-size:12px; line-height:20px; text-align:center; color:#FFF}

    .index_taocan dl dt img{ display:block; width:90%; margin:auto;}

    .index_taocan dl dd{ width:90%; height:20px;margin-top:8px; margin-left:5%;line-height:20px; font-size:12px; color:#666; overflow:hidden;}

    .leixing {

        color: #FFF;

        background: #08f none repeat scroll 0% 0%;

        font-size: 0px;

        padding: 0px 0px;

        border-radius: 5px;



        float: left;

        line-height:12px;

        margin:10px 8px 0 0;

    }

    .goods-raty b{

        font-weight: normal;

        color: #666;

        font-size: 0.65rem;

    }

    .goods-raty i {

        display: inline-block;

        height: 0.5rem;

        background-image: url(<?php echo MOBILE_TEMPLATES_URL;?>/images/star_r.png);

        background-repeat: repeat-x;

        background-position: 0 0;

        background-size: contain;

    }

    .goods-raty i.star1 { width: 0.5rem;}

    .goods-raty i.star2 { width: 1rem;}

    .goods-raty i.star3 { width: 1.5rem;}

    .goods-raty i.star4 { width: 2rem;}

    .goods-raty i.star5 { width: 2.5rem;}


    /*店铺街*/
    .store-layout {margin-top:20px;padding:0 0.2em 0 0.5em;}
    .store-cate {width:100%}
    .store-cate li{display:inline-block;width:50%;float:left;height:1.4em;text-align:center;margin-bottom:10px;}
    .store-cate li a{font-size:16px;color:#333;height:2.4em;line-height:2.4em;background: #e6e7e9;display: block;margin-right:10px;}
    .store-cate .active{background:#820000;}
    .store-cate .active {color:#fff;}

    .stroe-recommend h3{colro:#898989;font-size:16px; margin-top:20px;text-align:center;}
    .header-inp {margin:0.275rem 4rem 0rem 2.5rem}
    .stroe-search-btn {
        float: right;
        position: relative;
        top: -1.5em;
        padding-right: 0.4em;
        font-size: 0.9em;
        color: #999;
        right: 30px;
    }
    .header-inp {
        border-radius: 0.3rem;
    }
</style>
</head>
<body>
<div class="pre-loading">

    <div class="pre-block">

        <div class="spinner"><i></i></div>

        数据读取中...

    </div>

</div>
<!-- <header id="header" class="fixed">

  <div class="header-wrap">

  	<div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>

    <div class="header-tab"><a href="<?php echo urlMobile('shop');?>" class="cur">所有店铺</a><a href="<?php echo urlMobile('shop','shopclass');?>">店铺分类</a></div>

    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>

  </div>

<!--    --><?php //include template('layout/toptip');?>
</header>
<div class="nctouch-main-layout fixed-Width" style="margin-top:0;background:#fff">
    <div style="background:#ccc;padding-bottom:10px;">
        <div class="nctouch-inp-con" style="display:none;">
            <ul class="form-box">
                <li class="form-item">
                    <h4 style="width:24%">店铺所在地：</h4>
                    <div class="input-box" style="width:70%;float:right">
                        <input name="area_info" type="text" class="inp" id="area_info" autocomplete="off" onChange="btn_check($('form'));" placeholder="请选择店铺地区" readonly />  <span class="input-del"></span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="header-wrap" style="padding-top:3px;">
            <a href="javascript:void(0);"  class="header-inp" id="keyword_a"> <i class="icon"></i>
                <input type="text" class="search-input" oninput="writeClear($(this));"  name="keyword"  placeholder="输入关键词搜索店铺" maxlength="50" autocomplete="on" style="width:80%" id="keyword_shop"/>
            </a>
            <a id="serach_store" href="javascript:void(0);" class="stroe-search-btn">搜索</a>
        </div>

    </div>

    <!-- store category -->
    <script type="text/html" id="category_list">
        <ul>
            <% for (i = 0; i < category_list.length; i++) { %>
            <li><a href="javascript:void(0);" value="<%=category_list[i]['sc_id']%>"  class="store_category"> <%=category_list[i]['sc_name']%> </a></li>
            <% } %>
        </ul>
    </script>

    <!-- store item -->
    <script type="text/html" id="store_item">
        <% for (i = 0; i < store_list.length; i++) { %>
        <a href="<%=store_list[i]['url']%>">
            <dl>
                <dt><img src="<?=UPLOAD_SITE_URL.DS.ATTACH_PATH.DS?>store/<%=store_list[i]['logo']%>" class="B_eee"></dt>
                <dd><%=store_list[i]['name']%></dd>
            </dl>
        </a>
        <% } %>
    </script>

    <div class="" id="stores_container">
        <div class="store-layout">
            <div class="store-cate" id="category_list_container">
                <ul>

                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div style="clear: both"></div>
        <div class="stroe-recommend">
            <h3>已开通店铺</h3>
            <div class="index_taocan" id="ykt_stores">

            </div>
            </div>
        </div>
    <div style="clear: both"></div>
        <div class="stroe-recommend">
            <h3>未开通店铺</h3>
            <div class="index_taocan" id="wkt_stores">

            </div>
            </div>
        </div>
<div style="clear: both"></div>
    </div>
    <div style="margin-top:100px"></div>
    <?php //require_once template('footer-nav');?>
</body>




<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/template.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js?v=<?php echo date('YmdHi'); ?>"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/simple-plugin.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/swipe.js?v=2"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/shop.js?v=33623423"></script>

<script>
    var MBCoreSlideWapInc = function(flag,height){
        // 页面整体向下/上

    }
</script>
