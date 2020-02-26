<?php
defined('TTShop') or exit('Access Invalid!'); ?>
<link href="<?php echo SHOP_TEMPLATES_URL; ?>/css/cms_index.css" rel="stylesheet" type="text/css">

<!-- 轮播图 -->
	<div class="gcjs_slide">
		<?php echo loadadv(125);?>
	</div>

<!-- 轮播图 -->

<!-- 新闻中心 -->
	<div class="gcjs_news_box">
		<h2><a href="<?php echo urlShop('cms_index','list',array('catid'=>13));?>" target="_blank" >更多&gt;&gt;</a></h2>
		<div class="gcjs_news_box_big">
			<div class="gcjs_news_slide">
				<?php echo loadadv(142);?>
			</div>
			<div class="gcjs_news_tuijian">
					 <?php if(is_array($output['news_top_three']) and !empty($output['news_top_three'])){ $i=0;?>
                      <?php foreach ($output['news_top_three'] as $kt=>$vt){$i++;?>
                      		<dl>
								<a  target="_blank" href="<?php if($vt['url']!='')echo $vt['url'];else echo urlShop('cms_index', 'details', array('id'=>$vt['id'],'catid'=>$vt['catid']));?> ">
								<dt><i class="tuijian_<?php echo $i;?>"></i><?php echo str_cut($vt['title'],46,'...')?></dt>
								<dd><?php echo str_cut($vt['description'],110,'...')?><span>[详情]</span></dd>
								</a>
							</dl>                
                      <?php }?>
                      <?php }?>
			</div>
			<div class="gcjs_news_list">
			<?php if(is_array($output['news_right_three']) and !empty($output['news_right_three'])){ $ir=0;?>
			 <?php foreach ($output['news_right_three'] as $krt=>$vrt){$ir++;?>
				<div class="gcjs_nl_box <?php if($ir==1){?>cjs_nl_box1<?php }?>">
				 
                  
					<a  target="_blank" href="<?php if($vrt['url']!='')echo $vrt['url'];else echo urlShop('cms_index', 'details', array('id'=>$vrt['id'],'catid'=>$vrt['catid']));?> ">
						<div class="gcjs_nl_box_left"><img src="<?php echo $vrt['sthumb']?>"></div>
						<div class="gcjs_nl_box_right">
							<h3><?php echo str_cut($vrt['title'],26,'...')?></h3>
							<p><?php echo str_cut($vrt['description'],46,'...')?><span>[更多]</span></p>
						</div>
					</a>             
                   
                    
				</div>
				 <?php }?>
				  <?php }?>
			
			</div>
		</div>
	</div>
<!-- 新闻中心 -->

<!-- 招标信息 -->
	<div class="gcjs_zb_box">
		<h2><a href="<?php echo urlShop('cms_index','list',array('catid'=>18));?>" target="_blank" >更多&gt;&gt;</a></h2>
		<div class="gcjs_zb_box_big">
			<div class="gcjs_zb_box_big_left">
				<div class="gcjs_zb_top">
					<a  target="_blank" href="<?php if($output['zbnews_left_five'][0]['url']!='')echo $output['zbnews_left_five'][0]['url'];else echo urlShop('cms_index', 'details', array('id'=>$output['zbnews_left_five'][0]['id'],'catid'=>$output['zbnews_left_five'][0]['catid']));?> ">
						<div class="gcjs_zb_top_img">
							<img src="<?php echo $output['zbnews_left_five'][0]['sthumb'];?>">
						</div>
						<div class="gcjs_zb_top_news">
							<h3><?php echo str_cut($output['zbnews_left_five'][0]['title'],26,'...')?></h3>
							<p><?php echo str_cut($output['zbnews_left_five'][0]['description'],226,'...')?></p>
						</div>
					</a>
				</div>
				<div class="gcjs_zb_bottom">
				 <?php if(is_array($output['zbnews_left_five']) and !empty($output['zbnews_left_five'])){ $if=0;?>
                  <?php foreach ($output['zbnews_left_five'] as $kf=>$vf){$if++;?>
                  <?php if($if >1){?>
					<div class="gcjs_zb_list  <?php if($if==2 || $if ==4){?>gcjs_zb_list1<?php }?> ">
					<a  target="_blank" href="<?php if($vf['url']!='')echo $vf['url'];else echo urlShop('cms_index', 'details', array('id'=>$vf['id'],'catid'=>$vf['catid']));?> ">
						<div class="gcjs_zb_list_left"><img src="<?php echo $vf['sthumb'];?>"></div>
						<div class="gcjs_zb_list_right">
							<h3><?php echo str_cut($vf['title'],36,'...')?></h3>
							<p><?php echo str_cut($vf['description'],60,'...')?><span>[更多]</span></p>
						</div>
					</a>
					</div>
				  <?php }?>
				 <?php }?>
                <?php }?>
				</div>
			</div>
			<div class="gcjs_zb_box_big_right">
				<div class="gcjs_zb_box_big_right_img"><?php echo loadadv(129);?></div>
				<ul>
				 <?php if(is_array($output['zbnews_right_list']) and !empty($output['zbnews_right_list'])){?>
                      <?php foreach ($output['zbnews_right_list'] as $kz=>$zt){?>
                      			<li>
								<i></i>								
								<a  target="_blank" href="<?php if($zt['url']!='')echo $zt['url'];else echo urlShop('cms_index', 'details', array('catid'=>$zt['catid'],'id'=>$zt['id']));?> ">
								<?php echo str_cut($zt['title'],40,'...')?></a>
								</li>              
                      <?php }?>
                      <?php }?>
				
				</ul>
			</div>
		</div>
	</div>
<!-- 招标信息 -->
<div class="banner_box"><?php echo loadadv(130);?></div>

<!-- 供应求购 -->
	<div class="gcjs_gyqg_box">
		<h2><a href="<?php echo urlShop('cms_index','list',array('catid'=>23));?>" target="_blank">更多&gt;&gt;</a></h2>
		<div class="gajs_gyqg_box_big">
			<div class="gyqg_box_one">

			 <?php if(is_array($output['gyqg_left']) and !empty($output['gyqg_left'])){ $ig=0;?>
                  <?php foreach ($output['gyqg_left'] as $kg=>$vg){$ig++;?>
                  <?php if($ig <3){?>
					<div class="gyqg_box_one_box  <?php if($ig==1){?>gyqg_box_one_box1<?php }?>">
					<a  target="_blank" href="<?php if($vg['url']!='')echo $vg['url'];else echo urlShop('cms_index', 'details', array('id'=>$vg['id'],'catid'=>$vg['catid']));?> ">
						<div class="gyqg_box_one_left"><img src="<?php echo $vg['sthumb'];?>"></div>
						<div class="gyqg_box_one_right">
							<h3><?php echo str_cut($vg['title'],26,'...')?></h3>
							<p><?php echo str_cut($vg['description'],40,'...')?><span>[更多]</span></p>
						</div>
					</a>
					</div>
				  <?php }?>
				 <?php }?>
                <?php }?>

				
				
				<ul>
				 <?php if(is_array($output['gyqg_left']) and !empty($output['gyqg_left'])){ $ig=0;?>
                  <?php foreach ($output['gyqg_left'] as $kg=>$vg){$ig++;?>
                  <?php if($ig >2 && $ig < 9){?>
					<li><i></i><a  target="_blank" href="<?php if($vg['url']!='')echo $vg['url'];else echo urlShop('cms_index', 'details', array('id'=>$vg['id'],'catid'=>$vg['catid']));?> "><?php echo str_cut($vg['title'],38,'...')?></a></li>
				  <?php }?>
				 <?php }?>
                <?php }?>

				</ul>
			</div>
			<div class="gyqg_box_two">
				<div class="gyqg_box_two_img"><?php echo loadadv(131);?></div>
				<ul>
				<?php if(is_array($output['gyqg_left']) and !empty($output['gyqg_left'])){ $ig=0;?>
                  <?php foreach ($output['gyqg_left'] as $kg=>$vg){$ig++;?>
                  <?php if($ig >8){?>
					<li><i></i><a  target="_blank" href="<?php if($vg['url']!='')echo $vg['url'];else echo urlShop('cms_index', 'details', array('id'=>$vg['id'],'catid'=>$vg['catid']));?> "><?php echo str_cut($vg['title'],38,'...')?></a><span><?php echo date('Y-m-d',$vg['inputtime']); ?></span></li>
				  <?php }?>
				 <?php }?>
                <?php }?>



				</ul>
			</div>
			<div class="gyqg_box_three"><?php echo loadadv(143);?></div>
		</div>
	</div>


<!-- 供应求购 -->


<!-- 企业名录 -->
	<div class="gcjs_qyml">
		<h2><a href="<?php echo urlShop('cms_index','list',array('catid'=>24));?>" target="_blank">更多&gt;&gt;</a></h2>
		<div class="qyml_left">
		<div class="index_rank_img">
            <div class="index_rank_img_1"><a href="#" target="_blank" rel="nofollow" ><img src="http://pic.to8to.com/hot/510_5622.jpg?1447043378" alt="华浔"></a></div>
            <div style="left: 192px;" class="index_rank_img_2"><a href="#" target="_blank" rel="nofollow" ><img src="http://pic.to8to.com/hot/510_5623.jpg?1464920323" alt="乐峰"></a></div>
            <div style="left: 384px;" class="index_rank_img_3"><a href="#" target="_blank" rel="nofollow"><img src="http://pic.to8to.com/hot/510_5624.jpg?1447037482" alt="业之峰"></a></div>
        </div>
        <div class="qyml_box qyml_box1">
        	<h3><a href="<?php echo urlShop('cms_index','list',array('catid'=>32));?>">More</a></h3>
        	<a  target="_blank" href="<?php if($output['qyml_new']['url']!='')echo $output['qyml_new']['url'];else echo urlShop('cms_index', 'details', array('catid'=>$output['qyml_new']['catid'],'id'=>$output['qyml_new']['id']));?> ">
        	<div class="imgbox"><img src="<?php echo $output['qyml_new']['sthumb'];?>"></div>
        	<div class="infobox">
        		<i></i>
        		<div class="infobox_title"><?php echo str_cut($output['qyml_new']['title'],30,'...')?></div>
        		<div class="infobox_info"><?php echo str_cut($output['qyml_new']['description'],56,'...')?></div>
        	</div>
       		 </a>
        </div>
        <div class="qyml_box qyml_box2">
        	<h3><a href="<?php echo urlShop('cms_index','list',array('catid'=>33));?>">More</a></h3>
        	<a  target="_blank" href="<?php if($output['qyml_my']['url']!='')echo $output['qyml_my']['url'];else echo urlShop('cms_index', 'details', array('catid'=>$output['qyml_new']['catid'],'id'=>$output['qyml_new']['id']));?> ">
        	<div class="imgbox"><img src="<?php echo $output['qyml_my']['sthumb'];?>"></div>
        	<div class="infobox">
        		<i></i>
        		<div class="infobox_title"><?php echo str_cut($output['qyml_my']['title'],30,'...')?></div>
        		<div class="infobox_info"><?php echo str_cut($output['qyml_my']['description'],56,'...')?></div>
        	</div>
       		 </a>
        </div>
        </div>
        <div class="qyml_right">
        	<h3><a href="<?php echo urlShop('cms_index','list',array('catid'=>34));?>">More</a></h3>
	        	<div class="tjqy_box">
	        	
	        	<?php if(is_array($output['qyml_tj']) and !empty($output['qyml_tj'])){ ?>
                  <?php foreach ($output['qyml_tj'] as $kk=>$vv){?>
	        		<a  target="_blank" href="<?php if($vv['url']!='')echo $vv['url'];else echo urlShop('cms_index', 'details', array('id'=>$vv['id'],'catid'=>$vv['catid']));?> ">
	        			<img src="<?php echo $vv['sthumb'];?>">
	        			<div class="tjqy_box_info">
	        				<p class="tjqy_box_info_title"><?php echo str_cut($vv['title'],30,'...')?></p>
	        				<p>地址：<?php echo str_cut($vv['address'],20,'...')?></p>
	        			</div>
	        		</a>
	        	<?php }?>
                <?php }?>
	        	</div>
	        
        </div>
	</div>

<!-- 企业名录 -->

<div class="banner_box"><?php echo loadadv(133);?></div>

<!-- 工程设计 -->
	<div class="gcjs_gcsj">
		<h2><a href="<?php echo urlShop('cms_index','list',array('catid'=>25));?>" target="_blank">更多&gt;&gt;</a></h2>
		<div class="gcjs_box">
			<div class="gcjs_box_top">
				<div class="gcjs_box_top_boxone">
				<?php if(is_array($output['gcsj_list']) and !empty($output['gcsj_list'])){ $igs=0;?>
                  <?php foreach ($output['gcsj_list'] as $kgs=>$vgs){$igs++;?>
                  <?php if($igs <4){?>
					<div class="top_boxone_list <?php if($igs==1){?>top_boxone_list_1<?php }?>">
					 <a  target="_blank" href="<?php if($vgs['url']!='')echo $vgs['url'];else echo urlShop('cms_index', 'details', array('id'=>$vgs['id'],'catid'=>$vgs['catid']));?> ">
						<img src="<?php echo $vgs['sthumb'];?>">
						<div class="top_boxone_list_info">
	        				<p class="top_boxone_list_title"><?php echo str_cut($vgs['title'],30,'...')?></p>
	        				<p class="top_boxone_list_p"><?php echo str_cut($vgs['description'],50,'...')?></p>
	        			</div>
	        		 </a>
					</div>
					
				  <?php }?>
				 <?php }?>
                <?php }?>
					
					
				</div>
				<div class="gcjs_box_top_boxtwo"><?php echo loadadv(144);?></div>
				<div class="gcjs_box_top_boxthree">
					
				<?php if(is_array($output['gcsj_list']) and !empty($output['gcsj_list'])){ $igs=0;?>
                  <?php foreach ($output['gcsj_list'] as $kgs=>$vgs){$igs++;?>
                  <?php if($igs >3){?>
					<div class="top_boxone_list <?php if($igs==4){?>top_boxone_list_1<?php }?>">
					 <a  target="_blank" href="<?php if($vgs['url']!='')echo $vgs['url'];else echo urlShop('cms_index', 'details', array('id'=>$vgs['id'],'catid'=>$vgs['catid']));?> ">
						<img src="<?php echo $vgs['sthumb'];?>">
						<div class="top_boxone_list_info">
	        				<p class="top_boxone_list_title"><?php echo str_cut($vgs['title'],30,'...')?></p>
	        				<p class="top_boxone_list_p"><?php echo str_cut($vgs['description'],50,'...')?></p>
	        			</div>
	        		 </a>
					</div>
					
				  <?php }?>
				 <?php }?>
                <?php }?>
			
				</div>
			</div>
			<div class="gcjs_box_bottom">
				<div class="gcjs_box_ajzs_title"></div>
				<?php if(is_array($output['anli_list']) and !empty($output['gcsj_list'])){ ?>
                <?php foreach ($output['anli_list'] as $kn=>$vn){?>
				<div class="gcjs_box_list">
				<a  target="_blank" href="<?php if($vn['url']!='')echo $vn['url'];else echo urlShop('cms_index', 'details', array('id'=>$vn['id'],'catid'=>$vn['catid']));?> " title="<?php echo str_cut($vn['title'],30,'...')?>">
					<div class="gcjs_box_img"><img src="<?php echo $vn['thumb'];?>" title="<?php echo str_cut($vn['title'],30,'...')?>"></div>
				</a>
				</div>
				  <?php }?>	 
                <?php }?>
		
			</div>
		</div>
	</div>
<!-- 工程设计 -->

<!-- 工程案例 -->
<div class="gcjs_gcal_box">
	<div class="gcjs_gcal">
		<h2><a href="<?php echo urlShop('cms_index','list',array('catid'=>27));?>" target="_blank"></a></h2>
		<ul>

		 <?php if(is_array($output['gcal_list']) and !empty($output['gcal_list'])){ $ib=0; ?>
          <?php foreach ($output['gcal_list'] as $kb=>$vb){$ib++;?>
			<li <?php if($ib==1){?>class="first" <?php }?>>
				<a  target="_blank" href="<?php if($vb['url']!='')echo $vb['url'];else echo urlShop('cms_index', 'details', array('id'=>$vb['id'],'catid'=>$vb['catid']));?> " title="<?php echo str_cut($vb['title'],30,'...')?>">
					<img src="<?php echo $vb['thumb'];?>" title="<?php echo str_cut($vb['title'],30,'...')?>">
					<div class="lititle"><?php echo str_cut($vb['title'],30,'...')?></div>
					<div class="liinfo"><?php echo str_cut($vb['description'],90,'...')?></div>
					<div class="libtn">立即查看</div>
				</a>
			</li>
			 <?php }?>	 
             <?php }?>
			
		</ul>
		<div class="clear"></div>
		<div class="fl_box first"><a href=""><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/cms/gc_44.png"></a></div>
		<div class="fl_box"><a href=""><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/cms/gc_46.png"></a></div>
		<div class="fl_box"><a href=""><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/cms/gc_48.png"></a></div>
		<div class="fl_box"><a href=""><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/cms/gc_50.png"></a></div>
	</div>
</div>
<!-- 工程案例 -->
<div class="banner_box" style="margin-bottom:40px;"><?php echo loadadv(135);?></div>

<!-- 求职招聘 -->
<div class="gcjs_qzzp">
	<h2><a href="<?php echo urlShop('cms_index','list',array('catid'=>27));?>" target="_blank">更多&gt;&gt;</a></h2>
	<div class="qz_box">
		<div class="qz_box_bg"></div>
	  <?php if(is_array($output['zxzp_list']) and !empty($output['zxzp_list'])){ ?>
      <?php foreach ($output['zxzp_list'] as $kz=>$vz){?>
		<div class="qz_box_list">
		<a  target="_blank" href="<?php if($vz['url']!='')echo $vz['url'];else echo urlShop('cms_index', 'details', array('id'=>$vz['id'],'catid'=>$vz['catid']));?> " title="<?php echo str_cut($vz['title'],30,'...')?>">
			<img src="<?php echo $vz['thumb'];?>" title="<?php echo str_cut($vz['title'],30,'...')?>">
			<div class="qz_box_title"><?php echo str_cut($vz['title'],30,'...')?></div>
		</a>
		</div>
		<?php }?>	 
       <?php }?>
		
	</div>
	<div class="qz_box qz_box_two">
		<div class="qz_box_bg_two"></div>
		<div class="qz_box_list_box">
	
			<div class="qz_box_list_news">
				<a  target="_blank" href="<?php if($output['qzzp_list'][0]['url']!='')echo $output['qzzp_list'][0]['url'];else echo urlShop('cms_index', 'details', array('id'=>$output['qzzp_list'][0]['id'],'catid'=>$output['qzzp_list'][0]['catid']));?> " title="<?php echo str_cut($output['qzzp_list'][0]['title'],30,'...')?>">
					<img src="<?php echo $output['qzzp_list'][0]['sthumb'];?>" title="<?php echo str_cut($output['qzzp_list'][0]['title'],30,'...')?>">
				</a>
				<ul>
				  <?php if(is_array($output['qzzp_list']) and !empty($output['qzzp_list'])){$ip=0; ?>
			      <?php foreach ($output['qzzp_list'] as $kp=>$vp){$ip++;?>
			      <?php if($ip <5){?>
								<li>
									<a  target="_blank" href="<?php if($vp['url']!='')echo $vp['url'];else echo urlShop('cms_index', 'details', array('id'=>$vp['id'],'catid'=>$vp['catid']));?> " title="<?php echo str_cut($vp['title'],30,'...')?>">
									<i></i><?php echo str_cut($vp['title'],30,'...')?></a>
								</li>
					  <?php }?>	
					<?php }?>	 
			       <?php }?>

				</ul>
			</div>
			<div class="qz_box_list_news">
				<a  target="_blank" href="<?php if($output['qzzp_list'][4]['url']!='')echo $output['qzzp_list'][4]['url'];else echo urlShop('cms_index', 'details', array('id'=>$output['qzzp_list'][4]['id'],'catid'=>$output['qzzp_list'][0]['catid']));?> " title="<?php echo str_cut($output['qzzp_list'][4]['title'],30,'...')?>">
					<img src="<?php echo $output['qzzp_list'][4]['sthumb'];?>" title="<?php echo str_cut($output['qzzp_list'][4]['title'],30,'...')?>">
				</a>
				<ul>
				  <?php if(is_array($output['qzzp_list']) and !empty($output['qzzp_list'])){$ip=0; ?>
			      <?php foreach ($output['qzzp_list'] as $kp=>$vp){$ip++;?>
			      <?php if($ip >4 && $ip <9){?>
								<li>
									<a  target="_blank" href="<?php if($vp['url']!='')echo $vp['url'];else echo urlShop('cms_index', 'details', array('id'=>$vp['id'],'catid'=>$vp['catid']));?> " title="<?php echo str_cut($vp['title'],30,'...')?>">
									<i></i><?php echo str_cut($vp['title'],30,'...')?></a>
								</li>
					  <?php }?>	
					<?php }?>	 
			       <?php }?>
			</div>
			<div class="qz_box_list_news">
				<a  target="_blank" href="<?php if($output['qzzp_list'][8]['url']!='')echo $output['qzzp_list'][8]['url'];else echo urlShop('cms_index', 'details', array('id'=>$output['qzzp_list'][8]['id'],'catid'=>$output['qzzp_list'][8]['catid']));?> " title="<?php echo str_cut($output['qzzp_list'][8]['title'],30,'...')?>">
					<img src="<?php echo $output['qzzp_list'][8]['sthumb'];?>" title="<?php echo str_cut($output['qzzp_list'][8]['title'],30,'...')?>">
				</a>
				<ul>
				  <?php if(is_array($output['qzzp_list']) and !empty($output['qzzp_list'])){$ip=0; ?>
			      <?php foreach ($output['qzzp_list'] as $kp=>$vp){$ip++;?>
			      <?php if($ip >8 ){?>
								<li>
									<a  target="_blank" href="<?php if($vp['url']!='')echo $vp['url'];else echo urlShop('cms_index', 'details', array('id'=>$vp['id'],'catid'=>$vp['catid']));?> " title="<?php echo str_cut($vp['title'],30,'...')?>">
									<i></i><?php echo str_cut($vp['title'],30,'...')?></a>
								</li>
					  <?php }?>	
					<?php }?>	 
			       <?php }?>
			</div>

		</div>
	</div>
</div>
<!-- 求职招聘 -->

<!-- 机械商城 -->
<div class="gcjs_jxsc">
	<h2><a href="<?php echo urlShop('mall');?> ">更多&gt;&gt;</a></h2>
	<div class="goods_box">
		<div class="goods_box_one"><?php echo loadadv(145);?></div>
		<div class="goods_box_one goods_box_two">
			<div class="goods_box_two_1"><?php echo loadadv(146);?></div>
			<div class="goods_box_two_2 goods_box_two_3"><?php echo loadadv(147);?></div>
			<div class="goods_box_two_2 "><?php echo loadadv(149);?></div>
		</div>
		<div class="goods_box_three"><?php echo loadadv(150);?></div>
	</div>
</div>
<!-- 机械商城 -->

<div class="banner_box" style="margin-bottom:40px;"><?php echo loadadv(141);?></div>
<script>
	$(function(){

		var srcPic,
		picPos;
		srcPic = 'bpic';
		picPos = [456, 648, 192, 384];
		$('.index_rank_img > div').mouseenter(function () {
		    var vLeftTwo = $('.index_rank_img_2').position().left,
		        vLeftThree = $('.index_rank_img_3').position().left;
		    if ($(this).hasClass('index_rank_img_1') && vLeftTwo != '' + picPos[0] + '') {
		        $('.index_rank_img_2').stop().animate({
		            left: picPos[0]
		        }, 500);
		        $('.index_rank_img_3').stop().animate({
		            left: picPos[1]
		        }, 500);
		    } else if ($(this).hasClass('index_rank_img_2') && vLeftTwo == '' + picPos[0] + '') {
		        $('.index_rank_img_2').stop().animate({
		            left: picPos[2]
		        }, 500);
		    } else if ($(this).hasClass('index_rank_img_2') && vLeftTwo == '' + picPos[2] + '' && vLeftThree == '' + picPos[3] + '') {
		        $('.index_rank_img_3').stop().animate({
		            left: picPos[1]
		        }, 500);
		    } else if ($(this).hasClass('index_rank_img_3') && (vLeftTwo >= '' + picPos[0] + '' || vLeftTwo >= '' + picPos[2] + '')) {
		        $('.index_rank_img_2').stop().animate({
		            left: picPos[2]
		        }, 500);
		        $('.index_rank_img_3').stop().animate({
		            left: picPos[3]
		        }, 500);
		    }
		    ;

		});
	})
</script>