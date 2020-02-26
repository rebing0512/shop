<?php
defined('TTShop') or exit('Access Invalid!'); ?>
<link href="<?php echo SHOP_TEMPLATES_URL; ?>/css/index.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wwi-main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL; ?>/js/home_index.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/waypoints.js"></script> 
<style type="text/css">.category { display: block !important; }</style>
<?php if($output['zom_list'][0]['site_status']==1){?>
<div id="new-user" class="new-user">
    <div class="new-pic">
    <div id="zommbox" class="bannerBox2" >
            <div class="bd">
                <ul>                  
                    <?php foreach($output[ 'zom_list'][0]['code_info'] as $vai){?>
                        <li style="display: table-cell; vertical-align: top; width: 800px;">
                            <a href="<?php echo $vai['pic_url'];?>" target="_blank">        
                                <img src="<?php echo UPLOAD_SITE_URL.'/'.$vai['pic_img'];?>" alt="<?php echo $vai['pic_name'];?>"/>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            <div class="hd">
                <ul>
                <?php $cv == 0;foreach($output['zom_list'][0]['code_info'] as $cinfo){$cv++;?>
                    <li class=""><?php echo  $cv;?></li>
                <?php }?>
                </ul>
            </div>
        </div>
    </div>
    <i class="close" onclick="closezz();"></i>
</div>
<div id="dialog-overlay" class="dialog-overlay" >
    <div class="overlay"></div>
</div>

<script type="text/javascript">
    var TouchSlide=function(a){a=a||{};var b={slideCell:a.slideCell||"#touchSlide",titCell:a.titCell||".hd li",mainCell:a.mainCell||".bd",effect:a.effect||"left",autoPlay:a.autoPlay||!1,delayTime:a.delayTime||200,interTime:a.interTime||2500,defaultIndex:a.defaultIndex||0,titOnClassName:a.titOnClassName||"on",autoPage:a.autoPage||!1,prevCell:a.prevCell||".prev",nextCell:a.nextCell||".next",pageStateCell:a.pageStateCell||".pageState",pnLoop:"undefined "==a.pnLoop?!0:a.pnLoop,startFun:a.startFun||null,endFun:a.endFun||null,switchLoad:a.switchLoad||null},c=document.getElementById(b.slideCell.replace("#",""));if(!c)return!1;var d=function(a,b){a=a.split(" ");var c=[];b=b||document;var d=[b];for(var e in a)0!=a[e].length&&c.push(a[e]);for(var e in c){if(0==d.length)return!1;var f=[];for(var g in d)if("#"==c[e][0])f.push(document.getElementById(c[e].replace("#","")));else if("."==c[e][0])for(var h=d[g].getElementsByTagName("*"),i=0;i<h.length;i++){var j=h[i].className;j&&-1!=j.search(new RegExp("\\b"+c[e].replace(".","")+"\\b"))&&f.push(h[i])}else for(var h=d[g].getElementsByTagName(c[e]),i=0;i<h.length;i++)f.push(h[i]);d=f}return 0==d.length||d[0]==b?!1:d},e=function(a,b){var c=document.createElement("div");c.innerHTML=b,c=c.children[0];var d=a.cloneNode(!0);return c.appendChild(d),a.parentNode.replaceChild(c,a),m=d,c},g=function(a,b){!a||!b||a.className&&-1!=a.className.search(new RegExp("\\b"+b+"\\b"))||(a.className+=(a.className?" ":"")+b)},h=function(a,b){!a||!b||a.className&&-1==a.className.search(new RegExp("\\b"+b+"\\b"))||(a.className=a.className.replace(new RegExp("\\s*\\b"+b+"\\b","g"),""))},i=b.effect,j=d(b.prevCell,c)[0],k=d(b.nextCell,c)[0],l=d(b.pageStateCell)[0],m=d(b.mainCell,c)[0];if(!m)return!1;var N,O,n=m.children.length,o=d(b.titCell,c),p=o?o.length:n,q=b.switchLoad,r=parseInt(b.defaultIndex),s=parseInt(b.delayTime),t=parseInt(b.interTime),u="false"==b.autoPlay||0==b.autoPlay?!1:!0,v="false"==b.autoPage||0==b.autoPage?!1:!0,w="false"==b.pnLoop||0==b.pnLoop?!1:!0,x=r,y=null,z=null,A=null,B=0,C=0,D=0,E=0,G=/hp-tablet/gi.test(navigator.appVersion),H="ontouchstart"in window&&!G,I=H?"touchstart":"mousedown",J=H?"touchmove":"",K=H?"touchend":"mouseup",M=m.parentNode.clientWidth,P=n;if(0==p&&(p=n),v){p=n,o=o[0],o.innerHTML="";var Q="";if(1==b.autoPage||"true"==b.autoPage)for(var R=0;p>R;R++)Q+="<li>"+(R+1)+"</li>";else for(var R=0;p>R;R++)Q+=b.autoPage.replace("$",R+1);o.innerHTML=Q,o=o.children}"leftLoop"==i&&(P+=2,m.appendChild(m.children[0].cloneNode(!0)),m.insertBefore(m.children[n-1].cloneNode(!0),m.children[0])),N=e(m,'<div class="tempWrap" style="overflow:hidden; position:relative;"></div>'),m.style.cssText="width:"+P*M+"px;"+"position:relative;overflow:hidden;padding:0;margin:0;";for(var R=0;P>R;R++)m.children[R].style.cssText="display:table-cell;vertical-align:top;width:"+M+"px";var S=function(){"function"==typeof b.startFun&&b.startFun(r,p)},T=function(){"function"==typeof b.endFun&&b.endFun(r,p)},U=function(a){var b=("leftLoop"==i?r+1:r)+a,c=function(a){for(var b=m.children[a].getElementsByTagName("img"),c=0;c<b.length;c++)b[c].getAttribute(q)&&(b[c].setAttribute("src",b[c].getAttribute(q)),b[c].removeAttribute(q))};if(c(b),"leftLoop"==i)switch(b){case 0:c(n);break;case 1:c(n+1);break;case n:c(0);break;case n+1:c(1)}},V=function(){M=N.clientWidth,m.style.width=P*M+"px";for(var a=0;P>a;a++)m.children[a].style.width=M+"px";var b="leftLoop"==i?r+1:r;W(-b*M,0)};window.addEventListener("resize",V,!1);var W=function(a,b,c){c=c?c.style:m.style,c.webkitTransitionDuration=c.MozTransitionDuration=c.msTransitionDuration=c.OTransitionDuration=c.transitionDuration=b+"ms",c.webkitTransform="translate("+a+"px,0)"+"translateZ(0)",c.msTransform=c.MozTransform=c.OTransform="translateX("+a+"px)"},X=function(a){switch(i){case"left":r>=p?r=a?r-1:0:0>r&&(r=a?0:p-1),null!=q&&U(0),W(-r*M,s),x=r;break;case"leftLoop":null!=q&&U(0),W(-(r+1)*M,s),-1==r?(z=setTimeout(function(){W(-p*M,0)},s),r=p-1):r==p&&(z=setTimeout(function(){W(-M,0)},s),r=0),x=r}S(),A=setTimeout(function(){T()},s);for(var c=0;p>c;c++)h(o[c],b.titOnClassName),c==r&&g(o[c],b.titOnClassName);0==w&&(h(k,"nextStop"),h(j,"prevStop"),0==r?g(j,"prevStop"):r==p-1&&g(k,"nextStop")),l&&(l.innerHTML="<span>"+(r+1)+"</span>/"+p)};if(X(),u&&(y=setInterval(function(){r++,X()},t)),o)for(var R=0;p>R;R++)!function(){var a=R;o[a].addEventListener("click",function(){clearTimeout(z),clearTimeout(A),r=a,X()})}();k&&k.addEventListener("click",function(){(1==w||r!=p-1)&&(clearTimeout(z),clearTimeout(A),r++,X())}),j&&j.addEventListener("click",function(){(1==w||0!=r)&&(clearTimeout(z),clearTimeout(A),r--,X())});var Y=function(a){clearTimeout(z),clearTimeout(A),O=void 0,D=0;var b=H?a.touches[0]:a;B=b.pageX,C=b.pageY,m.addEventListener(J,Z,!1),m.addEventListener(K,$,!1)},Z=function(a){if(!H||!(a.touches.length>1||a.scale&&1!==a.scale)){var b=H?a.touches[0]:a;if(D=b.pageX-B,E=b.pageY-C,"undefined"==typeof O&&(O=!!(O||Math.abs(D)<Math.abs(E))),!O){switch(a.preventDefault(),u&&clearInterval(y),i){case"left":(0==r&&D>0||r>=p-1&&0>D)&&(D=.4*D),W(-r*M+D,0);break;case"leftLoop":W(-(r+1)*M+D,0)}null!=q&&Math.abs(D)>M/3&&U(D>-0?-1:1)}}},$=function(a){0!=D&&(a.preventDefault(),O||(Math.abs(D)>M/10&&(D>0?r--:r++),X(!0),u&&(y=setInterval(function(){r++,X()},t))),m.removeEventListener(J,Z,!1),m.removeEventListener(K,$,!1))};m.addEventListener(I,Y,!1)};
</script>

<script type="text/javascript">
    
     $(function(){
        var zomzc = getCookie('zomzc');
           
           if(!zomzc){
            
            $("#new-user").show();
              $("#dialog-overlay").show();
          }
        TouchSlide({ 
        slideCell:"#zommbox",
        titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        mainCell:".bd ul", 
        effect:"leftLoop", 
        delayTime:1000,
        interTime:4000,
        autoPage:true,//自动分页
        autoPlay:true //自动播放
    });
         
       
       
    });
     function closezz(){
                   setCookie('zomzc','yes',1);
                  $("#new-user").hide();
                  $("#dialog-overlay").hide();  
            }
</script>
<?php }?>  
<div class="clear">
</div>

<!-- HomeFocusLayout Begin-->
<div class="home-focus-layout"> 
<?php echo $output['web_html']['index_pic']; ?>
</div>
<div class="left-slide">
<div class="title"> <a class="wwisp" href="javascript:void(0)"  title="猜您喜欢">猜您喜欢<i></i></a></div>
<ul class="links">
<?php if (is_array($output['rc_list']) && !empty($output['rc_list'])) { $i = 0 ?> 
<?php foreach ($output['rc_list'] as $v) { $i++ ?>
<li><a href="<?php
        echo $v['value'] ?>" target="_blank" <?php
        echo $v['is_blod'] == 1 ? 'class="on"' : '' ?>><?php
        echo $v['name'] ?></a></li>
<?php }} ?>
</ul>
</div>
</div>
<div class="main-r">
<!-- <div class="mainR_inr">
<div class="topTtl">公告</div>
<ul class="clearfix noticeList"> 
<?php if (!empty($output['show_article']['notice']['list']) && is_array($output['show_article']['notice']['list'])) { ?> 
<?php foreach ($output['show_article']['notice']['list'] as $val) { ?>
<li>
    <a rel="nofollow" href="<?php   echo empty($val['article_url']) ? urlMember('article', 'show', array('article_id' => $val['article_id'])) : $val['article_url']; ?>" target="_blank">【公告】<?php echo $val['article_title']; ?></a>
</li>
<?php  }} ?>
</ul>
 <div class="topTtl">服务特色</div>
    <ul class="featuresList clearfix">
        <li><a rel="nofollow" href="<?php echo urlShop('show_joinin', 'index'); ?>" target="_self"><i class="i_ico01"></i>招商入驻</a></li>
        <li><a rel="nofollow" href="<?php echo urlShop('seller_login', 'show_login'); ?>" target="_self"><i class="i_ico02"></i>商家管理</a></li>
        <li><a rel="nofollow" href="<?php echo urlshop('special', 'special_detail', array('special_id' => '1')); ?>" target="_self"><i class="i_ico03"></i>消费保障</a></li>
        <li><a rel="nofollow" href="<?php echo urlShop('invite', 'index'); ?>" target="_self"><i class="i_ico04"></i>推广返利</a></li>
        <li><a rel="nofollow" href="<?php echo DELIVERY_SITE_URL; ?>" target="_self"><i class="i_ico05"></i>物流自提</a></li>
        <li><a rel="nofollow" href="<?php echo WAP_SITE_URL; ?>" target="_self"><i class="i_ico06"></i>手机专享</a></li>
    </ul>
</div>
 --></div>
</div>
</div>
<!--HomeFocusLayout End--><!--切换栏组合 stat-->
<div class="wrapper">
<div class="home-sale-suiji"><?php
echo $output['web_html']['index_sale']; ?></div>
<article class="m-brands" id="j-brands">
<h2 class="w-tit1 w-tit1-1"><span class="big">热门品牌</span> / BRAND</h2>
<ul class="clearfix"> 
<?php if (!empty($output['brand_r'])) { ?>
<?php foreach ($output['brand_r'] as $key => $brand_r) { ?>
<li class="itm1">
<a class="pic" href="<?php echo urlShop('brand', 'list', array('brand' => $brand_r['brand_id'])); ?>"  target="_blank" title="<?php echo $brand_r['brand_name']; ?>">
<div class="imgs">
<img class="brandbg img-lazyload" lm-url="<?php echo brandbigImage($brand_r['brand_bigpic']); ?>"  rel='lazy' src="<?php echo SHOP_TEMPLATES_URL; ?>/images/img/loading.gif"  alt="<?php echo $brand_r['brand_name']; ?>" title="<?php echo $brand_r['brand_name']; ?>" width="239px" height="239px">
<img class="logo opacity1" lm-url="<?php echo brandImage($brand_r['brand_pic']); ?>"  rel='lazy' src="<?php echo SHOP_TEMPLATES_URL; ?>/images/img/loading.gif" alt="<?php echo $brand_r['brand_name']; ?>" title="<?php echo $brand_r['brand_name']; ?>">
</div>
<div class="txt">
    <h3 class="tit"><?php echo $brand_r['brand_name']; ?></h3>
    <p class="desc s-fc2"><?php echo $brand_r['brand_introduction']; ?></p>
</div>
</a>
</li>
<?php }} ?>
<li class="itm5">
<a class="pic" href="<?php echo urlshop('brand'); ?>" target="_blank" title="大牌街">
    <img class="img-lazyload" lm-url="<?php echo SHOP_TEMPLATES_URL; ?>/images/img/brand-in.jpg"  rel='lazy' src="<?php echo SHOP_TEMPLATES_URL; ?>/images/img/loading.gif"  alt="大牌街" title="大牌街" width="237px" height="360px">
</a>
</li>
</ul>
</article>
<!--切换栏组合 end-->
<div class="mt10"><?php
echo loadadv(38, 'html'); ?> </div>
<!--StandardLayout Begin--> 
<?php
echo $output['web_html']['index']; ?> 
<!--StandardLayout End-->
<div class="mt10"><?php
echo loadadv(9, 'html'); ?></div></div>
<div class="wwi-main-footr">
<div class="wrapper">
<div class="sale_lum clearfix">
<div class="m" id="sale_cx">
<div class="mt">
<div class="title-line"></div>
<h2><span>特卖TeMai</span></h2>
</div>
<div class="sale_cx">
<?php
if (!empty($output['group_list']) && is_array($output['group_list'])) { ?>
<div class="groupbuy">
<ul>
<?php foreach ($output['group_list'] as $val) { ?>
<li>
<dl style=" background-image:url(<?php echo gthumb($val['groupbuy_image1'], 'small'); ?>)">
<dt><?php echo $val['groupbuy_name']; ?></dt>
<dd class="price">
<span class="groupbuy-price"><?php echo ncPriceFormatForList($val['groupbuy_price']); ?></span>
<span class="buy-button"><a href="<?php echo urlShop('show_groupbuy', 'groupbuy_detail', array( 'group_id' => $val['groupbuy_id'])); ?>">立即抢</a></span>
</dd>
<dd class="time">
<span class="sell">已售<em><?php echo $val['buy_quantity'] + $val['virtual_quantity']; ?></em></span> 
<span class="time-remain" count_down="<?php echo $val['end_time'] - TIMESTAMP; ?>"> 
<em time_id="d">0</em><?php echo $lang['text_tian']; ?>
<em time_id="h">0</em><?php echo $lang['text_hour']; ?> 
<em time_id="m">0</em><?php echo $lang['text_minute']; ?>
<em time_id="s">0</em><?php echo $lang['text_second']; ?> 
</span>
</dd>
</dl>
</li>
<?php } ?>
</ul>
</div>
<?php } ?>
</div>
</div>
<div class="m" id="sale_xs">
<div class="mt">
<div class="title-line"></div>
<h2><span>疯抢FengQiang</span></h2>
</div>
<div class="sale_xs">
<div class="home-sale-layout">
<div class="left-sidebar">
<?php echo loadadv(123);?>
<?php echo loadadv(124);?>
</div>
    <?php if (!empty($output['xianshi_item']) && is_array($output['xianshi_item'])) { ?> 
    <div class="right-sidebar"><div id="saleDiscount" class="sale-discount"> 
    <ul>
    <?php  foreach ($output['xianshi_item'] as $val) { ?>
        <li>
            <dl>
                    <dt class="goods-name">
                        <?php  echo $val['goods_name']; ?>
                    </dt>
                    <dd class="goods-thumb">
                    <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $val['goods_id'])); ?>"> 
                        <img lm-url="<?php  echo thumb($val, 240); ?>"   rel='lazy' src="<?php echo SHOP_TEMPLATES_URL; ?>/images/img/loading.gif">
                    </a>
                    </dd>
                    <dd class="goods-price"><?php echo ncPriceFormatForList($val['xianshi_price']);?> 
                        <span class="original"><?php echo ncPriceFormatForList($val['goods_price']); ?></span>
                    </dd>
                    <dd class="goods-price-discount"><em><?php echo $val['xianshi_discount']; ?></em></dd>
                    <dd class="time-remain" count_down="<?php echo $val['end_time'] - TIMESTAMP; ?>"><i></i>
                        <em time_id="d">0</em><?php echo $lang['text_tian']; ?>
                        <em time_id="h">0</em><?php echo $lang['text_hour']; ?> 
                        <em time_id="m">0</em><?php echo $lang['text_minute']; ?>
                        <em time_id="s">0</em><?php echo $lang['text_second']; ?> 
                    </dd> 
                <dd class="goods-buy-btn"></dd>
            </dl>
        </li>
    <?php } ?>
    </ul> 
    </div>
    </div>
    <?php } ?>
    </div>
  </div>
</div>
    <div class="m" id="share">
        <div class="mt">
            <div class="title-line"></div>
                <h2><span>晒单ShaiDan</span></h2>
        </div>
        <div class="share" id="sl">
        <ul class="show_share"><?php if (!empty($output['goods_evaluate_info']) && is_array($output['goods_evaluate_info'])) { ?>
        <?php foreach ($output['goods_evaluate_info'] as $k => $v) { ?>
        <li>
        <div class="p-img">
            <a href="<?php echo urlShop('goods', 'comments_list', array('goods_id' => $v['geval_goodsid'])); ?>" target="_blank">
                <img src="<?php echo strpos($v['goods_pic'], 'http') === 0 ? $v['goods_pic'] : UPLOAD_SITE_URL . "/" . ATTACH_GOODS . "/" . $v['geval_storeid'] . "/" . $v['geval_goodsimage']; ?>" alt="<?php echo $v['geval_goodsname']; ?>" width="100" height="100">
            </a>
        </div>
        <div class="p-info">
            <div class="author-info">
                <img title="<?php echo str_cut($v['geval_frommembername'], 2) . '***'; ?>"  lm-url="<?php echo getMemberAvatarForID($v['geval_frommemberid']); ?>"   rel='lazy' src="<?php echo SHOP_TEMPLATES_URL; ?>/images/img/loading.gif" alt="<?php echo str_cut($v['geval_frommembername'], 2) . '***'; ?>" width="28" height="28">
                <span><?php echo str_cut($v['geval_frommembername'], 2) . '***'; ?></span>
        </div>
        <div class="p-detail">
        <a target="_blank" title="<?php echo $v['geval_content']; ?>" href="<?php echo urlShop('goods', 'comments_list', array('goods_id' => $v['geval_goodsid'])); ?>">
        <?php echo $v['geval_content']; ?>
        <span class="icon-r">”</span>
        </a>
        <span class="icon-l">“</span>
        </div>
        </div>
        </li>
        <?php }} ?>
        </ul>
<script type = "text/javascript" > $(document).ready(function() {
    function statusRunner() {
        setTimeout(function() {
            var sl = $('#sl li'),
            f = $('#sl li:last');
            f.hide().insertBefore(sl.eq(0)).css('opacity', '0.1');
            f.slideDown(500,
            function() {
                f.animate({
                    opacity: 1
                });
            });
            statusRunner();
        },
        7000);
    }
    statusRunner();
});
$(".home-standard-layout .left-sidebar .title a ").hover(function() {
    $(".home-standard-layout .tabs-nav").addClass("wwi-hover");
});
$(".home-standard-layout .tabs-nav .close").click(function() {
    $(".home-standard-layout .tabs-nav").removeClass("wwi-hover");
}); 
</script>
</div>
</div>
</div>
</div>
</div>
<div id="nav_box" style="display: none;">
<ul>
<div class="m-logo"></div>
<?php if (is_array($output['lc_list']) && !empty($output['lc_list'])) {$i = 0 ?> 
    <?php foreach ($output['lc_list'] as $v) {
        $i++ ?>
        <li class="nav_Sd_ <?php echo $i; ?> <?php if ($i == 1) echo 'hover' ?>"> <a class="word" href="javascript:;">
        <em class="em"><?php echo $v['value'] ?></em>
        <?php echo $v['name'] ?></a></li>
        <?php }} ?>
</ul>
</div>
</div>
