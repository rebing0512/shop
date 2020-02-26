<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=mb_app_type&fun=index" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增/修信息模式推荐分类</h3>
                <h5>横图和圆图的信息模式下进行分类的管理，以便组合成可以需要的维护</h5>
            </div>
        </div>
    </div>

    <form id="form" method="post" action="index.php?con=mb_app_type&fun=<?=$_GET['fun']?>">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="id" value="<?php echo $output['data']['id']; ?>" />
        <div class="ncap-form-default">

            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="sort" id="sort" class="input-txt" value="<?php echo (int)$output['data']['sort']; ?>" />
                    <span class="err"></span>
                    <p class="notic">自然排序，数字越小越靠前</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>分类名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="name" id="name" class="input-txt" value="<?php echo $output['data']['name']; ?>" />
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>关联核心分类</label>
                </dt>
                <dd class="opt">
                    <select class="input-txt" name="h_type" id="h_type">
                        <option value="">请选择</option>
                        <?php foreach ($output['category'] as $type_name): ?>
                            <option
                                value="<?php echo $type_name['id']; ?>" <?php if (!is_null($output['data']['h_type']) && $type_name['id'] == $output['data']['h_type']) echo 'selected'; ?>><?php echo $type_name['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic">选择核心分类</p>
                </dd>
            </dl>
            
            
             <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>关联信息类型</label>
                </dt>
                <dd class="opt">
                    <select class="input-txt" name="info_type" id="info_type">
                        <option value="">请选择</option>
                        <?php foreach ($output['info_fenlei'] as $type_name): ?>
                            <option
                                value="<?php echo $type_name['id']; ?>" <?php if (!is_null($output['data']['info_type']) && $type_name['id'] == $output['data']['info_type']) echo 'selected'; ?>><?php echo $type_name['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic">选择信息类型</p>
                </dd>
            </dl>
            
            
            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#submitBtn').on('click',function(){
            if($('#form').valid())
            {
                $('#form').submit();
            }
        });
        $('#form').validate({
            errorPlacement:function(err,element){
                var error_id = element.parent('dd').children('span.err');
                error_id.append(err);
            },
            rules: {
                core_category_id: {
                    required: true
                },
                h_type: {
                    required: true
                },
                info_type: {
                    required: true
                },
                name: {
                    required: true
                },
                sort: {
                    required: true,
                    min:1
                }
            },
            messages:{

                core_category_id:{
                    required:'<i class="fa fa-exclamation-circle"></i>请选择推荐类型'
                },
                h_type:{
                    required:'<i class="fa fa-exclamation-circle"></i>请选择系统核心分类'
                },
                info_type:{
                    required:'<i class="fa fa-exclamation-circle"></i>请选择信息类型'
                },
                name:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写分类名称'
                },
                sort:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写排列顺序',
                    min:'<i class="fa fa-exclamation-circle"></i>最小为1'
                }
            }
        });
    });
</script>