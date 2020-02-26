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
  <form method="post" id="goods_form" action="<?php echo urlShop('store_news', 'news_update');?>">
  <input name="id" type="text" class="text w400" value="<?php echo $output['id'];?>" />
    <div class="ncsc-form-goods">
      <h3 id="demo1"><?php echo $lang['store_goods_index_goods_base_info']?></h3>
     <input name="id" type="hidden" value="<?php echo $output['news_info']['id'];?>" />
      <dl>
        <dt><i class="required">*</i>标题</dt>
        <dd>
          <input name="s_title" type="text" class="text w400" value="<?php echo $output['news_info']['s_title'];?>" />
          <span></span>
          <p class="hint">请填写文章标题</p>
        </dd>
      </dl>
       <dl>
        <dt><i class="required">*</i>分类</dt>
        <dd>
          <select name="s_catid" class="s-select">
            <?php foreach ($output['catelist'] as $k => $v){?>
            <option value="<?php echo $v['id'];?>"<?php if($v['id'] == $output['news_info']['s_catid']){?> selected="selected" <?php }?> ><?php echo $v['cate_name']; ?></option>
            <?php } ?>
          </select>
          <span></span>
          <p class="hint">请选择文章分类</p>
        </dd>
      </dl>
      <dl>
        <dt>简介</dt>
        <dd>
          <textarea name="s_summary" class="textarea h60 w400"><?php echo $output['news_info']['s_summary'];?></textarea>
          <span></span>
          <p class="hint">文章简介最长不能超过140个汉字</p>
        </dd>
      </dl>
    	<dl>
        <dt><i class="required">*</i>跳转链接</dt>
        <dd>
          <input name="s_url" type="text" class="text w400" value="<?php echo $output['news_info']['s_url'];?>" />
          <span></span>
          <p class="hint">请填写文章跳转链接</p>
        </dd>
      </dl>
       <dl>
        <dt><i class="required">*</i>文章缩略图</dt>
        <dd>
          <div class="ncsc-goods-default-pic">
            <div class="goodspic-uplaod">
              <div class="upload-thumb"> <img nctype="s_thumb" src="<?php echo $output['news_info']['s_thumb'];?>"/> </div>
              <input type="hidden" name="image_path" id="image_path" nctype="s_thumb" value="<?php echo $output['news_info']['s_thumb'];?>" />
              <span></span>
              <div class="handle">
                <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
                  <input type="file" hidefocus="true" size="1" class="input-file" name="s_thumb" id="s_thumb">
                  </span>
                  <p><i class="icon-upload-alt"></i>图片上传</p>
                  </a> </div>
            </div>
          </div>
         
        </dd>
      </dl>

      <dl>
        <dt><i class="required">*</i>点击次数</dt>
        <dd>
          <input name="s_click" type="text" class="text w400" value="<?php echo $output['news_info']['s_click'];?>" />
          <span></span>
          <p class="hint">请填写点击次数</p>
        </dd>
      </dl>
      <dl>
        <dt><i class="required">*</i>排序</dt>
        <dd>
          <input name="s_sort" type="text" class="text w400" value="<?php echo $output['news_info']['s_sort'];?>" />
          <span></span>
          <p class="hint">设置排序可以改变文章展示</p>
        </dd>
      </dl>

      <dl>
        <dt><i class="required">*</i>状态</dt>
        <dd>
          <input name="s_status" type="radio"  value="0" <?php if($output['news_info']['s_status'] ==1){?> checked="true" <?php }?>/>开启
          <input name="s_status" type="radio"  value="1" <?php if($output['news_info']['s_status'] ==0){?> checked="true" <?php }?> />关闭
          <span></span>
          <p class="hint">请设置网站状态</p>
        </dd>
      </dl>

            <dl>
        <dt>发布时间</dt>
        <dd>
          <ul class="ncsc-form-radio-list">
            <li>
              <label>
                <input name="g_state" value="1" type="radio" <?php if ($output['news_info']['g_state'] == 1 ) {?>checked="true"<?php }?> />
                立即发布 </label>
            </li>
            <li>
              <label>
                <input name="g_state" value="0" type="radio" nctype="auto"  <?php if ($output['news_info']['g_state'] == 0 ) {?>checked="true"<?php }?> />
              发布时间 </label>
              <input type="text" class="w80 text" name="starttime"  id="starttime" value="<?php echo $output['datetime'];?>" />
              <select  name="starttime_H" id="starttime_H">
                <?php foreach ($output['hour_array'] as $val){?>
                <option value="<?php echo $val;?>" <?php $sign_H = 0;if( $sign_H != 1 && $output['dateHtime'] == $val){?>selected="selected"<?php $sign_H = 1;}?>><?php echo $val;?></option>
                <?php }?>
              </select>
              时
              <select  name="starttime_i" id="starttime_i">
                <?php foreach ($output['minute_array'] as $val){?>
                <option value="<?php echo $val;?>" <?php $sign_i = 0;if($sign_i != 1 &&  $output['dateItime'] == $val){?>selected="selected"<?php $sign_i = 1;}?>><?php echo $val;?></option>
                <?php }?>
              </select>
              分</li>
      
          </ul>
        </dd>
      </dl>
      
    
    
      <dl>
        <dt><?php echo $lang['store_goods_index_goods_desc'].$lang['nc_colon'];?></dt>
        <dd id="ncProductDetails">
          <div class="tabs">
            <ul class="ui-tabs-nav">
              <li class="ui-tabs-selected"><a href="#panel-1"><i class="icon-desktop"></i> 电脑端</a></li>
              <!--<li class="selected"><a href="#panel-2"><i class="icon-mobile-phone"></i>手机端</a></li>-->
            </ul>
            <div id="panel-1" class="ui-tabs-panel">
              <?php showEditor('s_content',$output['news_info']['s_content'],'100%','480px','visibility:hidden;',"true");?>
             
            </div>
 
          </div>
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
<script type="text/javascript">
var SITEURL = "<?php echo SHOP_SITE_URL; ?>";
var DEFAULT_GOODS_IMAGE = "<?php echo thumb(array(), 60);?>";
var SHOP_RESOURCE_SITE_URL = "<?php echo SHOP_RESOURCE_SITE_URL;?>";

$(function(){
  // 定时发布时间
    $('#starttime').datepicker({dateFormat: 'yy-mm-dd'});
    $('input[name="g_state"]').click(function(){
        if($(this).attr('nctype') == 'auto'){
            $('#starttime').removeAttr('disabled').css('background','');
            $('#starttime_H').removeAttr('disabled').css('background','');
            $('#starttime_i').removeAttr('disabled').css('background','');
        }else{
            $('#starttime').attr('disabled','disabled').css('background','#E7E7E7 none');
            $('#starttime_H').attr('disabled','disabled').css('background','#E7E7E7 none');
            $('#starttime_i').attr('disabled','disabled').css('background','#E7E7E7 none');
        }
    });
   /* 商品图片ajax上传 */
    $('#s_thumb').fileupload({
        dataType: 'json',
        url: SITEURL + '/index.php?con=store_news&fun=thumb_upload&upload_type=uploadedfile',
        formData: {name:'s_thumb',id:"<?php echo $output['news_info']['id'];?>"},
        add: function (e,data) {
          $('img[nctype="s_thumb"]').attr('src', SHOP_TEMPLATES_URL + '/images/loading.gif');
            data.submit();
        },
        done: function (e,data) {
            var param = data.result;
            if (typeof(param.error) != 'undefined') {
              
                $('img[nctype="s_thumb"]').attr('src',DEFAULT_GOODS_IMAGE);
            } else {
                $('input[nctype="s_thumb"]').val(param.name);
                $('img[nctype="s_thumb"]').attr('src',param.thumb_name);
            }
        }
    });

	 
});


</script> 
