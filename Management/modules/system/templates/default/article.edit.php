<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?con=article&fun=article" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['article_index_manage'];?> - <?php echo $lang['nc_edit'];?>文章“<?php echo $output['article_array']['article_title'];?>”</h3>
        <h5><?php echo $lang['article_index_manage_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="article_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="article_id" value="<?php echo $output['article_array']['article_id'];?>" />
    <input type="hidden" name="ref_url" value="<?php echo getReferer();?>" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="article_title"><em>*</em><?php echo $lang['article_index_title'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['article_array']['article_title'];?>" name="article_title" id="article_title" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="cate_id"><em>*</em><?php echo $lang['article_add_class'];?></label>
        </dt>
        <dd class="opt">
          <select name="ac_id" id="ac_id">
            <option value=""><?php echo $lang['nc_please_choose'];?></option>
            <?php if(!empty($output['parent_list']) && is_array($output['parent_list'])){ ?>
            <?php foreach($output['parent_list'] as $k => $v){ ?>
            <option <?php if($output['article_array']['ac_id'] == $v['ac_id']){ ?>selected='selected'<?php } ?> value="<?php echo $v['ac_id'];?>"><?php echo $v['ac_name'];?></option>
            <?php } ?>
            <?php } ?>
          </select>
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row" nctype="article_position" style="display: none">
        <dt class="tit">
          <label>显示位置:</label>
        </dt>
        <dd class="opt">
          <input id="article_position1" name="article_position" <?php if($output['article_array']['article_position'] == '1'){ ?>checked="checked"<?php } ?> value="1" type="radio">
          <label for="article_position1" ><span>商城前台</span></label>
          <input id="article_position2" name="article_position" <?php if($output['article_array']['article_position'] == '2'){ ?>checked="checked"<?php } ?> value="2" type="radio">
          <label for="article_position2" ><span>买家中心</span></label>
          <input id="article_position3" name="article_position" <?php if($output['article_array']['article_position'] == '3'){ ?>checked="checked"<?php } ?> value="3" type="radio">
          <label for="article_position3" ><span>商家中心</span></label>
          <input id="article_position4" name="article_position" <?php if($output['article_array']['article_position'] == '4'){ ?>checked="checked"<?php } ?> value="4" type="radio">
          <label for="article_position4" ><span>全站</span></label>
        </dd>
      </dl>
        <dl class="row">
            <dt class="tit">
                <label for="articleForm">作者</label>
            </dt>
            <dd class="opt">
                <input type="text" value="<?php echo $output['article_array']['article_author'];?>" name="article_author" id="article_author" class="input-txt">
                <span class="err"></span>
                <p class="notic"></p>
            </dd>
        </dl>
      <dl class="row">
        <dt class="tit">
          <label for="article_url"><?php echo $lang['article_add_url'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['article_array']['article_url'];?>" name="article_url" id="article_url" class="input-txt">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['article_add_url_tip'];?></p>
        </dd>
      </dl>
<!-- ================================================================ -->
      <dl class="row" id="adv_pic">
        <dt class="tit">
          <input type="hidden" name="mark" value="0">
          <label for="file_adv_pic">缩略图</label>
        </dt>
        <dd class="opt">
          <div class="input-file-show"> <span class="show"> <a class="nyroModal" href="<?php echo UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$output['article_array']['article_img'];?>" rel="gal"> <i class="fa fa-picture-o" onmouseout="toolTip()" onmouseover="toolTip('<img src=<?php echo UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$output['article_array']['article_img'];?>>')"></i> </a> </span> <span class="type-file-box">
            <input name="textfield" id="textfield1" class="type-file-text" type="text">
            <input name="button" id="button1" value="选择上传..." class="type-file-button" type="button">
            <input type="file" class="type-file-file" id="file_adv_pic" name="adv_pic" size="30" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效"/>
            </span>
            <input type="hidden" name="pic_ori" value="<?php echo $output['article_array']['article_img'];?>">
            <input type="hidden" name="pic_ori2" value="<?php echo $output['article_array']['article_thumb'];?>">
          </div>
          <span class="err"></span>
          <p class="notic">系统支持的图片格式为:gif,jpg,jpeg,png</p>
        </dd>
      </dl>
<!-- ================================================================ -->
          <dl class="row">
        <dt class="tit">
          <label for="articleForm">文章摘要</label>
        </dt>
        <dd class="opt">
          <textarea type="text"  name="article_summary" id="article_summary" class="tarea"><?php echo $output['article_array']['article_summary'];?></textarea>
          <span class="err"></span>
          <p class="notic">请设置文章摘要</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="if_show"><?php echo $lang['article_add_show'];?></label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="article_show1" class="cb-enable <?php if($output['article_array']['article_show'] == '1'){ ?>selected<?php } ?>" ><?php echo $lang['nc_yes'];?></label>
            <label for="article_show0" class="cb-disable <?php if($output['article_array']['article_show'] == '0'){ ?>selected<?php } ?>" ><?php echo $lang['nc_no'];?></label>
            <input id="article_show1" name="article_show" <?php if($output['article_array']['article_show'] == '1'){ ?>checked="checked"<?php } ?>  value="1" type="radio">
            <input id="article_show0" name="article_show" <?php if($output['article_array']['article_show'] == '0'){ ?>checked="checked"<?php } ?> value="0" type="radio">
          </div>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><?php echo $lang['nc_sort'];?></dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['article_array']['article_sort'];?>" name="article_sort" id="article_sort" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
         <dl class="row">
        <dt class="tit"><?php echo $lang['nc_view'];?></dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['article_array']['article_view'];?>" name="article_view" id="article_view" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">点赞人数</dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['article_array']['article_zan'];?>" name="article_zan" id="article_zan" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
       <dl class="row">
        <dt class="tit">
          <label for="article_time"><em>*</em>添加时间</label>
        </dt>
        <dd class="opt">
          <input type="text" name="article_time" id="article_time" class="txt" value="<?php echo date('Y-m-d',$output['article_array']['article_time']) ?>">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label><em>*</em><?php echo $lang['article_add_content'];?></label>
        </dt>
        <dd class="opt">
          <?php showEditor('article_content',$output['article_array']['article_content']);?>
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><?php echo $lang['article_add_upload'];?></dt>
        <dd class="opt" id="divComUploadContainer">
          <div class="input-file-show"><span class="type-file-box">
            <input class="type-file-file" id="fileupload" name="fileupload" type="file" size="30" multiple hidefocus="true" title="点击按钮选择文件上传">
            <input type="text" name="text" id="text" class="type-file-text" />
            <input type="button" name="button" id="button" value="选择上传..." class="type-file-button" />
            </span></div>
          <div id="thumbnails" class="ncap-thumb-list">
            <h5><i class="fa fa-exclamation-circle"></i>上传后的图片可以插入到富文本编辑器中使用，无用附件请手动删除，如不处理系统会始终保存该附件图片。</h5>
            <ul>
              <?php if(is_array($output['file_upload'])){?>
              <?php foreach($output['file_upload'] as $k => $v){ ?>
              <li id="<?php echo $v['upload_id'];?>">
                <input type="hidden" name="file_id[]" value="<?php echo $v['upload_id'];?>" />
                <div class="thumb-list-pics"><a href="javascript:void(0);"><img src="<?php echo $v['upload_path'];?>" alt="<?php echo $v['file_name'];?>"/></a></div>
                <a href="javascript:del_file_upload('<?php echo $v['upload_id'];?>');" class="del" title="<?php echo $lang['nc_del'];?>">X</a><a href="javascript:insert_editor('<?php echo $v['upload_path'];?>');" class="inset"><i class="fa fa-trash"></i>插入图片</a> </li>
              <?php } ?>
              <?php } ?>
            </ul>
          </div>
        </dd>
      </dl>
      <dl class="row">
       <dt class="tit">小编推荐商品(填写id)</dt>
        <dd class="opt">
         <input type="text" value="<?php echo $output['article_array']['article_goods_id']?>" name="article_goods_id" id="goods_id" class="input-txt">
         <div class="mb-item-edit-content">
          <div class="search-goods" style="margin-left:0px;">
          <h3>选择商品添加(商品关键字)</h3>
   
          <input id="txt_goods_name" type="text" class="txt w200" name="">
          <a id="btn_mb_special_goods_search" class="ncap-btn" href="javascript:;" style="vertical-align: top; margin-left: 5px;">搜索</a>
          <div id="mb_special_goods_list"></div>
        </div>
        </div>
        </dd>
        
        
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js" type="text/javascript"></script> 
<script>

  $(document).ready(function(){
        $('#btn_mb_special_goods_search').on('click', function() {
            var url = '<?php echo urlAdminMobile('mb_special', 'goods_list');?>';
            var keyword = $('#txt_goods_name').val();
            var goods_type = 0;
            if(keyword) {
                $('#mb_special_goods_list').load(url + '&' + $.param({keyword: keyword,goods_type:goods_type}));
            }
        });

        $('#mb_special_goods_list').on('click', '[nctype="btn_add_goods"]', function() {

            var goods_id = $(this).attr('data-goods-id');
          
            $('#goods_id').val(goods_id);
        });
    });
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#article_form").valid()){
     $("#article_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#ac_id').on('change',function(){
		if($(this).val() == '1') {
			$('dl[nctype="article_position"]').show();
		}else{
			$('dl[nctype="article_position"]').hide();
		}
	});
	<?php if($output['article_array']['ac_id'] == '1'){ ?>
	$('dl[nctype="article_position"]').show();
    <?php } ?>
	$('#article_form').validate({
        errorPlacement: function(error, element){
			var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
            article_title : {
                required   : true
            },
			ac_id : {
                required   : true
            },
			article_url : {
				url : true
            },
			article_content : {
                required   : function(){
                    return $('#article_url').val() == '';
                }
            },
            article_sort : {
                number   : true
            }
        },
        messages : {
            article_title : {
                required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_add_title_null'];?>'
            },
			ac_id : {
                required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_add_class_null'];?>'
            },
			article_url : {
				url : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_add_url_wrong'];?>'
            },
			article_content : {
                required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_add_content_null'];?>'
            },
            article_sort  : {
                number   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['article_add_sort_int'];?>'
            }
        }
    });
    // 图片上传
    $('#fileupload').each(function(){
        $(this).fileupload({
            dataType: 'json',
            url: 'index.php?con=article&fun=article_pic_upload&item_id=<?php echo $output['article_array']['article_id'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile(data.result);
                }
            }
        });
    });
});
function add_uploadedfile(file_data)
{
	var newImg = '<li id="' + file_data.file_id + '"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="thumb-list-pics"><a href="javascript:void(0);"><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '"/></a></div><a href="javascript:del_file_upload(' + file_data.file_id + ');" class="del" title="<?php echo $lang['nc_del'];?>">X</a><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/';?>' + file_data.file_name + '\');" class="inset"><i class="fa fa-clipboard"></i>插入图片</a></li>';
    $('#thumbnails > ul').prepend(newImg);
}
function insert_editor(file_path){
	KE.appendHtml('article_content', '<img src="'+ file_path + '" alt="'+ file_path + '">');
}
function del_file_upload(file_id)
{
    if(!window.confirm('<?php echo $lang['nc_ensure_del'];?>')){
        return;
    }
    $.getJSON('index.php?con=article&fun=ajax&branch=del_file_upload&file_id=' + file_id, function(result){
        if(result){
            $('#' + file_id).remove();
        }else{
            alert('<?php echo $lang['article_add_del_fail'];?>');
        }
    });
}
</script>


<!-- ============================================= -->
<script type="text/javascript">
$(function(){
      $('#article_time').datepicker({dateFormat: 'yy-mm-dd'});

    $("#file_adv_pic").change(function(){
  $("#textfield1").val($("#file_adv_pic").val());
    });

  var textButton="<input type='text' name='textfield' id='textfield3' class='type-file-text' /><input type='button' name='button' id='button3' value='选择上传...' class='type-file-button' />"
    $(textButton).insertBefore("#file_flash_swf");
    $("#file_flash_swf").change(function(){
  $("#textfield3").val($("#file_flash_swf").val());
    });
    $('#ap_id').val('<?php echo $_GET['ap_id'];?>');
    $('#ap_id').change();
});
</script>
<!-- ============================================= -->