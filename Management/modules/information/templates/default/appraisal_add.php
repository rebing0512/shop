<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=mb_appraisal" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3><?php echo $output['action'];?>横图信息模式</h3>
                <h5><?php echo $output['action'];?>横图信息</h5>
            </div>
        </div>
    </div>
    <!-- 操作说明 -->
    <form id="user_form" enctype="multipart/form-data" method="post">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="id" id="id" value="<?php echo $output['page']['id'];?>" />
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="name"><em>*</em>名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['name'];?>" name="name" id="name" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="sort"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['sort'];?>" id="sort" name="sort" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="web_title"><em>*</em>标题</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['web_title'];?>" id="web_title" name="web_title" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="type"><em>*</em>类型</label>
                </dt>
                <dd class="opt">

                    <select id="type" name="type">

                        <?php foreach ($output['type'] as $k=>$v):?>
                            <option value="<?=$k?>" <?php if ($output['page']['type'] == $k){ echo 'selected'; } ?>><?=$v?></option>
                        <?php endforeach;?>

                    </select>

                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="type"><em>*</em>核心分类</label>
                </dt>
                <dd class="opt">

                    <select id="h_type" name="h_type">

                        <?php foreach ($output['category'] as $item):?>
                            <option value="<?=$item['id']?>" <?php if ($output['page']['h_type']==$item['id']):echo 'selected';endif;?>>
                                <?=$item['name']?>
                            </option>
                        <?php endforeach;?>

                    </select>
                    
                    <!----信息分类下的分类信息--->
                     <select id="info_type_id" name="info_type_id" style="display:none;">
                    </select>
                    


                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
               <!-- -->
                    <script>
					$(function(){
						//console.log("test");
						var info_type=new Object();
						//info_type['2'] = {'1':'test'};
						//console.log(info_type);
						info_type = <?php 
						   $this_json_arr = array();
						   //var_dump($output['info_type_data']);
						   //$first_xiabiao =0;
						   foreach ($output['info_type_data'] as $item){
							   //if(!$first_xiabiao) $first_xiabiao = $item['h_type'];
						       $this_json_arr[$item['h_type']][] = array(
							                                      'id' => $item['id'],
																  'name' =>$item['name']
							                                    );
						   }
						   echo  json_encode($this_json_arr);
						?>;
						//console.log(info_type);
						var this_cate_id = <?php echo empty($output['page']['h_type'])?0:$output['page']['h_type']; ?>;
						var info_cate_id = '<?php echo $output['page']['h_type']; ?>';
						var info_type_id = '<?php echo $output['page']['info_type_id']; ?>';
						
						
						function info_type_select(cate_id){
						    $("#info_type_id").hide();
							$("#info_type_id").empty();	
							console.log(info_type[cate_id]);
							var num = 0;						
							for(var item in info_type[cate_id]) {
								num++;
								console.log(item);
							   $("#info_type_id").append("<option value='"+info_type[cate_id][item].id+"'>"+info_type[cate_id][item].name+"</option>");							
							}
							if(info_cate_id == cate_id){
							   $("#info_type_id").find("option[value='"+info_type_id+"']").attr("selected",true);
							}
							//进行判断	
							if(num){
								$("#info_type_id+.err").text("");
								$("#submitBtn").show();						
						        $("#info_type_id").show();							
							}else{
								$("#info_type_id+.err").text(" 此核心分类下信息分类，不可设置内容。");
								$("#info_type_id+.err").attr("style","color:red;")
								$("#submitBtn").hide();		
							}
						}
						
						if(!this_cate_id){
						   this_cate_id =  $("select[name='h_type'] option:selected").val();
						}
						info_type_select(this_cate_id);
						
						//核心分类改变事件
						$("#h_type").change(function(){
						    var this_sel =  $("select[name='h_type'] option:selected").val();
							console.log(this_sel);
							info_type_select(this_sel);
						});
						
					});
					</script>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="url">URL</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $output['page']['url'];?>" id="url" name="url" class="input-txt">
                    <span class="err"></span> </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>图片</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show"><span class="type-file-box">
            <input class="type-file-file" id="_pic" name="_pic" type="file" size="30" hidefocus="true" title="点击按钮选择文件并提交表单后上传生效">
            <input type="text" value="<?php echo $output['page']['picture'];?>" name="member_avatar" id="member_avatar" class="type-file-text" />
            <input type="button" name="button" id="button" value="选择上传..." class="type-file-button" />
            </span></div>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="articleForm">简介</label>
                </dt>
                <dd class="opt">
                    <textarea type="text"  name="intro" id="intro" class="tarea"><?php echo $output['page']['intro'];?></textarea>
                    <span class="err"></span>
                    <p class="notic">请设置简介</p>
                </dd>
            </dl>
            <dl class="row" style="display:none;">
                <dt class="tit">
                    <label><em>*</em>内容</label>
                </dt>
                <dd class="opt">
                    <?php showEditor('detail',$output['page']['detail']);?>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    //裁剪图片后返回接收函数
    function call_back(picname){
        $('#member_avatar').val(picname);
        $('#view_img').attr('src','<?php echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR;?>/'+picname)
            .attr('onmouseover','toolTip("<img src=<?php echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR;?>/'+picname+'>")');
    }
    $(function(){
        $('input[class="type-file-file"]').change(uploadChange);
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
                    url : '<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=pic_upload&form_submit=ok&uploadpath=<?php echo ATTACH_AVATAR;?>',
                    secureuri:false,
                    fileElementId:'_pic',
                    dataType: 'json',
                    success: function (data, status)
                    {
                        if (data.status == 1){
                            ajax_form('cutpic','<?php echo $lang['nc_cut'];?>','<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=pic_cut&type=member&x=120&y=120&resize=1&ratio=0&url='+data.url,690);
                        }else{
                            alert(data.msg);
                        }
                        $('input[class="type-file-file"]').bind('change',uploadChange);
                    },
                    error: function (data, status, e)
                    {
                        alert('上传失败');
                        $('input[class="type-file-file"]').bind('change',uploadChange);
                    }
                }
            )
        };
        //按钮先执行验证再提交表单
        $("#submitBtn").click(function(){
            if($("#user_form").valid()){
                $("#user_form").submit();
            }
        });
        $('#user_form').validate({
            errorPlacement: function(error, element){
                var error_td = element.parent('dd').children('span.err');
                error_td.append(error);
            },
            rules : {
                member_name: {
                    required : true,
                    minlength: 3,
                    maxlength: 20,
                    remote   : {
                        url :'index.php?con=member&fun=ajax&branch=check_user_name',
                        type:'get',
                        data:{
                            user_name : function(){
                                return $('#member_name').val();
                            },
                            member_id : ''
                        }
                    }
                },
                member_passwd: {
                    required : true,
                    maxlength: 20,
                    minlength: 6
                },
                member_email   : {
                    required : true,
                    email : true,
                    remote   : {
                        url :'index.php?con=member&fun=ajax&branch=check_email',
                        type:'get',
                        data:{
                            user_name : function(){
                                return $('#member_email').val();
                            },
                            member_id : '<?php echo $output['member_array']['member_id'];?>'
                        }
                    }
                },
                member_qq : {
                    digits: true,
                    minlength: 5,
                    maxlength: 11
                }
            },
            messages : {
                member_name: {
                    required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_add_name_null']?>',
                    maxlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_add_name_length']?>',
                    minlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_add_name_length']?>',
                    remote   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_add_name_exists']?>'
                },
                member_passwd : {
                    required : '<i class="fa fa-exclamation-circle"></i><?php echo '密码不能为空'; ?>',
                    maxlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_password_tip']?>',
                    minlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_password_tip']?>'
                },
                member_email  : {
                    required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_email_null']?>',
                    email   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_valid_email']?>',
                    remote : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_email_exists']?>'
                },
                member_qq : {
                    digits: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_qq_wrong']?>',
                    minlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_qq_wrong']?>',
                    maxlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_qq_wrong']?>'
                }
            }
        });
    });
</script>
