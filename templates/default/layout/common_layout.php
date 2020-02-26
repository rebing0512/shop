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
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_header.css" rel="stylesheet" type="text/css">
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
var PRICE_FORMAT = '<?php echo $lang['currency'];?>%s';
$(function(){
  //首页左侧分类菜单
  $(".category ul.menu").find("li").each(
    function() {
      $(this).hover(
        function() {
            var cat_id = $(this).attr("cat_id");
          var menu = $(this).find("div[cat_menu_id='"+cat_id+"']");
          menu.show();
          $(this).addClass("hover");          
          var menu_height = menu.height();
          if (menu_height < 60) menu.height(80);
          menu_height = menu.height();
          var li_top = $(this).position().top;
          $(menu).css("top",-li_top + 47);
        },
        function() {
          $(this).removeClass("hover");
            var cat_id = $(this).attr("cat_id");
          $(this).find("div[cat_menu_id='"+cat_id+"']").hide();
        }
      );
    }
  );
  $(".mod_minicart").hover(function() {
    $("#nofollow,#minicart_list").addClass("on");
  },
  function() {
    $("#nofollow,#minicart_list").removeClass("on");
  });
  $('.mod_minicart').mouseover(function(){// 运行加载购物车
    load_cart_information();
    $(this).unbind('mouseover');
  });
    
  $('#button').click(function(){
      if ($('#keyword').val() == '') {
        if ($('#keyword').attr('data-value') == '') {
          return false
      } else {
        window.location.href="<?php echo SHOP_SITE_URL;?>/index.php?con=search&fun=index&keyword="+$('#keyword').attr('data-value');
          return false;
      }
      }
  });
  $(".head-search-bar").hover(null,function() {

    $('#search-tip').hide();
  });
  // input ajax tips
  $('#keyword').focus(function(){$('#search-tip').show()}).autocomplete({
    //minLength:0,
        source: function (request, response) {
            $.getJSON('http://www.ynlmsc.pw/index.php?con=search&fun=auto_complete', request, function (data, status, xhr) {
                $('#top_search_box > ul').unwrap();
                response(data);
                if (status == 'success') {
                    $('#search-tip').hide();
                    $(".head-search-bar").unbind('mouseover');
                    $('body > ul:last').wrap("<div id='top_search_box'></div>").css({'zIndex':'1000','width':'362px'});
                }
            });
       },
    select: function(ev,ui) {
      $('#keyword').val(ui.item.label);
      $('#top_search_form').submit();
    }
  });
  $('#search-his-del').on('click',function(){$.cookie('tt520_his_sh',null,{path:'/'});$('#search-his-list').empty();});
   var act = "search";
    if (act == "store_list"){
        $('#hdSearchTab ul li span').eq(0).html('店铺');
        $('#hdSearchTab ul li span').eq(1).html('商品');
        $('#hdSearchTab ul li').eq(0).attr('act','store_list');
        $('#search_act').attr("value","store_list");
        }
    $('#hdSearchTab').hover(function(){
        $('#hdSearchTab ul li').eq(1).show();
        $('#hdSearchTab ul li i').addClass('over').removeClass('arrow');
    },function(){
        $('#hdSearchTab ul li').eq(1).hide();
        $('#hdSearchTab ul li i').addClass('arrow').removeClass('over');
    });
    $('#hdSearchTab ul li').eq(1).click(function(){
        $(this).hide();
        if($(this).find('span').html() == '店铺') {
            $('#keyword').attr("placeholder","请输入您要搜索的店铺关键字");
            $('#hdSearchTab ul li span').eq(0).html('店铺');
            $('#hdSearchTab ul li span').eq(1).html('商品');
            $('#search_act').attr("value",'store_list');
        } else {
            $('#keyword').attr('placeholder','请输入您要搜索的商品关键字');
            $('#hdSearchTab ul li span').eq(0).html('商品');
            $('#hdSearchTab ul li span').eq(1).html('店铺');
            $('#search_act').attr("value",'search');
        }
        $("#keyword").focus();
    });
});
</script>
</head>
<body>
<!-- PublicTopLayout Begin -->
<?php require_once template('layout/layout_top');?>
<!-- PublicHeadLayout Begin -->
<div class="header-wrap">
  <header class="public-head-layout wrapper">
    <h1 class="site-logo"><a href="<?php echo SHOP_SITE_URL;?>"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COMMON.DS.$output['setting_config']['site_logo']; ?>" class="pngFix"></a></h1>
    <div class="logo-test"><?php echo $output['setting_config']['shopwwi_stitle']; ?></div>
   
    <div class="head-search-layout">
      <div class="head-search-bar" id="head-search-bar">
     <div class="hd_serach_tab" id="hdSearchTab">
      <ul><li con="search" class="current"><span>商品</span><i class="arrow"></i></li><li act="store_list"><span>店铺</span></li></ul>
<i></i>
</div>

        <form action="<?php echo SHOP_SITE_URL;?>" method="get" class="search-form" id="top_search_form">
          <input name="con" id="search_act" value="search" type="hidden">
          <?php
      if ($_GET['keyword']) {
        $keyword = stripslashes($_GET['keyword']);
      } elseif ($output['rec_search_list']) {
                $_stmp = $output['rec_search_list'][array_rand($output['rec_search_list'])];
        $keyword_name = $_stmp['name'];
        $keyword_value = $_stmp['value'];
      } else {
                $keyword = '';
            }
    ?>
          <input name="keyword" id="keyword" type="text" class="input-text" value="<?php echo $keyword;?>" maxlength="60" x-webkit-speech lang="zh-CN" onwebkitspeechchange="foo()" placeholder="<?php echo $keyword_name ? $keyword_name : '请输入您要搜索的商品关键字';?>" data-value="<?php echo rawurlencode($keyword_value);?>" x-webkit-grammar="builtin:search" autocomplete="off" />
          <input type="submit" id="button" value="<?php echo $lang['nc_common_search'];?>" class="input-submit">
        </form>
        <div class="search-tip" id="search-tip">
          <div class="search-history">
            <div class="title">历史纪录<a href="javascript:void(0);" id="search-his-del">清除</a></div>
            <ul id="search-his-list">
              <?php if (is_array($output['his_search_list']) && !empty($output['his_search_list'])) { ?>
              <?php foreach($output['his_search_list'] as $v) { ?>
              <li><a href="<?php echo urlShop('search', 'index', array('keyword' => $v));?>"><?php echo $v ?></a></li>
              <?php } ?>
              <?php } ?>
            </ul>
          </div>
          <div class="search-hot">
            <div class="title">热门搜索...</div>
            <ul>
              <?php if (is_array($output['rec_search_list']) && !empty($output['rec_search_list'])) { ?>
              <?php foreach($output['rec_search_list'] as $v) { ?>
              <li><a href="<?php echo urlShop('search', 'index', array('keyword' => $v['value']));?>"><?php echo $v['value']?></a></li>
              <?php } ?>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="keyword">
        <ul>
          <?php if(is_array($output['hot_search']) && !empty($output['hot_search'])) { foreach($output['hot_search'] as $val) { ?>
          <li><a href="<?php echo urlShop('search', 'index', array('keyword' => $val));?>"><?php echo $val; ?></a></li>
          <?php } }?>
        </ul>
      </div>
    </div>
    <div class="mod_minicart" style="">
    <a id="nofollow" target="_self" href="<?php echo SHOP_SITE_URL;?>/index.php?con=cart" class="mini_cart_btn">
                        <i class="cart_icon"></i> 
      <em class="cart_num"><?php echo $output['cart_goods_num'];?></em>
      <span>购物车</span>
    </a>
    <div id="minicart_list" class="minicart_list">
      <div class="spacer"></div>
      <div class="list_detail ps-container">
        <!--购物车有商品时begin-->
        <ul><img class="loading" src="<?php echo SHOP_TEMPLATES_URL;?>/images/loading.gif" /></ul> 
       
    </div>
  </div>
<!--    <div class="head-user-menu">
      <dl class="my-cart">
        <?php if ($output['cart_goods_num'] > 0) { ?>
        <div class="addcart-goods-num"><?php echo $output['cart_goods_num'];?></div>
        <?php } ?>
        <dt><span class="ico"></span>购物车结算<i class="arrow"></i></dt>
        <dd>
          <div class="sub-title">
            <h4>最新加入的商品</h4>
          </div>
          <div class="incart-goods-box">
            <div class="incart-goods"> <img class="loading" src="<?php echo SHOP_TEMPLATES_URL;?>/images/loading.gif" /> </div>
          </div>
          <div class="checkout"> <span class="total-price">共<i><?php echo $output['cart_goods_num'];?></i><?php echo $lang['nc_kindof_goods'];?></span><a href="<?php echo SHOP_SITE_URL;?>/index.php?con=cart" class="btn-cart">结算购物车中的商品</a> </div>
        </dd>
      </dl>
    </div>-->
  </header>
</div>
<!-- PublicHeadLayout End --> 

<!-- publicNavLayout Begin -->
<nav class="public-nav-layout <?php if($output['channel']) {echo 'channel-'.$output['channel']['channel_style'].' channel-'.$output['channel']['channel_id'];} ?>">
  <div class="wrapper">
    <div class="all-category">
      <?php require template('layout/home_goods_class');?>
    </div>
    <ul class="site-menu">
    
 <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
      <?php foreach($output['nav_list'] as $nav){?>
      <?php if($nav['nav_location'] == '1'){?>
      <li><a
        <?php
        if($nav['nav_new_open']) {
            echo ' target="_blank"';
        }
        switch($nav['nav_type']) {
            case '0':
                echo ' href="' . $nav['nav_url'] . '"';
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
        ?>><?php echo $nav['nav_title'];?></a></li>
      <?php }?>
      <?php }?>
      <?php }?>
    </ul>
  </div>
</nav>
