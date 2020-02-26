<?php defined('TTShop') or exit('Access Invalid!');?>
<?php echo getChat($layout);?>
<script language="javascript">
function fade() {
    $("img[rel='lazy']").each(function () {
        var $scroTop = $(this).offset();
        if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {
            $(this).hide();
            $(this).attr("src", $(this).attr("lm-url"));
            $(this).removeAttr("rel");
            $(this).removeAttr("name");
            $(this).fadeIn(500);
        }
    });
}

if($("img[rel='lazy']").length > 0) {
    $(window).scroll(function () {
        fade();
    });
};
fade();
</script>

<div class="jyw_footer_box" style="font-size:14px;">
  <div class="main">
    <div class="main_left" style="width:226px; margin-left:30px">
      <div class="jyw_f_l"></div>
    </div>
    <div class="main_right" style="width:714px;">
    <?php if(!empty($output['ft_catelist']) && is_array($output['ft_catelist'])){$il==0;?>
    <?php foreach ($output['ft_catelist'] as $kl => $vall){$il++;?>
     <?php if($il <4) {?>
   
          <ul class="footer_fw">
            <h4><a href="<?php echo urlShop('cms_index','list',array('catid'=>$vall['catid']));?>"><?php echo $vall['catname'];?></a></h4>
            <?php foreach ($vall['list'] as $ky => $yd) {?>
             
                    <li id="<?php echo $it;?>"><a  target="_blank" href="<?php if($yd['url']!='')echo $yd['url'];else echo urlShop('cms_index', 'details', array('id'=>$yd['id'],'catid'=>$yd['catid']));?> "><?php echo str_cut($yd['title'],26)?></a></li>
           
            <?php }?>
          </ul>
       <?php }?>
     <?php }?>
    <?php } ?>
      <ul class="footer_fw">
        <h4><a href="#">联系信息</a></h4>
        <li><a href="#"><?php echo C('site_name')?></a></li>
        <li><a href="#"><?php echo C('site_phone')?></a></li>
        <li><a href="#"><?php echo C('site_email')?></a></li>
        <li><a href="#">隐私声明</a></li>
      </ul>
    </div>
  </div>


    <div class="copyright_yd" style="margin:0px auto; width:100%; text-align:center;color:#CCCCCC; border-top:1px dashed #CCCCCC; padding-top:20px;">
        <p><a style="color:#FFFFFF" href="<?php echo SHOP_SITE_URL;?>"><?php echo $lang['nc_index'];?></a>
    <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
    <?php foreach($output['nav_list'] as $nav){?>
    <?php if($nav['nav_location'] == '2'){?>
    | <a style="color:#FFFFFF" <?php if($nav['nav_new_open']){?>target="_blank" <?php }?>href="<?php switch($nav['nav_type']){
        case '0':echo $nav['nav_url'];break;
        case '1':echo urlShop('search', 'index', array('cate_id'=>$nav['item_id']));break;
        case '2':echo urlShop('article', 'article',array('ac_id'=>$nav['item_id']));break;
        case '3':echo urlShop('activity', 'index',array('activity_id'=>$nav['item_id']));break;
    }?>"><?php echo $nav['nav_title'];?></a>
    <?php }?>
    <?php }?>
    <?php }?>
  </p>
 <div class="copy_yd_info">运营单位: <?php echo $output['setting_config']['operating_unit'];?></div>
 <div class="copy_yd_info"><?php echo $output['setting_config']['shopnc_version'];?> <?php echo $output['setting_config']['site_name'];?> <?php echo $output['setting_config']['icp_number']; ?></div>
 
 <div class="copy_yd_info">网址：<?php echo $output['setting_config']['web_url'];?></div>
 <div class="copy_yd_info"><?php echo html_entity_decode($output['setting_config']['statistics_code'],ENT_QUOTES); ?></div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.cookie.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">
<!-- 对比 --> 
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/compare.js"></script> 
<script type="text/javascript">
$(function(){
// Membership card
$('[nctype="mcard"]').membershipCard({type:'shop'});
});
</script>