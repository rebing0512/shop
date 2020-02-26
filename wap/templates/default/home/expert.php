<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/news.css">

<!-- <link rel="stylesheet" type="text/css" href="../css/swiper.css"> -->

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/swiper.js"></script>

<style>
    *{
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }
    .mb_activity_list{
        width: 100%;
        margin-bottom: 10px;
    }
    .mb_activity_list img{
        float: left;
        width:49.5%;
    }
    .mb_activity_list img:nth-child(2n){
        position: absolute;
        right: 0px;
    }
    .mb_activity_list_1{
        clear: both;
    }
    .mb_activity_list_1 img{
        margin-top: 4px;
        float: left:
    }
    .mb_activity_list_1 img:nth-child(1n){
        width: 34%;
    }
    .mb_activity_list_1 img:nth-child(2n){
        width: 64%;
        padding-top: 4px;
        position: absolute;
        right: 0px;
    }
    .mb_activity_list_2 {
        clear: both;
    }
    .mb_activity_list_2 img{
        float: left;
        width: 32.5%;
        margin-top: 4px;
    }
    .mb_activity_list_2 img:nth-child(2n){
     margin-left: 1.3%;
    }
    .mb_activity_list_2 img:nth-child(3n){
       position: absolute;
        right: 0px;
    }
    .mb_activity_list_3{
       clear: both;
    }
    .mb_activity_list_3 img{
        width: 100%;
        margin-top: 4px;
    }
    .mbcore_inlinetext {
        padding: 10px 0 20px 0;
        font-size: .65rem;
        margin-bottom: 10px;
        width: 100%;
        text-align: center;
    }
    .mbcore_inlinetext a {
        width: 30%;
        color: black;
        margin: 0;
        display: inline-block;
    }
    .clear{
        height:2.2rem;
        width:100%;
    }
    .news-list dl dd .news-detail p{
        -webkit-line-clamp: 5;
        font-size: .5rem;
        line-height: .7rem;
    }
    .news-list dl dd{
        padding:0;
    }
    .news-list dl{
        background-color: black;
        padding:0;
        height: 21vh;
        margin: 3px 0;
    }
    .news-list dl dd .news-detail .news-img{
        border-right: 1px white solid;
        width: 33vw;
        height: 21vh;
    }
    .news-list dl dd .news-detail img, .newsinfo img{
        height: 100%;
    }
    .news-list dl dd .news-detail h3 a{
        color: #ffffff;
        line-height: 275%;
    }
    .yh{
        padding: 0 10px;
    }
    .mwraper{
        top:0;
    }
    .nam{
        padding: 2%;
    }

</style>
</head>
<body>
    <?php if (!empty($output['list'])){?>
    <header id="header" class="fixed" style="position: relative;">
        <div class="header-wrap">
            <div class="header-title">
                <h1 style="color:#890101">驻馆鉴定专家</h1>
            </div>
            <div class="header-r"> <a id="header-nav" href="javascript:void(0);">asdfsa<sup>asdf</sup></a> </div>
        </div>
    </header>

    <div class="mwraper">



        <div class="main-wrap">

            <div class="news-list" id="">
                <?php foreach ($output['list'] as $item){?>
                <dl>
                    <dd>
                            <div class="news-detail">

                                <a href="<?php echo urlMobile('specials','expert_show',array('id'=>$item['id']))?>" class="news-img"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_AVATAR.DS.$item['picture']?>"><!--<span>行业资讯</span>--></a>
                                <a href="<?php echo urlMobile('specials','expert_show',array('id'=>$item['id']))?>">
                                    <h3 class="yh nam"><?php echo $item['name'];?></h3>

                                    <p class="yh"><?php echo $item['intro'];?></p>
                                </a>
                            </div>
                    </dd>
                </dl>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($output['group_list'])){?>
        <header id="header" class="fixed" style="position: relative;">
            <div class="header-wrap">
                <div class="header-title">
                    <h1 style="color:#890101">专家鉴定团</h1>
                </div>
                <div class="header-r"> <a id="header-nav" href="javascript:void(0);">asdfsa<sup>asdf</sup></a> </div>
            </div>
        </header>

        <div class="mwraper">

            <div class="main-wrap">

                <div class="news-list" id="">

                    <?php foreach ($output['group_list'] as $item){?>
                        <dl>
                            <dd>
                                <div class="news-detail">

                                    <a href="<?php echo urlMobile('specials','expert_show',array('id'=>$item['id']))?>" class="news-img"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_AVATAR.DS.$item['picture']?>"><!--<span>行业资讯</span>--></a>
                                    <a href="<?php echo urlMobile('specials','expert_show',array('id'=>$item['id']))?>">
                                    <h3 class="yh nam"><?php echo $item['name'];?></h3>

                                    <p class="yh"><?php echo $item['intro'];?></p>
                                    </a>
                                </div>
                            </dd>
                        </dl>
                    <?php } ?>

                </div>


            </div>

        </div>
    <?php } ?>


<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/template.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>


<div style="margin-top:47px;background-color:white;margin-bottom: 50px" class="main">

</div>
<?php require_once template('footer-nav'); ?>
</body>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/swiper.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/addtohomescreen.js"></script>
<script>
    $(function () {
        $('.main img').height('');
        $('.mb_activity_list img:first').width('49.5%');
        $('.mb_activity_list img:eq(1)').css('margin-left','1%');
        $('.mb_activity_list img:eq(1)').width('49.5%');
        $('.mb_activity_list_1 img:first').width('34%');
        $('.mb_activity_list_1 img:eq(1)').width('64%');
        $('.mb_activity_list_1 img:eq(1)').css('padding','4px 0');
        $('.mb_activity_list_2 img').width('32.5%');
        $('.mb_activity_list_2 img:first').css('margin-right','1.25%');
        $('.mb_activity_list_2 img:eq(1)').css('margin-right','1.25%');
        $('.mb_activity_list_3 img').width('100%');
    })
</script>
<script>
    $('.index-category').click(function () {
        ik = $(this).data('ik');
        $('.final').find('li').hide();
        $('.final').find('.type'+ik).show();
    });
    $('#index-categories').find('.index-category').on('click', function () {
        $(this).css('color','#750009').siblings().css('color','black');
        var _id = $(this).data('ik');
        $('.final').find('li').each(function(i,v){
            if ($(v).hasClass('type'+_id)) {
                $(v).show();
            } else {
                $(v).hide();
            }
        });
    });
    //$('#index-categories').find('.index-category').eq(0).trigger('click');
</script>
</html>
