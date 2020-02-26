<?php defined( 'InShopNC') or exit( 'Access Invalid!');?>
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/index.css" rel="stylesheet"
    type="text/css">
    <script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/home_index.js"
    charset="utf-8">
    </script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js">
    </script>
    <style type="text/css">
        .category { display: block !important; }
        .public-nav-layout .all-category .title{ padding-bottom:8px;}
    </style>
    <div class="clear">
    </div>
    <!-- HomeFocusLayout Begin-->
    <div class="home-focus-layout">
        <?php echo $output[ 'web_html'][ 'index_pic'];?>
            <div class="right-sidebar">
             <!--    <div class="box-all">
                    <div class="title">
                        <i>
                        </i>
                        <em>
                            公告
                        </em>
                        <a name="index2_none_gg_gd" target="_blank" href="<?php echo urllogin('article','article', array('ac_id'=>1));?>"
                        class="more">
                            更多
                        </a>
                    </div>
                    <div class="notice">
                        <div class="bg">
                        </div>
                        <ul class="list">
                            <?php if(!empty($output[ 'show_article'][ 'notice'][ 'list']) && is_array($output[
                            'show_article'][ 'notice'][ 'list'])) {$i=0; ?>
                                <?php foreach($output[ 'show_article'][ 'notice'][ 'list'] as $val) {$i++;
                                ?>
                                    <li <?php if($i==1) echo 'class="hot"'?>
                                        >
                                        <a target="_blank" href="<?php echo empty($val['article_url']) ? urlShop('article', 'show',array('article_id'=> $val['article_id'])):$val['article_url'] ;?>"
                                        title="<?php echo $val['article_title']; ?>">
                                            <i>
                                                【公告】
                                            </i>
                                            <em>
                                                <?php echo str_cut($val[ 'article_title'],24);?>
                                            </em>
                                        </a>
                                    </li>
                                    <?php }} ?>
                        </ul>
                    </div>
                    <div class="title">
                        <em>
                            商家助手
                        </em>
                    </div>
                    <div class="life">
                        <div class="list">
                            <ul>
                                <li class="s1">
                                    <a href="<?php echo urlLogin('predeposit', 'recharge_add');?>" rel="nofollow"
                                    target="_blank">
                                        充值
                                    </a>
                                </li>
                                <li class="s2">
                                    <a href="<?php echo urlShop('show_joinin', 'index');?>" rel="nofollow"
                                    target="_blank">
                                        入驻
                                    </a>
                                </li>
                                <li class="s3">
                                    <a href="<?php echo urlShop('show_help', 'index');?>" rel="nofollow" target="_blank">
                                        帮助
                                    </a>
                                </li>
                                <li class="m2">
                                    <a href="<?php echo urlShop('seller_login','show_login');?>" rel="nofollow"
                                    target="_blank">
                                        登入
                                    </a>
                                </li>
                                <li class="m3">
                                    <a href="<?php echo urlShop('store_order','index');?>" rel="nofollow"
                                    target="_blank">
                                        订单
                                    </a>
                                </li>
                                <li class="d1">
                                    <a href="<?php echo urlLogin('member_redpacket', 'index');?>" rel="nofollow"
                                    target="_blank">
                                        红包
                                    </a>
                                </li>
                                <li class="m1">
                                    <a href="<?php echo urlLogin('member_points','index');?>" rel="nofollow"
                                    target="_blank">
                                        积分
                                    </a>
                                </li>
                                <li class="d3">
                                    <a href="<?php echo urlShop('member_favorite_goods','index');?>" rel="nofollow"
                                    target="_blank">
                                        收藏
                                    </a>
                                </li>
                                <li class="d2">
                                    <a href="<?php echo urlLogin('member_voucher','index');?>" rel="nofollow"
                                    target="_blank">
                                        代金券
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <?php echo loadadv(66);?>
            </div>
    </div>
<!--=================================以上部分不能删除、只需要修改============================================================-->



<!-- after_banner -->
<div class="after_banner">
    <div class="after_banner_one banner_one"><?php echo loadadv(98);?></div>
    <div class="after_banner_one"><?php echo loadadv(99);?></div>
    <div class="after_banner_one"><?php echo loadadv(100);?></div>
</div>

<!---热卖开始-->
<div class="group">
    <div class="group_bg">
        <div class="group_title"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/hot.png"/></div>
        <div class="group_box">
        <?php foreach ($output['remai'] as $k => $v) { ?>
        <a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank" title="<?php echo $v['goods_jingle'];?>">
            <div class="group_one">
                <div class="group_one_img"><img src="<?php echo thumb($v,240);?>"/></div>
                <ul class="group_one_main">
                        <li class="gro_name"><?php echo str_cut($v['goods_name'],14);?></li>
                        <li class="gro_abs"><?php echo str_cut($v['goods_jingle'],14);?></li>
                        <li class="gro_ago">￥：<?php echo $v['goods_marketprice'];?></li>
                        <li class="gro_price">￥：<?php echo $v['goods_price'];?></li>
                        <li class="gro_buy">立即抢购</li>
                </ul>
            </div>
        </a>
       <?php }?>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
<!---热卖结束-->


<!-- small_banner -->
<div class="small_banner">
    <?php echo loadadv(101);?>
</div>
<?php $i=0;?>
<?php foreach ($output['goods_class'] as $k => $yd) { $i++;?>
<!-- 楼层 -->
<div class="ws_floor">
    <div class="ws_floor_title floor_title_<?php echo $i;?>"><div class="ws_floor_title_name"><?php echo $yd['gc_name']?></div></div>  
    <div class="ws_floor_box ws_floor_<?php echo $i;?>">
        <div class="ws_floor_left left_<?php echo $i;?>">
            <div class="ws_floor_left_top">
                <?php if($i == 1) {?>
                    <?php echo loadadv(102);?>
                <?php }elseif($i ==2) {?>
                   <?php echo loadadv(104);?>
                <?php }elseif($i ==3) {?>
                    <?php echo loadadv(106);?>
                <?php }elseif($i ==4) {?>
                    <?php echo loadadv(108);?>
                <?php }elseif($i ==5) {?>
                    <?php echo loadadv(110);?>
                <?php }elseif($i ==6) {?>
                    <?php echo loadadv(112);?>
                <?php }elseif($i ==7) {?>
                    <?php echo loadadv(114);?>
                <?php }elseif($i ==8) {?>
                    <?php echo loadadv(116);?>
                <?php } ?>
            </div>
            <div class="ws_floor_left_list">
                <ul class="ws_floor_left_list_all left_list_<?php echo $i;?>">
             <?php if (!empty($yd['class2']) && is_array($yd['class2'])) { ?>
              <?php foreach ($yd['class2'] as $k2 => $v2) { ?>
              <?php if (!empty($yd['class2']) && is_array($yd['class2'])) { ?>
              <?php $ii=0;foreach ($v2['class3'] as $k3 => $v3) { $ii++;?>
              <?php if($ii <7){?>
              <?php if($ii<=2){?>
                    <li class="list_line list_line_<?php echo $i;?>"><a href="<?php echo urlShop('search','index',array('cate_id'=> $v3['gc_id']));?>"><?php echo str_cut($v3['gc_name'],12);?></a></li>
              <?php } else { ?>
                    <li><a href="<?php echo urlShop('search','index',array('cate_id'=> $v3['gc_id']));?>"><?php echo str_cut($v3['gc_name'],12);?></a>  </li>
              <?php }?> 
              <?php } ?>
              <?php } ?>
              <?php } ?>
              <?php } ?>
              <?php } ?>
                </ul>
            </div>
            <div class="ws_floor_left_brand">
                <div class="ws_floor_left_brand_all">
                <?php foreach ($yd['g_brand'] as $k => $v) { ?>
                    <div class="ws_floor_left_brand_one"><a href="<?php echo urlShop('brand', 'list', array('brand'=>$v['brand_id']));?>"><img src="<?php echo brandImage($v['brand_pic']);?>" alt="<?php echo $v['brand_name'];?>" /></a></div>  
                <?php }?>
                </div>
            </div>
        </div>
        <div class="ws_floor_center ws_floor_center_<?php echo $i;?>">
            <div class="ws_floor_center_img">
                <?php if($i == 1) {?>
                    <?php echo loadadv(103);?>
                <?php }elseif($i ==2) {?>
                   <?php echo loadadv(105);?>
                <?php }elseif($i ==3) {?>
                    <?php echo loadadv(107);?>
                <?php }elseif($i ==4) {?>
                    <?php echo loadadv(109);?>
                <?php }elseif($i ==5) {?>
                    <?php echo loadadv(111);?>
                <?php }elseif($i ==6) {?>
                    <?php echo loadadv(113);?>
                <?php }elseif($i ==7) {?>
                    <?php echo loadadv(115);?>
                <?php }elseif($i ==8) {?>
                    <?php echo loadadv(117);?>
                <?php } ?>
            </div>
        </div>
        <div class="ws_floor_right ws_floor_right_<?php echo $i;?>">
        <?php foreach ($yd['g_tuijian_list'] as $k => $v) { ?>
            <div class="ws_floor_right_pro">
                <a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank" title="<?php echo $v['goods_jingle'];?>">
                    <div class="ws_floor_right_pro_img"><img src="<?php echo thumb($v,240)?>"/></div>
                    <ul class="ws_floor_right_pro_all">
                        <li class="floor_abs"><?php echo str_cut($v['goods_name'],20);?></li>
                        <li class="floor_ago_price">￥<?php echo $v['goods_marketprice'];?></li>
                        <li class="floor_price"><span>￥</span><?php echo $v['goods_price'];?></li>
                    </ul>
                </a>
            </div>
       <?php }?>
        </div>
    </div>
</div>
<!-- small_banner -->
<div class="small_banner">
    <img src="images/m_15.png"/>
</div>
                <?php if($i == 1) {?>
                    <?php echo loadadv(103);?>
                <?php }elseif($i ==2) {?>
                   <?php echo loadadv(105);?>
                <?php }elseif($i ==3) {?>
                    <?php echo loadadv(107);?>
                <?php }elseif($i ==4) {?>
                    <?php echo loadadv(109);?>
                <?php }elseif($i ==5) {?>
                    <?php echo loadadv(111);?>
                <?php }elseif($i ==6) {?>
                    <?php echo loadadv(113);?>
                <?php }elseif($i ==7) {?>
                    <?php echo loadadv(115);?>
                <?php }elseif($i ==8) {?>
                    <?php echo loadadv(117);?>
                <?php } ?>
<?php }?>


















