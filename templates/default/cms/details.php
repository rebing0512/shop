<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.js"></script>

<div class="wrapper">
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
        <div class="news-content left" >
            <div class="news-info-content">
                <div style="background: #fff;">

                            <div class="news-title">
                                <h2 class="yahei" id="newsTitle" <?php if($output['data']['style']){ ?> style="<?php echo $output['style'];?> ";<?php }?> ><?php echo $output['data']['title'];?></h2>
                            </div>
                            <div class="news-info">
                                <span class="idspan" id="<?php echo $output['data']['id'];?>"></span>
                                <div class="btn">

                                    <span class="left">
                                    <a href="<?php echo urlShop('cms_index','list',array('catid'=>$_GET['catid']));?>">
                                    <i class="zxun" style="background:url(<?php echo $output['nav_ico'];?>) no-repeat center center"></i><?php echo $output['nav_title'];?>
                                    </a>
                                    </span>
                                    <span><?php echo date('Y-m-d H:i',$output['data']['inputtime']);?></span>
                                    <span><i class="views"></i><?php echo $output['data']['views'];?></span>
                                    <a class="newsid" newsid="<?php echo $output['data']['id'];?>" newscatid="<?php echo $output['data']['catid'];?>" zancount="<?php echo $output['data']['zan'];?>" href="javascript:zan(<?php echo $output['data']['id'];?>,<?php echo $output['data']['catid'];?>,<?php echo $output['data']['zan'];?>);"><i class="zan"></i><span id="zan_<?php echo $output['data']['catid'];?>_<?php echo $output['data']['id'];?>"><?php echo $output['data']['zan'];?></span></a>
                                    <a href="#PLmao"><i class="com"></i><span id="comment<?php echo $output['data']['id'];?>"><?php echo $output['data']['comment'];?></span></a>
                                </div>

                            </div>
                            <div class="news-description">

                            </div>

                    <div class="news-detail">
                        <?php echo $output['data']['content'];?>
                    </div>

                    <div class="zan-addfavorite">
                        <div class="btn-group">
                            <span>赞</span>
                        </div>
                        <div class="zan-list">
                            <span class="arrow-1">&gt;</span>
                            <p>
                                <span><?php echo $output['data']['zan'];?></span>人<br>
                                已赞
                            </p>
                        </div>
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
                <a <?php if($output['pre_article']['islink']!=''){?>target="_blank" <?php }?>  class="left"  href="<?php if($output['pre_article']['url']!='')echo $output['pre_article']['url'];else echo urlShop('cms_index', 'details', array('catid'=>$output['pre_article']['catid'],'id'=>$output['pre_article']['id']));?>"><?php echo $lang['article_show_previous'];?>： <?php echo $output['pre_article']['title'];?></a>
                <?php }else{?>
                   <a href="javascript:void(0)" class="left"><?php echo $lang['article_article_not_found'];?></a>
                <?php }?>

                <?php if(!empty($output['next_article']) and is_array($output['next_article'])){?>
                    <a <?php if($output['next_article']['islink']!=''){?>target="_blank"<?php }?> href="<?php if($output['next_article']['url']!='')echo $output['next_article']['url'];else echo urlShop('cms_index', 'details', array('catid'=>$output['next_article']['catid'],'id'=>$output['next_article']['id']));?>"><span class="fr"><?php echo $lang['article_show_next'];?>：<?php echo $output['next_article']['title'];?></a>
                    <?php }else{?>
                     <a href="javascript:void(0)" class="right"><?php echo $lang['article_article_not_found'];?></a>
                <?php }?>
            </div>
              <?php if(intval(C('cms_attitude_flag')) === 1 && intval($output['data']['attitude_flag']) === 1) { ?>
              <section  class="article-attitude"> 
                <!-- 心情 -->
                <?php require('article_attitude.php');?>
              </section>
              <?php } ?>


            <?php if( !empty($output['xbtj']) ){?>
            <div class="product-info">
                <h6>小编推荐的商品</h6>
                <div class="pro-detail">
                    <img src="<?php echo thumb($output['xbtj'], 240);?>" alt="<?php echo $output['xbtj']['goods_name'];?>">
                    <div class="pro">
                        <p style="font-size: 18px; color: #f60;"><?php echo ncPriceFormatForListsmall($output['xbtj']['goods_price']);?></p>
                        <p style="color: #666;"><?php echo str_cut($output['xbtj']['goods_name'],36);?></p>
                        <p style="color: #c5c5c5; font-size: 14px;"><?php echo $output['xbtj']['goods_jingle'];?></p>
                    </div>
                    <a href="<?php echo urlShop('goods','index',array('goods_id'=>$output['xbtj']['goods_id']));?>">立即拥有<em>&gt;</em></a>
                </div>
            </div>
            <?php } ?>

              <?php if(intval(C('cms_comment_flag')) === 1 && intval($output['data']['allow_comment']) === 1) { ?>
              <section class="article-comment"> 
                <!-- 评论 -->
                <?php require('comment.php');?>
              </section>
              <?php } ?>

         

          <?php if(is_array($output['xgwz']) && !empty($output['xgwz'])){?>
                    <div class="sh_sub_wrap shadow" style="margin-top: 20px;margin-bottom:50px;">
                        <h2><span class="left">相关文章</span></h2>
                        <div class="sh_sub_con sh_cjwt_wrap p10">
                            <ul>

                                 
                                  <?php foreach ($output['xgwz'] as $ks=>$vs){?>
                                         <li class="yichu"><i class="icon_l"></i><a <?php if($vs['islink']!=''){?>target="_blank"<?php }?> href="<?php if($vs['url']!='')echo $vs['url'];else echo urlShop('cms_index', 'details', array('catid'=>$vs['catid'],'id'=>$vs['id']));?>"><?php echo str_cut($vs['title'],36,'......')?></a></li>
                                  <?php }?>
                                
                            </ul>
                        </div>
                    </div>
          <?php }?>

</div>
</div>

<script>
        var nid = "<?php echo $output['data']['id'];?>";
        var cid = "<?php echo $output['data']['catid'];?>";
        var uid = "<?php echo $_SESSION['member_id'];?>";
       

       
        if (getCookie("newszan" + nid) && getCookie("newszan" + nid) == "1") {

            $(".zan-addfavorite .btn-group span").addClass("curZan");
        }
            $(".shareEwm .big-ewm .close").on("click", function () {
                $(this).parents(".big-ewm").hide();
                setTimeout(function () {
                    $(".shareEwm .big-ewm").removeAttr("style");
                }, 100);
            });

            function zan(newsId, catid,count) {
                var key = 'newszan_' + catid + "_" + newsId;
                if (getCookie(key) == 1) {
                    TipMsg.position("亲，您已经赞过了！", $("#zan_"+ catid+ "_"+ newsId), 3600);
                } else {
                    $.post("<?php echo urlShop('cms_index', 'ajax_zan');?>", { newsId: newsId ,catid:catid}, function (res) {
                        if (res.status == 1) {
                            setCookie(key, 1);
                            count = count + 1;
                            $("#zan_"+ catid+ "_"+ newsId).html(count);

                            $(".zan-addfavorite .btn-group span").addClass("curZan");
                        }else{
                             TipMsg.position(res.info, $("#zan_"+ catid+ "_"+ newsId), 3600);
                        }
                    }, "json");
                }
            }



            $(".zan-addfavorite .btn-group span").click(function () {
                var the = $(this);
                the.addClass("curZan");
                var oZan = $(".news-info .btn a.newsid");
                var nid = oZan.attr("newsid");
                var ncatid = oZan.attr("newscatid");
                var cnt = oZan.attr("zanCount");
                var key = 'newszan_' + ncatid + "_" + nid;
                if (getCookie(key) == 1) {
                    TipMsg.position("亲，您已经赞过了！", the);
                } else {
                    zan(nid,ncatid, cnt);
                }
            });




</script>
