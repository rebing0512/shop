<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">

<div class="menus">
		<div class="guide_nav">
		   <?php foreach ($output['sub_class_list'] as $k=>$v){?>
          <a href="<?php echo urlShop('article', 'article', array('ac_id'=>$v['ac_id']));?>"><?php echo $v['ac_name']?></a>
          <?php }?>
		
		
		</div>
</div>
<div class="news">
	<div class="news_left">
		<div class="news_left_first">
			<div class="news_left_one">
				<div class="left_one_title">
					<h1>商城公告</h1>
		</div>
				<ul>
				    <?php foreach ($output['topsix'] as $kv=>$vv){?>
					<li> <i>▪</i> <a <?php if($vv['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vv['article_url']!='')echo $vv['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vv['article_id']));?>" target="_blank"><?php echo str_cut($vv['article_title'],26)?></a><span><?php echo time_format($vv['article_time'],'Y-m-d')?></span></li>
					<?php } ?>
				</ul>
			</div>
			<div class="news_left_two">
				<?php echo loadadv(62);?>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="news_left_second">
			<div class="news_left_second_one">
				<ul>
				
				 <?php foreach ($output['helpshi'] as $kh=>$vh){?>
					<li> · <a <?php if($vh['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vh['article_url']!='')echo $vh['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vh['article_id']));?>" target="_blank"><?php echo str_cut($vh['article_title'],26)?></a></li>
				<?php } ?>
				</ul>
                <div style="clear:both;"></div>
				<div class="secong_img"><?php echo loadadv(63);?></div>
			</div>
			<div class="news_left_second_two">
				<div class="news_second_title">行业<i style="color:02a129;font-size:16px;">资讯</i></div>
				<div class="news_second_main">

					<div>
					<a <?php if($output['hynews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['hynews'][0]['article_url']!='')echo $output['hynews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['hynews'][0]['article_id']));?>" target="_blank">
					<img src="<?php if($output['hynews'][0]['thub']!=''){echo $output['hynews'][0]['thub']; }else{echo '/shop/templates/default/images/thub_none.jpg';}?>"/>
					</a>
					</div>
					<ul>
						<li><h2><a <?php if($output['hynews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['hynews'][0]['article_url']!='')echo $output['hynews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['hynews'][0]['article_id']));?>" target="_blank"><?php echo str_cut($output['hynews'][0]['article_title'],25);?></a></h2></li>
						<li><p><a <?php if($output['hynews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['hynews'][0]['article_url']!='')echo $output['hynews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['hynews'][0]['article_id']));?>" target="_blank"><?php echo str_cut($output['hynews'][0]['article_summary'],160);?>......</a></p></li>
					</ul>
				</div>
                <div style="clear:both;"></div>
				<div class="news_second_box">
					<ul>
					<?php if(is_array($output['hynews']) && !empty($output['hynews'])){?>  
					<?php $i=0;?>
					<?php foreach ($output['hynews'] as $ky=>$vy){$i++;?>
					<?php if($i > 1){?>
					    <li><i> · </i><a  <a <?php if($vy['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vy['article_url']!='')echo $vy['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vy['article_id']));?>" target="_blank"><?php echo str_cut($vy['article_title'],26)?></a></li>
					  <?php } ?>
					  <?php } ?>
					 <?php } ?>
					</ul>
				</div>
			</div>
		</div>
        <div style="clear:both;"></div>
		<div class="news_third">
			<div class="news_third_one">
				<div class="news_second_title" style="width:360px;">售后<i style="color:02a129;font-size:16px;">服务</i></div>
				<div class="third_one_adv"><?php echo loadadv(1074);?></div>
				<ul>
					<?php if(is_array($output['shnew']) && !empty($output['shnew'])){?>  
					  <?php $i=0;?>
						<?php foreach ($output['shnew'] as $kdt=>$vdt){$i++;?>
						<?php if($i > 1){?>
						    <li><i> · </i><a  <a <?php if($vdt['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vdt['article_url']!='')echo $vdt['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vdt['article_id']));?>" target="_blank"><?php echo str_cut($vdt['article_title'],22)?></a></li>
						  <?php } ?>
						  <?php } ?>
					  <?php } ?>
				</ul>
			</div>
			<div class="third_two">
				<div class="news_second_title">店主<i style="color:02a129;font-size:16px;">之家</i></div>
				<div class="news_second_main">
					<div>
						<a <?php if($output['dznews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['dznews'][0]['article_url']!='')echo $output['dznews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['dznews'][0]['article_id']));?>" target="_blank">
						<img src="<?php if($output['dznews'][0]['thub']!=''){echo $output['dznews'][0]['thub']; }else{echo '/shop/templates/default/images/thub_none.jpg';}?>"/>
						</a>
					</div>
					<ul>
						<li><h2>
							<a <?php if($output['dznews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['dznews'][0]['article_url']!='')echo $output['dznews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['dznews'][0]['article_id']));?>" target="_blank">
							<?php echo str_cut($output['dznews'][0]['article_title'],22);?>
							</a>
						</h2></li>

						<li><p><a <?php if($output['dznews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['dznews'][0]['article_url']!='')echo $output['dznews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['dznews'][0]['article_id']));?>" target="_blank"><?php echo str_cut($output['dznews'][0]['article_summary'],160);?>......</a></p></li>
				  </ul>
				</div>
                <div style="clear:both;"></div>
				<div class="news_second_box">
					<ul>
					<?php if(is_array($output['dznews']) && !empty($output['dznews'])){?>  
					  <?php $i=0;?>
						<?php foreach ($output['dznews'] as $kd=>$vd){$i++;?>
						<?php if($i > 1){?>
						    <li><i> · </i><a  <a <?php if($vd['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vd['article_url']!='')echo $vd['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vd['article_id']));?>" target="_blank"><?php echo str_cut($vd['article_title'],26)?></a></li>
						  <?php } ?>
						  <?php } ?>
					  <?php } ?>
					</ul>
				</div>
			</div>
		</div>

	</div>
	<div class="news_right">
        <div class="news_second_title" style="width:248px;">推荐<i style="color:02a129;font-size:16px;">产品</i></div>
        <div class="news_right_box">
         <?php foreach($output['tuijian'] as $keyt=>$valt){ ?>
            <div class="news_right_one">
            	<a href="<?php echo urlShop('goods','index',array('goods_id'=>$valt['goods_id']));?>" target="_blank" title="<?php echo $valt['goods_jingle'];?>">
                <div><img src="<?php echo thumb($valt, 80);?>" title="<?php echo $valt['goods_name'];?>" alt="<?php echo $valt['goods_name'];?>" /></div>

                <ul>
                    <li class="zhaiyao"><?php echo str_cut($valt['goods_name'],32);?></li>
                    <li class="right_price"><?php echo ncPriceFormatForList($valt['goods_price']);?></li>
                    <li class="right_ago_price"><?php echo ncPriceFormatForList($valt['goods_marketprice']);?></li>
                </ul>
               	</a>
            </div>
      	<?php } ?>
        </div>
	</div>
	<div class="news_right" style="margin-top:10px;">
        <div class="news_second_title" style="width:248px;">热销<i style="color:02a129;font-size:16px;">产品</i></div>
        <div class="news_right_box">
            <?php foreach($output['rexiao'] as $keyt=>$valrx){ ?>
            <div class="news_right_one">
            	<a href="<?php echo urlShop('goods','index',array('goods_id'=>$valrx['goods_id']));?>" target="_blank" title="<?php echo $valrx['goods_jingle'];?>">
                <div><img src="<?php echo thumb($valrx, 80);?>" title="<?php echo $valrx['goods_name'];?>" alt="<?php echo $valrx['goods_name'];?>" /></div>

                <ul>
                    <li class="zhaiyao"><?php echo str_cut($valrx['goods_name'],32);?></li>
                    <li class="right_price"><?php echo ncPriceFormatForList($valrx['goods_price']);?></li>
                    <li class="right_ago_price"><?php echo ncPriceFormatForList($valrx['goods_marketprice']);?></li>
                </ul>
               	</a>
            </div>
      	 <?php } ?>
        </div>
	</div>
</div>

<script>
	
$(function(){
	$(".h_lunbo_1").hide();                                  
	$(".h_lunbo_1").eq(0).show();

	var n=0;
	function changeImg(){
		if(n>1){
			n=0;
		}else{
			n=n+1;
		}
		$(".h_lunbo_1").hide();
		$(".h_lunbo_1").eq(n).show();

		$(".h_dian1 .h_d3").removeClass("h_d4");
		$(".h_dian1 .h_d3").eq(n).addClass("h_d4");;
	}
var timer = setInterval(changeImg,3000);
	$(".h_lunbo_1").hover(function(){
		clearInterval(timer);	
	},function(){
		timer = setInterval(changeImg,3000)
	})
	
	$(".h_dian1 .h_d3").hover(function(){
		$(".h_dian1 .h_d3").removeClass("h_d4")
		$(this).addClass("h_d4")	
		n = $(".h_dian1 .h_d3").index(this);
		$(".h_lunbo_1").hide();
		$(".h_lunbo_1").eq(n).show();
	})
})


</script>