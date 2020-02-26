<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">

    <div class="main">
    <section class="essay_right">

        <h3 class="tit_red">导航<i></i></h3>

        <?php foreach ($output['cate_list'] as $k=>$v){?>
        <a class="list_zx" href="<?php echo urlShop('show_store', 'article_list', array('id'=>$v['id'],'store_id'=>$v['store_id']));?>" title="<?php echo $v['cate_name']?>">
       <?php echo $v['cate_name']?>
        </a>
        <?php }?>
      <div class="clear h10"></div>
       <h3 class="tit_red">最新推荐<!-- <a href="#" title="更多">更多</a> --><i></i></h3>
        <?php if(is_array($output['new_list']) and !empty($output['new_list'])){?>
          <?php foreach ($output['new_list'] as $k=>$v){?>
            <a class="recommend_a" target="_blank"  href="<?php  echo urlShop('show_store', 'article_detalis', array('store_id'=>$v['store_id'],'id'=>$v['id']));?>">
            <?php echo str_cut($v['s_title'],36,'......')?></a></li>
          <?php }?>
          <?php }else{?>
          <div><?php echo $lang['article_article_no_new_article'];?></div>
          <?php }?>

     <div class="clear h20"></div>
    <h3 class="tit">热卖商品<i></i></h3>
    <menu class="essay_pro">
    <?php if(is_array($output['tuijian']) and !empty($output['tuijian'])){?>
     <?php $i==0; foreach($output['tuijian'] as $keyt=>$valrx){ $i++;?>
      <a href="<?php echo urlShop('goods','index',array('goods_id'=>$valrx['goods_id']));?>" target="_blank" title="<?php echo $valrx['goods_jingle'];?>">
      <p>
      <img src="<?php echo thumb($valrx, 240);?>" title="<?php echo $valrx['goods_name'];?>" alt="<?php echo $valrx['goods_name'];?>"  height="106" width="106"/>
      </p>
      <span style="height: 40px;overflow: hidden;color: #000;"><?php echo str_cut($valrx['goods_name'],30);?></span>
      <span>￥<b class="decimal_format"><?php echo ncPriceFormatForListsmall($valrx['goods_price']);?></b></span>
      </a>
      <?php if($i%2==0){?>
      <i></i>
    <?php }}} ?>

      <div class="clear"></div>
    </menu>

  </section>
        <!--essay_right END-->
<div class="news-content left">
            <div class="clear"></div>
             <?php if(!empty($output['news_list']) and is_array($output['news_list'])){?>
            <div class="news-list">
                <h3 class="yahei"><b><?php echo $output['class_name'];?></b></h3>

                    <?php foreach ($output['news_list'] as $news_list) {?>
                        <dl class="idspan" id="<?php echo $news_list['id'];?>">

                            <dd>
                                <div class="big-img">
                                <div class="content_img">
                                  <a  href="<?php  echo urlShop('show_store', 'article_detalis', array('store_id'=>$news_list['store_id'],'id'=>$news_list['id']));?>">
                                        <img src="<?php echo $news_list['s_thumb'];?>"></a>
                                </div>
                                  <div class="content_info">
                                     <h4>
                                  <a  href="<?php  echo urlShop('show_store', 'article_detalis', array('store_id'=>$news_list['store_id'],'id'=>$news_list['id']));?>">
                                    <?php echo str_cut($news_list['s_title'],60);?>...</a></h4>
                                    <p class="yahei"> <?php echo str_cut($news_list['s_summary'],260);?></p>
                                  </div>
                                </div>
                                <div class="content">

                                    <div class="btn">
                                        <a class="left" href="<?php echo urlShop('cms_index', 'list', array('catid'=>$news_list['catid']));?>">
                                          <i class="dgou"  ></i><?php echo $news_list['cate_name'];?>
                                        </a>
                                        <span ><i class="times"></i><?php echo date('Y-m-d H:i:s',$news_list['s_time']);?></span>
                                        <span><i class="views"></i><?php echo $news_list['s_click'];?></span>
                                      
                                       
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    <?php }?>

            </div>

            <div class="tc mb20">  <div class="pagination"> <?php echo $output['show_page'];?> </div></div>
            <?php }else{ ?>
              <div class="none"><?php echo $lang['article_article_not_found'];?></div>
              <?php }?>
 </div>
 </div>
<div class="clear"></div>
