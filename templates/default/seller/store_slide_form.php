<?php defined('TTShop') or exit('Access Invalid!');?>
<?php defined('TTShop') or exit('Access Invalid!');?>
<style>
    .ncsc-store-slider li{
        border: solid 1px #E6E6E6;
    }
    .ncsc-store-slider{
        overflow: visible;
        border: none;
    }
</style>
<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="ncsc-form-default"> <div class="alert">
      <ul>
        <li>1. <?php echo $lang['store_slide_description_one'];?></li>
        <li>2. <?php printf($lang['store_slide_description_two'],intval(C('image_max_filesize'))/1024);?></li>
        <li>3. <?php echo $lang['store_slide_description_three'];?></li>
        <li>4. <?php echo $lang['store_slide_description_fore'];?></li>
      </ul>
    </div>
<!--  <div class="flexslider">
    <ul class="slides">
      <?php if(!empty($output['store_slide']) && is_array($output['store_slide'])){?>
      <?php for($i=0;$i<5;$i++){?>
      <?php if($output['store_slide'][$i] != ''){?>
      <li><a <?php if($output['store_slide_url'][$i] != '' && $output['store_slide_url'][$i] != 'https://'){?>href="<?php echo $output['store_slide_url'][$i];?>"<?php }?>><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i];?>"></a></li>
      <?php }?>
      <?php }?>
      <?php }else{?>
      <li> <img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS;?>f01.jpg"> </li>
      <li> <img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS;?>f02.jpg"> </li>
      <li> <img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS;?>f03.jpg"> </li>
      <li> <img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS;?>f04.jpg"> </li>
      <?php }?>
    </ul>
  </div>-->
  <form action="index.php?con=store_setting&fun=store_slide" id="store_slide_form" method="post" onsubmit="ajaxpost('store_slide_form', '', '', 'onerror');return false;">
    <input type="hidden" name="form_submit" value="ok" />
    <!-- 图片上传部分 -->
    <ul class="ncsc-store-slider" id="goods_images">
        <li style="width: 100%;border: none;">
            <div class="url">
                <label>轮播图</label>
            </div>
        </li>
      <?php for($i=0;$i<20;$i++){?>
      <li nc_type="handle_pic" id="thumbnail_<?php echo $i;?>">
        <div class="picture" nctype="file_<?php echo $i;?>">
          <?php if (empty($output['store_slide'][$i])) {?>
          <i class="icon-picture"></i>
          <?php } else {?>
          <img nctype="file_<?php echo $i;?>" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i];?>" />
          <?php }?>
          <input type="hidden" name="image_path[]" nctype="file_<?php echo $i;?>" value="<?php echo $output['store_slide'][$i];?>" /><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a></div>
        
        <div class="url">
          <label><?php echo $lang['store_slide_image_url'];?></label>
          <input type="text" class="text w150" name="image_url[]" value="<?php if($output['store_slide_url'][$i] == ''){  echo 'https://';}else{echo $output['store_slide_url'][$i];}?>" />
          <input type="text" class="text w150" name="title[]" placeholder="输入标题" value="<?php if($output['store_slide_title'][$i] != ''){echo $output['store_slide_url'][$i];}?>" style="display: none;"/>
        </div>
         <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i;?>" id="file_<?php echo $i;?>"/>
          </span>
          <p><i class="icon-upload-alt"></i><?php echo $lang['store_slide_image_upload'];?></p>
          </a></div></li>
      <?php } ?>
        <li style="width: 100%;border: none;">
            <div class="url">
                <label>广告位一</label>
            </div>
        </li>
        <?php for($i=20;$i<21;$i++){?>
            <li nc_type="handle_pic" id="thumbnail_<?php echo $i;?>">
                <div class="picture" nctype="file_<?php echo $i;?>">
                    <?php if (empty($output['store_slide'][$i])) {?>
                        <i class="icon-picture"></i>
                    <?php } else {?>
                        <img nctype="file_<?php echo $i;?>" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i];?>" />
                    <?php }?>
                    <input type="hidden" name="image_path[]" nctype="file_<?php echo $i;?>" value="<?php echo $output['store_slide'][$i];?>" /><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a></div>

                <div class="url">
                    <label><?php echo $lang['store_slide_image_url'];?></label>
                    <input type="text" class="text w150" name="image_url[]" value="<?php if($output['store_slide_url'][$i] == ''){  echo 'https://';}else{echo $output['store_slide_url'][$i];}?>" />
                    <input type="text" class="text w150" name="title[]" placeholder="输入标题" value="<?php if($output['store_slide_title'][$i] != ''){echo $output['store_slide_url'][$i];}?>" style="display: none;"/>
                </div>
                <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i;?>" id="file_<?php echo $i;?>"/>
          </span>
                        <p><i class="icon-upload-alt"></i><?php echo $lang['store_slide_image_upload'];?></p>
                    </a></div></li>
        <?php } ?>
        <li style="width: 100%;border: none;">
            <div class="url">
                <label>广告位二</label>
            </div>
        </li>
        <?php for($i=21;$i<25;$i++){?>
            <li nc_type="handle_pic" id="thumbnail_<?php echo $i;?>">
                <div class="picture" nctype="file_<?php echo $i;?>">
                    <?php if (empty($output['store_slide'][$i])) {?>
                        <i class="icon-picture"></i>
                    <?php } else {?>
                        <img nctype="file_<?php echo $i;?>" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i];?>" />
                    <?php }?>
                    <input type="hidden" name="image_path[]" nctype="file_<?php echo $i;?>" value="<?php echo $output['store_slide'][$i];?>" /><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a></div>

                <div class="url">
                    <label><?php echo $lang['store_slide_image_url'];?></label>
                    <input type="text" class="text w150" name="image_url[]" value="<?php if($output['store_slide_url'][$i] == ''){  echo 'https://';}else{echo $output['store_slide_url'][$i];}?>" />
                    <input type="text" class="text w150" name="title[]" placeholder="输入标题" value="<?php if($output['store_slide_title'][$i] != ''){echo $output['store_slide_title'][$i];}?>"/>
                </div>
                <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i;?>" id="file_<?php echo $i;?>"/>
          </span>
                        <p><i class="icon-upload-alt"></i><?php echo $lang['store_slide_image_upload'];?></p>
                    </a></div></li>
        <?php } ?>
        <li style="width: 100%;border: none;">
            <div class="url">
                <label>广告位三</label>
            </div>
        </li>
        <?php for($i=25;$i<28;$i++){?>
            <li nc_type="handle_pic" id="thumbnail_<?php echo $i;?>">
                <div class="picture" nctype="file_<?php echo $i;?>">
                    <?php if (empty($output['store_slide'][$i])) {?>
                        <i class="icon-picture"></i>
                    <?php } else {?>
                        <img nctype="file_<?php echo $i;?>" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i];?>" />
                    <?php }?>
                    <input type="hidden" name="image_path[]" nctype="file_<?php echo $i;?>" value="<?php echo $output['store_slide'][$i];?>" /><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a></div>

                <div class="url">
                    <label><?php echo $lang['store_slide_image_url'];?></label>
                    <input type="text" class="text w150" name="image_url[]" value="<?php if($output['store_slide_url'][$i] == ''){  echo 'https://';}else{echo $output['store_slide_url'][$i];}?>" />
                    <input type="text" class="text w150" name="title[]" placeholder="输入标题" value="<?php if($output['store_slide_title'][$i] != ''){echo $output['store_slide_url'][$i];}?>" style="display: none;"/>
                </div>
                <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i;?>" id="file_<?php echo $i;?>"/>
          </span>
                        <p><i class="icon-upload-alt"></i><?php echo $lang['store_slide_image_upload'];?></p>
                    </a></div></li>
        <?php } ?>
        <li style="width: 100%;border: none;">
            <div class="url">
                <label>循环广告位</label>
            </div>
        </li>
        <?php for($i=28;$i<86;$i+=3){?>
            <li nc_type="handle_pic" id="thumbnail_<?php echo $i;?>">
                <div class="picture" nctype="file_<?php echo $i;?>">
                    <?php if (empty($output['store_slide'][$i])) {?>
                        <i class="icon-picture"></i>
                    <?php } else {?>
                        <img nctype="file_<?php echo $i;?>" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i];?>" />
                    <?php }?>
                    <input type="hidden" name="image_path[]" nctype="file_<?php echo $i;?>" value="<?php echo $output['store_slide'][$i];?>" /><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a></div>

                <div class="url">
                    <label><?php echo $lang['store_slide_image_url'];?></label>
                    <input type="text" class="text w150" name="image_url[]" value="<?php if($output['store_slide_url'][$i] == ''){  echo 'https://';}else{echo $output['store_slide_url'][$i];}?>" />
                    <input type="text" class="text w150" name="title[]" placeholder="输入标题" value="<?php if($output['store_slide_title'][$i] != ''){echo $output['store_slide_url'][$i];}?>" style="display: none;"/>
                </div>
                <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i;?>" id="file_<?php echo $i;?>"/>
          </span>
                        <p><i class="icon-upload-alt"></i><?php echo $lang['store_slide_image_upload'];?></p>
                    </a></div></li>
            <br />
            <li nc_type="handle_pic" id="thumbnail_<?php echo $i+1;?>">
                <div class="picture" nctype="file_<?php echo $i+1;?>">
                    <?php if (empty($output['store_slide'][$i+1])) {?>
                        <i class="icon-picture"></i>
                    <?php } else {?>
                        <img nctype="file_<?php echo $i+1;?>" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i+1];?>" />
                    <?php }?>
                    <input type="hidden" name="image_path[]" nctype="file_<?php echo $i+1;?>" value="<?php echo $output['store_slide'][$i+1];?>" /><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a></div>

                <div class="url">
                    <label><?php echo $lang['store_slide_image_url'];?></label>
                    <input type="text" class="text w150" name="image_url[]" value="<?php if($output['store_slide_url'][$i+1] == ''){  echo 'https://';}else{echo $output['store_slide_url'][$i+1];}?>" />
                    <input type="text" class="text w150" name="title[]" placeholder="输入标题" value="<?php if($output['store_slide_title'][$i+1] != ''){echo $output['store_slide_url'][$i+1];}?>" style="display: none;"/>
                </div>
                <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i+1;?>" id="file_<?php echo $i+1;?>"/>
          </span>
                        <p><i class="icon-upload-alt"></i><?php echo $lang['store_slide_image_upload'];?></p>
                    </a></div></li>
            <li nc_type="handle_pic" id="thumbnail_<?php echo $i+2;?>">
                <div class="picture" nctype="file_<?php echo $i+2;?>">
                    <?php if (empty($output['store_slide'][$i+2])) {?>
                        <i class="icon-picture"></i>
                    <?php } else {?>
                        <img nctype="file_<?php echo $i+2;?>" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_SLIDE.DS.$output['store_slide'][$i+2];?>" />
                    <?php }?>
                    <input type="hidden" name="image_path[]" nctype="file_<?php echo $i+2;?>" value="<?php echo $output['store_slide'][$i+2];?>" /><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a></div>

                <div class="url">
                    <label><?php echo $lang['store_slide_image_url'];?></label>
                    <input type="text" class="text w150" name="image_url[]" value="<?php if($output['store_slide_url'][$i+2] == ''){  echo 'https://';}else{echo $output['store_slide_url'][$i+2];}?>" />
                    <input type="text" class="text w150" name="title[]" placeholder="输入标题" value="<?php if($output['store_slide_title'][$i+2] != ''){echo $output['store_slide_url'][$i+2];}?>" style="display: none;"/>
                </div>
                <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i+2;?>" id="file_<?php echo $i+2;?>"/>
          </span>
                        <p><i class="icon-upload-alt"></i><?php echo $lang['store_slide_image_upload'];?></p>
                    </a></div></li>
            <br/>
        <?php } ?>
    </ul>
   <div class="bottom"><label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['store_slide_submit'];?>"></label></div>
  </form>
</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/ajaxfileupload/ajaxfileupload.js" charset="utf-8"></script> 
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/store_slide.js" charset="utf-8"></script>
<!-- 引入幻灯片JS --> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.flexslider-min.js"></script> 
<script type="text/javascript">
var SITEURL = "<?php echo SHOP_SITE_URL;?>";
var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
var UPLOAD_SITE_URL = '<?php echo UPLOAD_SITE_URL;?>';
var ATTACH_COMMON = '<?php echo ATTACH_COMMON;?>';
var ATTACH_STORE = '<?php echo ATTACH_STORE;?>';
var SHOP_RESOURCE_SITE_URL = '<?php echo SHOP_RESOURCE_SITE_URL;?>';
</script> 
