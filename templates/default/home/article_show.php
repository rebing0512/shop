<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.js"></script>

<div class="wrapper">
 <section class="essay_right">

        <h3 class="tit_red">导航<i></i></h3>

        <?php foreach ($output['sub_class_list'] as $k=>$v){?>
        <a class="list_zx" href="<?php echo urlShop('article', 'article', array('ac_id'=>$v['ac_id']));?>" title="<?php echo $v['ac_name']?>">
          <img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_ARTICLE_LOGO.DS.$v['ac_logo']);?>" title="<?php echo $v['ac_name']?>" height="25"><?php echo $v['ac_name']?>
        </a>
        <?php }?>
      <div class="clear h10"></div>
       <h3 class="tit_red">最新推荐<!-- <a href="#" title="更多">更多</a> --><i></i></h3>
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
                                <h2 class="yahei" id="newsTitle"><?php echo $output['article']['article_title'];?></h2>
                            </div>
                            <div class="news-info">
                                <span class="idspan" id="<?php echo $output['article']['article_id'];?>"></span>
                                <div class="btn">

                                    <span class="left"><a href="<?php echo $output['nav_link_list'][1]['link'];?>"><i class="zxun"></i><?php echo $output['nav_link_list'][1]['title'];?></a></span>
                                    <span><?php echo date('Y-m-d H:i',$output['article']['article_time']);?></span>
                                    <span><i class="views"></i><?php echo $output['article']['article_view'];?></span>
                                    <a class="newsid" newsid="<?php echo $output['article']['article_id'];?>" zancount="<?php echo $output['article']['article_zan'];?>" href="javascript:zan(<?php echo $output['article']['article_id'];?>,<?php echo $output['article']['article_zan'];?>);"><i class="zan"></i><span id="zan<?php echo $output['article']['article_id'];?>"><?php echo $output['article']['article_zan'];?></span></a>
                                    <a href="#PLmao"><i class="com"></i><span id="comment<?php echo $output['article']['article_id'];?>"><?php echo $output['article']['article_pl'];?></span></a>
                                </div>

                            </div>
                            <div class="news-description">

                            </div>

                    <div class="news-detail">
                        <?php echo $output['article']['article_content'];?>
                    </div>

                    <div class="zan-addfavorite">
                        <div class="btn-group">
                            <span>赞</span>
                        </div>
                        <div class="zan-list">
                            <span class="arrow-1">&gt;</span>
                            <p>
                                <span><?php echo $output['article']['article_zan'];?></span>人<br>
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
                <a <?php if($output['pre_article']['article_url']!=''){?>target="_blank" <?php }?>  class="left"  href="<?php if($output['pre_article']['article_url']!='')echo $output['pre_article']['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['pre_article']['article_id']));?>"><?php echo $lang['article_show_previous'];?>： <?php echo $output['pre_article']['article_title'];?></a>
                <?php }else{?>
                <?php echo $lang['article_article_not_found'];?>
                <?php }?>

                <?php if(!empty($output['next_article']) and is_array($output['next_article'])){?>
                    <a <?php if($output['next_article']['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['next_article']['article_url']!='')echo $output['next_article']['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['next_article']['article_id']));?>"><span class="fr"><?php echo $lang['article_show_next'];?>：<?php echo $output['next_article']['article_title'];?></a>
                    <?php }else{?>
                    <?php echo $lang['article_article_not_found'];?>
                <?php }?>
            </div>

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
            <div class="news-comment" id="PLmao">
                <h3 class="yahei">我有话要说</h3>
                <div class="comment-input">
                    <div class="head-img">
                        <img alt="" src="<?php echo getMemberAvatar($_SESSION['avatar']);?>" />
                        <span class="arrow-1" style="top: 25px; left: 66px;">&lt;</span>
                        <textarea id="content" placeholder="说点什么吧..."></textarea>
                    </div>
                    <div class="btn">
                        <span class="selected" id="ajax_login">登录</span><span class="register">注册</span><span style="display:none" class="user_name"><?php echo $_SESSION['member_name'];?></span>
                        <button class="right" onclick="publishComment(this)" id="btnReview"></button>
                    </div>
                </div>

                <div class="comment-list">
                    <?php if(is_array($output['article_comment_list']) and !empty($output['article_comment_list'])){?>
                        <?php foreach($output['article_comment_list'] as $kl=>$cl){?>
                            <dl>
                                <dt>
                                    <img src="<?php echo $cl['member_avatar'];?>">
                                </dt>
                                <dd>
                                    <h4><span><?php echo $cl['member_name']?></span><em><?php echo date('Y-m-d H:i:s',$cl['s_comment_time'])?></em></h4>
                                    <p><?php echo $cl['s_comment_content']?></p>
                                </dd>
                            </dl>
                       <?php }}?>
                </div>
                  <?php if(is_array($output['article_comment_list']) and !empty($output['article_comment_list'])){?>
                 <div class="tc mb20">  <div class="pagination"> <?php echo $output['show_page'];?> </div></div>
                  <?php } ?>
                <script type="text/html" id="commentTmpl">
                    {{each}}
                    <dl>
                        <dt>
                            <img src="{{$value.member_img}}" /></dt>
                        <dd>
                            <h4><span>{{$value.member_name}}</span><em>{{$value.s_comment_time}}</em></h4>
                            <p>{{$value.s_comment_content}}</p>
                        </dd>
                    </dl>
                    {{/each}}
                </script>


            </div>

                    <div class="sh_sub_wrap shadow" style="margin-top: 20px;">
                        <h2><span class="left">相关文章</span></h2>
                        <div class="sh_sub_con sh_cjwt_wrap p10">
                            <ul>

                                   <?php if(is_array($output['xgwz']) and !empty($output['xgwz'])){?>
                                  <?php foreach ($output['xgwz'] as $ks=>$vs){?>
                                         <li class="yichu"><i class="icon_l"></i><a <?php if($vs['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vs['article_url']!='')echo $vs['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vs['article_id']));?>"><?php echo str_cut($vs['article_title'],36,'......')?></a></li>
                                  <?php }?>
                                  <?php }?>
                            </ul>
                        </div>
                    </div>
        </div>
    </div>


<script>
        var nid = "<?php echo $output['article']['article_id'];?>";
        var is_login="<?php echo $_SESSION['is_login'];?>";
        var uid = "<?php echo $_SESSION['member_id'];?>";
        var newsTitle = $("#newsTitle").text();
        if (newsTitle.substr(0, 1) == "【") {
            $("#newsTitle").css({ textIndent: "-12px" });
        }
        function publishComment(the) {

            var con = $.trim($("#content").val());
            con = StringFilter(con);
            var thisObj = $("#btnReview");
            thisObj.prop("disabled", true);
            if(!is_login){
                 TipMsg.Dialog(true, "登陆后再进行评论！", 1500);
                 login_dialog();

            }else{
                 if ( con == "" || con == null) {
                    TipMsg.Dialog(true, "评论内容不能为空，请填写评论！", 1500);
                    $('#content').focus();
                }else {
                    $(the).attr("disabled","disabled");
                    $.post("<?php echo urlShop('article', 'ajax_content');?>", { 'Pcontent': con, 'nid': nid,'uid':uid }, function (res) {
                        if (res.status == 1) {
                            setTimeout(function () {
                                $(the).removeAttr("disabled");
                            }, 10000);
                            $("#content").val("");
                            TipMsg.Dialog(true, "评论成功！", 1500);
                            var data = res.data;
                            $(".comment-list").prepend(template("commentTmpl", data));
                            $('#sppl').html(res.totalcount);
                        } else if (res.status == 2) {
                            $("#content").val("");
                            TipMsg.Dialog(false, "你已经评论过此文章了，不能重复评论哦！", 1500);
                        } else if(res.status == 3){
                             TipMsg.Dialog(true, "登陆后再进行评论！", 1500);
                             login_dialog();

                        }else{
                            TipMsg.Dialog(false, "出错了，请重试！", 1500);
                        }
                    }, "json");
                }

            }

        }

        if(is_login==true){
            var src="<?php echo getMemberAvatar($_SESSION['avatar']);?>";
            $(".comment-input .head-img img").attr("src",src);
            $(".comment-input .btn span.selected").hide();
            $(".comment-input .btn span.register").hide();
            $(".comment-input .btn span.user_name").show();
        } else {
            $(".comment-input .head-img img").attr("src", "<?php echo getMemberAvatar($_SESSION['avatar']);?>")
        }
        if (getCookie("newszan" + nid) && getCookie("newszan" + nid) == "1") {

            $(".zan-addfavorite .btn-group span").addClass("curZan");
        }



        function StringFilter(strSource) {
            var re = /\b(and|or|exec|execute|insert|select|delete|update|alter|create|drop|count|\*|chr|char|asc|mid|substring|master|truncate|declare|xp_cmdshell|restore|backup|net +user|net +localgroup +administrators)\b/;
            return strSource.replace(re, '').replace(/</gi, "＜").replace(/>/gi, "＞");
        }



      


            $(".shareEwm .big-ewm .close").on("click", function () {
                $(this).parents(".big-ewm").hide();
                setTimeout(function () {
                    $(".shareEwm .big-ewm").removeAttr("style");
                }, 100);
            });

            function zan(newsId, count) {
                var key = 'newszan' + newsId;
                if (getCookie(key) == 1) {
                    TipMsg.position("亲，您已经赞过了！", $("#zan" + newsId), 3600);
                } else {
                    $.post("<?php echo urlShop('article', 'ajax_zan');?>", { newsId: newsId }, function (res) {
                        if (res.status == 1) {
                            setCookie(key, 1);
                            count = count + 1;
                            $("#zan" + newsId).html(count);

                            $(".zan-addfavorite .btn-group span").addClass("curZan");
                        }else{
                             TipMsg.position(res.info, $("#zan" + newsId), 3600);
                        }
                    }, "json");
                }
            }


            $(".comment-input .btn span.selected").click(function () {
                   login_dialog();
            });
            $(".comment-input .btn span.register").click(function () {
                window.location.href = '/member/index.php?con=login&fun=register';
            });
            $(".zan-addfavorite .btn-group span").click(function () {
                var the = $(this);
                the.addClass("curZan");
                var oZan = $(".news-info .btn a.newsid");
                var nid = oZan.attr("newsid");

                var cnt = oZan.attr("zanCount");
                var key = 'newszan' + nid;
                if (getCookie(key) == 1) {
                    TipMsg.position("亲，您已经赞过了！", the);
                } else {
                    zan(nid, cnt);
                }
            });




</script>
