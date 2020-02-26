<?php defined( 'TTShop') or exit( 'Access Invalid!');?>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/jquery-weui.min.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/weui.min.css" />
<style type="text/css">
    .weui_panel_sq {
        background-color: rgba(0, 0, 0, 0);
    }
    .morenjinru {
        height: 3rem;
        line-height: 3rem;
        width: 100%;
        font-size: 1.2rem;
        margin-left: 1rem;
        color: #6A938A;
        background-color: white;
    }
    .weui_panel_sq .weui_media_hd img {
        border-radius: 50%;
    }

    .weui_panel_sq .weui_media_bd span {
        font-size: 1.2rem;
        color: gray;
    }

    .weui_panel_sq .weui_media_ft img {
        width: 1rem;
    }

    .weui-row {
        text-align: center;
        background-color: white;
    }
    .weui-row_padding{
        padding: 0.7rem 0rem;
    }
    .weui-row1 {
        background-color: rgba(0, 0, 0, 0.2);
    }
    .weui_panel_sq .weui_media_box {
        padding: 2.1rem;
        padding-left: 0.6rem;
    }
    .section_bady_nav_sq .nav_gengduo{
        float: right;
        margin-right: 0.5rem;
    }
    .weui_panel_sq .weui_media_text {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .weui_panel_sq .weui_media_text1 {
        font-size: 0.65rem;
    }

    .weui-row1 a {
        color: white;
        font-size: 0.7rem;

    }

    .weui-row1 .weui-col-33 {
        border-right: 1px solid gainsboro;
    }

    .weui-row1 .weui-col-33:nth-child(3n) {
        border-right: none;
    }

    .section_body_sq {
        margin: 0.7rem auto;
        width: 100%;
    }

    .section_body_sq .weui_btn_default {
        padding: 0.25rem 0rem;
        border-radius: 0px;
        background-color: white;
        color: #6C958D;
        font-size: 0.61rem;
    }
    .weui-row_sq{
        padding: 0.7rem 0rem;
    }
    .weui-row_sq .weui-col-33 em {
        font-size: 1rem;
        font-family: "微软雅黑";
        font-style: normal;
        display: block;
        color: gray;
    }

    .weui-row_sq .weui-col-33 img {
        width: 1.8rem;
    }

    .morenjinru {
        height: 3rem;
        line-height: 3rem;
        width: 100%;
        font-size: 1.2rem;
        margin-left: 1rem;
        color: #6A938A;
        background-color: white;
    }

    .weui_cells_checkbox .weui_check:checked+.weui_icon_checked:before {
        color: #1E7D67;
    }
    .weui_panel_sq .weui_media_box.weui_media_appmsg .weui_media_hd {
        margin-right: .8em;
        width: 70px;
        height: 70px;
        line-height: 70px;
        text-align: center;
    }
    .weui_panel_sq .weui-row.weui-no-gutter .weui-col-33 {
        width: 33.333333333333336%;
        margin: 0.2rem 0rem;
    }
    a.weui_media_box:active {
        background-color: rgba(0, 0, 0, 0);
    }

    .weui_panel_sz img {
        border-radius: 50%;
    }

    .weui_panel_sz .weui_media_text {
        font-size: 1.2rem;
    }

    .weui_panel_sz .weui_media_text1 {
        font-size: 1rem;
        color: gray;
    }

    .weui-row_sq .weui-col-20 em {
        font-size: 0.6rem;
        font-family: "微软雅黑";
        font-style: normal;
        display: block;
        color: gray;
    }

    .weui-row_sq .weui-col-20 img {
        width: 1rem;
    }

    .section_bady_nav_sq {
        height: 2rem;
        font-size: 0.61rem;
        padding-left: 1rem;
        line-height: 2rem;
        color: black;
        background-color: white;
        border-bottom: 1px solid #E6E6E6;
    }

    .section_bady_nav_sq img {
        width: 1rem;
        vertical-align: middle;
    }

</style>
</head>

<body>
<section>
    <div class="weui_panel_img">
        <div class="weui_panel weui_panel_sq weui_panel_access">
            <div class="weui_panel_bd">
                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="https://gateway.confolsc.com/avatar/<?=$output['member_info']['hashkey']?>" alt="">
                    </div>
                    <div class="weui_media_bd">
                        <p class="weui_media_text"><?=$output['member_info']['user_name']?></p>
                        <p class="weui_media_text1">买家中心</p>
                    </div>

                    <div class="weui_media_ft"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/set.png"></div>
                </a>
            </div>
        </div>
        <div class="weui-row weui-row1 weui-no-gutter">
            <div class="weui-col-33 sp">
                <a href="javascript:;">
                    <p><?=$output['member_info']['favorites_goods']?></p>
                    <p>关注商品</p>
                </a>
            </div>
            <div class="weui-col-33 gz">
                <a href="javascript:;">
                    <p><?=$output['member_info']['favorites_store']?></p>
                    <p>关注店铺</p>
                </a>
            </div>
            <div class="weui-col-33 zj">
                <a href="javascript:;">
                    <p><?=$output['member_info']['viewed_goods_num']?></p>
                    <p>足迹</p>
                </a>
            </div>
        </div>
    </div>
    <?php if ($output['store_info']['notice']==1):?>
    <ul class="nctouch-default-list mt5">
        <?php
        switch ($output['store_info']['store_type']){
            case 0 :
                ?>
                <li><a href="javascript:;" data-url="<?=urlMobile('store_joinin','step1')?>" data-title="店铺资质认证">

                        <h4>申请店铺</h4>

                        <h6><?php if ($output['store_info']['status']==1&&$output['store_info']['notice']==1):?>申请审核失败，点击修改资料提交审核<?php else:?>点击申请成为商家，获取海量客户资源<?php endif;?></h6>

                        <span class="arrow-r"></span></a></li>
                <?php
                break;
            case 1 :
                ?>
                <li><a href="javascript:;" class="hides">

                        <h4>申请店铺中</h4>

                        <h6>点击不再提示</h6>

                        <span class="arrow-r"></span></a></li>
                <?php
                break;
            case 2 :
                ?>
                <li><a href="javascript:;" class="hides">

                        <h4>申请店铺成功</h4>

                        <h6><?php if ($output['store_info']['status']==1&&$output['store_info']['notice']==1):?>申请店铺成功，点击修改资料提交审核<?php else:?>点击不再提示<?php endif;?></h6>

                        <span class="arrow-r"></span></a></li>
                <?php
                break;
//            case 3 :
//                ?>
<!--                <li><a href="javascript:;" id="hide">-->
<!---->
<!--                        <h4>认证店铺</h4>-->
<!---->
<!--                        <h6>高级店铺申请审核中，点击不再提示</h6>-->
<!---->
<!--                        <span class="arrow-r"></span></a></li>-->
<!--                --><?php
//                break;
//            case 4 :
//                ?>
<!--                <li><a href="javascript:;" id="hide">-->
<!---->
<!--                        <h4>高级店铺</h4>-->
<!---->
<!--                        <h6>恭喜成为高级店铺，点击不再提示</h6>-->
<!---->
<!--                        <span class="arrow-r"></span></a></li>-->
<!--                --><?php
//                break;
        } ?>
    </ul>
    <?php endif;?>
    <!--切换至卖家中心-->
    <div class="section_body section_body_sq">
        <a onclick="verification()" class="weui_btn weui_btn_disabled weui_btn_default">至卖家中心</a>
    </div>
    <!--全部订单-->

    <div class="secction_body">
        <div class="section_bady_nav section_bady_nav_sq all">
            <!--<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/myshop.png">-->
            全部订单
            <span class="nav_gengduo"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/arrow.png"></span>
        </div>

        <div class="weui-row weui-no-gutter weui-row_sq weui-row_padding">
            <div class="weui-col-20 dfk">
                <a href="JavaScript:;">
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/paymoney.png">
                    <em>待付款</em>
                </a>
            </div>
            <div class="weui-col-20 dfh">
                <a href="JavaScript:;">
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/sendpro.png">
                    <em>待发货</em>
                </a>
            </div>
            <div class="weui-col-20 dsh">
                <a href="JavaScript:;">
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/daishouhuo.png">
                    <em>待收货</em>
                </a>
            </div>
            <div class="weui-col-20 ysh">
                <a href="JavaScript:;">
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/yishouhuo.png">
                    <em>已收货</em>
                </a>
            </div>
            <div class="weui-col-20 tk">
                <a href="JavaScript:;">
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/6.png">
                    <em>退款/退货</em>
                </a>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js" ></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js" ></script>
<?php if (in_array($output['platform'],['wechat','pc','iphone-wap','android-wap'])){?>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type='text/javascript' src='https://mbcsc.confolsc.com/wx_js.php?alias=<?=C('app_alias')?>'></script>
    <script type='text/javascript' src='https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/wechat.js?_=<?=uniqid()?>'></script>
<?php } elseif ($output['platform']=='android'){ ?>
    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/webview.js"></script>
    <script type="text/javasctipt" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/WebViewJavascriptBridge.js"></script>
    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/MBCore.js?_=<?=uniqid()?>"></script>
<?php } elseif ($output['platform']=='ios'){ ?>
    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/webView_ios.js"></script>
    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/MBCore.js?_=<?=uniqid()?>"></script>
<?php } ?>
<!--自动跳转默认中心-->
<script>
    var seller_center = '<?=$output['seller_center']?>';
    $(function () {
        if (seller_center != ''){
            window.location.href = seller_center;
        }
    })
</script>
<script>
    function verification() {
        $.ajax({
            url: ApiUrl + '/index.php?con=seller_center&fun=verification',
            type: 'get',
            // data: '',
            dataType: 'json',
            success: function (data) {
                if (data.code >= 2) {
                    window.location.href = data.url;
                } else {
                    layer.open({
                        content: '请先申请店铺',
                        time: 1.5
                    });
                }
            }
        })
    }
    $('a[data-url]').on('click',function () {
        window.MBC.openNew({
            url:$(this).attr('data-url'),
            pageTitle:$(this).attr('data-title'),
            removeHeader:true
        })
        return false;
    })
    $('.hides').on('click',function () {
        $.ajax({
            type:'post',
            url:ApiUrl+'/index.php?con=store&fun=read',
            data:'',
            dataType:'json',
            success :function (result) {
                if (result.datas.code==1){
                    console.log(111)
                    $('.nctouch-default-list').remove();
                }
            }

        })
    })
</script>
<script type="text/javascript">
    $(".weui_media_appmsg_thumb").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_account',
            pageTitle:'设置',
            removeHeader:true
        })
        return false;
    })
    $(".weui_media_ft").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_account',
            pageTitle:'设置',
            removeHeader:true
        })
        return false;
    })
    $(".zj").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_goodsbrowse',
            pageTitle:'足迹',
            removeHeader:true
        })
        return false;
    })
    $(".all").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_order',
            pageTitle:'实物交易订单',
            removeHeader:true
        })
        return false;
    })
    $(".dfk").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_order&fun=index&data-state=state_new',
            pageTitle:'实物交易订单',
            removeHeader:true
        })
        return false;
    })
    $(".dfh").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_order&fun=index&data-state=state_shipping',
            pageTitle:'实物交易订单',
            removeHeader:true
        })
        return false;
    })
    $(".dsh").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_order&fun=index&data-state=state_send',
            pageTitle:'实物交易订单',
            removeHeader:true
        })
        return false;
    })
    $(".ysh").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_order&fun=index&data-state=state_noeval',
            pageTitle:'实物交易订单',
            removeHeader:true
        })
        return false;
    })
    $(".tk").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_refund',
            pageTitle:'实物交易订单',
            removeHeader:true
        })
        return false;
    })
    $(".gz").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_favorites_store',
            pageTitle:'关注店铺',
            removeHeader:true
        })
        return false;
    })
    $(".sp").click(function(){
        window.MBC.openNew({
            url:ApiUrl+ '/index.php?con=member_favorites',
            pageTitle:'关注商品',
            removeHeader:true
        })
        return false;
    })
</script>
</body>

</html>