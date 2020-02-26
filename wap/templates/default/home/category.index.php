<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>分类</title>
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/amazeui.min.css"/>
    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/basesss.css"/>
    <?php
    switch (C('app_alias')){
        case 'hongmuzhijia':
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/hongmu_base.css">
            <?php
            break;
        case 'guoshizhijia':
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/guoshi_base.css">
            <?php
            break;
        case 'zhile':
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/zhile_base.css">
            <?php
            break;
    }
    ?>
    <!--<link rel="stylesheet" href="../css/index.css" />-->
    <style>
        .all-texture{
            width: 90%;
            text-align: center;
            background-color: rgba(249, 245, 244, 0.4);
            margin: 30px auto;
            padding: 5px 0;
            border-radius: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<!--<header id="header" style="position: fixed;">-->
<!---->
<!--    <div class="header-wrap">-->
<!---->
<!--        <div class="header-l" style=" display: block; width: 3.9rem; height: 3.9rem;position: absolute;top: 0;left: 0;">-->
<!--            <a href="javascript:history.go(-1)"><i class="back"></i></a>-->
<!--        </div>-->
<!---->
<!--        <div class="header-title" style="display: inline-block;margin: 0 auto;text-align: center;">-->
<!---->
<!--            <h1 style="font-size: 1.5rem;color: #fff;font-weight: normal;line-height: 3.9rem;height: 3.9rem;">分类</h1>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!--</header>-->
<!--头部部分-->
<?php if (!$output['client']):?>
    <header class="head" style="position:fixed;z-index:200;">
        <div class="fanhui">
            <a href="javascript:history.go(-1)" class="back"><img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/fanhui.png"></a>
        </div>
        <h1 class="span1" style="font-weight: normal;">分类</h1>
    </header>
    <style>
        .margin-top{
            margin-top: 3.9rem;
        }
    </style>
<?php endif;?>
<section class="am-tabs am-g am-mgl margin-top" data-am-tabs="{noSwipe: 1}" id="doc-tab-demo-1">
    <!-- category -->
    <!-- am-tabs-nav -->
    <div class="am-u-sm-2 am-nav  am-nav am-nav-tabs am-minw" style="position:fixed;height: 93.5vh;overflow-x:hidden;overflow-y:auto" id="category-lists">
        <!--<div class="fenlei">
            分类
        </div>-->
        <?php foreach ($output['ch']['result']['category'] as $item): ?>
            <li class="am-u-search" >
                <a data-kind="<?=$item['kind_image']?>" data-texture="<?=$item['texture_image']?>" href="javascript:void(0)" data-ik="<?php echo $item['id']; ?>" class="category-item"><?php echo $item['name']; ?></a>
            </li>
        <?php endforeach; ?>
    </div>

    <div class="am-tabs-bd" style="margin-left:6rem;">
        <div class="main" id="tab1">
            <div class="am-tabs am-tabs_1" data-am-tabs <?= empty($output['ch']['result']['application']['texture_name']) ? 'hidden' : ''?>>
                <ul class="am-tabs-nav am-nav am-nav-tabs" id="sb">
                    <?php if ($output['ch']['result']['application']['sort']=='kind'){ ?>
                        <li class="am-active_a type" id="attribute_button">
                            <img id="kind_image" class="tu " />
                            <p class="am-active_c" id="attribute_button_text"><?=$output['ch']['result']['application']['kind_name']?></p>
                        </li>
                        <li class="am-active_b cath" id="texture_button" style="display: none;">
                            <img id="texture_image" class="tu " />
                            <p class="am-active_c" id="texture_button_text"><?=$output['ch']['result']['application']['texture_name']?></p>
                        </li>
                    <?php } elseif ($output['ch']['result']['application']['sort']=="texture") { ?>
                        <li class="am-active_b cath" id="texture_button">
                            <img id="texture_image" class="tu " />
                            <p class="am-active_c" id="texture_button_text"><?=$output['ch']['result']['application']['texture_name']?></p>
                        </li>
                        <li class="am-active_a type" id="attribute_button" style="display: none;">
                            <img id="kind_image" class="tu " />
                            <p class="am-active_c" id="attribute_button_text"><?=$output['ch']['result']['application']['kind_name']?></p>
                        </li>
                    <?php } ?>


                </ul>
            </div>

            <?php if ($output['ch']['result']['application']['sort']=='kind'){ ?>
                <div class="am-tabs-bd_a" id="attributes" style="display:none">
                    <?php foreach ($output['ch']['result']['category'] as $items): ?>
                        <div id="g<?php echo $items['id']; ?>" style="display:none;">
                            <?php foreach ($items['kinds'] as $item): ?>
                                <div class="am-avg-sm-3 am-avg_a">
                                    <div class="am-tab-panel_nav"><?php echo $item['name']; ?></div>
                                        <?php if (!empty($item['attributes'])): ?>
                                            <?php foreach ($item['attributes'] as $value): ?>
                                                <li data-id="<?php echo $value['id']; ?>" class="attribute">
                                                    <img class="am-thumbnail" src="<?=$value['image']?>"/>
                                                    <?php echo $value['name']; ?><?php if ($value['mark']):?><br/><span class="texture_a">（<?php echo $value['mark'];?>）</span><?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif;?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="am-tabs-bd_c textures" id="textures" style="display:none">
                    <?php foreach ($output['ch']['result']['category'] as $items): ?>
                        <div id="g<?php echo $items['id']; ?>c" class="am-avg-sm-3 am-avg_a" >
                            <div class="am-tab-panel_nav"><?php echo $items['name']; ?></div>

                            <?php foreach ($items['textures'] as $item): ?>
                                <li data-id="<?php echo $item['id']; ?>" class="texture">
                                    <img class="am-thumbnail" src="<?=$item['image']?>" />
                                    <?php if ($item['sub_name']):?>
                                        <?=$item['sub_name'].'<br/><span class="texture_a">（'.$item['name'].'）</span>'?>
                                    <?php else:?>
                                        <?php echo $item['name']; ?>
                                    <?php endif;?>
                                </li>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                            <?php if ($_GET['ref']=='search'):?>
                                <div class="all-texture weui-row_active">未收录材质请点击其它键</div>
                            <?php endif;?>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php } elseif ($output['ch']['result']['application']['sort']=="texture") { ?>
                <div class="am-tabs-bd_c textures" id="textures" style="display:none">
                    <?php foreach ($output['ch']['result']['category'] as $items): ?>
                        <div id="g<?php echo $items['id']; ?>c" class="am-avg-sm-3 am-avg_a" >

                            <div class="am-tab-panel_nav"><?php echo $items['name']; ?></div>

                            <?php foreach ($items['textures'] as $item): ?>
                                <li data-id="<?php echo $item['id']; ?>" class="texture">
                                    <img class="am-thumbnail" src="<?=$item['image']?>" />
                                    <?php if ($item['sub_name']):?>
                                        <?=$item['sub_name'].'<br/><span class="texture_a">（'.$item['name'].'）</span>'?>
                                    <?php else:?>
                                        <?php echo $item['name']; ?>
                                    <?php endif;?>
                                </li>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                            <?php if ($_GET['ref']=='search'):?>
                                <div class="all-texture weui-row_active">未收录材质请点击其它键</div>
                            <?php endif;?>
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="am-tabs-bd_a" id="attributes" style="display:none">
                    <?php foreach ($output['ch']['result']['category'] as $items): ?>
                        <div id="g<?php echo $items['id']; ?>" style="display:none;">
                            <?php foreach ($items['kinds'] as $item): ?>
                                <div class="am-avg-sm-3 am-avg_a">
                                    <div class="am-tab-panel_nav"><?php echo $item['name']; ?></div>
                                    <?php foreach ($item['attributes'] as $value): ?>
                                        <li data-id="<?php echo $value['id']; ?>" class="attribute">
                                            <img class="am-thumbnail" src="<?=$value['image']?>"/>
                                            <?php echo $value['name']; ?><?php if ($value['mark']):?><br/><span class="texture_a">（<?php echo $value['mark'];?>）</span><?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>


        </div>
</section>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-2.1.0.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/amazeui.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/common.js"></script>
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
<script type="text/javascript">
    $('.back').on('click',function () {
        console.log('x')
        window.MBC.back();
        return false;
    })

    var defau = "<?php echo $_SESSION['__ccid'];?>";

    var data = [];
    var current_category_id = null;
    var current_attribute_id = null;
    var current_texture_id = null;
    var ref = getQueryString('ref');

    $(function(){
        $('#g'+defau+'c').show().siblings().hide();
        // left category container
        $('#category-lists').on('click','.category-item',function(){
            var ik = $(this).attr('data-ik');
            // change active status
            $(this).parent('li').addClass('am-active').siblings().removeClass('am-active');
            $('#g'+ik+'c').show().siblings().hide();
            // show attributes
//            $('#attributes').show();
//            $('#textures').hide();
            $('#tab1>div:eq(1)').show();
            $('#tab1>div:eq(2)').hide();
            $('#g'+ik).show().siblings().hide();

            $('#sb>li:first>p').addClass('general_bottom');
//            $("#sb>li:eq(1)>p").removeClass('general_bottom');
            $("#sb>li:eq(1)").css('display','none');
            current_category_id = ik;
            $('body').scrollTop(0);

            // 设置品类和材质按钮背景图
            $('#kind_image').attr('src',$(this).attr('data-kind'));
            $('#texture_image').attr('src',$(this).attr('data-texture'));
        });

        // trigger click event on the first tag:a in category lists
        //$("#category-lists > li:first > a:first ").trigger('click');

        $("#tab1>div:eq(1)").on('click','li',function(){
            var url = '';
            if($(this).attr('class')=='texture'){
                current_texture_id = $(this).attr('data-id');
                <?php if (empty($output['ch']['result']['application']['texture_name']) || empty($output['ch']['result']['application']['kind_name'])):?>
                url = '&category_id='+current_category_id+'&texture_id='+current_texture_id;
                if (ref&&(ref=='search')){
                    window.location.href = '<?php echo urlMobile('goods','list'); ?>'+url+'&ref='+ref;
                }else{
                    window.location.href = '<?php echo urlMobile('seller_goods','add'); ?>'+url;
                }
                return false;
                <?php endif;?>
            }
            if ($(this).attr('class')=='attribute'){
                current_attribute_id = $(this).attr('data-id');
                <?php if (empty($output['ch']['result']['application']['texture_name']) || empty($output['ch']['result']['application']['kind_name'])):?>
                url = '&category_id='+current_category_id+'&attribute_id='+current_attribute_id;
                if (ref&&(ref=='search')){
                    window.location.href = '<?php echo urlMobile('goods','list'); ?>'+url+'&ref='+ref;
                }else{
                    window.location.href = '<?php echo urlMobile('seller_goods','add'); ?>'+url;
                }
                return false;
                <?php endif;?>
            }
            $('#sb>li:eq(1)').show();
            $('#sb>li:eq(1)>p').addClass('general_bottom');
            $("#sb>li:eq(0)>p").removeClass('general_bottom');

            $('#tab1>div:eq(1)').hide();
            $("#tab1>div:eq(2)").show();
            $('#g'+current_category_id+'c').show().siblings().hide();
            if (current_texture_id&&current_attribute_id){
                url = '&category_id='+current_category_id+'&attribute_id='+current_attribute_id+'&texture_id='+current_texture_id;
                if (ref&&(ref=='search')){
                    window.location.href = '<?php echo urlMobile('goods','list'); ?>'+url+'&ref='+ref;
                }else{
                    window.location.href = '<?php echo urlMobile('seller_goods','add'); ?>'+url;
                }
            }
        });

        $("#sb>li:eq(0)").on('click',function(){
            current_category_id = '';
            current_attribute_id = '';
            $('#sb>li:eq(0)>p').addClass('general_bottom');
            $("#sb>li:eq(1)>p").removeClass('general_bottom');
            $('#sb>li:eq(1)').hide();
            $('#tab1>div:eq(2)').hide();
            $("#tab1>div:eq(1)").show();
            $('body').scrollTop(0);
        });

        $('.all-texture').click(function(){
            current_texture_id = 'all';

            if (current_texture_id&&current_attribute_id){
                var url = '&category_id='+current_category_id+'&attribute_id='+current_attribute_id+'&texture_id='+current_texture_id;
                if (ref&&(ref=='search')) {
                    window.location.href = '<?php echo urlMobile('goods', 'list'); ?>' + url + '&ref=' + ref;
                }
            } else {
                $('#sb>li:eq(1)>p').addClass('general_bottom');
                $("#sb>li:eq(0)>p").removeClass('general_bottom');
                $('#sb>li:eq(1)').show();
                $('#tab1>div:eq(1)').hide();
                $("#tab1>div:eq(2)").show();
            }
        });

        $('.all-attribute').click(function(){
            current_attribute_id = 'all';

            if (current_texture_id&&current_attribute_id){
                var url = '&category_id='+current_category_id+'&attribute_id='+current_attribute_id+'&texture_id='+current_texture_id;
                if (ref&&(ref=='search')) {
                    window.location.href = '<?php echo urlMobile('goods', 'list'); ?>' + url + '&ref=' + ref;
                }
            } else {
                $('#sb>li:eq(1)>p').addClass('general_bottom');
                $('#sb>li:eq(1)').show();
                $("#sb>li:eq(0)>p").removeClass('general_bottom');

                $('#tab1>div:eq(1)').hide();
                $("#tab1>div:eq(2)").show();
            }
        });

        $('#tab1>div:eq(2)').on('click',"li",function(){
            if($(this).attr('class')=='texture'){
                current_texture_id = $(this).attr('data-id');
            }
            if ($(this).attr('class')=='attribute'){
                current_attribute_id = $(this).attr('data-id');
            }
            if (current_texture_id&&current_attribute_id){
                var url = '&category_id='+current_category_id+'&attribute_id='+current_attribute_id+'&texture_id='+current_texture_id;
                if (ref&&(ref=='search')){
                    window.location.href = '<?php echo urlMobile('goods','list'); ?>'+url+'&ref='+ref;
                }else{
                    window.location.href = '<?php echo urlMobile('seller_goods','add'); ?>'+url;
                }
            }
        });
        jQuery('a[data-ik='+defau+']').trigger('click');
    });



</script>
</body>
</html>
