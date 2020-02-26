<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.js"></script>
<style type="text/css">
.essay_right{margin-top: 0px;}
  .sidebar { width: 260px; float: right; }
 .block-style-one { margin-bottom:  20px;}
.block-style-one .title { height: 50px; border-bottom: solid 1px #ebebeb;}
.block-style-one .title h3 { font-size: 14px; line-height: 20px; color: #666; display: block; padding: 15px 12px; float: left;}
.block-style-one .content { background-color: #FFF; overflow: hidden; margin-top: 5px;}
.tzx-hot-comment-list { overflow: hidden;}
.tzx-hot-comment-list li { margin-bottom: 10px; overflow: hidden;}
.tzx-hot-comment-list li em { font-family: Georgia,Arial; font-weight: 600; font-size: 16px; color: #FFF; line-height: 24px; background-color: #999; vertical-align: top; text-align: center; display: inline-block; width: 25%; padding: 5px 0;}
.tzx-hot-comment-list li a { line-height: 16px; color: #00ACE6; vertical-align: top; display: inline-block; width: 70%; height: 32px; padding: 1px 0; margin-left: 4%;}
.article-recommand-list {font-size: 13px;
    line-height: 20px; overflow: hidden;}
.article-recommand-list li { margin-top: 20px;}
.article-recommand-list li a{color: #333;}
.article-recommand-list li a:hover{color: #ff5370;}
.article-recommand-list li.line { border-top: dashed 1px #E7E7E7; margin: 6px 0;}
.article-recommand-list a.class { color: #00ACE6; margin-right: 8px;}
</style>
<div class="wrapper">
 <section class="essay_right">

      <div class="sidebar">
    <div class="block-style-one">
      <div class="title">
        <h3>热门评论</h3>
      </div>
      <div class="content">
        <ul class="tzx-hot-comment-list">
        
           <?php if(is_array($output['hot_article_list']) and !empty($output['hot_article_list'])){?>
          <?php foreach ($output['hot_article_list'] as $k=>$v){?>
                <li><em><?php echo $v['comment'];?></em><a <?php if($v['islink']){?>target="_blank"<?php }?> href="<?php if($v['url']!='')echo $v['url'];else echo urlShop('cms_index', 'details', array('id'=>$v['id'],'catid'=>$v['catid']));?>"><?php echo str_cut($v['title'],46,'......')?></a></li>
          <?php }?>
          <?php }else{?>
          <div><?php echo $lang['article_article_no_new_article'];?></div>
          <?php }?>

                   
                            
        </ul>
      </div>
    </div>
    <div class="block-style-one">
      <div class="title">
        <h3>精彩推荐</h3>
      </div>
      <div class="content">
                <ul class="article-recommand-list">
                      <?php if(is_array($output['tj_article_list']) and !empty($output['tj_article_list'])){?>
                      <?php foreach ($output['tj_article_list'] as $kt=>$vt){?>
                             <li><a  class="class" <?php if($vt['islink']){?>target="_blank"<?php }?> href="<?php if($vt['url']!='')echo $vt['url'];else echo urlShop('cms_index', 'details', array('id'=>$vt['id'],'catid'=>$vt['catid']));?> ">[<?php echo $vt['catname'];?>]</a><a href="<?php if($vt['islink']){?>target="_blank"<?php }?> href="<?php if($vt['url']!='')echo $vt['url'];else echo urlShop('cms_index', 'details', array('id'=>$vt['id'],'catid'=>$vt['catid']));?>><?php echo str_cut($vt['title'],56,'...')?></a></li>
                                                   
                                <li class="line"></li>
                      <?php }?>
                      <?php }else{?>
                      <div><?php echo $lang['article_article_no_new_article'];?></div>
                      <?php }?>
                        
                  </ul>
                
      </div>
    </div>
  </div>
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

                                    <span class="left"><?php echo $output['nav_title'];?></span>
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
                <a <?php if($output['pre_article']['islink']!=''){?>target="_blank" <?php }?>  class="left"  href="<?php if($output['pre_article']['url']!='')echo $output['pre_article']['url'];else echo urlShop('cms_index', 'comment_detail', array('catid'=>$output['pre_article']['catid'],'id'=>$output['pre_article']['id']));?>"><?php echo $lang['article_show_previous'];?>： <?php echo $output['pre_article']['title'];?></a>
                <?php }else{?>
                   <a href="javascript:void(0)" class="left"><?php echo $lang['article_article_not_found'];?></a>
                <?php }?>

                <?php if(!empty($output['next_article']) and is_array($output['next_article'])){?>
                    <a <?php if($output['next_article']['islink']!=''){?>target="_blank"<?php }?> href="<?php if($output['next_article']['url']!='')echo $output['next_article']['url'];else echo urlShop('cms_index', 'comment_detail', array('catid'=>$output['next_article']['catid'],'id'=>$output['next_article']['id']));?>"><span class="fr"><?php echo $lang['article_show_next'];?>：<?php echo $output['next_article']['title'];?></a>
                    <?php }else{?>
                     <a href="javascript:void(0)" class="right"><?php echo $lang['article_article_not_found'];?></a>
                <?php }?>
            </div>
         



              <?php if(intval(C('cms_comment_flag')) === 1 && intval($output['data']['allow_comment']) === 1) { ?>
              <section class="article-comment" style="margin-top: 20px;margin-bottom:50px;"> 
                <!-- 评论 -->
                <?php require('comment.php');?>
              </section>
              <?php } ?>

         

  

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
