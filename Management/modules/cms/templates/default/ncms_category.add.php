<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?con=ncms_category" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3>栏目管理 - <?php echo $lang['nc_new'];?></h3>
        <h5><?php echo $lang['nc_ncms_model_field_manage_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="add_form" method="post" action="index.php?con=ncms_category&fun=ncms_category_save" enctype="multipart/form-data">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="name"><em>*</em><?php echo $lang['ncms_model_name'];?></label>
        </dt>

        <dd class="opt">
              <select name="info[modelid]" id="modelid">
                  <option value='' <?php if(empty($output['parentid_modelid'])){?>} selected <?php }?>>请选择模型</option>
                  <?php foreach($output['models'] as $vt){?>
                    <option value="<?php echo $vt['modelid'];?>" <?php if($output['parentid_modelid'] == $vt['modelid']){?> selected <?php }?>><?php echo $vt['name'];?></option>
                  <?php }?>
         
                </select>
          <span class="err"></span>
          <p class="notic"><?php echo $lang['ncms_model_error'];?></p>
        </dd>
      </dl>

       <dl class="row">
        <dt class="tit">
          <label for="name"><em>*</em><?php echo $lang['ncms_model_name'];?></label>
        </dt>
        <dd class="opt">
          <select name="info[parentid]" id="parentid">
                  <option value='0'>≡ 作为一级栏目 ≡</option>
                  <?php echo $output['category'];?>
          </select>
          <span class="err"></span>
          <p class="notic"><?php echo $lang['ncms_model_error'];?></p>
        </dd>
      </dl>
   

        <dl class="row">
        <dt class="tit">
          <label for="tablename"><em>*</em>是否显示</label>
        </dt>
        <dd class="opt">
          <input type='radio' name='ismenu' value='1' checked >
          显示
         <input type='radio' name='ismenu' value='0'  >
          不显示
          <span class="err"></span>
          <p class="notic">是否在前台菜单显示</p>
        </dd>
      </dl>

      

      <dl class="row" id="batch_add" style="display:none">
        <dt class="tit">
          <label for="tablename">栏目名称</label>
        </dt>
        <dd class="opt">
        <textarea name="batch_add" maxlength="255" style="width:300px;height:150px;"></textarea><br/>例如：<br/>

          <span class="err"></span>
          <p class="notic">国内新闻|china<br/>
国际新闻|world</p>
        </dd>
      </dl>

    

      <dl class="row" id="normal_add">
        <dt class="tit">
          <label for="tablename"><em>*</em>栏目名称</label>
        </dt>
        <dd class="opt">
          <input type="text" name="info[catname]" class="input-txt" value="" id="catname">
          <span class="err"></span>
          <p class="notic">请填写栏目名称</p>
        </dd>
      </dl>

 

        <dl class="row">
        <dt class="tit">
          <label for="tablename">栏目缩略图</label>
        </dt>
       <dd class="opt">
          <div class="input-file-show">  <span class="type-file-box">
            <input name="textfield" id="textfield1" class="type-file-text" type="text">
            <input name="button" id="button1" value="选择上传..." class="type-file-button" type="button">
            <input type="file" class="type-file-file" id="file_adv_pic" name="image" size="30" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效"/>
            </span>
       
          </div>
          <span class="err"></span>
          <p class="notic">系统支持的图片格式为:gif,jpg,jpeg,png</p>
        </dd>
      </dl>

  <!--      <dl class="row">
        <dt class="tit">
          <label for="tablename">是否终极栏目</label>
        </dt>
        <dd class="opt">
         <input name="info[child]" id="child" value="0" type="checkbox">
          <span class="err"></span>
          <p class="notic">终极栏目才可以添加信息</p>
        </dd>
      </dl> -->

      <dl class="row">
        <dt class="tit">
          <label for="tablename">栏目简介</label>
        </dt>
        <dd class="opt">
          <textarea name="info[description]" maxlength="255" style="width:300px;height:60px;"></textarea>
          <span class="err"></span>
          <p class="notic">请填写栏目简介</p>
        </dd>
      </dl>
  
      <dl class="row">
        <dt class="tit">
          <label for="tablename">指定栏目地址</label>
        </dt>
        <dd class="opt">
          <input name="setting[seturl]" id="seturl" class="input-txt" value="" type="text">
          <span class="err"></span>
          <p class="notic">请填写指定栏目地址名称</p>
        </dd>
      </dl>




      <div class="bot"><a id="submit" href="javascript:void(0)" class="ncap-btn-big ncap-btn-green"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript">


 
$(document).ready(function(){
  $("#file_adv_pic").change(function(){
      $("#textfield1").val($("#file_adv_pic").val());
    });
      $("#submit").click(function(){
          if($("#add_form").valid()){
            $("#add_form").submit();
          }
      });
      $('#add_form').validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
            'info[modelid]': {
                required : true,
               
            },
         
            'info[catname]':{
              required:true,
            }
        },
        messages : {
            'info[modelid]': {
                required : "<i class='fa fa-exclamation-circle'></i>请选择模型!" ,
                
            },
         
             'info[catname]': {
                required : "<i class='fa fa-exclamation-circle'></i>请填写栏目名称!" ,
                
            }
        }
    });
 });
    

 
</script>