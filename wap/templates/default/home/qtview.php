

    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/qrcss/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/qrcss/index.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/qrcss/animations.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/qrcss/load.css" />
<style>
    .page {
        position: relative;
    }
</style>
</head>
<body ontouchstart style=" height: 100%;position: absolute;">

<div id="loading">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>
<div id="content" style="display:none;height: 100%;">
    <div class="page page-1-1 page-current">
        <div class="wrap">
            <div class="img_1 pt-page-moveFromTop">
                <div class="WC_left">
                    <h1>
                        石雕身份证查询结果</h1>
                    <ul>
                        <?php foreach($output['this_data'] as $key => $val){
                            if($key == 'Picture'){
                                continue;
                            }
                            echo "<li>".$val['title']."：".$val['value']."</li>";
                        }?>
                    </ul>

                </div>
                <div class="img_1 pt-page-moveFromLeft mbcore_xinxi" style="font-size: 15px">
                    <span>监督电话 0578-6963308</span><br>
                    <span>石雕身份证由</span><br>
                    <span>青田县石雕行业协会颁发</span><br>
                    <span>青田县石雕产业保护和发展局监制</span>
                </div>

            </div>
            <img class="img_2 pt-page-moveCircle" src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/t1-yuan.png" />
            <img class="img_3 pt-page-moveIconUp" src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/icon_up.png" />
        </div>
    </div>
    <div class="page page-2-1 hide">
        <div class="wrap">
            <div class="img_1 pt-page-moveFromLeft mbcore_xinxi">
                <?php foreach($output['this_data'] as $key => $val){
                    if(
                        $key == 'Picture' ||
                        $key == 'SBNumber' ||
                        $key == 'Author'
                    ){
                        continue;
                    }
                    echo "<span>".$val['title']."：".$val['value']."</span>";
                }?>

            </div>
            <?php
            if(empty($output['this_data']['Picture']['value'])){
                $this_src = MOBILE_TEMPLATES_URL."/images/t2-2.png";
            }else{
                $this_src = $output['this_data']['Picture']['value'][0];
            }
            ?>
            <img id="tupian_datu" class="img_3 hide pt-page-moveCircle" src="<?php echo  $this_src; ?>" />
            <img class="img_6 pt-page-moveIconUp" src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/icon_up.png" />
        </div>
    </div>
    <div class="page page-3-1 hide">
        <div class="wrap">
            <div id="qrcode" class="img_0 pt-page-moveCircle"></div>
            <div class="img_1 pt-page-moveFromLeft mbcore_xinxi" style="font-size: 15px">
                <span>监督电话 0578-6963308</span><br>
                <span>石雕身份证由</span><br>
                <span>青田县石雕行业协会颁发</span><br>
                <span>青田县石雕产业保护和发展局监制</span><br>

                <span style="padding-top:20px;">青田国石社区</span><br>
                <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?php echo $output['MBC']['qr']; ?>">

            </div>
        </div>
    </div>
    <style>
        .page-3-1 .img_0{ width:100%; margin-top:60px;}
        <!--二维码新增样式-->
            #qrcode{ width:120px; height:120px;}
        #qrcode img{ position:relative; top:0px; left:50%; margin-left:-60px; z-index:20; width:120px; height:120px;}
        .page-3-1 .img_1{ top:0px;}
        .page-3-1 .mbcore_xinxi{ margin-top:60%;}

        .page-3-1 .img_1 img{width:120px; height:120px; margin-top:6px; margin-bottom:2px;}
    </style>

</div>

<!--返回按钮-->
<div  style="position: fixed; left: 20px; top: 20px; z-index: 5; visibility: visible;">
    <a href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?con=zhengshu&fun=search'.$output['MBC']['tag'];?>"><img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/fanhui22.png" width="40" /> </a>
</div>
<!--分享按钮-->
<div  style="position: fixed; right: 20px; top: 20px; z-index: 5; visibility: visible;">
    <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/fenxiang.png" width="40" onclick="shareDialog()"/>
</div>

<!--向下按钮-->
<div  id="ico_down" style="position: fixed; left:50%;margin-left:-20px; top: 20px; z-index: 5; visibility: visible; display:none;">
    <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/ico_down.png" width="40" onclick="shareDialog()"/>
</div>


<div id="share" onClick="closeDialog()">
    <div class="shareImg"></div>
</div>

<script type="text/javascript">
    var imgUrl = '<?php echo MOBILE_TEMPLATES_URL.'/images/'.$output['MBC']['logo'] ?>';
    <?php
    if(!empty($output['this_data']['Picture']['value'][0])){
        echo "imgUrl = '".$output['this_data']['Picture']['value'][0]."';";
    }
    ?>
    var lineLink = '<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?con=zhengshu&fun=qtview'.$output['MBC']['tag'].'&keyword='.$_GET['keyword'];?>';
    var shareTitle = '<?php echo trim($output['this_data']["Title"]["value"]);?>认证';
    var descContent = shareTitle+"由 青田石雕艺术品有限公司颁发，青田县石雕产业保护和发展局监制。";
    var appid = '<?php echo $output['signPackage']["appId"];?>';
    //gSound = 'img/1.mp3';
</script>

<script>
    var imgUrl = '<?php echo MOBILE_TEMPLATES_URL.'/images/'.$output['MBC']['logo'] ?>';
    var lineLink = window.location.href;
    var shareTitle = '青田石雕的“身份证”认证查询';
    var descContent = shareTitle+"：身份证由青田石雕艺术品有限公司颁发，青田县石雕产业保护和发展局监制。";
    //分享功能
    var params = {
        title:shareTitle,
        url:lineLink,
        image:imgUrl,
        description:descContent
    };
    //console.log(params);
    window.MBC.setShare(params);
</script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>
<!--<script src="--><?php //echo MOBILE_TEMPLATES_URL; ?><!--/js/touch.js"></script>-->
<script src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/index.js"></script>
<script type="text/javascript">
    document.onreadystatechange = loading;
    function loading(){
        if(document.readyState == "complete")
        {
            $("#loading").hide();
            $("#content").show();
            //playbksound();
        }
    }
    function shareDialog(){
        $("#share").show();
    }
    function closeDialog(){
        $("#share").hide();
    }
</script>
<!--图片浏览器-->
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/weui.min.css">
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL; ?>/css/qrcss/jquery-weui.css">
<style>
    .weui-photo-browser-modal{
        position:fixed; top:0px; left:0px; width:100%; height:100%;
        z-index:10000;
    }
</style>

<script src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery-weui.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/market/swiper.js"></script>
<script>
    var pb2 = $.photoBrowser({
        items: [
            <?php  if(empty($output['this_data']['Picture']['value'])){?>
            {
                image: "<?php echo MOBILE_TEMPLATES_URL; ?>/images/t2-2.png",
                caption: "默认图片"
            }
            <?php }else{
            $this_img_arr = $output['this_data']['Picture']['value'];
            $len = count($this_img_arr);
            $this_len = 0;
            foreach($this_img_arr as $val){
            $this_len++;
            ?>
            {
                image: "<?php echo $val;?>",
                caption: "<?php echo $output['this_data']['Title']['value'];?>"
            }
            <?php
            if($this_len<$len) echo ",";
            }
            }?>
        ]
    });

    //var is_open = 0;
    $("#tupian_datu").click(function(){
        /*if(is_open){
         }else{
         }*/
        console.log("test");
        pb2.open();  //打开
    });
</script>

<!--二维码生成-->
<script src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/qrcode.min.js"></script>
<script type="text/javascript">
    //http://www.zgqtsw.cn/shidiao/bh-
    //new QRCode(document.getElementById("qrcode"), "<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?con=zhengshu&fun=qtview&keyword='.$_GET['keyword'];?>");
    new QRCode(document.getElementById("qrcode"),
        {
            text: '<?php echo 'http://www.zgqtsw.cn/shidiao/bh-'.strtoupper($_GET['keyword']);?>',
            width: 120,
            height: 120,
            //colorDark : '#000000',
            //colorLight : '#ffffff',
            correctLevel : QRCode.CorrectLevel.H
        }
        //"<?php echo 'http://www.zgqtsw.cn/shidiao/bh-'.strtoupper($_GET['keyword']);?>"
    );
</script>
</body>
</html>