<?php defined('TTShop') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/news.css" rel="stylesheet" type="text/css">

<div class="menus">
        <div class="guide_nav">
           <?php foreach ($output['sub_class_list'] as $k=>$v){?>
          <a href="<?php echo urlShop('article', 'article', array('ac_id'=>$v['ac_id']));?>"><?php echo $v['ac_name']?></a>
          <?php }?>


        </div>
</div>
  <div class="article_block ">
  <div id="focus">
        <?php echo loadadv(143);?>
  </div>
  <div class="articlelist">
    <h3>
    </h3>

    <div class="learn_news">
      <h4>
         <?php echo str_cut($output['topnews'][0]['article_title'],26)?>
      </h4>

      <p>
        <a <?php if($output['topnews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['topnews'][0]['article_url']!='')echo $output['topnews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['topnews'][0]['article_id']));?>" target="_blank">
          <?php echo str_cut($output['topnews'][0]['article_summary'],60)?>
        </a>
      </p>
      <p>
        <a <?php if($output['topnews'][0]['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['topnews'][0]['article_url']!='')echo $output['topnews'][0]['article_url'];else echo urlShop('article', 'show', array('article_id'=>$output['topnews'][0]['article_id']));?>" target="_blank" class="red">
          【详细阅读】
        </a>
      </p>
    </div>
    <ul class="alllist bodertop mt10">



      <?php $iks==0;foreach ($output['topnewslist'] as $kvs=>$vvs){$iks++;?>
      <?php if($iks <7){?>
      <li>
        <a href="<?php echo urlShop('article', 'article', array('ac_id'=>$vvs['ac_id']));?>" class="kind">
          <?php echo $vvs['ac_name'];?>
        </a>
        <span>
          |
        </span>
        <a <?php if($vvs['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vvs['article_url']!='')echo $vvs['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vvs['article_id']));?>" target="_blank">
         <?php echo str_cut($vvs['article_title'],26)?>
        </a>
        <time><?php echo date("Y-m-d",$vvs['article_time'])?></time>
      </li>
      <?php } }?>
    </ul>
    <ul class="alllist bodertop mt10">
       <?php $iks1==0;foreach ($output['topnewslist'] as $kvs=>$vvs){$iks1++;?>
      <?php if($iks1 > 6){?>
      <li>
        <a href="<?php echo urlShop('article', 'article', array('ac_id'=>$vvs['ac_id']));?>" class="kind">
          <?php echo $vvs['ac_name'];?>
        </a>
        <span>
          |
        </span>
        <a <?php if($vvs['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vvs['article_url']!='')echo $vvs['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vvs['article_id']));?>" target="_blank">
         <?php echo str_cut($vvs['article_title'],26)?>
        </a>
        <time><?php echo date("Y-m-d",$vvs['article_time'])?></time>
      </li>
      <?php } }?>
    </ul>
  </div>
  <div class="pageside">
    <div class="sidecom">
      <div class="titles">
        <a class="ico ico3" href="<?php echo urlShop('article', 'article', array('ac_id'=>$output['tongzhi'][0]['ac_id']));?>">
        </a>
        通知公告
      </div>
      <ul class="body">
       <?php $ik==0;foreach ($output['tongzhi'] as $kv=>$vv){$ik++;?>
        <li>
          <div class="subject">
            <span class="ico <?php if($ik <4){?>ico1<?php }else{?>ico2<?php }?>">
            <?php echo $ik;?>
            </span>
            <a <?php if($vv['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vv['article_url']!='')echo $vv['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vv['article_id']));?>" target="_blank">
              <?php echo str_cut($vv['article_title'],26)?>
            </a>
          </div>
        </li>
         <?php } ?>

      </ul>
    </div>
    <div class="pic right">
     <?php echo loadadv(144);?>
    </div>
  </div>
</div>
<div class="clear"></div>
<div class="article_block homead ">
 <?php echo loadadv(145);?>
</div>


<div class="article_block">
  <div class="maincom">

    <div class="body">
    <?php if(!empty($output['aclist'])){?>
    <?php $it==0;foreach($output['aclist'] as $ka=>$va){$it++;?>
    <?php if($it<3){?>
      <div class="first <?php if($it==2){echo 'first_tl';}?>" >
        <div class="head">
          <span>
            <a href="<?php echo urlShop('article', 'article', array('ac_id'=>$va['ac_id']));?>" target="_blank">
              <?php echo $va['ac_name'];?>
            </a>
          </span>
          <div class="right gray">
            <a class="last" href="<?php echo urlShop('article', 'article', array('ac_id'=>$va['ac_id']));?>" target="_blank">
              更多
            </a>
          </div>
        </div>
        <ul class="alllist">
        <?php foreach($va['alist'] as $kt=>$vt){?>
          <li>
            <a class="kind" href="<?php echo urlShop('article', 'article', array('ac_id'=>$va['ac_id']));?>" target="_blank">
              <?php echo $va['ac_name'];?>
            </a>
            <span>
              |
            </span>
            <a <?php if($vt['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vt['article_url']!='')echo $vt['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vt['article_id']));?>" target="_blank">
              <?php echo str_cut($vt['article_title'],26)?>
            </a>
            <time><?php echo date("Y-m-d",$vt['article_time'])?></time>
          </li>
        <?php } ?>
        </ul>
      </div>
    <?php } } }?>
    </div>
  </div>
  <div class="pageside">
    <?php if(!empty($output['aclist'])){?>
    <?php $it1==0;foreach($output['aclist'] as $ka=>$va){$it1++;?>
    <?php if($it1>2){?>
    <div class="sidecom">
      <div class="titles">
        <a class="ico ico3" href="<?php echo urlShop('article', 'article', array('ac_id'=>$vvs['ac_id']));?>">
        </a>
          <?php echo $vvs['ac_name'];?>
      </div>
      <ul class="body">
        <?php $itone==0; foreach($va['alist'] as $kt=>$vt){$itone++;?>
        <li>
          <div class="subject">
            <?php if($itone <4){?>
            <span class="ico ico1">
            <?php }else{?>
            <span class="ico ico2">
            <?php }?>
               <?php echo $itone;?>

            </span>
             <a <?php if($vt['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vt['article_url']!='')echo $vt['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vt['article_id']));?>" target="_blank">
              <?php echo str_cut($vt['article_title'],26)?>
            </a>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
    <?php } } }?>
  </div>
</div>

<div class="clear"></div>

<div class="artimg_box article_block">
  <div class="sec-title-1">
    <h3>
      行业资讯
    </h3>
    <a class="more" href="<?php echo urlShop('article', 'article', array('ac_id'=>$output['hynews'][0]['ac_id']));?>">
      更多&gt;&gt;
    </a>
  </div>
    <div class="focus">
        <?php echo loadadv(146);?>
    </div>
  <ul class="a_liust">
  <?php if(!empty($output['hynews'])){?>
   <?php foreach($output['hynews'] as $ky=>$vy){?>
    <li>
      <p>
        <a <?php if($vy['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vy['article_url']!='')echo $vy['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vy['article_id']));?>" target="_blank">
          <img class="view" alt="<?php echo str_cut($vy['article_title'],26)?>" src="<?php echo $vy['article_thumb'];?>">
        </a>

      </p>
      <p>
       <a class="txt"  <?php if($vy['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($vy['article_url']!='')echo $vy['article_url'];else echo urlShop('article', 'show', array('article_id'=>$vy['article_id']));?>" target="_blank">
          <?php echo str_cut($vy['article_title'],20)?>
        </a>
      </p>
    </li>
    <?php } } ?>
  </ul>
</div>


<div class="artimg_box1 article_block" style="margin-bottom:10px;">
  <div class="sec-title-1">
    <h3>
      热卖推荐
    </h3>
    <a class="more" target="_blank" href="/shop/index.php?con=search&fun=index&tag=5">
      更多&gt;&gt;
    </a>
  </div>
  <ul>
    <?php foreach($output['rexiao'] as $keyt=>$valrx){ ?>
    <li>
      <p>
        <a href="<?php echo urlShop('goods','index',array('goods_id'=>$valrx['goods_id']));?>" target="_blank" title="<?php echo $valrx['goods_jingle'];?>">
            <img src="<?php echo thumb($valrx, 240);?>" title="<?php echo $valrx['goods_name'];?>" alt="<?php echo $valrx['goods_name'];?>" />
         </a>
      </p>
      <p>
        <span class="price">￥<b><?php echo ncPriceFormatForListsmall($valrx['goods_price']);?></b></span><span class="maket_price">￥<?php echo ncPriceFormatForListsmall($valrx['goods_marketprice']);?></span>
      </p>
    </li>
    <?php } ?>
  </ul>
</div>
