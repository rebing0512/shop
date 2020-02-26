<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

<title>石雕身份证查询</title>

    <meta name="keywords" content="石雕身份证查询" />
    <meta name="description" content="石雕身份证查询" />

    <style type="text/css">
        body {
            color: #555;
            font-family: Microsoft Yahei,"微软雅黑","宋体";
            font-size: 13px;
        }
        p, h1, h2, h3, h4, h5 {
            margin: 0;
            padding: 0;
        }
        .submit{
            height: 50px;
            width: 100%;
            margin-top:30px;
            background-color: rgb(95,142,143);
            border-radius: 8px;
            border-color: white;
            font-size: 18px;
            color: white;
        }
        .ad{
            padding-top: 60px;
            display: block;
            height: 30px;
            color: black;
        }
        .pf3{
            padding-bottom: 30px;
        }
        .tc {
            text-align: center;
        }
        .cx {line-height:24px;color:#484c53;}
        .cx h2 {font-size:16px;margin:30px 0 20px;text-align:center;font-weight:normal;}
        .search-cx {height:40px;line-height:40px;border:1px solid #a3a5a9;border-radius:5px;position:relative;}
        .search-cx .text {width: 100%;border: none;  border: 0;  height: 40px;  line-height: 40px;  margin: 0px 0%;  text-align: center;  font-size: 14px;  border-radius: 5px;}
        .search-cx img {width:30px;position:absolute;left:10px;top:5px;}
        .search-cx {}

        .cx .t1 {font-size:14px;color:#a00004;margin:40px 0;}
        .cx .t1 img {width:40px;}
        .cx p {text-indent:2em;margin-bottom:10px;}
        .cx h3 {font-size:15px;font-weight:normal;}

        .mbcore_wap_inc{ border-bottom:1px solid #CCC;}
        .cx{ padding-top:20px; width:98%; margin:0 auto;}
        input[type=button], input[type=submit], input[type=file], button { cursor: pointer; -webkit-appearance: none; }
    </style>

</head>

<body>


<!--公共头文件读取-->
<?php if($output['MBC']['head_show']){ ?>
    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.min.js"></script>
<?php } ?>
<!-- nav 结束 -->


<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-2.1.0.js"></script>

<div class="cx">
    <h2>石雕身份证查询</h2>
    <div class="pf3">
        <div class="search-cx" id="cx">
            <form id="search_form" method="get" action="./index.php?con=zhengshu&fun=qtview<?php echo $output['MBC']['tag']; ?>">
                <input type="hidden" name="con" value="zhengshu">
                <input type="hidden" name="fun" value="qtview">
                <?php if(!empty($output['MBC']['tag_name']) && !empty($output['MBC']['tag_val'])){?>
                    <input type="hidden" name="<?php echo $output['MBC']['tag_name']; ?>" value="<?php echo $output['MBC']['tag_val']; ?>">
                <?php } ?>
                <input type="text" class="text" name="keyword" value="" placeholder="请输入青田石雕身份证编号" />
                <input type="button"  class="submit" name="search" value="辨别真伪">
            </form>
            <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/so1.png" alt="" />
        </div>
    </div>
    <!-- 结束 -->

    <div class="tc t1">
        <span class="ad">扫一扫辩真伪,更方便</span><br />
        <img src="<?php echo MOBILE_TEMPLATES_URL; ?>/images/so2.png"  id="scanQRCode1" alt="" /><br />
    </div>


    <?php
    $uniqid = time();
    function urls($str){
        $app = C('app_alias');
        return "https://{$app}bbs.confolsc.com/".$str;
    }
    ?>

    <script type="text/javascript">
        var imgUrl = '<?php echo MOBILE_TEMPLATES_URL.'/images/'.$output['MBC']['logo'] ?>';
        var lineLink = '<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?con=zhengshu&fun=search'.$output['MBC']['tag'];?>';
        var shareTitle = '青田石雕的“身份证”认证查询';
        var descContent = shareTitle+"：身份证由青田石雕艺术品有限公司颁发，青田县石雕产业保护和发展局监制。";
    </script>

    <script>
        $(function(){
            //扫码
            $("#scanQRCode1").click(function(){
                window.MBC.scanQRCode({
                    needResult: 1,// 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function (res) {
                        var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                        //  http://www.zgqtsw.cn/shidiao/bh-QTSD020577
                        //  "<?php// echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?con=zhengshu&fun=qtview'.$output['MBC']['tag'].'&keyword='.$_GET['keyword'];?>"
                        //   alert(result);
                        var code_arr = result.split("-"); //字符分割
                        var code_str = "";
                        if(code_arr.length > 1){
                            code_str = code_arr[1];
                        }
                        code_str = code_str.toUpperCase();
                        var href = "<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?con=zhengshu&fun=qtview'.$output['MBC']['tag'].'&keyword=' ?>"+code_str;
                        try{
                            window.location.href=href;
                        } catch (e){
                            alert(e)
                        }
                    }});
            });

            //分享功能
            var params = {
                title:shareTitle,
                url:lineLink,
                image:imgUrl,
                description:descContent
            };
            //console.log(params);
            window.MBC.setShare(params);

        });
    </script>



    <script>
        $(function(){
            $("input[name='search']").click(function(){
                if($("input[name='keyword']").val()==""){
                    $("input[name='search']").val("填写身份证信息辨别真伪！");
                }else{
                    $("#search_form").submit();
                }});

        });
    </script>


    <!-- 结束 -->
    <div class="pf3">
        <h3>青田石雕的“身份证”</h3>
        <p>青田县石雕产业保护和发展局在全国石产业领域首次引入了“身份证管理制度”， 每一件青田石雕都将有自己的防伪身份证明。大大促进了产业的规范发展和诚信经营。</p>
        <p>身份证上注明了品名、石种、规格、作者、作者的技术职称(荣誉称号)、创作时间、鉴定专家、出证日期、编号(二维码)以及其它需要说明的内容。这有助于让石雕爱好者更好地“读懂”、“读透”石雕，从而使青田石雕作品件件有据可查，人人明白消费。</p>
        <p>据了解，青田石雕身份证适用于采用青田石雕技法创作的石雕作品、印章。只对创作工艺进行了严格规定，并未限制外地石种进入青田石雕市场。</p>
        <p>《青田石雕身份证管理制度》对于未按程序办理的行为也制定了严格的处罚规定。如青田石雕身份证制作申请人，如提供虚假情况和资料，致使青田石雕身份证结果失实的，青田石雕主管部门可以宣布该证无效，责令退货或赔偿。对申请人视情况作出警告、曝光、列入黑名单、市场禁入等处罚，并与诚信记录、星级商铺、职称评定、荣誉评定相挂钩。</p>
        <p>同时青田石雕身份证的鉴定专家由青田石雕主管部门会同石雕行业协会协商认定。鉴定专家把关不严，致使身份证结果失实的，青田石雕主管部门可以宣布该证无效，根据情节轻重给予警告、取消资格等处理，并责令协助消费者维权。</p>
    </div>
</div>


</body>
