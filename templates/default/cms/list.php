<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">

    <div class="main">

    

 <section class="essay_right">

        <h3 class="tit_red">导航<i></i></h3>

        <?php foreach ($output['catelist'] as $k=>$v){?>
        <a class="list_zx" href="<?php echo urlShop('cms_index', 'list', array('catid'=>$v['catid']));?>" title="<?php echo $v['catname']?>">
          <img src="<?php echo $v['image'];?>" title="<?php echo $v['catname']?>" height="25"><?php echo $v['catname']?>
        </a>
        <?php }?>
      <div class="clear h10"></div>
       <h3 class="tit_red">最新推荐<!-- <a href="#" title="更多">更多</a> --><i></i></h3>
        <?php if(is_array($output['new_article_list']) and !empty($output['new_article_list'])){?>
          <?php foreach ($output['new_article_list'] as $k=>$v){?>
            <a class="recommend_a" <?php if($v['islink']){?>target="_blank"<?php }?> href="<?php if($v['url']!='')echo $v['url'];else echo urlShop('cms_index', 'details', array('id'=>$v['id'],'catid'=>$v['catid']));?>">
            <?php echo str_cut($v['title'],36,'......')?></a></li>
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
             <?php if(!empty($output['article']) and is_array($output['article'])){?>
            <div class="news-list">
                <h3 class="yahei"><b><?php echo $output['class_name'];?></b></h3>

                    <?php foreach ($output['article'] as $article) {?>
                        <dl class="idspan" id="<?php echo $article['id'];?>">

                            <dd>
                                <div class="big-img">
                                <div class="content_img">
                                  <a <?php if($article['islink']==1){?>target="_blank"<?php }?> href="<?php if($article['url']!='')echo $article['url'];else echo urlShop('cms_index', 'details', array('catid'=>$article['catid'],'id'=>$article['id']));?>">
                                        <img src="<?php echo $article['thumb'];?>"></a>
                                </div>
                                  <div class="content_info">
                                     <h4>
                                    <a <?php if($article['islink']==1){?>target="_blank"<?php }?> href="<?php if($article['url']!='')echo $article['url'];else echo urlShop('cms_index', 'details', array('catid'=>$article['catid'],'id'=>$article['id']));?>">
                                    <?php echo str_cut($article['title'],60);?>...</a></h4>
                                    <p class="yahei"> <?php echo str_cut($article['description'],260);?></p>
                                  </div>
                                </div>
                                <div class="content">

                                    <div class="btn">
                                        <a class="left" href="<?php echo urlShop('cms_index', 'list', array('catid'=>$article['catid']));?>">
                                          <i class="dgou" style="background:none" ><img src="<?php echo $article['image'];?>" style="width:26px;height:26px;"></i><?php echo $article['classname'];?>
                                        </a>
                                        <span ><i class="times"></i><?php echo date('Y-m-d H:i:s',$article['inputtime']);?></span>
                                        <span><i class="views"></i><?php echo $article['views'];?></span>
                                        <a href="javascript:zan(<?php echo $article['id'];?>,<?php echo $article['catid'];?>,<?php echo $article['zan'];?>);"><i class="zan"></i><span id="zan_<?php echo $article['catid'];?>_<?php echo $article['id'];?>">赞一个(<?php echo $article['zan'];?>)</span></a>
                                        <a <?php if($article['islink']==1){?>target="_blank"<?php }?> href="<?php if($article['url']!='')echo $article['url']."#PLmao";else echo urlShop('cms_index', 'details', array('catid'=>$article['catid'],'id'=>$article['id']));?>#PLmao">
                                        <i class="com"></i>
                                        <span id="comment<?php echo $article['id'];?>">评论(<?php echo $article['comment'];?>)</span>
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

             function zan(newsId, catid,count) {
                var key = 'newszan_' + catid + "_" + newsId;
                if (getCookie(key) == 1) {
                    TipMsg.position("亲，您已经赞过了！", $("#zan_"+ catid+ "_"+ newsId), 3600);
                } else {
                    $.post("<?php echo urlShop('cms_index', 'ajax_zan');?>", { newsId: newsId ,catid:catid}, function (res) {
                        if (res.status == 1) {
                            setCookie(key, 1);
                            count = count + 1;
                            $("#zan_"+ catid+ "_"+ newsId).html("赞一个("+count+")");

                            $(".zan-addfavorite .btn-group span").addClass("curZan");
                        }else{
                             TipMsg.position(res.info, $("#zan_"+ catid+ "_"+ newsId), 3600);
                        }
                    }, "json");
                }
            }
 </script>
<div class="clear"></div>
