<?php defined( 'TTShop') or exit( 'Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_products_detail.css">

<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jweixin-1.0.0.js"></script>

<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=SirZmuszfnkIwZxmqqpfU6cgR9cbRUku&s=1"></script>

<script type="text/javascript" src="https://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>

<link rel="stylesheet" href="https://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />

</head>

<body>

<header id="header" class="posf">

    <div class="header-wrap">

        <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="back"></i> </a> </div>

        <ul class="header-nav">

            <li class=""><a href="javascript:void(0);" id="address">店铺地址</a></li>

        </ul>

        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>

    </div>

    <?php include template('layout/toptip');?>

    <style>
        img{
            margin-bottom: 5px;
        }
    </style>

</header>

<?php /***require_once template('layout/fiexd');**/?>



        <div id="allmap"></div>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>

<script type="text/javascript">
    $(function () {
        $('#allmap').height(window.innerHeight)
        // 百度地图API功能
        var map = new BMap.Map("allmap");    // 创建Map实例
        map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
        // 百度地图API功能
        var poi = new BMap.Point(<?=$output['address']['baidu_lng']?>,<?=$output['address']['baidu_lat']?>);
        map.centerAndZoom(poi, 16);
        var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
            '<img src="<?=getStoreLogo($output['store_info']['store_avatar'],'store_logo')?>" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;"/>' +
            '地址：<?=$output['address']['address_info']?><br/>电话：<?=$output['address']['phone_info']?><br/>简介：<?=$output['store_info']['store_description']?>' +
            '</div>';
        //创建检索信息窗口对象
        var searchInfoWindow = null;
        searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
            title  : "<?=$output['address']['name_info']?>",      //标题
            width  : 290,             //宽度
            height : 105,              //高度
            panel  : "panel",         //检索结果面板
            enableAutoPan : true,     //自动平移
            enableSendToPhone:false,
            searchTypes   :[
                BMAPLIB_TAB_SEARCH,   //周边检索
                BMAPLIB_TAB_TO_HERE,  //到这里去
                BMAPLIB_TAB_FROM_HERE //从这里出发
            ]
        });
        var marker = new BMap.Marker(poi); //创建marker对象
        marker.enableDragging(); //marker可拖拽
        searchInfoWindow.open(marker);
        map.addOverlay(marker); //在地图中添加marker
    })
</script>

