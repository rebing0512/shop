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
        font-size: .65rem;
        line-height: 1.95rem;
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
</style>
</head>
<body>
<?php if (!$_GET['type']):?>
    <header id="header" class="fixed" style="height: 1.95rem;">
        <div class="header-wrap">
            <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>
            <!--
            <div class="mbcore_inlinetext" id="index-categories" style="padding: 15px 0px;">
                <?php echo $output['read']; ?>
            </div>
            -->
            <div class="mbcore_inlinetext" id="index-categories" style="font-weight: bolder;">
                <?=$output['titles']?>
            </div>
            <div class="header-r"> <a id="header-nav" href="javascript:void(0);">asdfsa<sup>asdf</sup></a> </div>
        </div>
    </header>
<?php endif;?>
<div class="mwraper">



    <div class="main-wrap">

        <div class="news-list" id="loadData">

        </div>
<div class="clear"></div>
    </div>

</div>







<script type="text/html" id="news_list">

    <% var nlists = datas.nlists;%>

    <% if(nlists.length >0){%>

    <%for(i=0;i<nlists.length;i++){%>

    <dl>

        <dd>

            <div class="news-detail">

                <a href="index.php?con=article&fun=show&article_id=<%=nlists[i].article_id;%>" class="news-img"><img src="<%=nlists[i].article_img;%>" /><!--<span><%=nlists[i].class_name;%></span>--></a>

                <h3 class="yh"><a href="index.php?con=article&fun=show&article_id=<%=nlists[i].article_id;%>"><%=nlists[i].article_title;%></a></h3>

                <p class="yh"><%=nlists[i].article_summary;%></p>

                <div class="btn-grp">

                    <a class="left" href="javascript:void(0);"><i class="myiconfont icon-shiyongshijian"></i><%=nlists[i].article_time;%></a>
<!--
                    <a href="javascript:;"><i class="myiconfont icon-yueduliang views"></i><%=nlists[i].article_view;%></a>

                    <a href="index.php?con=article&fun=show&article_id=<%=nlists[i].article_id;%>#comment-area"><i class="myiconfont icon-pinglun pinglun"></i><span id="comment<%=nlists[i].article_id;%>"><%=nlists[i].article_pl;%></span></a>

                    <a href="javascript:zan(<%=nlists[i].article_id;%>,<%=nlists[i].article_zan;%>);"><i class="myiconfont icon-dianzan"></i><span id="zan<%=nlists[i].article_id;%>"><%=nlists[i].article_zan;%></span></a>
-->
                </div>

            </div>

        </dd>

    </dl>

    <% } %>

    <% } %>

</script>



<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/template.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/pagingNews.js"></script>


<script type="text/javascript">

    var swiper = new Swiper('.swiper-container', {

        slidesPerView: 4,

        paginationClickable: true,

        freeMode: true,

        observer:true,

        observeParents:true,

    });

    $(".swiper-container ul li a").on("tap", function () {

        var _this = $(this);

        _this.addClass("curMenu").parent().siblings().find("a").removeClass("curMenu");

    });

    function zan(newsId, count) {

        var key = 'newszan' + newsId;

        if (getCookie(key) == 1) {

            layer.open({

                content: '亲，您已经赞过了！',

                time: 1.5

            });

        }else{

            $.post(ApiUrl+"/index.php?con=article&fun=ajax_zan",{newsId: newsId},

                function(res) {

                    if (res.status == 1) {

                        addCookie(key, 1);

                        count = count + 1;

                        $("#zan" + newsId).html(count);

                    }

                },

                "json");

        }

    }

    $(function (){

        var type = getQueryString("type");



        if(type != null && type){

            $('.mwraper').css('top',0)

            type = parseInt(type);

            searchData(type, '0');

        }else{



            searchData('0', '0');

        }





    });



    function searchData(category, idd, obj) {

        if (idd == 4) {

            $(".swiper-wrapper").addClass("moveToLeft");

        }

        $("#slde_"+category).find("a").addClass("curMenu").parent().siblings().find("a").removeClass("curMenu");

        var parms = {

            con:'article',

            fun:'article',

            cid: category,



        };

        $("#loadData").html("");

        PagingData.init(ApiUrl+"/index.php", parms, "loadData", 1, ApiUrl+"/index.php");

    }
</script>

<div style="margin-top:47px;background-color:white;margin-bottom: 50px" class="main">
<!--
    <div  class="mb_activity_list">
        <?php echo loadadv(159);?>
        <?php echo loadadv(160);?>

    </div>
    <div  class="mb_activity_list_1">
        <?php echo loadadv(161);?>
        <?php echo loadadv(162);?>
    </div>
    <div  class="mb_activity_list_2">
        <?php echo loadadv(163);?>
        <?php echo loadadv(164);?>
        <?php echo loadadv(165);?>
    </div>
    <div  class="mb_activity_list_3">
        <?php echo loadadv(166);?>
    </div>
    <div  class="mb_activity_list_3">
        <?php echo loadadv(167);?>
    </div>
    <div  class="mb_activity_list_3">
        <?php echo loadadv(168);?>
    </div>
<!--    <div  class="mb_activity_list">-->
<!--        <img src="--><?php //echo MOBILE_TEMPLATES_URL;?><!--/images/fe16d46.png">-->
<!--        <p class="tupianshuoming">图片说明</p>-->
<!--    </div>-->
<!--    <div  class="mb_activity_list">-->
<!--        <img src="--><?php //echo MOBILE_TEMPLATES_URL;?><!--/images/fe16d46.png">-->
<!--        <p class="tupianshuoming">图片说明</p>-->
<!--    </div>-->
<!--    <div  class="mb_activity_list">-->
<!--        <img src="--><?php //echo MOBILE_TEMPLATES_URL;?><!--/images/fe16d46.png">-->
<!--        <p class="tupianshuoming">图片说明</p>-->
<!--    </div>-->
</div>
<?php if (!$_GET['type']):

require_once template('footer-nav');

endif;
?>
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
