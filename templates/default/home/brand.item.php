<?php defined('TTShop') or exit('Access Invalid!');?>

<?php foreach($output['brand_c'] as $key=>$brand_c){?> 
<?php if ($brand_c['image']){ $i=0;?>
<?php foreach($brand_c['image'] as $key=>$brand){$i++?> 
<?php
if ($i == 1) { ?>    <div class="clearfix brandWrap1" id="box"><img src="<?php
    echo SHOP_TEMPLATES_URL;?>/images/ht-brand-.png" class="img" alt="大牌街氛围图"></div><?php
} else if ($i == 2) { ?>   <div class="clearfix brandWrap1" id="box"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/ht-brands-.png" class="img" alt="大牌街氛围图"></div><?php
} ?>

<div class="brandWrap clearfix" id="box">


<a class="brandImgLink f-fl" href="<?php echo urlShop('brand', 'list', array('brand'=>$brand['brand_id']));?>" target="_blank">

<img class="brandImg img-lazyload"   rel='lazy' src="<?php echo brandbigImage($brand['brand_bigpic']);?>" title="<?php echo $brand['brand_name'];?>" alt="<?php echo $brand['brand_name'];?>">
</a>      
<a class="brandDesc f-fl" href="<?php echo urlShop('brand', 'list', array('brand'=>$brand['brand_id']));?>" target="_blank" style="top: 0px;"> 

<img class="brandLogo" lazy-url="<?php echo brandImage($brand['brand_pic']);?>"  rel='lazy' src="<?php echo brandImage($brand['brand_pic']);?>"  title="<?php echo $brand['brand_name'];?>" alt="<?php echo $brand['brand_name'];?>">
<p class="brandName" title="<?php echo $brand['brand_name'];?>"><?php echo $brand['brand_name'];?></p><p class="brandBenefit" title="<?php echo str_cut($brand['brand_introduction'],36);?>"><?php echo str_cut($brand['brand_introduction'],36);?></p><span class="brandBtn">进入品牌</span></a></div>
<?php } }?>
<?php if ($brand_c['text']){?> 
<div class="barnd-list-text"><strong>更多品牌：</strong> 
<?php foreach($brand_c['text'] as $key=>$brand){ ?>
	<a href="<?php echo urlShop('brand', 'list', array('brand'=>$brand['brand_id']));?>">
<?php echo $brand['brand_name'];?></a>
<?php } ?>
</div>
<?php } }?>