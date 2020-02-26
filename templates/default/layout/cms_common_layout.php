<?php defined('TTShop') or exit('Access Invalid!');?>
<!doctype html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo $output['html_title'];?></title>
<meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
<meta name="description" content="<?php echo $output['seo_description']; ?>" />

<meta name="renderer" content="webkit">
<meta name="renderer" content="ie-stand">
<?php echo html_entity_decode($output['setting_config']['qq_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['sina_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_qqzone_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_sinaweibo_appcode'],ENT_QUOTES); ?>
<style type="text/css">
body { _behavior: url(<?php echo SHOP_TEMPLATES_URL;
?>/css/csshover.htc);
}
</style>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/cms_header.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
<![endif]-->
<script>
var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var LOGIN_SITE_URL = '<?php echo LOGIN_SITE_URL;?>';var MEMBER_SITE_URL = '<?php echo MEMBER_SITE_URL;?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
</script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript">
  $(function(){
  //search
  $("#searchCMS").children('ul').children('li').click(function(){
    $(this).parent().children('li').removeClass("current");
    $(this).addClass("current");
        $("#form_search").attr("action", $(this).attr("action"));
        $("#act").val($(this).attr("act"));
        $("#op").val($(this).attr("op"));
  });
    var search_current_item = $("#searchCMS").children('ul').children('li.current');
    $("#form_search").attr("action", search_current_item.attr("action"));
    $("#act").val(search_current_item.attr("act"));
    $("#op").val(search_current_item.attr("op"));
});
</script>
</head>
<body>
<!-- PublicTopLayout Begin -->
<?php require_once template('layout/layout_top');?>
<!-- PublicHeadLayout Begin -->
<header id="topHeader">
  <div class="warp-all">
    <h1 class="cms-logo"> <a href="<?php echo SHOP_SITE_URL;?>">
      <a href="<?php echo SHOP_SITE_URL;?>"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COMMON.DS.$output['setting_config']['site_logo']; ?>" class="pngFix"></a>
   </h1>
    <div class="search-cms" id="searchCMS">
      <ul class="tab">
        <li <?php if($_GET['con'] != 'picture' ) echo 'class="current"'; ?> action="<?php echo SHOP_SITE_URL.DS;?>index.php" act="cmsseach" op="index"><?php echo $lang['cms_article'];?><i></i></li>
        <!-- <li <?php if($_GET['con'] == 'picture' ) echo 'class="current"'; ?> action="<?php echo SHOP_SITE_URL.DS;?>index.php" act="picture" op="picture_search"><?php echo $lang['cms_picture'];?><i></i></li> -->
        <li action="<?php echo SHOP_SITE_URL.DS;?>index.php" act="search"><?php echo $lang['cms_goods'];?><i></i></li>
      </ul>
      <div class="form-box">
        <form id="form_search" method="get" action="" >
          <input id="act" name="con" type="hidden" />
          <input id="op" name="fun" type="hidden" />
          <input id="keyword" name="keyword" type="text" class="input-text" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:'';?>" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" x-webkit-grammar="builtin:search" />
          <input id="btn_search" type="submit" class="input-btn" value="<?php echo $lang['cms_text_search'];?>">
        </form>
      </div>
      <div class="hot_keyword">
        热搜：
        <?php if(!empty($output['cms_keyword']) && is_array($output['cms_keyword'] )){?>
        <?php foreach($output['cms_keyword'] as $vt){?>
          <a href="<?php echo urlShop('cmsseach','index',array('keyword'=>$vt));?>"><?php echo $vt;?></a>
          <?php }?>
       <?php }?>
      </div>
    </div>
    <div class="header_phone">
      <?php echo C('site_phone')?>
    </div>
    <?php if($output['top_function_block']) { ?>
    <!--演示用天气插件-->
    <div class="weather-box">
      <div class="content">
        
        <iframe allowtransparency="true" frameborder="0" width="140" height="109" scrolling="no" src="http://tianqi.2345.com/plugin/widget/index.htm?s=1&v=1&f=1&b=&k=&t=1&a=1&c=54527&d=1&e=0"></iframe>

      </div>
    </div>
    <!--演示用天气插件 End-->
    <?php } ?>
  </div>
</header>
</div>
<!-- PublicHeadLayout End --> 

<!-- publicNavLayout Begin -->
<div id="navBar">
    <ul class="nc-nav-menu" id="jsddm">
     <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
      <?php foreach($output['nav_list'] as $nav){?>
      <?php if($nav['nav_location'] == '3'){?>
          <li>
          <a
        <?php
        if($nav['nav_new_open']) {
            echo ' target="_blank"';
        }
        switch($nav['nav_type']) {
            case '0':
                echo ' href="' . $nav['nav_url'] . '"';
                if (isset($_GET['catid']) && strstr($nav['nav_url'],'catid='.$_GET['catid']) ) {
                    echo ' class="current"';
                }
                break;

            case '1':
                echo ' href="' . urlShop('search', 'index',array('cate_id'=>$nav['item_id'])) . '"';
                if (isset($_GET['cate_id']) && $_GET['cate_id'] == $nav['item_id']) {
                    echo ' class="current"';
                }
                break;
            case '2':
                echo ' href="' . urlMember('article', 'article',array('ac_id'=>$nav['item_id'])) . '"';
                if (isset($_GET['ac_id']) && $_GET['ac_id'] == $nav['item_id']) {
                    echo ' class="current"';
                }
                break;
            case '3':
                echo ' href="' . urlShop('activity', 'index', array('activity_id'=>$nav['item_id'])) . '"';
                if (isset($_GET['activity_id']) && $_GET['activity_id'] == $nav['item_id']) {
                    echo ' class="current"';
                }
                break;

        }
        ?>>


        <?php echo $nav['nav_title'];?></a></li>
      <?php }?>
      <?php }?>
      <?php }?>
    </ul>
</div>



