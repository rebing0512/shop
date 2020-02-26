<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_products_list.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_common.css">

<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/amazeui.min.css" />

<style type="text/css">
    html,
    body {
        font-family: PingFang-SC-Regular, Helvetica Neue, Helvetica, microsoft yahei, sans-serif;
        color: #555;
        overflow: Scroll;
        overflow-x: hidden;
        background-color: white;
        font-size:12px !important;

    }

    .am-tabs-default .am-tabs-nav>.am-active a {
        background-color: white;
        line-height: 37px;
    }
    .am-tabs-default .am-tabs-nav {
        line-height: 37px;
        background-color: white;
        border-bottom: 1px solid whitesmoke;
    }
    .am-tabs-default .am-tabs-nav li:nth-child(2n+1){
        border-right: 1px solid whitesmoke;
    }
    .am-tabs-bd{border: none;}
    .am-thumbnail {
        background-color: white;
        border:none;
        margin-bottom: 0.8rem;
        padding: 0rem;
    }
    .am-thumbnails {
        margin-left: 0rem;

    }
    .am-tabs-bd .am-tab-panel{
        padding: 0 0 1rem;
    }
    .am-tab-panel_nav{
        padding: 2rem 1rem .5rem;
        font-size: 1.1rem;
        color: gray;
    }
    .am-avg-sm-4>li {
        padding:0.48rem;
        font-size: 0.6rem;
    }
    .am-tabs-bd div li {
        text-align: center;
        font-size: 1rem;
        -webkit-transform:scale(0.9);
    }
    .am-tabs-default .am-tabs-nav a {
        font-size: 1.3rem;
    }
    .am-avg_b li img {border-radius: 50%;}
    .header-l a{
        padding: 0rem;
        margin-top: 1.1rem;
        margin-left: .6rem;
    }
    .header-r a{
        width: 1.95rem;
        height: 1.95rem;

    }
    .nctouch-nav-menu{width: 8rem;top:2rem;right:0.2rem;}
    .nctouch-nav-menu .arrow {
        margin-right: 0.7rem;
        border-width: 0.7rem;
    }
    .nctouch-nav-menu ul{
        margin-top: 0rem;
        padding-left: 0rem;
    }
    .nctouch-nav-menu li a{
        height: 2.8rem;
        padding-left: 0.6rem;
        padding-top: 1rem;
        font-size: 1.1rem;
    }

    .nctouch-nav-menu li a i {
        width: 1rem;
        height: 1rem;
        vertical-align: bottom;
    }
    .header-inp .search-input{
        height: 3.4rem;
        line-height: 2.3rem;
        font-size: 1.2rem;
    }
    .am-tabs-default .am-tabs-nav a {
        line-height: 37px;
    }
    [data-am-widget=tabs] {
         margin: 0px;
    }
    header.fixed{
        height: 4rem;
    }
    .header-inp{
        height: 2.7rem !important;
    }
    .nctouch-product-header .header-inp{
        margin: .7rem 3.5rem 0 3.5rem !important;

    }
    .header-inp .icon{
        width: 2.3rem;
        height: 2.3rem;
        margin: .1rem 0.4rem;
    }
    .nctouch-product-header .header-r a{
        padding: 0 !important;
        margin:1rem 0.6rem 0.5rem 0.3rem ;
    }
    .header-r a{
        width: 2rem;
        height: 2rem;
    }
    .header-l a{
        width: 2rem;
        height: 2rem;
    }
    .texture_a {
        font-size: 10px;
        -webkit-transform: scale(0.8);
        display: block;
    }
    .all-texture{
        width: 60%;
        text-align: center;
        background-color: rgba(249, 245, 244, 0.4);
        margin: auto;
        padding: 2px 0;
        border-radius: 5px;
    }
    .iconfont{
        /*margin-top: -6px;*/
        font-size: 22px;
        /*font-weight: 600;*/
        color: white;
    }
</style>


</head>

<body>
<header id="header" class="nctouch-product-header fixed" style="z-index:999">

    <div class="header-wrap">

        <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="iconfont icon-arrowleft"></i> </a> </div>

        <div class="header-inp"> <i class="icon"></i> <span class="search-input">请输入搜索关键词</span> </div>

        <div class="header-r"><!-- <a href="<?php echo urlMobile('goods_class');?>" class="categroy"><i></i>

      </a>--> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>

    </div>

    <?php include template('layout/toptip');?>

</header>

<div data-am-widget="tabs" class="am-tabs am-tabs-default" style="margin-top: 4rem;">
    <ul class="am-tabs-nav am-cf">
        <li class="am-active <?=$output['title'][0]['class']?>">
            <a href="javascript:void(0);"><?=$output['title'][0]['name']?></a>
        </li>
        <li class="<?=$output['title'][1]['class']?>" style="display: none;">
            <a href="javascript:void(0);"><?=$output['title'][1]['name']?></a>
        </li>

    </ul>
    <div class="am-tabs-bd">
        <?php if ($output['sort'] == 'kind') { ?>
            <div class="am-tab-panel am-active" id="category">
                <div class="am-u-sm-10 am-avg-sm-3 am-avg-lg-10 am-thumbnails am-tab-panel am-fade am-in am-active">
                    <?php foreach ($output['ch']['kinds'] as $key=>$value){?>
                        <div class="am-avg-sm-4 am-avg_a">
                            <div class="am-tab-panel_nav" data-id="<?=$value['id']?>"><?=$value['name']?></div>
                            <?php if (!empty($value['attributes'])):?>
                                <?php foreach ($value['attributes'] as $k=>$v){?>
                                    <li data-id="<?=$v['id']?>"><img class="am-thumbnail" src="<?=$v['image']?>" /><?=$v['name']?></li>
                                <?php } ?>
                            <?php endif;?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="am-tab-panel" id="attribute">
                <div class="am-u-sm-10 am-avg-sm-3 am-avg-lg-10 am-thumbnails am-tab-panel am-fade am-in am-active">
                    <div class="am-avg-sm-4 am-avg_b">
                        <div class="am-tab-panel_nav">材质选择</div>

                        <?php foreach ($output['ch']['textures'] as $key=>$value):?>
                            <li data-id="<?=$value['id']?>">
                                <img class="am-thumbnail" src="<?=$value['image']?>" />
                                <?php if (empty($value['sub_name'])):?>
                                    <?=$value['name']?>
                                <?php else:?>
                                    <?=$value['sub_name']?><br/>
                                    <span class="texture_a"> (<?=$value['name']?>)</span>
                                <?php endif;?>
                            </li>
                        <?php endforeach;?>
                        <div class="jiange" style="clear: both"></div>
                        <div class="all-texture weui-row_active">其他材质请点击此条目</div>
                    </div>
                </div>
            </div>
        <?php } elseif ($output['sort'] == 'texture') { ?>
            <div class="am-tab-panel am-active" id="attribute">
                <div class="am-u-sm-10 am-avg-sm-3 am-avg-lg-10 am-thumbnails am-tab-panel am-fade am-in am-active">
                    <div class="am-avg-sm-4 am-avg_b">
                        <div class="am-tab-panel_nav">材质选择</div>
                        <?php foreach ($output['ch']['textures'] as $key=>$value):?>
                            <li data-id="<?=$value['id']?>">
                                <img class="am-thumbnail" src="<?=$value['image']?>" />
                                <?php if (empty($value['sub_name'])):?>
                                    <?=$value['name']?>
                                <?php else:?>
                                    <?=$value['sub_name']?><br/>
                                    <span class="texture_a"> (<?=$value['name']?>)</span>

                                <?php endif;?>
                            </li>
                        <?php endforeach;?>
                        <div class="jiange" style="clear: both"></div>
                        <div class="all-texture weui-row_active">其他材质请点击此条目</div>
                    </div>
                </div>
            </div>
            <div class="am-tab-panel" id="category">
                <div class="am-u-sm-10 am-avg-sm-3 am-avg-lg-10 am-thumbnails am-tab-panel am-fade am-in am-active">
                    <?php foreach ($output['ch']['kinds'] as $key=>$value){?>
                        <div class="am-avg-sm-4 am-avg_a">
                            <div class="am-tab-panel_nav" data-id="<?=$value['id']?>"><?=$value['name']?></div>
                            <?php foreach ($value['attributes'] as $k=>$v){?>
                                <li data-id="<?=$v['id']?>"><img class="am-thumbnail" src="<?=$v['image']?>" /><?=$v['name']?></li>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

</body>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-2.1.0.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/template.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<script>
    var keyword = decodeURIComponent(getQueryString("keyword"));
    $(function () {
        $("#header").on("click", ".header-inp",

            function() {

                location.href = ApiUrl + "/index.php?con=goods&fun=search&keyword="+keyword

            });
        <?php if ($output['sort'] == 'kind') { ?>
            var category_id = null;
            var attribute_id = null;
            $(function () {
                $('#category li').click(function () {
                    category_id = $(this).attr('data-id');
                    <?php if ($output['classify']):?>
                    location.href = '<?php echo urlMobile('goods','list'); ?>&category_id=<?= $_SESSION['__ccid'] ?>&attribute_id=' + category_id;
                    return;
                    <?php endif;?>
                    $('.category').removeClass('am-active');
                    $('.category').hide();
                    $('.attribute').addClass('am-active');
                    $('#category').removeClass('am-active');
                    $('#attribute').addClass('am-active');
                })
                $('.category').click(function () {
                    category = null;
                    $('.category').addClass('am-active');
                    $('.category').show();
                    $('.attribute').removeClass('am-active');
                    $('#category').addClass('am-active');
                    $('#attribute').removeClass('am-active');
                })
                $('.all-texture').click(function () {
                    var url = '&category_id='+'<?=$_SESSION['__ccid']?>'+'&attribute_id='+category_id;
                    location.href = '<?php echo urlMobile('goods','list'); ?>'+url;
                })
                $('#attribute li').click(function () {
                    attribute_id = $(this).attr('data-id');
                    var url = '&category_id='+'<?=$_SESSION['__ccid']?>'+'&attribute_id='+category_id+'&texture_id='+attribute_id;
                    location.href = '<?php echo urlMobile('goods','list'); ?>'+url;
                })
            })
        <?php } elseif ($output['sort'] == 'texture') {?>
            var category_id = null;
            var attribute_id = null;
            $(function () {
                $('#attribute li').click(function () {
                    attribute_id = $(this).attr('data-id');
                    <?php if ($output['classify']):?>
                    location.href = '<?php echo urlMobile('goods','list'); ?>&category_id=<?= $_SESSION['__ccid'] ?>&attribute_id=' + attribute_id;
                    return;
                    <?php endif;?>
                    $('.attribute').removeClass('am-active');
                    $('.category').addClass('am-active');
                    $('.category').show();
                    $('#attribute').removeClass('am-active');
                    $('#category').addClass('am-active');
                })
                $('.attribute').click(function () {
                    attribute_id = null;
                    $('.attribute').addClass('am-active');
                    $('.category').removeClass('am-active');
                    $('.category').hide();
                    $('#attribute').addClass('am-active');
                    $('#category').removeClass('am-active');
                })
                $('.all-texture').click(function () {
                    attribute_id = null;
                    $('.attribute').removeClass('am-active');
                    $('.category').addClass('am-active');
                    $('.category').show();
                    $('#attribute').removeClass('am-active');
                    $('#category').addClass('am-active');
                    //var url = '&category_id='+'<?=$_SESSION['__ccid']?>'+'&attribute_id='+category_id;
                    //location.href = '<?php echo urlMobile('goods','list'); ?>'+url;
                })
                $('#category li').click(function () {
                    category_id = $(this).attr('data-id');
                    var url = '&category_id='+'<?=$_SESSION['__ccid']?>'+'&attribute_id='+category_id+'&texture_id='+attribute_id;
                    location.href = '<?php echo urlMobile('goods','list'); ?>'+url;
                })
            })
        <?php } ?>
    })
</script>