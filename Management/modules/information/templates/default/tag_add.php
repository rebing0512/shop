<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.go(-1);" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增/修改绑定标签</h3>
                <h5>微信端推荐标签维护</h5>
            </div>
        </div>
    </div>

    <form id="form" method="post" action="index.php?con=mb_recommend&fun=<?=$_GET['fun']?>&type=<?=$_GET['type']?>">
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
                    <label for="ac_name"><em>*</em>标签名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="name" id="name" class="input-txt" value="<?php echo $output['data']['name']; ?>" />
                    <span class="err"></span>
                    <p class="notic"></p>
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
                name: {
                    required: true
                },
                sort: {
                    required: true,
                    min:1
                }
            },
            messages:{
                name:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写标签名称'
                },
                sort:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写排列顺序',
                    min:'<i class="fa fa-exclamation-circle"></i>最小为1'
                }
            }
        });
    });
</script>