<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">
<style>
.nch-breadcrumb{
   display: none;
}
</style>
    <div class="main">
    <div class="h10"></div>
    <?php echo loadadv(142);?>
       <section class="essay_right">

        <h3 class="tit_red"><?php echo $lang['article_article_article_class'];?><i></i></h3>
        <?php foreach ($output['sub_class_list'] as $k=>$v){?>
         <a class="list_zx" href="<?php echo urlShop('article', 'article', array('ac_id'=>$v['ac_id']));?>" title="<?php echo $v['ac_name']?>">
             <img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_ARTICLE_LOGO.DS.$v['ac_logo']);?>"  title="<?php echo $v['ac_name']?>" height="25">
             <?php echo $v['ac_name']?>
         </a>
        <?php }?>

     <div class="clear h10"></div>
    <h3 class="tit_red">最新推荐<!-- <a href="#" title="更多">更多</a><i></i> --></h3>
        <?php if(is_array($output['new_article_list']) and !empty($output['new_article_list'])){?>
          <?php foreach ($output['new_article_list'] as $k=>$v){?>
            <a class="recommend_a" <?php if($v['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($v['article_url']!='')echo $v['article_url'];else echo urlShop('article', 'show', array('article_id'=>$v['article_id']));?>">
            <?php echo str_cut($v['article_title'],36,'......')?></a></li>
          <?php }?>
          <?php }else{?>
          <div><?php echo $lang['article_article_no_new_article'];?></div>
          <?php }?>



     <div class="clear h20"></div>
    <h3 class="tit">热卖商品<i></i></h3>
    <menu class="essay_pro">
  <?php if(!empty($output['tuijian']) and is_array($output['tuijian'])){?>
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
    <?php }}}?>



      <div class="clear"></div>
    </menu>

  </section>
        <!--essay_right END-->
<div class="news-content left">
            <div class="clear"></div>
             <?php if(!empty($output['article']) and is_array($output['article'])){?>
            <div class="news-list">
                <h3 class="yahei"><b><?php echo $output['class_name'];?></b></h3>

                    <?php foreach ($output['article'] as $article) {?>
                        <dl class="idspan" id="9776">

                            <dd>
                                <div class="big-img">
                                <div class="content_img">
                                  <a <?php if($article['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($article['article_url']!='')echo $article['article_url'];else echo urlShop('article', 'show', array('article_id'=>$article['article_id']));?>">
                                        <img src="<?php echo $article['article_img'];?>"></a>
                                </div>
                                  <div class="content_info">
                                     <h4>
                                    <a <?php if($article['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($article['article_url']!='')echo $article['article_url'];else echo urlShop('article', 'show', array('article_id'=>$article['article_id']));?>">
                                    <?php echo str_cut($article['article_title'],60);?>...</a></h4>
                                    <p class="yahei"> <?php echo $article['article_summary'];?></p>
                                  </div>
                                </div>
                                <div class="content">

                                    <div class="btn">
                                        <a class="left" href="<?php echo urlShop('article', 'article', array('ac_id'=>$article['ac_id']));?>">
                                          <i class="dgou" style="background:none"><img src="<?php echo $output['class_icon'];?>" style="width:26px;height:26px;"></i><?php echo $output['class_name'];?>
                                        </a>
                                        <span ><i class="times"></i><?php echo date('Y-m-d H:i:s',$article['article_time']);?></span>
                                        <span><i class="views"></i><?php echo $article['article_view'];?></span>
                                        <a href="javascript:zan(<?php echo $article['article_id'];?>,<?php echo $article['article_zan'];?>);"><i class="zan"></i><span id="zan<?php echo $article['article_id'];?>">赞一个(<?php echo $article['article_zan'];?>)</span></a>
                                        <a <?php if($article['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($article['article_url']!='')echo $article['article_url']."#PLmao";else echo urlShop('article', 'show', array('article_id'=>$article['article_id']));?>#PLmao">
                                        <i class="com"></i>
                                        <span id="comment<?php echo $article['article_id'];?>">评论(<?php echo $article['article_pl'];?>)</span>
                                        </a>
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
 <script type="text/javascript">

            function zan(newsId, count) {
                var key = 'newszan' + newsId;
                if (getCookie(key) == 1) {
                    TipMsg.position("亲，您已经赞过了！", $("#zan" + newsId), 3600);
                } else {
                    $.post("<?php echo urlShop('article', 'ajax_zan');?>", { newsId: newsId }, function (res) {
                        if (res.status == 1) {
                            setCookie(key, 1);
                            count = count + 1;
                            $("#zan" + newsId).html("赞一个(" + count + ")");
                        }else{
                                 TipMsg.position(res.info, $("#zan" + newsId), 3600);
                            }
                    }, "json");
                }
            }
 </script>
<div class="clear"></div>
