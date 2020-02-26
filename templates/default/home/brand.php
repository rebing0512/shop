<?php
defined('TTShop') or die('Access Invalid!');
?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/ht-brand.css" rel="stylesheet" type="text/css">
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/masonry-docs.min.js"></script>
<div class="body" style="background:#0f0d1a url(<?php echo SHOP_TEMPLATES_URL;?>/images/ht-brand.jpg) no-repeat center top;">
<header id="recomHeader" class="m-header m-recomHeader"><h3>今日主打</h3></header>
<?php if (!empty($output['brand_r'])) {$i = 0;?>
<article class="m-recomBrand"><section class="rowOfFour clearfix">
<?php foreach ($output['brand_r'] as $key => $brand_r) {$i++;$i < 5;if ($i < 5) {?>
<div class="brandWrap clearfix">


<a class="brandImgLink f-fl" href="<?php echo urlShop('brand', 'list', array('brand' => $brand_r['brand_id']));?>" target="_blank">

<img class="brandImg img-lazyload"  lazy-url="<?php echo brandbigImage($brand_r['brand_bigpic']);?>"  rel='lazy' src="<?php echo brandbigImage($brand_r['brand_bigpic']);?>"  title="<?php echo $brand_r['brand_name'];?>" alt="<?php echo $brand_r['brand_name'];?>">


</a>  

    
<a class="brandDesc f-fl" href="<?php echo urlShop('brand', 'list', array('brand' => $brand_r['brand_id']));?>" target="_blank" style="top: 0px;">

<img class="brandLogo"  lazy-url="<?php echo brandImage($brand_r['brand_pic']);?>"  rel='lazy' src="<?php echo brandImage($brand_r['brand_pic']);?>"  title="<?php echo $brand_r['brand_name'];?>" alt="<?php echo $brand_r['brand_name'];?>" >



<p class="brandName" title="<?php echo $brand_r['brand_name'];?>"><?php echo $brand_r['brand_name'];?></p>
<p class="brandBenefit" title="<?php echo str_cut($brand_r['brand_introduction'],36);?>"><?php echo str_cut($brand_r['brand_introduction'],36);?></p>
<span class="brandBtn">进入品牌</span></a></div>
<?php }}?>
</section>
</article>
<?php }?>
<header id="streetHeader" class="m-header m-streetHeader"><h3>品牌逛不停</h3></header><nav id="staticnav" class="m-bsnav f-cb"><a class="tab <?php 
echo intval($_GET['gc_id']) <= 0 ? 'act' : '';
?>
" href="<?php 
echo urlShop('brand', 'index');
?>
" style="width:116.6px;"><span>全部</span></a><?php 
foreach ($output['goods_class'] as $k => $v) {
    ?>
<b class="sp">/</b>
<a class="tab <?php echo intval($_GET['gc_id']) == $v['gc_id'] ? 'act' : '';?>" href="<?php echo urlShop('brand', 'index', array('gc_id' => $v['gc_id']));?>
" style="width:116.6px;">
<span><?php echo $v['gc_name']; ?></span></a>
<?php }?>
</nav>
<article id="brandstreet" class="m-recomBrand m-brandStreet">
<section class="rowOfFour clearfix"><?php require BASE_TPL_PATH . '/home/brand.item.php';?>
</section>
</article>
</div>
<script>
$(".brandWrap").hover(function() {
    $(this).find(".brandDesc").animate({
        top: "-50px"
    },
    400, "swing")
},
function() {
    $(this).find(".brandDesc").stop(!0, !1).animate({
        top: "0px"
    },
    400, "swing")
});
$(function() {
    var a = $("#brandstreet");
    a.imagesLoaded(function() {
        a.masonry({
            itemSelector: "#box",
            gutter: 14,
            isAnimated: !0
        })
    })
});
</script>
</div>
<script language="javascript">
function fade() {
  $("img[rel='lazy']").each(function () {
    var $scroTop = $(this).offset();
    if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {
      $(this).hide();
      $(this).attr("src", $(this).attr("lazy-url"));
      $(this).removeAttr("rel");
      $(this).removeAttr("name");
      $(this).fadeIn(500);
    }
  });
}

if($("img[rel='lazy']").length > 0) {
  $(window).scroll(function () {
    fade();
  });
};
fade();
</script>   