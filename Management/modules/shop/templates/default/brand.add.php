<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?con=brand&fun=brand" title="返回品牌列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['brand_index_brand'];?> - <?php echo $lang['nc_new'];?></a></h3>
        <h5><?php echo $lang['brand_index_brand_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="brand_form" method="post"  enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label><em>*</em><?php echo $lang['brand_index_name'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="brand_name" id="brand_name" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label><em>*</em>名称首字母</label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="brand_initial" id="brand_initial" class="input-txt">
          <span class="err"></span>
          <p class="notic">商家发布商品快捷搜索品牌使用</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><?php echo $lang['brand_index_class'];?></dt>
        <dd class="opt">
          <div id="gcategory">
            <input type="hidden" value="" name="class_id" class="mls_id">
            <input type="hidden" value="" name="brand_class" class="mls_name">
            <select class="class-select">
              <option value="0"><?php echo $lang['nc_please_choose'];?></option>
              <?php if(!empty($output['gc_list'])){ ?>
              <?php foreach($output['gc_list'] as $k => $v){ ?>
              <?php if ($v['gc_parent_id'] == 0) {?>
              <option value="<?php echo $v['gc_id'];?>"><?php echo $v['gc_name'];?></option>
              <?php } ?>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
          <span class="err"></span>
          <p class="notic"><?php echo $lang['brand_index_class_tips'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><?php echo $lang['brand_index_pic_sign'];?></dt>
        <dd class="opt">
          <div class="input-file-show"><span class="type-file-box">
            <input class="type-file-file type-file-file_one" id="_pic" name="_pic" type="file" size="30" hidefocus="true" title="点击按钮选择文件并提交表单后上传生效">
            <input type="text" name="brand_pic" id="brand_pic" class="type-file-text" />
            <input type="button" name="button" id="button" value="选择上传..." class="type-file-button" />
            </span></div>
          <span class="err"></span>
          <p class="notic"><?php echo $lang['brand_index_upload_tips'].$lang['brand_add_support_type'];?>gif,jpg,png</p>
        </dd>
      </dl>

    

      <dl class="row" id="adv_pic">
        <dt class="tit">
          <input type="hidden" name="mark" value="0">
          <label for="file_adv_pic">band背景大图</label>
        </dt>
        <dd class="opt">
          <div class="input-file-show">  <span class="type-file-box">
            <input name="textfield" id="textfield1" class="type-file-text" type="text">
            <input name="button" id="button1" value="选择上传..." class="type-file-button" type="button">
            <input type="file" class="type-file-file" id="file_adv_pic" name="brand_bigpic" size="30" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效"/>
              </span>
            <input type="hidden" name="pic_ori" value="<?php echo $pic;?>">
          </div>
          <span class="err"></span>
          <p class="notic">品牌LOGO尺寸要求宽度为262像素，高度为262像素、比例为1:1的图片；gif,jpg,png</p>
        </dd>
      </dl>

            <dl class="row">
        <dt class="tit">
          <label><em>*</em>品牌简介</label>
        </dt>
        <dd class="opt">
         <textarea name="brand_introduction" rows="6" class="tarea" id="brand_introduction"><?php echo $output['brand_array']['brand_introduction'];?></textarea>

          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">展示方式</dt>
        <dd class="opt">
          <input id="show_type_0" type="radio" checked="checked" value="0" style="margin-bottom:6px;" name="show_type" />
          <label for="show_type_0">图片</label>
          <input id="show_type_1" type="radio" value="1" style="margin-bottom:6px;" name="show_type" />
          <label for="show_type_1">文字</label>
          <span class="err"></span>
          <p class="notic">在“全部品牌”页面的展示方式，如果设置为“图片”则显示该品牌的“品牌图片标识”，如果设置为“文字”则显示该品牌的“品牌名”</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><?php echo $lang['brand_add_if_recommend'];?></dt>
        <dd class="opt">
          <div class="onoff">
            <label for="brand_recommend1" class="cb-enable"><?php echo $lang['nc_yes'];?></label>
            <label for="brand_recommend0" class="cb-disable selected"><?php echo $lang['nc_no'];?></label>
            <input id="brand_recommend1" name="brand_recommend" <?php if($output['brand_array']['brand_recommend'] == '1'){ ?>checked="checked"<?php } ?>  value="1" type="radio">
            <input id="brand_recommend0" name="brand_recommend" <?php if($output['brand_array']['brand_recommend'] == '0'){ ?>checked="checked"<?php } ?> value="0" type="radio">
          </div>
          <p class="notic"><?php echo $lang['brand_index_recommend_tips'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><?php echo $lang['nc_sort'];?></dt>
        <dd class="opt">
          <input type="text" value="0" name="brand_sort" id="brand_sort" class="input-txt">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['brand_add_update_sort'];?></p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ajaxfileupload/ajaxfileupload.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script> 
<script>
//裁剪图片后返回接收函数
function call_back(picname){
	$('#brand_pic').val(picname);
	$('#view_img').attr('src','<?php echo UPLOAD_SITE_URL.'/'.ATTACH_BRAND;?>/'+picname);
}
$(function(){
	$("#submitBtn").click(function(){
	    if($("#brand_form").valid()){
	     $("#brand_form").submit();
		}
	});
  $("#file_adv_pic").change(function(){
      $("#textfield1").val($("#file_adv_pic").val());
  });
	$('.type-file-file_one').change(uploadChange);
	function uploadChange(){
		var filepath=$(this).val();
		var extStart=filepath.lastIndexOf(".");
		var ext=filepath.substring(extStart,filepath.length).toUpperCase();
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("file type error");
			$(this).attr('value','');
			return false;
		}
		if ($(this).val() == '') return false;
		ajaxFileUpload();
	}


	function ajaxFileUpload()
	{
		$.ajaxFileUpload
		(
			{
				url : '<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=pic_upload&form_submit=ok&uploadpath=<?php echo ATTACH_BRAND;?>',
				secureuri:false,
				fileElementId:'_pic',
				dataType: 'json',
				success: function (data, status)
				{
					if (data.status == 1){
						ajax_form('cutpic','<?php echo $lang['nc_cut'];?>','<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=pic_cut&type=brand&x=150&y=50&resize=1&ratio=3&url='+data.url,690);
					}else{
						alert(data.msg);
					}$('.type-file-file_one').bind('change',uploadChange);
				},
				error: function (data, status, e)
				{
					alert('上传失败');$('.type-file-file_one').bind('change',uploadChange);
				}
			}
		)
	};
	jQuery.validator.addMethod("initial", function(value, element) {
		return /^[A-Za-z0-9]$/i.test(value);
	}, "");
	$("#brand_form").validate({
		errorPlacement: function(error, element){
			var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
            brand_name : {
                required : true,
                remote   : {
                    url :'index.php?con=brand&fun=ajax&branch=check_brand_name',
                    type:'get',
                    data:{
                        brand_name : function(){
                            return $('#brand_name').val();
                            },
                            id  : ''
                    }
                }
            },
            brand_initial : {
                initial  : true
            },
            brand_sort : {
                number   : true
            }
        },
        messages : {
            brand_name : {
                required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['brand_add_name_null'];?>',
                remote   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['brand_add_name_exists'];?>'
            },
            brand_initial : {
                initial : '<i class="fa fa-exclamation-circle"></i>请填写正确首字母'
            },
            brand_sort  : {
                number   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['brand_add_sort_int'];?>'
            }
        }
	});	
});

gcategoryInit('gcategory');
</script> 
