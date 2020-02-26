<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.js"></script>

<div class="wrapper">
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
        <div class="news-content left" style="margin-top: 36px;">
            <div class="news-info-content">
                <div style="background: #fff;">

                            <div class="news-title">
                                <h2 class="yahei" id="newsTitle"><?php echo $output['news_info']['s_title'];?></h2>
                            </div>
                            <div class="news-info">
                                <span class="idspan" id="<?php echo $output['news_info']['id'];?>"></span>
                                <div class="btn">

                                    <span class="left"><a href="<?php echo urlShop('show_store', 'article_list', array('id'=>$output['news_info']['id'],'store_id'=>$output['news_info']['store_id']));?>"><i class="zxun"></i><?php echo $output['news_info']['cate_name'];?></a></span>
                                    <span><?php echo date('Y-m-d H:i',$output['news_info']['s_time']);?></span>
                                    <span><i class="views"></i><?php echo $output['news_info']['s_click'];?></span>
                                    
                                </div>

                            </div>
                            <div class="news-description">

                            </div>

                    <div class="news-detail">
                        <?php echo $output['news_info']['s_content'];?>
                    </div>

           
                    <div class="news-share">
                        <div data-bd-bind="1455507145063" class="bdsharebuttonbox bdshare-button-style0-16">
                            <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                            <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                            <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                            <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>

                            <a href="#" class="bds_more" data-cmd="more">更多</a>
                        </div>
                        <script>window._bd_share_config = { "common": { "bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "0", "bdSize": "16" }, "share": {} }; with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
                    </div>
                </div>
            </div>


            <div class="news-updown">
                 <?php if(!empty($output['pre_article']) and is_array($output['pre_article'])){?>
                <a target="_blank" class="left"  href="<?php  echo urlShop('show_store', 'article_detalis', array('id'=>$output['pre_article']['id'],'store_id'=>$output['pre_article']['store_id']));?>"><?php echo $lang['article_show_previous'];?>： <?php echo $output['pre_article']['s_title'];?></a>
                <?php }else{?>
                <?php echo $lang['article_article_not_found'];?>
                <?php }?>

                <?php if(!empty($output['next_article']) and is_array($output['next_article'])){?>
                    <a  target="_blank"  href="<?php  echo urlShop('show_store', 'article_detalis', array('id'=>$output['next_article']['id'],'store_id'=>$output['next_article']['store_id']));?>"><span class="fr"><?php echo $lang['article_show_next'];?>：<?php echo $output['next_article']['s_title'];?></a>
                    <?php }else{?>
                    <?php echo $lang['article_article_not_found'];?>
                <?php }?>
            </div>

  

                    <div class="sh_sub_wrap shadow" style="margin-top: 20px;">
                        <h2><span class="left">热门文章</span></h2>
                        <div class="sh_sub_con sh_cjwt_wrap p10">
                            <ul>

                                   <?php if(is_array($output['hot_list']) and !empty($output['hot_list'])){?>
                                  <?php foreach ($output['hot_list'] as $ks=>$vs){?>
                                         <li class="yichu"><i class="icon_l"></i><a target="_blank" href="<?php  echo urlShop('show_store', 'article_detalis', array('store_id'=>$vs['store_id'],'id'=>$vs['id']));?>"><?php echo str_cut($vs['s_title'],36,'......')?></a></li>
                                  <?php }?>
                                  <?php }?>
                            </ul>
                        </div>
                    </div>
        </div>
    </div>

