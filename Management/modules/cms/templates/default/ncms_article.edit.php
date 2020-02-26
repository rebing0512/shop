<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page" style="padding-top:0px;">

 <form name="myform" id="myform" action="index.php?con=ncms_article&fun=ncms_article_update" method="post"  enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php echo $output['id'];?>">
  <input type="hidden" name="catid" value="<?php echo $output['catid'];?>">
    <div class="ncap-form-default">
            <?php
            if(is_array($output['forminfos']['senior'])) {
             foreach($output['forminfos']['senior'] as $field=>$info) {
              if($info['isomnipotent']) continue;
              if($info['formtype']=='omnipotent') {
                foreach($output['forminfos']['base'] as $_fm=>$_fm_value) {
                  if($_fm_value['isomnipotent']) {
                    $info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
                  }
                }
                foreach($output['forminfos']['senior'] as $_fm=>$_fm_value) {
                  if($_fm_value['isomnipotent']) {
                    $info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
                  }
                }
              }
             ?>
              <dl class="row">
                <dt class="tit">
                  <label for="tablename"><?php if($info['star']){ ?><em>*</em><?php } ?><?php echo $info['name'];?> </label>
                </dt>
                <dd class="opt">
                  <?php echo $info['form'];?>
                  <span class="err"></span>
                   <p class="notic"><?php echo $info['tips'];?></p>
                </dd>
              </dl>

        <?php }}?>

            <?php if(is_array($output['forminfos']['base'])) {
              foreach($output['forminfos']['base'] as $field=>$info) {
                 if($info['isomnipotent']) continue;
                 if($info['formtype']=='omnipotent') {
                  foreach($output['forminfos']['base'] as $_fm=>$_fm_value) {
                    if($_fm_value['isomnipotent']) {
                      $info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
                    }
                  }
                  foreach($output['forminfos']['senior'] as $_fm=>$_fm_value) {
                    if($_fm_value['isomnipotent']) {
                      $info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
                    }
                  }
                }
               ?>


              <dl class="row">
                <dt class="tit">
                  <label for="tablename"><?php if($info['star']){ ?><em>*</em><?php } ?><?php echo $info['name'];?> </label>
                </dt>
                <dd class="opt">
                  <?php echo $info['form'];?>
                  <span class="err"></span>
                   <p class="notic"><?php echo $info['tips'];?></p>
                </dd>
              </dl>
      
            <?php } }?>

            <div class="bot"><a id="submit" href="javascript:void(0)" class="ncap-btn-big ncap-btn-green"><?php echo $lang['nc_submit'];?></a></div>
  </div>
</form>
</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/laydate/laydate.js"></script>
<script type="text/javascript">
//添加/修改文章时，标题加粗
function input_font_bold() {
    if ($('#title').css('font-weight') == '700' || $('#title').css('font-weight') == 'bold') {
        $('#title').css('font-weight', 'normal');
        $('#style_font_weight').val('');
    } else {
        $('#title').css('font-weight', 'bold');
        $('#style_font_weight').val('bold');
    }
}
//输入长度提示
function strlen_verify(obj, checklen, maxlen) {
    var v = obj.value,
        charlen = 0,
        maxlen = !maxlen ? 200 : maxlen,
        curlen = maxlen,
        len = strlen(v);
    var charset = 'utf-8';
    for (var i = 0; i < v.length; i++) {
        if (v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
            curlen -= charset == 'utf-8' ? 2 : 1;
        }
    }
    if (curlen >= len) {
        $('#' + checklen).html(curlen - len);
    } else {
        obj.value = mb_cutstr(v, maxlen, true);
    }
}

//长度统计
function strlen(str) {
    return ($.browser.msie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

//转向地址
function ruselinkurl() {
    if ($('#islink').is(':checked') == true) {
        $('#linkurl').attr('disabled', null);
        return false;
    } else {
        $('#linkurl').attr('disabled', 'true');
    }
}

function mb_cutstr(str, maxlen, dot) {
    var len = 0;
    var ret = '';
    var dot = !dot ? '...' : '';

    maxlen = maxlen - dot.length;
    for (var i = 0; i < str.length; i++) {
        len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
        if (len > maxlen) {
            ret += dot;
            break;
        }
        ret += str.substr(i, 1);
    }
    return ret;
}
  $(function(){
     $("#submit").click(function(){
          
            $("#myform").submit();
          
      });

  })
</script>
</div>
