<?php defined('TTShop') or exit('Access Invalid!'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/rzxy.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/nctouch_common.css">


<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery.js"></script>
<script>jQuery.noConflict()</script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/cropper.js" type="text/javascript"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/lrz.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/cropper.css">
<style type="text/css">
    .btnselect {
        display: inline-block;
        height: 0.9rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.55rem;
        color: #888;
        line-height: 0.9rem;
        background: #FFF;
        border: solid 0.05rem #EEE;
        border-radius: 0.15rem;
    }

    .current {
        padding: 0.28rem 0.53rem;
        color: #FFF;
        background: #0094DE;
        border: none;
    }

    .border_bottom textarea {
        width: 100%;
        height: 2rem;
        border: none;
    }

    .border_bottom dt em {
        color: red;
    }

    .upload_del {
        width: 15px;
        height: 15px;
        background: red;
        display: inline-block;
        position: absolute;
        right: -6px;
        top: -6px;
        font-size: 10px;
        text-align: center;
        line-height: 15px;
        z-index: 5;
        border-radius: 50%;
        color: #fff;
        opacity: 0.6;
        cursor: pointer;
    }

    a.ncbtn {
        font: normal 12px/20px "microsoft yahei", arial;
        color: #FFF;
        background-color: #CCD0D9;
        text-align: center;
        vertical-align: middle;
        display: inline-block;
        *display: inline;
        height: 20px;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        *zoom: 1;
    }

    ul.select_ul li {
        width: 100%;
        text-align: center;
        height: 30px;
        line-height: 30px;
        border-bottom: 1px solid #eee;
        display: inline-block;

    }
    .input_box dl dt{
        float: left;
        width: 120px;
        color: #2a2a2a;
    }

</style>
</head>
<body>

<header id="header" class="fixed">
    <div class="header-wrap">
        <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>
        <div class="header-title">
            <h1>商品添加</h1>
        </div>
        <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a></div>
    </div>
    <?php include template('layout/toptip'); ?>
</header>
<div class="nctouch-main-layout ">

    <form action="<?php echo urlMobile('seller_goods', 'goods_add'); ?>" method="post" id="sub_goods">
        <input type="hidden" name="commonid" value=""/>
        <input type="hidden" name="type_id" value="1">

        <div class="nctouch-home-block mt5">
            <div class="tit-bar weui-row_active"><i class="general_bgc"></i>商品图片(最多可上传9张商品图片)</div>

            <div class="evaluation-upload-block" id="images">
                <div class="nctouch-upload" id="upload">
                    <a href="javascript:void(0);">
                        <p><i class="icon-upload"></i></p>
                    </a>
                </div>
            </div>
        </div>

        <!-- 分类信息 -->
        <div class="nctouch-home-block mt5">
            <div class="tit-bar weui-row_active"><i class="general_bgc"></i>商品分类信息 <a style="float:right;" href="javascript:void(0);" id="rechange">重新选择</a></div>
            <div class="input_box">
                <dl class="border_bottom">
                    <dt>商品分类</dt>
                    <dd>
                        <?php echo $output['category']['category']; ?>
                    </dd>
                </dl>
                <dl class="border_bottom">
                    <dt><?=$output['name']['kind_name']?></dt>
                    <dd>
                        <?php if ($output['category']['attribute']!='其它'): echo $output['category']['kind'].'-'.$output['category']['attribute']; else:?>
                            <input type="text" name="attribute" id="attribute" placeholder="自定义编辑--最多5个字" maxlength="5"/>
                        <?php endif;?>
                    </dd>
                </dl>
                <dl class="border_bottom">
                    <dt><?=$output['name']['texture_name']?></dt>
                    <dd>
                        <?php if ($output['category']['texture']!='其它'): echo $output['category']['texture']; else:?>
                            <input type="text" name="texture" id="texture" placeholder="自定义编辑--最多5个字" maxlength="5"/>
                        <?php endif;?>
                    </dd>
                </dl>
                <dl>
                    <dt>店内分类</dt>
                    <dd><span class="new_add"><a href="javascript:void(0)" id="add_sgcategory"
                                                 class="ncbtn">新增分类</a> </span>
                        <?php if (!empty($output['store_class_goods'])) { ?>
                            <?php foreach ($output['store_class_goods'] as $v) { ?>
                                <select name="sgcate_id[]" class="sgcategory">
                                    <option value="0"><?php echo $lang['nc_please_choose']; ?></option>
                                    <?php foreach ($output['store_goods_class'] as $val) { ?>
                                        <option value="<?php echo $val['stc_id']; ?>"
                                                <?php if ($v == $val['stc_id']) { ?>selected="selected"<?php } ?>><?php echo $val['stc_name']; ?></option>
                                        <?php if (is_array($val['child']) && count($val['child']) > 0) { ?>
                                            <?php foreach ($val['child'] as $child_val) { ?>
                                                <option value="<?php echo $child_val['stc_id']; ?>"
                                                        <?php if ($v == $child_val['stc_id']) { ?>selected="selected"<?php } ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $child_val['stc_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        <?php } else { ?>
                            <select name="sgcate_id[]" class="sgcategory">
                                <option value="0"><?php echo $lang['nc_please_choose']; ?></option>
                                <?php if (!empty($output['store_goods_class'])) { ?>
                                    <?php foreach ($output['store_goods_class'] as $val) { ?>
                                        <option value="<?php echo $val['stc_id']; ?>"><?php echo $val['stc_name']; ?></option>
                                        <?php if (is_array($val['child']) && count($val['child']) > 0) { ?>
                                            <?php foreach ($val['child'] as $child_val) { ?>
                                                <option value="<?php echo $child_val['stc_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $child_val['stc_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <p class="hint"><?php echo $lang['store_goods_index_belong_multiple_store_class']; ?></p>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="nctouch-home-block mt5">
            <div class="tit-bar weui-row_active"><i class="general_bgc"></i>商品基本信息</div>
            <div class="input_box">
                <dl class="border_bottom">
                    <dt><em></em>商品名称</dt>
                    <dd>
                        <input id="g_name" name="g_name" type="text" value="" placeholder="长度最少3个字符"/>
                    </dd>
                </dl>
                <dl class="border_bottom">
                    <dt>商品卖点</dt>
                    <dd>
                        <input id="g_jingle" name="g_jingle" placeholder="长度140字符以内" style="font-size: 16px;border: none;"/>
<!--                        <textarea id="g_jingle" name="g_jingle" placeholder="长度140字符以内"></textarea>-->
                    </dd>
                </dl>
                <dl class="border_bottom">
                    <dt>商品价格</dt>
                    <dd>
                        <input id="g_price" name="g_price" type="text" value=""
                               placeholder="0.01~9999999之间的数字"/>
                    </dd>
                </dl>
<!--                <dl class="border_bottom">-->
<!--                    <dt>市场价</dt>-->
<!--                    <dd>-->
<!--                        <input id="g_marketprice" name="g_marketprice" type="text" value=""-->
<!--                               placeholder="0.01~9999999之间的数字，此价格仅为市场参考售价"/>-->
<!--                    </dd>-->
<!--                </dl>-->
<!--                <dl class="border_bottom">-->
<!--                    <dt>成本价</dt>-->
<!--                    <dd>-->
<!--                        <input id="g_costprice" name="g_costprice" type="text" value=""-->
<!--                               placeholder="0.00~9999999之间的数字，非必填选项"/>-->
<!--                    </dd>-->
<!--                </dl>-->
<!--                <dl class="border_bottom">-->
<!--                    <dt>折扣</dt>-->
<!--                    <dd>-->
<!--                        <input id="g_discount" name="g_discount" readonly type="text"-->
<!--                               placeholder="自动生成，不需编辑"/>-->
<!--                    </dd>-->
<!--                </dl>-->
                <dl class="border_bottom">
                    <dt>商品库存</dt>
                    <dd>
                        <input id="g_storage" name="g_storage" type="text" value="1" placeholder="为0~999999999之间的整数"/>
                    </dd>
                </dl>
<!--                <dl class="border_bottom">-->
<!--                    <dt>库存预警值</dt>-->
<!--                    <dd>-->
<!--                        <input id="g_alarm" name="g_alarm" type="text" value="" placeholder="请填写0~255的数字，0为不预警"/>-->
<!--                    </dd>-->
<!--                </dl>-->
<!--                <dl class="border_bottom">-->
<!--                    <dt>商品货号</dt>-->
<!--                    <dd>-->
<!--                        <input id="g_serial" name="g_serial" type="text" value=""-->
<!--                               placeholder="最多可输入20个字符，支持输入中文、字母、数字、_、/、-和小数点"/>-->
<!--                    </dd>-->
<!--                </dl>-->
<!--                <dl class="border_bottom">-->
<!--                    <dt>商品条形码</dt>-->
<!--                    <dd>-->
<!--                        <input id="g_barcode" name="g_barcode" type="text" value=""/>-->
<!--                    </dd>-->
<!--                </dl>-->
                <dl class="border_bottom">
                    <dt style="margin-top: 6%;">运费</dt>
                    <dd>
                        <input id="freight_0" nctype="freight" name="freight" class="radio" checked="checked" value="0"
                               type="radio">
                        <label for="freight_0">固定运费</label>
                        <div nctype="div_freight" style="width: 65%;float: right;height: 40px;">
                            <input id="g_freight" class="general_borderbt" name="g_freight" type="text" value="">
                        </div>
                        <input id="freight_1" nctype="freight" name="freight" class="radio" value="1" type="radio">
                        <label for="freight_1">包邮</label>
                    </dd>
                </dl>

                <dl class="border_bottom">
                    <dt>上架</dt>
                    <dd>
                        <div class="input-box " style="text-align: right;">
                            <label class="checked">
                                <input type="checkbox" checked="checked" class="checkbox" id="g_state" name="g_state" autocomplete="off"/>
                                <span class="power"><i></i></span> </label>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>


        <div class="nctouch-home-block mt5">
            <div class="tit-bar weui-row_active"><i class="general_bgc"></i>商品详情</div>
            <div class="input_box">
                <dl class="border_bottom">
                    <dd style="margin-left:0px;">
                        <textarea id="g_body" name="g_body" placeholder="简单商品详情描述" style="height:4rem;border: 1px solid #dfdfdf;font-size: 16px;"></textarea>
                    </dd>
                </dl>
            </div>
        </div>
        <input type="hidden" name="b_id" value="">
        <input type="hidden" name="b_name" value="">
        <input type="hidden" name="add_album" value="">
        <input type="hidden" name="jumpMenu" value="0">
        <input type="hidden" name="sup_id" value="0">
        <input type="hidden" name="plate_bottom" value="请选择">
        <input type="hidden" name="plate_top" value="请选择">
        <input type="hidden" name="freight" value="0">
        <input type="hidden" name="g_commend" value="1">
        <input type="hidden" name="city_id" value="">
        <input type="hidden" name="province_id" value="">
        <input type="hidden" name="g_vat" value="0">
        <input type="hidden" name="m_body" value="">
        <input type="hidden" name="goods_image" value="">
        <input type="hidden" name="search_brand_keyword" value="">
        <input type="hidden" name="region" value="">
        <input type="hidden" name="category_id" value="<?=$_GET['category_id']?>" />
        <input type="hidden" name="attribute_id" value="<?=$_GET['attribute_id']?>" />
        <input type="hidden" name="texture_id" value="<?=$_GET['texture_id']?>" />
        <a class="btn-l mt5 mb5 general_bgc" id="edit_goods" style="width: 96%;margin: 0 2%;">添加商品</a>
    </form>

    <div class="fix-block-r">
        <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
        <div class="constrast-brand hide">
            <ul class="select_ul">
                <?php if (is_array($output['list']) && !empty($output['list'])) { ?>
                    <?php foreach ($output['list'] as $vt) { ?>
                        <li><a href="javascript:;"
                               onclick="selectul('<?php echo $vt['title']; ?>',<?php echo $vt['id']; ?>,<?php echo intval($output['extend'][$v['id']]['price']); ?>)"><?php echo $vt['title']; ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
    <script>

//        var uploadTip = false;
//        var syncUpload = function(localids){
//            var id = localids.shift();
//            wx.uploadImage({
//                localId:id,
//                isShowProgressTips:false,
//                success:function(res){
//                    var serverid = res.serverId;
//                    $('#upload').before(html.replace(/__id__/g,serverid));
//                    if (localids.length>0) {
//                        syncUpload(localids);
//                    } else {
//                        layer.close(uploadTip);
//                    }
//                }
//            });
//        };
//        function MBCoreWXScriptCallback()
//        {
//            $("#upload").click(function(){
//                var existsImageCount = $('#images').find('.image').length;
//                if (existsImageCount >= 9) {
//                    alert('最多允许上传9张图片');
//                    return false;
//                }
//                wx.chooseImage({
//                    count:9-existsImageCount,
//                    success:function(res){
//                        uploadTip = layer.open({
//                            shadeClose:0,
//                            type:0,
//                            content:'正在上传图片'
//                        });
//                        var localids = res.localIds;
//                        console.log(localids.length);
//                        syncUpload(localids);
//                    }
//                });
//            });
//        }
        ;$(function () {
            $('#upload').on('click', function (event) {

                event.stopPropagation();
                var uploadedCount = $('#images').find('.image').length;

                if (9-uploadedCount<=0) {
                    layer.open({
                        content:'最多只能选择9张图片',
                        time:1.5
                    });
                    //$.toptip('最多只能选择9张图片',800,'error');
                    return false;
                }

                window.MBC.chooseImage({
                    count: 9 - uploadedCount,
                    success: function (data) {
                        layer.close();
                        //$.hideLoading();
                        if (data.code == 2) {
                            //$.toast('已取消','forbidden');
                            return false;
                        } else if (data.code == 3) {
                            layer.open({
                                content:'正在上传图片'
                            });
                            return false;
                            //$.showLoading('正在上传图片');
                        } else if (data.code == 4) {
                            // 上传过程已经全部结束
                            layer.close();
                            //$.hideLoading();
                            return false;
                        } else if (data.code == 5) {
                            // 已完成 N 张
                            // todo 待处理
                            return false;
                        } else if (data.code == 6) {
                            // 正在上传第 X 张
                            // todo 待处理
                            return false;
                        }
                        var url = "";
                        if (url.length <= 9) {
                            for (var i in data.ids) {
                                url = "https://gateway.confolsc.com/files/image/" + data.ids[i] + "?redirect=1&size=200,200";
                                //var html = '<li data-rid="__id__" id="upload" style="margin-top: 0.5rem;" class="weui_uploader_file uploadedFile" ><img class="img1" src="__url__"/><img class="img2" src=""></li>'.replace('__id__',data.ids[i]);

                                var html = '\
                                    <div class="nctouch-upload image">\
                                    <i class="upload_del">x</i>\
                                    <a href="javascript:void(0);">\
                                    <p>\
                                    <img data-id="__id__" src="__url__" style="width:100%;"/>\
                                    </p>\
                                    </a>\
                                    </div>';

                                html = html.replace('__id__',data.ids[i]);
                                html = html.replace('__url__',url);
                                $(html).insertBefore('#upload');
                            }
                            $('#images').on('click','.upload_del',function(){
                                $(this).parent().remove();
                            });
                        }
                    }
                });
            });
        });
    </script>
<!--    <script src="https://mbcsc.confolsc.com/wx_script.php?alias=--><?//=C('app_alias')?><!--"></script>-->
    <script>
        $("#add_sgcategory").unbind().click(function(){
            $(".sgcategory:last").after($(".sgcategory:last").clone(true).val(0));
        });
        $('#rechange').on('click',function(){
            if (confirm('将丢失当前已填写信息，确认要重新选择分类吗？')) {
                window.location.href = ApiUrl+'/index.php?con=category&next=publish_goods';
            }
            return false;
        });
        function selectul(title, id, price) {
            $("#transport_id").val(id);
            $("#transport_title").val(title);
            $("#g_freight").val(price);

            $("#postageName").text(title).css({'display': 'inline-block'});
            layer.closeAll();

        }
        $('#freight_0').click(function () {
            $('#g_freight').removeAttr('disabled')
        })
        $('#freight_1').click(function () {
            $('#g_freight').val(0.00)
            $('#g_freight').attr('disabled',true)
        })
//        jQuery(function () {
//            jQuery("#header .top_home").on("click", function () {
//                jQuery("#header .home_menu").toggle();
//            });
//            // 运费部分显示隐藏
//            jQuery('#freight_0').click(function () {
//                jQuery('div[nctype="div_freight"]').eq(0).show();
//                jQuery('div[nctype="div_freight"]').eq(1).hide();
//            });
//            jQuery('#freight_1').click(function () {
//
//                jQuery('div[nctype="div_freight"]').eq(1).show();
//                jQuery('div[nctype="div_freight"]').eq(0).hide();
//            });
//            jQuery("#postageButton").click(function () {
//                layer.open({type: 2, content: "加载中..."});
//                layer.closeAll();
//                layer.open({
//                    type: 1,
//                    title: "请选择售卖区域",
//                    content: jQuery('.constrast-brand').html(),
//                    shadeClose: false
//                });
//            });
//        });
        function lackBack() {
            layer.closeAll();
        }
        //更换头像
        function upload_img() {
            jQuery("#vip-file").trigger("click");
        }
        $('#sub_goods').on('submit',function(){
            var data = $(this).serialize();
            var action = $(this).attr('action');
            var _sub_dialog = layer.open({
                type:2,
                shadeClose:0
            });

            // 获取商品图片
            var imgs = '';
            $('#images').find('img[data-id]').each(function(i,v){console.log(i,v);
                imgs += 'img[]='+$(v).attr('data-id')+'&';
            });
            data += '&'+imgs;

            $.ajax({
                url:action,
                type:'post',
                dataType:'json',
                data:data,
                success:function(data){
                    layer.open(_sub_dialog);
                    if (data.code != 1) {
                        layer.open({"content":data.msg});
                    } else {
                        layer.open({
                            content:'发布成功！',
                            time:1.5
                        })
                        window.location.href =data.url;
                    }
                },
                complete:function(){
                    layer.close(_sub_dialog);
                },
                error:function(){
                }
            });
            return false;
        });
        $("#edit_goods").on('click',function(){
            $('#sub_goods').submit();
        });
    </script>


    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/list/goods_add.js"></script>
  