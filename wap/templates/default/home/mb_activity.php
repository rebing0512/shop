<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <style>
        .mb_activity_list{
             width: 100%;
            margin-bottom: 10px;
            position: relative;
        }
        .mb_activity_list img{
            width:100%;
        }
        .tupianshuoming{
            width: 100%;
            height: 30px;
            background-color: rgba(255,255,255,0.3);
            font-size: 0.7rem;
            padding-left: 10px;
            position: absolute;
            bottom: 0px;
            color: white;
            line-height: 30px;
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
                <h1 style="color:#890101">活动</h1>
            </div>
            <div class="header-r"> <a id="header-nav" href="javascript:void(0);">asdfsa<sup>asdf</sup></a> </div>
        </div>
    </header>
    <div style="margin-top:47px;background-color:white;margin-bottom: 50px" class="main">
        <div  class="mb_activity_list">
            <?php echo loadadv(154);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(155);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(173);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(174);?>
        </div>
        <div  class="mb_activity_list">
            <?php echo loadadv(175);?>
        </div>
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
        $('.mb_activity_list').find('a').find('img').width('100%');
        $('.pre-loading').remove();
    })
</script>
</html>
