<?php defined( 'TTShop') or exit( 'Access Invalid!');?>
<?php
function swiperLink($slide) {

    $module = $action = $args = '';

    switch ($slide['type'])
    {
        case 'goods':
            $module = 'goods';
            $action = 'detail';
            $args = array('goods_id'=>$slide['object']);
            return urlMobile($module,$action,$args);
            break;

        case 'store':
            $module = 'store';
            $action = 'index';
            $args = array('store_id'=>$slide['object']);
            return urlMobile($module,$action,$args);
            break;

        case 'url':
            $args = $slide['object'];
            return $args;
            break;
    }


}
?>
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/index.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/swiper.min.css" />

<style>
    body{-webkit-text-size-adjust:none}
    section{
        background-color:white;
        padding-top:8px;
    }
    .back{
        position: relative;
        width: 98%;
        height: 17%;
    }
    #swiper {
        width:100%;
    }
    #swiper > .swiper-wrapper > .swiper-slide > img {
        width:100%;
    }
    #swiper > .swiper-wrapper > .swiper-slide {
        float:left;
    }
    #taobao {
        width:100%;
        margin-top: .4rem;
    }
    #taobao > .swiper-wrapper > .swiper-slide > img {
        width:100%;
    }
    #taoba > .swiper-wrapper > .swiper-slide {
        float:left;
    }
    .swiper-pagination-bullet{
        width: 4px;
        height:4px;
    }
    .swiper-container-horizontal>.swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction{
        bottom: 3px;
    }
    .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet {
        margin: 0 2.5px;
    }
    #xiangdu {
        width:100%;
        margin-top: .4rem;
    }
    #xiangdu > .swiper-wrapper > .swiper-slide > img {
        width:100%;
    }
    #xiangdu > .swiper-wrapper > .swiper-slide {
        float:left;
    }
    .mbcore_inlinetext {
        /*font-weight:bolder;*/
        padding: 10px 0 20px 0;
        font-size: .5rem;
        width: 100%;
        text-align: center;
    }
    .mbcore_inlinetext a{
        width: 23%;
        color: black;
        margin: 0;
        display: inline-block;
    }
    .mbcore_inlinetext a {
        font-size: .6rem;
        -webkit-transform: scale(0.9);
    }
    #maskLayer{
        height:100%;
        position: fixed;
        z-index: 100;
        background-color:#000000;
        -moz-opacity:0.5;
        filter:alpha(opacity=50);
    }
    .txt p{
        color: #7A1B27;
        font-weight:400;
    }
    .txt p{
        font-size: 14px;
    }
    .swiper-container3{margin:0 auto;position:relative;overflow:hidden;z-index:1}
    .final p {
        padding: 3%;
        padding-left: 0px;
        /*margin-left: -20px;*/
        font-size: 14px;
        height: 35px;
        overflow: hidden;
        text-overflow: ellipsis;
        /*white-space: nowrap;*/
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .g_top a{
        color: white;
        position: relative;
        font-size: 15px;
        top: 20vh;
        margin-left: 23.5vw;
    }
    .g_top img{
        width: 5%;
        vertical-align: sub;
    }
    .g_in img{
        width: 100%;
    }
    .kengdie{
        height: 100%;
        background-color: black;
        bottom: 0;
        position: fixed;
        width: 100%;
        filter:alpha(opacity=50);
        -moz-opacity:0.5;
        -khtml-opacity: 0.5;
        opacity: 0.5;
        z-index: -1;
    }
    h3{
        /*font-weight: bold;*/
        font-size:.6rem;
        -webkit-transform:scale(0.9);
    }
    p img{
        float: right;
        vertical-align: middle;
    }
    .dh{
        position: fixed;
        width: 100vw;
        margin: 0 auto;
        padding: 20px 0 20px 0;
        top: 7%;
        background: white;
    }
    .yimeng_camera {
        position: fixed;
        bottom: 6rem;
        right: 0.5rem;
        width: 1.1rem;
        height: 1.1rem;
        border-radius: 50%;
        padding: 0.5rem;
        background-color: #862627;
        z-index: 1000;
    }
    .yimeng_camera img {
        width: 100%;
    }
    .navd{
        background-color: white;
        padding: 0rem 0rem 0.5rem 0rem;
    }
    txt>li>a {
        font-size: .585rem;
    }
    .txt>li{
        margin-top: -0.3rem;
        padding-bottom: 0.2rem;
    }
    .navd li img{
        width: 2.1rem;
        vertical-align: middle;
        margin-bottom: -0.4rem;
    }
    .header-wrap li{
        float: left;
        width: 16.8vw;
        line-height: 2.35rem;
        font-size: .7rem;
        padding-bottom: -0.5rem;
        font-weight: normal;
    }

    .header-wrap li img{
        width: 1.25rem;
        vertical-align: middle;
        margin-top: -0.15rem;
    }
    .asd{
        position: relative;
        height: 1.95rem;
        background-color: white;
    }

    .header-wrap li li{
        width: 50%;
    }
    .header-wrap li li img{
        width: 1.3rem;
        vertical-align: middle;
    }
    .topd li{
        float: left;
        width: 15vw;
        font-size: 0.8rem;
        text-align: center;
        vertical-align: middle;
        line-height: 1.95rem;
        color: white;
    }
    .topd li img{
        width: 1.2rem;
        vertical-align: middle;
        margin-top: -0.2rem;
    }


    .topd .head_hd{color: #346063;}
    .active{
        color: #890101;
    }
    .left{
        width: 100%;
        position: relative;
        margin-left: -0.25rem;
        padding: 2px 0px;
    }
    .pic_left p{
        text-align: center;
        font-size: 0.5rem;
        -webkit-text-size-adjust:none;
        /*-webkit-transform:scale(0.8);;*/
        margin-top: -.5rem;
        color: white;
    }
    .pic_left{
        position: absolute;
        top:1rem;
        left:28%;
    }
    .pic_left_name{
        text-align: center;
        line-height:.7rem;
    }
    .right>ul>li>a>p {
        margin-top: -5rem;
        width: 33%;
        text-align: center;
        position: absolute;
        line-height: .7rem;
    }
    .right>ul>li>a>p{
        font-size: 0.5rem;
        -webkit-text-size-adjust:none;
    }
    i{
        float: left;
        line-height: 2.35rem;
        font-size: .4rem;
    }
    a .tag{
        width:12vw;
    }
    .list_content{
        background-color: #f3f3f3;
        padding: 13.5px 2%;
    }
    .list_content ul li{
        float: left;
        width: 20%;
    }
    .section{
        width: 100%;
        height: 10px;
        background-color: white;
    }
    .yuan{
        position: relative;
        left: 0;
        top: 0;
        display: block;
        width: 47px;
        height: 47px;
        border: 1px solid #4d4d4d;
        border-radius: 55px;
        margin: 0 auto;
        font-size: 13px;
        text-align: center;
        color: #474b53;
    }
    .yuan span {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%,-50%);
        width: 28px;
        word-break: break-all;
        text-align: center;
        font-size: 12px;
        -webkit-text-size-adjust:none;
        line-height: 130%;
    }
    .sup{
        color: #890101;
        border: 1px solid #A33D3D;
    }
    #taobao img{
        border: none;
        /*border-image-width: 0px !important;*/
    }
</style>
</head>

<body>

<div class="pre-loading">

    <div class="pre-block">

        <div class="spinner"><i></i></div>

        数据加载中...

    </div>

</div>
<!-- 次级导航 -->
<header id="header" class="fixed">

    <div class="header-wrap">

        <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>

        <div class="header-title">

            <h1><?=$output['web_seo']?></h1>

        </div>

    </div>

</header>

<section style="background-color:white;padding:5px 0 30px 0;margin-top: 2.35rem;">
    <?php if (!empty($output['info']['picture'])):?>
        <a style="width: 100%;" href="<?=empty($output['info']['url'])?'javascript:void(0)':$output['info']['url']?>">
            <img style="width: 100%;" src="<?=UPLOAD_SITE_URL.'/contacts/'.$output['info']['picture']?>" />
        </a>
    <?php endif;?>
    <div class="mbcore_inlinetext" id="index-categories" style="padding: 12px 0px;">
        <?php echo $output['index_category']; ?>
    </div>
    <ul class="final">
        <?php foreach ($output['goods'] as $k=>$v){?>
            <li class="<?php echo 'type'.$v['rec_gc_id'];?> tem" >
                <a href="<?php echo urlMobile('goods','detail',array('goods_id'=>$v['goods_id']));?>">
                    <img src="<?php echo cthumb($v['goods_image'], 200,$v['store_id']);?>">
                </a>
                <p class="final_p" style="padding: 2% 0 0 0;color: #525252; font-size: 12px;font-weight: 400;height:35px; overflow: hidden;text-overflow: ellipsis;display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                    <?php echo $v['goods_name'];?><br/>

                </p>
                <span class="final_p_money weui-row_active" style="font-weight: 400;margin-left: -0.8rem;margin-bottom: 0.15rem"><?php echo _formatPrice($v['goods_price'],'￥');?></span>
            </li>
        <?php } ?>
        <div style="clear:both"></div>
    </ul>
</section>

<!--<div class="yimeng_camera"><img src="--><?php //echo RESOURCE_SITE_URL.'/images/camera.png';?><!--"></div>-->

<div style="height:50px;display:block;background-color: white;z-index: 0"></div>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/addcart.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/addtohomescreen.js"></script>
<!-- 取消TouchSlide调用
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/TouchSlide.1.1.js"></script>-->
<script type="text/javascript" src="https://debug.confolsc.com/target/target-script-min.js#anonymous_gongxue"></script>
<script type="text/javascript">
    $('.yimeng_camera').click(function () {
        window.location.href = '<?php echo urlMOBILE('category','index');?>';
    })
    $('.yuan').click(function () {
        $(this).addClass('sup').parent().siblings().find('a').removeClass('sup');
    })
</script>

<script>
    $('.index-category').click(function () {
        ik = $(this).data('ik');
        $('.final').find('li').hide();
        $('.final').find('.type'+ik).show();    });
    $('#index-categories').find('.index-category').on('click', function () {
        $(this).addClass('weui-row_active').siblings().removeClass('weui-row_active')

        var _id = $(this).data('ik');
        $('.final').find('li').each(function(i,v){
            if ($(v).hasClass('type'+_id)) {
                $(v).show();
            } else {
                $(v).hide();
            }
        });
    });
    if ($('#index-categories').find('.index-category').eq(0).length>0){
        $('#index-categories').find('.index-category').eq(0).trigger('click');
    } else {
        $('.final').find('li').hide();
    }

</script>
<script>


    // .final
    var margin = 8;  //分类主图
    var padding = 4;  //图片的间隙


    new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoplay:3000
    });
    new Swiper('.swiper-container3', {
        pagination: '.swiper-pagination3',
        paginationClickable: true,
        slidesPerView: 2,
        spaceBetween:padding, //2,  //slide之间的距离（单位px）
        //loop:true,
        autoplay:1000,
        speed:1500
    });
</script>
<script>
    $(function () {
        console.log('--margin--'+margin);
        console.log('--padding--'+padding);
        var window_width = $(window).width();
        var width = window_width-2*margin;
        var final_width = width;
        $('.final').width(width);
        $('.final').css('margin','0px auto');

        var img_width = (window_width-2*padding)/3;
        img_width=  Math.floor(img_width * 10) / 10;
        var img_height = img_width;
        timg_height = img_height*2+padding;
        $('.pic').find('div').find('img').width(img_width);
        $('.pic').find('div').find('img').height(img_height);
        $('.pic').find('.left').find('img').height(timg_height);
        $('.pic').find('.right').find('li').width(img_width);
        $('.pic').find('.right').find('li:nth-child(2n+1)').css('margin-right',padding+'px');
        $('.pic').find('.right').find('li').css('margin-bottom',padding+'px');
        $('.pic').find('.right').find('li:nth-child(4n+3)').css('margin-bottom','0px');
        $('.pic').find('.right').find('li:nth-child(4n+4)').css('margin-bottom','0px');
        $('.pic').find('.left').find('li').css('margin-bottom','0px');
        //宽度限定
        var left_width = img_width;
        var right_width = window_width-img_width;
        $('.pic').find('.left').attr('style','margin:0px; padding:0px; float:left;overflow:hidden;')
        $('.pic').find('.right').attr('style','margin:0px; padding:0px; float:left; margin-left:'+padding+'px;overflow:hidden;')
        $('.pic').find('.left').width(left_width-1);
        $('.pic').find('.right').width(right_width-padding);//+1


        var max_width = window_width;
        $('body > section').width(max_width);
        $('body > section').css('overflow','hidden');
        $('body > section').css('max-width',max_width+'px');
        $('body > section').append("<div style='clear:both;'></div>");
        var final_width = (final_width-padding)/2;
        final_width=  Math.floor(final_width * 10) / 10;
        $('.final').find('li').width(final_width);
        $('.final').find('li').css('margin-bottom',padding);
        var nod = document.createElement("style");
        str = ".final>li{margin:0px;padding-bottom: 0px;}";
        nod.type="text/css";
        if(nod.styleSheet){         //ie下
            nod.styleSheet.cssText = str;
        } else {
            nod.innerHTML = str;
        }
        console.log(nod);
        $('body').append(nod);

        $("#index-categories>a").each(function(index, element) {
            var dataik= $(element).attr('data-ik');
            console.log("&&&&&&&&&&"+dataik);
            $(".final>.type"+dataik).each(function(index, element) {
                var yushu = index%2;
                if(yushu==0){
                    $(element).css('margin-right',padding);
                }
            });

        });

        var swiper_height = $(".swiper-container3").find(".swiper-slide").css('width');
        swiper_height = parseFloat(swiper_height);
        console.log(swiper_height);
        swiper_height=  Math.floor(swiper_height * 10) / 10;
        console.log(swiper_height);
        var container3_height = swiper_height - 2;
        console.log(container3_height);
        $(".swiper-container3").height(container3_height);
        $(".swiper-container3").css('overflow','hidden');

        $('.pre-loading').remove();
    });
    $('#maskLayer').click(function () {
        $(this).css('display','none');
    })
    $('.back').click(function () {
        window.MBC.back()
        return false;
    })

</script>

<!--<style>
section .top .left{ width:auto; max-width:200px;}
html { overflow-x: hidden; overflow-y: auto; }
</style>-->
</body>
</html>




