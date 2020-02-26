<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?con=ncms_model&fun=ncms_model_list" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['nc_ncms_model_manage'];?> - <?php echo $lang['nc_edit'];?></h3>
        <h5><?php echo $lang['nc_ncms_model_manage_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="edit_form" method="post" action="index.php?con=ncms_model&fun=ncms_model_update">
  <input type="hidden" name="modelid" value="<?php echo $output['data']['modelid'];?>">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="name"><em>*</em><?php echo $lang['ncms_model_name'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['data']['name'];?>" name="name" id="name" class="input-txt">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['ncms_model_error'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="tablename"><em>*</em><?php echo $lang['ncms_model_tablename'];?></label>
        </dt>
        <dd class="opt">
          <input id="tablename" name="tablename" type="text" class="input-txt" value="<?php echo $output['data']['tablename'];?>" />
          <span class="err"></span>
          <p class="notic"><?php echo $lang['ncms_model_table_error'];?></p>
        </dd>
      </dl>

       <dl class="row">
        <dt class="tit">
          <label for="tablename"><?php echo $lang['ncms_model_description'];?></label>
        </dt>
         <dd class="opt">
          <textarea class="tarea" rows="6" name="description" id="description"><?php echo $output['data']['description'];?></textarea>
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <div class="bot"><a id="submit" href="javascript:void(0)" class="ncap-btn-big ncap-btn-green"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#submit").click(function(){
        $("#edit_form").submit();
    });
      //自定义 邮政编码验证    
    jQuery.validator.addMethod("isenglish", function(value, element) {    
      var zip = /^[A-Za-z]+$/;    
      return this.optional(element) || (zip.test(value));    
    }, "请正确的模型名称!");        
    $('#add_form').validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
            name: {
                required : true,
                maxlength : 20
            },
            tablename: {
                isenglish : true,
              
            }
        },
        messages : {
            name: {
                required : "<i class='fa fa-exclamation-circle'></i><?php echo $lang['ncms_model_error'];?>" ,
                maxlength : "<i class='fa fa-exclamation-circle'></i><?php echo $lang['ncms_model_error'];?>"
            },
            tablename: {
                isenglish : "<i class='fa fa-exclamation-circle'></i><?php echo $lang['ncms_model_table_error'];?>",
               
            }
        }
    });
});
</script>