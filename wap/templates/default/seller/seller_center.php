<?php defined( 'TTShop') or exit( 'Access Invalid!');?><link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/jquery-weui.min.css" /><link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/weui.min.css" /><!--		<link rel="stylesheet" href="--><?php //echo MOBILE_TEMPLATES_URL;?><!--/css/base.css" />--><!--        <link rel="stylesheet" href="--><?php //echo MOBILE_TEMPLATES_URL;?><!--/css/index.css" />--><style type="text/css">    .weui_panel_sq {        background-color: rgba(0, 0, 0, 0);    }    .morenjinru {        height: 3rem;        line-height: 3rem;        width: 100%;        font-size: 1.2rem;        margin-left: 1rem;        color: #6A938A;        background-color: white;    }    .weui_panel_sq .weui_media_hd img {        border-radius: 50%;    }    .secction_body{        margin-bottom: 0.5rem;    }    .weui_panel_sq .weui_media_bd span {        font-size: 1.2rem;        color: gray;    }    .weui_panel_sq .weui_media_ft img {        width: 1rem;    }    .weui-row {        text-align: center;        background-color: white;    }    .weui-row_padding{        padding: 0.7rem 0rem;    }    .weui-row1 {        background-color: rgba(0, 0, 0, 0.2);    }    .weui_panel_sq .weui_media_box {        padding: 2.1rem;        padding-left: 0.6rem;    }    .section_bady_nav_sq .nav_gengduo{        float: right;        margin-right: 0.5rem;        color: gray;    }    .weui_panel_sq .weui_media_text {        font-size: 0.8rem;        font-weight: 600;    }    .weui_panel_sq .weui_media_text1 {        font-size: 0.65rem;    }    .weui-row1 a {        color: white;        font-size: 0.7rem;    }    .weui-row1 .weui-col-33 {        border-right: 1px solid gainsboro;    }    .weui-row1 .weui-col-33:nth-child(3n) {        border-right: none;    }    .section_body_sq {        margin: 0.7rem auto;        width: 100%;    }    .section_body_sq .weui_btn_default {        padding: 0.25rem 0rem;        border-radius: 0px;        background-color: white;        color: #6C958D;        font-size: 0.61rem;    }    .weui-row_sq{        padding: 0.7rem 0rem;    }    .weui-row_sq .weui-col-33 em {        font-size: 1rem;        font-family: "微软雅黑";        font-style: normal;        display: block;        color: gray;    }    .weui-row_sq .weui-col-33 img {        width: 1.8rem;    }    .morenjinru {        height: 3rem;        line-height: 3rem;        width: 100%;        font-size: 1.2rem;        margin-left: 1rem;        color: #6A938A;        background-color: white;    }    .weui_cells_checkbox .weui_check:checked+.weui_icon_checked:before {        color: #1E7D67;    }    .weui_panel_sq .weui_media_box.weui_media_appmsg .weui_media_hd {        margin-right: .8em;        width: 70px;        height: 70px;        line-height: 70px;        text-align: center;    }    .weui_panel_sq .weui-row.weui-no-gutter .weui-col-33 {        width: 33.333333333333336%;        margin: 0.2rem 0rem;    }    a.weui_media_box:active {        background-color: rgba(0, 0, 0, 0);    }    .weui_panel_sz img {        border-radius: 50%;    }    .weui_panel_sz .weui_media_text {        font-size: 1.2rem;    }    .weui_panel_sz .weui_media_text1 {        font-size: 1rem;        color: gray;    }    .weui-row_sq .weui-col-20 em {        font-size: 0.6rem;        font-family: "微软雅黑";        font-style: normal;        display: block;        color: gray;    }    .weui-row_sq .weui-col-20 img {        width: 1rem;    }    .section_bady_nav_sq {        height: 2rem;        font-size: 0.61rem;        padding-left: 1rem;        line-height: 2rem;        color: black;        background-color: white;        border-bottom: 1px solid #E6E6E6;    }    .section_bady_nav_sq img {        width: 1rem;        vertical-align: middle;        margin-top: -0.199rem;    }</style></head><body><!--主体部分--><section>    <div class="weui_panel_img">        <div class="weui_panel weui_panel_sq weui_panel_access">            <div class="weui_panel_bd">                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">                    <div class="weui_media_hd">                        <img class="weui_media_appmsg_thumb" src="https://gateway.confolsc.com/avatar/<?=$output['member_info']['hashkey']?>" alt="">                    </div>                    <div class="weui_media_bd">                        <p class="weui_media_text"><?=$output['member_info']['user_name']?></p>                        <p class="weui_media_text1">卖家中心</p>                    </div>                    <div class="weui_media_ft"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/set.png"></div>                </a>            </div>        </div>        <div class="weui-row weui-row1 weui-no-gutter">            <div class="weui-col-33 sp">                <a href="javascript:;">                    <p><?=$output['member_info']['favorites_goods']?></p>                    <p>关注商品</p>                </a>            </div>            <div class="weui-col-33 gz">                <a href="javascript:;">                    <p><?=$output['member_info']['favorites_store']?></p>                    <p>关注店铺</p>                </a>            </div>            <div class="weui-col-33 zj">                <a href="javascript:;">                    <p><?=$output['member_info']['viewed_goods_num']?></p>                    <p>足迹</p>                </a>            </div>        </div>    </div>    <!--切换至卖家中心-->    <?php if ($output['store_info']['notice']==1):?>        <ul class="nctouch-default-list mt5">            <?php            switch ($output['store_info']['store_type']){                case 0 :                    ?>                    <li><a href="javascript:;" data-url="<?=urlMobile('store_joinin','step1')?>" data-title="店铺资质认证">                            <h4>申请店铺</h4>                            <h6><?php if ($output['store_info']['status']==1&&$output['store_info']['notice']==1):?>申请审核失败，点击修改资料提交审核<?php else:?>点击申请成为商家，获取海量客户资源<?php endif;?></h6>                            <span class="arrow-r"></span></a></li>                    <?php                    break;                case 1 :                    ?>                    <li><a href="javascript:;" class="hides">                            <h4>申请店铺中</h4>                            <h6>点击不再提示</h6>                            <span class="arrow-r"></span></a></li>                    <?php                    break;                case 2 :                    ?>                    <li><a href="javascript:;" class="hides">                            <h4>申请店铺成功</h4>                            <h6><?php if ($output['store_info']['status']==1&&$output['store_info']['notice']==1):?>申请店铺成功，点击修改资料提交审核<?php else:?>点击不再提示<?php endif;?></h6>                            <span class="arrow-r"></span></a></li>                    <?php                    break;//                case 3 ://                    ?><!--                    <li><a href="javascript:;" id="hide">--><!----><!--                            <h4>认证店铺</h4>--><!----><!--                            <h6>高级店铺申请审核中，点击不再提示</h6>--><!----><!--                            <span class="arrow-r"></span></a></li>--><!--                    --><?php//                    break;//                case 4 ://                    ?><!--                    <li><a href="javascript:;" id="hide">--><!----><!--                            <h4>高级店铺</h4>--><!----><!--                            <h6>恭喜成为高级店铺，点击不再提示</h6>--><!----><!--                            <span class="arrow-r"></span></a></li>--><!--                    --><?php//                    break;            } ?>        </ul>    <?php endif;?>    <div class="section_body section_body_sq">        <a href="<?=urlMobile('member','index',['center' => 'buyer'])?>" class="weui_btn weui_btn_disabled weui_btn_default">至买家中心</a>    </div>    <!--我是商家-->    <div class="secction_body">        <div class="section_bady_nav section_bady_nav_sq wssj">            <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/myshop.png">            我的店铺            <span class="nav_gengduo"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/arrow.png"></span>        </div>        <div class="weui-row weui-no-gutter weui-row_sq weui-row_padding">            <div class="weui-col-20 tjsp">                <a href="javascript:void(0);">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/addproduct.png">                    <em>添加商品</em>                </a>            </div>            <div class="weui-col-20 glsp">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/managepro.png">                    <em>管理商品</em>                </a>            </div>            <div class="weui-col-20 dpjs">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/introduce.png">                    <em>店铺介绍</em>                </a>            </div>            <div class="weui-col-20 dplg">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/logo.png">                    <em>店铺头像</em>                </a>            </div>            <div class="weui-col-20 sqsj">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/personal.png">                    <em>私洽手机</em>                </a>            </div>        </div>    </div>    <!--销售订单-->    <div class="secction_body">        <div class="section_bady_nav section_bady_nav_sq xsdd">            <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/salesorder.png">            销售订单            <span class="nav_gengduo">查看全部订单<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/arrow.png"></span>        </div>        <div class="weui-row weui-no-gutter weui-row_sq weui-row_padding">            <div class="weui-col-20 dfk">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/paymoney.png">                    <em>待付款</em>                </a>            </div>            <div class="weui-col-20 dfh">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/sendpro.png">                    <em>待发货</em>                </a>            </div>            <div class="weui-col-20 yfh">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/alreaysend.png">                    <em>已发货</em>                </a>            </div>            <div class="weui-col-20 ywc">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/finish.png">                    <em>已完成</em>                </a>            </div>            <div class="weui-col-20 yqx">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/cansel.png">                    <em>已取消</em>                </a>            </div>        </div>    </div>    <!--销售统计-->    <div class="secction_body">        <div class="section_bady_nav section_bady_nav_sq xstj">            <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/statistics.png">            销售统计            <span class="nav_gengduo">查看全部统计<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/arrow.png"></span>        </div>        <div class="weui-row weui-no-gutter weui-row_sq weui-row_padding">            <div class="weui-col-20 dpgk">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/12.png">                    <em>店铺概况</em>                </a>            </div>            <div class="weui-col-20 dptj">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/13.png">                    <em>店铺统计</em>                </a>            </div>            <div class="weui-col-20 dpll">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/14.png">                    <em>店铺流量</em>                </a>            </div>            <div class="weui-col-20 spll">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/15.png">                    <em>商品流量</em>                </a>            </div>            <div class="weui-col-20 xsph">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/16.png">                    <em>销售排行</em>                </a>            </div>        </div>    </div>    <!--退款退货-->    <div class="secction_body">        <div class="section_bady_nav section_bady_nav_sq tk">            <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/refund.png">            退款/退货            <span class="nav_gengduo"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/arrow.png"></span>        </div>        <div class="weui-row weui-no-gutter weui-row_sq weui-row_padding">            <div class="weui-col-20 sqtk">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/6.png">                    <em>售前退款</em>                </a>            </div>            <div class="weui-col-20 shtk">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/8.png">                    <em>售后退款</em>                </a>            </div>            <div class="weui-col-20 dpll">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/14.png">                    <em>店铺流量</em>                </a>            </div>            <div class="weui-col-20 sqth">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/11.png">                    <em>售前退货</em>                </a>            </div>            <div class="weui-col-20 shth">                <a href="JavaScript:;">                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/10.png">                    <em>售后退货</em>                </a>            </div>        </div>    </div>    <?php if (in_array($output['platform'], ['android'])):?>        <div id="func_desk">        </div>    <?php endif;?></section><script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-2.1.0.js"></script><script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script><script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js?201511"></script><?php if (in_array($output['platform'],['wechat','pc','iphone-wap','android-wap'])){?>    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>    <script type='text/javascript' src='https://mbcsc.confolsc.com/wx_js.php?alias=<?=C('app_alias')?>'></script>    <script type='text/javascript' src='https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/wechat.js?_=<?=uniqid()?>'></script><?php } elseif ($output['platform']=='android'){ ?>    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/webview.js"></script>    <script type="text/javasctipt" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/WebViewJavascriptBridge.js"></script>    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/MBCore.js?_=<?=uniqid()?>"></script><?php } elseif ($output['platform']=='ios'){ ?>    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/webView_ios.js"></script>    <script type="text/javascript" src="https://<?=C('app_alias')?>bbs.confolsc.com/assets/js/MBCore.js?_=<?=uniqid()?>"></script><?php } ?><script type="text/javascript">    $('a[data-url]').on('click',function () {        window.MBC.openNew({            url:$(this).attr('data-url'),            pageTitle:$(this).attr('data-title'),            removeHeader:true        })        return false;    })    $('.hides').on('click',function () {        $.ajax({            type:'post',            url:ApiUrl+'/index.php?con=store&fun=read',            data:'',            dataType:'json',            success :function (result) {                if (result.datas.code==1){                    console.log(111)                    $('.nctouch-default-list').remove();                }            }        })    });    $(".gz").click(function(){        window.MBC.openNew({            url:ApiUrl+ '/index.php?con=member_favorites_store',            pageTitle:'关注店铺',            removeHeader:true        })        return false;    });    $(".zj").click(function(){        window.MBC.openNew({            url:ApiUrl+ '/index.php?con=member_goodsbrowse',            pageTitle:'足迹',            removeHeader:true        })        return false;    });    $(".sp").click(function(){        window.MBC.openNew({            url:ApiUrl+ '/index.php?con=member_favorites',            pageTitle:'关注商品',            removeHeader:true        })        return false;    });    $(".weui_media_appmsg_thumb").click(function(){        window.MBC.openNew({            url:ApiUrl+ '/index.php?con=member_account',            pageTitle:'设置',            removeHeader:true        })        return false;    });    $(".weui_media_ft").click(function(){        window.MBC.openNew({            url:ApiUrl+ '/index.php?con=member_account',            pageTitle:'设置',            removeHeader:true        })        return false;    });    $(".wssj").click(function(){        window.MBC.openNew({            url:'<?=urlMobile('store','index',array('store_id'=>$_SESSION['store_id']))?>',            pageTitle:'<?=$output['store_info']['store_name']?>',            removeHeader:true        });        return false;    });    $(".tjsp").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=category&fun=index',            pageTitle:'分类',            removeHeader:true        });    });    $(".glsp").click(function(){        $.ajax({            url: '<?=  urlMobile('seller_center', 'judge');?>',            dataType: 'json',            success: function (data) {                if (data.code == 1){                    window.MBC.openNew({                        url:ApiUrl + '/index.php?con=seller_goods&fun=index&data-state=online',                        pageTitle:'我的商品',                        removeHeader:true                    });                    return false;                } else {                    layer.open({                        content: data.msg.info,                        time: 1.5                    })                }            }        })    });    $(".dpjs").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=store_phone&type=intro',            pageTitle:'店铺介绍',            removeHeader:true        });        return false;    });    $(".dplg").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=member_account&fun=update_img',            pageTitle:'店铺头像',            removeHeader:true        });        return false;    });    $(".sqsj").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=store_phone&type=phone',            pageTitle:'私洽手机',            removeHeader:true        });        return false;    });    $(".xsdd").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order&fun=index',            pageTitle:'销售订单',            removeHeader:true        });        return false;    });    $(".dfk").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order&fun=index&data-state=state_new',            pageTitle:'销售订单',            removeHeader:true        });        return false;    });    $(".dfh").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order&fun=index&data-state=state_pay',            pageTitle:'销售订单',            removeHeader:true        });        return false;    });    $(".yfh").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order&fun=index&data-state=state_send',            pageTitle:'销售订单',            removeHeader:true        });        return false;    });    $(".ywc").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order&fun=index&data-state=state_success',            pageTitle:'销售订单',            removeHeader:true        });        return false;    });    $(".yqx").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order&fun=index&data-state=state_cancel',            pageTitle:'销售订单',            removeHeader:true        });        return false;    });    $(".xstj").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=index',            pageTitle:'销售统计',            removeHeader:true        });        return false;    });    $(".dpgk").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=index',            pageTitle:'销售统计',            removeHeader:true        });        return false;    });    $(".dptj").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=goodslist',            pageTitle:'销售统计',            removeHeader:true        });        return false;    });    $(".dpll").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=storeflow',            pageTitle:'销售统计',            removeHeader:true        });        return false;    });    $(".spll").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=goodsflow',            pageTitle:'销售统计',            removeHeader:true        });        return false;    });    $(".xsph").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_stat&fun=hotgoods',            pageTitle:'销售统计',            removeHeader:true        });        return false;    });    $(".sqtk").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order_refund&fun=index',            pageTitle:'退款退货',            removeHeader:true        });        return false;    });    $(".shtk").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order_refund&fun=index&lock=1',            pageTitle:'退款退货',            removeHeader:true        });        return false;    });    $(".sqth").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order_return&fun=index',            pageTitle:'退款退货',            removeHeader:true        });        return false;    });    $(".shth").click(function(){        window.MBC.openNew({            url:ApiUrl + '/index.php?con=seller_order_return&fun=index&lock=1',            pageTitle:'退款退货',            removeHeader:true        });        return false;    });    function ondeskTop() {        var scfg = {            title:'<?=$output['store_info']['store_name']?>',            image:'<?= getStoreLogo($output['store_info']['store_avatar']) ?>' || '<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?=C('app_alias')?>.jpg',            url:get_share_url(window.location.href),            removeHeader: false,            success:function (rd) {                layer.open({                    content: '添加桌面成功',                    time: 1.5                })            }        };        window.MBC.ondesk(scfg);    }    window.MBC.getAppVersion({        success: function (data) {            var version = JSON.parse('<?= C('app_version') ?>');            if (version.indexOf(data) > -1){                console.log(data);                var html = "<div class=\"fix-block-share\" style=\"bottom:5.5rem;\">\n" +                    "<a href=\"javascript:void(0);\" class=\"\" id=\"ondeskTop\" onclick=\"ondeskTop()\"><i></i></a>\n" +                    "</div>\n"+                    "<div class=\"prompt_box\">\n" +                    "<div class=\"imgWrapper\">\n" +                    "<img src=\"<?php echo MOBILE_TEMPLATES_URL; ?>/images/prompt_message.png\">\n" +                    "<a href=\"javascript:;\" onclick=\"closePromptBox()\" class=\"closeMsgBtn\">\n" +                    "<img src=\"<?php echo MOBILE_TEMPLATES_URL; ?>/images/close_img.png\">\n" +                    "</a>\n"+                    "</div>\n"+                    "</div>";                $('#func_desk').append(html)            }        }    })</script></body></html>