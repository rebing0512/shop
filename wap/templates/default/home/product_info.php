<?php defined( 'TTShop') or exit( 'Access Invalid!');?><link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_products_detail.css"><script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jweixin-1.0.0.js"></script></head><body><header id="header" class="posf">  <div class="header-wrap">    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="back"></i> </a> </div>    <ul class="header-nav">      <li><a href="javascript:void(0);" id="goodsDetail">商品</a></li>      <li class="cur"><a href="javascript:void(0);" id="goodsBody">详情</a></li>      <li><a href="javascript:void(0);" id="goodsEvaluation">评价</a></li>    </ul>    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>  </div>  <?php include template('layout/toptip');?></header><?php /***require_once template('layout/fiexd');**/?><div class="nctouch-main-layout" id="fixed-tab-pannel">  <div class="fixed-tab-pannel">    <?php echo $output['goods_common_info']['goods_body'];?>  </div></div><script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script> <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script><script type="text/javascript">    var TB = 0;    $(function() {        $(window).scroll(function() {            if ($(window).scrollTop() == 0) {                //alert(11111)                if(TB > 0){                    $("#goodsDetail").click();                }                TB += 1;            }        });    });    $(function(){     var o= <?php echo $output['goods_id'];?>;         $("#goodsDetail").click(function() {             window.location.href = ApiUrl + "/index.php?con=goods&fun=detail&goods_id=" + o        });        $("#goodsBody").click(function() {           window.location.href = ApiUrl + "/index.php?con=goods&fun=goods_body&goods_id=" + o        });        $("#goodsEvaluation").click(function() {            window.location.href = ApiUrl + "/index.php?con=goods&fun=goods_evaluate&goods_id=" + o        })    })    $(function () {        var imgObj = document.getElementsByTagName('img');        var imgsurl = [];        var nowurl='';        //var imgObj=$("#content img");        //console.log(imgs.length)        for(var i=0;i<imgObj.length;i++){            imgsurl[i]=imgObj[i].src;            imgObj[i].onclick=function(){                nowurl=this.src;                wx.previewImage({                    current: nowurl,                    urls: imgsurl                });            }        }    });</script>