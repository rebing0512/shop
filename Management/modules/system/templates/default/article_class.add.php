<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?con=article_class&fun=article_class" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['article_class_index_class'];?> - <?php echo $lang['nc_new'];?></h3>
        <h5><?php echo $lang['article_class_index_class_subhead'];?></h5>
      </div>
    </div>
  </div>

  <form id="article_class_form" method="post"  enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="ac_name"><em>*</em><?php echo $lang['article_class_index_name'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="ac_name" id="ac_name" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
     <dl class="row">
        <dt class="tit">
          <label for="parent_id"><?php echo $lang['article_class_add_sup_class'];?></label>
        </dt>
        <dd class="opt">
          <select name="ac_parent_id" id="ac_parent_id">
            <option value="0"><?php echo $lang['nc_please_choose'];?></option>
            <?php if(!empty($output['parent_list']) && is_array($output['parent_list'])){ ?>
            <?php foreach($output['parent_list'] as $k => $v){ ?>
            <option <?php if($output['ac_parent_id'] == $v['ac_id']){ ?>selected='selected'<?php } ?> value="<?php echo $v['ac_id'];?>"><?php echo $v['ac_name'];?></option>
            <?php } ?>
            <?php } ?>
          </select>
          <span class="err"></span>
          <p class="notic"><?php echo $lang['article_class_add_sup_class_notice'];?></p>
        </dd>
      </dl> 
        <dl class="row">
        <dt class="tit">
          <label for="article_logo">分类logo</label>
        </dt>
        <dd class="opt">
          <div class="input-file-show"><span class="show"><a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_ARTICLE_LOGO.DS.$output['class_array']['article_logo']);?>"> <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.$output['list_setting']['mobile_logo']);?>>')" onMouseOut="toolTip()"/></i> </a></span><span class="type-file-box">
            <input type="text" name="textfield" id="textfield1" class="type-file-text" />
            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button" />
            <input class="type-file-file" id="article_logo" name="article_logo" type="file" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
            </span></div>
          <span class="err"></span>
          <p class="notic">默认网站LOGO,通用头部显示，最佳显示尺寸为25*25像素</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="ac_sort"><?php echo $lang['nc_sort'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="255" name="ac_sort" id="ac_sort" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#article_class_form").valid()){
     $("#article_class_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#article_class_form').validate({
        errorPlacement: function(error, element){
			var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
            ac_name : {
                required : true,
                remote   : {                
                url :'index.php?con=article_class&fun=ajax&branch=check_class_name',
                type:'get',
                data:{
                    ac_name : function(){
                        return $('#ac_name').val();
                    },
                    ac_parent_id : function() {
                        return $('#ac_parent_id').val();
                    },
                    ac_id : ''
                  }
                }
            },
            ac_sort : {
                number   : true
            }
        },
        messages : {
            ac_name : {
                required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_class_add_name_null'];?>',
                remote   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_class_add_name_exists'];?>'
            },
            ac_sort  : {
                number   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_class_add_sort_int'];?>'
            }
        }
    });
});
</script>