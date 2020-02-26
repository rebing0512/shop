<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<meta charset="UTF-8">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/pinzhong.css" rel="stylesheet">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.css" rel="stylesheet" type="text/css">

<style>
    .mb_cate_list {
        text-align: center;
        font-size: .6rem;
        width: 100vw;
        line-height: 3rem;
        color:gray;
    }
    .mb_cate_list > a {
        padding:0 .7rem 0 .7rem;
    }
    .mb_cate_list > a.active {
        color:#890101;
    }
    h4 {
        padding:0;
        color:#ababab;
    }
    .mb_item_list {
        padding-bottom: 130px;
        padding-left: 17%;
    }
    .mb_item_list  a {
        line-height: 40px;
        font-size: .5rem;
        width:32%;
        float: left;
    }
    .mb_activity_list {
        width: 100%;
        margin-bottom: 10px;
        position: relative;
    }
    header.fixed {
        position: relative;
        background-color: white;
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
<header id="header" class="fixed">
    <div class="header-wrap">
        <div class="header-title">
            <h1 style="color:#890101">驻馆鉴定专家</h1>
        </div>
        <div class="header-r"> <a id="header-nav" href="javascript:void(0);">asdfsa<sup>asdf</sup></a> </div>
    </div>
</header>
</section>
<!--
<div style="margin-top:0;background-color:white;">

    <div style="">
        <h4 style="padding:3rem 0 0.5rem;">石种分类 Stone Species</h4>
        <div style="width:80vw;margin:0 auto;" class="mb_item_list" id="mb_item_list">
            <a href="javascript:void(0);" data-id="all">全部</a>
            <?php foreach ( C('stone') as $k => $v){ ?>
                <a href="javascript:void(0);" data-id="<?php echo $k;?>"><?php echo $v;?></a>
            <?php };?>
        </div>
    </div>
</div>
<section class="first">
    <h4 style="padding:1rem 0 0.5rem;margin-left: 0.1rem; ">雕刻技法 Carving Techniques</h4>
    <div style="width:80vw;margin:0 auto;" class="mb_item_list" id="mb_item_list_1">
        <a href="javascript:void(0);" data-id="all"><i>全部</i></a>
        <?php foreach (C('carve') as $k => $v){?>
            <a href="javascript:void(0);" data-id="<?php echo $k;?>"><?php echo $v;?></a>
        <?php } ?>
    </div>
    <div class="clear"></div>
</section>
<div class="button">
    <ul>
        <li><a href="#">清除</a></li>
        <li><a href="#">确认</a></li>
        <div class="clear"></div>
    </ul>
</div>
-->
<div style="background-color:white;margin-bottom: 50px" class="main">
    <div  class="mb_activity_list">
        <?php echo loadadv(197);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(198);?>
    </div>
    <header id="header" class="fixed">
        <div class="header-wrap">
            <div class="header-title">
                <h1 style="color:#890101">专家鉴定团</h1>
            </div>
            <div class="header-r"> <a id="header-nav" href="javascript:void(0);">asdfsa<sup>asdf</sup></a> </div>
        </div>
    </header>
    <div  class="mb_activity_list">
        <?php echo loadadv(159);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(178);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(179);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(180);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(181);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(194);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(195);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(196);?>
    </div>
    <div  class="mb_activity_list">
        <?php echo loadadv(199);?>
    </div>
</div>
<style>
    .button li{
        width: 50%;
        text-align: center;
        float: left;
    }
    .button a{
        position: relative;
        left: 0;
        top: 20px;
        display: block;
        width: 50px;
        height: 50px;
        border: 1px solid #87161a;
        border-radius: 55px;
        margin: 0 auto;
        font-size: 15px;
        text-align: center;
        line-height: 50px;
        color: #87161a;
    }
</style>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/swiper.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/addtohomescreen.js"></script>

<script>
    /**
    var sel = [];
    $('#mb_item_list a').click(function () {
        $('#mb_item_list a').css('font-size','.5rem');
        $('#mb_item_list a').css('color','#676b70');
        $(this).css('font-size','.8rem');
        $(this).css('color','#87161a');
        sel['stone'] = $(this).data('id');
    });
    $('#mb_item_list_1 a').click(function () {
        $('#mb_item_list_1 a').css('font-size','.5rem');
        $('#mb_item_list_1 a').css('color','#676b70');
        $(this).css('font-size','.8rem');
        $(this).css('color','#87161a');
        sel['carve'] = $(this).data('id');
    });
    $(".button a:eq(0)").click(function () {
        $('.mb_item_list a').css('font-size','.5rem');
        $('.mb_item_list a').css('color','#676b70');
        sel = [];
    })
    $(".button a:eq(1)").click(function () {
        if(sel['stone']&&sel['carve']){
        window.location.href = ApiUrl+'/index.php?con=goods&fun=list&stone='+sel['stone']+'&carve='+sel['carve'];
        }else {
            alert('请选择分类！');
        }
    })
    */
    $(function () {
        $('.main img').height('');
        $('.mb_activity_list').find('a').find('img').width('100%');
        $('.pre-loading').remove()
    })
</script>
</body>
<?php require_once template('footer-nav'); ?>