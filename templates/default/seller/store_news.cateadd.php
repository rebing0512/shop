<?php defined('TTShop') or exit('Access Invalid!');?>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.charCount.js"></script>
<!--[if lt IE 8]>
  <script src="<?php echo RESOURCE_SITE_URL;?>/js/json2.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<style type="text/css">
#fixedNavBar { filter:progid:DXImageTransform.Microsoft.gradient(enabled='true',startColorstr='#CCFFFFFF', endColorstr='#CCFFFFFF');background:rgba(255,255,255,0.8); width: 90px; margin-left: 600px; border-radius: 4px; position: fixed; z-index: 999; top: 172px; left: 50%;}
#fixedNavBar h3 { font-size: 12px; line-height: 24px; text-align: center; margin-top: 4px;}
#fixedNavBar ul { width: 80px; margin: 0 auto 5px auto;}
#fixedNavBar li { margin-top: 5px;}
#fixedNavBar li a { font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; background-color: #F5F5F5; color: #999; text-align: center; display: block;  height: 20px; border-radius: 10px;}
#fixedNavBar li a:hover { color: #FFF; text-decoration: none; background-color: #27a9e3;}
</style>
<div class="item-publish">
  <form method="post" id="goods_form" action="<?php echo urlShop('store_news', 'news_catesave');?>">
    <div class="ncsc-form-goods">
      <h3 id="demo1"><?php echo $lang['store_goods_index_goods_base_info']?></h3>
     
      <dl>
        <dt><i class="required">*</i>分类名称</dt>
        <dd>
          <input name="cate_name" type="text" class="text w400" value="" />
          <span></span>
          <p class="hint">请填写分类名称</p>
        </dd>
      </dl>
      <dl>
        <dt><i class="required">*</i>跳转链接</dt>
        <dd>
          <input name="cate_jump" type="text" class="text w400" value="" />
          <span></span>
          <p class="hint">请填写分类跳转链接</p>
        </dd>
      </dl>
      <dl>
        <dt><i class="required">*</i>排序</dt>
        <dd>
          <input name="cate_sort" type="text" class="text w400" value="" />
          <span></span>
          <p class="hint">设置排序可以改变文章展示</p>
        </dd>
      </dl>

      <dl>
        <dt><i class="required">*</i>状态</dt>
        <dd>
          <input name="cate_display" type="radio"  value="0" checked="true" />开启
          <input name="cate_display" type="radio"  value="1" />关闭
          <span></span>
          <p class="hint">请设置网站状态</p>
        </dd>
      </dl>
    </div>
    <div class="bottom tc hr32">
      <label class="submit-border">
        <input type="submit" class="submit" value="提交 "/>
      </label>
    </div>
  </form>
</div>
